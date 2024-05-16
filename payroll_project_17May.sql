-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 16, 2024 at 09:40 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `payroll_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Rahul', 'developer.rahul9888@gmail.com', NULL, '$2y$12$XC4uI2BFbGQOZ01YRqrCWebi6W9Ll0USbeeDARuuUUguimg9Sf0Du', NULL, '2024-05-16 08:31:42', '2024-05-16 03:01:42');

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendance_logs`
--

CREATE TABLE `attendance_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('in','out') NOT NULL,
  `status` enum('on-time','late','overtime','under-time') NOT NULL,
  `minutes_rendered` tinyint(4) NOT NULL DEFAULT 0,
  `date` date NOT NULL DEFAULT curdate(),
  `time` time NOT NULL DEFAULT curtime(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deboards`
--

CREATE TABLE `deboards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `reason` varchar(255) NOT NULL,
  `notice_period` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `final_employment_date` date NOT NULL,
  `final_working_date` date NOT NULL,
  `report_to` int(11) NOT NULL,
  `support_comment` varchar(255) NOT NULL,
  `re_employable` tinyint(1) NOT NULL,
  `remaining_pl_year` int(11) NOT NULL,
  `remaining_pl_leave` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `leave_application`
--

CREATE TABLE `leave_application` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reason` varchar(255) NOT NULL,
  `information` varchar(255) NOT NULL,
  `applier_user_id` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `leave_type_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `leave_type`
--

CREATE TABLE `leave_type` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `days` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `leave_type`
--

INSERT INTO `leave_type` (`id`, `type`, `days`, `created_at`, `updated_at`) VALUES
(1, 'CL', 1, '2024-05-17 01:09:46', '2024-05-16 19:39:46'),
(2, 'PL', 1, '2024-05-17 01:09:46', '2024-05-16 19:39:46');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2024_04_23_204945_create_leaves_table', 1),
(7, '2024_04_23_205005_create_attendances_table', 1),
(8, '2024_04_23_205016_create_admins_table', 1),
(9, '2024_04_23_205031_create_payrolls_table', 1),
(10, '2024_04_24_184903_create_notifications_table', 1),
(11, '2024_04_24_194502_create_attendance_logs_table', 1),
(12, '2024_04_24_195912_create_leave_type_table', 1),
(13, '2024_04_24_200122_create_leave_application_table', 1),
(14, '2024_05_11_054447_create_user_details_table', 2),
(15, '2024_05_11_061124_create_permission_tables', 2),
(16, '2024_05_11_063204_create_payroll_batch_table', 3),
(17, '2024_05_11_063322_create_payrolls_table', 4),
(18, '2024_05_12_093851_create_deboards_table', 4),
(19, '2024_05_16_121058_add_slug_to_permission_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) NOT NULL,
  `type` varchar(255) NOT NULL,
  `notifiable_type` varchar(255) NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payrolls`
--

CREATE TABLE `payrolls` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `batch_id` int(11) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payroll_batch`
--

CREATE TABLE `payroll_batch` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payroll_batch`
--

INSERT INTO `payroll_batch` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Batch', '2024-05-12 13:10:02', '2024-05-12 13:10:02'),
(2, 'sf', '2024-05-12 14:00:40', '2024-05-12 14:00:40'),
(3, 'aegfe', '2024-05-12 14:01:18', '2024-05-12 14:01:18');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `slug`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'On-Board', 'user-create', 'adminApi', NULL, NULL),
(3, 'De-Board', 'user-delete', 'adminApi', NULL, NULL),
(4, 'Update Profile', 'user-edit', 'adminApi', NULL, NULL),
(5, 'View Profile', 'user-view', 'adminApi', NULL, NULL),
(6, 'Leave Approval', 'leave-edit', 'adminApi', NULL, NULL),
(7, 'View Leave History', 'leave-list', 'adminApi', NULL, NULL),
(8, 'Generate Payroll', 'payroll-create', 'adminApi', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'adminApi', '2024-05-02 03:58:26', '2024-05-16 14:05:51'),
(3, 'Employee', 'adminApi', '2024-05-02 14:21:27', '2024-05-16 14:06:00'),
(4, 'Developer', 'adminApi', '2024-05-16 07:22:10', '2024-05-16 14:06:10'),
(24, 'Designer', 'adminApi', '2024-05-16 14:06:22', '2024-05-16 14:06:22');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 3),
(1, 4),
(1, 24),
(3, 1),
(3, 3),
(3, 4),
(3, 24),
(4, 1),
(4, 3),
(4, 4),
(5, 1),
(5, 3),
(5, 4),
(6, 1),
(6, 3),
(6, 4),
(7, 1),
(7, 3),
(7, 4),
(7, 24),
(8, 1),
(8, 3),
(8, 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `employee_id` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `phone` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `first_name`, `last_name`, `employee_id`, `email`, `email_verified_at`, `phone`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Rahul Tech', 'Rahul', 'Tech', '75875875', 'goldroger9888@gmail.com', NULL, '01234567895', '$2y$12$pnnvB5jBv1Klwkls4VdqbO9EIK8QMv1HuTryPTI4NKgcIuUHwFBau', NULL, '2024-05-11 16:49:14', '2024-05-12 03:56:52', NULL),
(2, 'Name Tech', 'Name', 'Tech', '7587587547', 'goldroger98888@gmail.com', NULL, '01234567895', '$2y$12$jtMWAj.DXms9ANHLwuWRZOgw8a8sYkGF6jXLhx8/RtIp/WWBxzREC', NULL, '2024-05-11 16:50:34', '2024-05-12 03:44:15', NULL),
(4, 'Amazing Tech', 'Amazing', 'Tech', '12345578', 'employee123@gmail.com', NULL, '01234567895', '$2y$12$tm.Oyoxy7vVgGiuastILWeWygERMoK/eZgFchtj5MvH1YCzrSsG32', NULL, '2024-05-12 12:24:41', '2024-05-12 06:54:41', NULL),
(5, 'Rahul Singh', 'Rahul', 'Singh', '54545554656', 'fwwglhrwlj@gmail.com', NULL, '4567894512', '$2y$12$i6bqNepAq365hZ920xrXIOND9ExYkgdkaSw3xHtzgurhH0.QgMSbS', NULL, '2024-05-16 08:41:36', '2024-05-16 03:11:36', NULL),
(6, 'Rahul dlkf', 'Rahul', 'dlkf', '545656', 'wrgr@gmaill.com', NULL, '878455465', '$2y$12$JiD8Hy2RzKE1CErqjuNoOe4FGt0JDks9jwpVnNTOD7qkRAbUEGSSC', NULL, '2024-05-16 08:44:33', '2024-05-16 03:14:33', NULL),
(8, 'Rahul dlkf', 'Rahul', 'dlkf', '54565687', 'wrgrkhkhj@gmaill.com', NULL, '878455465', '$2y$12$zyUK5iGDvKZAU8PcJLCGKOscb3sq9nSlW3GVqUbhzx9JX4wz/mEgG', NULL, '2024-05-16 08:47:01', '2024-05-16 03:17:01', NULL),
(9, 'swfwg tegt4g', 'swfwg', 'tegt4g', '4585', '4thth@gh.com', NULL, '54655', '$2y$12$DW0cyz8YDfkwPPwQSs4KzuxYnW/vcJbgroDUfxngc5uefFmySUuUK', NULL, '2024-05-16 08:47:55', '2024-05-16 03:17:55', NULL),
(10, 'sfgf sgsrfg', 'sfgf', 'sgsrfg', '5465656', 'srfgr@gmail.com', NULL, '54656', '$2y$12$vVngAQAHm7.hiaSvq1e0uOdcZywbGpj1Z/HhD/qob5tcUquhXEUV.', NULL, '2024-05-16 08:48:50', '2024-05-16 03:18:50', NULL),
(15, 'Rahul Singh', 'Rahul', 'Singh', '54565956', 'jhbdkh@gmail.com', NULL, '8465656', '$2y$12$nX3b4WVWLB2CAzLc2wY7Bef24UHGn2qVbsjATPV0uICOWzH0Vomuu', NULL, '2024-05-16 09:13:11', '2024-05-16 03:43:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `gender` varchar(10) NOT NULL,
  `dob` date DEFAULT NULL,
  `secondary_email` varchar(255) DEFAULT NULL,
  `alternate_phone` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `address_1` varchar(255) DEFAULT NULL,
  `city` varchar(20) DEFAULT NULL,
  `state` varchar(20) DEFAULT NULL,
  `country` varchar(20) DEFAULT NULL,
  `postcode` varchar(10) DEFAULT NULL,
  `p_address` varchar(255) DEFAULT NULL,
  `p_address_1` varchar(255) DEFAULT NULL,
  `p_city` varchar(20) DEFAULT NULL,
  `p_state` varchar(20) DEFAULT NULL,
  `p_country` varchar(20) DEFAULT NULL,
  `p_postcode` varchar(10) DEFAULT NULL,
  `doj` date DEFAULT NULL,
  `prob_end_date` date DEFAULT NULL,
  `company` varchar(20) DEFAULT NULL,
  `location` varchar(50) DEFAULT NULL,
  `qualification` varchar(50) DEFAULT NULL,
  `experience` varchar(50) DEFAULT NULL,
  `immediate_manager` varchar(50) DEFAULT NULL,
  `immediate_manager_code` varchar(50) DEFAULT NULL,
  `leave_approving_auth` varchar(50) DEFAULT NULL,
  `leave_approving_code` varchar(50) DEFAULT NULL,
  `department` varchar(50) DEFAULT NULL,
  `job_role` varchar(50) DEFAULT NULL,
  `grade` varchar(10) DEFAULT NULL,
  `employment_type` varchar(10) DEFAULT NULL,
  `aadhar_number` varchar(20) DEFAULT NULL,
  `pan_number` varchar(20) DEFAULT NULL,
  `holiday_year` varchar(20) DEFAULT NULL,
  `work_pattern` varchar(20) DEFAULT NULL,
  `earning_leave_entitlement` varchar(20) DEFAULT NULL,
  `this_year` varchar(20) DEFAULT NULL,
  `next_year` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `user_id`, `gender`, `dob`, `secondary_email`, `alternate_phone`, `address`, `address_1`, `city`, `state`, `country`, `postcode`, `p_address`, `p_address_1`, `p_city`, `p_state`, `p_country`, `p_postcode`, `doj`, `prob_end_date`, `company`, `location`, `qualification`, `experience`, `immediate_manager`, `immediate_manager_code`, `leave_approving_auth`, `leave_approving_code`, `department`, `job_role`, `grade`, `employment_type`, `aadhar_number`, `pan_number`, `holiday_year`, `work_pattern`, `earning_leave_entitlement`, `this_year`, `next_year`, `created_at`, `updated_at`) VALUES
(1, 2, 'Female', '2024-05-01', 'goldroger9888@gmail.com', '123245', 'Kurali', 'wrgrw', 'wrg', 'rwg', 'wrg', '140103', 'Kurali', 'wrgrw', 'wrg', 'rwg', 'wrg', '140103', '2024-05-21', '2024-05-06', 'Option1', 'Option2', 'Option2', 'Option2', 'Option2', '2024-05-14', 'Option2', '2024-05-28', 'Option1', 'HR', 'Option1', 'B', '855858', '585', 'Option1', 'Option2', '58', '2024', '2023', '2024-05-11 11:20:34', '2024-05-12 03:31:34'),
(4, 4, 'Male', '2024-05-14', 'goldroger9888@gmail.com', 'undefined', 'Kurali', 'Address 1', 'Mohali', 'Punjab', 'India', '140103', 'Kurali', 'Address 1', 'Mohali', 'Punjab', 'India', '140103', '2024-05-07', '2024-05-13', 'Option2', 'Option1', 'Option1', 'Option1', 'Option1', '2024-05-13', 'Option1', '2024-05-21', NULL, '3', 'Option1', 'A', '332311', '12235', 'Option1', 'Option1', '100', '20', 'undefined', '2024-05-12 06:54:41', '2024-05-16 14:03:34'),
(5, 5, 'Male', '2024-05-13', 'wfgr@gmail.com', '1234565565', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', '2024-05-15', '2024-05-15', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', '2024-05-16 03:11:36', '2024-05-16 03:11:36'),
(6, 15, 'Male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-05-16 03:43:11', '2024-05-16 03:43:11'),
(7, 9, 'Female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-05-16 03:55:26', '2024-05-16 03:55:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance_logs`
--
ALTER TABLE `attendance_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attendance_logs_date_index` (`date`);

--
-- Indexes for table `deboards`
--
ALTER TABLE `deboards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `deboards_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `leave_application`
--
ALTER TABLE `leave_application`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leave_type`
--
ALTER TABLE `leave_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payrolls`
--
ALTER TABLE `payrolls`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payrolls_user_id_foreign` (`user_id`);

--
-- Indexes for table `payroll_batch`
--
ALTER TABLE `payroll_batch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_details_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attendance_logs`
--
ALTER TABLE `attendance_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deboards`
--
ALTER TABLE `deboards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leave_application`
--
ALTER TABLE `leave_application`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leave_type`
--
ALTER TABLE `leave_type`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `payrolls`
--
ALTER TABLE `payrolls`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payroll_batch`
--
ALTER TABLE `payroll_batch`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `deboards`
--
ALTER TABLE `deboards`
  ADD CONSTRAINT `deboards_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payrolls`
--
ALTER TABLE `payrolls`
  ADD CONSTRAINT `payrolls_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
