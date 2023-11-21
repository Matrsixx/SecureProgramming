-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2023 at 12:57 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dry-it`
--

-- --------------------------------------------------------

--
-- Table structure for table `tenant`
--

CREATE TABLE `tenant` (
  `id` int(3) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `Photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tenant`
--

INSERT INTO `tenant` (`id`, `name`, `address`, `Photo`) VALUES
(1, 'New Laundry ', 'Jalan Kemanggisan ', 'https://media.discordapp.net/attachments/524461320314028052/1093157739561242695/20230228_154831.jpg?width=568&height=426'),
(2, 'New Laundry 1', 'Jalan Kemanggisan ', 'https://media.discordapp.net/attachments/524461320314028052/1093157739561242695/20230228_154831.jpg?width=568&height=426'),
(3, 'New Laundry 2', 'Jalan Kemanggisan ', 'https://media.discordapp.net/attachments/524461320314028052/1093157739561242695/20230228_154831.jpg?width=568&height=426'),
(4, 'New Laundry 3', 'Jalan Kemanggisan 123', 'https://media.discordapp.net/attachments/524461320314028052/1093157739561242695/20230228_154831.jpg?width=568&height=426'),
(5, 'New Laundry 10', 'Jalan Kemanggisan 123', 'https://media.discordapp.net/attachments/524461320314028052/1093157739561242695/20230228_154831.jpg?width=568&height=426');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(3) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tenant`
--
ALTER TABLE `tenant`
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
-- AUTO_INCREMENT for table `tenant`
--
ALTER TABLE `tenant`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
