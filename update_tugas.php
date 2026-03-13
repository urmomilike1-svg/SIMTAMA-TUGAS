<?php
include "koneksi.php";

$id = $_POST['id'];
$deskripsi = $_POST['deskripsi'];
$deadline = $_POST['deadline'];

mysqli_query($conn,"
UPDATE tugas
SET deskripsi='$deskripsi',
deadline='$deadline'
WHERE id='$id'
");

header("Location: kelola_tugas.php");
?>