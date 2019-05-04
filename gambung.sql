-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Bulan Mei 2019 pada 20.17
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 7.3.3

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
-- Struktur dari tabel `cart`
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
-- Dumping data untuk tabel `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `id_produk`, `kuantitas`, `status`, `status_pengiriman`, `id_transfer`) VALUES
(1, 7, 17, 1, 1, 0, 1),
(2, 7, 16, 4, 1, 0, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `foto_produk`
--

CREATE TABLE `foto_produk` (
  `id_foto` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `foto_produk`
--

INSERT INTO `foto_produk` (`id_foto`, `id_produk`, `gambar`) VALUES
(11, 40, 'Coba_AL.png.png'),
(12, 40, 'Coba_Frame.png.png'),
(13, 40, 'Coba_psTcwrZyvD.png'),
(14, 40, 'Coba_b7tp4EmGqr.png'),
(16, 41, 'Kopi Anjay_APCG0Eq2Ko.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
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
  `kategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id`, `penjual_id`, `id_toko`, `nama`, `harga`, `keterangan`, `gambar`, `berat`, `kategori`) VALUES
(12, 3, 0, 'Kopiko', '1232', 'Kopiko Enak Sekali', 'Kopiko.png', 500, 'kopi'),
(13, 3, 0, 'dsa', '1234', 'wef', 'dsa.png', 250, 'kopi'),
(14, 3, 0, 'Kopi Enakdsds', '200000', 'Kopi Enak', 'Kopi Enakdsds.jpeg', 300, 'kopi'),
(15, 3, 0, 'dsa', '23', 'das', 'dsa.jpeg', 600, 'kerajinan'),
(16, 4, 0, 'Kripik Teh', '25000', 'Kripik Teh Ciwidey, dari bahan alami', 'Kripik Teh.png', 750, 'teh'),
(17, 9, 0, 'April', '10000000', 'Cewe sukanya marah mulu', 'April.jpeg', 55, 'kerajinan'),
(40, 9, 2, 'Coba', '1000000', 'multifoto', 'Coba.png', 100, 'kopi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `toko`
--

CREATE TABLE `toko` (
  `id_toko` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_toko` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `toko`
--

INSERT INTO `toko` (`id_toko`, `id_user`, `nama_toko`, `alamat`, `gambar`) VALUES
(2, 9, 'Toko Erza', 'Ini Alamat', 'dwa.jpeg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transfer`
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
-- Dumping data untuk tabel `transfer`
--

INSERT INTO `transfer` (`id_transfer`, `id_user`, `total`, `status_upload`, `status_verifikasi`, `date_upload`, `time_checkout`) VALUES
(1, 7, 10052000, 1, 0, '2019-05-04', '05:06:pm'),
(2, 7, 162000, 0, 0, '0000-00-00', '05:06:pm');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
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
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `role_id`, `nama_depan`, `nama_belakang`, `tanggal_lahir`, `kota`, `alamat`, `no_telp`, `email`, `password`) VALUES
(1, 1, '', '', '0000-00-00', '', '', '2147483647', 'admin@gmail.com', 'admin'),
(4, 2, 'Rizqi', 'Prima', '2001-01-11', 'Klaten', 'Bandun Keren', '2147483647', 'rizqisupernova@gmail.com', 'rizqisupernova'),
(5, 3, 'Rizqi', 'Prima', '1998-01-11', '', 'Rizqi Prima Hariadhy', '2147483647', 'rizqiphdd@gmail.com', '123456'),
(6, 3, 'Rizqi', 'Prima', '1998-01-11', '', 'Bandung', '2147483647', 'rizqiphdddd@gmail.com', 'rizqiphdddd@gmail.com'),
(7, 3, 'Aprilia', 'Widyas', '1998-04-19', 'Klaten', 'Bojongsoang', '082216650304', 'apriliawidyas@gmail.com', 'adgjmptwe'),
(8, 3, 'Erza', 'Ganteng', '2019-04-10', 'Klaten', 'Asrama gd 9', '085', 'erzaganteng@gmail.com', 'erza'),
(9, 2, 'Erza', 'Gantenk Banget', '2019-05-07', '', 'hatimu yang terdalam', '123', 'erza@gmail.com', 'erza'),
(10, 1, 'Erza Ganteng', 'Admin Ganteng', '2019-05-18', 'Bandung', 'Bojongswan', '12345612345', 'erzaadmin@gmail.com', 'erza');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'admin'),
(2, 'penjual'),
(3, 'pembeli');

-- --------------------------------------------------------

--
-- Struktur dari tabel `voucher`
--

CREATE TABLE `voucher` (
  `id` int(255) NOT NULL,
  `kode` varchar(10) NOT NULL,
  `diskon` decimal(3,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `voucher`
--

INSERT INTO `voucher` (`id`, `kode`, `diskon`) VALUES
(1, 'ERZGANTENG', '0.50'),
(2, 'YDHS123HJ4', '0.20'),
(3, 'APR19', '0.30');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `foto_produk`
--
ALTER TABLE `foto_produk`
  ADD PRIMARY KEY (`id_foto`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `toko`
--
ALTER TABLE `toko`
  ADD PRIMARY KEY (`id_toko`),
  ADD UNIQUE KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `transfer`
--
ALTER TABLE `transfer`
  ADD PRIMARY KEY (`id_transfer`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`email`);

--
-- Indeks untuk tabel `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `voucher`
--
ALTER TABLE `voucher`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode` (`kode`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `foto_produk`
--
ALTER TABLE `foto_produk`
  MODIFY `id_foto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT untuk tabel `toko`
--
ALTER TABLE `toko`
  MODIFY `id_toko` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `transfer`
--
ALTER TABLE `transfer`
  MODIFY `id_transfer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `voucher`
--
ALTER TABLE `voucher`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
