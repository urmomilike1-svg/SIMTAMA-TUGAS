<?php
session_start();
include "koneksi.php";

if(!isset($_SESSION['username']) || $_SESSION['role'] != 'dosen'){
    header("Location: login.php");
    exit;
}

$judul = $_POST['judul'];
$deskripsi = $_POST['deskripsi'];
$deadline = $_POST['deadline'];
$nim = $_POST['nim'];
$matakuliah_id = $_POST['matakuliah_id'];

$query = mysqli_query($conn,"
INSERT INTO tugas (judul, deskripsi, deadline, nim, matakuliah_id)
VALUES ('$judul','$deskripsi','$deadline','$nim','$matakuliah_id')
");

if($query){
    header("Location: kelola_tugas.php");
}else{
    echo "Tugas gagal disimpan";
}
?>

