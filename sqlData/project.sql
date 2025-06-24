-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2025 at 08:59 PM
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
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `users_data`
--

CREATE TABLE `users_data` (
  `id` int(11) NOT NULL,
  `userId` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phonenumber` varchar(255) DEFAULT NULL,
  `userProfile` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `DOB` varchar(255) DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `registeredTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `onlineStatus` varchar(50) DEFAULT 'offline'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_data`
--

INSERT INTO `users_data` (`id`, `userId`, `email`, `phonenumber`, `userProfile`, `username`, `password`, `DOB`, `gender`, `registeredTime`, `onlineStatus`) VALUES
(7, '011325676171056782517105678251632024', 'khadkasaugat321@gmail.com', NULL, '20210327224811.jpg', 'saugat', '$2y$10$AW2UimKplBAEtI3eltvJB.d9LwZaTaYKPrR2YkperRKWe/WRCr1I2', '1905-1-1', 'male', '2024-04-15 12:09:34', 'online'),
(8, '022350268171058318717105831871632024', NULL, '9866297539', NULL, 'lado', '$2y$10$WsTFxj3kFRS3FXt9OPX8j.5CPVEgC0uKxB6/8OqQ0kkKbRTufJv5G', '1905-1-1', 'others', '2024-03-19 18:18:50', 'offline'),
(9, '002111014171058322117105832211632024', 'example321@gmail.com', NULL, NULL, 'example', '$2y$10$NKQbZwqmPIBQN0vgoOzAQ.Dwe/s0cW9MeSYa6QNCB/v7SjQx592kS', '1905-1-1', 'male', '2024-03-19 18:18:50', 'offline'),
(10, '123325286171058582717105858271632024', 'fuck321@gmail.com', NULL, '24edb6f691a2cb1ed9c0113e54d13d06.jpg', 'fuck', '$2y$10$jsXEpLsdKtliG70mlAuOdOYueet1swYS/xAhdywoAstNKsrkMnKZG', '1905-1-1', 'others', '2024-03-20 17:29:19', 'offline'),
(11, '110325657171087319717108731971932024', 'power321@gmail.com', NULL, '24689420d67669acd2f0c505474a813f.jpg', 'power', '$2y$10$QWRIYWNM/WKSq9Hbo2ojHeiUmiysnW1FTiEvuaXjjCT1mLoid90na', '1905-8-9', 'others', '2024-05-13 14:06:54', 'offline'),
(12, '013156351172429537717242953772282024', 'adishgang11@gmail.com', NULL, 'Screenshot (61).png', 'adish', '$2y$10$S4Xwia4ypCtjpMB/dWtlVOK/ymFG/K1HCzQt9wzW/IEcJTbMjWdGC', '1905-1-1', 'male', '2024-09-17 14:08:55', 'online');

-- --------------------------------------------------------

--
-- Table structure for table `user_data`
--
-- Error reading structure for table project.user_data: #1932 - Table &#039;project.user_data&#039; doesn&#039;t exist in engine
-- Error reading data for table project.user_data: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near &#039;FROM `project`.`user_data`&#039; at line 1

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users_data`
--
ALTER TABLE `users_data`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users_data`
--
ALTER TABLE `users_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
