-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.27-MariaDB - Source distribution
-- Server OS:                    Linux
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for video_game_managment
CREATE DATABASE IF NOT EXISTS `video_game_managment` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `video_game_managment`;

-- Dumping structure for table video_game_managment.users
CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`user_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table video_game_managment.users: ~2 rows (approximately)
INSERT INTO `users` (`username`, `password`, `user_id`) VALUES
	('teo', '123', 1),
	('teo', '12345', 5);

-- Dumping structure for table video_game_managment.video_Games
CREATE TABLE IF NOT EXISTS `video_Games` (
  `title` varchar(50) NOT NULL,
  `description` varchar(50) DEFAULT NULL,
  `release_date` date DEFAULT NULL,
  `genre` varchar(50) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `game_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`game_id`),
  KEY `FK_video_Games_users` (`user_id`),
  CONSTRAINT `FK_video_Games_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table video_game_managment.video_Games: ~7 rows (approximately)
INSERT INTO `video_Games` (`title`, `description`, `release_date`, `genre`, `user_id`, `game_id`) VALUES
	('mortal combat', 'kalo', '2023-10-01', 'arcade', 5, 5),
	('mortal combat', 'kati', '2023-10-15', 'arcade', 1, 6),
	('assassin creed 5', 'kati', '2023-10-15', 'arcade', 1, 7),
	('assassin', 'kalo', '2023-10-15', 'kill', 5, 8),
	('cs_go', 'meh', '2023-10-09', 'shooting', 5, 9),
	('outlast', 'ok', '2023-10-25', 'horror', 5, 10),
	('call of duty', 'polu kalo', '2023-10-10', 'shooting', 5, 11);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
