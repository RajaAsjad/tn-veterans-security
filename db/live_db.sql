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
INSERT INTO `class_schedules` VALUES (4,7,'2026-01-22','12:12:00','20:12:00',8,10,2,0,'Class A 03',NULL,'Jayson Wheat',1,'scheduled','Testing','2026-01-20 17:38:22','2026-01-20 17:38:22'),(5,7,'2026-01-23','15:21:00','23:21:00',8,10,2,2,'Class A 03',NULL,'Jayson Wheat',1,'scheduled','Testing','2026-01-20 17:38:22','2026-01-21 10:55:00'),(6,7,'2026-01-27','08:42:00','16:42:00',8,10,2,0,'Class A 03',NULL,'Jayson Wheat',1,'scheduled','Testing','2026-01-20 17:38:22','2026-01-20 17:38:22'),(7,1,'2026-01-22','11:11:00','16:11:00',5,8,4,0,'Class A 7',NULL,'Jayson',1,'scheduled','test','2026-01-20 17:45:12','2026-01-21 14:42:14'),(8,1,'2026-01-24','07:50:00','15:50:00',8,10,2,0,'class A 09',NULL,'Jayson ww',1,'scheduled','testing','2026-01-20 17:45:50','2026-01-20 17:45:50'),(9,3,'2026-01-23','16:00:00','08:00:00',16,10,1,0,'32123',NULL,'Jack',1,'scheduled',NULL,'2026-01-21 13:34:30','2026-01-21 13:34:30'),(10,2,'2026-01-30','17:00:00','01:00:00',8,10,2,0,'Class A17',NULL,'Jack son',1,'scheduled',NULL,'2026-01-21 13:36:22','2026-01-21 13:36:22'),(11,2,'2026-01-31','18:00:00','02:00:00',8,10,2,0,'Class A17',NULL,'Jack son',1,'scheduled',NULL,'2026-01-21 13:36:22','2026-01-21 13:36:22'),(12,26,'2026-01-29','03:50:00','07:50:00',4,10,1,0,'1231231','Location A','Jayson ww',1,'scheduled','Dallas Law Training',NULL,NULL),(13,26,'2026-01-29','03:50:00','07:50:00',4,10,1,3,'1231231','Location B','Jayson ww',1,'scheduled','Dallas Law Training',NULL,'2026-01-28 13:02:14'),(14,26,'2026-01-30','18:51:00','20:51:00',2,10,1,0,'Class A 7','Location A','Jack',1,'scheduled','Lethal Less Traning',NULL,NULL),(15,26,'2026-01-30','18:51:00','20:51:00',2,10,1,0,'Class A 7','Location B','Jack',1,'scheduled','Lethal Less Traning',NULL,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES (1,'Json','customer@customer.com','$2y$12$8DaIhkSdBoi8p.qXc7Vx2e6vLsM7EoqFMg5jEXHp9my/ezenSegyK','1231231231','44075 Pipeline Plaza Ste. 125','customer-profiles/ypHnHGAPwms3tWX1LKRFVVoRsdJauW0s2fhODHqd.jpg',NULL,NULL,'2026-01-12 17:14:44','2026-01-12 17:23:51'),(2,'Production Head','student@gmail.com','$2y$12$UUuPm.bnIhlqLJxz.CaNoucS8AXcrpeLKj6pxybDRUXFc7OU5RpkG','1231231231','44075 Pipeline Plaza Ste. 125','customer-profiles/wkdK2E1C1UA412Lf2KWEfXg6GXbWUYGl5vnsaJ6k.jpg',NULL,NULL,'2026-01-20 18:19:20','2026-01-20 18:21:46'),(3,'Jack','jack@gemail.com','$2y$12$qd5xtI0IzfwvE5CUrR2hNeObl5hHF1zY1LkjVodoi/wZ3H/EX/Qzi','1231231231','44075 Pipeline Plaza Ste. 132',NULL,NULL,NULL,'2026-01-21 10:35:40','2026-01-21 10:35:40'),(4,'Arthur Stewart','myzemalof@mailinator.com','$2y$12$fj7PJKkg5C80/llqTmv3Euz4wpIAjkuo00C/X0bAUk9T5omKXtg2e','+1 (711) 955-7239',NULL,NULL,NULL,NULL,'2026-02-17 21:42:16','2026-02-17 21:42:16'),(5,'Zachary Petty','qinigon@mailinator.com','$2y$12$YBCTP39rRRz.SCIVmYIpr.tgB/u2NI5bOcqifo2riayCsciAWdOV.','+1 (624) 201-5859',NULL,NULL,NULL,NULL,'2026-02-17 21:44:36','2026-02-17 21:44:36'),(6,'James Allen','james@americandigitalagency.us','$2y$12$N3g11kvp74fJAPhPt.5HyOyyGpIZTJMs/g6QrFDHtRYK.2GI0qbE2','1234356789',NULL,NULL,NULL,NULL,'2026-02-25 15:38:33','2026-02-25 15:38:33');
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
INSERT INTO `payments` VALUES (1,1,2,40.00,'deposit','cash','pending',NULL,NULL,NULL,0,NULL,NULL,NULL,0,NULL,NULL,'2026-01-20','2026-01-20 18:21:08','2026-01-20 18:21:08'),(2,2,3,100.00,'deposit','credit_card','completed','1231231231111111',NULL,NULL,1,'154','155','2026-02-13 20:33:17',0,NULL,NULL,'2026-01-21','2026-01-21 10:55:21','2026-02-13 20:33:17'),(3,3,2,300.00,'deposit','credit_card','completed','1231231231',NULL,NULL,1,'156','157','2026-02-13 20:33:24',0,NULL,NULL,'2026-01-28','2026-01-28 13:02:30','2026-02-13 20:33:24'),(4,5,5,20.00,'deposit','credit_card','completed',NULL,'quickbooks_payments','{\"charge_id\":null}',1,'164','165','2026-02-17 21:45:42',0,NULL,NULL,'2026-02-17','2026-02-17 21:45:33','2026-02-17 21:45:42');
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
INSERT INTO `service_bookings` VALUES (1,2,1,'2026-01-22','11:11:00','completed','Testing','2026-01-20 18:20:37','2026-01-21 14:42:13',7,NULL,380.00,40.00,340.00,'deposit_paid','group',4,'Team 2'),(2,3,7,'2026-01-23','15:21:00','confirmed',NULL,'2026-01-21 10:55:00','2026-01-21 10:55:21',5,NULL,400.00,100.00,300.00,'deposit_paid','group',2,NULL),(3,2,26,'2026-01-29','03:50:00','confirmed',NULL,'2026-01-28 13:02:14','2026-01-28 13:02:30',13,'Location B',300.00,300.00,0.00,'deposit_paid','group',3,'Test'),(4,4,35,'2026-02-17',NULL,'pending',NULL,'2026-02-17 21:42:20','2026-02-17 21:42:20',NULL,NULL,100.00,20.00,80.00,'pending','group',1,'Arthur Stewart'),(5,5,35,'2026-02-17',NULL,'confirmed',NULL,'2026-02-17 21:44:38','2026-02-17 21:45:33',NULL,NULL,1700.00,20.00,1680.00,'deposit_paid','group',17,'Zachary Petty'),(6,5,35,'2026-02-17',NULL,'pending',NULL,'2026-02-17 21:54:15','2026-02-17 21:54:15',NULL,NULL,1700.00,20.00,1680.00,'pending','group',17,'Zachary Petty');
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
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_relationships`
--

LOCK TABLES `service_relationships` WRITE;
/*!40000 ALTER TABLE `service_relationships` DISABLE KEYS */;
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
  `categories` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` VALUES (1,'Armed Security Certification','Armed Security Certification provides advanced training in firearm safety, legal use of force, and tactical response for professional armed security roles.','<p>Armed Security Certification is an advanced training program designed for individuals pursuing or currently working in armed security positions. This certification equips participants with the knowledge, skills, and discipline required to carry and use firearms responsibly while performing protective duties.</p><p><br></p><p>The program covers firearm safety, weapons handling, marksmanship fundamentals, and safe storage, along with critical instruction on use-of-force laws, legal responsibilities, and ethical decision-making. Participants receive scenario-based training to develop judgment, threat assessment, and controlled response under high-stress conditions.</p><p><br></p><p>Additional focus areas include defensive tactics, situational awareness, communication, and coordination with law enforcement and emergency responders. Emphasis is placed on professionalism, accountability, and compliance with state and employer regulations.</p><p><br></p><p>Armed Security Certification is ideal for security professionals seeking armed assignments in corporate, residential, event, or high-risk environments. Completion of this training demonstrates readiness, competence, and commitment to maintaining the highest standards of safety and professionalism in armed protective services.</p>',95.00,10.00,NULL,10,2,'group',1,0,'services/gV79EbBPvkL16BCvQpqhb9gatnK9A8slmsv2OhsR.jpg',1,1,NULL,NULL,NULL,0,0,0,'2026-01-12 12:52:47','2026-01-21 12:52:40',NULL),(2,'Force Science (De-escalation)','Force Science (De-escalation) training teaches evidence-based techniques to reduce conflict, manage behavior, and safely resolve high-stress encounters.','<p>Force Science (De-escalation) training is a research-driven program focused on understanding human behavior, stress responses, and decision-making during high-risk or emotionally charged situations. This training equips participants with proven de-escalation strategies to prevent situations from escalating into physical force.</p><p><br></p><p>The course emphasizes verbal communication skills, body language awareness, distance management, and emotional regulation to influence behavior and maintain control. Participants learn how stress, perception, and cognitive limitations affect both responders and subjects, enabling safer and more effective interactions.</p><p><br></p><p>Scenario-based training reinforces practical application, teaching participants how to recognize warning signs, apply tactical patience, and choose appropriate responses while remaining legally and ethically compliant. The program also addresses use-of-force decision-making, accountability, and post-incident considerations.</p><p><br></p><p>Force Science (De-escalation) training is ideal for security officers, guards, supervisors, and individuals preparing for future security careers. It promotes professionalism, safety, and confidence while reducing risk, liability, and unnecessary use of force in protective service environments.</p>',200.00,100.00,NULL,10,2,'group',1,0,'services/lu6mY6GfYotlfByxzKUFWSukJnAC0U7JU5BTDtDD.jpg',3,1,NULL,NULL,NULL,0,0,0,'2026-01-12 13:00:45','2026-01-21 12:58:40',NULL),(3,'ASP (Batons and Restraints)','ASP (Batons and Restraints) training teaches proper baton use and restraint techniques for safely controlling and managing resistant or aggressive individuals.','<p>ASP (Batons and Restraints) training provides essential instruction in the safe, legal, and effective use of expandable batons and restraint devices for security and protective service professionals. This program emphasizes control, officer safety, and minimizing injury while managing confrontational or non-compliant situations.</p><p><br></p><p>Participants learn correct baton handling, striking zones, defensive techniques, and retention methods, along with proper application of restraints such as handcuffs and control devices. The training includes use-of-force guidelines, legal considerations, and decision-making to ensure actions are justified, proportional, and compliant with industry standards.</p><p><br></p><p>Scenario-based exercises help develop practical skills in de-escalation, subject control, team coordination, and situational awareness. Strong emphasis is placed on professionalism, accountability, and post-incident procedures, including reporting and subject care.</p><p><br></p><p>This training is ideal for security officers, guards, and individuals preparing for future security roles who require intermediate force options to maintain safety and control in dynamic environments.</p>',100.00,50.00,NULL,10,2,'group',0,0,'services/BkxqE6w72S4gcPBjXi06KoDngDnDNdh1cV4KJlne.png',2,1,NULL,NULL,NULL,0,0,0,'2026-01-12 13:13:46','2026-01-21 12:55:06',NULL),(4,'NRA (Advanced Handgun Carry)','NRA Advanced Handgun Carry training develops advanced handgun skills, defensive carry techniques, and responsible decision-making for armed professionals and qualified civilians.','<p>NRA Advanced Handgun Carry is an advanced-level firearms training program designed to enhance defensive handgun proficiency for individuals who carry a firearm for personal protection or professional duties. This course builds on fundamental handgun skills and focuses on real-world defensive carry scenarios.</p><p><br></p><p>Training includes advanced marksmanship, drawing from concealment, movement, use of cover, threat assessment, and defensive shooting techniques. Strong emphasis is placed on firearm safety, legal considerations, and responsible use of force in accordance with applicable laws.</p><p><br></p><p>Participants also learn mindset development, situational awareness, and decision-making under stress through scenario-based instruction. The course reinforces safe gun handling, accountability, and ethical responsibilities associated with carrying a handgun in public or professional environments.</p><p><br></p><p>NRA Advanced Handgun Carry is ideal for armed security personnel, protective service professionals, and experienced civilian carriers seeking to elevate their skills, confidence, and readiness while maintaining the highest standards of safety and professionalism.</p>',150.00,50.00,NULL,10,2,'group',0,0,'services/BrCipzeQ82L1MONsdaonwzCkq716sIzeq16tvNiU.jpg',4,1,NULL,NULL,NULL,0,0,0,'2026-01-12 13:14:51','2026-01-21 13:00:00',NULL),(6,'Red Cross (First Aid, CPR, and AED)','Red Cross First Aid, CPR, and AED training equips individuals with lifesaving skills to respond confidently to medical emergencies.','<p>Red Cross First Aid, CPR, and AED training provides comprehensive, nationally recognized instruction in emergency medical response for adults, children, and infants. This course prepares participants to act quickly and effectively during medical emergencies until professional help arrives.</p><p><br></p><p>Training covers essential first aid skills, including bleeding control, wound care, shock management, and response to common injuries and illnesses. Participants also receive hands-on instruction in cardiopulmonary resuscitation (CPR) and the safe, effective use of Automated External Defibrillators (AEDs).</p><p><br></p><p>Emphasis is placed on scene safety, emergency assessment, teamwork, and legal considerations such as Good Samaritan protections. Practical scenarios build confidence, coordination, and readiness in high-stress situations.</p><p><br></p><p>This training is ideal for security officers, guards, workplace teams, educators, and individuals preparing for future security or protective service roles. Certification demonstrates preparedness, responsibility, and commitment to safety in any environment.</p>',300.00,100.00,NULL,10,2,'group',0,0,'services/KWZGG0VFBFUh0fYE2nBcZwcB3brTGSyqhb2PavAq.jpg',6,1,NULL,NULL,NULL,0,0,0,'2026-01-12 13:18:51','2026-01-21 13:02:32',NULL),(7,'ALERRT (Active Shooter)','ALERRT (Active Shooter) training prepares individuals to recognize, respond to, and survive active shooter and hostile threat incidents.','<p>ALERRT (Advanced Law Enforcement Rapid Response Training) – Active Shooter training is a nationally recognized, research-based program designed to prepare individuals and organizations for rapid and effective response to active shooter and hostile threat events.</p><p><br></p><p>The training focuses on threat recognition, situational awareness, and immediate response strategies to reduce harm and save lives. Participants learn proven concepts such as movement during high-risk incidents, decision-making under stress, communication, coordination with first responders, and lifesaving medical response including bleeding control.</p><p><br></p><p>Scenario-based instruction reinforces practical application, helping participants understand attacker behavior, response priorities, and survival principles. The program emphasizes prevention, preparedness, and recovery while maintaining legal and ethical responsibilities.</p><p><br></p><p>ALERRT Active Shooter training is ideal for security officers, guards, school staff, healthcare workers, corporate teams, and individuals preparing for future security roles. Completion of this training increases confidence, readiness, and the ability to act decisively during critical incidents.</p>',200.00,50.00,NULL,10,2,'group',1,0,'services/zzHmHY9InmzwDnFkFocKwdNPsTCLP3vNFTmW9ZIm.jpg',7,1,NULL,NULL,NULL,0,0,0,'2026-01-20 16:43:51','2026-01-21 13:03:55',NULL),(20,'Refuse to be the Victim','NRA personal safety and crime prevention program.','<p><span style=\"color: rgb(71, 85, 105);\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</span></p>',NULL,NULL,NULL,10,2,'group',0,0,NULL,12,1,'nra','Refuse to be the Victim',NULL,0,0,0,'2026-01-27 11:47:18','2026-02-13 18:41:34','[\"nra\"]'),(26,'Unarmed Guard Training','4-hour comprehensive training program for unarmed security officers.',NULL,100.00,100.00,NULL,10,2,'group',0,0,NULL,1,1,'security_training','Unarmed Guard Training',NULL,0,0,0,'2026-01-27 16:32:33','2026-01-27 18:04:02',NULL),(27,'Armed Security Certification','Complete armed security guard certification program. Available at Location A and Location B.',NULL,NULL,NULL,NULL,10,2,'group',0,1,NULL,2,1,'security_training','Armed Security Certification',NULL,0,0,0,'2026-01-27 16:32:33','2026-01-27 16:32:33',NULL),(30,'Enhanced Handgun Carry Permit','Enhanced handgun carry permit training and certification.',NULL,NULL,NULL,NULL,10,2,'group',0,1,NULL,7,1,'security_training','Enhanced Handgun Carry Permit',NULL,0,0,0,'2026-01-27 16:32:33','2026-01-27 16:32:33',NULL),(32,'New Shooter','Lorem ipsum dolor sit amet, consectetur adipiscing elit,','<p><span style=\"color: rgb(71, 85, 105);\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"</span></p>',NULL,NULL,NULL,10,2,'group',0,0,NULL,0,1,'nra',NULL,NULL,0,0,0,'2026-02-09 18:21:37','2026-02-13 19:02:43','[\"nra\"]'),(33,'Pistol Training','Lorem ipsum dolor sit amet, consectetur adipiscing elit,','<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"</p>',100.00,NULL,NULL,10,2,'group',0,0,NULL,0,1,'nra',NULL,NULL,0,0,0,'2026-02-10 16:35:31','2026-02-13 18:22:18','[\"nra\"]'),(34,'Rifle Training','Lorem ipsum dolor sit amet, consectetur adipiscing elit,','<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',100.00,NULL,NULL,10,2,'group',0,0,NULL,0,1,'nra',NULL,NULL,0,0,0,'2026-02-10 16:39:12','2026-02-13 18:23:14','[\"nra\"]'),(35,'Shotgun Training','lorem ipsum dolor sit amet, consectetur adipiscing elit,','<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',100.00,NULL,NULL,10,2,'group',0,0,NULL,0,1,'nra',NULL,NULL,0,0,0,'2026-02-10 16:42:52','2026-02-13 18:40:10','[\"nra\"]'),(37,'Private Instruction','Lorem ipsum dolor sit amet, consectetur adipiscing elit','<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>',0.00,NULL,NULL,10,2,'group',0,0,NULL,0,1,'nra',NULL,NULL,0,0,0,'2026-02-10 16:48:31','2026-02-13 18:42:08','[\"nra\"]'),(38,'BLS Blended','This Basic Life Support (BLS) certification course provides the training needed to respond to life-threatening emergencies. Individuals will learn high-quality CPR for adults, children, and infants, how to use an AED, and how to relieve choking safely and effectively. The course also covers teamwork during emergencies and how to quickly recognize cardiac arrest and other critical situations.','<p>This Basic Life Support (BLS) certification course provides comprehensive training to help individuals respond quickly and effectively during life-threatening emergencies. The course teaches high-quality CPR for adults, children, and infants, proper use of an Automated External Defibrillator (AED), and safe techniques for relieving choking. Participants will also learn how to recognize cardiac arrest, respiratory distress, and other medical emergencies that require immediate action.</p><p>In addition to hands-on skills, the training emphasizes teamwork, communication, scene safety, and following current emergency response guidelines. Individuals will gain the confidence and knowledge needed to act decisively in workplaces, healthcare settings, schools, and public environments. Upon completion, participants will be better prepared to provide critical lifesaving care until advanced medical help arrives.</p>',0.00,NULL,NULL,10,2,'group',0,0,NULL,0,1,'red_cross',NULL,NULL,0,0,0,'2026-02-10 17:19:46','2026-02-25 20:59:30','[\"red_cross\"]'),(39,'First Aid CPR AED Blended','Lorem Ipsum is simply dummy text of the printing and typesetting industry.','<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>',0.00,NULL,NULL,10,2,'group',0,0,NULL,0,1,'red_cross',NULL,NULL,0,0,0,'2026-02-10 17:25:03','2026-02-10 17:37:47',NULL),(41,'Baton','Lorem Ipsum is simply dummy text of the printing and typesetting industry.','<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>',0.00,NULL,NULL,10,2,'group',0,0,NULL,0,1,'asp_less_than_lethal',NULL,NULL,0,0,0,'2026-02-10 17:39:37','2026-02-13 18:44:28','[\"asp_less_than_lethal\"]'),(42,'Enhanced Handgun Permit','Lorem Ipsum is simply dummy text of the printing and typesetting industry.','<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>',0.00,NULL,NULL,10,2,'group',0,0,NULL,0,1,'homeland_security',NULL,NULL,0,0,0,'2026-02-10 17:43:06','2026-02-13 18:48:07','[\"homeland_security\"]'),(43,'Unarmed Renewal 2 Years','Lorem Ipsum is simply dummy text of the printing and typesetting industry.','<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>',0.00,NULL,NULL,10,2,'group',0,0,NULL,0,1,'renewals',NULL,NULL,0,0,0,'2026-02-10 17:46:35','2026-02-13 18:58:21','[\"renewals\"]'),(46,'Restraints','Lorem Ipsum is simply dummy text of the printing and typesetting industry.','<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>',0.00,NULL,NULL,10,2,'group',0,0,NULL,0,1,'asp_less_than_lethal',NULL,NULL,0,0,0,'2026-02-11 11:18:44','2026-02-11 11:18:44',NULL),(47,'OC  Spray','Lorem Ipsum is simply dummy text of the printing and typesetting industry.','<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>',0.00,NULL,NULL,10,2,'group',0,0,NULL,0,1,'asp_less_than_lethal',NULL,NULL,0,0,0,'2026-02-11 11:20:31','2026-02-13 18:46:16','[\"asp_less_than_lethal\"]'),(48,'Flashlight','Lorem Ipsum is simply dummy text of the printing and typesetting industry.','<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>',0.00,NULL,NULL,10,2,'group',0,0,NULL,0,1,'asp_less_than_lethal',NULL,NULL,0,0,0,'2026-02-11 11:22:04','2026-02-13 18:46:58','[\"asp_less_than_lethal\"]'),(49,'Active Shooter','Lorem Ipsum is simply dummy text of the printing and typesetting industry.','<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>',0.00,NULL,NULL,10,2,'group',0,0,NULL,0,1,'active_shooter',NULL,NULL,0,0,0,'2026-02-11 11:26:18','2026-02-13 22:19:22','[\"active_shooter\"]'),(50,'Unarmed  Security','This unarmed security certification training is for individuals who want to become licensed security guards. The course covers basic security procedures, observation skills, report writing, and state laws. It prepares students to work safely and professionally in unarmed security positions.','<p>This <strong>unarmed security certification</strong> course provides the required training to become a l <strong>certified unarmed security guard</strong>. Individuals will learn essential security procedures, patrol techniques, emergency response protocols, observation and documentation skills, conflict management, and proper report writing. The course also covers state laws, use-of-force guidelines, ethics, and professional standards expected in the security industry.</p><p>Individuals will gain practical knowledge on how to handle real-world situations such as disturbances, suspicious activity, and workplace incidents while maintaining safety and professionalism. By the end of the course, participants will be prepared to perform their duties confidently, responsibly, and effectively in a variety of security settings including offices, retail locations, events, and residential properties.</p>',0.00,NULL,NULL,10,2,'group',0,0,NULL,0,1,'security_guard',NULL,NULL,0,0,0,'2026-02-11 11:30:29','2026-02-25 17:11:14','[\"security_training\"]'),(51,'Armed  Security',NULL,'<p><br></p>',0.00,NULL,NULL,10,2,'group',0,0,NULL,0,1,'security_guard',NULL,NULL,0,0,0,'2026-02-11 11:32:27','2026-02-25 02:39:16','[\"security_training\"]'),(53,'De-escalation',NULL,'<p><br></p>',0.00,NULL,NULL,10,2,'group',0,0,NULL,0,1,'dallas_law',NULL,NULL,0,0,0,'2026-02-11 11:39:58','2026-02-25 02:38:19','[\"dallas_law\"]'),(55,'First Aid CPR AED',NULL,'<p><br></p>',0.00,NULL,NULL,10,2,'group',0,0,NULL,0,1,'dallas_law',NULL,NULL,0,0,0,'2026-02-11 11:43:59','2026-02-25 02:37:44','[\"red_cross\",\"dallas_law\"]'),(56,'Armed Renewal 2 Years','Renewing your Tennessee Armed Guard license makes sure you are still trained and ready to carry a firearm while working security. During renewal, you review the laws, re‑qualify with your firearm, and confirm you still meet all state requirements. This process helps keep armed security officers safe, responsible, and prepared to do their job the right way.','<p>Renewing your Tennessee Armed Guard license is an important step that makes sure you stay trained, responsible, and ready to carry a firearm while working security. The state requires armed guards to renew their license every year so they can stay up to date on the laws, safety rules, and skills needed to work with a firearm in public.</p><p>During the renewal process, armed guards review Tennessee use‑of‑force laws, learn about any changes in state regulations, and go over the responsibilities that come with carrying a weapon on duty. A big part of renewal is the annual firearms requalification, where officers must show they can safely handle, load, fire, and control their weapon. This helps prove that the officer can still use their firearm safely and confidently.</p><p>Renewal also confirms that the officer still meets all state requirements, such as having a clean background, being mentally and physically able to perform the job, and following all rules set by Tennessee Private Protective Services. By completing the renewal each year, armed guards show they are committed to professionalism, safety, and protecting the people and property they are assigned to watch.</p>',70.00,30.00,NULL,10,2,'group',0,0,NULL,0,1,'renewals',NULL,NULL,0,0,0,'2026-02-11 11:46:33','2026-02-25 19:30:20','[\"renewals\"]'),(58,'Enhanced Armed Guard To be Determined','The Enhanced Armed Guard endorsement is required for officers carrying rifles or shotguns on duty. Applicants must have 5 years of full‑time law enforcement experience or 4 years of active‑duty military service in a combat MOS. This endorsement adds advanced firearms training and higher‑level decision‑making standards for elevated‑risk assignments.','<p>The Tennessee Enhanced Armed Guard endorsement is a specialized credential for security professionals who carry rifles or shotguns in the performance of duty. This endorsement reflects a higher level of responsibility, training, and operational readiness than the standard armed guard license. It is designed for officers working in elevated‑risk environments where long‑gun deployment may be necessary, such as critical infrastructure, high‑value asset protection, or specialized response roles.</p><p>Enhanced Armed Guards are expected to demonstrate advanced judgment, disciplined firearm handling, and the ability to operate safely under pressure. The training emphasizes threat assessment, legal considerations, safe long‑gun operation, and the elevated standards required when carrying weapons with greater range, penetration, and tactical impact. Officers learn to evaluate rapidly changing situations, maintain strict muzzle discipline, and apply force only when legally justified and tactically appropriate.</p><p>This endorsement ensures that only individuals with proven high‑risk experience and advanced weapons proficiency are authorized to carry long guns in a security capacity. It reinforces professionalism, accountability, and the heightened expectations placed on officers trusted with greater firepower.</p><p>Eligibility Requirements</p><p>To qualify for the Tennessee Enhanced Armed Guard endorsement, applicants must meet one of the following background requirements:</p><p>• A minimum of 5 years of full‑time law enforcement service, or</p><p>• A minimum of 4 years of active‑duty military service in a combat MOS</p><p>These requirements ensure that Enhanced Armed Guards have real‑world experience in high‑stress environments where disciplined firearm handling and sound judgment are essential.</p><p>Training and Certification Requirements</p><p>Applicants must also hold a valid Tennessee Armed Guard registration, complete the Enhanced Armed Guard training course, pass the written exam, and successfully complete the advanced firearms qualification for long‑gun proficiency. All required state applications and fees must be submitted for approval.</p><p>Why This Endorsement Matters</p><p>The Enhanced Armed Guard credential signals that an officer has proven experience in tactical or high‑risk environments, advanced firearms discipline, and the decision‑making skills needed for elevated‑risk assignments. It is often required for roles involving critical infrastructure, executive protection, high‑value transport, and environments where long‑gun capability is part of the security posture.</p>',150.00,30.00,NULL,10,2,'group',0,0,NULL,0,1,'renewals',NULL,NULL,0,0,0,'2026-02-11 11:50:20','2026-02-25 02:23:36','[\"security_training\",\"renewals\"]'),(59,'Dallas Law Renewal 2 Years','Dallas Law requires any security officer working at a Tennessee establishment that serves alcohol to complete additional training in de‑escalation, safe restraint techniques, CPR, and First Aid. This training must be completed within 15 days of assignment and refreshed before renewal to ensure officers can safely manage incidents in alcohol‑related environments.','<p>Dallas Law is a Tennessee statute that establishes enhanced training standards for security officers working in environments where alcohol is served. The law was created to improve safety, reduce unnecessary force, and ensure that officers assigned to bars, restaurants, nightclubs, event venues, and other on‑premises alcohol establishments are properly prepared for the unique risks associated with those settings.</p><p>Under Dallas Law, any armed or unarmed security officer working at an alcohol‑licensed location must complete additional training within 15 days of assignment. This training covers four essential areas: de‑escalation, safe restraint techniques, CPR, and First Aid. These skills address the most common challenges in alcohol‑related environments, where impaired judgment, heightened emotions, and unpredictable behavior can quickly escalate into medical or physical emergencies.</p><p>For annual renewal, officers must show that they have maintained this training and remain current on all Dallas Law requirements. This ensures that personnel working around alcohol can manage confrontations professionally, respond to medical issues effectively, and apply force only when necessary and appropriate. Dallas Law raises the standard of care for security operations in alcohol‑serving establishments and reinforces the officer’s responsibility to protect patrons, staff, and the public</p>',60.00,60.00,NULL,10,2,'group',1,0,NULL,0,1,'renewals',NULL,NULL,0,0,0,'2026-02-11 11:53:26','2026-02-25 02:10:24','[\"renewals\"]'),(60,'Active Shooter Renewal Annual','A focused refresher course that reinforces critical response principles, threat recognition, rapid decision‑making, and coordinated action during active‑shooter events. Students review updated best practices, strengthen their situational awareness, and practice clear, decisive communication to improve safety and survivability.','<p>Our Active Shooter Annual Renewal course reinforces the critical skills security professionals need to respond decisively during violent‑intruder events. This annual refresher focuses on updated best practices, threat recognition, rapid decision‑making, and coordinated movement under pressure. Students review core response principles, strengthen situational awareness, and practice clear, assertive communication that supports safer outcomes.</p><p>Through scenario‑based discussion and practical application, participants sharpen their ability to assess evolving threats, guide others to safety, and work effectively with responding law enforcement. This course ensures officers remain confident, current, and prepared to act with purpose when seconds matter.</p>',75.00,30.00,NULL,10,2,'group',0,0,NULL,0,1,'renewals',NULL,NULL,0,0,0,'2026-02-11 11:55:24','2026-02-25 02:01:04','[\"renewals\"]'),(61,'Force Science (De-Escalation)','A focused, scenario‑based class that teaches security officers how to stay calm, read behavior, and guide tense situations toward safe, voluntary compliance. Students learn practical communication skills, proven de‑escalation strategies, and a structured approach they can use immediately on shift.','<p class=\"ql-align-justify\"><br></p><p>Our De‑Escalation Training course gives security officers the practical tools they need to confidently manage tense situations while maintaining safety, professionalism, and control. Built on proven principles from Force Science, behavioral psychology, and real‑world security operations, this class focuses on what officers actually face on shift—not theory, but usable skills.</p><p>Participants learn how to recognize behavioral cues, reduce emotional&nbsp;</p>',200.00,30.00,NULL,10,2,'group',1,0,NULL,0,1,'force_science',NULL,NULL,0,0,0,'2026-02-12 10:39:28','2026-02-25 01:57:45','[\"force_science\"]'),(62,'Less Lethal','Less‑than‑lethal tools are items security officers use to control someone without using deadly force. These tools are meant to stop a person, slow them down, or protect the officer while causing only temporary pain or discomfort. Common examples include pepper spray, batons, Tasers, and handcuffs. Tennessee requires officers to be trained before they can carry or use any of these tools on duty.','<p>In Tennessee security work, “less‑than‑lethal” refers to tools that are designed to stop or control a person without causing death. These tools give security officers safe options to handle problems before a situation becomes dangerous. They are meant to cause temporary pain, discomfort, or loss of movement so the officer can take control without using deadly force.</p><p>Less‑than‑lethal tools are important because security officers often deal with people who are angry, aggressive, or refusing to follow instructions. These tools help officers protect themselves and others while lowering the chance of serious injury. Common less‑than‑lethal tools include pepper spray, batons, Tasers, and handcuffs. Each tool works in a different way, but all of them are meant to control a person safely and quickly.</p><p>Tennessee requires security officers to be properly trained before they can carry or use any less‑than‑lethal device. Training teaches officers how each tool works, when it is allowed, and how to use it without causing unnecessary harm. Officers also learn the laws about force, how to give clear commands, and how to check on a person after the tool is used.</p><p>Less‑than‑lethal tools help officers stay professional, make good decisions, and keep situations from getting out of control. By using these tools correctly, security officers can protect people, avoid injuries, and handle problems in a safe and responsible way.</p>',NULL,NULL,NULL,10,2,'group',0,0,NULL,0,1,NULL,NULL,NULL,0,0,0,'2026-02-25 02:37:00','2026-02-25 02:37:00','[]');
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
INSERT INTO `sessions` VALUES ('K4RfX4ByzEt88Q1UEEjhwO4PnZwrcvnrEP89f8Sn',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoibHByT3laeDhSN3FHZVI1ZVhQMHp3WU5jY3ozM3pmcnNUdnZ1dWV4RCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1771004556),('qV8XNTi6geLDFYUgHFEtPkIQEwyi1M4keAAmUeZW',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoidFZyRHg3RDdCRnJvcHBXWG1xcGZseWJ1Z1JxWHl3RjYzTXpjcmJLRCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hbGwtc2VydmljZXMiO3M6NToicm91dGUiO3M6MTI6ImFsbC1zZXJ2aWNlcyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==',1770932663),('UZJoZT24pf19CZEBBts3FtvLhv85YT1mPfrZgVrh',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVkpCSHhMY1g3QWtvYWdQUDRDalpyeEtUZGNiVkhtTktmT1JjY2tSNyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hbGwtc2VydmljZXMiO3M6NToicm91dGUiO3M6MTI6ImFsbC1zZXJ2aWNlcyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==',1770913278);
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
  `square_application_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `square_access_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `square_location_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `square_environment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'sandbox',
  `square_enabled` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `site_settings`
--

LOCK TABLES `site_settings` WRITE;
/*!40000 ALTER TABLE `site_settings` DISABLE KEYS */;
INSERT INTO `site_settings` VALUES (1,'settings/QIyXAmLmzsobqiIVvP435nLZYmDIrOQk6IcaoNvk.png','settings/EML3A39NnBHsnS4YBf1kuWWOOGt6SQdmZUrsndGd.png','settings/OG6zOg9uaaYdiNqAacR7IEyK8X5DP3hhCu0vRL3j.png','615-554-1131','tnvetsecsvctrng@gmail.com','123 Security Way,\r\nNashville, TN 37201',NULL,NULL,NULL,NULL,NULL,'AB0rfAJ4fBfjUdm23xtDaBr8R95pzD0D0MNqeSGuvsVpURht4a','l6vtWPm9Q8RuJlLxy1T0gSX9vIt6mD0EY2S3tj9L','9341456376232298','sandbox','eyJhbGciOiJkaXIiLCJlbmMiOiJBMTI4Q0JDLUhTMjU2IiwieC5vcmciOiJIMCJ9..xNJ53QHh3-0sWxRs8Zum2A.DWSRyq5DZpDbIJcX6EIjB7iaOmaNKQG1erkpxhr8CgpW3y9v8qTdIK__ZJ6YoibtSxIfAFRdScSca4tKwZLTH7rDquCim6LPBAjWzHkO4WUr5qA2YpUI1TItCySAhMvmUfkIiqlr_fms8NAiOgH-xNNbco6eJQ1Kg4MsK3sUXh7uo9fwumbK8nghGXclT04fFLexTpIK99Pue652lw0oDlSRtKnEMAyOD6sDDg8elN9LyHdYMn0lyHL2utS1hbb-mUDDamuW6ck2WlNYfYKDYWpa3JGn71K3KgJZYWnsKB-kpMItXUQWBr6SX9kW9lWQbGZRlGrntylgVsa4H6g398VuoOdv1D7UkIsWYNmj9YYyGDHJcoQQqZ7PSSIWW_VjJZakCquEFYz858ZpYtTiQqyAvL8AoiGrPERjfBspuNUpi89uvw5Cp2TYeDSPVNy2WlCL7oPxTz78nkS4gWljJK4ekwLjWmM4ZIU0kwrdhMaEtMMOeG2-3oJJ-ELDXN85.PABT3pkf2HW9faiYNj_ezg','RT1-221-H0-1780091041mg1aazxlm4ht8x9z8x1v',1,NULL,NULL,NULL,NULL,0,'2026-01-12 13:30:50','2026-02-17 21:45:34',NULL,NULL,NULL,NULL,NULL,'sandbox',0);
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
INSERT INTO `users` VALUES (1,'Super Admin','admin@admin.com','profiles/aZVVys5VZTiQrbnCNflIkXtIvgaYmeWZNdtpnYuj.jpg',NULL,'$2y$12$T9.zhU.ZeaSdCwIQi2RaWO78E.qibh7giBZyXVvcQ8jSwuWmXWAZa','cmuWHy1trtVvTwVxRKA9VGsiFMjbqaWqYpsTlD6ZDQtNnoYHucTagHz6PZhJ','2026-01-12 12:47:43','2026-01-12 13:46:52');
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

-- Dump completed on 2026-02-25 21:50:41
