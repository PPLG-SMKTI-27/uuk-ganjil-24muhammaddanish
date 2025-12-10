# Sistem Parkir - MVC (PHP Native) - Full Project
Ringkasan:
- PHP Native, MVC, OOP
- Bootstrap 5 UI
- Login (admin & petugas)
- CRUD User (admin), CRUD Kendaraan (admin & petugas)
- Database SQL siap import: `sql/parking.sql`

Cara pakai singkat:
1. Extract ke folder webroot (contoh: Laragon `C:/laragon/www/parking_system`).
2. Import `sql/parking.sql` ke MySQL.
3. Sesuaikan pengaturan DB di `app/config/Database.php`.
4. Akses `http://localhost/parking_system/public/`.

Default accounts (dimasukkan via SQL menggunakan SHA2):
- admin / admin123
- petugas / petugas123
