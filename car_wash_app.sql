-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 30, 2019 at 07:05 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `car_wash_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(140) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(32) NOT NULL,
  `phone` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `phone`) VALUES
(1, 'mahmudul', 'mahmudul@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '01630811624');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(140) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(5, 'Car Wash'),
(6, 'Car Repair');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `location` varchar(150) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `description` text NOT NULL,
  `price` varchar(20) NOT NULL,
  `image` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `location`, `phone`, `category_id`, `user_id`, `description`, `price`, `image`, `date`) VALUES
(6, 'Washing Car With Resonable Cost', 'Badda', '01635689521', 5, 14, '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\n tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim \r\nveniam,&lt;br&gt;quis nostrud exercitation ullamco laboris nisi ut aliquip ex \r\nea commodo consequat. Duis aute irure dolor in reprehenderit in \r\nvoluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur \r\nsint occaecat cupidatat non proident, sunt in culpa qui officia deserunt\r\n mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\n tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim \r\nveniam,&lt;br&gt;quis nostrud exercitation ullamco laboris nisi ut aliquip ex \r\nea commodo consequat. Duis aute irure dolor in reprehenderit in \r\nvoluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur \r\nsint occaecat cupidatat non proident, sunt in culpa qui officia deserunt\r\n mollit anim id est laborum.&lt;/p&gt;', '2000', '6e0d79a674.jpg', '2019-07-30 12:16:08'),
(7, 'Car Engine Repair', 'Gulshan', '01632659891', 6, 14, '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo unde molestiae earum labore, repellendus ad, ullam ipsam a tempore quibusdam eaque. Voluptatum praesentium veritatis quisquam quia corporis magnam libero voluptates.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo unde molestiae earum labore, repellendus ad, ullam ipsam a tempore quibusdam eaque. Voluptatum praesentium veritatis quisquam quia corporis magnam libero voluptates.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo unde molestiae earum labore, repellendus ad, ullam ipsam a tempore quibusdam eaque. Voluptatum praesentium veritatis quisquam quia corporis magnam libero voluptates.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo unde molestiae earum labore, repellendus ad, ullam ipsam a tempore quibusdam eaque. Voluptatum praesentium veritatis quisquam quia corporis magnam libero voluptates.&lt;br&gt;&lt;/p&gt;', '10000', '271d3fdc29.jpg', '2019-07-30 13:15:31');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `full_name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `user_type` int(11) NOT NULL,
  `password` varchar(140) NOT NULL,
  `reset_code` varchar(32) DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `phone`, `user_type`, `password`, `reset_code`, `is_active`, `date`) VALUES
(14, 'Mahmudul Hassan', 'mahmudul.hassan240@gmail.com', '01630811624', 1, '$2y$10$rLUcMVoQtbS.b0xx.5Bfo.6pjH7LgnRGIoJL6vxRCUvFPNIP6b9Tm', '', 1, '2019-07-30 08:43:22'),
(15, 'Jhon Doe', 'jhon@gmail.com', '01630811624', 1, '$2y$10$NgqQ0XEyKT38FsQBHlMe7OzM9Z.AQLOcIieC5kDFECJ8lHD0sVRe6', '', 1, '2019-07-30 14:53:33');

-- --------------------------------------------------------

--
-- Table structure for table `user_categories`
--

CREATE TABLE `user_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(140) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_categories`
--

INSERT INTO `user_categories` (`id`, `name`) VALUES
(1, 'Service Provider'),
(3, 'User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_category_id` (`category_id`),
  ADD KEY `fk_user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_type` (`user_type`);

--
-- Indexes for table `user_categories`
--
ALTER TABLE `user_categories`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user_categories`
--
ALTER TABLE `user_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `fk_category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_user_type` FOREIGN KEY (`user_type`) REFERENCES `user_categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
