-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 09, 2018 at 02:24 PM
-- Server version: 5.7.22
-- PHP Version: 7.1.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `camagru`
--

-- --------------------------------------------------------

--
-- Table structure for table `effects_img`
--

CREATE TABLE `effects_img` (
  `id_effect` int(11) NOT NULL,
  `effect_path` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `effects_img`
--

INSERT INTO `effects_img` (`id_effect`, `effect_path`) VALUES
(4, '../../public/img/effects_images/e1.png'),
(5, '../../public/img/effects_images/e2.png'),
(6, '../../public/img/effects_images/e3.png'),
(7, '../../public/img/effects_images/e4.png'),
(9, '../../public/img/effects_images/e5.png'),
(11, '../../public/img/effects_images/e6.png');

-- --------------------------------------------------------

--
-- Table structure for table `img_comments`
--

CREATE TABLE `img_comments` (
  `id_sender` int(11) NOT NULL,
  `id_receiver` int(11) NOT NULL,
  `id_img` int(11) NOT NULL,
  `comment_text` varchar(201) NOT NULL,
  `comment_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comment_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `img_likes`
--

CREATE TABLE `img_likes` (
  `like_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `img_id` int(11) NOT NULL,
  `like_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `path`
--

CREATE TABLE `path` (
  `id` int(11) NOT NULL,
  `path` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `path`
--

INSERT INTO `path` (`id`, `path`) VALUES
(1, '<^$>'),
(2, '<^gallery$>'),
(5, '<^registration/activate/checkSum=\\S{10}$>'),
(7, '<^Error_404$>'),
(8, '<^registration$>'),
(9, '<^autorization/unlog$>'),
(10, '<^restoring_psw$>'),
(11, '<^autorization$>'),
(12, '<^restoring_psw/activate/checkSum=\\S{10}$>'),
(13, '<^settings$>'),
(14, '<^settings/delete/checkSum=\\S{10}$>'),
(15, '<^gallery/show/\\d+$>'),
(16, '<^gallery/add_comment$>'),
(17, '<^gallery/add_like$>'),
(18, '<^gallery/show_comments$>'),
(19, '<^gallery/show_likes$>'),
(20, '<^my_gallery$>'),
(21, '<^my_gallery/del_img$>'),
(22, '<^my_gallery/lips$>');

-- --------------------------------------------------------

--
-- Table structure for table `users_images`
--

CREATE TABLE `users_images` (
  `img_id` int(11) NOT NULL,
  `img_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `img_path` varchar(128) NOT NULL,
  `user_id` int(11) NOT NULL,
  `count_likes` int(11) NOT NULL DEFAULT '0',
  `count_comments` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users_info`
--

CREATE TABLE `users_info` (
  `user_id` int(11) NOT NULL,
  `name` varchar(64) DEFAULT NULL,
  `email` varchar(64) DEFAULT NULL,
  `user_password` varchar(256) DEFAULT NULL,
  `notification` smallint(6) NOT NULL DEFAULT '1',
  `token` varchar(128) NOT NULL,
  `check_email` smallint(6) NOT NULL DEFAULT '0',
  `avatar` varchar(128) NOT NULL DEFAULT '../../public/img/images1.jpeg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `effects_img`
--
ALTER TABLE `effects_img`
  ADD PRIMARY KEY (`id_effect`);

--
-- Indexes for table `img_comments`
--
ALTER TABLE `img_comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `id_sender` (`id_sender`),
  ADD KEY `id_receiver` (`id_receiver`),
  ADD KEY `id_img` (`id_img`);

--
-- Indexes for table `img_likes`
--
ALTER TABLE `img_likes`
  ADD PRIMARY KEY (`like_id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `receiver_id` (`receiver_id`),
  ADD KEY `img_id` (`img_id`);

--
-- Indexes for table `path`
--
ALTER TABLE `path`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_images`
--
ALTER TABLE `users_images`
  ADD PRIMARY KEY (`img_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users_info`
--
ALTER TABLE `users_info`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `effects_img`
--
ALTER TABLE `effects_img`
  MODIFY `id_effect` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `img_comments`
--
ALTER TABLE `img_comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `img_likes`
--
ALTER TABLE `img_likes`
  MODIFY `like_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `path`
--
ALTER TABLE `path`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users_images`
--
ALTER TABLE `users_images`
  MODIFY `img_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `users_info`
--
ALTER TABLE `users_info`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `img_comments`
--
ALTER TABLE `img_comments`
  ADD CONSTRAINT `id_img` FOREIGN KEY (`id_img`) REFERENCES `users_images` (`img_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_receiver` FOREIGN KEY (`id_receiver`) REFERENCES `users_info` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_sender` FOREIGN KEY (`id_sender`) REFERENCES `users_info` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `img_likes`
--
ALTER TABLE `img_likes`
  ADD CONSTRAINT `img_id` FOREIGN KEY (`img_id`) REFERENCES `users_images` (`img_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `receiver_id` FOREIGN KEY (`receiver_id`) REFERENCES `users_info` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sender_id` FOREIGN KEY (`sender_id`) REFERENCES `users_info` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users_images`
--
ALTER TABLE `users_images`
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users_info` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
