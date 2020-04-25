-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2020 at 10:10 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_croit`
--

-- --------------------------------------------------------

--
-- Table structure for table `comenzi`
--

CREATE TABLE `comenzi` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `name` text NOT NULL,
  `region` int(11) NOT NULL,
  `sizes` text NOT NULL,
  `initial_sizes` text NOT NULL,
  `completed` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comenzi`
--

INSERT INTO `comenzi` (`id`, `id_user`, `name`, `region`, `sizes`, `initial_sizes`, `completed`) VALUES
(61, 4, '2', 0, ' 0 0 0 0 0 -1 -10 0 0 0', ' 0 0 0 0 0 33 44 0 0 0', 0);

-- --------------------------------------------------------

--
-- Table structure for table `span`
--

CREATE TABLE `span` (
  `id` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `nr_sheet` int(11) NOT NULL,
  `length` float NOT NULL,
  `piecesPerSize` text NOT NULL,
  `loss` float NOT NULL,
  `plus_piecesPerSize` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `span`
--

INSERT INTO `span` (`id`, `id_order`, `nr_sheet`, `length`, `piecesPerSize`, `loss`, `plus_piecesPerSize`) VALUES
(140, 44, 1, 0, ' 0 1 0 0 1 0 1 0 0 0 1', 0, ' 0 1110 0 0 221 0 332 0 0 0 443'),
(186, 61, 10, 0, ' 0 0 0 0 0 0 1 2 0 0 0', 0, ' 0 0 0 0 0 0 23 24 0 0 0'),
(187, 61, 10, 0, ' 0 0 0 0 0 0 0 1 0 0 0', 0, ' 0 0 0 0 0 0 33 34 0 0 0'),
(188, 61, 13, 0, ' 0 0 0 0 0 0 1 0 0 0 0', 0, ' 0 0 0 0 0 0 20 44 0 0 0'),
(189, 61, 10, 0, ' 0 0 0 0 0 0 1 1 0 0 0', 0, ' 0 0 0 0 0 0 23 34 0 0 0'),
(190, 61, 4, 0, ' 0 0 0 0 0 0 0 1 0 0 0', 0, ' 0 0 0 0 0 0 33 40 0 0 0'),
(191, 61, 1, 0, ' 0 0 0 0 0 0 1 0 0 0 0', 12, ' 0 0 0 0 0 0 32 44 0 0 0'),
(192, 61, 10, 3, ' 0 0 0 0 0 0 0 1 0 0 0', 3.2, ' 0 0 0 0 0 0 -1 -10 0 0 0'),
(193, 61, 0, 3, ' 0 0 0 0 0 0 0 0 0 0 0', 0, ' 0 0 0 0 0 0 -1 0 0 0 0'),
(194, 61, 0, 3.2, ' 0 0 0 0 0 0 0 0 0 0 0', 0, ' 0 0 0 0 0 0 -1 0 0 0 0');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `nume` text NOT NULL,
  `prenume` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `nume`, `prenume`, `password`) VALUES
(3, 'Gheorghe', 'Nicolaescu', 'Gheorghe', '$2y$10$mLouGjmSyMlwgOG6Ejaciu05QEWBS1iiGeAZWXdnileVptlBfq4gy'),
(4, 'mihai', 'Nicolaescu', 'Gheorghe', '$2y$10$Qk6UC5S9KvSNk/ssPkE8L.VKZIGJ.4ZOCRPhe8m7CldjdsCWFb.Q2'),
(5, 'ovidiu', 'Nicolaescu', 'Ovidiu', '$2y$10$.jMQwbTEuwfunHauYMU6aOf5FZ1xG9ZuwexhFL3Q0LImJF4XNpJS6');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comenzi`
--
ALTER TABLE `comenzi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `span`
--
ALTER TABLE `span`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comenzi`
--
ALTER TABLE `comenzi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `span`
--
ALTER TABLE `span`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=195;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
