-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2025 at 09:00 PM
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
-- Database: `users_conversations`
--

-- --------------------------------------------------------

--
-- Table structure for table `87`
--

CREATE TABLE `87` (
  `id` int(11) NOT NULL,
  `userId` varchar(255) DEFAULT NULL,
  `userName` varchar(255) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `todaysDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `97`
--

CREATE TABLE `97` (
  `id` int(11) NOT NULL,
  `userId` varchar(255) DEFAULT NULL,
  `userName` varchar(255) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `todaysDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `97`
--

INSERT INTO `97` (`id`, `userId`, `userName`, `message`, `todaysDate`) VALUES
(1, '7', 'saugat', 'hawa', '2024-04-15 13:59:06');

-- --------------------------------------------------------

--
-- Table structure for table `107`
--

CREATE TABLE `107` (
  `id` int(11) NOT NULL,
  `userId` varchar(255) DEFAULT NULL,
  `userName` varchar(255) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `todaysDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `107`
--

INSERT INTO `107` (`id`, `userId`, `userName`, `message`, `todaysDate`) VALUES
(3, '7', 'saugat', 'oi dumb fuck', '2024-04-15 14:23:02');

-- --------------------------------------------------------

--
-- Table structure for table `711`
--

CREATE TABLE `711` (
  `id` int(11) NOT NULL,
  `userId` varchar(255) DEFAULT NULL,
  `userName` varchar(255) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `todaysDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `711`
--

INSERT INTO `711` (`id`, `userId`, `userName`, `message`, `todaysDate`) VALUES
(21, '7', 'saugat', 'oioi', '2024-04-11 17:22:49'),
(22, '7', 'saugat', 'huh', '2024-04-12 16:24:30'),
(23, '11', 'power', 'k re', '2024-04-12 16:24:43'),
(24, '7', 'saugat', 'huh', '2024-04-15 12:17:57'),
(25, '7', 'saugat', 'huh', '2024-04-15 12:23:33'),
(26, '7', 'saugat', 'huh', '2024-04-15 12:30:21'),
(27, '7', 'saugat', 'hello', '2024-04-15 12:49:47'),
(28, '7', 'saugat', 'wassup', '2024-04-15 12:49:57'),
(29, '7', 'saugat', 'k re', '2024-04-15 12:59:04'),
(30, '7', 'saugat', 'huh', '2024-04-15 13:17:15'),
(31, '7', 'saugat', 'hey', '2024-04-15 13:48:53'),
(32, '7', 'saugat', 'banyo', '2024-04-15 13:53:11'),
(33, '11', 'power', 'k banyo', '2024-04-15 14:13:38'),
(34, '7', 'saugat', 'function bata data leko', '2024-04-15 14:13:55'),
(35, '11', 'power', 'ye ye good good', '2024-04-15 14:14:07'),
(36, '7', 'saugat', 'k good vanxa', '2024-04-15 14:29:04'),
(37, '7', 'saugat', 'oi', '2024-04-21 11:40:55'),
(38, '7', 'saugat', 'oi', '2024-05-13 14:05:35');

-- --------------------------------------------------------

--
-- Table structure for table `712`
--

CREATE TABLE `712` (
  `id` int(11) NOT NULL,
  `userId` varchar(255) DEFAULT NULL,
  `userName` varchar(255) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `todaysDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `712`
--

INSERT INTO `712` (`id`, `userId`, `userName`, `message`, `todaysDate`) VALUES
(2, '12', 'adish', 'oi saugat', '2024-09-17 14:09:20');

-- --------------------------------------------------------

--
-- Table structure for table `811`
--

CREATE TABLE `811` (
  `id` int(11) NOT NULL,
  `userId` varchar(255) DEFAULT NULL,
  `userName` varchar(255) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `todaysDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `911`
--

CREATE TABLE `911` (
  `id` int(11) NOT NULL,
  `userId` varchar(255) DEFAULT NULL,
  `userName` varchar(255) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `todaysDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `87`
--
ALTER TABLE `87`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `97`
--
ALTER TABLE `97`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `107`
--
ALTER TABLE `107`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `711`
--
ALTER TABLE `711`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `712`
--
ALTER TABLE `712`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `811`
--
ALTER TABLE `811`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `911`
--
ALTER TABLE `911`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `87`
--
ALTER TABLE `87`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `97`
--
ALTER TABLE `97`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `107`
--
ALTER TABLE `107`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `711`
--
ALTER TABLE `711`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `712`
--
ALTER TABLE `712`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `811`
--
ALTER TABLE `811`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `911`
--
ALTER TABLE `911`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
