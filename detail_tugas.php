<?php
include "koneksi.php";

$id = $_GET['id'];

$query = mysqli_query($conn,"
SELECT pengumpulan_tugas.*, mahasiswa.nama
FROM pengumpulan_tugas
JOIN mahasiswa ON pengumpulan_tugas.nim = mahasiswa.nim
WHERE tugas_id='$id'
");

while($row = mysqli_fetch_assoc($query)){

echo "
<div style='border:1px solid #ddd;padding:10px;margin:10px'>

<h4>$row[nama]</h4>

<a href='$row[file]'>Download File</a>

<form method='post' action='simpan_nilai.php'>

<input type='hidden' name='id' value='$row[id]'>

Nilai:
<input type='number' name='nilai' value='$row[nilai]'>

Komentar:
<textarea name='komentar'>$row[komentar]</textarea>

<button type='submit'>Simpan</button>

</form>

</div>
";

}
?>