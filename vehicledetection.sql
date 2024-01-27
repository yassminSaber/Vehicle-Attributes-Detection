-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2023 at 08:35 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vehicledetection`
--

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE `driver` (
  `user_id` int(11) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `NationalID` varchar(14) NOT NULL,
  `UserName` varchar(20) NOT NULL,
  `Password` varchar(200) NOT NULL,
  `PlateNumber` varchar(10) NOT NULL,
  `HashedPassword` varchar(255) NOT NULL,
  `ProfilePicture` varchar(255) DEFAULT NULL,
  `Violation` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`user_id`, `Email`, `NationalID`, `UserName`, `Password`, `PlateNumber`, `HashedPassword`, `ProfilePicture`, `Violation`) VALUES
(11, 'rawanehab124@gmail.com', '30107102100429', 'RowanEhab', '30107102100429', 'ERN77', '$2y$10$TtX3oEat7vlD22OTgTFZiepouagUBFwN6haJo4l5hhI3qYApXUNbq', 'uploads/64948b5b212a29.42436764.jpeg', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `governmentdata`
--

CREATE TABLE `governmentdata` (
  `nationalID` varchar(20) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `platenumber` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `governmentdata`
--

INSERT INTO `governmentdata` (`nationalID`, `color`, `platenumber`) VALUES
('30107102100429', 'Blue', 'اوج7823'),
('12345678987632', 'orange', 'دل4625'),
('دل٤٦٢٥', 'orange', '98765432890643'),
('30002242401929', 'Red', 'اوج٧٨٢٣');

-- --------------------------------------------------------

--
-- Table structure for table `modelsdata`
--

CREATE TABLE `modelsdata` (
  `damagestatus` varchar(50) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `platenumber` varchar(50) DEFAULT NULL,
  `speed` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `modelsdata`
--

INSERT INTO `modelsdata` (`damagestatus`, `color`, `type`, `platenumber`, `speed`) VALUES
('no damage', 'brown', 'car', 'دع١٢٦٨', 47),
('no damage', 'white', 'car', 'دل٤٦٢٥', 19),
('no damage', 'grey', 'car', 'رن٦٢١٣', 12),
('no damage', 'white', 'car', 'طي٤٥٣١', 9),
('smash', 'white', 'car', 'اوج٧٨٢٣', 8),
('no damage', 'brown', 'car', 'دع١٢٦٨', 47),
('no damage', 'white', 'car', 'دل٤٦٢٥', 19),
('no damage', 'grey', 'car', 'رن٦٢١٣', 12),
('no damage', 'white', 'car', 'طي٤٥٣١', 9),
('smash', 'white', 'car', 'اوج٧٨٢٣', 8),
('no damage', 'brown', 'car', 'دع١٢٦٨', 47),
('no damage', 'white', 'car', 'دل٤٦٢٥', 19),
('no damage', 'grey', 'car', 'رن٦٢١٣', 12),
('no damage', 'white', 'car', 'طي٤٥٣١', 9),
('smash', 'white', 'car', 'اوج٧٨٢٣', 8);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE `vehicle` (
  `PlatNumber` varchar(10) NOT NULL,
  `Violation` text DEFAULT NULL,
  `ID` varchar(14) DEFAULT NULL,
  `Price` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`PlatNumber`, `Violation`, `ID`, `Price`) VALUES
('ABCD123', 'change in color from black to red', '30107102100429', 500);

-- --------------------------------------------------------

--
-- Table structure for table `video`
--

CREATE TABLE `video` (
  `counter` int(11) NOT NULL,
  `vehicletype` varchar(40) NOT NULL,
  `location` varchar(50) NOT NULL,
  `video` longblob NOT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `speed` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `video`
--

INSERT INTO `video` (`counter`, `vehicletype`, `location`, `video`, `date`, `time`, `speed`) VALUES
(12, 'car', 'elharam', 0x20, '0000-00-00', '00:00:00', 60);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`NationalID`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD UNIQUE KEY `PlateNumber` (`PlateNumber`);

--
-- Indexes for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD UNIQUE KEY `PlatNumber` (`PlatNumber`),
  ADD KEY `ID` (`ID`);

--
-- Indexes for table `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`counter`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `driver`
--
ALTER TABLE `driver`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `video`
--
ALTER TABLE `video`
  MODIFY `counter` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
