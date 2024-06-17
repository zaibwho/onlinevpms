-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2024 at 12:58 PM
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
-- Database: `onlinevpms_std`
--

-- --------------------------------------------------------

--
-- Table structure for table `parkingslot`
--

CREATE TABLE `parkingslot` (
  `Slot` int(11) NOT NULL,
  `SlotFor` varchar(120) NOT NULL,
  `State` tinyint(1) DEFAULT 0,
  `lat` float(10,6) DEFAULT NULL,
  `lng` float(10,6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `parkingslot`
--

INSERT INTO `parkingslot` (`Slot`, `SlotFor`, `State`, `lat`, `lng`) VALUES
(1116, 'Car', 0, 31.516348, 74.339508),
(1474, 'Car', 0, 31.528009, 74.291313),
(1775, 'Car', 0, 31.536053, 74.273163),
(1852, 'Car', 0, 31.515894, 74.339600),
(1867, 'Car', 0, 31.528072, 74.291000),
(2129, 'MotorBike', 0, 31.516348, 74.339508),
(2166, 'MotorBike', 0, 31.528240, 74.291061),
(2532, 'MotorBike', 0, 31.527979, 74.291718),
(2879, 'MotorBike', 0, 31.515894, 74.339600);

-- --------------------------------------------------------

--
-- Table structure for table `stdadmin`
--

CREATE TABLE `stdadmin` (
  `ID` int(11) NOT NULL,
  `session_id` varchar(120) DEFAULT NULL,
  `AdminName` varchar(120) NOT NULL,
  `UserName` varchar(120) NOT NULL,
  `MobileNumber` varchar(50) NOT NULL,
  `Email` varchar(200) NOT NULL,
  `Password` varchar(120) NOT NULL,
  `AdminRegdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `stdadmin`
--

INSERT INTO `stdadmin` (`ID`, `session_id`, `AdminName`, `UserName`, `MobileNumber`, `Email`, `Password`, `AdminRegdate`) VALUES
(1, NULL, 'Shahzaib', 'zaibwho', '0324-0443231', 'zaibwho@gmail.com', 'fc5e038d38a57032085441e7fe7010b0', '2024-06-17 10:44:53');

-- --------------------------------------------------------

--
-- Table structure for table `stdcategory`
--

CREATE TABLE `stdcategory` (
  `ID` int(11) NOT NULL,
  `VehicleCat` varchar(120) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `stdcategory`
--

INSERT INTO `stdcategory` (`ID`, `VehicleCat`, `CreationDate`) VALUES
(1, 'Car', '2022-03-03 12:51:26'),
(2, 'MotorBike', '2022-03-03 12:51:37'),
(3, 'Riksha', '2022-03-09 12:09:49'),
(4, 'Truck', '2024-06-17 10:11:23');

-- --------------------------------------------------------

--
-- Table structure for table `stdvehicle`
--

CREATE TABLE `stdvehicle` (
  `ID` int(11) NOT NULL,
  `RegNo` int(11) NOT NULL,
  `FirstName` varchar(120) NOT NULL,
  `LastName` varchar(120) NOT NULL,
  `VehicleCategory` varchar(120) NOT NULL,
  `VehicleCompanyname` varchar(120) DEFAULT NULL,
  `LicensePlateNo` varchar(120) DEFAULT NULL,
  `Status` varchar(120) DEFAULT 'OUT',
  `ParkSlot` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stdvehicle`
--

INSERT INTO `stdvehicle` (`ID`, `RegNo`, `FirstName`, `LastName`, `VehicleCategory`, `VehicleCompanyname`, `LicensePlateNo`, `Status`, `ParkSlot`) VALUES
(14, 2203185, 'Shahzaib', 'Shahid', 'MotorBike', 'Road Prince RP 70', 'LEN-2952', 'OUT', NULL),
(15, 2203185, 'Shahzaib', 'Shahid', 'Car', 'Suzuki Wagon R', 'LED-2411', 'OUT', NULL),
(17, 2203185, 'Shahzaib', 'Shahid', 'MotorBike', 'Honda CD 70', 'LEN-2910', 'OUT', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `stdvehstatus`
--

CREATE TABLE `stdvehstatus` (
  `ID` int(11) NOT NULL,
  `RegNo` int(11) NOT NULL,
  `FirstName` varchar(120) NOT NULL,
  `LastName` varchar(120) NOT NULL,
  `VehicleCategory` varchar(120) NOT NULL,
  `VehicleCompanyname` varchar(120) NOT NULL,
  `LicensePlateNo` varchar(120) NOT NULL,
  `VehicleStatus` varchar(120) DEFAULT NULL,
  `ParkSlot` int(11) DEFAULT NULL,
  `Timing` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stdvehstatus`
--

INSERT INTO `stdvehstatus` (`ID`, `RegNo`, `FirstName`, `LastName`, `VehicleCategory`, `VehicleCompanyname`, `LicensePlateNo`, `VehicleStatus`, `ParkSlot`, `Timing`) VALUES
(1, 2203185, 'Shahzaib', 'Shahid', 'Car', 'Toyota Corolla Gli', 'LED-1923', 'IN', 1867, '2022-08-24 06:41:57'),
(2, 2203185, 'Shahzaib', 'Shahid', 'Car', 'Toyota Corolla Gli', 'LED-1923', 'OUT', 1867, '2022-08-24 06:42:50'),
(3, 2203185, 'Shahzaib', 'Shahid', 'Car', 'Toyota Corolla Gli', 'LED-1923', 'IN', 1852, '2022-08-28 18:09:24'),
(4, 2203185, 'Shahzaib', 'Shahid', 'Car', 'Toyota Corolla Gli', 'LED-1923', 'OUT', 1852, '2022-08-28 18:09:34'),
(5, 2203185, 'Shahzaib', 'Shahid', 'Car', 'Toyota Corolla Gli', 'LED-1923', 'IN', 1867, '2022-09-08 11:28:34'),
(6, 2203185, 'Shahzaib', 'Shahid', 'Car', 'Toyota Corolla Gli', 'LED-1923', 'OUT', 1867, '2022-09-08 11:28:52'),
(7, 2203185, 'Shahzaib', 'Shahid', 'Car', 'Suzuki Wagon R', 'LED-2411', 'IN', 1867, '2022-10-24 16:55:39'),
(8, 2203185, 'Shahzaib', 'Shahid', 'Car', 'Suzuki Wagon R', 'LED-2411', 'OUT', 1867, '2022-12-07 05:24:58'),
(9, 2203185, 'Shahzaib', 'Shahid', 'Car', 'Toyota Corolla Gli', 'LED-1923', 'IN', 1867, '2022-12-07 05:25:50'),
(10, 2203185, 'Shahzaib', 'Shahid', 'Car', 'Toyota Corolla Gli', 'LED-1923', 'OUT', 1867, '2022-12-07 05:25:54'),
(11, 2203185, 'Shahzaib', 'Shahid', 'Car', 'Toyota Corolla Gli', 'LED-1923', 'OUT', 1867, '2022-12-07 05:25:54'),
(12, 2203185, 'Shahzaib', 'Shahid', 'Car', 'Suzuki Liana', 'LED-3184', 'IN', 1474, '2022-12-16 06:22:41'),
(13, 2203185, 'Shahzaib', 'Shahid', 'Car', 'Suzuki Liana', 'LED-3184', 'OUT', 1474, '2022-12-16 06:23:17'),
(14, 2203185, 'Shahzaib', 'Shahid', 'MotorBike', 'Road Prince RP 70', 'LEN-2952', 'IN', 2532, '2024-06-17 10:44:17'),
(15, 2203185, 'Shahzaib', 'Shahid', 'MotorBike', 'Road Prince RP 70', 'LEN-2952', 'OUT', 2532, '2024-06-17 10:44:57'),
(16, 2203185, 'Shahzaib', 'Shahid', 'MotorBike', 'Road Prince RP 70', 'LEN-2952', 'OUT', 2532, '2024-06-17 10:45:44');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `ID` int(11) NOT NULL,
  `session_id` varchar(120) DEFAULT NULL,
  `FirstName` varchar(30) NOT NULL,
  `LastName` varchar(30) NOT NULL,
  `RegNo` int(11) NOT NULL,
  `Contact` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `sidebar` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`ID`, `session_id`, `FirstName`, `LastName`, `RegNo`, `Contact`, `Password`, `sidebar`) VALUES
(1, 'edAlciDOSR', 'Shahzaib', 'Shahid', 2203185, '0324-0443231', 'fc5e038d38a57032085441e7fe7010b0', 0);

-- --------------------------------------------------------

--
-- Table structure for table `veh_info`
--

CREATE TABLE `veh_info` (
  `ID` int(11) NOT NULL,
  `cat` varchar(30) NOT NULL,
  `brand` varchar(50) NOT NULL,
  `model` varchar(50) NOT NULL,
  `length` int(11) NOT NULL,
  `width` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `veh_info`
--

INSERT INTO `veh_info` (`ID`, `cat`, `brand`, `model`, `length`, `width`) VALUES
(1, 'Car', 'BMW', '7 Series', 5238, 2169),
(2, 'Car', 'Daewoo', 'Racer', 4482, 1662),
(3, 'Car', 'Daihatsu', 'Charade', 4080, 1620),
(4, 'Car', 'Daihatsu', 'Cuore', 3470, 1475),
(5, 'Car', 'Daihatsu', 'Cuore CX', 3300, 1395),
(6, 'Car', 'Daihatsu', 'Mira', 3395, 1475),
(7, 'Car', 'Daihatsu', 'Move', 3395, 1475),
(8, 'Car', 'Honda', 'Accord', 4933, 1849),
(9, 'Car', 'Honda', 'City', 4549, 1748),
(10, 'Car', 'Honda', 'City Aspire', 4395, 1695),
(11, 'Car', 'Honda', 'City IDSI', 4390, 1485),
(12, 'Car', 'Honda', 'City IVTEC', 4440, 1695),
(13, 'Car', 'Honda', 'City Vario', 4390, 1690),
(14, 'Car', 'Honda', 'Civic', 4656, 1799),
(15, 'Car', 'Honda', 'Civic EXi', 4450, 1695),
(16, 'Car', 'Honda', 'Civic IVTEC', 4630, 1799),
(17, 'Car', 'Honda', 'Civic Prosmetic', 4540, 1755),
(18, 'Car', 'Honda', 'Civic VTi', 4437, 1720),
(19, 'Car', 'Honda', 'Civic VTi Oriel', 4437, 1720),
(20, 'Car', 'Honda', 'Civic VTi Prosmatec', 4437, 1720),
(21, 'Car', 'Honda', 'CR Z', 4102, 1739),
(22, 'Car', 'Honda', 'CR Z Sports Hybird', 4080, 1740),
(23, 'Car', 'Honda', 'Fit', 4100, 1702),
(24, 'Car', 'Honda', 'Insight', 4663, 1819),
(25, 'Car', 'Honda', 'Life', 2995, 1295),
(26, 'Car', 'Honda', 'Vezel', 4295, 1770),
(27, 'Car', 'Hyundai', 'Santro Club', 3610, 1645),
(28, 'Car', 'KIA', 'Sportage', 4481, 1854),
(29, 'Car', 'Land Rover', 'Range Rover Sport', 4879, 2220),
(30, 'Car', 'Lexus', 'CT 200h', 4351, 1765),
(31, 'Car', 'Lexus', 'CT 450h', 4890, 1895),
(32, 'Car', 'Lexus', 'Harrier', 4730, 1845),
(33, 'Car', 'Lexus', 'RX 400h', 4755, 1844),
(34, 'Car', 'Lexus', 'RX 450h', 4890, 1895),
(35, 'Car', 'Maserati', 'Quattroporte', 5262, 1948),
(36, 'Car', 'Mazda', 'Az Wagon', 3395, 1475),
(37, 'Car', 'Mazda', 'RX8', 4460, 1770),
(38, 'Car', 'Mazda', 'Scrum', 3395, 1475),
(39, 'Car', 'Mercedes Benz', 'C Class', 4751, 2033),
(40, 'Car', 'Mercedes Benz', 'E Class', 5075, 2065),
(41, 'Car', 'Mercedes Benz', 'S Class', 5289, 2109),
(42, 'Car', 'Mitsubishi', 'GTO', 4600, 1840),
(43, 'Car', 'Mitsubishi', 'Lancer', 4585, 1760),
(44, 'Car', 'Mitsubishi', 'Minicab', 2995, 1295),
(45, 'Car', 'Mitsubishi', 'Pajero Mini', 3395, 1475),
(46, 'Car', 'Nissan', '350Z', 4314, 1816),
(47, 'Car', 'Nissan', 'Juke', 4135, 1765),
(48, 'Car', 'Nissan', 'Latio', 4430, 1695),
(49, 'Car', 'Nissan', 'NX', 4140, 1680),
(50, 'Car', 'Nissan', 'Sunny', 4455, 1695),
(51, 'Car', 'Porsche', 'Boxster', 4374, 1801),
(52, 'Car', 'Suzuki', 'Alto', 3445, 1515),
(53, 'Car', 'Suzuki', 'APV', 4405, 1750),
(54, 'Car', 'Suzuki', 'Bolan', 3255, 1395),
(55, 'Car', 'Suzuki', 'Bolan VX', 3255, 1395),
(56, 'Car', 'Suzuki', 'Cultus', 3845, 1590),
(57, 'Car', 'Suzuki', 'Cultus VX', 3600, 1600),
(58, 'Car', 'Suzuki', 'Cultus VXL', 3600, 1600),
(59, 'Car', 'Suzuki', 'Cultus VXR', 3600, 1600),
(60, 'Car', 'Suzuki', 'Every', 3390, 1470),
(61, 'Car', 'Suzuki', 'Khyber', 3685, 1545),
(62, 'Car', 'Suzuki', 'Liana', 4230, 1690),
(63, 'Car', 'Suzuki', 'Margalla', 3710, 1575),
(64, 'Car', 'Suzuki', 'Mehran', 3300, 1405),
(65, 'Car', 'Suzuki', 'Mehran VX', 3300, 1405),
(66, 'Car', 'Suzuki', 'Mehran VXR', 3300, 1405),
(67, 'Car', 'Suzuki', 'Swift', 3845, 1735),
(68, 'Car', 'Suzuki', 'Wagon R', 3655, 1620),
(69, 'Car', 'Toyota', 'Allion', 4565, 1695),
(70, 'Car', 'Toyota', 'Aqua', 3995, 1695),
(71, 'Car', 'Toyota', 'Belta', 4300, 1700),
(72, 'Car', 'Toyota', 'Camry', 4885, 1840),
(73, 'Car', 'Toyota', 'Corolla', 4530, 1705),
(74, 'Car', 'Toyota', 'Corolla 2.0 D Saloon', 4540, 1760),
(75, 'Car', 'Toyota', 'Corolla Altis', 4620, 1775),
(76, 'Car', 'Toyota', 'Corolla Axio', 4400, 1695),
(77, 'Car', 'Toyota', 'Corolla Gli', 4620, 1775),
(78, 'Car', 'Toyota', 'Corolla Saloon', 4530, 1705),
(79, 'Car', 'Toyota', 'Corolla XE', 4369, 1684),
(80, 'Car', 'Toyota', 'Corolla Xli', 4620, 1775),
(81, 'Car', 'Toyota', 'Crown Athlete', 4895, 1800),
(82, 'Car', 'Toyota', 'Estima', 4795, 1790),
(83, 'Car', 'Toyota', 'Fielder X', 4410, 1695),
(84, 'Car', 'Toyota', 'Hilux', 5265, 1800),
(85, 'Car', 'Toyota', 'Hilux Vigo', 5260, 1760),
(86, 'Car', 'Toyota', 'iQ', 2985, 1680),
(87, 'Car', 'Toyota', 'Land Cruiser', 4950, 1980),
(88, 'Car', 'Toyota', 'Land Cruiser Prado', 4760, 1885),
(89, 'Car', 'Toyota', 'Mark X', 4730, 1775),
(90, 'Car', 'Toyota', 'Passo', 3595, 1665),
(91, 'Car', 'Toyota', 'Prado', 3595, 1665),
(92, 'Car', 'Toyota', 'Premio', 4600, 1695),
(93, 'Car', 'Toyota', 'Prius', 4540, 1760),
(94, 'Car', 'Toyota', 'Supra', 4379, 1854),
(95, 'Car', 'Toyota', 'Townace', 4475, 1695),
(96, 'Car', 'Toyota', 'Tundra', 5933, 1975),
(97, 'Car', 'Toyota', 'Vitz', 3750, 1695),
(98, 'Car', 'Toyota', 'Wish', 4600, 1695),
(99, 'Car', 'Volks Wagon', 'Foxy', 4079, 1539),
(100, 'Car', 'Volks Wagon', 'Golf GTI', 4267, 1800),
(101, 'Car', 'Volks Wagon', 'Up', 3540, 1645),
(102, 'MotorBike', 'Road Prince', 'RP 70', 1900, 780),
(104, 'MotorBike', 'Honda', 'CD 70', 1897, 751),
(105, 'Riksha', 'KIng Hero', 'KH-200', 2625, 1300),
(106, 'Car', 'Porshe', '911 Turbo S', 4535, 1900);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `parkingslot`
--
ALTER TABLE `parkingslot`
  ADD PRIMARY KEY (`Slot`);

--
-- Indexes for table `stdadmin`
--
ALTER TABLE `stdadmin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `stdcategory`
--
ALTER TABLE `stdcategory`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `stdvehicle`
--
ALTER TABLE `stdvehicle`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `stdvehstatus`
--
ALTER TABLE `stdvehstatus`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `veh_info`
--
ALTER TABLE `veh_info`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `stdadmin`
--
ALTER TABLE `stdadmin`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stdcategory`
--
ALTER TABLE `stdcategory`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `stdvehicle`
--
ALTER TABLE `stdvehicle`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `stdvehstatus`
--
ALTER TABLE `stdvehstatus`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `veh_info`
--
ALTER TABLE `veh_info`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
