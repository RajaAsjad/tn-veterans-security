-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Jan 21, 2026 at 08:43 PM
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

INSERT INTO `class_schedules` (`id`, `service_id`, `class_date`, `start_time`, `end_time`, `duration_hours`, `max_students`, `min_students`, `current_students`, `room`, `instructor`, `can_overlap`, `status`, `notes`, `created_at`, `updated_at`) VALUES
(4, 7, '2026-01-22', '12:12:00', '20:12:00', 8, 10, 2, 0, 'Class A 03', 'Jayson Wheat', 1, 'scheduled', 'Testing', '2026-01-20 17:38:22', '2026-01-20 17:38:22'),
(5, 7, '2026-01-23', '15:21:00', '23:21:00', 8, 10, 2, 2, 'Class A 03', 'Jayson Wheat', 1, 'scheduled', 'Testing', '2026-01-20 17:38:22', '2026-01-21 10:55:00'),
(6, 7, '2026-01-27', '08:42:00', '16:42:00', 8, 10, 2, 0, 'Class A 03', 'Jayson Wheat', 1, 'scheduled', 'Testing', '2026-01-20 17:38:22', '2026-01-20 17:38:22'),
(7, 1, '2026-01-22', '11:11:00', '16:11:00', 5, 8, 4, 0, 'Class A 7', 'Jayson', 1, 'scheduled', 'test', '2026-01-20 17:45:12', '2026-01-21 14:42:14'),
(8, 1, '2026-01-24', '07:50:00', '15:50:00', 8, 10, 2, 0, 'class A 09', 'Jayson ww', 1, 'scheduled', 'testing', '2026-01-20 17:45:50', '2026-01-20 17:45:50'),
(9, 3, '2026-01-23', '16:00:00', '08:00:00', 16, 10, 1, 0, '32123', 'Jack', 1, 'scheduled', NULL, '2026-01-21 13:34:30', '2026-01-21 13:34:30'),
(10, 2, '2026-01-30', '17:00:00', '01:00:00', 8, 10, 2, 0, 'Class A17', 'Jack son', 1, 'scheduled', NULL, '2026-01-21 13:36:22', '2026-01-21 13:36:22'),
(11, 2, '2026-01-31', '18:00:00', '02:00:00', 8, 10, 2, 0, 'Class A17', 'Jack son', 1, 'scheduled', NULL, '2026-01-21 13:36:22', '2026-01-21 13:36:22');

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
(3, 'Jack', 'jack@gemail.com', '$2y$12$qd5xtI0IzfwvE5CUrR2hNeObl5hHF1zY1LkjVodoi/wZ3H/EX/Qzi', '1231231231', '44075 Pipeline Plaza Ste. 132', NULL, NULL, NULL, '2026-01-21 10:35:40', '2026-01-21 10:35:40');

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
(14, '2026_01_21_184933_add_api_keys_to_site_settings_table', 8);

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
(2, 2, 3, 100.00, 'deposit', 'credit_card', 'completed', '1231231231111111', NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, '2026-01-21', '2026-01-21 10:55:21', '2026-01-21 10:55:21');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `short_description` text DEFAULT NULL,
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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `title`, `short_description`, `description`, `price`, `deposit_amount`, `duration_hours`, `max_students`, `min_students`, `class_type`, `has_online_parts`, `testing_in_person`, `image`, `order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Armed Security Certification', 'Armed Security Certification provides advanced training in firearm safety, legal use of force, and tactical response for professional armed security roles.', '<p>Armed Security Certification is an advanced training program designed for individuals pursuing or currently working in armed security positions. This certification equips participants with the knowledge, skills, and discipline required to carry and use firearms responsibly while performing protective duties.</p><p><br></p><p>The program covers firearm safety, weapons handling, marksmanship fundamentals, and safe storage, along with critical instruction on use-of-force laws, legal responsibilities, and ethical decision-making. Participants receive scenario-based training to develop judgment, threat assessment, and controlled response under high-stress conditions.</p><p><br></p><p>Additional focus areas include defensive tactics, situational awareness, communication, and coordination with law enforcement and emergency responders. Emphasis is placed on professionalism, accountability, and compliance with state and employer regulations.</p><p><br></p><p>Armed Security Certification is ideal for security professionals seeking armed assignments in corporate, residential, event, or high-risk environments. Completion of this training demonstrates readiness, competence, and commitment to maintaining the highest standards of safety and professionalism in armed protective services.</p>', 95.00, 10.00, NULL, 10, 2, 'group', 1, 0, 'services/gV79EbBPvkL16BCvQpqhb9gatnK9A8slmsv2OhsR.jpg', 1, 1, '2026-01-12 12:52:47', '2026-01-21 12:52:40'),
(2, 'Force Science (De-escalation)', 'Force Science (De-escalation) training teaches evidence-based techniques to reduce conflict, manage behavior, and safely resolve high-stress encounters.', '<p>Force Science (De-escalation) training is a research-driven program focused on understanding human behavior, stress responses, and decision-making during high-risk or emotionally charged situations. This training equips participants with proven de-escalation strategies to prevent situations from escalating into physical force.</p><p><br></p><p>The course emphasizes verbal communication skills, body language awareness, distance management, and emotional regulation to influence behavior and maintain control. Participants learn how stress, perception, and cognitive limitations affect both responders and subjects, enabling safer and more effective interactions.</p><p><br></p><p>Scenario-based training reinforces practical application, teaching participants how to recognize warning signs, apply tactical patience, and choose appropriate responses while remaining legally and ethically compliant. The program also addresses use-of-force decision-making, accountability, and post-incident considerations.</p><p><br></p><p>Force Science (De-escalation) training is ideal for security officers, guards, supervisors, and individuals preparing for future security careers. It promotes professionalism, safety, and confidence while reducing risk, liability, and unnecessary use of force in protective service environments.</p>', 200.00, 100.00, NULL, 10, 2, 'group', 1, 0, 'services/lu6mY6GfYotlfByxzKUFWSukJnAC0U7JU5BTDtDD.jpg', 3, 1, '2026-01-12 13:00:45', '2026-01-21 12:58:40'),
(3, 'ASP (Batons and Restraints)', 'ASP (Batons and Restraints) training teaches proper baton use and restraint techniques for safely controlling and managing resistant or aggressive individuals.', '<p>ASP (Batons and Restraints) training provides essential instruction in the safe, legal, and effective use of expandable batons and restraint devices for security and protective service professionals. This program emphasizes control, officer safety, and minimizing injury while managing confrontational or non-compliant situations.</p><p><br></p><p>Participants learn correct baton handling, striking zones, defensive techniques, and retention methods, along with proper application of restraints such as handcuffs and control devices. The training includes use-of-force guidelines, legal considerations, and decision-making to ensure actions are justified, proportional, and compliant with industry standards.</p><p><br></p><p>Scenario-based exercises help develop practical skills in de-escalation, subject control, team coordination, and situational awareness. Strong emphasis is placed on professionalism, accountability, and post-incident procedures, including reporting and subject care.</p><p><br></p><p>This training is ideal for security officers, guards, and individuals preparing for future security roles who require intermediate force options to maintain safety and control in dynamic environments.</p>', 100.00, 50.00, NULL, 10, 2, 'group', 0, 0, 'services/BkxqE6w72S4gcPBjXi06KoDngDnDNdh1cV4KJlne.png', 2, 1, '2026-01-12 13:13:46', '2026-01-21 12:55:06'),
(4, 'NRA (Advanced Handgun Carry)', 'NRA Advanced Handgun Carry training develops advanced handgun skills, defensive carry techniques, and responsible decision-making for armed professionals and qualified civilians.', '<p>NRA Advanced Handgun Carry is an advanced-level firearms training program designed to enhance defensive handgun proficiency for individuals who carry a firearm for personal protection or professional duties. This course builds on fundamental handgun skills and focuses on real-world defensive carry scenarios.</p><p><br></p><p>Training includes advanced marksmanship, drawing from concealment, movement, use of cover, threat assessment, and defensive shooting techniques. Strong emphasis is placed on firearm safety, legal considerations, and responsible use of force in accordance with applicable laws.</p><p><br></p><p>Participants also learn mindset development, situational awareness, and decision-making under stress through scenario-based instruction. The course reinforces safe gun handling, accountability, and ethical responsibilities associated with carrying a handgun in public or professional environments.</p><p><br></p><p>NRA Advanced Handgun Carry is ideal for armed security personnel, protective service professionals, and experienced civilian carriers seeking to elevate their skills, confidence, and readiness while maintaining the highest standards of safety and professionalism.</p>', 150.00, 50.00, NULL, 10, 2, 'group', 0, 0, 'services/BrCipzeQ82L1MONsdaonwzCkq716sIzeq16tvNiU.jpg', 4, 1, '2026-01-12 13:14:51', '2026-01-21 13:00:00'),
(5, 'Standard Handgun Carry', 'Standard Handgun Carry training teaches safe handgun handling, basic defensive shooting skills, and responsible concealed or open carry practices.', '<p>Standard Handgun Carry training is designed to provide participants with a solid foundation in carrying and using a handgun safely and responsibly. This course focuses on essential firearm safety rules, proper handling, and basic marksmanship skills required for defensive handgun carry.</p><p><br></p><p>Participants learn correct grip, stance, sight alignment, trigger control, and safe drawing and holstering techniques. The training also covers carry methods, situational awareness, and fundamental defensive concepts to help individuals respond appropriately to potential threats.</p><p><br></p><p>Legal responsibilities, use-of-force principles, and ethical considerations are emphasized to ensure participants understand when and how a handgun may be used in self-defense or professional contexts. Practical exercises reinforce confidence, accuracy, and safe decision-making.</p><p><br></p><p>Standard Handgun Carry is ideal for new or developing armed security professionals and responsible civilians seeking foundational training before advancing to higher-level handgun carry or tactical courses.</p>', 120.00, 120.00, NULL, 10, 2, 'group', 1, 0, 'services/oW2xcpo9xtVBfs4WwXc3VuyO3Lz94aF2LnAgzolr.jpg', 5, 1, '2026-01-12 13:15:47', '2026-01-21 13:01:18'),
(6, 'Red Cross (First Aid, CPR, and AED)', 'Red Cross First Aid, CPR, and AED training equips individuals with lifesaving skills to respond confidently to medical emergencies.', '<p>Red Cross First Aid, CPR, and AED training provides comprehensive, nationally recognized instruction in emergency medical response for adults, children, and infants. This course prepares participants to act quickly and effectively during medical emergencies until professional help arrives.</p><p><br></p><p>Training covers essential first aid skills, including bleeding control, wound care, shock management, and response to common injuries and illnesses. Participants also receive hands-on instruction in cardiopulmonary resuscitation (CPR) and the safe, effective use of Automated External Defibrillators (AEDs).</p><p><br></p><p>Emphasis is placed on scene safety, emergency assessment, teamwork, and legal considerations such as Good Samaritan protections. Practical scenarios build confidence, coordination, and readiness in high-stress situations.</p><p><br></p><p>This training is ideal for security officers, guards, workplace teams, educators, and individuals preparing for future security or protective service roles. Certification demonstrates preparedness, responsibility, and commitment to safety in any environment.</p>', 300.00, 100.00, NULL, 10, 2, 'group', 0, 0, 'services/KWZGG0VFBFUh0fYE2nBcZwcB3brTGSyqhb2PavAq.jpg', 6, 1, '2026-01-12 13:18:51', '2026-01-21 13:02:32'),
(7, 'ALERRT (Active Shooter)', 'ALERRT (Active Shooter) training prepares individuals to recognize, respond to, and survive active shooter and hostile threat incidents.', '<p>ALERRT (Advanced Law Enforcement Rapid Response Training) – Active Shooter training is a nationally recognized, research-based program designed to prepare individuals and organizations for rapid and effective response to active shooter and hostile threat events.</p><p><br></p><p>The training focuses on threat recognition, situational awareness, and immediate response strategies to reduce harm and save lives. Participants learn proven concepts such as movement during high-risk incidents, decision-making under stress, communication, coordination with first responders, and lifesaving medical response including bleeding control.</p><p><br></p><p>Scenario-based instruction reinforces practical application, helping participants understand attacker behavior, response priorities, and survival principles. The program emphasizes prevention, preparedness, and recovery while maintaining legal and ethical responsibilities.</p><p><br></p><p>ALERRT Active Shooter training is ideal for security officers, guards, school staff, healthcare workers, corporate teams, and individuals preparing for future security roles. Completion of this training increases confidence, readiness, and the ability to act decisively during critical incidents.</p>', 200.00, 50.00, NULL, 10, 2, 'group', 1, 0, 'services/zzHmHY9InmzwDnFkFocKwdNPsTCLP3vNFTmW9ZIm.jpg', 7, 1, '2026-01-20 16:43:51', '2026-01-21 13:03:55'),
(8, 'Private Protective Services (for future security jobs)', 'Private Protective Services training prepares individuals for future security careers through professional protection skills and real-world readiness.', '<p>Private Protective Services training is designed for individuals seeking future employment in the security and protective services industry. This program provides foundational and practical training required to pursue careers in private security, executive protection, event security, and facility protection.</p><p><br></p><p>The course covers essential security topics including access control, patrol procedures, threat assessment, report writing, communication skills, and emergency response. Participants also develop situational awareness, professionalism, and conflict management skills critical to effective protective operations.</p><p><br></p><p>Strong emphasis is placed on legal responsibilities, ethical conduct, and industry standards to ensure participants understand their role in safeguarding people, property, and assets. Scenario-based instruction reinforces decision-making, teamwork, and confidence in real-world environments.</p><p><br></p><p>This training is ideal for individuals preparing for future security roles and provides a strong pathway toward professional certification, employment readiness, and career advancement in the private protective services field.</p>', 200.00, 100.00, NULL, 10, 2, 'group', 0, 0, 'services/5iKmhLhpZ21xyRBtqL5AnhNM5eDmapIiksSqKler.jpg', 8, 1, '2026-01-20 16:45:12', '2026-01-21 13:05:59');

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

INSERT INTO `service_bookings` (`id`, `customer_id`, `service_id`, `booking_date`, `booking_time`, `status`, `notes`, `created_at`, `updated_at`, `class_schedule_id`, `total_amount`, `deposit_amount`, `remaining_amount`, `payment_status`, `booking_type`, `number_of_students`, `group_name`) VALUES
(1, 2, 1, '2026-01-22', '11:11:00', 'completed', 'Testing', '2026-01-20 18:20:37', '2026-01-21 14:42:13', 7, 380.00, 40.00, 340.00, 'deposit_paid', 'group', 4, 'Team 2'),
(2, 3, 7, '2026-01-23', '15:21:00', 'confirmed', NULL, '2026-01-21 10:55:00', '2026-01-21 10:55:21', 5, 400.00, 100.00, 300.00, 'deposit_paid', 'group', 2, NULL);

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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `header_logo`, `footer_logo`, `favicon`, `phone`, `email`, `address`, `facebook_url`, `twitter_url`, `instagram_url`, `linkedin_url`, `youtube_url`, `quickbooks_client_id`, `quickbooks_client_secret`, `quickbooks_company_id`, `quickbooks_environment`, `quickbooks_access_token`, `quickbooks_refresh_token`, `quickbooks_enabled`, `bank_api_provider`, `bank_api_key`, `bank_api_secret`, `bank_account_id`, `bank_sync_enabled`, `created_at`, `updated_at`) VALUES
(1, 'settings/TrtiBGfNvMfJq1Wwx2PH8MQ869j9v3haDZgKuRY6.png', 'settings/rJPKZxg7wHlfj0mapTu5WaJLIatsXchwYMbgavnS.png', 'settings/1FYglKr8Td9AHyiuLjP5f3qLtyormikwBSTvXhxp.png', '615-554-1131', 'tnvetsecsvctrng@gmail.com', '123 Security Way,\r\nNashville, TN 37201', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'sandbox', NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, '2026-01-12 13:30:50', '2026-01-12 13:35:36');

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
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_bookings`
--
ALTER TABLE `service_bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_bookings_customer_id_foreign` (`customer_id`),
  ADD KEY `service_bookings_service_id_foreign` (`service_id`),
  ADD KEY `service_bookings_class_schedule_id_foreign` (`class_schedule_id`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `service_bookings`
--
ALTER TABLE `service_bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
