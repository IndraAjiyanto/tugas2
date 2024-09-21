-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 21, 2024 at 01:24 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pweb2`
--

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `mahasiswa_id` int NOT NULL,
  `nim` varchar(20) NOT NULL,
  `nama_mhs` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_telp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`mahasiswa_id`, `nim`, `nama_mhs`, `alamat`, `email`, `no_telp`) VALUES
(1, '230102083', 'Indra Ajiyanto', 'Ajibarang', 'indraajiyanto052@gmail.com', '0895377383818'),
(2, '23020928772', 'Aji ', 'Ajibarang', 'AjiIndra@gmail.com', '099786543'),
(3, '23020928772', 'inin', 'Cilacap', 'indraa@gmail.com', '9274923');

-- --------------------------------------------------------

--
-- Table structure for table `nilai_perbaikan`
--

CREATE TABLE `nilai_perbaikan` (
  `perbaikan_id` int NOT NULL,
  `tgl_perbaikan` date NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `mahasiswa_id` int NOT NULL,
  `matkul_id` int NOT NULL,
  `semester_id` int NOT NULL,
  `nilai_id` int NOT NULL,
  `dosen_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `nilai_perbaikan`
--

INSERT INTO `nilai_perbaikan` (`perbaikan_id`, `tgl_perbaikan`, `keterangan`, `mahasiswa_id`, `matkul_id`, `semester_id`, `nilai_id`, `dosen_id`) VALUES
(1, '2024-09-11', 'nilai sudah mencukupi', 1, 2, 1, 1, 2),
(2, '2024-09-11', 'nilai lumayan dicukupi', 4, 3, 1, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`mahasiswa_id`);

--
-- Indexes for table `nilai_perbaikan`
--
ALTER TABLE `nilai_perbaikan`
  ADD PRIMARY KEY (`perbaikan_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `mahasiswa_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `nilai_perbaikan`
--
ALTER TABLE `nilai_perbaikan`
  MODIFY `perbaikan_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
