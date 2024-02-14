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

-- Dumping data for table edu_tech_db.accounts: ~1 rows (approximately)
INSERT INTO `accounts` (`acc_id`, `acc_user`, `acc_pass`, `acc_name`) VALUES
	(1, 'admin', '$2y$10$bl00r/Iu5cNPWpSuoVqpiu0uvEosk0tJNZCCJJYMD..hzeFGIx6Ne', 'Theerapong Tha-in');

-- Dumping structure for table edu_tech_db.article
CREATE TABLE IF NOT EXISTS `article` (
  `article_id` int(5) NOT NULL AUTO_INCREMENT,
  `article_title` tinytext NOT NULL,
  `img_resource` text NOT NULL,
  `img_source` varchar(50) NOT NULL,
  `article_link` tinytext NOT NULL,
  `article_update` timestamp NOT NULL DEFAULT current_timestamp(),
  `img_location` text NOT NULL,
  PRIMARY KEY (`article_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table edu_tech_db.article: ~1 rows (approximately)
INSERT INTO `article` (`article_id`, `article_title`, `img_resource`, `img_source`, `article_link`, `article_update`, `img_location`) VALUES
	(1, 'ทดสอบ', 'http://localhost/edu_tech_backend/dist/img/article/20240212084403.png', 'คอมพิวเตอร์', '#', '2024-02-12 07:44:03', 'dist/img/article/20240212084403.png');

-- Dumping structure for table edu_tech_db.carousel_img_slide
CREATE TABLE IF NOT EXISTS `carousel_img_slide` (
  `img_id` int(5) NOT NULL AUTO_INCREMENT,
  `img_resource` text NOT NULL,
  `img_source` varchar(50) NOT NULL,
  `img_regdate` timestamp NOT NULL DEFAULT current_timestamp(),
  `img_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `img_location` text NOT NULL,
  PRIMARY KEY (`img_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table edu_tech_db.carousel_img_slide: ~1 rows (approximately)
INSERT INTO `carousel_img_slide` (`img_id`, `img_resource`, `img_source`, `img_regdate`, `img_update`, `img_location`) VALUES
	(2, 'https://www.oar.ubu.ac.th/new//upload/slideshow/f59834af3138dbf73964fa32af30c8bb.png', 'รูปจากเว็บไซต์', '2024-02-12 07:43:19', '2024-02-12 07:43:19', '');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table edu_tech_db.gallery: ~1 rows (approximately)
INSERT INTO `gallery` (`img_id`, `img_title`, `img_resource`, `img_source`, `img_link`, `img_update`, `img_location`) VALUES
	(1, 'asd', 'http://localhost/edu_tech_backend/dist/img/gallery/20240212084334.png', 'คอมพิวเตอร์', '#', '2024-02-12 07:43:34', 'dist/img/gallery/20240212084334.png');

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table edu_tech_db.group_media: ~9 rows (approximately)
INSERT INTO `group_media` (`media_id`, `media_title`, `img_resource`, `img_source`, `media_link`, `media_date`, `img_location`, `media_type`, `group`) VALUES
	(1, 'ทดสอบ', 'http://localhost/edu_tech_backend/dist/img/learning_media/20240212084841.png', 'คอมพิวเตอร์', '#', '2024-02-14 04:09:43', 'dist/img/learning_media/20240212084841.png', 'ภาพหลัก', 'learning_media'),
	(2, 'ทดสอบ', 'http://localhost/edu_tech_backend/dist/img/learning_media/20240212084852.png', 'คอมพิวเตอร์', '#', '2024-02-14 04:09:52', 'dist/img/learning_media/20240212084852.png', 'ตัวอย่าง', 'learning_media'),
	(3, 'ทดสอบ', 'http://localhost/edu_tech_backend/dist/img/request_media/20240212084909.png', 'คอมพิวเตอร์', '#', '2024-02-14 04:10:00', 'dist/img/request_media/20240212084909.png', 'ภาพหลัก', 'request_media'),
	(4, 'ทดสอบ', 'http://localhost/edu_tech_backend/dist/img/request_media/20240212084918.png', 'คอมพิวเตอร์', '#', '2024-02-14 04:10:10', 'dist/img/request_media/20240212084918.png', 'ตัวอย่าง', 'request_media'),
	(5, 'ทดสอบ', 'http://localhost/edu_tech_backend/dist/img/evaluate_media/20240212084930.png', 'คอมพิวเตอร์', '#', '2024-02-14 04:10:20', 'dist/img/evaluate_media/20240212084930.png', 'ภาพหลัก', 'evaluate_media'),
	(6, 'ทดสอบ', 'http://localhost/edu_tech_backend/dist/img/evaluate_media/20240212084940.png', 'คอมพิวเตอร์', '#', '2024-02-14 04:10:30', 'dist/img/evaluate_media/20240212084940.png', 'ตัวอย่าง', 'evaluate_media'),
	(7, 'ทดสอบ', 'http://localhost/edu_tech_backend/dist/img/product_service/20240212084959.png', 'คอมพิวเตอร์', '#', '2024-02-14 04:10:37', 'dist/img/product_service/20240212084959.png', 'ภาพหลัก', 'product_service'),
	(8, 'ทดสอบ', 'http://localhost/edu_tech_backend/dist/img/room_service/20240212085054.png', 'คอมพิวเตอร์', '#', '2024-02-14 04:10:44', 'dist/img/room_service/20240212085054.png', 'ภาพหลัก', 'room_service'),
	(9, 'ทดสอบ', 'http://localhost/edu_tech_backend/dist/img/services/20240212085307.png', 'คอมพิวเตอร์', '#', '2024-02-14 04:10:53', 'dist/img/services/20240212085307.png', 'ภาพหลัก', 'services');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table edu_tech_db.video: ~4 rows (approximately)
INSERT INTO `video` (`video_id`, `video_title`, `img_resource`, `img_source`, `video_link`, `video_update`, `img_location`) VALUES
	(1, 'ทดสอบ', 'http://localhost/edu_tech_backend/dist/img/video/20240212084421.png', 'คอมพิวเตอร์', '#', '2024-02-12 07:44:21', 'dist/img/video/20240212084421.png'),
	(2, 'ทดสอบ', 'http://localhost/edu_tech_backend/dist/img/video/20240212084447.png', 'คอมพิวเตอร์', '#', '2024-02-12 07:44:47', 'dist/img/video/20240212084447.png'),
	(3, 'ทดสอบ', 'http://localhost/edu_tech_backend/dist/img/video/20240212084457.png', 'คอมพิวเตอร์', '#', '2024-02-12 07:44:57', 'dist/img/video/20240212084457.png'),
	(4, 'ทดสอบ', 'http://localhost/edu_tech_backend/dist/img/video/20240212084507.png', 'คอมพิวเตอร์', '#', '2024-02-12 07:45:07', 'dist/img/video/20240212084507.png');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
