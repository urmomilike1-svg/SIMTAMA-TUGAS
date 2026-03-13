<?php
session_start();
include "koneksi.php";

if(!isset($_SESSION['username']) || $_SESSION['role']!='dosen'){
header("Location: login.php");
exit;
}

$id = $_GET['id'];

$data = mysqli_query($conn,"SELECT * FROM tugas WHERE id='$id'");
$t = mysqli_fetch_assoc($data);
?>

<!DOCTYPE html>
<html>
<head>

<title>Edit Tugas</title>

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

.form-container textarea,
.form-container input{
width:100%;
padding:10px;
margin-bottom:15px;
border:1px solid #ccc;
border-radius:6px;
}

.submit-btn{
background:#f59e0b;
color:white;
padding:10px 20px;
border:none;
border-radius:6px;
cursor:pointer;
}

.submit-btn:hover{
background:#d97706;
}

</style>

</head>

<body>

<div class="navbar">
<h2>SIMTAMA</h2>
<a href="kelola_tugas.php">Kembali</a>
</div>

<div class="form-container">

<h2>Edit Tugas</h2>

<form action="update_tugas.php" method="POST">

<input type="hidden" name="id" value="<?php echo $t['id']; ?>">

<label>Judul Tugas</label>
<input type="text" value="<?php echo $t['judul']; ?>" readonly>

<label>Deskripsi</label>
<textarea name="deskripsi" required><?php echo $t['deskripsi']; ?></textarea>

<label>Deadline</label>
<input type="date" name="deadline" value="<?php echo $t['deadline']; ?>" required>

<button type="submit" class="submit-btn">Update Tugas</button>

</form>

</div>

</body>
</html>