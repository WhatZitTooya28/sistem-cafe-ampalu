-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Jul 2025 pada 03.51
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
(8, '2025_07_16_061948_add_payment_columns_to_orders_table', 3),
(9, '2025_07_18_212515_create_ratings_table', 4);

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
(26, 11, NULL, 20000.00, 'selesai', 'cashier', 'paid', '2025-07-18 06:31:42', '2025-07-18 14:43:51'),
(27, 98, NULL, 20000.00, 'menunggu_pembayaran', 'cashier', 'pending', '2025-07-18 06:51:46', '2025-07-18 06:51:46'),
(28, 98, NULL, 20000.00, 'selesai', 'cashier', 'paid', '2025-07-18 06:52:02', '2025-07-18 14:43:50'),
(29, 11, NULL, 156000.00, 'selesai', 'cashier', 'paid', '2025-07-18 06:53:05', '2025-07-18 14:43:50'),
(30, 98, NULL, 40000.00, 'selesai', 'cashier', 'paid', '2025-07-18 11:56:59', '2025-07-18 14:43:49'),
(31, 43, NULL, 20000.00, 'selesai', 'cashier', 'paid', '2025-07-18 11:57:49', '2025-07-18 14:43:48'),
(32, 1000, NULL, 44000.00, 'selesai', 'cashier', 'paid', '2025-07-18 11:58:53', '2025-07-18 12:04:29'),
(33, 120, NULL, 20000.00, 'selesai', 'cashier', 'paid', '2025-07-18 12:07:04', '2025-07-18 12:07:39'),
(34, 150, NULL, 44000.00, 'selesai', 'cashier', 'paid', '2025-07-18 12:10:59', '2025-07-18 12:17:10'),
(35, 285, NULL, 60000.00, 'selesai', 'cashier', 'paid', '2025-07-18 14:08:40', '2025-07-18 14:09:27'),
(36, 285, NULL, 40000.00, 'menunggu_pembayaran', 'cashier', 'pending', '2025-07-18 14:12:12', '2025-07-18 14:12:12'),
(37, 234, NULL, 20000.00, 'selesai', 'cashier', 'paid', '2025-07-18 14:33:59', '2025-07-18 14:37:09'),
(38, 43, NULL, 20000.00, 'selesai', 'cashier', 'paid', '2025-07-18 14:42:08', '2025-07-18 14:43:46'),
(39, 90, NULL, 76000.00, 'selesai', 'cashier', 'paid', '2025-07-18 14:44:26', '2025-07-18 14:45:56'),
(40, NULL, 'cok', 102000.00, 'selesai', 'cashier', 'paid', '2025-07-18 14:46:53', '2025-07-18 14:48:30'),
(41, 38, NULL, 176000.00, 'selesai', 'cashier', 'paid', '2025-07-18 14:49:17', '2025-07-18 17:45:30'),
(42, 38, NULL, 60000.00, 'selesai', 'cashier', 'paid', '2025-07-18 14:50:20', '2025-07-18 17:45:30'),
(43, 67, NULL, 60000.00, 'menunggu_pembayaran', 'qris', 'pending', '2025-07-18 15:07:23', '2025-07-18 15:07:23'),
(44, 67, NULL, 20000.00, 'menunggu_pembayaran', 'qris', 'pending', '2025-07-18 15:08:04', '2025-07-18 15:08:04'),
(45, 65, NULL, 60000.00, 'menunggu_pembayaran', 'qris', 'pending', '2025-07-18 15:13:15', '2025-07-18 15:13:15'),
(46, 65, NULL, 60000.00, 'menunggu_pembayaran', 'qris', 'pending', '2025-07-18 15:13:36', '2025-07-18 15:13:36'),
(47, 65, NULL, 20000.00, 'menunggu_pembayaran', 'qris', 'pending', '2025-07-18 15:15:10', '2025-07-18 15:15:10'),
(48, 65, NULL, 20000.00, 'menunggu_pembayaran', 'qris', 'pending', '2025-07-18 15:19:40', '2025-07-18 15:19:40'),
(49, 65, NULL, 60000.00, 'menunggu_pembayaran', 'qris', 'pending', '2025-07-18 15:20:48', '2025-07-18 15:20:48'),
(50, 65, NULL, 60000.00, 'menunggu_pembayaran', 'qris', 'pending', '2025-07-18 15:25:07', '2025-07-18 15:25:07'),
(51, 11, NULL, 20000.00, 'menunggu_pembayaran', 'qris', 'pending', '2025-07-18 15:28:41', '2025-07-18 15:28:41'),
(52, 11, NULL, 40000.00, 'menunggu_pembayaran', 'qris', 'pending', '2025-07-18 15:33:53', '2025-07-18 15:33:53'),
(53, 34, NULL, 72000.00, 'menunggu_pembayaran', 'qris', 'pending', '2025-07-18 15:38:59', '2025-07-18 15:38:59'),
(54, 34, NULL, 60000.00, 'menunggu_pembayaran', 'cashier', 'pending', '2025-07-18 15:40:05', '2025-07-18 15:40:05'),
(55, 34, NULL, 24000.00, 'menunggu_pembayaran', 'qris', 'pending', '2025-07-18 15:40:20', '2025-07-18 15:40:20'),
(56, 34, NULL, 60000.00, 'menunggu_pembayaran', 'qris', 'pending', '2025-07-18 15:40:34', '2025-07-18 15:40:34'),
(57, 34, NULL, 60000.00, 'menunggu_pembayaran', 'qris', 'pending', '2025-07-18 15:44:42', '2025-07-18 15:44:42'),
(58, 34, NULL, 75000.00, 'menunggu_pembayaran', 'qris', 'pending', '2025-07-18 15:48:01', '2025-07-18 15:48:01'),
(59, 34, NULL, 60000.00, 'menunggu_pembayaran', 'qris', 'pending', '2025-07-18 15:49:16', '2025-07-18 15:49:16'),
(60, 34, NULL, 20000.00, 'menunggu_pembayaran', 'qris', 'pending', '2025-07-18 15:49:23', '2025-07-18 15:49:23'),
(61, 23, NULL, 180000.00, 'menunggu_pembayaran', 'qris', 'pending', '2025-07-18 15:57:06', '2025-07-18 15:57:06'),
(62, 23, NULL, 40000.00, 'menunggu_pembayaran', 'qris', 'pending', '2025-07-18 15:57:57', '2025-07-18 15:57:57'),
(63, 23, NULL, 40000.00, 'selesai', 'cashier', 'paid', '2025-07-18 15:58:07', '2025-07-18 17:45:29'),
(64, 2, NULL, 20000.00, 'selesai', 'cashier', 'paid', '2025-07-18 16:01:14', '2025-07-18 17:45:28'),
(65, 23, NULL, 60000.00, 'menunggu_pembayaran', 'qris', 'pending', '2025-07-18 16:03:08', '2025-07-18 16:03:08'),
(66, 23, NULL, 60000.00, 'selesai', 'cashier', 'paid', '2025-07-18 16:08:07', '2025-07-18 17:45:27'),
(67, 23, NULL, 60000.00, 'menunggu_pembayaran', 'qris', 'pending', '2025-07-18 16:12:00', '2025-07-18 16:12:00'),
(68, 23, NULL, 20000.00, 'menunggu_pembayaran', 'qris', 'pending', '2025-07-18 16:18:42', '2025-07-18 16:18:42'),
(69, 12, NULL, 20000.00, 'menunggu_pembayaran', 'qris', 'pending', '2025-07-18 16:24:34', '2025-07-18 16:24:34'),
(70, 12, NULL, 40000.00, 'menunggu_pembayaran', 'qris', 'pending', '2025-07-18 16:28:24', '2025-07-18 16:28:24'),
(71, 567, NULL, 24000.00, 'menunggu_pembayaran', 'qris', 'pending', '2025-07-18 16:29:07', '2025-07-18 16:29:07'),
(72, 567, NULL, 20000.00, 'menunggu_pembayaran', 'qris', 'pending', '2025-07-18 16:33:08', '2025-07-18 16:33:08'),
(73, 567, NULL, 20000.00, 'menunggu_pembayaran', 'qris', 'pending', '2025-07-18 16:33:40', '2025-07-18 16:33:40'),
(74, 567, NULL, 20000.00, 'menunggu_pembayaran', 'qris', 'pending', '2025-07-18 16:36:06', '2025-07-18 16:36:06'),
(75, 24, NULL, 20000.00, 'menunggu_pembayaran', 'qris', 'pending', '2025-07-18 16:38:00', '2025-07-18 16:38:00'),
(76, 24, NULL, 20000.00, 'menunggu_pembayaran', 'qris', 'pending', '2025-07-18 16:39:37', '2025-07-18 16:39:37'),
(77, 24, NULL, 20000.00, 'menunggu_pembayaran', 'qris', 'pending', '2025-07-18 16:41:36', '2025-07-18 16:41:36'),
(78, 24, NULL, 20000.00, 'menunggu_pembayaran', 'qris', 'pending', '2025-07-18 16:44:11', '2025-07-18 16:44:11'),
(79, 24, NULL, 20000.00, 'menunggu_pembayaran', 'qris', 'pending', '2025-07-18 16:55:07', '2025-07-18 16:55:07'),
(80, 24, NULL, 40000.00, 'menunggu_pembayaran', 'qris', 'pending', '2025-07-18 17:02:13', '2025-07-18 17:02:13'),
(81, 24, NULL, 100000.00, 'menunggu_pembayaran', 'qris', 'pending', '2025-07-18 17:04:54', '2025-07-18 17:04:54'),
(82, 24, NULL, 20000.00, 'menunggu_pembayaran', 'qris', 'pending', '2025-07-18 17:10:49', '2025-07-18 17:10:49'),
(83, 24, NULL, 60000.00, 'selesai', 'qris', 'paid', '2025-07-18 17:25:44', '2025-07-18 17:45:27'),
(84, 12, NULL, 20000.00, 'selesai', 'qris', 'paid', '2025-07-18 17:37:38', '2025-07-18 17:45:26'),
(85, 12, NULL, 20000.00, 'selesai', 'cashier', 'paid', '2025-07-18 17:40:43', '2025-07-18 17:45:24'),
(86, NULL, 'yoga', 78000.00, 'selesai', 'cashier', 'paid', '2025-07-18 17:45:03', '2025-07-18 17:45:23'),
(87, 23, NULL, 44000.00, 'menunggu_pembayaran', 'cashier', 'pending', '2025-07-18 18:23:35', '2025-07-18 18:23:35'),
(88, 23, NULL, 108000.00, 'menunggu_pembayaran', 'qris', 'pending', '2025-07-18 18:24:05', '2025-07-18 18:24:05'),
(89, NULL, 'aziz', 60000.00, 'proses', 'cashier', 'paid', '2025-07-18 18:33:27', '2025-07-18 18:33:38'),
(90, NULL, 'aziz', 80000.00, 'proses', 'qris', 'paid', '2025-07-18 18:34:05', '2025-07-18 18:34:12'),
(91, NULL, 'aziz', 60000.00, 'proses', 'cashier', 'paid', '2025-07-18 18:47:36', '2025-07-18 18:47:39'),
(92, 900, NULL, 60000.00, 'proses', 'cashier', 'paid', '2025-07-18 18:48:28', '2025-07-18 18:48:34'),
(93, NULL, 'asep', 100000.00, 'selesai', 'qris', 'paid', '2025-07-18 18:49:38', '2025-07-18 18:50:08');

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
(68, 29, 4, 4, 24000.00, NULL, '2025-07-18 06:53:06', '2025-07-18 06:53:06'),
(69, 30, 5, 2, 20000.00, NULL, '2025-07-18 11:56:59', '2025-07-18 11:56:59'),
(70, 31, 5, 1, 20000.00, NULL, '2025-07-18 11:57:49', '2025-07-18 11:57:49'),
(71, 32, 5, 1, 20000.00, NULL, '2025-07-18 11:58:53', '2025-07-18 11:58:53'),
(72, 32, 4, 1, 24000.00, NULL, '2025-07-18 11:58:53', '2025-07-18 11:58:53'),
(73, 33, 5, 1, 20000.00, NULL, '2025-07-18 12:07:04', '2025-07-18 12:07:04'),
(74, 34, 5, 1, 20000.00, NULL, '2025-07-18 12:11:00', '2025-07-18 12:11:00'),
(75, 34, 4, 1, 24000.00, NULL, '2025-07-18 12:11:00', '2025-07-18 12:11:00'),
(76, 35, 5, 3, 20000.00, NULL, '2025-07-18 14:08:40', '2025-07-18 14:08:40'),
(77, 36, 5, 2, 20000.00, NULL, '2025-07-18 14:12:12', '2025-07-18 14:12:12'),
(78, 37, 5, 1, 20000.00, NULL, '2025-07-18 14:34:00', '2025-07-18 14:34:00'),
(79, 38, 5, 1, 20000.00, NULL, '2025-07-18 14:42:08', '2025-07-18 14:42:08'),
(80, 39, 10, 4, 19000.00, NULL, '2025-07-18 14:44:26', '2025-07-18 14:44:26'),
(81, 40, 3, 1, 18000.00, '', '2025-07-18 14:46:53', '2025-07-18 14:46:53'),
(82, 40, 4, 1, 24000.00, '', '2025-07-18 14:46:53', '2025-07-18 14:46:53'),
(83, 40, 5, 3, 20000.00, '', '2025-07-18 14:46:53', '2025-07-18 14:46:53'),
(84, 41, 4, 4, 24000.00, NULL, '2025-07-18 14:49:17', '2025-07-18 14:49:17'),
(85, 41, 8, 4, 20000.00, NULL, '2025-07-18 14:49:17', '2025-07-18 14:49:17'),
(86, 42, 5, 3, 20000.00, NULL, '2025-07-18 14:50:20', '2025-07-18 14:50:20'),
(87, 43, 5, 3, 20000.00, NULL, '2025-07-18 15:07:23', '2025-07-18 15:07:23'),
(88, 44, 5, 1, 20000.00, NULL, '2025-07-18 15:08:04', '2025-07-18 15:08:04'),
(89, 45, 5, 3, 20000.00, NULL, '2025-07-18 15:13:15', '2025-07-18 15:13:15'),
(90, 46, 5, 3, 20000.00, NULL, '2025-07-18 15:13:36', '2025-07-18 15:13:36'),
(91, 47, 5, 1, 20000.00, NULL, '2025-07-18 15:15:10', '2025-07-18 15:15:10'),
(92, 48, 5, 1, 20000.00, NULL, '2025-07-18 15:19:40', '2025-07-18 15:19:40'),
(93, 49, 5, 3, 20000.00, NULL, '2025-07-18 15:20:48', '2025-07-18 15:20:48'),
(94, 50, 5, 3, 20000.00, NULL, '2025-07-18 15:25:07', '2025-07-18 15:25:07'),
(95, 51, 5, 1, 20000.00, NULL, '2025-07-18 15:28:41', '2025-07-18 15:28:41'),
(96, 52, 5, 2, 20000.00, NULL, '2025-07-18 15:33:53', '2025-07-18 15:33:53'),
(97, 53, 4, 3, 24000.00, NULL, '2025-07-18 15:38:59', '2025-07-18 15:38:59'),
(98, 54, 5, 3, 20000.00, NULL, '2025-07-18 15:40:05', '2025-07-18 15:40:05'),
(99, 55, 4, 1, 24000.00, NULL, '2025-07-18 15:40:20', '2025-07-18 15:40:20'),
(100, 56, 5, 3, 20000.00, NULL, '2025-07-18 15:40:34', '2025-07-18 15:40:34'),
(101, 57, 5, 3, 20000.00, NULL, '2025-07-18 15:44:42', '2025-07-18 15:44:42'),
(102, 58, 9, 3, 25000.00, NULL, '2025-07-18 15:48:01', '2025-07-18 15:48:01'),
(103, 59, 5, 3, 20000.00, NULL, '2025-07-18 15:49:16', '2025-07-18 15:49:16'),
(104, 60, 5, 1, 20000.00, NULL, '2025-07-18 15:49:23', '2025-07-18 15:49:23'),
(105, 61, 5, 9, 20000.00, NULL, '2025-07-18 15:57:06', '2025-07-18 15:57:06'),
(106, 62, 5, 2, 20000.00, NULL, '2025-07-18 15:57:57', '2025-07-18 15:57:57'),
(107, 63, 5, 2, 20000.00, NULL, '2025-07-18 15:58:07', '2025-07-18 15:58:07'),
(108, 64, 5, 1, 20000.00, NULL, '2025-07-18 16:01:14', '2025-07-18 16:01:14'),
(109, 65, 5, 3, 20000.00, NULL, '2025-07-18 16:03:08', '2025-07-18 16:03:08'),
(110, 66, 5, 3, 20000.00, NULL, '2025-07-18 16:08:07', '2025-07-18 16:08:07'),
(111, 67, 8, 3, 20000.00, NULL, '2025-07-18 16:12:00', '2025-07-18 16:12:00'),
(112, 68, 5, 1, 20000.00, NULL, '2025-07-18 16:18:42', '2025-07-18 16:18:42'),
(113, 69, 5, 1, 20000.00, NULL, '2025-07-18 16:24:34', '2025-07-18 16:24:34'),
(114, 70, 5, 2, 20000.00, NULL, '2025-07-18 16:28:24', '2025-07-18 16:28:24'),
(115, 71, 4, 1, 24000.00, NULL, '2025-07-18 16:29:07', '2025-07-18 16:29:07'),
(116, 72, 5, 1, 20000.00, NULL, '2025-07-18 16:33:08', '2025-07-18 16:33:08'),
(117, 73, 5, 1, 20000.00, NULL, '2025-07-18 16:33:40', '2025-07-18 16:33:40'),
(118, 74, 5, 1, 20000.00, NULL, '2025-07-18 16:36:06', '2025-07-18 16:36:06'),
(119, 75, 5, 1, 20000.00, NULL, '2025-07-18 16:38:00', '2025-07-18 16:38:00'),
(120, 76, 5, 1, 20000.00, NULL, '2025-07-18 16:39:37', '2025-07-18 16:39:37'),
(121, 77, 5, 1, 20000.00, NULL, '2025-07-18 16:41:36', '2025-07-18 16:41:36'),
(122, 78, 5, 1, 20000.00, NULL, '2025-07-18 16:44:11', '2025-07-18 16:44:11'),
(123, 79, 5, 1, 20000.00, NULL, '2025-07-18 16:55:07', '2025-07-18 16:55:07'),
(124, 80, 5, 2, 20000.00, NULL, '2025-07-18 17:02:13', '2025-07-18 17:02:13'),
(125, 81, 9, 4, 25000.00, NULL, '2025-07-18 17:04:54', '2025-07-18 17:04:54'),
(126, 82, 5, 1, 20000.00, NULL, '2025-07-18 17:10:49', '2025-07-18 17:10:49'),
(127, 83, 5, 3, 20000.00, NULL, '2025-07-18 17:25:44', '2025-07-18 17:25:44'),
(128, 84, 5, 1, 20000.00, NULL, '2025-07-18 17:37:38', '2025-07-18 17:37:38'),
(129, 85, 8, 1, 20000.00, NULL, '2025-07-18 17:40:43', '2025-07-18 17:40:43'),
(130, 86, 3, 3, 18000.00, '', '2025-07-18 17:45:03', '2025-07-18 17:45:03'),
(131, 86, 4, 1, 24000.00, '', '2025-07-18 17:45:03', '2025-07-18 17:45:03'),
(132, 87, 5, 1, 20000.00, NULL, '2025-07-18 18:23:35', '2025-07-18 18:23:35'),
(133, 87, 4, 1, 24000.00, NULL, '2025-07-18 18:23:35', '2025-07-18 18:23:35'),
(134, 88, 4, 2, 24000.00, NULL, '2025-07-18 18:24:05', '2025-07-18 18:24:05'),
(135, 88, 5, 3, 20000.00, NULL, '2025-07-18 18:24:05', '2025-07-18 18:24:05'),
(136, 89, 5, 3, 20000.00, NULL, '2025-07-18 18:33:27', '2025-07-18 18:33:27'),
(137, 90, 5, 4, 20000.00, NULL, '2025-07-18 18:34:05', '2025-07-18 18:34:05'),
(138, 91, 5, 3, 20000.00, NULL, '2025-07-18 18:47:36', '2025-07-18 18:47:36'),
(139, 92, 5, 3, 20000.00, NULL, '2025-07-18 18:48:28', '2025-07-18 18:48:28'),
(140, 93, 5, 5, 20000.00, NULL, '2025-07-18 18:49:38', '2025-07-18 18:49:38');

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
-- Struktur dari tabel `ratings`
--

CREATE TABLE `ratings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_item_id` bigint(20) UNSIGNED NOT NULL,
  `rating` tinyint(3) UNSIGNED NOT NULL,
  `review` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `ratings`
--

INSERT INTO `ratings` (`id`, `order_item_id`, `rating`, `review`, `created_at`, `updated_at`) VALUES
(1, 78, 5, 'enak', '2025-07-18 14:37:29', '2025-07-18 14:37:29'),
(2, 79, 5, 'p', '2025-07-18 14:42:57', '2025-07-18 14:42:57'),
(3, 80, 5, 'enak', '2025-07-18 14:45:17', '2025-07-18 14:45:17'),
(4, 86, 5, 'enak', '2025-07-18 15:51:52', '2025-07-18 15:51:52'),
(5, 137, 5, NULL, '2025-07-18 18:45:21', '2025-07-18 18:45:21'),
(6, 139, 5, NULL, '2025-07-18 18:48:53', '2025-07-18 18:48:53'),
(7, 140, 5, NULL, '2025-07-18 18:49:57', '2025-07-18 18:50:26');

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
('oEWEANwuG3nsCar5nKdq5wEjJlFNELi8zUWieOEw', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiQ0pHem9wYmVhaHYzUm9XUXJEZ0tKRXd6cWtBdDJtdE1pbnlTY01ldyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6MTM6ImN1c3RvbWVyX25hbWUiO3M6NDoiYXNlcCI7fQ==', 1752889830);

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
-- Indeks untuk tabel `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ratings_order_item_id_foreign` (`order_item_id`);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT untuk tabel `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- AUTO_INCREMENT untuk tabel `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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

--
-- Ketidakleluasaan untuk tabel `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_order_item_id_foreign` FOREIGN KEY (`order_item_id`) REFERENCES `order_items` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
