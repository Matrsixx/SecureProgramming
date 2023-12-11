-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2023 at 08:21 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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
-- Table structure for table `attempt`
--

CREATE TABLE `attempt` (
  `id` int(11) NOT NULL,
  `ip` varchar(25) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attempt`
--

INSERT INTO `attempt` (`id`, `ip`, `timestamp`) VALUES
(1, '192.168.1.1', '2023-11-23 13:05:54'),
(2, '::1', '2023-11-23 13:15:08'),
(3, '::1', '2023-11-23 13:17:19'),
(4, '::1', '2023-11-23 13:17:24'),
(5, '::1', '2023-11-23 13:17:26'),
(7, '::1', '2023-11-23 13:17:33'),
(8, '::1', '2023-11-23 13:19:14'),
(9, '::1', '2023-11-23 13:19:16'),
(10, '::1', '2023-11-23 13:19:17'),
(11, '::1', '2023-11-23 13:19:19'),
(12, '::1', '2023-11-23 13:19:20'),
(13, '::1', '2023-11-23 13:42:02'),
(14, '::1', '2023-11-23 13:53:59'),
(15, '::1', '2023-11-23 14:03:57'),
(16, '::1', '2023-11-23 14:05:45'),
(17, '::1', '2023-11-23 14:06:02'),
(18, '::1', '2023-11-23 14:06:25'),
(24, '::1', '2023-12-11 06:55:04'),
(25, '::1', '2023-12-11 06:55:19'),
(31, '::1', '2023-12-11 07:12:52'),
(32, '::1', '2023-12-11 07:13:37'),
(33, '::1', '2023-12-11 07:20:06'),
(34, '::1', '2023-12-11 07:20:14'),
(35, '::1', '2023-12-11 07:20:19');

-- --------------------------------------------------------

--
-- Table structure for table `laundryservice`
--

CREATE TABLE `laundryservice` (
  `id` int(11) NOT NULL,
  `servicename` varchar(255) NOT NULL,
  `serviceprice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `laundryservice`
--

INSERT INTO `laundryservice` (`id`, `servicename`, `serviceprice`) VALUES
(1, 'cuci sekarang', 5000),
(2, 'cuci besok', 10000);

-- --------------------------------------------------------

--
-- Table structure for table `secret`
--

CREATE TABLE `secret` (
  `id` int(11) NOT NULL,
  `value` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `secret`
--

INSERT INTO `secret` (`id`, `value`, `type`) VALUES
(1, '0x4AAAAAAANj8UN97ZQ7tSm6eHdNWqUSJ5A', 'cloudflare_secret');

-- --------------------------------------------------------

--
-- Table structure for table `tenant`
--

CREATE TABLE `tenant` (
  `id` int(3) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `photo` longtext NOT NULL,
  `phone` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tenant`
--

INSERT INTO `tenant` (`id`, `user_id`, `name`, `address`, `photo`, `phone`) VALUES
(1, 9, 'New Laundry ', 'Jalan Kemanggisan ', '655db3ab83713_2538641266d71672538cb15ca8cd07d4.jpeg', '0812341241'),
(2, 9, 'New Laundry 1', 'Jalan Kemanggisan ', '655db3ab83713_2538641266d71672538cb15ca8cd07d4.jpeg', '0812341412'),
(3, 9, 'New Laundry 2', 'Jalan Kemanggisan ', '655db3ab83713_2538641266d71672538cb15ca8cd07d4.jpeg', '0812341675'),
(4, 9, 'New Laundry 3', 'Jalan Kemanggisan 123', '655db3ab83713_2538641266d71672538cb15ca8cd07d4.jpeg', '0812341473'),
(5, 9, 'New Laundry 10', 'Jalan Kemanggisan 123', '655db3ab83713_2538641266d71672538cb15ca8cd07d4.jpeg', '0812341870'),
(7, 15, 'Apa aja lah ya', 'Apa aja lah ya', '655db3ab83713_2538641266d71672538cb15ca8cd07d4.jpeg', '0812345678'),
(8, 16, 'Admin Tenant', 'Admin Tenant', '655e150f67c74_discord bot.png', '0812345678'),
(9, 17, 'Tenant Ampas', 'alert(\'xss\')', '655e15d6d2f38_discord bot.png', '0812345678');

-- --------------------------------------------------------

--
-- Table structure for table `transactionheader`
--

CREATE TABLE `transactionheader` (
  `id` int(255) NOT NULL,
  `TransactionPrice` int(255) NOT NULL,
  `TransactionDate` date NOT NULL,
  `usersid` int(255) NOT NULL,
  `tenantid` int(255) NOT NULL,
  `TransactionProgress` smallint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactionheader`
--

INSERT INTO `transactionheader` (`id`, `TransactionPrice`, `TransactionDate`, `usersid`, `tenantid`, `TransactionProgress`) VALUES
(1, 20000, '2023-11-22', 7, 2, 1),
(2, 50000, '2023-11-21', 7, 1, 0),
(3, 10000, '2023-11-21', 7, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(3) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(10) DEFAULT NULL,
  `photo` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `role`, `photo`) VALUES
(7, 'felix', '$2y$10$1usESoM3cr4zYstRiNgs2um0NawyEC9hD2m.vx8gYy5lj1RwZ4kHu', 'felix@gmail.com', 'buyer', '655e2329b61c1_welcome-dribbble.gif'),
(9, 'sokrates', '$2y$10$1usESoM3cr4zYstRiNgs2unK.MS5nSb44zeJEea4zgh5Nn58/4PD2', 'sokrates@gmail.com', 'seller', '655f4c5f91176_nyonteq.png'),
(14, 'phan', '$2y$10$1usESoM3cr4zYstRiNgs2uWBX.ojeBZanas9AQzoxgmm8Bbk5zmOq', 'phan@gmail.com', 'seller', '655e2329b61c1_welcome-dribbble.gif'),
(15, 'stephan', '$2y$10$1usESoM3cr4zYstRiNgs2uWAsEpa6MHOToXvGFgj2rtO7urlqy4n.', 'stephan@gmail.com', 'seller', '655e2329b61c1_welcome-dribbble.gif'),
(16, 'admin', '$2y$10$1usESoM3cr4zYstRiNgs2u9zpnaM.ByoI6UIH2BaCBqxTP/4P8eF.', 'admin@gmail.com', 'seller', '655e2329b61c1_welcome-dribbble.gif'),
(17, 'ampas', '$2y$10$1usESoM3cr4zYstRiNgs2uOlCqMHohSkMJuECgBK.lDUu6akoODu.', 'ampas@gmail.com', 'seller', '655e2329b61c1_welcome-dribbble.gif'),
(18, 'bikinbaru', '$2y$10$1usESoM3cr4zYstRiNgs2uzx9KMQP.c7h4VR3cD2LpZEFkaBbrwfW', 'bikinbaru@gmail.com', 'buyer', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attempt`
--
ALTER TABLE `attempt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laundryservice`
--
ALTER TABLE `laundryservice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `secret`
--
ALTER TABLE `secret`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tenant`
--
ALTER TABLE `tenant`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `transactionheader`
--
ALTER TABLE `transactionheader`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usersid` (`usersid`),
  ADD KEY `tenantid` (`tenantid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attempt`
--
ALTER TABLE `attempt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `laundryservice`
--
ALTER TABLE `laundryservice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `secret`
--
ALTER TABLE `secret`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tenant`
--
ALTER TABLE `tenant`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `transactionheader`
--
ALTER TABLE `transactionheader`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tenant`
--
ALTER TABLE `tenant`
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `transactionheader`
--
ALTER TABLE `transactionheader`
  ADD CONSTRAINT `tenantid` FOREIGN KEY (`tenantid`) REFERENCES `tenant` (`id`),
  ADD CONSTRAINT `usersid` FOREIGN KEY (`usersid`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
