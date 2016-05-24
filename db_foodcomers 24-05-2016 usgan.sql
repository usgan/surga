-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 24 Mei 2016 pada 10.55
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

--
-- Dumping data untuk tabel `tb_auth`
--

INSERT INTO `tb_auth` (`id_auth`, `id_pengguna`, `ip_address`, `mac_address`, `status`, `tgl`) VALUES
('auth0778', 'user0001', 'qhO4YmegeKNzTOuvZBvAzW/AZSK6kMoYbJlNADO22PSF5w/BBb', 'cQsENkmjgKSxm+8cP/cA5iVnISeMQ0NKmpjBnf5BiT1goolRFY', 'T', '2016-05-19 11:17:06'),
('auth1090', 'user0001', 'vICiJBDdsAWyxw49c4CpU8r5MKsdytTw00Ews9t3c04OjjUID3', 'jWppHF2ykwi6yE2Md+2ELQoS51LZz6akTHJfslAUPdoA1RzGAC', 'T', '2016-05-22 05:10:51'),
('auth1402', 'user0001', 'v4ZYn4g7AHAexShSN8qgKyiZ98I3KDsgqyjqNVQSEb5ZgK4Q9C', 'CvZjBZ8m9fJBbkovp24tpiN5MBj/hWGTf0E8A3MmzyfRBxqAlA', 'T', '2016-05-17 10:27:08'),
('auth1992', 'user0001', 'DTSvv0goKRTrta/tCl1vEFxTVyKGa9YNLTXLoYUJoXoNOXZB0l', 'F/+fSC7AlortWdePaUyTHVbNt9tbsrKyH4hjctKpNre//Tglya', 'T', '2016-05-17 10:28:23'),
('auth2001', 'user0001', 'fVS5T1iuBGFVAgYF6bVL5yjVIooaG1u4xfU0ILidd0BnVtUGId', 'dmtAbD3gmDlnkeXaZ9+2+FLcWhYwP54ABnTCZWa3ksEFuY7xl1', 'T', '2016-05-18 10:51:28'),
('auth2191', 'user0001', 'UvCLvZ5Febju8/yntF+jMwWavN/pWxZ4Zg3xqgvvFvTjlk3Cw3', 'GhZjaVSHXCDPkisLAZpe0/6wRPvPjapQd5zQfogZggRZnk3mM4', 'T', '2016-05-17 10:22:21'),
('auth2388', 'user0001', 'vb7xKX63jEbLfbX5eFFdy/snMB+7lV+hHOeI3xA61jf5vHl5Nx', 'bgeYgarsTqmz3tOoXR8WBhuhxiZW+RG0dXiWPmU3gCJdIq9XuD', 'F', '2016-05-17 10:26:13'),
('auth2546', 'user0001', 'qKf/eOyV1YdGwjXO609ttbAQi4Jaeh69srsl2AXOLA3qsg2aLJ', 'wJT0+g8+9mW2ZsNJ5i+mC3dssPQtknCM0c/jQbEelVN78wy85M', 'T', '2016-05-23 00:24:44'),
('auth3110', 'user0001', 'mo8CnUsRg1EETa+o2cO0aYGlgjmgzIgB3sOik2vnP4oAvAV7c2', 'FIvj1qHZ33Z2H8f5qOLIJetR0qHmQ1RXQUcqFCm2w3d2ojNJkW', 'T', '2016-05-22 00:48:16'),
('auth3479', 'user0001', 'CyBan4XvPJh4qLnj9sv/SraL/m5eviQ8lvJRg4yD7t4WPNHNdM', '7SNjoMM/QQVRg/n8rHK7T4g+d5+NvZnZYH4AzDHaGhNUAevk81', 'T', '2016-05-18 08:20:57'),
('auth4013', 'user0001', '60QPN4Jd/GE9O1BZcaF6JhL+qK8IbIodObc9gRN6brWbTFrY2n', 'nyAZAnLm4veqsFP7mkHYFTYLoippJWBlFV0u1KxLvFP0VRoReu', 'T', '2016-05-17 10:32:29'),
('auth4629', 'user0001', 'fQxiLU9Hx+0RwYGXWX88dFowZ6Y6LvGbIoY7oMAQLNNNpthXPP', 'szSes6F6v57AQXW0o4psPYAIE1x9Elp8wLWe7frMzMwDBrzha4', 'T', '2016-05-18 09:25:20'),
('auth4650', 'user0001', 'KfbJBMNmyp7VvWeJdIHNj1Tg7FQctDLCdIl/qYq5PKU5o0XNsM', 'C/nRBgG1zguwmaejKiiKlSaUZYVKs6dfPhMu8i8QaNpQj85p/6', 'T', '2016-05-18 00:32:02'),
('auth4765', 'user0001', '1Lddyp986HDS2H6ZglBOC2MVRm0c/dWoVZfajDw9wLWwzQlz4I', 'XwLO0wWT1GVU+ya6YMDymd0QJaZzxTHNx2vy3Qlc1HLrOrk/sx', 'T', '2016-05-17 11:21:57'),
('auth5532', 'user0001', 'zsFuyIaSQPxLryFI8FwBMuuKjR2jz/O3fXrUjmqkW/3Cfie5Ff', 'P8rU33OHwh/z0QC3lep7LMzD4+X/9GaLlcujrX5hxalLNLyzUp', 'T', '2016-05-17 10:41:52'),
('auth5982', 'user0001', 'D8bLuveu1/dx9tY/DaJ32QRiKOp8jtndmTTnAA0rQHG7IEpey/', 'th3377oRv1iPpboMyN2XU5pqxVAtoTFvp5I8/bcX0Bp3DPD3Sh', 'T', '2016-05-17 10:21:32'),
('auth6219', 'user0001', '6PBFjAOK0dxBHhLCFRGX45VyrsbH+CY0sRFA3OT4wzwT1avRG7', '4gbMqOm8ZLVSrfGWkjsC9L545VPcGmp88pDOIJIS3r21PIolVW', 'T', '2016-05-19 00:48:37'),
('auth6887', 'user0001', 'NEY7eJVYlB00cF6FxzBnlKHsPg8JmvMCRucDXCdOfNmKyeL4Lh', 'Zz/tJhRMsWhAoCarnt0b1oRVH604/kE9AYf8c65qYQtbwVTwDE', 'T', '2016-05-24 08:05:17'),
('auth6941', 'user0001', 'xcFW/9DkyOd67gtxd4LvghrvAN+tLlCUc+5akD+mK48rrCx/CY', 'iIkX/t+p9YIV7uXm3f60E40n8c1sZK0evl5j9laTIRFNWofIV8', 'T', '2016-05-21 00:59:49'),
('auth6997', 'user0001', 'JObEPWGFScuvzvIdhCVR3fSbsYwH5uL3w3UjzbeBQYrFo1sYS9', 'RsQy4u3/RKzoJLp6qZgj9UZq0KHFUY5ILLubmQzjxBHl+Q3nPT', 'T', '2016-05-24 03:51:08'),
('auth7017', 'user0001', '6nuCOioaJXB7mz0vcP52wj/2P0sN2og2A7iu0c9pnjlB4mGWob', 'UZJuL6w+zZFYCeG96vlW+5W+m3GArqCH0dfCjjoT7qMUNuL7ld', 'T', '2016-05-21 12:58:40'),
('auth7062', 'user0001', 'B7OBxEXWhvC7ouYvfprRSkLtNOKvdX7kar2OH6Mhzy9gqRyqMc', 'idYo5SJGKX41nsdq1GAtb7TBTDN9lJOi1GneiemZnIUv6GHkrE', 'T', '2016-05-18 00:24:25'),
('auth7319', 'user0001', 'nC2WtvizbH8hRREe6iV1HMlHRdwkQK8KY19UNHO8X7gTp9Hlft', 'rFec7YTIjsJqhpCuLtKPOEqgO8MhhcL9Gs/CdCeaaYRfFgRrkO', 'T', '2016-05-21 06:19:58'),
('auth8054', 'user0001', 'oUC/uuV7qfpGHORbe8hAxNbOSfmhJQ8GH30S2iJNXTFQEMircn', 'JMhAebT/llWi3X6RogTEFgnG+qggGS1RKq3bAfr5EXRQZ0rgbQ', 'T', '2016-05-18 00:16:54'),
('auth8478', 'user0001', 'hn7JsfQkwxpb/ouQsu0uO42CfB1x9MOE5jPCnfv2xWY0RViB+1', '4wgUIf2L2gZRgK451Mue3xn8eP2qS4vgC6WWtU3E5HpwMsD6s9', 'T', '2016-05-17 10:30:57'),
('auth9617', 'user0001', 'tX9ii0mYLgwBPxaXFZhlkVlzKUGTSfQviUXCzIxjH1R53XecUI', 'JCLvBUR4aGPJmzwJ6LC2YHiI56s9mF52ABAXLg7qoROm5ia91e', 'T', '2016-05-18 09:14:02'),
('auth9910', 'user0001', 'AlePUihAi8t17u8TOSMoMmpSZwrvj1nIsKobfBo9Xf9yZRozja', 'N7QYnplJ8eJg43I24EQHoQ3f4QXQyK+QDM+OTjOOKh/2Px067/', 'T', '2016-05-19 23:37:17');

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
  `keterangan` varchar(1000) NOT NULL,
  `gambar` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

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
  `nama_level` varchar(50) NOT NULL,
  `statustoko` varchar(1) NOT NULL DEFAULT 'N',
  `keterangan` varchar(1000) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_levelpengguna`
--

INSERT INTO `tb_levelpengguna` (`id_level`, `nama_level`, `statustoko`, `keterangan`) VALUES
(1, 'Super Admin', 'N', ''),
(2, 'Penjual', 'Y', ''),
(3, 'Pembeli', 'N', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_link`
--

CREATE TABLE IF NOT EXISTS `tb_link` (
  `id_url` int(11) NOT NULL,
  `id_level` varchar(2) NOT NULL,
  `url` varchar(50) NOT NULL,
  `fungsi` varchar(50) NOT NULL,
  `keterangan` varchar(1000) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_link`
--

INSERT INTO `tb_link` (`id_url`, `id_level`, `url`, `fungsi`, `keterangan`) VALUES
(1, '1', 'menu/menu', '#', 'tidak memiliki fungsi lain. digunakan hanya untuk admin'),
(2, '1', 'menu/acmenu', '#', 'digunakan untuk menambah menu baru kedalam database'),
(3, '1', 'menu/cmenu', '#', 'digunakan untuk membuka form yang akan digunakan membuat menu baru'),
(4, '1', 'menu/cmpengguna', '#', 'digunakan untuk mengeolompokkan menu yang akan digunakan pada masing-masing tingkatan pengguna'),
(5, '1', 'menu/dmpengguna', '#', 'digunakan untuk menghapus data menu tingkatan pengguna delete menu pengguna -> dmpengguna'),
(6, '1', 'menu/imenu', '#', 'digunakan untuk menampilkan informasi menu informasi menu -> imenu'),
(7, '1', 'menu/dmenu', '#', 'digunakan untuk menghapus data menu pada tb_menu delete menu -> dmenu'),
(8, '1', 'menu/emenu', '#', ' //digunakan untuk membuka halaman edit menu yang digunakan yang telah ada di database -> edit menu -> emenu'),
(9, '1', 'menu/uemenu', '#', 'digunakan untuk mengubah data menu yang telah ada didatabase -> update edit menu -> uemenu'),
(10, '1', 'link/show', '#', 'digunakan untuk menampilkan data link kedalam table'),
(11, '1', 'link/add', '#', 'digunakan untuk menambah link'),
(15, '1', 'link/create', '#', 'digunakan untuk membuat link baru'),
(16, '1', 'link/edit', '#', 'digunakan untuk membuka halaman edit link'),
(17, '1', 'link/update', '#', 'digunakan untuk memperbaharui link'),
(19, '1', 'link/delete', '#', 'perintah yang digunakan untuk menghapus dala link di database'),
(21, '1', 'smenu/show', '#', 'untuk menampilkan daftar link sub menu'),
(22, '1', 'smenu/create', '#', 'digunakan untuk membuka form sub menu baru'),
(23, '1', 'smenu/add', '#', 'digunakan untuk menambah sub menu baru'),
(24, '1', 'smenu/info', '#', 'digunakan untuk mengambil info data pengguna yang menggunakan sub menu'),
(25, '1', 'smenu/delete', '#', 'digunakan untuk menghapus data submenu'),
(26, '1', 'smenu/edit', '#', 'digunakan untuk membuka form edit data sub menu'),
(27, '1', 'smenu/update', '#', 'difunakan untuk memperbaharui data sub menu'),
(28, '1', 'smenu/createspengguna', '#', 'digunakan untuk mendaftarkan pengguna agar dapat mengakses menu ini'),
(29, '1', 'smenu/addsmpengguna', '#', 'digunakan untuk menambah data sub menu pada pengguna'),
(30, '1', 'smenu/deletesmpengguna', '#', 'digunakan untuk menghapus data sub menu pada pengguna'),
(31, '1', 'tpengguna/add', '#', 'digunakan untuk menambah data Tingkat pengguna'),
(32, '1', 'tpengguna/create', '#', 'digunakan untuk membuka form tambah pengguna'),
(33, '1', 'tpengguna/edit', '#', 'digunakan untuk membuka form edit tingkat pengguna'),
(34, '1', 'tpengguna/update', '#', 'perintah yang digunakan untuk memperbaharui data tingkat pengguna'),
(35, '1', 'tpengguna/delete', '#', 'perintah yang digunakan untuk menghapus data tingkat pengguna'),
(36, '1', 'Daftartoko/show', '#', 'digunakan untuk menampilkan data toko yang telah terdaftar'),
(37, '1', 'daftartoko/create', '#', 'digunakan untuk membuka form daftar toko'),
(38, '1', 'daftartoko/add', '#', 'digunakan untuk memasukkan data toko kedalam database'),
(39, '1', 'daftartoko/update', '#', 'digunakan untuk memperbaharui data toko di database'),
(40, '1', 'daftartoko/delete', '#', 'digunakan untuk menghapus data toko di database'),
(41, '1', 'tpengguna/show', '#', 'digunakan untuk menamoilkan data tingkat pengguna'),
(42, '1', 'dpengguna/show', '#', 'digunakan untuk menampilkan data pengguna'),
(43, '1', 'kategori/show', '#', 'digunakan untuk menampilkan data kategori di table'),
(44, '1', 'kategori/create', '#', 'digunakan untuk membuka form kategori untuk membuat kategori baru'),
(45, '1', 'kategori/add', '#', 'digunakan untuk menambah kategori'),
(46, '1', 'kategori/edit', '#', 'digunakan untuk membuka form edit kategori'),
(47, '1', 'kategori/update', '#', 'digunakan untuk memperbaharui data kategori'),
(48, '1', 'kategori/delete', '#', 'perintah yang dilakukan untuk menghapus data kategori'),
(49, '1', 'provinsi/show', '#', 'digunakan untuk menampilkan data provisi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_lmenu`
--

CREATE TABLE IF NOT EXISTS `tb_lmenu` (
  `id_lmenu` int(11) NOT NULL,
  `id_menu` int(4) NOT NULL,
  `id_level` int(2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_lmenu`
--

INSERT INTO `tb_lmenu` (`id_lmenu`, `id_menu`, `id_level`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 4, 2),
(6, 5, 1);

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
-- Struktur dari tabel `tb_lsmenu`
--

CREATE TABLE IF NOT EXISTS `tb_lsmenu` (
  `id_lsmenu` int(11) NOT NULL,
  `id_smenu` int(11) NOT NULL,
  `id_level` int(2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_lsmenu`
--

INSERT INTO `tb_lsmenu` (`id_lsmenu`, `id_smenu`, `id_level`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(5, 10, 1),
(6, 12, 1),
(7, 11, 1),
(8, 13, 1),
(9, 14, 1),
(10, 15, 1),
(11, 16, 1);

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
-- Struktur dari tabel `tb_menu`
--

CREATE TABLE IF NOT EXISTS `tb_menu` (
  `id_menu` int(4) NOT NULL,
  `nama_menu` varchar(100) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `link` varchar(100) NOT NULL,
  `urut` int(4) NOT NULL,
  `punyasub` varchar(1) NOT NULL COMMENT 'Y/N jika punya sub Y jika tidak N',
  `tampil` varchar(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_menu`
--

INSERT INTO `tb_menu` (`id_menu`, `nama_menu`, `icon`, `link`, `urut`, `punyasub`, `tampil`) VALUES
(1, 'Dashboard', 'menu-icon icon-speedometer', 'home/index', 1, 'N', 'Y'),
(2, 'Menu Admin', 'menu-icon icon-speedometer', '#', 2, 'Y', 'Y'),
(3, 'Pengguna', ' ', '#', 3, 'Y', 'Y'),
(4, 'Toko', ' ', '#', 4, 'Y', 'Y'),
(5, 'Data Area', '#', '#', 5, 'Y', 'Y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengguna`
--

CREATE TABLE IF NOT EXISTS `tb_pengguna` (
  `id_pengguna` varchar(30) NOT NULL,
  `id_lokasi` varchar(30) NOT NULL DEFAULT '-',
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
-- Dumping data untuk tabel `tb_pengguna`
--

INSERT INTO `tb_pengguna` (`id_pengguna`, `id_lokasi`, `id_level`, `nama_pengguna`, `password`, `email`, `jenkel`, `foto_pengguna`, `status`, `tgl`) VALUES
('user0001', '-', 1, 'Mk360lg+2OHwuT2WcCK1l+qKj2hnp5vV7OgWjQqGzQvM2pFffg+Q78iVkQPH9KgDVwiDtMdpxv/eIe5KwRWikk0sdnqqX/w7I7+AMPploLQTFx3Gb7yKf0U4P7u2REakE+PvohG2tKEcfsPZTH57sCMReK1s2o+voYzhs84HZvF54jQxl5+JKwEnIAmfG35es8K36F7SOjsShqOqHCF+21hXEy4WtvZzG6BS0czFxfrWPnuWq+H96a37b2UnkUGCgpaMXCli6WL4eM6BYubi0ZSevWerDKQoVzoWBBJcLVA=', '7qswTYdBu4Ad08b3hKU/Py+o07iIcrMO8lJ90mBhXF5sJaa/ihLU3fjhLkq9tTpi6TzNpSHpGJ+4eIe3uASwIFCKWOUjWo7NEvhf2xe1PDdzAgjwjLiRozAAeEedBJDf', 'HdbnSBA90N1opmGCeNgGPDRC8PCH+87LVNK92gphavrOkxIHB6Siio07YYZMjFGTJD6lR/1S1+UmAiG1CxbMW0mo5/6xPtQhf9Hdx8pUBktxtYjbvWj2OikwIYuBNMHNGVCTCKJBl5btkmtTVt+v8t1pcCUNTdhrVX4udok0TD+NeWRP78qveMI9zLsjeJuyKknPzgDnHmrnJFkYpISsC8F3ptddsLgt6IMV34wUKjekVeDfQdsgej/Mfvcrc+0rram9MzDxRwvHDm7Tat/rXtDaNl+CjhsfgSoQ1bBndCc=', 'L', 'default.png', 'active', '2016-05-17 09:58:16'),
('user0002', '-', 1, 'VnvC1j0jfw9IkqMXzIid9b52m44Dc00MhE7QgK+h0MR630JRiNd6zwmI4m9Awy6ce4Ag7WlaeTNg3V3cHyiLmI9zGu5QfTXjy3uOluBEvkUJGdwPOlfsWETu3dQxm3wUBW3/Y/NL8ywFxTK983Cb4RURbAcVhlo1a6e45TdKbshGq59mCr6Sw5CpAGtoLXNjd3lFhb1Vj+WMGC8kfPTrFfx7GJhqGiDjPxaq5PdNVDtxeMECp2obLiU3B5ea0eXereyxp4Z3s0MKMwD+h3VWM4oeHsYSZtqiekpkvXCuDtE=', '+5OfB5KtjDBNi+AogfAJ9iJPOH8YvBntSQfNUCPJ/YXPW5iDR7p8hwJ/HUYDR3zkYBdt6952mp9fHNyKQ1FMRANlE8qRnAeXLGmOUFmwPrDwpVNJcJxKmpxFq8TydvfO', '+D6LmDwzRD3jLaPwQ+8Zu1Do04DyMoFqDplAiRW4vbmv1VYTtmtwgrDiogBDiOzTE8pGOpHnewLaWgbAIEiNXlwUaa7pHsUHXtxeEinBr3YiTdWqXFHNqACwVEOS5VCzO6lQpJrmRJMy/nj2dEG9dXzMm/8RX+SPhBxP1d1AcNRRU5S11PkMJEw1Wk4BVNnDzILLrWCBJOOrwl0VqBTynleU4inYR/9UZ2lIPVTywq41miXmzr9vWrn6V+5RyL4HtFW1QVjkfltb08ntQIBThu4ad9TJCuOVs43JYXLHycw=', 'P', 'default.png', 'active', '2016-05-17 10:00:07');

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
  `id_provinsi` int(4) NOT NULL,
  `nama_provinsi` varchar(50) NOT NULL,
  `kode_provinsi` varchar(10) NOT NULL
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
-- Struktur dari tabel `tb_smenu`
--

CREATE TABLE IF NOT EXISTS `tb_smenu` (
  `id_smenu` int(11) NOT NULL,
  `id_menu` int(4) NOT NULL,
  `nama_smenu` varchar(100) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `link` varchar(100) NOT NULL,
  `urut` int(4) NOT NULL,
  `tampil` varchar(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_smenu`
--

INSERT INTO `tb_smenu` (`id_smenu`, `id_menu`, `nama_smenu`, `icon`, `link`, `urut`, `tampil`) VALUES
(1, 2, 'Menu', '', 'menu/menu', 1, 'Y'),
(2, 2, 'Sub Menu', '', 'smenu/show', 2, 'Y'),
(3, 2, 'Link Pengguna', '', 'link/show', 3, 'Y'),
(10, 4, 'Daftar Toko', ' ', 'daftartoko/show', 2, 'Y'),
(11, 3, 'Tingkat Pengguna', '#', 'tpengguna/show', 1, 'Y'),
(12, 3, 'Data Pengguna', '#', 'dpengguna/show', 2, 'Y'),
(13, 4, 'Kategori', '', 'kategori/show', 1, 'Y'),
(14, 5, 'Provinsi', '#', 'provinsi/show', 1, 'Y'),
(15, 5, 'Kecamatan', '#', 'kecamatan/show', 2, 'Y'),
(16, 5, 'Kotamadya', '#', 'kotamadya/show', 3, 'Y');

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
  `email` varchar(100) NOT NULL,
  `tgl` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nohp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_toko`
--

INSERT INTO `tb_toko` (`id_toko`, `pemilik`, `nama_toko`, `informasi`, `email`, `tgl`, `nohp`) VALUES
('201605221505281', 'usgan', 'toko rabam', '<p>toko muhammad usgan adalah yang terbaik okeoke. aqua timez music terbaik bersama toko online</p>\r\n', 'muhammadusgan@gmail.com', '2016-05-22 07:05:28', '085398253232');

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
-- Indexes for table `tb_link`
--
ALTER TABLE `tb_link`
  ADD PRIMARY KEY (`id_url`);

--
-- Indexes for table `tb_lmenu`
--
ALTER TABLE `tb_lmenu`
  ADD PRIMARY KEY (`id_lmenu`);

--
-- Indexes for table `tb_lokasi`
--
ALTER TABLE `tb_lokasi`
  ADD PRIMARY KEY (`id_lokasi`);

--
-- Indexes for table `tb_lsmenu`
--
ALTER TABLE `tb_lsmenu`
  ADD PRIMARY KEY (`id_lsmenu`);

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
-- Indexes for table `tb_menu`
--
ALTER TABLE `tb_menu`
  ADD PRIMARY KEY (`id_menu`);

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
  ADD PRIMARY KEY (`id_provinsi`);

--
-- Indexes for table `tb_rating`
--
ALTER TABLE `tb_rating`
  ADD PRIMARY KEY (`id_rating`);

--
-- Indexes for table `tb_smenu`
--
ALTER TABLE `tb_smenu`
  ADD PRIMARY KEY (`id_smenu`);

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
-- AUTO_INCREMENT for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  MODIFY `id_kategori` int(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
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
-- AUTO_INCREMENT for table `tb_levelpengguna`
--
ALTER TABLE `tb_levelpengguna`
  MODIFY `id_level` int(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tb_link`
--
ALTER TABLE `tb_link`
  MODIFY `id_url` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT for table `tb_lmenu`
--
ALTER TABLE `tb_lmenu`
  MODIFY `id_lmenu` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tb_lsmenu`
--
ALTER TABLE `tb_lsmenu`
  MODIFY `id_lsmenu` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tb_menu`
--
ALTER TABLE `tb_menu`
  MODIFY `id_menu` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tb_provinsi`
--
ALTER TABLE `tb_provinsi`
  MODIFY `id_provinsi` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_smenu`
--
ALTER TABLE `tb_smenu`
  MODIFY `id_smenu` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `tb_sttoko`
--
ALTER TABLE `tb_sttoko`
  MODIFY `id_sttoko` int(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
