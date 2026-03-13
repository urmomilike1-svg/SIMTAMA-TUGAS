<?php
session_start();
include "koneksi.php";

// Pastikan dosen login
if(!isset($_SESSION['username']) || $_SESSION['role'] != 'dosen'){
    header("Location: login.php");
    exit;
}

// Ambil matakuliah dosen login (anggap 1 matakuliah per dosen)
$dosen_username = $_SESSION['username'];
$matakuliah_query = mysqli_query($conn, "
    SELECT * FROM matakuliah 
    WHERE dosen_id = (
        SELECT id FROM dosen WHERE nama = '$dosen_username'
    )
");
$matakuliah = mysqli_fetch_assoc($matakuliah_query);

if(!$matakuliah){
    echo "Anda belum memiliki matakuliah yang diampu.";
    exit;
}

// Ambil daftar mahasiswa untuk dropdown
$mahasiswa_query = mysqli_query($conn, "SELECT * FROM mahasiswa ORDER BY nama ASC");

// Ambil semua tugas dosen untuk matakuliah ini
$tugas_query = mysqli_query($conn, "
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
    <title>Buat & Lihat Tugas</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .form-container{
            max-width: 600px;
            margin: 30px auto;
            background:white;
            padding:25px;
            border-radius:12px;
            box-shadow:0 5px 15px rgba(0,0,0,0.1);
        }
        .form-container h2{
            text-align:center;
            margin-bottom:20px;
            color:#1e40af;
        }
        .form-container label{
            font-weight:bold;
            margin-top:10px;
            display:block;
            color:#374151;
        }
        .form-container input[type=text],
        .form-container textarea,
        .form-container select,
        .form-container input[type=date]{
            width:100%;
            padding:10px;
            margin-top:5px;
            margin-bottom:15px;
            border:1px solid #ccc;
            border-radius:6px;
            font-size:14px;
        }
        .form-container textarea{
            resize:vertical;
            min-height:80px;
        }
        .submit-btn{
            background:#3b82f6;
            color:white;
            padding:10px 20px;
            border:none;
            border-radius:6px;
            font-weight:600;
            cursor:pointer;
            transition:0.3s;
        }
        .submit-btn:hover{
            background:#2563eb;
            transform:scale(1.05);
        }

        /* =================== */
        /* Kartu Tugas Dosen */
        .tugas-container{
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 15px;
            justify-items: center;
            margin-top: 30px;
        }
        .tugas-card{
            background:#ffffff;
            width:100%;
            max-width:300px;
            padding:20px;
            border-radius:12px;
            box-shadow:0 4px 10px rgba(0,0,0,0.1);
            transition: transform 0.3s, box-shadow 0.3s;
            display:flex;
            flex-direction:column;
        }
        .tugas-card:hover{
            transform:translateY(-6px);
            box-shadow:0 8px 20px rgba(0,0,0,0.15);
        }
        .tugas-card h3{
            color:#1e40af;
            margin-bottom:10px;
            font-size:1.3rem;
            font-weight:700;
            border-bottom:2px solid #3b82f6;
            padding-bottom:5px;
            letter-spacing:0.5px;
        }
        .tugas-card p{
            color:#374151;
            font-size:0.95rem;
            margin-bottom:8px;
            line-height:1.5;
            text-align:justify;
        }
        .deadline{
            background:#ef4444;
            color:white;
            padding:6px 12px;
            border-radius:6px;
            font-weight:bold;
            font-size:0.85rem;
            text-align:center;
            margin-bottom:8px;
        }
        .nim{
            font-size:0.85rem;
            color:#4b5563;
            margin-bottom:8px;
        }
    </style>
</head>
<body>

<div class="navbar">
    <h2>SIMTAMA</h2>
    <a href="dashboard.php">Kembali</a>
</div>

<div class="form-container">
    <h2>Buat Tugas</h2>
    <form action="simpan_tugas.php" method="POST">
        <label>Judul Tugas (Otomatis dari Matakuliah)</label>
        <input type="text" name="judul" value="<?php echo htmlspecialchars($matakuliah['nama']); ?>" readonly>

        <label>Deskripsi Tugas</label>
        <textarea name="deskripsi" placeholder="Masukkan deskripsi tugas" required></textarea>

        <label>Deadline</label>
        <input type="date" name="deadline" required>

        <label>Mahasiswa</label>
        <select name="nim" required>
            <option value="">-- Pilih Mahasiswa --</option>
            <?php while($mhs = mysqli_fetch_assoc($mahasiswa_query)) { ?>
                <option value="<?php echo $mhs['nim']; ?>"><?php echo $mhs['nama']; ?> (<?php echo $mhs['nim']; ?>)</option>
            <?php } ?>
        </select>

        <input type="hidden" name="matakuliah_id" value="<?php echo $matakuliah['id']; ?>">

        <button type="submit" class="submit-btn">Simpan Tugas</button>
    </form>
</div>

</body>
</html>