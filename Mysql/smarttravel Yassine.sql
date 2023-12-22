-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 22, 2023 at 09:31 AM
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
(1, 1, 45, 1.00),
(2, 1, 35, 1.50),
(3, 2, 38, 1.30);

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
(1, 'ctm', 'upload/company/ctmctm.png'),
(2, 'ghazala', 'upload/company/ghazalaghazala.png');

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
(1, 'safi', 'casablanca', 350.00, 205);

-- --------------------------------------------------------

--
-- Table structure for table `trip`
--

CREATE TABLE `trip` (
  `id` int(11) NOT NULL,
  `departure_time` varchar(255) NOT NULL,
  `arrive_time` varchar(255) NOT NULL,
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
(1, '2023-01-10 05:30:00', '2023-01-10 06:30:00', 5, 350.00, 1, 1, 'morning'),
(2, '2023-01-10 07:30:00', '2023-01-10 08:30:00', 15, 525.00, 2, 1, 'morning');

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
  ADD KEY `number_bus` (`number_bus`),
  ADD KEY `road_id` (`road_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bus`
--
ALTER TABLE `bus`
  MODIFY `number_bus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `road`
--
ALTER TABLE `road`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `trip`
--
ALTER TABLE `trip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  ADD CONSTRAINT `trip_ibfk_1` FOREIGN KEY (`number_bus`) REFERENCES `bus` (`number_bus`),
  ADD CONSTRAINT `trip_ibfk_2` FOREIGN KEY (`road_id`) REFERENCES `road` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
