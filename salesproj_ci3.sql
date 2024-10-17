-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 07, 2024 at 02:32 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `salesproj_ci3`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`) VALUES
(1, 'Laptop Lenovo'),
(2, 'Kursi Gaming'),
(3, 'Meja Kerja'),
(4, 'Monitor Dell'),
(5, 'Printer Epson');

-- --------------------------------------------------------

--
-- Table structure for table `mgt_posisi`
--

CREATE TABLE `mgt_posisi` (
  `id_posisi` int(11) NOT NULL,
  `nama_posisi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mgt_posisi`
--

INSERT INTO `mgt_posisi` (`id_posisi`, `nama_posisi`) VALUES
(1, 'Negosiator'),
(2, 'Sales'),
(3, 'Kolektor'),
(4, 'Sopir'),
(5, 'Testing');

-- --------------------------------------------------------

--
-- Table structure for table `mgt_user`
--

CREATE TABLE `mgt_user` (
  `id_user` int(11) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `posisi` varchar(50) NOT NULL,
  `alamat` text DEFAULT NULL,
  `nomor_telpon` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mgt_user`
--

INSERT INTO `mgt_user` (`id_user`, `nama_lengkap`, `posisi`, `alamat`, `nomor_telpon`) VALUES
(2, 'Yogi', '1', 'Sumedang', '0813132313'),
(3, 'Ayogi Kurniawan', '2', 'BSD', '081312312'),
(4, 'Test Sopir', '4', 'Smd', '08324324'),
(5, 'Tes Kol', '3', 'BSD', '08233424');

-- --------------------------------------------------------

--
-- Table structure for table `setting_mgt`
--

CREATE TABLE `setting_mgt` (
  `id_setting` int(11) NOT NULL,
  `lama_tempo` int(11) NOT NULL,
  `prosentase_sales` decimal(5,2) NOT NULL,
  `prosentase_kolektor` decimal(5,2) NOT NULL,
  `prosentase_negosiator` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `setting_mgt`
--

INSERT INTO `setting_mgt` (`id_setting`, `lama_tempo`, `prosentase_sales`, `prosentase_kolektor`, `prosentase_negosiator`) VALUES
(1, 10, '10.00', '10.00', '10.00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_role`
--

CREATE TABLE `tb_role` (
  `id` int(11) NOT NULL,
  `nama_role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_role`
--

INSERT INTO `tb_role` (`id`, `nama_role`) VALUES
(1, 'administrator'),
(2, 'member'),
(3, 'admin'),
(4, 'operator');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `nama_lengkap` varchar(128) NOT NULL,
  `id_role` int(11) NOT NULL,
  `image` varchar(128) NOT NULL DEFAULT 'user.png',
  `is_active` int(11) NOT NULL,
  `cid` int(11) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `did` int(11) DEFAULT NULL,
  `cname` varchar(256) DEFAULT NULL,
  `uname` varchar(256) DEFAULT NULL,
  `dname` varchar(256) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `email`, `username`, `password`, `nama_lengkap`, `id_role`, `image`, `is_active`, `cid`, `uid`, `did`, `cname`, `uname`, `dname`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin@gmail.com', 'admin', '$2y$10$j1DUadXW3FpeYAtRab7YXOmxdQSETLN7Pvza/ay3P9CX0TFi4KBzm', 'admin', 1, 'user.png', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'member@gmail.com', 'member', '$2y$10$j1DUadXW3FpeYAtRab7YXOmxdQSETLN7Pvza/ay3P9CX0TFi4KBzm', 'member', 2, 'user.png', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_negosiator` int(11) DEFAULT NULL,
  `id_sales` int(11) DEFAULT NULL,
  `id_sopir` int(11) DEFAULT NULL,
  `id_kolektor` int(11) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `harga` decimal(10,2) DEFAULT NULL,
  `uang_akad` decimal(10,2) DEFAULT NULL,
  `id_tuan_rumah` varchar(50) NOT NULL,
  `nama_tuan_rumah` varchar(100) DEFAULT NULL,
  `alamat_tuan_rumah` text DEFAULT NULL,
  `kontak_tuan_rumah` varchar(15) DEFAULT NULL,
  `customer` varchar(100) DEFAULT NULL,
  `alamat_customer` text DEFAULT NULL,
  `kontak_customer` varchar(15) DEFAULT NULL,
  `tanggal_jatuh_tempo` date DEFAULT NULL,
  `termin1` decimal(10,2) DEFAULT NULL,
  `termin2` decimal(10,2) DEFAULT NULL,
  `termin3` decimal(10,2) DEFAULT NULL,
  `termin4` decimal(10,2) DEFAULT NULL,
  `prosentase_sales` decimal(5,2) DEFAULT NULL,
  `prosentase_negosiator` decimal(5,2) DEFAULT NULL,
  `prosentase_kolektor` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_negosiator`, `id_sales`, `id_sopir`, `id_kolektor`, `id_barang`, `harga`, `uang_akad`, `id_tuan_rumah`, `nama_tuan_rumah`, `alamat_tuan_rumah`, `kontak_tuan_rumah`, `customer`, `alamat_customer`, `kontak_customer`, `tanggal_jatuh_tempo`, `termin1`, `termin2`, `termin3`, `termin4`, `prosentase_sales`, `prosentase_negosiator`, `prosentase_kolektor`) VALUES
(4, 2, 3, 4, 5, NULL, '10000.00', '2000.00', '4003', 'YOGI', 'BSD', '08324242', 'SL', 'BSD', '082434', '2024-10-18', '1000.00', '1000.00', '1000.00', '5000.00', '10.00', '10.00', '10.00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `mgt_posisi`
--
ALTER TABLE `mgt_posisi`
  ADD PRIMARY KEY (`id_posisi`);

--
-- Indexes for table `mgt_user`
--
ALTER TABLE `mgt_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `setting_mgt`
--
ALTER TABLE `setting_mgt`
  ADD PRIMARY KEY (`id_setting`);

--
-- Indexes for table `tb_role`
--
ALTER TABLE `tb_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_role` (`id_role`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD UNIQUE KEY `id_tuan_rumah` (`id_tuan_rumah`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `mgt_posisi`
--
ALTER TABLE `mgt_posisi`
  MODIFY `id_posisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `mgt_user`
--
ALTER TABLE `mgt_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `setting_mgt`
--
ALTER TABLE `setting_mgt`
  MODIFY `id_setting` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_role`
--
ALTER TABLE `tb_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD CONSTRAINT `user_role_id` FOREIGN KEY (`id_role`) REFERENCES `tb_role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
