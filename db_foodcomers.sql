-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 17 Mei 2016 pada 12.00
-- Versi Server: 5.6.24
-- PHP Version: 5.6.8

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
-- Struktur dari tabel `diskusi_produk`
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
-- Struktur dari tabel `tb_auth`
--

CREATE TABLE IF NOT EXISTS `tb_auth` (
  `id_auth` varchar(30) NOT NULL,
  `id_pengguna` varchar(30) NOT NULL,
  `ip_address` varchar(50) NOT NULL,
  `mac_address` varchar(50) NOT NULL,
  `status` varchar(1) NOT NULL,
  `tgl` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_belanja`
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
-- Struktur dari tabel `tb_gambarproduk`
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
-- Struktur dari tabel `tb_kategori`
--

CREATE TABLE IF NOT EXISTS `tb_kategori` (
  `id_kategori` int(2) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `keterangan` varchar(500) NOT NULL,
  `gambar` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kecamatan`
--

CREATE TABLE IF NOT EXISTS `tb_kecamatan` (
  `id_kecamatan` int(4) NOT NULL,
  `id_kotamadya` int(4) NOT NULL,
  `nama_kecamatan` varchar(50) NOT NULL,
  `count_toko` int(3) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kotamadya`
--

CREATE TABLE IF NOT EXISTS `tb_kotamadya` (
  `id_kotamadya` int(4) NOT NULL,
  `id_provinsi` int(4) NOT NULL,
  `nama_kotamadya` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_levelpengguna`
--

CREATE TABLE IF NOT EXISTS `tb_levelpengguna` (
  `id_level` int(2) NOT NULL,
  `nama_level` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_levelpengguna`
--

INSERT INTO `tb_levelpengguna` (`id_level`, `nama_level`) VALUES
(1, 'Super Admin'),
(2, 'Penjual'),
(3, 'Pembeli');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_lokasi`
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
-- Struktur dari tabel `tb_medsos`
--

CREATE TABLE IF NOT EXISTS `tb_medsos` (
  `id_medsos` varchar(30) NOT NULL,
  `nama_medsos` varchar(100) NOT NULL,
  `icon` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_medsostoko`
--

CREATE TABLE IF NOT EXISTS `tb_medsostoko` (
  `id_medsostoko` varchar(30) NOT NULL,
  `id_medsos` varchar(30) NOT NULL,
  `id_toko` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengguna`
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

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pesan`
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
-- Struktur dari tabel `tb_produk`
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
-- Struktur dari tabel `tb_provinsi`
--

CREATE TABLE IF NOT EXISTS `tb_provinsi` (
  `tb_provinsi` int(4) NOT NULL,
  `nama_provinsi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_rating`
--

CREATE TABLE IF NOT EXISTS `tb_rating` (
  `id_rating` varchar(30) NOT NULL,
  `id_pengguna` varchar(30) NOT NULL,
  `id_lokasi` varchar(30) NOT NULL,
  `rating` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_stmengirim`
--

CREATE TABLE IF NOT EXISTS `tb_stmengirim` (
  `id_stmengirim` int(2) NOT NULL,
  `stmengirim` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_stmengirim`
--

INSERT INTO `tb_stmengirim` (`id_stmengirim`, `stmengirim`) VALUES
(1, 'Belum Diterima'),
(2, 'Telah Diterima');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_stpesan`
--

CREATE TABLE IF NOT EXISTS `tb_stpesan` (
  `id_stpesan` int(3) NOT NULL,
  `stpesan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_stpesan`
--

INSERT INTO `tb_stpesan` (`id_stpesan`, `stpesan`) VALUES
(1, 'Menunggu Konfirmasi'),
(2, 'Stok Habis'),
(3, 'Stok Ada');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_sttoko`
--

CREATE TABLE IF NOT EXISTS `tb_sttoko` (
  `id_sttoko` int(2) NOT NULL,
  `nama_status` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_sttoko`
--

INSERT INTO `tb_sttoko` (`id_sttoko`, `nama_status`) VALUES
(1, 'Pusat'),
(2, 'Cabang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_toko`
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
-- Struktur dari tabel `tb_transaksi`
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
-- Struktur dari tabel `ulasan_produk`
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
