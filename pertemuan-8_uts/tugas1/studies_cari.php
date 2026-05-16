<?php
$ar_judul = ['NO', 'NAMA SEKOLAH', 'TAHUN', 'KETERANGAN', 'JENJANG', 'FOTO', 'ACTION'];

$obj = new Studi();
$keyword = $_GET['keyword'] ?? '';
$rs = $obj->cari($keyword);
?>

<h3>Hasil Pencarian Riwayat Studi</h3>
<a href="index.php?hal=studies_list" class="btn btn-secondary mb-3">Kembali ke Daftar</a>
<table class="table table-striped">
    <thead>
        <tr>
            <?php
            foreach ($ar_judul as $jdl) {
                echo '<th>' . $jdl . '</th>';
            }
            ?>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        foreach ($rs as $row) {
        ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= htmlspecialchars($row['nama_sekolah']) ?></td>
                <td><?= htmlspecialchars($row['thn']) ?></td>
                <td><?= htmlspecialchars($row['ket']) ?></td>
                <td><?= htmlspecialchars($row['jenjang']) ?></td>
                <td width="15%">
                    <?php if (!empty($row['foto'])) { ?>
                        <img src="img/<?= htmlspecialchars($row['foto']) ?>" width="80" />
                    <?php } else { ?>
                        <img src="img/nophoto.jpg" width="80" />
                    <?php } ?>
                </td>
                <td>
                    <form method="POST" action="controller/studiesController.php">
                        <a href="index.php?hal=studies_detail&id=<?= $row['id'] ?>" class="btn btn-info btn-sm">Detail</a>
                        <a href="index.php?hal=studies_form&id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Ubah</a>
                        <button type="submit" name="proses" value="hapus" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin dihapus?')">Hapus</button>
                        <input type="hidden" name="id" value="<?= $row['id'] ?>" />
                    </form>
                </td>
            </tr>
        <?php
            $no++;
        }
        ?>
    </tbody>
</table>