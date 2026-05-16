<?php
$id = $_REQUEST['id'] ?? null;

if (!$id) {
    header('Location: index.php?hal=studies_list');
    exit;
}

$model = new Studi();
$rs = $model->getStudi($id);

if (!$rs) {
    header('Location: index.php?hal=studies_list');
    exit;
}
?>

<div class="card mb-3">

    <div class="row g-0">

        <div class="col-md-4">

            <?php if (!empty($rs['foto'])) { ?>

                <img src="img/<?= $rs['foto'] ?>"
                     class="img-fluid rounded-start">

            <?php } else { ?>

                <img src="img/nophoto.jpg"
                     class="img-fluid rounded-start">

            <?php } ?>

        </div>

        <div class="col-md-8">

            <div class="card-body">

                <h5 class="card-title">
                    <?= $rs['nama_sekolah'] ?>
                </h5>

                <p class="card-text">

                    Jenjang :
                    <?= $rs['jenjang'] ?>
                    <br>

                    Tahun Lulus :
                    <?= $rs['thn'] ?>
                    <br>

                    Keterangan :
                    <?= $rs['ket'] ?>

                </p>

                <a href="index.php?hal=studies_list"
                   class="btn btn-primary">
                    Kembali
                </a>

            </div>

        </div>

    </div>

</div>