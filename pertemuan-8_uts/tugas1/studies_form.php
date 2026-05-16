<?php
$id = $_GET['id'] ?? null;

$obj = new Studi();

$row = [];

if ($id) {
    $row = $obj->getStudi($id);
}

function old($row, $key)
{
    return $row[$key] ?? '';
}
?>

<div class="container mt-4">

    <h3><?= $id ? 'Ubah' : 'Tambah' ?> Data Studi</h3>

    <form method="POST" action="controller/studiesController.php">

        <div class="mb-3">
            <label>Nama Sekolah</label>

            <input type="text"
                   name="nama_sekolah"
                   class="form-control"
                   value="<?= old($row, 'nama_sekolah') ?>"
                   required>
        </div>

        <div class="mb-3">
            <label>Tahun Lulus</label>

            <input type="text"
                   name="thn"
                   class="form-control"
                   value="<?= old($row, 'thn') ?>"
                   required>
        </div>

        <div class="mb-3">
            <label>Keterangan</label>

            <textarea name="ket"
                      class="form-control"><?= old($row, 'ket') ?></textarea>
        </div>

        <?php
$level = new Level();
$rs_level = $level->index();
?>

<div class="mb-3">
    <label>Jenjang</label>

    <select name="idlevel" class="form-select" required>

        <option value="">Pilih Jenjang</option>

        <?php foreach($rs_level as $lvl){ ?>

            <option value="<?= $lvl['id'] ?>" <?= (old($row, 'idlevel') == $lvl['id']) ? 'selected' : '' ?>>

                <?= $lvl['nama'] ?>

            </option>

        <?php } ?>

    </select>
</div>

        <div class="mb-3">
            <label>Foto</label>

            <input type="text"
                   name="foto"
                   class="form-control"
                   value="<?= old($row, 'foto') ?>">
        </div>

        <?php if (!$id) { ?>

            <button class="btn btn-primary"
                    name="proses"
                    value="simpan">
                Simpan
            </button>

        <?php } else { ?>

            <button class="btn btn-success"
                    name="proses"
                    value="ubah">
                Ubah
            </button>

            <input type="hidden"
                   name="idx"
                   value="<?= $id ?>">

        <?php } ?>

        <a href="index.php?hal=studies_list"
           class="btn btn-secondary">
            Kembali
        </a>

    </form>
</div>