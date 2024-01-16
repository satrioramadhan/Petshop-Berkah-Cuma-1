-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Jan 16, 2024 at 09:21 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `petshopp`
--

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `alamat` varchar(25) NOT NULL,
  `jabatan` varchar(25) NOT NULL,
  `gender` enum('Laki - laki','Perempuan','','') NOT NULL,
  `kontak` varchar(20) NOT NULL,
  `gaji` int(11) NOT NULL,
  `nik` varchar(50) NOT NULL,
  `is_deleted` varchar(50) NOT NULL,
  `is_acount` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nama`, `alamat`, `jabatan`, `gender`, `kontak`, `gaji`, `nik`, `is_deleted`, `is_acount`) VALUES
(1, 'Faisal Arrahman Pratama', 'Tegal', 'Owner', 'Laki - laki', '2147483647', 120000000, '22090147', 'Y', ''),
(2, 'uhuyy', 'jauhh', 'Sapu Halamann', 'Perempuan', '8345678900', 10000001, '3456789096789011', 'Y', ''),
(3, 'ucup surucup', 'deket', 'owner', 'Laki - laki', '821343232', 1000000, '32414232132', 'Y', ''),
(4, 'harapan bersama', 'deket', 'kasir', 'Laki - laki', '2147483647', 200000, '3234234312', '', ''),
(5, 'otong surotong', 'rumah orang tua', 'owner', 'Laki - laki', '8123455', 100000, '3328188231', '', ''),
(6, 'otong surotong', 'palm asri', 'sapu sapu', 'Laki - laki', '08213432321', 100000, '33281821', 'Y', ''),
(7, 'oneng', 'rumah orang tua', 'kasir', 'Perempuan', '081234532', 100000, '332818323', '', ''),
(8, 'adit', 'randu', 'kasir', 'Laki - laki', '83456789001110', 1000000, '3231', 'Y', ''),
(9, 'adaa', 'asrii', 'obb', 'Laki - laki', '123456', 100000, '3211', '', ''),
(10, 'adaa', 'asrii', 'obb', 'Laki - laki', '123456', 100000, '32311', 'Y', ''),
(11, 'aa', 'aa', 'aa', 'Perempuan', '11', 11, '11', 'Y', ''),
(12, 'eaa', 'ea', 'ea', 'Laki - laki', '33', 33, '33', 'Y', ''),
(13, 'oio', 'oi', 'oi', 'Laki - laki', '9', 9, '9', 'Y', ''),
(14, 'ani1', 'cabawann', 'mandiin kucingg', 'Perempuan', '08234242333', 3000000, '32332443233', 'Y', ''),
(15, 'ajam', 'tegallllll', 'kasir', 'Laki - laki', '082938212', 100000, '332423432323', '', ''),
(16, 'otong', 'deket', 'kasir', 'Laki - laki', '08213432321', 121313, '323423431222', '', ''),
(17, 'fuji', 'deket', 'kasir', 'Laki - laki', '08213432321', 100000, '3234234312222', 'Y', ''),
(18, 'sugengg', 'samping pak rtt', 'sapu halamann', 'Laki - laki', '0895738455', 2000000, '323123211', 'Y', '');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `kontak` int(11) NOT NULL,
  `gender` enum('Laki - laki','Perempuan') NOT NULL,
  `is_deleted` varchar(50) NOT NULL,
  `nik` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama`, `alamat`, `kontak`, `gender`, `is_deleted`, `nik`) VALUES
(1, 'adit', 'deket', 123456, 'Laki - laki', 'Y', '3231'),
(2, 'otong', 'randu gunting', 1, 'Laki - laki', 'Y', '33281821'),
(3, 'oneng', 'Merpati', 2147483647, 'Laki - laki', 'Y', '323423431222'),
(4, 'ucup surucupp', 'rumah orang tua', 2147483647, 'Perempuan', '', '32313234234312'),
(5, 'aditt', 'dekett', 1234566, 'Perempuan', '', '32312'),
(6, 'a', 'a', 2, 'Perempuan', 'Y', '2'),
(7, 'oneng', 'randu', 2147483647, 'Laki - laki', '', '323423431221'),
(8, 'ff', 'ffr', 553, 'Laki - laki', 'Y', '55'),
(9, 'ani', 'cabawan', 2147483647, 'Perempuan', 'Y', '32342353'),
(10, 'gojo', 'rumah sakit', 911, 'Perempuan', '', '3245642342'),
(11, 'jokowii', 'samping pak rww', 2147483647, 'Perempuan', 'Y', '323441233');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(25) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `is_deleted` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `harga`, `stok`, `is_deleted`) VALUES
(11, 'kandang kucingg', 1000000, 1000, 'Y'),
(12, 'seblak', 15000, 0, 'N'),
(13, 'vitamin kucing', 50000, 200, ''),
(14, 'pakan ikan', 20000, 10, ''),
(15, 'pakan ayam', 10000, 50, ''),
(21, 'Pur Ayam', 20000, 10, 'Y'),
(22, 'dedek', 5000, 30, 'N'),
(41, 'mie gacoann', 15000, 1, 'N'),
(99, 'Pakan Adit', 15000, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah_barang` int(100) NOT NULL,
  `total_harga` int(100) NOT NULL,
  `is_deleted` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `tgl_transaksi`, `id_produk`, `jumlah_barang`, `total_harga`, `is_deleted`) VALUES
(3, '2024-01-15', 13, 2, 100000, ''),
(6, '2024-01-15', 99, 3, 45000, ''),
(9, '2024-01-15', 13, 2, 100000, ''),
(10, '2024-01-15', 13, 2, 100000, ''),
(11, '2024-01-15', 15, 1, 100000, ''),
(38, '2024-01-15', 99, 3, 45000, ''),
(40, '2024-01-16', 12, 2, 200000, ''),
(41, '2024-01-16', 99, 2, 30000, ''),
(43, '2024-01-16', 12, 2, 30000, ''),
(44, '2024-01-16', 41, 2, 30000, '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(100) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `id_pegawai`, `username`, `password`) VALUES
(1, 2, 'uhuycuma1', 'satu1nya'),
(3, 15, 'ajam1', 'ajam11'),
(4, 5, 'otong1', 'cuma1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`),
  ADD UNIQUE KEY `nik` (`nik`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`),
  ADD UNIQUE KEY `nik` (`nik`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `transaksi_produk_fk` (`id_produk`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
