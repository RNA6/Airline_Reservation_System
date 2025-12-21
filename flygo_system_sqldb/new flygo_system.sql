-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Dec 20, 2025 at 12:31 PM
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
-- Database: `flygo_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `name` varchar(40) NOT NULL,
  `short_name` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`name`, `short_name`) VALUES
('Dammam', 'DMM'),
('Jeddah', 'JED'),
('Madinah', 'MED'),
('Riyadh', 'RUH');

-- --------------------------------------------------------

--
-- Table structure for table `credit_card`
--

CREATE TABLE `credit_card` (
  `card_number` varchar(16) NOT NULL,
  `passport` varchar(10) NOT NULL,
  `first_name` varchar(24) NOT NULL,
  `last_name` varchar(32) NOT NULL,
  `expairy_date` date NOT NULL,
  `cvv` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `extra`
--

CREATE TABLE `extra` (
  `ticket_number` int(10) UNSIGNED NOT NULL,
  `passport` varchar(10) NOT NULL,
  `seat` varchar(4) NOT NULL,
  `small_bags` int(11) NOT NULL,
  `medium_bags` int(11) NOT NULL,
  `large_bags` int(11) NOT NULL,
  `meal` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `flights`
--

CREATE TABLE `flights` (
  `flight_number` varchar(8) NOT NULL,
  `origin` varchar(8) NOT NULL,
  `destination` varchar(8) NOT NULL,
  `departure_time` datetime NOT NULL,
  `arrival_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `flights`
--

INSERT INTO `flights` (`flight_number`, `origin`, `destination`, `departure_time`, `arrival_time`) VALUES
('10000001', 'RUH', 'JED', '2025-02-01 06:00:00', '2025-02-01 08:00:00'),
('10000002', 'RUH', 'JED', '2025-02-01 12:00:00', '2025-02-01 14:00:00'),
('10000003', 'RUH', 'JED', '2025-02-01 18:00:00', '2025-02-01 20:00:00'),
('10000004', 'RUH', 'DMM', '2025-02-01 07:00:00', '2025-02-01 08:15:00'),
('10000005', 'RUH', 'DMM', '2025-02-01 13:00:00', '2025-02-01 14:15:00'),
('10000006', 'RUH', 'DMM', '2025-02-01 19:00:00', '2025-02-01 20:15:00'),
('10000007', 'RUH', 'MED', '2025-02-01 06:30:00', '2025-02-01 08:00:00'),
('10000008', 'RUH', 'MED', '2025-02-01 12:30:00', '2025-02-01 14:00:00'),
('10000009', 'RUH', 'MED', '2025-02-01 18:30:00', '2025-02-01 20:00:00'),
('10000010', 'JED', 'RUH', '2025-02-01 06:00:00', '2025-02-01 08:00:00'),
('10000011', 'JED', 'RUH', '2025-02-01 12:00:00', '2025-02-01 14:00:00'),
('10000012', 'JED', 'RUH', '2025-02-01 18:00:00', '2025-02-01 20:00:00'),
('10000013', 'JED', 'DMM', '2025-02-01 07:30:00', '2025-02-01 09:45:00'),
('10000014', 'JED', 'DMM', '2025-02-01 13:30:00', '2025-02-01 15:45:00'),
('10000015', 'JED', 'DMM', '2025-02-01 19:30:00', '2025-02-01 21:45:00'),
('10000016', 'JED', 'MED', '2025-02-01 08:00:00', '2025-02-01 09:15:00'),
('10000017', 'JED', 'MED', '2025-02-01 14:00:00', '2025-02-01 15:15:00'),
('10000018', 'JED', 'MED', '2025-02-01 20:00:00', '2025-02-01 21:15:00'),
('10000019', 'DMM', 'RUH', '2025-02-01 06:15:00', '2025-02-01 07:30:00'),
('10000020', 'DMM', 'RUH', '2025-02-01 12:15:00', '2025-02-01 13:30:00'),
('10000021', 'DMM', 'RUH', '2025-02-01 18:15:00', '2025-02-01 19:30:00'),
('10000022', 'DMM', 'JED', '2025-02-01 07:00:00', '2025-02-01 09:15:00'),
('10000023', 'DMM', 'JED', '2025-02-01 13:00:00', '2025-02-01 15:15:00'),
('10000024', 'DMM', 'JED', '2025-02-01 19:00:00', '2025-02-01 21:15:00'),
('10000025', 'DMM', 'MED', '2025-02-01 08:30:00', '2025-02-01 10:30:00'),
('10000026', 'DMM', 'MED', '2025-02-01 14:30:00', '2025-02-01 16:30:00'),
('10000027', 'DMM', 'MED', '2025-02-01 20:30:00', '2025-02-01 22:30:00'),
('10000028', 'MED', 'RUH', '2025-02-01 06:45:00', '2025-02-01 08:15:00'),
('10000029', 'MED', 'RUH', '2025-02-01 12:45:00', '2025-02-01 14:15:00'),
('10000030', 'MED', 'RUH', '2025-02-01 18:45:00', '2025-02-01 20:15:00'),
('10000031', 'MED', 'JED', '2025-02-01 07:00:00', '2025-02-01 08:15:00'),
('10000032', 'MED', 'JED', '2025-02-01 13:00:00', '2025-02-01 14:15:00'),
('10000033', 'MED', 'JED', '2025-02-01 19:00:00', '2025-02-01 20:15:00'),
('10000034', 'MED', 'DMM', '2025-02-01 08:00:00', '2025-02-01 10:00:00'),
('10000035', 'MED', 'DMM', '2025-02-01 14:00:00', '2025-02-01 16:00:00'),
('10000036', 'MED', 'DMM', '2025-02-01 20:00:00', '2025-02-01 22:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `passenger`
--

CREATE TABLE `passenger` (
  `title` varchar(8) NOT NULL,
  `first_name` varchar(24) NOT NULL,
  `last_name` varchar(32) NOT NULL,
  `nationality` varchar(10) NOT NULL,
  `passport` varchar(10) NOT NULL,
  `birth_date` date NOT NULL,
  `age_group` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `ticket_number` int(10) UNSIGNED NOT NULL,
  `flight_number` varchar(8) DEFAULT NULL,
  `class` varchar(16) DEFAULT NULL,
  `adults_number` int(11) DEFAULT 1,
  `children_number` int(11) DEFAULT NULL,
  `infants_number` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `passport` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone_number` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `access_token` varchar(1024) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`short_name`);

--
-- Indexes for table `credit_card`
--
ALTER TABLE `credit_card`
  ADD PRIMARY KEY (`card_number`),
  ADD KEY `credit_card_foreign_key` (`passport`);

--
-- Indexes for table `extra`
--
ALTER TABLE `extra`
  ADD PRIMARY KEY (`ticket_number`,`passport`),
  ADD KEY `ticket_number` (`ticket_number`),
  ADD KEY `passport` (`passport`);

--
-- Indexes for table `flights`
--
ALTER TABLE `flights`
  ADD PRIMARY KEY (`flight_number`),
  ADD KEY `foreign_key` (`origin`),
  ADD KEY `foreign_key2` (`destination`);

--
-- Indexes for table `passenger`
--
ALTER TABLE `passenger`
  ADD PRIMARY KEY (`passport`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`ticket_number`),
  ADD KEY `Foregin_Key` (`flight_number`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`passport`) USING BTREE,
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `access_token` (`access_token`) USING HASH,
  ADD KEY `passport` (`passport`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `ticket_number` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `credit_card`
--
ALTER TABLE `credit_card`
  ADD CONSTRAINT `credit_card_foreign_key` FOREIGN KEY (`passport`) REFERENCES `passenger` (`passport`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `extra`
--
ALTER TABLE `extra`
  ADD CONSTRAINT `fk_extra_passport` FOREIGN KEY (`passport`) REFERENCES `passenger` (`passport`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_extra_ticket` FOREIGN KEY (`ticket_number`) REFERENCES `ticket` (`ticket_number`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `flights`
--
ALTER TABLE `flights`
  ADD CONSTRAINT `foreign_key` FOREIGN KEY (`origin`) REFERENCES `cities` (`short_name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `foreign_key2` FOREIGN KEY (`destination`) REFERENCES `cities` (`short_name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `Foregin_Key` FOREIGN KEY (`flight_number`) REFERENCES `flights` (`flight_number`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `Foreign key` FOREIGN KEY (`passport`) REFERENCES `passenger` (`passport`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
