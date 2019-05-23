-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2019 at 11:32 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gambungs_gambung`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `kuantitas` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `status_pengiriman` int(11) NOT NULL,
  `id_transfer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `id_produk`, `kuantitas`, `status`, `status_pengiriman`, `id_transfer`) VALUES
(1, 7, 17, 1, 1, 0, 1),
(2, 7, 16, 4, 1, 0, 2),
(3, 8, 40, 4, 1, 0, 3),
(4, 8, 17, 3, 1, 1, 4),
(5, 11, 41, 1, 1, 1, 5),
(6, 11, 42, 2, 1, 0, 6);

-- --------------------------------------------------------

--
-- Table structure for table `foto_produk`
--

CREATE TABLE `foto_produk` (
  `id_foto` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `nama_kategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notif`
--

CREATE TABLE `notif` (
  `notif_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `notif_judul` varchar(255) NOT NULL,
  `notif_text` varchar(255) NOT NULL,
  `notif_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notif`
--

INSERT INTO `notif` (`notif_id`, `user_id`, `notif_judul`, `notif_text`, `notif_status`) VALUES
(1, 8, 'Notifikasi Barang', 'Barang anda sudah diproses', 1),
(2, 8, 'Notifikasi Pembayaran', 'Barang anda sudah diproses', 1),
(3, 8, 'Verifikasi Pembayaran', 'Bukti transfer anda sudah diverifikasi', 1),
(4, 0, 'Verifikasi Pembayaran', 'Bukti transfer anda sudah diverifikasi', 0),
(5, 8, 'Verifikasi Pembayaran', 'Bukti transfer anda sudah diverifikasi', 1),
(6, 8, 'Verifikasi Pengiriman', 'Barang anda sudah dikirim', 1),
(7, 11, 'Verifikasi Pembayaran', 'Bukti transfer anda sudah diverifikasi', 1),
(8, 11, 'Verifikasi Pengiriman', 'Barang anda sudah dikirim', 1);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(255) NOT NULL,
  `penjual_id` int(255) NOT NULL,
  `id_toko` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `harga` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `berat` int(11) NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `penjual_id`, `id_toko`, `nama`, `harga`, `keterangan`, `gambar`, `berat`, `kategori`, `stock`) VALUES
(41, 9, 2, 'Kopi Mantap', '50000', 'Mantap Betul', 'Kopi Mantap.jpeg', 100, 'kopi', 0),
(42, 9, 2, 'Teh Mantap', '50000', 'Mantap Betul', 'Teh Mantap.jpeg', 100, 'teh', 0),
(43, 9, 2, 'Teh Oke', '50000', 'Oke Betul', 'Teh Oke.jpeg', 100, 'kerajinan', 0),
(44, 16, 3, '', '', '', '.png', 0, 'kopi', 0);

-- --------------------------------------------------------

--
-- Table structure for table `toko`
--

CREATE TABLE `toko` (
  `id_toko` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_toko` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `toko`
--

INSERT INTO `toko` (`id_toko`, `id_user`, `nama_toko`, `alamat`, `gambar`) VALUES
(2, 9, 'Toko X', 'Ciwidey', 'Toko X.png'),
(3, 16, 'gamboeng', 'gambung', 'gamboeng.png');

-- --------------------------------------------------------

--
-- Table structure for table `transfer`
--

CREATE TABLE `transfer` (
  `id_transfer` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `status_upload` int(1) NOT NULL,
  `status_verifikasi` int(11) NOT NULL,
  `date_upload` date NOT NULL,
  `time_checkout` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transfer`
--

INSERT INTO `transfer` (`id_transfer`, `id_user`, `total`, `status_upload`, `status_verifikasi`, `date_upload`, `time_checkout`) VALUES
(1, 7, 10052000, 1, 1, '2019-05-04', '05:06:pm'),
(2, 7, 162000, 0, 0, '0000-00-00', '05:06:pm'),
(3, 8, 4062000, 1, 1, '2019-05-05', '11:05:am'),
(4, 8, 30052000, 1, 1, '2019-05-05', '11:20:am'),
(5, 11, 70000, 1, 1, '2019-05-13', '07:24:pm'),
(6, 11, 120000, 0, 0, '0000-00-00', '03:50:am');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `nama_depan` varchar(255) NOT NULL,
  `nama_belakang` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `kota` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `email` varchar(225) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `role_id`, `nama_depan`, `nama_belakang`, `tanggal_lahir`, `kota`, `alamat`, `no_telp`, `email`, `password`) VALUES
(4, 2, 'Rizqi', 'Prima', '2001-01-11', 'Klaten', 'Bandun Keren', '2147483647', 'rizqisupernova@gmail.com', 'rizqisupernova'),
(7, 3, 'Aprilia', 'Widyas', '1998-04-19', 'Klaten', 'Bojongsoang', '082216650304', 'apriliawidyas@gmail.com', 'adgjmptwe'),
(10, 1, 'Karina', 'Farizki', '2019-05-18', 'Bandung', 'Bojongswan', '12345612345', 'karinaadmin@gmail.com', 'karinafs'),
(11, 3, 'Karina ', 'FS', '1997-12-16', 'Klaten', 'Klaten', '082216649651', 'karinafarizki20@gmail.com', 'karinafs'),
(14, 1, 'Amjad Fawwaz', 'Humam', '1997-01-08', 'Bandung', 'Ciwidey', '081215548761', 'amjadfawwaz123@gmail.com', 'asdawe123'),
(15, 1, 'Rival', 'Fauzi', '2019-05-03', 'Bandung', 'Ciwidey', '081215548761', 'rivalf666@gmail.com', 'jangawareng'),
(16, 1, 'Nugraha Rasid', 'Firdaus', '2019-05-17', 'Bandung', 'Ciwidey', '081215548761', 'nugraharf@gmail.com', 'nugraha19');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'admin'),
(2, 'penjual'),
(3, 'pembeli');

-- --------------------------------------------------------

--
-- Table structure for table `voucher`
--

CREATE TABLE `voucher` (
  `id` int(255) NOT NULL,
  `kode` varchar(10) NOT NULL,
  `diskon` decimal(3,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `voucher`
--

INSERT INTO `voucher` (`id`, `kode`, `diskon`) VALUES
(1, 'ERZGANTENG', '0.50'),
(2, 'YDHS123HJ4', '0.20'),
(3, 'APR19', '0.30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `foto_produk`
--
ALTER TABLE `foto_produk`
  ADD PRIMARY KEY (`id_foto`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notif`
--
ALTER TABLE `notif`
  ADD PRIMARY KEY (`notif_id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `toko`
--
ALTER TABLE `toko`
  ADD PRIMARY KEY (`id_toko`),
  ADD UNIQUE KEY `id_user` (`id_user`);

--
-- Indexes for table `transfer`
--
ALTER TABLE `transfer`
  ADD PRIMARY KEY (`id_transfer`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`email`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `voucher`
--
ALTER TABLE `voucher`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode` (`kode`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `foto_produk`
--
ALTER TABLE `foto_produk`
  MODIFY `id_foto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notif`
--
ALTER TABLE `notif`
  MODIFY `notif_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `toko`
--
ALTER TABLE `toko`
  MODIFY `id_toko` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transfer`
--
ALTER TABLE `transfer`
  MODIFY `id_transfer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `voucher`
--
ALTER TABLE `voucher`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
