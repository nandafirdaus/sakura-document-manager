-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2015 at 02:58 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `document_data`
--

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE IF NOT EXISTS `companies` (
`id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `address` varchar(500) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`, `address`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, 'Roxin Labs Inc.', 'Seattle, CA.', '2015-04-12 08:22:05', '2015-04-12 04:58:39', NULL),
(6, 'PT Traveloka Indonesia', 'PT Traveloka Indonesia\r\nGrand Slipi Tower Lt. 39\r\nJl. S. Parman Kav 22-24\r\nJakarta Barat 11480\r\nIndonesia', '2015-04-12 08:29:08', '2015-04-25 11:11:30', NULL),
(7, 'Sakura Dewata Tour & Travel', 'Ruko Kawasan Industri MM2100\r\nKarawang, Bekasi\r\nJawa Barat', '2015-04-12 11:24:36', '2015-04-12 11:24:36', NULL),
(8, 'PT Honda Precision Part Manufacturing', 'Kerawang Bekasi.', '2015-04-26 16:19:55', '2015-04-26 16:19:55', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE IF NOT EXISTS `documents` (
`id` int(11) NOT NULL,
  `issued` date DEFAULT NULL,
  `expired` date NOT NULL,
  `doc_number` varchar(50) DEFAULT NULL,
  `document_type_id` int(11) NOT NULL,
  `file_url` varchar(255) DEFAULT NULL,
  `kitas_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `issued`, `expired`, `doc_number`, `document_type_id`, `file_url`, `kitas_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(19, '2015-04-01', '2015-04-30', 'fdsfsdgfs', 4, 'uploads/documents/2-4-8907.ppt', 2, '2015-04-19 09:48:33', '2015-04-19 11:34:33', NULL),
(20, '2015-04-01', '2015-04-30', '123456', 4, 'uploads/documents/-4-6468.pdf', 4, '2015-04-26 08:40:53', '2015-04-26 08:40:53', NULL),
(21, '2015-04-01', '2015-04-23', 'dfsfsfs', 5, 'uploads/documents/-5-8599.pdf', 4, '2015-04-26 08:44:04', '2015-04-26 08:48:19', NULL),
(22, '1970-01-01', '2015-12-09', '2GGIIJG 8827-AL', 4, 'uploads/documents/-4-4620.pdf', 5, '2015-04-26 16:24:45', '2015-04-26 16:24:45', NULL),
(23, '1970-01-01', '1970-01-01', 'STM/5685/XI/2014', 5, '', 5, '2015-04-26 16:25:18', '2015-04-26 16:25:18', NULL),
(24, '1970-01-01', '1970-01-01', 'KEP.25087/MEN/P/IMTA/2014', 9, '', 5, '2015-04-26 16:25:47', '2015-04-26 16:25:47', NULL),
(25, '1970-01-01', '2015-12-09', '2C21JD 6654-N', 11, '', 5, '2015-04-26 16:26:23', '2015-04-26 16:26:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `document_type`
--

CREATE TABLE IF NOT EXISTS `document_type` (
`id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `document_type`
--

INSERT INTO `document_type` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, 'POA', '2015-04-19 02:24:05', '2015-04-19 02:24:05', NULL),
(5, 'STM', '2015-04-19 02:24:10', '2015-04-19 02:24:10', NULL),
(6, 'CARD SKTTT', '2015-04-19 02:24:19', '2015-04-19 02:24:19', NULL),
(7, 'SKSKP', '2015-04-19 02:24:31', '2015-04-19 02:24:31', NULL),
(8, 'BIODATA', '2015-04-19 02:24:40', '2015-04-19 02:24:40', NULL),
(9, 'IMTA', '2015-04-19 02:24:50', '2015-04-19 02:24:50', NULL),
(10, 'LAKEB', '2015-04-19 02:24:58', '2015-04-19 02:24:58', NULL),
(11, 'MERP', '2015-04-19 02:25:05', '2015-04-19 02:25:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE IF NOT EXISTS `employees` (
`id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `position` varchar(150) DEFAULT NULL,
  `rptka_id` int(11) DEFAULT NULL,
  `company_id` int(11) NOT NULL,
  `passport_number` varchar(100) DEFAULT NULL,
  `passport_issued` date DEFAULT NULL,
  `passport_expired` date DEFAULT NULL,
  `passport_file_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `position`, `rptka_id`, `company_id`, `passport_number`, `passport_issued`, `passport_expired`, `passport_file_url`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Nanda Firdaus', 'CEO', NULL, 4, NULL, NULL, NULL, NULL, '2015-04-12 10:45:29', '2015-04-12 11:22:16', NULL),
(2, 'Suncin', 'Direktur', 3, 7, '', NULL, NULL, NULL, '2015-04-12 11:25:02', '2015-04-26 09:55:32', NULL),
(9, 'Farah Nuraini', 'UX Designer', NULL, 6, '123456', '2015-04-29', '2017-05-19', 'uploads/documents/6-passport-5840.pdf', '2015-04-19 06:57:42', '2015-05-02 08:07:06', NULL),
(12, 'Denny Haryadi', 'Lead Designer', NULL, 4, '080989999', '2015-04-01', '2015-04-30', NULL, '2015-04-25 16:16:10', '2015-04-26 11:02:30', NULL),
(15, 'Wiwik', 'Direktur Ticketing', NULL, 7, '', NULL, NULL, NULL, '2015-04-26 01:46:02', '2015-04-26 11:03:26', NULL),
(16, 'Derianto Kusuma', 'Chief Technology Officer', NULL, 6, '', NULL, NULL, NULL, '2015-04-26 11:01:04', '2015-04-26 11:01:04', NULL),
(17, 'Ferry Unardi', 'Chief Executive Officer', NULL, 6, '', NULL, NULL, NULL, '2015-04-26 11:01:27', '2015-04-26 11:01:27', NULL),
(18, 'Albert Zhang', 'Chief Product Officer', NULL, 6, '', NULL, NULL, NULL, '2015-04-26 11:01:53', '2015-04-26 11:01:53', NULL),
(19, 'Dannis Muhammad', 'Chief Marketing Officer', NULL, 6, '', NULL, NULL, NULL, '2015-04-26 11:02:51', '2015-04-26 11:02:51', NULL),
(20, 'Alfan Hendro', 'Product Manager Hotel', NULL, 6, '', NULL, NULL, NULL, '2015-04-26 11:03:52', '2015-04-26 11:03:52', NULL),
(21, 'Nanda Firdaus', 'Data Analyst', NULL, 6, '', NULL, NULL, NULL, '2015-04-26 11:04:21', '2015-04-26 11:04:21', NULL),
(22, 'Asakawa Eijiro', 'Chief Representative', NULL, 8, 'TH3371551', '2007-06-04', '2017-06-04', 'uploads/documents/8-passport-7223.pdf', '2015-04-26 16:22:09', '2015-04-26 16:22:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kitas`
--

CREATE TABLE IF NOT EXISTS `kitas` (
`id` int(11) NOT NULL,
  `issued` date DEFAULT NULL,
  `expired` date NOT NULL,
  `sequence` int(11) NOT NULL,
  `doc_number` varchar(100) NOT NULL,
  `file_url` varchar(255) DEFAULT NULL,
  `employee_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kitas`
--

INSERT INTO `kitas` (`id`, `issued`, `expired`, `sequence`, `doc_number`, `file_url`, `employee_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, '2015-04-04', '2015-04-19', 2, 'ABC123', 'uploads/documents/1-KITAS-1-8152.pdf', 1, '2015-04-19 09:22:30', '2015-04-19 09:22:30', NULL),
(3, '2015-04-01', '2015-04-30', 3, '134567432', 'uploads/documents/9-KITAS-3-4600.pdf', 9, '2015-04-26 05:24:53', '2015-04-26 05:24:53', NULL),
(4, '2015-03-03', '2016-04-29', 2, 'Wut Wut', 'uploads/documents/12-KITAS-2-8048.pdf', 12, '2015-04-26 05:25:25', '2015-04-26 05:25:25', NULL),
(5, '1970-01-01', '2015-12-09', 3, '2C21JD 6654-N', 'uploads/documents/22-KITAS-3-4468.pdf', 22, '2015-04-26 16:23:36', '2015-04-26 16:23:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2015_04_11_150404_crate_users_table', 2),
('2015_04_11_151803_crate_users_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('nandafirdaus@outlook.com', 'e5ece2f0d2d0df2355c64a2f7ddf23cd2ac1a3f56abce563d167c1eb725ac160', '2015-04-12 14:26:54');

-- --------------------------------------------------------

--
-- Table structure for table `pic`
--

CREATE TABLE IF NOT EXISTS `pic` (
`id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `position` varchar(150) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `mobile` varchar(50) DEFAULT NULL,
  `company_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rptka`
--

CREATE TABLE IF NOT EXISTS `rptka` (
`id` int(11) NOT NULL,
  `doc_number` varchar(100) NOT NULL,
  `issued` date NOT NULL,
  `expired` date NOT NULL,
  `file_url` varchar(255) DEFAULT NULL,
  `company_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rptka`
--

INSERT INTO `rptka` (`id`, `doc_number`, `issued`, `expired`, `file_url`, `company_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 'dsfwf34r2', '2015-04-01', '2015-05-01', 'uploads/documents/7-RPTKA-3378.pdf', 7, '2015-05-02 09:24:16', '2015-05-02 09:24:16', NULL),
(4, 'Hello wawa', '2015-04-02', '2016-05-02', '', 6, '2015-05-02 09:21:40', '2015-05-02 09:21:40', NULL),
(5, 'wawawawawaw', '2015-04-01', '0000-00-00', '', 7, '2015-04-26 16:16:43', '2015-04-26 16:16:43', '2015-04-26 16:16:43');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Nanda', 'nandafirdaus@outlook.com', '$2y$10$nu9kEz/CFSvS97W49oJo7eP.CgRjQAtDNa4szxAjhQdjrP8P.gAPq', 'xdfLIMTtR6FTx04Rz8algWpD2KSsvJDzVTjiKEq1OLNpNyPTT6R4VxrfhFqI', '2015-04-11 08:40:04', '2015-04-12 08:47:28', NULL),
(10, 'Farah Nuraini', 'farah.nuraini@gmail.com', '$2y$10$bh9L/97B1PBQnGupogFQcO5jhaZ48G3yJLOaEN9TNl9nbZw.ZsDou', '9DeyBe0w0DbD3vezrNGaReLx2x0QtDd9E8AssFfsspMCw8c2dw17kinOEdG1', '2015-04-12 01:51:11', '2015-05-02 09:08:14', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
 ADD PRIMARY KEY (`id`), ADD KEY `document_type_id` (`document_type_id`), ADD KEY `kitas_id` (`kitas_id`);

--
-- Indexes for table `document_type`
--
ALTER TABLE `document_type`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
 ADD PRIMARY KEY (`id`), ADD KEY `company_id` (`company_id`), ADD KEY `rptka_id` (`rptka_id`);

--
-- Indexes for table `kitas`
--
ALTER TABLE `kitas`
 ADD PRIMARY KEY (`id`), ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
 ADD KEY `password_resets_email_index` (`email`), ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `pic`
--
ALTER TABLE `pic`
 ADD PRIMARY KEY (`id`), ADD KEY `company_id` (`company_id`);

--
-- Indexes for table `rptka`
--
ALTER TABLE `rptka`
 ADD PRIMARY KEY (`id`), ADD KEY `company_id` (`company_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `users_username_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `document_type`
--
ALTER TABLE `document_type`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `kitas`
--
ALTER TABLE `kitas`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `pic`
--
ALTER TABLE `pic`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rptka`
--
ALTER TABLE `rptka`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `documents`
--
ALTER TABLE `documents`
ADD CONSTRAINT `documents_ibfk_2` FOREIGN KEY (`document_type_id`) REFERENCES `document_type` (`id`) ON UPDATE CASCADE,
ADD CONSTRAINT `documents_ibfk_3` FOREIGN KEY (`kitas_id`) REFERENCES `kitas` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
ADD CONSTRAINT `employees_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON UPDATE CASCADE,
ADD CONSTRAINT `employees_ibfk_2` FOREIGN KEY (`rptka_id`) REFERENCES `rptka` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `kitas`
--
ALTER TABLE `kitas`
ADD CONSTRAINT `kitas_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `pic`
--
ALTER TABLE `pic`
ADD CONSTRAINT `pic_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
