-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.32-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for edu_tech_db
CREATE DATABASE IF NOT EXISTS `edu_tech_db` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `edu_tech_db`;

-- Dumping structure for table edu_tech_db.accounts
CREATE TABLE IF NOT EXISTS `accounts` (
  `acc_id` int(5) NOT NULL AUTO_INCREMENT,
  `acc_user` varchar(50) NOT NULL,
  `acc_pass` text NOT NULL,
  `acc_name` varchar(150) NOT NULL,
  PRIMARY KEY (`acc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table edu_tech_db.accounts: ~0 rows (approximately)
INSERT INTO `accounts` (`acc_id`, `acc_user`, `acc_pass`, `acc_name`) VALUES
	(1, 'admin', '$2y$10$bl00r/Iu5cNPWpSuoVqpiu0uvEosk0tJNZCCJJYMD..hzeFGIx6Ne', 'Theerapong Tha-in');

-- Dumping structure for table edu_tech_db.article
CREATE TABLE IF NOT EXISTS `article` (
  `article_id` int(5) NOT NULL AUTO_INCREMENT,
  `article_title` tinytext NOT NULL,
  `article_own` tinytext NOT NULL,
  `img_resource` text NOT NULL,
  `img_source` varchar(50) NOT NULL,
  `article_link` varchar(150) NOT NULL DEFAULT '',
  `article_update` timestamp NOT NULL DEFAULT current_timestamp(),
  `img_location` varchar(150) NOT NULL DEFAULT '',
  `editor_text` text NOT NULL,
  `event_img` text NOT NULL,
  PRIMARY KEY (`article_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table edu_tech_db.article: ~0 rows (approximately)

-- Dumping structure for table edu_tech_db.carousel_img_slide
CREATE TABLE IF NOT EXISTS `carousel_img_slide` (
  `img_id` int(5) NOT NULL AUTO_INCREMENT,
  `img_resource` text NOT NULL,
  `img_source` varchar(50) NOT NULL,
  `img_regdate` timestamp NOT NULL DEFAULT current_timestamp(),
  `img_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `img_location` text NOT NULL,
  PRIMARY KEY (`img_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table edu_tech_db.carousel_img_slide: ~0 rows (approximately)

-- Dumping structure for table edu_tech_db.gallery
CREATE TABLE IF NOT EXISTS `gallery` (
  `img_id` int(5) NOT NULL AUTO_INCREMENT,
  `img_title` tinytext NOT NULL,
  `img_resource` text NOT NULL,
  `img_source` varchar(50) NOT NULL,
  `img_link` tinytext NOT NULL,
  `img_update` timestamp NOT NULL DEFAULT current_timestamp(),
  `img_location` text NOT NULL,
  PRIMARY KEY (`img_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table edu_tech_db.gallery: ~0 rows (approximately)

-- Dumping structure for table edu_tech_db.group_media
CREATE TABLE IF NOT EXISTS `group_media` (
  `media_id` int(5) NOT NULL AUTO_INCREMENT,
  `media_title` tinytext NOT NULL,
  `img_resource` text NOT NULL,
  `img_source` varchar(50) NOT NULL,
  `media_link` tinytext NOT NULL,
  `media_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `img_location` text NOT NULL,
  `media_type` varchar(50) NOT NULL,
  `group` text NOT NULL,
  PRIMARY KEY (`media_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table edu_tech_db.group_media: ~0 rows (approximately)

-- Dumping structure for table edu_tech_db.video
CREATE TABLE IF NOT EXISTS `video` (
  `video_id` int(5) NOT NULL AUTO_INCREMENT,
  `video_title` tinytext NOT NULL,
  `img_resource` text NOT NULL,
  `img_source` varchar(50) NOT NULL,
  `video_link` tinytext NOT NULL,
  `video_update` timestamp NOT NULL DEFAULT current_timestamp(),
  `img_location` text NOT NULL,
  PRIMARY KEY (`video_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table edu_tech_db.video: ~0 rows (approximately)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
