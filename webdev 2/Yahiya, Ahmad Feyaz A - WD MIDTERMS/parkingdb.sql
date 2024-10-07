-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2024 at 03:54 AM
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
-- Database: `parkingdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `parking_slots`
--

CREATE TABLE `parking_slots` (
  `id` int(11) NOT NULL,
  `slot_number` varchar(10) NOT NULL,
  `is_available` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parking_slots`
--

INSERT INTO `parking_slots` (`id`, `slot_number`, `is_available`) VALUES
(1, 'A1', 1),
(2, 'A2', 1),
(3, 'A3', 1);

-- --------------------------------------------------------

--
-- Table structure for table `parking_transactions`
--

CREATE TABLE `parking_transactions` (
  `id` int(11) NOT NULL,
  `vehicle_plate` varchar(20) NOT NULL,
  `entry_time` datetime NOT NULL,
  `exit_time` datetime DEFAULT NULL,
  `parking_slot_id` int(11) NOT NULL,
  `remarks` text DEFAULT NULL,
  `status` enum('Parked','Exited') DEFAULT 'Parked',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parking_transactions`
--

INSERT INTO `parking_transactions` (`id`, `vehicle_plate`, `entry_time`, `exit_time`, `parking_slot_id`, `remarks`, `status`, `created_at`) VALUES
(12, 'J123IK', '2024-10-07 09:41:14', '2024-10-07 09:42:01', 2, '', 'Exited', '2024-10-07 01:41:14'),
(13, 'SKIBIDI123', '2024-10-07 09:42:15', '2024-10-07 09:47:21', 1, 'TRY TRY TRY', 'Exited', '2024-10-07 01:42:15'),
(14, 'MYCAR2005', '2024-10-07 09:42:28', '2024-10-07 09:47:18', 2, '', 'Exited', '2024-10-07 01:42:28'),
(15, 'HELICOPTER500', '2024-10-07 09:42:42', '2024-10-07 09:47:17', 3, '', 'Exited', '2024-10-07 01:42:42'),
(16, 'ehhe', '2024-10-07 09:47:28', '2024-10-07 09:47:56', 2, '', 'Exited', '2024-10-07 01:47:28'),
(17, '234324', '2024-10-07 09:47:53', '2024-10-07 09:50:19', 3, '', 'Exited', '2024-10-07 01:47:53'),
(18, 'djahdkfhkadsjf', '2024-10-07 09:48:03', '2024-10-07 09:50:18', 2, '', 'Exited', '2024-10-07 01:48:03'),
(19, 'afdsfsaf', '2024-10-07 09:50:15', '2024-10-07 09:50:17', 1, '', 'Exited', '2024-10-07 01:50:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `parking_slots`
--
ALTER TABLE `parking_slots`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parking_transactions`
--
ALTER TABLE `parking_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parking_slot_id` (`parking_slot_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `parking_slots`
--
ALTER TABLE `parking_slots`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `parking_transactions`
--
ALTER TABLE `parking_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `parking_transactions`
--
ALTER TABLE `parking_transactions`
  ADD CONSTRAINT `parking_transactions_ibfk_1` FOREIGN KEY (`parking_slot_id`) REFERENCES `parking_slots` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
