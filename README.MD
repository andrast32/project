# 📚 Sistem Manajemen Perpustakaan Digital

Ini adalah proyek **Sistem Manajemen Perpustakaan Digital** berbasis web yang dibangun menggunakan PHP dan MySQL. Sistem ini mendukung pengelolaan data buku, anggota, guru, peminjaman, pengembalian, serta fitur backup database.

## Fitur Utama

- **Manajemen Buku**: Tambah, edit, hapus, dan cari data buku.
- **Manajemen Anggota & Guru**: Kelola data anggota (siswa) dan guru.
- **Peminjaman & Pengembalian**: Catat transaksi peminjaman dan pengembalian buku.
- **Kunjungan**: Monitoring kunjungan anggota dan guru ke perpustakaan.
- **Backup Database**: Ekspor database ke file SQL untuk backup.
- **Manajemen User/Admin**: Kelola akun admin.

## Struktur Database

Struktur database dapat ditemukan pada file [`database/cp.sql`](database/cp.sql). File ini berisi:

- Struktur tabel (anggota, data_buku, data_kelas, guru, kunjungan, peminjaman, user, dll)
- Data contoh (dummy)
- Pengaturan indeks dan AUTO_INCREMENT

## Cara Instalasi

1. **Clone atau Download Proyek**
   ```bash
   git clone https://github.com/username/nama-repo.git
   ```

2. **Import Database**
   - Buka phpMyAdmin atau MySQL client.
   - Buat database baru, misal: `cp`.
   - Import file `database/cp.sql` ke database tersebut.

3. **Konfigurasi Koneksi Database**
   - Edit file `koneksi.php` dan sesuaikan dengan konfigurasi MySQL Anda:
     ```php
     $mysqli = new mysqli("localhost", "root", "", "cp");
     ```

4. **Jalankan di Localhost**
   - Letakkan folder proyek di dalam direktori web server (misal: `c:\laragon\www\project`).
   - Akses melalui browser: `http://localhost/project`

## Catatan

- Pastikan ekstensi PHP seperti `mysqli` sudah aktif.
- Untuk fitur backup, pastikan path `mysqldump` sudah benar jika menggunakan Windows/Laragon/XAMPP.
- Jika terjadi error saat backup, cek hak akses folder dan konfigurasi database.

## Kontribusi

Kontribusi sangat terbuka! Silakan fork repo ini dan buat pull request untuk perbaikan atau penambahan fitur.

## Lisensi

Proyek ini menggunakan lisensi [MIT](LICENSE).

---

**Dibuat dengan 10 kopi**
