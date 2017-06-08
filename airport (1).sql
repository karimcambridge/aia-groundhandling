-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2017 at 10:12 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `airport`
--

-- --------------------------------------------------------

--
-- Table structure for table `aircraft`
--

CREATE TABLE `aircraft` (
  `ID` int(5) NOT NULL,
  `registration` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `aircarft_type` varchar(12) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `aircraft_type`
--

CREATE TABLE `aircraft_type` (
  `ID` int(11) NOT NULL,
  `aircraft_type` varchar(12) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `airwaybills`
--

CREATE TABLE `airwaybills` (
  `ID` int(11) NOT NULL,
  `airwaybill` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `carrier_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `airwaybills`
--

INSERT INTO `airwaybills` (`ID`, `airwaybill`, `carrier_id`) VALUES
(1, 'Liatx230723', 1),
(5, 'CALf30721312', 2),
(6, 'TLHL3131', 12);

-- --------------------------------------------------------

--
-- Table structure for table `cargo_inventory`
--

CREATE TABLE `cargo_inventory` (
  `ID` int(11) NOT NULL,
  `airwaybill` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Descrition` int(11) NOT NULL,
  `cargo_type_id` int(11) NOT NULL,
  `date_in` date NOT NULL,
  `item_weight` float NOT NULL,
  `date_out` date NOT NULL,
  `state` int(11) NOT NULL,
  `count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `cargo_item_type`
--

CREATE TABLE `cargo_item_type` (
  `ID` int(11) NOT NULL,
  `cargo_type` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `price_KG` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `cargo_item_type`
--

INSERT INTO `cargo_item_type` (`ID`, `cargo_type`, `price_KG`) VALUES
(1, 'Live', 0.68),
(2, 'Normal', 0.015),
(3, 'Refri', 0.0378),
(4, 'Agri', 0.048);

-- --------------------------------------------------------

--
-- Table structure for table `carriers`
--

CREATE TABLE `carriers` (
  `ID` int(11) NOT NULL,
  `name` varchar(24) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `carriers`
--

INSERT INTO `carriers` (`ID`, `name`) VALUES
(1, 'LIAT'),
(2, 'Caribbean Airlines'),
(3, 'DHL'),
(4, 'Fedex'),
(5, 'Amerijet'),
(6, 'JetPack'),
(7, 'Vincy Aviation'),
(8, 'Sunwing'),
(9, 'Air Canada'),
(10, 'EasySky'),
(11, 'American Airlines'),
(12, 'Private'),
(13, 'Diplomatic'),
(14, 'Emergency'),
(15, 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `flights`
--

CREATE TABLE `flights` (
  `ID` int(5) NOT NULL,
  `number` varchar(5) CHARACTER SET utf8 NOT NULL,
  `Date` date NOT NULL,
  `ETA` time NOT NULL,
  `ATA` time NOT NULL,
  `Time_O_G` time NOT NULL,
  `ETD` time NOT NULL,
  `ATD` time NOT NULL,
  `COO` varchar(25) CHARACTER SET utf8 NOT NULL,
  `COD` varchar(25) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `manifest`
--

CREATE TABLE `manifest` (
  `ID` int(11) NOT NULL,
  `airwaybill` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `num_of pieces` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `copy_of_manifest` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `ID` int(11) NOT NULL,
  `flight_number` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `carrier_name` varchar(24) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `time_of_service` datetime NOT NULL,
  `service_item_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `service_item`
--

CREATE TABLE `service_item` (
  `ID` int(11) NOT NULL,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `cost` float NOT NULL,
  `item_use` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `service_item`
--

INSERT INTO `service_item` (`ID`, `name`, `cost`, `item_use`) VALUES
(1, 'Payloadmover', 328, 0),
(2, 'Highliftloader', 350, 0),
(3, 'GPU', 145, 0),
(4, 'ACU', 174, 0),
(5, 'Bagbelt', 126, 0),
(6, 'Bagcart/dolly', 39, 0),
(7, 'Tractor', 140, 0),
(8, 'Towbar', 55, 0),
(9, 'Paxstairs', 318, 0),
(10, 'ASU', 360, 0),
(11, 'AC_main_equip', 176, 0),
(12, 'Sewage_charge', 180, 0),
(13, 'Potable_water', 178, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `accountid` int(11) NOT NULL,
  `username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`accountid`, `username`, `password`) VALUES
(1, 'admin', 'password');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aircraft`
--
ALTER TABLE `aircraft`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Registration` (`registration`),
  ADD UNIQUE KEY `type` (`aircarft_type`);

--
-- Indexes for table `aircraft_type`
--
ALTER TABLE `aircraft_type`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `aircraft_type` (`aircraft_type`);

--
-- Indexes for table `airwaybills`
--
ALTER TABLE `airwaybills`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `carrier` (`carrier_id`),
  ADD KEY `airwaybill` (`airwaybill`) USING BTREE,
  ADD KEY `ID` (`ID`),
  ADD KEY `carrier_id` (`carrier_id`);

--
-- Indexes for table `cargo_inventory`
--
ALTER TABLE `cargo_inventory`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Air_bill` (`airwaybill`),
  ADD KEY `Cargo_type` (`cargo_type_id`);

--
-- Indexes for table `cargo_item_type`
--
ALTER TABLE `cargo_item_type`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `cargo_type` (`cargo_type`);

--
-- Indexes for table `carriers`
--
ALTER TABLE `carriers`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `flights`
--
ALTER TABLE `flights`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `manifest`
--
ALTER TABLE `manifest`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `airwaybill` (`airwaybill`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD KEY `service_item_id` (`service_item_id`);

--
-- Indexes for table `service_item`
--
ALTER TABLE `service_item`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ID` (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`accountid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aircraft`
--
ALTER TABLE `aircraft`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `aircraft_type`
--
ALTER TABLE `aircraft_type`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `airwaybills`
--
ALTER TABLE `airwaybills`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `cargo_inventory`
--
ALTER TABLE `cargo_inventory`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cargo_item_type`
--
ALTER TABLE `cargo_item_type`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `carriers`
--
ALTER TABLE `carriers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `flights`
--
ALTER TABLE `flights`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `manifest`
--
ALTER TABLE `manifest`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `service_item`
--
ALTER TABLE `service_item`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `accountid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `aircraft`
--
ALTER TABLE `aircraft`
  ADD CONSTRAINT `aircraft_ibfk_1` FOREIGN KEY (`aircarft_type`) REFERENCES `aircraft_type` (`aircraft_type`);

--
-- Constraints for table `airwaybills`
--
ALTER TABLE `airwaybills`
  ADD CONSTRAINT `airwaybills_ibfk_1` FOREIGN KEY (`carrier_id`) REFERENCES `carriers` (`ID`);

--
-- Constraints for table `cargo_inventory`
--
ALTER TABLE `cargo_inventory`
  ADD CONSTRAINT `cargo_inventory_ibfk_1` FOREIGN KEY (`airwaybill`) REFERENCES `airwaybills` (`airwaybill`),
  ADD CONSTRAINT `cargo_inventory_ibfk_2` FOREIGN KEY (`cargo_type_id`) REFERENCES `cargo_item_type` (`ID`);

--
-- Constraints for table `manifest`
--
ALTER TABLE `manifest`
  ADD CONSTRAINT `manifest_ibfk_1` FOREIGN KEY (`airwaybill`) REFERENCES `airwaybills` (`airwaybill`);

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_ibfk_1` FOREIGN KEY (`service_item_id`) REFERENCES `service_item` (`ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
