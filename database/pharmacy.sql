-- phpMyAdmin SQL Dump
-- version 5.0.4deb2~bpo10+1+bionic1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 07, 2021 at 05:48 PM
-- Server version: 5.7.33-0ubuntu0.18.04.1
-- PHP Version: 7.4.16

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
(1, 5, 2, 2, 'Zmax 500mg', 'zmax-500mg', 'fasdfsaf', 'dfasdff', 270, 35.00, 'Description', NULL, 'Pending', '2023-02-20 18:00:00', '2021-01-15 08:56:54', '2021-03-07 16:25:48', NULL),
(2, 5, 2, 1, 'Seclo 20mg', 'seclo-20mg', 'fasdfsaf', 'dfasdff', 295, 30.00, 'Description', NULL, 'Pending', NULL, '2021-01-15 09:06:38', '2021-03-07 09:28:45', NULL),
(3, 5, 2, 2, 'Maxpro 20mg', 'maxpro-20mg', 'fasdfsaf', 'dfasdff', 690, 30.00, 'Description', NULL, 'Pending', NULL, '2021-01-15 09:06:38', '2021-03-07 16:25:48', NULL);

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
(49, 32, 1, 20, '35.00', '700.00', '2021-03-07 09:28:45', '2021-03-07 09:28:45'),
(50, 32, 2, 15, '30.00', '450.00', '2021-03-07 09:28:45', '2021-03-07 09:28:45'),
(51, 33, 1, 20, '35.00', '700.00', '2021-03-07 16:25:48', '2021-03-07 16:25:48'),
(52, 33, 3, 20, '30.00', '600.00', '2021-03-07 16:25:48', '2021-03-07 16:25:48');

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
(1, 5, 1, 1, 'Cash', 'Pieces', 310, 6000.00, 30.00, 6000.00, 0.00, '2021-01-01', 'fdsfsdfs', '2021-02-18', '2021-02-21 13:00:08', '2021-02-21 13:00:08'),
(2, 5, 2, 1, 'Cash', 'Pieces', 110, 3000.00, 20.00, 3000.00, 0.00, '2021-01-01', NULL, '2021-03-03', '2021-03-03 11:18:44', '2021-03-03 11:18:44'),
(3, 5, 2, 1, 'Cash', 'Pieces', 200, 2000.00, 20.00, 2000.00, NULL, '2021-03-03', NULL, '2021-03-02', '2021-03-03 11:20:54', '2021-03-03 11:20:54'),
(4, 5, 3, 1, 'Cash', 'Pieces', 310, 2000.00, 20.00, 2000.00, NULL, '2021-03-03', NULL, '2021-03-02', '2021-03-03 11:20:54', '2021-03-03 11:20:54'),
(5, 5, 3, 2, 'Due', NULL, 400, 8000.00, 20.00, 0.00, 8000.00, '2021-03-30', NULL, '2021-03-07', '2021-03-07 11:44:03', '2021-03-07 11:44:03');

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
(32, 5, 1, 'Cash', '1150.00', '50.00', '1100.00', '1100.00', NULL, NULL, NULL, NULL, '2021-03-07 09:28:45', '2021-03-07 09:28:45'),
(33, 5, 5, 'Cash', '1300.00', '50.00', '1250.00', '1250.00', NULL, NULL, NULL, NULL, '2021-03-07 16:25:48', '2021-03-07 16:25:48');

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
(1, 5, 'Jhon Pharmacy', NULL, 'jhon@mail.com', '+8801516120343', 'fasdfsd', '2021-02-21 12:58:56', '2021-02-21 12:58:56'),
(2, 5, 'Kanak Pharmacy', NULL, 'kanak@gmail.com', '1122432232323', NULL, '2021-03-07 11:41:56', '2021-03-07 11:41:56');

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
  ADD KEY `sales_customer_id_foreign` (`customer_id`),
  ADD KEY `sales_user_id_foreign` (`user_id`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `receipts`
--
ALTER TABLE `receipts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
