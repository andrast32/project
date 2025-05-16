DROP TABLE IF EXISTS anggota;

CREATE TABLE `anggota` (
  `id_siswa` int NOT NULL AUTO_INCREMENT,
  `nis` bigint NOT NULL,
  `password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `nama_anggota` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `id_kelas` int unsigned DEFAULT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `no_telp` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '',
  `foto` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '',
  `level` enum('anggota') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_siswa`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=123410051 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO anggota VALUES("8","1921681010","$2y$10$7xhyAM1f0qKKhXFcm6JcxeO/epMxQeHrMG.o.PyLazxaNrCt9Yz/S","sinta aulia cantika putri","1000000017","rumah sinta aulia cantika putri ramdani lestari anggunita","081234567890","1921681001.jpg","anggota");
INSERT INTO anggota VALUES("123410050","1921681003","$2y$10$sIYHUC7pAnz/Y6KIvMokYuyWm6WeKgNKQwgvtSJCAOuyMKpXl0eQq","aaa","1000000017","aaa","aaa","1921681003.jpg","anggota");


DROP TABLE IF EXISTS data_buku;

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO data_buku VALUES("3","ADPU 4341","Analisis dan Perancangan Sistem","Buku Pelajaran","Analisis dan Perancangan Sistem\n\n\n\nSebuah Pengantar Buku «Analisis dan Perancangan Sistem» adalah sumber referensi penting bagi mereka yang ingin memahami proses pengembangan sistem informasi yang berkualitas.\n\nBuku ini berfokus pada dua aspek utama dalam pengembangan sistem, yaitu analisis dan perancangan, yang merupakan fondasi penting dalam setiap proyek teknologi informasi.\n\nDi era digital ini, hampir semua organisasi, baik besar maupun kecil, membutuhkan sistem informasi yang andal untuk menjalankan operasi bisnis mereka.\n\nSalah satu teknik yang paling umum digunakan adalah Data Flow Diagram yang menggambarkan aliran data dalam sistem. DFD membantu menganalisis bagaimana data bergerak melalui sistem, dari input hingga output, serta bagaimana proses internal bekerja. Selain itu, buku ini juga menjelaskan penggunaan Entity-Relationship Diagram yang digunakan untuk memodelkan hubungan antar entitas dalam database. Misalnya, cloud computing memungkinkan organisasi untuk mengakses sumber daya komputasi yang lebih besar tanpa harus mengelola infrastruktur mereka sendiri, sedangkan big data memberikan peluang untuk menganalisis data dalam jumlah besar guna mendapatkan wawasan yang lebih mendalam. Pengujian dan Implementasi Sistem Setelah sistem dirancang, tahap berikutnya adalah pengujian dan implementasi. Pengujian sistem sangat penting untuk memastikan bahwa sistem berfungsi sesuai dengan spesifikasi yang telah ditentukan.","Bahar S.T, M.Kom.","Universitas Terbuka","2024-09-11","A 02","21","3.png");
INSERT INTO data_buku VALUES("5","ADPU 4342","Teori Organisasi","Buku Pelajaran","teori organisasi","DRS. Agus Joko Purwanto, M.Si.","Universitas Terbuka","2024-09-23","A 01","20","5.png");


DROP TABLE IF EXISTS data_kelas;

CREATE TABLE `data_kelas` (
  `id_kelas` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `kelas` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `indeks_kelas` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_guru` bigint DEFAULT NULL,
  PRIMARY KEY (`id_kelas`)
) ENGINE=InnoDB AUTO_INCREMENT=1000000023 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO data_kelas VALUES("1000000017","1","A","7");
INSERT INTO data_kelas VALUES("1000000018","2","A","9");
INSERT INTO data_kelas VALUES("1000000021","3","A","14");
INSERT INTO data_kelas VALUES("1000000022","4","A","12");


DROP TABLE IF EXISTS guru;

CREATE TABLE `guru` (
  `id_guru` bigint NOT NULL AUTO_INCREMENT,
  `nip` bigint NOT NULL,
  `password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `nama_guru` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `no_telp` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `level` enum('guru') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_guru`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO guru VALUES("7","1921681002","$2y$10$0AZmbZCWg1t9ZyZ2L8WarewQF1HprqKZpn5FLwGgqtXDIjAyoHwJC","asep budiman cahya","rumah sinta aulia cantika putri ramdani lestari anggunita","081234567890","1921681001.jpg","guru");
INSERT INTO guru VALUES("9","1234567890123456713","$2y$10$DibsXZRvdgYy0NV1X/aNaeYSc0lGH8V/UFDDawcQAPqtbXMyr4tZG","Bambang Wibowo","rumah bambang","081234567890","1234567890123456782.jpg","guru");
INSERT INTO guru VALUES("12","1234567890123456789","$2y$10$jgNStQ6g.spw2IJ2NelLFO0ijoRN6I1w5TXJXkwCgsYPhz8TI3SIe","syifa sinta shakila","rumah syifa","081234567890","1234567890123456789.jpg","guru");
INSERT INTO guru VALUES("14","1234567890123456790","$2y$10$LLPHLRf4cpVphR4AxE1yHO.rkAxljtm4nGkNQJEvusyrAUrOtMaQm","eneng","rumah eneng","081234567892","1234567890123456790.jpg","guru");


DROP TABLE IF EXISTS kunjungan_anggota;

CREATE TABLE `kunjungan_anggota` (
  `id_kunjungan` int NOT NULL AUTO_INCREMENT,
  `id_siswa` bigint DEFAULT NULL,
  `hari` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tanggal` date DEFAULT NULL,
  `jam` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_kunjungan`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO kunjungan_anggota VALUES("15","8","Selasa","2025-05-13","07:16");
INSERT INTO kunjungan_anggota VALUES("16","8","Selasa","2025-05-13","08:10");


DROP TABLE IF EXISTS kunjungan_guru;

CREATE TABLE `kunjungan_guru` (
  `id_kunjungan` int NOT NULL AUTO_INCREMENT,
  `id_guru` bigint DEFAULT NULL,
  `hari` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tanggal` date DEFAULT NULL,
  `jam` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_kunjungan`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO kunjungan_guru VALUES("11","9","Selasa","2025-05-13","07:16");
INSERT INTO kunjungan_guru VALUES("12","9","Selasa","2025-05-13","07:17");


DROP TABLE IF EXISTS peminjaman_anggota;

CREATE TABLE `peminjaman_anggota` (
  `id_peminjaman` int NOT NULL AUTO_INCREMENT,
  `id_siswa` bigint DEFAULT NULL,
  `id_buku` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tanggal_pinjam` date DEFAULT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `tanggal_kembali_buku` date DEFAULT NULL,
  `jumlah` int DEFAULT NULL,
  `status` enum('kembali','pinjam') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `denda` int DEFAULT NULL,
  PRIMARY KEY (`id_peminjaman`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1000000044 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO peminjaman_anggota VALUES("1000000033","8","3","2025-05-10","2025-05-19","2025-05-10","10","kembali","");
INSERT INTO peminjaman_anggota VALUES("1000000034","8","3","2025-05-10","2025-05-19","2025-05-10","1","kembali","");
INSERT INTO peminjaman_anggota VALUES("1000000035","8","3","2025-05-11","2025-05-20","2025-05-11","10","kembali","");
INSERT INTO peminjaman_anggota VALUES("1000000036","8","5","2025-05-11","2025-05-20","2025-05-11","10","kembali","");
INSERT INTO peminjaman_anggota VALUES("1000000037","8","3","2025-05-11","2025-05-20","2025-05-11","5","kembali","");
INSERT INTO peminjaman_anggota VALUES("1000000038","8","5","2025-05-11","2025-05-20","2025-05-11","5","kembali","");
INSERT INTO peminjaman_anggota VALUES("1000000039","8","3","2025-05-11","2025-05-20","2025-05-11","1","kembali","");
INSERT INTO peminjaman_anggota VALUES("1000000040","8","3","2025-05-13","2025-05-22","2025-05-13","1","kembali","");
INSERT INTO peminjaman_anggota VALUES("1000000041","8","3","2025-05-13","2025-05-22","2025-05-13","1","kembali","");
INSERT INTO peminjaman_anggota VALUES("1000000042","8","5","2025-05-13","2025-05-22","2025-05-13","10","kembali","");
INSERT INTO peminjaman_anggota VALUES("1000000043","8","3","2025-05-14","2025-05-23","","1","pinjam","");


DROP TABLE IF EXISTS peminjaman_guru;

CREATE TABLE `peminjaman_guru` (
  `id_peminjaman` int NOT NULL AUTO_INCREMENT,
  `id_guru` bigint DEFAULT NULL,
  `id_buku` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tanggal_pinjam` date DEFAULT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `tanggal_kembali_buku` date DEFAULT NULL,
  `jumlah` int DEFAULT NULL,
  `status` enum('kembali','pinjam') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `denda` int DEFAULT NULL,
  PRIMARY KEY (`id_peminjaman`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

INSERT INTO peminjaman_guru VALUES("10","7","3","2024-10-23","2024-10-23","","1","kembali","0");
INSERT INTO peminjaman_guru VALUES("11","9","5","2025-05-10","2025-05-19","2025-05-10","1","kembali","");
INSERT INTO peminjaman_guru VALUES("12","9","3","2025-05-11","2025-05-20","2025-05-11","1","kembali","");
INSERT INTO peminjaman_guru VALUES("13","9","5","2025-05-11","2025-05-20","2025-05-11","1","kembali","");
INSERT INTO peminjaman_guru VALUES("14","7","3","2025-05-11","2025-05-20","2025-05-11","1","kembali","");
INSERT INTO peminjaman_guru VALUES("15","9","3","2025-05-11","2025-05-20","2025-05-11","1","kembali","");
INSERT INTO peminjaman_guru VALUES("16","9","5","2025-05-11","2025-05-20","2025-05-11","1","kembali","");
INSERT INTO peminjaman_guru VALUES("17","9","3","2025-05-12","2025-05-21","2025-05-13","1","kembali","");
INSERT INTO peminjaman_guru VALUES("18","7","3","2025-05-13","2025-05-22","2025-05-13","1","kembali","");


DROP TABLE IF EXISTS user;

CREATE TABLE `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `username` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `nama_user` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `level` enum('Admin') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `foto` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=1000000016 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO user VALUES("1000000001","andra@admin.com","$2y$10$GYTNkguN9MmQ1Na1xsSXIetBWj2GY6GKuPEBmQBRvlimb/W388q7y","Indra Setiawan","Admin","1000000001.jpg");
INSERT INTO user VALUES("1000000012","tabroni@admin.com","$2y$10$ngjdQ82FLm2VRZs/qVl5L.FshUMp342pg72Y7LWw1RCURqIu5/QfW","Tabroni","Admin","1000000012.jpg");
INSERT INTO user VALUES("1000000013","fajri@admin.com","$2y$10$C9NsoYqniPwIh1nQJRxQoOsM5U4al0IOl4mAX0PYFs2UdND.x2bqm","fajri","Admin","1000000013.jpg");
INSERT INTO user VALUES("1000000014","salwa@admin.com","$2y$10$vKkEr2.m0T404To56/snp.UyC21pCR.I7qniGHySwSySBwhyvsMiG","salwa","Admin","1000000014.jpg");
INSERT INTO user VALUES("1000000015","nina@admin.com","$2y$10$htkiEF3G2GKtdGPkxmzpiO9YwyxBNuePYNXpP7wLZ83Z/H..26x2C","nina","Admin","1000000015.jpg");


