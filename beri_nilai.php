<?php
session_start();
include "koneksi.php";

if(!isset($_SESSION['username']) || $_SESSION['role']!='dosen'){
header("Location: login.php");
exit;
}

$id = $_GET['id'];

$data = mysqli_query($conn,"SELECT * FROM tugas WHERE id='$id'");
$tugas = mysqli_fetch_assoc($data);
?>

<!DOCTYPE html>
<html>
<head>

<title>Beri Nilai</title>

<link rel="stylesheet" href="style.css">

<style>

.form-box{
max-width:500px;
margin:50px auto;
background:white;
padding:25px;
border-radius:10px;
box-shadow:0 5px 15px rgba(0,0,0,0.1);
}

.form-box h2{
text-align:center;
margin-bottom:20px;
}

input,textarea{
width:100%;
padding:10px;
margin-bottom:15px;
border:1px solid #ccc;
border-radius:6px;
}

button{
background:#10b981;
color:white;
border:none;
padding:10px 15px;
border-radius:6px;
cursor:pointer;
}

</style>

</head>

<body>

<div class="navbar">
<h2>SIMTAMA</h2>
<a href="kelola_tugas.php">Kembali</a>
</div>

<div class="form-box">

<h2>Beri Nilai</h2>

<form action="simpan_nilai.php" method="POST">

<input type="hidden" name="id" value="<?php echo $tugas['id']; ?>">

<label>Judul Tugas</label>
<input type="text" value="<?php echo $tugas['judul']; ?>" readonly>

<label>Nilai</label>
<input type="number" name="nilai" required>

<label>Komentar</label>
<textarea name="komentar" required></textarea>

<button type="submit">Simpan Nilai</button>

</form>

</div>

</body>
</html>