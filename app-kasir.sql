-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.33 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table app-kasir.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table app-kasir.failed_jobs: ~0 rows (approximately)
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Dumping structure for table app-kasir.kategoris
CREATE TABLE IF NOT EXISTS `kategoris` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_kat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table app-kasir.kategoris: ~3 rows (approximately)
/*!40000 ALTER TABLE `kategoris` DISABLE KEYS */;
INSERT INTO `kategoris` (`id`, `nama_kat`, `created_at`, `updated_at`) VALUES
	(1, 'Makanan', '2022-10-25 14:22:40', '2022-10-25 14:22:40'),
	(2, 'Minuman', '2022-10-25 14:22:54', '2022-10-25 14:22:54'),
	(3, 'Snack', '2022-10-25 14:22:58', '2022-10-25 14:22:58');
/*!40000 ALTER TABLE `kategoris` ENABLE KEYS */;

-- Dumping structure for table app-kasir.mejas
CREATE TABLE IF NOT EXISTS `mejas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Meja Kosong','Belum Bayar') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Meja Kosong',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table app-kasir.mejas: ~3 rows (approximately)
/*!40000 ALTER TABLE `mejas` DISABLE KEYS */;
INSERT INTO `mejas` (`id`, `nama`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'Meja 01', 'Meja Kosong', '2022-10-25 14:22:31', '2022-10-25 14:22:31'),
	(2, 'Meja 02', 'Meja Kosong', '2022-10-27 16:39:42', '2022-10-27 16:39:42'),
	(3, 'Meja 03', 'Belum Bayar', '2022-10-27 16:39:49', '2022-10-27 16:39:50');
/*!40000 ALTER TABLE `mejas` ENABLE KEYS */;

-- Dumping structure for table app-kasir.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table app-kasir.migrations: ~12 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(45, '2014_10_12_000000_create_users_table', 1),
	(46, '2014_10_12_100000_create_password_resets_table', 1),
	(47, '2019_08_19_000000_create_failed_jobs_table', 1),
	(48, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(49, '2022_03_26_062458_create_mejas_table', 1),
	(50, '2022_03_26_062550_create_kategoris_table', 1),
	(51, '2022_03_26_062616_create_produks_table', 1),
	(52, '2022_03_26_064317_create_settings_table', 1),
	(53, '2022_03_26_065226_create_pengeluarans_table', 1),
	(54, '2022_03_26_065322_create_penjualans_table', 1),
	(55, '2022_03_26_065522_create_penjualan_details_table', 1),
	(56, '2022_04_09_145713_create_permission_tables', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table app-kasir.model_has_permissions
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table app-kasir.model_has_permissions: ~0 rows (approximately)
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;

-- Dumping structure for table app-kasir.model_has_roles
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table app-kasir.model_has_roles: ~2 rows (approximately)
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
	(1, 'App\\Models\\User', 1),
	(2, 'App\\Models\\User', 2);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;

-- Dumping structure for table app-kasir.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table app-kasir.password_resets: ~0 rows (approximately)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Dumping structure for table app-kasir.pengeluarans
CREATE TABLE IF NOT EXISTS `pengeluarans` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `deskripsi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nominal` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table app-kasir.pengeluarans: ~0 rows (approximately)
/*!40000 ALTER TABLE `pengeluarans` DISABLE KEYS */;
/*!40000 ALTER TABLE `pengeluarans` ENABLE KEYS */;

-- Dumping structure for table app-kasir.penjualans
CREATE TABLE IF NOT EXISTS `penjualans` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `meja_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `kode_penj` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_item` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `bayar` int(11) NOT NULL DEFAULT '0',
  `diterima` int(11) NOT NULL DEFAULT '0',
  `status` enum('Sudah Bayar','Belum Bayar') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Belum Bayar',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `penjualans_kode_penj_unique` (`kode_penj`),
  KEY `penjualans_meja_id_foreign` (`meja_id`),
  KEY `penjualans_user_id_foreign` (`user_id`),
  CONSTRAINT `penjualans_meja_id_foreign` FOREIGN KEY (`meja_id`) REFERENCES `mejas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `penjualans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table app-kasir.penjualans: ~4 rows (approximately)
/*!40000 ALTER TABLE `penjualans` DISABLE KEYS */;
INSERT INTO `penjualans` (`id`, `meja_id`, `user_id`, `kode_penj`, `total_item`, `total_harga`, `bayar`, `diterima`, `status`, `created_at`, `updated_at`) VALUES
	(1, 3, 1, 'dasdas', 2, 24000, 0, 0, 'Belum Bayar', '2022-10-27 17:20:11', '2022-10-29 11:09:44'),
	(3, 2, 1, 'ssda', 3, 31000, 0, 0, 'Belum Bayar', '2022-10-27 18:43:14', '2022-10-29 10:30:49'),
	(4, 2, 1, 'ssaa', 1, 10000, 10000, 0, 'Sudah Bayar', '2022-10-27 18:44:24', NULL),
	(5, 1, 1, 'SDA', 4, 48000, 50000, 48000, 'Sudah Bayar', '2022-10-27 18:45:45', NULL);
/*!40000 ALTER TABLE `penjualans` ENABLE KEYS */;

-- Dumping structure for table app-kasir.penjualan_details
CREATE TABLE IF NOT EXISTS `penjualan_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `penjualan_id` bigint(20) unsigned NOT NULL,
  `produk_id` bigint(20) unsigned NOT NULL,
  `jumlah` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `penjualan_details_penjualan_id_foreign` (`penjualan_id`),
  KEY `penjualan_details_produk_id_foreign` (`produk_id`),
  CONSTRAINT `penjualan_details_penjualan_id_foreign` FOREIGN KEY (`penjualan_id`) REFERENCES `penjualans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `penjualan_details_produk_id_foreign` FOREIGN KEY (`produk_id`) REFERENCES `produks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table app-kasir.penjualan_details: ~8 rows (approximately)
/*!40000 ALTER TABLE `penjualan_details` DISABLE KEYS */;
INSERT INTO `penjualan_details` (`id`, `penjualan_id`, `produk_id`, `jumlah`, `subtotal`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 1, 14000, '2022-10-27 17:22:11', '2022-10-27 17:22:11'),
	(2, 1, 2, 1, 10000, '2022-10-27 17:22:32', '2022-10-27 17:22:32'),
	(3, 5, 1, 2, 24000, '2022-10-27 18:46:44', NULL),
	(4, 5, 2, 2, 20000, '2022-10-27 18:47:04', NULL),
	(5, 3, 1, 1, 14000, '2022-10-27 18:47:45', NULL),
	(6, 3, 2, 1, 10000, '2022-10-27 18:48:03', NULL),
	(7, 3, 3, 1, 7000, '2022-10-27 18:48:25', NULL),
	(8, 4, 2, 1, 10000, '2022-10-27 18:49:04', NULL);
/*!40000 ALTER TABLE `penjualan_details` ENABLE KEYS */;

-- Dumping structure for table app-kasir.permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table app-kasir.permissions: ~0 rows (approximately)
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;

-- Dumping structure for table app-kasir.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
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

-- Dumping data for table app-kasir.personal_access_tokens: ~0 rows (approximately)
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;

-- Dumping structure for table app-kasir.produks
CREATE TABLE IF NOT EXISTS `produks` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kategori_id` bigint(20) unsigned NOT NULL,
  `nama_prod` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_prod` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `ket` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `produks_kode_prod_unique` (`kode_prod`),
  KEY `produks_kategori_id_foreign` (`kategori_id`),
  CONSTRAINT `produks_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategoris` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table app-kasir.produks: ~3 rows (approximately)
/*!40000 ALTER TABLE `produks` DISABLE KEYS */;
INSERT INTO `produks` (`id`, `kategori_id`, `nama_prod`, `kode_prod`, `harga_jual`, `ket`, `created_at`, `updated_at`) VALUES
	(1, 1, 'Nasi Goreng', 'P000001', 14000, 'dasdasdas', '2022-10-25 15:32:53', '2022-10-25 15:32:53'),
	(2, 2, 'Kopi Susu', 'P000002', 10000, NULL, '2022-10-25 16:21:35', '2022-10-25 16:21:48'),
	(3, 3, 'Telur Gulung', 'P000003', 7000, NULL, '2022-10-25 16:22:36', '2022-10-25 16:22:36');
/*!40000 ALTER TABLE `produks` ENABLE KEYS */;

-- Dumping structure for table app-kasir.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table app-kasir.roles: ~3 rows (approximately)
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'admin', 'web', '2022-10-25 14:21:21', '2022-10-25 14:21:22'),
	(2, 'kasir', 'web', '2022-10-25 14:21:28', '2022-10-25 14:21:28'),
	(3, 'waiters', 'web', '2022-10-25 14:21:34', '2022-10-25 14:21:34');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Dumping structure for table app-kasir.role_has_permissions
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table app-kasir.role_has_permissions: ~0 rows (approximately)
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;

-- Dumping structure for table app-kasir.settings
CREATE TABLE IF NOT EXISTS `settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_toko` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path_logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table app-kasir.settings: ~1 rows (approximately)
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` (`id`, `nama_toko`, `alamat`, `telp`, `path_logo`, `created_at`, `updated_at`) VALUES
	(1, 'KDA Coffe and Foodcourt', 'Jl. Lintas Negeri Lama', '0821', 'logo-20221017153924.jpg', '2022-10-25 14:20:48', '2022-10-25 14:20:49');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;

-- Dumping structure for view app-kasir.terlaris
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `terlaris` (
	`penjualan_id` BIGINT(20) UNSIGNED NOT NULL,
	`produk_id` BIGINT(20) UNSIGNED NOT NULL,
	`nama_kat` VARCHAR(255) NULL COLLATE 'utf8mb4_unicode_ci',
	`nama_prod` VARCHAR(255) NULL COLLATE 'utf8mb4_unicode_ci',
	`jumlah` INT(11) NOT NULL,
	`created_at` TIMESTAMP NULL
) ENGINE=MyISAM;

-- Dumping structure for table app-kasir.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table app-kasir.users: ~2 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `nama`, `email`, `email_verified_at`, `password`, `foto`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Admin', 'admin@gmail.com', '2022-10-25 14:19:44', '$2y$10$C1fElaYFe5nRhVgSwdCTtevOO82uFmpGOHS14CcKlIGXy4YmCZH/i', '20221017153856.png', 'tHnJQsND8gUsTcxXWuS3mj9fsij9p4fCFLZvgCiS9fFJjkhxXWQNB4cXDi3k', '2022-10-25 14:19:47', '2022-10-25 19:22:38'),
	(2, 'Kasir', 'kasir@gmail.com', NULL, '$2y$10$j6rNnmR3YYA9GJod9Nt8eOOS7/DXNIFZmnJcq3rB0Zx8ICVZXnxjW', '20221028142523.jpg', NULL, '2022-10-28 14:25:23', '2022-10-28 14:25:23');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Dumping structure for view app-kasir.terlaris
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `terlaris`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `terlaris` AS select `penjualan_details`.`penjualan_id` AS `penjualan_id`,`penjualan_details`.`produk_id` AS `produk_id`,`kategoris`.`nama_kat` AS `nama_kat`,`produks`.`nama_prod` AS `nama_prod`,`penjualan_details`.`jumlah` AS `jumlah`,`penjualan_details`.`created_at` AS `created_at` from ((`penjualan_details` left join `produks` on((`penjualan_details`.`produk_id` = `produks`.`id`))) left join `kategoris` on((`produks`.`kategori_id` = `kategoris`.`id`)));

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
