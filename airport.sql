-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2017 at 02:50 PM
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
  `Registration` varchar(10) NOT NULL,
  `country` varchar(20) NOT NULL,
  `type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `aircraft_type`
--

CREATE TABLE `aircraft_type` (
  `ID` int(11) NOT NULL,
  `aircraft_type` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `air_bill`
--

CREATE TABLE `air_bill` (
  `ID` int(11) DEFAULT NULL,
  `Airb_bill` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cago_item_type`
--

CREATE TABLE `cago_item_type` (
  `ID` int(11) NOT NULL,
  `cargo_type` varchar(10) NOT NULL,
  `price_KG` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cago_item_type`
--

INSERT INTO `cago_item_type` (`ID`, `cargo_type`, `price_KG`) VALUES
(1, 'LIVE', 0.68),
(2, 'Normal', 0.015),
(3, 'Refri', 0.0378),
(4, 'Agri', 0.048);

-- --------------------------------------------------------

--
-- Table structure for table `cargo_item`
--

CREATE TABLE `cargo_item` (
  `ID` int(11) NOT NULL,
  `Air_bill` varchar(20) NOT NULL,
  `Cargo_type` int(11) NOT NULL,
  `date_in` date NOT NULL,
  `date_out` date NOT NULL,
  `Item_weight` float NOT NULL,
  `state` int(11) NOT NULL,
  `Days_in` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `carriers`
--

CREATE TABLE `carriers` (
  `ID` int(11) NOT NULL,
  `Name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `flights`
--

CREATE TABLE `flights` (
  `ID` int(5) NOT NULL,
  `number` varchar(5) NOT NULL,
  `ETA` time NOT NULL,
  `ATA` time NOT NULL,
  `Time_O_G` time NOT NULL,
  `ETD` time NOT NULL,
  `ATD` time NOT NULL,
  `COO` varchar(25) NOT NULL,
  `COD` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `manifest`
--

CREATE TABLE `manifest` (
  `ID` int(11) NOT NULL,
  `Airbill` varchar(20) NOT NULL,
  `num_of pieces` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `copy_of_manifest` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aircraft`
--
ALTER TABLE `aircraft`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Registration` (`Registration`),
  ADD UNIQUE KEY `type` (`type`);

--
-- Indexes for table `aircraft_type`
--
ALTER TABLE `aircraft_type`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `air_bill`
--
ALTER TABLE `air_bill`
  ADD KEY `Airb_bill` (`Airb_bill`);

--
-- Indexes for table `cago_item_type`
--
ALTER TABLE `cago_item_type`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `cargo_type` (`cargo_type`);

--
-- Indexes for table `cargo_item`
--
ALTER TABLE `cargo_item`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Air_bill` (`Air_bill`),
  ADD KEY `Cargo_type` (`Cargo_type`);

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
  ADD PRIMARY KEY (`ID`);

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
-- AUTO_INCREMENT for table `cago_item_type`
--
ALTER TABLE `cago_item_type`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `cargo_item`
--
ALTER TABLE `cargo_item`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `carriers`
--
ALTER TABLE `carriers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
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
-- Constraints for dumped tables
--

--
-- Constraints for table `cargo_item`
--
ALTER TABLE `cargo_item`
  ADD CONSTRAINT `cargo_item_ibfk_1` FOREIGN KEY (`Air_bill`) REFERENCES `air_bill` (`Airb_bill`),
  ADD CONSTRAINT `cargo_item_ibfk_2` FOREIGN KEY (`Cargo_type`) REFERENCES `cago_item_type` (`ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
