-- MySQL dump 10.13  Distrib 8.0.44, for Linux (x86_64)
--
-- Host: localhost    Database: tn_veterans
-- ------------------------------------------------------
-- Server version	8.0.44-0ubuntu0.24.04.2

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `class_schedules`
--

DROP TABLE IF EXISTS `class_schedules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `class_schedules` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `service_id` bigint unsigned NOT NULL,
  `class_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time DEFAULT NULL,
  `duration_hours` int NOT NULL,
  `max_students` int NOT NULL DEFAULT '10',
  `min_students` int NOT NULL DEFAULT '2',
  `current_students` int NOT NULL DEFAULT '0',
  `room` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instructor` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `can_overlap` tinyint(1) NOT NULL DEFAULT '1',
  `status` enum('scheduled','full','cancelled','completed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'scheduled',
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `class_schedules_class_date_start_time_index` (`class_date`,`start_time`),
  KEY `class_schedules_service_id_class_date_index` (`service_id`,`class_date`),
  CONSTRAINT `class_schedules_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `class_schedules`
--

LOCK TABLES `class_schedules` WRITE;
/*!40000 ALTER TABLE `class_schedules` DISABLE KEYS */;
INSERT INTO `class_schedules` VALUES (4,7,'2026-01-22','12:12:00','20:12:00',8,10,2,0,'Class A 03',NULL,'Jayson Wheat',1,'scheduled','Testing','2026-01-20 17:38:22','2026-01-20 17:38:22'),(5,7,'2026-01-23','15:21:00','23:21:00',8,10,2,2,'Class A 03',NULL,'Jayson Wheat',1,'scheduled','Testing','2026-01-20 17:38:22','2026-01-21 10:55:00'),(6,7,'2026-01-27','08:42:00','16:42:00',8,10,2,0,'Class A 03',NULL,'Jayson Wheat',1,'scheduled','Testing','2026-01-20 17:38:22','2026-01-20 17:38:22'),(7,1,'2026-01-22','11:11:00','16:11:00',5,8,4,0,'Class A 7',NULL,'Jayson',1,'scheduled','test','2026-01-20 17:45:12','2026-01-21 14:42:14'),(8,1,'2026-01-24','07:50:00','15:50:00',8,10,2,0,'class A 09',NULL,'Jayson ww',1,'scheduled','testing','2026-01-20 17:45:50','2026-01-20 17:45:50'),(9,3,'2026-01-23','16:00:00','08:00:00',16,10,1,0,'32123',NULL,'Jack',1,'scheduled',NULL,'2026-01-21 13:34:30','2026-01-21 13:34:30'),(10,2,'2026-01-30','17:00:00','01:00:00',8,10,2,0,'Class A17',NULL,'Jack son',1,'scheduled',NULL,'2026-01-21 13:36:22','2026-01-21 13:36:22'),(11,2,'2026-01-31','18:00:00','02:00:00',8,10,2,0,'Class A17',NULL,'Jack son',1,'scheduled',NULL,'2026-01-21 13:36:22','2026-01-21 13:36:22'),(12,26,'2026-01-29','03:50:00','07:50:00',4,10,1,5,'1231231','Location A','Jayson ww',1,'scheduled','Dallas Law Training',NULL,'2026-01-28 22:02:04'),(13,26,'2026-01-29','03:50:00','07:50:00',4,10,1,3,'1231231','Location B','Jayson ww',1,'scheduled','Dallas Law Training',NULL,'2026-01-28 13:02:14'),(14,26,'2026-01-30','18:51:00','20:51:00',2,10,1,2,'Class A 7','Location A','Jack',1,'scheduled','Lethal Less Traning',NULL,'2026-01-28 23:22:31'),(15,26,'2026-01-30','18:51:00','20:51:00',2,10,1,0,'Class A 7','Location B','Jack',1,'scheduled','Lethal Less Traning',NULL,NULL);
/*!40000 ALTER TABLE `class_schedules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `profile_picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `customers_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES (1,'Json','customer@customer.com','$2y$12$8DaIhkSdBoi8p.qXc7Vx2e6vLsM7EoqFMg5jEXHp9my/ezenSegyK','1231231231','44075 Pipeline Plaza Ste. 125','customer-profiles/ypHnHGAPwms3tWX1LKRFVVoRsdJauW0s2fhODHqd.jpg',NULL,NULL,'2026-01-12 17:14:44','2026-01-12 17:23:51'),(2,'Production Head','student@gmail.com','$2y$12$UUuPm.bnIhlqLJxz.CaNoucS8AXcrpeLKj6pxybDRUXFc7OU5RpkG','1231231231','44075 Pipeline Plaza Ste. 125','customer-profiles/wkdK2E1C1UA412Lf2KWEfXg6GXbWUYGl5vnsaJ6k.jpg',NULL,NULL,'2026-01-20 18:19:20','2026-01-20 18:21:46'),(3,'Jack','jack@gemail.com','$2y$12$qd5xtI0IzfwvE5CUrR2hNeObl5hHF1zY1LkjVodoi/wZ3H/EX/Qzi','1231231231','44075 Pipeline Plaza Ste. 132',NULL,NULL,NULL,'2026-01-21 10:35:40','2026-01-21 10:35:40'),(4,'ryan','ryan@americandigitalagency.us','$2y$12$mDpbRrAmCctbeKWF8T63N.0xSXbQw2.J1K/p5Q3cSBXooehW8hx4a','12345676789',NULL,NULL,NULL,NULL,'2026-01-28 21:19:05','2026-01-28 21:19:05'),(5,'Brennan Klocko','your.email+fakedata72935@gmail.com','$2y$12$KoLH.Tq3dIkUUZofBZTCCudWPUB16mE5jNLqiDeK0.8/UOnfupJzW','620-061-2089',NULL,NULL,NULL,NULL,'2026-01-28 22:01:13','2026-01-28 22:01:13');
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
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
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_01_12_174338_create_services_table',2),(5,'2026_01_12_175606_add_short_description_to_services_table',3),(6,'2026_01_12_182335_create_site_settings_table',4),(7,'2026_01_12_183941_add_profile_picture_to_users_table',5),(8,'2026_01_12_221013_create_customers_table',6),(9,'2026_01_12_221017_create_service_bookings_table',6),(10,'2026_01_20_220728_add_class_fields_to_services_table',7),(11,'2026_01_20_220737_create_class_schedules_table',7),(12,'2026_01_20_220740_add_payment_fields_to_service_bookings_table',7),(13,'2026_01_20_220744_create_payments_table',7),(14,'2026_01_21_184933_add_api_keys_to_site_settings_table',8),(15,'2026_01_27_163452_add_category_fields_to_services_table',9),(16,'2026_01_27_164327_create_security_company_links_table',10),(17,'2026_01_27_164435_add_instructor_bios_to_site_settings_table',11),(18,'2026_01_27_165429_add_location_to_class_schedules_table',12),(19,'2026_01_27_165433_add_location_to_service_bookings_table',12),(20,'2026_01_27_220557_create_service_relationships_table',13),(21,'2026_01_27_220640_add_requires_conditional_questions_to_services_table',13);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `booking_id` bigint unsigned NOT NULL,
  `customer_id` bigint unsigned NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_type` enum('deposit','full_payment','remaining_balance','refund') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'deposit',
  `payment_method` enum('credit_card','debit_card','bank_transfer','cash','check','other') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'credit_card',
  `status` enum('pending','completed','failed','refunded') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_gateway` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gateway_response` text COLLATE utf8mb4_unicode_ci,
  `synced_to_quickbooks` tinyint(1) NOT NULL DEFAULT '0',
  `quickbooks_invoice_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quickbooks_payment_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quickbooks_synced_at` timestamp NULL DEFAULT NULL,
  `synced_to_bank` tinyint(1) NOT NULL DEFAULT '0',
  `bank_synced_at` timestamp NULL DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `payment_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `payments_transaction_id_unique` (`transaction_id`),
  KEY `payments_booking_id_status_index` (`booking_id`,`status`),
  KEY `payments_customer_id_payment_date_index` (`customer_id`,`payment_date`),
  KEY `payments_transaction_id_index` (`transaction_id`),
  CONSTRAINT `payments_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `service_bookings` (`id`) ON DELETE CASCADE,
  CONSTRAINT `payments_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
INSERT INTO `payments` VALUES (1,1,2,40.00,'deposit','cash','pending',NULL,NULL,NULL,0,NULL,NULL,NULL,0,NULL,NULL,'2026-01-20','2026-01-20 18:21:08','2026-01-20 18:21:08'),(2,2,3,100.00,'deposit','credit_card','completed','1231231231111111',NULL,NULL,0,NULL,NULL,NULL,0,NULL,NULL,'2026-01-21','2026-01-21 10:55:21','2026-01-21 10:55:21'),(3,3,2,300.00,'deposit','credit_card','completed','1231231231',NULL,NULL,0,NULL,NULL,NULL,0,NULL,NULL,'2026-01-28','2026-01-28 13:02:30','2026-01-28 13:02:30'),(4,4,4,100.00,'deposit','credit_card','completed','12313123',NULL,NULL,0,NULL,NULL,NULL,0,NULL,NULL,'2026-01-28','2026-01-28 21:26:52','2026-01-28 21:26:52'),(5,6,4,100.00,'deposit','credit_card','completed','13121232',NULL,NULL,0,NULL,NULL,NULL,0,NULL,NULL,'2026-01-28','2026-01-28 23:22:48','2026-01-28 23:22:48');
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `security_company_links`
--

DROP TABLE IF EXISTS `security_company_links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `security_company_links` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `security_company_links`
--

LOCK TABLES `security_company_links` WRITE;
/*!40000 ALTER TABLE `security_company_links` DISABLE KEYS */;
/*!40000 ALTER TABLE `security_company_links` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service_bookings`
--

DROP TABLE IF EXISTS `service_bookings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `service_bookings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` bigint unsigned NOT NULL,
  `service_id` bigint unsigned NOT NULL,
  `booking_date` date NOT NULL,
  `booking_time` time DEFAULT NULL,
  `status` enum('pending','confirmed','completed','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `class_schedule_id` bigint unsigned DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `deposit_amount` decimal(10,2) DEFAULT NULL,
  `remaining_amount` decimal(10,2) DEFAULT NULL,
  `payment_status` enum('pending','deposit_paid','fully_paid','refunded') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `booking_type` enum('group','one-on-one') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'group',
  `number_of_students` int NOT NULL DEFAULT '1',
  `group_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `service_bookings_customer_id_foreign` (`customer_id`),
  KEY `service_bookings_service_id_foreign` (`service_id`),
  KEY `service_bookings_class_schedule_id_foreign` (`class_schedule_id`),
  CONSTRAINT `service_bookings_class_schedule_id_foreign` FOREIGN KEY (`class_schedule_id`) REFERENCES `class_schedules` (`id`) ON DELETE CASCADE,
  CONSTRAINT `service_bookings_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `service_bookings_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_bookings`
--

LOCK TABLES `service_bookings` WRITE;
/*!40000 ALTER TABLE `service_bookings` DISABLE KEYS */;
INSERT INTO `service_bookings` VALUES (1,2,1,'2026-01-22','11:11:00','completed','Testing','2026-01-20 18:20:37','2026-01-21 14:42:13',7,NULL,380.00,40.00,340.00,'deposit_paid','group',4,'Team 2'),(2,3,7,'2026-01-23','15:21:00','confirmed',NULL,'2026-01-21 10:55:00','2026-01-21 10:55:21',5,NULL,400.00,100.00,300.00,'deposit_paid','group',2,NULL),(3,2,26,'2026-01-29','03:50:00','confirmed',NULL,'2026-01-28 13:02:14','2026-01-28 13:02:30',13,'Location B',300.00,300.00,0.00,'deposit_paid','group',3,'Test'),(4,4,26,'2026-01-30','18:51:00','confirmed',NULL,'2026-01-28 21:26:34','2026-01-28 21:26:52',14,'Location A',100.00,100.00,0.00,'deposit_paid','group',1,'Ryan'),(5,5,26,'2026-01-29','03:50:00','pending',NULL,'2026-01-28 22:02:04','2026-01-28 22:02:04',12,'Location A',500.00,500.00,0.00,'pending','group',5,'Brennon Glover'),(6,4,26,'2026-01-30','18:51:00','confirmed',NULL,'2026-01-28 23:22:31','2026-01-28 23:22:48',14,'Location A',100.00,100.00,0.00,'deposit_paid','group',1,'ryan');
/*!40000 ALTER TABLE `service_bookings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service_relationships`
--

DROP TABLE IF EXISTS `service_relationships`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `service_relationships` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `parent_service_id` bigint unsigned NOT NULL,
  `linked_service_id` bigint unsigned NOT NULL,
  `order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `service_relationships_parent_service_id_linked_service_id_unique` (`parent_service_id`,`linked_service_id`),
  KEY `service_relationships_linked_service_id_foreign` (`linked_service_id`),
  CONSTRAINT `service_relationships_linked_service_id_foreign` FOREIGN KEY (`linked_service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE,
  CONSTRAINT `service_relationships_parent_service_id_foreign` FOREIGN KEY (`parent_service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_relationships`
--

LOCK TABLES `service_relationships` WRITE;
/*!40000 ALTER TABLE `service_relationships` DISABLE KEYS */;
INSERT INTO `service_relationships` VALUES (1,26,17,0,'2026-01-27 18:04:02','2026-01-30 00:03:30'),(2,26,18,1,'2026-01-27 18:04:02','2026-01-30 00:03:30'),(3,1,17,0,'2026-01-29 22:53:31','2026-01-29 22:53:31'),(4,1,18,1,'2026-01-29 22:53:31','2026-01-29 22:53:31'),(5,1,19,2,'2026-01-29 22:53:31','2026-01-29 22:53:31'),(11,18,29,0,'2026-01-29 22:57:05','2026-01-29 22:57:05'),(12,18,23,1,'2026-01-29 22:57:05','2026-01-29 22:57:05'),(13,36,17,0,'2026-02-03 21:25:51','2026-02-03 21:25:51'),(14,36,18,1,'2026-02-03 21:25:51','2026-02-03 21:25:51');
/*!40000 ALTER TABLE `service_relationships` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `services` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `price` decimal(10,2) DEFAULT NULL,
  `deposit_amount` decimal(10,2) DEFAULT NULL,
  `duration_hours` int DEFAULT NULL,
  `max_students` int NOT NULL DEFAULT '10',
  `min_students` int NOT NULL DEFAULT '2',
  `class_type` enum('group','one-on-one') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'group',
  `has_online_parts` tinyint(1) NOT NULL DEFAULT '0',
  `testing_in_person` tinyint(1) NOT NULL DEFAULT '1',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subcategory` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `requires_dallas_law` tinyint(1) NOT NULL DEFAULT '0',
  `requires_active_shooter` tinyint(1) NOT NULL DEFAULT '0',
  `requires_conditional_questions` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` VALUES (1,'Armed Security Certification','Armed Security Certification provides advanced training in firearm safety, legal use of force, and tactical response for professional armed security roles.','<p>Armed Security Certification is an advanced training program designed for individuals pursuing or currently working in armed security positions. This certification equips participants with the knowledge, skills, and discipline required to carry and use firearms responsibly while performing protective duties.</p><p><br></p><p>The program covers firearm safety, weapons handling, marksmanship fundamentals, and safe storage, along with critical instruction on use-of-force laws, legal responsibilities, and ethical decision-making. Participants receive scenario-based training to develop judgment, threat assessment, and controlled response under high-stress conditions.</p><p><br></p><p>Additional focus areas include defensive tactics, situational awareness, communication, and coordination with law enforcement and emergency responders. Emphasis is placed on professionalism, accountability, and compliance with state and employer regulations.</p><p><br></p><p>Armed Security Certification is ideal for security professionals seeking armed assignments in corporate, residential, event, or high-risk environments. Completion of this training demonstrates readiness, competence, and commitment to maintaining the highest standards of safety and professionalism in armed protective services.</p>',160.00,160.00,NULL,10,2,'group',0,0,'services/gV79EbBPvkL16BCvQpqhb9gatnK9A8slmsv2OhsR.jpg',1,1,NULL,NULL,NULL,0,0,0,'2026-01-12 12:52:47','2026-01-29 22:53:31'),(2,'Force Science (De-escalation)','Force Science (De-escalation) training teaches evidence-based techniques to reduce conflict, manage behavior, and safely resolve high-stress encounters.','<p>Force Science (De-escalation) training is a research-driven program focused on understanding human behavior, stress responses, and decision-making during high-risk or emotionally charged situations. This training equips participants with proven de-escalation strategies to prevent situations from escalating into physical force.</p><p><br></p><p>The course emphasizes verbal communication skills, body language awareness, distance management, and emotional regulation to influence behavior and maintain control. Participants learn how stress, perception, and cognitive limitations affect both responders and subjects, enabling safer and more effective interactions.</p><p><br></p><p>Scenario-based training reinforces practical application, teaching participants how to recognize warning signs, apply tactical patience, and choose appropriate responses while remaining legally and ethically compliant. The program also addresses use-of-force decision-making, accountability, and post-incident considerations.</p><p><br></p><p>Force Science (De-escalation) training is ideal for security officers, guards, supervisors, and individuals preparing for future security careers. It promotes professionalism, safety, and confidence while reducing risk, liability, and unnecessary use of force in protective service environments.</p>',200.00,100.00,NULL,10,2,'group',1,0,'services/lu6mY6GfYotlfByxzKUFWSukJnAC0U7JU5BTDtDD.jpg',3,1,NULL,NULL,NULL,0,0,0,'2026-01-12 13:00:45','2026-01-21 12:58:40'),(3,'ASP (Batons and Restraints)','ASP (Batons and Restraints) training teaches proper baton use and restraint techniques for safely controlling and managing resistant or aggressive individuals.','<p>ASP (Batons and Restraints) training provides essential instruction in the safe, legal, and effective use of expandable batons and restraint devices for security and protective service professionals. This program emphasizes control, officer safety, and minimizing injury while managing confrontational or non-compliant situations.</p><p><br></p><p>Participants learn correct baton handling, striking zones, defensive techniques, and retention methods, along with proper application of restraints such as handcuffs and control devices. The training includes use-of-force guidelines, legal considerations, and decision-making to ensure actions are justified, proportional, and compliant with industry standards.</p><p><br></p><p>Scenario-based exercises help develop practical skills in de-escalation, subject control, team coordination, and situational awareness. Strong emphasis is placed on professionalism, accountability, and post-incident procedures, including reporting and subject care.</p><p><br></p><p>This training is ideal for security officers, guards, and individuals preparing for future security roles who require intermediate force options to maintain safety and control in dynamic environments.</p>',100.00,50.00,NULL,10,2,'group',0,0,'services/BkxqE6w72S4gcPBjXi06KoDngDnDNdh1cV4KJlne.png',2,1,NULL,NULL,NULL,0,0,0,'2026-01-12 13:13:46','2026-01-21 12:55:06'),(4,'NRA (Advanced Handgun Carry)','NRA Advanced Handgun Carry training develops advanced handgun skills, defensive carry techniques, and responsible decision-making for armed professionals and qualified civilians.','<p>NRA Advanced Handgun Carry is an advanced-level firearms training program designed to enhance defensive handgun proficiency for individuals who carry a firearm for personal protection or professional duties. This course builds on fundamental handgun skills and focuses on real-world defensive carry scenarios.</p><p><br></p><p>Training includes advanced marksmanship, drawing from concealment, movement, use of cover, threat assessment, and defensive shooting techniques. Strong emphasis is placed on firearm safety, legal considerations, and responsible use of force in accordance with applicable laws.</p><p><br></p><p>Participants also learn mindset development, situational awareness, and decision-making under stress through scenario-based instruction. The course reinforces safe gun handling, accountability, and ethical responsibilities associated with carrying a handgun in public or professional environments.</p><p><br></p><p>NRA Advanced Handgun Carry is ideal for armed security personnel, protective service professionals, and experienced civilian carriers seeking to elevate their skills, confidence, and readiness while maintaining the highest standards of safety and professionalism.</p>',150.00,50.00,NULL,10,2,'group',0,0,'services/BrCipzeQ82L1MONsdaonwzCkq716sIzeq16tvNiU.jpg',4,1,NULL,NULL,NULL,0,0,0,'2026-01-12 13:14:51','2026-01-21 13:00:00'),(6,'Red Cross (First Aid, CPR, and AED)','Red Cross First Aid, CPR, and AED training equips individuals with lifesaving skills to respond confidently to medical emergencies.','<p>Red Cross First Aid, CPR, and AED training provides comprehensive, nationally recognized instruction in emergency medical response for adults, children, and infants. This course prepares participants to act quickly and effectively during medical emergencies until professional help arrives.</p><p><br></p><p>Training covers essential first aid skills, including bleeding control, wound care, shock management, and response to common injuries and illnesses. Participants also receive hands-on instruction in cardiopulmonary resuscitation (CPR) and the safe, effective use of Automated External Defibrillators (AEDs).</p><p><br></p><p>Emphasis is placed on scene safety, emergency assessment, teamwork, and legal considerations such as Good Samaritan protections. Practical scenarios build confidence, coordination, and readiness in high-stress situations.</p><p><br></p><p>This training is ideal for security officers, guards, workplace teams, educators, and individuals preparing for future security or protective service roles. Certification demonstrates preparedness, responsibility, and commitment to safety in any environment.</p>',300.00,100.00,NULL,10,2,'group',0,0,'services/KWZGG0VFBFUh0fYE2nBcZwcB3brTGSyqhb2PavAq.jpg',6,1,NULL,NULL,NULL,0,0,0,'2026-01-12 13:18:51','2026-01-21 13:02:32'),(7,'ALERRT (Active Shooter)','ALERRT (Active Shooter) training prepares individuals to recognize, respond to, and survive active shooter and hostile threat incidents.','<p>ALERRT (Advanced Law Enforcement Rapid Response Training) – Active Shooter training is a nationally recognized, research-based program designed to prepare individuals and organizations for rapid and effective response to active shooter and hostile threat events.</p><p><br></p><p>The training focuses on threat recognition, situational awareness, and immediate response strategies to reduce harm and save lives. Participants learn proven concepts such as movement during high-risk incidents, decision-making under stress, communication, coordination with first responders, and lifesaving medical response including bleeding control.</p><p><br></p><p>Scenario-based instruction reinforces practical application, helping participants understand attacker behavior, response priorities, and survival principles. The program emphasizes prevention, preparedness, and recovery while maintaining legal and ethical responsibilities.</p><p><br></p><p>ALERRT Active Shooter training is ideal for security officers, guards, school staff, healthcare workers, corporate teams, and individuals preparing for future security roles. Completion of this training increases confidence, readiness, and the ability to act decisively during critical incidents.</p>',200.00,50.00,NULL,10,2,'group',1,0,'services/zzHmHY9InmzwDnFkFocKwdNPsTCLP3vNFTmW9ZIm.jpg',7,1,NULL,NULL,NULL,0,0,0,'2026-01-20 16:43:51','2026-01-21 13:03:55'),(8,'Private Protective Services (for future security jobs)','Private Protective Services training prepares individuals for future security careers through professional protection skills and real-world readiness.','<p>Private Protective Services training is designed for individuals seeking future employment in the security and protective services industry. This program provides foundational and practical training required to pursue careers in private security, executive protection, event security, and facility protection.</p><p><br></p><p>The course covers essential security topics including access control, patrol procedures, threat assessment, report writing, communication skills, and emergency response. Participants also develop situational awareness, professionalism, and conflict management skills critical to effective protective operations.</p><p><br></p><p>Strong emphasis is placed on legal responsibilities, ethical conduct, and industry standards to ensure participants understand their role in safeguarding people, property, and assets. Scenario-based instruction reinforces decision-making, teamwork, and confidence in real-world environments.</p><p><br></p><p>This training is ideal for individuals preparing for future security roles and provides a strong pathway toward professional certification, employment readiness, and career advancement in the private protective services field.</p>',200.00,100.00,NULL,10,2,'group',0,0,'services/5iKmhLhpZ21xyRBtqL5AnhNM5eDmapIiksSqKler.jpg',8,1,NULL,NULL,NULL,0,0,0,'2026-01-20 16:45:12','2026-01-21 13:05:59'),(17,'Less Lethal Training','Comprehensive less lethal weapons and techniques training.',NULL,NULL,NULL,NULL,10,2,'group',0,1,NULL,9,1,'security_training','Less Lethal Training',NULL,0,0,0,'2026-01-27 11:47:18','2026-01-27 11:47:18'),(18,'Dallas Law Training','Required training for security officers working around alcohol.',NULL,60.00,60.00,NULL,10,2,'group',1,0,NULL,10,1,'security_training','Dallas Law',NULL,0,0,0,'2026-01-27 11:47:18','2026-01-29 22:57:05'),(19,'Active Shooter Training','Required training for security officers working at schools, churches, or daycares.','<h2 class=\"ql-align-center\"><strong style=\"background-color: transparent;\">Reprogramming Your Brain\'s Emergency Response</strong></h2><h2 class=\"ql-align-center\"><br></h2><p class=\"ql-align-center\"><span style=\"color: rgb(0, 0, 0); background-color: transparent;\">Dive deep into the neuroscience of survival with our ALIVE methodology. This section explores how the Assess, Leave, Impede, Violence, and Expose framework aligns with your brain\'s natural stress responses, effectively rewiring your neural pathways for optimal performance under extreme pressure. Through cutting-edge cognitive exercises and immersive simulations, you\'ll learn to override paralyzing fear responses and activate your brain\'s rapid decision-making capabilities. Discover how this neurological approach can transform split-second reactions into life-saving actions.</span></p><p><br></p><p>This course introduces the ALIVE methodology (Assess, Leave, Impede, Violence, and Expose), a groundbreaking approach to emergency response training rooted in neuroscience. The program focuses on reprogramming participants\' neural pathways to optimize performance under extreme stress. Through advanced cognitive exercises and immersive simulations, students learn to override paralyzing fear responses and activate rapid decision-making capabilities. This neurological approach aims to transform split-second reactions into life-saving actions, effectively rewiring the brain\'s emergency response mechanisms. Beyond personal safety, the course explores the broader societal impact of ALIVE training. It demonstrates how individual preparedness creates a positive ripple effect in communities, using case studies to illustrate how a single trained person can significantly alter the outcome of crisis situations. Participants learn about their potential role as crucial nodes in the network of public safety, understanding how their enhanced awareness and skills can subtly influence those around them, contributing to a more resilient society. The course emphasizes the far-reaching consequences of this training, showing how individual actions can trigger a cascade of positive outcomes in emergency scenarios.</p>',200.00,200.00,NULL,10,2,'group',0,0,NULL,11,1,'security_training','Active Shooter',NULL,0,0,0,'2026-01-27 11:47:18','2026-01-29 23:54:46'),(20,'Refuse to be the Victim','NRA personal safety and crime prevention program.',NULL,NULL,NULL,NULL,10,2,'group',0,1,NULL,12,1,'nra','Refuse to be the Victim',NULL,0,0,0,'2026-01-27 11:47:18','2026-01-27 11:47:18'),(21,'NRA Rifle Training','Comprehensive rifle training and certification.',NULL,NULL,NULL,NULL,10,2,'group',0,1,NULL,13,1,'nra','Rifle',NULL,0,0,0,'2026-01-27 11:47:18','2026-01-27 11:47:18'),(22,'NRA Shotgun Training','Comprehensive shotgun training and certification.',NULL,NULL,NULL,NULL,10,2,'group',0,1,NULL,14,1,'nra','Shotgun',NULL,0,0,0,'2026-01-27 11:47:18','2026-01-27 11:47:18'),(23,'First Aid / CPR / AED','Red Cross First Aid, CPR, and AED certification training.',NULL,NULL,NULL,NULL,10,2,'group',0,1,NULL,15,1,'red_cross','First Aid / CPR / AED',NULL,0,0,0,'2026-01-27 11:47:18','2026-01-27 11:47:18'),(24,'BLS (Basic Life Support)','Red Cross Basic Life Support certification for healthcare providers.',NULL,NULL,NULL,NULL,10,2,'group',0,1,NULL,16,1,'red_cross','BLS',NULL,0,0,0,'2026-01-27 11:47:18','2026-01-27 11:47:18'),(26,'Unarmed Guard Training (Initial Course)','4-hour comprehensive training program for unarmed security officers.','<h2 class=\"ql-align-center\"><strong style=\"background-color: transparent;\">Professional Unarmed Security Training in Nashville, Tennessee</strong></h2><h2 class=\"ql-align-center\"><br></h2><p class=\"ql-align-center\"><span style=\"color: rgb(0, 0, 0); background-color: transparent;\">Elevate your career in the security industry with our comprehensive unarmed security training course in Nashville, Tennessee. Our expert-led program is designed to equip you with the essential skills and knowledge required to excel in this challenging and rewarding field. From firearms proficiency and tactical awareness to legal considerations and conflict de-escalation, our course covers all aspects of armed security work.</span></p><p class=\"ql-align-center\"><br></p><p class=\"ql-align-center\"><span style=\"color: rgb(0, 0, 0); background-color: transparent;\">Throughout this intensive training, you\'ll benefit from hands-on experience with industry-standard equipment, realistic scenario-based exercises, and in-depth classroom instruction. Our curriculum is tailored to meet and exceed Tennessee state requirements, ensuring you\'re fully prepared for certification upon completion. Whether you\'re new to the security field or looking to enhance your existing skills, our course provides the foundation for a successful career in unarmed security. Join us in Nashville and take the first step towards becoming a highly skilled and confident security professional.</span></p><p class=\"ql-align-center\"><br></p><p class=\"ql-align-center\">This program is designed for individuals taking their first steps into the security industry. Throughout this course, you\'ll gain the fundamental knowledge and skills necessary to begin your career as an unarmed security professional. We\'ll cover essential topics including the roles and responsibilities of security guards, legal aspects of security work, effective communication techniques, emergency response procedures, and basic safety protocols. You\'ll learn about professional conduct, report writing, and how to handle various security situations without the use of weapons. We\'ll also guide you through the process of obtaining your initial unarmed security guard license, including application requirements and exam preparation. By the end of this course, you\'ll be well-equipped with the foundational skills and knowledge needed to start your career in the unarmed security field, ready to provide valuable protective services in a variety of settings.</p><p><br></p>',75.00,75.00,NULL,10,2,'group',0,0,NULL,1,1,'security_training','Unarmed Guard Training',NULL,0,0,0,'2026-01-27 16:32:33','2026-01-30 00:03:30'),(27,'Armed Security Certification','Complete armed security guard certification program. Available at Location A and Location B.',NULL,NULL,NULL,NULL,10,2,'group',0,1,NULL,2,1,'security_training','Armed Security Certification',NULL,0,0,0,'2026-01-27 16:32:33','2026-01-27 16:32:33'),(28,'ASP (Batons & Restraints) with OC Spray','Advanced training in batons, restraints, and OC spray techniques. Available at Location A and Location B.',NULL,NULL,NULL,NULL,10,2,'group',0,1,NULL,3,1,'security_training','ASP (Batons & Restraints)',NULL,0,0,0,'2026-01-27 16:32:33','2026-01-27 16:32:33'),(29,'Force Science (De-Escalation)','Learn effective de-escalation techniques and force science principles.',NULL,NULL,NULL,NULL,10,2,'group',0,1,NULL,6,1,'security_training','Force Science',NULL,0,0,0,'2026-01-27 16:32:33','2026-01-27 16:32:33'),(32,'Unarmed Guard (Renewal Course)','Course renewal to keep your unarmed security skills sharp.','<h2 class=\"ql-align-center\"><strong style=\"background-color: transparent;\">Professional Unarmed Security Training in Nashville, Tennessee</strong></h2><h2 class=\"ql-align-center\"><br></h2><p>Elevate your career in the security industry with our comprehensive unarmed security training course in Nashville, Tennessee. Our expert-led program is designed to equip you with the essential skills and knowledge required to excel in this challenging and rewarding field. From firearms proficiency and tactical awareness to legal considerations and conflict de-escalation, our course covers all aspects of armed security work.</p><p><br></p><p>Throughout this intensive training, you\'ll benefit from hands-on experience with industry-standard equipment, realistic scenario-based exercises, and in-depth classroom instruction. Our curriculum is tailored to meet and exceed Tennessee state requirements, ensuring you\'re fully prepared for certification upon completion. Whether you\'re new to the security field or looking to enhance your existing skills, our course provides the foundation for a successful career in unarmed security. Join us in Nashville and take the first step towards becoming a highly skilled and confident security professional.</p><p><br></p><p>This program is designed to help current unarmed security professionals in Tennessee efficiently update their knowledge and renew their licenses. We\'ll cover the latest industry standards, best practices, and any recent changes in security protocols or regulations that affect unarmed guards. The course includes refreshers on crucial topics such as situational awareness, conflict de-escalation, emergency response procedures, and professional conduct. We\'ll also guide you through the renewal process, ensuring you understand all requirements and deadlines. By completing this course, you\'ll not only meet the state\'s continuing education requirements but also enhance your skills, making you a more effective and valuable security professional.</p>',50.00,50.00,NULL,10,2,'group',0,0,NULL,0,1,'security_training',NULL,NULL,0,0,0,'2026-01-29 23:51:45','2026-01-29 23:51:45'),(33,'2 - Day: Armed Guard Training (Initial course)','Comprehensive training for individuals seeking to become armed security professionals','<h2 class=\"ql-align-center\"><strong style=\"background-color: transparent;\">Unlock Your Full Potential with Our Armed Security Training Course in Nashville, Tennessee!</strong></h2><h2 class=\"ql-align-center\"><br></h2><p class=\"ql-align-center\"><span style=\"color: rgb(0, 0, 0); background-color: transparent;\">Elevate your career in the security industry with our comprehensive armed security training course in Nashville, Tennessee. Our expert-led program is designed to equip you with the essential skills and knowledge required to excel in this challenging and rewarding field. From firearms proficiency and tactical awareness to legal considerations and conflict de-escalation, our course covers all aspects of armed security work.</span></p><p class=\"ql-align-center\"><br></p><p class=\"ql-align-center\"><span style=\"color: rgb(0, 0, 0); background-color: transparent;\">Throughout this intensive training, you\'ll benefit from hands-on experience with industry-standard equipment, realistic scenario-based exercises, and in-depth classroom instruction. Our curriculum is tailored to meet and exceed Tennessee state requirements, ensuring you\'re fully prepared for certification upon completion. Whether you\'re new to the security field or looking to enhance your existing skills, our course provides the foundation for a successful career in armed security. Join us in Nashville and take the first step towards becoming a highly skilled and confident security professional.</span></p><p class=\"ql-align-center\"><br></p><p class=\"ql-align-center\">This program is designed for individuals in Tennessee seeking to become licensed armed security professionals. We\'ll cover essential areas including comprehensive firearms safety protocols, use of force laws, and fundamental threat assessment techniques. The course will thoroughly explore critical topics such as proper weapons handling, situational awareness in armed contexts, and legal responsibilities specific to armed guards. We\'ll guide you through the initial armed license application process, ensuring you meet all state requirements. Additionally, we\'ll introduce you to current security technology and tactics relevant to armed personnel. By completing this course, you\'ll not only fulfill your initial license requirements but also gain the foundational knowledge and skills necessary to become a capable and confident armed security professional in today\'s security landscape.</p><p><br></p>',160.00,160.00,NULL,10,2,'group',0,0,NULL,0,1,'security_training',NULL,NULL,0,0,0,'2026-01-30 00:00:33','2026-01-30 00:00:33'),(34,'2 - Day: Armed Initial + Less Lethal + Dallas Law','Comprehensive starter kit provides everything you need to launch your career in the security industry.','<h2 class=\"ql-align-center\"><strong style=\"background-color: transparent;\">Triple Threat: Arm Yourself with Knowledge</strong></h2><h2 class=\"ql-align-center\"><br></h2><p class=\"ql-align-center\"><span style=\"color: rgb(0, 0, 0); background-color: transparent;\">In this groundbreaking course, we combine three essential aspects of modern security training into one powerful package. Our \"Triple Threat\" approach integrates armed security fundamentals, less lethal tactics, and Dallas-specific legal requirements, creating a uniquely comprehensive learning experience. This innovative program is designed to produce well-rounded security professionals who are prepared for a wide range of scenarios and compliant with the latest regulations.</span></p><p class=\"ql-align-center\"><br></p><p class=\"ql-align-center\">This comprehensive course offers a unique \"Triple Threat\" approach to security training, combining armed security fundamentals, less lethal tactics, and Dallas-specific legal requirements into one integrated program. Designed for aspiring security professionals, this innovative curriculum provides a well-rounded education that prepares participants for a wide range of scenarios while ensuring compliance with the latest regulations. The course covers essential aspects of armed security, introduces various less lethal options, and delves into the specific legal landscape of Dallas. Beyond just imparting knowledge, this program serves as a career advancement roadmap for security professionals. It outlines how each component of the training - Armed Initial, Less Lethal, and Dallas Law compliance - contributes to professional development and opens up new career opportunities. Participants will learn how to leverage these skills to increase their earning potential and position themselves for leadership roles in the security industry. This course is tailored to accelerate career growth, guiding students from entry-level positions towards management roles in the dynamic field of security.</p><p><br></p>',270.00,270.00,NULL,10,2,'group',0,0,NULL,0,1,'security_training',NULL,NULL,0,0,0,'2026-01-30 00:09:09','2026-02-03 20:44:34'),(35,'Armed Guard (Renewal course)','Convenient renewal for armed security personnel.','<h2 class=\"ql-align-center\"><strong style=\"background-color: transparent;\">Unlock Your Full Potential with Our Armed Security Training Course in Nashville, Tennessee!</strong></h2><h2 class=\"ql-align-center\"><br></h2><p class=\"ql-align-center\"><span style=\"color: rgb(0, 0, 0); background-color: transparent;\">Elevate your career in the security industry with our comprehensive armed security training course in Nashville, Tennessee. Our expert-led program is designed to equip you with the essential skills and knowledge required to excel in this challenging and rewarding field. From firearms proficiency and tactical awareness to legal considerations and conflict de-escalation, our course covers all aspects of armed security work.</span></p><p class=\"ql-align-center\"><br></p><p class=\"ql-align-center\"><span style=\"color: rgb(0, 0, 0); background-color: transparent;\">Throughout this intensive training, you\'ll benefit from hands-on experience with industry-standard equipment, realistic scenario-based exercises, and in-depth classroom instruction. Our curriculum is tailored to meet and exceed Tennessee state requirements, ensuring you\'re fully prepared for certification upon completion. Whether you\'re new to the security field or looking to enhance your existing skills, our course provides the foundation for a successful career in armed security. Join us in Nashville and take the first step towards becoming a highly skilled and confident security professional.</span></p><p class=\"ql-align-center\"><br></p><p class=\"ql-align-center\">This program is tailored for experienced armed security professionals in Tennessee who need to update their credentials and refresh their skills. We\'ll cover critical areas including the latest firearms safety protocols, updates to use of force laws, and advanced threat assessment techniques. The course will revisit important topics such as proper weapons handling, situational awareness in armed contexts, and legal responsibilities specific to armed guards. We\'ll also guide you through the armed license renewal process, ensuring you meet all state requirements and deadlines. Additionally, we\'ll discuss recent developments in security technology and tactics relevant to armed personnel.</p><p><br></p><p class=\"ql-align-center\">By completing this course, you\'ll not only fulfill your license renewal obligations but also sharpen your expertise, making you a more capable and confident armed security professional in today\'s evolving security landscape.</p>',70.00,70.00,NULL,10,2,'group',0,0,NULL,0,1,'security_training',NULL,NULL,0,0,0,'2026-02-03 20:48:14','2026-02-03 20:48:14'),(36,'Unarmed Security + Less Lethal + Dallas Law','This bundle will renew your unarmed security registration card and the Less Lethal & Dallas Law.','<h2 class=\"ql-align-center\">Unlock Your Full Potential with Our Online <strong>Unarmed Security + Less Lethal + Dallas Law Course</strong>!</h2><p class=\"ql-align-center\">This all-in-one online training program is designed to help you renew your unarmed security guard license while expanding your skills with less-lethal training and a thorough understanding of Dallas Law requirements. The course covers essential topics such as current security regulations, professional conduct, conflict de-escalation strategies, proper use and limitations of less-lethal tools, emergency response procedures, and the legal rights and responsibilities of unarmed security personnel.</p><p class=\"ql-align-center\">This bundled course fulfills the requirements to renew your unarmed security registration card, complete your less-lethal certification, and meet Dallas Law training standards. You will also receive clear guidance on the renewal process to ensure you remain compliant and in good standing with the appropriate authorities. Once both courses are completed, your official completion certificates will be emailed to you within 24 to 72 hours. By completing this program, you will be fully prepared to continue your career as a professional security guard with updated knowledge, practical skills, and confidence to perform your duties safely and legally.</p>',270.00,270.00,NULL,10,2,'group',0,0,NULL,0,1,'security_training',NULL,NULL,0,0,0,'2026-02-03 21:25:51','2026-02-03 21:25:51'),(37,'Armed Guard Training + Dallas Law + Active Shooter + Less than Lethal','Renew your armed security license with our all-in-one online Armed Guard + Dallas Law + Active Shooter + Less-Lethal Course. Gain essential skills, legal knowledge, and practical training, and receive your completion certificates within 24–72 hours.','<h2 class=\"ql-align-center\">Unlock Your Full Potential with Our Online <strong>Armed Guard Training + Dallas Law + Active Shooter + Less-Lethal Course</strong>!</h2><h2 class=\"ql-align-center\"><br></h2><p class=\"ql-align-center\">This comprehensive online program is designed to provide armed security professionals with all the essential training needed to stay compliant, skilled, and prepared. The course covers key topics such as armed security procedures, Dallas Law regulations, active shooter response strategies, proper handling and limitations of less-lethal tools, emergency preparedness, and the legal responsibilities of armed security personnel.</p><p class=\"ql-align-center\">This bundled course fulfills the requirements to renew your armed security license, complete your Dallas Law training, and gain certifications for active shooter response and less-lethal use. Upon completion, you will receive your official certificates via email within 24 to 72 hours. By completing this program, you will be equipped with the knowledge, practical skills, and confidence needed to perform your duties safely and effectively in today’s security environment.</p>',270.00,270.00,NULL,10,2,'group',0,0,NULL,0,1,'security_training',NULL,NULL,0,0,0,'2026-02-03 21:31:26','2026-02-03 21:31:26'),(38,'Enhanced Arm Guard + Arm Guard Training + Rifle & Shotgun Qualification','Upgrade your credentials with our Enhanced Armed Guard + Armed Guard Training + Rifle & Shotgun Qualification Course. Includes Dallas Law, Less-Lethal, and Active Shooter certifications, plus rifle and shotgun qualification. Receive your certificates within 24–72 hours.','<h2 class=\"ql-align-center\">Take Your Security Skills to the Next Level with Our Online <strong>Enhanced Armed Guard + Armed Guard Training + Rifle &amp; Shotgun Qualification Course</strong>!</h2><h2 class=\"ql-align-center\"><br></h2><p class=\"ql-align-center\">This advanced online program is designed for security professionals seeking to enhance their armed guard credentials and firearms proficiency. The <strong>Armed Guard Training component includes Dallas Law, Less-Lethal, and Active Shooter certifications</strong>, ensuring you are fully compliant and prepared for a wide range of security scenarios. The course covers advanced armed security procedures, legal responsibilities, safe handling of firearms, and specialized training for rifle and shotgun qualification. You will gain practical skills, confidence, and knowledge to perform your duties safely, effectively, and in compliance with all regulatory standards.</p><p class=\"ql-align-center\">This bundled course fulfills the requirements to renew your armed guard license and complete rifle and shotgun qualifications. Upon completion, your official certificates will be emailed to you within 24 to 72 hours. By completing this program, you’ll be fully prepared to operate as a highly trained and qualified armed security professional.</p>',270.00,270.00,NULL,10,2,'group',0,0,NULL,0,1,'security_training',NULL,NULL,0,0,0,'2026-02-03 21:35:03','2026-02-03 21:35:03'),(39,'Less than Lethal + OC Spray + Baton + Flashlights & Restraints','Build confidence with our Less‑Than‑Lethal + OC Spray + Baton + Flashlights & Restraints Course. Learn safe, legal, and effective use of defensive tools and receive your completion certificate within 24–72 hours.','<h2 class=\"ql-align-center\">Strengthen Your Defensive Skills with Our Online <strong>Less‑Than‑Lethal + OC Spray + Baton + Flashlights &amp; Restraints Course</strong>!</h2><p class=\"ql-align-center\">This specialized online training program is designed to equip security professionals with essential knowledge and practical skills for the safe and effective use of less‑than‑lethal tools. The course covers proper handling, legal considerations, and tactical use of OC spray, batons, flashlights, and restraints, along with situational awareness and use‑of‑force guidelines. Emphasis is placed on de‑escalation, personal safety, and responding appropriately to real‑world security situations while remaining compliant with applicable laws and regulations.</p><p class=\"ql-align-center\">Upon completion of this course, you will receive your official completion certificate via email within 24 to 72 hours. This training helps ensure you are prepared to perform your duties confidently, responsibly, and professionally using approved less‑than‑lethal equipment.</p>',270.00,270.00,NULL,10,2,'group',0,0,NULL,0,1,'security_training',NULL,NULL,0,0,0,'2026-02-03 21:39:43','2026-02-03 21:39:43'),(40,'Dallas Law + De-escalation, First Aid, CPR, and AED.','Gain essential legal knowledge and lifesaving skills with our Dallas Law + De-escalation, First Aid, CPR, and AED Course. Receive your completion certificates within 24–72 hours.','<h2 class=\"ql-align-center\">Enhance Your Security Expertise with Our Online <strong>Dallas Law + De-escalation, First Aid, CPR, and AED Course</strong>!</h2><h2 class=\"ql-align-center\"><br></h2><p class=\"ql-align-center\">This comprehensive online program is designed to provide security professionals with the essential legal knowledge and lifesaving skills needed on the job. The course covers Dallas Law regulations, effective de-escalation techniques, and critical emergency response skills including First Aid, CPR, and AED usage. You will learn how to safely manage high-stress situations, respond to medical emergencies, and protect yourself and others while staying fully compliant with local laws.</p><p class=\"ql-align-center\">Upon completion, you will receive your official completion certificates via email within 24 to 72 hours. This training ensures you are prepared to act confidently, professionally, and legally in any security or emergency situation.</p>',270.00,270.00,NULL,10,2,'group',0,0,NULL,0,1,'security_training',NULL,NULL,0,0,0,'2026-02-03 21:41:36','2026-02-03 21:41:36');
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `site_settings`
--

DROP TABLE IF EXISTS `site_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `site_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `header_logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer_logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favicon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `facebook_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quickbooks_client_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quickbooks_client_secret` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quickbooks_company_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quickbooks_environment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'sandbox',
  `quickbooks_access_token` text COLLATE utf8mb4_unicode_ci,
  `quickbooks_refresh_token` text COLLATE utf8mb4_unicode_ci,
  `quickbooks_enabled` tinyint(1) NOT NULL DEFAULT '0',
  `bank_api_provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_api_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_api_secret` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_account_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_sync_enabled` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `jayson_bio` text COLLATE utf8mb4_unicode_ci,
  `kenny_bio` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `site_settings`
--

LOCK TABLES `site_settings` WRITE;
/*!40000 ALTER TABLE `site_settings` DISABLE KEYS */;
INSERT INTO `site_settings` VALUES (1,'settings/HkTP9i1aGr2s3JE4ZjbSLyyEblos0ANba3URBzp9.png','settings/dPSM1qh74nks4mPtEAjQejcrYwr3J2ZBDyucSxEa.png','settings/DaIIEUGQHDsFNSCTsNKxgwP8QdGGyepJCtN37Ipr.png','615-554-1131','tnvetsecsvctrng@gmail.com','123 Security Way,\r\nNashville, TN 37201',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'sandbox',NULL,NULL,0,NULL,NULL,NULL,NULL,0,'2026-01-12 13:30:50','2026-01-28 19:38:53',NULL,NULL);
/*!40000 ALTER TABLE `site_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Super Admin','admin@admin.com','profiles/tX5Ggifkdjt6eFFPmdloiGLFs99HtZ2wSNyqif7O.jpg',NULL,'$2y$12$T9.zhU.ZeaSdCwIQi2RaWO78E.qibh7giBZyXVvcQ8jSwuWmXWAZa','sEUl5rJo07i0CtzNbaAIVfP441pS5hnQMuExjpp0ARpgM6d7xYorz3I4JUzf','2026-01-12 12:47:43','2026-01-28 19:39:07');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-02-11 18:58:29
