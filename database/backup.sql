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

INSERT INTO anggota VALUES("1","1921681001","1921681001@smpn1girimarto.com","$2y$10$7xhyAM1f0qKKhXFcm6JcxeO/epMxQeHrMG.o.PyLazxaNrCt9Yz/S","sinta aulia cantika putri","1000000016","rumah sinta aulia cantika putri ramdani lestari anggunita","081234567890","1921681001.jpg","anggota");


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



DROP TABLE IF EXISTS data_kelas;

CREATE TABLE `data_kelas` (
  `id_kelas` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `kelas` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `indeks_kelas` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nip` bigint DEFAULT NULL,
  PRIMARY KEY (`id_kelas`)
) ENGINE=InnoDB AUTO_INCREMENT=1000000019 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO data_kelas VALUES("1000000001","1","A","1");


DROP TABLE IF EXISTS guru;

CREATE TABLE `guru` (
  `id_guru` bigint NOT NULL AUTO_INCREMENT,
  `nip` bigint NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `nama_guru` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `no_telp` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `level` enum('guru') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_guru`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



DROP TABLE IF EXISTS kunjungan_anggota;

CREATE TABLE `kunjungan_anggota` (
  `id_kunjungan` int NOT NULL AUTO_INCREMENT,
  `nis` bigint DEFAULT NULL,
  `hari` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tanggal` date DEFAULT NULL,
  `jam` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_kunjungan`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



DROP TABLE IF EXISTS kunjungan_guru;

CREATE TABLE `kunjungan_guru` (
  `id_kunjungan` int NOT NULL AUTO_INCREMENT,
  `nip` bigint DEFAULT NULL,
  `hari` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tanggal` date DEFAULT NULL,
  `jam` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_kunjungan`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



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



DROP TABLE IF EXISTS peminjaman_guru;

CREATE TABLE `peminjaman_guru` (
  `id_peminjaman` int NOT NULL AUTO_INCREMENT,
  `nip` bigint DEFAULT NULL,
  `id_buku` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tanggal_pinjam` date DEFAULT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `jumlah` int DEFAULT NULL,
  `status` enum('kembali','pinjam') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `denda` int DEFAULT NULL,
  PRIMARY KEY (`id_peminjaman`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;



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


