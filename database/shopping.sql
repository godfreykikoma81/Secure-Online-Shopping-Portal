-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 25, 2024 at 01:11 PM
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
-- Database: `shopping`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `user_id` int(10) NOT NULL,
  `Product_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`user_id`, `Product_id`) VALUES
(25, 16),
(25, 16),
(25, 18),
(25, 21),
(26, 15),
(26, 22),
(25, 17),
(52, 15),
(52, 16),
(51, 15),
(51, 15),
(51, 17),
(51, 15),
(51, 16),
(51, 16),
(51, 16),
(55, 17),
(55, 18),
(55, 16),
(56, 21),
(56, 27),
(56, 16),
(57, 26),
(57, 25),
(57, 24),
(58, 27),
(58, 26),
(58, 25);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `Product_id` int(10) NOT NULL,
  `Product_Name` varchar(20) NOT NULL,
  `Product_Picture` varchar(1000) NOT NULL,
  `Product_Price` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`Product_id`, `Product_Name`, `Product_Picture`, `Product_Price`) VALUES
(15, 'infinix hot 10i', '664a6de48a8d0.jpeg', '270000'),
(16, 'watch', '664a6e0783627.jpeg', '30000'),
(17, 'T-ShIrt', '664bc1b9a7e15.jpeg', '20000'),
(18, 'T-ShIrt', '664bc1e1bb98d.jpeg', '22000'),
(19, 'T-ShIrt', '664bc1f50e315.jpeg', '20000'),
(20, 'Suit', '664bc2386d3d3.jpeg', '150000'),
(21, 'Laptop', '664bc2759ad81.jpeg', '1500000'),
(23, 'watch2', '66596ae85b559.jpeg', '15000'),
(24, 'camera', '6671306cb96ff.jpeg', '150000'),
(25, 'watch', '667d2d516b06d.jpg', '50000'),
(26, 'Camera', '667d2d911aa4b.jpg', '250000'),
(27, 'watch', '667d2dc567303.jpg', '25000');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `log_Id` int(10) NOT NULL,
  `User_Id` int(10) NOT NULL,
  `action` varchar(50) NOT NULL,
  `timestamp` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`log_Id`, `User_Id`, `action`, `timestamp`) VALUES
(1, 51, 'login', '2024-06-26'),
(2, 51, 'logout', '2024-06-26'),
(3, 43, 'login', '2024-06-26'),
(4, 43, 'login', '2024-06-27'),
(5, 43, 'logout', '2024-06-27'),
(6, 43, 'login', '2024-06-27'),
(7, 43, 'logout', '2024-06-27'),
(8, 55, 'login', '2024-06-27'),
(9, 55, 'logout', '2024-06-27'),
(10, 43, 'login', '2024-06-27'),
(11, 43, 'logout', '2024-06-27'),
(12, 55, 'login', '2024-06-27'),
(13, 55, 'logout', '2024-06-27'),
(14, 56, 'login', '2024-06-27'),
(15, 56, 'logout', '2024-06-27'),
(16, 43, 'login', '2024-06-27'),
(17, 43, 'logout', '2024-06-27'),
(18, 55, 'login', '2024-06-27'),
(19, 55, 'logout', '2024-06-27'),
(20, 43, 'login', '2024-06-27'),
(21, 57, 'login', '2024-06-29'),
(22, 57, 'logout', '2024-06-29'),
(23, 43, 'login', '2024-06-29'),
(24, 43, 'logout', '2024-06-29'),
(25, 43, 'login', '2024-06-29'),
(26, 43, 'logout', '2024-06-29'),
(27, 43, 'login', '2024-06-29'),
(28, 43, 'logout', '2024-06-29'),
(29, 58, 'login', '2024-06-29'),
(30, 58, 'logout', '2024-06-29');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `No` int(10) NOT NULL,
  `firstName` varchar(20) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `phone` int(11) NOT NULL,
  `privilege` varchar(6) NOT NULL,
  `secret` varchar(16) NOT NULL,
  `Created` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`No`, `firstName`, `lastName`, `email`, `password`, `phone`, `privilege`, `secret`, `Created`) VALUES
(43, 'GODFREY', 'KIKOMA', 'godfrey@gmail.com', '$2y$10$khR6H3zkckKx8PjEtunfou0QWKtTci/aaCY1kZHYTekmJu3YBaDVa', 782345480, 'super', 'SQ52BEXFPMT3ULQY', '2024-05-25'),
(55, 'ERIC', 'KIKO', 'eric@gmail.com', '$2y$10$57DHMVSXxm4kmcefL3wqkeRf8dgPCH5/B9cQH6V/MFuDcA/1wIBtG', 787230434, 'normal', '7OKUYJ34M3ZK7A4Q', '2024-06-27'),
(56, 'fulgens', 'charles', 'fulgens@gmail.com', '$2y$10$lkhaIkGiBz5WNjJwitciZukko4VvG5BKQGx3lO1wPb4l4IWXLZBuu', 787232323, 'normal', 'TKMPJ2H6DDN36OHA', '2024-06-27'),
(58, 'GERALD', 'KIKO', 'gela@gmail.com', '$2y$10$Alc/3gc62F4mvVxHh6bMReEG4j759WtWFIHaDmuk4wwgudYY9bmtm', 787230480, 'normal', 'BMLOTD6R7JVMXCOO', '2024-06-29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`Product_id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`log_Id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`No`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `Product_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `log_Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `No` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
