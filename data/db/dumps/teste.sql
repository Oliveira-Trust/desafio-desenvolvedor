-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.23 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for docusign2
CREATE DATABASE IF NOT EXISTS `docusign2` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `docusign2`;

-- Dumping structure for table docusign2.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `unidade_id` int unsigned DEFAULT NULL,
  `drt` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_drt_unique` (`drt`),
  UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table docusign2.users: ~6 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `unidade_id`, `drt`, `username`, `password`, `name`, `email`, `avatar`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 1, '1163756', 'valves', '$2y$10$wO9t2Pw4IuZLDd/BxUh9cOY3QC.eYm7xQ9QBh3yO3aeBotRgEp0Na', 'Vinicius Oliveira', '1163756@mackenzie.br', 'https://via.placeholder.com/640x480.png/0044bb?text=VO+culpa', 'SrMTiWPiKRx7HCSd1gl3iDQmxCoI3o54PvZDuvOlfmn8sFerCkS19CMHk8br', NULL, NULL),
	(2, 1, '4500429', 'dramos', '$2y$10$cRV4aBtkVCg4bf/ed8xDnuB7hI3rPAB16Bv2H.rC9WVUtfFzELMf2', 'Danhylo Ramos', '4500429@mackenzie.br', 'https://via.placeholder.com/640x480.png/0033ee?text=DR+corrupti', NULL, NULL, NULL),
	(3, 1, '1124964', 'cguimaraes', '$2y$10$irdXhLU1CAdEAfb/41ErgOETdDBoUDGp80VnJ/i6Jc02XQP0Mwaru', 'Claudio Guimarães', '1124964@mackenzie.br', 'https://via.placeholder.com/640x480.png/007722?text=CG+eaque', NULL, NULL, NULL),
	(4, 1, '1129450', 'fcampos', '$2y$10$2oc7UaOA7tnBdb1gZr55gucRShgHmeA7b477axj87J3y0ZDvPaJN2', 'Fabiana Campos', '1129450@mackenzie.br', 'https://via.placeholder.com/640x480.png/00ffcc?text=FC+mollitia', NULL, NULL, NULL),
	(5, 1, '1147163', 'dsouza', '$2y$10$orsWy2N9OeoBiyXbod256.hmtpstNTbeS0vADM//cwhaYOJ/emZc2', 'Daniel Souza', '1147163@mackenzie.br', 'https://via.placeholder.com/640x480.png/00ee99?text=DS+occaecati', NULL, NULL, NULL),
	(6, 1, '1094431', 'cferreira', '$2y$10$oFZu2i99AsJneWuJU5fimu1ZveBnoOZWRS18jdpsOinuwgIQjkrOu', 'Catia Ferreira', 'catia.ferreira@mackenzie.br.', 'https://via.placeholder.com/640x480.png/009999?text=DS+praesentium', NULL, NULL, NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
