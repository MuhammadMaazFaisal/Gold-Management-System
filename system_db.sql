-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 20, 2023 at 10:52 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `system_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `additional_step`
--

CREATE TABLE `additional_step` (
  `id` int NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `vendor_id` varchar(255) NOT NULL,
  `type` varchar(191) DEFAULT NULL,
  `amount` varchar(191) DEFAULT NULL,
  `date` varchar(255) NOT NULL,
  `status` varchar(191) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `additional_step`
--

INSERT INTO `additional_step` (`id`, `product_id`, `vendor_id`, `type`, `amount`, `date`, `status`) VALUES
(27, 'RF0010001', 'S013', 'Green', '1000', '2023-10-02', 'Active'),
(29, 'AW0040002', 'S013', 'Dull', '1000', '2023-10-03', 'Active'),
(30, 'RF0010003', 'S013', 'Sapphire', '5000', '2023-10-03', 'Active'),
(35, 'IM0030004', 'HK015', 'Meena', '12', '2023-10-20', 'Active'),
(36, 'AW0040005', 'S013', 'Dull', '290', '2023-10-14', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `buyer`
--

CREATE TABLE `buyer` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `buyer`
--

INSERT INTO `buyer` (`id`, `name`, `status`, `date`) VALUES
('MF004', 'Maaz Faisal', 'Active', '2023-09-13');

-- --------------------------------------------------------

--
-- Table structure for table `cash`
--

CREATE TABLE `cash` (
  `id` int NOT NULL,
  `date` varchar(255) NOT NULL,
  `vendor_id` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `amount` float NOT NULL,
  `details` text NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `m2_cash`
--

CREATE TABLE `m2_cash` (
  `id` int NOT NULL,
  `date` varchar(255) NOT NULL,
  `buyer_id` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `details` text NOT NULL,
  `status` varchar(255) NOT NULL,
  `amount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `m2_gold`
--

CREATE TABLE `m2_gold` (
  `id` int NOT NULL,
  `date` varchar(255) NOT NULL,
  `buyer_id` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `details` text NOT NULL,
  `status` varchar(255) NOT NULL,
  `amount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `manufacturing_step`
--

CREATE TABLE `manufacturing_step` (
  `id` int NOT NULL,
  `vendor_id` varchar(255) DEFAULT NULL,
  `product_id` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `image` text,
  `details` text,
  `type` varchar(191) DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `purity` varchar(255) DEFAULT NULL,
  `purity_text` varchar(255) NOT NULL,
  `unpolish_weight` float DEFAULT NULL,
  `polish_weight` float DEFAULT NULL,
  `rate` int DEFAULT NULL,
  `wastage` float DEFAULT NULL,
  `unpure_weight` float DEFAULT NULL,
  `pure_weight` float DEFAULT NULL,
  `status` varchar(191) NOT NULL DEFAULT 'Active',
  `tValues` float NOT NULL,
  `barcode` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `manufacturing_step`
--

INSERT INTO `manufacturing_step` (`id`, `vendor_id`, `product_id`, `date`, `image`, `details`, `type`, `quantity`, `purity`, `purity_text`, `unpolish_weight`, `polish_weight`, `rate`, `wastage`, `unpure_weight`, `pure_weight`, `status`, `tValues`, `barcode`) VALUES
(106, 'RF001', 'RF0010001', '2023-10-02', 'external-work-directory/images//1696290008-', '', 'Repairing', 23, '7', '21k', 31, 27, 7, 2.26, NULL, NULL, 'Active', 29.1, '150879056225'),
(107, 'AW004', 'AW0040002', '2023-10-03', 'external-work-directory/images//1697300948-', '', 'Ring', 2, '7', '18k', 28, 25, 6, 1.75, NULL, NULL, 'Active', 22.31, ''),
(108, 'RF001', 'RF0010003', '2023-10-03', 'external-work-directory/images//1696375858-', '', 'Polish paid', 23, '7', '21k', 33, 31, 7, 2.41, NULL, NULL, 'Active', 30.98, '20536064306'),
(109, 'IM003', 'IM0030004', '2023-10-03', 'external-work-directory/images//1696365818-', '', 'Order', 10, '6', '18k', 100, 26, 6, 6.25, NULL, NULL, 'Active', 79.69, '37364173284'),
(110, 'AW004', 'AW0040005', '2023-10-14', 'external-work-directory/images//1697300978-', '', 'Repairing', 11, '6', '22k', 5, 10, 6, 0.31, NULL, NULL, 'Active', 4.86, '608123666083'),
(111, 'AC005', 'AC0050006', '2023-10-14', 'external-work-directory/images//1697303524-', '', 'Ring', 1, '7', '21k', 250, 250, 7, 18.23, NULL, NULL, 'Active', 234.7, '86928375377'),
(112, 'WM002', 'WM0020007', '2023-10-18', 'external-work-directory/images//1697649720-', '', 'Repairing', 8, '6', '22k', 50, 100, 6, 3.13, NULL, NULL, 'Active', 48.67, '146148969672');

-- --------------------------------------------------------

--
-- Table structure for table `metal`
--

CREATE TABLE `metal` (
  `id` int NOT NULL,
  `date` varchar(255) NOT NULL,
  `vendor_id` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `details` varchar(255) NOT NULL,
  `issued_weight` float NOT NULL,
  `purity` float NOT NULL,
  `pure_weight` float NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `metal`
--

INSERT INTO `metal` (`id`, `date`, `vendor_id`, `type`, `details`, `issued_weight`, `purity`, `pure_weight`, `status`) VALUES
(30, '2023-10-14', 'AW004', 'issued', '', 100, 1, 100, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `polisher_step`
--

CREATE TABLE `polisher_step` (
  `id` int NOT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `product_id` varchar(191) DEFAULT NULL,
  `vendor_id` varchar(255) DEFAULT NULL,
  `image` text,
  `details` text,
  `difference` float DEFAULT NULL,
  `rate` float NOT NULL,
  `Wastage` float DEFAULT NULL,
  `Payable` float DEFAULT NULL,
  `status` varchar(191) NOT NULL DEFAULT 'Active',
  `polisherbarcode` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `polisher_step`
--

INSERT INTO `polisher_step` (`id`, `date`, `product_id`, `vendor_id`, `image`, `details`, `difference`, `rate`, `Wastage`, `Payable`, `status`, `polisherbarcode`) VALUES
(46, '2023-10-01 19:00:00', 'RF0010001', 'R006', 'external-work-directory/images/1696290043-', 'Nothing', 4, 1, 0.32, 3.68, 'Active', '270530890683'),
(47, '2023-10-02 19:00:00', 'AW0040002', 'H007', 'external-work-directory/images/1696375215-', '', 2, 1, 0.29, 1.71, 'Active', '925994549660'),
(48, '2023-10-02 19:00:00', 'RF0010003', 'R006', 'external-work-directory/images/1696375865-', '', 2, 1, 0.34, 1.66, 'Active', '398550419229'),
(49, '2023-10-03 07:00:00', 'IM0030004', 'R006', 'external-work-directory/images/1696365825-', '', 74, 1, 1.04, 72.96, 'Active', '798334808743'),
(50, '2023-10-13 19:00:00', 'AW0040005', 'R006', 'external-work-directory/images/1697300989-', '', -5, 23, -0, -5, 'Active', '801055045112');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `weight` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `weight`, `status`, `date_created`) VALUES
('AC0050006', NULL, NULL, 'SemiFinished', '2023-10-14 17:12:04'),
('AW0040002', NULL, NULL, 'Active', '2023-10-03 23:20:03'),
('AW0040005', NULL, NULL, 'Active', '2023-10-14 16:29:38'),
('IM0030004', NULL, NULL, 'Active', '2023-10-03 20:43:38'),
('RF0010001', NULL, NULL, 'SemiFinished', '2023-10-02 23:40:08'),
('RF0010003', NULL, NULL, 'Active', '2023-10-03 23:30:58'),
('WM0020007', NULL, NULL, 'SemiFinished', '2023-10-18 17:22:00');

-- --------------------------------------------------------

--
-- Table structure for table `purchasing`
--

CREATE TABLE `purchasing` (
  `id` varchar(255) NOT NULL,
  `vendor_id` varchar(255) NOT NULL,
  `total` int NOT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `purchasing`
--

INSERT INTO `purchasing` (`id`, `vendor_id`, `total`, `date`, `status`) VALUES
('existing', 'existing', 0, '2023-09-16 17:17:03', 'active'),
('PI-0002', 'S013', 2600, '2023-10-02 23:42:08', 'Active'),
('PI-0003', 'S013', 700, '2023-10-04 00:09:03', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `purchasing_details`
--

CREATE TABLE `purchasing_details` (
  `id` int NOT NULL,
  `p_id` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `detail` varchar(255) NOT NULL,
  `price_per` varchar(255) NOT NULL,
  `quantity` int NOT NULL,
  `remaining_quantity` int NOT NULL,
  `weight` float NOT NULL,
  `remaining_weight` float NOT NULL,
  `rate` float NOT NULL,
  `total_amount` float NOT NULL,
  `remaining_total_amount` float NOT NULL,
  `barcode` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `purchasing_details`
--

INSERT INTO `purchasing_details` (`id`, `p_id`, `type`, `detail`, `price_per`, `quantity`, `remaining_quantity`, `weight`, `remaining_weight`, `rate`, `total_amount`, `remaining_total_amount`, `barcode`) VALUES
(49, 'PI-0002', 'Zircon', '1.5mm', 'Qty', 1000, 0, 100, 0, 0.9, 900, 0, '1696290083807'),
(50, 'PI-0002', 'Zircon', '1.3mm', 'Qty', 1000, 0, 100, 0, 0.7, 700, 0, '1696290104622'),
(51, 'PI-0002', 'Zircon', '1.8mm', 'Qty', 1000, 0, 100, 0, 1, 1000, 0, '1696290121498'),
(52, 'PI-0003', 'Zircon', '1.7mm', 'Qty', 1000, 0, 100, 0, 0.7, 700, 0, '1696378137618');

-- --------------------------------------------------------

--
-- Table structure for table `returned_item`
--

CREATE TABLE `returned_item` (
  `id` int NOT NULL,
  `code` varchar(255) NOT NULL,
  `vendor_id` varchar(255) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `weight` float NOT NULL,
  `quantity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `returned_item`
--

INSERT INTO `returned_item` (`id`, `code`, `vendor_id`, `product_id`, `price`, `weight`, `quantity`) VALUES
(55, 'zircon', 'ZA010', 'RF0010001', 0, 5, 50),
(57, '3', 'ZA010', 'RF0010003', 0, 21, 21),
(59, 'rw', 'S009', 'AW0040002', 0, 10, 12);

-- --------------------------------------------------------

--
-- Table structure for table `returned_stone_step`
--

CREATE TABLE `returned_stone_step` (
  `id` int NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `vendor_id` varchar(255) NOT NULL,
  `received_weight` float NOT NULL,
  `stone_weight` float NOT NULL,
  `stone_quantity` int NOT NULL,
  `total_weight` float NOT NULL,
  `rate` int NOT NULL,
  `shruded_quantity` float NOT NULL,
  `wastage` float NOT NULL,
  `grand_weight` float NOT NULL,
  `payable` float NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `returned_stone_step`
--

INSERT INTO `returned_stone_step` (`id`, `product_id`, `vendor_id`, `received_weight`, `stone_weight`, `stone_quantity`, `total_weight`, `rate`, `shruded_quantity`, `wastage`, `grand_weight`, `payable`, `date`) VALUES
(33, 'RF0010001', 'ZA010', 30, 5, 50, 35, 0, 10, 0.04, 35.04, 1.96, '2023-10-02 23:56:19'),
(34, 'AW0040002', 'S009', 25, 10, 12, 35, 0, 20, 0, 35, 1, '2023-10-07 17:16:01'),
(35, 'RF0010003', 'ZA010', 51, 21, 21, 72, 0, 31, 0.11, 72.11, -31.11, '2023-10-03 23:31:55'),
(36, 'IM0030004', 'MS008', 20, 0, 0, 20, 0, 5, 0, 20, 26, '2023-10-07 17:17:53'),
(37, 'AW0040005', 'MS008', 100, 20, 10, 110, 0, 5, 1, 111, -76, '2023-10-14 16:31:04');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `id` varchar(255) NOT NULL,
  `p_id` varchar(255) NOT NULL,
  `total` float NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id`, `p_id`, `total`, `date`, `status`) VALUES
('SI-0001', 'PI-0002', 450, '2023-10-02 23:42:54', 'Active'),
('SI-0002', 'PI-0002', 450, '2023-10-02 23:43:42', 'Active'),
('SI-0003', 'PI-0002', 0, '2023-10-02 23:43:58', 'Active'),
('SI-0004', 'existing', 1200, '2023-10-03 00:03:31', 'Active'),
('SI-0005', 'PI-0003', 175, '2023-10-04 00:09:51', 'Active'),
('SI-0006', 'PI-0003', 490, '2023-10-04 00:10:23', 'Active'),
('SI-0007', 'PI-0003', 35, '2023-10-04 00:10:49', 'Active'),
('SI-0008', 'existing', 100, '2023-10-14 16:02:17', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `stock_details`
--

CREATE TABLE `stock_details` (
  `id` int NOT NULL,
  `s_id` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `detail` varchar(255) NOT NULL,
  `price_per` varchar(255) NOT NULL,
  `quantity` int NOT NULL,
  `weight` float NOT NULL,
  `rate` float NOT NULL,
  `total_amount` float NOT NULL,
  `barcode` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `stock_details`
--

INSERT INTO `stock_details` (`id`, `s_id`, `type`, `detail`, `price_per`, `quantity`, `weight`, `rate`, `total_amount`, `barcode`) VALUES
(88, 'SI-0001', 'Zircon', '1.5mm', 'Qty', 495, 40, 0.9, 450, 1696290083807),
(89, 'SI-0001', 'Zircon', '1.3mm', 'Qty', 398, 10, 0.7, 350, 1696290104622),
(90, 'SI-0002', 'Zircon', '1.5mm', 'Qty', 500, 50, 0.9, 450, 1696290083807),
(91, 'SI-0002', 'Zircon', '1.3mm', 'Qty', 500, 50, 0.7, 350, 1696290104622),
(92, 'SI-0002', 'Zircon', '1.8mm', 'Qty', 760, 60, 1, 900, 1696290121498),
(93, 'SI-0003', 'Zircon', '1.8mm', 'Qty', 100, 10, 1, 100, 1696290121498),
(94, 'SI-0004', 'Zircon', '2.0mm', 'Qty', 980, 90, 1.2, 1200, 1696291376987),
(95, 'SI-0005', 'Zircon', '1.7mm', 'Qty', 250, 25, 0.7, 175, 1696378137618),
(96, 'SI-0006', 'Zircon', '1.7mm', 'Qty', 700, 70, 0.7, 490, 1696378137618),
(97, 'SI-0007', 'Zircon', '1.7mm', 'Qty', 50, 5, 0.7, 35, 1696378137618),
(98, 'SI-0008', 'gold', 'asda', 'Qty', 10, 4, 10, 100, 1697299321795);

-- --------------------------------------------------------

--
-- Table structure for table `stone`
--

CREATE TABLE `stone` (
  `id` int NOT NULL,
  `code` varchar(255) NOT NULL,
  `vendor_id` varchar(255) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `weight` float NOT NULL,
  `quantity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `stone`
--

INSERT INTO `stone` (`id`, `code`, `vendor_id`, `product_id`, `price`, `weight`, `quantity`) VALUES
(125, '1696290104622', 'MS008', 'IM0030004', 0, 20, 1),
(126, '1696290121498', 'MS008', 'AW0040005', 0, 20, 40);

-- --------------------------------------------------------

--
-- Table structure for table `stone_setter_step`
--

CREATE TABLE `stone_setter_step` (
  `Ssid` int NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `vendor_id` varchar(255) DEFAULT NULL,
  `image` text,
  `detail` varchar(200) DEFAULT NULL,
  `retained_weight` float NOT NULL,
  `total_weight` float NOT NULL,
  `Issued_weight` float DEFAULT NULL,
  `z_total_weight` float DEFAULT NULL,
  `z_total_quantity` int DEFAULT NULL,
  `s_total_weight` float DEFAULT NULL,
  `s_total_quantity` int DEFAULT NULL,
  `grand_weight` float NOT NULL,
  `status` varchar(191) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `stone_setter_step`
--

INSERT INTO `stone_setter_step` (`Ssid`, `product_id`, `date`, `vendor_id`, `image`, `detail`, `retained_weight`, `total_weight`, `Issued_weight`, `z_total_weight`, `z_total_quantity`, `s_total_weight`, `s_total_quantity`, `grand_weight`, `status`) VALUES
(72, 'RF0010001', '2023-10-01 19:00:00', 'ZA010', '', '', 0, 27, 27, 10, 100, 0, 0, 37, 'Active'),
(73, 'AW0040002', '2023-10-02 19:00:00', 'S009', '', '', 0, 26, 26, 10, 100, 0, 0, 36, 'Active'),
(74, 'RF0010003', '2023-10-02 19:00:00', 'ZA010', '', '', 0, 31, 31, 10, 20, 0, 0, 41, 'Active'),
(75, 'IM0030004', '2023-10-03 07:00:00', 'MS008', '', '', 10, 26, 16, 10, 1, 20, 1, 46, 'Active'),
(76, 'AW0040005', '2023-10-13 19:00:00', 'MS008', '', '', 5, 10, 5, 10, 5, 20, 40, 35, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int NOT NULL,
  `UserName` varchar(255) DEFAULT NULL,
  `UserEmail` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `UserLogInDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UserLogOutDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Token` varchar(255) DEFAULT NULL,
  `UserStatus` varchar(45) DEFAULT 'Active',
  `AddedBy` varchar(100) DEFAULT NULL,
  `Date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `UserName`, `UserEmail`, `Password`, `UserLogInDate`, `UserLogOutDate`, `Token`, `UserStatus`, `AddedBy`, `Date`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$vC41AOMLc.nfBlZFOwukkuN/44tpQIlIjnGdRMMOVdlzOTf5fT5zq', '2022-09-26 05:31:11', '2022-09-26 05:31:11', '754bcf4b23f6b6f887e30182f22ac0b7bd577256d26e7e744546ac8403ee855a3aa236909dd98571731913e85f8dd1b1e7c9', 'Active', NULL, '2020-09-24 12:53:37'),
(8, 'faisal', 'faisal@yahoo.com', '$2y$10$vC41AOMLc.nfBlZFOwukkuN/44tpQIlIjnGdRMMOVdlzOTf5fT5zq', '2022-10-15 07:36:32', '2022-10-15 07:36:32', 'c46cfab94d3716025904f1d56a5c94675caa51b576509f68f585ad72604487e624705aa5f152d76225351d4a1c9b6b3c42de', 'Active', NULL, '2022-10-15 07:36:32'),
(9, 'masood', 'masood@gmail.com', '$2y$10$eUxlPA542YDKdrxQby0DteriQYPv70waERO0LFLtPJ/c5K7JkWoTG', '2022-10-29 16:26:33', '2022-10-29 16:26:33', '8f12620ae6e8851c8bfa5f2075b84e8f05ddef1a11551d44341c38980accbc60dafe6dd8f91ce90b6c7f1592eaa787f09bdf', 'Active', NULL, '2022-10-29 16:26:33');

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `id` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `18k` float NOT NULL,
  `21k` float NOT NULL,
  `22k` float NOT NULL,
  `status` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`id`, `type`, `name`, `18k`, `21k`, `22k`, `status`, `date`) VALUES
('AC005', 'manufacturer', 'Ayaz Challa', 7, 7, 7, 'Active', '2023-09-16'),
('AG014', 'vendor', 'AQ Gems', 0, 0, 0, 'Active', '2023-09-16'),
('AW004', 'manufacturer', 'Asim Wasim', 6, 6, 6, 'Active', '2023-09-16'),
('existing', 'existing', 'existing', 0, 0, 0, 'inactive', ''),
('H007', 'polisher', 'Hanif', 1, 1, 1, 'Active', '2023-09-16'),
('HK015', 'vendor', 'Haji Kareem', 0, 0, 0, 'Active', '2023-09-16'),
('IM003', 'manufacturer', 'Imran Mamo', 6, 6, 6, 'Active', '2023-09-16'),
('MH011', 'stone setter', 'Muhammad Hamza', 0.35, 0.35, 0.35, 'Active', '2023-09-16'),
('MS008', 'stone setter', 'Muhammad Siraj', 0.35, 0.35, 0.35, 'Active', '2023-09-16'),
('R006', 'polisher', 'Rafiq', 1, 1, 1, 'Active', '2023-09-16'),
('RF001', 'manufacturer', 'Raees Fancy', 7, 7, 7, 'Active', '2023-09-16'),
('S009', 'stone setter', 'Surfraz', 0.35, 0.35, 0.35, 'Active', '2023-09-16'),
('S013', 'vendor', 'Sharafat', 0, 0, 0, 'Active', '2023-09-16'),
('SS012', 'vendor', 'Saleem Shastri', 0, 0, 0, 'Active', '2023-09-16'),
('WM002', 'manufacturer', 'Waqas Mehmood', 6, 6, 6, 'Active', '2023-09-16'),
('ZA010', 'stone setter', 'Zaki Abbasi', 0.35, 0.35, 0.35, 'Active', '2023-09-16');

-- --------------------------------------------------------

--
-- Table structure for table `zircon`
--

CREATE TABLE `zircon` (
  `id` int NOT NULL,
  `code` varchar(255) NOT NULL,
  `vendor_id` varchar(255) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `weight` float NOT NULL,
  `price` float NOT NULL,
  `quantity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `zircon`
--

INSERT INTO `zircon` (`id`, `code`, `vendor_id`, `product_id`, `weight`, `price`, `quantity`) VALUES
(182, '1696290104622', 'ZA010', 'RF0010001', 10, 0, 100),
(183, '1696290121498', 'S009', 'AW0040002', 10, 0, 100),
(184, '1696291376987', 'ZA010', 'RF0010003', 10, 0, 20),
(185, '1696290104622', 'MS008', 'IM0030004', 10, 0, 1),
(186, '1696290083807', 'MS008', 'AW0040005', 10, 0, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `additional_step`
--
ALTER TABLE `additional_step`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `vendor_id` (`vendor_id`);

--
-- Indexes for table `buyer`
--
ALTER TABLE `buyer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cash`
--
ALTER TABLE `cash`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vendor_id` (`vendor_id`);

--
-- Indexes for table `m2_cash`
--
ALTER TABLE `m2_cash`
  ADD PRIMARY KEY (`id`),
  ADD KEY `buyer_id` (`buyer_id`);

--
-- Indexes for table `m2_gold`
--
ALTER TABLE `m2_gold`
  ADD PRIMARY KEY (`id`),
  ADD KEY `buyer_id` (`buyer_id`);

--
-- Indexes for table `manufacturing_step`
--
ALTER TABLE `manufacturing_step`
  ADD PRIMARY KEY (`id`),
  ADD KEY `manufacturing_step_ibfk_1` (`vendor_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `metal`
--
ALTER TABLE `metal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vendor_id` (`vendor_id`);

--
-- Indexes for table `polisher_step`
--
ALTER TABLE `polisher_step`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vendor_id` (`vendor_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchasing`
--
ALTER TABLE `purchasing`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vendor_id` (`vendor_id`);

--
-- Indexes for table `purchasing_details`
--
ALTER TABLE `purchasing_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `returned_item`
--
ALTER TABLE `returned_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `vendor_id` (`vendor_id`);

--
-- Indexes for table `returned_stone_step`
--
ALTER TABLE `returned_stone_step`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `vendor_id` (`vendor_id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`),
  ADD KEY `p_id` (`p_id`);

--
-- Indexes for table `stock_details`
--
ALTER TABLE `stock_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `s_id` (`s_id`);

--
-- Indexes for table `stone`
--
ALTER TABLE `stone`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `vendor_id` (`vendor_id`);

--
-- Indexes for table `stone_setter_step`
--
ALTER TABLE `stone_setter_step`
  ADD PRIMARY KEY (`Ssid`),
  ADD KEY `vendor_id` (`vendor_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `UserName` (`UserName`),
  ADD UNIQUE KEY `UserEmail` (`UserEmail`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zircon`
--
ALTER TABLE `zircon`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `vendor_id` (`vendor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `additional_step`
--
ALTER TABLE `additional_step`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `cash`
--
ALTER TABLE `cash`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `m2_cash`
--
ALTER TABLE `m2_cash`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `m2_gold`
--
ALTER TABLE `m2_gold`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `manufacturing_step`
--
ALTER TABLE `manufacturing_step`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `metal`
--
ALTER TABLE `metal`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `polisher_step`
--
ALTER TABLE `polisher_step`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `purchasing_details`
--
ALTER TABLE `purchasing_details`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `returned_item`
--
ALTER TABLE `returned_item`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `returned_stone_step`
--
ALTER TABLE `returned_stone_step`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `stock_details`
--
ALTER TABLE `stock_details`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `stone`
--
ALTER TABLE `stone`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT for table `stone_setter_step`
--
ALTER TABLE `stone_setter_step`
  MODIFY `Ssid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `zircon`
--
ALTER TABLE `zircon`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=187;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `additional_step`
--
ALTER TABLE `additional_step`
  ADD CONSTRAINT `additional_step_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `additional_step_ibfk_2` FOREIGN KEY (`vendor_id`) REFERENCES `vendor` (`id`);

--
-- Constraints for table `cash`
--
ALTER TABLE `cash`
  ADD CONSTRAINT `cash_ibfk_1` FOREIGN KEY (`vendor_id`) REFERENCES `vendor` (`id`);

--
-- Constraints for table `m2_cash`
--
ALTER TABLE `m2_cash`
  ADD CONSTRAINT `m2_cash_ibfk_1` FOREIGN KEY (`buyer_id`) REFERENCES `buyer` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `m2_gold`
--
ALTER TABLE `m2_gold`
  ADD CONSTRAINT `m2_gold_ibfk_1` FOREIGN KEY (`buyer_id`) REFERENCES `buyer` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `manufacturing_step`
--
ALTER TABLE `manufacturing_step`
  ADD CONSTRAINT `manufacturing_step_ibfk_1` FOREIGN KEY (`vendor_id`) REFERENCES `vendor` (`id`),
  ADD CONSTRAINT `manufacturing_step_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Constraints for table `metal`
--
ALTER TABLE `metal`
  ADD CONSTRAINT `metal_ibfk_1` FOREIGN KEY (`vendor_id`) REFERENCES `vendor` (`id`);

--
-- Constraints for table `polisher_step`
--
ALTER TABLE `polisher_step`
  ADD CONSTRAINT `polisher_step_ibfk_1` FOREIGN KEY (`vendor_id`) REFERENCES `vendor` (`id`),
  ADD CONSTRAINT `polisher_step_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Constraints for table `purchasing`
--
ALTER TABLE `purchasing`
  ADD CONSTRAINT `purchasing_ibfk_1` FOREIGN KEY (`vendor_id`) REFERENCES `vendor` (`id`);

--
-- Constraints for table `returned_item`
--
ALTER TABLE `returned_item`
  ADD CONSTRAINT `returned_item_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `returned_item_ibfk_2` FOREIGN KEY (`vendor_id`) REFERENCES `vendor` (`id`);

--
-- Constraints for table `returned_stone_step`
--
ALTER TABLE `returned_stone_step`
  ADD CONSTRAINT `returned_stone_step_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `returned_stone_step_ibfk_2` FOREIGN KEY (`vendor_id`) REFERENCES `vendor` (`id`);

--
-- Constraints for table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`p_id`) REFERENCES `purchasing` (`id`);

--
-- Constraints for table `stock_details`
--
ALTER TABLE `stock_details`
  ADD CONSTRAINT `stock_details_ibfk_1` FOREIGN KEY (`s_id`) REFERENCES `stock` (`id`);

--
-- Constraints for table `stone`
--
ALTER TABLE `stone`
  ADD CONSTRAINT `stone_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `stone_ibfk_2` FOREIGN KEY (`vendor_id`) REFERENCES `vendor` (`id`);

--
-- Constraints for table `stone_setter_step`
--
ALTER TABLE `stone_setter_step`
  ADD CONSTRAINT `stone_setter_step_ibfk_1` FOREIGN KEY (`vendor_id`) REFERENCES `vendor` (`id`),
  ADD CONSTRAINT `stone_setter_step_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Constraints for table `zircon`
--
ALTER TABLE `zircon`
  ADD CONSTRAINT `zircon_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `zircon_ibfk_2` FOREIGN KEY (`vendor_id`) REFERENCES `vendor` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
