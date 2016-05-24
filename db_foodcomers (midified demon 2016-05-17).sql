-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2016 at 12:43 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_foodcomers`
--

-- --------------------------------------------------------

--
-- Table structure for table `diskusi_produk`
--

CREATE TABLE IF NOT EXISTS `diskusi_produk` (
  `id_diskusi` varchar(30) NOT NULL,
  `id_produk` varchar(30) NOT NULL,
  `id_pengguna` varchar(30) NOT NULL,
  `komentar` varchar(500) NOT NULL,
  `tgl` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_auth`
--

CREATE TABLE IF NOT EXISTS `tb_auth` (
  `id_auth` varchar(30) NOT NULL,
  `id_pengguna` varchar(30) NOT NULL,
  `ip_address` varchar(50) NOT NULL,
  `mac_address` varchar(50) NOT NULL,
  `status` varchar(1) NOT NULL,
  `tgl` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_auth`
--

INSERT INTO `tb_auth` (`id_auth`, `id_pengguna`, `ip_address`, `mac_address`, `status`, `tgl`) VALUES
('auth1402', 'user0001', 'v4ZYn4g7AHAexShSN8qgKyiZ98I3KDsgqyjqNVQSEb5ZgK4Q9C', 'CvZjBZ8m9fJBbkovp24tpiN5MBj/hWGTf0E8A3MmzyfRBxqAlA', 'T', '2016-05-17 10:27:08'),
('auth1992', 'user0001', 'DTSvv0goKRTrta/tCl1vEFxTVyKGa9YNLTXLoYUJoXoNOXZB0l', 'F/+fSC7AlortWdePaUyTHVbNt9tbsrKyH4hjctKpNre//Tglya', 'T', '2016-05-17 10:28:23'),
('auth2191', 'user0001', 'UvCLvZ5Febju8/yntF+jMwWavN/pWxZ4Zg3xqgvvFvTjlk3Cw3', 'GhZjaVSHXCDPkisLAZpe0/6wRPvPjapQd5zQfogZggRZnk3mM4', 'T', '2016-05-17 10:22:21'),
('auth2388', 'user0001', 'vb7xKX63jEbLfbX5eFFdy/snMB+7lV+hHOeI3xA61jf5vHl5Nx', 'bgeYgarsTqmz3tOoXR8WBhuhxiZW+RG0dXiWPmU3gCJdIq9XuD', 'F', '2016-05-17 10:26:13'),
('auth4013', 'user0001', '60QPN4Jd/GE9O1BZcaF6JhL+qK8IbIodObc9gRN6brWbTFrY2n', 'nyAZAnLm4veqsFP7mkHYFTYLoippJWBlFV0u1KxLvFP0VRoReu', 'T', '2016-05-17 10:32:29'),
('auth5532', 'user0001', 'zsFuyIaSQPxLryFI8FwBMuuKjR2jz/O3fXrUjmqkW/3Cfie5Ff', 'P8rU33OHwh/z0QC3lep7LMzD4+X/9GaLlcujrX5hxalLNLyzUp', 'T', '2016-05-17 10:41:52'),
('auth5982', 'user0001', 'D8bLuveu1/dx9tY/DaJ32QRiKOp8jtndmTTnAA0rQHG7IEpey/', 'th3377oRv1iPpboMyN2XU5pqxVAtoTFvp5I8/bcX0Bp3DPD3Sh', 'T', '2016-05-17 10:21:32'),
('auth8478', 'user0001', 'hn7JsfQkwxpb/ouQsu0uO42CfB1x9MOE5jPCnfv2xWY0RViB+1', '4wgUIf2L2gZRgK451Mue3xn8eP2qS4vgC6WWtU3E5HpwMsD6s9', 'T', '2016-05-17 10:30:57');

-- --------------------------------------------------------

--
-- Table structure for table `tb_belanja`
--

CREATE TABLE IF NOT EXISTS `tb_belanja` (
  `id_belanja` varchar(30) NOT NULL,
  `id_produk` varchar(30) NOT NULL,
  `id_stmengirim` int(2) NOT NULL,
  `session_belanja` varchar(30) NOT NULL,
  `total_barang` int(4) NOT NULL,
  `biaya` int(11) NOT NULL,
  `alamat_pemesanan` varchar(500) NOT NULL,
  `keterangan` varchar(500) NOT NULL,
  `lotitude` float NOT NULL,
  `latitude` float NOT NULL,
  `id_stpesan` int(3) NOT NULL,
  `tgl` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_gambarproduk`
--

CREATE TABLE IF NOT EXISTS `tb_gambarproduk` (
  `id_gambar` varchar(30) NOT NULL,
  `id_produk` varchar(30) NOT NULL,
  `nama_gambar` varchar(100) NOT NULL,
  `setcover` varchar(1) NOT NULL,
  `tgl` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori`
--

CREATE TABLE IF NOT EXISTS `tb_kategori` (
  `id_kategori` int(2) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `keterangan` varchar(500) NOT NULL,
  `gambar` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_kecamatan`
--

CREATE TABLE IF NOT EXISTS `tb_kecamatan` (
`id_kecamatan` int(4) NOT NULL,
  `id_kotamadya` int(4) NOT NULL,
  `nama_kecamatan` varchar(50) NOT NULL,
  `count_toko` int(3) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_kotamadya`
--

CREATE TABLE IF NOT EXISTS `tb_kotamadya` (
`id_kotamadya` int(4) NOT NULL,
  `id_provinsi` int(4) NOT NULL,
  `nama_kotamadya` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_levelpengguna`
--

CREATE TABLE IF NOT EXISTS `tb_levelpengguna` (
  `id_level` int(2) NOT NULL,
  `nama_level` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_levelpengguna`
--

INSERT INTO `tb_levelpengguna` (`id_level`, `nama_level`) VALUES
(1, 'Super Admin'),
(2, 'Penjual'),
(3, 'Pembeli');

-- --------------------------------------------------------

--
-- Table structure for table `tb_lokasi`
--

CREATE TABLE IF NOT EXISTS `tb_lokasi` (
  `id_lokasi` varchar(30) NOT NULL,
  `id_toko` varchar(30) NOT NULL,
  `id_sttoko` int(2) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `id_kecamatan` int(4) NOT NULL,
  `nohp` varchar(15) NOT NULL,
  `latitude` float NOT NULL,
  `lotitude` float NOT NULL,
  `ak_rating` float NOT NULL DEFAULT '0',
  `tgl` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_medsos`
--

CREATE TABLE IF NOT EXISTS `tb_medsos` (
  `id_medsos` varchar(30) NOT NULL,
  `nama_medsos` varchar(100) NOT NULL,
  `icon` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_medsostoko`
--

CREATE TABLE IF NOT EXISTS `tb_medsostoko` (
  `id_medsostoko` varchar(30) NOT NULL,
  `id_medsos` varchar(30) NOT NULL,
  `id_toko` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengguna`
--

CREATE TABLE IF NOT EXISTS `tb_pengguna` (
  `id_pengguna` varchar(30) NOT NULL,
  `id_lokasi` varchar(30) NOT NULL,
  `id_level` int(2) NOT NULL,
  `nama_pengguna` varchar(400) NOT NULL,
  `password` varchar(400) NOT NULL,
  `email` varchar(400) NOT NULL,
  `jenkel` varchar(1) NOT NULL,
  `foto_pengguna` varchar(100) NOT NULL,
  `status` varchar(10) NOT NULL,
  `tgl` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pengguna`
--

INSERT INTO `tb_pengguna` (`id_pengguna`, `id_lokasi`, `id_level`, `nama_pengguna`, `password`, `email`, `jenkel`, `foto_pengguna`, `status`, `tgl`) VALUES
('user0001', '-', 1, 'Mk360lg+2OHwuT2WcCK1l+qKj2hnp5vV7OgWjQqGzQvM2pFffg+Q78iVkQPH9KgDVwiDtMdpxv/eIe5KwRWikk0sdnqqX/w7I7+AMPploLQTFx3Gb7yKf0U4P7u2REakE+PvohG2tKEcfsPZTH57sCMReK1s2o+voYzhs84HZvF54jQxl5+JKwEnIAmfG35es8K36F7SOjsShqOqHCF+21hXEy4WtvZzG6BS0czFxfrWPnuWq+H96a37b2UnkUGCgpaMXCli6WL4eM6BYubi0ZSevWerDKQoVzoWBBJcLVA=', '7qswTYdBu4Ad08b3hKU/Py+o07iIcrMO8lJ90mBhXF5sJaa/ihLU3fjhLkq9tTpi6TzNpSHpGJ+4eIe3uASwIFCKWOUjWo7NEvhf2xe1PDdzAgjwjLiRozAAeEedBJDf', 'HdbnSBA90N1opmGCeNgGPDRC8PCH+87LVNK92gphavrOkxIHB6Siio07YYZMjFGTJD6lR/1S1+UmAiG1CxbMW0mo5/6xPtQhf9Hdx8pUBktxtYjbvWj2OikwIYuBNMHNGVCTCKJBl5btkmtTVt+v8t1pcCUNTdhrVX4udok0TD+NeWRP78qveMI9zLsjeJuyKknPzgDnHmrnJFkYpISsC8F3ptddsLgt6IMV34wUKjekVeDfQdsgej/Mfvcrc+0rram9MzDxRwvHDm7Tat/rXtDaNl+CjhsfgSoQ1bBndCc=', 'L', 'default.png', 'active', '2016-05-17 09:58:16'),
('user0002', '-', 1, 'VnvC1j0jfw9IkqMXzIid9b52m44Dc00MhE7QgK+h0MR630JRiNd6zwmI4m9Awy6ce4Ag7WlaeTNg3V3cHyiLmI9zGu5QfTXjy3uOluBEvkUJGdwPOlfsWETu3dQxm3wUBW3/Y/NL8ywFxTK983Cb4RURbAcVhlo1a6e45TdKbshGq59mCr6Sw5CpAGtoLXNjd3lFhb1Vj+WMGC8kfPTrFfx7GJhqGiDjPxaq5PdNVDtxeMECp2obLiU3B5ea0eXereyxp4Z3s0MKMwD+h3VWM4oeHsYSZtqiekpkvXCuDtE=', '+5OfB5KtjDBNi+AogfAJ9iJPOH8YvBntSQfNUCPJ/YXPW5iDR7p8hwJ/HUYDR3zkYBdt6952mp9fHNyKQ1FMRANlE8qRnAeXLGmOUFmwPrDwpVNJcJxKmpxFq8TydvfO', '+D6LmDwzRD3jLaPwQ+8Zu1Do04DyMoFqDplAiRW4vbmv1VYTtmtwgrDiogBDiOzTE8pGOpHnewLaWgbAIEiNXlwUaa7pHsUHXtxeEinBr3YiTdWqXFHNqACwVEOS5VCzO6lQpJrmRJMy/nj2dEG9dXzMm/8RX+SPhBxP1d1AcNRRU5S11PkMJEw1Wk4BVNnDzILLrWCBJOOrwl0VqBTynleU4inYR/9UZ2lIPVTywq41miXmzr9vWrn6V+5RyL4HtFW1QVjkfltb08ntQIBThu4ad9TJCuOVs43JYXLHycw=', 'P', 'default.png', 'active', '2016-05-17 10:00:07');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pesan`
--

CREATE TABLE IF NOT EXISTS `tb_pesan` (
  `id_pesan` varchar(30) NOT NULL,
  `id_pengguna` varchar(30) NOT NULL,
  `session_belanja` varchar(30) NOT NULL,
  `pesan` varchar(500) NOT NULL,
  `tot_biaya` int(11) NOT NULL,
  `latitude` float NOT NULL,
  `lotitude` float NOT NULL,
  `tgl` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_produk`
--

CREATE TABLE IF NOT EXISTS `tb_produk` (
  `id_produk` varchar(30) NOT NULL,
  `id_lokasi` varchar(30) NOT NULL,
  `id_kategori` int(2) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `satuan` varchar(50) NOT NULL,
  `b_produk` int(4) NOT NULL,
  `pemesanan_min` int(4) NOT NULL,
  `informasi` varchar(500) NOT NULL,
  `harga` int(11) NOT NULL,
  `tgl` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_provinsi`
--

CREATE TABLE IF NOT EXISTS `tb_provinsi` (
`tb_provinsi` int(4) NOT NULL,
  `nama_provinsi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_rating`
--

CREATE TABLE IF NOT EXISTS `tb_rating` (
  `id_rating` varchar(30) NOT NULL,
  `id_pengguna` varchar(30) NOT NULL,
  `id_lokasi` varchar(30) NOT NULL,
  `rating` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_stmengirim`
--

CREATE TABLE IF NOT EXISTS `tb_stmengirim` (
  `id_stmengirim` int(2) NOT NULL,
  `stmengirim` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_stmengirim`
--

INSERT INTO `tb_stmengirim` (`id_stmengirim`, `stmengirim`) VALUES
(1, 'Belum Diterima'),
(2, 'Telah Diterima');

-- --------------------------------------------------------

--
-- Table structure for table `tb_stpesan`
--

CREATE TABLE IF NOT EXISTS `tb_stpesan` (
  `id_stpesan` int(3) NOT NULL,
  `stpesan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_stpesan`
--

INSERT INTO `tb_stpesan` (`id_stpesan`, `stpesan`) VALUES
(1, 'Menunggu Konfirmasi'),
(2, 'Stok Habis'),
(3, 'Stok Ada');

-- --------------------------------------------------------

--
-- Table structure for table `tb_sttoko`
--

CREATE TABLE IF NOT EXISTS `tb_sttoko` (
`id_sttoko` int(2) NOT NULL,
  `nama_status` varchar(10) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tb_sttoko`
--

INSERT INTO `tb_sttoko` (`id_sttoko`, `nama_status`) VALUES
(1, 'Pusat'),
(2, 'Cabang');

-- --------------------------------------------------------

--
-- Table structure for table `tb_toko`
--

CREATE TABLE IF NOT EXISTS `tb_toko` (
  `id_toko` varchar(30) NOT NULL,
  `pemilik` varchar(100) NOT NULL,
  `nama_toko` varchar(100) NOT NULL,
  `informasi` varchar(1000) NOT NULL,
  `tgl` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi`
--

CREATE TABLE IF NOT EXISTS `tb_transaksi` (
  `id_transaksi` varchar(30) NOT NULL,
  `id_pesan` varchar(30) NOT NULL,
  `id_lokasi` varchar(30) NOT NULL,
  `tot_harga` int(11) NOT NULL,
  `tgl` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ulasan_produk`
--

CREATE TABLE IF NOT EXISTS `ulasan_produk` (
  `id_ulasan` varchar(30) NOT NULL,
  `id_produk` varchar(30) NOT NULL,
  `ulasan` varchar(500) NOT NULL,
  `id_pengguna` varchar(30) NOT NULL,
  `tgl` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `diskusi_produk`
--
ALTER TABLE `diskusi_produk`
 ADD PRIMARY KEY (`id_diskusi`);

--
-- Indexes for table `tb_auth`
--
ALTER TABLE `tb_auth`
 ADD PRIMARY KEY (`id_auth`);

--
-- Indexes for table `tb_belanja`
--
ALTER TABLE `tb_belanja`
 ADD PRIMARY KEY (`id_belanja`);

--
-- Indexes for table `tb_gambarproduk`
--
ALTER TABLE `tb_gambarproduk`
 ADD PRIMARY KEY (`id_gambar`);

--
-- Indexes for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
 ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `tb_kecamatan`
--
ALTER TABLE `tb_kecamatan`
 ADD PRIMARY KEY (`id_kecamatan`);

--
-- Indexes for table `tb_kotamadya`
--
ALTER TABLE `tb_kotamadya`
 ADD PRIMARY KEY (`id_kotamadya`);

--
-- Indexes for table `tb_levelpengguna`
--
ALTER TABLE `tb_levelpengguna`
 ADD PRIMARY KEY (`id_level`);

--
-- Indexes for table `tb_lokasi`
--
ALTER TABLE `tb_lokasi`
 ADD PRIMARY KEY (`id_lokasi`);

--
-- Indexes for table `tb_medsos`
--
ALTER TABLE `tb_medsos`
 ADD PRIMARY KEY (`id_medsos`);

--
-- Indexes for table `tb_medsostoko`
--
ALTER TABLE `tb_medsostoko`
 ADD PRIMARY KEY (`id_medsostoko`);

--
-- Indexes for table `tb_pengguna`
--
ALTER TABLE `tb_pengguna`
 ADD PRIMARY KEY (`id_pengguna`);

--
-- Indexes for table `tb_pesan`
--
ALTER TABLE `tb_pesan`
 ADD PRIMARY KEY (`id_pesan`);

--
-- Indexes for table `tb_produk`
--
ALTER TABLE `tb_produk`
 ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `tb_provinsi`
--
ALTER TABLE `tb_provinsi`
 ADD PRIMARY KEY (`tb_provinsi`);

--
-- Indexes for table `tb_rating`
--
ALTER TABLE `tb_rating`
 ADD PRIMARY KEY (`id_rating`);

--
-- Indexes for table `tb_stmengirim`
--
ALTER TABLE `tb_stmengirim`
 ADD PRIMARY KEY (`id_stmengirim`);

--
-- Indexes for table `tb_stpesan`
--
ALTER TABLE `tb_stpesan`
 ADD PRIMARY KEY (`id_stpesan`);

--
-- Indexes for table `tb_sttoko`
--
ALTER TABLE `tb_sttoko`
 ADD PRIMARY KEY (`id_sttoko`);

--
-- Indexes for table `tb_toko`
--
ALTER TABLE `tb_toko`
 ADD PRIMARY KEY (`id_toko`);

--
-- Indexes for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
 ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `ulasan_produk`
--
ALTER TABLE `ulasan_produk`
 ADD PRIMARY KEY (`id_ulasan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_kecamatan`
--
ALTER TABLE `tb_kecamatan`
MODIFY `id_kecamatan` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_kotamadya`
--
ALTER TABLE `tb_kotamadya`
MODIFY `id_kotamadya` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_provinsi`
--
ALTER TABLE `tb_provinsi`
MODIFY `tb_provinsi` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_sttoko`
--
ALTER TABLE `tb_sttoko`
MODIFY `id_sttoko` int(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
