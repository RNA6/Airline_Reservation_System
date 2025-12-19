-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 19 ديسمبر 2025 الساعة 20:37
-- إصدار الخادم: 10.4.32-MariaDB
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
-- بنية الجدول `cities`
--

CREATE TABLE `cities` (
  `name` varchar(40) NOT NULL,
  `short_name` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `credit_card`
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
-- بنية الجدول `extra`
--

CREATE TABLE `extra` (
  `ticket_number` varchar(10) NOT NULL,
  `passport` varchar(10) NOT NULL,
  `seat` varchar(4) NOT NULL,
  `small_bags` int(11) NOT NULL,
  `medium_bags` int(11) NOT NULL,
  `large_bags` int(11) NOT NULL,
  `meal` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `flight`
--

CREATE TABLE `flight` (
  `flight_number` varchar(8) NOT NULL,
  `origin` varchar(8) NOT NULL,
  `destenation` varchar(8) NOT NULL,
  `departure_time` datetime NOT NULL,
  `arrival_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `passenger`
--

CREATE TABLE `passenger` (
  `title` varchar(8) DEFAULT NULL,
  `first_name` varchar(24) NOT NULL,
  `last_name` varchar(32) NOT NULL,
  `nationality` varchar(10) NOT NULL,
  `passport` varchar(10) NOT NULL,
  `birth_date` date NOT NULL,
  `age_group` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `ticket`
--

CREATE TABLE `ticket` (
  `ticket_number` varchar(10) NOT NULL,
  `flight_number` varchar(8) NOT NULL,
  `class` varchar(16) NOT NULL,
  `adult_number` int(11) NOT NULL DEFAULT 1,
  `children_number` int(11) NOT NULL,
  `infants_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `user`
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
  ADD KEY `extras_foreign_key` (`passport`);

--
-- Indexes for table `flight`
--
ALTER TABLE `flight`
  ADD PRIMARY KEY (`flight_number`),
  ADD KEY `foreign_key` (`origin`),
  ADD KEY `foreign_key2` (`destenation`);

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
-- قيود الجداول المُلقاة.
--

--
-- قيود الجداول `credit_card`
--
ALTER TABLE `credit_card`
  ADD CONSTRAINT `credit_card_foreign_key` FOREIGN KEY (`passport`) REFERENCES `passenger` (`passport`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- قيود الجداول `extra`
--
ALTER TABLE `extra`
  ADD CONSTRAINT `extras2_foreign_key` FOREIGN KEY (`ticket_number`) REFERENCES `ticket` (`ticket_number`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `extras_foreign_key` FOREIGN KEY (`passport`) REFERENCES `flight` (`flight_number`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- قيود الجداول `flight`
--
ALTER TABLE `flight`
  ADD CONSTRAINT `foreign_key` FOREIGN KEY (`origin`) REFERENCES `cities` (`short_name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `foreign_key2` FOREIGN KEY (`destenation`) REFERENCES `cities` (`short_name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- قيود الجداول `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `Foregin_Key` FOREIGN KEY (`flight_number`) REFERENCES `flight` (`flight_number`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- قيود الجداول `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `Foreign key` FOREIGN KEY (`passport`) REFERENCES `passenger` (`passport`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
