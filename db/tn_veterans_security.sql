-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Jan 12, 2026 at 09:56 PM
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
-- Database: `tn_veterans_security`
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
(7, '2026_01_12_183941_add_profile_picture_to_users_table', 5);

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
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `short_description` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `title`, `short_description`, `description`, `image`, `order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Security Officers/Guard Training', 'Professional training programs designed to prepare security officers with the skills, knowledge, and confidence required to protect people, property, and assets effectively.', '<p>Our <strong>Security Officers/Guard Training</strong> program provides comprehensive, hands-on instruction for individuals seeking to start or advance a career in the security industry. The training focuses on essential skills required to perform duties professionally, responsibly, and in compliance with industry standards.</p><p>Participants are trained in areas such as access control, patrol procedures, emergency response, incident reporting, conflict management, communication skills, and legal responsibilities. Emphasis is placed on situational awareness, professionalism, ethical conduct, and customer service to ensure guards can operate effectively in a wide range of environments, including commercial properties, residential communities, events, and corporate facilities.</p><p>The program combines practical exercises with classroom-based learning to build confidence, discipline, and readiness for real-world security situations. Upon completion, trainees are better equipped to handle security challenges, reduce risks, and maintain a safe and secure environment.</p>', 'services/5yWOOMMVrWGOacnfvyEAQEumb013QOX4HeiS4KAn.png', 1, 1, '2026-01-12 12:52:47', '2026-01-12 13:02:53'),
(2, 'Red Cross Training', 'Certified Red Cross training programs that teach life-saving skills such as first aid, CPR, and emergency response.', '<p>Our <strong>Red Cross Training</strong> program offers essential, internationally recognized instruction designed to equip individuals with critical life-saving skills. This training is ideal for security personnel, workplace teams, caregivers, and individuals who want to be prepared for medical emergencies.</p><p>Participants receive hands-on training in first aid, CPR, AED usage, bleeding control</p>', 'services/2Goip8r2rNF7oOWbng0T0ozEcRMMfr8TQFlmrwgp.png', 2, 1, '2026-01-12 13:00:45', '2026-01-12 13:11:41'),
(3, 'ASP Instructor Training (Baton & Control)', 'Advanced instructor-level training focused on baton handling, control techniques, and safe use-of-force practices.', '<p>Our <strong>ASP Instructor Training (Baton &amp; Control)</strong> program is designed to certify professionals in the proper instruction and application of baton and control techniques. This training emphasizes defensive tactics, subject control, and safe, lawful use-of-force methods in accordance with industry standards.</p><p>Participants learn advanced baton handling skills, control and restraint techniques, escalation and de-escalation strategies, and instructional methodologies required to train others effectively. The course also covers legal considerations, officer safety, risk management, and injury prevention to ensure responsible and professional application in real-world situations.</p><p>This program is ideal for security supervisors, law enforcement trainers, and experienced security officers seeking to become certified instructors capable of delivering high-quality baton and control training while maintaining safety, compliance, and professionalism.</p>', 'services/BkxqE6w72S4gcPBjXi06KoDngDnDNdh1cV4KJlne.png', 3, 1, '2026-01-12 13:13:46', '2026-01-12 13:13:46'),
(4, 'NRA Firearms Instructor Training', 'Certified NRA instructor training designed to prepare professionals to safely teach firearms handling, marksmanship, and firearm safety.', '<p>Our <strong>NRA Firearms Instructor Training</strong> program is a nationally recognized course designed to certify qualified individuals as professional firearms instructors. The training focuses on firearm safety, proper handling, marksmanship fundamentals, and effective teaching methodologies in accordance with NRA standards.</p><p><br></p><p>Participants receive in-depth instruction on safe firearm operation, range safety management, legal responsibilities, risk awareness, and lesson planning. The program also emphasizes instructional skills, including communication techniques, student evaluation, and classroom and range management to ensure instructors can train others responsibly and effectively.</p><p><br></p><p>This training is ideal for security professionals, law enforcement personnel, range staff, and experienced firearm users seeking official NRA instructor certification. Upon completion, graduates are equipped to deliver high-quality, safety-focused firearms training while maintaining compliance, professionalism, and strict safety standards.</p>', 'services/cWCypdvo7XIvtjaMd9dMDeyK6uPaqJOE73KjbKgh.png', 4, 1, '2026-01-12 13:14:51', '2026-01-12 13:14:51'),
(5, 'State of Tennessee Certified Handgun Instructor Training', 'State-certified training program that prepares qualified individuals to become approved handgun instructors in Tennessee.', '<p>Our <strong>State of Tennessee Certified Handgun Instructor Training</strong> program is designed to prepare experienced firearm professionals to meet the requirements for state certification as handgun instructors. This course focuses on firearm safety, handgun operation, marksmanship fundamentals, and instructional techniques in compliance with Tennessee state regulations.</p><p><br></p><p>Participants receive detailed instruction on state handgun laws, safe handling and storage practices, use-of-force considerations, range safety management, and student evaluation methods. The program also emphasizes effective teaching skills, lesson planning, and responsible instruction to ensure instructors can confidently train others in both classroom and live-fire environments.</p><p><br></p><p>This training is ideal for security professionals, law enforcement personnel, firearms instructors, and qualified individuals seeking official state certification. Upon completion, graduates are equipped to deliver professional, lawful, and safety-focused handgun training that meets Tennessee state standards.</p>', 'services/R6rhHrj0MKoSGdIpLez3YfakT4oq6rSPMO3JzZZf.png', 5, 1, '2026-01-12 13:15:47', '2026-01-12 13:15:47'),
(6, 'De-Escalation Training', 'Practical training focused on communication and behavioral techniques to safely reduce conflict and prevent escalation.', '<p>Our <strong>De-Escalation Training</strong> program equips individuals with proven strategies to recognize, manage, and defuse potentially volatile situations before they escalate into violence. This training emphasizes communication, emotional intelligence, situational awareness, and behavioral control to promote safety for both professionals and the public.</p><p><br></p><p>Participants learn verbal and non-verbal communication techniques, threat recognition, stress management, and conflict resolution strategies. The course also covers cultural awareness, crisis intervention principles, and decision-making under pressure, helping trainees respond effectively to challenging interactions.</p><p><br></p><p>This training is ideal for security officers, law enforcement, healthcare workers, educators, and customer-facing professionals who regularly interact with the public. Upon completion, participants are better prepared to maintain control, reduce risk, and resolve conflicts professionally and safely.</p>', 'services/6SiLr4iMwGwEoSzpEr0dfSynESv5yWtnVDRufBbt.png', 6, 1, '2026-01-12 13:18:51', '2026-01-12 13:18:51');

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `header_logo`, `footer_logo`, `favicon`, `phone`, `email`, `address`, `facebook_url`, `twitter_url`, `instagram_url`, `linkedin_url`, `youtube_url`, `created_at`, `updated_at`) VALUES
(1, 'settings/TrtiBGfNvMfJq1Wwx2PH8MQ869j9v3haDZgKuRY6.png', 'settings/rJPKZxg7wHlfj0mapTu5WaJLIatsXchwYMbgavnS.png', 'settings/1FYglKr8Td9AHyiuLjP5f3qLtyormikwBSTvXhxp.png', '615-554-1131', 'tnvetsecsvctrng@gmail.com', '123 Security Way,\r\nNashville, TN 37201', NULL, NULL, NULL, NULL, NULL, '2026-01-12 13:30:50', '2026-01-12 13:35:36');

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
(1, 'Super Admin', 'admin@admin.com', 'profiles/aZVVys5VZTiQrbnCNflIkXtIvgaYmeWZNdtpnYuj.jpg', NULL, '$2y$12$T9.zhU.ZeaSdCwIQi2RaWO78E.qibh7giBZyXVvcQ8jSwuWmXWAZa', 'H5L9WniIQK97OFYGlYoJvSm7yZOqN9Wkk2MjyEljvMNwUJzwxKgdKO6JS0Pw', '2026-01-12 12:47:43', '2026-01-12 13:46:52');

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
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
