CREATE DATABASE IF NOT EXISTS parking CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE parking;

DROP TABLE IF EXISTS users;
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin','petugas') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- passwords hashed with SHA2 for initial import (login accepts both SHA256 and password_hash)
INSERT INTO users (username, password, role) VALUES
('admin', SHA2('admin123',256), 'admin'),
('petugas', SHA2('petugas123',256), 'petugas');

DROP TABLE IF EXISTS vehicles;
CREATE TABLE vehicles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    plate VARCHAR(20) NOT NULL,
    type ENUM('motor','mobil') NOT NULL,
    entry_time DATETIME NOT NULL,
    exit_time DATETIME DEFAULT NULL,
    fee INT DEFAULT NULL,
    created_by INT DEFAULT NULL,
    FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL
);
