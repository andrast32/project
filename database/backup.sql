DROP TABLE IF EXISTS anggota;

CREATE TABLE `anggota` (
  `id_siswa` int NOT NULL AUTO_INCREMENT,
  `nis` bigint NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `nama_anggota` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `id_kelas` int unsigned DEFAULT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `no_telp` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '',
  `foto` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '',
  `level` enum('anggota') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_siswa`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO anggota VALUES("8","1921681001","1921681001@smpn1girimarto.com","$2y$10$7xhyAM1f0qKKhXFcm6JcxeO/epMxQeHrMG.o.PyLazxaNrCt9Yz/S","sinta aulia cantika putri","1000000016","rumah sinta aulia cantika putri ramdani lestari anggunita","081234567890","1921681001.jpg","anggota");


DROP TABLE IF EXISTS data_buku;

CREATE TABLE `data_buku` (
  `id_buku` bigint NOT NULL AUTO_INCREMENT,
  `kode_buku` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `judul` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `penulis` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `penerbit` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `tahun_terbit` date DEFAULT NULL,
  `kode_rak` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `stok` int DEFAULT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_buku`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO data_buku VALUES("3","ADPU 4341","Analisis dan Perancangan Sistem","Analisis dan Perancangan Sistem\n\nSebuah Pengantar Buku «Analisis dan Perancangan Sistem» adalah sumber referensi penting bagi mereka yang ingin memahami proses pengembangan sistem informasi yang berkualitas.\nBuku ini berfokus pada dua aspek utama dalam pengembangan sistem, yaitu analisis dan perancangan, yang merupakan fondasi penting dalam setiap proyek teknologi informasi.\nDi era digital ini, hampir semua organisasi, baik besar maupun kecil, membutuhkan sistem informasi yang andal untuk menjalankan operasi bisnis mereka.\nSalah satu teknik yang paling umum digunakan adalah Data Flow Diagram yang menggambarkan aliran data dalam sistem. DFD membantu menganalisis bagaimana data bergerak melalui sistem, dari input hingga output, serta bagaimana proses internal bekerja. Selain itu, buku ini juga menjelaskan penggunaan Entity-Relationship Diagram yang digunakan untuk memodelkan hubungan antar entitas dalam database. Misalnya, cloud computing memungkinkan organisasi untuk mengakses sumber daya komputasi yang lebih besar tanpa harus mengelola infrastruktur mereka sendiri, sedangkan big data memberikan peluang untuk menganalisis data dalam jumlah besar guna mendapatkan wawasan yang lebih mendalam. Pengujian dan Implementasi Sistem Setelah sistem dirancang, tahap berikutnya adalah pengujian dan implementasi. Pengujian sistem sangat penting untuk memastikan bahwa sistem berfungsi sesuai dengan spesifikasi yang telah ditentukan.","Bahar S.T, M.Kom.","Universitas Terbuka","2024-09-11","A 01","22","3.jpg");
INSERT INTO data_buku VALUES("5","ADPU 4342","Teori Organisasi","teori organisasi","DRS. Agus Joko Purwanto, M.Si.","Universitas Terbuka","2024-09-23","A 01","20","5.jpg");


DROP TABLE IF EXISTS data_kelas;

CREATE TABLE `data_kelas` (
  `id_kelas` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `kelas` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `indeks_kelas` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nig` bigint DEFAULT NULL,
  PRIMARY KEY (`id_kelas`)
) ENGINE=InnoDB AUTO_INCREMENT=1000000019 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO data_kelas VALUES("1000000016","7","A","1921681001");
INSERT INTO data_kelas VALUES("1000000017","8","B","1234567890123456782");
INSERT INTO data_kelas VALUES("1000000018","9","C","1234567890123456789");


DROP TABLE IF EXISTS guru;

CREATE TABLE `guru` (
  `id_guru` bigint NOT NULL AUTO_INCREMENT,
  `nig` bigint NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `nama_guru` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `no_telp` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `level` enum('guru') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_guru`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO guru VALUES("7","1921681001","asep@guru.com","$2y$10$dREdepT1LoU9JZEHqVHo5uSYrx.UOD1v84FsMiK4w9pEBsiGzmYGq","asep budiman cahyadi","rumah asep","081234567890","1921681001.jpg","guru");
INSERT INTO guru VALUES("9","1234567890123456782","bambang@guru.com","$2y$10$DibsXZRvdgYy0NV1X/aNaeYSc0lGH8V/UFDDawcQAPqtbXMyr4tZG","Bambang Wibowo","rumah bambang","081234567890","1234567890123456782.jpg","guru");
INSERT INTO guru VALUES("12","1234567890123456789","syifa@guru.com","$2y$10$jgNStQ6g.spw2IJ2NelLFO0ijoRN6I1w5TXJXkwCgsYPhz8TI3SIe","syifa sinta shakila","rumah syifa","081234567890","1234567890123456789.jpg","guru");


DROP TABLE IF EXISTS kunjungan_anggota;

CREATE TABLE `kunjungan_anggota` (
  `id_kunjungan` int NOT NULL AUTO_INCREMENT,
  `nis` bigint DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `hari` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jam` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_kunjungan`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO kunjungan_anggota VALUES("16","1921681001","2025-05-06","Selasa","05:01");


DROP TABLE IF EXISTS kunjungan_guru;

CREATE TABLE `kunjungan_guru` (
  `id_kunjungan` int NOT NULL AUTO_INCREMENT,
  `nig` bigint DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  PRIMARY KEY (`id_kunjungan`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO kunjungan_guru VALUES("4","1921681001","2024-10-07");


DROP TABLE IF EXISTS peminjaman_anggota;

CREATE TABLE `peminjaman_anggota` (
  `id_peminjaman` int NOT NULL AUTO_INCREMENT,
  `nis` bigint DEFAULT NULL,
  `id_buku` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tanggal_pinjam` date DEFAULT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `jumlah` int DEFAULT NULL,
  `status` enum('kembali','pinjam') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `denda` int DEFAULT NULL,
  PRIMARY KEY (`id_peminjaman`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1000000029 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO peminjaman_anggota VALUES("1000000021","1921681001","3","2024-10-23","2024-10-23","1","kembali","0");
INSERT INTO peminjaman_anggota VALUES("1000000025","1921681001","3","2024-10-29","2024-10-29","1","kembali","0");
INSERT INTO peminjaman_anggota VALUES("1000000026","1921681001","3","2024-10-26","2024-10-29","1","kembali","2000");
INSERT INTO peminjaman_anggota VALUES("1000000027","1921681001","5","2024-10-29","2024-11-01","1","kembali","2000");
INSERT INTO peminjaman_anggota VALUES("1000000028","1921681001","3","2024-10-29","2024-11-01","1","kembali","2000");


DROP TABLE IF EXISTS peminjaman_guru;

CREATE TABLE `peminjaman_guru` (
  `id_peminjaman` int NOT NULL AUTO_INCREMENT,
  `nig` bigint DEFAULT NULL,
  `id_buku` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tanggal_pinjam` date DEFAULT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `jumlah` int DEFAULT NULL,
  `status` enum('kembali','pinjam') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `denda` int DEFAULT NULL,
  PRIMARY KEY (`id_peminjaman`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

INSERT INTO peminjaman_guru VALUES("10","1921681001","3","2024-10-23","2024-10-23","1","kembali","0");


DROP TABLE IF EXISTS user;

CREATE TABLE `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `username` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `nama_user` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `level` enum('Admin') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `foto` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=1000000008 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO user VALUES("1000000001","andra@admin.com","$2y$10$lyN42DtadXIc8STLppYuD.d6j3Ulu4wJx/pz1ZgDG6H0XOZgXsGwe","Indra Setiawan","Admin","1000000001.jpg");


