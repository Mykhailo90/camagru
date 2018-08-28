-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Авг 28 2018 г., 21:16
-- Версия сервера: 10.0.34-MariaDB-0ubuntu0.16.04.1
-- Версия PHP: 7.0.30-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `camagru`
--

DELIMITER $$
--
-- Процедуры
--
CREATE DEFINER=`msarapii`@`localhost` PROCEDURE `path_in_program` ()  BEGIN
	    SELECT path FROM path;
    END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `effects_img`
--

CREATE TABLE `effects_img` (
  `id_effect` int(11) NOT NULL,
  `effect_path` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `effects_img`
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
-- Структура таблицы `gifs`
--

CREATE TABLE `gifs` (
  `gif_id` int(11) NOT NULL,
  `gif_path` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `img_comments`
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
-- Структура таблицы `img_likes`
--

CREATE TABLE `img_likes` (
  `like_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `img_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `path`
--

CREATE TABLE `path` (
  `id` int(11) NOT NULL,
  `path` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `path`
--

INSERT INTO `path` (`id`, `path`) VALUES
(1, ''),
(2, 'gallery'),
(3, 'Error_404');

-- --------------------------------------------------------

--
-- Структура таблицы `test`
--

CREATE TABLE `test` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `test`
--

INSERT INTO `test` (`id`, `name`) VALUES
(1, 'Roma'),
(2, 'Kolia'),
(3, 'Vasya'),
(4, 'Vania');

-- --------------------------------------------------------

--
-- Структура таблицы `users_images`
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
-- Структура таблицы `users_info`
--

CREATE TABLE `users_info` (
  `user_id` int(11) NOT NULL,
  `name` varchar(64) DEFAULT NULL,
  `email` varchar(64) DEFAULT NULL,
  `user_password` varchar(256) DEFAULT NULL,
  `user_avatar_path` varchar(256) DEFAULT 'u_images/incognito.jpg',
  `gif_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users_info`
--

INSERT INTO `users_info` (`user_id`, `name`, `email`, `user_password`, `user_avatar_path`, `gif_id`) VALUES
(1, 'msarapii', '0660330233@ukr.net', '$2y$10$gLJBptRbOxSBIXXw.zb.au2Lavhescsq7Dnd4eU57ckyoCRIChEI2', 'u_images/incognito.jpg', NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `effects_img`
--
ALTER TABLE `effects_img`
  ADD PRIMARY KEY (`id_effect`);

--
-- Индексы таблицы `gifs`
--
ALTER TABLE `gifs`
  ADD PRIMARY KEY (`gif_id`);

--
-- Индексы таблицы `img_comments`
--
ALTER TABLE `img_comments`
  ADD KEY `id_sender` (`id_sender`),
  ADD KEY `id_receiver` (`id_receiver`),
  ADD KEY `id_img` (`id_img`);

--
-- Индексы таблицы `img_likes`
--
ALTER TABLE `img_likes`
  ADD PRIMARY KEY (`like_id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `receiver_id` (`receiver_id`),
  ADD KEY `img_id` (`img_id`);

--
-- Индексы таблицы `path`
--
ALTER TABLE `path`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users_images`
--
ALTER TABLE `users_images`
  ADD PRIMARY KEY (`img_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `users_info`
--
ALTER TABLE `users_info`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `gif_id` (`gif_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `effects_img`
--
ALTER TABLE `effects_img`
  MODIFY `id_effect` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT для таблицы `gifs`
--
ALTER TABLE `gifs`
  MODIFY `gif_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `img_likes`
--
ALTER TABLE `img_likes`
  MODIFY `like_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `path`
--
ALTER TABLE `path`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `test`
--
ALTER TABLE `test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `users_images`
--
ALTER TABLE `users_images`
  MODIFY `img_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `users_info`
--
ALTER TABLE `users_info`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `img_comments`
--
ALTER TABLE `img_comments`
  ADD CONSTRAINT `id_img` FOREIGN KEY (`id_img`) REFERENCES `users_images` (`img_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_receiver` FOREIGN KEY (`id_receiver`) REFERENCES `users_info` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_sender` FOREIGN KEY (`id_sender`) REFERENCES `users_info` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `img_likes`
--
ALTER TABLE `img_likes`
  ADD CONSTRAINT `img_id` FOREIGN KEY (`img_id`) REFERENCES `users_images` (`img_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `receiver_id` FOREIGN KEY (`receiver_id`) REFERENCES `users_info` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sender_id` FOREIGN KEY (`sender_id`) REFERENCES `users_info` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `users_images`
--
ALTER TABLE `users_images`
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users_info` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `users_info`
--
ALTER TABLE `users_info`
  ADD CONSTRAINT `gif_id` FOREIGN KEY (`gif_id`) REFERENCES `gifs` (`gif_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
