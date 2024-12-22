-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 22, 2024 at 09:35 PM
-- Server version: 5.7.24
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vikings`
--

-- --------------------------------------------------------

--
-- Table structure for table `viking`
--

CREATE TABLE `viking` (
  `id` int(11) NOT NULL,
  `name` varchar(16) NOT NULL,
  `attack` int(11) NOT NULL,
  `defense` int(11) NOT NULL,
  `health` int(11) NOT NULL,
  `password` varchar(512) DEFAULT NULL,
  `token` varchar(128) DEFAULT NULL,
  `expiration` datetime DEFAULT NULL,
  `weaponId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `viking`
--

INSERT INTO `viking` (`id`, `name`, `attack`, `defense`, `health`, `password`, `token`, `expiration`, `weaponId`) VALUES
(3, 'Kratoss', 350, 200, 100, 'azerty', NULL, NULL, 6),
(16, 'Kratosa', 390, 180, 80, 'azerty', '4be097dfce0edc7c0de128e7bb00a1bd7e88ae0a3fcff70ad2c8545b4ed855703b09bce1649e78144f2deca2dff05e70e0d6624426e61ed33cce2e4226ebf7cb', '2024-12-18 13:29:19', 6),
(18, 'Kratosa', 390, 180, 80, 'azerty', NULL, NULL, 6),
(19, 'Kratosa', 390, 180, 80, 'azerty', NULL, NULL, 6),
(20, 'Kratosa', 390, 180, 80, 'azerty', NULL, NULL, 6),
(21, 'Kratosa', 390, 180, 80, 'azerty', NULL, NULL, NULL),
(22, 'Kratosa', 390, 180, 80, 'azerty', NULL, NULL, NULL),
(23, 'Kratosa', 390, 180, 80, 'azerty', NULL, NULL, NULL),
(24, 'Kratosa', 390, 180, 80, 'azerty', NULL, NULL, NULL),
(25, 'Kratosa', 390, 180, 80, 'azerty', NULL, NULL, NULL),
(26, 'Kratosa', 390, 180, 80, 'azerty', NULL, NULL, 6),
(27, 'Kratosa', 390, 180, 80, 'azerty', NULL, NULL, 6),
(28, 'Kratosa', 390, 180, 80, 'azerty', NULL, NULL, NULL),
(29, 'Kratosa', 390, 180, 80, 'azerty', NULL, NULL, NULL),
(30, 'Kratosa', 390, 180, 80, 'azerty', NULL, NULL, NULL),
(31, 'Kratosa', 390, 180, 80, 'azerty', NULL, NULL, NULL),
(32, 'Kratosa', 390, 180, 80, 'azerty', NULL, NULL, NULL),
(33, 'Kratosa', 390, 180, 80, 'azerty', NULL, NULL, NULL),
(34, 'Kratosa', 390, 180, 80, 'azerty', NULL, NULL, NULL),
(35, 'Kratosa', 390, 180, 80, 'azerty', NULL, NULL, NULL),
(36, 'Kratosa', 390, 180, 80, 'azerty', NULL, NULL, NULL),
(37, 'Kratosa', 390, 180, 80, 'azerty', NULL, NULL, NULL),
(38, 'Kratosa', 390, 180, 80, 'azerty', NULL, NULL, 6),
(39, 'Kratosa', 390, 180, 80, 'azerty', NULL, NULL, 6);

-- --------------------------------------------------------

--
-- Table structure for table `weapon`
--

CREATE TABLE `weapon` (
  `id` int(11) NOT NULL,
  `type` varchar(16) NOT NULL,
  `damage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `weapon`
--

INSERT INTO `weapon` (`id`, `type`, `damage`) VALUES
(6, 'Bare hands', 1),
(7, 'Axe', 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `viking`
--
ALTER TABLE `viking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_weapon` (`weaponId`);

--
-- Indexes for table `weapon`
--
ALTER TABLE `weapon`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `viking`
--
ALTER TABLE `viking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `weapon`
--
ALTER TABLE `weapon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `viking`
--
ALTER TABLE `viking`
  ADD CONSTRAINT `fk_weapon` FOREIGN KEY (`weaponId`) REFERENCES `weapon` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
