-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 02, 2023 at 07:59 PM
-- Server version: 8.0.30
-- PHP Version: 7.4.1

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
(24, 'R0020008', 'H012', 'Color Stones', '250', '2023-06-21', 'Active'),
(25, 'R0020008', 'NL016', 'Sapphire', '270', '2023-06-21', 'Active'),
(26, 'R0020008', 'AG015', 'Color Stones', '300', '2023-06-21', 'Active');

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

--
-- Dumping data for table `cash`
--

INSERT INTO `cash` (`id`, `date`, `vendor_id`, `type`, `amount`, `details`, `status`) VALUES
(1, '2023-06-20', 'I003', 'issued', 120, '123', 'Inactive'),
(2, '2023-06-20', 'I003', 'recieved', 250, '123', 'Inactive'),
(3, '2023-06-20', 'H012', 'issued', 223, '3123', 'Active');

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
(89, 'A004', 'A0040001', '2023-06-12', 'external-work-directory/images//1686590166-', '', 'Select Type', 17, '7.5', '', 15, 15, 8, 1.17, NULL, NULL, 'Inactive', 12.13, '467034126285'),
(90, 'A004', 'A0040002', '2023-06-12', 'external-work-directory/images//1686590229-', '', 'Ring', 17, '7.5', '', 155.77, 155.77, 8, 12.17, NULL, NULL, 'Active', 125.95, '601005158528'),
(91, 'R002', 'R0020003', '2023-06-12', 'external-work-directory/images//1686590343-', '', 'Tops', 12, '8.5', '', 219.19, 217.16, 9, 19.41, NULL, NULL, 'Active', 178.95, '584767710233'),
(92, 'W001', 'W0010004', '2023-06-12', 'external-work-directory/images//1686590430-', '', 'Kara', 1, '6', '', 82.25, 82.25, 6, 5.14, NULL, NULL, 'Active', 76.47, '506594778317'),
(94, 'W001', 'W0010006', '2023-06-15', 'external-work-directory/images//1686849497-', '', 'Select Type', 2, '6', '22k', 21, 21, 6, 1.31, NULL, NULL, 'Active', 20.44, '571153590262'),
(96, 'R002', 'R0020008', '2023-06-20', 'external-work-directory/images//1687274158-', '', 'Repairing', 1, '8.5', '22k', 1.2, 1.5, 9, 0.11, NULL, NULL, 'Active', 0.98, '148524478677');

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
(22, '2023-06-20', 'A019', 'issued', '', 21.333, 0.999, 21.31, 'Active'),
(23, '2023-06-20', 'H006', 'recieved', '', 21, 0.999, 20.98, 'Active');

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
(43, '2023-06-11 19:00:00', 'R0020003', 'R005', 'external-work-directory/images/1686590366-', '', 2.03, 1, 2.28, -0.25, 'Active', '127671018517');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `status`) VALUES
('A0040001', 'Inactive'),
('A0040002', 'Active'),
('R0020003', 'Active'),
('R0020007', 'Active'),
('R0020008', 'Active'),
('W0010004', 'Active'),
('W0010005', 'Active'),
('W0010006', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `purchasing`
--

CREATE TABLE `purchasing` (
  `id` varchar(255) NOT NULL,
  `vendor_id` varchar(255) NOT NULL,
  `total` int NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `purchasing`
--

INSERT INTO `purchasing` (`id`, `vendor_id`, `total`, `date`, `status`) VALUES
('existing', 'existing', 0, '2023-07-20 16:25:24', ''),
('PI-0001', 'H012', 4, '2023-07-03 15:36:16', 'Inactive');

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
(38, 'PI-0001', 'Zircon', '12', 'Qty', 2, 2, 2, 2, 2, 4, 4, '');

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
('SI-0001', 'existing', 780, '2023-07-20 16:25:51', 'Active');

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
  `barcode` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `stock_details`
--

INSERT INTO `stock_details` (`id`, `s_id`, `type`, `detail`, `price_per`, `quantity`, `weight`, `rate`, `total_amount`, `barcode`) VALUES
(60, 'SI-0001', 'Zircon', 'Ruby', 'K', 1, 12, 13, 780, 2147483647);

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
(121, '', 'S008', 'W0010004', 0, 0, 0),
(122, '', 'S008', 'A0040002', 0, 0, 0),
(123, '', 'S009', 'A0040002', 0, 0, 0);

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
  `z_total_price` float NOT NULL,
  `z_total_weight` float NOT NULL,
  `z_total_quantity` int NOT NULL,
  `s_total_price` float NOT NULL,
  `s_total_weight` float NOT NULL,
  `s_total_quantity` int NOT NULL,
  `grand_weight` float NOT NULL,
  `grand_total` float NOT NULL,
  `status` varchar(191) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `stone_setter_step`
--

INSERT INTO `stone_setter_step` (`Ssid`, `product_id`, `date`, `vendor_id`, `image`, `detail`, `retained_weight`, `total_weight`, `Issued_weight`, `z_total_price`, `z_total_weight`, `z_total_quantity`, `s_total_price`, `s_total_weight`, `s_total_quantity`, `grand_weight`, `grand_total`, `status`) VALUES
(61, 'W0010004', '2023-06-11 19:00:00', 'S008', '', '', 0, 82.25, 82, 0, 6.9, 266, 0, 0, 0, 88.9, 0, 'Active'),
(62, 'A0040002', '2023-06-11 19:00:00', 'S008', '', '', 105, 155.77, 50, 0, 5.39, 435, 0, 0, 0, 55.39, 0, 'Active'),
(63, 'A0040002', '2023-06-11 19:00:00', 'S009', '', '', 0, 105, 105, 0, 2, 200, 0, 0, 0, 107, 0, 'Active');

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
('A004', 'manufacturer', 'AyazChalla', 13, 7.5, 8.5, 'Active', '2023-06-12'),
('A014', 'vendor', 'Admin', 0, 0, 0, 'Inactive', '2023-06-12'),
('A019', 'manufacturer', 'AmirKhalil', 12, 6.5, 6.5, 'Active', '2023-06-12'),
('AG015', 'vendor', 'AQ Gems', 0, 0, 0, 'Active', '2023-06-12'),
('B013', 'vendor', 'Best', 0, 0, 0, 'Inactive', '2023-06-12'),
('existing', 'existing', 'existing', 0, 0, 0, '', ''),
('H006', 'polisher', 'Hanif', 1, 1, 1, 'Active', '2023-06-12'),
('H011', 'stone setter', 'Hamza', 0.35, 0.35, 0.35, 'Active', '2023-06-12'),
('H012', 'vendor', 'Sharafat Bhai', 0, 0, 0, 'Active', '2023-06-12'),
('I003', 'manufacturer', 'ImranMamu', 12, 6, 6, 'Active', '2023-06-12'),
('IL018', 'vendor', 'Imran Lacquer', 0, 0, 0, 'Active', '2023-06-12'),
('NL016', 'vendor', 'Naveed Lacquer', 0, 0, 0, 'Active', '2023-06-12'),
('R002', 'manufacturer', 'RaeesFancy', 12, 8.5, 8.5, 'Active', '2023-06-12'),
('R005', 'polisher', 'Rafiq', 1, 1, 1, 'Active', '2023-06-12'),
('R007', 'polisher', 'RafiqCompound', 1, 1, 1, 'Active', '2023-06-12'),
('S008', 'stone setter', 'Sarfaraz', 0.35, 0.35, 0.35, 'Active', '2023-06-12'),
('S009', 'stone setter', 'Siraj', 0.35, 0.35, 0.35, 'Active', '2023-06-12'),
('SG017', 'vendor', 'Shakeeb Gems', 0, 0, 0, 'Active', '2023-06-12'),
('W001', 'manufacturer', 'Waqas', 12, 6, 6, 'Active', '2023-06-12'),
('Z010', 'stone setter', 'Zaki', 0.35, 0.35, 0.35, 'Active', '2023-06-12');

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
(149, 'Round 2mm', 'S008', 'W0010004', 6.9, 0, 266),
(150, 'Round 1.5mm Packet', 'S008', 'A0040002', 4.5, 0, 400),
(151, 'Round 2mm', 'S008', 'A0040002', 0.89, 0, 35),
(152, 'Round 2mm', 'S009', 'A0040002', 2, 0, 200);

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
-- Indexes for table `cash`
--
ALTER TABLE `cash`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vendor_id` (`vendor_id`);

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `cash`
--
ALTER TABLE `cash`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `manufacturing_step`
--
ALTER TABLE `manufacturing_step`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `metal`
--
ALTER TABLE `metal`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `polisher_step`
--
ALTER TABLE `polisher_step`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `purchasing_details`
--
ALTER TABLE `purchasing_details`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `returned_item`
--
ALTER TABLE `returned_item`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `returned_stone_step`
--
ALTER TABLE `returned_stone_step`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `stock_details`
--
ALTER TABLE `stock_details`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `stone`
--
ALTER TABLE `stone`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `stone_setter_step`
--
ALTER TABLE `stone_setter_step`
  MODIFY `Ssid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `zircon`
--
ALTER TABLE `zircon`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

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
