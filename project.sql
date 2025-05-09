-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2025 at 06:04 PM
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
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `itemId` int(10) NOT NULL,
  `itemImage` varchar(150) NOT NULL,
  `itemName` varchar(200) NOT NULL,
  `itemPrice` int(10) NOT NULL,
  `itemQuantity` int(10) NOT NULL,
  `userEmail` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(255) NOT NULL,
  `UserName` varchar(255) NOT NULL,
  `userEmail` varchar(255) NOT NULL,
  `userPhoneNumber` int(255) NOT NULL,
  `orderStatus` varchar(255) NOT NULL,
  `deliveryStatus` varchar(255) NOT NULL,
  `orderImage` varchar(255) NOT NULL,
  `orderName` varchar(255) NOT NULL,
  `orderPrice` int(255) NOT NULL,
  `orderQuantity` int(255) NOT NULL,
  `totalPrice` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productId` int(10) NOT NULL,
  `productImage` varchar(400) NOT NULL,
  `productName` varchar(100) NOT NULL,
  `productPrice` int(10) NOT NULL,
  `productQuantity` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productId`, `productImage`, `productName`, `productPrice`, `productQuantity`) VALUES
(1, '01.jpg', 'Brand New i3 third gen laptop', 68000, 100),
(2, '02.jpg', 'i5 third gen system unit with a RGB fans', 45000, 99),
(3, '03.jpg', 'Brand new i5 fifth gen laptop', 85000, 100),
(4, '15.jpg', 'RPM Euro games Gaming keyboard', 7500, 100),
(6, '11.jpg', 'MSI H110 Brand New Motherboard', 22000, 100);

-- --------------------------------------------------------

--
-- Table structure for table `productall`
--

CREATE TABLE `productall` (
  `productId` int(11) NOT NULL,
  `productImage` varchar(100) NOT NULL,
  `productTitle` varchar(200) NOT NULL,
  `productPrice` int(20) NOT NULL,
  `productQuantity` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `productall`
--

INSERT INTO `productall` (`productId`, `productImage`, `productTitle`, `productPrice`, `productQuantity`) VALUES
(1, '01.jpg', 'Brand New i3 third gen laptop', 60000, 100),
(2, '02.jpg', 'i5 third gen system unit with a RGB fans', 45000, 100),
(3, '03.jpg', 'Brand new i5 fifth gen laptop', 85000, 100),
(4, '15.jpg', 'RPM Euro games Gaming keyboard', 7500, 100);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userId` int(14) NOT NULL,
  `userName` varchar(100) NOT NULL,
  `userEmail` varchar(100) NOT NULL,
  `userPwd` varchar(500) NOT NULL,
  `userJobRoll` varchar(50) NOT NULL,
  `userImage` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userId`, `userName`, `userEmail`, `userPwd`, `userJobRoll`, `userImage`) VALUES
(2, 'Lakshan', 'lakshandananjana253@gmail.com', '$2y$10$9O.hRP6TV1DaW.h5s4ktB.0Zw8nzKPTjlHqs7Mh0DH5HvMKuxpknK', 'user', NULL),
(3, 'lakshan', 'lakshandananjana253@admin.com', '$2y$10$UAX.Ve79CdKLLwEtWL9lHeHNQ5kwATb5rs4MvazRELOnsXbymRuJa', 'Admin', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`itemId`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productId`);

--
-- Indexes for table `productall`
--
ALTER TABLE `productall`
  ADD PRIMARY KEY (`productId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `itemId` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `productall`
--
ALTER TABLE `productall`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userId` int(14) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
