-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
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


-- Dumping database structure for absen
CREATE DATABASE IF NOT EXISTS `absen` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `absen`;

-- Dumping structure for table absen.absen
CREATE TABLE IF NOT EXISTS `absen` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `No_absen` int NOT NULL,
  `Nama_Karyawan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cabang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `posisi_jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hari1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hari2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hari3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hari4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hari5` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hari6` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hari7` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hari8` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hari9` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hari10` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hari11` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hari12` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hari13` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hari14` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hari15` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hari16` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hari17` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hari18` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hari19` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hari20` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hari21` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hari22` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hari23` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hari24` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hari25` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hari26` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hari27` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hari28` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hari29` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hari30` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hari31` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tahun` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Bulan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `absen_no_absen_unique` (`No_absen`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table absen.contohs
CREATE TABLE IF NOT EXISTS `contohs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table absen.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table absen.master_users
CREATE TABLE IF NOT EXISTS `master_users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama_user` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_cabang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table absen.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=193 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table absen.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table absen.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table absen.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
