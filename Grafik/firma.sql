-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Ноя 10 2016 г., 08:46
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `firma`
--

-- --------------------------------------------------------

--
-- Структура таблицы `department`
--

CREATE TABLE IF NOT EXISTS `department` (
  `key_dep` int(11) NOT NULL AUTO_INCREMENT,
  `name_d` varchar(50) NOT NULL,
  PRIMARY KEY (`key_dep`),
  UNIQUE KEY `key_dep` (`key_dep`),
  KEY `key_dep_2` (`key_dep`),
  KEY `key_dep_3` (`key_dep`),
  KEY `key_dep_4` (`key_dep`),
  KEY `key_dep_5` (`key_dep`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `department`
--

INSERT INTO `department` (`key_dep`, `name_d`) VALUES
(1, 'Бухгалтерия'),
(2, 'Отдел продаж'),
(3, 'Внедрение'),
(4, 'Отдел разработки');

-- --------------------------------------------------------

--
-- Структура таблицы `job`
--

CREATE TABLE IF NOT EXISTS `job` (
  `key_job` int(11) NOT NULL AUTO_INCREMENT,
  `name_j` varchar(50) NOT NULL,
  PRIMARY KEY (`key_job`),
  UNIQUE KEY `key_job` (`key_job`),
  KEY `key_job_2` (`key_job`),
  KEY `key_job_3` (`key_job`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Дамп данных таблицы `job`
--

INSERT INTO `job` (`key_job`, `name_j`) VALUES
(1, 'Начальник отдела/Ведущий инженер'),
(2, 'Инженер связи 1 кат.'),
(3, 'Инженер связи 2 кат.'),
(4, 'Инженер-программист 1 кат.'),
(5, 'Инженер-программист 2 кат.'),
(7, 'Менеджер по продажам'),
(8, 'Главный бухгалтер/Бухгалтер 1 кат.'),
(9, 'Бухгалтер 2 категории'),
(10, 'Менеджер по работе с клиентами');

-- --------------------------------------------------------

--
-- Структура таблицы `worker`
--

CREATE TABLE IF NOT EXISTS `worker` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key_job` int(11) DEFAULT NULL,
  `key_dep` int(11) DEFAULT NULL,
  `fio` varchar(75) DEFAULT NULL,
  `data_start` date DEFAULT NULL,
  `count_day` int(11) DEFAULT NULL,
  `perk` int(11) DEFAULT NULL,
  `complementary` int(11) DEFAULT NULL,
  `balance_current` int(11) DEFAULT NULL,
  `balance_new` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `key_job` (`key_job`),
  KEY `key_job_2` (`key_job`),
  KEY `key_dep` (`key_dep`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Дамп данных таблицы `worker`
--

INSERT INTO `worker` (`id`, `key_job`, `key_dep`, `fio`, `data_start`, `count_day`, `perk`, `complementary`, `balance_current`, `balance_new`) VALUES
(1, 1, 4, 'Иванов И.И.', '2000-01-10', 28, 0, 0, 0, 28),
(2, 1, 3, 'Петров П.И.', '2000-01-28', 28, 0, 0, 5, 28),
(3, 1, 2, 'Сидоров С.И.', '2000-01-10', 28, 0, 0, 0, 28),
(4, 8, 1, 'Котов И.И.', '1996-05-15', 28, 0, 0, 14, 28),
(5, 1, 4, 'Антипов А.А.', '1998-09-12', 28, 0, 0, 10, 28),
(6, 4, 4, 'Волков В.В.', '2010-03-11', 30, 0, 0, 0, 30),
(7, 4, 4, 'Зайцев И.И.', '2016-02-01', 28, 0, 0, 7, 28),
(8, 5, 4, 'Кабанов Д.А.', '2016-09-10', 28, 1, 0, 28, 28),
(9, 1, 3, 'Трофимов И.Т.', '2012-05-05', 28, 0, 1, 2, 28),
(10, 3, 3, 'Колобков Н.Н.', '2015-08-10', 28, 0, 0, 0, 28),
(11, 3, 3, 'Минаев И.В.', '2002-01-15', 28, 0, 0, 0, 28),
(12, 2, 3, 'Кудинов И.И.', '2016-11-10', 31, 1, 0, 31, 31),
(13, 2, 3, 'Киреев Д.А.', '2000-01-15', 28, 0, 0, 0, 28),
(14, 1, 2, 'Молотов И.Б.', '2000-10-01', 28, 0, 0, 0, 28),
(15, 10, 2, 'Болотов И.И.', '2007-01-18', 28, 0, 0, 0, 28),
(16, 10, 2, 'Белов И.И.', '2007-11-10', 28, 0, 0, 10, 28),
(17, 7, 2, 'Ковалев И.И.', '2010-07-10', 28, 0, 3, 0, 28),
(18, 7, 2, 'Краснов Б.И.', '2015-01-10', 28, 0, 0, 0, 28),
(19, 7, 2, 'Бугаев И.И.', '2011-12-12', 28, 0, 0, 10, 28),
(20, 9, 1, 'Лугов И.И.', '2005-09-10', 28, 0, 0, 0, 28),
(21, 9, 1, 'Русаков И.П.', '2015-01-20', 28, 0, 0, 3, 28),
(22, 8, 1, 'Лесков И.П.', '2010-01-15', 28, 0, 0, 0, 28);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
