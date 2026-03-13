-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2026 at 04:02 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simtama`
--

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`id`, `nama`) VALUES
(1, 'Dr. Rahman'),
(2, 'Prof. Sari'),
(3, 'Dr. Ahmad'),
(4, 'Dr. Lestari'),
(5, 'Prof. Leon'),
(6, 'Dr. Anita'),
(7, 'Prof. Bimo'),
(8, 'Dr. Citra'),
(9, 'Dr. Dedi'),
(10, 'Prof. Elvira');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `nim` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `nama`, `nim`) VALUES
(1, 'Andi Pratama', '22001'),
(2, 'Budi Santoso', '22002'),
(3, 'Citra Lestari', '22003'),
(4, 'Dedi Kurniawan', '22004'),
(5, 'Eka Putri', '22005'),
(6, 'Fajar Nugroho', '22006'),
(7, 'Gita Sari', '22007'),
(8, 'Hendra Wijaya', '22008'),
(9, 'Indah Permata', '22009'),
(10, 'Joko Saputra', '22010');

-- --------------------------------------------------------

--
-- Table structure for table `matakuliah`
--

CREATE TABLE `matakuliah` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `dosen_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `matakuliah`
--

INSERT INTO `matakuliah` (`id`, `nama`, `dosen_id`) VALUES
(1, 'Pemrograman Web', 1),
(2, 'Basis Data', 2),
(3, 'Struktur Data', 3),
(4, 'Algoritma', 4),
(5, 'Sistem Informasi', 5),
(6, 'Jaringan Komputer', 6),
(7, 'Pemrograman C++', 7),
(8, 'Basis Data Lanjut', 8),
(9, 'Sistem Operasi', 9),
(10, 'Cloud Computing', 10);

-- --------------------------------------------------------

--
-- Table structure for table `pengumpulan_tugas`
--

CREATE TABLE `pengumpulan_tugas` (
  `id` int(11) NOT NULL,
  `tugas_id` int(11) DEFAULT NULL,
  `nim` varchar(20) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `nilai` int(11) DEFAULT NULL,
  `komentar` text DEFAULT NULL,
  `tanggal_upload` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tugas`
--

CREATE TABLE `tugas` (
  `id` int(11) NOT NULL,
  `judul` varchar(200) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `deadline` date DEFAULT NULL,
  `nim` varchar(20) DEFAULT NULL,
  `matakuliah_id` int(11) NOT NULL,
  `nilai` int(11) DEFAULT NULL,
  `komentar` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tugas`
--

INSERT INTO `tugas` (`id`, `judul`, `deskripsi`, `deadline`, `nim`, `matakuliah_id`, `nilai`, `komentar`) VALUES
(1, 'Tugas Pemrograman Web', 'Buat sistem login menggunakan PHP dan MySQL', '2026-04-10', '22001', 1, NULL, NULL),
(2, 'Tugas Basis Data', 'Buat ERD sistem akademik', '2026-04-12', '22001', 2, NULL, NULL),
(3, 'Tugas Struktur Data', 'Implementasi Stack dan Queue', '2026-04-15', '22002', 3, NULL, NULL),
(4, 'Tugas Algoritma', 'Buat program sorting menggunakan quicksort', '2026-04-18', '22002', 4, 86, 'Kerja bagus!'),
(5, 'Tugas Sistem Informasi', 'Analisis sistem perpustakaan', '2026-04-20', '22003', 5, NULL, NULL),
(6, 'Tugas Jaringan Komputer', 'Buat laporan topologi jaringan', '2026-04-22', '22003', 6, NULL, NULL),
(7, 'Tugas Pemrograman C++', 'Buat program manajemen mahasiswa', '2026-04-25', '22004', 7, NULL, NULL),
(8, 'Tugas Basis Data Lanjut', 'Normalisasi database sampai 3NF', '2026-04-27', '22005', 8, NULL, NULL),
(9, 'Tugas Sistem Operasi', 'Jelaskan proses scheduling', '2026-04-28', '22006', 9, NULL, NULL),
(10, 'Tugas Cloud Computing', 'Buat laporan tentang cloud service', '2026-05-01', '22007', 10, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL,
  `nim` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `nim`) VALUES
(1, 'Dr. Rahman', '123', 'dosen', NULL),
(2, 'Prof. Sari', '123', 'dosen', NULL),
(3, 'Dr. Ahmad', '123', 'dosen', NULL),
(4, 'Dr. Lestari', '123', 'dosen', NULL),
(5, 'Prof. Leon', '123', 'dosen', NULL),
(6, 'Dr. Anita', '123', 'dosen', NULL),
(7, 'Prof. Bimo', '123', 'dosen', NULL),
(8, 'Dr. Citra', '123', 'dosen', NULL),
(9, 'Dr. Dedi', '123', 'dosen', NULL),
(10, 'Prof. Elvira', '123', 'dosen', NULL),
(22001, 'andi', '123', 'mahasiswa', '22001'),
(22002, 'budi', '123', 'mahasiswa', '22002'),
(22003, 'citra', '123', 'mahasiswa', '22003'),
(22004, 'dedi', '123', 'mahasiswa', '22004'),
(22005, 'eka', '123', 'mahasiswa', '22005'),
(22006, 'fajar', '123', 'mahasiswa', '22006'),
(22007, 'gita', '123', 'mahasiswa', '22007'),
(22008, 'hendra', '123', 'mahasiswa', '22008'),
(22009, 'indah', '123', 'mahasiswa', '22009'),
(22010, 'joko', '123', 'mahasiswa', '22010');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `matakuliah`
--
ALTER TABLE `matakuliah`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dosen_id` (`dosen_id`);

--
-- Indexes for table `pengumpulan_tugas`
--
ALTER TABLE `pengumpulan_tugas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tugas_id` (`tugas_id`);

--
-- Indexes for table `tugas`
--
ALTER TABLE `tugas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_matakuliah` (`matakuliah_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `matakuliah`
--
ALTER TABLE `matakuliah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pengumpulan_tugas`
--
ALTER TABLE `pengumpulan_tugas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tugas`
--
ALTER TABLE `tugas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22012;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `matakuliah`
--
ALTER TABLE `matakuliah`
  ADD CONSTRAINT `matakuliah_ibfk_1` FOREIGN KEY (`dosen_id`) REFERENCES `dosen` (`id`);

--
-- Constraints for table `pengumpulan_tugas`
--
ALTER TABLE `pengumpulan_tugas`
  ADD CONSTRAINT `pengumpulan_tugas_ibfk_1` FOREIGN KEY (`tugas_id`) REFERENCES `tugas` (`id`);

--
-- Constraints for table `tugas`
--
ALTER TABLE `tugas`
  ADD CONSTRAINT `fk_matakuliah` FOREIGN KEY (`matakuliah_id`) REFERENCES `matakuliah` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
