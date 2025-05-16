-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 16 Bulan Mei 2025 pada 08.55
-- Versi server: 8.0.30
-- Versi PHP: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cp`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggota`
--

CREATE TABLE `anggota` (
  `id_siswa` int NOT NULL,
  `nis` bigint NOT NULL,
  `password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `nama_anggota` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `id_kelas` int UNSIGNED DEFAULT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `no_telp` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '',
  `foto` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '',
  `level` enum('anggota') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `anggota`
--

INSERT INTO `anggota` (`id_siswa`, `nis`, `password`, `nama_anggota`, `id_kelas`, `alamat`, `no_telp`, `foto`, `level`) VALUES
(8, 1921681010, '$2y$10$T5Ht0Gx6d3vpDxkCUaFDMeU3a867t2tU2ggR20vNK7nKWNwbgW2lq', 'sinta aulia cantika putri', 1000000017, 'rumah sinta aulia cantika putri ramdani lestari anggunita', '081234567890', '1921681001.jpg', 'anggota'),
(123410050, 1921681003, '$2y$10$sIYHUC7pAnz/Y6KIvMokYuyWm6WeKgNKQwgvtSJCAOuyMKpXl0eQq', 'aaa', 1000000017, 'aaa', 'aaa', '1921681003.jpg', 'anggota');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_buku`
--

CREATE TABLE `data_buku` (
  `id_buku` bigint NOT NULL AUTO_INCREMENT,
  `kode_buku` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `judul` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `kategori` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `penulis` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `penerbit` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `tahun_terbit` date DEFAULT NULL,
  `kode_rak` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `stok` int DEFAULT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_buku`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `data_buku`
--

INSERT INTO `data_buku` (`id_buku`, `kode_buku`, `judul`, `kategori`, `deskripsi`, `penulis`, `penerbit`, `tahun_terbit`, `kode_rak`, `stok`, `foto`) VALUES
(3, 'ADPU 4341', 'Analisis dan Perancangan Sistem', 'Buku Pelajaran', 'Analisis dan Perancangan Sistem\r\n\r\n\r\n\r\nSebuah Pengantar Buku Analisis dan Perancangan Sistem» adalah sumber referensi penting bagi mereka yang ingin memahami proses pengembangan sistem informasi yang berkualitas.\r\n\r\nBuku ini berfokus pada dua aspek utama dalam pengembangan sistem, yaitu analisis dan perancangan, yang merupakan fondasi penting dalam setiap proyek teknologi informasi.\r\n\r\nDi era digital ini, hampir semua organisasi, baik besar maupun kecil, membutuhkan sistem informasi yang andal untuk menjalankan operasi bisnis mereka.\r\n\r\nSalah satu teknik yang paling umum digunakan adalah Data Flow Diagram yang menggambarkan aliran data dalam sistem. DFD membantu menganalisis bagaimana data bergerak melalui sistem, dari input hingga output, serta bagaimana proses internal bekerja. Selain itu, buku ini juga menjelaskan penggunaan Entity-Relationship Diagram yang digunakan untuk memodelkan hubungan antar entitas dalam database. Misalnya, cloud computing memungkinkan organisasi untuk mengakses sumber daya komputasi yang lebih besar tanpa harus mengelola infrastruktur mereka sendiri, sedangkan big data memberikan peluang untuk menganalisis data dalam jumlah besar guna mendapatkan wawasan yang lebih mendalam. Pengujian dan Implementasi Sistem Setelah sistem dirancang, tahap berikutnya adalah pengujian dan implementasi. Pengujian sistem sangat penting untuk memastikan bahwa sistem berfungsi sesuai dengan spesifikasi yang telah ditentukan.', 'Bahar S.T, M.Kom.', 'Universitas Terbuka', '2024-09-11', 'A 02', 19, '3.png'),
(5, 'ADPU 4342', 'Teori Organisasi', 'Buku Pelajaran', 'teori organisasi', 'DRS. Agus Joko Purwanto, M.Si.', 'Universitas Terbuka', '2024-09-23', 'A 01', 20, '5.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_kelas`
--

CREATE TABLE `data_kelas` (
  `id_kelas` int(10) UNSIGNED ZEROFILL NOT NULL,
  `kelas` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `indeks_kelas` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_guru` bigint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `data_kelas`
--

INSERT INTO `data_kelas` (`id_kelas`, `kelas`, `indeks_kelas`, `id_guru`) VALUES
(1000000017, '1', 'A', 7),
(1000000018, '2', 'A', 9),
(1000000021, '3', 'A', 14),
(1000000022, '4', 'A', 12);

-- --------------------------------------------------------

--
-- Struktur dari tabel `guru`
--

CREATE TABLE `guru` (
  `id_guru` bigint NOT NULL,
  `nip` bigint NOT NULL,
  `password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `nama_guru` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `no_telp` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `level` enum('guru') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `guru`
--

INSERT INTO `guru` (`id_guru`, `nip`, `password`, `nama_guru`, `alamat`, `no_telp`, `foto`, `level`) VALUES
(7, 1921681002, '$2y$10$nm4AbuITe8xvw5DM32DMU.1cirIH0cYBUmO026fiwpPpqmIjSk/pq', 'asep budiman cahya', 'rumah sinta aulia cantika putri ramdani lestari anggunita', '081234567890', '1921681001.jpg', 'guru'),
(9, 1234567890123456713, '$2y$10$DibsXZRvdgYy0NV1X/aNaeYSc0lGH8V/UFDDawcQAPqtbXMyr4tZG', 'Bambang Wibowo', 'rumah bambang', '081234567890', '1234567890123456782.jpg', 'guru'),
(12, 1234567890123456789, '$2y$10$jgNStQ6g.spw2IJ2NelLFO0ijoRN6I1w5TXJXkwCgsYPhz8TI3SIe', 'syifa sinta shakila', 'rumah syifa', '081234567890', '1234567890123456789.jpg', 'guru'),
(14, 1234567890123456790, '$2y$10$LLPHLRf4cpVphR4AxE1yHO.rkAxljtm4nGkNQJEvusyrAUrOtMaQm', 'eneng', 'rumah eneng', '081234567892', '1234567890123456790.jpg', 'guru');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kunjungan_anggota`
--

CREATE TABLE `kunjungan_anggota` (
  `id_kunjungan` int NOT NULL,
  `id_siswa` bigint DEFAULT NULL,
  `hari` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tanggal` date DEFAULT NULL,
  `jam` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kunjungan_anggota`
--

INSERT INTO `kunjungan_anggota` (`id_kunjungan`, `id_siswa`, `hari`, `tanggal`, `jam`) VALUES
(15, 8, 'Selasa', '2025-05-13', '07:16'),
(16, 8, 'Selasa', '2025-05-13', '08:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kunjungan_guru`
--

CREATE TABLE `kunjungan_guru` (
  `id_kunjungan` int NOT NULL,
  `id_guru` bigint DEFAULT NULL,
  `hari` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tanggal` date DEFAULT NULL,
  `jam` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kunjungan_guru`
--

INSERT INTO `kunjungan_guru` (`id_kunjungan`, `id_guru`, `hari`, `tanggal`, `jam`) VALUES
(11, 9, 'Selasa', '2025-05-13', '07:16'),
(12, 9, 'Selasa', '2025-05-13', '07:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman_anggota`
--

CREATE TABLE `peminjaman_anggota` (
  `id_peminjaman` int NOT NULL,
  `id_siswa` bigint DEFAULT NULL,
  `id_buku` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tanggal_pinjam` date DEFAULT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `tanggal_kembali_buku` date DEFAULT NULL,
  `jumlah` int DEFAULT NULL,
  `status` enum('kembali','pinjam') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `denda` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `peminjaman_anggota`
--

INSERT INTO `peminjaman_anggota` (`id_peminjaman`, `id_siswa`, `id_buku`, `tanggal_pinjam`, `tanggal_kembali`, `tanggal_kembali_buku`, `jumlah`, `status`, `denda`) VALUES
(1000000033, 8, '3', '2025-05-10', '2025-05-19', '2025-05-10', 10, 'kembali', NULL),
(1000000034, 8, '3', '2025-05-10', '2025-05-19', '2025-05-10', 1, 'kembali', NULL),
(1000000035, 8, '3', '2025-05-11', '2025-05-20', '2025-05-11', 10, 'kembali', NULL),
(1000000036, 8, '5', '2025-05-11', '2025-05-20', '2025-05-11', 10, 'kembali', NULL),
(1000000037, 8, '3', '2025-05-11', '2025-05-20', '2025-05-11', 5, 'kembali', NULL),
(1000000038, 8, '5', '2025-05-11', '2025-05-20', '2025-05-11', 5, 'kembali', NULL),
(1000000039, 8, '3', '2025-05-11', '2025-05-20', '2025-05-11', 1, 'kembali', NULL),
(1000000040, 8, '3', '2025-05-13', '2025-05-22', '2025-05-13', 1, 'kembali', NULL),
(1000000041, 8, '3', '2025-05-13', '2025-05-22', '2025-05-13', 1, 'kembali', NULL),
(1000000042, 8, '5', '2025-05-13', '2025-05-22', '2025-05-13', 10, 'kembali', NULL),
(1000000043, 8, '3', '2025-05-14', '2025-05-23', '2025-05-15', 1, 'kembali', NULL),
(1000000044, 8, '3', '2025-05-15', '2025-05-24', '2025-05-16', 5, 'kembali', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman_guru`
--

CREATE TABLE `peminjaman_guru` (
  `id_peminjaman` int NOT NULL,
  `id_guru` bigint DEFAULT NULL,
  `id_buku` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tanggal_pinjam` date DEFAULT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `tanggal_kembali_buku` date DEFAULT NULL,
  `jumlah` int DEFAULT NULL,
  `status` enum('kembali','pinjam') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `denda` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `peminjaman_guru`
--

INSERT INTO `peminjaman_guru` (`id_peminjaman`, `id_guru`, `id_buku`, `tanggal_pinjam`, `tanggal_kembali`, `tanggal_kembali_buku`, `jumlah`, `status`, `denda`) VALUES
(10, 7, '3', '2024-10-23', '2024-10-23', NULL, 1, 'kembali', 0),
(11, 9, '5', '2025-05-10', '2025-05-19', '2025-05-10', 1, 'kembali', NULL),
(12, 9, '3', '2025-05-11', '2025-05-20', '2025-05-11', 1, 'kembali', NULL),
(13, 9, '5', '2025-05-11', '2025-05-20', '2025-05-11', 1, 'kembali', NULL),
(14, 7, '3', '2025-05-11', '2025-05-20', '2025-05-11', 1, 'kembali', NULL),
(15, 9, '3', '2025-05-11', '2025-05-20', '2025-05-11', 1, 'kembali', NULL),
(16, 9, '5', '2025-05-11', '2025-05-20', '2025-05-11', 1, 'kembali', NULL),
(17, 9, '3', '2025-05-12', '2025-05-21', '2025-05-13', 1, 'kembali', NULL),
(18, 7, '3', '2025-05-13', '2025-05-22', '2025-05-13', 1, 'kembali', NULL),
(19, 7, '3', '2025-05-16', '2025-05-25', NULL, 3, 'pinjam', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int NOT NULL,
  `username` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `nama_user` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `level` enum('Admin') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `foto` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama_user`, `level`, `foto`) VALUES
(1000000001, 'andra@admin.com', '$2y$10$GYTNkguN9MmQ1Na1xsSXIetBWj2GY6GKuPEBmQBRvlimb/W388q7y', 'Indra Setiawan', 'Admin', '1000000001.jpg'),
(1000000012, 'tabroni@admin.com', '$2y$10$ngjdQ82FLm2VRZs/qVl5L.FshUMp342pg72Y7LWw1RCURqIu5/QfW', 'Tabroni', 'Admin', '1000000012.jpg'),
(1000000013, 'fajri@admin.com', '$2y$10$C9NsoYqniPwIh1nQJRxQoOsM5U4al0IOl4mAX0PYFs2UdND.x2bqm', 'fajri', 'Admin', '1000000013.jpg'),
(1000000014, 'salwa@admin.com', '$2y$10$vKkEr2.m0T404To56/snp.UyC21pCR.I7qniGHySwSySBwhyvsMiG', 'salwa', 'Admin', '1000000014.jpg'),
(1000000015, 'nina@admin.com', '$2y$10$htkiEF3G2GKtdGPkxmzpiO9YwyxBNuePYNXpP7wLZ83Z/H..26x2C', 'nina', 'Admin', '1000000015.jpg');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id_siswa`) USING BTREE;

--
-- Indeks untuk tabel `data_buku`
--
ALTER TABLE `data_buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indeks untuk tabel `data_kelas`
--
ALTER TABLE `data_kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indeks untuk tabel `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id_guru`) USING BTREE;

--
-- Indeks untuk tabel `kunjungan_anggota`
--
ALTER TABLE `kunjungan_anggota`
  ADD PRIMARY KEY (`id_kunjungan`) USING BTREE;

--
-- Indeks untuk tabel `kunjungan_guru`
--
ALTER TABLE `kunjungan_guru`
  ADD PRIMARY KEY (`id_kunjungan`) USING BTREE;

--
-- Indeks untuk tabel `peminjaman_anggota`
--
ALTER TABLE `peminjaman_anggota`
  ADD PRIMARY KEY (`id_peminjaman`) USING BTREE;

--
-- Indeks untuk tabel `peminjaman_guru`
--
ALTER TABLE `peminjaman_guru`
  ADD PRIMARY KEY (`id_peminjaman`) USING BTREE;

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id_siswa` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123410051;

--
-- AUTO_INCREMENT untuk tabel `data_buku`
--
ALTER TABLE `data_buku`
  MODIFY `id_buku` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `data_kelas`
--
ALTER TABLE `data_kelas`
  MODIFY `id_kelas` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000000023;

--
-- AUTO_INCREMENT untuk tabel `guru`
--
ALTER TABLE `guru`
  MODIFY `id_guru` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `kunjungan_anggota`
--
ALTER TABLE `kunjungan_anggota`
  MODIFY `id_kunjungan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `kunjungan_guru`
--
ALTER TABLE `kunjungan_guru`
  MODIFY `id_kunjungan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `peminjaman_anggota`
--
ALTER TABLE `peminjaman_anggota`
  MODIFY `id_peminjaman` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000000045;

--
-- AUTO_INCREMENT untuk tabel `peminjaman_guru`
--
ALTER TABLE `peminjaman_guru`
  MODIFY `id_peminjaman` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000000016;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
