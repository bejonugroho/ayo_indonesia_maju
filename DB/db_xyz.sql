-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 31 Mei 2020 pada 00.51
-- Versi Server: 5.6.25
-- PHP Version: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_xyz`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_jadwal`
--

CREATE TABLE IF NOT EXISTS `detail_jadwal` (
  `id` int(11) NOT NULL,
  `id_jadwal` int(11) DEFAULT NULL,
  `id_tim` int(11) DEFAULT NULL,
  `skor` varchar(50) DEFAULT NULL,
  `gol` varchar(50) DEFAULT NULL,
  `waktu_gol` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_jadwal`
--

INSERT INTO `detail_jadwal` (`id`, `id_jadwal`, `id_tim`, `skor`, `gol`, `waktu_gol`) VALUES
(1, 1, 13, '1 - 0', '4', '54'),
(3, 1, 13, '2 - 0', '4', '77');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal`
--

CREATE TABLE IF NOT EXISTS `jadwal` (
  `id` int(11) NOT NULL,
  `tgl_pertandingan` datetime DEFAULT NULL,
  `id_tim` int(11) DEFAULT NULL,
  `id_tim_2` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `home` varchar(50) DEFAULT NULL,
  `away` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jadwal`
--

INSERT INTO `jadwal` (`id`, `tgl_pertandingan`, `id_tim`, `id_tim_2`, `status`, `home`, `away`) VALUES
(1, '2020-05-30 18:00:00', 13, 17, 1, 'PERSIJA', 'PERSIPURA'),
(2, '2020-06-10 18:00:00', 13, 17, 1, 'PERSIJA', 'PERSIPURA');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_informasi_tim`
--

CREATE TABLE IF NOT EXISTS `tbl_informasi_tim` (
  `id` int(11) NOT NULL,
  `nama_tim` varchar(50) NOT NULL,
  `logo_tim` varchar(50) NOT NULL,
  `tahun_berdiri` year(4) NOT NULL,
  `alamat_markas` varchar(50) NOT NULL,
  `kota_markas` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_informasi_tim`
--

INSERT INTO `tbl_informasi_tim` (`id`, `nama_tim`, `logo_tim`, `tahun_berdiri`, `alamat_markas`, `kota_markas`) VALUES
(13, 'PERSIJA', 'PERSIJA.jpg', 1928, 'jl.Senayan', 'jakarta'),
(14, 'PERSITA', 'PERSITA.jpg', 1923, 'Jl.Cikuya', 'Tangerang'),
(15, 'PERSIB', 'PERSIB.jpg', 1917, 'Jl.Siliwangi', 'bandung'),
(17, 'PERSIPURA', '', 0000, '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pemain`
--

CREATE TABLE IF NOT EXISTS `tbl_pemain` (
  `id` int(11) NOT NULL,
  `id_tim` int(11) NOT NULL,
  `nama_pemain` varchar(50) NOT NULL,
  `tinggi_badan` int(5) NOT NULL,
  `berat_badan` int(5) NOT NULL,
  `posisi_pemain` enum('Penyerang','Gelandang','Bertahan','Penjaga Gawang') NOT NULL,
  `nomor_punggung` int(2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_pemain`
--

INSERT INTO `tbl_pemain` (`id`, `id_tim`, `nama_pemain`, `tinggi_badan`, `berat_badan`, `posisi_pemain`, `nomor_punggung`) VALUES
(1, 13, 'Ansyari Lubis', 189, 78, 'Gelandang', 7),
(2, 14, 'Komang Mariawan S', 190, 67, 'Penyerang', 10),
(3, 17, 'Boas Salosa', 189, 77, 'Penyerang', 11),
(4, 13, 'Indrianto N', 189, 78, 'Penyerang', 9);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `email`, `password`, `level`) VALUES
(1, 'bejo@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_jadwal`
--
ALTER TABLE `detail_jadwal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_informasi_tim`
--
ALTER TABLE `tbl_informasi_tim`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_pemain`
--
ALTER TABLE `tbl_pemain`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_jadwal`
--
ALTER TABLE `detail_jadwal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_informasi_tim`
--
ALTER TABLE `tbl_informasi_tim`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `tbl_pemain`
--
ALTER TABLE `tbl_pemain`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
