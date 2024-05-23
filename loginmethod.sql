-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2024 at 07:18 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `loginmethod`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `pass_word` varchar(255) DEFAULT NULL,
  `firstName` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  `user_email` varchar(255) NOT NULL,
  `birthday` date DEFAULT NULL,
  `sex` varchar(255) DEFAULT NULL,
  `user_profile_picture` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `pass_word`, `firstName`, `lastName`, `user_email`, `birthday`, `sex`, `user_profile_picture`) VALUES
(5, 'huhh', '$2y$10$8QtMFrfcmxgzCy7.hDxQU.nUe29axEiOb1cxPxV.icscRjK.lA4dq', 'zayn', 'malik', 'ninaumali88@gmail.com', '1993-01-12', 'Male', 'uploads/OIP.jpg'),
(6, 'za', '$2y$10$odAQeLtZjNyYKcFbcgASJ.KMzod0wlP/9O7uEgWJFhFjHLwZBwEhC', 'Zayn', 'Malik', 'ninaumali88@gmail.com', '1993-01-12', 'Male', 'uploads/OIP_1716340469.jpg'),
(7, 'ni', '$2y$10$cB6Y72T1R1pE.noSpx2g7.hRMT2kRibMWH4SDJZuSsDMpG96zvb6W', 'Niall', 'Horan', 'ninaumali88@gmail.com', '1993-09-13', 'Male', 'uploads/R.jpg'),
(8, 'har', '$2y$10$AhnAxweOV3GuRkYN72GN7eL2Hev33Cut3yV654Qso2vRXHm1Fvm7S', 'Harry', 'Styles', 'bloomumali@gmail.com', '1994-02-01', 'Male', 'uploads/b286382894ed25b4c9fb85894a3e214b.984x984x1.jpg'),
(9, 'lou', '$2y$10$rsg.1ZJUDO5849wF8TpGDur02Wb.hqXhGeoymWxzlXZFFGUiWywva', 'Louis ', 'Tomlinson', 'bloomumali@gmail.com', '1991-12-24', 'Male', 'uploads/03-Louis-Tomlinson-2017-mc-billboard-1548-compressed.jpg'),
(10, 'lia', '$2y$10$CI7DFYXmIHVTJZmhyeujQeL55/BVBnIi4v0iNnm5b.i3p3Rs74zY2', 'Liam', 'Payne', 'bloomumali@gmail.com', '1994-08-29', 'Male', 'uploads/sada.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user_address`
--

CREATE TABLE `user_address` (
  `user_add_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_add_street` varchar(255) DEFAULT NULL,
  `user_add_barangay` varchar(255) DEFAULT NULL,
  `user_add_city` varchar(255) DEFAULT NULL,
  `user_add_province` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_address`
--

INSERT INTO `user_address` (`user_add_id`, `user_id`, `user_add_street`, `user_add_barangay`, `user_add_city`, `user_add_province`) VALUES
(5, 6, 'sunnyvale', 'Bugtong na Pulo', 'Lipa City    ', 'Region IV-A (CALABARZON)    '),
(6, 7, 'HASABS', 'Balagtas', 'Batangas City (Capital)  ', 'Region IV-A (CALABARZON)  '),
(7, 8, 'palm', 'Atilano L. Ricardo', 'Bagac', 'Region III (Central Luzon)'),
(8, 9, 'sadfsf', 'Mabini Ext. (Pob.)', 'Dinalupihan', 'Region III (Central Luzon)'),
(9, 10, 'sdfa', 'Manibaug Libutad', 'Porac', 'Region III (Central Luzon)');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_address`
--
ALTER TABLE `user_address`
  ADD PRIMARY KEY (`user_add_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_address`
--
ALTER TABLE `user_address`
  MODIFY `user_add_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_address`
--
ALTER TABLE `user_address`
  ADD CONSTRAINT `user_address_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
