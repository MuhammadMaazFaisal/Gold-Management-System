-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 01, 2023 at 04:02 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

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
  `id` int(11) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `vendor_id` varchar(255) NOT NULL,
  `type` varchar(191) DEFAULT NULL,
  `amount` varchar(191) DEFAULT NULL,
  `date` varchar(255) NOT NULL,
  `status` varchar(191) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `additional_step`
--

INSERT INTO `additional_step` (`id`, `product_id`, `vendor_id`, `type`, `amount`, `date`, `status`) VALUES
(24, 'R0020008', 'H012', 'Color Stones', '250', '2023-06-21', 'Active'),
(25, 'R0020008', 'NL016', 'Sapphire', '270', '2023-06-21', 'Active'),
(26, 'R0020008', 'AG015', 'Color Stones', '300', '2023-06-21', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `articlecomplexityparameters`
--

CREATE TABLE `articlecomplexityparameters` (
  `ArticleComplexityParameterID` int(11) NOT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `ComplexityParameterID` int(11) NOT NULL,
  `ArticleProcessingID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `articlefigurerecord`
--

CREATE TABLE `articlefigurerecord` (
  `ArticleFigureRecordID` int(11) NOT NULL,
  `FigurePath` varchar(245) DEFAULT NULL,
  `FigureName` varchar(45) DEFAULT NULL,
  `FigureDate` timestamp NULL DEFAULT current_timestamp(),
  `ArticleProcessingID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `articleprocessdetails`
--

CREATE TABLE `articleprocessdetails` (
  `ArticleProcessDetailID` int(11) NOT NULL,
  `ArticleProcessingDetailDate` timestamp NULL DEFAULT current_timestamp(),
  `ArticleProcessingID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `articleprocessing`
--

CREATE TABLE `articleprocessing` (
  `ArticleProcessingID` int(11) NOT NULL,
  `ArticleProcessingIndicator` varchar(45) DEFAULT NULL,
  `ArticleProcessingStatus` varchar(45) DEFAULT NULL COMMENT 'InProgress, Completed, Rejected',
  `ArticleProcessingDate` timestamp NULL DEFAULT current_timestamp(),
  `UserAssignedArticleID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `articleprocessingscores`
--

CREATE TABLE `articleprocessingscores` (
  `ArticleProcessingScoreID` int(11) NOT NULL,
  `ApplicableScore` int(11) DEFAULT NULL,
  `TotalQuantity` int(11) DEFAULT NULL,
  `ScoreSummary` varchar(45) DEFAULT NULL,
  `ArticleProcessingID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `articlereferenceextractions`
--

CREATE TABLE `articlereferenceextractions` (
  `ArticleProcessingID` int(11) NOT NULL,
  `ReferenceFileName` varchar(45) DEFAULT NULL,
  `ReferenceFileDate` timestamp NULL DEFAULT current_timestamp(),
  `UserID` int(11) NOT NULL,
  `ArticleID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `ArticleID` int(11) NOT NULL,
  `ArticleTitle` varchar(45) DEFAULT NULL,
  `ArticleCode` varchar(50) DEFAULT NULL COMMENT 'Example: CMC-29-42-6335',
  `ArticleJMSCode` varchar(50) DEFAULT NULL COMMENT 'Example: BMS-THAN-2022-HT1-4064-1',
  `ArticleAuthors` varchar(45) DEFAULT NULL,
  `ArticleKeywords` varchar(255) DEFAULT NULL,
  `ArticleDOI` varchar(45) DEFAULT NULL,
  `ArticleProcessingType` varchar(15) NOT NULL DEFAULT 'published' COMMENT 'published, accepted',
  `ArticleType` varchar(45) DEFAULT NULL,
  `ArticleLastPage` varchar(45) DEFAULT NULL,
  `ArticleFirstPage` varchar(45) DEFAULT NULL,
  `Elocator` varchar(45) DEFAULT NULL,
  `ArticleIssue` int(11) NOT NULL,
  `ArticleVolume` int(11) NOT NULL,
  `ArticleYear` int(11) NOT NULL,
  `ArticleAbstract` varchar(1000) DEFAULT NULL,
  `EPubDate` timestamp NULL DEFAULT current_timestamp(),
  `JournalID` int(11) NOT NULL,
  `AddedBy` int(11) NOT NULL,
  `Status` varchar(20) NOT NULL DEFAULT 'Active' COMMENT 'Active,Archive',
  `Date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `articlesfilesrecord`
--

CREATE TABLE `articlesfilesrecord` (
  `ArticlesFilesRecordID` int(11) NOT NULL,
  `FileType` varchar(45) DEFAULT NULL COMMENT 'PDF, Word, XML Converted, XML Valid, EPUB, HTML',
  `Quantity` varchar(45) DEFAULT NULL,
  `FileName` varchar(50) DEFAULT NULL,
  `FilePath` varchar(300) DEFAULT NULL,
  `ArticleID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `assignmenttypes`
--

CREATE TABLE `assignmenttypes` (
  `AssignmentTypeID` int(11) NOT NULL,
  `AssignmentTypeName` varchar(45) DEFAULT NULL,
  `AssignmentTypeCode` varchar(15) NOT NULL,
  `AddedBy` int(11) NOT NULL,
  `Date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cash`
--

CREATE TABLE `cash` (
  `id` int(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `vendor_id` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `amount` float NOT NULL,
  `details` text NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cash`
--

INSERT INTO `cash` (`id`, `date`, `vendor_id`, `type`, `amount`, `details`, `status`) VALUES
(1, '2023-06-20', 'I003', 'issued', 120, '123', 'Inactive'),
(2, '2023-06-20', 'I003', 'recieved', 250, '123', 'Inactive'),
(3, '2023-06-20', 'H012', 'issued', 223, '3123', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `cashaccount`
--

CREATE TABLE `cashaccount` (
  `caID` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `name` varchar(45) DEFAULT NULL,
  `amount` varchar(300) DEFAULT NULL,
  `AddedBy` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `cashaccount`
--

INSERT INTO `cashaccount` (`caID`, `date`, `name`, `amount`, `AddedBy`) VALUES
(2, '2023-02-10 19:00:00', 'Ali', '6000', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `complexityparameters`
--

CREATE TABLE `complexityparameters` (
  `ComplexityParameterID` int(11) NOT NULL,
  `ComplexityParameterName` varchar(45) DEFAULT NULL,
  `ComplexityParameterScore` int(11) DEFAULT NULL,
  `ComplexityParameterStatus` varchar(45) DEFAULT 'Active',
  `ComplexityParameterDate` datetime DEFAULT current_timestamp(),
  `AddedBy` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `externalworkstepone`
--

CREATE TABLE `externalworkstepone` (
  `id` int(11) NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `image` text DEFAULT NULL,
  `code` varchar(191) DEFAULT NULL,
  `type` varchar(191) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `p_value` float DEFAULT NULL,
  `up_email` int(11) DEFAULT NULL,
  `p_email` int(11) DEFAULT NULL,
  `r_flow` int(11) DEFAULT NULL,
  `wtg_value` int(11) DEFAULT NULL,
  `t_value` int(11) DEFAULT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `status` varchar(191) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `externalworkstepone`
--

INSERT INTO `externalworkstepone` (`id`, `name`, `image`, `code`, `type`, `quantity`, `p_value`, `up_email`, `p_email`, `r_flow`, `wtg_value`, `t_value`, `date`, `status`) VALUES
(2, 'AED', 'external-work-directory/images/1666931375-image.png', 'aza', 'qq', 2, 0.75, 33, 3, 6, 2, 35, '2022-10-27 19:00:00', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `externalworksteptwo`
--

CREATE TABLE `externalworksteptwo` (
  `id` int(11) NOT NULL,
  `code` varchar(191) DEFAULT NULL,
  `name` varchar(191) DEFAULT NULL,
  `difference` int(11) DEFAULT NULL,
  `po_was` int(11) DEFAULT NULL,
  `ps_email` int(11) DEFAULT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `status` varchar(191) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `externalworksteptwo`
--

INSERT INTO `externalworksteptwo` (`id`, `code`, `name`, `difference`, `po_was`, `ps_email`, `date`, `status`) VALUES
(1, 'aza', 'AED', 30, 0, 30, '2022-10-27 19:00:00', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `goldaccount`
--

CREATE TABLE `goldaccount` (
  `AccID` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `name` varchar(45) DEFAULT NULL,
  `gold_issued` varchar(300) DEFAULT NULL,
  `AddedBy` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `goldaccount`
--

INSERT INTO `goldaccount` (`AccID`, `date`, `name`, `gold_issued`, `AddedBy`) VALUES
(4, '2023-02-11 12:28:11', 'Raees Fancy', '50.16', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `gold_accont_step`
--

CREATE TABLE `gold_accont_step` (
  `id` int(11) NOT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `name` varchar(191) DEFAULT NULL,
  `detail` varchar(200) DEFAULT NULL,
  `gold_Issued_weight` varchar(191) DEFAULT NULL,
  `purity` varchar(191) DEFAULT NULL,
  `pure_weight_issued` varchar(191) DEFAULT NULL,
  `status` varchar(191) NOT NULL DEFAULT 'Active',
  `goldbarcode` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gold_accont_step`
--

INSERT INTO `gold_accont_step` (`id`, `date`, `name`, `detail`, `gold_Issued_weight`, `purity`, `pure_weight_issued`, `status`, `goldbarcode`) VALUES
(2, '2023-02-11 19:00:00', 'Faisal-001', 'System Test', '88', '56', '6.2', 'Active', '454077290702');

-- --------------------------------------------------------

--
-- Table structure for table `issuearticles`
--

CREATE TABLE `issuearticles` (
  `IssueArticleID` int(11) NOT NULL,
  `Date` timestamp NULL DEFAULT current_timestamp(),
  `ArticleID` int(11) NOT NULL,
  `IssueID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `issues`
--

CREATE TABLE `issues` (
  `IssueID` int(11) NOT NULL,
  `Issue` int(11) DEFAULT NULL,
  `Volume` int(11) DEFAULT NULL,
  `Year` int(11) DEFAULT NULL,
  `Date` datetime DEFAULT current_timestamp(),
  `Journals_JournalID` int(11) NOT NULL,
  `AddedBy` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item_list`
--

CREATE TABLE `item_list` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `supplier_id` int(30) NOT NULL,
  `cost` float NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item_list`
--

INSERT INTO `item_list` (`id`, `name`, `description`, `supplier_id`, `cost`, `status`, `date_created`, `date_updated`) VALUES
(1, 'Stone', 'Sample Only', 1, 150, 1, '2021-11-02 10:01:55', '2021-11-02 10:01:55'),
(2, 'Ruby', 'Sample only', 2, 200, 1, '2021-11-02 10:02:12', '2021-11-02 10:02:12');

-- --------------------------------------------------------

--
-- Table structure for table `journals`
--

CREATE TABLE `journals` (
  `JournalID` int(11) NOT NULL,
  `JournalAddedBy` varchar(45) NOT NULL,
  `JournalCode` varchar(45) DEFAULT NULL,
  `JournalTitle` varchar(225) DEFAULT NULL,
  `JournalType` varchar(50) DEFAULT NULL,
  `ISSNOnline` varchar(45) DEFAULT NULL,
  `ISSNPrint` varchar(45) DEFAULT NULL,
  `JournalImpactFactor` varchar(45) DEFAULT NULL,
  `JournalStatus` varchar(45) DEFAULT 'Active',
  `JournalURL` varchar(200) NOT NULL,
  `JournalAimsandScope` varchar(5000) NOT NULL,
  `JournalDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `manufacturing_step`
--

CREATE TABLE `manufacturing_step` (
  `id` int(11) NOT NULL,
  `vendor_id` varchar(255) DEFAULT NULL,
  `product_id` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `image` text DEFAULT NULL,
  `details` text DEFAULT NULL,
  `type` varchar(191) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `purity` varchar(255) DEFAULT NULL,
  `purity_text` varchar(255) NOT NULL,
  `unpolish_weight` float DEFAULT NULL,
  `polish_weight` float DEFAULT NULL,
  `rate` int(11) DEFAULT NULL,
  `wastage` float DEFAULT NULL,
  `unpure_weight` float DEFAULT NULL,
  `pure_weight` float DEFAULT NULL,
  `status` varchar(191) NOT NULL DEFAULT 'Active',
  `tValues` float NOT NULL,
  `barcode` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `id` int(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `vendor_id` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `details` varchar(255) NOT NULL,
  `issued_weight` float NOT NULL,
  `purity` float NOT NULL,
  `pure_weight` float NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `id` int(11) NOT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `product_id` varchar(191) DEFAULT NULL,
  `vendor_id` varchar(255) DEFAULT NULL,
  `image` text DEFAULT NULL,
  `details` text DEFAULT NULL,
  `difference` float DEFAULT NULL,
  `rate` float NOT NULL,
  `Wastage` float DEFAULT NULL,
  `Payable` float DEFAULT NULL,
  `status` varchar(191) NOT NULL DEFAULT 'Active',
  `polisherbarcode` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `polisher_step`
--

INSERT INTO `polisher_step` (`id`, `date`, `product_id`, `vendor_id`, `image`, `details`, `difference`, `rate`, `Wastage`, `Payable`, `status`, `polisherbarcode`) VALUES
(43, '2023-06-11 19:00:00', 'R0020003', 'R005', 'external-work-directory/images/1686590366-', '', 2.03, 1, 2.28, -0.25, 'Active', '127671018517');

-- --------------------------------------------------------

--
-- Table structure for table `po_items`
--

CREATE TABLE `po_items` (
  `po_id` int(30) NOT NULL,
  `item_id` int(30) NOT NULL,
  `quantity` int(30) NOT NULL,
  `price` float NOT NULL DEFAULT 0,
  `unit` varchar(50) NOT NULL,
  `total` float NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `processingstages`
--

CREATE TABLE `processingstages` (
  `ProcessingStageID` int(11) NOT NULL,
  `ProcessingStageName` varchar(45) DEFAULT NULL,
  `ProcessingStageCode` varchar(15) DEFAULT NULL,
  `ProcessingStageDescription` varchar(200) DEFAULT NULL,
  `ScoreCalculationStatus` varchar(45) DEFAULT NULL,
  `ScoreCalculationRationale` varchar(45) DEFAULT NULL,
  `AddedBy` int(11) DEFAULT NULL,
  `Date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Table structure for table `purchase_order_list`
--

CREATE TABLE `purchase_order_list` (
  `id` int(30) NOT NULL,
  `po_code` varchar(50) NOT NULL,
  `supplier_id` int(30) NOT NULL,
  `amount` float NOT NULL,
  `discount_perc` float NOT NULL DEFAULT 0,
  `discount` float NOT NULL DEFAULT 0,
  `tax_perc` float NOT NULL DEFAULT 0,
  `tax` float NOT NULL DEFAULT 0,
  `remarks` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = pending, 1 = partially received, 2 =received',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchase_order_list`
--

INSERT INTO `purchase_order_list` (`id`, `po_code`, `supplier_id`, `amount`, `discount_perc`, `discount`, `tax_perc`, `tax`, `remarks`, `status`, `date_created`, `date_updated`) VALUES
(1, 'PO-0001', 1, 81480, 3, 2250, 12, 8730, 'Sample', 2, '2021-11-03 11:20:22', '2021-11-03 11:21:00'),
(2, 'PO-0002', 2, 107464, 5, 5050, 12, 11514, 'Sample PO Only', 2, '2021-11-03 11:50:50', '2021-11-03 11:52:15');

-- --------------------------------------------------------

--
-- Table structure for table `purchasing`
--

CREATE TABLE `purchasing` (
  `id` varchar(255) NOT NULL,
  `vendor_id` varchar(255) NOT NULL,
  `total` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `id` int(255) NOT NULL,
  `p_id` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `detail` varchar(255) NOT NULL,
  `price_per` varchar(255) NOT NULL,
  `quantity` int(255) NOT NULL,
  `remaining_quantity` int(255) NOT NULL,
  `weight` float NOT NULL,
  `remaining_weight` float NOT NULL,
  `rate` float NOT NULL,
  `total_amount` float NOT NULL,
  `remaining_total_amount` float NOT NULL,
  `barcode` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `id` int(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `vendor_id` varchar(255) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `weight` float NOT NULL,
  `quantity` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `returned_stone_step`
--

CREATE TABLE `returned_stone_step` (
  `id` int(255) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `vendor_id` varchar(255) NOT NULL,
  `received_weight` float NOT NULL,
  `stone_weight` float NOT NULL,
  `stone_quantity` int(255) NOT NULL,
  `total_weight` float NOT NULL,
  `rate` int(255) NOT NULL,
  `shruded_quantity` float NOT NULL,
  `wastage` float NOT NULL,
  `grand_weight` float NOT NULL,
  `payable` float NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roleprocessingstages`
--

CREATE TABLE `roleprocessingstages` (
  `RoleProcessingStageID` int(11) NOT NULL,
  `RoleID` int(11) NOT NULL,
  `ProcessingStageID` int(11) NOT NULL,
  `Date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `RoleID` int(11) NOT NULL,
  `RoleName` varchar(45) DEFAULT NULL,
  `RoleDescription` varchar(300) DEFAULT NULL,
  `Status` varchar(45) DEFAULT 'Active',
  `AddedBy` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`RoleID`, `RoleName`, `RoleDescription`, `Status`, `AddedBy`) VALUES
(1, 'Admin', 'Test', 'Active', NULL),
(2, 'Super Admin', 'Super', 'Active', NULL),
(5, 'Production leads', 'feed data Activity', 'Active', 'henry'),
(6, 'Production Report', 'Production Report', 'Active', 'henry'),
(7, 'View Manufecuring', 'View Manufecuring  Details', 'Active', 'admin'),
(8, 'Account', 'Account Information', 'Active', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `rolesystemactivities`
--

CREATE TABLE `rolesystemactivities` (
  `RoleSystemActivityID` int(11) NOT NULL,
  `RoleID` int(11) NOT NULL,
  `SystemActivityID` int(11) NOT NULL,
  `Date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `rolesystemactivities`
--

INSERT INTO `rolesystemactivities` (`RoleSystemActivityID`, `RoleID`, `SystemActivityID`, `Date`) VALUES
(1, 2, 1, '2022-10-14 15:25:17'),
(3, 2, 4, '2022-10-14 15:35:30'),
(4, 2, 3, '2022-10-14 15:35:30'),
(5, 2, 6, '2022-10-14 15:47:41'),
(6, 2, 5, '2022-10-14 15:47:41'),
(7, 2, 10, '2022-10-14 15:55:33'),
(8, 2, 9, '2022-10-14 15:55:33'),
(9, 2, 8, '2022-10-14 15:55:33'),
(10, 2, 7, '2022-10-14 15:56:48'),
(21, 2, 12, '2022-10-15 16:58:54'),
(24, 5, 18, '2022-10-15 17:23:57'),
(28, 2, 20, '2022-10-15 17:48:09'),
(33, 5, 12, '2022-10-27 11:58:08'),
(34, 5, 16, '2022-10-27 12:00:59'),
(35, 5, 17, '2022-10-27 12:00:59'),
(36, 5, 23, '2022-10-27 12:00:59'),
(39, 2, 23, '2022-10-29 15:37:24'),
(41, 2, 2, '2023-02-08 15:48:01'),
(43, 2, 21, '2023-02-09 09:55:27'),
(44, 2, 16, '2023-02-10 22:25:44'),
(45, 2, 18, '2023-02-10 22:25:44'),
(46, 2, 22, '2023-02-10 23:21:49'),
(47, 2, 17, '2023-02-15 05:58:18');

-- --------------------------------------------------------

--
-- Table structure for table `sechedule_set`
--

CREATE TABLE `sechedule_set` (
  `sechedule_id` int(11) NOT NULL,
  `Product_name` varchar(255) NOT NULL,
  `target_no` varchar(255) NOT NULL,
  `added_by` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sechedule_set`
--

INSERT INTO `sechedule_set` (`sechedule_id`, `Product_name`, `target_no`, `added_by`) VALUES
(2, 'EZTOTE K', '100', 'henry'),
(3, 'EZTOTE Q', '200', 'henry'),
(4, 'EZTOTE F', '150', 'henry');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `id` varchar(255) NOT NULL,
  `p_id` varchar(255) NOT NULL,
  `total` float NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `id` int(255) NOT NULL,
  `s_id` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `detail` varchar(255) NOT NULL,
  `price_per` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `weight` float NOT NULL,
  `rate` float NOT NULL,
  `total_amount` float NOT NULL,
  `barcode` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock_details`
--

INSERT INTO `stock_details` (`id`, `s_id`, `type`, `detail`, `price_per`, `quantity`, `weight`, `rate`, `total_amount`, `barcode`) VALUES
(60, 'SI-0001', 'Zircon', 'Ruby', 'K', 1, 12, 13, 780, 2147483647);

-- --------------------------------------------------------

--
-- Table structure for table `stock_list`
--

CREATE TABLE `stock_list` (
  `id` int(30) NOT NULL,
  `item_id` int(30) NOT NULL,
  `quantity` int(30) NOT NULL,
  `unit` varchar(250) DEFAULT NULL,
  `price` float NOT NULL DEFAULT 0,
  `total` float NOT NULL DEFAULT current_timestamp(),
  `type` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=IN , 2=OUT',
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stone`
--

CREATE TABLE `stone` (
  `id` int(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `vendor_id` varchar(255) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `weight` float NOT NULL,
  `quantity` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stone`
--

INSERT INTO `stone` (`id`, `code`, `vendor_id`, `product_id`, `price`, `weight`, `quantity`) VALUES
(121, '', 'S008', 'W0010004', 0, 0, 0),
(122, '', 'S008', 'A0040002', 0, 0, 0),
(123, '', 'S009', 'A0040002', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `stone_setter_account`
--

CREATE TABLE `stone_setter_account` (
  `ssaID` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `name` varchar(45) DEFAULT NULL,
  `received` varchar(300) DEFAULT NULL,
  `paid` varchar(255) NOT NULL,
  `ssabarcode` varchar(255) NOT NULL,
  `AddedBy` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stone_setter_step`
--

CREATE TABLE `stone_setter_step` (
  `Ssid` int(11) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `vendor_id` varchar(255) DEFAULT NULL,
  `image` text DEFAULT NULL,
  `detail` varchar(200) DEFAULT NULL,
  `retained_weight` float NOT NULL,
  `total_weight` float NOT NULL,
  `Issued_weight` float DEFAULT NULL,
  `z_total_price` float NOT NULL,
  `z_total_weight` float NOT NULL,
  `z_total_quantity` int(255) NOT NULL,
  `s_total_price` float NOT NULL,
  `s_total_weight` float NOT NULL,
  `s_total_quantity` int(255) NOT NULL,
  `grand_weight` float NOT NULL,
  `grand_total` float NOT NULL,
  `status` varchar(191) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stone_setter_step`
--

INSERT INTO `stone_setter_step` (`Ssid`, `product_id`, `date`, `vendor_id`, `image`, `detail`, `retained_weight`, `total_weight`, `Issued_weight`, `z_total_price`, `z_total_weight`, `z_total_quantity`, `s_total_price`, `s_total_weight`, `s_total_quantity`, `grand_weight`, `grand_total`, `status`) VALUES
(61, 'W0010004', '2023-06-11 19:00:00', 'S008', '', '', 0, 82.25, 82, 0, 6.9, 266, 0, 0, 0, 88.9, 0, 'Active'),
(62, 'A0040002', '2023-06-11 19:00:00', 'S008', '', '', 105, 155.77, 50, 0, 5.39, 435, 0, 0, 0, 55.39, 0, 'Active'),
(63, 'A0040002', '2023-06-11 19:00:00', 'S009', '', '', 0, 105, 105, 0, 2, 200, 0, 0, 0, 107, 0, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `supplier_list`
--

CREATE TABLE `supplier_list` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `address` text NOT NULL,
  `cperson` text NOT NULL,
  `contact` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier_list`
--

INSERT INTO `supplier_list` (`id`, `name`, `address`, `cperson`, `contact`, `status`, `date_created`, `date_updated`) VALUES
(1, 'Supplier 101', 'Sample Supplier Address 101', 'Supplier Staff 101', '09123456789', 1, '2021-11-02 09:36:19', '2021-11-02 09:36:19'),
(2, 'Supplier 102', 'Sample Address 102', 'Supplier Staff 102', '0987654332', 1, '2021-11-02 09:36:54', '2021-11-02 09:36:54');

-- --------------------------------------------------------

--
-- Table structure for table `systemactivities`
--

CREATE TABLE `systemactivities` (
  `SystemActivityID` int(11) NOT NULL,
  `SystemActivityName` varchar(45) DEFAULT NULL,
  `SystemActivityCode` varchar(15) NOT NULL,
  `SystemActivityDescription` varchar(200) DEFAULT NULL,
  `AddedBy` int(11) DEFAULT NULL,
  `Date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `systemactivities`
--

INSERT INTO `systemactivities` (`SystemActivityID`, `SystemActivityName`, `SystemActivityCode`, `SystemActivityDescription`, `AddedBy`, `Date`) VALUES
(1, 'Register Users', 'RU', NULL, NULL, '2022-10-14 15:18:49'),
(2, 'View Users', 'VU', 'Testsss', NULL, '2022-10-14 15:18:49'),
(3, 'View Role', 'VR', 'View Role Access', NULL, '2022-10-14 15:33:10'),
(4, 'Add Role', 'AR', 'Add Role Access', NULL, '2022-10-14 15:34:29'),
(5, 'Edit Role System Activities', 'ERSA', NULL, NULL, '2022-10-14 15:44:22'),
(6, 'Edit Role Processing Stages', 'ERPS', NULL, NULL, '2022-10-14 15:44:48'),
(7, 'View System Activities', 'VSA', NULL, NULL, '2022-10-14 15:51:50'),
(8, 'Edit System Activities', 'ESA', NULL, NULL, '2022-10-14 15:52:32'),
(9, 'Delete System Activities', 'DSA', NULL, NULL, '2022-10-14 15:52:32'),
(10, 'Add System Activities', 'ASA', NULL, NULL, '2022-10-14 15:54:00'),
(11, 'Wallet Balance', 'WB', 'test', 1, '2022-10-14 16:15:18'),
(12, 'Production page 1', 'prodp', 'Production page Display', 1, '2022-10-15 12:48:37'),
(15, 'widgets', 'wg', 'widgets Display Or Not', 1, '2022-10-15 17:08:29'),
(16, 'Polisher', 'Polisher_panel', 'Polisher Panel widgets', 1, '2022-10-15 17:12:29'),
(17, 'STONE SETTER', 'Stone_setter', 'Stone Setter widgets', 1, '2022-10-15 17:15:39'),
(18, 'MANUFACTURING DEPARTMENT', 'manufacturing_d', 'manufacturing form', 1, '2022-10-15 17:23:47'),
(19, 'Counter Widget Display', 'counter_widget', 'Counter Widge', 1, '2022-10-15 17:26:55'),
(20, 'Schedule Set', 'SCHEDULE_set', 'Schedule Set Activity', 1, '2022-10-15 17:37:32'),
(21, 'Production Report', 'pro_report', 'Production Report Activity', 1, '2022-10-15 19:27:56'),
(22, 'Edit Users', 'EU', 'Edit existing user', 1, '2022-10-27 09:39:03'),
(23, 'Additional Manufacturing', 'additional_manu', 'Additional Manufacturing Panel', 1, '2022-10-27 11:42:55'),
(24, 'AccountPage', 'AP', 'Account Page Create', 1, '2023-02-11 14:32:36');

-- --------------------------------------------------------

--
-- Table structure for table `systemsettings`
--

CREATE TABLE `systemsettings` (
  `SystemSettingID` int(11) NOT NULL,
  `StageRejectionTimeout` int(11) DEFAULT NULL,
  `InProcessThreshold` varchar(45) DEFAULT NULL,
  `PositiveIndicatorScore` varchar(45) DEFAULT NULL,
  `NegativeIndicatorScore` varchar(45) DEFAULT NULL,
  `AddedBy` int(11) DEFAULT NULL,
  `Date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `userassignedarticles`
--

CREATE TABLE `userassignedarticles` (
  `UserAssignedArticleID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `ArticleID` int(11) NOT NULL,
  `ProcessingStageID` int(11) NOT NULL,
  `AssignmentTypeID` int(11) NOT NULL,
  `Status` varchar(15) NOT NULL DEFAULT 'Assigned' COMMENT 'Not Assigned,	Assigned,	InProgress,	Holded,	Completed,	Reassigned',
  `Date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `usermonthlyprocessingscore`
--

CREATE TABLE `usermonthlyprocessingscore` (
  `UserMonthlyProcessingScoreID` int(11) NOT NULL,
  `ArticlesQuantity` varchar(45) DEFAULT NULL,
  `ArticlesScore` varchar(45) DEFAULT NULL,
  `UserID` int(11) NOT NULL,
  `MonthlyScoreDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `userprocessingstages`
--

CREATE TABLE `userprocessingstages` (
  `UserProcessingStageID` int(11) NOT NULL,
  `InProcessThreshold` varchar(45) DEFAULT NULL,
  `UserID` int(11) NOT NULL,
  `ProcessingStageID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `userreassignedarticles`
--

CREATE TABLE `userreassignedarticles` (
  `UserReassignedArticleID` int(11) NOT NULL,
  `Comment` varchar(100) NOT NULL,
  `UserReassignedArticleStatus` varchar(45) DEFAULT NULL,
  `UserAssignedArticleID` int(11) NOT NULL,
  `Date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `userroles`
--

CREATE TABLE `userroles` (
  `UserRoleID` int(11) NOT NULL,
  `Date` timestamp NULL DEFAULT current_timestamp(),
  `UserID` int(11) NOT NULL,
  `RoleID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `userroles`
--

INSERT INTO `userroles` (`UserRoleID`, `Date`, `UserID`, `RoleID`) VALUES
(1, '2022-10-14 10:16:46', 1, 2),
(2, '2022-10-15 07:36:32', 8, 5),
(3, '2022-10-29 16:26:33', 9, 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `UserName` varchar(255) DEFAULT NULL,
  `UserEmail` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `UserLogInDate` timestamp NULL DEFAULT current_timestamp(),
  `UserLogOutDate` timestamp NULL DEFAULT current_timestamp(),
  `Token` varchar(255) DEFAULT NULL,
  `UserStatus` varchar(45) DEFAULT 'Active',
  `AddedBy` varchar(100) DEFAULT NULL,
  `Date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `UserName`, `UserEmail`, `Password`, `UserLogInDate`, `UserLogOutDate`, `Token`, `UserStatus`, `AddedBy`, `Date`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$vC41AOMLc.nfBlZFOwukkuN/44tpQIlIjnGdRMMOVdlzOTf5fT5zq', '2022-09-26 05:31:11', '2022-09-26 05:31:11', '754bcf4b23f6b6f887e30182f22ac0b7bd577256d26e7e744546ac8403ee855a3aa236909dd98571731913e85f8dd1b1e7c9', 'Active', NULL, '2020-09-24 12:53:37'),
(8, 'faisal', 'faisal@yahoo.com', '$2y$10$vC41AOMLc.nfBlZFOwukkuN/44tpQIlIjnGdRMMOVdlzOTf5fT5zq', '2022-10-15 07:36:32', '2022-10-15 07:36:32', 'c46cfab94d3716025904f1d56a5c94675caa51b576509f68f585ad72604487e624705aa5f152d76225351d4a1c9b6b3c42de', 'Active', NULL, '2022-10-15 07:36:32'),
(9, 'masood', 'masood@gmail.com', '$2y$10$eUxlPA542YDKdrxQby0DteriQYPv70waERO0LFLtPJ/c5K7JkWoTG', '2022-10-29 16:26:33', '2022-10-29 16:26:33', '8f12620ae6e8851c8bfa5f2075b84e8f05ddef1a11551d44341c38980accbc60dafe6dd8f91ce90b6c7f1592eaa787f09bdf', 'Active', NULL, '2022-10-29 16:26:33');

-- --------------------------------------------------------

--
-- Table structure for table `usersystemactivities`
--

CREATE TABLE `usersystemactivities` (
  `UserSystemActivityID` int(11) NOT NULL,
  `UserSystemActivityDate` timestamp NULL DEFAULT current_timestamp(),
  `UserID` int(11) NOT NULL,
  `SystemActivityID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `id` int(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `vendor_id` varchar(255) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `weight` float NOT NULL,
  `price` float NOT NULL,
  `quantity` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Indexes for table `articlecomplexityparameters`
--
ALTER TABLE `articlecomplexityparameters`
  ADD PRIMARY KEY (`ArticleComplexityParameterID`),
  ADD KEY `fk_ArticleComplexityParameters_ComplexityParameters_idx` (`ComplexityParameterID`),
  ADD KEY `fk_ArticleComplexityParameters_ArticleProcessing1_idx` (`ArticleProcessingID`);

--
-- Indexes for table `articlefigurerecord`
--
ALTER TABLE `articlefigurerecord`
  ADD PRIMARY KEY (`ArticleFigureRecordID`),
  ADD KEY `fk_ArticleFigureRecord_ArticleProcessing1_idx` (`ArticleProcessingID`);

--
-- Indexes for table `articleprocessdetails`
--
ALTER TABLE `articleprocessdetails`
  ADD PRIMARY KEY (`ArticleProcessDetailID`),
  ADD KEY `fk_ArticleProcessDetails_ArticleProcessing1_idx` (`ArticleProcessingID`);

--
-- Indexes for table `articleprocessing`
--
ALTER TABLE `articleprocessing`
  ADD PRIMARY KEY (`ArticleProcessingID`),
  ADD KEY `fkey_user_assign_articles` (`UserAssignedArticleID`);

--
-- Indexes for table `articleprocessingscores`
--
ALTER TABLE `articleprocessingscores`
  ADD PRIMARY KEY (`ArticleProcessingScoreID`),
  ADD KEY `fk_ArticleProcessingScores_ArticleProcessing1_idx` (`ArticleProcessingID`);

--
-- Indexes for table `articlereferenceextractions`
--
ALTER TABLE `articlereferenceextractions`
  ADD PRIMARY KEY (`ArticleProcessingID`),
  ADD KEY `fk_ArticleReferenceExtractions_Users1_idx` (`UserID`),
  ADD KEY `fk_ArticleReferenceExtractions_Articles1_idx` (`ArticleID`);

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`ArticleID`),
  ADD KEY `fk_Articles_Journals1_idx` (`JournalID`),
  ADD KEY `fk_Article_AddedBy` (`AddedBy`);

--
-- Indexes for table `articlesfilesrecord`
--
ALTER TABLE `articlesfilesrecord`
  ADD PRIMARY KEY (`ArticlesFilesRecordID`),
  ADD KEY `fk_ArticlesFilesRecord_Articles1_idx` (`ArticleID`);

--
-- Indexes for table `assignmenttypes`
--
ALTER TABLE `assignmenttypes`
  ADD PRIMARY KEY (`AssignmentTypeID`);

--
-- Indexes for table `cash`
--
ALTER TABLE `cash`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vendor_id` (`vendor_id`);

--
-- Indexes for table `cashaccount`
--
ALTER TABLE `cashaccount`
  ADD PRIMARY KEY (`caID`);

--
-- Indexes for table `complexityparameters`
--
ALTER TABLE `complexityparameters`
  ADD PRIMARY KEY (`ComplexityParameterID`);

--
-- Indexes for table `externalworkstepone`
--
ALTER TABLE `externalworkstepone`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `externalworksteptwo`
--
ALTER TABLE `externalworksteptwo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `goldaccount`
--
ALTER TABLE `goldaccount`
  ADD PRIMARY KEY (`AccID`);

--
-- Indexes for table `gold_accont_step`
--
ALTER TABLE `gold_accont_step`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `issuearticles`
--
ALTER TABLE `issuearticles`
  ADD PRIMARY KEY (`IssueArticleID`),
  ADD KEY `fk_IssueArticles_Articles1_idx` (`ArticleID`),
  ADD KEY `fk_IssueArticles_Issues1_idx` (`IssueID`);

--
-- Indexes for table `issues`
--
ALTER TABLE `issues`
  ADD PRIMARY KEY (`IssueID`),
  ADD KEY `fk_Issues_Journals1_idx` (`Journals_JournalID`),
  ADD KEY `fk_Issues_Users1` (`AddedBy`);

--
-- Indexes for table `item_list`
--
ALTER TABLE `item_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `journals`
--
ALTER TABLE `journals`
  ADD PRIMARY KEY (`JournalID`);

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
-- Indexes for table `po_items`
--
ALTER TABLE `po_items`
  ADD KEY `po_id` (`po_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `processingstages`
--
ALTER TABLE `processingstages`
  ADD PRIMARY KEY (`ProcessingStageID`),
  ADD KEY `fkey1_admin_id_process` (`AddedBy`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_order_list`
--
ALTER TABLE `purchase_order_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supplier_id` (`supplier_id`);

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
-- Indexes for table `roleprocessingstages`
--
ALTER TABLE `roleprocessingstages`
  ADD PRIMARY KEY (`RoleProcessingStageID`),
  ADD KEY `fk_RoleProcessingStages_Roles1_idx` (`RoleID`),
  ADD KEY `fk_RoleProcessingStages_ProcessingStages1_idx` (`ProcessingStageID`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`RoleID`);

--
-- Indexes for table `rolesystemactivities`
--
ALTER TABLE `rolesystemactivities`
  ADD PRIMARY KEY (`RoleSystemActivityID`),
  ADD KEY `fk_RoleSystemActivities_Roles1_idx` (`RoleID`),
  ADD KEY `fk_RoleSystemActivities_SystemActivities` (`SystemActivityID`);

--
-- Indexes for table `sechedule_set`
--
ALTER TABLE `sechedule_set`
  ADD PRIMARY KEY (`sechedule_id`);

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
-- Indexes for table `stock_list`
--
ALTER TABLE `stock_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stock_list_ibfk_1` (`item_id`);

--
-- Indexes for table `stone`
--
ALTER TABLE `stone`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `vendor_id` (`vendor_id`);

--
-- Indexes for table `stone_setter_account`
--
ALTER TABLE `stone_setter_account`
  ADD PRIMARY KEY (`ssaID`);

--
-- Indexes for table `stone_setter_step`
--
ALTER TABLE `stone_setter_step`
  ADD PRIMARY KEY (`Ssid`),
  ADD KEY `vendor_id` (`vendor_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `supplier_list`
--
ALTER TABLE `supplier_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `systemactivities`
--
ALTER TABLE `systemactivities`
  ADD PRIMARY KEY (`SystemActivityID`),
  ADD KEY `fk_user` (`AddedBy`);

--
-- Indexes for table `systemsettings`
--
ALTER TABLE `systemsettings`
  ADD PRIMARY KEY (`SystemSettingID`);

--
-- Indexes for table `userassignedarticles`
--
ALTER TABLE `userassignedarticles`
  ADD PRIMARY KEY (`UserAssignedArticleID`),
  ADD KEY `fk_UserAssignedArticles_Users1_idx` (`UserID`),
  ADD KEY `fk_UserAssignedArticles_Articles1_idx` (`ArticleID`),
  ADD KEY `fk_UserAssignedArticles_ProcessingStages1_idx` (`ProcessingStageID`),
  ADD KEY `fk_UserAssignedArticles_AssignmentTypes1_idx` (`AssignmentTypeID`);

--
-- Indexes for table `usermonthlyprocessingscore`
--
ALTER TABLE `usermonthlyprocessingscore`
  ADD PRIMARY KEY (`UserMonthlyProcessingScoreID`),
  ADD KEY `fk_UserMonthlyProcessingScore_Users1_idx` (`UserID`);

--
-- Indexes for table `userprocessingstages`
--
ALTER TABLE `userprocessingstages`
  ADD PRIMARY KEY (`UserProcessingStageID`),
  ADD KEY `fk_UserProcessingStages_Users1_idx` (`UserID`),
  ADD KEY `fk_UserProcessingStages_ProcessingStages1_idx` (`ProcessingStageID`);

--
-- Indexes for table `userreassignedarticles`
--
ALTER TABLE `userreassignedarticles`
  ADD PRIMARY KEY (`UserReassignedArticleID`);

--
-- Indexes for table `userroles`
--
ALTER TABLE `userroles`
  ADD PRIMARY KEY (`UserRoleID`),
  ADD KEY `fk_UserRoles_Users1_idx` (`UserID`),
  ADD KEY `fk_UserRoles_Roles1_idx` (`RoleID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `UserName` (`UserName`),
  ADD UNIQUE KEY `UserEmail` (`UserEmail`);

--
-- Indexes for table `usersystemactivities`
--
ALTER TABLE `usersystemactivities`
  ADD PRIMARY KEY (`UserSystemActivityID`),
  ADD KEY `fk_UserSystemActivities_Users1_idx` (`UserID`),
  ADD KEY `fk_UserSystemActivities_SystemActivities1_idx` (`SystemActivityID`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `articlecomplexityparameters`
--
ALTER TABLE `articlecomplexityparameters`
  MODIFY `ArticleComplexityParameterID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `articlefigurerecord`
--
ALTER TABLE `articlefigurerecord`
  MODIFY `ArticleFigureRecordID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `articleprocessdetails`
--
ALTER TABLE `articleprocessdetails`
  MODIFY `ArticleProcessDetailID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `articleprocessing`
--
ALTER TABLE `articleprocessing`
  MODIFY `ArticleProcessingID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `articleprocessingscores`
--
ALTER TABLE `articleprocessingscores`
  MODIFY `ArticleProcessingScoreID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `articlereferenceextractions`
--
ALTER TABLE `articlereferenceextractions`
  MODIFY `ArticleProcessingID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `ArticleID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `articlesfilesrecord`
--
ALTER TABLE `articlesfilesrecord`
  MODIFY `ArticlesFilesRecordID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `assignmenttypes`
--
ALTER TABLE `assignmenttypes`
  MODIFY `AssignmentTypeID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cash`
--
ALTER TABLE `cash`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cashaccount`
--
ALTER TABLE `cashaccount`
  MODIFY `caID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `complexityparameters`
--
ALTER TABLE `complexityparameters`
  MODIFY `ComplexityParameterID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `externalworkstepone`
--
ALTER TABLE `externalworkstepone`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `externalworksteptwo`
--
ALTER TABLE `externalworksteptwo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `goldaccount`
--
ALTER TABLE `goldaccount`
  MODIFY `AccID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `gold_accont_step`
--
ALTER TABLE `gold_accont_step`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `issuearticles`
--
ALTER TABLE `issuearticles`
  MODIFY `IssueArticleID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `issues`
--
ALTER TABLE `issues`
  MODIFY `IssueID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item_list`
--
ALTER TABLE `item_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `journals`
--
ALTER TABLE `journals`
  MODIFY `JournalID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `manufacturing_step`
--
ALTER TABLE `manufacturing_step`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `metal`
--
ALTER TABLE `metal`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `polisher_step`
--
ALTER TABLE `polisher_step`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `processingstages`
--
ALTER TABLE `processingstages`
  MODIFY `ProcessingStageID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchasing_details`
--
ALTER TABLE `purchasing_details`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `returned_item`
--
ALTER TABLE `returned_item`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `returned_stone_step`
--
ALTER TABLE `returned_stone_step`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `roleprocessingstages`
--
ALTER TABLE `roleprocessingstages`
  MODIFY `RoleProcessingStageID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `RoleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `rolesystemactivities`
--
ALTER TABLE `rolesystemactivities`
  MODIFY `RoleSystemActivityID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `sechedule_set`
--
ALTER TABLE `sechedule_set`
  MODIFY `sechedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `stock_details`
--
ALTER TABLE `stock_details`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `stock_list`
--
ALTER TABLE `stock_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stone`
--
ALTER TABLE `stone`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `stone_setter_account`
--
ALTER TABLE `stone_setter_account`
  MODIFY `ssaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `stone_setter_step`
--
ALTER TABLE `stone_setter_step`
  MODIFY `Ssid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `supplier_list`
--
ALTER TABLE `supplier_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `systemactivities`
--
ALTER TABLE `systemactivities`
  MODIFY `SystemActivityID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `systemsettings`
--
ALTER TABLE `systemsettings`
  MODIFY `SystemSettingID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `userassignedarticles`
--
ALTER TABLE `userassignedarticles`
  MODIFY `UserAssignedArticleID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `userprocessingstages`
--
ALTER TABLE `userprocessingstages`
  MODIFY `UserProcessingStageID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `userreassignedarticles`
--
ALTER TABLE `userreassignedarticles`
  MODIFY `UserReassignedArticleID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `userroles`
--
ALTER TABLE `userroles`
  MODIFY `UserRoleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `usersystemactivities`
--
ALTER TABLE `usersystemactivities`
  MODIFY `UserSystemActivityID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zircon`
--
ALTER TABLE `zircon`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

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
-- Constraints for table `articlecomplexityparameters`
--
ALTER TABLE `articlecomplexityparameters`
  ADD CONSTRAINT `fk_ArticleComplexityParameters_ArticleProcessing1` FOREIGN KEY (`ArticleProcessingID`) REFERENCES `articleprocessing` (`ArticleProcessingID`),
  ADD CONSTRAINT `fk_ArticleComplexityParameters_ComplexityParameters` FOREIGN KEY (`ComplexityParameterID`) REFERENCES `complexityparameters` (`ComplexityParameterID`);

--
-- Constraints for table `articlefigurerecord`
--
ALTER TABLE `articlefigurerecord`
  ADD CONSTRAINT `fk_ArticleFigureRecord_ArticleProcessing1` FOREIGN KEY (`ArticleProcessingID`) REFERENCES `articleprocessing` (`ArticleProcessingID`);

--
-- Constraints for table `articleprocessdetails`
--
ALTER TABLE `articleprocessdetails`
  ADD CONSTRAINT `fk_ArticleProcessDetails_ArticleProcessing1` FOREIGN KEY (`ArticleProcessingID`) REFERENCES `articleprocessing` (`ArticleProcessingID`);

--
-- Constraints for table `articleprocessing`
--
ALTER TABLE `articleprocessing`
  ADD CONSTRAINT `fkey_user_assign_articles` FOREIGN KEY (`UserAssignedArticleID`) REFERENCES `userassignedarticles` (`UserAssignedArticleID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `articleprocessingscores`
--
ALTER TABLE `articleprocessingscores`
  ADD CONSTRAINT `fk_ArticleProcessingScores_ArticleProcessing1` FOREIGN KEY (`ArticleProcessingID`) REFERENCES `articleprocessing` (`ArticleProcessingID`);

--
-- Constraints for table `articlereferenceextractions`
--
ALTER TABLE `articlereferenceextractions`
  ADD CONSTRAINT `fk_ArticleReferenceExtractions_Articles1` FOREIGN KEY (`ArticleID`) REFERENCES `articles` (`ArticleID`),
  ADD CONSTRAINT `fk_ArticleReferenceExtractions_Users1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `fk_Article_AddedBy` FOREIGN KEY (`AddedBy`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `fk_Articles_Journals1` FOREIGN KEY (`JournalID`) REFERENCES `journals` (`JournalID`);

--
-- Constraints for table `articlesfilesrecord`
--
ALTER TABLE `articlesfilesrecord`
  ADD CONSTRAINT `fk_ArticlesFilesRecord_Articles1` FOREIGN KEY (`ArticleID`) REFERENCES `articles` (`ArticleID`) ON DELETE CASCADE;

--
-- Constraints for table `cash`
--
ALTER TABLE `cash`
  ADD CONSTRAINT `cash_ibfk_1` FOREIGN KEY (`vendor_id`) REFERENCES `vendor` (`id`);

--
-- Constraints for table `issuearticles`
--
ALTER TABLE `issuearticles`
  ADD CONSTRAINT `fk_IssueArticles_Articles1` FOREIGN KEY (`ArticleID`) REFERENCES `articles` (`ArticleID`),
  ADD CONSTRAINT `fk_IssueArticles_Issues1` FOREIGN KEY (`IssueID`) REFERENCES `issues` (`IssueID`);

--
-- Constraints for table `issues`
--
ALTER TABLE `issues`
  ADD CONSTRAINT `fk_Issues_Journals1` FOREIGN KEY (`Journals_JournalID`) REFERENCES `journals` (`JournalID`),
  ADD CONSTRAINT `fk_Issues_Users1` FOREIGN KEY (`AddedBy`) REFERENCES `users` (`UserID`);

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
-- Constraints for table `po_items`
--
ALTER TABLE `po_items`
  ADD CONSTRAINT `po_items_ibfk_1` FOREIGN KEY (`po_id`) REFERENCES `purchase_order_list` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `po_items_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `item_list` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `processingstages`
--
ALTER TABLE `processingstages`
  ADD CONSTRAINT `fkey1_admin_id_process` FOREIGN KEY (`AddedBy`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `purchase_order_list`
--
ALTER TABLE `purchase_order_list`
  ADD CONSTRAINT `purchase_order_list_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier_list` (`id`) ON DELETE CASCADE;

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
-- Constraints for table `roleprocessingstages`
--
ALTER TABLE `roleprocessingstages`
  ADD CONSTRAINT `fk_RoleProcessingStages_Roles1` FOREIGN KEY (`RoleID`) REFERENCES `roles` (`RoleID`);

--
-- Constraints for table `rolesystemactivities`
--
ALTER TABLE `rolesystemactivities`
  ADD CONSTRAINT `fk_RoleSystemActivities_Roles1` FOREIGN KEY (`RoleID`) REFERENCES `roles` (`RoleID`),
  ADD CONSTRAINT `fk_RoleSystemActivities_SystemActivities` FOREIGN KEY (`SystemActivityID`) REFERENCES `systemactivities` (`SystemActivityID`) ON DELETE CASCADE;

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
-- Constraints for table `stock_list`
--
ALTER TABLE `stock_list`
  ADD CONSTRAINT `stock_list_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `item_list` (`id`) ON DELETE CASCADE;

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
-- Constraints for table `systemactivities`
--
ALTER TABLE `systemactivities`
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`AddedBy`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `userassignedarticles`
--
ALTER TABLE `userassignedarticles`
  ADD CONSTRAINT `fk_UserAssignedArticles_Articles1` FOREIGN KEY (`ArticleID`) REFERENCES `articles` (`ArticleID`),
  ADD CONSTRAINT `fk_UserAssignedArticles_AssignmentTypes1` FOREIGN KEY (`AssignmentTypeID`) REFERENCES `assignmenttypes` (`AssignmentTypeID`),
  ADD CONSTRAINT `fk_UserAssignedArticles_Users1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `usermonthlyprocessingscore`
--
ALTER TABLE `usermonthlyprocessingscore`
  ADD CONSTRAINT `fk_UserMonthlyProcessingScore_Users1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `userprocessingstages`
--
ALTER TABLE `userprocessingstages`
  ADD CONSTRAINT `fk_UserProcessingStages_Users1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `userroles`
--
ALTER TABLE `userroles`
  ADD CONSTRAINT `fk_UserRoles_Roles1` FOREIGN KEY (`RoleID`) REFERENCES `roles` (`RoleID`),
  ADD CONSTRAINT `fk_UserRoles_Users1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `usersystemactivities`
--
ALTER TABLE `usersystemactivities`
  ADD CONSTRAINT `fk_UserSystemActivities_SystemActivities` FOREIGN KEY (`SystemActivityID`) REFERENCES `systemactivities` (`SystemActivityID`),
  ADD CONSTRAINT `fk_UserSystemActivities_Users1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE;

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
