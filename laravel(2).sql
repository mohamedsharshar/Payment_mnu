-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2025 at 01:15 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `billamounts`
--

CREATE TABLE `billamounts` (
  `ID` bigint(20) NOT NULL,
  `ItemSequence` int(11) NOT NULL,
  `BillNumber` varchar(90) NOT NULL,
  `Amount` decimal(18,2) NOT NULL,
  `SettlementAccountCode` varchar(500) NOT NULL,
  `AmountDescription` varchar(500) NOT NULL,
  `Currency` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `ID` int(90) NOT NULL,
  `ServiceType_ID` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `DueDate` timestamp NULL DEFAULT current_timestamp(),
  `BillStatus` int(11) NOT NULL DEFAULT 1,
  `CustomerCode` varchar(14) DEFAULT NULL,
  `BusinessDate` date DEFAULT NULL,
  `SettlementDate` date DEFAULT NULL,
  `CreatedIn` timestamp NULL DEFAULT NULL,
  `archive` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`ID`, `ServiceType_ID`, `updated_at`, `created_at`, `DueDate`, `BillStatus`, `CustomerCode`, `BusinessDate`, `SettlementDate`, `CreatedIn`, `archive`) VALUES
(40, 2, '2025-02-02 12:49:22', '2025-01-23 10:49:30', '2025-01-23 12:49:30', 1, '29010151700408', NULL, NULL, NULL, NULL),
(44, 2, '2025-02-02 10:16:25', '2025-02-02 10:16:25', '2025-02-02 12:16:25', 1, NULL, NULL, NULL, NULL, NULL),
(45, 1, '2025-02-02 10:20:55', '2025-02-02 10:20:55', '2025-02-02 12:20:55', 1, NULL, NULL, NULL, NULL, NULL),
(46, 1, '2025-02-02 10:29:30', '2025-02-02 10:29:30', '2025-02-02 12:29:30', 1, NULL, NULL, NULL, NULL, NULL),
(47, 2, '2025-02-03 11:11:49', '2025-02-03 11:11:49', '2025-02-03 13:11:49', 1, NULL, NULL, NULL, NULL, NULL),
(48, 1, '2025-02-03 11:12:16', '2025-02-03 11:12:16', '2025-02-03 13:12:16', 1, NULL, NULL, NULL, NULL, NULL),
(49, 1, '2025-02-03 11:13:00', '2025-02-03 11:13:00', '2025-02-03 13:13:00', 1, NULL, NULL, NULL, NULL, NULL),
(50, 1, '2025-02-03 11:13:37', '2025-02-03 11:13:37', '2025-02-03 13:13:37', 1, NULL, NULL, NULL, NULL, NULL),
(51, 1, '2025-02-03 11:20:05', '2025-02-03 11:20:05', '2025-02-03 13:20:05', 1, NULL, NULL, NULL, NULL, NULL),
(52, 1, '2025-02-03 11:20:55', '2025-02-03 11:20:55', '2025-02-03 13:20:55', 1, NULL, NULL, NULL, NULL, NULL),
(53, 1, '2025-02-03 11:27:04', '2025-02-03 11:27:04', '2025-02-03 13:27:04', 1, NULL, NULL, NULL, NULL, NULL),
(54, 1, '2025-02-03 11:28:26', '2025-02-03 11:28:26', '2025-02-03 13:28:26', 1, NULL, NULL, NULL, NULL, NULL),
(57, 1, '2025-02-03 11:30:57', '2025-02-03 11:30:57', '2025-02-03 13:30:57', 1, NULL, NULL, NULL, NULL, NULL),
(59, 1, '2025-02-03 11:37:20', '2025-02-03 11:37:20', '2025-02-03 13:37:20', 1, NULL, NULL, NULL, NULL, NULL),
(60, 1, '2025-02-05 11:21:05', '2025-02-05 11:21:05', '2025-02-05 13:21:05', 1, NULL, NULL, NULL, NULL, NULL),
(61, 2, '2025-02-05 11:21:09', '2025-02-05 11:21:09', '2025-02-05 13:21:09', 1, NULL, NULL, NULL, NULL, NULL),
(62, 2, '2025-02-05 11:22:09', '2025-02-05 11:22:09', '2025-02-05 13:22:09', 1, NULL, NULL, NULL, NULL, NULL),
(64, 1, '2025-02-05 11:29:17', '2025-02-05 11:29:17', '2025-02-05 13:29:17', 1, '1234', NULL, NULL, NULL, NULL),
(65, 2, '2025-02-05 11:29:24', '2025-02-05 11:29:24', '2025-02-05 13:29:24', 1, '1234', NULL, NULL, NULL, NULL),
(70, 2, '2025-02-06 06:01:38', '2025-02-06 06:01:38', '2025-02-06 08:01:38', 1, '123456', NULL, NULL, NULL, NULL),
(71, 3, '2025-02-06 06:37:47', '2025-02-06 06:37:47', '2025-02-06 08:37:47', 1, '123456', NULL, NULL, NULL, NULL),
(72, 3, '2025-02-06 06:55:49', '2025-02-06 06:55:49', '2025-02-06 08:55:49', 1, '123456', NULL, NULL, NULL, NULL),
(73, 3, '2025-02-06 07:00:54', '2025-02-06 07:00:54', '2025-02-06 09:00:54', 1, '123456', NULL, NULL, NULL, NULL),
(78, 3, '2025-02-06 08:43:42', '2025-02-06 08:43:42', '2025-02-06 10:43:42', 1, '123', NULL, NULL, NULL, NULL),
(84, 3, '2025-02-08 07:50:21', '2025-02-08 07:50:21', '2025-02-08 09:50:21', 1, '1', NULL, NULL, NULL, NULL),
(85, 3, '2025-02-08 10:23:00', '2025-02-08 10:23:00', '2025-02-08 12:23:00', 1, '11', NULL, NULL, NULL, NULL),
(86, 3, '2025-02-09 10:05:13', '2025-02-09 10:05:13', '2025-02-09 12:05:13', 1, '29015101700438', NULL, NULL, NULL, NULL),
(87, 3, '2025-02-09 10:09:57', '2025-02-09 10:09:57', '2025-02-09 12:09:57', 1, NULL, NULL, NULL, NULL, NULL),
(88, 3, '2025-02-09 10:14:37', '2025-02-09 10:14:37', '2025-02-09 12:14:37', 1, NULL, NULL, NULL, NULL, NULL),
(89, 3, '2025-02-09 10:54:29', '2025-02-09 10:54:29', '2025-02-09 12:54:29', 1, '29015001700403', NULL, NULL, NULL, NULL),
(90, 3, '2025-02-10 12:00:27', '2025-02-10 12:00:27', '2025-02-10 14:00:27', 1, '29010151700428', NULL, NULL, NULL, NULL),
(91, 1, '2025-02-27 07:35:46', '2025-02-27 07:35:46', '2025-02-27 09:35:46', 1, '29010151700428', NULL, NULL, NULL, NULL),
(95, 1, '2025-02-27 09:48:09', '2025-02-27 09:48:09', '2025-02-27 11:48:09', 1, '29010151700408', NULL, NULL, NULL, NULL),
(96, 3, '2025-03-09 10:49:22', '2025-03-09 10:49:22', '2025-03-09 12:49:22', 1, '29010151700488', NULL, NULL, NULL, NULL),
(97, 3, '2025-05-04 07:42:11', '2025-05-04 07:42:11', '2025-05-04 10:42:11', 1, '29010151700485', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `Code` varchar(14) NOT NULL,
  `Name` varchar(500) NOT NULL,
  `Description` varchar(500) DEFAULT NULL,
  `Mobile` varchar(50) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `CreatedIn` timestamp NULL DEFAULT NULL,
  `facultyID` int(11) DEFAULT NULL,
  `UserLevelID` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`Code`, `Name`, `Description`, `Mobile`, `Email`, `CreatedIn`, `facultyID`, `UserLevelID`, `updated_at`, `created_at`) VALUES
('0', 'هاله', NULL, NULL, 'asasdasd@gmail.com', NULL, NULL, NULL, '2025-02-08 11:21:23', '2025-02-08 11:21:23'),
('1', 'هاله', NULL, NULL, 'hala_am86@yahoo.com', NULL, NULL, NULL, '2025-02-05 07:24:55', '2025-02-05 07:24:55'),
('11', 'sharshar', NULL, NULL, 'mmshsh05@gmail.com', NULL, NULL, NULL, '2025-02-08 10:22:41', '2025-02-08 10:22:41'),
('123', 'هاله', NULL, NULL, 'hala_am86@yahoo.com', NULL, NULL, NULL, '2025-02-01 11:10:27', '2025-02-01 11:10:27'),
('1232', 'sharshar', NULL, NULL, 'hala_am86@yahoo.com', NULL, NULL, NULL, '2025-02-08 11:04:49', '2025-02-08 11:04:49'),
('1234', 'هاله', NULL, NULL, 'hala_am86@yahoo.com', NULL, NULL, NULL, '2025-02-05 08:39:42', '2025-02-05 08:39:42'),
('123456', 'هاله', NULL, NULL, 'hala_am86@yahoo.com', NULL, NULL, NULL, '2025-02-06 06:01:22', '2025-02-06 06:01:22'),
('1234567891011', 'هاله', NULL, NULL, 'hala_am86@yahoo.com', NULL, NULL, NULL, '2025-02-01 11:14:44', '2025-02-01 11:14:44'),
('29010151700', 'هاله', NULL, NULL, 'hala_am86@yahoo.com', NULL, NULL, NULL, '2025-02-02 07:44:45', '2025-02-02 07:44:45'),
('29010151700408', 'هاله فؤاد جابر', NULL, NULL, '29010151700408', NULL, NULL, NULL, '2025-02-02 07:45:18', '2025-02-02 07:45:18'),
('29010151700428', 'هاله فؤاد جابر', NULL, NULL, 'hala_am86@yahoo.com', NULL, NULL, NULL, '2025-02-10 12:00:11', '2025-02-10 12:00:11'),
('29010151700459', 'هاله', NULL, NULL, 'hala_am86@yahoo.com', NULL, NULL, NULL, '2025-02-08 11:28:55', '2025-02-08 11:28:55'),
('29010151700485', 'sharshar', NULL, NULL, 'mohamed@yahoo.com', NULL, NULL, NULL, '2025-05-04 07:39:33', '2025-05-04 07:39:33'),
('29010151700488', 'هاله فؤاد جابر', NULL, NULL, 'hala_am86@yahoo.com', NULL, NULL, NULL, '2025-03-09 10:47:50', '2025-03-09 10:47:50'),
('29010151700489', 'محمود فوزى', NULL, NULL, 'hala_am86@yahoo.com', NULL, NULL, NULL, '2025-02-06 09:24:26', '2025-02-06 09:24:26'),
('29015001700403', 'هاله', NULL, NULL, 'hala_am86@yahoo.com', NULL, NULL, NULL, '2025-02-05 11:33:09', '2025-02-05 11:33:09'),
('29015101700438', 'هاله', NULL, NULL, 'hala_am86@yahoo.com', NULL, NULL, NULL, '2025-02-09 10:05:03', '2025-02-09 10:05:03'),
('290151700458', 'هاله فؤاد جابر زقزوق', NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-01 13:08:58', '2025-02-01 13:10:13'),
('5', 'هاله', NULL, NULL, 'hala_am86@yahoo.com', NULL, NULL, NULL, '2025-02-05 11:36:04', '2025-02-05 11:36:04'),
('8', 'شهد', NULL, NULL, 'sahad@yahoo.com', NULL, NULL, NULL, '2025-02-08 07:04:15', '2025-02-08 07:04:15'),
('9', 'محمد', NULL, NULL, 'mohamed@yahoo.com', NULL, NULL, NULL, '2025-02-08 07:09:45', '2025-02-08 07:09:45'),
('s', 'هاله', NULL, NULL, 'hala_am86@yahoo.com', NULL, NULL, NULL, '2025-02-08 11:06:43', '2025-02-08 11:06:43');

-- --------------------------------------------------------

--
-- Table structure for table `ef_payment`
--

CREATE TABLE `ef_payment` (
  `Id` bigint(20) NOT NULL,
  `Billing_Account` varchar(450) NOT NULL,
  `BillNumber` varchar(90) NOT NULL,
  `Payment_Date` timestamp NOT NULL DEFAULT curdate(),
  `Processing_Date` timestamp NOT NULL DEFAULT curdate(),
  `Amount` decimal(18,2) NOT NULL,
  `Transaction_Number` varchar(20) NOT NULL,
  `Payment_Method` varchar(20) DEFAULT NULL,
  `Access_Channel` varchar(20) NOT NULL,
  `Bank_Id` varchar(20) DEFAULT NULL,
  `Branch_Id` varchar(20) DEFAULT NULL,
  `District_Code` varchar(20) DEFAULT NULL,
  `Bulk_Amount_Sequence` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faculties`
--

CREATE TABLE `faculties` (
  `ID` int(11) NOT NULL,
  `NameAR` varchar(50) NOT NULL,
  `Code` varchar(50) DEFAULT NULL,
  `Account` varchar(50) DEFAULT NULL,
  `NameEN` varchar(50) DEFAULT NULL,
  `CBEMemberAccount` varchar(50) DEFAULT NULL,
  `AccountNumber` varchar(50) DEFAULT NULL,
  `Note` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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
-- Table structure for table `jobs`
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
-- Table structure for table `job_batches`
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
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_12_29_115307_create_posts_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `value`, `created_at`, `updated_at`) VALUES
(1, 'بيان حاله', '200', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `ID` int(11) NOT NULL,
  `SERVICESName` varchar(255) NOT NULL,
  `value` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`ID`, `SERVICESName`, `value`) VALUES
(1, 'بيان حاله', 200),
(2, 'تربية عسكريه', 500),
(3, 'رسم القيد', 1500);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
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
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('0x7lBqK2cQq7isjD51VajTFWqQHFNOdX0oElF9rS', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiYmtHc1FHQ3V1d1k3YnVhY0lOenM5Vmt2VXB1aTE2TDdkUWgxZlFFOSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6ODoicGFzc3dvcmQiO3M6MTQ6IjI5MDEwMTUxNzAwNDg1Ijt9', 1746357365),
('BXCUbHo7LkQ5oRPtAQgGpEjvMmMNcH349EKoW7U1', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:138.0) Gecko/20100101 Firefox/138.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRDd0dk5RbG5OeDV5VkwzZWxrdkxZYTJwNDQwTUMzMjhxaUFZNXo5RyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wb3N0cyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1748342821),
('DCY9sjR0U6n245klD2C5aSw2zdyZ1o24MGAXw1s7', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSFJqamRCS1QweTZCb1BMaUdaOERuUmZBNUJ1UTZzZkpNTkNYZFYxTyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6ODoicGFzc3dvcmQiO3M6MTQ6IjI5MDEwMTUxNzAwNDA4Ijt9', 1748348482),
('OnYjUiYlBBuCYLTRqmI03CbCEv1OhVksc2poCGOj', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:138.0) Gecko/20100101 Firefox/138.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOTVkQVBIVDJNajJEN2p5a1RvT1lzODFTejQ5bENqNU1PQnZzMFJ5RCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9yZWdpc3RlciI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1747308871);

-- --------------------------------------------------------

--
-- Table structure for table `userlevels`
--

CREATE TABLE `userlevels` (
  `ID` int(11) NOT NULL,
  `UserLevelName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', NULL, '$2y$12$bTwfFlxIdCND3nbREqBN3uPBQ/OM7Pzdy5/vXp9epuiSbDii4Ko9S', NULL, '2025-03-02 06:32:15', '2025-03-02 06:32:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `billamounts`
--
ALTER TABLE `billamounts`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`ID`);

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
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`Code`);

--
-- Indexes for table `ef_payment`
--
ALTER TABLE `ef_payment`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `faculties`
--
ALTER TABLE `faculties`
  ADD PRIMARY KEY (`ID`);

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
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `userlevels`
--
ALTER TABLE `userlevels`
  ADD PRIMARY KEY (`ID`);

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
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `ID` int(90) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
