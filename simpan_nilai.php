<?php
include "koneksi.php";

$id = $_POST['id'];
$nilai = $_POST['nilai'];

mysqli_query($conn,"
UPDATE tugas
SET nilai='$nilai'
WHERE id='$id'
");

header("Location: kelola_tugas.php");
?>