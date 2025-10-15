-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 22, 2025 at 08:09 AM
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
-- Database: `esimprod`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(36) NOT NULL,
  `kode_barang` varchar(255) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `nomor_seri` varchar(255) NOT NULL,
  `merk` varchar(255) NOT NULL,
  `jenis_barang_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `qr_code` varchar(255) NOT NULL,
  `limit` int(11) NOT NULL,
  `sisa_limit` int(11) NOT NULL,
  `foto` varchar(2048) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `uuid`, `kode_barang`, `nama_barang`, `nomor_seri`, `merk`, `jenis_barang_id`, `status`, `deskripsi`, `qr_code`, `limit`, `sisa_limit`, `foto`, `created_at`, `updated_at`) VALUES
(7, '66d3cc54-27c6-410a-8753-701b5aee3fe8', 'U2JX3HLNTR5E', 'EOS 6D (N)', '028022002984', 'Canon', 1, 'tersedia', 'EOS 6 D (N) Body Only', '1734257206_qr.png', 5, 0, '1734308545.png', '2024-12-14 10:06:46', '2025-02-13 00:08:26'),
(8, '1293d528-7f5a-4efd-8190-392caaffa951', '6I7C90Z8NF4H', 'EOS 6D MARK II', 'JZY5E1ZL61G0YFZR0MUQ', 'Canon', 1, 'tersedia', NULL, '1734264359_qr.png', 5, 5, '1734308794.png', '2024-12-14 12:05:59', '2025-01-06 17:58:42'),
(9, '9defc3e0-4864-4cb1-8723-68f7fa78847d', '5D3YEAO6FP0S', 'EOS 6D (WG)', '038024000818', 'Canon', 1, 'tersedia', NULL, '1734264400_qr.png', 5, 4, '1734308605.png', '2024-12-14 12:06:40', '2025-02-01 03:00:44'),
(10, 'abbfb8f9-6aff-4a4c-b6db-54fa176ed6e9', 'RYI063Q87VOU', 'MIC RODE', 'CR0292639', 'RODE', 6, 'tersedia', NULL, '1734308782_qr.png', 5, 2, '1734308888.png', '2024-12-15 00:26:22', '2025-03-26 03:18:25'),
(11, '9fcb9946-7c6b-4d3a-bc13-1c4b084bb0d4', 'LP6RHQ25MDZ0', 'NIKON D800E', '2001368', 'Nikon', 1, 'tersedia', 'D800E, 7V-12V (2.5 A)', '1734309056_qr.png', 5, 4, '1734309056.png', '2024-12-15 00:30:56', '2025-01-22 06:49:15'),
(12, '9f207695-7572-41b8-b957-6faf77f75d8b', 'MNQV5ADR72LG', 'Lensa Tamron', '663764', 'TAMRON', 2, 'tersedia', 'Lensa TAMRON, 70-300mm, TELE MACRO(1:2), 62Ohm, A17', '1734309245_qr.png', 5, 4, '1734309245.png', '2024-12-15 00:34:05', '2025-05-21 08:13:13'),
(13, '665b8cf9-fe6c-4ab9-a347-8f0a342f7f5f', 'AEIKPSG2Z4RT', 'Baterai GO PRO', 'TS7SJNNVXA1CB5E8737Z', 'GO PRO', 8, 'tersedia', 'Rechargeable Li-ion Battery Pack, 3.7 V, 1180 mAH, 4.37 Wh', '1734309642_qr.png', 5, 5, '1734309655.png', '2024-12-15 00:40:42', '2025-01-22 08:34:31'),
(15, '705d0307-c3e3-458b-bbd8-3fe1fc2e2be0', 'W42YSR9JPQMO', 'LENSA MACRO PRO TAMA', '-', 'PRO TAMA', 2, 'tersedia', '72 mm, Macro', '1734309974_qr.png', 5, 4, '1734309974.png', '2024-12-15 00:46:14', '2025-05-28 07:35:35'),
(17, 'f9468723-9d57-485a-a098-47de5e8a1697', 'VL3TC52OKBMF', 'DRONE DJI MAVIC 2', '163CG9G', 'DJI', 5, 'tersedia', 'DJI MAVIC 2, Power : LiPo 3850mAH (15,4V), Model L1P', '1734310293_qr.png', 5, 5, '1734310293.png', '2024-12-15 00:51:33', '2025-01-22 07:38:18'),
(20, 'e9fabf56-713f-49b2-b24f-4b5c806da585', 'DN0IFE8LUVXK', 'SONY NXCAM', '0520139', 'SONY', 1, 'tersedia', 'HXR-NX3, PAL 7.2V, 20x Optical Zoom, Sony Lens G', '1734310651_qr.png', 5, 5, '1734310651.png', '2024-12-15 00:57:31', '2025-01-22 07:31:23'),
(21, 'e28bad72-6102-408b-813c-b25525de5a08', 'O4UHPBMSD2K1', 'Laptop Acer Aspire V5', 'NXM8ASN00233939A353400', 'Acer', 11, 'tersedia', 'SNID : 33923608534', '1734310922_qr.png', 5, 4, '1734310922.png', '2024-12-15 01:02:02', '2025-03-26 03:18:25'),
(22, '3d813a12-e881-48cd-933c-86f1f0e68ec9', 'WYQ0J5U694AL', 'Kamera BOLEX H16', '9NQEY5C1ZPFF3L38BCPK', 'BOLEX', 1, 'tersedia', NULL, '1734311159_qr.png', 5, 4, '1734311159.png', '2024-12-15 01:05:59', '2025-01-07 19:24:59'),
(23, '466d5cb0-78a3-42d1-8bda-0811e29c9307', 'PRD0INCK4ZE2', 'SD CARD 128 GB [1]', '1558OM2X1EVAG86UH105', 'Sandisk', 10, 'tersedia', 'SD Card Sandisk Extreme Pro 170mb/s Class 10', '1734317814_qr.png', 5, 4, '1734317815.png', '2024-12-15 02:56:56', '2025-02-01 03:00:44'),
(24, 'a3c18556-3999-40f2-b1df-becb48559fdc', 'F84W3ZQGBJLH', 'SD CARD 128 GB [2]', 'HLXNQDMO6AIQRRTXNYJF', 'Sandisk', 10, 'tersedia', 'SD Card Sandisk Extreme Pro 170mb/s Class 10', '1734317850_qr.png', 5, 5, '1734317850.png', '2024-12-15 02:57:30', '2024-12-15 07:26:28'),
(25, 'acff2450-f305-4d3e-8a72-a6f6aa79af02', '6Z0LMDKVYIS8', 'SD CARD 128 GB [3]', 'VET0Q5TSQ5H87B7D69EM', 'Sandisk', 10, 'tersedia', 'SD Card Sandisk Extreme Pro 170mb/s Class 10', '1734317879_qr.png', 5, 5, '1734317879.png', '2024-12-15 02:57:59', '2024-12-15 02:57:59'),
(26, '14985b6b-9807-4aab-a306-f465bf8e4c40', '2EJ6KUS1LNRW', 'Battery Pack [1]', 'CU1JUCJE448EI3S7DRUK', '-', 4, 'tersedia', 'Li-ion Battery Pack', '1734318205_qr.png', 5, 5, '1734318206.png', '2024-12-15 03:03:26', '2024-12-15 07:26:28'),
(27, '3c815215-1947-435c-afd8-c673502ce1c3', 'NFB9PJROLEIY', 'Battery Pack [2]', 'HONRCUKDLMAZSYWYLB5F', '-', 4, 'tersedia', 'Li-ion Battery Pack', '1734318236_qr.png', 5, 0, '1734318236.png', '2024-12-15 03:03:56', '2025-04-05 22:26:14'),
(28, '1db9a8e8-9b5b-4948-9d20-adb612b25aa9', 'A3QCHGZEJR42', 'Tripod SACHTLER', '75LXDJVWMS6Q1VV0SMNU', 'SACHTLER', 8, 'tersedia', 'Tripod SACHTLER', '1734318367_qr.png', 5, 5, '1734318367.png', '2024-12-15 03:06:07', '2025-01-22 07:20:11'),
(30, '4d5e9311-0035-490e-9ef2-a5be24c2a36b', 'JMKWA2X3E6BO', 'LENSA YONGNUO', '15018017', 'YONGNOU', 2, 'tidak-tersedia', 'LENSA YONGNUO 50MM', '1734318963_qr.png', 5, 2, '1734318963.png', '2024-12-15 03:16:03', '2025-05-28 07:35:35'),
(31, '31086fe6-2f3b-4938-ab87-13870b3310ef', 'BNWKM9UIR2XT', 'Perlengkapan GO PRO', 'HME34SHGFUB3NT8U0D5D', 'GO PRO', 3, 'tersedia', NULL, '1734319180_qr.png', 5, 3, '1734319180.png', '2024-12-15 03:19:40', '2025-01-22 08:34:18'),
(32, '4dda83cf-574d-44d4-8b69-ca97f4243c31', 'VQ09DBCXKE8Y', 'Baterai Kamera Canon [1]', '95DHMRY7SHO3DYV2ULJZ', 'Canon', 4, 'tersedia', NULL, '1734319364_qr.png', 5, 5, '1734319364.png', '2024-12-15 03:22:44', '2024-12-23 09:18:09'),
(33, 'b0c316a9-8087-4e8f-ae03-e29fd6aa6d2a', '6KR9N57O8PQT', 'Baterai Kamera Canon [2]', 'LVFRSJID9U1A0HZDGQQ3', 'Canon', 4, 'tersedia', NULL, '1734319413_qr.png', 5, 0, '1734319413.png', '2024-12-15 03:23:33', '2025-04-05 22:25:17'),
(34, 'e8d804a7-aa98-40cd-a647-8f9578cb6de1', 'POXSQK8E0CNI', 'Baterai Kamera Canon [3]', '15VSHWDX9DT5SSV84GCV', 'Canon', 4, 'tersedia', NULL, '1734319436_qr.png', 5, 0, '1734319436.png', '2024-12-15 03:23:56', '2025-04-05 22:26:23'),
(35, '0b357199-6607-42e1-9c1e-546e5638d58a', 'GIURT7M01VKB', 'Baterai Kamera Canon [4]', '1ANVBM2XLAPMN6O7HNDQ', 'Canon', 4, 'tersedia', NULL, '1734319459_qr.png', 5, 5, '1734319459.png', '2024-12-15 03:24:19', '2025-03-26 01:45:32'),
(36, '86c9da4f-18e4-42dd-8335-4fb2a5baff47', 'XRYQ8C90MBZ6', 'Baterai Kamera Canon [5]', '2NK6HWEAKSYK1R14Q8VY', 'Canon', 4, 'tersedia', NULL, '1734319531_qr.png', 5, 5, '1734319531.png', '2024-12-15 03:25:31', '2025-01-07 20:53:57'),
(37, '92b97e5e-2285-4e0f-9c97-84fdf5215188', 'EN32WX8T4OM0', 'Charger Baterai Kamera Canon [1]', '5N35EI5KXYAGXE9MU7XT', 'Canon', 8, 'tersedia', NULL, '1734319745_qr.png', 5, 5, '1734319745.png', '2024-12-15 03:29:05', '2025-02-07 01:24:44'),
(38, '696491a0-1d21-48d5-87c4-d8e608afdf70', '78G6UQSBLXDE', 'Charger Baterai Kamera Canon [2]', 'DQQM01U72N25OM9AY41F', 'Canon', 8, 'tersedia', NULL, '1734319789_qr.png', 5, 4, '1734319789.png', '2024-12-15 03:29:49', '2025-02-21 03:24:02'),
(39, 'febbaf78-0e26-42bf-9c2b-c3d79eb140d3', '10H2VP893IWD', 'Charger Baterai Kamera Canon [3]', 'LFLXZYE5Q2B90PO2C9SA', 'Canon', 8, 'tersedia', NULL, '1734319821_qr.png', 5, 4, '1734319821.png', '2024-12-15 03:30:21', '2025-02-27 06:46:31'),
(40, '94b35284-2eb7-41de-9317-22bc5cb223f7', 'LNPE1M9D3BCF', 'Nikon 18-200 mm', '42488697', 'Nikon', 2, 'tersedia', 'Nikon DX SWM VR ED IF Aspherical, 18-200 mm,', '1737529158_qr.png', 5, 5, '1737684925.jpg', '2025-01-22 06:59:18', '2025-01-24 02:15:25'),
(42, '159e2722-002b-4e11-98f5-368a7044b5f4', '92NWO0QU4T7L', 'SIGMA DG', '11091842', 'SIGMA', 2, 'tersedia', 'SIGMA for Nikon, LCF=86II,  86mm', '1737529472_qr.png', 5, 5, '1737684881.jpg', '2025-01-22 07:04:32', '2025-01-24 02:14:41'),
(43, '6469a3f9-1bde-4ae3-a697-9000adaec1f3', 'GMFH39PKAZWD', 'SONY ALPHA 7S III [1]', '4875932', 'SONY', 1, 'tersedia', '4K, SteadyShot INSIDE', '1737531904_qr.png', 5, 5, '1737543954.jpg', '2025-01-22 07:45:04', '2025-01-22 11:48:09'),
(44, 'ad986c20-6287-42fa-8670-0a95ac7b99b1', 'ZG9NF6CA0LUD', 'SONY ALPHA 7S III [2]', '4876023', 'SONY', 1, 'tersedia', '4K, SteadyShot Inside', '1737531976_qr.png', 5, 5, '1737543870.jpg', '2025-01-22 07:46:16', '2025-01-22 11:48:17'),
(45, 'cf96e07b-663e-4ed3-a9a6-e1348ce372fa', 'K21JDC9A6MS0', 'Lensa SONY FE 24-70 F2.8 GM', 'S01-2130258-7', 'SONY', 2, 'tersedia', 'SONY FE 2.8/24-70 GM, Type G, E-Mount', '1737532403_qr.png', 5, 5, '1737546715.jpg', '2025-01-22 07:53:23', '2025-01-22 11:51:55'),
(46, '43ef1416-1ef5-4ed9-bc78-11e149734d4d', 'JX4TYEPVKCR3', 'Lensa SONY FE50 MM FE1.4 ZA', 'S01-1820502-4', 'SONY', 2, 'tersedia', 'E-Mount, 35mm full range, 72mm', '1737532560_qr.png', 5, 5, '1737546794.jpg', '2025-01-22 07:56:00', '2025-01-22 11:53:14'),
(47, '42d9af35-6031-4080-aaef-13a28497427c', '4MKS8DJFY2GT', 'Lensa SONY FE 16-35 mm F.2.8 GM II', 'S01-1811458-E', 'SONY', 2, 'tersedia', 'E-Mount, 35mm full frame, 82mm', '1737532768_qr.png', 5, 5, '1737546820.jpg', '2025-01-22 07:59:28', '2025-01-22 11:53:40'),
(48, '849de5b0-cec1-4b76-a4bb-9bb4b8106bf0', '1ZHR3SQ6EUB7', 'Lensa FE 70-200 mm F2.8 GM OSS', 'S01-1958755-Q', 'SONY', 2, 'tersedia', 'E-Mount, 35 mm full frame, 77mm', '1737532880_qr.png', 5, 5, '1737545478.jpg', '2025-01-22 08:01:20', '2025-01-22 11:31:18'),
(49, 'a969c464-04c3-49ee-a446-e2668e670543', 'X2W1T7NKZPD0', 'SONY Battery Pack NP-FZ100 [1]', '20220519WDB', 'SONY', 4, 'tersedia', 'Kapasitas 16,4 Wh, 2280mAH/7.2V', '1737533126_qr.png', 5, 5, '1737545182.jpg', '2025-01-22 08:05:26', '2025-01-22 11:26:22'),
(50, '0d6ac666-c525-48a7-bdb4-64b26226d2ef', 'ROKNYMLIAP5D', 'SONY Battery Pack NP-FZ100 [2]', '20220907WEB', 'SONY', 4, 'tersedia', 'Kapasitas 16.4 Wh, 2280 mAh/7.2V', '1737533238_qr.png', 5, 5, '1737545175.jpg', '2025-01-22 08:07:18', '2025-01-22 11:26:15'),
(51, '3e95f4c2-4ed3-4730-bdde-f5009b698f62', '6UFDMOJGN1YZ', 'SONY Battery Pack NP-FZ100 [3]', '20230207WEB', 'SONY', 4, 'tersedia', 'Kapasitas 16.4 Wh, 2280 mAh/7.2V', '1737533375_qr.png', 5, 5, '1737545167.jpg', '2025-01-22 08:09:35', '2025-01-22 11:26:07'),
(52, '00ad431b-a9c3-4503-a68a-9d42f8e43f5d', 'RSVP41YO3JZC', 'SONY Battery Pack NP-FZ100 [4]', '20221018WEA', 'SONY', 4, 'tersedia', 'Kapasitas 16.4 Wh, 2280 mAh/7.2V', '1737533464_qr.png', 5, 5, '1737545149.jpg', '2025-01-22 08:11:04', '2025-01-22 11:25:49'),
(53, '17b917b3-5c28-44af-ae3a-67552c4ae9ae', 'CZBW41IU5G6S', 'SONY Battery Pack NP-FZ100 [5]', '20220907WEB', 'SONY', 4, 'tersedia', 'Kapasitas 16.4 Wh, 2280 mAh/7.2V', '1737533559_qr.png', 5, 5, '1737545062.jpg', '2025-01-22 08:12:39', '2025-01-22 11:24:22'),
(54, '93e91c50-311f-4888-b7cd-2eab9b852b15', 'YF1JZKNP9S73', 'SONY Battery Pack  NP-FZ100 [6]', '20211113WDB', 'SONY', 4, 'tersedia', 'Kapasitas 16.4 Wh, 2280 mAh/7.2V', '1737533621_qr.png', 5, 5, '1737544479.jpg', '2025-01-22 08:13:41', '2025-01-22 11:14:39'),
(55, 'c3663ba7-e973-47aa-a431-4df38641bd5a', '84QSOEU7H2XT', 'SONY Battery Charger BC-QZ1 [1]', '220455PA1007227', 'SONY', 8, 'tersedia', 'Quick Charger, Z series', '1737533807_qr.png', 5, 5, '1737545213.jpg', '2025-01-22 08:16:47', '2025-01-22 11:26:53'),
(56, 'ed6d0cf0-a3dc-4978-bdde-024dc4126ff5', 'TPLGQR20NFZW', 'SONY Battery Charger BC-QZ1 [2]', '22115PA1000120', 'SONY', 8, 'tersedia', 'Quick Charger, Z series', '1737533871_qr.png', 5, 5, '1737545222.jpg', '2025-01-22 08:17:51', '2025-01-22 11:27:02'),
(57, 'de2a8c93-a2ec-4bbb-b3e3-5f2f756b07d3', '8GYQLNSOD1W7', 'TASCAM DR-07X', '1980295', 'TASCAM', 6, 'tersedia', 'Stereo digital audio recorder and USB audio interface', '1737534047_qr.png', 5, 5, '1737544135.jpg', '2025-01-22 08:20:47', '2025-01-22 11:08:55'),
(58, 'cbd9f43e-2579-46a9-8f6e-9f9e92ac3db1', 'UY0R5P1FBNJH', 'CAMCORDER CANON XA65', '683629000160', 'CANON', 1, 'tersedia', '4K, 20x Optical zoom, Infrared', '1737534531_qr.png', 5, 5, '1737544182.jpg', '2025-01-22 08:28:51', '2025-01-22 11:09:42'),
(59, 'a3119dcd-3403-4e7c-b444-bc4e9e8922a8', 'USHRLZTQ35OA', 'Lampu ZHIYUN FIVERAY M40 [1]', '9020270C0010896', 'ZHIYUN', 12, 'tersedia', '40 W', '1737534730_qr.png', 5, 5, '1737543771.jpg', '2025-01-22 08:32:10', '2025-01-22 11:02:51'),
(60, '13a4c24e-898c-4ba4-af72-9ac94c4588ad', '0RPTMOZ7JSA1', 'Lampu ZHIYUN FIVERAY M40 [2]', '8FF02E0C0010081', 'ZHIYUN', 12, 'tersedia', '40 W', '1737534795_qr.png', 5, 5, '1737544105.jpg', '2025-01-22 08:33:15', '2025-01-22 11:08:25'),
(61, '21309dad-d522-4185-9668-dd4ddeee6fd9', 'Z7IKES5HRAJW', 'CAMCORDER PANASONIC AJ-PX230', 'A9TRA0010', 'PANASONIC', 1, 'tersedia', '7.2 V/12 V (19.5 W)', '1737535043_qr.png', 5, 5, '1737544206.jpg', '2025-01-22 08:37:23', '2025-01-22 11:10:06'),
(64, '282a0c71-22ef-4a1a-8e91-28772e10864c', 'YBV1O9CE6Q03', 'mic wireless Set SENNHEISER [1]', '5092000092', 'SENNHEISER', 6, 'tersedia', 'Wireless, freq range D 780-822 MHz', '1737535701_qr.png', 5, 5, '1737545287.jpg', '2025-01-22 08:48:21', '2025-07-23 03:25:25'),
(65, '648699a9-7d10-4762-aebf-46cd2861a29a', 'PNRAHQ6UGI9M', 'mic wireless Set SENNHEISER [2]', '5441001176', 'SENNHEISER', 6, 'tersedia', 'Wireless, freq range B 626-668 MHz', '1737535787_qr.png', 5, 5, '1737545403.jpg', '2025-01-22 08:49:47', '2025-07-23 03:25:37'),
(66, '279a1365-4b57-4d27-ba5b-22cf35bb390c', 'QFW15CLNHBV7', 'mic wireless Set SENNHEISER [3]', '4029000033', 'SENNHEISER', 6, 'tersedia', 'Wireless, freq range C 734-776 MHz', '1737535930_qr.png', 5, 5, '1737545393.jpg', '2025-01-22 08:52:10', '2025-07-23 03:25:49'),
(67, 'd285f83c-ea28-4166-96e8-cd8c914115f0', 'XNKTWQ0MBPRZ', 'SOLITON 1', '-', 'SOLITON', 8, 'tersedia', NULL, '1738200646_qr.png', 10, 10, '1738327279.jpg', '2025-01-30 01:30:46', '2025-01-31 12:41:20'),
(68, '400ec383-550e-4985-a80e-0340cd2fa115', 'BH6L3TZPXD1U', 'SOLITON 2', '-', 'SOLITON', 8, 'tersedia', NULL, '1738200663_qr.png', 5, 5, '1738327191.jpg', '2025-01-30 01:31:03', '2025-01-31 12:39:52'),
(69, '37440d33-9826-4e2b-b76f-0295a6978920', '0WE5SQRL4D36', 'LENSA Canon 50mm, EF 50', '-', 'Canon', 2, 'tersedia', 'Canon 50mm, EF 50', '1738200766_qr.png', 10, 10, 'default.jpg', '2025-01-30 01:32:46', '2025-01-30 01:32:46'),
(70, '97e72077-6540-4106-b79f-3f49f4d6eb5e', 'P6W13X8GTC2Q', 'LENSA Canon UV, 75-300mm', '-', 'Canon', 2, 'tersedia', 'UV, 75-300mm', '1738200856_qr.png', 5, 5, 'default.jpg', '2025-01-30 01:34:16', '2025-01-30 01:34:16'),
(71, 'd290ff16-2873-42ab-8946-2afddc5460a5', 'NQ87MEWYIASF', 'LENSA TAMRON For CANON, 24-105 mm', '-', 'TAMRON', 2, 'tersedia', '24-105 mm', '1738200942_qr.png', 10, 10, '1738327393.jpg', '2025-01-30 01:35:42', '2025-01-31 12:43:14'),
(72, 'f284c784-62f9-4ca5-ad78-ed2cc37c6456', '6AFZHMK3V9S7', 'LENSA TAMRON, 17-35 mm', '-', 'TAMRON', 2, 'tersedia', '17-35 mm', '1738201036_qr.png', 5, 5, '1738327671.jpg', '2025-01-30 01:37:16', '2025-01-31 12:47:52'),
(73, '0e96d5fc-cab4-484b-a350-071d6f11c310', 'W9DSPK31HCGN', 'Clip On Set SENNHEISER [1]', '4120036210', 'SENNHEISER', 6, 'tersedia', 'SK100 G4, freq B 626-668 MHz', '1738201540_qr.png', 5, 5, '1738327567.jpg', '2025-01-30 01:45:40', '2025-01-31 12:46:08'),
(74, '056e8f3a-c3b9-46a3-98b4-fbb400610697', 'UQX30PV9TEL7', 'Clip On Set SENNHEISER [2]', '4067012725', 'SENNHEISER', 6, 'tersedia', 'SK100, FQ E 823-865 MHz', '1738201753_qr.png', 5, 5, '1738327534.jpg', '2025-01-30 01:49:13', '2025-01-31 12:45:35'),
(75, 'ffcc5da3-0cb3-4fea-8338-414841e536f6', 'CBQ329FVA4JT', 'Clip On Set SENNHEISER [3]', '4130036556', 'SENNHEISER', 6, 'tersedia', 'FREQ B 626-668 MHz, SK100 G4', '1738201881_qr.png', 5, 5, '1738327525.jpg', '2025-01-30 01:51:21', '2025-01-31 12:45:26'),
(76, '81a52c2d-4d9a-40ce-ad53-bd160ccf5be8', '5H2GC4TVF0BN', 'Lampu GODOX LF308', '20H00066496', 'GODOX', 12, 'tersedia', '18 W', '1738202208_qr.png', 5, 5, '1738329470.jpg', '2025-01-30 01:56:48', '2025-01-31 13:17:51'),
(77, 'ea7e8bf5-f2b7-41e0-bc53-92a2154d612e', 'SVOMFI5HACB3', 'NIKON Battery Charger MH25', '1110015450G', 'NIKON', 4, 'tersedia', NULL, '1738202448_qr.png', 5, 5, '1738328775.jpg', '2025-01-30 02:00:48', '2025-01-31 13:06:16'),
(78, '348fb7e5-2bec-48a0-a6a7-4d7673221836', '07UBNX48VIKH', 'DJI RS 3 PRO', '5DNDK8N0069J3R', 'DJI', 8, 'tersedia', 'Professional 3-axis Camera Stabilizer', '1738202852_qr.png', 5, 5, '1738329534.jpg', '2025-01-30 02:07:32', '2025-01-31 13:18:55'),
(79, 'ad305a36-98fe-46de-bdb8-5345e798c2fb', 'UP5VF40ILJ86', 'DJI AIR 2S', '3YTBJ9Q003054L', 'DJI', 5, 'tersedia', 'Air Drone', '1738203086_qr.png', 5, 5, '1738328014.jpg', '2025-01-30 02:11:26', '2025-01-31 12:53:35'),
(80, 'a9d6c61f-3cc3-4df6-a96b-b380761dcd70', 'J48OBH0ALRSQ', 'OPPO A5 2020', 'QCPH193311A08A7943', 'OPPO', 7, 'tersedia', '4GB RAM 128GB STORAGE', '1738204169_qr.png', 5, 5, '1738328023.jpg', '2025-01-30 02:29:29', '2025-01-31 12:53:44'),
(81, '6ebf7027-c65c-4203-901a-38586eace893', '6TWFVJ87KOIG', 'Baterai Canon LP-E6N', 'S/N ------', 'Canon', 4, 'tersedia', 'Baterai Canon', '1738204352_qr.png', 5, 5, '1738327917.jpg', '2025-01-30 02:32:32', '2025-01-31 12:51:58'),
(82, 'b26b44cd-33db-40a5-8d3c-149af50c4adb', 'K2FTV851ZOJ3', 'Baterai Canon LP-E6H', 'S/N ------', 'Canon', 4, 'tersedia', 'Baterai Canon', '1738204427_qr.png', 5, 5, '1738327770.jpg', '2025-01-30 02:33:47', '2025-01-31 12:49:31'),
(83, 'b176cbcc-1224-4fd5-a918-14356f36e0c7', 'RO7ETAPU1GF5', 'Baterai Canon LP-E6N (2)', 'S/N ---------', 'Canon', 4, 'tersedia', 'Baterai Canon', '1738204527_qr.png', 4, 4, '1738327778.jpg', '2025-01-30 02:35:27', '2025-01-31 12:49:38'),
(84, '71b9fd95-3f95-49ed-b105-5020b6ced978', 'KUSGP27A61RQ', 'Baterai Canon LP-E6H (2)', 'S/N ---------', 'Canon', 4, 'tersedia', 'Baterai Canon', '1738204600_qr.png', 4, 4, '1738327824.jpg', '2025-01-30 02:36:40', '2025-01-31 12:50:25'),
(85, '48d06fb5-3e3f-40ed-af33-8afd892579cd', 'FEO8WMNLR9Y7', 'Baterai Canon LP-E6[1]', 'S/N --------', 'Canon', 4, 'tersedia', 'Baterai Canon', '1738204675_qr.png', 4, 4, '1738327833.jpg', '2025-01-30 02:37:55', '2025-01-31 12:50:34'),
(86, '2d657bb5-05b2-43b4-b02d-947f4898672c', '2GV8T0LQBJAR', 'Baterai Canon LP-E6 (2)', 'S/N ------------', 'Canon', 4, 'tersedia', 'Baterai Canon', '1738204757_qr.png', 4, 4, '1738327841.jpg', '2025-01-30 02:39:17', '2025-01-31 12:50:42'),
(87, '0bb5fabb-96ec-412b-83bb-636d48150a14', 'XL6GCDHMF5W1', 'Baterai Canon LP-E6 (3)', 'S/N --------', 'Canon', 4, 'tersedia', 'Baterai Canon', '1738204807_qr.png', 4, 4, '1738327850.jpg', '2025-01-30 02:40:07', '2025-01-31 12:50:51'),
(88, '7920713b-4f11-4ec7-bf98-d26e9d778ef0', 'I405BER91WVX', 'Baterai FB-LP-E6+', 'S/N ------------', 'FB', 4, 'tersedia', 'Baterai FB', '1738204869_qr.png', 4, 4, 'default.jpg', '2025-01-30 02:41:09', '2025-01-30 02:41:09'),
(89, 'bbd76c34-3b2d-49fd-869d-264dcb9f76de', '6JEKWG9ZP7LB', 'Canon Battery Charger CG-800E', 'S/N ---------', 'Canon', 4, 'tersedia', NULL, '1738205154_qr.png', 4, 4, '1738328686.jpg', '2025-01-30 02:45:54', '2025-01-31 13:04:47'),
(90, 'da75ed0b-725f-4907-8624-eeac0f0a5473', 'ZHRA3UQ8V4EW', 'Video Light HR-5100A', 'S/N ----------', 'Video Light', 12, 'tersedia', 'LED Battery Video Light', '1738205283_qr.png', 4, 4, '1738328542.jpg', '2025-01-30 02:48:03', '2025-01-31 13:02:23'),
(91, '8ffe5685-ad12-49fd-8daa-1d9e0be6eede', 'EIO3NQG68YT5', 'Apature Amaran FI', 'S/N -----------', 'Apature', 12, 'tersedia', NULL, '1738205355_qr.png', 4, 4, '1738328486.jpg', '2025-01-30 02:49:15', '2025-01-31 13:01:27'),
(92, 'f9d070a1-0430-4e74-8688-3d29cfd9115f', 'GFNW87MBUH1J', 'GoPro Hero 8 Black', 'S/N -------', 'GoPro', 3, 'tersedia', 'Action Cam', '1738205512_qr.png', 5, 5, '1738328594.jpg', '2025-01-30 02:51:52', '2025-03-25 02:01:27'),
(93, 'faf165f8-bc00-47df-a8ec-db31548597dd', 'B3OK945CJR0N', 'ZHIYUN CRANE 3 LAB', 'S/N -------', 'ZHIYUN', 8, 'tersedia', NULL, '1738205670_qr.png', 5, 5, '1738328435.jpg', '2025-01-30 02:54:30', '2025-01-31 13:00:35'),
(97, '6758e943-356f-456c-bfa0-08eab83bf300', 'Q3P4RES05UDG', 'Baterai SONY BP-U30', '20130716', 'SONY', 4, 'tersedia', 'made in japan | 14.4V | 1.95Ah | 28Wh', '1750129884_qr.svg', 5, 5, '1753841542.jpg', '2025-06-17 03:11:28', '2025-07-30 02:12:22'),
(98, 'f67acf93-1fdc-40ea-ab19-e2d81c8d243f', '3BIFM2USJNA7', 'Baterai SONY BP-U30 1', '20160517', 'SONY', 4, 'tersedia', 'made in japan | 14.4V | 1.95Ah | 28Wh', '1750130036_qr.svg', 5, 5, '1753841550.jpg', '2025-06-17 03:13:56', '2025-07-30 02:12:30'),
(99, 'cfbbbee6-f203-49b4-adcb-0a8474bdd94e', 'EADXNZGUCBI0', 'Baterai SONY BP-U30 2', '0410819-20160517', 'SONY', 4, 'tersedia', 'made in japan | 14.4V | 1.95Ah | 28Wh', '1750132115_qr.svg', 5, 4, '1753841557.jpg', '2025-06-17 03:48:35', '2025-07-30 02:12:37'),
(100, '2c38a33b-7365-488a-8ca3-8b6b92096eaa', '8LNOG4AQ5JES', 'Baterai SONY BP-U30 3', '20160510', 'SONY', 4, 'tersedia', 'made in japan | 14.4V | 1.95Ah | 28Wh', '1750137499_qr.svg', 5, 5, '1753841563.jpg', '2025-06-17 05:18:19', '2025-07-30 02:12:43'),
(101, 'a01c69f5-44ea-42fd-83c7-752367b71659', 'AOFH2S94L8DQ', 'Baterai SONY BP-U30 4', '20191015', 'SONY', 4, 'tersedia', 'made in japan | 14.4V | 1.95Ah | 28Wh', '1750137534_qr.svg', 5, 5, '1753841570.jpg', '2025-06-17 05:18:54', '2025-07-30 02:12:50'),
(102, '6f240f08-09da-49ac-8cba-8bdb26a2379a', 'CNITGB26YVFL', 'AC Adaptor / Charger AC-VL1', '14073000158', 'SONY', 8, 'tersedia', 'CLASS 2 BATERY', '1750138486_qr.svg', 5, 5, '1753841611.jpg', '2025-06-17 05:34:46', '2025-07-30 02:13:31'),
(103, '8447d8e1-df11-424a-ba35-022515f5c668', 'CZMVEL624XTR', 'Baterai SONY BP-U60', '20151022', 'SONY', 4, 'tersedia', '3700mAh | 14.4 V | 3.9Ah', '1750138616_qr.svg', 5, 5, '1753841642.jpg', '2025-06-17 05:36:57', '2025-07-30 02:14:02'),
(104, '1c042a25-f9ba-45d5-975d-c71a29f09a25', 'SFA0RX58PTUZ', 'AC Adaptor / Charger AC-VL1 2', '14083005588', 'SONY', 8, 'tersedia', 'CLASS 2 BATERY', '1750138812_qr.svg', 5, 5, '1753841648.jpg', '2025-06-17 05:40:12', '2025-07-30 02:14:08'),
(105, 'a0ca3892-b8db-4d53-adc0-d99a49f9ae31', 'E7K3W2SHNUR8', 'AC Adaptor / Charger AC-VL1 3', '14073000137', 'SONY', 8, 'tersedia', 'CLASS 2 BATERY', '1750138881_qr.svg', 5, 5, '1753841654.jpg', '2025-06-17 05:41:21', '2025-07-30 02:14:14'),
(106, 'b9497e65-87ea-42d7-a53d-3226a58234bd', 'T7C0M4K1DQB8', 'AC Adaptor / Charger AC-VL1 4', '14083001561', 'SONY', 8, 'tersedia', 'CLASS 2 BATERY', '1750138934_qr.svg', 5, 5, '1750294387.JPG', '2025-06-17 05:42:14', '2025-06-19 00:53:07'),
(107, 'b6cf3b13-79cd-48b3-ac15-d7dc52efd94b', 'BA53926ECU4N', 'Baterai Drone DJI 1', '0P2AK7J53702NC', 'DJI', 8, 'tersedia', 'FB2-3850 mAh | 15.4 V', '1750223523_qr.svg', 5, 5, '1750223523.jpeg', '2025-06-18 05:12:03', '2025-06-18 05:12:03'),
(108, '29667fb6-bb60-4479-93e8-9549b82c21d9', '6B02SFMZ9L1H', 'Baterai Drone DJI 2', '0P2AKC653702Y6', 'DJI', 8, 'tersedia', 'FB2-3850 mAh | 15.4 V', '1750223650_qr.svg', 5, 5, '1750223650.jpeg', '2025-06-18 05:14:10', '2025-06-18 05:14:10'),
(109, '19b47e94-2fb5-465d-952a-7f2971ece011', '92K3FE6HML1G', 'Baterai Drone DJI 3', '0P2AK7J5370276', 'DJI', 8, 'tersedia', 'FB2-3850 mAh | 15.4 V', '1750223748_qr.svg', 5, 5, '1750223748.jpeg', '2025-06-18 05:15:48', '2025-06-18 05:15:48'),
(110, '4e5d6b9c-6ecf-4289-9940-a0259983d05c', '2VG0Z7C61WNY', 'Baterai Drone DJI 4', '0P2AKBE537036H', 'DJI', 8, 'tersedia', 'FB2-3850 mAh | 15.4 V', '1750223810_qr.svg', 5, 5, '1750223810.jpeg', '2025-06-18 05:16:50', '2025-06-18 05:16:50'),
(111, 'b2c23aac-8956-4bbf-acfd-b00e9700c244', '52QN79U0O4L3', 'Baterai Drone DJI 5 (Kembung)', '0P2AGB553400YK', 'DJI', 8, 'tersedia', 'FB2-3850 mAh | 15.4 V (Kembung)', '1750224088_qr.svg', 5, 5, '1750224088.jpeg', '2025-06-18 05:21:29', '2025-06-18 05:21:29'),
(112, 'bbb5e395-ee14-4c2d-915c-3e766aded62c', 'VBCENZH7UIQG', 'CAMCORDER SONY PXW-X160 (1)', '1605355', 'SONY', 1, 'tersedia', '25X OPTICAL ZOOM', '1750296190_qr.svg', 5, 5, '1753841803.jpg', '2025-06-19 01:23:11', '2025-07-30 02:16:43'),
(113, 'ecb50657-6bdc-41f6-a0f3-8709d2a5c4c7', '5QZ62YDE0GTH', 'CAMCORDER SONY PXW-X160 (2)', '1605358', 'SONY', 1, 'tersedia', '25X OPTICAL ZOOM', '1750296193_qr.svg', 5, 5, '1753841809.jpg', '2025-06-19 01:23:13', '2025-07-30 02:16:49'),
(114, '4cf81511-e112-4c1e-9b91-558b7952019f', 'KWUYJDSOLH85', 'TRIPOD TAKARA SPIRIT-3 (1)', '123456789', 'TAKARA', 8, 'tersedia', 'TRIPOD TAKARA SPIRIT-3', '1750296696_qr.svg', 5, 5, '1750296696.png', '2025-06-19 01:31:36', '2025-06-19 01:31:36'),
(115, '3ad990b9-2567-4714-9b14-c78ea6c22643', 'LR8XWNAB23MP', 'TRIPOD TAKARA SPIRIT-3 (2)', '123456789', 'TAKARA', 8, 'tersedia', 'TRIPOD TAKARA SPIRIT-3', '1750296699_qr.svg', 5, 5, '1750296699.png', '2025-06-19 01:31:39', '2025-06-19 01:31:39'),
(116, 'aa3968f2-6698-48bc-abdf-afaea3000b8d', 'CVUSXI29FP8T', 'TRIPOD TAKARA SPIRIT-3 (3)', '123456789', 'TAKARA', 8, 'tersedia', 'TRIPOD TAKARA SPIRIT-3', '1750296700_qr.svg', 5, 5, '1750296700.png', '2025-06-19 01:31:40', '2025-06-19 01:31:40'),
(117, '55960a46-6a54-4041-9697-dbdcb9af2cea', 'W3UZCBDHT6SQ', 'TRIPOD TAKARA SPIRIT-3 (4)', '123456789', 'TAKARA', 8, 'tersedia', 'TRIPOD TAKARA SPIRIT-3', '1750296701_qr.svg', 5, 5, '1750296701.png', '2025-06-19 01:31:42', '2025-06-19 01:31:42'),
(118, '861b70b6-27e0-47f3-a152-6c0315fc1a30', 'ECSV5GOUPQJX', 'TRIPOD KECIL', '123456789', 'Tidak bermerk', 8, 'tersedia', 'tripod kecil tidak bermerk', '1750296757_qr.svg', 5, 5, '1750296757.png', '2025-06-19 01:32:37', '2025-06-19 01:32:37'),
(119, '32d7e6c2-aa50-4402-a552-5743eb938bc2', '27ZKSC43H6VB', 'Atem Mini', '7303010', 'Blackmagic', 8, 'tersedia', NULL, '1750726363_qr.svg', 5, 5, '1750726364.jpeg', '2025-06-24 00:52:45', '2025-06-24 00:52:45'),
(120, 'a1b93cc8-4043-41aa-83d8-aef9073555ae', 'BH6V05NM7EKW', 'HDMI Video Capture 261M', 'EZCAP261202010', 'EZCAP', 8, 'tersedia', 'USB 3.0', '1750726871_qr.svg', 5, 5, '1750726871.jpeg', '2025-06-24 01:01:11', '2025-06-24 01:01:11'),
(121, '75f99e18-328f-4361-8ae7-9a912c650bbd', 'Y4WVOZN9E3SR', 'AC Adaptor / Charger BC-U1', '16053005046', 'SONY', 8, 'tersedia', 'CLASS 2 BATTERY', '1750727290_qr.svg', 5, 5, '1750727290.jpg', '2025-06-24 01:08:10', '2025-06-24 01:08:10'),
(122, '247fdee5-4a7d-426d-808c-499ff8322e11', 'DGH4UNFR1BMZ', 'AC Adaptor / Charger BC-U1 (1)', '16053005046', 'SONY', 8, 'tersedia', NULL, '1750727444_qr.svg', 5, 5, '1750727444.jpg', '2025-06-24 01:10:44', '2025-06-24 01:10:44'),
(123, '7338fd95-2b11-4911-a96c-9316ad7b5124', 'KF7UM6DT0EAG', 'AC Adaptor / Charger BC-U1 (2)', '16053005046', 'SONY', 8, 'tersedia', NULL, '1750727477_qr.svg', 5, 5, '1750727477.jpg', '2025-06-24 01:11:17', '2025-06-24 01:11:17'),
(124, '939e7c78-b9d4-4748-8798-80c7ae40d13a', 'PMSJ90BXUHDT', 'HD/SD-SDI Distribution Amplifier', 'VP-597', 'datavideo', 8, 'tersedia', '2 x 6 3G HD/SD-SDI Distribution Amplifier', '1750730443_qr.svg', 5, 5, '1750730444.jpg', '2025-06-24 02:00:46', '2025-06-24 02:00:46'),
(125, '105bbfdd-60f0-4920-87e7-d3bb7fbc4f61', 'ATFYRQZO15H8', 'HD/SD-SDI Distribution Amplifier (1)', 'VP-597', 'datavideo', 8, 'tersedia', '2 x 6 3G HD/SD-SDI Distribution Amplifier', '1750730497_qr.svg', 5, 5, '1750730497.jpg', '2025-06-24 02:01:37', '2025-06-24 02:01:37'),
(126, 'caa1a5f9-4035-4625-83d1-3bc22d48ebb1', 'GOVCELKR0QX3', 'Mini Converter Analog to SDI', '2354663', 'Blackmagicdesign', 8, 'tersedia', NULL, '1750730939_qr.svg', 5, 5, '1750730939.jpg', '2025-06-24 02:08:59', '2025-06-24 02:08:59'),
(127, 'a7d1ce36-a6bc-4a0a-9021-8e5c619e2111', '3HYTU6ADERGK', 'Mini Converter Analog to SDI (1)', '2355245', 'Blackmagicdesign', 8, 'tersedia', NULL, '1750730982_qr.svg', 5, 5, '1750730982.jpg', '2025-06-24 02:09:42', '2025-06-24 02:09:42'),
(129, 'e0850d6c-9b1a-48d9-a176-3319adaf5bd0', 'XWPOJ6KNZ584', 'Mini Converter Analog to SDI (2)', '2355245', 'Blackmagicdesign', 8, 'tersedia', NULL, '1750731124_qr.svg', 5, 5, '1750731124.jpg', '2025-06-24 02:12:04', '2025-06-24 02:12:04'),
(130, '0de24aa3-8717-45b1-ab08-cbe97f6d2146', 'QUVY98OF14GS', 'Audio Distributor', '02180272600065', 'Kramer', 8, 'tersedia', '1 Input 5 Output', '1750731564_qr.svg', 5, 5, '1750731564.jpg', '2025-06-24 02:19:24', '2025-06-24 02:19:24'),
(131, '411ab3cf-6762-4c69-b2b5-2395bfe2861f', 'IPGMWOZVTLXH', 'UPS ICA  CE1200', '1B1D21427087', 'ICA', 8, 'tersedia', 'UPS Kapasitas 1200 VA', '1750810571_qr.svg', 5, 5, '1750810571.jpeg', '2025-06-25 00:16:14', '2025-06-25 00:16:14'),
(132, '877be4a2-0136-4e5d-a992-67f265385b1b', 'OMR5GEHJ0NY1', 'UPS ICA CE1200 (1)', '1B1D21427087', 'ICA', 8, 'tersedia', 'UPS Kapasitas 1200 VA', '1750810648_qr.svg', 5, 5, '1750810648.jpeg', '2025-06-25 00:17:28', '2025-06-25 00:17:28'),
(133, 'ac1d26b4-cc4d-4da3-95f2-ca63ee8b120b', '6QS2N97HY4F5', 'UPS ICA 3200 VA', '121701500155', 'ICA', 8, 'tersedia', 'UPS Kapasitas 3200 VA', '1750810756_qr.svg', 5, 5, '1750810756.jpg', '2025-06-25 00:19:16', '2025-06-25 00:19:16'),
(134, '56f5f1cf-a1c7-4712-8e4a-398d97854dad', 'E7UDG8WKXLP4', '4 Port HDMI Splitter', 'N242500054', 'BAFO', 8, 'tersedia', '4 Port Out 1 Port In', '1750811080_qr.svg', 5, 5, '1750811080.jpg', '2025-06-25 00:24:40', '2025-06-25 00:24:40'),
(135, '4a4a9149-a342-4c7f-adf3-a91d40b0b068', 'SPJ2KOYVX9RB', '4 Port HDMI Splitter (1)', 'N242500054', 'BAFO', 8, 'tersedia', '4 Port Out 1 Port In', '1750811123_qr.svg', 5, 5, '1750811123.jpg', '2025-06-25 00:25:23', '2025-06-25 00:25:23'),
(136, '2dbd102d-c11a-4ab3-95b9-f410a5c5df92', 'IJB68AEOXLQP', 'Lampu Godox SL300III (2)', '23C00193241', 'Godox', 12, 'tersedia', 'Lampu Godox SL300III', '1750813013_qr.svg', 5, 5, '1753841458.jpg', '2025-06-25 00:56:55', '2025-07-30 02:10:58'),
(137, 'd2e30e1e-e763-43a6-b7d1-21ec197d6127', '5FDWO8TBZKHI', 'Lampu Godox SL300III (1)', '23C00193186', 'Godox', 12, 'tersedia', 'Lampu Godox SL300III', '1750813055_qr.svg', 5, 5, '1753841447.jpg', '2025-06-25 00:57:35', '2025-07-30 02:10:47'),
(138, '9f20b82d-7b33-47b3-86ce-efdb72be916e', 'RVMIHYT9XQ1W', 'Lampu Godox SL300III Bi', '23I00084920', 'Godox', 12, 'tersedia', 'Lampu Godox SL300III', '1750813124_qr.svg', 5, 5, '1753841440.jpg', '2025-06-25 00:58:44', '2025-07-30 02:10:40'),
(139, '44dcad38-c10a-4df0-9c59-84eedb728fed', 'ST2JFYW43HZD', 'Lampu Godox LED 1000 Bi II (1)', 'M21A057430', 'Godox', 12, 'tersedia', 'Lampu Godox LED 1000 Bi II', '1750813386_qr.svg', 5, 5, '1753841383.jpg', '2025-06-25 01:03:06', '2025-07-30 02:09:43'),
(140, 'fcccf1f0-3cee-4c11-8fe1-887cda225813', '3K17FEDJ8BMO', 'Lampu Godox LED 1000 Bi II (2)', 'M21A057429', 'Godox', 12, 'tersedia', 'Lampu Godox LED 1000 Bi II', '1750813441_qr.svg', 5, 5, '1753841376.jpg', '2025-06-25 01:04:01', '2025-07-30 02:09:36'),
(141, 'cc8b4ab0-6998-4a6c-b256-4e6fc365b472', '8K7TOFIE5W39', 'AC Adaptor/Charger S-3602F', 'S-3602F', 'Swit', 8, 'tersedia', '100V-240V, 50/60Hz\r\n7V-8.4V (Charging)\r\n8.4V (Adapting)', '1751249168_qr.svg', 5, 5, '1753841201.jpeg', '2025-06-30 02:06:12', '2025-07-30 02:06:41'),
(142, '79019029-7f2f-47e1-a969-52db590e8446', 'Z0TE76Q4NGI1', 'Lensa Nikon AF Nikkor 20mm 1:2.8D', '123456789', 'Nikon', 2, 'tersedia', 'Lensa sudut lebar yang kompatibel dengan kamera full-frame (FX) maupun format DX.', '1751328625_qr.svg', 5, 5, '1753841163.jpg', '2025-07-01 00:10:29', '2025-07-30 02:06:03'),
(143, '2fc585ad-e568-4e02-b29b-bed4663fd829', 'H49MDTA72P1O', 'SWIT Battery S-8970 (1)', '00942029', 'SWIT', 4, 'tersedia', 'Baterai ini memiliki tegangan nominal 7.2V, kapasitas 47Wh (6.6Ah)', '1751330216_qr.svg', 5, 5, '1753841144.jpeg', '2025-07-01 00:36:56', '2025-07-30 02:05:44'),
(144, 'fab55709-522c-49f3-9179-c93e1e74d52a', 'QJXZSE15K9NW', 'SWIT Battery S-8970 (2)', '00941929', 'SWIT', 4, 'tersedia', 'Baterai ini memiliki tegangan nominal 7.2V, kapasitas 47Wh (6.6Ah)', '1751330710_qr.svg', 5, 5, '1753841138.jpeg', '2025-07-01 00:45:10', '2025-07-30 02:05:38'),
(145, 'fb53805b-2934-43dd-a37a-c8b2f5246c49', 'X2ZCE19RKWF0', 'SWIT Battery S-8970 (3)', '00941779', 'SWIT', 4, 'tersedia', 'Baterai ini memiliki tegangan nominal 7.2V, kapasitas 47Wh (6.6Ah)', '1751330870_qr.svg', 5, 5, '1753841130.jpeg', '2025-07-01 00:47:50', '2025-07-30 02:05:30'),
(146, '3e542f1c-946b-48e9-92ac-3758b8c0dc1c', 'FBA3NOZUL2X8', 'SONY Battery NP-F970', '123456789', 'SONY', 4, 'tersedia', 'Tipe: Lithium-ion.\r\nKapasitas: 6600mAh atau 7800mAh (tergantung model).\r\nTegangan: 7.2V.', '1751332351_qr.svg', 5, 5, '1753841109.jpeg', '2025-07-01 01:12:31', '2025-07-30 02:05:09'),
(147, 'f976ec0b-a0f7-4228-a47c-3685229ad0f7', 'V9CE2G5F6IWM', 'SONY Battery NP-F970 (2)', '123456789', 'SONY', 4, 'tersedia', 'Tipe: Lithium-ion. Kapasitas: 6600mAh atau 7800mAh (tergantung model). Tegangan: 7.2V.', '1751332657_qr.svg', 5, 5, '1753841098.jpeg', '2025-07-01 01:17:37', '2025-07-30 02:04:58'),
(148, '88052528-cae7-4b3d-9d8e-aeb34bead2f4', 'OY4RJ8NMXDSE', 'SONY BATTERY PACK NP-F770 (1)', '123456789', 'SONY', 4, 'tersedia', 'baterai lithium-ion yang dapat diisi ulang, dirancang untuk camcorder dan peralatan Sony lainnya. Baterai ini memiliki kapasitas sekitar 4400mAh dan tegangan 7.2V', '1751414291_qr.svg', 5, 5, '1753841062.jpg', '2025-07-01 23:58:15', '2025-07-30 02:04:22'),
(149, '7b65cf4a-7e0d-4394-aba7-f7fb4c340a66', 'HNVPYU26DMEG', 'SONY BATTERY PACK NP-F770 (2)', '123456789', 'SONY', 4, 'tersedia', 'baterai lithium-ion yang dapat diisi ulang, dirancang untuk camcorder dan peralatan Sony lainnya. Baterai ini memiliki kapasitas sekitar 4400mAh dan tegangan 7.2V', '1751414356_qr.svg', 5, 5, '1753841053.jpg', '2025-07-01 23:59:16', '2025-07-30 02:04:13'),
(150, '277fc9a0-bf7e-4db8-ac7f-c2e9f47901b5', 'PRX8YT9WL0D7', 'Baterai POWERANGE DF-248', '123456789', 'powerange', 4, 'tersedia', 'Baterai ini memiliki output 7.4V dengan kapasitas 6.6Ah atau 48Wh. Ukurannya kompak, 70mm x 38mm x 58mm, dan beratnya sekitar 270g. Baterai ini juga mendukung berbagai suhu pengoperasian, dari -20°C hingga +55°C.', '1751414749_qr.svg', 5, 5, '1751414749.jpg', '2025-07-02 00:05:49', '2025-07-02 00:05:49'),
(151, '6601283e-a76a-4ca0-b30e-9b4b40b1f944', 'Q1GC75MJ34Z9', 'AC Adaptor/Charger S-3602F (2)', 'S-3602F', 'SWIT', 8, 'tersedia', '100V-240V, 50/60Hz 7V-8,4V (Charging) 8,4V (Adapting)', '1751506257_qr.svg', 5, 5, '1751506257.jpeg', '2025-07-03 01:30:58', '2025-07-03 01:30:58'),
(152, '50983b7d-e821-497c-8bb1-f4f18049387f', 'WA1O473JZM0E', 'GODOX RGB MINI CREATIVE LIGHT', 'M1', 'GODOX', 12, 'tersedia', 'Input 5V = 2,4A, Battery: 7,6V, 2410mAh/18.3Wh', '1751506791_qr.svg', 5, 5, '1753841022.jpg', '2025-07-03 01:39:51', '2025-07-30 02:03:42'),
(153, 'be782859-7b2c-477c-8665-195f45f2e84c', 'VM6DHPNSLFG4', 'GODOX RGB MINI CREATIVE LIGHT (2)', 'M1', 'GODOX', 12, 'tersedia', 'Input 5V = 2,4A, Battery: 7,6V, 2410mAh/18.3Wh', '1751507024_qr.svg', 5, 5, '1753841015.jpg', '2025-07-03 01:43:44', '2025-07-30 02:03:35'),
(154, '42d0b94c-47c3-47da-8e93-d1dd6e97396e', 'VJINHD1CQEBR', 'GODOX RGB MINI CREATIVE LIGHT (3)', 'M1', 'GODOX', 12, 'tersedia', 'Input 5V = 2,4A, Battery: 7,6V, 2410mAh/18.3Wh', '1751507159_qr.svg', 5, 5, '1753841009.jpg', '2025-07-03 01:45:59', '2025-07-30 02:03:29'),
(155, '7c0ca5d9-a924-4afe-a858-07772080ea81', 'PG7N2V1HRAFX', '4 Port HDMI Splitter (2)', '-', 'BAFO', 8, 'tersedia', '4 Port Out 1 Port In', '1751507574_qr.svg', 5, 5, 'default.jpg', '2025-07-03 01:52:54', '2025-07-03 01:52:54'),
(156, '75a32d8d-eb73-46e3-9de4-acbf08a64f9d', 'YM6ZEU2JLC9O', 'SDI & HDMI WIRELESS SYSTEM', 'FLOW500', 'SWIT', 8, 'tersedia', '-', '1751507937_qr.svg', 5, 5, '1751507937.jpg', '2025-07-03 01:58:57', '2025-07-03 01:58:57'),
(157, 'fda00191-d5a8-450b-9a79-b4dfc5b051a2', '6GVQDBI0PU9R', 'SDI & HDMI WIRELESS SYSTEM (2)', 'FLOW500', 'SWIT', 8, 'tersedia', '-', '1751507969_qr.svg', 5, 5, '1751507969.jpg', '2025-07-03 01:59:29', '2025-07-03 01:59:29'),
(158, 'a2ff33ed-b284-4c88-8a24-bca400573fe0', 'U9MFV4O1SLP8', 'SDI & HDMI WIRELESS SYSTEM (3)', 'FLOW500', 'SWIT', 8, 'tersedia', '-', '1751507994_qr.svg', 5, 5, '1751507994.jpg', '2025-07-03 01:59:54', '2025-07-03 01:59:54'),
(159, '7e0173b7-70ac-4432-93d5-7750479de79d', 'T0OEP54AWDHV', 'Mini Converter SDI to Analog 4k', '2360671', 'Black Magic Design', 8, 'tersedia', 'Mini Converter SDI to Analog 4K includes everything you need to convert from SD, HD, 3G and 6G‑SDI video to analog in HD/SD component, NTSC and PAL video. The built in down converter means you can even connect Ultra HD sources to component video in SD or HD as well as NTSC and PAL video! Easily connect any analog equipment such as Betacam SP, VHS, and video monitors!', '1751591815_qr.svg', 5, 5, '1751591815.jpeg', '2025-07-04 01:16:58', '2025-07-04 01:16:58'),
(160, 'fcf9ffa7-79a4-474a-a5b8-ad3dadf48c6c', 'RYJ420GCHNIQ', 'Mini Converter SDI to Analog', '6937462``', 'Black Magic Design', 8, 'tersedia', 'The perfect way to convert from SD and HD‑SDI to analog component, s‑video or NTSC/PAL composite. Mini Converter SDI to analog supports all SD and HD input formats up to 1080p30 and includes a down converter for when you need to convert from HD to standard definition analog formats such as s‑video and composite. Audio can be de‑embedded to balanced analog or AES/EBU. Mini Converter SDI to Analog is ideal for converting to older analog equipment when you don’t need the extra cost of the 6G‑SDI 4K model.', '1751592226_qr.svg', 5, 5, '1751592226.jpeg', '2025-07-04 01:23:46', '2025-07-04 01:23:46'),
(161, '0a5640ed-b79b-4d0c-9210-b535daabcdb6', 'OTB8FL3R4J7N', 'HyperDeck Studio HD Mini', '11477950', 'Black Magic Design', 8, 'tersedia', 'HyperDeck Studio lets you record broadcast quality video files directly onto SD cards and SSD media! The new redesigned HyperDeck Studios feature modern design with more codecs and quieter cooling. All models now support recording to H.264, Apple ProRes or DNxHD files with either PCM or AAC audio. Plus the 4K model adds support for H.265 files! When you\'ve finished recording, media can be mounted on any computer to access the files using your favorite video software. For ISO recording, there\'s even built in timecode and reference generators for syncing multiple units! All of these powerful features make HyperDeck Studio perfect for broadcast, live production or multi screen digital signage!', '1751592704_qr.svg', 5, 5, '1751592704.jpeg', '2025-07-04 01:31:44', '2025-07-04 01:31:44'),
(162, '27391a9a-09a1-418f-b0a6-b1941ca8f9ed', 'LZF1AHY2QUKI', 'Atem Television Studio HD', '6139446', 'Black Magic Design', 15, 'tersedia', 'The new ATEM Television Studio is a professional live production switcher built into a broadcast control panel so it can be used for high end work while being extremely portable. This means you can use it in small venues that don\'t have the access for equipment racks or broadcast vans. You get a powerful switcher with 8 standards converted SDI inputs, aux outputs, 4 chroma keyers, 2 downstream keyers, SuperSource, 2 media players and lots of transitions! Plus it includes a whole television studio of features such as hardware streaming, recording, audio mixer, talkback, multiview and optional internal network shared storage. There\'s even an ISO model that records all 8 inputs for editing!', '1751592906_qr.svg', 5, 5, '1751592906.jpg', '2025-07-04 01:35:06', '2025-07-04 01:35:06'),
(163, '8cd10e1e-4b53-46d1-849f-e88bd4d25257', 'H26XO9PQG8DF', 'LCD Monitor HD-SDI, HDMI & YPbPr', '667GL', 'Lilliput', 8, 'tersedia', 'On Camera Monitors Security Monitors Live Streams Embedded PCs and Industrial Tablets Metal', '1751593987_qr.svg', 5, 5, '1751593987.jpeg', '2025-07-04 01:53:07', '2025-07-04 01:53:07'),
(164, '3450fdea-9060-49bc-9402-708e881c79b1', '850UIABD4POC', 'HDMI cable with ethernet', '4719857309858', 'BAFO Technologies', 8, 'tersedia', 'BAFO HDMI Cable High Speed with Ethernet\r\n\r\nFull HD 1080P\r\n2.0 Version\r\n4K\r\n\r\nHDMI 19pin standard (Type-A) connector to HDMI 19 pin (Type-A) connector', '1751594455_qr.svg', 5, 5, '1751594455.jpg', '2025-07-04 02:00:55', '2025-07-04 02:00:55'),
(165, 'bca34fd3-266e-4b09-833a-6a70abc5bc84', 'RQL605TBAM3W', 'Directional Converter', 'LXBFH480', 'decimator design', 8, 'tersedia', 'Pocket-Sized Bidirectional Converter\r\nHDMI Input and Output\r\n3G/HD/SD-SDI Input and Output\r\nMultiple Input/Output Conversion Modes\r\nHDMI and SDI Input Locks', '1751594776_qr.svg', 5, 5, '1751594776.jpg', '2025-07-04 02:06:16', '2025-07-04 02:06:16'),
(166, '9c6d4275-53c6-4d18-b9ca-c89ef72ab730', '9Z4AV20MW7LR', 'SHURE WIRELESS MICROPHONE (1)', '3RC1342455', 'SHURE', 6, 'tersedia', '1 Receiver display digital\r\n2 antena\r\n2 transceiver + 2 mic clip on\r\nkabel konektor\r\nUHF Frequency\r\nJarak jangkauan bisa sampai dengan 50m', '1751595110_qr.svg', 5, 5, '1751595110.jpg', '2025-07-04 02:11:50', '2025-07-09 02:40:08'),
(167, '7e715a8e-fd63-458b-8154-24244ec874fc', 'PVFBKCJRYQ7X', '4 port hdmi 2.0 splitter', '00689798', 'BAFO TECHNOLOGIES', 8, 'tersedia', 'Compatibility HDMI 2.0 Resolution 4Kx2K@60Hz Max Transmission Rate 18Gbps Input HDMI*1 Output HDMI*4 Material Metal Shell Application Computer, Multimedia, Monitor, Projector, etc', '1751849590_qr.svg', 5, 5, '1751849590.jpeg', '2025-07-07 00:53:13', '2025-07-07 00:53:13'),
(168, '03ca1bca-cd53-407d-bbec-fc6342a1f082', 'HNFWEG2ALQ90', 'LCD HD-SDI, HDMI & YPbPr Input 2', '12345678', 'LILLIPUT', 8, 'tersedia', '4k Kamera top 7\" Monitor untuk video production seperti video clip, vlog, dan produksi lainnya dengan memanfaatkan kamera 4K digital seperti DSLR dan Mirrorless dengan input hanya HDMI. Sangat ringan dan praktis, dapat dinyalakan dengan tenaga batterei selain juga power adaptor.', '1751850097_qr.svg', 5, 5, '1751850097.jpeg', '2025-07-07 01:01:37', '2025-07-07 01:01:37'),
(169, '40c2de39-7b35-454a-83e7-31ed3746af5e', 'KEQ3WU9YXFCD', 'professional HD display solutions', '969PB74082062', 'LILLIPUT', 8, 'tersedia', '4k Kamera top 9,7 Monitor untuk video production seperti video clip, vlog, dan produksi lainnya dengan memanfaatkan kamera 4K digital seperti DSLR dan Mirrorless dengan input hanya HDMI. Sangat ringan dan praktis, dapat dinyalakan dengan tenaga batterei selain juga power adaptor.', '1751850766_qr.svg', 5, 5, '1751850766.jpg', '2025-07-07 01:12:46', '2025-07-07 01:12:46'),
(170, '894c10c6-223e-4a1b-ac8e-31e6d2bf13cf', '2K5VAIGM0C7Z', 'FIVERAY M40', '8FF02E0C0010081', 'ZHIYUN', 8, 'tersedia', '•40W high power in a pocket size\r\n•Color temperature ranging from 2700-6500k, CRI reaches 95+\r\n•Smart & advanced cooling system\r\n•Precise parameter control via the wheels\r\n•Versatile extension (can be mounted on difference devices and applied in various scenarios)\r\n•Fast & easy charging (50W PD fast charging)', '1751851059_qr.svg', 5, 5, '1751851059.jpg', '2025-07-07 01:17:39', '2025-07-07 01:17:39'),
(171, '0332e7a8-392d-4664-b906-be27861fb4da', 'H893POXCNZLE', 'DIGITAL VIDEO BATTERY', '1520851803883', 'DIGITAL', 4, 'tersedia', 'Baterai ini memiliki kapasitas 4000mAh dan overheat protection. Membuat baterai ini awet dan tahan lama untuk kamera Anda. Meskipun baterai ini bukan baterai original Sony, tapi kualitasnya sebanding dengan baterai originalnya Sony.', '1751851358_qr.svg', 5, 5, '1751851358.jpg', '2025-07-07 01:22:38', '2025-07-07 01:22:38'),
(172, 'b1bf4bab-2f65-4d00-b2c2-7c8ad9609673', 'PN7BXYDO9M14', 'EXTENDER UP TO 20KM', 'CON00100', 'SINGLE FIBER OPTIC', 8, 'tersedia', 'INCLUDE TRANSMITTER + RECEIVER', '1751851740_qr.svg', 5, 5, '1751851740.jpeg', '2025-07-07 01:29:01', '2025-07-07 01:29:14'),
(173, 'b9a59b7a-48e9-4b9c-8c8b-58161d293291', 'WK6OCV3EZSY9', 'WIRELESS VIDEO TRANSMISSION SYSTEM', '0023450T 1208642', 'HOLLYLAND', 8, 'tersedia', 'Mars 4K mendukung transmisi video 4K UHD pada 30fps untuk videografer cerdas yang mencari kemampuan produksi resolusi tinggi. Mars 4K juga mendukung format FHD dan HD pada kecepatan bingkai yang bervariasi—24p, 30p, dan 60p. (2PCS/BOX)', '1751852057_qr.svg', 5, 5, '1751852057.jpg', '2025-07-07 01:34:17', '2025-07-07 01:34:17'),
(174, '4a20212b-e413-41a2-ace0-6355bab5a1ca', '57M016KR2YPX', 'SMARTGEN BATTERY CHARGER', '12394834987002808', 'SMARTGEN', 4, 'tersedia', 'BAC06 series switching battery charger adopts the latest switch power components, which is designed for charging lead-acid starting battery according to its property. The charger is suitable for lead-acid battery float charge. The maximum charge current for 12V charger is 6A; the maximum charge current for 24V charger is 3A.', '1751852222_qr.svg', 5, 5, '1751852234.jpg', '2025-07-07 01:37:02', '2025-07-07 01:37:14'),
(175, '12fd54b6-281f-4d9f-9889-6e8476082d50', 'Y56W1DR72BIH', 'mikrotik motherboard', 'RB760iGS', 'hEX series', 8, 'tersedia', 'HEX S is a five-port Gigabit Ethernet router for locations where wireless connectivity is not required\r\nCompared to the hEX, the hEX S also features an SFP port and PoE output on the last port.\r\nIt is affordable, small and easy to use, but at the same time it comes with a very powerful dual-core 880 MHz CPU and 256 MB of RAM, capable of all the advanced configurations that RouterOS supports.\r\nThe device has a USB 2.0 PoE output for Ethernet port #5 and a 1.25 Gbit/s SFP cage.\r\nPort #5 can power other passive PoE-capable devices with the same voltage applied to the unit.', '1751938326_qr.svg', 5, 5, '1751938326.jpg', '2025-07-08 01:32:10', '2025-07-08 01:32:10'),
(176, 'bb657a61-4a72-4e77-9bb2-996b4e05349e', '3B5NPLQTHA1X', 'LCD Display Dual Slot Charger', 'NP-F970', 'RoHS', 8, 'tersedia', 'Two high capacity of 8800mAh 7.2V NP-F970 batteries,no memory effect , you can charge them at any time and anywhere,maximize charging efficiency,increasing your camera run time.\r\nDesigned with dual-channel charger can charge 2 packs 8800mAh np-f970 backup simultaneous,LED light clearly shows the charging status:red light means charging, green means fully charged.\r\nFully decoded batteries, you can check the remaining capacity, shutter count and recharge performance on the cameras power source info screen.Compatible with Sony NP-F990 NP-F975 NP-F970 NP-F960 NP-F950 NP-F930 NP-F770 NP-F750 NP-F730 NP-F570 NP-F550 NP-F530 NP-F330 Battery, Sony Camcorder and LED Video Light.\r\nCommon micro-USB input makes the charger possible to be powered up via a wall charger, car charger, or even a power bank.\r\nNP-F970 lithium-ion battery pack passed CE,FCC and RoHS certificated, built-in 6 layers of protection: over-charging,over-discharging, short-circuit, over-current, over-heat and battery PTC protection to ensure that your battery pack will be safe to use as a replacement for your devices.', '1751939016_qr.svg', 5, 5, '1751939016.png', '2025-07-08 01:43:36', '2025-07-08 01:43:36'),
(177, '0d086ba2-5372-4d1b-befc-92b3304273c9', '96M8ZF1JKS5B', 'DIGITTRADE High Security HDD HS256 S3', '2563001128', 'DIGITTRADE', 8, 'tersedia', 'External high-security hard disk HS256 S3\r\nProfessional solution for authorities and companies\r\nThe portable high security hard disk HS256 S3 enables data protection compliant storage, sending and archiving of sensitive and personal data at authorities and companies. It\'s faster, safer and more robust than any other HS hard drive.\r\nThe elegant and robust 2.5-inch aluminum housing protects against mechanical influences and electromagnetic waves. The USB3.0 connection ensures fast data transmission during reading and writing.\r\nThe BSI certification confirms that you can entrust this hard drive with your particularly sensitive data. In addition, by using this hard drive you fulfill the strictest requirements of the Federal Data Protection Act (BDSG) and the European Data Protection Regulation (EU-DSGVO) with regard to the secure storage and storage of personal data.\r\nThe information stored on the HS256 S3 is protected from unauthorized access, for example if the hard drive is lost or stolen, or in the case of logical or physical attacks, in view of the confidentiality of the information.\r\n\r\nThe Digittrade HS256 S3 ensures the confidentiality of the data through the following security mechanisms:\r\nEncryption\r\nAccess control\r\nManagement of cryptographic keys', '1751939524_qr.svg', 5, 5, '1753840960.jpg', '2025-07-08 01:52:04', '2025-07-30 02:02:40'),
(178, '7ecf7666-ad3d-4f18-a4c2-5c6bf7abce53', '2PIK6L5VMEU8', 'SMOOTH-Q3 SM113', 'ER95863/21', 'ZHIYUN', 8, 'tersedia', 'The Smooth-Q3 is a compact folding 3-axis stabilizer for smartphones, designed with a built-in LED video light with three selectable brightness levels. It provides stabilized motion along the pan, tilt, and roll axes to let you capture smooth, professional-looking video with your phone. The gimbal easily switches between portrait and landscape modes at the press of a button, allowing you to shoot both cinematic and social media videos while the LED light illuminates your subjects. The phone holder supports smartphones up to 3.5\" wide, covering most phones.\r\nThe gimbal\'s capabilities are enhanced via a companion ZY Cami iOS/Android app, which allows you to set up creative movements such as Simplified Dolly Zoom. The app also offers functions such as Advanced Smart Tracking and one-tap live streaming. The gimbal has an ergonomic design with a nonslip handle, and it runs for up to 15 hours on the included battery and fully recharges in approximately three hours. A mini tripod is also included and can be used as a tripod or handgrip extension to allow you to hold the gimbal with two hands for better control of it.', '1751940109_qr.svg', 5, 5, '1753840935.jpg', '2025-07-08 02:01:49', '2025-07-30 02:02:15'),
(179, 'a3038b1e-64eb-4a5d-8ec1-dccea3c515cb', 'N6LBD9HW4OIC', 'Professional FM Transceiver KD-C1 1', '81650/SDPPI/2022 7850', 'WLN', 9, 'tersedia', 'HT WLN KD-C1; Specification : General Frequency Range: 400-470MHz Operation Voltage: DC3.7V Channel Capacity: 16 Antenna: Integrated antenna Antenna Impedance: 50 Dimension: 96x55x22mm Transmit Output power: 2W/0.5W The maximum deviation: ±5KHz Residual radiation:  lt;60dB Current: 1000mA Receiver Sensitivity:  lt;0.16µV(12dB SINAD) Squelch Sensitivity:  lt;0.2µV Intermodulation: 50dB Audio Power: 300mW current: 100mA Squelch current: 20mA Jarak jangkauan : up to 5km (tergantung kondisi area)', '1751940733_qr.svg', 5, 5, '1751940733.jpg', '2025-07-08 02:12:13', '2025-07-08 02:12:31'),
(180, 'c8ab909a-24d7-45a9-a826-4251bfe5dc6f', 'Q890JFGCDI4X', 'Professional FM Transceiver KD-C1 2', '81650/SDPPI/2022 7850', 'WLN', 9, 'tersedia', 'HT WLN KD-C1; Specification : General Frequency Range: 400-470MHz Operation Voltage: DC3.7V Channel Capacity: 16 Antenna: Integrated antenna Antenna Impedance: 50 Dimension: 96x55x22mm Transmit Output power: 2W/0.5W The maximum deviation: ±5KHz Residual radiation: lt;60dB Current: 1000mA Receiver Sensitivity: lt;0.16µV(12dB SINAD) Squelch Sensitivity: lt;0.2µV Intermodulation: 50dB Audio Power: 300mW current: 100mA Squelch current: 20mA Jarak jangkauan : up to 5km (tergantung kondisi area)', '1751941021_qr.svg', 5, 5, '1751941021.jpg', '2025-07-08 02:17:01', '2025-07-08 02:17:01');
INSERT INTO `barang` (`id`, `uuid`, `kode_barang`, `nama_barang`, `nomor_seri`, `merk`, `jenis_barang_id`, `status`, `deskripsi`, `qr_code`, `limit`, `sisa_limit`, `foto`, `created_at`, `updated_at`) VALUES
(181, '53350858-9a78-4d95-b483-94b49f13a959', 'SKDZ5ITYU0BL', 'Professional FM Transceiver KD-C1 3', '81650/SDPPI/2022 7850', 'WLN', 9, 'tersedia', 'HT WLN KD-C1; Specification : General Frequency Range: 400-470MHz Operation Voltage: DC3.7V Channel Capacity: 16 Antenna: Integrated antenna Antenna Impedance: 50 Dimension: 96x55x22mm Transmit Output power: 2W/0.5W The maximum deviation: ±5KHz Residual radiation: lt;60dB Current: 1000mA Receiver Sensitivity: lt;0.16µV(12dB SINAD) Squelch Sensitivity: lt;0.2µV Intermodulation: 50dB Audio Power: 300mW current: 100mA Squelch current: 20mA Jarak jangkauan : up to 5km (tergantung kondisi area)', '1751941196_qr.svg', 5, 5, '1751941196.jpg', '2025-07-08 02:19:56', '2025-07-08 02:19:56'),
(182, '16f5c2a5-519b-4273-8395-3fbf20d980a2', 'S6UHIAWXZ95Q', 'Professional FM Transceiver KD-C1 4', 'N6LBD9HW4OIC', 'WLN', 9, 'tersedia', 'HT WLN KD-C1; Specification : General Frequency Range: 400-470MHz Operation Voltage: DC3.7V Channel Capacity: 16 Antenna: Integrated antenna Antenna Impedance: 50 Dimension: 96x55x22mm Transmit Output power: 2W/0.5W The maximum deviation: ±5KHz Residual radiation: lt;60dB Current: 1000mA Receiver Sensitivity: lt;0.16µV(12dB SINAD) Squelch Sensitivity: lt;0.2µV Intermodulation: 50dB Audio Power: 300mW current: 100mA Squelch current: 20mA Jarak jangkauan : up to 5km (tergantung kondisi area)', '1751941317_qr.svg', 5, 5, '1751941456.jpg', '2025-07-08 02:21:57', '2025-07-08 02:24:16'),
(183, 'c0ef9e3c-9764-4eb8-a6e3-248b001dbed9', 'UNKIOX94PWRY', 'Lampu GODOX SL150III [1]', '22L00099060', 'Godox', 12, 'tersedia', 'The Godox SL150W II LED Video Light is a daylight-balanced 150W LED monolite-style light source suitable for broadcasting, cinematography, online streaming, and other video applications. Dimming settings range from 0% to full power and can be adjusted by its wireless remote.', '1752022246_qr.svg', 5, 5, '1753840809.jpg', '2025-07-09 00:50:49', '2025-07-30 02:00:10'),
(184, 'd4f88d2c-e968-4f22-84e6-adbfda85e992', 'W6H1DLMOZAKQ', 'Lampu GODOX SL150III [2]', '22L00099062', 'Godox', 12, 'tersedia', 'The Godox SL150W II LED Video Light is a daylight-balanced 150W LED monolite-style light source suitable for broadcasting, cinematography, online streaming, and other video applications. Dimming settings range from 0% to full power and can be adjusted by its wireless remote.', '1752022441_qr.svg', 5, 5, '1753840802.jpg', '2025-07-09 00:54:01', '2025-07-30 02:00:02'),
(185, '02489eb8-5c0c-48ec-bdc2-d090a6a01247', '3LYBCRPI9WHE', '8 PORT GIGABIT L2 Managed Switch with 2 SFP', 'CAR10JR000794', 'RUIJIE', 8, 'tersedia', '- Layer 2 Smart Managed Switch 8 Port 10/100/1000BASE-T\r\n- 8 port 10/100/1000BASE-T\r\n- 2 port SFP BASE-X\r\n- Kecepatan switching: 192Gbps\r\n- MAC: 8K, VLAN: 4094\r\n- Fitur Layer 2: port mirroring, loop protection, cable detection\r\n- Fitur keamanan: broadcast storm suppression, port speed limit, port isolasi\r\n- Dimensi: 260x120x43.6mm\r\n- Suhu pengoperasian: 0°C~50°C\r\n- Mudah dikelola dan dikonfigurasi melalui Ruijie cloud\r\n- Manajemen Web terintegrasi\r\n- Daya AC 100~240V, 50/60Hz\r\n- Mendukung IEEE802.1Q VLAN, keamanan antar grup perangkat', '1752022776_qr.svg', 5, 5, '1752022776.png', '2025-07-09 00:59:37', '2025-07-09 01:01:17'),
(186, 'c632eb18-5b40-4fc7-890d-eb66201d88f8', '5JN7ORFTG9L3', 'Rujie 8 PORT GIGABIT L2 Managed Switch with 2 SFP', 'CAR10JR001335', 'RUIJIE', 8, 'tersedia', '- Layer 2 Smart Managed Switch 8 Port 10/100/1000BASE-T\r\n- 8 port 10/100/1000BASE-T\r\n- 2 port SFP BASE-X\r\n- Kecepatan switching: 192Gbps\r\n- MAC: 8K, VLAN: 4094\r\n- Fitur Layer 2: port mirroring, loop protection, cable detection\r\n- Fitur keamanan: broadcast storm suppression, port speed limit, port isolasi\r\n- Dimensi: 260x120x43.6mm\r\n- Suhu pengoperasian: 0°C~50°C\r\n- Mudah dikelola dan dikonfigurasi melalui Ruijie cloud\r\n- Manajemen Web terintegrasi\r\n- Daya AC 100~240V, 50/60Hz\r\n- Mendukung IEEE802.1Q VLAN, keamanan antar grup perangkat', '1752022946_qr.svg', 5, 5, '1753840736.jpg', '2025-07-09 01:02:26', '2025-07-30 01:58:56'),
(187, '12f84e3c-3c9c-4d02-8ba6-ec3a5b9128d1', 'GFJKWYLT4NU7', 'MIKROTIK', 'HEX090NCZ49', 'MIKROTIK', 8, 'tersedia', 'CRS354-48P-4S+2Q+RM sangat fungsional, dan memiliki harga terbaik di pasaran – menjadikannya tambahan yang sempurna untuk pengaturan profesional.\r\n\r\nTotal throughput non-blocking adalah 168 Gbps, kapasitas switching 336 Gbps, dan kecepatan forwarding mencapai 235 Mpps.\r\n\r\nGaransi 1 Tahun.', '1752023551_qr.svg', 5, 5, '1752023551.png', '2025-07-09 01:12:34', '2025-07-09 01:13:04'),
(188, '24da33ad-c6c1-4521-8bb4-90bcfd012817', '38D5QG9PA0UW', 'SHURE WIRELESS MICROPHONE (2)', '3RD0859591', 'SHURE', 6, 'tersedia', '1 Receiver display digital\r\n2 antena\r\n2 transceiver + 2 mic clip on\r\nkabel konektor\r\nUHF Frequency\r\nJarak jangkauan bisa sampai dengan 50m', '1752023918_qr.svg', 5, 5, '1752023918.jpg', '2025-07-09 01:18:38', '2025-07-09 02:40:11'),
(189, '1aae37aa-0eb0-4d15-8104-ac23341e492d', '81NPEWZKAGTM', 'SHURE WIRELESS MICROPHONE (3)', '3QC1529034', 'SHURE', 6, 'tersedia', 'Di Evolution Music, kami berusaha untuk menonjolkan cacat kosmetik (jika ada) dengan menggambarkan setiap sudut dari setiap perlengkapan sehingga Anda tahu persis apa yang Anda dapatkan. Kami juga selalu menggambarkan semua aksesori. Apa yang Anda lihat adalah apa yang akan Anda dapatkan, jadi silakan lihat gambarnya! Semua yang kami jual telah diuji dan berfungsi penuh kecuali dinyatakan lain. Kami memiliki peringkat bintang 5 dari 1000+ pelanggan yang puas di tiga lokasi kami. Silakan kirim pesan kepada kami jika Anda memiliki pertanyaan. Kami selalu senang membantu dan akan segera menanggapi!', '1752024046_qr.svg', 5, 5, '1752024046.jpg', '2025-07-09 01:20:46', '2025-07-09 01:20:46'),
(190, '1378960d-b430-4628-8f76-1e59579420c1', 'U0KV6IW5DT34', 'SHURE WIRELESS MICROPHONE (4)', '3RA0348954', 'SHURE', 6, 'tersedia', 'Di Evolution Music, kami berusaha untuk menonjolkan cacat kosmetik (jika ada) dengan menggambarkan setiap sudut dari setiap perlengkapan sehingga Anda tahu persis apa yang Anda dapatkan. Kami juga selalu menggambarkan semua aksesori. Apa yang Anda lihat adalah apa yang akan Anda dapatkan, jadi silakan lihat gambarnya! Semua yang kami jual telah diuji dan berfungsi penuh kecuali dinyatakan lain. Kami memiliki peringkat bintang 5 dari 1000+ pelanggan yang puas di tiga lokasi kami. Silakan kirim pesan kepada kami jika Anda memiliki pertanyaan. Kami selalu senang membantu dan akan segera menanggapi!', '1752024242_qr.svg', 5, 5, '1752024242.jpg', '2025-07-09 01:24:02', '2025-07-09 01:54:45'),
(191, '96b6fd1d-828d-4b17-9b2f-7b28df6b566c', '7WVTE0RKMNLX', 'Web Presenter 4K', '13443365', 'Blackmagicdesign', 8, 'tersedia', 'Hubungkan Ponsel 5G atau 4G untuk Data Seluler\r\nOutput Webcam USB untuk Perangkat Lunak Video\r\nPemantauan Teknis Bawaan\r\nTermasuk Utilitas Web Presenter\r\n12G-SDI Mendukung 720 HD, 1080 HD, dan Ultra HD\r\nRedundansi Bawaan Membuat Anda Tetap Siaran\r\nTautan Siaran dengan ATEM Streaming Bridge', '1752109964_qr.svg', 5, 5, '1752109964.jpg', '2025-07-10 01:12:47', '2025-07-10 01:12:47'),
(192, '6cf84ce7-2fed-4bea-9773-a1f2866bde77', 'R2GZ8AQ0W15I', 'Audio Distributor Amplifier', '07151226200003', 'kramer', 8, 'tersedia', 'Penguat distribusi berkinerja tinggi untuk sinyal audio stereo seimbang dan tidak seimbang. Penguat ini menggunakan satu masukan stereo seimbang atau tidak seimbang dan mendistribusikan sinyal secara bersamaan ke sepuluh keluaran stereo (lima seimbang dan lima tidak seimbang). Pilihan Masukan Seimbang/Tidak Seimbang. Rasio S/N - 84 dB (tanpa bobot). Kontrol Level (Gain). Ukuran Desktop - Ukuran ringkas. 2 unit dapat dipasang berdampingan di rak 1U dengan adaptor RK-1 opsional.', '1752110487_qr.svg', 5, 5, '1752110487.jpg', '2025-07-10 01:21:27', '2025-07-10 01:21:27'),
(193, '512e860b-5716-4158-8250-324a4f3624e8', 'LCIA7EQ0H2G5', 'APC Surge Protector', '5z2344t31884', 'APC', 8, 'tersedia', 'APC protection Ectnet RJ45 10/100/1000BaseT\r\nManufacturer: APC\r\nManufacturer\'s number: PNET1GB', '1752110920_qr.svg', 5, 5, '1752110920.jpg', '2025-07-10 01:28:40', '2025-07-10 01:28:40'),
(194, '12fd83ec-7191-4a11-96d3-f5459e32f4f7', 'Z5N83U4WKJTH', 'APC Surge Protector (2)', '5Z344T31773', 'APC', 8, 'tersedia', 'APC protection Ectnet RJ45 10/100/1000BaseT\r\nManufacturer: APC\r\nManufacturer\'s number: PNET1GB', '1752111014_qr.svg', 5, 5, '1752111014.jpg', '2025-07-10 01:30:14', '2025-07-10 01:30:14'),
(195, '1a6c38a9-47d3-43ee-838b-f5b8a21cbaa8', 'LOQ8E1V6HFK3', 'APC Surge Protector (3)', '5Z2344T31887', 'APC', 8, 'tersedia', 'APC protection Ectnet RJ45 10/100/1000BaseT\r\nManufacturer: APC\r\nManufacturer\'s number: PNET1GB', '1752111136_qr.svg', 5, 5, '1752111136.jpg', '2025-07-10 01:32:16', '2025-07-10 01:32:16'),
(196, '0e9a4251-e122-4b2e-beed-920e50c2299e', 'MN9G8SDRE6J7', 'Mini Converter', 'K0546264', 'AJA', 8, 'tersedia', 'Konversi Analog ke Digital kualitas AJA 10-bit\r\nDaya rendah, ukuran ringkas\r\nInput Komponen atau Komposit YPbPr/RGB\r\nOutput HD/SD-SDI\r\nDapat dikonfigurasi dengan sakelar DIP, atau dengan perangkat lunak AJA Mini-Config untuk Mac dan PC melalui USB\r\nCatu Daya DWP-U-R1 Termasuk\r\nGaransi 5 tahun\r\nSpesifikasi\r\nFormat:\r\n525i/625i, 1080i 50/59.94/60 Hz\r\n1080psf 23.98/24/25 Hz\r\n720p 50/59.94/60 Hz\r\nInput:\r\nKomponen HD YPbPr, RGB (SMPTE-274), BNC\r\nKomponen SD (Betacam, EBU-N10)/komposit/YC (S-Video), BNC\r\nOutput: HD/SD-SDI, SMPTE-259/292/296M, 1x BNC\r\nKontrol Pengguna:\r\nDipswitch Eksternal\r\nKontrol (Lokal/Jarak Jauh)\r\nKomponen/Komposit (Hanya SD)\r\nFormat (YPbPr/YC atau RGB)\r\nPedestal Tersedia (hidup/mati) (Hanya SD)\r\nDaya: +5-20 VDC, 3 watt\r\nDimensi: 5,1\" x 2,4\" x 1\" (130 x 61 x 25 mm)', '1752111376_qr.svg', 5, 5, '1752111376.jpg', '2025-07-10 01:36:16', '2025-07-10 01:36:16'),
(197, '600287dc-6233-49a3-aff4-a2c3521cf2a7', 'VRCO731052EB', 'ROLL MIC CABLE (PERLENG) 1', '123456789', '-', 8, 'tersedia', '-', '1752111965_qr.svg', 5, 5, '1752111965.jpg', '2025-07-10 01:46:06', '2025-07-10 01:46:06'),
(198, '2b8923b3-0e74-4aa4-97a0-46093dd62914', 'UX7V4YAIRNSQ', 'ROLL MIC CABLE (2)', '123456789', '-', 8, 'tersedia', '-', '1752112083_qr.svg', 5, 5, '1752112083.jpg', '2025-07-10 01:48:03', '2025-07-10 01:48:03'),
(199, '8d21e986-cad7-4037-bc7a-3bea986a7bf0', '7NC4DQOUE6SZ', 'Extender wifi', '2208227002249', 'tp link', 8, 'tersedia', 'Brings Wi-Fi dead zones to life with strong Wi-Fi expansion at a combined speed of up to 750Mbps*\r\nOperates over both 2.4GHz band(300Mbps) and 5GHz bands(433Mbps) for a more stable wireless experience\r\nIntelligent signal light helps to fi­nd the best location for optimal Wi-Fi coverage by showing the signal strength\r\nWorks with any Wi-Fi router or wireless access point**', '1752201174_qr.svg', 5, 5, '1752201174.jpg', '2025-07-11 02:32:58', '2025-07-11 02:35:20'),
(200, '783e4cbd-6e1a-4277-82a0-f67439c04db8', '8JW7SQN5T0IH', 'Lampu', '-', 'Amaran', 12, 'tersedia', 'APUTURE AMARAN 672S menghasilkan cahaya putih 5500K. Dengan sudut penyinaran cahaya 25derajat (spot).', '1752202100_qr.svg', 5, 5, '1752202100.jpg', '2025-07-11 02:48:21', '2025-07-11 02:48:21'),
(201, '06435831-cf82-4a99-bec0-0f990e37e233', '08WGV6IX51EQ', 'Wireless A', '-', 'CVW', 8, 'tersedia', 'Jarak transmisi hingga 250m (bila tanpa hambatan) dengan penggunaan battery yang umum (model NP-Fx70', '1752202636_qr.svg', 5, 5, '1752202636.jpg', '2025-07-11 02:57:16', '2025-07-11 02:57:16'),
(202, 'e6339f1e-3f5c-45b1-9eb6-1423297b3555', 'KXZN5302IUD4', 'Wireless B', '-', 'CVW', 8, 'tersedia', 'Jarak transmisi hingga 250m (bila tanpa hambatan) dengan penggunaan battery yang umum (model NP-Fx70) .', '1752202871_qr.svg', 5, 5, '1752202871.jpg', '2025-07-11 03:01:11', '2025-07-11 03:01:11'),
(203, 'de2730cb-03df-4457-960f-c213bdfd4b68', 'UR6WQTKZELIH', 'TV Player', '-', 'Leadstar', 8, 'tersedia', 'Providing a ~ 240V universal power supply adapter, adopting DC input design is more secure.\r\nSupport U disk and ; Support high birate decoding; Support 1080p video.\r\nSupport MKV, MOV, AVI, WMV, MP4, FLV, MPEG1-4, MP3 format.\r\nEquipped with 1500mah rechargeable lithium battery for about 90 minutes using time outdoors.\r\nHigh sensitivity tuner, enhanced signal reception capability.', '1752203220_qr.svg', 5, 5, '1752203220.jpg', '2025-07-11 03:07:00', '2025-07-11 03:07:00'),
(204, '8804ee9d-af8b-4907-9d2e-06f64fc0ff70', 'WPTN785LRVKI', 'Switcher', '00399836', 'Datavideo', 15, 'tersedia', '6-Input HDMI/HD-SDI Video Switcher\r\n1080i and 720p Input-Compatible\r\nMulti-View HDMI Output\r\nChroma & Luma-Key Functions\r\nLED-Lit Hard Keys and T-Bar Lever\r\nUser-Assignable Keys\r\nCross-Point Assignment', '1752203544_qr.svg', 5, 5, '1752203544.jpg', '2025-07-11 03:12:24', '2025-07-11 03:12:24'),
(205, '9f68e338-3aba-429f-92d3-e334562f789d', 'ZJFLTP5E1UXW', 'Digital Video Switcher', '00431140', 'Datavideo', 15, 'tersedia', '6-Input HDMI/HD-SDI Video Switcher\r\n1080i and 720p Input-Compatible\r\nMulti-View HDMI Output\r\nChroma & Luma-Key Functions\r\nLED-Lit Hard Keys and T-Bar Lever\r\nUser-Assignable Keys\r\nCross-Point Assignment', '1752203901_qr.svg', 5, 5, '1752203901.jpg', '2025-07-11 03:18:22', '2025-07-11 03:18:22'),
(206, '5d176e1c-713b-462f-b032-ebae72dc42e4', 'OINF1A4MBEJ7', 'Router Switch', 'G1Q70RQ005134', 'RUIJIE', 8, 'tersedia', 'The Ruijie RG-ES108GD is an efficient 8-port gigabit unmanaged metal switch designed for seamless network connectivity.\r\n\r\nIdeal for home or small office environments, it supports high-speed data transfer with a maximum port forwarding rate of 1000Mbps.\r\n\r\nWith its compact design and low power consumption, this switch is both space-saving and energy-efficient.\r\n\r\nThe robust build ensures durability, while the easy plug-and-play setup makes it user-friendly for all skill levels.\r\n\r\nExperience reliable performance with 8K MAC address support and a backplane bandwidth of 16Gbps, perfect for enhancing your network infrastructure.', '1752455861_qr.svg', 5, 5, '1752455861.jpg', '2025-07-14 01:17:46', '2025-07-14 01:17:46'),
(207, '626aa8db-97ae-4087-9e7a-7d7c87759c39', 'C3BL5AQTVIEM', 'HARDISK', '-', 'DATA VIDEO', 10, 'tersedia', 'ATA-HE3 | DATAVIDEO HE-3 Additional Spare (Empty) Removable Hard Drive Enclosure for HDR60 / HDR70,', '1752456269_qr.svg', 5, 5, '1752456269.jpg', '2025-07-14 01:24:29', '2025-07-14 01:24:29'),
(208, '185b2127-87da-4c1b-ba2f-63b7836e090d', 'EUY9IR71DWO5', 'Desktop Switch', '223C8X4002273', 'TP-LINK', 8, 'tersedia', '8 Gigabit Auto-Negotiation RJ45 ports, Supports Auto MDI / MDIX\r\nGreen Ethernet technology saves power consumption\r\nIEEE 802.3x flow control provides reliable data transfer\r\nPlastic case, desktop or wall-mounting design\r\nPlug and play, no configuration require', '1752456445_qr.svg', 5, 5, '1752456445.jpg', '2025-07-14 01:27:25', '2025-07-14 01:27:25'),
(209, '45f3a9b1-cfa9-49fa-bfa2-6566ac9af807', '63ICDSAVFGEU', 'OPTICAL POWER METER(normal)', '-', 'MERK AMG', 8, 'tersedia', 'Jenis pengukur daya optik jenis kalibrasi semacam ini adalah untuk instalasi genggam, operasi dan pemeliharaan desain jaringan serat optik khusus dari instrumen uji portabel yang tepat, tahan lama, dan nyaman. \r\n\r\nDengan tampilan pintar, dapat memilih untuk beralih kembali tampilan lampu, fungsi shutdown otomatis, rentang uji daya optik super lebar, akurasi pengujian akurat dan fungsi auto-kalibrasi pengguna baru dan desain antarmuka umum\r\n\r\nDeskripsi Fiber optic Optical Power Meter Cable Tester ( OPM )', '1752456909_qr.svg', 5, 5, '1752456909.jpg', '2025-07-14 01:35:09', '2025-07-14 01:35:09'),
(210, '95571fc4-1b46-4a85-870a-ef525c82da02', 'BI7LYSWQFGEM', 'OPM Optical Power Meter Fiber Optic', '-', 'AUA-9', 1, 'tersedia', 'AUA-9 OPM Optical Power Meter Fiber Optic Tool -70dBm~+10dBm', '1752457121_qr.svg', 5, 5, '1752457121.jpg', '2025-07-14 01:38:41', '2025-07-14 01:38:41'),
(211, '493b2d19-6e9b-4c05-9a09-db1bb7073a13', 'D2CYX0KQ6EW4', 'Datavideo DAC-70 VGA / HDMI / 3G/HD/SD Cross-Converter', '00700143', 'data video', 8, 'tersedia', 'The Datavideo DAC-70 is an up/down cross-converter that converts between SD, HD, and 3G formats. It accepts VGA, SDI, and HDMI video inputs. It automatically converts to the selected output format, even when the video input changes. The DAC-70 is compatible with 3GB/s SDI, and the converter includes a built-in mini-USB connection for updating to support future video formats.', '1752457376_qr.svg', 5, 5, '1753840651.jpg', '2025-07-14 01:42:56', '2025-07-30 01:57:31'),
(213, '084f46fd-ad3c-4147-b1a3-3c8e0812b355', '4GZT7195MHUJ', 'RG-RAP2200(E) Reyee Wi-Fi 5 1267Mbps Ceiling Access Point', 'G1RP7SG012045', 'Ruijie', 8, 'tersedia', 'Dual-radio performance, up to 1.267Gbps.\r\nGet better performance with 802.11ac wave 2’s MU-MIMO technology.\r\nSupport to optimize the entire wireless network with just one click.\r\nEasily set up your Wi-Fi network with Ruijie Cloud APP in 3 minutes.\r\nWith Ruijie Cloud, easy to maintain your networks remotely.', '1752539008_qr.svg', 5, 5, '1753840615.jpg', '2025-07-15 00:23:32', '2025-07-30 01:56:55'),
(214, 'b205e58a-10b5-496d-b169-76038941801c', 'K7UCB9QPIW0S', 'Kramer VM-50AN: 1: 5 Bal/UnBalanced St-Audio Distribution Amplifier', '07151226200014', 'Kramer', 8, 'tersedia', '- B or U Stereo Input 10 Simultaneous Outputs S/N — 84dB L & R Level Controls Rack Kit — RK–1 - Size — Desktop — Mount 2 units side–by–side in a 1U rack space with the optional RK–1 adapter. - Audio — B/U', '1752539193_qr.svg', 5, 5, '1753839832.jpg', '2025-07-15 00:26:33', '2025-07-30 01:43:52'),
(215, 'f065bb34-38a5-4f3a-9252-1eef4f7609a7', '4GVQ2KWJTC7E', 'MIC MEJA /PODIUM WIRELESS MONITOR AUDIO MA-200 QUE4 CONFERENCE MIC', '-', 'MONITOR AUDIO', 6, 'tersedia', '- Frequency range: 610-810MHz\r\n- Channels: 2 (fixed frequency)\r\n- Response: 50Hz-18KHz\r\n- RF Production: High performance integrated IC\r\n- RF Bandwidth: 50MHz\r\n- Signal to noise ratio: >105dB (a weighted peak)\r\n- Dynamic range: >100dB\r\n- Distortion: - Working Range: 50 meter', '1752539443_qr.svg', 5, 5, '1752539443.jpg', '2025-07-15 00:30:43', '2025-07-15 00:30:43'),
(216, '91819277-f38e-47bc-b32a-2e4107a2e5d1', '0IFMYSQBU4JZ', 'Keyboard Wireless Logitech K220', '2448LOA2GSD8', 'Logitech', 8, 'tersedia', 'Keyboard\r\nNumber pad 10 tombol\r\nKontrol Musik\r\nMaksimal 5 juta keystroke (tidak termasuk tombol number lock)\r\nJenis tombol: Tombol deep-profile\r\nTahan tumpahan ?\r\n2 baterai AAA (Baterai Alkaline）', '1752539789_qr.svg', 5, 5, '1753839784.jpg', '2025-07-15 00:36:29', '2025-07-30 01:43:04'),
(217, '29b7e988-c225-4734-9330-e5d3036133ea', 'SQ3T7D68OPR4', 'Goot Solder Tembak TQ-77', '610220133-A', 'Goot', 8, 'tersedia', 'Goot TQ-77 merupakan solder tembak dengan two stage heat switch system yang dapat menyorder pada suhu rendah 20 w dan tinggi 200 w , dilengkapi dengan powerlamp yang memudahkan anda mengecek panas dan nyala solder. Ujung solder ini menggunakan keramik sehingga membuat nyaman ketika menyolder dan tidak menempel.', '1752540084_qr.svg', 5, 5, '1753839757.jpg', '2025-07-15 00:41:24', '2025-07-30 01:42:37'),
(218, '70e47e64-f539-49e4-bfff-9187f6eb56c6', '7E9OFG5DQZVS', 'APC STOP KONTAK COLOKAN LISTRIK ANTI PETIR SURGE PROTECTOR', '-', 'APC', 8, 'tersedia', 'PC PM6U-GR part of SurgeArrest Essential Family. Memiliki 6 (enam) stop kontak yang terlindungi dari lonjakan arus dengan rating 1836 Joule. \r\n\r\n\r\nPM6U-GR juga memiliki 2 port USB untuk mengisi daya perangkat seluler Anda secara bersamaan. Ini juga memiliki fitur penyaringan EMI dan RFI, melindungi dari data error dan kerusakan pada keyboard karena gangguan listrik. \r\n\r\n\r\nSeri APC SurgeArrest Essential memberikan perlindungan tingkat utama terhadap lonjakan arus yang harus ada di komputer dan perangkat elektronik rumah tangga mana pun.', '1752540272_qr.svg', 5, 5, '1752540272.png', '2025-07-15 00:44:32', '2025-07-15 00:44:32'),
(219, '0c8cf021-3fa1-4ea7-908b-ff1f1ec0c307', 'K2PXFVREUJ8S', 'HT FIRSTCOM FC-04G 1', '-', 'FIRSTCOM', 9, 'tersedia', 'Frekuensi: VHF ( 136-174 MHz) & UHF ( 400-470 MHz) + Radio Channel Out Power: 5 Watt Spesifikasi UMUM Range Frekuensi VHF: 135 - 174MHz Kapasitas Channel 128 Channel Spacing 2, 5 KHz Tegangan operasi 7, 4 V Baterai 1500mAh ( Li-ion) Battery Life ( 5-5-90 Tugas Siklus) 1200mAh Li-ion Battery Sekitar 10 jam Frekuensi Stabillity ± 2.5ppm Suhu Operasi -20 C ~ + 50 C Dimensi ( LebarxTinggixKedalaman) ( dengan baterai, tanpa antena) 129mmx58.5mmx36.5mm Berat ( dengan antena & baterai) 260g Pemancar 5W RF Output Power / 1.5W ( VHF) Modulation F3E Palsu dan harmonisa d-21dBm Noise FM e40dB Audio Distirtion d 3% Penerima Sensitivitas d-120dBm Selektivitas e 65dBm Intermodulation e 60dBm Memblokir atau desensitisasi e 85dBm S 40dBm N e / Rated Power Audio Output 500mW Rated Audio Distortion e 5%', '1752540624_qr.svg', 5, 5, '1753839663.jpg', '2025-07-15 00:50:24', '2025-07-30 01:41:03'),
(220, '38115a3d-a60b-4ec2-b1ed-bd1c74cfa071', 'NEUH3P9Q5AM6', 'HT FIRSTCOM FC-04G 2', '-', 'FIRSTCOM', 9, 'tersedia', 'Frekuensi: VHF ( 136-174 MHz) & UHF ( 400-470 MHz) + Radio Channel Out Power: 5 Watt Spesifikasi UMUM Range Frekuensi VHF: 135 - 174MHz Kapasitas Channel 128 Channel Spacing 2, 5 KHz Tegangan operasi 7, 4 V Baterai 1500mAh ( Li-ion) Battery Life ( 5-5-90 Tugas Siklus) 1200mAh Li-ion Battery Sekitar 10 jam Frekuensi Stabillity ± 2.5ppm Suhu Operasi -20 C ~ + 50 C Dimensi ( LebarxTinggixKedalaman) ( dengan baterai, tanpa antena) 129mmx58.5mmx36.5mm Berat ( dengan antena & baterai) 260g Pemancar 5W RF Output Power / 1.5W ( VHF) Modulation F3E Palsu dan harmonisa d-21dBm Noise FM e40dB Audio Distirtion d 3% Penerima Sensitivitas d-120dBm Selektivitas e 65dBm Intermodulation e 60dBm Memblokir atau desensitisasi e 85dBm S 40dBm N e / Rated Power Audio Output 500mW Rated Audio Distortion e 5%', '1752540660_qr.svg', 5, 5, '1753839654.jpg', '2025-07-15 00:51:00', '2025-07-30 01:40:55'),
(221, '89e6d3a7-3f2a-4635-b487-ef30de5e9825', 'LTEW61S543FY', 'Hi Rice HR-5100A Professional Video Light', '-', 'HI RICE', 12, 'tersedia', '-LED : 6 PCS\r\n\r\n-Power : 18W\r\n\r\n-Import Volt : 6V – 16.8V\r\n\r\n-Illumination : 1395 LUX       \r\n\r\n-Color temperature 3000 / 6000k\r\n\r\n-Brigthness Control : Adjustable\r\n\r\n-Illumination : 600\r\n\r\n-Fit Battery : NP-F970 / F770 / F570', '1752541077_qr.svg', 5, 5, '1752541077.jpeg', '2025-07-15 00:57:57', '2025-07-15 00:57:57'),
(222, '4a9ef47f-e301-462a-8576-d61192304a63', 'N6SH1OFT0Q7G', 'EMT vintage polarity tester set 160-2', '46174', 'EMT', 8, 'tersedia', 'Vintage system to check the polarity (absolut phase) of microphones and speakers. Includes units EMT 160-2 and 160-1 with original case. Tested and working. Operates with 9V and 2 x 4,5V batteries, 9V battery is included. Sold as is with no warranty.', '1752712953_qr.svg', 5, 5, '1752712954.jpg', '2025-07-17 00:42:38', '2025-07-17 00:42:38'),
(223, '93b7c989-b007-4a79-b653-d9fbf9ce3783', 'AWX0UN3JC6BP', 'zhiyua crane 3 lab', '-', 'zhiyua', 8, 'tersedia', 'Zhiyun-Tech CRANE 3 LAB menggunakan desain gimbal ke arah yang berbeda dengan tambahan pegangan di bagian atas. Dengan tripod mini yang disertakan terpasang di bagian bawah dan pegangan ergonomis yang tetap di atas, CRANE 3 LAB dapat digunakan dua tangan untuk stabilitas optimal. Selain itu, pegangannya memungkinkan Anda untuk beralih secara mulus ke mode underslung, baik dengan satu atau dua tangan, dan menghasilkan bidikan kreatif seperti bidikan berputar 360 ° saat Anda bergerak lebih dekat ke arah subjek. Selain desain inovatif ini, CRANE 3 LAB juga mengemas fitur-fitur canggih lainnya, seperti transmisi video nirkabel, dan memberikan kemampuan untuk menstabilkan beban hingga 10 lb.\r\n\r\nCRANE 3 LAB mendukung dua servos opsional pada saat yang sama untuk kontrol fokus dan zoom langsung dari handwheel di samping. Pada saat yang sama, semua kontrol lain yang Anda butuhkan tersedia di ujung jari Anda di bagian atas pegangan bersama dengan layar status OLED. Selain itu, aplikasi ZY PLAY iOS / Android yang disertakan (unduh gratis) menyediakan banyak fungsi kontrol yang sama serta fitur khusus seperti panorama, selang waktu fokus, selang waktu gerakan, selang waktu eksposur panjang, pengaturan kamera, dan lebih.\r\n\r\nTransmisi nirkabel dicapai melalui koneksi Wi-Fi ke ponsel atau tablet iOS / Android. CRANE 3 LAB secara nirkabel mentransmisikan rekaman video Anda dari kamera ke perangkat seluler Anda secara real time dalam resolusi 1080p. Fitur ini kompatibel dengan kamera tertentu; silakan lihat situs web Zhiyun-Tech untuk daftar kompatibilitas kamera lengkap.\r\n\r\nSeri LAB Zhiyun dirilis bersama ekosistem opsional, aksesori TransMount khusus. Salah satunya adalah TransMount Phone Holder, yang memungkinkan Anda memasang ponsel di sisi gimbal untuk memantau bidikan Anda melalui aplikasi ZY PLAY. Aksesori lainnya termasuk sabuk kamera dan monopoda khusus yang bekerja sama dengan sabuk.\r\n\r\nFitur utama lain dari gimbal adalah sistem kunci kait sumbu yang terdiri dari kunci kait terpisah pada setiap sumbu. Fitur ini memungkinkan Anda untuk mengunci sumbu individu untuk mengingat posisi keseimbangan Anda saat mematikan gimbal. Dengan cara ini Anda tidak perlu menyeimbangkan kembali setiap saat.', '1752713206_qr.svg', 5, 5, '1753839575.jpeg', '2025-07-17 00:46:46', '2025-07-30 01:39:35'),
(224, '523ce21a-c54a-48dd-9a8f-28e19d7742d6', 'P92QVRUTIJBF', 'powerbank smartcoby', '-', 'smartcoby', 4, 'tersedia', 'Equipped with 3 ports that are convenient for users with multiple devices. High power up to 65W via USB-C single port PD rapid charging. Charge your MacBook Pro 13\" or any laptop on the go\r\nEquipped with excellent simultaneous charging capabilities, the total output can be up to 95 W and can be used in any combination of laptops, tablets, and smartphones\r\nCan be fully charged in about 1.6 hours. The input on the main unit is also compatible with 65 W, so it can be stored in a minimum of about 1 hour and 40 minutes despite the large capacity of 20,000 mAh. The storage time may vary depending on the environment\r\nFeatures a playful dot LED display function for everyday use and a dot type numerical status display that is easy to understand and easy to understand\r\nSupports rapid pass-through charging; charges both devices and batteries, allowing you to quickly charge your devices via the battery. Great for environments with only one outlet or when you want to charge both. Rapid pass-through is possible when using a charger or charging cable that supports rapid charging\r\nFast charge all devices Supports PD fast charge 65W output. It can charge a variety of devices, from laptops to tablets to smartphones and more. A cable that supports high power charging is required. ※There are cases where charging cannot be performed depending on the device\r\nCables are not included with this product. A separate Type-C cable must be provided in order to store this produc', '1752713437_qr.svg', 5, 5, '1752713437.jpg', '2025-07-17 00:50:37', '2025-07-17 00:50:37'),
(225, '723e61ae-233b-4f31-87dd-31fe54d028b0', 'QFLRHW6JMVE9', 'Audio Balance to Unbalance and Unbalance to Balance converter', '-', 'LA-20T', 8, 'tersedia', 'Audio Balance to Unbalance and Unbalance to Balance converter LA-20', '1752713642_qr.svg', 5, 5, '1752713642.jpg', '2025-07-17 00:54:02', '2025-07-17 00:54:02'),
(226, 'de76482d-1b54-424d-ab01-f9b25aab6fb4', '9QOML5GFA8UV', 'Camlight', '-', 'Camlight Pl-2500', 12, 'tersedia', 'lampu', '1752713830_qr.svg', 5, 5, '1752713830.jpg', '2025-07-17 00:57:10', '2025-07-17 00:57:10'),
(227, '4012a2ae-0172-4422-9008-935b27ed00f4', 'V3R14YZQTMFU', 'NETWORK CABLE TESTER TRACKER LAN OPTICAL POWER METER', '-', 'Noyava', 8, 'tersedia', 'alat penguji kabel jaringan LAN yang juga berfungsi sebagai penguji serat optik (fiber optic). Alat ini memiliki fitur lengkap seperti pengukur daya optik (OPM), Visual Fault Locator (VFL), penguji POE, dan pelacak kabel (wire tracker). Selain itu, NF-8508 juga dapat melakukan pelacakan kabel, pengujian panjang kabel, dan pengujian map kabel (wiremap)', '1752714033_qr.svg', 5, 5, '1753839414.jpg', '2025-07-17 01:00:33', '2025-07-30 01:36:54'),
(228, '83a48cec-0b18-4eff-9ba4-a6e9b96d3fda', 'V9ET0S3HF4J2', 'TC 1280 STEREO DIGITAL AUDIO DELAY', '-', 'TC Electronic TC 1280', 8, 'tersedia', 'No degradation of signal quality .The TC digital converter technology has been acclaimed as being \"very musical and warm\".\r\nSoft HF roll off: -3dB @ 25 kHz and -12 dB @ 33 kHz allows ALL the signal to pass thru the device.\r\nDynamic range > 100 dB is excellent for live sound performances.\r\nAbsolute stereo phase linearity within 2 microseconds.\r\nDelay time increments adjustable down to 5 microseconds for exact adjustments needed when aligning speaker driver components.\r\nExpandable memory up to 2 x 10 seconds.\r\nFront panel controls are lockable for permanent installation.\r\nRemote control possible via MIDI or dedicated switches. (TC0050 footswitch allows access to presets).\r\nDelay times may be displayed and adjusted in time, or distance (meters or feet), or video frames (25half or full frame, and 30half or full frame).\r\nAutomatic relay bypass of audio should there be a loss of power.\r\nNon-volatile memory of delay time settings in 4 presets.', '1752714208_qr.svg', 5, 5, '1753839372.jpg', '2025-07-17 01:03:28', '2025-07-30 01:36:12'),
(229, '9d9a1baa-79a6-48f3-a4ec-0500b9ca0699', 'XNHSWY2UBEZ5', 'Headset', '-', 'beringer', 8, 'tersedia', 'High-Performance Studio Headphones Ultra-wide frequency response High-definition bass and super-transparent highs Ultra-wide dynamic range High-efficiency cobalt capsule Single-sided cord with oxygen-free copper wires Optimized oval-shaped ear cups Ultra-rugged headband construction Technical data Capsule diameter: 40 mm Frequency response: 20 Hz - 20 kHz Max. power handling: 100 mW Impedance: 64 Ohm Sensitivity: 110 dB @ 1 kHz Cord length: 2.0 m Connector: TRS stereo jac', '1752714600_qr.svg', 5, 5, '1752714600.jpg', '2025-07-17 01:10:00', '2025-07-17 01:32:31'),
(230, 'd026a3d4-8b32-4e91-8e1c-e8eda547ff3b', 'C4HR29LM6FDY', 'DJI RS 3 PRO GIMBAL STABILIZER', '-', 'DJI PRO', 8, 'tersedia', 'DJI RS 3 telah didesain ulang agar lebih ringan dan lebih ramping daripada gimbal Ronin RSC 2 dengan berat hanya 2,8 lb dengan muatan hingga 3kg. Gimbal mungil ini cukup tangguh untuk mendukung dan menstabilkan Sony a7S III atau Canon R5 dengan lensa zoom 24-70mm yang terpasang. Dengan layar OLED penuh warna yang lebih besar, kenop penyetelan baru, dan stabilitas yang lebih baik, RS 3 dapat menjadi bagian penting dari kit kamera saku Anda.\r\n\r\nFitur Utama :\r\nDengan ketahanan Payload hingga 3 kg\r\nLayar sentuh 1,8 Inch OLED full color\r\nAlgoritma Stabilisasi Generasi ke-3\r\nTransmisi video hingga jarak 200m\r\nPenggunaan hingga 12 jam', '1752715132_qr.svg', 5, 5, '1753839316.jpg', '2025-07-17 01:18:52', '2025-07-30 01:35:16'),
(231, '6f8bc6e1-57ff-4d0d-827b-41a401b339d0', 'JH71UWO3ZDTF', 'Behringer HPX2000 High-Definition DJ Headphones', '-', 'Behringer', 8, 'tersedia', 'High-definition bass and super-transparent highs\r\nUltra-high dynamic range\r\nHigh-efficiency cobalt capsule\r\n1/8\" connector plus 1/4\" adapter included\r\nSingle-sided cord with oxygen-free copper wires\r\nRotating, reversible round-shaped ear cups\r\nUltra-rugged headband construction\r\nDesigned and engineered in Germany', '1752716064_qr.svg', 5, 5, '1753839282.jpg', '2025-07-17 01:34:24', '2025-07-30 01:34:42'),
(232, '8ad8d084-f3c9-47df-ae0a-3337870f124c', 'N2FYS6WQK3JO', 'Logitech USB Powered Speaker Z120', '-', 'Logitech', 8, 'tersedia', 'Speaker stereo yang ditenagai USB\r\nSpeaker ringkas ini ditenagai oleh USB dan pemasangannya pun sederhana, sehingga mudah untuk dibawa dari satu ruangan ke ruangan lainnya.\r\nFitur :\r\n1. Ditenagai USB\r\nHubungkan ke port USB untuk mendapatkan daya dan input 3,5 mm untuk audio. Speaker yang berdesain ringkas ini mudah dipasang dan dapat dibawa ke mana pun.\r\n2. Manajemen Kabel\r\nSesuaikan panjang kabel dengan menggunakan solusi manajemen kabel di bagian belakang speaker.\r\n3. Kontrol yang mudah\r\nMudah mengakses daya dan volume dari sebuah kenop di speaker kanan.', '1752716341_qr.svg', 5, 5, '1753839217.jpg', '2025-07-17 01:39:01', '2025-07-30 01:33:37'),
(233, '4b69d5ad-e383-4d26-a916-76dd537a9ab7', 'VOKC5R4IZ8FH', 'EIKON EK5NF NEAR-FIELD STUDIO MONITOR SPEAKER', '-', 'EIKON', 8, 'tersedia', 'EK NF is the ideal nearfield monitor solution for any kind of music production applications. From the carefully selected transducers to the proprietary enhanced waveguides and to the low resonance cabinet design, everything has been tailored to offer the best accuracy over the whole audio spectrum. The perfectly optimized electronics, including highheadroom separate Class AB amplifiers for high and low section, high precision crossover networks and separate LIMITER circuits, provide maximum resolution and minimum listening fatigue.\r\n\r\n- 0.75 “soft-dome tweeter for detailed response and a high-resolution sound\r\n- Proprietary integrated elliptical waveguide with accurate directivity control\r\n- Long-excursion 5.25” woofer with lightweight fiber-glass composite cone\r\n- Precisely calculated front tuning port for greater low-frequency extension\r\n- Multiple audio input connectors for connecting any kind of source\r\n- HF adjustment for a flexible control of high frequency\r\n- Sophisticated, carefully designed crossover filters an improved resolution\r\n- High-headroom Class AB 25+45W amplifiers with dual accurate CLIP LIMITER', '1752716518_qr.svg', 5, 5, '1753839170.jpg', '2025-07-17 01:41:59', '2025-07-30 01:32:50'),
(234, 'd37a58a1-bda0-4780-8a86-70b44ebe17d9', 'VZYMU6OJ3WSG', 'Sony GV-HD700E HD Video Walkman', '-', 'Sony', 8, 'tersedia', 'High quality 7-inch (16:9) widescreen LCD with a hi-end resolution of 1,157K. i.LINK and HDMI out. Supports both HDV and MiniDV tapes and can also be used as a back-up deck for professional videographers as it can also record HDV1080i/DV signals that are shot to it from an external source.\r\n\r\n7 inch LCD HDV(tm) Video Walkman(R) VCR\r\nExperience high-definition video to go. The HDV(tm) Video Walkman(R) VCR features a high-resolution 7\" LCD for viewing and editing your footage.\r\n- High Definition / Standard Definition Capable\r\n- 7.0\" Wide (16:9) LCD Display (1152K Pixels)\r\n- x.v.Color(tm) Technology\r\n- LCD Profile Control\r\n- L and M Series InfoLITHIUM(R) Battery Compatibility\r\n- Assignable Buttons', '1752716772_qr.svg', 5, 5, '1753838973.jpg', '2025-07-17 01:46:12', '2025-07-30 01:29:33'),
(235, 'a95ad1e9-ddb3-4094-9767-49a668fd45ea', '84B32SEXTKUP', 'SHURE MX412D/C GOOSENECK MIC', '-', 'SHURE', 6, 'tersedia', 'The MX412 and MX418 Microflex gooseneck microphones provide the added length and flexibility needed for speakers in environments like lecterns, pulpits, and courtrooms. Available in four models with a variety of heights and mounting styles to choose from, Microflex Gooseneck microphones feature high sensitivity and balanced, transformerless output for maximum resistance to electromagnetic hum and RF interference, even over long cable runs. Interchangeable Cartridge Designed for easy replacement and available in cardioid, supercardioid and omnidirectional polar patterns, the interchangeable cartridges offer wide frequency response and accurate sound reproduction for a broad variety of applications, such as houses of worship, courtrooms and conference centres. Plus, the condenser cartridges fit every model in the Microflex product line for enhanced convenience and consistent sound. Available Options Microflex Gooseneck microphones are available in four models with a variety of heights and mounting styles to choose from. One model includes a silent mute switch with LED indicator, a Shure Microflex exclusive. And every Microflex Gooseneck features high sensitivity and balanced, transformerless output for maximum immunity to electromagnetic hum and RF interference, even over long cable runs. Each Microflex Gooseneck microphone comes with a complete installation kit, including locking metal and foam ball windscreens, snap-in, and shock-mount microphone stand adapters. Models MX412/ C (Cardioid), MX412/ S (Supercardioid), MX412/ N (No Cartridge): 12-inch Gooseneck Condenser Microphone, Attached XLR Preamp, Shock Mount, Flange Mount, Snap-Fit Foam Windscreen. * (Optional Desktop Base with 10 foot Cable: A412B) MX418/ C ( Cardioid) , MX418/ S (Supercardioid), MX418/ N (No Cartridge): 18-inch', '1752718237_qr.svg', 5, 5, '1753838929.jpeg', '2025-07-17 02:10:37', '2025-07-30 01:28:49'),
(236, '819e8078-6cfa-4677-8329-f5afd408d558', 'X8FJUQB0SW74', 'Speaker Management Driverack DBX PA2', '12001525894', 'dbx Pro', 8, 'tersedia', 'DriveRack PA2\r\n\r\nComplete Loudspeaker Management System\r\n\r\n\r\n\r\nALL YOU NEED TO GET THE MOST FROM YOUR PA. NOW WITH COMPLETE CONTROL FROM YOUR MOBILE DEVICE.\r\n\r\nThe DriveRack® PA2 provides all the processing you need between your mixer and amplifiers to optimize and protect your loudspeakers. With the latest advancements in dbx’s proprietary AutoEQ™ and AFS™ algorithms, a new input delay module for delaying the FOH system to the backline, Ethernet control via an Android®, iOS®, Mac®, or Windows® device, and updated Wizards, the DriveRack PA2 continues the DriveRack legacy of great-sounding, powerful, and affordable loudspeaker management processors, for a whole new generation.\r\n\r\n\r\n\r\nAUTOEQ™\r\n\r\nNew, improved AutoEQ algorithm ensures an extremely accurate, fast, and non-intrusive automatic EQ experience.\r\n\r\n\r\n\r\nWith the RTA Mic “listening” to your room, the new, updated DriveRack PA2 AutoEQ algorithm sets speaker levels and room EQ automatically in a matter of seconds. This means room adjustments can now be made very quickly, without subjecting the audience to annoying, lengthy broadcasts of pink noise.\r\n\r\n\r\n\r\nENHANCED AFS™ FEEDBACK ELIMINATION\r\n\r\nEnhanced AFS™ algorithm for faster, more precise feedback elimination, without adversely affecting your system’s tone.\r\n\r\n\r\n\r\nNothing turns audiences away like annoying and potentially painful audio feedback. Fortunately, dbx engineers have revisited their already-stellar Advanced Feedback Suppression algorithm and made it work even better. The DriveRack PA2 listens for and anticipates feedback and adjusts speaker output automatically before it even has a chance, while never altering your sound.\r\n\r\n\r\n\r\nUPDATED WIZARD SETUP FUNCTIONS\r\n\r\nUpdated Wizards make initial set up easy, while ensuring speaker tunings and other settings are up-to-date.\r\n\r\n\r\n\r\nWizard functions on the DriveRack PA2 guide you through easy, step-by-step processes to help you get the most from your loudspeaker system. Helps you easily configure level balancing, AutoEQ, Advanced Feedback Suppression, and provides access to built-in and constantly updating speaker tunings from most major speaker manufacturers.\r\n\r\n\r\n\r\nAVAILABLE INPUT PROCESSING\r\n\r\ndbx Compression\r\n\r\nAFS™ (Advanced Feedback Suppression)\r\n\r\nGraphic EQ\r\n\r\n8-Band Parametric EQ (adjusted when using the AutoEQ)\r\n\r\nSubharmonic Synthesis\r\n\r\nAVAILABLE OUTPUT PROCESSING\r\n\r\nCrossover (supports full range, 2-way, and 3-way systems)\r\n\r\n8-Band Parametric EQs (used for speaker tunings)\r\n\r\ndbx Limiting\r\n\r\nDriver Alignment Delays\r\n\r\nRecommended for: Installed, Portable, Tour.', '1752718481_qr.svg', 5, 5, '1752718481.png', '2025-07-17 02:14:41', '2025-07-17 02:14:41'),
(237, 'bbca500f-e103-4f82-92c6-b5defcd01f7b', '7GSQYNJMW8VC', 'HT PoC talkcom TC-389S 1', 'TC398S00415', 'talkcom', 9, 'tersedia', 'Brand: TALKCOM\r\n\r\nType: TC389S\r\n\r\n\r\n\r\nFitur:\r\n\r\n- 4G LTE\r\n\r\n- panggilan group\r\n\r\n- interkom nasional\r\n\r\n- pengisian daya usb\r\n\r\n- peralihan netcom penuh', '1752718792_qr.svg', 5, 5, '1752718792.png', '2025-07-17 02:19:52', '2025-07-17 02:19:52'),
(238, 'de552d02-4ed8-46da-ac0d-198b35e266c6', '9CGSLFPQI2B4', 'HT PoC talkcom TC-389S 2', 'TC398S00376', 'talkcom', 9, 'tersedia', 'Brand: TALKCOM\r\n\r\nType: TC389S\r\n\r\n\r\n\r\nFitur:\r\n\r\n- 4G LTE\r\n\r\n- panggilan group\r\n\r\n- interkom nasional\r\n\r\n- pengisian daya usb\r\n\r\n- peralihan netcom penuh', '1752718862_qr.svg', 5, 5, '1752718862.png', '2025-07-17 02:21:02', '2025-07-17 02:21:02'),
(239, '050a9c72-e932-458e-bf92-b5ab03ce837d', '1GYC56P9ZOUV', 'SOLDER heißluftgebläse typ hot jet s', '-', 'heißluftgebläse', 8, 'tersedia', '-', '1752719482_qr.svg', 5, 5, '1753838631.jpg', '2025-07-17 02:31:22', '2025-07-30 01:23:51'),
(240, '4d0feb54-546a-48a2-aefa-ebb3d660fa03', '3FXKETJHY7DP', '4 pack Hollyland Technology Wireless Intercom System (SOLIDCOM)', '022231R 30049BC', 'Hollyland Technology', 9, 'tersedia', 'For Small- to Mid-Sized Events\r\n4 x Beltpacks & LEMO Headsets\r\n1.9 GHz Full-Duplex Transmission\r\nUp to 1312\' Wireless Range\r\n4-Channel Communication\r\nSidetone Function\r\nCascade Base Station Connection\r\nRemovable Lithium-Ion Batteries\r\nApp & Website-Based Configuration\r\nBeltpack Charging Station Included', '1752720122_qr.svg', 5, 5, '1753837938.jpg', '2025-07-17 02:42:02', '2025-07-30 01:12:18'),
(241, 'd6cfff63-51c5-43af-9bc2-c1bb90626731', 'YJAOZQ4U6LFG', '4 pack Wireless Transmission Intercom System', '861929638B', 'MOMA', 9, 'tersedia', '*【1000ft Full-duplex Communication System】MarsT1000 wireless range up to 1000ft LOS, Up to 5 people talk wirelessly. 2 sets of Mars T1000 can support 10 people simultaneously. Compatible connection with other intercom systems, Tally and Switcher. Such as Blackmagic, Sony, Datavideo, Clearcom etc.\r\n\r\n*【Key Features & Great Performances】Mars T1000 is working 1.9GHz frequency to best avoid the interference. Designed with OLED to remind you and to avoid loss signals with your team and Mute/Talk to experiences the real-time communication depends on circumstances. 3.5mm Hollyland professional wireless headsets best help to reduce the noise and compatible with other types of earphone or headset according to your preference.\r\n\r\n*【Long Power Supply & Multiple Charging Modes】1 Base station power up 20HRS and each belt-pack built in lithium batteries power up to 8HRS+. Base station powers by 2 portable L-series batteries without power cutting or direct charge by wall plug .The 4 belt-packs power by Type-C cables, the USB end connect to adapters or direct connect to the 4* USB ports of the base station.\r\n\r\n*【Complete Accessories & User-Friendly】Mars T1000 includes 1x Base station, 4x Belt-packs, 5x Professional Dynamic Side-Ear Headset, 3x 1.9G High-Gain Base Station Antenna; 4x Type-C Cable; 1x 4-Pin XLR Adapter; 1x User Manual\r\n\r\n*【Wide-Range Application & 1 Year Warranty】Sport Events, Drone Crew, Event,Church, Broadcast /School Studio, Film Crew and Constructions and etc.We offer 1 Year warranty for all of our products and lifelong service for our customers. Any questions, please contact us freely, we will reply back within 24 hours.', '1752720738_qr.svg', 5, 5, '1753837871.jpg', '2025-07-17 02:52:20', '2025-07-30 01:11:11'),
(242, 'ef1dc72c-2f16-40cb-8ca4-1740a15ba302', '8DJKQEGPWS5Z', 'CAMCODER SONY PXW-X160', '1605364', 'SONY', 1, 'tersedia', '25X OPTICAL ZOOM', '1753241361_qr.svg', 5, 5, '1753836637.jpg', '2025-07-23 03:29:26', '2025-07-30 00:50:37'),
(243, '8c51fa93-142c-4cdf-87d6-5c67eb4021fc', '0HT7AO4ZKFYX', 'EARTEC HUB 6 PACK 1 BASE DESTINATION', '3064A-B4HHUB2015', 'EARTEC', 9, 'tersedia', 'HUB6D (HUB 6-Person Headset Intercom) dari Eartec menyediakan komunikasi wireless full duplex untuk staf produksi yang lebih besar yang perlu tetap melakukan komunikasi konstan saat bekerja dengan tangan mereka. HUB Mini Base ini beratnya hanya 255 gram, sehingga mudah untuk ditempatkan \"di lokasi\" atau dikenakan dengan sabuk. Saat dipasang dengan nyaman di pinggang user, repeater digital ini bergerak mulus bersama grup Anda sehingga kru dapat berbicara secara bersamaan dalam jarak hingga 300 meter (ruangan terbuka tanpa halangan).', '1753353175_qr.svg', 5, 5, '1753836582.jpg', '2025-07-24 10:32:59', '2025-07-30 00:49:42'),
(244, '7618fa29-b768-428c-a8e4-0cecda2f9e5d', '7SYQLUKB62DG', 'SONY XDCAM PXW-Z150', '7601575', 'SONY', 1, 'tersedia', 'Sony PXW-Z150 4K XDCAM Camcorder menghadirkan kinerja berkualitas tinggi, kemampuan beradaptasi, dan kemudahan penggunaan ke bodi genggam ringkas yang berukuran sama dengan HXR-NX100. Cocok untuk video perusahaan, rumah ibadah, dan rekaman deposisi hukum. Camcorder ini memiliki sensor Exmor RS tunggal dengan resolusi UHD 4K (3840 x 2160), lensa Sony G dengan rentang zoom optik 12x, dan Zoom Gambar Jernih 18 / 24x dalam 4K / HD. Ini dapat merekam 4K dalam XAVC Long pada 4: 2: 0 8-bit, dan HD dalam XAVC Long pada 4: 2: 2 10-bit pada 50 Mb / s, serta MPEG2HD pada 4: 2: 2 atau 4: 2: 0 hanya dalam 8-bit. Lensa zoom terintegrasi dilengkapi cincin kontrol lensa individual untuk fokus, iris, dan zoom, dan menghasilkan sorotan halus di luar fokus. Lensa dapat digunakan baik dalam mode otomatis penuh dengan kontrol servo atau sebagai lensa yang dioperasikan sepenuhnya secara manual.\r\n\r\nCamcorder mendukung penyimpanan hingga 6 profil gambar dan memungkinkan Anda berbagi profil; kamera juga mendukung Gerak Lambat dan Cepat Sony untuk merekam video HD pada kecepatan bingkai variabel, termasuk 120 fps. Merekam ke berbagai format, kecepatan bingkai, dan codec, camcorder ini mendukung perekaman 100 Mb / s XAVC Long GOP video 4K UHD hingga 29,97p, HD hingga 59,94p, MPEG HD hingga 59,94p, dan AVCHD 2.0 hingga 59.94p. Rekaman Anda direkam ke media melalui dua slot kartu memori SD. Anda dapat memilih untuk merekam secara bersamaan ke kedua kartu atau menggunakan mode relai yang mengalihkan perekaman secara otomatis ke kartu memori kedua ketika yang pertama penuh. Ini fitur built-in Wi-Fi dan konektivitas NFC. PXW-Z150 dilengkapi dua input audio XLR 3-pin yang mendukung line, mic, dan mic + 48V (phantom power) untuk menggunakan mikrofon eksternal; Anda juga dapat menggunakan mikrofon internal PXW-Z150 untuk merekam audio saat pengambilan gambar. Camcorder juga mencakup kemampuan Pemotretan Malam untuk memotret dalam kondisi pencahayaan yang sangat redup serta stempel tanggal / waktu, dan fungsionalitas kode waktu.', '1753355339_qr.svg', 5, 5, '1753836507.jpg', '2025-07-24 11:08:59', '2025-07-30 00:48:27'),
(245, 'faed332f-c2fe-4751-8b6b-771bd904e55f', 'Q6NPKC5YGTH1', 'SONY XDCAM PXW-Z150 (1)', '7601973', 'SONY', 1, 'tersedia', 'Sony PXW-Z150 4K XDCAM Camcorder menghadirkan kinerja berkualitas tinggi, kemampuan beradaptasi, dan kemudahan penggunaan ke bodi genggam ringkas yang berukuran sama dengan HXR-NX100. Cocok untuk video perusahaan, rumah ibadah, dan rekaman deposisi hukum. Camcorder ini memiliki sensor Exmor RS tunggal dengan resolusi UHD 4K (3840 x 2160), lensa Sony G dengan rentang zoom optik 12x, dan Zoom Gambar Jernih 18 / 24x dalam 4K / HD. Ini dapat merekam 4K dalam XAVC Long pada 4: 2: 0 8-bit, dan HD dalam XAVC Long pada 4: 2: 2 10-bit pada 50 Mb / s, serta MPEG2HD pada 4: 2: 2 atau 4: 2: 0 hanya dalam 8-bit. Lensa zoom terintegrasi dilengkapi cincin kontrol lensa individual untuk fokus, iris, dan zoom, dan menghasilkan sorotan halus di luar fokus. Lensa dapat digunakan baik dalam mode otomatis penuh dengan kontrol servo atau sebagai lensa yang dioperasikan sepenuhnya secara manual.', '1753355342_qr.svg', 5, 5, '1753836439.jpg', '2025-07-24 11:09:02', '2025-07-30 00:47:19'),
(246, '5d9c10ae-4ae2-406f-aeaa-4aad421d7ae0', '5KS3GQFPCML6', 'SONY XDCAM PXW-Z150 (2)', '7602050', 'SONY', 1, 'tersedia', 'Sony PXW-Z150 4K XDCAM Camcorder menghadirkan kinerja berkualitas tinggi, kemampuan beradaptasi, dan kemudahan penggunaan ke bodi genggam ringkas yang berukuran sama dengan HXR-NX100. Cocok untuk video perusahaan, rumah ibadah, dan rekaman deposisi hukum. Camcorder ini memiliki sensor Exmor RS tunggal dengan resolusi UHD 4K (3840 x 2160), lensa Sony G dengan rentang zoom optik 12x, dan Zoom Gambar Jernih 18 / 24x dalam 4K / HD. Ini dapat merekam 4K dalam XAVC Long pada 4: 2: 0 8-bit, dan HD dalam XAVC Long pada 4: 2: 2 10-bit pada 50 Mb / s, serta MPEG2HD pada 4: 2: 2 atau 4: 2: 0 hanya dalam 8-bit. Lensa zoom terintegrasi dilengkapi cincin kontrol lensa individual untuk fokus, iris, dan zoom, dan menghasilkan sorotan halus di luar fokus. Lensa dapat digunakan baik dalam mode otomatis penuh dengan kontrol servo atau sebagai lensa yang dioperasikan sepenuhnya secara manual.', '1753355344_qr.svg', 5, 5, '1753836450.jpg', '2025-07-24 11:09:04', '2025-07-30 00:47:30'),
(251, '7419151d-4c1e-4352-8780-51ab1590a1cd', '6OP90MKYWZH5', 'ALLEN & HEATH SQ-5 MIXER', 'SQ5X-001020351', 'ALLEN & HEATH', 17, 'tersedia', '48 channel / 36 bus digital mixer Powered by Allen & Heath’s revolutionary XCVI 96kHz FPGA engine, SQ-5 is built for professionals in the most demanding live sound applications. Delivering class-leading high resolution audio with an ultra-low <0.7ms latency, the SQ-5 gives you unrivalled power and audio fidelity. The mixer has 16 onboard preamps and 8 stereo FX engines with dedicated return channels and access to the acclaimed RackExtra FX library. 12 stereo mixes (configurable as groups or auxes) make SQ the perfect companion for in-ear monitoring setups, whilst Automatic Mic Mixing takes the strain in multi-mic environments. SQ-5 gives you all the tools to meet any requirement, from AV and corporate events to live productions and houses of worship.', '1753356677_qr.svg', 5, 5, '1753836356.jpg', '2025-07-24 11:31:17', '2025-07-30 00:45:56');
INSERT INTO `barang` (`id`, `uuid`, `kode_barang`, `nama_barang`, `nomor_seri`, `merk`, `jenis_barang_id`, `status`, `deskripsi`, `qr_code`, `limit`, `sisa_limit`, `foto`, `created_at`, `updated_at`) VALUES
(252, '97728a4f-a51c-4dbf-ba59-960f875f6499', '73O1LIU02WZS', 'CAMCODER SONY PXW-X160 (3)', '1605362', 'SONY', 1, 'tersedia', '25X OPTICAL ZOOM', '1753356800_qr.svg', 5, 5, '1753836245.jpg', '2025-07-24 11:33:20', '2025-07-30 00:44:05'),
(253, 'f6acb113-cee3-4499-8054-6202b68978ca', '30JG6VY9R2B1', 'LAPTOP DELL VOSTRO', 'RJ0XV A00', 'DELL', 11, 'tersedia', 'VOSTRO 14 3000\r\nI3 \r\n512', '1753357273_qr.svg', 999, 999, '1753836196.jpg', '2025-07-24 11:41:13', '2025-07-30 00:43:16'),
(258, 'b117170f-953a-4a4f-9a44-8d9886123d15', 'W516ED4T3L8Z', 'Sony ECM-VG1 Electret Condenser Microphone (1)', '100377', 'SONY', 6, 'tersedia', 'The Sony ECM-VG1 Electret Condenser Microphone is a rugged, all-metal shotgun microphone with a supercardioid polar pattern, making it a well suited choice for camcorder-mounted and boom pole operation alike. The included windscreen has been designed to maximize wind-noise rejection.', '1753412745_qr.svg', 5, 5, '1753836182.jpg', '2025-07-25 03:05:45', '2025-07-30 00:43:02'),
(259, 'd02c941b-45b9-47db-aabd-77cddec1c852', 'YWGQDN9VJ6PT', 'Sony ECM-VG1 Electret Condenser Microphone', '100386', 'SONY', 6, 'tersedia', 'The Sony ECM-VG1 Electret Condenser Microphone is a rugged, all-metal shotgun microphone with a supercardioid polar pattern, making it a well suited choice for camcorder-mounted and boom pole operation alike. The included windscreen has been designed to maximize wind-noise rejection.', '1753412770_qr.svg', 5, 5, '1753836173.jpg', '2025-07-25 03:06:10', '2025-07-30 00:42:53'),
(260, '73c90a7c-499f-4d18-9b96-2d2c8d6bdd2f', 'EIDBLQ1T8PMS', 'DONGLE MIC Sennheiser EW 100-ENG G3 (2)', '2', 'Sennheiser', 6, 'tersedia', NULL, '1753423953_qr.svg', 5, 5, '1753836148.jpg', '2025-07-25 06:12:37', '2025-07-30 00:42:28'),
(261, 'e68a039f-8aac-4a2d-8bb1-84960eeb86b0', 'A3HV6PQTKSC2', 'DONGLE MIC Sennheiser EW 100-ENG G3 (1)', '1', 'Sennheiser', 6, 'tersedia', NULL, '1753423958_qr.svg', 5, 5, '1753836139.jpg', '2025-07-25 06:12:38', '2025-07-30 00:42:19'),
(262, '33a08628-a8f4-4d27-991d-df48d5d1247b', 'FJB1OKPD76G8', 'Mic Wireless AKG SR45 Perception Wireless Vocal Set (1)', 'V11', 'AKG', 6, 'tersedia', 'The Perception Wireless high performance Vocal Set delivers brilliant sound and is suprisingly easy to use. The included HT45 handheld transmitter features a dynamic microphone with cardioid polar pattern, ensuring voices to cut through any mix. The SR45 receiver provides professional XLR and 1/4\" jack outputs\r\n\r\n1 X SR45 Receiver\r\n1 X HT45 Handheld transmitter\r\n1 X Stand Adapter\r\n1 X Universal Power Supply with US', '1753424727_qr.svg', 5, 5, '1753836043.JPG', '2025-07-25 06:25:27', '2025-07-30 00:40:43'),
(263, '1736105f-2c3d-41c5-aadf-86c43f0ab4d5', '2ORJLW3V6MXB', 'Mic Wireless AKG SR45 Perception Wireless Vocal Set (2)', 'V11', 'AKG', 6, 'tersedia', 'The Perception Wireless high performance Vocal Set delivers brilliant sound and is suprisingly easy to use. The included HT45 handheld transmitter features a dynamic microphone with cardioid polar pattern, ensuring voices to cut through any mix. The SR45 receiver provides professional XLR and 1/4\" jack outputs\r\n\r\n1 X SR45 Receiver\r\n1 X HT45 Handheld transmitter\r\n1 X Stand Adapter\r\n1 X Universal Power Supply with US', '1753424730_qr.svg', 5, 5, '1753836031.JPG', '2025-07-25 06:25:30', '2025-07-30 00:40:31'),
(264, '6f99ee18-aba8-4565-8d96-608173776a25', '5VP76URTSH0F', 'Mic Wireless AKG SR45 Perception Wireless Vocal Set (3)', 'V11', 'AKG', 6, 'tersedia', 'The Perception Wireless high performance Vocal Set delivers brilliant sound and is suprisingly easy to use. The included HT45 handheld transmitter features a dynamic microphone with cardioid polar pattern, ensuring voices to cut through any mix. The SR45 receiver provides professional XLR and 1/4\" jack outputs\r\n\r\n1 X SR45 Receiver\r\n1 X HT45 Handheld transmitter\r\n1 X Stand Adapter\r\n1 X Universal Power Supply with US', '1753424733_qr.svg', 5, 5, '1753835945.JPG', '2025-07-25 06:25:33', '2025-07-30 00:39:05'),
(265, 'b91735c8-ba91-46e3-a2ab-14052e8af7d4', 'HCUS2PTYAB9G', 'Mic Wireless AKG SR45 Perception Wireless Vocal Set (4)', 'V11', 'AKG', 6, 'tersedia', 'The Perception Wireless high performance Vocal Set delivers brilliant sound and is suprisingly easy to use. The included HT45 handheld transmitter features a dynamic microphone with cardioid polar pattern, ensuring voices to cut through any mix. The SR45 receiver provides professional XLR and 1/4\" jack outputs\r\n\r\n1 X SR45 Receiver\r\n1 X HT45 Handheld transmitter\r\n1 X Stand Adapter\r\n1 X Universal Power Supply with US', '1753424737_qr.svg', 5, 5, '1753835933.JPG', '2025-07-25 06:25:37', '2025-07-30 00:38:53');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('206b78cc646448dedc1fc88658c08d3d', 's:2514:\"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkCAYAAABw4pVUAAAACXBIWXMAAA7EAAAOxAGVKw4bAAAG/0lEQVR4nO2dSWwbVRjH/7PYjh0vcZzUWRpFJUA3KiACoeaCVFVwqECAoFThAKciVA4IITggxIFFSEiVEPTAoeJQSqWqVcWiorIUkKBSOVTikNKWRqUJbWonjh2v8TLzOIDbxPWMPeOZN8/O+13fLF++33xvG8cWCCHgsIPsdABGOTc9YfgJGh87I9gRix0ILFeImeQ3C6uSmBJip4BGsCKICSFOiqjFaTGOCWFJghZOyKEupB1E1EJTjEjrRkB7ygDoxk2lQtpVRD3srhZbhXSSiFrsEmOLkE4WUYvVYqiOIZzGWFoha6kyarGqUiyrkLUsA7Du77dEyFqXUcWKPLQshMtYTav5aEkIl1GfVvJiWgiXoY/Z/JgSwmU0h5k8GRbCZRjDaL74wpAxml4Y8sponWYWj7xCGKMpIbw6rKGZPPIKYYyGQnh1WEujfPIKYQxdIbw67EEvr5pCuAx70cov77IYo64QXh10qJdnXiGMwYUwxm17WfS7KwFB3wQC3vvg82yBWx6AJPohiV4oagGKmkW5Eke+dAn55QtIF86ioiw2deWRvtfQH3rKskhjqcO4ljhg2fWqrNzjcvAfdiREeybRH3oabrm/7hGyFIAsBeBxDcLvvRcIAYSoyBcvIpU7jUTmJCpKknLc9rKqy6JVHR7XCDat/wzDkZc0ZWghCCK6uzZjOLIP20a/xPrIKzZFSY+VeadeIW55CHcNfWJYRD0EQUapErcgKnagPKgLuGPgA0tkAICqFpHIfGPJtViBqpC+4JPwee607HrJ7A9Q1LRl12OBm10WjfEjEtil275cmkF86SiK5VlUlBQksRtuOQqvZyMC3gdukzmfPm46lkJxGpeu7zN0jkqWTd+vEeemJ8j42BmB2hgiS2F0d23WbE9mT+NK7C0AdZ6L7CkAgEuOotf/CCKBXVDUDPLFC6bjIVCYrC5qQjzykGYbISpmF/ajrowVlCsxxFKHEEsdgiQGLY6QDaiNIbIU1mxT1FzTi71b57D3dFsBNSEqKWq2SWJ3xz7xRhEBOgO63npBEEQMR4wNsJ3IuekJQq1CiuUZlCsJzfa+4GPYEH0XkhiiFRKTUFyHECxmv9M9IuzfgXtGj2Owd++a7cIEQgi1PSxZCmPLyGHIUk/DYxU1j4X0V4injqCszJu6n5W7vYuZ7/F3/G1LrqUH1ZV6RUniavx9EKI2PFYSfYj27MHW0WMY6XsdLsma7RbWof6Cain/K67G32tKCgCIggv9oSewdfQYBnv3QhDcNkfoLI68MVzMfovLc6/qDvK1iIILg+EXsGXkMLzuu22Mzlkce4WbKfyOqZlnEUsdgapqr1Fq8biGsXH4U/R0P2xjdM7h6Dt1leRxLfExpmZ2I546ClVtbvNOFD3YEH0H/q77bY6QPlRnWY2QxCDWhZ5Bf2g3ZCnQ8PhS+QamZveAkFLddr1ZltHdXkLKUEmh6ePNwtSXYCpqGnPJg4ilvkC0ZxLRnucgil2ax7tdA+j1P4pE5mvD92J1t5fJjwGppIC55EGcn51EbvlP3WPD/h2UoqIDk0KqlCo38Nf1l1EoXdE8xufZRDEi+xEB57/4UQ+VFBBLfq7ZLokBAMyGb4jxsTMC0xVSpVSZ02lV0ejFVjtBTcho/5tYF5o0tWnodWt/MKLcYR+UozbLcrsGEQnuwlDkRSzlfkEicwqZ/FkQVPTPkwcwEH5es71Qumx1qI5CfdorCi6E/TsR9u+EouaRXf4D+eXzyBcvoqwsQlHSgCDBLUcR9D2EvuDjkMRuzeulsj+bikMQXHDJUUPnqGoOipo1db9muSlkfOyMQHuBKIk+hHzbEfJtN3V+uZJAMvujqXO97g3YNnrC0Dl2fdgauDWxaotBXYvZhf1QSd7pMCylbYVcSxxAKveT02FYDrUxhBD9wbtZKkoG/yQ+wmLmpCXXY41VFWLnAnH6xhuYmf8Q+eJFU+dXlAzml47j/OyejpPhyD/sEFLEQvoEFtInIEu9CHofhM+zGV3uUXhc6yGJ3RAFLyCI/89mciiV55ArXkC+OIWl3G8Np8idQN2vZ2JlO34tUNsrte2g3qlwIYxRVwjLu7+dRL088wphDE0hvErsRSu/uhXCpdiDXl55l8UYDYXwKrGWRvnkFcIYTQnhVWIN/IuU2xDDv0HF97mMY6SH4RXCGIaF8PHEGEbzZapCuJTmMJMn010Wl6KP2fy0NIZwKfVpJS8tD+pcympazYclsywu5T+syINl0961LsWqv5//fHeL8J/v7nBsqZAqnVwpdnXRtgqp0kli7B4rqQip0s5iaE1aqI4h7ToToxk31QpZSTtUixMPkGNCVsKSHKermAkhVZwU47SIKkwJqcVOQawIqIVpIfUwI4nV5NfjX4LHz1UKkKd+AAAAAElFTkSuQmCC\";', 2069034671);

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
-- Table structure for table `catatan`
--

CREATE TABLE `catatan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `isi_catatan` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `catatan`
--

INSERT INTO `catatan` (`id`, `isi_catatan`, `created_at`, `updated_at`) VALUES
(1, '<ul data-spread=\"false\" data-pm-slice=\"3 3 []\">\r\n<li>\r\n<p>Barang yang rusak atau hilang menjadi tanggung jawab peminjam.</p>\r\n</li>\r\n<li>\r\n<p>Keterlambatan pengembalian dapat dikenakan sanksi.</p>\r\n</li>\r\n<li>\r\n<p>Gunakan barang sesuai keperluan dan dengan hati-hati.</p>\r\n</li>\r\n</ul>', NULL, '2025-02-11 01:14:27');

-- --------------------------------------------------------

--
-- Table structure for table `detail_peminjaman`
--

CREATE TABLE `detail_peminjaman` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `kode_peminjaman` varchar(255) NOT NULL,
  `kode_barang` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_peminjaman`
--

INSERT INTO `detail_peminjaman` (`id`, `uuid`, `kode_peminjaman`, `kode_barang`, `created_at`, `updated_at`) VALUES
(18, '2f9d1c2a-cff3-493c-804b-43a8803b30fa', 'PMB-1747815190', 'MNQV5ADR72LG', '2025-05-21 08:13:13', '2025-05-21 08:13:13'),
(19, '95857a96-c9b3-42d8-b859-c184536a7e28', 'PMB-1748417733', 'JMKWA2X3E6BO', '2025-05-28 07:35:35', '2025-05-28 07:35:35'),
(20, '6eb70753-1006-4714-a544-53fc5b07d579', 'PMB-1748417733', 'W42YSR9JPQMO', '2025-05-28 07:35:35', '2025-05-28 07:35:35'),
(21, 'aba69682-52ca-43a5-a54c-5320a86329ea', 'PMB-1750723468', 'EADXNZGUCBI0', '2025-06-24 00:04:28', '2025-06-24 00:04:28');

-- --------------------------------------------------------

--
-- Table structure for table `detail_pengembalian`
--

CREATE TABLE `detail_pengembalian` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `kode_pengembalian` varchar(255) NOT NULL,
  `kode_barang` varchar(255) NOT NULL,
  `deskripsi` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_pengembalian`
--

INSERT INTO `detail_pengembalian` (`id`, `uuid`, `kode_pengembalian`, `kode_barang`, `deskripsi`, `status`, `created_at`, `updated_at`) VALUES
(23, '26cffb8f-6421-4d7e-8291-53a609986628', 'PG-1747815336', 'MNQV5ADR72LG', 'gak sengaja kebanting', 'rusak', '2025-05-21 08:15:36', '2025-05-21 08:16:21'),
(24, '36ff86fd-23ad-427e-962f-d3a3459fe407', 'PG-1748417840', 'JMKWA2X3E6BO', 'lupa ketinggalan', 'belum_dikembalikan', '2025-05-28 07:37:20', '2025-05-28 07:37:39'),
(25, '90e7d4b7-701f-4147-b0c7-52bd5ef1fee2', 'PG-1748417840', 'W42YSR9JPQMO', 'gak sengaja hehe', 'rusak', '2025-05-28 07:37:20', '2025-05-28 07:37:39');

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
-- Table structure for table `guidebook`
--

CREATE TABLE `guidebook` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `file` varchar(2048) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `guidebook`
--

INSERT INTO `guidebook` (`id`, `uuid`, `file`, `status`, `created_at`, `updated_at`) VALUES
(1, 'c55f24ea-5a33-4f5f-b947-811883780046', '1737377602.pdf', 'used', '2025-01-20 12:53:22', '2025-03-25 13:18:31');

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id`, `uuid`, `jabatan`, `created_at`, `updated_at`) VALUES
(1, '9f679c46-2cfb-4b5a-9f77-fa34abadf897', 'Technical Director (TD)', '2024-12-26 16:38:11', '2024-12-26 16:38:11'),
(2, 'd950f553-b3b5-409a-acc7-a60afc3b4bc7', 'Petugas Khusus', '2024-12-26 16:38:11', '2024-12-26 16:38:11'),
(3, 'eae118b1-63b0-4159-ba77-295207c962fc', 'Administrator', '2024-12-26 16:38:11', '2024-12-26 16:38:11');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_barang`
--

CREATE TABLE `jenis_barang` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `jenis_barang` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jenis_barang`
--

INSERT INTO `jenis_barang` (`id`, `uuid`, `jenis_barang`, `created_at`, `updated_at`) VALUES
(1, '0c0c56d6-8ff2-45b7-9067-95451a69f3cb', 'Kamera', '2024-12-26 16:38:11', '2024-12-26 16:38:11'),
(2, '4f68e354-c339-4760-b1cb-3a54364b67ee', 'Lensa', '2024-12-26 16:38:11', '2024-12-26 16:38:11'),
(3, '6597d2e9-9e65-492e-95a4-20f25c70553a', 'Action Cam', '2024-12-26 16:38:11', '2024-12-26 16:38:11'),
(4, 'df758baa-e723-49a3-ac90-47740370d085', 'Baterai', '2024-12-26 16:38:11', '2024-12-26 16:38:11'),
(5, 'd6b4ccba-7aa6-4165-a486-b9858476d155', 'Drone', '2024-12-26 16:38:12', '2024-12-26 16:38:12'),
(6, '2757ecbb-3649-487f-8dca-b15cadc3590f', 'Mikropon', '2024-12-26 16:38:12', '2025-01-22 08:29:47'),
(7, 'c31dc3c7-dfcc-48fa-9b2d-baac0672b30b', 'Smartphone', '2024-12-26 16:38:12', '2024-12-26 16:38:12'),
(8, 'ad6d171e-efac-4c4a-8d2f-8a776366d9c7', 'Perlengkapan', '2024-12-26 16:38:12', '2025-01-22 08:30:02'),
(9, '985a29df-cf9e-4f34-8d6c-372ce82889d3', 'Komunikasi', '2024-12-26 16:38:12', '2024-12-26 16:38:12'),
(10, 'fb8906af-5b28-4daa-ba50-e3493138c4f5', 'Memori', '2024-12-26 16:38:12', '2025-01-22 08:30:10'),
(11, 'fb924501-f7b0-4754-91f1-351b0b961d0e', 'Laptop', '2024-12-26 16:38:12', '2024-12-26 16:38:12'),
(12, 'a0f4e777-f99a-488d-8fbf-fd9d2a5f9f07', 'Lampu', '2025-01-22 08:30:23', '2025-01-22 08:30:23'),
(15, 'ba9f798c-7a60-4022-bd75-5028f3332d81', 'Video Switcher', '2025-06-24 00:47:45', '2025-06-24 00:47:45'),
(17, 'b56c6c9b-99b6-4b4e-a174-5c0c9b8d3a67', 'Mixer Audio', '2025-07-24 11:22:03', '2025-07-24 11:22:03');

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
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `waktu_login` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `gambar` varchar(2048) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`id`, `id_user`, `waktu_login`, `gambar`, `created_at`, `updated_at`) VALUES
(98, 19, '2025-04-07 04:55:27', '67f35abf4843c.jpg', '2025-04-07 04:55:27', '2025-04-07 04:55:27'),
(100, 19, '2025-04-07 08:23:54', '67f38b9a88630.jpg', '2025-04-07 08:23:54', '2025-04-07 08:23:54'),
(102, 19, '2025-04-10 07:23:14', '67f771e2ee400.jpg', '2025-04-10 07:23:14', '2025-04-10 07:23:14'),
(104, 19, '2025-04-10 07:29:53', '67f7737137f3f.jpg', '2025-04-10 07:29:53', '2025-04-10 07:29:53'),
(107, 19, '2025-04-10 07:36:31', '67f774ffd9570.jpg', '2025-04-10 07:36:31', '2025-04-10 07:36:31'),
(110, 19, '2025-04-10 07:46:29', '67f7775521fe8.jpg', '2025-04-10 07:46:29', '2025-04-10 07:46:29'),
(111, 19, '2025-04-10 07:48:41', '67f777d97f7e1.jpg', '2025-04-10 07:48:41', '2025-04-10 07:48:41'),
(112, 19, '2025-04-10 07:52:54', '67f778d6a7528.jpg', '2025-04-10 07:52:54', '2025-04-10 07:52:54'),
(113, 19, '2025-04-10 07:53:15', '67f778eb516e0.jpg', '2025-04-10 07:53:15', '2025-04-10 07:53:15'),
(115, 19, '2025-04-10 08:04:44', '67f77b9c409d2.jpg', '2025-04-10 08:04:44', '2025-04-10 08:04:44'),
(117, 19, '2025-04-10 08:08:07', '67f77c678a1cc.jpg', '2025-04-10 08:08:07', '2025-04-10 08:08:07'),
(118, 19, '2025-04-11 08:11:43', '67f8cebeee5fd.jpg', '2025-04-11 08:11:43', '2025-04-11 08:11:43'),
(119, 22, '2025-04-11 09:59:21', '67f8e7f987b21.jpg', '2025-04-11 09:59:21', '2025-04-11 09:59:21'),
(120, 22, '2025-04-11 09:59:42', '67f8e80ec30c8.jpg', '2025-04-11 09:59:42', '2025-04-11 09:59:42'),
(121, 19, '2025-04-21 07:03:11', '6805edaed1606.jpg', '2025-04-21 07:03:11', '2025-04-21 07:03:11'),
(122, 19, '2025-04-21 07:05:29', '6805ee393f1f4.jpg', '2025-04-21 07:05:29', '2025-04-21 07:05:29'),
(123, 22, '2025-04-21 07:05:41', '6805ee45be22f.jpg', '2025-04-21 07:05:41', '2025-04-21 07:05:41'),
(124, 19, '2025-04-21 08:06:39', '6805fc8f5b143.jpg', '2025-04-21 08:06:39', '2025-04-21 08:06:39'),
(125, 22, '2025-04-21 08:11:45', '6805fdc1da8dc.jpg', '2025-04-21 08:11:45', '2025-04-21 08:11:45'),
(126, 19, '2025-04-21 08:12:34', '6805fdf24a267.jpg', '2025-04-21 08:12:34', '2025-04-21 08:12:34'),
(128, 19, '2025-05-06 00:25:50', '6819570e29169.jpg', '2025-05-06 00:25:50', '2025-05-06 00:25:50'),
(129, 19, '2025-05-21 08:02:57', '682d88b1405a8.jpg', '2025-05-21 08:02:57', '2025-05-21 08:02:57'),
(130, 22, '2025-05-21 08:11:36', '682d8ab89ba64.jpg', '2025-05-21 08:11:36', '2025-05-21 08:11:36'),
(131, 19, '2025-05-21 08:16:35', '682d8be38f8a7.jpg', '2025-05-21 08:16:35', '2025-05-21 08:16:35'),
(132, 22, '2025-05-21 10:18:20', '682da86b9c4f5.jpg', '2025-05-21 10:18:20', '2025-05-21 10:18:20'),
(133, 19, '2025-05-27 02:34:56', '683524d01d723.jpg', '2025-05-27 02:34:56', '2025-05-27 02:34:56'),
(134, 19, '2025-05-28 07:33:36', '6836bc4fbf96e.jpg', '2025-05-28 07:33:36', '2025-05-28 07:33:36'),
(135, 22, '2025-05-28 07:34:05', '6836bc6dc3425.jpg', '2025-05-28 07:34:05', '2025-05-28 07:34:05'),
(136, 19, '2025-05-28 07:38:32', '6836bd780e97c.jpg', '2025-05-28 07:38:32', '2025-05-28 07:38:32'),
(137, 26, '2025-06-02 03:15:40', '683d175c25ce3.jpg', '2025-06-02 03:15:40', '2025-06-02 03:15:40'),
(138, 26, '2025-06-02 03:21:36', '683d18c0adae5.jpg', '2025-06-02 03:21:36', '2025-06-02 03:21:36'),
(139, 26, '2025-06-02 03:24:05', '683d19555ad26.jpg', '2025-06-02 03:24:05', '2025-06-02 03:24:05'),
(140, 26, '2025-06-02 03:24:18', '683d1962ce40c.jpg', '2025-06-02 03:24:18', '2025-06-02 03:24:18'),
(141, 26, '2025-06-02 03:24:35', '683d19730f8c4.jpg', '2025-06-02 03:24:35', '2025-06-02 03:24:35'),
(142, 26, '2025-06-02 03:33:02', '683d1b6e021ab.jpg', '2025-06-02 03:33:02', '2025-06-02 03:33:02'),
(143, 26, '2025-06-02 03:35:45', '683d1c114b7d9.jpg', '2025-06-02 03:35:45', '2025-06-02 03:35:45'),
(144, 26, '2025-06-03 06:35:40', '683e97bbd63fd.jpg', '2025-06-03 06:35:40', '2025-06-03 06:35:40'),
(145, 26, '2025-06-17 01:09:34', '6850c04dd35a2.jpg', '2025-06-17 01:09:34', '2025-06-17 01:09:34'),
(147, 22, '2025-06-17 01:11:10', '6850c0ae8de4a.jpg', '2025-06-17 01:11:10', '2025-06-17 01:11:10'),
(148, 26, '2025-06-17 01:12:42', '6850c10a57b76.jpg', '2025-06-17 01:12:42', '2025-06-17 01:12:42'),
(149, 26, '2025-06-18 00:24:39', '68520747b16c3.jpg', '2025-06-18 00:24:39', '2025-06-18 00:24:39'),
(150, 26, '2025-06-18 05:06:54', '6852496e99ebc.jpg', '2025-06-18 05:06:54', '2025-06-18 05:06:54'),
(151, 19, '2025-06-19 00:46:36', '68535dec32fed.jpg', '2025-06-19 00:46:36', '2025-06-19 00:46:36'),
(152, 26, '2025-06-20 07:39:55', '6855104b12151.jpg', '2025-06-20 07:39:55', '2025-06-20 07:39:55'),
(153, 26, '2025-06-23 05:55:55', '6858ec6b2c996.jpg', '2025-06-23 05:55:55', '2025-06-23 05:55:55'),
(154, 26, '2025-06-23 06:13:07', '6858f073dc99f.jpg', '2025-06-23 06:13:07', '2025-06-23 06:13:07'),
(155, 26, '2025-06-23 23:58:23', '6859ea1e926ed.jpg', '2025-06-23 23:58:23', '2025-06-23 23:58:23'),
(156, 26, '2025-06-24 00:03:21', '6859eb49539a2.jpg', '2025-06-24 00:03:21', '2025-06-24 00:03:21'),
(157, 35, '2025-06-24 00:03:48', '6859eb640988d.jpg', '2025-06-24 00:03:48', '2025-06-24 00:03:48'),
(158, 26, '2025-06-24 00:11:13', '6859ed21a160a.jpg', '2025-06-24 00:11:13', '2025-06-24 00:11:13'),
(159, 26, '2025-06-24 00:39:33', '6859f3c5cf18c.jpg', '2025-06-24 00:39:33', '2025-06-24 00:39:33'),
(160, 35, '2025-06-24 00:40:20', '6859f3f4aeae8.jpg', '2025-06-24 00:40:20', '2025-06-24 00:40:20'),
(161, 27, '2025-06-24 00:43:29', '6859f4b1d4ff1.jpg', '2025-06-24 00:43:29', '2025-06-24 00:43:29'),
(162, 27, '2025-06-24 00:43:43', '6859f4bf6be7d.jpg', '2025-06-24 00:43:43', '2025-06-24 00:43:43'),
(163, 29, '2025-06-24 00:44:07', '6859f4d7da642.jpg', '2025-06-24 00:44:07', '2025-06-24 00:44:07'),
(164, 35, '2025-06-24 00:44:23', '6859f4e711b59.jpg', '2025-06-24 00:44:23', '2025-06-24 00:44:23'),
(165, 26, '2025-06-24 00:44:38', '6859f4f67d3c5.jpg', '2025-06-24 00:44:38', '2025-06-24 00:44:38'),
(166, 26, '2025-06-24 00:44:55', '6859f507d49e5.jpg', '2025-06-24 00:44:55', '2025-06-24 00:44:55'),
(167, 26, '2025-06-24 01:05:29', '6859f9d8f16dd.jpg', '2025-06-24 01:05:29', '2025-06-24 01:05:29'),
(168, 26, '2025-06-24 05:37:47', '685a39ab6f190.jpg', '2025-06-24 05:37:47', '2025-06-24 05:37:47'),
(169, 35, '2025-06-24 06:08:12', '685a40cc703cb.jpg', '2025-06-24 06:08:12', '2025-06-24 06:08:12'),
(170, 26, '2025-06-24 07:24:06', '685a529617e1b.jpg', '2025-06-24 07:24:06', '2025-06-24 07:24:06'),
(171, 26, '2025-06-25 00:13:54', '685b3f41f0dd4.jpg', '2025-06-25 00:13:54', '2025-06-25 00:13:54'),
(172, 27, '2025-06-25 01:33:32', '685b51ec3e276.jpg', '2025-06-25 01:33:32', '2025-06-25 01:33:32'),
(173, 26, '2025-06-25 01:35:12', '685b525015b66.jpg', '2025-06-25 01:35:12', '2025-06-25 01:35:12'),
(174, 26, '2025-06-25 05:31:14', '685b89a1ce3a8.jpg', '2025-06-25 05:31:14', '2025-06-25 05:31:14'),
(175, 19, '2025-06-25 23:49:23', '685c8b02d7dc2.jpg', '2025-06-25 23:49:23', '2025-06-25 23:49:23'),
(176, 26, '2025-06-25 23:50:17', '685c8b390db59.jpg', '2025-06-25 23:50:17', '2025-06-25 23:50:17'),
(177, 26, '2025-06-30 00:56:20', '6861e0b3d4451.jpg', '2025-06-30 00:56:20', '2025-06-30 00:56:20'),
(178, 26, '2025-06-30 23:55:31', '686323f2b4a48.jpg', '2025-06-30 23:55:31', '2025-06-30 23:55:31'),
(179, 32, '2025-07-01 13:08:24', '6863ddc7db29b.jpg', '2025-07-01 13:08:24', '2025-07-01 13:08:24'),
(180, 26, '2025-07-01 23:40:43', '686471fb53def.jpg', '2025-07-01 23:40:43', '2025-07-01 23:40:43'),
(181, 26, '2025-07-03 01:22:09', '6865db4072437.jpg', '2025-07-03 01:22:09', '2025-07-03 01:22:09'),
(182, 26, '2025-07-04 01:11:22', '68672a398e817.jpg', '2025-07-04 01:11:22', '2025-07-04 01:11:22'),
(183, 22, '2025-07-04 01:41:37', '68673151c7e14.jpg', '2025-07-04 01:41:37', '2025-07-04 01:41:37'),
(184, 19, '2025-07-04 01:42:04', '6867316cec026.jpg', '2025-07-04 01:42:04', '2025-07-04 01:42:04'),
(185, 26, '2025-07-04 01:44:14', '686731ee7cd09.jpg', '2025-07-04 01:44:14', '2025-07-04 01:44:14'),
(186, 19, '2025-07-04 06:30:58', '68677521dc5c7.jpg', '2025-07-04 06:30:58', '2025-07-04 06:30:58'),
(187, 27, '2025-07-05 10:49:30', '68690339985fd.jpg', '2025-07-05 10:49:30', '2025-07-05 10:49:30'),
(188, 19, '2025-07-05 10:50:32', '68690378698ec.jpg', '2025-07-05 10:50:32', '2025-07-05 10:50:32'),
(189, 19, '2025-07-07 00:49:45', '686b19a8cb874.jpg', '2025-07-07 00:49:45', '2025-07-07 00:49:45'),
(190, 19, '2025-07-08 01:23:52', '686c7327e0754.jpg', '2025-07-08 01:23:52', '2025-07-08 01:23:52'),
(191, 30, '2025-07-08 01:25:39', '686c7393ad9eb.jpg', '2025-07-08 01:25:39', '2025-07-08 01:25:39'),
(192, 19, '2025-07-08 01:28:47', '686c744ea1220.jpg', '2025-07-08 01:28:47', '2025-07-08 01:28:47'),
(193, 26, '2025-07-09 00:43:07', '686dbb1aaf21c.jpg', '2025-07-09 00:43:07', '2025-07-09 00:43:07'),
(194, 22, '2025-07-09 00:44:01', '686dbb513b2ce.jpg', '2025-07-09 00:44:01', '2025-07-09 00:44:01'),
(195, 19, '2025-07-09 00:44:32', '686dbb70d5019.jpg', '2025-07-09 00:44:32', '2025-07-09 00:44:32'),
(196, 30, '2025-07-09 01:52:00', '686dcb408d371.jpg', '2025-07-09 01:52:00', '2025-07-09 01:52:00'),
(197, 22, '2025-07-09 01:53:24', '686dcb9491227.jpg', '2025-07-09 01:53:24', '2025-07-09 01:53:24'),
(198, 19, '2025-07-09 01:53:55', '686dcbb3a4081.jpg', '2025-07-09 01:53:55', '2025-07-09 01:53:55'),
(199, 29, '2025-07-09 03:08:34', '686ddd3285b18.jpg', '2025-07-09 03:08:34', '2025-07-09 03:08:34'),
(200, 19, '2025-07-09 03:15:13', '686ddec199240.jpg', '2025-07-09 03:15:13', '2025-07-09 03:15:13'),
(201, 19, '2025-07-09 03:25:45', '686de139028fb.jpg', '2025-07-09 03:25:45', '2025-07-09 03:25:45'),
(202, 19, '2025-07-10 01:03:18', '686f11562c9c3.jpg', '2025-07-10 01:03:18', '2025-07-10 01:03:18'),
(203, 19, '2025-07-11 02:30:24', '6870774052f09.jpg', '2025-07-11 02:30:24', '2025-07-11 02:30:24'),
(204, 19, '2025-07-14 01:09:26', '687458c58377f.jpg', '2025-07-14 01:09:26', '2025-07-14 01:09:26'),
(205, 19, '2025-07-14 01:50:52', '6874627c95482.jpg', '2025-07-14 01:50:52', '2025-07-14 01:50:52'),
(206, 19, '2025-07-15 00:20:20', '68759ec39348a.jpg', '2025-07-15 00:20:20', '2025-07-15 00:20:20'),
(207, 19, '2025-07-15 05:21:39', '6875e5637446d.jpg', '2025-07-15 05:21:39', '2025-07-15 05:21:39'),
(208, 19, '2025-07-17 00:37:39', '687845d28cc5c.jpg', '2025-07-17 00:37:39', '2025-07-17 00:37:39'),
(209, 31, '2025-07-22 23:55:35', '688024f69ead1.jpg', '2025-07-22 23:55:35', '2025-07-22 23:55:35'),
(210, 33, '2025-07-22 23:55:52', '6880250829843.jpg', '2025-07-22 23:55:52', '2025-07-22 23:55:52'),
(211, 26, '2025-07-23 00:15:38', '688029aa92823.jpg', '2025-07-23 00:15:38', '2025-07-23 00:15:38'),
(212, 33, '2025-07-23 02:34:53', '68804a4d7948c.jpg', '2025-07-23 02:34:53', '2025-07-23 02:34:53'),
(213, 19, '2025-07-23 03:23:27', '688055af95729.jpg', '2025-07-23 03:23:27', '2025-07-23 03:23:27'),
(214, 19, '2025-07-23 05:46:06', '6880771db597c.jpg', '2025-07-23 05:46:06', '2025-07-23 05:46:06'),
(215, 26, '2025-07-24 10:27:18', '68820a85df87b.jpg', '2025-07-24 10:27:18', '2025-07-24 10:27:18'),
(216, 26, '2025-07-24 11:37:14', '68821aea0b24f.jpg', '2025-07-24 11:37:14', '2025-07-24 11:37:14'),
(217, 31, '2025-07-24 11:43:02', '68821c46c29c9.jpg', '2025-07-24 11:43:02', '2025-07-24 11:43:02'),
(218, 27, '2025-07-24 11:49:41', '68821dd565001.jpg', '2025-07-24 11:49:41', '2025-07-24 11:49:41'),
(219, 32, '2025-07-24 13:14:24', '688231b0b19b9.jpg', '2025-07-24 13:14:24', '2025-07-24 13:14:24'),
(220, 26, '2025-07-25 02:55:37', '6882f228506fc.jpg', '2025-07-25 02:55:37', '2025-07-25 02:55:37'),
(221, 26, '2025-07-25 06:06:08', '68831ecf72cb4.jpg', '2025-07-25 06:06:08', '2025-07-25 06:06:08'),
(222, 26, '2025-07-28 03:42:18', '6886f19a147e0.jpg', '2025-07-28 03:42:18', '2025-07-28 03:42:18'),
(223, 19, '2025-07-28 03:45:18', '6886f24e390f2.jpg', '2025-07-28 03:45:18', '2025-07-28 03:45:18'),
(224, 19, '2025-07-28 03:51:07', '6886f3ab4dbfd.jpg', '2025-07-28 03:51:07', '2025-07-28 03:51:07'),
(225, 19, '2025-07-29 07:24:35', '68887733a933d.jpg', '2025-07-29 07:24:35', '2025-07-29 07:24:35'),
(226, 19, '2025-07-29 12:52:14', '6888c3fec5b10.jpg', '2025-07-29 12:52:14', '2025-07-29 12:52:14'),
(227, 19, '2025-07-29 23:32:30', '68895a0e6127b.jpg', '2025-07-29 23:32:30', '2025-07-29 23:32:30'),
(228, 19, '2025-07-31 01:37:07', '688ac8c3c71ab.jpg', '2025-07-31 01:37:07', '2025-07-31 01:37:07'),
(229, 26, '2025-08-05 07:09:18', '6891ae1edd3dc.jpg', '2025-08-05 07:09:18', '2025-08-05 07:09:18'),
(230, 27, '2025-08-05 09:01:13', '6891c85923d56.jpg', '2025-08-05 09:01:13', '2025-08-05 09:01:13'),
(231, 27, '2025-08-05 10:52:32', '6891e27090c0c.jpg', '2025-08-05 10:52:32', '2025-08-05 10:52:32'),
(232, 19, '2025-08-22 02:15:34', '68a7d2c6bd68e.jpg', '2025-08-22 02:15:34', '2025-08-22 02:15:34');

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
(1, '0000_11_17_120946_create_jabatan_table', 1),
(2, '0001_01_01_000000_create_users_table', 1),
(3, '0001_01_01_000001_create_cache_table', 1),
(4, '0001_01_01_000002_create_jobs_table', 1),
(5, '2024_10_24_020418_create_jenis_barang_table', 1),
(6, '2024_10_24_020444_create_barang_table', 1),
(7, '2024_11_04_001540_create_peruntukan_table', 1),
(8, '2024_11_04_002537_create_perawatan_table', 1),
(9, '2024_11_04_002636_create_peminjaman_table', 1),
(10, '2024_11_04_002709_create_pengembalian_table', 1),
(11, '2024_11_05_061543_create_detail_peminjaman_table', 1),
(12, '2024_11_05_061552_create_detail_pengembalian_table', 1),
(13, '2024_12_22_182303_create_log_table', 1),
(14, '2024_12_27_083246_create_catatan_table', 1),
(15, '2025_01_20_134343_create_guidebook_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('akmalrahim376@gmail.com', '$2y$12$BFiCOjnpWB7QFehltrIPj.xxzH.Cijo0fXdy2.tME1GWs4fYTgAri', '2025-02-24 01:57:07');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `kode_peminjaman` varchar(255) NOT NULL,
  `nomor_surat` varchar(255) NOT NULL,
  `nomor_peminjaman` varchar(255) NOT NULL,
  `peruntukan_id` bigint(20) UNSIGNED NOT NULL,
  `tanggal_penggunaan` date NOT NULL,
  `tanggal_peminjaman` date NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `qr_code` varchar(2048) DEFAULT NULL,
  `peminjam` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id`, `uuid`, `kode_peminjaman`, `nomor_surat`, `nomor_peminjaman`, `peruntukan_id`, `tanggal_penggunaan`, `tanggal_peminjaman`, `tanggal_kembali`, `qr_code`, `peminjam`, `status`, `created_at`, `updated_at`) VALUES
(6, '95efdb92-8c27-497e-bdfa-d591efbc6dfb', 'PMB-1747815190', 'ysdfbwaefrewf7dsw8h', 'PMJ-202505-01', 5, '2025-05-21', '2025-05-21', '2025-05-24', '1747815191_qr.svg', 'Akbar Laksana', 'Selesai', '2025-05-21 08:13:13', '2025-05-21 08:15:36'),
(7, '8f186832-d3fd-4398-8528-89279370aac7', 'PMB-1748417733', 'hhsdfgyauegfhewbfy7t87tjnj', 'PMJ-202505-02', 4, '2025-05-28', '2025-05-28', '2025-05-30', '1748417734_qr.svg', 'Akbar Laksana', 'Selesai', '2025-05-28 07:35:35', '2025-05-28 07:37:20'),
(8, '7a447006-1764-45b2-aca4-65fd53cc1cbc', 'PMB-1750723468', 'testestes', 'PMJ-202506-01', 13, '2025-06-24', '2025-06-24', '2025-06-25', '1750723468_qr.svg', 'team2', 'Proses', '2025-06-24 00:04:28', '2025-06-24 00:04:28');

-- --------------------------------------------------------

--
-- Table structure for table `pengembalian`
--

CREATE TABLE `pengembalian` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `kode_pengembalian` varchar(255) NOT NULL,
  `kode_peminjaman` varchar(255) NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `peminjam` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengembalian`
--

INSERT INTO `pengembalian` (`id`, `uuid`, `kode_pengembalian`, `kode_peminjaman`, `tanggal_kembali`, `peminjam`, `status`, `created_at`, `updated_at`) VALUES
(8, '28fe0bf9-0e2f-4b7d-b7ca-54e86369957f', 'PG-1747815336', 'PMB-1747815190', '2025-05-21', 'Akbar Laksana', 'Lengkap', '2025-05-21 08:15:36', '2025-05-21 08:15:36'),
(9, 'a44effec-c2a5-4c8e-86ae-0e4d2fa9b5e9', 'PG-1748417840', 'PMB-1748417733', '2025-05-28', 'Akbar Laksana', 'Tidak Lengkap', '2025-05-28 07:37:20', '2025-05-28 07:37:20');

-- --------------------------------------------------------

--
-- Table structure for table `perawatan`
--

CREATE TABLE `perawatan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `kode_perawatan` varchar(255) NOT NULL,
  `surat` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `peruntukan`
--

CREATE TABLE `peruntukan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `peruntukan` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `peruntukan`
--

INSERT INTO `peruntukan` (`id`, `uuid`, `peruntukan`, `created_at`, `updated_at`) VALUES
(1, '3714cba4-b71c-4edd-993a-4e84fc5a654b', 'Inspirasi Indonesia', '2024-12-26 16:38:12', '2024-12-26 16:38:12'),
(2, 'ac4f4507-bb9c-406e-9fbd-a8c0aabfc77c', 'Pesona Indonesia', '2024-12-26 16:38:12', '2024-12-26 16:38:12'),
(3, '62853ead-d1ab-494f-8170-d0dcb38cbfb2', 'Anak Indonesia', '2024-12-26 16:38:12', '2024-12-26 16:38:12'),
(4, '66328ae1-a97b-49d0-9a1a-91335cb66182', 'Jejak Islam', '2024-12-26 16:38:12', '2024-12-26 16:38:12'),
(5, '6857f954-cb13-43c1-bcc1-04fbe9bf4b83', 'Potensi Banua', '2024-12-26 16:38:12', '2024-12-26 16:38:12'),
(6, '92fa4944-bfbc-4d5b-b093-0e963e304b20', 'Lensa Olahraga', '2024-12-26 16:38:12', '2024-12-26 16:38:12'),
(7, '6ffa997f-c308-4db2-b695-2338fbcc8779', 'Live Cross', '2024-12-26 16:38:12', '2024-12-26 16:38:12'),
(8, 'fc4a3aaf-c3e6-4fe8-93a6-f9faaec794b6', 'Dangdut Keliling', '2024-12-26 16:38:12', '2024-12-26 16:38:12'),
(9, 'b93b98c0-b2fc-4acb-ab02-690b6609e785', 'Reformasi Birokrasi', '2024-12-26 16:38:12', '2024-12-26 16:38:12'),
(10, '6bfc9ab6-d3b0-425c-8904-88dcb78c052e', 'Hari yang Berkah', '2024-12-26 16:38:12', '2024-12-26 16:38:12'),
(13, 'a8d16d2c-de5b-4262-80eb-f6d92cd2f24c', 'Lainnya', '2025-03-26 02:06:42', '2025-03-26 02:06:42');

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
('KmXi83AJ806j1AqPcwGDNaMPe4HVCmGDnyWofd6l', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNjdBS1RTV2xxd0hnbFVGeXpMaWhpVWhWRWhMWVZ1RzZiclE5NHdqUyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1755828905),
('lHe9rRoBXch7HyPztcxUKLSP4ckrjt8LTxqqLSj2', 27, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiN0lLTWo5RklQQ0dKNWphbUJySDVXeTNVOHFrNFd0NUpkVjZrVlJhaCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjE6e2k6MDtzOjY6Im5vdGlmeSI7fX1zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozMjoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL3BlbWluamFtYW4iO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyNztzOjE2OiJwYXNzd29yZFZlcmlmaWVkIjtiOjE7czo2OiJub3RpZnkiO2E6NTp7czo3OiJtZXNzYWdlIjtzOjQxOiJBbmRhIHRpZGFrIG1lbWlsaWtpIGFrc2VzIGtlIGhhbGFtYW4gaW5pISI7czo0OiJ0eXBlIjtzOjU6ImVycm9yIjtzOjQ6Imljb24iO3M6MTY6ImZsYXRpY29uMi1kZWxldGUiO3M6NToibW9kZWwiO3M6NToidG9hc3QiO3M6NToidGl0bGUiO047fX0=', 1754391215),
('QKtfG4cad3q1NG13Ctxu2wu03e2z6gDWhp0ZQyMo', 19, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoieUZLYmpsNUt5VEVkdnc3dlBUWmRkZVVPcWQwYXRMNVRCeUU2cE52diI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wZW1pbmphbWFuL3BkZi84ZjE4NjgzMi1kM2ZkLTQzOTgtODUyOC04OTI3OTM3MGFhYzciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxOTtzOjE2OiJwYXNzd29yZFZlcmlmaWVkIjtiOjE7fQ==', 1755829195),
('yx7GA58Cv1p4DOk4y5FYr819jTsymIpyoINYdE7g', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiak9oVjEyWUF3djBRb0NoZ2lIQmljZnh5VTRWcnMzTnRJc1pXZ3NiRCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fX0=', 1754727777);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `kode_user` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nip` varchar(255) NOT NULL,
  `nomor_hp` varchar(13) NOT NULL,
  `jabatan_id` bigint(20) UNSIGNED NOT NULL,
  `qr_code` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `foto` varchar(2048) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `uuid`, `nama_lengkap`, `kode_user`, `email`, `nip`, `nomor_hp`, `jabatan_id`, `qr_code`, `role`, `email_verified_at`, `password`, `foto`, `remember_token`, `created_at`, `updated_at`) VALUES
(19, 'fdd7e00e-26c2-40e9-b12d-e0c243e28597', 'Superadmin ESIMPROD', 'USR68284', 'tvriweb@gmail.com', '199125653821', '081352680699', 1, '1743890223_qr.svg', 'superadmin', NULL, '$2y$12$sTvlKyapbQgZ5RiXwsI6ium9GCurvg1Msx1Ar8MEPfcrHx9NpsW3y', NULL, NULL, '2025-04-05 21:57:04', '2025-04-05 21:57:04'),
(22, '2240ffa0-5a7e-498d-84ee-c225126730eb', 'Akbar Laksana', 'USR283425', 'akbarlaksana@gmail.com', '199004232022031007', '085386612234', 1, '1744359184_qr.svg', 'user', NULL, NULL, '1745223121.png', NULL, '2025-04-11 08:13:04', '2025-04-21 08:12:01'),
(26, '032d8114-fda7-44c4-af08-182a61789e8f', 'Tim Update Data', 'USR458827', 'syifadavina.tvri@gmail.com', '200508242025042001', '082351688062', 2, '1748418544_qr.svg', 'admin', NULL, '$2y$12$.7/kcFRw.00tBnvtjUl/QODkkK1pircM2xtR2lj6n3uOxpXo.TMcy', 'default.jpeg', NULL, '2025-05-28 07:49:04', '2025-05-28 07:49:04'),
(27, 'be5bc84b-cac0-41ff-b74a-3c2e6f598066', 'YUSUF SUPRIYANTO', 'USR805847', 'yusufsupriyanto.srgn@gmail.com', '198303022022211016', '087831149360', 1, '1750213227_qr.svg', 'user', NULL, NULL, '1750213227.jpg', NULL, '2025-06-18 02:20:30', '2025-06-18 02:20:30'),
(28, 'f5f74e87-d8d4-43f5-b416-0503bbcb745c', 'Arie Fajar Prasetyo', 'USR890541', 'arekkim12@gmail.com', '198408092022211015', '082155574234', 1, '1750213678_qr.svg', 'user', NULL, NULL, '1750297829.jpeg', NULL, '2025-06-18 02:27:58', '2025-06-19 01:50:31'),
(29, '53c57187-9e0c-45cd-9109-d2cd89785748', 'NAZIB FULLAH', 'USR403368', 'nazibfullah@gmail.com', '199403292022031008', '089660590666', 1, '1750213742_qr.svg', 'user', NULL, NULL, '1750213742.jpg', NULL, '2025-06-18 02:29:02', '2025-06-18 02:29:02'),
(30, '25bc744c-2adf-441f-87f0-22cf986626e1', 'LILIK SUSANTO', 'USR559095', 'lilocla10@gmail.com', '198003262014091001', '08125081040', 1, '1750213855_qr.svg', 'user', NULL, NULL, '1750213855.jpg', NULL, '2025-06-18 02:30:55', '2025-06-18 02:30:55'),
(31, 'a1a7faa5-fd16-4fa5-a83a-919ca8966b82', 'ARY PRIYANTO', 'USR731880', 'arynayu@gmail.com', '197604012014091002', '081348328876', 1, '1750213904_qr.svg', 'user', NULL, NULL, '1750213904.jpg', NULL, '2025-06-18 02:31:44', '2025-06-18 02:31:44'),
(32, '6def29bb-9ab3-448b-8758-fc2d445e3fad', 'Yulius NW', 'USR115575', 'yuliu.nw090770@gmail.com', '197009071998031004', '083153417340', 1, '1750214006_qr.svg', 'user', NULL, NULL, '1750214006.jpg', NULL, '2025-06-18 02:33:27', '2025-06-18 02:33:27'),
(33, 'af6cb6f7-ebf3-42e1-83b4-77fa14df2c5b', 'JAYADI SANUSI', 'USR930089', 'Jayadisanusi2323@gmail.com', '198203102022211015', '085332111559', 1, '1750214059_qr.svg', 'user', NULL, NULL, '1750214059.jpg', NULL, '2025-06-18 02:34:19', '2025-06-18 02:34:19'),
(34, 'ef3dad19-837e-4d0f-aaf6-73a7f5b59a34', 'Fitro Borney', 'USR707183', 'fitroborney@gmail.com', '198905272022031003', '081351067780', 1, '1750294340_qr.svg', 'user', NULL, NULL, '1750294340.jpg', NULL, '2025-06-19 00:52:24', '2025-06-19 00:52:24'),
(35, 'a83fb863-5a79-4e24-83ed-45d54ed62cef', 'team2', 'USR662431', 'testteam2@gmail.com', '5435346546324', '6456457577834', 1, '1750723379_qr.svg', 'user', NULL, NULL, 'default.jpeg', NULL, '2025-06-24 00:03:00', '2025-06-24 00:03:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `barang_kode_barang_unique` (`kode_barang`),
  ADD KEY `barang_jenis_barang_id_foreign` (`jenis_barang_id`);

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
-- Indexes for table `catatan`
--
ALTER TABLE `catatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_peminjaman`
--
ALTER TABLE `detail_peminjaman`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_peminjaman_kode_peminjaman_foreign` (`kode_peminjaman`),
  ADD KEY `detail_peminjaman_kode_barang_foreign` (`kode_barang`);

--
-- Indexes for table `detail_pengembalian`
--
ALTER TABLE `detail_pengembalian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_pengembalian_kode_pengembalian_foreign` (`kode_pengembalian`),
  ADD KEY `detail_pengembalian_kode_barang_foreign` (`kode_barang`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `guidebook`
--
ALTER TABLE `guidebook`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_barang`
--
ALTER TABLE `jenis_barang`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `log_id_user_foreign` (`id_user`);

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
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `peminjaman_kode_peminjaman_unique` (`kode_peminjaman`),
  ADD KEY `peminjaman_peruntukan_id_foreign` (`peruntukan_id`);

--
-- Indexes for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pengembalian_kode_pengembalian_unique` (`kode_pengembalian`),
  ADD KEY `pengembalian_kode_peminjaman_foreign` (`kode_peminjaman`);

--
-- Indexes for table `perawatan`
--
ALTER TABLE `perawatan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `perawatan_kode_perawatan_unique` (`kode_perawatan`);

--
-- Indexes for table `peruntukan`
--
ALTER TABLE `peruntukan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_kode_user_unique` (`kode_user`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_nip_unique` (`nip`),
  ADD KEY `users_jabatan_id_foreign` (`jabatan_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=266;

--
-- AUTO_INCREMENT for table `catatan`
--
ALTER TABLE `catatan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `detail_peminjaman`
--
ALTER TABLE `detail_peminjaman`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `detail_pengembalian`
--
ALTER TABLE `detail_pengembalian`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `guidebook`
--
ALTER TABLE `guidebook`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jenis_barang`
--
ALTER TABLE `jenis_barang`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=233;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pengembalian`
--
ALTER TABLE `pengembalian`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `perawatan`
--
ALTER TABLE `perawatan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `peruntukan`
--
ALTER TABLE `peruntukan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_jenis_barang_id_foreign` FOREIGN KEY (`jenis_barang_id`) REFERENCES `jenis_barang` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `detail_peminjaman`
--
ALTER TABLE `detail_peminjaman`
  ADD CONSTRAINT `detail_peminjaman_kode_barang_foreign` FOREIGN KEY (`kode_barang`) REFERENCES `barang` (`kode_barang`) ON DELETE CASCADE,
  ADD CONSTRAINT `detail_peminjaman_kode_peminjaman_foreign` FOREIGN KEY (`kode_peminjaman`) REFERENCES `peminjaman` (`kode_peminjaman`) ON DELETE CASCADE;

--
-- Constraints for table `detail_pengembalian`
--
ALTER TABLE `detail_pengembalian`
  ADD CONSTRAINT `detail_pengembalian_kode_barang_foreign` FOREIGN KEY (`kode_barang`) REFERENCES `barang` (`kode_barang`) ON DELETE CASCADE,
  ADD CONSTRAINT `detail_pengembalian_kode_pengembalian_foreign` FOREIGN KEY (`kode_pengembalian`) REFERENCES `pengembalian` (`kode_pengembalian`) ON DELETE CASCADE;

--
-- Constraints for table `log`
--
ALTER TABLE `log`
  ADD CONSTRAINT `log_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_peruntukan_id_foreign` FOREIGN KEY (`peruntukan_id`) REFERENCES `peruntukan` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD CONSTRAINT `pengembalian_kode_peminjaman_foreign` FOREIGN KEY (`kode_peminjaman`) REFERENCES `peminjaman` (`kode_peminjaman`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_jabatan_id_foreign` FOREIGN KEY (`jabatan_id`) REFERENCES `jabatan` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
