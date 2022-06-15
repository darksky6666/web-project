-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2022 at 09:52 AM
-- Server version: 8.0.23
-- PHP Version: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `foody`
--

-- --------------------------------------------------------

--
-- Table structure for table `complaint_list`
--

CREATE TABLE `complaint_list` (
  `complaint_ID` int NOT NULL,
  `complaintType` varchar(30) DEFAULT NULL,
  `complaintDesc` varchar(300) DEFAULT NULL,
  `complaintDate` date DEFAULT NULL,
  `complaintTime` time DEFAULT NULL,
  `complaintStatus` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `order_ID` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `complaint_list`
--

INSERT INTO `complaint_list` (`complaint_ID`, `complaintType`, `complaintDesc`, `complaintDate`, `complaintTime`, `complaintStatus`, `order_ID`) VALUES
(12, 'DAMAGED FOOD', 'lol', '2022-06-15', '02:06:15', 'IN INVESTIGATION', 1),
(13, 'LATE DELIVERY', 'hoho', '2022-06-15', '02:12:20', 'IN INVESTIGATION', 3),
(15, 'DAMAGED FOOD', 'll', '2022-06-15', '15:39:40', 'IN INVESTIGATION', 5);

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `delivery_ID` int NOT NULL,
  `timeDelivered` time DEFAULT NULL,
  `rider_username` varchar(100) DEFAULT NULL,
  `rd_ID` int DEFAULT NULL,
  `order_ID` int DEFAULT NULL,
  `complaint_ID` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_ID` int NOT NULL,
  `fDesc` varchar(100) DEFAULT NULL,
  `fDate` date DEFAULT NULL,
  `fTime` time DEFAULT NULL,
  `order_ID` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `food_categories`
--

CREATE TABLE `food_categories` (
  `fc_ID` int NOT NULL,
  `categoryName` varchar(100) DEFAULT NULL,
  `categoryPrice` float DEFAULT NULL
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
  `foodName` varchar(100) DEFAULT NULL,
  `foodPhoto` varchar(100) DEFAULT NULL,
  `foodDesc` varchar(100) DEFAULT NULL,
  `foodAvailability` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `fc_ID` int DEFAULT NULL,
  `rd_ID` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `menu_list`
--

INSERT INTO `menu_list` (`menu_ID`, `foodName`, `foodPhoto`, `foodDesc`, `foodAvailability`, `fc_ID`, `rd_ID`) VALUES
(2, 'Nasi Goreng Pattaya', '1-nasi-goreng-pattaya.png', 'A fried rice dish made by wrapping chicken fried rice in omelette.', 'Available', 5, 2),
(3, 'Milo Dinasour', '2-milo-dinasour.png', 'A cup of iced Milo (a chocolate malt beverage) with undissolved Milo powder added on top of it.', 'Available', 6, 2),
(4, 'Chicken Chop', '3-chicken-chop.png', 'A pan-fried chicken covered with bold black pepper sauce plus Australian fries.', 'Available', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `od_ID` int NOT NULL,
  `orderQuantity` int DEFAULT NULL,
  `menu_ID` int DEFAULT NULL,
  `order_ID` int DEFAULT NULL,
  `totalPrice` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`od_ID`, `orderQuantity`, `menu_ID`, `order_ID`, `totalPrice`) VALUES
(1, 1, 2, 1, 7),
(2, 1, 3, 1, 8),
(3, 1, 4, 3, 10),
(4, 1, 2, 3, 7),
(5, 1, 2, 1, 7),
(6, 1, 2, 5, 7);

-- --------------------------------------------------------

--
-- Table structure for table `order_list`
--

CREATE TABLE `order_list` (
  `order_ID` int NOT NULL,
  `orderDate` date DEFAULT NULL,
  `orderTime` time DEFAULT NULL,
  `totalPayment` float DEFAULT NULL,
  `orderStatus` varchar(100) DEFAULT NULL,
  `delLocation` varchar(100) DEFAULT NULL,
  `RO_username` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `rider_username` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_list`
--

INSERT INTO `order_list` (`order_ID`, `orderDate`, `orderTime`, `totalPayment`, `orderStatus`, `delLocation`, `RO_username`, `username`, `rider_username`) VALUES
(1, '2022-06-15', '12:29:21', 22, 'Ordered', 'ds', NULL, NULL, NULL),
(2, '2022-06-15', '14:00:09', NULL, 'Incomplete', NULL, NULL, NULL, NULL),
(3, '2022-06-15', '14:04:59', 17, 'Ordered', 'ds', NULL, NULL, 'RU10001'),
(4, '2022-06-15', '15:37:10', NULL, 'Incomplete', NULL, NULL, NULL, NULL),
(5, '2022-06-15', '15:39:22', 7, 'Ordered', 'ds', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `res_details`
--

CREATE TABLE `res_details` (
  `rd_ID` int NOT NULL,
  `rdName` varchar(100) DEFAULT NULL,
  `rdLocation` varchar(100) DEFAULT NULL,
  `rdOpTime` varchar(100) DEFAULT NULL,
  `rdContactNo` varchar(100) DEFAULT NULL,
  `cuisinesType` varchar(100) DEFAULT NULL,
  `varietyType` varchar(100) DEFAULT NULL,
  `rdPhoto` varchar(100) DEFAULT NULL,
  `RO_username` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `res_details`
--

INSERT INTO `res_details` (`rd_ID`, `rdName`, `rdLocation`, `rdOpTime`, `rdContactNo`, `cuisinesType`, `varietyType`, `rdPhoto`, `RO_username`) VALUES
(2, 'Sri Pekan Chinese Food', '26, Jalan Tengku Arif Bendahara, 26600 Pekan, Pahang', '10:00 AM - 08:00 PM', '0129893560', 'Rice Noodles', 'Non-Halal', '1-sri-pekan-chinese-food.png', 'RE10002');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int NOT NULL,
  `username` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `password` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `address` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `region` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `phoneNum` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `emailAdd` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `userType` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `name`, `address`, `region`, `phoneNum`, `emailAdd`, `userType`) VALUES
(1, 'AM10001', 'ehf234#', 'Iskandar bin Shah', 'No 27, Jalan Bunga Melati, Taman Harmoni, Pekan Pahang.', 'Pekan', '0130924843', 'iskandar@gmail.com', 'Admin'),
(2, 'SD10001', 'wjy322@', 'Wang Yi Bo', 'Residen Pelajar 5, Blok A, Universiti Malaysia Pahang, Kampus Pekan.', 'Pekan', '0195110297', 'SD10001@student.ump.edu.my', 'General User'),
(3, 'ST10004', 'sui8972', 'Ajay A/L Darsh', 'Residen Pelajar 2, Blok C, Universiti Malaysia Pahang, Kampus Gambang.', 'Gambang', '0189852737', 'ST10004@staff.ump.edu.my', 'General User'),
(4, 'RE10002', 'guy897@', 'Ang Zhi Nuo', '26, Jalan Tengku Arif Bendahara, Pekan, Pahang.', 'Pekan', '0120294348', 'ang@gmail.com', 'Restaurant Owner'),
(5, 'RU10001', 'qwert01', 'Ahmad bin Ali', '81, Jalan Dewan Bahasa 2, Kampung Raja, Pahang.', 'Gambang', '0125342651', 'ahmad77@gmail.com', 'Rider');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `complaint_list`
--
ALTER TABLE `complaint_list`
  ADD PRIMARY KEY (`complaint_ID`),
  ADD KEY `Test` (`order_ID`);

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`delivery_ID`),
  ADD KEY `rider_username` (`rider_username`),
  ADD KEY `rd_ID` (`rd_ID`),
  ADD KEY `order_ID` (`order_ID`),
  ADD KEY `complaint_ID` (`complaint_ID`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_ID`),
  ADD KEY `order_ID` (`order_ID`);

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
  ADD KEY `fc_ID` (`fc_ID`),
  ADD KEY `rd_ID` (`rd_ID`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`od_ID`),
  ADD KEY `menu_ID` (`menu_ID`),
  ADD KEY `order_ID` (`order_ID`);

--
-- Indexes for table `order_list`
--
ALTER TABLE `order_list`
  ADD PRIMARY KEY (`order_ID`),
  ADD KEY `RO_username` (`RO_username`),
  ADD KEY `username` (`username`),
  ADD KEY `rider_name` (`rider_username`);

--
-- Indexes for table `res_details`
--
ALTER TABLE `res_details`
  ADD PRIMARY KEY (`rd_ID`),
  ADD KEY `username` (`RO_username`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `complaint_list`
--
ALTER TABLE `complaint_list`
  MODIFY `complaint_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `delivery_ID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_ID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `food_categories`
--
ALTER TABLE `food_categories`
  MODIFY `fc_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `menu_list`
--
ALTER TABLE `menu_list`
  MODIFY `menu_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `od_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `order_list`
--
ALTER TABLE `order_list`
  MODIFY `order_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `res_details`
--
ALTER TABLE `res_details`
  MODIFY `rd_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `complaint_list`
--
ALTER TABLE `complaint_list`
  ADD CONSTRAINT `complaint_list_ibfk_1` FOREIGN KEY (`order_ID`) REFERENCES `order_list` (`order_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `delivery`
--
ALTER TABLE `delivery`
  ADD CONSTRAINT `delivery_ibfk_1` FOREIGN KEY (`rider_username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `delivery_ibfk_2` FOREIGN KEY (`rd_ID`) REFERENCES `res_details` (`rd_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `delivery_ibfk_3` FOREIGN KEY (`order_ID`) REFERENCES `order_list` (`order_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `delivery_ibfk_4` FOREIGN KEY (`complaint_ID`) REFERENCES `complaint_list` (`complaint_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`order_ID`) REFERENCES `order_list` (`order_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `menu_list`
--
ALTER TABLE `menu_list`
  ADD CONSTRAINT `menu_list_ibfk_1` FOREIGN KEY (`fc_ID`) REFERENCES `food_categories` (`fc_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `menu_list_ibfk_2` FOREIGN KEY (`rd_ID`) REFERENCES `res_details` (`rd_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`menu_ID`) REFERENCES `menu_list` (`menu_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`order_ID`) REFERENCES `order_list` (`order_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_list`
--
ALTER TABLE `order_list`
  ADD CONSTRAINT `order_list_ibfk_1` FOREIGN KEY (`RO_username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_list_ibfk_2` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_list_ibfk_3` FOREIGN KEY (`rider_username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `res_details`
--
ALTER TABLE `res_details`
  ADD CONSTRAINT `res_details_ibfk_1` FOREIGN KEY (`RO_username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;
