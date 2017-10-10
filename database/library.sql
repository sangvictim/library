-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 15, 2017 at 04:56 PM
-- Server version: 5.7.18-0ubuntu0.16.04.1
-- PHP Version: 5.6.30-11+deb.sury.org~xenial+3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_anggota`
--

CREATE TABLE `t_anggota` (
  `id` int(10) NOT NULL,
  `nim` int(10) NOT NULL,
  `nama` char(50) NOT NULL,
  `th_angkatan` int(4) NOT NULL,
  `jk` char(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_anggota`
--

INSERT INTO `t_anggota` (`id`, `nim`, `nama`, `th_angkatan`, `jk`, `created_at`, `updated_at`) VALUES
(5, 201705, 'siswa 5', 2013, 'L', '2017-04-23 02:58:13', '2017-04-23 09:58:13'),
(6, 201706, 'siswa 6', 2013, 'L', '2017-04-23 02:58:42', '2017-04-23 09:58:42'),
(7, 201707, 'siswa 7', 2013, 'L', '2017-04-23 02:58:13', '2017-04-23 09:58:13'),
(8, 201708, 'siswa 8', 2013, 'L', '2017-04-23 02:58:42', '2017-04-23 09:58:42');

-- --------------------------------------------------------

--
-- Table structure for table `t_buku`
--

CREATE TABLE `t_buku` (
  `id` varchar(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `penerbit` char(20) NOT NULL,
  `th_terbit` year(4) NOT NULL,
  `stok` int(10) NOT NULL,
  `rak` int(5) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_buku`
--

INSERT INTO `t_buku` (`id`, `nama`, `penerbit`, `th_terbit`, `stok`, `rak`, `gambar`, `deskripsi`, `created_at`, `updated_at`) VALUES
('BK001', 'Buku Satu', 'erlangga', 2016, 10, 8, '25.jpg', 'deskripsi buku satu', '2017-05-23 15:56:59', '2017-04-23 10:04:40'),
('BK002', 'Buku Dua', 'erlangga', 2016, 10, 9, '26.jpg', 'deskripsi buku dua satu', '2017-05-23 15:57:05', '2017-04-23 04:29:46'),
('BK003', 'Buku Tiga', 'Nescafe', 2017, 10, 10, 'AlbumArtSmall.jpg', 'deskripsi buku tiga', '2017-04-23 03:07:20', '2017-04-23 10:07:20'),
('BK004', 'Buku Empat', 'Nescafe', 2017, 10, 11, 'mobil_tua.jpg', 'deskripsi buku empat', '2017-04-23 03:08:07', '2017-04-23 10:08:07');

--
-- Triggers `t_buku`
--
DELIMITER $$
CREATE TRIGGER `stok_buku` AFTER INSERT ON `t_buku` FOR EACH ROW BEGIN
	INSERT INTO t_stok (kode_buku, stok) VALUES (NEW.id, NEW.stok);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_stok` AFTER UPDATE ON `t_buku` FOR EACH ROW BEGIN
	UPDATE t_stok SET
    	t_stok.stok=NEW.stok
        WHERE t_stok.kode_buku=NEW.id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `t_daftar_hadir`
--

CREATE TABLE `t_daftar_hadir` (
  `id` int(255) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_daftar_hadir`
--

INSERT INTO `t_daftar_hadir` (`id`, `nama`, `created_at`) VALUES
(1, 't', '2017-04-25'),
(2, 'tio', '2017-04-25'),
(3, 'saya', '2017-04-25'),
(4, 'gg', '2017-04-25'),
(5, 'ty', '2017-04-25'),
(6, 'q', '2017-04-25'),
(7, 'sari', '2017-04-25'),
(8, 'saya lagi', '2017-04-25'),
(9, 'dfe', '2017-04-25'),
(10, 'victim', '2017-04-26'),
(11, 'coba', '2017-04-26'),
(12, 'coba', '2017-04-26'),
(13, 'coba', '2017-04-27'),
(14, 'tio', '2017-05-04'),
(15, 'kamu', '2017-05-04'),
(16, 'tio', '2017-05-04'),
(17, 'saya', '2017-05-04'),
(18, 'saya', '2017-05-26');

-- --------------------------------------------------------

--
-- Table structure for table `t_denda`
--

CREATE TABLE `t_denda` (
  `id` int(1) NOT NULL,
  `denda` int(5) NOT NULL,
  `hari` tinyint(2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_denda`
--

INSERT INTO `t_denda` (`id`, `denda`, `hari`, `created_at`, `updated_at`) VALUES
(1, 5000, 3, '2017-05-31 14:22:17', '2017-05-31 09:48:01');

-- --------------------------------------------------------

--
-- Table structure for table `t_peminjaman`
--

CREATE TABLE `t_peminjaman` (
  `id` int(50) NOT NULL,
  `nim` int(10) NOT NULL,
  `nama_anggota` varchar(50) NOT NULL,
  `th_angkatan` int(4) NOT NULL,
  `kode_buku` varchar(10) NOT NULL,
  `nama_buku` varchar(50) NOT NULL,
  `jumlah` int(5) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1' COMMENT '1=pinjam,0=kembali',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_peminjaman`
--

INSERT INTO `t_peminjaman` (`id`, `nim`, `nama_anggota`, `th_angkatan`, `kode_buku`, `nama_buku`, `jumlah`, `status`, `created_at`, `updated_at`) VALUES
(7, 201705, 'siswa 5', 2013, 'BK001', 'Buku Satu', 1, 0, '2017-05-23 04:22:25', '2017-05-23 11:22:25'),
(8, 201705, 'siswa 5', 2013, 'BK002', 'Buku Dua', 1, 0, '2017-05-23 04:22:25', '2017-05-23 11:22:25'),
(9, 201705, 'siswa 5', 2013, 'BK001', 'Buku Satu', 1, 1, '2017-05-26 22:33:49', '2017-05-27 05:33:49'),
(10, 201705, 'siswa 5', 2013, 'BK002', 'Buku Dua', 1, 1, '2017-05-26 22:33:49', '2017-05-27 05:33:49');

--
-- Triggers `t_peminjaman`
--
DELIMITER $$
CREATE TRIGGER `pinjam` AFTER INSERT ON `t_peminjaman` FOR EACH ROW BEGIN
	UPDATE t_stok SET
    	t_stok.stok=t_stok.stok - NEW.jumlah
        WHERE t_stok.kode_buku=NEW.kode_buku;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `t_pengembalian`
--

CREATE TABLE `t_pengembalian` (
  `id` int(50) NOT NULL,
  `nim` int(10) NOT NULL,
  `nama_anggota` varchar(50) NOT NULL,
  `th_angkatan` int(4) NOT NULL,
  `kode_buku` varchar(10) NOT NULL,
  `nama_buku` varchar(50) NOT NULL,
  `jumlah` int(5) NOT NULL,
  `denda` int(11) NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_pengembalian`
--

INSERT INTO `t_pengembalian` (`id`, `nim`, `nama_anggota`, `th_angkatan`, `kode_buku`, `nama_buku`, `jumlah`, `denda`, `tgl_pinjam`, `created_at`, `updated_at`) VALUES
(5, 201705, 'siswa 5', 2013, 'BK001', 'Buku Satu', 1, 0, '2017-05-23', '2017-05-23 04:38:55', '2017-05-23 11:38:55'),
(6, 201705, 'siswa 5', 2013, 'BK002', 'Buku Dua', 1, 0, '2017-05-23', '2017-05-23 04:38:55', '2017-05-23 11:38:55');

--
-- Triggers `t_pengembalian`
--
DELIMITER $$
CREATE TRIGGER `kembali` AFTER INSERT ON `t_pengembalian` FOR EACH ROW BEGIN
	UPDATE t_stok SET
    	t_stok.stok=t_stok.stok + NEW.jumlah
        WHERE t_stok.kode_buku=NEW.kode_buku;
    UPDATE t_peminjaman SET
    	t_peminjaman.status = '0'
        WHERE t_peminjaman.nim = NEW.nim AND 		   t_peminjaman.kode_buku = NEW.kode_buku;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `t_rak`
--

CREATE TABLE `t_rak` (
  `id` int(5) NOT NULL,
  `rak` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_rak`
--

INSERT INTO `t_rak` (`id`, `rak`, `created_at`, `updated_at`) VALUES
(8, 'Rak 1', '2017-04-23 02:55:58', '2017-04-23 09:55:58'),
(9, 'Rak 2', '2017-04-23 02:56:08', '2017-04-23 09:56:08'),
(10, 'Rak 3', '2017-04-23 02:56:17', '2017-04-23 09:56:17'),
(11, 'Rak 4', '2017-04-23 02:56:23', '2017-04-23 09:56:23'),
(12, 'Rak 5', '2017-04-23 02:56:29', '2017-04-23 09:56:29'),
(13, 'Rak 6', '2017-04-22 21:48:41', '2017-04-23 06:38:30');

-- --------------------------------------------------------

--
-- Table structure for table `t_setting`
--

CREATE TABLE `t_setting` (
  `id` int(11) NOT NULL,
  `instansi` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `kepsek` char(50) NOT NULL,
  `petugas` char(50) NOT NULL,
  `prov` char(20) NOT NULL,
  `kab` char(20) NOT NULL,
  `kec` char(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_setting`
--

INSERT INTO `t_setting` (`id`, `instansi`, `alamat`, `kepsek`, `petugas`, `prov`, `kab`, `kec`, `created_at`, `updated_at`) VALUES
(1, 'My School', 'Jl. Dk.Tengah N0 94', 'Sang Victim', 'Tio', 'Jawa Tengah', 'Pemalang', 'Belik', '2017-05-23 15:16:14', '2017-05-23 10:16:14');

-- --------------------------------------------------------

--
-- Table structure for table `t_stok`
--

CREATE TABLE `t_stok` (
  `id` int(20) NOT NULL,
  `kode_buku` varchar(20) NOT NULL,
  `stok` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_stok`
--

INSERT INTO `t_stok` (`id`, `kode_buku`, `stok`) VALUES
(2, 'BK001', 9),
(3, 'BK002', 9),
(4, 'BK003', 10),
(5, 'BK004', 10);

-- --------------------------------------------------------

--
-- Table structure for table `user_login`
--

CREATE TABLE `user_login` (
  `id` int(5) NOT NULL,
  `nik` int(11) NOT NULL,
  `nama` char(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `akses` int(1) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_login`
--

INSERT INTO `user_login` (`id`, `nik`, `nama`, `username`, `password`, `akses`, `created_at`, `updated_at`) VALUES
(1, 0, 'Developer', 'admin', '21232f297a57a5a743894a0e4a801fc3', 0, '2017-04-14 05:17:22', '2017-04-14 08:19:11'),
(2, 0, 'Petugas', 'petugas', 'afb91ef692fd08c445e8cb1bab2ccf9c', 1, '2017-04-14 05:17:22', '2017-04-14 08:19:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_anggota`
--
ALTER TABLE `t_anggota`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nim` (`nim`);

--
-- Indexes for table `t_buku`
--
ALTER TABLE `t_buku`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rak` (`rak`);

--
-- Indexes for table `t_daftar_hadir`
--
ALTER TABLE `t_daftar_hadir`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_denda`
--
ALTER TABLE `t_denda`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_peminjaman`
--
ALTER TABLE `t_peminjaman`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kode_buku` (`kode_buku`),
  ADD KEY `nim` (`nim`);

--
-- Indexes for table `t_pengembalian`
--
ALTER TABLE `t_pengembalian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kode_buku` (`kode_buku`),
  ADD KEY `nim` (`nim`);

--
-- Indexes for table `t_rak`
--
ALTER TABLE `t_rak`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_setting`
--
ALTER TABLE `t_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_stok`
--
ALTER TABLE `t_stok`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kode_buku` (`kode_buku`);

--
-- Indexes for table `user_login`
--
ALTER TABLE `user_login`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_anggota`
--
ALTER TABLE `t_anggota`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `t_daftar_hadir`
--
ALTER TABLE `t_daftar_hadir`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `t_denda`
--
ALTER TABLE `t_denda`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `t_peminjaman`
--
ALTER TABLE `t_peminjaman`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `t_pengembalian`
--
ALTER TABLE `t_pengembalian`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `t_rak`
--
ALTER TABLE `t_rak`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `t_setting`
--
ALTER TABLE `t_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `t_stok`
--
ALTER TABLE `t_stok`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `user_login`
--
ALTER TABLE `user_login`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `t_buku`
--
ALTER TABLE `t_buku`
  ADD CONSTRAINT `t_buku_ibfk_1` FOREIGN KEY (`rak`) REFERENCES `t_rak` (`id`);

--
-- Constraints for table `t_peminjaman`
--
ALTER TABLE `t_peminjaman`
  ADD CONSTRAINT `t_peminjaman_ibfk_4` FOREIGN KEY (`kode_buku`) REFERENCES `t_buku` (`id`),
  ADD CONSTRAINT `t_peminjaman_ibfk_5` FOREIGN KEY (`nim`) REFERENCES `t_anggota` (`nim`) ON DELETE CASCADE;

--
-- Constraints for table `t_pengembalian`
--
ALTER TABLE `t_pengembalian`
  ADD CONSTRAINT `t_pengembalian_ibfk_4` FOREIGN KEY (`kode_buku`) REFERENCES `t_buku` (`id`),
  ADD CONSTRAINT `t_pengembalian_ibfk_5` FOREIGN KEY (`nim`) REFERENCES `t_anggota` (`nim`) ON DELETE CASCADE;

--
-- Constraints for table `t_stok`
--
ALTER TABLE `t_stok`
  ADD CONSTRAINT `t_stok_ibfk_1` FOREIGN KEY (`kode_buku`) REFERENCES `t_buku` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
