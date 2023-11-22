-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 22, 2023 at 09:00 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 7.3.29

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
-- Table structure for table `tenant`
--

CREATE TABLE `tenant` (
  `id` int(3) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `Photo` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tenant`
--

INSERT INTO `tenant` (`id`, `user_id`, `name`, `address`, `Photo`, `phone`) VALUES
(1, 9, 'New Laundry ', 'Jalan Kemanggisan ', '655db3ab83713_2538641266d71672538cb15ca8cd07d4.jpeg', '0812341241'),
(2, 9, 'New Laundry 1', 'Jalan Kemanggisan ', '655db3ab83713_2538641266d71672538cb15ca8cd07d4.jpeg', '0812341412'),
(3, 9, 'New Laundry 2', 'Jalan Kemanggisan ', '655db3ab83713_2538641266d71672538cb15ca8cd07d4.jpeg', '0812341675'),
(4, 9, 'New Laundry 3', 'Jalan Kemanggisan 123', '655db3ab83713_2538641266d71672538cb15ca8cd07d4.jpeg', '0812341473'),
(5, 9, 'New Laundry 10', 'Jalan Kemanggisan 123', '655db3ab83713_2538641266d71672538cb15ca8cd07d4.jpeg', '0812341870'),
(7, 15, 'Apa aja lah ya', 'Apa aja lah ya', '655db3ab83713_2538641266d71672538cb15ca8cd07d4.jpeg', '0812345678');

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
  `role` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `role`) VALUES
(7, 'felix', '$2y$10$1usESoM3cr4zYstRiNgs2um0NawyEC9hD2m.vx8gYy5lj1RwZ4kHu', 'felix@gmail.com', 'buyer'),
(9, 'sokrates', '$2y$10$1usESoM3cr4zYstRiNgs2unK.MS5nSb44zeJEea4zgh5Nn58/4PD2', 'sokrates@gmail.com', 'seller'),
(14, 'phan', '$2y$10$1usESoM3cr4zYstRiNgs2uWBX.ojeBZanas9AQzoxgmm8Bbk5zmOq', 'phan@gmail.com', 'seller'),
(15, 'stephan', '$2y$10$1usESoM3cr4zYstRiNgs2uWAsEpa6MHOToXvGFgj2rtO7urlqy4n.', 'stephan@gmail.com', 'seller');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `laundryservice`
--
ALTER TABLE `laundryservice`
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
-- AUTO_INCREMENT for table `laundryservice`
--
ALTER TABLE `laundryservice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tenant`
--
ALTER TABLE `tenant`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `transactionheader`
--
ALTER TABLE `transactionheader`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
