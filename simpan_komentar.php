<?php
include "koneksi.php";

$id = $_POST['id'];
$komentar = $_POST['komentar'];

mysqli_query($conn,"
UPDATE tugas
SET komentar='$komentar'
WHERE id='$id'
");

header("Location: kelola_tugas.php");
?>