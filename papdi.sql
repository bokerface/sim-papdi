-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.18 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table sim-papdi.admins
CREATE TABLE IF NOT EXISTS `admins` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` bigint(20) unsigned DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`),
  KEY `admins_role_id_foreign` (`role_id`),
  CONSTRAINT `admins_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sim-papdi.admins: ~1 rows (approximately)
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` (`id`, `username`, `email`, `password`, `fullname`, `phone`, `role_id`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'admin', 'admin@site.com', '$2y$10$IAhZXF2yVqmYSxKO2bQOiOfHd4F6alp/C4krPUdysgOJEDNZhZ.j2', 'admin', '123456789', 1, NULL, NULL, NULL);
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;

-- Dumping structure for table sim-papdi.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sim-papdi.categories: ~2 rows (approximately)
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`id`, `created_at`, `updated_at`, `name`, `description`) VALUES
	(1, '2023-08-09 07:29:34', '2023-08-09 07:29:34', 'Rooney Mcdowell', 'Est consequatur qui'),
	(2, '2023-09-11 02:07:30', '2023-09-11 02:07:30', 'Breanna Hendrix', 'Est iusto sed suscip');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;

-- Dumping structure for table sim-papdi.certificates
CREATE TABLE IF NOT EXISTS `certificates` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) unsigned DEFAULT NULL,
  `participant_id` bigint(20) unsigned DEFAULT NULL,
  `bg_image` text COLLATE utf8mb4_unicode_ci,
  `template` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `certificates_order_id_foreign` (`order_id`),
  KEY `certificates_participant_id_foreign` (`participant_id`),
  CONSTRAINT `certificates_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `certificates_participant_id_foreign` FOREIGN KEY (`participant_id`) REFERENCES `participants` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sim-papdi.certificates: ~0 rows (approximately)
/*!40000 ALTER TABLE `certificates` DISABLE KEYS */;
/*!40000 ALTER TABLE `certificates` ENABLE KEYS */;

-- Dumping structure for table sim-papdi.certificate_settings
CREATE TABLE IF NOT EXISTS `certificate_settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `training_id` bigint(20) unsigned DEFAULT NULL,
  `file` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `certificate_settings_training_id_foreign` (`training_id`),
  CONSTRAINT `certificate_settings_training_id_foreign` FOREIGN KEY (`training_id`) REFERENCES `trainings` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sim-papdi.certificate_settings: ~2 rows (approximately)
/*!40000 ALTER TABLE `certificate_settings` DISABLE KEYS */;
INSERT INTO `certificate_settings` (`id`, `created_at`, `updated_at`, `training_id`, `file`) VALUES
	(1, '2023-09-12 03:43:25', '2023-09-21 02:30:45', 1, 'trainings/certificate/1/dummy_absen.png'),
	(2, '2023-09-12 04:51:02', '2023-09-12 04:51:02', 3, NULL);
/*!40000 ALTER TABLE `certificate_settings` ENABLE KEYS */;

-- Dumping structure for table sim-papdi.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sim-papdi.migrations: ~15 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_100000_create_password_resets_table', 1),
	(2, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(3, '2023_05_15_062854_create_roles_table', 1),
	(4, '2023_05_16_020745_create_categories_table', 1),
	(5, '2023_05_16_062854_create_users_table', 1),
	(6, '2023_05_16_062855_create_admins_table', 1),
	(7, '2023_05_17_084334_create_trainings_table', 1),
	(8, '2023_05_17_084400_create_trainers_table', 1),
	(9, '2023_05_17_092748_create_training_trainer_table', 1),
	(10, '2023_05_19_024012_create_orders_table', 1),
	(11, '2023_05_19_025354_create_participants_table', 1),
	(12, '2023_05_19_030519_create_order_participant_table', 1),
	(13, '2023_05_19_034438_create_certificates_table', 1),
	(15, '2023_09_11_023110_create_urgent_participants_table', 2),
	(16, '2023_09_12_031327_create_certificate_settings_table', 3);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table sim-papdi.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `payment_method` enum('Transfer','Midtrans') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `training_id` bigint(20) unsigned DEFAULT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `order_date` date DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `payment_amount` bigint(20) DEFAULT NULL,
  `status_order` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orders_training_id_foreign` (`training_id`),
  KEY `orders_user_id_foreign` (`user_id`),
  CONSTRAINT `orders_training_id_foreign` FOREIGN KEY (`training_id`) REFERENCES `trainings` (`id`) ON DELETE CASCADE,
  CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sim-papdi.orders: ~0 rows (approximately)
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;

-- Dumping structure for table sim-papdi.order_participant
CREATE TABLE IF NOT EXISTS `order_participant` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `participant_id` bigint(20) unsigned DEFAULT NULL,
  `order_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_participant_participant_id_foreign` (`participant_id`),
  KEY `order_participant_order_id_foreign` (`order_id`),
  CONSTRAINT `order_participant_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_participant_participant_id_foreign` FOREIGN KEY (`participant_id`) REFERENCES `participants` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sim-papdi.order_participant: ~0 rows (approximately)
/*!40000 ALTER TABLE `order_participant` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_participant` ENABLE KEYS */;

-- Dumping structure for table sim-papdi.participants
CREATE TABLE IF NOT EXISTS `participants` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `participants_user_id_foreign` (`user_id`),
  CONSTRAINT `participants_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sim-papdi.participants: ~0 rows (approximately)
/*!40000 ALTER TABLE `participants` DISABLE KEYS */;
/*!40000 ALTER TABLE `participants` ENABLE KEYS */;

-- Dumping structure for table sim-papdi.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sim-papdi.password_resets: ~0 rows (approximately)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Dumping structure for table sim-papdi.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sim-papdi.personal_access_tokens: ~0 rows (approximately)
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;

-- Dumping structure for table sim-papdi.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sim-papdi.roles: ~2 rows (approximately)
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `role`) VALUES
	(1, 'admin'),
	(2, 'user');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Dumping structure for table sim-papdi.trainers
CREATE TABLE IF NOT EXISTS `trainers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `job` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sim-papdi.trainers: ~2 rows (approximately)
/*!40000 ALTER TABLE `trainers` DISABLE KEYS */;
INSERT INTO `trainers` (`id`, `name`, `photo`, `description`, `email`, `job`, `created_at`, `updated_at`) VALUES
	(1, 'Seth Hayes', NULL, 'Temporibus occaecat', 'zimuza@mailinator.com', 'Explicabo Et cillum', '2023-08-09 07:29:22', '2023-08-09 07:29:22'),
	(2, 'McKenzie Rollins', NULL, 'Sed velit consequatu', 'genaja@mailinator.com', 'Beatae et est quia', '2023-09-11 02:07:18', '2023-09-11 02:07:18');
/*!40000 ALTER TABLE `trainers` ENABLE KEYS */;

-- Dumping structure for table sim-papdi.trainings
CREATE TABLE IF NOT EXISTS `trainings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint(20) unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` text COLLATE utf8mb4_unicode_ci,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `cost` enum('paid','free') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price_earlybird` bigint(20) DEFAULT NULL,
  `price_normal` bigint(20) DEFAULT NULL,
  `price_onsite` bigint(20) DEFAULT NULL,
  `earlybird_end` date DEFAULT NULL,
  `place` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('online','onsite') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `quota` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trainings_category_id_foreign` (`category_id`),
  CONSTRAINT `trainings_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sim-papdi.trainings: ~3 rows (approximately)
/*!40000 ALTER TABLE `trainings` DISABLE KEYS */;
INSERT INTO `trainings` (`id`, `category_id`, `name`, `image`, `start_date`, `end_date`, `cost`, `price_earlybird`, `price_normal`, `price_onsite`, `earlybird_end`, `place`, `type`, `description`, `quota`, `created_at`, `updated_at`) VALUES
	(1, 2, 'Chandler Flaming', 'trainings/training_banner/1/dummy-lowres.png', '1980-07-01 19:59:00', '2020-07-15 20:13:00', NULL, 210, 773, 687, '2023-09-13', 'Cillum praesentium s', 'onsite', 'Rem magnam sed ullam', 26, '2023-09-11 02:07:48', '2023-09-13 08:02:01'),
	(2, 1, 'Chaney Sandoval', 'trainings/training_banner/2/dummy_absen.png', '2019-04-04 01:00:00', '2020-06-07 07:06:00', NULL, 986, 376, 632, '2023-09-04', 'Eaque sint accusant', 'onsite', 'Et architecto enim i', 78, '2023-09-11 02:20:06', '2023-09-11 02:20:06'),
	(3, 2, 'Avram Castillo', 'trainings/training_banner/3/dummy_absen.png', '2013-05-02 03:06:00', '2013-07-02 07:45:00', NULL, 742, 7424, 742, '1986-11-16', 'Sit fuga Dolorum q', 'onsite', 'Vero velit dolor bea', 26, '2023-09-12 03:09:31', '2023-09-12 03:10:21');
/*!40000 ALTER TABLE `trainings` ENABLE KEYS */;

-- Dumping structure for table sim-papdi.training_trainer
CREATE TABLE IF NOT EXISTS `training_trainer` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `training_id` bigint(20) unsigned DEFAULT NULL,
  `trainer_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `training_trainer_training_id_foreign` (`training_id`),
  KEY `training_trainer_trainer_id_foreign` (`trainer_id`),
  CONSTRAINT `training_trainer_trainer_id_foreign` FOREIGN KEY (`trainer_id`) REFERENCES `trainers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `training_trainer_training_id_foreign` FOREIGN KEY (`training_id`) REFERENCES `trainings` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sim-papdi.training_trainer: ~3 rows (approximately)
/*!40000 ALTER TABLE `training_trainer` DISABLE KEYS */;
INSERT INTO `training_trainer` (`id`, `training_id`, `trainer_id`, `created_at`, `updated_at`) VALUES
	(1, 1, 2, '2023-09-11 02:07:49', '2023-09-13 07:43:54'),
	(2, 2, 2, '2023-09-11 02:20:06', '2023-09-11 02:20:06'),
	(3, 3, 2, '2023-09-12 03:09:32', '2023-09-12 03:09:32');
/*!40000 ALTER TABLE `training_trainer` ENABLE KEYS */;

-- Dumping structure for table sim-papdi.urgent_participants
CREATE TABLE IF NOT EXISTS `urgent_participants` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `training_id` bigint(20) unsigned NOT NULL,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `agency` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `urgent_participants_training_id_foreign` (`training_id`),
  CONSTRAINT `urgent_participants_training_id_foreign` FOREIGN KEY (`training_id`) REFERENCES `trainings` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sim-papdi.urgent_participants: ~5 rows (approximately)
/*!40000 ALTER TABLE `urgent_participants` DISABLE KEYS */;
INSERT INTO `urgent_participants` (`id`, `created_at`, `updated_at`, `training_id`, `fullname`, `email`, `agency`) VALUES
	(2, '2023-09-11 06:18:57', '2023-09-11 06:18:57', 1, 'Ingrid Owens', 'giluriji@mailinator.com', 'Dolore non vel ipsam'),
	(3, '2023-09-11 06:19:19', '2023-09-11 06:19:19', 1, 'Ingrid Owens', 'giluriji@mailinator.com', 'Dolore non vel ipsam'),
	(4, '2023-09-11 06:20:42', '2023-09-11 06:20:42', 2, 'Daphne Walter', 'fanysuhuny@mailinator.com', 'Beatae veniam dolor'),
	(5, '2023-09-11 06:21:19', '2023-09-11 06:21:19', 2, 'Jonah Crawford', 'ryhojamy@mailinator.com', 'Et saepe aut placeat'),
	(6, '2023-09-12 04:50:54', '2023-09-12 04:50:54', 3, 'Sara Hahn', 'mesi@mailinator.com', 'Sed ut nihil tempori');
/*!40000 ALTER TABLE `urgent_participants` ENABLE KEYS */;

-- Dumping structure for table sim-papdi.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` bigint(20) unsigned DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_role_id_foreign` (`role_id`),
  CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sim-papdi.users: ~1 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `username`, `email`, `password`, `fullname`, `agency`, `phone`, `role_id`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Austin', 'messcarry32@gmail.com', '$2y$10$HvgwWhtZOYuu9yorToa9hu0uownqymTDWrKJOrgTU1O/wd1gZT2y2', 'Austin Wilkerson', 'Id pariatur Eum per', '+1 (467) 669-3292', 1, NULL, '2023-09-21 02:34:37', '2023-09-21 02:34:37');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
