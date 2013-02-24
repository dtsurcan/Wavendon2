-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Фев 23 2013 г., 21:11
-- Версия сервера: 5.1.61-0ubuntu0.11.10.1
-- Версия PHP: 5.3.6-13ubuntu3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `wavendon`
--

-- --------------------------------------------------------

--
-- Структура таблицы `wd_role`
--

CREATE TABLE IF NOT EXISTS `wd_role` (
  `id` tinyint(1) NOT NULL,
  `name` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `wd_role`
--

INSERT INTO `wd_role` (`id`, `name`) VALUES
(1, 'User'),
(2, 'Tenant'),
(3, 'Guarantor'),
(4, 'Landlord'),
(5, 'Admin');

-- --------------------------------------------------------

--
-- Структура таблицы `wd_users`
--

CREATE TABLE IF NOT EXISTS `wd_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title_id` tinyint(1) DEFAULT NULL,
  `first_name` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `middle_name` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `passport_number` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `driving_license_number` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `note` text COLLATE utf8_unicode_ci NOT NULL,
  `date_create` datetime NOT NULL,
  `date_update` datetime NOT NULL,
  `date_last_activity` datetime NOT NULL,
  `date_note_update` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `title_id` (`title_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Дамп данных таблицы `wd_users`
--

INSERT INTO `wd_users` (`id`, `title_id`, `first_name`, `middle_name`, `last_name`, `passport_number`, `driving_license_number`, `email`, `password`, `note`, `date_create`, `date_update`, `date_last_activity`, `date_note_update`) VALUES
(10, 1, 'Dmitry', 'playmix', 'Tsurcan', 'asd asd asd qw qweq', '', 'playmix@list.ru', '$2a$10$hnB005EN6BxRI6g1ujzxtucfC6VPWV5P2kMZBC6ZlTBT6AraWHLEq', 'tsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney\\''s organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles pitchfork biodiesel fixie etsy retro mlkshk vice blog. Scenester cred you probably haven\\''t heard of them, vinyl craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr', '2013-02-23 15:42:09', '2013-02-23 15:42:09', '2013-02-23 21:05:56', '0000-00-00 00:00:00'),
(11, 1, 'Admin', '', '', '', '', 'admin@admin.com', '$2a$10$hDwWwfF5FJD2XAjRDtC2v.asztS.i4WXJQeaV/1CuJ43dak6mAiUS', '', '2013-02-23 21:07:04', '2013-02-23 21:07:04', '2013-02-23 21:10:57', '0000-00-00 00:00:00'),
(12, 1, 'Demo', '', '', '', '', 'demo@demo.com', '$2a$10$4Xyw9HPHvxdO7sYB8dUSb.umJVk5S4bURvnuK9gGrcLFxyJUWMCMW', '', '2013-02-23 21:11:32', '2013-02-23 21:11:32', '2013-02-23 21:11:32', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Структура таблицы `wd_user_copies_of_driving`
--

CREATE TABLE IF NOT EXISTS `wd_user_copies_of_driving` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_create` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `copy` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `wd_user_copies_of_passport`
--

CREATE TABLE IF NOT EXISTS `wd_user_copies_of_passport` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_create` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `copy` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `wd_user_photos`
--

CREATE TABLE IF NOT EXISTS `wd_user_photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_create` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `link` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `primary` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Структура таблицы `wd_user_role`
--

CREATE TABLE IF NOT EXISTS `wd_user_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `role_id` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `wd_user_role`
--

INSERT INTO `wd_user_role` (`id`, `user_id`, `role_id`) VALUES
(1, 10, 2),
(2, 11, 5),
(3, 12, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `wd_user_titles`
--

CREATE TABLE IF NOT EXISTS `wd_user_titles` (
  `id` tinyint(1) NOT NULL,
  `name` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_2` (`id`),
  KEY `id` (`id`),
  KEY `id_3` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `wd_user_titles`
--

INSERT INTO `wd_user_titles` (`id`, `name`) VALUES
(1, 'Mr'),
(2, 'Mrs'),
(3, 'Ms'),
(4, 'Dr');

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `wd_users`
--
ALTER TABLE `wd_users`
  ADD CONSTRAINT `wd_users_ibfk_1` FOREIGN KEY (`title_id`) REFERENCES `wd_user_titles` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `wd_user_copies_of_driving`
--
ALTER TABLE `wd_user_copies_of_driving`
  ADD CONSTRAINT `wd_user_copies_of_driving_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `wd_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `wd_user_copies_of_passport`
--
ALTER TABLE `wd_user_copies_of_passport`
  ADD CONSTRAINT `wd_user_copies_of_passport_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `wd_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `wd_user_photos`
--
ALTER TABLE `wd_user_photos`
  ADD CONSTRAINT `wd_user_photos_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `wd_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `wd_user_role`
--
ALTER TABLE `wd_user_role`
  ADD CONSTRAINT `wd_user_role_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `wd_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `wd_user_role_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `wd_role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
