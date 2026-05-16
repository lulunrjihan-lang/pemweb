<?php
$id = $_GET['id'] ?? null;

if (!$id) {
    header('Location: index.php?hal=level_list');
    exit;
}

$obj = new Level();
$row = $obj->getLevel($id);

if (!$row) {
    header('Location: index.php?hal=level_list');
    exit;
}
?>

<div class="container mt-4">

    <h3>Detail Level</h3>

    <table class="table table-bordered">

        <tr>
            <th width="20%">ID</th>

            <td>
                <?= $row['id'] ?>
            </td>
        </tr>

        <tr>
            <th>Nama Level</th>

            <td>
                <?= htmlspecialchars($row['nama']) ?>
            </td>
        </tr>

    </table>

    <a href="index.php?hal=level_list"
       class="btn btn-secondary">

        Kembali

    </a>

</div>