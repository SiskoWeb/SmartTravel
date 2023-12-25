-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 25, 2023 at 05:19 PM
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
-- Database: `smarttravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `bus`
--

CREATE TABLE `bus` (
  `number_bus` int(11) NOT NULL,
  `companyID` int(11) DEFAULT NULL,
  `capacity` int(11) DEFAULT NULL,
  `cost_per_km` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bus`
--

INSERT INTO `bus` (`number_bus`, `companyID`, `capacity`, `cost_per_km`) VALUES
(6, 10, 35, 1.20),
(7, 11, 55, 0.90),
(8, 10, 58, 1.10),
(9, 11, 42, 0.88),
(10, 13, 21, 0.70);

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `name`, `image`) VALUES
(10, 'ctm', 'upload/company/ctm_65886749c6c94_1703438153'),
(11, 'ghazala', 'upload/company/ghazala_6589375e21b5f_1703491422'),
(12, 'Arrahman', 'upload/company/Arrahman_6589aaaa88371_1703520938'),
(13, 'cha9ori', 'upload/company/cha9ori_6589aacbbc6d5_1703520971'),
(14, 'BabSalama', 'upload/company/BabSalama_6589aadb270e2_1703520987');

-- --------------------------------------------------------

--
-- Table structure for table `road`
--

CREATE TABLE `road` (
  `id` int(11) NOT NULL,
  `departure` varchar(255) NOT NULL,
  `destination` varchar(255) NOT NULL,
  `distance_km` decimal(10,2) NOT NULL,
  `distance_minute` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `road`
--

INSERT INTO `road` (`id`, `departure`, `destination`, `distance_km`, `distance_minute`) VALUES
(14, 'Safi', 'Marrakech', 250.00, 140),
(15, 'Safi', 'Casablanca', 310.00, 210),
(16, 'Agadir', 'Rabat', 480.00, 260),
(17, 'Sale', 'Meknès', 70.00, 70),
(18, 'Rabat', 'Sale', 15.00, 4);

-- --------------------------------------------------------

--
-- Table structure for table `trip`
--

CREATE TABLE `trip` (
  `id` int(11) NOT NULL,
  `departure_time` varchar(255) NOT NULL,
  `arrive_time` varchar(255) DEFAULT NULL,
  `seats_available` int(11) NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `number_bus` int(11) DEFAULT NULL,
  `road_id` int(11) DEFAULT NULL,
  `timeOfDay` enum('morning','afternoon','night') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trip`
--

INSERT INTO `trip` (`id`, `departure_time`, `arrive_time`, `seats_available`, `price`, `number_bus`, `road_id`, `timeOfDay`) VALUES
(12, '2024-01-21T13:40', NULL, 20, 225.00, 7, 14, 'afternoon'),
(14, '2024-01-21T15:51', NULL, 22, 225.00, 8, 14, 'night'),
(15, '2024-01-21T12:03', NULL, 25, 16.50, 8, 18, 'afternoon'),
(16, '2024-01-21T17:01', NULL, 21, 13.20, 9, 18, 'morning'),
(17, '2024-01-21T19:08', NULL, 14, 18.00, 6, 18, 'morning'),
(18, '2024-01-21T22:02', NULL, 17, 300.00, 6, 14, 'night'),
(19, '2024-01-22T05:05', NULL, 21, 225.00, 7, 14, 'night'),
(20, '2024-01-22T21:13', NULL, 21, 220.00, 9, 14, 'morning'),
(21, '2024-01-21T22:23', NULL, 10, 217.00, 10, 15, 'morning');

--
-- Triggers `trip`
--
DELIMITER $$
CREATE TRIGGER `calculate_price` BEFORE INSERT ON `trip` FOR EACH ROW BEGIN
    DECLARE cost DECIMAL(10, 2);
    DECLARE distance DECIMAL(10, 2);

    -- Get cost_per_km from the bus table
    SELECT cost_per_km INTO cost FROM bus WHERE number_bus = NEW.number_bus;

    -- Get distance_km from the road table
    SELECT distance_km INTO distance FROM road WHERE id = NEW.road_id;

    -- Calculate the price
    SET NEW.price = cost * distance;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bus`
--
ALTER TABLE `bus`
  ADD PRIMARY KEY (`number_bus`),
  ADD KEY `companyID` (`companyID`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `road`
--
ALTER TABLE `road`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_departure_destination` (`departure`,`destination`);

--
-- Indexes for table `trip`
--
ALTER TABLE `trip`
  ADD PRIMARY KEY (`id`),
  ADD KEY `road_id` (`road_id`),
  ADD KEY `number_bus` (`number_bus`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bus`
--
ALTER TABLE `bus`
  MODIFY `number_bus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `road`
--
ALTER TABLE `road`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `trip`
--
ALTER TABLE `trip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bus`
--
ALTER TABLE `bus`
  ADD CONSTRAINT `bus_ibfk_1` FOREIGN KEY (`companyID`) REFERENCES `company` (`id`);

--
-- Constraints for table `trip`
--
ALTER TABLE `trip`
  ADD CONSTRAINT `trip_ibfk_2` FOREIGN KEY (`road_id`) REFERENCES `road` (`id`),
  ADD CONSTRAINT `trip_ibfk_3` FOREIGN KEY (`number_bus`) REFERENCES `bus` (`number_bus`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
