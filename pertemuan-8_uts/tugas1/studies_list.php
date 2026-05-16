<?php
$obj = new Studi();
$level_id = $_GET['level_id'] ?? null;

if (!empty($level_id)) {
    $rs = $obj->getByLevel($level_id);
    $title = 'Daftar Riwayat Studi (Level terkait)';
} else {
    $rs = $obj->index();
    $title = 'Daftar Riwayat Studi';
}
?>

<div class="container mt-4">

<h3><?= htmlspecialchars($title) ?></h3>

<a href="index.php?hal=studies_form" class="btn btn-primary mb-3">
    Tambah
</a>

<?php if (!empty($level_id)) { ?>
    <a href="index.php?hal=studies_list" class="btn btn-secondary mb-3 ms-2">
        Tampilkan Semua Studi
    </a>
<?php } ?>

<table class="table table-striped">

    <thead>
        <tr>
            <th>No</th>
            <th>Nama Sekolah</th>
            <th>Tahun</th>
            <th>Keterangan</th>
            <th>Jenjang</th>
            <th>Foto</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>

    <?php
    $no = 1;
    foreach ($rs as $row) {
    ?>

    <tr>
        <td><?= $no++ ?></td>
        <td><?= $row['nama_sekolah'] ?></td>
        <td><?= $row['thn'] ?></td>
        <td><?= $row['ket'] ?></td>
        <td><?= $row['jenjang'] ?></td>

        <td>
            <img src="img/<?= $row['foto'] ?? 'nophoto.jpg' ?>" width="80">
        </td>

        <td>

            <a href="index.php?hal=studies_detail&id=<?= $row['id'] ?>"
               class="btn btn-info btn-sm">
                Detail
            </a>

            <a href="index.php?hal=studies_form&id=<?= $row['id'] ?>"
               class="btn btn-warning btn-sm">
                Edit
            </a>

            <form method="POST"
                  action="controller/studiesController.php"
                  style="display:inline;">

                <input type="hidden" name="id" value="<?= $row['id'] ?>">

                <button type="submit"
                        name="proses"
                        value="hapus"
                        class="btn btn-danger btn-sm"
                        onclick="return confirm('Yakin hapus?')">
                    Hapus
                </button>

            </form>

        </td>
    </tr>

    <?php } ?>

    </tbody>
</table>

</div>