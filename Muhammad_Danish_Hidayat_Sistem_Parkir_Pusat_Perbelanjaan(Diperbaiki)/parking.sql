-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 10, 2025 at 12:03 PM
-- Server version: 8.4.3
-- PHP Version: 8.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `parking`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `role` enum('admin','petugas') COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `created_at`) VALUES
(1, 'admin', '240be518fabd2724ddb6f04eeb1da5967448d7e831c08c8fa822809f74c720a9', 'admin', '2025-12-10 05:12:39'),
(2, 'petugas', '2dad904f71aa0dcf6ea1addaa084a5865ffe448e4d3f900668e1cc7e7b6153d7', 'petugas', '2025-12-10 05:12:39');

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `id` int NOT NULL,
  `plate` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `type` enum('motor','mobil') COLLATE utf8mb4_general_ci NOT NULL,
  `entry_time` datetime NOT NULL,
  `exit_time` datetime DEFAULT NULL,
  `fee` int DEFAULT NULL,
  `created_by` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`id`, `plate`, `type`, `entry_time`, `exit_time`, `fee`, `created_by`) VALUES
(13, 'adwdqdqwdqwfqwf', 'motor', '2025-12-10 19:28:23', '2025-12-10 19:33:09', 5000, 2),
(14, 'qwdqwdqwqf2g2g', 'mobil', '2025-12-10 19:28:28', '2025-12-10 19:33:08', 10000, 2),
(15, 'qewyk35fsaget', 'mobil', '2025-12-10 19:28:32', '2025-12-10 19:33:08', 10000, 2),
(16, 'rrju5kerfrwhytk', 'motor', '2025-12-10 19:28:37', '2025-12-10 19:33:07', 5000, 2),
(17, 'dg,yioadbry,t', 'mobil', '2025-12-10 19:28:42', '2025-12-10 19:33:06', 10000, 2),
(18, 'qef3rg53g35g', 'motor', '2025-12-10 19:33:18', NULL, NULL, 2),
(19, 'BCC69', 'motor', '2025-12-10 19:38:13', NULL, NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD CONSTRAINT `vehicles_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
