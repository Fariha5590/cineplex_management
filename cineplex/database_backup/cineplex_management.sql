-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 13, 2017 at 06:22 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cineplex_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `username` varchar(30) NOT NULL,
  `password` char(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`username`, `password`) VALUES
('admin', 'password');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_orders`
--

CREATE TABLE `ticket_orders` (
  `customer_name` varchar(30) NOT NULL,
  `order_id` int(11) NOT NULL,
  `movie_name` varchar(30) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `movie_time` datetime DEFAULT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ticket_orders`
--

INSERT INTO `ticket_orders` (`customer_name`, `order_id`, `movie_name`, `movie_id`, `movie_time`, `quantity`) VALUES
('zubayer', 3, 'Despicable Me 2', 1002, '2017-08-09 12:00:00', 4),
('fariha', 1, 'Spiderman', 1001, '2017-08-09 09:00:00', 40),
('zubayer', 2, 'Spiderman', 1001, '2017-08-09 09:00:00', 20),
('zubayer', 4, 'Spiderman', 1001, '2017-08-09 09:00:00', 17),
('fariha', 6, 'Despicable Me 2', 1002, '2017-08-09 12:00:00', 12);

-- --------------------------------------------------------

--
-- Table structure for table `ticket_status`
--

CREATE TABLE `ticket_status` (
  `movie_id` int(11) NOT NULL,
  `movie_name` varchar(30) NOT NULL,
  `time_date` datetime NOT NULL,
  `available_tickets` int(11) NOT NULL,
  `max_tickets` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ticket_status`
--

INSERT INTO `ticket_status` (`movie_id`, `movie_name`, `time_date`, `available_tickets`, `max_tickets`) VALUES
(1001, 'Spiderman: Homecoming', '2017-08-10 06:00:00', 200, 200),
(1002, 'Dunkirk', '2017-08-11 13:00:00', 200, 200),
(1003, 'Despicable Me 3', '2017-08-10 15:00:00', 200, 200),
(1004, 'Dhaka Attack', '2017-08-16 10:00:00', 200, 200),
(1005, 'Kung Fu Panda', '2017-08-12 12:00:00', 220, 220);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `name` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` char(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`name`, `username`, `email`, `password`) VALUES
('Fariha', 'fariha', 'fariha@gmail.com', '111111'),
('Tanjid Hasan', 'imu', 'imu@gmail.com', 'iiiiii'),
('Sayma Afrin', 'sayma', 'sayma@gmail.com', 'ssssss'),
('ASM Salauddin', 'shadow', 'shadow@gmail.com', 'shadow'),
('Zubayer', 'zubayer', 'zubayer@gmail.com', 'rrrrrr');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `ticket_orders`
--
ALTER TABLE `ticket_orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `ticket_status`
--
ALTER TABLE `ticket_status`
  ADD PRIMARY KEY (`movie_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `username` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
