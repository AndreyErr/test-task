-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: Mysql_db
-- Время создания: Май 08 2023 г., 17:16
-- Версия сервера: 10.11.2-MariaDB-1:10.11.2+maria~ubu2204
-- Версия PHP: 8.1.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `test`
--

-- --------------------------------------------------------

--
-- Структура таблицы `events`
--

CREATE TABLE `events` (
  `id` int(6) NOT NULL,
  `event_name` varchar(150) NOT NULL,
  `user_status` tinyint(1) NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `event_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `events`
--

INSERT INTO `events` (`id`, `event_name`, `user_status`, `ip_address`, `event_date`) VALUES
(27, 'aaabcd', 0, '172.19.0.1', '2023-05-08'),
(28, 'aaabcd', 1, '172.19.0.1', '2023-05-08'),
(29, 'aaabcd', 0, '172.19.0.1', '2023-05-08'),
(30, 'aaabcd', 1, '172.19.0.1', '2023-05-08'),
(31, 'aaabcd', 1, '172.19.0.1', '2023-05-08'),
(32, 'aaabcd', 1, '172.19.0.2', '2023-05-08'),
(33, 'aaabcd', 1, '172.19.0.1', '2023-05-08'),
(34, 'aaabcd', 1, '172.19.0.1', '2023-05-09'),
(35, 'aaabc', 1, '172.19.0.3', '2023-05-08'),
(36, 'aaabcd', 1, '172.19.0.1', '2023-05-08'),
(37, 'aaabcd', 0, '172.19.0.1', '2023-05-09'),
(38, 'aaabcd', 0, '172.19.0.2', '2023-05-08'),
(39, 'aaabcd', 0, '172.19.0.3', '2023-05-08'),
(40, 'aaabcd', 0, '172.19.0.1', '2023-05-09'),
(41, 'aaabcd', 0, '172.19.0.1', '2023-05-08'),
(42, 'aaabcd', 0, '172.19.0.1', '2023-05-08'),
(43, 'aaabcd', 0, '172.19.0.2', '2023-05-09'),
(44, 'aaabcd', 0, '172.19.0.1', '2023-05-08'),
(45, 'aaabcd', 1, '172.19.0.1', '2023-05-08');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `events`
--
ALTER TABLE `events`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
