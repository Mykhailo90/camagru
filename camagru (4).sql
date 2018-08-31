-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 31, 2018 at 08:47 PM
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

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=``@`127.0.0.1` PROCEDURE `path_in_program` ()  READS SQL DATA
BEGIN SELECT path FROM path; END$$

DELIMITER ;

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
(1, 'effects_images/Alfa-Romeo.png'),
(2, 'effects_images/ball.jpeg'),
(3, 'effects_images/cat.jpeg'),
(4, 'effects_images/kisspng.jpg'),
(5, 'effects_images/linux.png'),
(6, 'effects_images/lubWater.png'),
(7, 'effects_images/mario_heart.png'),
(8, 'effects_images/mult.png'),
(9, 'effects_images/Plane_1.jpg'),
(10, 'effects_images/umbrella.png'),
(11, 'effects_images/water1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `img_comments`
--

CREATE TABLE `img_comments` (
  `comment_id` int(11) NOT NULL,
  `id_sender` int(11) NOT NULL,
  `id_receiver` int(11) NOT NULL,
  `id_img` int(11) NOT NULL,
  `comment_text` varchar(4000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `img_likes`
--

CREATE TABLE `img_likes` (
  `like_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `img_id` int(11) NOT NULL
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
(11, '<^autorization$>');

-- --------------------------------------------------------

--
-- Table structure for table `users_images`
--

CREATE TABLE `users_images` (
  `img_id` int(11) NOT NULL,
  `img_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `img_path` int(11) NOT NULL,
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
  `check_email` smallint(6) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_info`
--

INSERT INTO `users_info` (`user_id`, `name`, `email`, `user_password`, `notification`, `token`, `check_email`) VALUES
(20, 'Misha', '0660330233@ukr.net', '$2y$10$1ayLumNfZ4Z2YQOYiyXAtO8qNmfPv2KEzml86N6MwSvp526QVhUmW', 1, '2W6Vq$1vm6', 1);

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
-- AUTO_INCREMENT for table `img_likes`
--
ALTER TABLE `img_likes`
  MODIFY `like_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `path`
--
ALTER TABLE `path`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users_images`
--
ALTER TABLE `users_images`
  MODIFY `img_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users_info`
--
ALTER TABLE `users_info`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

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
