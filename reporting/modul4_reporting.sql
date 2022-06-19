-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Jun 2022 pada 10.50
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `modul4_reporting`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `cogs` bigint(20) NOT NULL,
  `selling_price` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `product`
--

INSERT INTO `product` (`id`, `name`, `qty`, `cogs`, `selling_price`) VALUES
(1, 'Stirling Engine', 11, 110000, 185000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_log`
--

CREATE TABLE `product_log` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `operator` varchar(255) NOT NULL,
  `origin` varchar(255) NOT NULL,
  `destination` varchar(255) DEFAULT NULL,
  `log_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `product_log`
--

INSERT INTO `product_log` (`id`, `product_id`, `qty`, `status`, `operator`, `origin`, `destination`, `log_date`) VALUES
(2, 1, 2, 'arrival', 'Production Staff 1', 'Workstation 3', 'Production', '2022-03-01 07:04:57'),
(4, 1, 5, 'departure', 'Production Staff 1', 'Production', 'Warehouse', '2022-03-01 07:08:30'),
(6, 1, 5, 'finished', 'Operator WS3', 'Workstation 3', NULL, '2022-03-01 07:51:14'),
(7, 1, 5, 'arrival', 'Production Staff 1', 'Workstation 3', 'Production', '2022-03-01 07:51:48'),
(8, 1, 7, 'arrival', 'Ray Soesanto', 'Workstation 3', 'Production', '2022-03-20 07:58:54'),
(9, 1, 5, 'arrival', 'Production Staff 1', 'Workstation 3', 'Production', '2022-03-26 06:14:09'),
(10, 1, 5, 'departure', 'Production Staff 1', 'Production', 'Warehouse', '2022-03-26 06:49:52'),
(11, 1, 7, 'finished', 'Operator WS1', 'Workstation 1', '', '2022-03-26 07:45:37');

-- --------------------------------------------------------

--
-- Struktur dari tabel `raw_material`
--

CREATE TABLE `raw_material` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `raw_material`
--

INSERT INTO `raw_material` (`id`, `name`, `qty`, `price`) VALUES
(2, 'Arm Piston', -3, 100),
(3, 'Cylinder', 5, 100),
(4, 'Foot Box', 5, 100),
(5, 'Piston', 5, 100),
(6, 'Piston Tube', 5, 20);

-- --------------------------------------------------------

--
-- Struktur dari tabel `raw_material_log`
--

CREATE TABLE `raw_material_log` (
  `id` int(11) NOT NULL,
  `raw_material_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `operator` varchar(255) NOT NULL,
  `origin` varchar(255) NOT NULL,
  `destination` varchar(255) NOT NULL,
  `log_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `raw_material_log`
--

INSERT INTO `raw_material_log` (`id`, `raw_material_id`, `qty`, `status`, `operator`, `origin`, `destination`, `log_date`) VALUES
(3, 1, 5, 'arrival', 'Production Staff 1', 'Warehouse', 'Production', '2022-03-01 06:54:42'),
(4, 1, 5, 'departure', 'Production Staff 1', 'Production', 'Workstation 1', '2022-03-01 06:55:02'),
(13, 1, 5, 'arrival', 'Production Supervisor 1', 'Warehouse', 'Production', '2022-03-01 12:04:08'),
(14, 2, 5, 'arrival', 'Production Supervisor 1', 'Warehouse', 'Production', '2022-03-01 12:04:51'),
(15, 3, 5, 'arrival', 'Production Supervisor 1', 'Warehouse', 'Production', '2022-03-01 12:05:02'),
(16, 4, 5, 'arrival', 'Production Supervisor 1', 'Warehouse', 'Production', '2022-03-01 12:05:06'),
(17, 5, 5, 'arrival', 'Production Supervisor 1', 'Warehouse', 'Production', '2022-03-01 12:05:10'),
(18, 2, 1, 'arrival', 'Operator WS1', 'Production', 'Workstation 1', '2022-03-20 08:16:40'),
(19, 2, 5, 'departure', 'Production Staff 1', 'Production', 'Workstation 1', '2022-03-26 06:53:46'),
(20, 2, 1, 'arrival', 'Production Staff 1', 'Warehouse', 'Production', '2022-03-26 06:54:50'),
(21, 2, 4, 'departure', 'Production Staff 1', 'Production', 'Workstation 1', '2022-03-26 06:57:34'),
(22, 2, 2, 'arrival', 'Operator WS1', 'Production', 'Workstation 1', '2022-03-26 07:38:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `role` varchar(100) NOT NULL,
  `workstation` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `name`, `role`, `workstation`) VALUES
(1, 'admin_ensyse', 'e10adc3949ba59abbe56e057f20f883e', 'Admin', 'rl_admin', NULL),
(2, 'productionstaff', 'e10adc3949ba59abbe56e057f20f883e', 'Production Staff 1', 'rl_productionstaff', NULL),
(3, 'productionspv', 'e10adc3949ba59abbe56e057f20f883e', 'Production Supervisor 1', 'rl_productionspv', NULL),
(4, 'operator1', 'e10adc3949ba59abbe56e057f20f883e', 'Operator WS1', 'rl_workstation', 'Workstation 1'),
(5, 'operator2', 'e10adc3949ba59abbe56e057f20f883e', 'Operator WS2', 'rl_workstation', 'Workstation 2'),
(6, 'operator3', 'e10adc3949ba59abbe56e057f20f883e', 'Operator WS3', 'rl_workstation', 'Workstation 3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `wip`
--

CREATE TABLE `wip` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `wip`
--

INSERT INTO `wip` (`id`, `name`, `qty`) VALUES
(1, 'Piston Tube Assembly', 0),
(2, 'Small Piston Tube Assembly', 0),
(3, 'Final Assembly Stirling Machine', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `wip_detail`
--

CREATE TABLE `wip_detail` (
  `id` int(11) NOT NULL,
  `wip_id` int(11) NOT NULL,
  `raw_material_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `wip_detail`
--

INSERT INTO `wip_detail` (`id`, `wip_id`, `raw_material_id`, `qty`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 1),
(3, 1, 3, 1),
(4, 1, 4, 1),
(5, 1, 5, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `wip_log`
--

CREATE TABLE `wip_log` (
  `id` int(11) NOT NULL,
  `wip_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `operator` varchar(255) NOT NULL,
  `origin` varchar(255) NOT NULL,
  `destination` varchar(255) DEFAULT NULL,
  `log_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `wip_log`
--

INSERT INTO `wip_log` (`id`, `wip_id`, `qty`, `status`, `operator`, `origin`, `destination`, `log_date`) VALUES
(4, 1, 1, 'arrival', 'Operator WS3', 'Workstation 1', 'Workstation 3', '2022-03-01 07:29:08'),
(11, 1, 5, 'finished', 'Operator WS1', 'Workstation 1', '', '2022-03-01 07:40:09'),
(12, 2, 5, 'finished', 'Operator WS2', 'Workstation 2', '', '2022-03-01 07:40:35'),
(13, 1, 5, 'arrival', 'Operator WS3', 'Workstation 1', 'Workstation 3', '2022-03-01 07:43:24'),
(14, 2, 5, 'arrival', 'Operator WS3', 'Workstation 2', 'Workstation 3', '2022-03-01 07:43:41'),
(15, 1, 4, 'arrival', 'Operator WS1', 'Production', 'Workstation 1', '2022-03-26 07:40:40'),
(16, 1, 4, 'finished', 'Operator WS1', 'Workstation 1', '', '2022-03-26 07:42:55');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `product_log`
--
ALTER TABLE `product_log`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `raw_material`
--
ALTER TABLE `raw_material`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `raw_material_log`
--
ALTER TABLE `raw_material_log`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `wip`
--
ALTER TABLE `wip`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `wip_detail`
--
ALTER TABLE `wip_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `wip_log`
--
ALTER TABLE `wip_log`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `product_log`
--
ALTER TABLE `product_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `raw_material`
--
ALTER TABLE `raw_material`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `raw_material_log`
--
ALTER TABLE `raw_material_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `wip`
--
ALTER TABLE `wip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `wip_detail`
--
ALTER TABLE `wip_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `wip_log`
--
ALTER TABLE `wip_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
