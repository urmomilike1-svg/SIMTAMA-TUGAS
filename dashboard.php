<?php
session_start();

if(!isset($_SESSION['username'])){
header("Location: login.php");
exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Dashboard SIMTAMA</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<div class="navbar">
<h2>SIMTAMA</h2>
<a href="logout.php">Logout</a>
</div>

<div class="container">

<h1>Dashboard</h1>

<?php

if($_SESSION['role']=="mahasiswa"){

echo "

<div class='card-container'>

<div class='card'>
<h3>Lihat Tugas & Upload</h3>
<p>Melihat tugas dari dosen</p>
<a href='lihat_tugas_dan_upload.php'>Buka</a>
</div>


<div class='card'>
<h3>Nilai & Feedback</h3>
<p>Melihat nilai dari dosen</p>
<a href='lihat_nilai.php'>Lihat</a>
</div>

";

}else{

echo "

<div class='card-container'>

<div class='card'>
<h3>Buat Tugas</h3>
<p>Memberikan tugas kepada mahasiswa</p>
<a href='tambah_tugas.php'>Input</a>
</div>

<div class='card'>
<h3>Kelola Tugas Mahasiswa</h3>
<p>Lihat tugas, beri nilai, komentar, edit dan hapus</p>
<a href='kelola_tugas.php'>Buka</a>
</div>

";

}

?>

</div>

</body>
</html>