<?php
$flash_error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['proses'] ?? '') === 'hapus') {
    include_once 'koneksi.php';
    include_once 'models/Level.php';

    $id = $_POST['id'] ?? '';
    if (!empty($id)) {
        $level = new Level();
        $deleted = $level->hapus($id);
        if (!$deleted) {
            $flash_error = 'Data level tidak dapat dihapus karena terdapat riwayat studi terkait. Hapus riwayat studi terlebih dahulu.';
        }
    }
}

$obj = new Level();
$rs = $obj->index();
?>

<div class="container mt-4">

    <h3>Data Level</h3>

    <?php if (!empty($flash_error)) { ?>
        <div class="alert alert-danger" role="alert">
            <?= htmlspecialchars($flash_error) ?>
        </div>
    <?php } ?>

    <a href="index.php?hal=level_form"
       class="btn btn-primary mb-3">
        Tambah
    </a>

    <table class="table table-striped table-bordered">

        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama Level</th>
                <th>Jumlah Studi</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>

        <?php
        $no = 1;

        if (!empty($rs)) {
            foreach ($rs as $row) {
                $relatedCount = $obj->countStudi($row['id']);
        ?>

        <tr>
            <td><?= $no++ ?></td>
            <td><?= htmlspecialchars($row['nama']) ?></td>
            <td><?= $relatedCount ?></td>

            <td>

                <!-- DETAIL selalu tampil -->
                <a href="index.php?hal=level_detail&id=<?= $row['id'] ?>"
                   class="btn btn-info btn-sm">
                    Detail
                </a>

                <!-- Edit -->
                <a href="index.php?hal=level_form&id=<?= $row['id'] ?>"
                   class="btn btn-warning btn-sm">
                    Edit
                </a>

                <?php if ($relatedCount > 0) { ?>
                    <a href="index.php?hal=studies_list&level_id=<?= $row['id'] ?>"
                       class="btn btn-secondary btn-sm">
                        Lihat Studi
                    </a>
                <?php } else { ?>
                    <form method="POST"
                          action="index.php?hal=level_list"
                          style="display:inline-block; margin:0;">

                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                        <input type="hidden" name="proses" value="hapus">

                        <button type="submit"
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Yakin ingin menghapus data ini?')">
                            Hapus
                        </button>

                    </form>
                <?php } ?>

            </td>
        </tr>

        <?php
            }
        } else {
        ?>

        <tr>
            <td colspan="3" class="text-center">
                Data belum tersedia
            </td>
        </tr>

        <?php } ?>

        </tbody>
    </table>

</div>