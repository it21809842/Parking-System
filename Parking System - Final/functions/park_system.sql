-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 04, 2022 at 03:45 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `park_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_contacts`
--

CREATE TABLE `admin_contacts` (
  `id` int(11) NOT NULL,
  `title` varchar(500) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `slot_id` int(11) NOT NULL,
  `floor_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `plate_no` varchar(8) NOT NULL,
  `vehical_type` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `booking_status` int(1) NOT NULL COMMENT '1=released\r\n2=booked',
  `booked_date` datetime NOT NULL,
  `release_date` datetime NOT NULL,
  `checkout_date` datetime DEFAULT NULL,
  `fine` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `floors`
--

CREATE TABLE `floors` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `floors`
--

INSERT INTO `floors` (`id`, `name`) VALUES
(1, '1 st Floor'),
(2, '2 nd Floor'),
(3, '3 rd Floor'),
(4, '4 th Floor'),
(5, '5 th Floor');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(500) NOT NULL,
  `description` text NOT NULL,
  `rate` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `site_visits`
--

CREATE TABLE `site_visits` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `slots`
--

CREATE TABLE `slots` (
  `id` int(11) NOT NULL,
  `slot_number` int(11) NOT NULL,
  `floor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `slots`
--

INSERT INTO `slots` (`id`, `slot_number`, `floor_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 5, 1),
(6, 6, 1),
(7, 7, 1),
(8, 8, 1),
(9, 9, 1),
(10, 10, 1),
(11, 11, 1),
(12, 12, 1),
(13, 13, 1),
(14, 14, 1),
(15, 15, 1),
(16, 16, 1),
(17, 17, 1),
(18, 18, 1),
(19, 19, 1),
(20, 20, 1),
(21, 21, 1),
(22, 22, 1),
(23, 23, 1),
(24, 24, 1),
(25, 25, 1),
(26, 26, 1),
(27, 27, 1),
(28, 28, 1),
(29, 29, 1),
(30, 30, 1),
(31, 31, 1),
(32, 32, 1),
(33, 33, 1),
(34, 34, 1),
(35, 35, 1),
(36, 36, 1),
(37, 37, 1),
(38, 38, 1),
(39, 39, 1),
(40, 40, 1),
(41, 41, 1),
(42, 42, 1),
(43, 43, 1),
(44, 44, 1),
(45, 45, 1),
(46, 46, 1),
(47, 47, 1),
(48, 48, 1),
(49, 49, 1),
(50, 50, 1),
(51, 51, 1),
(52, 52, 1),
(53, 53, 1),
(54, 54, 1),
(55, 55, 1),
(56, 56, 1),
(57, 57, 1),
(58, 58, 1),
(59, 59, 1),
(60, 60, 1),
(61, 1, 2),
(62, 2, 2),
(63, 3, 2),
(64, 4, 2),
(65, 5, 2),
(66, 6, 2),
(67, 7, 2),
(68, 8, 2),
(69, 9, 2),
(70, 10, 2),
(71, 11, 2),
(72, 12, 2),
(73, 13, 2),
(74, 14, 2),
(75, 15, 2),
(76, 16, 2),
(77, 17, 2),
(78, 18, 2),
(79, 19, 2),
(80, 20, 2),
(81, 21, 2),
(82, 22, 2),
(83, 23, 2),
(84, 24, 2),
(85, 25, 2),
(86, 26, 2),
(87, 27, 2),
(88, 28, 2),
(89, 29, 2),
(90, 30, 2),
(91, 31, 2),
(92, 32, 2),
(93, 33, 2),
(94, 34, 2),
(95, 35, 2),
(96, 36, 2),
(97, 37, 2),
(98, 38, 2),
(99, 39, 2),
(100, 40, 2),
(101, 41, 2),
(102, 42, 2),
(103, 43, 2),
(104, 44, 2),
(105, 45, 2),
(106, 46, 2),
(107, 47, 2),
(108, 48, 2),
(109, 49, 2),
(110, 50, 2),
(111, 51, 2),
(112, 52, 2),
(113, 53, 2),
(114, 54, 2),
(115, 55, 2),
(116, 56, 2),
(117, 57, 2),
(118, 58, 2),
(119, 59, 2),
(120, 60, 2),
(121, 1, 3),
(122, 2, 3),
(123, 3, 3),
(124, 4, 3),
(125, 5, 3),
(126, 6, 3),
(127, 7, 3),
(128, 8, 3),
(129, 9, 3),
(130, 10, 3),
(131, 11, 3),
(132, 12, 3),
(133, 13, 3),
(134, 14, 3),
(135, 15, 3),
(136, 16, 3),
(137, 17, 3),
(138, 18, 3),
(139, 19, 3),
(140, 20, 3),
(141, 21, 3),
(142, 22, 3),
(143, 23, 3),
(144, 24, 3),
(145, 25, 3),
(146, 26, 3),
(147, 27, 3),
(148, 28, 3),
(149, 29, 3),
(150, 30, 3),
(151, 31, 3),
(152, 32, 3),
(153, 33, 3),
(154, 34, 3),
(155, 35, 3),
(156, 36, 3),
(157, 37, 3),
(158, 38, 3),
(159, 39, 3),
(160, 40, 3),
(161, 41, 3),
(162, 42, 3),
(163, 43, 3),
(164, 44, 3),
(165, 45, 3),
(166, 46, 3),
(167, 47, 3),
(168, 48, 3),
(169, 49, 3),
(170, 50, 3),
(171, 51, 3),
(172, 52, 3),
(173, 53, 3),
(174, 54, 3),
(175, 55, 3),
(176, 56, 3),
(177, 57, 3),
(178, 58, 3),
(179, 59, 3),
(180, 60, 3),
(181, 1, 4),
(182, 2, 4),
(183, 3, 4),
(184, 4, 4),
(185, 5, 4),
(186, 6, 4),
(187, 7, 4),
(188, 8, 4),
(189, 9, 4),
(190, 10, 4),
(191, 11, 4),
(192, 12, 4),
(193, 13, 4),
(194, 14, 4),
(195, 15, 4),
(196, 16, 4),
(197, 17, 4),
(198, 18, 4),
(199, 19, 4),
(200, 20, 4),
(201, 21, 4),
(202, 22, 4),
(203, 23, 4),
(204, 24, 4),
(205, 25, 4),
(206, 26, 4),
(207, 27, 4),
(208, 28, 4),
(209, 29, 4),
(210, 30, 4),
(211, 31, 4),
(212, 32, 4),
(213, 33, 4),
(214, 34, 4),
(215, 35, 4),
(216, 36, 4),
(217, 37, 4),
(218, 38, 4),
(219, 39, 4),
(220, 40, 4),
(221, 41, 4),
(222, 42, 4),
(223, 43, 4),
(224, 44, 4),
(225, 45, 4),
(226, 46, 4),
(227, 47, 4),
(228, 48, 4),
(229, 49, 4),
(230, 50, 4),
(231, 51, 4),
(232, 52, 4),
(233, 53, 4),
(234, 54, 4),
(235, 55, 4),
(236, 56, 4),
(237, 57, 4),
(238, 58, 4),
(239, 59, 4),
(240, 60, 4),
(241, 1, 5),
(242, 2, 5),
(243, 3, 5),
(244, 4, 5),
(245, 5, 5),
(246, 6, 5),
(247, 7, 5),
(248, 8, 5),
(249, 9, 5),
(250, 10, 5),
(251, 11, 5),
(252, 12, 5),
(253, 13, 5),
(254, 14, 5),
(255, 15, 5),
(256, 16, 5),
(257, 17, 5),
(258, 18, 5),
(259, 19, 5),
(260, 20, 5),
(261, 21, 5),
(262, 22, 5),
(263, 23, 5),
(264, 24, 5),
(265, 25, 5),
(266, 26, 5),
(267, 27, 5),
(268, 28, 5),
(269, 29, 5),
(270, 30, 5),
(271, 31, 5),
(272, 32, 5),
(273, 33, 5),
(274, 34, 5),
(275, 35, 5),
(276, 36, 5),
(277, 37, 5),
(278, 38, 5),
(279, 39, 5),
(280, 40, 5),
(281, 41, 5),
(282, 42, 5),
(283, 43, 5),
(284, 44, 5),
(285, 45, 5),
(286, 46, 5),
(287, 47, 5),
(288, 48, 5),
(289, 49, 5),
(290, 50, 5),
(291, 51, 5),
(292, 52, 5),
(293, 53, 5),
(294, 54, 5),
(295, 55, 5),
(296, 56, 5),
(297, 57, 5),
(298, 58, 5),
(299, 59, 5),
(300, 60, 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(100) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `user_role` int(1) NOT NULL COMMENT '1=admin\r\n2=user\r\n3=employee',
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `vehical_types`
--

CREATE TABLE `vehical_types` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `cost` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vehical_types`
--

INSERT INTO `vehical_types` (`id`, `type`, `cost`) VALUES
(1, 'Hatchback', 50),
(2, 'Station Wagon', 100),
(3, 'Sedan', 150),
(4, 'SUVs/Minivan', 200),
(5, 'Pickup Truck', 250),
(6, 'Van/Prado/Montero', 400);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_contacts`
--
ALTER TABLE `admin_contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `floors`
--
ALTER TABLE `floors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_visits`
--
ALTER TABLE `site_visits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slots`
--
ALTER TABLE `slots`
  ADD PRIMARY KEY (`id`),
  ADD KEY `floor_id` (`floor_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_name` (`user_name`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `vehical_types`
--
ALTER TABLE `vehical_types`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_contacts`
--
ALTER TABLE `admin_contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `floors`
--
ALTER TABLE `floors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `site_visits`
--
ALTER TABLE `site_visits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `slots`
--
ALTER TABLE `slots`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=301;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vehical_types`
--
ALTER TABLE `vehical_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `slots`
--
ALTER TABLE `slots`
  ADD CONSTRAINT `slots_ibfk_1` FOREIGN KEY (`floor_id`) REFERENCES `floors` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
