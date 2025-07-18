-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Jul 2025 pada 16.56
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_cafe_ampalu`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `category` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `menus`
--

INSERT INTO `menus` (`id`, `name`, `description`, `price`, `category`, `image`, `image_url`, `created_at`, `updated_at`) VALUES
(3, 'nasi ayam lada hitam', 'enak', 18000.00, 'Foods', 'OlyoFV5gOivw8gRrrsinMpaIMdT1GH7nSBJUL6mP.jpg', NULL, '2025-07-15 23:03:25', '2025-07-15 23:03:25'),
(4, 'creamy chicken ampalu', 'enak', 24000.00, 'Foods', 'aLF6tMdbkbYKLMsCnuGyqp07nDUjefcQ4omTAd6a.jpg', NULL, '2025-07-15 23:03:45', '2025-07-15 23:03:45'),
(5, 'nasi goreng ampalu', 'enak', 20000.00, 'Foods', 'O4HzVEGDV5LIPAaIKXNS3kXfNYazJFkSLzmlLo41.jpg', NULL, '2025-07-15 23:04:03', '2025-07-15 23:04:03'),
(6, 'Strawberry Mocktail', 'enak', 18000.00, 'Non-Coffee', 'gyUSXHZEzPYfMmhzSxQXD0vwYMyWrVZbdjchjc75.jpg', NULL, '2025-07-15 23:04:22', '2025-07-15 23:04:22'),
(7, 'americano panas', 'enak', 15000.00, 'Coffe', 'kdmvSH6nXBMw9NFytotZSvYifSHPnJ0fHHrgsXZc.jpg', NULL, '2025-07-15 23:04:40', '2025-07-15 23:04:40'),
(8, 'espresso', 'enak', 20000.00, 'Coffe', 'lPA7Jkh7HqAnEPxxqEsFOfuTF8tq4ksg6B5YWKbv.jpg', NULL, '2025-07-15 23:04:58', '2025-07-15 23:04:58'),
(9, 'Es krim taro', 'enak', 25000.00, 'Non-Coffee', '4miZyCkolz2768WcPeVwUhnzhJSl0rQPSBlLDza1.jpg', NULL, '2025-07-15 23:05:21', '2025-07-15 23:05:21'),
(10, 'Spaghetti bolognese', 'enak', 19000.00, 'Snack', 'oqdW0o1aiXhsFFlPl7eyo3THKW7jNzfPKuHc04sq.jpg', NULL, '2025-07-15 23:05:37', '2025-07-15 23:05:37');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_07_09_044557_create_menus_table', 1),
(5, '2025_07_15_150023_add_image_to_menus_table', 1),
(6, '2025_07_16_055739_create_orders_table', 2),
(7, '2025_07_16_055919_create_order_items_table', 2),
(8, '2025_07_16_061948_add_payment_columns_to_orders_table', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `table_number` int(10) UNSIGNED DEFAULT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `total_price` decimal(15,2) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'proses',
  `payment_method` varchar(255) NOT NULL,
  `payment_status` varchar(255) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `orders`
--

INSERT INTO `orders` (`id`, `table_number`, `customer_name`, `total_price`, `status`, `payment_method`, `payment_status`, `created_at`, `updated_at`) VALUES
(1, 22, NULL, 209000.00, 'selesai', 'cashier', 'paid', '2025-07-15 23:32:32', '2025-07-18 04:03:17'),
(2, 22, NULL, 45000.00, 'selesai', 'qris', 'pending', '2025-07-15 23:34:05', '2025-07-18 04:03:15'),
(3, 33, NULL, 40000.00, 'selesai', 'qris', 'pending', '2025-07-15 23:42:40', '2025-07-17 04:30:47'),
(4, 112, NULL, 24000.00, 'selesai', 'cashier', 'paid', '2025-07-16 23:05:10', '2025-07-17 01:56:16'),
(5, 33, NULL, 44000.00, 'selesai', 'qris', 'pending', '2025-07-16 23:06:58', '2025-07-17 01:56:15'),
(6, 22, NULL, 20000.00, 'selesai', 'qris', 'pending', '2025-07-16 23:08:01', '2025-07-17 01:56:13'),
(7, 222, NULL, 44000.00, 'menunggu_persetujuan', 'cashier', 'pending', '2025-07-17 01:52:41', '2025-07-17 01:52:41'),
(8, 12, NULL, 49000.00, 'menunggu_persetujuan', 'cashier', 'pending', '2025-07-17 04:10:07', '2025-07-17 04:10:07'),
(9, NULL, 'aziz', 80000.00, 'selesai', 'cashier', 'paid', '2025-07-17 04:58:36', '2025-07-17 05:05:12'),
(10, NULL, 'aziz', 42000.00, 'selesai', 'cashier', 'paid', '2025-07-17 05:02:23', '2025-07-17 05:05:08'),
(11, NULL, 'aziz', 62000.00, 'selesai', 'cashier', 'paid', '2025-07-17 05:03:47', '2025-07-17 05:05:06'),
(12, NULL, 'aziz', 42000.00, 'selesai', 'cashier', 'paid', '2025-07-17 05:04:30', '2025-07-17 05:05:04'),
(13, NULL, 'Rasid', 37000.00, 'selesai', 'cashier', 'paid', '2025-07-17 05:06:05', '2025-07-18 04:02:54'),
(14, NULL, 'Fajar', 44000.00, 'selesai', 'cashier', 'paid', '2025-07-17 05:06:38', '2025-07-18 04:02:31'),
(15, NULL, 'Fajar', 105000.00, 'selesai', 'cashier', 'paid', '2025-07-18 02:39:10', '2025-07-18 04:02:18'),
(16, NULL, 'yoga', 159000.00, 'selesai', 'cashier', 'paid', '2025-07-18 03:07:26', '2025-07-18 04:01:49'),
(17, NULL, 'adib', 136000.00, 'selesai', 'cashier', 'paid', '2025-07-18 03:51:14', '2025-07-18 03:51:49'),
(18, NULL, 'yoga', 310000.00, 'selesai', 'cashier', 'paid', '2025-07-18 04:09:21', '2025-07-18 04:13:40'),
(19, 33, NULL, 180000.00, 'menunggu_pembayaran', 'cashier', 'pending', '2025-07-18 05:21:12', '2025-07-18 05:21:12'),
(20, 11, NULL, 44000.00, 'menunggu_pembayaran', 'cashier', 'pending', '2025-07-18 05:24:00', '2025-07-18 05:24:00'),
(21, 11, NULL, 44000.00, 'menunggu_pembayaran', 'cashier', 'pending', '2025-07-18 05:25:22', '2025-07-18 05:25:22'),
(22, 11, NULL, 44000.00, 'selesai', 'cashier', 'paid', '2025-07-18 05:41:58', '2025-07-18 05:44:04'),
(23, 11, NULL, 44000.00, 'selesai', 'cashier', 'paid', '2025-07-18 05:56:53', '2025-07-18 06:09:50'),
(24, 12, NULL, 44000.00, 'menunggu_pembayaran', 'cashier', 'pending', '2025-07-18 06:08:20', '2025-07-18 06:08:20'),
(25, 11, NULL, 20000.00, 'selesai', 'cashier', 'paid', '2025-07-18 06:11:34', '2025-07-18 06:13:01'),
(26, 11, NULL, 20000.00, 'proses', 'cashier', 'paid', '2025-07-18 06:31:42', '2025-07-18 06:31:45'),
(27, 98, NULL, 20000.00, 'menunggu_pembayaran', 'cashier', 'pending', '2025-07-18 06:51:46', '2025-07-18 06:51:46'),
(28, 98, NULL, 20000.00, 'proses', 'cashier', 'paid', '2025-07-18 06:52:02', '2025-07-18 06:52:11'),
(29, 11, NULL, 156000.00, 'proses', 'cashier', 'paid', '2025-07-18 06:53:05', '2025-07-18 06:53:07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `menu_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `menu_id`, `quantity`, `price`, `notes`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 3, 24000.00, NULL, '2025-07-15 23:32:32', '2025-07-15 23:32:32'),
(2, 1, 8, 4, 20000.00, NULL, '2025-07-15 23:32:32', '2025-07-15 23:32:32'),
(3, 1, 10, 3, 19000.00, NULL, '2025-07-15 23:32:32', '2025-07-15 23:32:32'),
(4, 2, 5, 1, 20000.00, NULL, '2025-07-15 23:34:05', '2025-07-15 23:34:05'),
(5, 2, 9, 1, 25000.00, NULL, '2025-07-15 23:34:05', '2025-07-15 23:34:05'),
(6, 3, 8, 1, 20000.00, NULL, '2025-07-15 23:42:40', '2025-07-15 23:42:40'),
(7, 3, 5, 1, 20000.00, NULL, '2025-07-15 23:42:40', '2025-07-15 23:42:40'),
(8, 4, 4, 1, 24000.00, NULL, '2025-07-16 23:05:10', '2025-07-16 23:05:10'),
(9, 5, 8, 1, 20000.00, NULL, '2025-07-16 23:06:58', '2025-07-16 23:06:58'),
(10, 5, 4, 1, 24000.00, NULL, '2025-07-16 23:06:58', '2025-07-16 23:06:58'),
(11, 6, 5, 1, 20000.00, NULL, '2025-07-16 23:08:01', '2025-07-16 23:08:01'),
(12, 7, 5, 1, 20000.00, NULL, '2025-07-17 01:52:41', '2025-07-17 01:52:41'),
(13, 7, 4, 1, 24000.00, NULL, '2025-07-17 01:52:41', '2025-07-17 01:52:41'),
(14, 8, 4, 1, 24000.00, NULL, '2025-07-17 04:10:07', '2025-07-17 04:10:07'),
(15, 8, 9, 1, 25000.00, NULL, '2025-07-17 04:10:07', '2025-07-17 04:10:07'),
(16, 9, 3, 1, 18000.00, '', '2025-07-17 04:58:36', '2025-07-17 04:58:36'),
(17, 9, 4, 1, 24000.00, '', '2025-07-17 04:58:36', '2025-07-17 04:58:36'),
(18, 9, 5, 1, 20000.00, '', '2025-07-17 04:58:36', '2025-07-17 04:58:36'),
(19, 9, 6, 1, 18000.00, '', '2025-07-17 04:58:36', '2025-07-17 04:58:36'),
(20, 10, 4, 1, 24000.00, '', '2025-07-17 05:02:23', '2025-07-17 05:02:23'),
(21, 10, 3, 1, 18000.00, '', '2025-07-17 05:02:23', '2025-07-17 05:02:23'),
(22, 11, 3, 1, 18000.00, '', '2025-07-17 05:03:47', '2025-07-17 05:03:47'),
(23, 11, 4, 1, 24000.00, '', '2025-07-17 05:03:47', '2025-07-17 05:03:47'),
(24, 11, 5, 1, 20000.00, '', '2025-07-17 05:03:47', '2025-07-17 05:03:47'),
(25, 12, 4, 1, 24000.00, '', '2025-07-17 05:04:30', '2025-07-17 05:04:30'),
(26, 12, 3, 1, 18000.00, '', '2025-07-17 05:04:30', '2025-07-17 05:04:30'),
(27, 13, 3, 1, 18000.00, '', '2025-07-17 05:06:05', '2025-07-17 05:06:05'),
(28, 13, 10, 1, 19000.00, '', '2025-07-17 05:06:05', '2025-07-17 05:06:05'),
(29, 14, 4, 1, 24000.00, '', '2025-07-17 05:06:38', '2025-07-17 05:06:38'),
(30, 14, 5, 1, 20000.00, '', '2025-07-17 05:06:38', '2025-07-17 05:06:38'),
(31, 15, 3, 1, 18000.00, '', '2025-07-18 02:39:10', '2025-07-18 02:39:10'),
(32, 15, 4, 1, 24000.00, '', '2025-07-18 02:39:11', '2025-07-18 02:39:11'),
(33, 15, 5, 1, 20000.00, '', '2025-07-18 02:39:11', '2025-07-18 02:39:11'),
(34, 15, 6, 1, 18000.00, '', '2025-07-18 02:39:11', '2025-07-18 02:39:11'),
(35, 15, 9, 1, 25000.00, '', '2025-07-18 02:39:11', '2025-07-18 02:39:11'),
(36, 16, 3, 1, 18000.00, '', '2025-07-18 03:07:26', '2025-07-18 03:07:26'),
(37, 16, 4, 1, 24000.00, '', '2025-07-18 03:07:26', '2025-07-18 03:07:26'),
(38, 16, 5, 1, 20000.00, '', '2025-07-18 03:07:26', '2025-07-18 03:07:26'),
(39, 16, 6, 1, 18000.00, '', '2025-07-18 03:07:26', '2025-07-18 03:07:26'),
(40, 16, 9, 1, 25000.00, '', '2025-07-18 03:07:26', '2025-07-18 03:07:26'),
(41, 16, 7, 1, 15000.00, '', '2025-07-18 03:07:26', '2025-07-18 03:07:26'),
(42, 16, 8, 1, 20000.00, '', '2025-07-18 03:07:26', '2025-07-18 03:07:26'),
(43, 16, 10, 1, 19000.00, '', '2025-07-18 03:07:26', '2025-07-18 03:07:26'),
(44, 17, 3, 4, 18000.00, '', '2025-07-18 03:51:14', '2025-07-18 03:51:14'),
(45, 17, 5, 2, 20000.00, '', '2025-07-18 03:51:14', '2025-07-18 03:51:14'),
(46, 17, 4, 1, 24000.00, '', '2025-07-18 03:51:14', '2025-07-18 03:51:14'),
(47, 18, 3, 5, 18000.00, '', '2025-07-18 04:09:21', '2025-07-18 04:09:21'),
(48, 18, 10, 5, 19000.00, '', '2025-07-18 04:09:21', '2025-07-18 04:09:21'),
(49, 18, 9, 5, 25000.00, '', '2025-07-18 04:09:21', '2025-07-18 04:09:21'),
(50, 19, 5, 4, 20000.00, NULL, '2025-07-18 05:21:12', '2025-07-18 05:21:12'),
(51, 19, 9, 4, 25000.00, NULL, '2025-07-18 05:21:12', '2025-07-18 05:21:12'),
(52, 20, 8, 0, 20000.00, NULL, '2025-07-18 05:24:00', '2025-07-18 05:24:00'),
(53, 20, 5, 1, 20000.00, NULL, '2025-07-18 05:24:00', '2025-07-18 05:24:00'),
(54, 20, 4, 1, 24000.00, NULL, '2025-07-18 05:24:00', '2025-07-18 05:24:00'),
(55, 21, 5, 1, 20000.00, NULL, '2025-07-18 05:25:22', '2025-07-18 05:25:22'),
(56, 21, 4, 1, 24000.00, NULL, '2025-07-18 05:25:22', '2025-07-18 05:25:22'),
(57, 22, 5, 1, 20000.00, NULL, '2025-07-18 05:41:58', '2025-07-18 05:41:58'),
(58, 22, 4, 1, 24000.00, NULL, '2025-07-18 05:41:58', '2025-07-18 05:41:58'),
(59, 23, 4, 1, 24000.00, NULL, '2025-07-18 05:56:53', '2025-07-18 05:56:53'),
(60, 23, 5, 1, 20000.00, NULL, '2025-07-18 05:56:53', '2025-07-18 05:56:53'),
(61, 24, 5, 1, 20000.00, NULL, '2025-07-18 06:08:20', '2025-07-18 06:08:20'),
(62, 24, 4, 1, 24000.00, NULL, '2025-07-18 06:08:20', '2025-07-18 06:08:20'),
(63, 25, 5, 1, 20000.00, NULL, '2025-07-18 06:11:34', '2025-07-18 06:11:34'),
(64, 26, 5, 1, 20000.00, NULL, '2025-07-18 06:31:42', '2025-07-18 06:31:42'),
(65, 27, 5, 1, 20000.00, NULL, '2025-07-18 06:51:46', '2025-07-18 06:51:46'),
(66, 28, 5, 1, 20000.00, NULL, '2025-07-18 06:52:02', '2025-07-18 06:52:02'),
(67, 29, 5, 3, 20000.00, NULL, '2025-07-18 06:53:05', '2025-07-18 06:53:05'),
(68, 29, 4, 4, 24000.00, NULL, '2025-07-18 06:53:06', '2025-07-18 06:53:06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('GQovW8R6n4jL1n9gmQ44uXT7wsBydVMmaIAWriFr', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiYzcyTGVzWlNWNXNnemxIRW1xMkNKdkdsMEw1WmZrVXI4cUx5OVQ5SCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9tZW51Ijt9czoxMjoidGFibGVfbnVtYmVyIjtzOjI6IjIyIjt9', 1752847654);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'kasir',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin Cafe', 'admin@cafeampalu.com', NULL, '$2y$12$5NeRm8XXmXXvbl1d5oo1g.GR/jbksI5lYYzdLPq0TMFIGvojHCnrO', 'admin', NULL, '2025-07-15 22:46:28', '2025-07-15 22:46:28'),
(2, 'Kasir Satu', 'kasir@cafeampalu.com', NULL, '$2y$12$fTLUvmCOjxWG3qq9Ou3/ZOQ9FJ32FqB2ZaJF4IU3WiLEyotbMY.Sm', 'kasir', NULL, '2025-07-15 22:46:28', '2025-07-15 22:46:28'),
(3, 'Admin Dapur', 'dapur@cafeampalu.com', NULL, '$2y$12$rh2s0tiHOnUYiebAjy3A9uYaUbO32nbcIZe5qPOxbGxxK8THJaZx2', 'dapur', NULL, '2025-07-15 22:46:28', '2025-07-15 22:46:28');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_menu_id_foreign` (`menu_id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`),
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
