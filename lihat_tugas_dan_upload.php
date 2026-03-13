<?php
session_start();
include "koneksi.php";

if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit;
}

$nim = $_SESSION['nim'];

if(!$nim){
    echo "Anda tidak memiliki tugas karena NIM tidak tersedia.";
    exit;
}

// Ambil tugas mahasiswa yang belum dinilai
$stmt = $conn->prepare("SELECT * FROM tugas WHERE nim=? AND nilai IS NULL ORDER BY deadline ASC");
$stmt->bind_param("s", $nim);
$stmt->execute();
$result = $stmt->get_result();

date_default_timezone_set('Asia/Jakarta');
$today = date('Y-m-d');
?>

<!DOCTYPE html>
<html>
<head>
<title>Tugas Saya</title>
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="tugas.css">
<style>
/* ========================= */
/* Tombol Upload Tugas */
.upload-btn {
    display: inline-block;
    text-decoration: none;
    background: #3b82f6;
    color: white;
    padding: 8px 16px;
    border-radius: 6px;
    font-size: 0.9rem;
    font-weight: bold;
    transition: background 0.3s, transform 0.2s;
    margin-top: 12px;
}

.upload-btn:hover {
    background: #2563eb;
    transform: scale(1.05);
}

.upload-btn:disabled, .upload-btn[disabled] {
    background: #9ca3af;
    cursor: not-allowed;
    transform: none;
}
.file-label {
    display: block;
    margin-top: 10px;
    font-size: 0.85rem;
    color: #374151;
}
</style>
</head>
<body>

<div class="navbar">
    <h2>SIMTAMA</h2>
    <a href="dashboard.php">Kembali</a>
</div>

<div class="container">

<div class="tugas-container">
<?php
if($result->num_rows > 0){
    while($data = $result->fetch_assoc()){
        $isDeadlinePassed = ($today > $data['deadline']);
?>
<div class="tugas-card">
    <h3><?php echo htmlspecialchars($data['judul']); ?></h3>
    <p><?php echo htmlspecialchars($data['deskripsi']); ?></p>
    <div class="deadline">
        Deadline: <?php echo $data['deadline']; ?>
    </div>

    <!-- Form Upload -->
    <form method="POST" action="proses_upload.php" enctype="multipart/form-data">
        <label class="file-label">Pilih file tugas:</label>
        <input type="file" name="file_tugas" required>
        <button type="submit" class="upload-btn" <?php echo $isDeadlinePassed ? "disabled" : ""; ?>>
            <?php echo $isDeadlinePassed ? "Deadline Terlewati" : "Upload Tugas"; ?>
        </button>
    </form>

    <?php if(!empty($data['file_tugas'])): ?>
        <p style="margin-top:8px; font-size:0.85rem; color:#4b5563;">
            File sebelumnya: <a href="uploads/<?php echo $data['file_tugas']; ?>" target="_blank">Lihat</a>
        </p>
    <?php endif; ?>
</div>
<?php
    }
}else{
    echo "<p style='text-align:center; font-size:1.1rem; color:#6b7280;'>Belum ada tugas yang diberikan.</p>";
}
?>
</div>
</div>

</body>
</html>