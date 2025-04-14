-- Database Schema for Photobox Application
-- Bahasa: Indonesia

-- 1. Tabel Pengguna
CREATE TABLE IF NOT EXISTS pengguna (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100),
    no_wa VARCHAR(20),
    role ENUM('admin', 'user') DEFAULT 'user',
    dibuat_pada TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 2. Tabel Voucher
CREATE TABLE IF NOT EXISTS voucher (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kode VARCHAR(20) UNIQUE NOT NULL,
    nilai DECIMAL(10,2) NOT NULL,
    berlaku_hingga DATE,
    digunakan BOOLEAN DEFAULT FALSE,
    dibuat_pada TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 3. Tabel Transaksi
CREATE TABLE IF NOT EXISTS transaksi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_pengguna INT,
    metode_pembayaran ENUM('qris', 'voucher') NOT NULL,
    id_voucher INT,
    status ENUM('pending', 'sukses', 'gagal') DEFAULT 'pending',
    total DECIMAL(10,2) NOT NULL,
    dibuat_pada TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_pengguna) REFERENCES pengguna(id),
    FOREIGN KEY (id_voucher) REFERENCES voucher(id)
);

-- 4. Tabel Background
CREATE TABLE IF NOT EXISTS background (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    file_path VARCHAR(255) NOT NULL,
    aktif BOOLEAN DEFAULT TRUE,
    dibuat_pada TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 5. Tabel Frame
CREATE TABLE IF NOT EXISTS frame (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    file_path VARCHAR(255) NOT NULL,
    aktif BOOLEAN DEFAULT TRUE,
    dibuat_pada TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 6. Tabel Layout
CREATE TABLE IF NOT EXISTS layout (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    file_path VARCHAR(255) NOT NULL,
    aktif BOOLEAN DEFAULT TRUE,
    dibuat_pada TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 7. Tabel Stiker
CREATE TABLE IF NOT EXISTS stiker (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    file_path VARCHAR(255) NOT NULL,
    kategori VARCHAR(50),
    aktif BOOLEAN DEFAULT TRUE,
    dibuat_pada TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 8. Tabel Foto
CREATE TABLE IF NOT EXISTS foto (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_transaksi INT NOT NULL,
    file_path VARCHAR(255) NOT NULL,
    filter VARCHAR(50),
    dibuat_pada TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_transaksi) REFERENCES transaksi(id)
);

-- 9. Tabel Pengaturan
CREATE TABLE IF NOT EXISTS pengaturan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_aplikasi VARCHAR(100) DEFAULT 'Photobox',
    no_wa_admin VARCHAR(20),
    harga_default DECIMAL(10,2) DEFAULT 0,
    durasi_pemilihan INT DEFAULT 120, -- dalam detik
    durasi_pengambilan_foto INT DEFAULT 600, -- dalam detik
    diupdate_pada TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Data awal
INSERT INTO pengaturan (nama_aplikasi, no_wa_admin, harga_default) 
VALUES ('Photobox', '6281234567890', 25000);

INSERT INTO background (nama, file_path) VALUES
('Background 1', 'images/backgrounds/bg1.jpg'),
('Background 2', 'images/backgrounds/bg2.jpg');

INSERT INTO frame (nama, file_path) VALUES
('Frame Classic', 'images/frames/frame1.png'),
('Frame Modern', 'images/frames/frame2.png');

INSERT INTO layout (nama, file_path) VALUES
('Layout 4R 1 Foto', 'images/layouts/layout1.png'),
('Layout 4R 2 Foto', 'images/layouts/layout2.png');
