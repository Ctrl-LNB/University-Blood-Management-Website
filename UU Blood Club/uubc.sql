-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3377
-- Generation Time: Dec 17, 2025 at 05:10 PM
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
-- Database: `uubc`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_panel`
--

CREATE TABLE `admin_panel` (
  `EMAIL` varchar(50) NOT NULL,
  `PASSWORD` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_panel`
--

INSERT INTO `admin_panel` (`EMAIL`, `PASSWORD`) VALUES
('admin@uubc', 'admin@uubc');

-- --------------------------------------------------------

--
-- Table structure for table `donors`
--

CREATE TABLE `donors` (
  `DONOR_ID` int(11) NOT NULL,
  `ID_NUMBER` varchar(50) NOT NULL,
  `EMAIL` varchar(100) NOT NULL,
  `FULL_NAME` varchar(100) NOT NULL,
  `BLOOD_GROUP` varchar(5) NOT NULL,
  `GENDER` varchar(10) NOT NULL,
  `LAST_DONATION_DATE` date DEFAULT NULL,
  `ADDRESS` varchar(255) NOT NULL,
  `PHONE_NUMBER` varchar(20) NOT NULL,
  `OCCUPATION` varchar(20) NOT NULL,
  `REGISTER_DATE` timestamp NOT NULL DEFAULT current_timestamp(),
  `STATUS` enum('approved','pending') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donors`
--

INSERT INTO `donors` (`DONOR_ID`, `ID_NUMBER`, `EMAIL`, `FULL_NAME`, `BLOOD_GROUP`, `GENDER`, `LAST_DONATION_DATE`, `ADDRESS`, `PHONE_NUMBER`, `OCCUPATION`, `REGISTER_DATE`, `STATUS`) VALUES
(18, '1', 'abc@gmail.com', 'ABc', 'A+', 'Male', '2025-01-01', 'dhaka', '0170000000', 'Staff', '2025-12-11 17:33:31', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `memberships`
--

CREATE TABLE `memberships` (
  `MEMBER_ID` int(11) NOT NULL,
  `FULL_NAME` varchar(100) NOT NULL,
  `ID_NUMBER` varchar(50) NOT NULL,
  `BLOOD_GROUP` varchar(5) NOT NULL,
  `GENDER` varchar(10) NOT NULL,
  `EMAIL` varchar(100) NOT NULL,
  `DEPARTMENT` varchar(100) NOT NULL,
  `BATCH` varchar(50) NOT NULL,
  `PHONE_NUMBER` varchar(20) NOT NULL,
  `ADDRESS` varchar(255) NOT NULL,
  `JOIN_DATE` timestamp NOT NULL DEFAULT current_timestamp(),
  `STATUS` enum('approved','pending') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `memberships`
--

INSERT INTO `memberships` (`MEMBER_ID`, `FULL_NAME`, `ID_NUMBER`, `BLOOD_GROUP`, `GENDER`, `EMAIL`, `DEPARTMENT`, `BATCH`, `PHONE_NUMBER`, `ADDRESS`, `JOIN_DATE`, `STATUS`) VALUES
(10, 'Riad Hasan', '332', 'A+', 'Male', 'riadhasan@gmail.com', 'CSE', '12', '0170000000', 'Dhaka', '2012-12-11 18:00:00', 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `USER_ID` int(11) NOT NULL,
  `u_id` varchar(30) DEFAULT NULL,
  `NAME` varchar(100) NOT NULL,
  `EMAIL` varchar(100) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`USER_ID`, `u_id`, `NAME`, `EMAIL`, `PASSWORD`) VALUES
(23, '332', 'Riad Hasan', 'riadhasan@gmail.com', 'riad404');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_panel`
--
ALTER TABLE `admin_panel`
  ADD PRIMARY KEY (`EMAIL`);

--
-- Indexes for table `donors`
--
ALTER TABLE `donors`
  ADD PRIMARY KEY (`DONOR_ID`),
  ADD UNIQUE KEY `ID_NUMBER` (`ID_NUMBER`),
  ADD UNIQUE KEY `EMAIL` (`EMAIL`);

--
-- Indexes for table `memberships`
--
ALTER TABLE `memberships`
  ADD PRIMARY KEY (`MEMBER_ID`),
  ADD UNIQUE KEY `ID_NUMBER` (`ID_NUMBER`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`USER_ID`),
  ADD UNIQUE KEY `EMAIL` (`EMAIL`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `donors`
--
ALTER TABLE `donors`
  MODIFY `DONOR_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `memberships`
--
ALTER TABLE `memberships`
  MODIFY `MEMBER_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `USER_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
