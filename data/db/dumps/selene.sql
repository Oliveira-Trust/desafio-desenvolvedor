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


-- Dumping database structure for currency_converter
DROP DATABASE IF EXISTS `currency_converter`;
CREATE DATABASE IF NOT EXISTS `currency_converter` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `currency_converter`;

-- Dumping structure for table currency_converter.session
DROP TABLE IF EXISTS `session`;
CREATE TABLE IF NOT EXISTS `session` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `session_id` varchar(2000) NOT NULL,
  `time_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `time_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `time_created` (`time_created`),
  KEY `time_updated` (`time_updated`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table currency_converter.session: ~0 rows (approximately)
/*!40000 ALTER TABLE `session` DISABLE KEYS */;
/*!40000 ALTER TABLE `session` ENABLE KEYS */;

-- Dumping structure for table currency_converter.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int unsigned NOT NULL AUTO_INCREMENT,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `email` varchar(191) NOT NULL,
  `fullname` varchar(191) NOT NULL,
  `password` varchar(191) NOT NULL,
  `time_created` timestamp DEFAULT CURRENT_TIMESTAMP,
  `time_updated` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `unique_email` (`email`),
  KEY `time_created` (`time_created`),
  KEY `time_updated` (`time_updated`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `users` (`user_id`, `is_admin`, `email`, `fullname`, `password`, `time_created`, `time_updated`) VALUES
	(1, 1, 'admin@oliveiratrust.com.br', 'admin oliveiratrust', '$argon2id$v=19$m=65536,t=2,p=1$uGf+zt21exD8eUR2r2P2Mg$1hhfMJ2eIdxoG/xcy+Pc2y5AJ+0sODg9liLU06SqHYc', NULL, NULL),
	(2, 0, 'cliente@oliveiratrust.com.br', 'cliente oliveiratrust', '$argon2id$v=19$m=65536,t=2,p=1$WZZUzjSaTOeV6SagPq1x0Q$QRaU0XJWJRQvYMPZ7L2xu3bHmo3xu7wAE33JPLc8N+s', NULL, NULL);
-- Dumping data for table currency_converter.users: ~0 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
