-- phpMyAdmin SQL Dump
-- version 5.3.0-dev+20220707.a5d60f5698
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 09, 2022 at 07:48 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `donor`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(10) NOT NULL,
  `email` varchar(25) NOT NULL,
  `password` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `password`) VALUES
(1, 'admin', 'admin@gmail.com', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `dokter`
--

CREATE TABLE `dokter` (
  `id` int(11) NOT NULL,
  `nama_dokter` varchar(50) NOT NULL,
  `umur` int(11) NOT NULL,
  `rumah_sakit` varchar(20) NOT NULL,
  `id_posko` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dokter`
--

INSERT INTO `dokter` (`id`, `nama_dokter`, `umur`, `rumah_sakit`, `id_posko`) VALUES
(2, 'Dokter Arum Tri Pamungkas', 45, 'Permata', 1),
(3, 'Dokter Rahmad Arya', 37, 'Prasetya Husada', 2),
(4, 'Dokter Angga Pradana', 35, 'Lavalette', 3),
(5, 'Dokter Frederick Huisand', 36, 'Prima Husada', 4);

-- --------------------------------------------------------

--
-- Table structure for table `pendonor`
--

CREATE TABLE `pendonor` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `golongan_darah` varchar(5) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `id_posko` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pendonor`
--

INSERT INTO `pendonor` (`id`, `nama`, `golongan_darah`, `alamat`, `no_hp`, `id_posko`) VALUES
(38, 'Angga Pradana', 'O', 'Kanigoro Kabupaten Blitar', '082123872625', 1),
(39, 'Ganes Tampan', 'B', 'Kanigoro Kabupaten Blitar', '082123872625', 4);

-- --------------------------------------------------------

--
-- Table structure for table `penerima`
--

CREATE TABLE `penerima` (
  `id` int(11) NOT NULL,
  `nama_penerima` varchar(50) NOT NULL,
  `golongan_darah` varchar(5) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `rumah_sakit` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penerima`
--

INSERT INTO `penerima` (`id`, `nama_penerima`, `golongan_darah`, `alamat`, `no_hp`, `rumah_sakit`) VALUES
(27, 'Daimo kun', 'A', 'Kota Blitar', '082123872625', 'Lavalette');

-- --------------------------------------------------------

--
-- Table structure for table `posko_donor`
--

CREATE TABLE `posko_donor` (
  `id_posko` int(11) NOT NULL,
  `alamat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posko_donor`
--

INSERT INTO `posko_donor` (`id_posko`, `alamat`) VALUES
(1, 'Karangploso Kabupaten Malang'),
(2, 'Sengkaling Kabupaten Malang'),
(3, 'Ketawanggede Kota Malang'),
(4, 'Jalan Mayjen Haryono');

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_darah_keluar`
--

CREATE TABLE `riwayat_darah_keluar` (
  `id` int(11) NOT NULL,
  `nama_penerima` varchar(50) NOT NULL,
  `golongan_darah` varchar(5) NOT NULL,
  `kantong` int(11) NOT NULL,
  `rumah_sakit` varchar(20) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `riwayat_darah_keluar`
--

INSERT INTO `riwayat_darah_keluar` (`id`, `nama_penerima`, `golongan_darah`, `kantong`, `rumah_sakit`, `tanggal`) VALUES
(24, 'Daimo kun', 'A', 1, 'Lavalette', '2022-07-06');

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_darah_masuk`
--

CREATE TABLE `riwayat_darah_masuk` (
  `id` int(11) NOT NULL,
  `id_posko` int(11) NOT NULL,
  `golongan_darah` varchar(5) NOT NULL,
  `kantong` int(11) NOT NULL,
  `rumah_sakit` varchar(20) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `riwayat_darah_masuk`
--

INSERT INTO `riwayat_darah_masuk` (`id`, `id_posko`, `golongan_darah`, `kantong`, `rumah_sakit`, `tanggal`) VALUES
(24, 1, 'A', 10, 'Lavalette', '2022-07-04'),
(26, 2, 'B', 15, 'Permata', '2022-07-05'),
(27, 1, 'B', 15, 'Lavalette', '2022-07-05'),
(28, 1, 'O', 15, 'Permata', '2022-07-05'),
(29, 1, 'B', 12, 'Prasetya Husada', '2022-07-05'),
(30, 1, 'O', 7, 'Prasetya Husada', '2022-07-05'),
(31, 4, 'A', 5, 'Prima Husada', '2022-07-05'),
(32, 3, 'AB', 5, 'Prima Husada', '2022-07-05');

-- --------------------------------------------------------

--
-- Table structure for table `rumah_sakit`
--

CREATE TABLE `rumah_sakit` (
  `rumah_sakit` varchar(20) NOT NULL,
  `darah_a` int(11) NOT NULL,
  `darah_b` int(11) NOT NULL,
  `darah_ab` int(11) NOT NULL,
  `darah_o` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rumah_sakit`
--

INSERT INTO `rumah_sakit` (`rumah_sakit`, `darah_a`, `darah_b`, `darah_ab`, `darah_o`) VALUES
('Lavalette', 8, 15, 0, 0),
('Permata', 0, 15, 0, 15),
('Prasetya Husada', 0, 12, 0, 7),
('Prima Husada', 5, 0, 5, 25);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama` (`nama_dokter`),
  ADD KEY `id_posko` (`id_posko`);

--
-- Indexes for table `pendonor`
--
ALTER TABLE `pendonor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_posko` (`id_posko`);

--
-- Indexes for table `penerima`
--
ALTER TABLE `penerima`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rumah_sakit` (`rumah_sakit`);

--
-- Indexes for table `posko_donor`
--
ALTER TABLE `posko_donor`
  ADD PRIMARY KEY (`id_posko`);

--
-- Indexes for table `riwayat_darah_keluar`
--
ALTER TABLE `riwayat_darah_keluar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rumah_sakit` (`rumah_sakit`);

--
-- Indexes for table `riwayat_darah_masuk`
--
ALTER TABLE `riwayat_darah_masuk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_posko` (`id_posko`),
  ADD KEY `rumah_sakit` (`rumah_sakit`);

--
-- Indexes for table `rumah_sakit`
--
ALTER TABLE `rumah_sakit`
  ADD PRIMARY KEY (`rumah_sakit`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `dokter`
--
ALTER TABLE `dokter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pendonor`
--
ALTER TABLE `pendonor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `penerima`
--
ALTER TABLE `penerima`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `riwayat_darah_keluar`
--
ALTER TABLE `riwayat_darah_keluar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `riwayat_darah_masuk`
--
ALTER TABLE `riwayat_darah_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dokter`
--
ALTER TABLE `dokter`
  ADD CONSTRAINT `dokter_ibfk_1` FOREIGN KEY (`id_posko`) REFERENCES `posko_donor` (`id_posko`);

--
-- Constraints for table `pendonor`
--
ALTER TABLE `pendonor`
  ADD CONSTRAINT `pendonor_ibfk_1` FOREIGN KEY (`id_posko`) REFERENCES `posko_donor` (`id_posko`);

--
-- Constraints for table `penerima`
--
ALTER TABLE `penerima`
  ADD CONSTRAINT `penerima_ibfk_1` FOREIGN KEY (`rumah_sakit`) REFERENCES `rumah_sakit` (`rumah_sakit`);

--
-- Constraints for table `riwayat_darah_keluar`
--
ALTER TABLE `riwayat_darah_keluar`
  ADD CONSTRAINT `riwayat_darah_keluar_ibfk_1` FOREIGN KEY (`rumah_sakit`) REFERENCES `rumah_sakit` (`rumah_sakit`);

--
-- Constraints for table `riwayat_darah_masuk`
--
ALTER TABLE `riwayat_darah_masuk`
  ADD CONSTRAINT `riwayat_darah_masuk_ibfk_1` FOREIGN KEY (`id_posko`) REFERENCES `posko_donor` (`id_posko`),
  ADD CONSTRAINT `riwayat_darah_masuk_ibfk_2` FOREIGN KEY (`rumah_sakit`) REFERENCES `rumah_sakit` (`rumah_sakit`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;



