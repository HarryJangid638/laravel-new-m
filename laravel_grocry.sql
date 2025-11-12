-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 29, 2025 at 01:30 PM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_grocry`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `last_login_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `phone`, `password`, `profile_image`, `email_verified_at`, `remember_token`, `is_active`, `last_login_at`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'adminds@yopmail.com', '9988552200', '$2y$12$Ywl6J.Ii0Ko5KXX/tf2j4uHkkguA73zrz2gn2j76/.QKmMLI8LSOa', 'C:\\Users\\Admin\\AppData\\Local\\Temp\\php333.tmp', '2025-07-28 10:19:22', 'DJPvoYOnzRjPspz4iyq21ptdO0hrQwLBDbVa8J1VV4YbYBB5VzKl4QhXrIlO', 1, '2025-07-28 10:19:22', NULL, NULL, '2025-07-30 07:11:23');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` bigint UNSIGNED DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `position` int UNSIGNED DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `parent_id`, `description`, `status`, `position`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Bulldog', 'bulldog', NULL, NULL, 1, 0, '2025-08-01 01:25:12', '2025-08-01 01:25:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `email_preferences`
--

CREATE TABLE `email_preferences` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `layout_html` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

CREATE TABLE `email_templates` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_keys` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_preference_id` bigint UNSIGNED DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_07_28_100656_create_admins_table', 2),
(5, '2025_07_28_101117_create_uploads_table', 2),
(8, '2025_07_29_125656_create_settings_table', 3),
(9, '2025_07_29_131415_create_email_preferences_table', 3),
(10, '2025_07_29_131620_create_email_templates_table', 3),
(11, '2025_07_30_133445_create_roles_table', 4),
(12, '2025_07_30_134226_create_categories_table', 4),
(13, '2025_07_30_140413_create_products_table', 4),
(14, '2025_07_30_140627_create_tags_table', 4),
(15, '2025_07_30_140731_create_product_tags_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `regular_price` decimal(10,2) NOT NULL,
  `promotional_price` decimal(10,2) DEFAULT NULL,
  `currency` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'USD',
  `tax_rate` decimal(5,2) NOT NULL DEFAULT '0.00',
  `shipping_width` decimal(8,2) DEFAULT NULL,
  `shipping_height` decimal(8,2) DEFAULT NULL,
  `shipping_weight` decimal(8,2) DEFAULT NULL,
  `shipping_fee` decimal(10,2) DEFAULT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `sub_category_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_tags`
--

CREATE TABLE `product_tags` (
  `product_id` bigint UNSIGNED NOT NULL,
  `tag_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `slug`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Super Admin', 'super-admin', 1, '2025-07-31 09:07:31', '2025-07-31 09:07:31', NULL),
(2, 'User', 'user', 1, '2025-08-29 07:15:40', '2025-08-29 07:15:40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('2mkKFozo8K8Rc2SJ99bdcWP519sF7FZpPXXB6nvk', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:142.0) Gecko/20100101 Firefox/142.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMHpnRDVRblB6WTY1eHpVVld6THljMXhvZXdCY2M1TGt5Q29JcGpscCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0MToiaHR0cHM6Ly9tYXRlcmxpemUudGVzdC9hZG1pbi9yb2xlcy8xL2VkaXQiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo0MToiaHR0cHM6Ly9tYXRlcmxpemUudGVzdC9hZG1pbi9yb2xlcy8xL2VkaXQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1756469651),
('gRS7V0vRciOK0USavB0irrjHswkmwh9wK6Ao4plI', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:142.0) Gecko/20100101 Firefox/142.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaHduenV2Snp1REV2R253OE94M3F1RnB3S3RtRENrejAzNDJ5NUdXcyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHBzOi8vbWF0ZXJsaXplLnRlc3QvYWRtaW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1756472627),
('J5BR22ulF19AiScI3aHgIVzDRLZFpsI0BFrOgwPQ', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:142.0) Gecko/20100101 Firefox/142.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiTTRIRUxCaVp1ekQ1OHJjZmdQMUM4d0lPanNwcWhPZHJSMWM2VnM5dyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHBzOi8vbWF0ZXJsaXplLnRlc3QvYWRtaW4vdXNlcnMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUyOiJsb2dpbl9hZG1pbl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1756474135);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint UNSIGNED NOT NULL,
  `key` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` text COLLATE utf8mb4_unicode_ci,
  `group` enum('web','mail') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '0=> inactive, 1=> active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `type`, `display_name`, `details`, `group`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'site_logo', NULL, 'image', 'Site Logo', NULL, 'web', 1, '2025-07-29 14:10:23', NULL, NULL),
(2, 'company_name', 'Dotsquares', 'text', 'Company Name [Login Page, Sidebar Top Title]', NULL, 'mail', 1, '2025-07-29 14:11:28', '2025-07-29 09:18:54', NULL),
(3, 'company_email', 'test@yomail.com', 'text', 'Company Email', NULL, 'web', 1, '2025-07-29 14:18:51', '2025-07-29 09:19:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `uploads`
--

CREATE TABLE `uploads` (
  `id` bigint UNSIGNED NOT NULL,
  `uploadsable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uploadsable_id` bigint UNSIGNED NOT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `original_file_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'media type',
  `file_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `extension` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `orientation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `uploads`
--

INSERT INTO `uploads` (`id`, `uploadsable_type`, `uploadsable_id`, `file_path`, `original_file_name`, `type`, `file_type`, `extension`, `orientation`, `created_at`, `updated_at`) VALUES
(6, 'App\\Models\\Admin', 1, 'uploads/users/3Div4et1i4kgfhSPztdmCyksxLR9wKG6cEkuN8Fg.jpg', '3.jpg', NULL, 'image/jpeg', 'jpg', NULL, '2025-07-30 07:11:23', '2025-07-30 07:11:23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'John Doe', 'john.doe@example.com', '2025-08-14 09:45:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9v8sEL6Yy3Bq9T9s4P4lG6', NULL, '2025-08-14 09:45:05', '2025-08-14 09:45:05'),
(2, 'Jane Smith', 'jane.smith@example.com', '2025-08-14 09:45:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9v8sEL6Yy3Bq9T9s4P4lG6', NULL, '2025-08-14 09:45:05', '2025-08-14 09:45:05'),
(3, 'Michael Johnson', 'michael.johnson@example.com', '2025-08-14 09:45:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9v8sEL6Yy3Bq9T9s4P4lG6', NULL, '2025-08-14 09:45:05', '2025-08-14 09:45:05'),
(4, 'Emily Davis', 'emily.davis@example.com', '2025-08-14 09:45:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9v8sEL6Yy3Bq9T9s4P4lG6', NULL, '2025-08-14 09:45:05', '2025-08-14 09:45:05'),
(5, 'David Wilson', 'david.wilson@example.com', '2025-08-14 09:45:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9v8sEL6Yy3Bq9T9s4P4lG6', NULL, '2025-08-14 09:45:05', '2025-08-14 09:45:05'),
(6, 'Sarah Brown', 'sarah.brown@example.com', '2025-08-14 09:45:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9v8sEL6Yy3Bq9T9s4P4lG6', NULL, '2025-08-14 09:45:05', '2025-08-14 09:45:05'),
(7, 'Daniel Miller', 'daniel.miller@example.com', '2025-08-14 09:45:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9v8sEL6Yy3Bq9T9s4P4lG6', NULL, '2025-08-14 09:45:05', '2025-08-14 09:45:05'),
(8, 'Olivia Garcia', 'olivia.garcia@example.com', '2025-08-14 09:45:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9v8sEL6Yy3Bq9T9s4P4lG6', NULL, '2025-08-14 09:45:05', '2025-08-14 09:45:05'),
(9, 'James Martinez', 'james.martinez@example.com', '2025-08-14 09:45:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9v8sEL6Yy3Bq9T9s4P4lG6', NULL, '2025-08-14 09:45:05', '2025-08-14 09:45:05'),
(10, 'Sophia Anderson', 'sophia.anderson@example.com', '2025-08-14 09:45:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9v8sEL6Yy3Bq9T9s4P4lG6', NULL, '2025-08-14 09:45:05', '2025-08-14 09:45:05'),
(11, 'Matthew Thomas', 'matthew.thomas@example.com', '2025-08-14 09:45:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9v8sEL6Yy3Bq9T9s4P4lG6', NULL, '2025-08-14 09:45:05', '2025-08-14 09:45:05'),
(12, 'Isabella Taylor', 'isabella.taylor@example.com', '2025-08-14 09:45:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9v8sEL6Yy3Bq9T9s4P4lG6', NULL, '2025-08-14 09:45:05', '2025-08-14 09:45:05'),
(13, 'Ethan Moore', 'ethan.moore@example.com', '2025-08-14 09:45:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9v8sEL6Yy3Bq9T9s4P4lG6', NULL, '2025-08-14 09:45:05', '2025-08-14 09:45:05'),
(14, 'Mia Jackson', 'mia.jackson@example.com', '2025-08-14 09:45:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9v8sEL6Yy3Bq9T9s4P4lG6', NULL, '2025-08-14 09:45:05', '2025-08-14 09:45:05'),
(15, 'Alexander White', 'alexander.white@example.com', '2025-08-14 09:45:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9v8sEL6Yy3Bq9T9s4P4lG6', NULL, '2025-08-14 09:45:05', '2025-08-14 09:45:05'),
(16, 'Charlotte Harris', 'charlotte.harris@example.com', '2025-08-14 09:45:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9v8sEL6Yy3Bq9T9s4P4lG6', NULL, '2025-08-14 09:45:05', '2025-08-14 09:45:05'),
(17, 'Benjamin Clark', 'benjamin.clark@example.com', '2025-08-14 09:45:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9v8sEL6Yy3Bq9T9s4P4lG6', NULL, '2025-08-14 09:45:05', '2025-08-14 09:45:05'),
(18, 'Amelia Lewis', 'amelia.lewis@example.com', '2025-08-14 09:45:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9v8sEL6Yy3Bq9T9s4P4lG6', NULL, '2025-08-14 09:45:05', '2025-08-14 09:45:05'),
(19, 'Logan Lee', 'logan.lee@example.com', '2025-08-14 09:45:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9v8sEL6Yy3Bq9T9s4P4lG6', NULL, '2025-08-14 09:45:05', '2025-08-14 09:45:05'),
(20, 'Harper Walker', 'harper.walker@example.com', '2025-08-14 09:45:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9v8sEL6Yy3Bq9T9s4P4lG6', NULL, '2025-08-14 09:45:05', '2025-08-14 09:45:05'),
(21, 'Lucas Hall', 'lucas.hall@example.com', '2025-08-14 09:45:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9v8sEL6Yy3Bq9T9s4P4lG6', NULL, '2025-08-14 09:45:05', '2025-08-14 09:45:05'),
(22, 'Evelyn Allen', 'evelyn.allen@example.com', '2025-08-14 09:45:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9v8sEL6Yy3Bq9T9s4P4lG6', NULL, '2025-08-14 09:45:05', '2025-08-14 09:45:05'),
(23, 'Henry Young', 'henry.young@example.com', '2025-08-14 09:45:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9v8sEL6Yy3Bq9T9s4P4lG6', NULL, '2025-08-14 09:45:05', '2025-08-14 09:45:05'),
(24, 'Abigail King', 'abigail.king@example.com', '2025-08-14 09:45:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9v8sEL6Yy3Bq9T9s4P4lG6', NULL, '2025-08-14 09:45:05', '2025-08-14 09:45:05'),
(25, 'Jack Wright', 'jack.wright@example.com', '2025-08-14 09:45:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9v8sEL6Yy3Bq9T9s4P4lG6', NULL, '2025-08-14 09:45:05', '2025-08-14 09:45:05'),
(26, 'Ella Scott', 'ella.scott@example.com', '2025-08-14 09:45:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9v8sEL6Yy3Bq9T9s4P4lG6', NULL, '2025-08-14 09:45:05', '2025-08-14 09:45:05'),
(27, 'Sebastian Green', 'sebastian.green@example.com', '2025-08-14 09:45:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9v8sEL6Yy3Bq9T9s4P4lG6', NULL, '2025-08-14 09:45:05', '2025-08-14 09:45:05'),
(28, 'Aria Adams', 'aria.adams@example.com', '2025-08-14 09:45:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9v8sEL6Yy3Bq9T9s4P4lG6', NULL, '2025-08-14 09:45:05', '2025-08-14 09:45:05'),
(29, 'William Baker', 'william.baker@example.com', '2025-08-14 09:45:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9v8sEL6Yy3Bq9T9s4P4lG6', NULL, '2025-08-14 09:45:05', '2025-08-14 09:45:05'),
(30, 'Scarlett Nelson', 'scarlett.nelson@example.com', '2025-08-14 09:45:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9v8sEL6Yy3Bq9T9s4P4lG6', NULL, '2025-08-14 09:45:05', '2025-08-14 09:45:05'),
(31, 'Samuel Carter', 'samuel.carter@example.com', '2025-08-14 09:45:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9v8sEL6Yy3Bq9T9s4P4lG6', NULL, '2025-08-14 09:45:05', '2025-08-14 09:45:05'),
(32, 'Victoria Mitchell', 'victoria.mitchell@example.com', '2025-08-14 09:45:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9v8sEL6Yy3Bq9T9s4P4lG6', NULL, '2025-08-14 09:45:05', '2025-08-14 09:45:05'),
(33, 'Joseph Perez', 'joseph.perez@example.com', '2025-08-14 09:45:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9v8sEL6Yy3Bq9T9s4P4lG6', NULL, '2025-08-14 09:45:05', '2025-08-14 09:45:05'),
(34, 'Penelope Roberts', 'penelope.roberts@example.com', '2025-08-14 09:45:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9v8sEL6Yy3Bq9T9s4P4lG6', NULL, '2025-08-14 09:45:05', '2025-08-14 09:45:05'),
(35, 'Owen Turner', 'owen.turner@example.com', '2025-08-14 09:45:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9v8sEL6Yy3Bq9T9s4P4lG6', NULL, '2025-08-14 09:45:05', '2025-08-14 09:45:05'),
(36, 'Luna Phillips', 'luna.phillips@example.com', '2025-08-14 09:45:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9v8sEL6Yy3Bq9T9s4P4lG6', NULL, '2025-08-14 09:45:05', '2025-08-14 09:45:05'),
(37, 'Gabriel Campbell', 'gabriel.campbell@example.com', '2025-08-14 09:45:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9v8sEL6Yy3Bq9T9s4P4lG6', NULL, '2025-08-14 09:45:05', '2025-08-14 09:45:05'),
(38, 'Chloe Parker', 'chloe.parker@example.com', '2025-08-14 09:45:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9v8sEL6Yy3Bq9T9s4P4lG6', NULL, '2025-08-14 09:45:05', '2025-08-14 09:45:05'),
(39, 'Aiden Evans', 'aiden.evans@example.com', '2025-08-14 09:45:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9v8sEL6Yy3Bq9T9s4P4lG6', NULL, '2025-08-14 09:45:05', '2025-08-14 09:45:05'),
(40, 'Grace Edwards', 'grace.edwards@example.com', '2025-08-14 09:45:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9v8sEL6Yy3Bq9T9s4P4lG6', NULL, '2025-08-14 09:45:05', '2025-08-14 09:45:05'),
(41, 'Elijah Collins', 'elijah.collins@example.com', '2025-08-14 09:45:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9v8sEL6Yy3Bq9T9s4P4lG6', NULL, '2025-08-14 09:45:05', '2025-08-14 09:45:05'),
(42, 'Zoe Stewart', 'zoe.stewart@example.com', '2025-08-14 09:45:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9v8sEL6Yy3Bq9T9s4P4lG6', NULL, '2025-08-14 09:45:05', '2025-08-14 09:45:05'),
(43, 'Mason Sanchez', 'mason.sanchez@example.com', '2025-08-14 09:45:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9v8sEL6Yy3Bq9T9s4P4lG6', NULL, '2025-08-14 09:45:05', '2025-08-14 09:45:05'),
(44, 'Hannah Morris', 'hannah.morris@example.com', '2025-08-14 09:45:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9v8sEL6Yy3Bq9T9s4P4lG6', NULL, '2025-08-14 09:45:05', '2025-08-14 09:45:05'),
(45, 'Jacob Rogers', 'jacob.rogers@example.com', '2025-08-14 09:45:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9v8sEL6Yy3Bq9T9s4P4lG6', NULL, '2025-08-14 09:45:05', '2025-08-14 09:45:05'),
(46, 'Lily Reed', 'lily.reed@example.com', '2025-08-14 09:45:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9v8sEL6Yy3Bq9T9s4P4lG6', NULL, '2025-08-14 09:45:05', '2025-08-14 09:45:05'),
(47, 'Carter Cook', 'carter.cook@example.com', '2025-08-14 09:45:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9v8sEL6Yy3Bq9T9s4P4lG6', NULL, '2025-08-14 09:45:05', '2025-08-14 09:45:05'),
(48, 'Sofia Morgan', 'sofia.morgan@example.com', '2025-08-14 09:45:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9v8sEL6Yy3Bq9T9s4P4lG6', NULL, '2025-08-14 09:45:05', '2025-08-14 09:45:05'),
(49, 'Wyatt Bell', 'wyatt.bell@example.com', '2025-08-14 09:45:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9v8sEL6Yy3Bq9T9s4P4lG6', NULL, '2025-08-14 09:45:05', '2025-08-14 09:45:05'),
(50, 'Avery Murphy', 'avery.murphy@example.com', '2025-08-14 09:45:05', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9v8sEL6Yy3Bq9T9s4P4lG6', NULL, '2025-08-14 09:45:05', '2025-08-14 09:45:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `email_preferences`
--
ALTER TABLE `email_preferences`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_templates`
--
ALTER TABLE `email_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_templates_slug_unique` (`slug`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_sub_category_id_foreign` (`sub_category_id`);

--
-- Indexes for table `product_tags`
--
ALTER TABLE `product_tags`
  ADD PRIMARY KEY (`product_id`,`tag_id`),
  ADD KEY `product_tags_tag_id_foreign` (`tag_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uploads`
--
ALTER TABLE `uploads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uploads_uploadsable_type_uploadsable_id_index` (`uploadsable_type`,`uploadsable_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `email_preferences`
--
ALTER TABLE `email_preferences`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `email_templates`
--
ALTER TABLE `email_templates`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `uploads`
--
ALTER TABLE `uploads`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_sub_category_id_foreign` FOREIGN KEY (`sub_category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_tags`
--
ALTER TABLE `product_tags`
  ADD CONSTRAINT `product_tags_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_tags_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
