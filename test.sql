-- Adminer 5.4.1 MySQL 8.0.44 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `position`;
CREATE TABLE `position` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(32) COLLATE utf8mb4_danish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_danish_ci;

INSERT INTO `position` (`id`, `name`) VALUES
(1,	'Програміст'),
(2,	'Менеджер'),
(3,	'Тестувальник');

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(32) COLLATE utf8mb4_danish_ci NOT NULL,
  `last_name` varchar(32) COLLATE utf8mb4_danish_ci NOT NULL,
  `id_position` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_danish_ci;

INSERT INTO `user` (`id`, `first_name`, `last_name`, `id_position`) VALUES
(31,	'Test 1',	'Test 2',	3),
(36,	'First Name 1',	'Last Name 2 ',	1);

-- 2025-12-11 01:02:27 UTC
