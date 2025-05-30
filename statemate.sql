-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2025 at 10:50 AM
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
-- Database: `statemate`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `cardCode` varchar(255) NOT NULL,
  `cardName` varchar(255) NOT NULL,
  `mdn` varchar(255) NOT NULL,
  `customer` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `inv_num` varchar(255) NOT NULL,
  `branch` varchar(255) NOT NULL,
  `deliveryDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `down` varchar(255) NOT NULL,
  `terms` varchar(255) NOT NULL,
  `installment` varchar(255) NOT NULL,
  `repo_status` varchar(255) NOT NULL,
  `uds_date` timestamp NULL DEFAULT NULL,
  `uds_no` varchar(255) NOT NULL,
  `redeem_date` timestamp NULL DEFAULT NULL,
  `area` varchar(255) NOT NULL,
  `mainBranch` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `cardCode`, `cardName`, `mdn`, `customer`, `address`, `inv_num`, `branch`, `deliveryDate`, `down`, `terms`, `installment`, `repo_status`, `uds_date`, `uds_no`, `redeem_date`, `area`, `mainBranch`, `created`, `modified`) VALUES
(1, '3863', 'John Doe', '5786', 'John Doe', 'Iloilo City', '3764', 'Showroom', '2025-05-30 01:35:38', '4500', 'COD', '12', 'Good', NULL, '68344567', NULL, 'Iloilo', 'Showroom', '2025-05-30 01:35:38', NULL),
(2, '3569', 'John Wick', '4366', 'John Wick', 'Makati City', '4357', 'Viac', '2025-05-30 02:43:45', '5000', 'Cash', '24', 'Repo', NULL, '4843', NULL, 'Makati', 'Makati', '2025-05-30 02:43:45', NULL),
(3, '3569', 'John Wick', '4366', 'John Wick', 'Makati City', '4357', 'Viac', '2025-05-30 05:48:48', '3500', 'Bank Transfer', '12', 'Good', NULL, '5346', NULL, 'Manila', 'Iloilo', '2025-05-30 05:34:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `customerId` varchar(255) NOT NULL,
  `customerCardCode` varchar(255) NOT NULL,
  `customerCardName` varchar(255) NOT NULL,
  `customerBranch` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `branch` varchar(255) NOT NULL,
  `postingDate` timestamp NULL DEFAULT NULL,
  `createdDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `customerId`, `customerCardCode`, `customerCardName`, `customerBranch`, `author`, `remarks`, `branch`, `postingDate`, `createdDate`, `created`, `modified`) VALUES
(1, '3', '3569', 'John Wick', 'Viac', 'Regine Galimba', 'Well done!', 'Showroom', '2025-05-30 16:00:00', '2025-06-02 16:00:00', '2025-05-30 06:50:34', NULL),
(2, '2', '3569', 'John Wick', 'Viac', 'Merruel Tuvida', 'Well said.', 'Viac', '2025-06-04 16:00:00', '2025-06-25 16:00:00', '2025-05-30 07:57:48', NULL),
(3, '2', '3569', 'John Wick', 'Viac', 'Regine Galimba', 'Hello world!', 'Viac', '2025-06-12 16:00:00', '2025-06-24 16:00:00', '2025-05-30 07:59:38', NULL),
(4, '2', '3569', 'John Wick', 'Viac', 'Jummie Cadapan', 'Thanks rold!', 'Viac', '2025-06-16 16:00:00', '2025-06-07 16:00:00', '2025-05-30 08:02:25', NULL),
(5, '2', '3569', 'John Wick', 'Viac', 'Angelo', 'Mazal', 'Showroom', '2025-06-18 16:00:00', '2025-06-12 16:00:00', '2025-05-30 08:04:24', NULL),
(6, '2', '3569', 'John Wick', 'Viac', 'Charlotte', 'Mazal gyapon', 'Viac', '2025-06-10 16:00:00', '2025-06-20 16:00:00', '2025-05-30 08:05:56', NULL),
(7, '3', '3569', 'John Wick', 'Viac', 'John Wick', 'Hi there!', 'Showroom', '2025-06-15 16:00:00', '2025-08-14 16:00:00', '2025-05-30 08:09:44', NULL),
(8, '1', '3863', 'John Doe', 'Showroom', 'Angela', 'Sample data!', 'Agdao', '2025-06-21 16:00:00', '2025-06-20 16:00:00', '2025-05-30 08:11:40', NULL),
(9, '2', '3569', 'John Wick', 'Viac', 'Angelica', 'Yow!', 'Agdao', '2025-06-04 16:00:00', '2025-06-13 16:00:00', '2025-05-30 08:18:45', NULL),
(10, '1', '3863', 'John Doe', 'Showroom', 'Marcus', 'Callback next week for due date', 'Showroom', '2025-07-10 16:00:00', '2025-08-08 16:00:00', '2025-05-30 08:27:25', NULL),
(11, '1', '3863', 'John Doe', 'Showroom', 'Luca', 'Callback on June 7', 'Agdao', '2025-07-24 16:00:00', '2025-07-20 16:00:00', '2025-05-30 08:29:08', NULL),
(12, '1', '3863', 'John Doe', 'Showroom', 'Robert', 'April 3', 'Agdao', '2025-06-04 16:00:00', '2025-07-04 16:00:00', '2025-05-30 08:32:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `isAdmin` int(11) NOT NULL,
  `dept` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `profile` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstLogin` int(11) NOT NULL,
  `reset` int(11) NOT NULL,
  `disabled` int(11) NOT NULL,
  `q1` varchar(255) NOT NULL,
  `q2` varchar(255) NOT NULL,
  `q3` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `isAdmin`, `dept`, `name`, `profile`, `password`, `firstLogin`, `reset`, `disabled`, `q1`, `q2`, `q3`, `created`, `modified`) VALUES
(1, 0, 'AR', 'Karlalooo', '', '$2y$10$UbGHxDfVwazW7pU1U.wqBeguvCvuasoNcQDvaZkM140HwoPuvxSIi', 1, 1, 0, '', '', '', '2025-05-29 06:38:28', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
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
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
