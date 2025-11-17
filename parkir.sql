-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 17, 2025 at 07:35 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `parkir`
--

-- --------------------------------------------------------

--
-- Table structure for table `kendaraan`
--

CREATE TABLE `kendaraan` (
  `id_kendaraan` int NOT NULL,
  `tipe_kendaraan` varchar(16) DEFAULT NULL,
  `waktu_parkir` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `parkiran`
--

CREATE TABLE `parkiran` (
  `tipe_kendaraan` varchar(16) DEFAULT NULL,
  `roda_dua` int DEFAULT NULL,
  `roda_empat` int DEFAULT NULL,
  `posisi_parkir` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_parkir`
--

CREATE TABLE `transaksi_parkir` (
  `id_kendaraan` int NOT NULL,
  `tipe_kendaraan` varchar(16) DEFAULT NULL,
  `waktu_parkir` date DEFAULT NULL,
  `jenis_pembayaran` varchar(16) DEFAULT NULL,
  `harga` int NOT NULL,
  `total` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kendaraan`
--
ALTER TABLE `kendaraan`
  ADD PRIMARY KEY (`id_kendaraan`),
  ADD UNIQUE KEY `tipe_kendaraan` (`tipe_kendaraan`);

--
-- Indexes for table `parkiran`
--
ALTER TABLE `parkiran`
  ADD UNIQUE KEY `tipe_kendaraan` (`tipe_kendaraan`);

--
-- Indexes for table `transaksi_parkir`
--
ALTER TABLE `transaksi_parkir`
  ADD PRIMARY KEY (`id_kendaraan`),
  ADD UNIQUE KEY `tipe_kendaraan` (`tipe_kendaraan`),
  ADD UNIQUE KEY `jenis_pembayaran` (`jenis_pembayaran`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kendaraan`
--
ALTER TABLE `kendaraan`
  ADD CONSTRAINT `kendaraan_ibfk_1` FOREIGN KEY (`tipe_kendaraan`) REFERENCES `parkiran` (`tipe_kendaraan`);

--
-- Constraints for table `transaksi_parkir`
--
ALTER TABLE `transaksi_parkir`
  ADD CONSTRAINT `transaksi_parkir_ibfk_1` FOREIGN KEY (`tipe_kendaraan`) REFERENCES `kendaraan` (`tipe_kendaraan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
