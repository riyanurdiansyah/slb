-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2021 at 07:10 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_slb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_baca_gambar`
--

CREATE TABLE `tb_baca_gambar` (
  `id` int(11) NOT NULL,
  `foto` varchar(128) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `kategori_id` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_baca_huruf`
--

CREATE TABLE `tb_baca_huruf` (
  `id` int(11) NOT NULL,
  `materi` varchar(512) NOT NULL,
  `penjelasan` varchar(512) NOT NULL,
  `metode_id` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_baca_huruf`
--

INSERT INTO `tb_baca_huruf` (`id`, `materi`, `penjelasan`, `metode_id`) VALUES
(1, 'bisindo.jpg', 'BISINDO (Bahasa Isyarat Indonesia)\r\n\r\nBahasa isyarat ini lah yang sering ditemukan di kalangan Teman Tuli maupun Teman Inklusi pengguna bahasa isyarat. BISINDO dibentuk oleh kelompok Tuli dan muncul secara alami berdasarkan pengamatan Teman Tuli. Maka dari', '1'),
(3, 'sibi.jpg', 'SIBI (Sistem Isyarat Bahasa Indonesia)\r\n\r\nSistem isyarat ini dibentuk oleh mantan kepala SLB yang merupakan orang dengar. SIBI diadopsi dari Bahasa Isyarat Amerika. SIBI telah diresmikan pemerintah, namun lebih sering digunakan pada pembelajaran di SLB. SIBI dianggap lebih sulit karena mengandung kosakata yang baku dan rumit, serta memiliki awalan dan akhiran.  Berbeda dengan BISINDO, SIBI disampaikan dengan satu tangan. (RYR/SKS)', '2'),
(4, 'sibi2.jpg', 'A', '2'),
(5, 'sibi3.jpg', 'B', '2'),
(6, 'sibi4.jpg', 'C', '2');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori_gambar`
--

CREATE TABLE `tb_kategori_gambar` (
  `id` int(11) NOT NULL,
  `foto` varchar(128) NOT NULL,
  `nama` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_kategori_gambar`
--

INSERT INTO `tb_kategori_gambar` (`id`, `foto`, `nama`) VALUES
(1, 'Binatang.jpg', 'Binatang'),
(2, 'Keluarga.jpg', 'Keluarga'),
(3, 'Transportasi.jpg', 'Transportasi'),
(4, 'Olahraga.jpg', 'Olahraga');

-- --------------------------------------------------------

--
-- Table structure for table `tb_tebak_huruf`
--

CREATE TABLE `tb_tebak_huruf` (
  `id` int(11) NOT NULL,
  `soal` varchar(128) NOT NULL,
  `jawaban` varchar(128) NOT NULL,
  `metode_id` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_tebak_huruf`
--

INSERT INTO `tb_tebak_huruf` (`id`, `soal`, `jawaban`, `metode_id`) VALUES
(4, 's.jpg', 's', 1),
(5, 'j.jpg', 'j', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_tebak_kata`
--

CREATE TABLE `tb_tebak_kata` (
  `id` int(11) NOT NULL,
  `soal` varchar(128) NOT NULL,
  `jawaban` varchar(128) NOT NULL,
  `metode_id` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_tebak_kata`
--

INSERT INTO `tb_tebak_kata` (`id`, `soal`, `jawaban`, `metode_id`) VALUES
(5, 'jam.jpg', 'jam', 2),
(7, 'sendok.jpg', 'sendok', 2),
(8, 'botol.jpg', 'botol', 2),
(9, 'pensil.jpg', 'pensil', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_users`
--

CREATE TABLE `tb_users` (
  `id` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `nama` varchar(256) NOT NULL,
  `password` varchar(512) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `jenis_kelamin` varchar(16) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` varchar(256) NOT NULL,
  `kelas` varchar(16) NOT NULL,
  `foto` varchar(128) NOT NULL,
  `role_id` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_users`
--

INSERT INTO `tb_users` (`id`, `username`, `nama`, `password`, `no_hp`, `jenis_kelamin`, `tgl_lahir`, `alamat`, `kelas`, `foto`, `role_id`) VALUES
(3, 'admin', 'admin', '$2y$10$Nt2ihAhaddlQ5jT3W/VAYewSl/3wzUG.j10G/yVPhXvSw7gBNjcVy', '', 'Laki-laki', '0000-00-00', '', '', 'cowo.jpg', 1),
(4, '14045', 'Dyas', '$2y$10$eu5.DvsyVmTGyrtwspFGNuwuFR8O1PsdWGYbkFkYzAuzkM7RDMK.e', '', 'Perempuan', '0000-00-00', '-', '', 'cewe.jpg', 2),
(5, '14046', 'Joko', '$2y$10$.VfM7MbmxwnIE.ynKmSZXeHx0NC9bAZUgsi/4e4JOaapFN4J3ALmC', '', 'Laki-laki', '0000-00-00', '-', '', 'cowo.jpg', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_baca_gambar`
--
ALTER TABLE `tb_baca_gambar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_baca_huruf`
--
ALTER TABLE `tb_baca_huruf`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_kategori_gambar`
--
ALTER TABLE `tb_kategori_gambar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_tebak_huruf`
--
ALTER TABLE `tb_tebak_huruf`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_tebak_kata`
--
ALTER TABLE `tb_tebak_kata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_baca_gambar`
--
ALTER TABLE `tb_baca_gambar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_baca_huruf`
--
ALTER TABLE `tb_baca_huruf`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_kategori_gambar`
--
ALTER TABLE `tb_kategori_gambar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_tebak_huruf`
--
ALTER TABLE `tb_tebak_huruf`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_tebak_kata`
--
ALTER TABLE `tb_tebak_kata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
