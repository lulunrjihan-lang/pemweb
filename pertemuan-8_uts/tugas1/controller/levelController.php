<?php
session_start();

include_once '../koneksi.php';
include_once '../models/Level.php';

// Jika tidak ada POST, redirect ke level_list
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../index.php?hal=level_list");
    exit;
}

$obj = new Level();

$proses = $_POST['proses'] ?? '';

switch ($proses) {

    case 'simpan':
        $nama = $_POST['nama'] ?? '';
        if (!empty($nama)) {
            $obj->simpan([$nama]);
        }
        break;

    case 'ubah':
        $id = $_POST['idx'] ?? '';
        $nama = $_POST['nama'] ?? '';

        if (!empty($id) && !empty($nama)) {
            $obj->ubah([$nama, $id]);
        }
        break;

    case 'hapus':
        $id = $_POST['id'] ?? '';

        if (!empty($id)) {
            try {
                $result = $obj->hapus($id);
                if ($result) {
                    // Sukses hapus
                }
            } catch (Exception $e) {
                // Error handling jika ada database error
            }
        }
        break;
}

header("Location: ../index.php?hal=level_list");
exit;
?>