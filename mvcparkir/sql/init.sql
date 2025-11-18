CREATE DATABASE IF NOT EXISTS mvc_parkir CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE mvc_parkir;

CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(100) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  role ENUM('admin','petugas') NOT NULL DEFAULT 'petugas'
);

CREATE TABLE IF NOT EXISTS parkir (
  id INT AUTO_INCREMENT PRIMARY KEY,
  plat_nomor VARCHAR(50) NOT NULL,
  jenis_kendaraan ENUM('roda2','roda4') NOT NULL,
  jam_masuk DATETIME NOT NULL,
  jam_keluar DATETIME NULL,
  biaya INT DEFAULT 0,
  status ENUM('parkir','keluar') DEFAULT 'parkir',
  petugas_id INT NULL,
  FOREIGN KEY (petugas_id) REFERENCES users(id) ON DELETE SET NULL
);
