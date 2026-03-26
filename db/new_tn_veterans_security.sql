-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 26, 2026 at 06:32 PM
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
-- Database: `security`
--

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
-- Table structure for table `class_schedules`
--

CREATE TABLE `class_schedules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `class_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time DEFAULT NULL,
  `duration_hours` int(11) NOT NULL,
  `max_students` int(11) NOT NULL DEFAULT 10,
  `min_students` int(11) NOT NULL DEFAULT 2,
  `current_students` int(11) NOT NULL DEFAULT 0,
  `room` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `instructor` varchar(255) DEFAULT NULL,
  `can_overlap` tinyint(1) NOT NULL DEFAULT 1,
  `status` enum('scheduled','full','cancelled','completed') NOT NULL DEFAULT 'scheduled',
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `class_schedules`
--

INSERT INTO `class_schedules` (`id`, `service_id`, `class_date`, `start_time`, `end_time`, `duration_hours`, `max_students`, `min_students`, `current_students`, `room`, `location`, `instructor`, `can_overlap`, `status`, `notes`, `created_at`, `updated_at`) VALUES
(4, 7, '2026-01-22', '12:12:00', '20:12:00', 8, 10, 2, 0, 'Class A 03', NULL, 'Jayson Wheat', 1, 'scheduled', 'Testing', '2026-01-20 17:38:22', '2026-01-20 17:38:22'),
(5, 7, '2026-01-23', '15:21:00', '23:21:00', 8, 10, 2, 2, 'Class A 03', NULL, 'Jayson Wheat', 1, 'scheduled', 'Testing', '2026-01-20 17:38:22', '2026-01-21 10:55:00'),
(6, 7, '2026-01-27', '08:42:00', '16:42:00', 8, 10, 2, 0, 'Class A 03', NULL, 'Jayson Wheat', 1, 'scheduled', 'Testing', '2026-01-20 17:38:22', '2026-01-20 17:38:22'),
(7, 1, '2026-01-22', '11:11:00', '16:11:00', 5, 8, 4, 0, 'Class A 7', NULL, 'Jayson', 1, 'scheduled', 'test', '2026-01-20 17:45:12', '2026-01-21 14:42:14'),
(8, 1, '2026-01-24', '07:50:00', '15:50:00', 8, 10, 2, 0, 'class A 09', NULL, 'Jayson ww', 1, 'scheduled', 'testing', '2026-01-20 17:45:50', '2026-01-20 17:45:50'),
(9, 3, '2026-01-23', '16:00:00', '08:00:00', 16, 10, 1, 0, '32123', NULL, 'Jack', 1, 'scheduled', NULL, '2026-01-21 13:34:30', '2026-01-21 13:34:30'),
(10, 2, '2026-01-30', '17:00:00', '01:00:00', 8, 10, 2, 0, 'Class A17', NULL, 'Jack son', 1, 'scheduled', NULL, '2026-01-21 13:36:22', '2026-01-21 13:36:22'),
(11, 2, '2026-01-31', '18:00:00', '02:00:00', 8, 10, 2, 0, 'Class A17', NULL, 'Jack son', 1, 'scheduled', NULL, '2026-01-21 13:36:22', '2026-01-21 13:36:22'),
(12, 26, '2026-01-29', '03:50:00', '07:50:00', 4, 10, 1, 0, '1231231', 'Location A', 'Jayson ww', 1, 'scheduled', 'Dallas Law Training', NULL, NULL),
(13, 26, '2026-01-29', '03:50:00', '07:50:00', 4, 10, 1, 3, '1231231', 'Location B', 'Jayson ww', 1, 'scheduled', 'Dallas Law Training', NULL, '2026-01-28 13:02:14'),
(14, 26, '2026-01-30', '18:51:00', '20:51:00', 2, 10, 1, 0, 'Class A 7', 'Location A', 'Jack', 1, 'scheduled', 'Lethal Less Traning', NULL, NULL),
(15, 26, '2026-01-30', '18:51:00', '20:51:00', 2, 10, 1, 0, 'Class A 7', 'Location B', 'Jack', 1, 'scheduled', 'Lethal Less Traning', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `password`, `phone`, `address`, `profile_picture`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Json', 'customer@customer.com', '$2y$12$8DaIhkSdBoi8p.qXc7Vx2e6vLsM7EoqFMg5jEXHp9my/ezenSegyK', '1231231231', '44075 Pipeline Plaza Ste. 125', 'customer-profiles/ypHnHGAPwms3tWX1LKRFVVoRsdJauW0s2fhODHqd.jpg', NULL, NULL, '2026-01-12 17:14:44', '2026-01-12 17:23:51'),
(2, 'Production Head', 'student@gmail.com', '$2y$12$UUuPm.bnIhlqLJxz.CaNoucS8AXcrpeLKj6pxybDRUXFc7OU5RpkG', '1231231231', '44075 Pipeline Plaza Ste. 125', 'customer-profiles/wkdK2E1C1UA412Lf2KWEfXg6GXbWUYGl5vnsaJ6k.jpg', NULL, NULL, '2026-01-20 18:19:20', '2026-01-20 18:21:46'),
(3, 'Jack', 'jack@gemail.com', '$2y$12$qd5xtI0IzfwvE5CUrR2hNeObl5hHF1zY1LkjVodoi/wZ3H/EX/Qzi', '1231231231', '44075 Pipeline Plaza Ste. 132', NULL, NULL, NULL, '2026-01-21 10:35:40', '2026-01-21 10:35:40'),
(4, 'Arthur Stewart', 'myzemalof@mailinator.com', '$2y$12$fj7PJKkg5C80/llqTmv3Euz4wpIAjkuo00C/X0bAUk9T5omKXtg2e', '+1 (711) 955-7239', NULL, NULL, NULL, NULL, '2026-02-17 21:42:16', '2026-02-17 21:42:16'),
(5, 'Zachary Petty', 'qinigon@mailinator.com', '$2y$12$YBCTP39rRRz.SCIVmYIpr.tgB/u2NI5bOcqifo2riayCsciAWdOV.', '+1 (624) 201-5859', NULL, NULL, NULL, NULL, '2026-02-17 21:44:36', '2026-02-17 21:44:36'),
(6, 'James Allen', 'james@americandigitalagency.us', '$2y$12$N3g11kvp74fJAPhPt.5HyOyyGpIZTJMs/g6QrFDHtRYK.2GI0qbE2', '1234356789', NULL, NULL, NULL, NULL, '2026-02-25 15:38:33', '2026-02-25 15:38:33'),
(7, 'Reese Huff', 'kaqajuzac@mailinator.com', '$2y$12$/bu1L5nBNkieHF6rlxZeXOciWSuTXt70.RhLW2K/nGuD3xwk9LN16', '+1 (515) 947-2357', NULL, NULL, NULL, NULL, '2026-02-25 17:10:36', '2026-02-25 17:10:36'),
(8, 'Fleur Skinner', 'fymutiwi@mailinator.com', '$2y$12$c57phwlmE6ECmJvzlb6H9u6AdXh/BFOMQfQILBLcCxjsLECN0XgiO', '+1 (633) 563-7447', NULL, NULL, NULL, NULL, '2026-02-26 13:58:16', '2026-02-26 13:58:16'),
(9, 'Ralph Price', 'kupanusid@mailinator.com', '$2y$12$6E9MuYPn6y0ZT6Sc4ZuSvej50XtiaNk6dRxhhueNv461eZyyGQL0K', '+1 (863) 832-1195', NULL, NULL, NULL, NULL, '2026-02-26 15:53:05', '2026-02-26 15:53:05'),
(10, 'Tatiana Boyd', 'kasa@mailinator.com', '$2y$12$q3iUrvXvRRb7losHgS1kJu3g7VEkA5ixdOyFuAgf6C5OM9bb0Peg.', '+1 (611) 219-3096', NULL, NULL, NULL, NULL, '2026-03-06 13:35:07', '2026-03-06 13:35:07'),
(11, 'Pamela Gonzalez', 'gumu@mailinator.com', '$2y$12$Eztq7YzHtotkBxwmfdqZKOqQTZ0ilzgzJmAcu2aPVscbkU895jtEG', '+1 (328) 414-8434', 'Recusandae Porro in', NULL, NULL, NULL, '2026-03-06 13:40:34', '2026-03-06 13:40:34'),
(12, 'Tad Ortiz', 'dupelyh@mailinator.com', '$2y$12$sS0I7wXcBHaqobrAqptDBeQaWlUbEE5Bd4VIMQwHSjkh.SHMzspbW', '+1 (841) 664-6456', NULL, NULL, NULL, NULL, '2026-03-10 13:33:22', '2026-03-10 13:33:22'),
(13, 'Nathaniel Mcneil', 'nolilerux@mailinator.com', '$2y$12$0dBAqBYtsYMFEqybc.JGtOWxyFFFgxX3BoZEwGWfIirAf55EK6E4i', '+1 (853) 423-8583', NULL, NULL, NULL, NULL, '2026-03-10 16:29:18', '2026-03-10 16:29:18'),
(14, 'Quamar Britt', 'quhexeciwu@mailinator.com', '$2y$12$mBNCiOV.xIT3ayhVPI8eE.efaaV9RAvb8QvGtFRyN8A9mwSaaae3i', '+1 (845) 296-5428', NULL, NULL, NULL, NULL, '2026-03-10 18:20:46', '2026-03-10 18:20:46');

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
(4, '2026_01_12_174338_create_services_table', 2),
(5, '2026_01_12_175606_add_short_description_to_services_table', 3),
(6, '2026_01_12_182335_create_site_settings_table', 4),
(7, '2026_01_12_183941_add_profile_picture_to_users_table', 5),
(8, '2026_01_12_221013_create_customers_table', 6),
(9, '2026_01_12_221017_create_service_bookings_table', 6),
(10, '2026_01_20_220728_add_class_fields_to_services_table', 7),
(11, '2026_01_20_220737_create_class_schedules_table', 7),
(12, '2026_01_20_220740_add_payment_fields_to_service_bookings_table', 7),
(13, '2026_01_20_220744_create_payments_table', 7),
(14, '2026_01_21_184933_add_api_keys_to_site_settings_table', 8),
(15, '2026_01_27_163452_add_category_fields_to_services_table', 9),
(16, '2026_01_27_164327_create_security_company_links_table', 10),
(17, '2026_01_27_164435_add_instructor_bios_to_site_settings_table', 11),
(18, '2026_01_27_165429_add_location_to_class_schedules_table', 12),
(19, '2026_01_27_165433_add_location_to_service_bookings_table', 12),
(20, '2026_01_27_220557_create_service_relationships_table', 13),
(21, '2026_01_27_220640_add_requires_conditional_questions_to_services_table', 13),
(22, '2026_03_11_000000_add_slug_to_services_table', 14),
(23, '2026_03_11_100000_add_sub_titles_to_services_table', 15),
(24, '2026_02_12_100000_change_services_category_to_json_for_multiple', 16),
(25, '2026_03_02_201303_add_current_students_to_services_table', 16),
(26, '2026_03_26_160758_add_requirments_column_to_services_table', 16);

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
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `booking_id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_type` enum('deposit','full_payment','remaining_balance','refund') NOT NULL DEFAULT 'deposit',
  `payment_method` enum('credit_card','debit_card','bank_transfer','cash','check','other') NOT NULL DEFAULT 'credit_card',
  `status` enum('pending','completed','failed','refunded') NOT NULL DEFAULT 'pending',
  `transaction_id` varchar(255) DEFAULT NULL,
  `payment_gateway` varchar(255) DEFAULT NULL,
  `gateway_response` text DEFAULT NULL,
  `synced_to_quickbooks` tinyint(1) NOT NULL DEFAULT 0,
  `quickbooks_invoice_id` varchar(255) DEFAULT NULL,
  `quickbooks_payment_id` varchar(255) DEFAULT NULL,
  `quickbooks_synced_at` timestamp NULL DEFAULT NULL,
  `synced_to_bank` tinyint(1) NOT NULL DEFAULT 0,
  `bank_synced_at` timestamp NULL DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `payment_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `booking_id`, `customer_id`, `amount`, `payment_type`, `payment_method`, `status`, `transaction_id`, `payment_gateway`, `gateway_response`, `synced_to_quickbooks`, `quickbooks_invoice_id`, `quickbooks_payment_id`, `quickbooks_synced_at`, `synced_to_bank`, `bank_synced_at`, `notes`, `payment_date`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 40.00, 'deposit', 'cash', 'pending', NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, '2026-01-20', '2026-01-20 18:21:08', '2026-01-20 18:21:08'),
(2, 2, 3, 100.00, 'deposit', 'credit_card', 'completed', '1231231231111111', NULL, NULL, 1, '154', '155', '2026-02-13 20:33:17', 0, NULL, NULL, '2026-01-21', '2026-01-21 10:55:21', '2026-02-13 20:33:17'),
(3, 3, 2, 300.00, 'deposit', 'credit_card', 'completed', '1231231231', NULL, NULL, 1, '156', '157', '2026-02-13 20:33:24', 0, NULL, NULL, '2026-01-28', '2026-01-28 13:02:30', '2026-02-13 20:33:24'),
(4, 5, 5, 20.00, 'deposit', 'credit_card', 'completed', NULL, 'quickbooks_payments', '{\"charge_id\":null}', 1, '164', '165', '2026-02-17 21:45:42', 0, NULL, NULL, '2026-02-17', '2026-02-17 21:45:33', '2026-02-17 21:45:42');

-- --------------------------------------------------------

--
-- Table structure for table `security_company_links`
--

CREATE TABLE `security_company_links` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `url` varchar(255) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(100) DEFAULT NULL,
  `short_description` text DEFAULT NULL,
  `requirements` text DEFAULT NULL,
  `sub_titles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`sub_titles`)),
  `description` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `deposit_amount` decimal(10,2) DEFAULT NULL,
  `duration_hours` int(11) DEFAULT NULL,
  `max_students` int(11) NOT NULL DEFAULT 10,
  `min_students` int(11) NOT NULL DEFAULT 2,
  `class_type` enum('group','one-on-one') NOT NULL DEFAULT 'group',
  `has_online_parts` tinyint(1) NOT NULL DEFAULT 0,
  `testing_in_person` tinyint(1) NOT NULL DEFAULT 1,
  `image` varchar(255) DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `subcategory` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `requires_dallas_law` tinyint(1) NOT NULL DEFAULT 0,
  `requires_active_shooter` tinyint(1) NOT NULL DEFAULT 0,
  `requires_conditional_questions` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `categories` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `current_students` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `title`, `slug`, `short_description`, `requirements`, `sub_titles`, `description`, `price`, `deposit_amount`, `duration_hours`, `max_students`, `min_students`, `class_type`, `has_online_parts`, `testing_in_person`, `image`, `order`, `is_active`, `subcategory`, `location`, `requires_dallas_law`, `requires_active_shooter`, `requires_conditional_questions`, `created_at`, `updated_at`, `categories`, `current_students`) VALUES
(1, 'Armed Security Certification', NULL, 'Armed Security Certification provides advanced training in firearm safety, legal use of force, and tactical response for professional armed security roles.', NULL, NULL, '<p>Armed Security Certification is an advanced training program designed for individuals pursuing or currently working in armed security positions. This certification equips participants with the knowledge, skills, and discipline required to carry and use firearms responsibly while performing protective duties.</p><p><br></p><p>The program covers firearm safety, weapons handling, marksmanship fundamentals, and safe storage, along with critical instruction on use-of-force laws, legal responsibilities, and ethical decision-making. Participants receive scenario-based training to develop judgment, threat assessment, and controlled response under high-stress conditions.</p><p><br></p><p>Additional focus areas include defensive tactics, situational awareness, communication, and coordination with law enforcement and emergency responders. Emphasis is placed on professionalism, accountability, and compliance with state and employer regulations.</p><p><br></p><p>Armed Security Certification is ideal for security professionals seeking armed assignments in corporate, residential, event, or high-risk environments. Completion of this training demonstrates readiness, competence, and commitment to maintaining the highest standards of safety and professionalism in armed protective services.</p>', 95.00, 10.00, NULL, 10, 2, 'group', 1, 0, 'services/gV79EbBPvkL16BCvQpqhb9gatnK9A8slmsv2OhsR.jpg', 1, 1, NULL, NULL, 0, 0, 0, '2026-01-12 12:52:47', '2026-01-21 12:52:40', NULL, 0),
(2, 'Force Science (De-escalation)', NULL, 'Force Science (De-escalation) training teaches evidence-based techniques to reduce conflict, manage behavior, and safely resolve high-stress encounters.', NULL, NULL, '<p>Force Science (De-escalation) training is a research-driven program focused on understanding human behavior, stress responses, and decision-making during high-risk or emotionally charged situations. This training equips participants with proven de-escalation strategies to prevent situations from escalating into physical force.</p><p><br></p><p>The course emphasizes verbal communication skills, body language awareness, distance management, and emotional regulation to influence behavior and maintain control. Participants learn how stress, perception, and cognitive limitations affect both responders and subjects, enabling safer and more effective interactions.</p><p><br></p><p>Scenario-based training reinforces practical application, teaching participants how to recognize warning signs, apply tactical patience, and choose appropriate responses while remaining legally and ethically compliant. The program also addresses use-of-force decision-making, accountability, and post-incident considerations.</p><p><br></p><p>Force Science (De-escalation) training is ideal for security officers, guards, supervisors, and individuals preparing for future security careers. It promotes professionalism, safety, and confidence while reducing risk, liability, and unnecessary use of force in protective service environments.</p>', 200.00, 100.00, NULL, 10, 2, 'group', 1, 0, 'services/lu6mY6GfYotlfByxzKUFWSukJnAC0U7JU5BTDtDD.jpg', 3, 1, NULL, NULL, 0, 0, 0, '2026-01-12 13:00:45', '2026-01-21 12:58:40', NULL, 0),
(3, 'ASP (Batons and Restraints)', NULL, 'ASP (Batons and Restraints) training teaches proper baton use and restraint techniques for safely controlling and managing resistant or aggressive individuals.', NULL, NULL, '<p>ASP (Batons and Restraints) training provides essential instruction in the safe, legal, and effective use of expandable batons and restraint devices for security and protective service professionals. This program emphasizes control, officer safety, and minimizing injury while managing confrontational or non-compliant situations.</p><p><br></p><p>Participants learn correct baton handling, striking zones, defensive techniques, and retention methods, along with proper application of restraints such as handcuffs and control devices. The training includes use-of-force guidelines, legal considerations, and decision-making to ensure actions are justified, proportional, and compliant with industry standards.</p><p><br></p><p>Scenario-based exercises help develop practical skills in de-escalation, subject control, team coordination, and situational awareness. Strong emphasis is placed on professionalism, accountability, and post-incident procedures, including reporting and subject care.</p><p><br></p><p>This training is ideal for security officers, guards, and individuals preparing for future security roles who require intermediate force options to maintain safety and control in dynamic environments.</p>', 100.00, 50.00, NULL, 10, 2, 'group', 0, 0, 'services/BkxqE6w72S4gcPBjXi06KoDngDnDNdh1cV4KJlne.png', 2, 1, NULL, NULL, 0, 0, 0, '2026-01-12 13:13:46', '2026-01-21 12:55:06', NULL, 0),
(4, 'NRA (Advanced Handgun Carry)', NULL, 'NRA Advanced Handgun Carry training develops advanced handgun skills, defensive carry techniques, and responsible decision-making for armed professionals and qualified civilians.', NULL, NULL, '<p>NRA Advanced Handgun Carry is an advanced-level firearms training program designed to enhance defensive handgun proficiency for individuals who carry a firearm for personal protection or professional duties. This course builds on fundamental handgun skills and focuses on real-world defensive carry scenarios.</p><p><br></p><p>Training includes advanced marksmanship, drawing from concealment, movement, use of cover, threat assessment, and defensive shooting techniques. Strong emphasis is placed on firearm safety, legal considerations, and responsible use of force in accordance with applicable laws.</p><p><br></p><p>Participants also learn mindset development, situational awareness, and decision-making under stress through scenario-based instruction. The course reinforces safe gun handling, accountability, and ethical responsibilities associated with carrying a handgun in public or professional environments.</p><p><br></p><p>NRA Advanced Handgun Carry is ideal for armed security personnel, protective service professionals, and experienced civilian carriers seeking to elevate their skills, confidence, and readiness while maintaining the highest standards of safety and professionalism.</p>', 150.00, 50.00, NULL, 10, 2, 'group', 0, 0, 'services/BrCipzeQ82L1MONsdaonwzCkq716sIzeq16tvNiU.jpg', 4, 1, NULL, NULL, 0, 0, 0, '2026-01-12 13:14:51', '2026-01-21 13:00:00', NULL, 0),
(6, 'Red Cross (First Aid, CPR, and AED)', NULL, 'Red Cross First Aid, CPR, and AED training equips individuals with lifesaving skills to respond confidently to medical emergencies.', NULL, NULL, '<p>Red Cross First Aid, CPR, and AED training provides comprehensive, nationally recognized instruction in emergency medical response for adults, children, and infants. This course prepares participants to act quickly and effectively during medical emergencies until professional help arrives.</p><p><br></p><p>Training covers essential first aid skills, including bleeding control, wound care, shock management, and response to common injuries and illnesses. Participants also receive hands-on instruction in cardiopulmonary resuscitation (CPR) and the safe, effective use of Automated External Defibrillators (AEDs).</p><p><br></p><p>Emphasis is placed on scene safety, emergency assessment, teamwork, and legal considerations such as Good Samaritan protections. Practical scenarios build confidence, coordination, and readiness in high-stress situations.</p><p><br></p><p>This training is ideal for security officers, guards, workplace teams, educators, and individuals preparing for future security or protective service roles. Certification demonstrates preparedness, responsibility, and commitment to safety in any environment.</p>', 300.00, 100.00, NULL, 10, 2, 'group', 0, 0, 'services/KWZGG0VFBFUh0fYE2nBcZwcB3brTGSyqhb2PavAq.jpg', 6, 1, NULL, NULL, 0, 0, 0, '2026-01-12 13:18:51', '2026-01-21 13:02:32', NULL, 0),
(7, 'ALERRT (Active Shooter)', NULL, 'ALERRT (Active Shooter) training prepares individuals to recognize, respond to, and survive active shooter and hostile threat incidents.', NULL, NULL, '<p>ALERRT (Advanced Law Enforcement Rapid Response Training) – Active Shooter training is a nationally recognized, research-based program designed to prepare individuals and organizations for rapid and effective response to active shooter and hostile threat events.</p><p><br></p><p>The training focuses on threat recognition, situational awareness, and immediate response strategies to reduce harm and save lives. Participants learn proven concepts such as movement during high-risk incidents, decision-making under stress, communication, coordination with first responders, and lifesaving medical response including bleeding control.</p><p><br></p><p>Scenario-based instruction reinforces practical application, helping participants understand attacker behavior, response priorities, and survival principles. The program emphasizes prevention, preparedness, and recovery while maintaining legal and ethical responsibilities.</p><p><br></p><p>ALERRT Active Shooter training is ideal for security officers, guards, school staff, healthcare workers, corporate teams, and individuals preparing for future security roles. Completion of this training increases confidence, readiness, and the ability to act decisively during critical incidents.</p>', 200.00, 50.00, NULL, 10, 2, 'group', 1, 0, 'services/zzHmHY9InmzwDnFkFocKwdNPsTCLP3vNFTmW9ZIm.jpg', 7, 1, NULL, NULL, 0, 0, 0, '2026-01-20 16:43:51', '2026-01-21 13:03:55', NULL, 0),
(20, 'Refuse to be the Victim', NULL, 'NRA personal safety and crime prevention program.', NULL, NULL, '<p><span style=\"color: rgb(71, 85, 105);\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</span></p>', NULL, NULL, NULL, 10, 2, 'group', 0, 0, NULL, 12, 1, 'Refuse to be the Victim', NULL, 0, 0, 0, '2026-01-27 11:47:18', '2026-02-13 18:41:34', '[\"nra\"]', 0),
(26, 'Unarmed Guard Training', NULL, '4-hour comprehensive training program for unarmed security officers.', NULL, NULL, NULL, 100.00, 100.00, NULL, 10, 2, 'group', 0, 0, NULL, 1, 1, 'Unarmed Guard Training', NULL, 0, 0, 0, '2026-01-27 16:32:33', '2026-01-27 18:04:02', '[\"security_training\"]', 0),
(27, 'Armed Security Certification', NULL, 'Complete armed security guard certification program. Available at Location A and Location B.', NULL, NULL, NULL, NULL, NULL, NULL, 10, 2, 'group', 0, 1, NULL, 2, 1, 'Armed Security Certification', NULL, 0, 0, 0, '2026-01-27 16:32:33', '2026-01-27 16:32:33', '[\"security_training\"]', 0),
(30, 'Enhanced Handgun Carry Permit', NULL, 'Tennessee’s Enhanced Handgun Carry Permit course now requires a minimum of 4 hours of classroom instruction plus a live‑fire range component.\r\nMost instructors deliver the class in about 6 hours total. \r\nTraining covers firearm safety, legal responsibilities, carry laws, and a required shooting qualification', '<ul><li>Be a Tennessee resident</li><li>Be at least 21 years old (or 18 if active‑duty military or honorably discharged veteran)</li><li>Provide proof of U.S. citizenship or lawful permanent residency</li></ul><p><br></p><p><strong>&nbsp;Legal Eligibility</strong></p><p>Applicant must NOT:</p><ul><li>Have any felony convictions</li><li>Be under indictment for a felony</li><li>Have domestic violence convictions or pending charges</li><li>Be a fugitive from justice</li><li>Be an unlawful user of controlled substances</li><li>Have recent court‑ordered or voluntary substance‑abuse hospitalization</li><li>(10 years if court‑ordered, 3 years if voluntary)</li><li>Have two DUI convictions within 10 years, with one in the last 5 years</li><li>Be under court jurisdiction for a DUI or Class A misdemeanor</li><li>Have been adjudicated mentally defective, committed, or found to pose a substantial likelihood of harm within the last 7 years</li><li>Have a stalking conviction or pending charge</li><li>Be receiving Social Security disability due to alcohol, drug dependence, or mental disability</li><li>Be subject to an Order of Protection</li><li>Have been dishonorably discharged from the military</li><li>Have renounced U.S. citizenship</li><li>Be an illegal or unlawful alien</li></ul><p><br></p><p><strong>Documentation &amp; Background Check</strong></p><ul><li>Submit fingerprints for TBI background check</li><li>Provide photo ID</li><li>Submit proof of completion of a state‑approved handgun safety course (your updated 4‑hour classroom + range format meets this requirement)</li></ul>', '[]', '<p>The Tennessee Enhanced Handgun Carry Permit course is designed to provide citizens with a comprehensive understanding of handgun safety, legal responsibilities, and practical firearm handling.</p><p>The state now requires a minimum of 4 hours of classroom instruction combined with a mandatory live‑fire range component, resulting in an average total course time of approximately 6 hours, depending on class size and instructor pacing.</p><p><br></p><h3>Classroom Instruction (Minimum 4 Hours)</h3><p><br></p><p>The classroom portion focuses on the knowledge and judgment required to responsibly carry a handgun in Tennessee. Core topics include:</p><ul><li>Firearm safety fundamentals Safe handling, storage, transportation, and accident prevention.</li><li>Handgun operation and maintenance Understanding firearm parts, function, loading/unloading, and basic care</li><li>Tennessee laws governing carry and use of force Legal definitions, prohibited locations, duty to retreat, and lawful self‑defense</li><li>Interactions with law enforcement Best practices during traffic stops and public encounters while carrying.</li><li>Situational awareness and conflict avoidance Recognizing threats, de‑escalation principles, and responsible decision‑making.</li></ul><p><br></p><p><strong>This section ensures students understand not only how to carry a handgun, but when and why it is legally and ethically appropriate to use one.</strong></p><p><strong>&nbsp;Live‑Fire Range Component</strong></p><p><br></p><h3>Purpose of the EHCP Trainin</h3><p><br></p><p>The Enhanced Permit provides the broadest carry privileges in Tennessee and is recognized by more states through reciprocity agreements.&nbsp;</p><p><br></p><p>The course is structured to:</p><ul><li>Build safe, confident handgun carriers</li><li>Ensure students understand Tennessee’s legal framework</li><li>Prepare individuals for responsible concealed or open carry in daily life</li></ul><p><br></p><p><strong>Tennessee Enhanced Handgun Carry Permit – Eligibility Requirements</strong></p><p><br></p><p>To qualify for an EHCP, an applicant must meet all of the following:</p><p><br></p>', NULL, NULL, NULL, 10, 2, 'group', 0, 0, NULL, 7, 1, 'Enhanced Handgun Carry Permit', NULL, 0, 0, 0, '2026-01-27 16:32:33', '2026-03-26 12:30:12', '[\"security_training\"]', 0),
(32, 'New Shooter', NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit,', NULL, NULL, '<p><span style=\"color: rgb(71, 85, 105);\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"</span></p>', NULL, NULL, NULL, 10, 2, 'group', 0, 0, NULL, 0, 1, NULL, NULL, 0, 0, 0, '2026-02-09 18:21:37', '2026-02-13 19:02:43', '[\"nra\"]', 0),
(33, 'Pistol Training', NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit,', NULL, NULL, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"</p>', 100.00, NULL, NULL, 10, 2, 'group', 0, 0, NULL, 0, 1, NULL, NULL, 0, 0, 0, '2026-02-10 16:35:31', '2026-02-13 18:22:18', '[\"nra\"]', 0),
(34, 'Rifle Training', NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit,', NULL, NULL, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', 100.00, NULL, NULL, 10, 2, 'group', 0, 0, NULL, 0, 1, NULL, NULL, 0, 0, 0, '2026-02-10 16:39:12', '2026-02-13 18:23:14', '[\"nra\"]', 0),
(35, 'Shotgun Training', NULL, 'lorem ipsum dolor sit amet, consectetur adipiscing elit,', NULL, NULL, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', 100.00, NULL, NULL, 10, 2, 'group', 0, 0, NULL, 0, 1, NULL, NULL, 0, 0, 0, '2026-02-10 16:42:52', '2026-02-13 18:40:10', '[\"nra\"]', 0),
(37, 'Private Instruction', NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', NULL, NULL, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>', 0.00, NULL, NULL, 10, 2, 'group', 0, 0, NULL, 0, 1, NULL, NULL, 0, 0, 0, '2026-02-10 16:48:31', '2026-02-13 18:42:08', '[\"nra\"]', 0),
(38, 'BLS Blended (BOTH) Hospital/Daycare Security', NULL, 'This Basic Life Support (BLS) certification course provides the training needed to respond to life-threatening emergencies. Individuals will learn high-quality CPR for adults, children, and infants, how to use an AED, and how to relieve choking safely and effectively. The course also covers teamwork during emergencies and how to quickly recognize cardiac arrest and other critical situations.', NULL, '[]', '<p>This Basic Life Support (BLS) certification course provides comprehensive training to help individuals respond quickly and effectively during life-threatening emergencies. The course teaches high-quality CPR for adults, children, and infants, proper use of an Automated External Defibrillator (AED), and safe techniques for relieving choking. Participants will also learn how to recognize cardiac arrest, respiratory distress, and other medical emergencies that require immediate action.</p><p>In addition to hands-on skills, the training emphasizes teamwork, communication, scene safety, and following current emergency response guidelines. Individuals will gain the confidence and knowledge needed to act decisively in workplaces, healthcare settings, schools, and public environments. Upon completion, participants will be better prepared to provide critical lifesaving care until advanced medical help arrives.</p>', 0.00, NULL, NULL, 10, 2, 'group', 0, 0, NULL, 0, 1, NULL, NULL, 0, 0, 0, '2026-02-10 17:19:46', '2026-03-16 12:54:36', '[\"red_cross\"]', 0),
(39, 'First Aid CPR AED Blended', NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', NULL, NULL, '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>', 0.00, NULL, NULL, 10, 2, 'group', 0, 0, NULL, 0, 1, NULL, NULL, 0, 0, 0, '2026-02-10 17:25:03', '2026-02-10 17:37:47', '[\"red_cross\"]', 0),
(41, 'Baton', NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', NULL, NULL, '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 0.00, NULL, NULL, 10, 2, 'group', 0, 0, NULL, 0, 1, NULL, NULL, 0, 0, 0, '2026-02-10 17:39:37', '2026-02-13 18:44:28', '[\"asp_less_than_lethal\"]', 0),
(42, 'Enhanced Handgun Permit', NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', NULL, NULL, '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 0.00, NULL, NULL, 10, 2, 'group', 0, 0, NULL, 0, 1, NULL, NULL, 0, 0, 0, '2026-02-10 17:43:06', '2026-02-13 18:48:07', '[\"homeland_security\"]', 0),
(43, 'Unarmed renewal (2 Year)', NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', NULL, '[]', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 0.00, NULL, NULL, 10, 2, 'group', 0, 0, NULL, 0, 1, NULL, NULL, 0, 0, 0, '2026-02-10 17:46:35', '2026-03-16 13:11:38', '[\"renewals\"]', 0),
(46, 'Restraints', NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', NULL, NULL, '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 0.00, NULL, NULL, 10, 2, 'group', 0, 0, NULL, 0, 1, NULL, NULL, 0, 0, 0, '2026-02-11 11:18:44', '2026-02-11 11:18:44', '[\"asp_less_than_lethal\"]', 0),
(47, 'OC  Spray', NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', NULL, NULL, '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 0.00, NULL, NULL, 10, 2, 'group', 0, 0, NULL, 0, 1, NULL, NULL, 0, 0, 0, '2026-02-11 11:20:31', '2026-02-13 18:46:16', '[\"asp_less_than_lethal\"]', 0),
(48, 'Flashlight', NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', NULL, NULL, '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 0.00, NULL, NULL, 10, 2, 'group', 0, 0, NULL, 0, 1, NULL, NULL, 0, 0, 0, '2026-02-11 11:22:04', '2026-02-13 18:46:58', '[\"asp_less_than_lethal\"]', 0),
(49, 'Active Shooter', NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', NULL, NULL, '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 0.00, NULL, NULL, 10, 2, 'group', 0, 0, NULL, 0, 1, NULL, NULL, 0, 0, 0, '2026-02-11 11:26:18', '2026-02-13 22:19:22', '[\"active_shooter\"]', 0),
(50, 'Unarmed  Security', NULL, 'This unarmed security certification training is for individuals who want to become licensed security guards. The course covers basic security procedures, observation skills, report writing, and state laws. It prepares students to work safely and professionally in unarmed security positions.', NULL, NULL, '<p>This <strong>unarmed security certification</strong> course provides the required training to become a l <strong>certified unarmed security guard</strong>. Individuals will learn essential security procedures, patrol techniques, emergency response protocols, observation and documentation skills, conflict management, and proper report writing. The course also covers state laws, use-of-force guidelines, ethics, and professional standards expected in the security industry.</p><p>Individuals will gain practical knowledge on how to handle real-world situations such as disturbances, suspicious activity, and workplace incidents while maintaining safety and professionalism. By the end of the course, participants will be prepared to perform their duties confidently, responsibly, and effectively in a variety of security settings including offices, retail locations, events, and residential properties.</p>', 0.00, NULL, NULL, 10, 2, 'group', 0, 0, NULL, 0, 1, NULL, NULL, 0, 0, 0, '2026-02-11 11:30:29', '2026-02-25 17:11:14', '[\"security_guard\"]', 0),
(51, 'Armed  Security', NULL, NULL, NULL, NULL, '<p><br></p>', 0.00, NULL, NULL, 10, 2, 'group', 0, 0, NULL, 0, 1, NULL, NULL, 0, 0, 0, '2026-02-11 11:32:27', '2026-02-25 02:39:16', '[\"security_guard\"]', 0),
(53, 'De-escalation', NULL, NULL, NULL, NULL, '<p><br></p>', 0.00, NULL, NULL, 10, 2, 'group', 0, 0, NULL, 0, 1, NULL, NULL, 0, 0, 0, '2026-02-11 11:39:58', '2026-02-25 02:38:19', '[\"dallas_law\"]', 0),
(55, 'First Aid CPR AED', NULL, NULL, NULL, NULL, '<p><br></p>', 0.00, NULL, NULL, 10, 2, 'group', 0, 0, NULL, 0, 1, NULL, NULL, 0, 0, 0, '2026-02-11 11:43:59', '2026-02-25 02:37:44', '[\"dallas_law\"]', 0),
(56, 'Armed guard renewal (2 Year)', NULL, 'Renewing your Tennessee Armed Guard license makes sure you are still trained and ready to carry a firearm while working security. During renewal, you review the laws, re‑qualify with your firearm, and confirm you still meet all state requirements. This process helps keep armed security officers safe, responsible, and prepared to do their job the right way.', NULL, '[]', '<p>Renewing your Tennessee Armed Guard license is an important step that makes sure you stay trained, responsible, and ready to carry a firearm while working security. The state requires armed guards to renew their license every year so they can stay up to date on the laws, safety rules, and skills needed to work with a firearm in public.</p><p>During the renewal process, armed guards review Tennessee use‑of‑force laws, learn about any changes in state regulations, and go over the responsibilities that come with carrying a weapon on duty. A big part of renewal is the annual firearms requalification, where officers must show they can safely handle, load, fire, and control their weapon. This helps prove that the officer can still use their firearm safely and confidently.</p><p>Renewal also confirms that the officer still meets all state requirements, such as having a clean background, being mentally and physically able to perform the job, and following all rules set by Tennessee Private Protective Services. By completing the renewal each year, armed guards show they are committed to professionalism, safety, and protecting the people and property they are assigned to watch.</p>', 70.00, 30.00, NULL, 10, 2, 'group', 0, 0, NULL, 0, 1, NULL, NULL, 0, 0, 0, '2026-02-11 11:46:33', '2026-03-16 13:11:12', '[\"renewals\"]', 0),
(58, 'Enhanced Armed Guard To be Determined', NULL, 'The Enhanced Armed Guard endorsement is required for officers carrying rifles or shotguns on duty. Applicants must have 5 years of full‑time law enforcement experience or 4 years of active‑duty military service in a combat MOS. This endorsement adds advanced firearms training and higher‑level decision‑making standards for elevated‑risk assignments.', NULL, NULL, '<p>The Tennessee Enhanced Armed Guard endorsement is a specialized credential for security professionals who carry rifles or shotguns in the performance of duty. This endorsement reflects a higher level of responsibility, training, and operational readiness than the standard armed guard license. It is designed for officers working in elevated‑risk environments where long‑gun deployment may be necessary, such as critical infrastructure, high‑value asset protection, or specialized response roles.</p><p>Enhanced Armed Guards are expected to demonstrate advanced judgment, disciplined firearm handling, and the ability to operate safely under pressure. The training emphasizes threat assessment, legal considerations, safe long‑gun operation, and the elevated standards required when carrying weapons with greater range, penetration, and tactical impact. Officers learn to evaluate rapidly changing situations, maintain strict muzzle discipline, and apply force only when legally justified and tactically appropriate.</p><p>This endorsement ensures that only individuals with proven high‑risk experience and advanced weapons proficiency are authorized to carry long guns in a security capacity. It reinforces professionalism, accountability, and the heightened expectations placed on officers trusted with greater firepower.</p><p>Eligibility Requirements</p><p>To qualify for the Tennessee Enhanced Armed Guard endorsement, applicants must meet one of the following background requirements:</p><p>• A minimum of 5 years of full‑time law enforcement service, or</p><p>• A minimum of 4 years of active‑duty military service in a combat MOS</p><p>These requirements ensure that Enhanced Armed Guards have real‑world experience in high‑stress environments where disciplined firearm handling and sound judgment are essential.</p><p>Training and Certification Requirements</p><p>Applicants must also hold a valid Tennessee Armed Guard registration, complete the Enhanced Armed Guard training course, pass the written exam, and successfully complete the advanced firearms qualification for long‑gun proficiency. All required state applications and fees must be submitted for approval.</p><p>Why This Endorsement Matters</p><p>The Enhanced Armed Guard credential signals that an officer has proven experience in tactical or high‑risk environments, advanced firearms discipline, and the decision‑making skills needed for elevated‑risk assignments. It is often required for roles involving critical infrastructure, executive protection, high‑value transport, and environments where long‑gun capability is part of the security posture.</p>', 150.00, 30.00, NULL, 10, 2, 'group', 0, 0, NULL, 0, 1, NULL, NULL, 0, 0, 0, '2026-02-11 11:50:20', '2026-02-25 02:23:36', '[\"renewals\"]', 0),
(59, 'Dallas Law renewal (2 year)', NULL, 'Dallas Law requires any security officer working at a Tennessee establishment that serves alcohol to complete additional training in de‑escalation, safe restraint techniques, CPR, and First Aid. This training must be completed within 15 days of assignment and refreshed before renewal to ensure officers can safely manage incidents in alcohol‑related environments.', NULL, '[]', '<p>Dallas Law is a Tennessee statute that establishes enhanced training standards for security officers working in environments where alcohol is served. The law was created to improve safety, reduce unnecessary force, and ensure that officers assigned to bars, restaurants, nightclubs, event venues, and other on‑premises alcohol establishments are properly prepared for the unique risks associated with those settings.</p><p>Under Dallas Law, any armed or unarmed security officer working at an alcohol‑licensed location must complete additional training within 15 days of assignment. This training covers four essential areas: de‑escalation, safe restraint techniques, CPR, and First Aid. These skills address the most common challenges in alcohol‑related environments, where impaired judgment, heightened emotions, and unpredictable behavior can quickly escalate into medical or physical emergencies.</p><p>For annual renewal, officers must show that they have maintained this training and remain current on all Dallas Law requirements. This ensures that personnel working around alcohol can manage confrontations professionally, respond to medical issues effectively, and apply force only when necessary and appropriate. Dallas Law raises the standard of care for security operations in alcohol‑serving establishments and reinforces the officer’s responsibility to protect patrons, staff, and the public</p>', 60.00, 60.00, NULL, 10, 2, 'group', 1, 0, NULL, 0, 1, NULL, NULL, 0, 0, 0, '2026-02-11 11:53:26', '2026-03-16 13:06:29', '[\"renewals\"]', 0),
(60, 'Active Shooter Renewal Annual', NULL, 'A focused refresher course that reinforces critical response principles, threat recognition, rapid decision‑making, and coordinated action during active‑shooter events. Students review updated best practices, strengthen their situational awareness, and practice clear, decisive communication to improve safety and survivability.', NULL, NULL, '<p>Our Active Shooter Annual Renewal course reinforces the critical skills security professionals need to respond decisively during violent‑intruder events. This annual refresher focuses on updated best practices, threat recognition, rapid decision‑making, and coordinated movement under pressure. Students review core response principles, strengthen situational awareness, and practice clear, assertive communication that supports safer outcomes.</p><p>Through scenario‑based discussion and practical application, participants sharpen their ability to assess evolving threats, guide others to safety, and work effectively with responding law enforcement. This course ensures officers remain confident, current, and prepared to act with purpose when seconds matter.</p>', 75.00, 30.00, NULL, 10, 2, 'group', 0, 0, NULL, 0, 1, NULL, NULL, 0, 0, 0, '2026-02-11 11:55:24', '2026-02-25 02:01:04', '[\"renewals\"]', 0),
(61, 'Force Science (De-Escalation)', NULL, 'A focused, scenario‑based class that teaches security officers how to stay calm, read behavior, and guide tense situations toward safe, voluntary compliance. Students learn practical communication skills, proven de‑escalation strategies, and a structured approach they can use immediately on shift.', NULL, NULL, '<p class=\"ql-align-justify\"><br></p><p>Our De‑Escalation Training course gives security officers the practical tools they need to confidently manage tense situations while maintaining safety, professionalism, and control. Built on proven principles from Force Science, behavioral psychology, and real‑world security operations, this class focuses on what officers actually face on shift—not theory, but usable skills.</p><p>Participants learn how to recognize behavioral cues, reduce emotional&nbsp;</p>', 200.00, 30.00, NULL, 10, 2, 'group', 1, 0, NULL, 0, 1, NULL, NULL, 0, 0, 0, '2026-02-12 10:39:28', '2026-02-25 01:57:45', '[\"force_science\"]', 0),
(62, 'Less Lethal', NULL, 'Less‑than‑lethal tools are items security officers use to control someone without using deadly force. These tools are meant to stop a person, slow them down, or protect the officer while causing only temporary pain or discomfort. Common examples include pepper spray, batons, Tasers, and handcuffs. Tennessee requires officers to be trained before they can carry or use any of these tools on duty.', NULL, NULL, '<p>In Tennessee security work, “less‑than‑lethal” refers to tools that are designed to stop or control a person without causing death. These tools give security officers safe options to handle problems before a situation becomes dangerous. They are meant to cause temporary pain, discomfort, or loss of movement so the officer can take control without using deadly force.</p><p>Less‑than‑lethal tools are important because security officers often deal with people who are angry, aggressive, or refusing to follow instructions. These tools help officers protect themselves and others while lowering the chance of serious injury. Common less‑than‑lethal tools include pepper spray, batons, Tasers, and handcuffs. Each tool works in a different way, but all of them are meant to control a person safely and quickly.</p><p>Tennessee requires security officers to be properly trained before they can carry or use any less‑than‑lethal device. Training teaches officers how each tool works, when it is allowed, and how to use it without causing unnecessary harm. Officers also learn the laws about force, how to give clear commands, and how to check on a person after the tool is used.</p><p>Less‑than‑lethal tools help officers stay professional, make good decisions, and keep situations from getting out of control. By using these tools correctly, security officers can protect people, avoid injuries, and handle problems in a safe and responsible way.</p>', NULL, NULL, NULL, 10, 2, 'group', 0, 0, NULL, 0, 1, NULL, NULL, 0, 0, 0, '2026-02-25 02:37:00', '2026-02-25 02:37:00', NULL, 0),
(63, 'bloodborne pathogens', NULL, 'Lorem Ipsum is a standard placeholder text used in the printing and typesetting industry, originating from a Latin text by Cicero, and serves to create a natural-looking block of text for design layouts.', NULL, '[]', '<p><strong>Lorem&nbsp;Ipsum&nbsp;is&nbsp;a&nbsp;standard&nbsp;placeholder&nbsp;text&nbsp;used&nbsp;in&nbsp;the&nbsp;printing&nbsp;and&nbsp;typesetting&nbsp;industry,&nbsp;originating&nbsp;from&nbsp;a&nbsp;Latin&nbsp;text&nbsp;by&nbsp;Cicero,&nbsp;and&nbsp;serves&nbsp;to&nbsp;create&nbsp;a&nbsp;natural-looking&nbsp;block&nbsp;of&nbsp;text&nbsp;for&nbsp;design&nbsp;layouts.</strong><span class=\"ql-cursor\">﻿﻿</span></p>', 0.00, NULL, NULL, 10, 2, 'group', 0, 0, NULL, 0, 1, NULL, NULL, 0, 0, 0, '2026-03-06 12:44:42', '2026-03-16 12:55:40', NULL, 0),
(64, 'Babysitting & Childcare', NULL, 'Lorem Ipsum is a standard placeholder text used in the printing and typesetting industry, originating from a Latin text by Cicero, and serves to create a natural-looking block of text for design layouts.', NULL, '[]', '<p>Lorem Ipsum is a standard placeholder text used in the printing and typesetting industry, originating from a Latin text by Cicero, and serves to create a natural-looking block of text for design&nbsp;</p>', 0.00, NULL, NULL, 10, 2, 'group', 0, 0, NULL, 0, 1, NULL, NULL, 0, 0, 0, '2026-03-06 12:45:54', '2026-03-16 12:56:11', NULL, 0),
(65, 'ASP 4hr (less than lethal)', 'asp-4-hr', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', NULL, '[\"Flashlight\",\"OC Spray\",\"Baton\",\"Restrains\"]', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 100.00, NULL, NULL, 20, 10, 'one-on-one', 0, 0, NULL, 27, 1, 'Molestiae delectus', 'Location A', 0, 0, 0, '2026-03-10 17:02:36', '2026-03-10 17:58:18', NULL, 0),
(66, 'adasdasdasd', 'adasdasdasd', 'adasdasdasd', NULL, '[\"asdasdasd\",\"asdasdasdasdasd\",\"asdasdasdasdasdsad\"]', '<p>adasdasdasd</p>', 10.00, 20.00, NULL, 10, 1, 'one-on-one', 0, 0, NULL, 1, 1, NULL, 'Location A', 0, 0, 0, '2026-03-10 17:28:34', '2026-03-10 17:28:34', NULL, 0),
(67, 'Homeland security (6hr)', 'homeland-security', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', NULL, '[\"Enhanced handgun permit\"]', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 100.00, NULL, NULL, 10, 1, 'group', 0, 0, NULL, 0, 1, NULL, NULL, 0, 0, 0, '2026-03-10 18:02:01', '2026-03-10 18:02:31', NULL, 0),
(68, 'Active Shooter (8hr)', 'active-shooter', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', NULL, '[]', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 100.00, NULL, NULL, 10, 1, 'group', 0, 0, NULL, 0, 1, NULL, NULL, 0, 0, 0, '2026-03-10 18:04:43', '2026-03-10 18:04:43', NULL, 0),
(69, 'Forced science De-escalation', 'forced-science-de-escalation', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', NULL, '[]', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 100.00, NULL, NULL, 10, 1, 'group', 0, 0, NULL, 0, 1, NULL, NULL, 0, 0, 0, '2026-03-10 18:06:49', '2026-03-10 18:06:49', NULL, 0),
(70, 'Dallas Law', 'dallas-law', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', NULL, '[\"First aid CPR AED\",\"De-escalation\",\"Restrains\"]', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 100.00, NULL, NULL, 10, 1, 'group', 0, 0, NULL, 0, 1, NULL, NULL, 0, 0, 0, '2026-03-10 18:09:23', '2026-03-10 18:09:23', NULL, 0),
(71, 'Enhanced armed guard (1 Year)', NULL, NULL, NULL, '[]', NULL, NULL, NULL, NULL, 10, 1, 'group', 0, 0, NULL, 0, 1, NULL, NULL, 0, 0, 0, '2026-03-16 13:01:25', '2026-03-16 13:01:25', NULL, 0),
(72, 'Initial armed security (2 Years)', NULL, NULL, NULL, '[]', NULL, NULL, NULL, NULL, 10, 1, 'group', 0, 0, NULL, 0, 1, NULL, NULL, 0, 0, 0, '2026-03-16 13:01:56', '2026-03-16 13:01:56', NULL, 0),
(73, 'Initial unarmed security (2 Years)', NULL, NULL, NULL, '[]', NULL, NULL, NULL, NULL, 10, 1, 'group', 0, 0, NULL, 0, 1, NULL, NULL, 0, 0, 0, '2026-03-16 13:02:31', '2026-03-16 13:02:31', NULL, 0),
(74, 'Initial Dallas Law (2 Years)', NULL, NULL, NULL, '[]', NULL, NULL, NULL, NULL, 10, 1, 'group', 0, 0, NULL, 0, 1, NULL, NULL, 0, 0, 0, '2026-03-16 13:02:53', '2026-03-16 13:02:53', NULL, 0),
(75, 'Initial Active shooter (1 Year)', NULL, NULL, NULL, '[]', NULL, NULL, NULL, NULL, 10, 1, 'group', 0, 0, NULL, 0, 1, NULL, NULL, 0, 0, 0, '2026-03-16 13:03:15', '2026-03-16 13:03:15', NULL, 0),
(76, 'Initial BLS(Basic Life Support Hospital)  2 Years', NULL, NULL, NULL, '[]', NULL, NULL, NULL, NULL, 10, 1, 'group', 0, 0, NULL, 0, 1, NULL, NULL, 0, 0, 0, '2026-03-16 13:04:08', '2026-03-16 13:04:28', NULL, 0),
(77, 'Less than Lethal (1 Time as long as you have the Certificate)', NULL, NULL, NULL, '[]', NULL, NULL, NULL, NULL, 10, 1, 'group', 0, 0, NULL, 0, 1, NULL, NULL, 0, 0, 0, '2026-03-16 13:05:06', '2026-03-16 13:05:06', NULL, 0),
(78, 'Active shooter (1 Year)', NULL, NULL, NULL, '[]', NULL, NULL, NULL, NULL, 10, 1, 'group', 0, 0, NULL, 0, 1, NULL, NULL, 0, 0, 0, '2026-03-16 13:05:50', '2026-03-16 13:05:50', NULL, 0),
(79, 'Enhanced armed guard (1 Year)', NULL, NULL, NULL, '[]', NULL, NULL, NULL, NULL, 10, 1, 'group', 0, 0, NULL, 0, 1, NULL, NULL, 0, 0, 0, '2026-03-16 13:07:04', '2026-03-16 13:07:04', NULL, 0),
(80, 'BLS Renewal (Hospital 2 Year)', NULL, NULL, NULL, '[]', NULL, NULL, NULL, NULL, 10, 1, 'group', 0, 0, NULL, 0, 1, NULL, NULL, 0, 0, 0, '2026-03-16 13:12:05', '2026-03-16 13:12:05', NULL, 0),
(81, 'First AID CPR AED (2 Year )', NULL, NULL, NULL, '[]', NULL, NULL, NULL, NULL, 10, 1, 'group', 0, 0, NULL, 0, 1, NULL, NULL, 0, 0, 0, '2026-03-16 13:12:32', '2026-03-16 13:12:32', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `service_bookings`
--

CREATE TABLE `service_bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `booking_date` date NOT NULL,
  `booking_time` time DEFAULT NULL,
  `status` enum('pending','confirmed','completed','cancelled') NOT NULL DEFAULT 'pending',
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `class_schedule_id` bigint(20) UNSIGNED DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `deposit_amount` decimal(10,2) DEFAULT NULL,
  `remaining_amount` decimal(10,2) DEFAULT NULL,
  `payment_status` enum('pending','deposit_paid','fully_paid','refunded') NOT NULL DEFAULT 'pending',
  `booking_type` enum('group','one-on-one') NOT NULL DEFAULT 'group',
  `number_of_students` int(11) NOT NULL DEFAULT 1,
  `group_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_bookings`
--

INSERT INTO `service_bookings` (`id`, `customer_id`, `service_id`, `booking_date`, `booking_time`, `status`, `notes`, `created_at`, `updated_at`, `class_schedule_id`, `location`, `total_amount`, `deposit_amount`, `remaining_amount`, `payment_status`, `booking_type`, `number_of_students`, `group_name`) VALUES
(1, 2, 1, '2026-01-22', '11:11:00', 'completed', 'Testing', '2026-01-20 18:20:37', '2026-01-21 14:42:13', 7, NULL, 380.00, 40.00, 340.00, 'deposit_paid', 'group', 4, 'Team 2'),
(2, 3, 7, '2026-01-23', '15:21:00', 'confirmed', NULL, '2026-01-21 10:55:00', '2026-01-21 10:55:21', 5, NULL, 400.00, 100.00, 300.00, 'deposit_paid', 'group', 2, NULL),
(3, 2, 26, '2026-01-29', '03:50:00', 'confirmed', NULL, '2026-01-28 13:02:14', '2026-01-28 13:02:30', 13, 'Location B', 300.00, 300.00, 0.00, 'deposit_paid', 'group', 3, 'Test'),
(4, 4, 35, '2026-02-17', NULL, 'pending', NULL, '2026-02-17 21:42:20', '2026-02-17 21:42:20', NULL, NULL, 100.00, 20.00, 80.00, 'pending', 'group', 1, 'Arthur Stewart'),
(5, 5, 35, '2026-02-17', NULL, 'confirmed', NULL, '2026-02-17 21:44:38', '2026-02-17 21:45:33', NULL, NULL, 1700.00, 20.00, 1680.00, 'deposit_paid', 'group', 17, 'Zachary Petty'),
(6, 5, 35, '2026-02-17', NULL, 'pending', NULL, '2026-02-17 21:54:15', '2026-02-17 21:54:15', NULL, NULL, 1700.00, 20.00, 1680.00, 'pending', 'group', 17, 'Zachary Petty'),
(7, 7, 53, '2026-02-25', NULL, 'pending', NULL, '2026-02-25 17:10:44', '2026-02-25 17:10:44', NULL, NULL, 0.00, 20.00, -20.00, 'pending', 'group', 1, 'Reese Huff'),
(8, 7, 49, '2026-02-25', NULL, 'pending', NULL, '2026-02-25 17:20:31', '2026-02-25 17:20:31', NULL, NULL, 0.00, 20.00, -20.00, 'pending', 'group', 19, 'Leroy Atkinson'),
(9, 9, 42, '2026-02-26', NULL, 'pending', NULL, '2026-02-26 15:53:10', '2026-02-26 15:53:10', NULL, NULL, 0.00, 20.00, -20.00, 'pending', 'group', 19, 'Ralph Price'),
(10, 10, 49, '2026-03-06', NULL, 'pending', NULL, '2026-03-06 13:35:13', '2026-03-06 13:35:13', NULL, NULL, 0.00, 20.00, -20.00, 'pending', 'group', 16, 'Tatiana Boyd'),
(11, 13, 65, '2026-03-10', NULL, 'pending', NULL, '2026-03-10 17:21:42', '2026-03-10 17:21:42', NULL, NULL, 6422.00, 20.00, 6402.00, 'pending', 'one-on-one', 19, 'Amos Carson');

-- --------------------------------------------------------

--
-- Table structure for table `service_relationships`
--

CREATE TABLE `service_relationships` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_service_id` bigint(20) UNSIGNED NOT NULL,
  `linked_service_id` bigint(20) UNSIGNED NOT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
('7ZNMlVrDA9BctBpGfPtgj8EGF1nhbdSPYcz7Jhv4', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUlZGY1Q3WnplMmpMYjRzQnlVNmQ2RVV5Rnd3bnVnTEJNUW1LYldWaiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC90cmFpbmluZy1zZXJ2aWNlcy8zMCI7czo1OiJyb3V0ZSI7czoxNToic2VydmljZS5kZXRhaWxzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1774546264);

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE `site_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `header_logo` varchar(255) DEFAULT NULL,
  `footer_logo` varchar(255) DEFAULT NULL,
  `favicon` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `facebook_url` varchar(255) DEFAULT NULL,
  `twitter_url` varchar(255) DEFAULT NULL,
  `instagram_url` varchar(255) DEFAULT NULL,
  `linkedin_url` varchar(255) DEFAULT NULL,
  `youtube_url` varchar(255) DEFAULT NULL,
  `quickbooks_client_id` varchar(255) DEFAULT NULL,
  `quickbooks_client_secret` varchar(255) DEFAULT NULL,
  `quickbooks_company_id` varchar(255) DEFAULT NULL,
  `quickbooks_environment` varchar(255) DEFAULT 'sandbox',
  `quickbooks_access_token` text DEFAULT NULL,
  `quickbooks_refresh_token` text DEFAULT NULL,
  `quickbooks_enabled` tinyint(1) NOT NULL DEFAULT 0,
  `bank_api_provider` varchar(255) DEFAULT NULL,
  `bank_api_key` varchar(255) DEFAULT NULL,
  `bank_api_secret` varchar(255) DEFAULT NULL,
  `bank_account_id` varchar(255) DEFAULT NULL,
  `bank_sync_enabled` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `jayson_bio` text DEFAULT NULL,
  `kenny_bio` text DEFAULT NULL,
  `square_application_id` varchar(255) DEFAULT NULL,
  `square_access_token` varchar(255) DEFAULT NULL,
  `square_location_id` varchar(255) DEFAULT NULL,
  `square_environment` varchar(255) DEFAULT 'sandbox',
  `square_enabled` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `header_logo`, `footer_logo`, `favicon`, `phone`, `email`, `address`, `facebook_url`, `twitter_url`, `instagram_url`, `linkedin_url`, `youtube_url`, `quickbooks_client_id`, `quickbooks_client_secret`, `quickbooks_company_id`, `quickbooks_environment`, `quickbooks_access_token`, `quickbooks_refresh_token`, `quickbooks_enabled`, `bank_api_provider`, `bank_api_key`, `bank_api_secret`, `bank_account_id`, `bank_sync_enabled`, `created_at`, `updated_at`, `jayson_bio`, `kenny_bio`, `square_application_id`, `square_access_token`, `square_location_id`, `square_environment`, `square_enabled`) VALUES
(1, 'settings/Hr1zWU5e8KXGwR6ksSRh0li1BRwSLsAR9jC5tXcJ.png', 'settings/CHrF1S5YNXUm3ANzPze9yVyMyfOBBL4gIMG3Q0pI.png', 'settings/g5SK3CyFpOJl76qSj4ptrkOCLzWo4RqpKJ2PtfZn.png', '615-554-1131', 'tnvetsecsvctrng@gmail.com', '123 Security Way,\r\nNashville, TN 37201', NULL, NULL, NULL, NULL, NULL, 'AB0rfAJ4fBfjUdm23xtDaBr8R95pzD0D0MNqeSGuvsVpURht4a', 'l6vtWPm9Q8RuJlLxy1T0gSX9vIt6mD0EY2S3tj9L', '9341456376232298', 'sandbox', 'eyJhbGciOiJkaXIiLCJlbmMiOiJBMTI4Q0JDLUhTMjU2IiwieC5vcmciOiJIMCJ9..H_aMQbTVzrj71B3WB69u2w.TemqvqQvKtWfUQPhHoQz8gBSxxSsMnHdAlQ_8VyYL-ymH_x-PXdUZZVDOuBun-U9F0y-YZ0cgQYJF3fkCaUDeJMp_C-nfQ2G4U3dTxbY2UbKapQh6CkPaMa046E194K_xPdd9FLkqMwPYyzPEWPsCuKcUBqaqyDBdWBljDnaYIunejHSOLxZPIA_wDYk3eeNc3XI-i_np9ajelrOBFOWkrdYk18om-gim61YLGy5x1QbFAgloKP4vVSREYiBG1reiD3ZnpYevmqjWyQSnD0FqUwmy7MdanGpaG0hlcuudEpAzM7--GL9WtGswZwPW7UT9YGSi7UcEafrqhr7gnJrd4jYvA9FNkmvPq0SLbWM2Wje6yqUWh0Ix7t0uk9YwBNjeDQGZO82mzik_IFnclETtJ7iyjxUfdDKf0sw0Mxmfa8hCY0iRH8E0xavrJxmKDoBBlaVolSX8TvBa_9nUn3VS9ePnuBi9ihUuDk2eAXrSnFhOKgDUCPq9sZJvV-2XvSS.XnN4qGys5_gx1rs5IL2-JA', 'RT1-145-H0-17819077230l560pd8api6uap2x072', 1, NULL, NULL, NULL, NULL, 0, '2026-01-12 13:30:50', '2026-03-10 17:22:03', NULL, NULL, NULL, NULL, NULL, 'sandbox', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `profile_picture`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'admin@admin.com', 'profiles/aZVVys5VZTiQrbnCNflIkXtIvgaYmeWZNdtpnYuj.jpg', NULL, '$2y$12$T9.zhU.ZeaSdCwIQi2RaWO78E.qibh7giBZyXVvcQ8jSwuWmXWAZa', 'cmuWHy1trtVvTwVxRKA9VGsiFMjbqaWqYpsTlD6ZDQtNnoYHucTagHz6PZhJ', '2026-01-12 12:47:43', '2026-01-12 13:46:52');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `class_schedules`
--
ALTER TABLE `class_schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_schedules_class_date_start_time_index` (`class_date`,`start_time`),
  ADD KEY `class_schedules_service_id_class_date_index` (`service_id`,`class_date`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_email_unique` (`email`);

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
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `payments_transaction_id_unique` (`transaction_id`),
  ADD KEY `payments_booking_id_status_index` (`booking_id`,`status`),
  ADD KEY `payments_customer_id_payment_date_index` (`customer_id`,`payment_date`),
  ADD KEY `payments_transaction_id_index` (`transaction_id`);

--
-- Indexes for table `security_company_links`
--
ALTER TABLE `security_company_links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `services_slug_unique` (`slug`);

--
-- Indexes for table `service_bookings`
--
ALTER TABLE `service_bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_bookings_customer_id_foreign` (`customer_id`),
  ADD KEY `service_bookings_service_id_foreign` (`service_id`),
  ADD KEY `service_bookings_class_schedule_id_foreign` (`class_schedule_id`);

--
-- Indexes for table `service_relationships`
--
ALTER TABLE `service_relationships`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `service_relationships_parent_service_id_linked_service_id_unique` (`parent_service_id`,`linked_service_id`),
  ADD KEY `service_relationships_linked_service_id_foreign` (`linked_service_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `class_schedules`
--
ALTER TABLE `class_schedules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `security_company_links`
--
ALTER TABLE `security_company_links`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `service_bookings`
--
ALTER TABLE `service_bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `service_relationships`
--
ALTER TABLE `service_relationships`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=166;

--
-- AUTO_INCREMENT for table `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `class_schedules`
--
ALTER TABLE `class_schedules`
  ADD CONSTRAINT `class_schedules_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `service_bookings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payments_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `service_bookings`
--
ALTER TABLE `service_bookings`
  ADD CONSTRAINT `service_bookings_class_schedule_id_foreign` FOREIGN KEY (`class_schedule_id`) REFERENCES `class_schedules` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `service_bookings_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `service_bookings_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `service_relationships`
--
ALTER TABLE `service_relationships`
  ADD CONSTRAINT `service_relationships_linked_service_id_foreign` FOREIGN KEY (`linked_service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `service_relationships_parent_service_id_foreign` FOREIGN KEY (`parent_service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
