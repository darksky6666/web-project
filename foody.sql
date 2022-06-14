-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2022 at 09:55 AM
-- Server version: 8.0.28
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `foody`
--

-- --------------------------------------------------------

--
-- Table structure for table `food_categories`
--

CREATE TABLE `food_categories` (
  `fc_ID` int NOT NULL,
  `categoryName` varchar(30) NOT NULL,
  `categoryPrice` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `food_categories`
--

INSERT INTO `food_categories` (`fc_ID`, `categoryName`, `categoryPrice`) VALUES
(1, 'Chicken', 10),
(2, 'Noodles', 7.5),
(3, 'Soup', 5.5),
(4, 'Dessert', 4.5),
(5, 'Rice', 7),
(6, 'Beverages', 8);

-- --------------------------------------------------------

--
-- Table structure for table `menu_list`
--

CREATE TABLE `menu_list` (
  `menu_ID` int NOT NULL,
  `foodName` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `foodPhoto` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `foodDesc` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `foodAvailability` varchar(20) NOT NULL,
  `fc_ID` int DEFAULT NULL,
  `RO_username` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `menu_list`
--

INSERT INTO `menu_list` (`menu_ID`, `foodName`, `foodPhoto`, `foodDesc`, `foodAvailability`, `fc_ID`, `RO_username`) VALUES
(1, 'Nasi Lemak Ayam', 'nasi-lemak-ayam.png', 'Fragrant rice with peanuts and anchovies with a delicious sambal.', 'Available', 5, 'RE10001'),
(2, 'Chicken Chop', 'chicken-chop.png', 'A pan-fried chicken covered with bold black pepper sauce plus Australian fries.', 'Not Available', 1, 'RE10001'),
(3, 'Mee Goreng', 'mee-goreng.png', 'Yellow noodles stir fried in cooking oil with garlic, onion, chicken, chilli, cabbage, tomatoes and eggs.', 'Not Available', 2, 'RE10001');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int NOT NULL,
  `menu_ID` int DEFAULT NULL,
  `orderQuantity` int DEFAULT NULL,
  `orderID` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `menu_ID`, `orderQuantity`, `orderID`) VALUES
(1, 1, 1, 1),
(2, 2, 2, 1),
(3, 2, 1, 2),
(4, 3, 3, 2),
(5, 1, 1, 3),
(6, 2, 1, 3),
(7, 2, 1, 4),
(8, 3, 2, 5),
(9, 3, 2, 6),
(10, 1, 1, 7),
(11, 2, 3, 8),
(12, 3, 2, 9),
(13, 1, 2, 10);

-- --------------------------------------------------------

--
-- Table structure for table `order_list`
--

CREATE TABLE `order_list` (
  `orderID` int NOT NULL,
  `orderDate` date DEFAULT NULL,
  `orderTime` time DEFAULT NULL,
  `totalAmount` float DEFAULT NULL,
  `orderStatus` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `username` varchar(30) DEFAULT NULL,
  `RO_username` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_list`
--

INSERT INTO `order_list` (`orderID`, `orderDate`, `orderTime`, `totalAmount`, `orderStatus`, `username`, `RO_username`) VALUES
(1, '2022-04-02', '15:15:43', 27, 'Prepared', 'u1', 'RE10001'),
(2, '2022-04-06', '15:15:00', 32.5, 'Prepared', 'u2', 'RE10001'),
(3, '2022-04-13', '13:58:35', 100, 'Prepared', 'u1', 'RE10001'),
(4, '2022-04-20', '12:03:26', 120, 'Prepared', 'u1', 'RE10001'),
(5, '2022-04-24', '17:04:16', 50, 'Prepared', 'u2', 'RE10001'),
(6, '2022-05-07', '17:04:16', 30, 'Prepared', 'u2', 'RE10001'),
(7, '2022-05-14', '15:15:43', 21, 'Prepared', 'u2', 'RE10001'),
(8, '2022-05-21', '15:15:43', 40, 'Prepared', 'u2', 'RE10001'),
(9, '2022-05-28', '15:15:43', 10, 'Cancel', 'u1', 'RE10001'),
(10, '2022-06-01', '15:15:43', 30, 'Cancel', 'u2', 'RE10001');

-- --------------------------------------------------------

--
-- Table structure for table `restaurant_details`
--

CREATE TABLE `restaurant_details` (
  `rd_ID` int NOT NULL,
  `rdName` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `rdLocation` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `rdOpTime` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `rdContactNo` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `cuisinesType` varchar(30) NOT NULL,
  `varietyType` varchar(30) NOT NULL,
  `RO_username` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `restaurant_details`
--

INSERT INTO `restaurant_details` (`rd_ID`, `rdName`, `rdLocation`, `rdOpTime`, `rdContactNo`, `cuisinesType`, `varietyType`, `RO_username`) VALUES
(1, 'Sri Pekan Chinese Food', '26, Jalan Tengku Arif Bendahara, 26600 Pekan, Pahang', '10:00 AM - 08:00 PM', '0129893560', 'Rice Noodles', 'Non-Halal', 'RE10003'),
(2, 'AFOUR CAFE (A4 CAFE)', 'Lot 1,Jalan Satria,26600, 26600 Pekan, Pahang', '04:00 PM - 11:00 PM', '01116996977', 'Malaysian Food', 'Halal', 'RE10002'),
(3, 'D\' Laman Western Cuisine', '118 Jalan Istana Melati, Kampung Mengkasar, 26600 Pekan, Pahang', '06:00 PM - 12:00 AM', '01137400233', 'Western', 'Halal', 'RE10001');

-- --------------------------------------------------------

--
-- Table structure for table `restaurant_owner`
--

CREATE TABLE `restaurant_owner` (
  `RO_username` varchar(30) NOT NULL,
  `ROPassword` varchar(30) NOT NULL,
  `ROName` varchar(30) NOT NULL,
  `ROAddress` varchar(100) NOT NULL,
  `ROPhoneNum` varchar(20) NOT NULL,
  `ROEmailAdd` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `restaurant_owner`
--

INSERT INTO `restaurant_owner` (`RO_username`, `ROPassword`, `ROName`, `ROAddress`, `ROPhoneNum`, `ROEmailAdd`) VALUES
('RE10001', '12345', 'Ali bin Abu', 'No 5, Jalan Petaling 1, Taman Petaling', '0127897955', 'aliabu@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(30) NOT NULL,
  `password` varchar(30) DEFAULT NULL,
  `name` varchar(30) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `phoneNum` varchar(20) DEFAULT NULL,
  `emailAdd` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `name`, `address`, `phoneNum`, `emailAdd`) VALUES
('u1', 'wjy322@', 'Wang Yi Bo', 'Residen Pelajar 5, Blok A, Universiti Malaysia Pahang, Kampus Pekan.', '0195110297', 'SD10001@student.ump.edu.my'),
('u2', 'ysp0573', 'Aiman bin Hakim', 'Residen Pelajar 3, Blok H, Universiti Malaysia Pahang, Kampus Gambang.', '0139093847', 'SD10002@student.ump.edu.my');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `food_categories`
--
ALTER TABLE `food_categories`
  ADD PRIMARY KEY (`fc_ID`);

--
-- Indexes for table `menu_list`
--
ALTER TABLE `menu_list`
  ADD PRIMARY KEY (`menu_ID`),
  ADD KEY `fk_fc_ID` (`fc_ID`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_orderID` (`orderID`),
  ADD KEY `fk_menu_ID` (`menu_ID`);

--
-- Indexes for table `order_list`
--
ALTER TABLE `order_list`
  ADD PRIMARY KEY (`orderID`),
  ADD KEY `fk_username` (`username`);

--
-- Indexes for table `restaurant_details`
--
ALTER TABLE `restaurant_details`
  ADD PRIMARY KEY (`rd_ID`);

--
-- Indexes for table `restaurant_owner`
--
ALTER TABLE `restaurant_owner`
  ADD PRIMARY KEY (`RO_username`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `food_categories`
--
ALTER TABLE `food_categories`
  MODIFY `fc_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `menu_list`
--
ALTER TABLE `menu_list`
  MODIFY `menu_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `order_list`
--
ALTER TABLE `order_list`
  MODIFY `orderID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `restaurant_details`
--
ALTER TABLE `restaurant_details`
  MODIFY `rd_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `menu_list`
--
ALTER TABLE `menu_list`
  ADD CONSTRAINT `fk_fc_ID` FOREIGN KEY (`fc_ID`) REFERENCES `food_categories` (`fc_ID`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `fk_menu_ID` FOREIGN KEY (`menu_ID`) REFERENCES `menu_list` (`menu_ID`),
  ADD CONSTRAINT `fk_orderID` FOREIGN KEY (`orderID`) REFERENCES `order_list` (`orderID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `order_list`
--
ALTER TABLE `order_list`
  ADD CONSTRAINT `fk_username` FOREIGN KEY (`username`) REFERENCES `user` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
