-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 15, 2024 at 03:44 AM
-- Server version: 5.7.17-log
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;


--
-- Database: `magang`
--

-- --------------------------------------------------------

--
-- Table structure for table `magang`
--

CREATE TABLE `magang` (
  `id_magang` varchar(20) NOT NULL,
  `id_mahasiswa` varchar(20) NOT NULL,
  `tgl` date NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `bagian` varchar(50) NOT NULL,
  `keterangan` text NOT NULL,
  `status` varchar(20) NOT NULL,
  `tanggapan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `magang`
--

INSERT INTO `magang` (`id_magang`, `id_mahasiswa`, `tgl`, `tgl_mulai`, `tgl_selesai`, `bagian`, `keterangan`, `status`, `tanggapan`) VALUES
('2405140001902', '2', '2024-05-14', '2024-05-03', '2024-05-13', 'IT', 'melakukan kegiatan magang dari kampus', 'Selesai', ''),
('2405140002118', '3', '2024-05-14', '2024-05-05', '2024-05-15', 'IT', 'melakukan kegiatan magang dari kampus', 'Selesai', ''),
('2405150003302', '5', '2024-05-15', '2024-05-02', '2024-05-12', 'IT', 'melakukan kegiatan magang dari kampus', 'Selesai', '');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id_mahasiswa` int(11) NOT NULL,
  `nim` varchar(20) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `jurusan` varchar(30) NOT NULL,
  `kampus` varchar(30) NOT NULL,
  `telp` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id_mahasiswa`, `nim`, `nama`, `jurusan`, `kampus`, `telp`, `alamat`, `username`, `password`) VALUES
(1, '202049019', 'Ojan Setiawan', 'Komputerisasi Akuntansi', 'Universitas Sriwijaya', '081284930090', 'Jl. Kancil Putih Komplek Melati Blok.C No.1182', 'ojan', '12345'),
(2, '202109283', 'Yunita Pratiwi', 'Sistem Informasi', 'Universitas Sriwijaya', '081383002984', 'Jl. Letkol Iskandar Lr.Sepakat No.309', 'yunita', '12345'),
(3, '201983736', 'Komarudin Asegaf', 'Komputer', 'Universitas Bina Dharma', '082193839200', 'Jl. Tapak Siring Perumahan Cempaka Blok.A No.781', 'komar', '12345'),
(4, '202002918', 'Aji Masaji', 'Komputerisasi Akuntansi', 'Universitas Sriwijaya', '082302918920', 'Jl. Kertapati Lr.Kancil No.599', 'aji', '12345'),
(5, '202103928', 'Rani Rahardian', 'Komputerisasi Akuntansi', 'Universitas Sriwijaya', '081194892091', 'Jl. Macan Lindungan No.513', 'rani', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `sertifikat`
--

CREATE TABLE `sertifikat` (
  `id_sertifikat` int(11) NOT NULL,
  `id_magang` varchar(20) NOT NULL,
  `tgl_sertifikat` date NOT NULL,
  `nilai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sertifikat`
--

INSERT INTO `sertifikat` (`id_sertifikat`, `id_magang`, `tgl_sertifikat`, `nilai`) VALUES
(1, '2147483647', '2024-05-15', 80),
(2, '2147483647', '2024-05-14', 90),
(3, '2405140001902', '2024-05-14', 75),
(4, '2405140002118', '2024-05-14', 85),
(5, '2405150003302', '2024-05-14', 90);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `akses` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `magang`
--
ALTER TABLE `magang`
  ADD PRIMARY KEY (`id_magang`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id_mahasiswa`);

--
-- Indexes for table `sertifikat`
--
ALTER TABLE `sertifikat`
  ADD PRIMARY KEY (`id_sertifikat`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id_mahasiswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `sertifikat`
--
ALTER TABLE `sertifikat`
  MODIFY `id_sertifikat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
