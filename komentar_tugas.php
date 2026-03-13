<?php
session_start();
include "koneksi.php";

$id = $_GET['id'];

$data = mysqli_query($conn,"SELECT * FROM tugas WHERE id='$id'");
$t = mysqli_fetch_assoc($data);
?>

<!DOCTYPE html>
<html>
<head>

<title>Beri Komentar</title>

<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="tugas.css">

<style>

.form-container{
max-width:500px;
margin:40px auto;
background:white;
padding:25px;
border-radius:12px;
box-shadow:0 5px 15px rgba(0,0,0,0.1);
}

.form-container h2{
text-align:center;
margin-bottom:20px;
}

.form-container textarea{
width:100%;
padding:10px;
border:1px solid #ccc;
border-radius:6px;
margin-bottom:15px;
min-height:100px;
}

.submit-btn{
background:#3b82f6;
color:white;
padding:10px 20px;
border:none;
border-radius:6px;
cursor:pointer;
}

.submit-btn:hover{
background:#2563eb;
}

</style>

</head>

<body>

<div class="navbar">
<h2>SIMTAMA</h2>
<a href="kelola_tugas.php">Kembali</a>
</div>

<div class="form-container">

<h2>Beri Komentar</h2>

<form action="simpan_komentar.php" method="POST">

<input type="hidden" name="id" value="<?php echo $t['id']; ?>">

<label>Judul Tugas</label>
<input type="text" value="<?php echo $t['judul']; ?>" readonly>

<label>Komentar</label>
<textarea name="komentar" required></textarea>

<button type="submit" class="submit-btn">Simpan Komentar</button>

</form>

</div>

</body>
</html>