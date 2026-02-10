


SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


CREATE TABLE `category_list` (
  `id` bigint(30) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `category_list` (`id`, `name`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Mobile Phones', 'Mobile Phones Category', 1, '2023-05-01 10:32:44', NULL),
(2, 'Keys', 'Keys Category', 1, '2023-05-01 10:34:27', NULL),
(3, 'Watches', 'Watches Category', 1, '2023-05-01 10:35:58', '2023-05-01 10:36:15');

CREATE TABLE `inquiry_list` (
  `id` bigint(30) NOT NULL AUTO_INCREMENT,
  `fullname` text NOT NULL,
  `contact` text NOT NULL,
  `email` text NOT NULL,
  `message` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `inquiry_list` (`id`, `fullname`, `contact`, `email`, `message`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Jane Doe', '09123546788', 'jdoe@mail.com', 'Sample Inquiry Message', 1, '2023-05-01 14:11:19', '2023-05-01 14:25:47');

CREATE TABLE `item_list` (
  `id` bigint(30) NOT NULL AUTO_INCREMENT,
  `category_id` bigint(30) NOT NULL,
  `fullname` text NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `contact` text NOT NULL,
  `image_path` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `fk_category_id` (`category_id`),
  CONSTRAINT `fk_category_id` FOREIGN KEY (`category_id`) REFERENCES `category_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `item_list` (`id`, `category_id`, `fullname`, `title`, `description`, `contact`, `image_path`, `status`, `created_at`, `updated`) VALUES
(1, 2, 'Mark Cooper', 'Found Keys at Central Park', 'Sample Description', '09123564789', 'uploads/items/1.png?v=1682912925', 1, '2023-05-01 11:48:45', '2023-05-01 11:48:45'),
(3, 1, 'Claire Blake', 'Found an Android Phone', 'Sample Description', '09123654897', 'uploads/items/3.png?v=1682916949', 1, '2023-05-01 12:55:48', '2023-05-01 12:55:49'),
(5, 3, 'Samantha Lou', 'Found a Watch', 'Sample Description', '09457778988', 'uploads/items/5.png?v=1682917427', 1, '2023-05-01 13:03:47', '2023-05-01 13:03:47'),
(6, 1, 'Wilson Smith', 'Found Something', 'Sample Description', '09123564789', NULL, 2, '2023-05-01 13:34:29', '2023-05-01 14:04:10');

CREATE TABLE `system_info` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `system_info` (`id`, `meta_field`, `meta_value`) VALUES
(1, 'name', 'Lost and Found Information System'),
(6, 'short_name', 'PHP - LFIS'),
(11, 'logo', 'uploads/logo.png?v=1682908055'),
(13, 'user_avatar', 'uploads/user_avatar.jpg'),
(14, 'cover', 'uploads/cover.png?v=1682908055'),
(17, 'phone', '903-436-9356'),
(18, 'mobile', '0917-351-8047'),
(19, 'email', 'info@simpleorganization.org'),
(20, 'address', '4226 Florence Street, Arlington, Texas, 76011');

CREATE TABLE `users` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(250) NOT NULL,
  `middlename` text DEFAULT NULL,
  `lastname` varchar(250) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `avatar` text DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 0,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='2';

INSERT INTO `users` (`id`, `firstname`, `middlename`, `lastname`, `username`, `password`, `avatar`, `last_login`, `type`, `date_added`, `date_updated`) VALUES
(1, 'Adminstrator', '', 'Admin', 'admin', '$2y$10$lu9Lz9d61nsRRq5aXGOrmuik6tzhMif.AIQTmxgj4LTHf3M9hyGtW', 'uploads/avatars/1.png?v=1678760026', NULL, 1, '2021-01-20 14:02:37', '2023-04-26 16:01:02'),
(9, 'Claire', '', 'Blake', 'cblake', '$2y$10$DFEet3AmXnsVKls912SbHey87bsXauL7nannya2CjtV7m37dNZhNe', 'uploads/avatars/9.png?v=1682495668', NULL, 2, '2023-04-26 15:54:27', '2023-04-26 16:02:36');
COMMIT;
