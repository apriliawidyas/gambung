-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2019 at 04:00 PM
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
-- Database: `gambung`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `kuantitas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `id_produk`, `kuantitas`) VALUES
(6, 8, 16, 10),
(8, 8, 16, 2);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(255) NOT NULL,
  `penjual_id` int(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `harga` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `penjual_id`, `nama`, `harga`, `keterangan`, `gambar`) VALUES
(12, 3, 'Kopiko', '1232', 'Kopiko Enak Sekali', 'Kopiko.png'),
(13, 3, 'dsa', '1234', 'wef', 'dsa.png'),
(14, 3, 'Kopi Enakdsds', '200000', 'Kopi Enak', 'Kopi Enakdsds.jpeg'),
(15, 3, 'dsa', '23', 'das', 'dsa.jpeg'),
(16, 4, 'Kripik Teh', '25000', 'Kripik Teh Ciwidey, dari bahan alami', 'Kripik Teh.png');

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
  `alamat` varchar(255) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `email` varchar(225) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `role_id`, `nama_depan`, `nama_belakang`, `tanggal_lahir`, `alamat`, `no_telp`, `email`, `password`) VALUES
(1, 1, '', '', '0000-00-00', '', '2147483647', 'admin', 'admin'),
(2, 3, '', '', '0000-00-00', '', '0', 'pembeli', 'pembeli'),
(3, 2, 'Rizqis', 'Primas', '1998-11-11', 'Bandung Juara', '081226269692', 'rizqiphd@gmail.com', 'tehataukopi'),
(4, 2, 'Rizqi', 'Prima', '2001-01-11', 'Bandun Keren', '2147483647', 'rizqisupernova@gmail.com', 'rizqisupernova'),
(5, 3, 'Rizqi', 'Prima', '1998-01-11', 'Rizqi Prima Hariadhy', '2147483647', 'rizqiphdd@gmail.com', '123456'),
(6, 3, 'Rizqi', 'Prima', '1998-01-11', 'Bandung', '2147483647', 'rizqiphdddd@gmail.com', 'rizqiphdddd@gmail.com'),
(7, 3, 'Aprilia', 'Widyas', '1998-04-19', 'Bojongsoang', '082216650304', 'apriliawidyas@gmail.com', 'adgjmptwe'),
(8, 3, 'Erza', 'Ganteng', '2019-04-10', 'Asrama', '085', 'erzaganteng@gmail.com', 'erza');

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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
