-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Nov 21, 2024 at 03:07 AM
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
-- Database: `data`
--

-- --------------------------------------------------------

--
-- Table structure for table `cabang`
--

CREATE TABLE `cabang` (
  `id` int(11) NOT NULL,
  `nama_cabang` varchar(100) NOT NULL,
  `nama_pic` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('aktif','nonaktif') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cabang`
--

INSERT INTO `cabang` (`id`, `nama_cabang`, `nama_pic`, `email`, `password`, `no_telp`, `created_at`, `updated_at`, `status`) VALUES
(59, 'cabang baru', 'aku', 'baru@gmail.com', '', ' 0900', '2024-11-20 16:45:09', '2024-11-20 16:45:09', 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `kontrak`
--

CREATE TABLE `kontrak` (
  `id` int(11) NOT NULL,
  `no_kontrak` varchar(50) NOT NULL,
  `jenis_petugas` varchar(255) NOT NULL,
  `nama_vendor` varchar(255) NOT NULL,
  `nama_cabang` varchar(255) NOT NULL,
  `awal_kontrak` date NOT NULL,
  `akhir_kontrak` date NOT NULL,
  `sisa_waktu` int(11) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `file_kontrak` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('aktif','nonaktif') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kontrak`
--

INSERT INTO `kontrak` (`id`, `no_kontrak`, `jenis_petugas`, `nama_vendor`, `nama_cabang`, `awal_kontrak`, `akhir_kontrak`, `sisa_waktu`, `keterangan`, `file_kontrak`, `created_at`, `updated_at`, `status`) VALUES
(57, '1000', 'Kebersihan', 'vendor baru', 'cabang baru', '2024-11-01', '2024-12-07', NULL, NULL, '1732146432_7d8d701531bfaa5be689.pdf', '2024-11-20 23:47:12', '2024-11-20 23:47:12', 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `penilaian`
--

CREATE TABLE `penilaian` (
  `id` int(11) NOT NULL,
  `no_kontrak` varchar(50) NOT NULL,
  `jenis_petugas` varchar(255) NOT NULL,
  `nama_vendor` varchar(255) NOT NULL,
  `nama_cabang` varchar(255) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `kinerja` decimal(10,0) DEFAULT NULL,
  `kinerja1` int(11) NOT NULL,
  `gambar_kinerja1` varchar(50) NOT NULL,
  `kinerja2` int(11) NOT NULL,
  `gambar_kinerja2` varchar(50) NOT NULL,
  `kinerja3` int(11) NOT NULL,
  `gambar_kinerja3` varchar(50) NOT NULL,
  `kinerja4` int(11) NOT NULL,
  `gambar_kinerja4` varchar(50) NOT NULL,
  `kinerja5` int(11) NOT NULL,
  `gambar_kinerja5` varchar(50) NOT NULL,
  `m_mitra` decimal(10,0) DEFAULT NULL,
  `mitra1` int(11) NOT NULL,
  `gambar_mitra1` varchar(50) NOT NULL,
  `mitra2` int(11) NOT NULL,
  `gambar_mitra2` varchar(50) NOT NULL,
  `mitra3` int(11) NOT NULL,
  `gambar_mitra3` varchar(50) NOT NULL,
  `personil` decimal(10,0) NOT NULL,
  `nilai_personil1` int(11) NOT NULL,
  `gambar_personil1` varchar(50) NOT NULL,
  `nilai_personil2` int(11) NOT NULL,
  `gambar_personil2` varchar(50) NOT NULL,
  `nilai_personil3` int(11) NOT NULL,
  `gambar_personil3` varchar(50) NOT NULL,
  `nilai_personil4` int(11) NOT NULL,
  `gambar_personil4` varchar(50) NOT NULL,
  `nilai_personil5` int(11) NOT NULL,
  `gambar_personil5` varchar(50) NOT NULL,
  `material` decimal(10,0) NOT NULL,
  `nilai_material` int(11) NOT NULL,
  `gambar_material` varchar(50) NOT NULL,
  `kedisiplinan` decimal(10,0) NOT NULL,
  `disiplin` int(11) NOT NULL,
  `gambar_disiplin` varchar(50) NOT NULL,
  `fatal_error` decimal(10,0) NOT NULL,
  `fatal1` int(11) NOT NULL,
  `gambar_fatal1` varchar(50) NOT NULL,
  `fatal2` int(11) NOT NULL,
  `gambar_fatal2` varchar(50) NOT NULL,
  `fatal3` int(11) NOT NULL,
  `gambar_fatal3` varchar(50) NOT NULL,
  `total` decimal(10,0) NOT NULL,
  `status` enum('aktif','nonaktif') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penilaian`
--

INSERT INTO `penilaian` (`id`, `no_kontrak`, `jenis_petugas`, `nama_vendor`, `nama_cabang`, `tanggal`, `kinerja`, `kinerja1`, `gambar_kinerja1`, `kinerja2`, `gambar_kinerja2`, `kinerja3`, `gambar_kinerja3`, `kinerja4`, `gambar_kinerja4`, `kinerja5`, `gambar_kinerja5`, `m_mitra`, `mitra1`, `gambar_mitra1`, `mitra2`, `gambar_mitra2`, `mitra3`, `gambar_mitra3`, `personil`, `nilai_personil1`, `gambar_personil1`, `nilai_personil2`, `gambar_personil2`, `nilai_personil3`, `gambar_personil3`, `nilai_personil4`, `gambar_personil4`, `nilai_personil5`, `gambar_personil5`, `material`, `nilai_material`, `gambar_material`, `kedisiplinan`, `disiplin`, `gambar_disiplin`, `fatal_error`, `fatal1`, `gambar_fatal1`, `fatal2`, `gambar_fatal2`, `fatal3`, `gambar_fatal3`, `total`, `status`) VALUES
(45, '1000', 'Kebersihan', 'vendor baru', 'cabang baru', '2024-11-20 23:47:12', NULL, 0, '', 0, '', 0, '', 0, '', 0, '', NULL, 0, '', 0, '', 0, '', 0, 0, '', 0, '', 0, '', 0, '', 0, '', 0, 0, '', 0, 0, '', 0, 0, '', 0, '', 0, '', 0, 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_level` enum('admin','pic','vendor','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `user_level`) VALUES
(4, 'admin@gmail.com', '$2y$10$7Gpu3zZwAM7UZw8llNOGeumc1YpCD2UK2GJS.qE2UnX4aRM8lCF4y', 'admin'),
(33, 'baru@gmail.com', '$2y$10$n.Ipwi.H2TSREeRiBiblKOAKRDOxWKdv.vbOfVFkzcdEQMmAYAgE2', 'pic'),
(34, 'siapa@gmail.com', '$2y$10$sL5ONPK3R/Rmwotq8.MMu.4yjoJw0XmVHYBFnc5Y1/wAQkhYCJ8HK', 'vendor');

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `id` int(11) NOT NULL,
  `nama_vendor` varchar(255) NOT NULL,
  `nama_user` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `no_telp` varchar(20) NOT NULL,
  `status` enum('aktif','nonaktif') NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`id`, `nama_vendor`, `nama_user`, `email`, `password`, `no_telp`, `status`, `role`) VALUES
(42, 'vendor baru', 'siapa', 'siapa@gmail.com', '$2y$10$2UTNsrmAiSAK.zwYNnacA./apQvDGEOkkePTPHLPeyuSDMDRdm26y', ' 09090', 'aktif', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cabang`
--
ALTER TABLE `cabang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kontrak`
--
ALTER TABLE `kontrak`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cabang`
--
ALTER TABLE `cabang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `kontrak`
--
ALTER TABLE `kontrak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `penilaian`
--
ALTER TABLE `penilaian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
