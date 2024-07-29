-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 09, 2024 at 05:01 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gudang`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_barang_keluar`
--

CREATE TABLE `data_barang_keluar` (
  `id_part` int(11) NOT NULL,
  `part_number` int(11) NOT NULL,
  `kode_produksi` varchar(255) NOT NULL,
  `diskripsi` varchar(255) NOT NULL,
  `quatity_total` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `lokasi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_barang_keluar`
--

INSERT INTO `data_barang_keluar` (`id_part`, `part_number`, `kode_produksi`, `diskripsi`, `quatity_total`, `tanggal`, `lokasi`) VALUES
(1, 1, '1998881121', 'Kebutuhan pokok untuk memasak', 5, '2023-12-12 07:50:07', 'Solo');

-- --------------------------------------------------------

--
-- Table structure for table `data_barang_masuk`
--

CREATE TABLE `data_barang_masuk` (
  `id_part` int(11) NOT NULL,
  `production_order` varchar(255) NOT NULL,
  `kode_produksi` varchar(255) NOT NULL,
  `diskripsi` varchar(255) NOT NULL,
  `quatity` int(11) NOT NULL,
  `part_number` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `lokasi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_barang_masuk`
--

INSERT INTO `data_barang_masuk` (`id_part`, `production_order`, `kode_produksi`, `diskripsi`, `quatity`, `part_number`, `tanggal`, `lokasi`) VALUES
(1, 'Minyak Goreng', '1998881121', 'Kebutuhan pokok untuk memasak', 50, 1, '2023-12-11 17:00:00', 'Solo');

-- --------------------------------------------------------

--
-- Table structure for table `data_hasil_produksi`
--

CREATE TABLE `data_hasil_produksi` (
  `id_part` int(11) NOT NULL,
  `part_number` int(11) NOT NULL,
  `kode_produksi` varchar(255) NOT NULL,
  `diskripsi` varchar(255) NOT NULL,
  `quatity_total` int(11) NOT NULL,
  `received` int(11) NOT NULL,
  `rejected` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `lokasi` varchar(255) NOT NULL,
  `ket` varchar(11) NOT NULL,
  `sementara` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_hasil_produksi`
--

INSERT INTO `data_hasil_produksi` (`id_part`, `part_number`, `kode_produksi`, `diskripsi`, `quatity_total`, `received`, `rejected`, `tanggal`, `lokasi`, `ket`, `sementara`) VALUES
(1, 1, '1998881121', 'Kebutuhan pokok untuk memasak', 10, 5, 5, '2023-12-12 07:50:07', 'Solo', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `data_stock_barang`
--

CREATE TABLE `data_stock_barang` (
  `id_part` int(11) NOT NULL,
  `part_number` int(11) NOT NULL,
  `kode_produksi` varchar(255) NOT NULL,
  `diskripsi` varchar(255) NOT NULL,
  `quatity` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `lokasi` varchar(255) NOT NULL,
  `production_order` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_stock_barang`
--

INSERT INTO `data_stock_barang` (`id_part`, `part_number`, `kode_produksi`, `diskripsi`, `quatity`, `tanggal`, `lokasi`, `production_order`) VALUES
(1, 1, '1998881121', 'Kebutuhan pokok untuk memasak', 40, '2023-12-12 07:49:24', 'Solo', 'Minyak Goreng');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`) VALUES
(1, 'anomwisnu13@gmail.com', '$2y$10$wmaqxwH3ANsvLEZVPc6IN.3o.Hc3j81o1xxsq07FrgEyJJZE7zFuq');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_barang_keluar`
--
ALTER TABLE `data_barang_keluar`
  ADD PRIMARY KEY (`id_part`);

--
-- Indexes for table `data_barang_masuk`
--
ALTER TABLE `data_barang_masuk`
  ADD PRIMARY KEY (`id_part`);

--
-- Indexes for table `data_hasil_produksi`
--
ALTER TABLE `data_hasil_produksi`
  ADD PRIMARY KEY (`id_part`);

--
-- Indexes for table `data_stock_barang`
--
ALTER TABLE `data_stock_barang`
  ADD PRIMARY KEY (`id_part`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_barang_keluar`
--
ALTER TABLE `data_barang_keluar`
  MODIFY `id_part` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `data_barang_masuk`
--
ALTER TABLE `data_barang_masuk`
  MODIFY `id_part` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `data_hasil_produksi`
--
ALTER TABLE `data_hasil_produksi`
  MODIFY `id_part` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `data_stock_barang`
--
ALTER TABLE `data_stock_barang`
  MODIFY `id_part` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
