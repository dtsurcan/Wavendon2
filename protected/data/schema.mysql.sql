SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


CREATE TABLE IF NOT EXISTS `wd_block` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `date_create` datetime NOT NULL,
  `date_update` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `wd_feature` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `is_room` tinyint(1) NOT NULL DEFAULT '0',
  `is_property` tinyint(1) NOT NULL DEFAULT '0',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_create` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `room_id` (`is_room`),
  KEY `property_id` (`is_property`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `wd_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `room_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_from` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `wd_property` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type_id` tinyint(1) DEFAULT NULL,
  `block_id` int(11) DEFAULT NULL,
  `num_of_rooms` int(11) NOT NULL,
  `num_of_vacant_rooms` int(11) NOT NULL,
  `num_of_tenants_currently_in` int(11) NOT NULL,
  `date_create` datetime NOT NULL,
  `date_update` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `block_id` (`block_id`),
  KEY `type_id` (`type_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `wd_property_feature` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `property_id` int(11) NOT NULL,
  `feature_id` int(11) NOT NULL,
  `date_create` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `property_id` (`property_id`),
  KEY `feature_id` (`feature_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `wd_property_type` (
  `id` tinyint(1) NOT NULL,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `wd_role` (
  `id` tinyint(1) NOT NULL,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `wd_room` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `map` text COLLATE utf8_unicode_ci NOT NULL,
  `size` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `weekly_rate` double NOT NULL,
  `revenue_to_date` double NOT NULL,
  `property_id` int(11) DEFAULT NULL,
  `status_id` tinyint(1) DEFAULT NULL,
  `status_description` text COLLATE utf8_unicode_ci NOT NULL,
  `date_create` datetime NOT NULL,
  `date_update` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `property_id` (`property_id`),
  KEY `status_id` (`status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `wd_room_feature` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `room_id` int(11) NOT NULL,
  `feature_id` int(11) NOT NULL,
  `date_create` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `room_id` (`room_id`),
  KEY `feature_id` (`feature_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `wd_room_photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `room_id` int(11) NOT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_create` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `room_id` (`room_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `wd_room_status` (
  `id` tinyint(1) NOT NULL,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `wd_room_tenant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `room_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `weekly_rate` double NOT NULL,
  `revenue_to_date` double NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `date_from` datetime NOT NULL,
  `date_create` datetime NOT NULL,
  `date_update` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `room_id` (`room_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

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

CREATE TABLE IF NOT EXISTS `wd_user_copies_of_driving` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_create` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

CREATE TABLE IF NOT EXISTS `wd_user_copies_of_passport` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_create` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

CREATE TABLE IF NOT EXISTS `wd_user_photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_create` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `link` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `primary` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

CREATE TABLE IF NOT EXISTS `wd_user_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `role_id` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

CREATE TABLE IF NOT EXISTS `wd_user_titles` (
  `id` tinyint(1) NOT NULL,
  `name` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_2` (`id`),
  KEY `id` (`id`),
  KEY `id_3` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


ALTER TABLE `wd_block`
  ADD CONSTRAINT `wd_block_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `wd_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `wd_property`
  ADD CONSTRAINT `wd_property_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `wd_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `wd_property_ibfk_3` FOREIGN KEY (`type_id`) REFERENCES `wd_property_type` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `wd_property_ibfk_4` FOREIGN KEY (`block_id`) REFERENCES `wd_block` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

ALTER TABLE `wd_property_feature`
  ADD CONSTRAINT `wd_property_feature_ibfk_2` FOREIGN KEY (`feature_id`) REFERENCES `wd_feature` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `wd_property_feature_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `wd_property` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `wd_room`
  ADD CONSTRAINT `wd_room_ibfk_5` FOREIGN KEY (`status_id`) REFERENCES `wd_room_status` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `wd_room_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `wd_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `wd_room_ibfk_4` FOREIGN KEY (`property_id`) REFERENCES `wd_property` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

ALTER TABLE `wd_room_feature`
  ADD CONSTRAINT `wd_room_feature_ibfk_2` FOREIGN KEY (`feature_id`) REFERENCES `wd_feature` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `wd_room_feature_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `wd_room` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `wd_room_photos`
  ADD CONSTRAINT `wd_room_photos_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `wd_room` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `wd_room_tenant`
  ADD CONSTRAINT `wd_room_tenant_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `wd_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `wd_room_tenant_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `wd_room` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `wd_users`
  ADD CONSTRAINT `wd_users_ibfk_1` FOREIGN KEY (`title_id`) REFERENCES `wd_user_titles` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

ALTER TABLE `wd_user_copies_of_driving`
  ADD CONSTRAINT `wd_user_copies_of_driving_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `wd_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `wd_user_copies_of_passport`
  ADD CONSTRAINT `wd_user_copies_of_passport_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `wd_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `wd_user_photos`
  ADD CONSTRAINT `wd_user_photos_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `wd_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `wd_user_role`
  ADD CONSTRAINT `wd_user_role_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `wd_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `wd_user_role_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `wd_role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
