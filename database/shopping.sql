-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 30, 2024 at 11:52 AM
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
(59, 'GODFREY', 'KIKO', 'godfrey@gmail.com', '$2y$10$PkpA8Xjvw7M1N2i1fufYJ.i.91lktyxyNeWaqKttzm0E5eh7gd2zy', 787234512, 'super', 'UPDZ5W5NCJMZWKXI', '2024-07-30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`Product_id`);

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
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `No` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
