-- phpMyAdmin SQL Dump
-- version 5.0.4deb2~bpo10+1+bionic1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 01, 2021 at 08:07 PM
-- Server version: 5.7.33-0ubuntu0.18.04.1
-- PHP Version: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pharmacy`
--

-- --------------------------------------------------------

--
-- Table structure for table `attributes`
--

CREATE TABLE `attributes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `attributes`
--

INSERT INTO `attributes` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'ML', 'ml', '2021-01-06 06:04:45', '2021-01-06 06:06:38'),
(2, 'MG', 'mg', '2021-01-06 07:03:22', '2021-01-06 07:03:22');

-- --------------------------------------------------------

--
-- Table structure for table `attribute_values`
--

CREATE TABLE `attribute_values` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `attribute_id` bigint(20) UNSIGNED NOT NULL,
  `value` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `attribute_values`
--

INSERT INTO `attribute_values` (`id`, `attribute_id`, `value`, `created_at`, `updated_at`) VALUES
(1, 1, '30', '2021-01-06 06:43:03', '2021-01-06 06:43:03'),
(2, 1, '50', '2021-01-06 07:00:27', '2021-01-06 07:00:27'),
(3, 1, '100', '2021-01-06 07:02:11', '2021-01-06 07:02:11'),
(4, 2, '250', '2021-01-06 07:03:33', '2021-01-06 07:03:33'),
(5, 2, '500', '2021-01-06 07:03:47', '2021-01-06 07:03:47');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(2, 'Square Pharmaceuticals', 'square-pharmaceuticals', '2021-01-03 04:30:57', '2021-01-03 04:30:57');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `parent_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `user_id`, `name`, `slug`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, 5, 'Syrup', 'syrup', 0, '2021-01-03 05:49:25', '2021-01-03 06:31:13'),
(2, 5, 'Capsule', 'capsule', 0, '2021-01-03 05:51:21', '2021-01-03 06:31:23'),
(3, 5, 'Tablet', 'tablet', 0, '2021-01-03 05:52:31', '2021-01-03 05:52:31');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(70) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(70) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `user_id`, `name`, `mobile`, `email`, `address`, `created_at`, `updated_at`) VALUES
(1, 5, 'Mohammad Jamal', '03493494888', 'jamal@gmail.com', 'Demo Address', '2021-02-03 05:16:42', '2021-02-17 10:16:13'),
(2, 5, 'Mohammad Kamal', '03493494898', 'kamal@gmail.com', 'Kamal Demo Address', '2021-02-03 05:17:22', '2021-02-17 10:08:57'),
(4, 5, 'Jhon Doe', '01516120343', 'jhon@mail.com', 'Jhon Doe Address', '2021-02-17 10:15:59', '2021-02-17 10:15:59'),
(5, 5, 'Alim Dhar', '23283728999', 'alim@gmail.com', 'Address', '2021-02-17 10:17:06', '2021-02-17 10:17:06');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `account_name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `account_code` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `expense_amount` decimal(8,2) NOT NULL DEFAULT '0.00',
  `narration` text COLLATE utf8_unicode_ci,
  `transaction_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `user_id`, `account_name`, `account_code`, `expense_amount`, `narration`, `transaction_date`, `created_at`, `updated_at`) VALUES
(1, 5, 'Conveyance', '100232', '60.00', 'Conveyance  Expense', '2021-01-14 18:00:00', '2021-02-17 11:19:14', '2021-02-17 11:26:41'),
(2, 5, 'Conveyance', '100232', '40.00', 'Conveyance  Expense', '2021-02-14 18:00:00', '2021-02-17 11:19:14', '2021-02-17 11:26:41'),
(3, 5, 'Conveyance', '100232', '140.00', 'Conveyance  Expense', '2021-02-20 18:00:00', '2021-02-17 11:19:14', '2021-02-17 11:26:41');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `connection` text COLLATE utf8_unicode_ci NOT NULL,
  `queue` text COLLATE utf8_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sale_id` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `sale_id`, `invoice_id`, `created_at`, `updated_at`) VALUES
(1, 74, '000001', '2021-02-13 07:23:33', '2021-02-13 07:23:33'),
(2, 78, '000002', '2021-02-13 07:25:49', '2021-02-13 07:25:49');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_12_26_065428_create_brands_table', 2),
(6, '2021_01_03_105144_create_categories_table', 3),
(7, '2021_01_06_113010_create_attributes_table', 4),
(8, '2021_01_06_115523_create_attribute_values_table', 4),
(15, '2021_01_10_085036_create_products_table', 5),
(25, '2021_01_13_111249_create_suppliers_table', 6),
(26, '2021_01_13_114817_create_purchases_table', 6),
(27, '2021_01_22_144000_create_customers_table', 6),
(28, '2021_01_22_145005_create_sales_table', 6),
(30, '2021_01_29_163221_create_product_sale_table', 6),
(31, '2021_02_13_130636_create_invoices_table', 7),
(32, '2021_02_17_162217_create_expenses_table', 8),
(33, '2021_01_22_145247_create_receipts_table', 9),
(34, '2021_02_19_215815_create_settings_table', 10);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `sku` varchar(70) COLLATE utf8_unicode_ci DEFAULT NULL,
  `barcode` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `total_quantity` int(11) NOT NULL,
  `sales_price` double(8,2) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `thumbnail` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` enum('Publish','Pending','Draft') COLLATE utf8_unicode_ci DEFAULT 'Pending',
  `expiry_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `user_id`, `brand_id`, `category_id`, `name`, `slug`, `sku`, `barcode`, `total_quantity`, `sales_price`, `description`, `thumbnail`, `status`, `expiry_date`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 5, 2, 2, 'Zmax 500mg', 'zmax-500mg', 'fasdfsaf', 'dfasdff', 10, 35.00, 'Description', NULL, 'Pending', '2023-02-20 18:00:00', '2021-01-15 08:56:54', '2021-02-21 16:13:43', NULL),
(2, 5, 2, 2, 'Seclo 20mg', 'seclo-20mg', 'fasdfsaf', 'dfasdff', 10, 30.00, 'Description', NULL, 'Pending', NULL, '2021-01-15 09:06:38', '2021-02-21 13:00:08', NULL),
(3, 5, 2, 2, 'Maxpro 20mg', 'maxpro-20mg', 'fasdfsaf', 'dfasdff', 10, 30.00, 'Description', NULL, 'Pending', NULL, '2021-01-15 09:06:38', '2021-01-15 09:06:38', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_sale`
--

CREATE TABLE `product_sale` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sale_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `sales_price` decimal(8,2) DEFAULT NULL,
  `total_amount` decimal(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_sale`
--

INSERT INTO `product_sale` (`id`, `sale_id`, `product_id`, `quantity`, `sales_price`, `total_amount`, `created_at`, `updated_at`) VALUES
(9, 3, 1, 12, '35.00', '420.00', NULL, NULL),
(10, 3, 2, 15, '30.00', '450.00', NULL, NULL),
(11, 3, 3, 20, '30.00', '600.00', NULL, NULL),
(12, 4, 1, 10, '35.00', '350.00', NULL, NULL),
(13, 4, 2, 15, '30.00', '450.00', NULL, NULL),
(14, 4, 3, 20, '30.00', '600.00', NULL, NULL),
(15, 5, 1, 10, '35.00', '350.00', NULL, NULL),
(16, 5, 2, 15, '30.00', '450.00', NULL, NULL),
(17, 5, 3, 20, '30.00', '600.00', NULL, NULL),
(18, 6, 1, 10, '35.00', '350.00', NULL, NULL),
(19, 6, 2, 15, '30.00', '450.00', NULL, NULL),
(20, 6, 3, 20, '30.00', '600.00', NULL, NULL),
(21, 7, 1, 10, '35.00', '350.00', NULL, NULL),
(22, 7, 2, 15, '30.00', '450.00', NULL, NULL),
(23, 7, 3, 20, '30.00', '600.00', NULL, NULL),
(24, 8, 1, 10, '35.00', '350.00', NULL, NULL),
(25, 8, 2, 15, '30.00', '450.00', NULL, NULL),
(26, 8, 3, 20, '30.00', '600.00', NULL, NULL),
(27, 9, 1, 10, '35.00', '350.00', NULL, NULL),
(28, 9, 2, 15, '30.00', '450.00', NULL, NULL),
(29, 9, 3, 20, '30.00', '600.00', NULL, NULL),
(30, 10, 1, 10, '35.00', '350.00', NULL, NULL),
(31, 10, 2, 15, '30.00', '450.00', NULL, NULL),
(32, 10, 3, 20, '30.00', '600.00', NULL, NULL),
(33, 11, 1, 10, '35.00', '350.00', NULL, NULL),
(34, 11, 2, 15, '30.00', '450.00', NULL, NULL),
(35, 11, 3, 20, '30.00', '600.00', NULL, NULL),
(36, 12, 1, 10, '35.00', '350.00', NULL, NULL),
(37, 12, 2, 15, '30.00', '450.00', NULL, NULL),
(38, 12, 3, 20, '30.00', '600.00', NULL, NULL),
(39, 13, 1, 10, '35.00', '350.00', NULL, NULL),
(40, 13, 2, 15, '30.00', '450.00', NULL, NULL),
(41, 13, 3, 20, '30.00', '600.00', NULL, NULL),
(42, 14, 1, 10, '35.00', '350.00', NULL, NULL),
(43, 14, 2, 15, '30.00', '450.00', NULL, NULL),
(44, 14, 3, 20, '30.00', '600.00', NULL, NULL),
(45, 15, 1, 10, '35.00', '350.00', NULL, NULL),
(46, 15, 2, 15, '30.00', '450.00', NULL, NULL),
(47, 15, 3, 20, '30.00', '600.00', NULL, NULL),
(48, 16, 1, 10, '35.00', '350.00', NULL, NULL),
(49, 16, 2, 15, '30.00', '450.00', NULL, NULL),
(50, 16, 3, 20, '30.00', '600.00', NULL, NULL),
(51, 17, 1, 10, '35.00', '350.00', NULL, NULL),
(52, 17, 2, 15, '30.00', '450.00', NULL, NULL),
(53, 17, 3, 20, '30.00', '600.00', NULL, NULL),
(54, 18, 1, 10, '35.00', '350.00', NULL, NULL),
(55, 18, 2, 15, '30.00', '450.00', NULL, NULL),
(56, 18, 3, 20, '30.00', '600.00', NULL, NULL),
(57, 19, 1, 10, '35.00', '350.00', NULL, NULL),
(58, 19, 2, 15, '30.00', '450.00', NULL, NULL),
(59, 19, 3, 20, '30.00', '600.00', NULL, NULL),
(60, 20, 1, 10, '35.00', '350.00', NULL, NULL),
(61, 20, 2, 15, '30.00', '450.00', NULL, NULL),
(62, 20, 3, 20, '30.00', '600.00', NULL, NULL),
(63, 21, 1, 10, '35.00', '350.00', NULL, NULL),
(64, 21, 2, 15, '30.00', '450.00', NULL, NULL),
(65, 21, 3, 20, '30.00', '600.00', NULL, NULL),
(66, 22, 1, 10, '35.00', '350.00', NULL, NULL),
(67, 22, 2, 15, '30.00', '450.00', NULL, NULL),
(68, 22, 3, 20, '30.00', '600.00', NULL, NULL),
(69, 23, 1, 10, '35.00', '350.00', NULL, NULL),
(70, 23, 2, 15, '30.00', '450.00', NULL, NULL),
(71, 23, 3, 20, '30.00', '600.00', NULL, NULL),
(72, 24, 1, 10, '35.00', '350.00', NULL, NULL),
(73, 24, 2, 15, '30.00', '450.00', NULL, NULL),
(74, 24, 3, 20, '30.00', '600.00', NULL, NULL),
(75, 25, 1, 10, '35.00', '350.00', NULL, NULL),
(76, 25, 2, 15, '30.00', '450.00', NULL, NULL),
(77, 25, 3, 20, '30.00', '600.00', NULL, NULL),
(78, 26, 1, 10, '35.00', '350.00', NULL, NULL),
(79, 26, 2, 15, '30.00', '450.00', NULL, NULL),
(80, 26, 3, 20, '30.00', '600.00', NULL, NULL),
(81, 27, 1, 10, '35.00', '350.00', NULL, NULL),
(82, 27, 2, 15, '30.00', '450.00', NULL, NULL),
(83, 27, 3, 20, '30.00', '600.00', NULL, NULL),
(84, 28, 1, 10, '35.00', '350.00', NULL, NULL),
(85, 28, 2, 15, '30.00', '450.00', NULL, NULL),
(86, 28, 3, 20, '30.00', '600.00', NULL, NULL),
(87, 29, 1, 10, '35.00', '350.00', NULL, NULL),
(88, 29, 2, 15, '30.00', '450.00', NULL, NULL),
(89, 29, 3, 20, '30.00', '600.00', NULL, NULL),
(90, 30, 1, 10, '35.00', '350.00', NULL, NULL),
(91, 30, 2, 15, '30.00', '450.00', NULL, NULL),
(92, 30, 3, 20, '30.00', '600.00', NULL, NULL),
(93, 31, 1, 10, '35.00', '350.00', NULL, NULL),
(94, 31, 2, 15, '30.00', '450.00', NULL, NULL),
(95, 31, 3, 20, '30.00', '600.00', NULL, NULL),
(96, 32, 1, 10, '35.00', '350.00', NULL, NULL),
(97, 32, 2, 15, '30.00', '450.00', NULL, NULL),
(98, 32, 3, 20, '30.00', '600.00', NULL, NULL),
(99, 33, 1, 10, '35.00', '350.00', NULL, NULL),
(100, 33, 2, 15, '30.00', '450.00', NULL, NULL),
(101, 33, 3, 20, '30.00', '600.00', NULL, NULL),
(102, 34, 1, 10, '35.00', '350.00', NULL, NULL),
(103, 34, 2, 15, '30.00', '450.00', NULL, NULL),
(104, 34, 3, 20, '30.00', '600.00', NULL, NULL),
(105, 35, 1, 10, '35.00', '350.00', NULL, NULL),
(106, 35, 2, 15, '30.00', '450.00', NULL, NULL),
(107, 35, 3, 20, '30.00', '600.00', NULL, NULL),
(108, 36, 1, 10, '35.00', '350.00', NULL, NULL),
(109, 36, 2, 15, '30.00', '450.00', NULL, NULL),
(110, 36, 3, 20, '30.00', '600.00', NULL, NULL),
(111, 37, 1, 10, '35.00', '350.00', NULL, NULL),
(112, 37, 2, 15, '30.00', '450.00', NULL, NULL),
(113, 37, 3, 20, '30.00', '600.00', NULL, NULL),
(114, 38, 1, 10, '35.00', '350.00', NULL, NULL),
(115, 38, 2, 15, '30.00', '450.00', NULL, NULL),
(116, 38, 3, 20, '30.00', '600.00', NULL, NULL),
(117, 39, 1, 10, '35.00', '350.00', NULL, NULL),
(118, 39, 2, 15, '30.00', '450.00', NULL, NULL),
(119, 39, 3, 20, '30.00', '600.00', NULL, NULL),
(120, 40, 1, 10, '35.00', '350.00', NULL, NULL),
(121, 40, 2, 15, '30.00', '450.00', NULL, NULL),
(122, 40, 3, 20, '30.00', '600.00', NULL, NULL),
(123, 41, 1, 10, '35.00', '350.00', NULL, NULL),
(124, 41, 2, 15, '30.00', '450.00', NULL, NULL),
(125, 41, 3, 20, '30.00', '600.00', NULL, NULL),
(126, 42, 1, 10, '35.00', '350.00', NULL, NULL),
(127, 42, 2, 15, '30.00', '450.00', NULL, NULL),
(128, 42, 3, 20, '30.00', '600.00', NULL, NULL),
(129, 43, 1, 10, '35.00', '350.00', NULL, NULL),
(130, 43, 2, 15, '30.00', '450.00', NULL, NULL),
(131, 43, 3, 20, '30.00', '600.00', NULL, NULL),
(132, 44, 1, 10, '35.00', '350.00', NULL, NULL),
(133, 44, 2, 15, '30.00', '450.00', NULL, NULL),
(134, 44, 3, 20, '30.00', '600.00', NULL, NULL),
(135, 45, 1, 10, '35.00', '350.00', NULL, NULL),
(136, 45, 2, 15, '30.00', '450.00', NULL, NULL),
(137, 45, 3, 20, '30.00', '600.00', NULL, NULL),
(138, 46, 1, 10, '35.00', '350.00', NULL, NULL),
(139, 46, 2, 15, '30.00', '450.00', NULL, NULL),
(140, 46, 3, 20, '30.00', '600.00', NULL, NULL),
(141, 47, 1, 10, '35.00', '350.00', NULL, NULL),
(142, 47, 2, 15, '30.00', '450.00', NULL, NULL),
(143, 47, 3, 20, '30.00', '600.00', NULL, NULL),
(144, 48, 1, 10, '35.00', '350.00', NULL, NULL),
(145, 48, 2, 15, '30.00', '450.00', NULL, NULL),
(146, 48, 3, 20, '30.00', '600.00', NULL, NULL),
(147, 49, 1, 10, '35.00', '350.00', NULL, NULL),
(148, 49, 2, 15, '30.00', '450.00', NULL, NULL),
(149, 49, 3, 20, '30.00', '600.00', NULL, NULL),
(150, 50, 1, 10, '35.00', '350.00', NULL, NULL),
(151, 50, 2, 15, '30.00', '450.00', NULL, NULL),
(152, 50, 3, 20, '30.00', '600.00', NULL, NULL),
(153, 51, 1, 10, '35.00', '350.00', NULL, NULL),
(154, 51, 2, 15, '30.00', '450.00', NULL, NULL),
(155, 51, 3, 20, '30.00', '600.00', NULL, NULL),
(156, 52, 1, 10, '35.00', '350.00', NULL, NULL),
(157, 52, 2, 15, '30.00', '450.00', NULL, NULL),
(158, 52, 3, 20, '30.00', '600.00', NULL, NULL),
(159, 53, 1, 10, '35.00', '350.00', NULL, NULL),
(160, 53, 2, 15, '30.00', '450.00', NULL, NULL),
(161, 53, 3, 20, '30.00', '600.00', NULL, NULL),
(162, 54, 1, 10, '35.00', '350.00', NULL, NULL),
(163, 54, 2, 15, '30.00', '450.00', NULL, NULL),
(164, 54, 3, 20, '30.00', '600.00', NULL, NULL),
(165, 55, 1, 10, '35.00', '350.00', NULL, NULL),
(166, 55, 2, 15, '30.00', '450.00', NULL, NULL),
(167, 55, 3, 20, '30.00', '600.00', NULL, NULL),
(168, 56, 1, 10, '35.00', '350.00', NULL, NULL),
(169, 56, 2, 15, '30.00', '450.00', NULL, NULL),
(170, 56, 3, 20, '30.00', '600.00', NULL, NULL),
(171, 57, 1, 10, '35.00', '350.00', NULL, NULL),
(172, 57, 2, 15, '30.00', '450.00', NULL, NULL),
(173, 57, 3, 20, '30.00', '600.00', NULL, NULL),
(174, 58, 1, 10, '35.00', '350.00', NULL, NULL),
(175, 58, 2, 15, '30.00', '450.00', NULL, NULL),
(176, 58, 3, 20, '30.00', '600.00', NULL, NULL),
(177, 59, 1, 10, '35.00', '350.00', NULL, NULL),
(178, 59, 2, 15, '30.00', '450.00', NULL, NULL),
(179, 59, 3, 20, '30.00', '600.00', NULL, NULL),
(180, 60, 1, 10, '35.00', '350.00', NULL, NULL),
(181, 60, 2, 15, '30.00', '450.00', NULL, NULL),
(182, 60, 3, 20, '30.00', '600.00', NULL, NULL),
(183, 61, 1, 10, '35.00', '350.00', NULL, NULL),
(184, 61, 2, 15, '30.00', '450.00', NULL, NULL),
(185, 61, 3, 20, '30.00', '600.00', NULL, NULL),
(186, 62, 1, 10, '35.00', '350.00', NULL, NULL),
(187, 62, 2, 15, '30.00', '450.00', NULL, NULL),
(188, 62, 3, 20, '30.00', '600.00', NULL, NULL),
(189, 63, 1, 10, '35.00', '350.00', NULL, NULL),
(190, 63, 2, 15, '30.00', '450.00', NULL, NULL),
(191, 63, 3, 20, '30.00', '600.00', NULL, NULL),
(192, 64, 1, 10, '35.00', '350.00', NULL, NULL),
(193, 64, 2, 15, '30.00', '450.00', NULL, NULL),
(194, 64, 3, 20, '30.00', '600.00', NULL, NULL),
(195, 65, 1, 12, '35.00', '420.00', NULL, NULL),
(196, 65, 2, 15, '30.00', '450.00', NULL, NULL),
(197, 65, 3, 18, '30.00', '540.00', NULL, NULL),
(198, 66, 1, 12, '35.00', '420.00', NULL, NULL),
(199, 66, 2, 15, '30.00', '450.00', NULL, NULL),
(200, 66, 3, 18, '30.00', '540.00', NULL, NULL),
(201, 67, 1, 10, '35.00', '350.00', NULL, NULL),
(202, 67, 2, 12, '30.00', '360.00', NULL, NULL),
(203, 68, 1, 10, '35.00', '350.00', NULL, NULL),
(204, 68, 2, 12, '30.00', '360.00', NULL, NULL),
(205, 69, 1, 10, '35.00', '350.00', NULL, NULL),
(206, 69, 2, 12, '30.00', '360.00', NULL, NULL),
(207, 70, 1, 10, '35.00', '350.00', NULL, NULL),
(208, 70, 2, 12, '30.00', '360.00', NULL, NULL),
(209, 71, 1, 10, '35.00', '350.00', NULL, NULL),
(210, 71, 2, 15, '30.00', '450.00', NULL, NULL),
(211, 72, 1, 10, '35.00', '350.00', NULL, NULL),
(212, 72, 2, 15, '30.00', '450.00', NULL, NULL),
(213, 73, 1, 10, '35.00', '350.00', NULL, NULL),
(214, 73, 3, 15, '30.00', '450.00', NULL, NULL),
(215, 74, 1, 10, '35.00', '350.00', NULL, NULL),
(216, 74, 3, 15, '30.00', '450.00', NULL, NULL),
(217, 75, 1, 10, '35.00', '350.00', NULL, NULL),
(218, 75, 3, 15, '30.00', '450.00', NULL, NULL),
(219, 76, 1, 20, '35.00', '700.00', NULL, NULL),
(220, 76, 3, 15, '30.00', '450.00', NULL, NULL),
(221, 77, 1, 20, '35.00', '700.00', NULL, NULL),
(222, 77, 3, 15, '30.00', '450.00', NULL, NULL),
(223, 78, 1, 20, '35.00', '700.00', NULL, NULL),
(224, 78, 3, 15, '30.00', '450.00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `supplier_id` bigint(20) UNSIGNED NOT NULL,
  `transaction_type` enum('Cash','Due','Cheque') COLLATE utf8_unicode_ci NOT NULL,
  `unit` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `total_quantity` int(11) NOT NULL,
  `total_amount` double(8,2) NOT NULL,
  `unit_price` double(8,2) NOT NULL,
  `paid_amount` double(8,2) DEFAULT NULL,
  `due_amount` double(8,2) DEFAULT NULL,
  `due_paid_date` date DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `purchase_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `user_id`, `product_id`, `supplier_id`, `transaction_type`, `unit`, `total_quantity`, `total_amount`, `unit_price`, `paid_amount`, `due_amount`, `due_paid_date`, `description`, `purchase_date`, `created_at`, `updated_at`) VALUES
(1, 5, 2, 1, 'Cash', 'Pieces', 200, 6000.00, 30.00, 6000.00, 0.00, '2021-01-01', 'fdsfsdfs', '2021-02-18', '2021-02-21 13:00:08', '2021-02-21 13:00:08');

-- --------------------------------------------------------

--
-- Table structure for table `receipts`
--

CREATE TABLE `receipts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `receipt_title` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `receipts`
--

INSERT INTO `receipts` (`id`, `customer_id`, `receipt_title`, `amount`, `created_at`, `updated_at`) VALUES
(1, 1, 'Loan Paid', '300.00', '2021-02-19 15:52:55', '2021-02-19 15:54:59');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `sales_type` enum('Cash','Cheque','Due','Mobile Banking') COLLATE utf8_unicode_ci NOT NULL,
  `gross_amount` decimal(8,2) NOT NULL,
  `discount_amount` decimal(8,2) DEFAULT '0.00',
  `net_amount` decimal(8,2) NOT NULL,
  `paid_amount` decimal(8,2) DEFAULT '0.00',
  `due_amount` decimal(8,2) DEFAULT '0.00',
  `pay_back_date` date DEFAULT NULL,
  `transaction_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `user_id`, `customer_id`, `sales_type`, `gross_amount`, `discount_amount`, `net_amount`, `paid_amount`, `due_amount`, `pay_back_date`, `transaction_id`, `note`, `created_at`, `updated_at`) VALUES
(3, 5, 1, 'Due', '1470.00', '100.00', '1370.00', '1100.00', '270.00', NULL, NULL, NULL, '2021-02-07 03:39:59', '2021-02-07 04:00:55'),
(4, 5, 1, 'Due', '1400.00', '100.00', '1300.00', '1000.00', '300.00', '2021-02-20', NULL, NULL, '2021-02-12 17:45:45', '2021-02-12 17:45:45'),
(5, 5, 1, 'Due', '1400.00', '100.00', '1300.00', '1000.00', '300.00', '2021-02-20', NULL, NULL, '2021-02-12 17:46:03', '2021-02-12 17:46:03'),
(6, 5, 1, 'Due', '1400.00', '100.00', '1300.00', '1000.00', '300.00', '2021-02-20', NULL, NULL, '2021-02-12 17:46:09', '2021-02-12 17:46:09'),
(7, 5, 1, 'Due', '1400.00', '100.00', '1300.00', '1000.00', '300.00', '2021-02-20', NULL, NULL, '2021-02-12 17:46:31', '2021-02-12 17:46:31'),
(8, 5, 1, 'Due', '1400.00', '100.00', '1300.00', '1000.00', '300.00', '2021-02-20', NULL, NULL, '2021-02-12 17:49:37', '2021-02-12 17:49:37'),
(9, 5, 1, 'Due', '1400.00', '100.00', '1300.00', '1000.00', '300.00', '2021-02-20', NULL, NULL, '2021-02-12 17:50:42', '2021-02-12 17:50:42'),
(10, 5, 1, 'Due', '1400.00', '100.00', '1300.00', '1000.00', '300.00', '2021-02-20', NULL, NULL, '2021-02-12 17:52:41', '2021-02-12 17:52:41'),
(11, 5, 1, 'Due', '1400.00', '100.00', '1300.00', '1000.00', '300.00', '2021-02-20', NULL, NULL, '2021-02-12 17:53:11', '2021-02-12 17:53:11'),
(12, 5, 1, 'Due', '1400.00', '100.00', '1300.00', '1000.00', '300.00', '2021-02-20', NULL, NULL, '2021-02-12 17:54:31', '2021-02-12 17:54:31'),
(13, 5, 1, 'Due', '1400.00', '100.00', '1300.00', '1000.00', '300.00', '2021-02-20', NULL, NULL, '2021-02-12 17:55:09', '2021-02-12 17:55:09'),
(14, 5, 1, 'Due', '1400.00', '100.00', '1300.00', '1000.00', '300.00', '2021-02-20', NULL, NULL, '2021-02-12 17:58:12', '2021-02-12 17:58:12'),
(15, 5, 1, 'Due', '1400.00', '100.00', '1300.00', '1000.00', '300.00', '2021-02-20', NULL, NULL, '2021-02-12 18:00:32', '2021-02-12 18:00:32'),
(16, 5, 1, 'Due', '1400.00', '100.00', '1300.00', '1000.00', '300.00', '2021-02-20', NULL, NULL, '2021-02-12 18:03:54', '2021-02-12 18:03:54'),
(17, 5, 1, 'Due', '1400.00', '100.00', '1300.00', '1000.00', '300.00', '2021-02-20', NULL, NULL, '2021-02-12 18:04:45', '2021-02-12 18:04:45'),
(18, 5, 1, 'Due', '1400.00', '100.00', '1300.00', '1000.00', '300.00', '2021-02-20', NULL, NULL, '2021-02-12 18:06:07', '2021-02-12 18:06:07'),
(19, 5, 1, 'Due', '1400.00', '100.00', '1300.00', '1000.00', '300.00', '2021-02-20', NULL, NULL, '2021-02-12 18:06:31', '2021-02-12 18:06:31'),
(20, 5, 1, 'Due', '1400.00', '100.00', '1300.00', '1000.00', '300.00', '2021-02-20', NULL, NULL, '2021-02-12 18:07:12', '2021-02-12 18:07:12'),
(21, 5, 1, 'Due', '1400.00', '100.00', '1300.00', '1000.00', '300.00', '2021-02-20', NULL, NULL, '2021-02-12 18:09:20', '2021-02-12 18:09:20'),
(22, 5, 1, 'Due', '1400.00', '100.00', '1300.00', '1000.00', '300.00', '2021-02-20', NULL, NULL, '2021-02-12 18:09:24', '2021-02-12 18:09:24'),
(23, 5, 1, 'Due', '1400.00', '100.00', '1300.00', '1000.00', '300.00', '2021-02-20', NULL, NULL, '2021-02-12 18:10:14', '2021-02-12 18:10:14'),
(24, 5, 1, 'Due', '1400.00', '100.00', '1300.00', '1000.00', '300.00', '2021-02-20', NULL, NULL, '2021-02-12 18:11:23', '2021-02-12 18:11:23'),
(25, 5, 1, 'Due', '1400.00', '100.00', '1300.00', '1000.00', '300.00', '2021-02-20', NULL, NULL, '2021-02-12 18:12:07', '2021-02-12 18:12:07'),
(26, 5, 1, 'Due', '1400.00', '100.00', '1300.00', '1000.00', '300.00', '2021-02-20', NULL, NULL, '2021-02-12 18:13:05', '2021-02-12 18:13:05'),
(27, 5, 1, 'Due', '1400.00', '100.00', '1300.00', '1000.00', '300.00', '2021-02-20', NULL, NULL, '2021-02-12 18:13:49', '2021-02-12 18:13:49'),
(28, 5, 1, 'Due', '1400.00', '100.00', '1300.00', '1000.00', '300.00', '2021-02-20', NULL, NULL, '2021-02-12 18:14:02', '2021-02-12 18:14:02'),
(29, 5, 1, 'Due', '1400.00', '100.00', '1300.00', '1000.00', '300.00', '2021-02-20', NULL, NULL, '2021-02-12 18:16:32', '2021-02-12 18:16:32'),
(30, 5, 1, 'Due', '1400.00', '100.00', '1300.00', '1000.00', '300.00', '2021-02-20', NULL, NULL, '2021-02-12 18:17:12', '2021-02-12 18:17:12'),
(31, 5, 1, 'Due', '1400.00', '100.00', '1300.00', '1000.00', '300.00', '2021-02-20', NULL, NULL, '2021-02-12 18:17:46', '2021-02-12 18:17:46'),
(32, 5, 1, 'Due', '1400.00', '100.00', '1300.00', '1000.00', '300.00', '2021-02-20', NULL, NULL, '2021-02-12 18:17:52', '2021-02-12 18:17:52'),
(33, 5, 1, 'Due', '1400.00', '100.00', '1300.00', '1000.00', '300.00', '2021-02-20', NULL, NULL, '2021-02-12 18:17:54', '2021-02-12 18:17:54'),
(34, 5, 1, 'Due', '1400.00', '100.00', '1300.00', '1000.00', '300.00', '2021-02-20', NULL, NULL, '2021-02-12 18:18:25', '2021-02-12 18:18:25'),
(35, 5, 1, 'Due', '1400.00', '100.00', '1300.00', '1000.00', '300.00', '2021-02-20', NULL, NULL, '2021-02-12 18:19:03', '2021-02-12 18:19:03'),
(36, 5, 1, 'Due', '1400.00', '100.00', '1300.00', '1000.00', '300.00', '2021-02-20', NULL, NULL, '2021-02-12 18:22:23', '2021-02-12 18:22:23'),
(37, 5, 1, 'Due', '1400.00', '100.00', '1300.00', '1000.00', '300.00', '2021-02-20', NULL, NULL, '2021-02-12 18:23:07', '2021-02-12 18:23:07'),
(38, 5, 1, 'Due', '1400.00', '100.00', '1300.00', '1000.00', '300.00', '2021-02-20', NULL, NULL, '2021-02-12 18:24:54', '2021-02-12 18:24:54'),
(39, 5, 1, 'Due', '1400.00', '100.00', '1300.00', '1000.00', '300.00', '2021-02-20', NULL, NULL, '2021-02-12 18:25:01', '2021-02-12 18:25:01'),
(40, 5, 1, 'Due', '1400.00', '100.00', '1300.00', '1000.00', '300.00', '2021-02-20', NULL, NULL, '2021-02-12 18:25:44', '2021-02-12 18:25:44'),
(41, 5, 1, 'Due', '1400.00', '100.00', '1300.00', '1000.00', '300.00', '2021-02-20', NULL, NULL, '2021-02-12 18:25:54', '2021-02-12 18:25:54'),
(42, 5, 1, 'Due', '1400.00', '100.00', '1300.00', '1000.00', '300.00', '2021-02-20', NULL, NULL, '2021-02-12 18:25:59', '2021-02-12 18:25:59'),
(43, 5, 1, 'Due', '1400.00', '100.00', '1300.00', '1000.00', '300.00', '2021-02-20', NULL, NULL, '2021-02-12 18:26:07', '2021-02-12 18:26:07'),
(44, 5, 1, 'Due', '1400.00', '100.00', '1300.00', '1000.00', '300.00', '2021-02-20', NULL, NULL, '2021-02-12 18:26:19', '2021-02-12 18:26:19'),
(45, 5, 1, 'Due', '1400.00', '100.00', '1300.00', '1000.00', '300.00', '2021-02-20', NULL, NULL, '2021-02-12 18:26:27', '2021-02-12 18:26:27'),
(46, 5, 1, 'Due', '1400.00', '100.00', '1300.00', '1000.00', '300.00', '2021-02-20', NULL, NULL, '2021-02-12 18:26:47', '2021-02-12 18:26:47'),
(47, 5, 1, 'Due', '1400.00', '100.00', '1300.00', '1000.00', '300.00', '2021-02-20', NULL, NULL, '2021-02-12 18:27:24', '2021-02-12 18:27:24'),
(48, 5, 1, 'Due', '1400.00', '100.00', '1300.00', '1000.00', '300.00', '2021-02-20', NULL, NULL, '2021-02-12 18:28:33', '2021-02-12 18:28:33'),
(49, 5, 1, 'Due', '1400.00', '100.00', '1300.00', '1000.00', '300.00', '2021-02-20', NULL, NULL, '2021-02-12 18:28:35', '2021-02-12 18:28:35'),
(50, 5, 1, 'Due', '1400.00', '100.00', '1300.00', '1000.00', '300.00', '2021-02-20', NULL, NULL, '2021-02-12 18:28:38', '2021-02-12 18:28:38'),
(51, 5, 1, 'Due', '1400.00', '100.00', '1300.00', '1000.00', '300.00', '2021-02-20', NULL, NULL, '2021-02-12 18:29:14', '2021-02-12 18:29:14'),
(52, 5, 1, 'Due', '1400.00', '100.00', '1300.00', '1000.00', '300.00', '2021-02-20', NULL, NULL, '2021-02-12 18:29:20', '2021-02-12 18:29:20'),
(53, 5, 1, 'Due', '1400.00', '100.00', '1300.00', '1000.00', '300.00', '2021-02-20', NULL, NULL, '2021-02-12 18:29:37', '2021-02-12 18:29:37'),
(54, 5, 1, 'Due', '1400.00', '100.00', '1300.00', '1000.00', '300.00', '2021-02-20', NULL, NULL, '2021-02-12 18:29:41', '2021-02-12 18:29:41'),
(55, 5, 1, 'Due', '1400.00', '100.00', '1300.00', '1000.00', '300.00', '2021-02-20', NULL, NULL, '2021-02-12 18:29:48', '2021-02-12 18:29:48'),
(56, 5, 1, 'Due', '1400.00', '100.00', '1300.00', '1000.00', '300.00', '2021-02-20', NULL, NULL, '2021-02-12 18:30:05', '2021-02-12 18:30:05'),
(57, 5, 1, 'Due', '1400.00', '100.00', '1300.00', '1000.00', '300.00', '2021-02-20', NULL, NULL, '2021-02-12 18:30:06', '2021-02-12 18:30:06'),
(58, 5, 1, 'Due', '1400.00', '100.00', '1300.00', '1000.00', '300.00', '2021-02-20', NULL, NULL, '2021-02-12 18:30:07', '2021-02-12 18:30:07'),
(59, 5, 1, 'Due', '1400.00', '100.00', '1300.00', '1000.00', '300.00', '2021-02-20', NULL, NULL, '2021-02-12 18:30:07', '2021-02-12 18:30:07'),
(60, 5, 1, 'Due', '1400.00', '100.00', '1300.00', '1000.00', '300.00', '2021-02-20', NULL, NULL, '2021-02-12 18:30:08', '2021-02-12 18:30:08'),
(61, 5, 1, 'Due', '1400.00', '100.00', '1300.00', '1000.00', '300.00', '2021-02-20', NULL, NULL, '2021-02-12 18:30:08', '2021-02-12 18:30:08'),
(62, 5, 1, 'Due', '1400.00', '100.00', '1300.00', '1000.00', '300.00', '2021-02-20', NULL, NULL, '2021-02-12 18:30:08', '2021-02-12 18:30:08'),
(63, 5, 1, 'Due', '1400.00', '100.00', '1300.00', '1000.00', '300.00', '2021-02-20', NULL, NULL, '2021-02-12 18:30:08', '2021-02-12 18:30:08'),
(64, 5, 1, 'Due', '1400.00', '100.00', '1300.00', '1000.00', '300.00', '2021-02-20', NULL, NULL, '2021-02-12 18:32:12', '2021-02-12 18:32:12'),
(65, 5, 2, 'Due', '1410.00', '50.00', '1360.00', '1300.00', '60.00', '2021-02-20', NULL, NULL, '2021-02-13 06:08:24', '2021-02-13 06:08:24'),
(66, 5, 2, 'Due', '1410.00', '50.00', '1360.00', '1300.00', '60.00', '2021-02-20', NULL, NULL, '2021-02-13 06:10:43', '2021-02-13 06:10:43'),
(67, 5, 1, 'Due', '710.00', '100.00', '610.00', '600.00', '10.00', '2021-02-15', NULL, NULL, '2021-02-13 06:48:56', '2021-02-13 06:48:56'),
(68, 5, 1, 'Due', '710.00', '100.00', '610.00', '600.00', '10.00', '2021-02-15', NULL, NULL, '2021-02-13 06:49:24', '2021-02-13 06:49:24'),
(69, 5, 1, 'Due', '710.00', '100.00', '610.00', '600.00', '10.00', '2021-02-15', NULL, NULL, '2021-02-13 06:49:34', '2021-02-13 06:49:34'),
(70, 5, 1, 'Due', '710.00', '60.00', '650.00', '600.00', '50.00', NULL, NULL, NULL, '2021-02-13 06:50:50', '2021-02-13 06:50:50'),
(71, 5, 1, 'Due', '800.00', '50.00', '750.00', '700.00', '50.00', NULL, NULL, NULL, '2021-02-13 06:57:40', '2021-02-13 06:57:40'),
(72, 5, 1, 'Due', '800.00', '50.00', '750.00', '700.00', '50.00', NULL, NULL, NULL, '2021-02-13 06:58:13', '2021-02-13 06:58:13'),
(73, 5, 1, 'Due', '800.00', '30.00', '770.00', '750.00', '20.00', NULL, NULL, NULL, '2021-02-13 07:22:36', '2021-02-13 07:22:36'),
(74, 5, 1, 'Due', '800.00', '30.00', '770.00', '750.00', '20.00', NULL, NULL, NULL, '2021-02-13 07:23:33', '2021-02-13 07:23:33'),
(75, 5, 1, 'Due', '800.00', '30.00', '770.00', '750.00', '20.00', NULL, NULL, NULL, '2021-02-13 07:24:09', '2021-02-13 07:24:09'),
(76, 5, 1, 'Due', '1150.00', '50.00', '1100.00', '1000.00', '100.00', NULL, NULL, NULL, '2021-02-13 07:24:43', '2021-02-13 07:24:43'),
(77, 5, 1, 'Due', '1150.00', '50.00', '1100.00', '1000.00', '100.00', NULL, NULL, NULL, '2021-02-13 07:25:15', '2021-02-13 07:25:15'),
(78, 5, 1, 'Due', '1150.00', '50.00', '1100.00', '1000.00', '100.00', NULL, NULL, NULL, '2021-02-13 07:25:49', '2021-02-13 07:25:49');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'name', 'Sumon Pharmacy', '2021-02-19 16:31:24', '2021-02-19 16:56:49'),
(2, 'logo', 'settings/ukXjywcz0bBYXKfM0zIqlWbrO1613753752eis.jpg', '2021-02-19 16:31:24', '2021-02-19 16:55:52');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `company_name` varchar(70) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(70) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `user_id`, `name`, `company_name`, `email`, `mobile`, `address`, `created_at`, `updated_at`) VALUES
(1, 5, 'Jhon Pharmacy', NULL, 'jhon@mail.com', '+8801516120343', 'fasdfsd', '2021-02-21 12:58:56', '2021-02-21 12:58:56');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(140) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(170) COLLATE utf8_unicode_ci NOT NULL,
  `profile_pic` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `country` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci,
  `user_type` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Admin, Employee',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `last_login_ip` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `name`, `username`, `email`, `mobile`, `password`, `profile_pic`, `gender`, `birthdate`, `country`, `city`, `address`, `user_type`, `email_verified_at`, `last_login_ip`, `remember_token`, `created_at`, `updated_at`) VALUES
(3, 'Mohammad', 'Sumon', 'Mohammad Sumon', 'sumonsssbgc', 'sumon@gmail.com', '01516120344', '$2y$10$iGWhN4IGPzR0DtZCPgF/peukkR6wNCUrV6QeUacVTrX61MErG4mgq', NULL, 'male', '2010-12-02', 'Bangladesh', 'Chattogram', 'Agrabad Chowmuhoni\r\nCorporation Staff Quarter, East Madarbari, Chattogram', 'employee', NULL, NULL, NULL, '2020-12-21 11:07:19', '2020-12-25 23:47:08'),
(5, 'Mohammad', 'Sumon', 'Mohammad Sumon', 'sumonssbgc', 'sumonsbgc@gmail.com', '015161203', '$2y$10$kTgfVLpLZvfGy6NW9o.iU.EeG3rU/6e2qEEb6NZnvSG3dyJtvtXay', NULL, '', '2020-12-22', '', '', '', 'admin', NULL, NULL, 'TczU6OWc3GAr6AHG8u3w1Zju7dWRq9IVIsZvoYlhH0THbrZXzcy5B3NPnRpY', '2020-12-21 12:58:23', '2020-12-21 12:58:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `attributes_name_unique` (`name`),
  ADD UNIQUE KEY `attributes_slug_unique` (`slug`);

--
-- Indexes for table `attribute_values`
--
ALTER TABLE `attribute_values`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attribute_values_attribute_id_foreign` (`attribute_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_unique` (`name`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`),
  ADD KEY `categories_user_id_foreign` (`user_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customers` (`user_id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `expenses_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoices_sale_id_foreign` (`sale_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_name_unique` (`name`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD KEY `products_user_id_foreign` (`user_id`),
  ADD KEY `products_brand_id_foreign` (`brand_id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `product_sale`
--
ALTER TABLE `product_sale`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_sale_sale_id_foreign` (`sale_id`),
  ADD KEY `product_sale_product_id_foreign` (`product_id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchases_user_id_foreign` (`user_id`),
  ADD KEY `purchases_product_id_foreign` (`product_id`),
  ADD KEY `purchases_supplier_id_foreign` (`supplier_id`);

--
-- Indexes for table `receipts`
--
ALTER TABLE `receipts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `receipts_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sales_user_id_foreign` (`user_id`),
  ADD KEY `sales_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `key` (`key`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `suppliers_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_mobile_unique` (`mobile`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `attribute_values`
--
ALTER TABLE `attribute_values`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_sale`
--
ALTER TABLE `product_sale`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=225;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `receipts`
--
ALTER TABLE `receipts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attribute_values`
--
ALTER TABLE `attribute_values`
  ADD CONSTRAINT `attribute_values_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`);

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `expenses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_sale_id_foreign` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`),
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `products_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `product_sale`
--
ALTER TABLE `product_sale`
  ADD CONSTRAINT `product_sale_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `product_sale_sale_id_foreign` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`);

--
-- Constraints for table `purchases`
--
ALTER TABLE `purchases`
  ADD CONSTRAINT `purchases_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `purchases_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`),
  ADD CONSTRAINT `purchases_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `receipts`
--
ALTER TABLE `receipts`
  ADD CONSTRAINT `receipts_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`);

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `sales_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD CONSTRAINT `suppliers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
