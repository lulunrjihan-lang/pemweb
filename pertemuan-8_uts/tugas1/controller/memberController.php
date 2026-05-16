<?php
session_start();
include_once '../koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];

// ambil data user
$sql = "SELECT * FROM member WHERE username = ?";
$stmt = $dbh->prepare($sql);
$stmt->execute([$username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// cek user
if ($user) {

    // kalau password masih plain text (belum hash)
    if ($password == $user['password']) {

        // 🔥 INI YANG PALING PENTING
        $_SESSION['MEMBER'] = $user;

        header("Location: ../index.php");
        exit;

    } else {
        header("Location: ../login.php?msg=error");
        exit;
    }

} else {
    header("Location: ../login.php?msg=error");
    exit;
}
?>