-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 17, 2019 at 04:01 PM
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
  `phone` varchar(11) NOT NULL,
  `admin_type` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `phone`, `admin_type`) VALUES
(1, 'mahmudul', 'mahmudul@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '01630811624', 1),
(2, 'Test Admin', 'test@gmail.com', '25f9e794323b453885f5181f1b624d0b', '01630811624', 0);

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
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `description`) VALUES
(1, 'About Us', '&lt;p&gt;It is a long established fact that a reader will be distracted by the \r\nreadable content of a page when looking at its layout. The point of \r\nusing Lorem Ipsum is that it has a more-or-less normal distribution of \r\nletters, as opposed to using \'Content here, content here\', making it \r\nlook like readable English. Many desktop publishing packages and web \r\npage editors now use Lorem Ipsum as their default model text, and a \r\nsearch for \'lorem ipsum\' will uncover many web sites still in their \r\ninfancy.&lt;/p&gt;&lt;p&gt;It is a long established fact that a reader will be distracted by the \r\nreadable content of a page when looking at its layout. The point of \r\nusing Lorem Ipsum is that it has a more-or-less normal distribution of \r\nletters, as opposed to using \'Content here, content here\', making it \r\nlook like readable English. Many desktop publishing packages and web \r\npage editors now use Lorem Ipsum as their default model text, and a \r\nsearch for \'lorem ipsum\' will uncover many web sites still in their \r\ninfancy.&lt;/p&gt;&lt;p&gt;It is a long established fact that a reader will be distracted by the \r\nreadable content of a page when looking at its layout. The point of \r\nusing Lorem Ipsum is that it has a more-or-less normal distribution of \r\nletters, as opposed to using \'Content here, content here\', making it \r\nlook like readable English. Many desktop publishing packages and web \r\npage editors now use Lorem Ipsum as their default model text, and a \r\nsearch for \'lorem ipsum\' will uncover many web sites still in their \r\ninfancy.&lt;/p&gt;&lt;p&gt;It is a long established fact that a reader will be distracted by the \r\nreadable content of a page when looking at its layout. The point of \r\nusing Lorem Ipsum is that it has a more-or-less normal distribution of \r\nletters, as opposed to using \'Content here, content here\', making it \r\nlook like readable English. Many desktop publishing packages and web \r\npage editors now use Lorem Ipsum as their default model text, and a \r\nsearch for \'lorem ipsum\' will uncover many web sites still in their \r\ninfancy.&lt;/p&gt;');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` int(10) UNSIGNED NOT NULL,
  `provider_id` int(10) UNSIGNED NOT NULL,
  `service_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`id`, `provider_id`, `service_id`, `user_id`, `date`) VALUES
(2, 14, 7, 16, '2019-08-02 18:16:56'),
(3, 14, 6, 16, '2019-08-02 18:33:45'),
(4, 15, 8, 16, '2019-08-04 13:21:04'),
(5, 15, 10, 14, '2019-08-08 19:29:13');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) UNSIGNED NOT NULL,
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
(7, 'Car Engine Repair', 'Gulshan', '01632659891', 6, 14, '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo unde molestiae earum labore, repellendus ad, ullam ipsam a tempore quibusdam eaque. Voluptatum praesentium veritatis quisquam quia corporis magnam libero voluptates.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo unde molestiae earum labore, repellendus ad, ullam ipsam a tempore quibusdam eaque. Voluptatum praesentium veritatis quisquam quia corporis magnam libero voluptates.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo unde molestiae earum labore, repellendus ad, ullam ipsam a tempore quibusdam eaque. Voluptatum praesentium veritatis quisquam quia corporis magnam libero voluptates.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo unde molestiae earum labore, repellendus ad, ullam ipsam a tempore quibusdam eaque. Voluptatum praesentium veritatis quisquam quia corporis magnam libero voluptates.&lt;br&gt;&lt;/p&gt;', '10000', '271d3fdc29.jpg', '2019-07-30 13:15:31'),
(8, 'Car Tire Repair', 'Badda Dahaka', '012635982', 6, 15, '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sequi placeat, consequuntur debitis! Aspernatur quis facere odit adipisci nisi aliquid sint aperiam, suscipit porro, dolore praesentium excepturi ut labore repellendus debitis.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sequi placeat, consequuntur debitis! Aspernatur quis facere odit adipisci nisi aliquid sint aperiam, suscipit porro, dolore praesentium excepturi ut labore repellendus debitis.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sequi placeat, consequuntur debitis! Aspernatur quis facere odit adipisci nisi aliquid sint aperiam, suscipit porro, dolore praesentium excepturi ut labore repellendus debitis.&lt;br&gt;&lt;/p&gt;', '1500', '5f4212ac4f.jpg', '2019-08-04 13:19:35'),
(9, 'Wash &amp; Color', 'Banani', '0126359842', 5, 15, '&lt;p&gt;It is a long established fact that a reader will be distracted by the \r\nreadable content of a page when looking at its layout. The point of \r\nusing Lorem Ipsum is that it has a more-or-less normal distribution of \r\nletters, as opposed to using \'Content here, content here\', making it \r\nlook like readable English. Many desktop publishing packages and web \r\npage editors now use Lorem Ipsum as their default model text, and a \r\nsearch for \'lorem ipsum\' will uncover many web sites still in their \r\ninfancy.&lt;/p&gt;', '5000', '64413304fb.jpg', '2019-08-04 18:01:58'),
(10, 'Clean Car Glass', 'Baridhara', '0163256463', 5, 15, '&lt;p&gt;It is a long established fact that a reader will be distracted by the \r\nreadable content of a page when looking at its layout. The point of \r\nusing Lorem Ipsum is that it has a more-or-less normal distribution of \r\nletters, as opposed to using \'Content here, content here\', making it \r\nlook like readable English. Many desktop publishing packages and web \r\npage editors now use Lorem Ipsum as their default model text, and a \r\nsearch for \'lorem ipsum\' will uncover many web sites still in their \r\ninfancy.&lt;/p&gt;', '500', 'f7ccb79049.jpg', '2019-08-04 18:06:31');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(150) NOT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `address`, `phone`, `email`, `facebook`, `linkedin`, `instagram`) VALUES
(1, 'Service &amp; Wash Your Car', 'New York, 94126, USA', '+ 01 234 567 89', 'contact@example.com', 'http://www.facebook.com', 'http://www.linkedin.com', 'http://www.instagram.com');

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
(15, 'Jhon Doe', 'jhon@gmail.com', '01630811624', 1, '$2y$10$NgqQ0XEyKT38FsQBHlMe7OzM9Z.AQLOcIieC5kDFECJ8lHD0sVRe6', '', 1, '2019-07-30 14:53:33'),
(16, 'Mark Doe', 'mark@gmail.com', '01630811624', 3, '$2y$10$fxbfLZcxqOJ/V289zyoV/uhlt..iQotKp0YutaTVty06sfMr1Id0G', '', 1, '2019-08-01 16:02:38');

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
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_id_2` (`user_id`),
  ADD KEY `fk_service_id` (`service_id`),
  ADD KEY `fk_provider_id` (`provider_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_category_id` (`category_id`),
  ADD KEY `fk_user_id` (`user_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user_categories`
--
ALTER TABLE `user_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `requests`
--
ALTER TABLE `requests`
  ADD CONSTRAINT `fk_provider_id` FOREIGN KEY (`provider_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_service_id` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_user_id_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

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
