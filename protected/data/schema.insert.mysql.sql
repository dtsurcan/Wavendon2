SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


INSERT INTO `wd_property_type` (`id`, `name`) VALUES
(1, 'House'),
(2, 'Flat');

INSERT INTO `wd_role` (`id`, `name`) VALUES
(1, 'User'),
(2, 'Tenant'),
(3, 'Guarantor'),
(4, 'Landlord'),
(5, 'Admin');

INSERT INTO `wd_room_status` (`id`, `name`) VALUES
(1, 'Available'),
(2, 'Occupied'),
(3, 'Unavailable');

INSERT INTO `wd_users` (`id`, `title_id`, `first_name`, `middle_name`, `last_name`, `passport_number`, `driving_license_number`, `email`, `password`, `note`, `date_create`, `date_update`, `date_last_activity`, `date_note_update`) VALUES
(10, 4, 'Dmitry', 'playmix', 'Tsurcan', 'asd asd asd qw qweq', '', 'playmix@list.ru', '$2a$10$hnB005EN6BxRI6g1ujzxtucfC6VPWV5P2kMZBC6ZlTBT6AraWHLEq', 'tsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney\\''s organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles pitchfork biodiesel fixie etsy retro mlkshk vice blog. Scenester cred you probably haven\\''t heard of them, vinyl craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr11', '2013-02-23 15:42:09', '2013-02-26 13:45:01', '2013-02-26 19:22:31', '2013-02-25 17:36:42'),
(11, 1, 'Admin', '', '', '', '', 'admin@admin.com', '$2a$10$hDwWwfF5FJD2XAjRDtC2v.asztS.i4WXJQeaV/1CuJ43dak6mAiUS', '', '2013-02-23 21:07:04', '2013-02-23 21:07:04', '2013-02-24 21:09:01', '0000-00-00 00:00:00'),
(12, 1, 'Demo', '', '', '', '', 'demo@demo.com', '$2a$10$4Xyw9HPHvxdO7sYB8dUSb.umJVk5S4bURvnuK9gGrcLFxyJUWMCMW', '', '2013-02-23 21:11:32', '2013-02-23 21:11:32', '2013-02-23 21:13:22', '0000-00-00 00:00:00');

INSERT INTO `wd_user_copies_of_driving` (`id`, `date_create`, `user_id`, `link`) VALUES
(1, '2013-02-26 14:48:39', 10, '12.jpg'),
(2, '2013-02-26 14:48:45', 10, '13.jpg');

INSERT INTO `wd_user_copies_of_passport` (`id`, `date_create`, `user_id`, `link`) VALUES
(1, '2013-02-26 14:49:42', 10, '1920x1280.jpg');

INSERT INTO `wd_user_photos` (`id`, `date_create`, `user_id`, `link`, `primary`) VALUES
(1, '2013-02-26 14:49:50', 10, '747565.jpg', 0);

INSERT INTO `wd_user_role` (`id`, `user_id`, `role_id`) VALUES
(1, 10, 3),
(2, 11, 5),
(3, 12, 1);

INSERT INTO `wd_user_titles` (`id`, `name`) VALUES
(1, 'Mr'),
(2, 'Mrs'),
(3, 'Ms'),
(4, 'Dr');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
