-- phpMyAdmin SQL Dump
-- version 5.1.0-rc1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 12, 2021 at 02:17 AM
-- Server version: 8.0.23
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `duplitrade`
--

-- --------------------------------------------------------

--
-- Table structure for table `alerts_tickets`
--

CREATE TABLE `alerts_tickets` (
  `id` int NOT NULL,
  `ticket_id` bigint NOT NULL,
  `trading_room` int NOT NULL,
  `status` tinyint NOT NULL,
  `instrument` tinyint DEFAULT NULL,
  `type` tinyint NOT NULL,
  `amount` float NOT NULL,
  `open_price` float NOT NULL DEFAULT '0',
  `close_price` float DEFAULT NULL,
  `stop_loss` float DEFAULT NULL,
  `take_profit` float DEFAULT NULL,
  `current` float DEFAULT NULL,
  `pl` float NOT NULL DEFAULT '0',
  `gross_pl` float NOT NULL DEFAULT '0',
  `net_pl` float NOT NULL DEFAULT '0',
  `swap` float NOT NULL DEFAULT '0',
  `open_time` timestamp NULL DEFAULT NULL,
  `close_time` timestamp NULL DEFAULT NULL,
  `calculated_balance` float NOT NULL,
  `closed_position_cnt` int NOT NULL,
  `opened_time` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='table for tickets';

-- --------------------------------------------------------

--
-- Table structure for table `instruments`
--

CREATE TABLE `instruments` (
  `id` int NOT NULL,
  `instrument_name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `profit_calculate`
--

CREATE TABLE `profit_calculate` (
  `id` int NOT NULL,
  `traiding_room_id` int NOT NULL,
  `per_year` int NOT NULL,
  `monthly_avg_profit` float NOT NULL DEFAULT '0',
  `crated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE `statuses` (
  `id` int NOT NULL,
  `status_name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` bigint NOT NULL,
  `trading_room` int NOT NULL,
  `status` int NOT NULL,
  `instrument` int DEFAULT NULL,
  `type` int NOT NULL,
  `amount` float NOT NULL,
  `open_price` float NOT NULL DEFAULT '0',
  `close_price` float DEFAULT NULL,
  `stop_loss` float DEFAULT NULL,
  `take_profit` float DEFAULT NULL,
  `current` float DEFAULT NULL,
  `pl` float NOT NULL DEFAULT '0',
  `gross_pl` float NOT NULL DEFAULT '0',
  `net_pl` float NOT NULL DEFAULT '0',
  `swap` float NOT NULL DEFAULT '0',
  `open_time` timestamp NULL DEFAULT NULL,
  `close_time` timestamp NULL DEFAULT NULL,
  `calculated_balance` float NOT NULL,
  `closed_position_cnt` int NOT NULL,
  `opened_time` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='table for tickets';

-- --------------------------------------------------------

--
-- Table structure for table `trading_rooms`
--

CREATE TABLE `trading_rooms` (
  `id` int NOT NULL,
  `some_data` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'some_data',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='demo table for creating foreign key ';

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `id` int NOT NULL,
  `type_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='BUY,SELL, .....';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alerts_tickets`
--
ALTER TABLE `alerts_tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `instruments`
--
ALTER TABLE `instruments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `instrument_name` (`instrument_name`);

--
-- Indexes for table `profit_calculate`
--
ALTER TABLE `profit_calculate`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Room_year` (`traiding_room_id`,`per_year`) USING BTREE;

--
-- Indexes for table `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `status_name` (`status_name`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_ticket` (`id`,`trading_room`,`status`),
  ADD KEY `trading_room` (`trading_room`),
  ADD KEY `status` (`status`),
  ADD KEY `type` (`type`),
  ADD KEY `instrument` (`instrument`);

--
-- Indexes for table `trading_rooms`
--
ALTER TABLE `trading_rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `type_name` (`type_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alerts_tickets`
--
ALTER TABLE `alerts_tickets`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `instruments`
--
ALTER TABLE `instruments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `profit_calculate`
--
ALTER TABLE `profit_calculate`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trading_rooms`
--
ALTER TABLE `trading_rooms`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`trading_room`) REFERENCES `trading_rooms` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `tickets_ibfk_2` FOREIGN KEY (`status`) REFERENCES `statuses` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `tickets_ibfk_3` FOREIGN KEY (`type`) REFERENCES `types` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `tickets_ibfk_4` FOREIGN KEY (`instrument`) REFERENCES `instruments` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
