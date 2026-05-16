<?php
session_start();

include_once '../koneksi.php';
include_once '../models/Studies.php';

// Jika tidak ada POST, redirect
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../index.php?hal=studies_list");
    exit;
}

$nama = $_POST['nama_sekolah'] ?? '';
$thn = $_POST['thn'] ?? '';
$ket = $_POST['ket'] ?? '';
$idlevel = $_POST['idlevel'] ?? '';
$foto = $_POST['foto'] ?? '';
$tombol = $_POST['proses'] ?? '';

$data = [
    $nama,
    $thn,
    $ket,
    $idlevel,
    $foto,
];

$obj_studi = new Studi();
switch ($tombol) {
    case 'simpan':
        if (!empty($nama) && !empty($thn) && !empty($idlevel)) {
            try {
                $obj_studi->simpan($data);
            } catch (Exception $e) {
                // Error handling
            }
        }
        break;
    case 'ubah':
        $id = $_POST['idx'] ?? '';
        if (!empty($id) && !empty($nama) && !empty($thn) && !empty($idlevel)) {
            try {
                $data[] = $id;
                $obj_studi->ubah($data);
            } catch (Exception $e) {
                // Error handling
            }
        }
        break;
    case 'hapus':
        $id = $_POST['id'] ?? '';
        if (!empty($id)) {
            try {
                $obj_studi->hapus($id);
            } catch (Exception $e) {
                // Error handling
            }
        }
        break;
}

header('Location: ../index.php?hal=studies_list');
exit;

?>