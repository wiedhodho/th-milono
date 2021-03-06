-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Aug 01, 2021 at 08:42 PM
-- Server version: 10.5.8-MariaDB-1:10.5.8+maria~focal
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `th_milono`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `barang_id` int(11) NOT NULL,
  `barang_transaksi` int(11) NOT NULL,
  `barang_nama` varchar(255) NOT NULL,
  `barang_qty` int(11) NOT NULL,
  `barang_created` datetime DEFAULT NULL,
  `barang_updated` datetime DEFAULT NULL,
  `barang_deleted` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `customer_nama` varchar(255) NOT NULL,
  `customer_alamat` varchar(255) NOT NULL,
  `customer_telp` varchar(25) NOT NULL,
  `customer_user` int(11) NOT NULL,
  `customer_created` datetime DEFAULT NULL,
  `customer_updated` datetime DEFAULT NULL,
  `customer_deleted` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_nama`, `customer_alamat`, `customer_telp`, `customer_user`, `customer_created`, `customer_updated`, `customer_deleted`) VALUES
(1, 'PT. Pama Persada1', 'Jl. APT Pranoto1', '08565401266611', 1, '2021-07-24 23:31:53', '2021-07-24 23:35:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `keuangan`
--

CREATE TABLE `keuangan` (
  `keuangan_id` int(11) NOT NULL,
  `keuangan_nominal` int(11) NOT NULL,
  `keuangan_keterangan` varchar(255) NOT NULL,
  `keuangan_user` int(11) NOT NULL,
  `keuangan_approved` datetime DEFAULT NULL,
  `keuangan_approved_by` int(11) DEFAULT NULL,
  `keuangan_created` datetime DEFAULT NULL,
  `keuangan_updated` datetime DEFAULT NULL,
  `keuangan_deleted` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `keuangan`
--

INSERT INTO `keuangan` (`keuangan_id`, `keuangan_nominal`, `keuangan_keterangan`, `keuangan_user`, `keuangan_approved`, `keuangan_approved_by`, `keuangan_created`, `keuangan_updated`, `keuangan_deleted`) VALUES
(1, 20000000, 'hehehe1', 1, NULL, NULL, '2021-07-26 08:13:00', '2021-07-26 08:15:21', NULL),
(2, 121212, 'tidak jadi', 1, '2021-07-30 08:07:00', 1, '2021-07-26 08:16:01', '2021-07-30 08:07:00', NULL),
(3, 12000, 'tes tes1', 1, NULL, NULL, '2021-07-30 08:00:20', '2021-07-30 08:02:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `setting_name` varchar(20) NOT NULL,
  `setting_type` varchar(10) NOT NULL,
  `setting_value` varchar(255) NOT NULL,
  `setting_desc` varchar(255) NOT NULL,
  `setting_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`setting_name`, `setting_type`, `setting_value`, `setting_desc`, `setting_updated`) VALUES
('alamat', 'text', 'JL. APT. Pranoto No. 01 Telp. (0554) 2024306 E-Mail: kominfo@gmail.com', 'alamat instansi', '2021-03-14 09:07:08'),
('allowed_filetypes', 'text', 'jpeg,jpg,png,gif,bmp,zip,rar,pdf,doc,docx,xls,xlsx,ppt,pptx,dwg,xlsm', 'extensi file yang diperbolehkan\r\n', '2021-03-14 13:50:16'),
('app_name', 'text', 'SIPENYU', 'nama aplikasi', '2021-03-15 12:57:05'),
('footer', 'text', 'Copyright ?? Kominfo 2021', 'copyright', '2021-03-15 13:27:22'),
('kota', 'text', 'TANJUNG REDEB', 'kota instansi', '2021-03-14 13:55:46'),
('logo', 'file', 'unnamed.jpg', 'Logo Website', '2021-03-14 09:08:40'),
('max_size', 'text', '204800', 'maximum file size when upload in kilobytes', '2021-03-14 13:50:23'),
('site_desc', 'text', 'Sistem Informasi Unit Layanan Pengadaan Kabupaten Berau', '', '2021-03-14 13:50:25'),
('site_keyword', 'text', 'ulp, lpse, berau, sistem informasi, 2017, wiedhodho', '', '2021-03-14 13:50:28'),
('site_title', 'text', 'Bengkel Milono', '', '2021-07-24 07:41:57');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `transaksi_id` int(11) NOT NULL,
  `transaksi_customer` int(11) NOT NULL,
  `transaksi_user` int(11) NOT NULL,
  `transaksi_status` tinyint(4) NOT NULL,
  `transaksi_total` int(11) NOT NULL,
  `transaksi_created` datetime DEFAULT NULL,
  `transaksi_updated` datetime DEFAULT NULL,
  `transaksi_deleted` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `users_id` int(11) NOT NULL,
  `users_name` varchar(50) NOT NULL,
  `users_password` varchar(100) NOT NULL,
  `users_salt` varchar(50) NOT NULL,
  `users_level` tinyint(4) NOT NULL,
  `users_nohp` varchar(20) NOT NULL,
  `users_nama` varchar(100) NOT NULL,
  `users_foto` varchar(100) NOT NULL,
  `users_aktif` tinyint(1) NOT NULL DEFAULT 0,
  `users_lastlogin` timestamp NULL DEFAULT NULL,
  `users_lastip` varchar(15) DEFAULT NULL,
  `users_created` timestamp NULL DEFAULT NULL,
  `users_updated` timestamp NULL DEFAULT NULL,
  `users_deleted` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`users_id`, `users_name`, `users_password`, `users_salt`, `users_level`, `users_nohp`, `users_nama`, `users_foto`, `users_aktif`, `users_lastlogin`, `users_lastip`, `users_created`, `users_updated`, `users_deleted`) VALUES
(1, 'admin', '$2y$10$C5/IGiJiSuXiLATaXKpbL.IqCpT66RmlbW4tjOGeOISAADNFGlmsW', '#MzLE4rb@0uKSGe27TJy)Qwds', 1, '+62856540126662', 'Edi Wahyu Widodo, S.ST, MT12', '6a5be3e71002b0c54e784da4dc0881cbd99a1238.jpg', 1, '2021-08-01 06:36:50', '172.16.238.1', '2021-03-09 07:52:51', '2021-08-01 06:36:50', NULL),
(2, 'bidan', '$2y$10$llDJi.O9rrJVHX6qM8HJ.ed0DbWtZZZMeDdLhJIdiVjZx4X0NY306', '', 3, '081297155586', 'Hardianty Amaliah', '6a5be3e71002b0c54e784da4dc0881cbd99a1238_1.jpg', 0, '2021-03-09 20:22:10', '172.16.238.1', '2021-03-09 20:21:57', '2021-03-25 08:06:55', NULL),
(3, 'kominfo1', '$2y$10$aqOgVCud7OiS6qrvqLQNzO4oQE4LZ0KQBqf2YIgfD2/fpAQOaeFwa', 'jZ(*qw$6g4vd^fNa&~Ey!J5U+', 4, '+6285654012661', 'PT. Pama Persada1', '75b44b0e9c2e5d305fa323c6c51d3476_Generic_6.jpg', 1, NULL, NULL, '2021-07-24 08:08:26', '2021-07-24 08:09:44', '2021-07-24 08:09:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`barang_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `keuangan`
--
ALTER TABLE `keuangan`
  ADD PRIMARY KEY (`keuangan_id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`setting_name`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`transaksi_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`),
  ADD UNIQUE KEY `users_name` (`users_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `barang_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `keuangan`
--
ALTER TABLE `keuangan`
  MODIFY `keuangan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `transaksi_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
