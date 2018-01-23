-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3307
-- Время создания: Янв 22 2018 г., 05:51
-- Версия сервера: 10.2.8-MariaDB
-- Версия PHP: 5.6.31

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `beer_test`
--

--
-- Очистить таблицу перед добавлением данных `beers`
--

TRUNCATE TABLE `beers`;
--
-- Дамп данных таблицы `beers`
--

INSERT INTO `beers` (`id`, `name`, `text`, `type_id`, `brand_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Sam Adams Utopias', 'Sam Adams Utopias desc', 2, 7, 1, '2018-01-22 03:35:51', '2018-01-22 03:35:51'),
(2, 'Билк', 'Билк desc', 12, 8, 0, '2018-01-22 03:37:11', '2018-01-22 03:37:34'),
(3, 'Cave Creek Chili Beer', 'Cave Creek Chili Beer desc', 1, 9, 0, '2018-01-22 03:39:07', '2018-01-22 03:39:07'),
(4, 'Lindemans Kriek Cherry Lambic', 'Lindemans Kriek Cherry Lambic desc', 13, 10, 1, '2018-01-22 03:40:16', '2018-01-22 03:40:44'),
(5, 'Mamma Mia Pizza Beer', 'Mamma Mia Pizza Beer desc', 9, 11, 0, '2018-01-22 03:46:49', '2018-01-22 03:46:49'),
(6, 'Gueuze', 'Gueuze desc', 13, 12, 0, '2018-01-22 03:49:43', '2018-01-22 03:49:43'),
(7, 'Framboise', 'Framboise desc', 13, 12, 0, '2018-01-22 03:50:13', '2018-01-22 03:50:13');

--
-- Очистить таблицу перед добавлением данных `beer_types`
--

TRUNCATE TABLE `beer_types`;
--
-- Дамп данных таблицы `beer_types`
--

INSERT INTO `beer_types` (`id`, `name`) VALUES
(1, 'Светлое'),
(2, 'Темное'),
(3, 'Безалкогольное'),
(4, 'Живое'),
(5, 'Ржаное'),
(6, 'Рисовое'),
(7, 'Кукурузное'),
(8, 'Картофельное'),
(9, 'Овощное'),
(10, 'Банановое'),
(11, 'Травяное'),
(12, 'Молочное'),
(13, 'Фруктовое');

--
-- Очистить таблицу перед добавлением данных `brands`
--

TRUNCATE TABLE `brands`;
--
-- Дамп данных таблицы `brands`
--

INSERT INTO `brands` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(3, 'Оболонь', 1, '2018-01-22 03:35:11', '2018-01-22 03:35:11'),
(4, 'Карлсберг', 1, '2018-01-22 03:35:11', '2018-01-22 03:35:11'),
(5, 'САН ИнБев', 1, '2018-01-22 03:35:11', '2018-01-22 03:35:11'),
(6, 'Радомышль', 1, '2018-01-22 03:35:11', '2018-01-22 03:35:11'),
(7, 'Samuel Adams', 0, '2018-01-22 03:35:11', '2018-01-22 03:35:11'),
(8, 'Хоккайдо', 0, '2018-01-22 03:36:47', '2018-01-22 03:36:47'),
(9, 'Black Mountain', 0, '2018-01-22 03:37:48', '2018-01-22 03:37:48'),
(10, 'бельгийское', 0, '2018-01-22 03:39:24', '2018-01-22 03:39:24'),
(11, 'Mamma Mia Pizza Beer', 1, '2018-01-22 03:46:29', '2018-01-22 03:46:29'),
(12, 'Bell-Vue', 1, '2018-01-22 03:49:20', '2018-01-22 03:49:20');
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
