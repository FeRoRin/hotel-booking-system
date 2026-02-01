-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 01, 2026 at 07:04 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tarik_hotel_booking`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `contact_no` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `id_card` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `checkin_date` date NOT NULL,
  `checkout_date` date NOT NULL,
  `rooms` int(11) NOT NULL,
  `guests` int(11) NOT NULL,
  `booking_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `note` varchar(100) DEFAULT NULL,
  `booking_type_id` int(11) DEFAULT NULL,
  `room_type` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `user_id`, `customer_name`, `contact_no`, `email`, `id_card`, `address`, `checkin_date`, `checkout_date`, `rooms`, `guests`, `booking_date`, `note`, `booking_type_id`, `room_type`) VALUES
(2, 2, 'Jane Smith', '987654321', 'janesmith@example.com', 'XYZ789', '456 Elm St', '2024-08-10', '2024-08-15', 1, 2, '2024-06-07 04:45:17', '2 adult / DP', NULL, NULL),
(3, 1, 'Alice Johnson', '0666', 'alice@example.com', 'DEF456', '789 Oak St', '2024-09-20', '2024-09-25', 3, 6, '2024-06-07 04:45:17', '2 kids,4 adult', 8, 'Standard'),
(4, 2, 'Bob Williams', '111111111', 'bob@example.com', 'GHI789', '321 Pine St', '2024-10-15', '2024-10-20', 2, 4, '2024-06-07 04:45:17', '2 kids,2 adult', NULL, NULL),
(6, 2, 'Michael Davis', '333333333', 'michael@example.com', 'MNO345', '987 Cedar St', '2024-12-01', '2024-12-06', 3, 5, '2024-06-07 04:45:17', '2 kids,3 adult', NULL, NULL),
(7, 1, 'Sophia Miller', '444444444', 'sophia@example.com', 'PQR678', '654 Birch St', '2025-01-10', '2025-01-15', 2, 4, '2024-06-07 04:45:17', '2 kids,2 adult', NULL, NULL),
(8, 2, 'David Wilson', '666666666', 'david@example.com', 'STU901', '789 Walnut St', '2025-02-15', '2025-02-20', 1, 2, '2024-06-07 04:45:17', '2 adult', NULL, NULL),
(9, 1, 'Olivia Moore', '777777777', 'olivia@example.com', 'VWX234', '123 Cedar St', '2025-03-20', '2025-03-25', 3, 6, '2024-06-07 04:45:17', '2 kids,4 adult', NULL, NULL),
(12, 1, 'John Doe', '123456789', 'johndoe@example.com', 'ABC123', '123 Main St', '2025-07-01', '2025-07-05', 2, 4, '2024-06-07 04:45:17', '2 kids,2 adult', NULL, NULL),
(13, 2, 'Jane Smith', '987654321', 'janesmith@example.com', 'XYZ789', '456 Elm St', '2025-06-04', '2025-07-10', 1, 2, '2024-06-07 04:45:17', '2 adult', NULL, NULL),
(14, 1, 'Alice Johnson', '555555555', 'alice@example.com', 'DEF456', '789 Oak St', '2025-07-11', '2025-07-15', 3, 6, '2024-06-07 04:45:17', '2 kids,4 adult', NULL, NULL),
(15, 2, 'Bob Williams', '111111111', 'bob@example.com', 'GHI789', '321 Pine St', '2025-07-16', '2025-07-20', 2, 4, '2024-06-07 04:45:17', '2 kids,2 adult', NULL, NULL),
(17, 2, 'Michael Davis', '333333333', 'michael@example.com', 'MNO345', '987 Cedar St', '2025-07-26', '2025-07-30', 3, 5, '2024-06-07 04:45:17', '3 kids,2 adult', NULL, NULL),
(18, 1, 'Sophia Miller', '444444444', 'sophia@example.com', 'PQR678', '654 Birch St', '2025-07-31', '2025-08-05', 2, 4, '2024-06-07 04:45:17', '2 kids,2 adult', NULL, NULL),
(60, 2, 'Makoto', '0000', 'null', 'null', 'null', '2024-07-16', '2024-07-12', 3, 3, '2024-07-01 17:43:48', 'null', 2, 'Vue Mer'),
(62, 2, 'Kajin2', '000066', 'null2@null.null', 'null', 'null', '2024-07-10', '2024-07-12', 3, 3, '2024-07-01 18:21:32', '1 kid', 1, 'Vue Mer'),
(64, 2, 'Jane Smith', '987654321', 'janesmith@example.com', 'XYZ789', '456 Elm St', '2024-08-10', '2024-08-15', 1, 2, '2024-07-01 18:26:40', '2 adult / DP', 8, 'Vue Mer'),
(75, 2, 'tome', '0000', 'null@null.null', 'null', 'null', '2024-07-16', '2024-07-18', 100, 100, '2024-07-01 19:11:34', 'null', 1, 'Standard'),
(76, 2, 'Kajin', '0000', 'null@null.null', 'null', 'null', '2024-07-16', '2024-07-17', 47, 50, '2024-07-01 19:12:16', 'null', 1, 'Standard'),
(80, 2, 'Makoto', '0000', 'null@null.null', 'null', 'null', '2024-07-18', '2024-07-19', 40, 50, '2024-07-01 19:49:39', 'null', 1, 'Standard'),
(83, 2, 'test', '0000', 'null@null.null', 'null', 'null', '2024-07-19', '2024-07-20', 100, 200, '2024-07-01 20:14:59', 'null', 1, 'Standard'),
(84, 2, 'Makoto', '0000', 'null@null.null', 'null', 'null', '2024-07-19', '2024-07-19', 5, 10, '2024-07-01 20:15:36', 'null', 1, 'Standard'),
(85, 2, 'test', '0000', 'null@null.null', 'null', 'null', '2024-07-20', '2024-07-23', 50, 50, '2024-07-01 20:16:11', 'null', 1, 'Standard'),
(86, 2, 'Kajin', '0000', 'null@null.null', 'null', 'null', '2024-07-21', '2024-07-24', 40, 40, '2024-07-01 20:23:26', 'null', 1, 'Standard'),
(89, 2, 'test', '0000', 'null@null.null', 'null', 'null', '2024-07-26', '2024-07-27', 5, 10, '2024-07-01 20:29:15', 'null', 1, 'Vue Mer');

-- --------------------------------------------------------

--
-- Table structure for table `booking_types`
--

CREATE TABLE `booking_types` (
  `id` int(11) NOT NULL,
  `type_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking_types`
--

INSERT INTO `booking_types` (`id`, `type_name`) VALUES
(1, 'INDIVIDUEL'),
(2, 'LUXOTOUR'),
(3, 'ENENEMENT VOYAGES'),
(4, 'ATLAS OUTDOOR'),
(5, 'MYGO'),
(6, 'NORAFRICA'),
(8, 'BOOKING'),
(9, 'HOTEL BEDS'),
(10, 'ONLINE'),
(11, 'PALAIS ROYALE');

-- --------------------------------------------------------

--
-- Table structure for table `cancelled_bookings`
--

CREATE TABLE `cancelled_bookings` (
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `contact_no` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `id_card` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `checkin_date` date NOT NULL,
  `checkout_date` date NOT NULL,
  `rooms` int(11) NOT NULL,
  `guests` int(11) NOT NULL,
  `booking_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `note` varchar(100) DEFAULT NULL,
  `booking_type_id` int(11) DEFAULT NULL,
  `room_type` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cancelled_bookings`
--

INSERT INTO `cancelled_bookings` (`booking_id`, `user_id`, `customer_name`, `contact_no`, `email`, `id_card`, `address`, `checkin_date`, `checkout_date`, `rooms`, `guests`, `booking_date`, `note`, `booking_type_id`, `room_type`) VALUES
(57, 2, 'Makoto', '0666666', 'kayoheh910@telvetto.com', 'li85641', 'uufer1200', '2024-06-25', '2024-06-27', 1, 2, '2024-06-27 12:19:48', 'M sdse', NULL, NULL),
(91, 2, 'Makoto', '0000', 'null@null.null', 'null', 'null', '2024-07-09', '2024-07-10', 1, 1, '2024-07-02 14:30:57', 'null', NULL, NULL),
(87, 2, 'nanami', '0000', 'null@null.null', 'null', 'null', '2024-07-16', '2024-07-18', 3, 3, '2024-07-01 20:24:07', 'null', NULL, NULL),
(72, 2, 'Jane Smith', '987654321', 'janesmith@example.com', 'XYZ789', '456 Elm St', '2024-08-10', '2024-08-15', 2, 3, '2024-07-01 18:47:51', '2 adult / DP', 8, 'Vue Mer');

-- --------------------------------------------------------

--
-- Table structure for table `room_count`
--

CREATE TABLE `room_count` (
  `id` int(11) NOT NULL,
  `room_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_count`
--

INSERT INTO `room_count` (`id`, `room_count`) VALUES
(1, 150);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `username`, `email`, `password`, `created_at`) VALUES
(1, 'Fero', 'fero', 'fero@gmail.com', 'd0a512f262ed34abed0c45cefe08c429', '2025-04-01 11:49:22'),
(2, 'admin', 'admin', 'admin@hotelMS.com', 'fb1e75090b96d2e0abec0ec980c2f392', '2025-04-01 11:49:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `fk_booking_type` (`booking_type_id`);

--
-- Indexes for table `booking_types`
--
ALTER TABLE `booking_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cancelled_bookings`
--
ALTER TABLE `cancelled_bookings`
  ADD KEY `fk_booking_type1` (`booking_type_id`);

--
-- Indexes for table `room_count`
--
ALTER TABLE `room_count`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `booking_types`
--
ALTER TABLE `booking_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `fk_booking_type` FOREIGN KEY (`booking_type_id`) REFERENCES `booking_types` (`id`);

--
-- Constraints for table `cancelled_bookings`
--
ALTER TABLE `cancelled_bookings`
  ADD CONSTRAINT `fk_booking_type1` FOREIGN KEY (`booking_type_id`) REFERENCES `booking_types` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
