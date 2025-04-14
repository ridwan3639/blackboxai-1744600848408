# Photobox Application

## Overview
Aplikasi photobox berbasis web menggunakan PHP dan MySQL dengan fitur:
- Pembayaran via QRIS atau Voucher
- Pemilihan background, frame, dan layout
- Pengambilan foto dengan 6x shot
- Filter pencahayaan
- Custom layout foto
- Tambahan stiker
- Cetak otomatis
- Berbagi via Email & WhatsApp
- Dashboard admin

## Struktur Proyek
- `public/` - File yang dapat diakses publik
- `app/` - Logika aplikasi (controllers, models, views)
- `config/` - Konfigurasi database
- `logs/` - File log

## Instalasi
1. Buat database `photobox_db` di MySQL
2. Import file SQL dari folder `sql/`
3. Sesuaikan konfigurasi database di `config/database.php`
4. Akses aplikasi melalui `public/index.php`

## Teknologi
- PHP 7.4+
- MySQL 5.7+
- HTML5, CSS3, JavaScript
- Webcam API untuk pengambilan foto
