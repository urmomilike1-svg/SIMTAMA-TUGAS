<?php
session_start();
include "koneksi.php";

if(!isset($_SESSION['username']) || $_SESSION['role'] != 'dosen'){
    header("Location: login.php");
    exit;
}

$dosen_username = $_SESSION['username'];

$matakuliah_query = mysqli_query($conn,"
SELECT * FROM matakuliah
WHERE dosen_id = (
SELECT id FROM dosen WHERE nama='$dosen_username'
)");

$matakuliah = mysqli_fetch_assoc($matakuliah_query);

if(!$matakuliah){
echo "Anda belum memiliki matakuliah yang diampu.";
exit;
}

$tugas_query = mysqli_query($conn,"
SELECT t.*, m.nama AS nama_mahasiswa
FROM tugas t
JOIN mahasiswa m ON t.nim = m.nim
WHERE t.matakuliah_id = ".$matakuliah['id']."
ORDER BY t.deadline ASC
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Tugas Mahasiswa</title>
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="tugas.css">

<style>

.tugas-container{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(280px,1fr));
gap:15px;
margin:30px;
}

.tugas-card{
background:white;
padding:20px;
border-radius:12px;
box-shadow:0 4px 10px rgba(0,0,0,0.1);
transition:0.3s;
display:flex;
flex-direction:column;
}

.tugas-card:hover{
transform:translateY(-5px);
box-shadow:0 8px 20px rgba(0,0,0,0.15);
}

.tugas-card h3{
color:#1e40af;
margin-bottom:10px;
border-bottom:2px solid #3b82f6;
padding-bottom:5px;
}

.tugas-card p{
font-size:14px;
color:#374151;
margin-bottom:8px;
}

.deadline{
background:#ef4444;
color:white;
padding:6px 10px;
border-radius:6px;
font-size:12px;
text-align:center;
margin-bottom:10px;
font-weight:bold;
}

.nim{
font-size:12px;
color:#4b5563;
margin-bottom:10px;
}

.btn-group{
margin-top:auto;
display:flex;
gap:5px;
flex-wrap:wrap;
}

.btn{
padding:6px 10px;
border-radius:6px;
font-size:12px;
text-decoration:none;
color:white;
}

.edit{background:#f59e0b;}
.hapus{background:#ef4444;}
.nilai{background:#10b981;}
.komentar{background:#3b82f6;}

</style>

</head>

<body>

<div class="navbar">
<h2>SIMTAMA</h2>
<a href="dashboard.php">Kembali</a>
</div>


<div class="tugas-container">

<?php

if(mysqli_num_rows($tugas_query)==0){

echo "<h3 style='text-align:center;width:100%'>Tidak ada tugas yang aktif</h3>";

}else{

while($t=mysqli_fetch_assoc($tugas_query)){

?>

<div class="tugas-card">

<h3><?php echo $t['judul']; ?></h3>

<p><?php echo $t['deskripsi']; ?></p>

<div class="deadline">
Deadline: <?php echo $t['deadline']; ?>
</div>

<p class="nim">
Mahasiswa: <?php echo $t['nama_mahasiswa']; ?>
</p>

<div class="btn-group">

<a class="btn nilai" href="beri_nilai.php?id=<?php echo $t['id']; ?>">Nilai</a>

<a class="btn komentar" href="komentar_tugas.php?id=<?php echo $t['id']; ?>">Komentar</a>

<a class="btn edit" href="edit_tugas.php?id=<?php echo $t['id']; ?>">Edit</a>

<a class="btn hapus" 
href="hapus_tugas.php?id=<?php echo $t['id']; ?>" 
onclick="return confirm('Apakah Anda yakin ingin menghapus tugas ini?')">
Hapus
</a>

</div>

</div>

<?php
}
}
?>

</div>

</body>
</html>