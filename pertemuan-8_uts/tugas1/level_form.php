<?php
$id = $_GET['id'] ?? null;

$obj = new Level();

$row = [];

if ($id) {
    $row = $obj->getLevel($id);
}

function val($row, $key)
{
    return $row[$key] ?? '';
}
?>

<div class="container mt-4">

    <h3>
        <?= $id ? 'Ubah' : 'Tambah' ?> Level
    </h3>

    <form method="POST"
          action="controller/levelController.php">

        <div class="mb-3">

            <label class="form-label">
                Nama Level
            </label>

            <input type="text"
                   name="nama"
                   class="form-control"
                   required
                   value="<?= htmlspecialchars(val($row,'nama')) ?>">

        </div>

        <?php if (!$id) { ?>

            <button type="submit"
                    class="btn btn-primary"
                    name="proses"
                    value="simpan">

                Simpan

            </button>

        <?php } else { ?>

            <button type="submit"
                    class="btn btn-success"
                    name="proses"
                    value="ubah">

                Ubah

            </button>

            <input type="hidden"
                   name="idx"
                   value="<?= $id ?>">

        <?php } ?>

        <a href="index.php?hal=level_list"
           class="btn btn-secondary">

            Kembali

        </a>

    </form>

</div>