<?php
session_start();
include "koneksi.php";

if(!isset($_SESSION['username']) || $_SESSION['role'] != 'mahasiswa'){
    header("Location: login.php");
    exit;
}

$nim = $_SESSION['nim'];

$data = mysqli_query($conn,"
SELECT * FROM tugas
WHERE nim='$nim'
AND nilai IS NOT NULL
");
?>

<!DOCTYPE html>
<html>
<head>

<title>Nilai & Feedback</title>

<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="tugas.css">

</head>

<body>

<div class="navbar">
<h2>SIMTAMA</h2>
<a href="dashboard.php">Kembali</a>
</div>

<div class="tugas-container">

<?php

if(mysqli_num_rows($data)==0){

echo "<h3 style='text-align:center;width:100%'>Belum ada tugas yang dinilai</h3>";

}else{

while($d=mysqli_fetch_assoc($data)){
?>

<div class="tugas-card">

<h3><?php echo $d['judul']; ?></h3>

<p><?php echo $d['deskripsi']; ?></p>

<div class="deadline">
Deadline: <?php echo $d['deadline']; ?>
</div>

<p><b>Nilai:</b> <?php echo $d['nilai']; ?></p>

<p><b>Komentar:</b> <?php echo $d['komentar']; ?></p>

</div>

<?php
}
}
?>

</div>

</body>
</html>