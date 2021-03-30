-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2018 at 04:07 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `invoice`
--

-- --------------------------------------------------------

--
-- Table structure for table `artikel`
--

CREATE TABLE `artikel` (
  `id_artikel` int(11) NOT NULL,
  `name_artikel` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `artikel`
--

INSERT INTO `artikel` (`id_artikel`, `name_artikel`) VALUES
(8, 'Fernsehen'),
(7, 'PC'),
(1, 'Stuhl'),
(2, 'Tisch');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `subject`, `content`, `date`, `type`) VALUES
(27, 'koko', 'kokomic@gmail.com', 'jojo', 'kk', '2018-01-14 13:50:53', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `daily`
--

CREATE TABLE `daily` (
  `id_daily` int(11) NOT NULL,
  `id_seller` int(11) NOT NULL DEFAULT '0',
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `number_user` int(11) NOT NULL,
  `benutzertyp` varchar(30) DEFAULT NULL,
  `name_user` varchar(30) NOT NULL,
  `debit` double NOT NULL DEFAULT '0',
  `credit` double NOT NULL DEFAULT '0',
  `statement` varchar(60) NOT NULL,
  `date_daily` date NOT NULL,
  `art` varchar(30) NOT NULL,
  `retoure` varchar(30) NOT NULL,
  `sales` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `daily`
--

INSERT INTO `daily` (`id_daily`, `id_seller`, `id`, `id_user`, `number_user`, `benutzertyp`, `name_user`, `debit`, `credit`, `statement`, `date_daily`, `art`, `retoure`, `sales`) VALUES
(21552, 0, 1, 35, 161001, NULL, 'Customer (1)', 0, 60, 'aa', '2017-12-01', 'Tag', '', ''),
(21553, 0, 1, 76, 261002, NULL, 'Supplier 2', 50, 0, 'aa', '2017-12-01', 'Tag', '', ''),
(21554, 0, 1, 75, 261001, NULL, 'Supplier 1', 60, 0, 'sdf', '2017-12-01', 'Tag', '', ''),
(21555, 0, 1, 75, 261001, NULL, 'Supplier 1', 10, 0, 'sdf', '2017-12-01', 'Tag', '', ''),
(21556, 0, 1, 75, 261001, NULL, 'Supplier 1', 10, 0, 'sdf', '2017-12-01', 'Tag', '', ''),
(21557, 0, 1, 76, 261002, NULL, 'Supplier 2', 10, 0, 'sdf', '2017-12-01', 'Tag', '', ''),
(21558, 0, 1, 75, 261001, NULL, 'Supplier 1', 10, 0, 'sdf', '2017-12-01', 'Tag', '', ''),
(21559, 0, 1, 36, 161002, NULL, 'Customer (2)', 0, 10, 'b', '2017-12-01', 'Tag', '', ''),
(21560, 0, 1, 35, 161001, NULL, 'Customer (1)', 30, 0, 'j', '2017-12-01', 'Tag', '', ''),
(21561, 0, 2, 35, 161001, NULL, 'Customer (1)', 40, 0, 'm', '2017-12-25', 'Tag', '', ''),
(21567, 0, 4, 35, 161001, NULL, 'Customer (1)', 6, 0, 'PC', '2017-12-08', 'rechnung', 'No', 'verkauf'),
(21568, 0, 4, 35, 161001, NULL, 'Customer (1)', 8, 0, 'Stuhl', '2017-12-08', 'rechnung', 'No', 'verkauf'),
(21569, 0, 4, 35, 161001, NULL, 'Customer (1)', 6, 0, 'Fernsehen', '2017-12-08', 'rechnung', 'No', 'verkauf'),
(21570, 0, 4, 35, 161001, NULL, 'Customer (1)', 12, 0, 'PC', '2017-12-08', 'rechnung', 'No', 'verkauf'),
(21571, 0, 4, 35, 161001, NULL, 'Customer (1)', 6, 0, 'Fernsehen', '2017-12-08', 'rechnung', 'No', 'verkauf'),
(21572, 0, 4, 35, 161001, NULL, 'Customer (1)', 6, 0, 'Fernsehen', '2017-12-08', 'rechnung', 'No', 'verkauf'),
(21573, 0, 4, 35, 161001, NULL, 'Customer (1)', 48, 0, 'PC', '2017-12-08', 'rechnung', 'No', 'verkauf'),
(21574, 0, 4, 35, 161001, NULL, 'Customer (1)', 60, 0, 'PC', '2017-12-08', 'rechnung', 'No', 'verkauf'),
(21575, 0, 5, 159, 161003, NULL, 'Customer (3)', 9.600000000000001, 0, 'PC', '2017-12-02', 'rechnung', 'No', 'verkauf'),
(21576, 0, 5, 159, 161003, NULL, 'Customer (3)', 6, 0, 'Stuhl', '2017-12-02', 'rechnung', 'No', 'verkauf'),
(21577, 0, 6, 159, 161003, NULL, 'Customer (3)', 2, 0, 'Fernsehen', '2017-12-29', 'rechnung', 'No', 'verkauf'),
(21578, 0, 6, 159, 161003, NULL, 'Customer (3)', 12, 0, 'PC', '2017-12-29', 'rechnung', 'No', 'verkauf'),
(21579, 0, 7, 159, 161003, NULL, 'Customer (3)', 0, 0, '', '2017-01-01', 'rechnung', 'No', 'verkauf'),
(21580, 0, 11, 36, 161002, NULL, 'Customer (2)', 0, 0, '', '2017-12-31', 'rechnung', 'No', 'verkauf'),
(21581, 0, 12, 36, 161002, NULL, 'Customer (2)', 0, 0, '', '2017-12-24', 'rechnung', 'No', 'verkauf'),
(21582, 0, 13, 159, 161003, NULL, 'Customer (3)', 0, 0, '', '2017-12-31', 'rechnung', 'No', 'verkauf'),
(21583, 0, 14, 35, 161001, NULL, 'Customer (1)', 0, 0, '', '2017-12-31', 'rechnung', 'No', 'verkauf'),
(21584, 0, 16, 35, 161001, NULL, 'Customer (1)', 0, 0, '', '2018-12-31', 'rechnung', 'No', 'verkauf'),
(21585, 0, 17, 36, 161002, NULL, 'Customer (2)', 0, 0, '', '2018-12-31', 'rechnung', 'No', 'verkauf'),
(21598, 0, 8, 75, 261001, NULL, 'Supplier 1', 0, 0, '', '2017-12-31', 'rechnung', 'No', 'einkauf'),
(21599, 0, 15, 75, 261001, NULL, 'Supplier 1', 0, 0, '', '2018-01-04', 'rechnung', 'No', 'einkauf'),
(21601, 0, 9, 76, 261002, NULL, 'Supplier 2', 6, 0, 'Stuhl', '2017-12-31', 'rechnung', 'Yes', 'einkauf'),
(21602, 0, 10, 75, 261001, NULL, 'Supplier 1', 6, 0, 'PC', '2017-12-31', 'rechnung', 'Yes', 'einkauf'),
(21603, 0, 10, 75, 261001, NULL, 'Supplier 1', 9, 0, 'Fernsehen', '2017-12-31', 'rechnung', 'Yes', 'einkauf');

-- --------------------------------------------------------

--
-- Table structure for table `daily_artikel`
--

CREATE TABLE `daily_artikel` (
  `id_daily_artikel` int(11) NOT NULL,
  `id_lager` int(11) NOT NULL DEFAULT '0',
  `name_lager` varchar(30) DEFAULT NULL,
  `id_artikel` int(11) NOT NULL DEFAULT '0',
  `name_artikel` varchar(30) DEFAULT NULL,
  `anzahl` double NOT NULL DEFAULT '0',
  `id_user` int(11) NOT NULL DEFAULT '0',
  `name_user` varchar(30) DEFAULT NULL,
  `benutzertyp` varchar(30) DEFAULT NULL,
  `id_Invoice` int(11) NOT NULL DEFAULT '0',
  `quantity_kunde` double NOT NULL DEFAULT '0',
  `quantity_Lieferant` double NOT NULL DEFAULT '0',
  `price` double NOT NULL DEFAULT '0',
  `date` date DEFAULT NULL,
  `retoure` varchar(30) DEFAULT NULL,
  `sales` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `daily_artikel`
--

INSERT INTO `daily_artikel` (`id_daily_artikel`, `id_lager`, `name_lager`, `id_artikel`, `name_artikel`, `anzahl`, `id_user`, `name_user`, `benutzertyp`, `id_Invoice`, `quantity_kunde`, `quantity_Lieferant`, `price`, `date`, `retoure`, `sales`) VALUES
(1173, 1, '3.14', 7, 'PC', 0, 35, 'Customer (1)', NULL, 4, 2, 0, 3, '2017-12-08', 'No', 'verkauf'),
(1174, 2, '3.15', 1, 'Stuhl', 0, 35, 'Customer (1)', NULL, 4, 4, 0, 2, '2017-12-08', 'No', 'verkauf'),
(1175, 1, '3.14', 8, 'Fernsehen', 0, 35, 'Customer (1)', NULL, 4, 2, 0, 3, '2017-12-08', 'No', 'verkauf'),
(1176, 3, '4.5', 7, 'PC', 0, 35, 'Customer (1)', NULL, 4, 4, 0, 3, '2017-12-08', 'No', 'verkauf'),
(1177, 1, '3.14', 8, 'Fernsehen', 0, 35, 'Customer (1)', NULL, 4, 2, 0, 3, '2017-12-08', 'No', 'verkauf'),
(1178, 1, '3.14', 8, 'Fernsehen', 0, 35, 'Customer (1)', NULL, 4, 2, 0, 3, '2017-12-08', 'No', 'verkauf'),
(1179, 2, '3.15', 7, 'PC', 0, 35, 'Customer (1)', NULL, 4, 6, 0, 8, '2017-12-08', 'No', 'verkauf'),
(1180, 1, '3.14', 7, 'PC', 0, 35, 'Customer (1)', NULL, 4, 2, 0, 30, '2017-12-08', 'No', 'verkauf'),
(1181, 2, '3.15', 7, 'PC', 0, 159, 'Customer (3)', NULL, 5, 1.6, 0, 6, '2017-12-02', 'No', 'verkauf'),
(1182, 1, '3.14', 1, 'Stuhl', 0, 159, 'Customer (3)', NULL, 5, 2, 0, 3, '2017-12-02', 'No', 'verkauf'),
(1183, 1, '3.14', 8, 'Fernsehen', 0, 159, 'Customer (3)', NULL, 6, 1, 0, 2, '2017-12-29', 'No', 'verkauf'),
(1184, 2, '3.15', 7, 'PC', 0, 159, 'Customer (3)', NULL, 6, 2, 0, 6, '2017-12-29', 'No', 'verkauf'),
(1185, 0, NULL, 0, NULL, 0, 159, 'Customer (3)', NULL, 7, 0, 0, 0, '2017-01-01', 'No', 'verkauf'),
(1186, 0, NULL, 0, NULL, 0, 36, 'Customer (2)', NULL, 11, 0, 0, 0, '2017-12-31', 'No', 'verkauf'),
(1187, 0, NULL, 0, NULL, 0, 36, 'Customer (2)', NULL, 12, 0, 0, 0, '2017-12-24', 'No', 'verkauf'),
(1188, 0, NULL, 0, NULL, 0, 159, 'Customer (3)', NULL, 13, 0, 0, 0, '2017-12-31', 'No', 'verkauf'),
(1189, 0, NULL, 0, NULL, 0, 35, 'Customer (1)', NULL, 14, 0, 0, 0, '2017-12-31', 'No', 'verkauf'),
(1190, 0, NULL, 0, NULL, 0, 35, 'Customer (1)', NULL, 16, 0, 0, 0, '2018-12-31', 'No', 'verkauf'),
(1191, 0, NULL, 0, NULL, 0, 36, 'Customer (2)', NULL, 17, 0, 0, 0, '2018-12-31', 'No', 'verkauf'),
(1204, 1, '3.14', 1, 'Stuhl', 0, 76, 'Supplier 2', NULL, 9, 2, 0, 3, '2017-12-31', 'Yes', 'einkauf'),
(1205, 2, '3.15', 7, 'PC', 0, 75, 'Supplier 1', NULL, 10, 2, 0, 3, '2017-12-31', 'Yes', 'einkauf'),
(1206, 2, '3.15', 8, 'Fernsehen', 0, 75, 'Supplier 1', NULL, 10, 3, 0, 3, '2017-12-31', 'Yes', 'einkauf'),
(1207, 1, '3.14', 7, 'PC', 0, 1, '3.14', NULL, 1, 0, 54, 4, '2017-12-01', NULL, 'Lager'),
(1208, 2, '3.15', 7, 'PC', 0, 2, '3.15', NULL, 2, 0, 5, 4.5, '2017-12-02', NULL, 'Lager'),
(1209, 1, '3.14', 7, 'PC', 0, 1, '3.14', NULL, 3, 0, 4, 4.3, '2017-12-02', NULL, 'Lager'),
(1210, 1, '3.14', 1, 'Stuhl', 0, 1, '3.14', NULL, 4, 0, 3, 3, '2017-12-03', NULL, 'Lager'),
(1211, 1, '3.14', 2, 'Tisch', 0, 1, '3.14', NULL, 5, 0, 3, 3, '2017-12-03', NULL, 'Lager'),
(1212, 1, '3.14', 8, 'Fernsehen', 0, 1, '3.14', NULL, 6, 0, 6, 15, '2017-12-03', NULL, 'Lager'),
(1213, 1, '3.14', 8, 'Fernsehen', 0, 1, '3.14', NULL, 7, 0, 2, 2, '2017-12-31', NULL, 'Lager');

-- --------------------------------------------------------

--
-- Table structure for table `day`
--

CREATE TABLE `day` (
  `id_day` int(11) NOT NULL,
  `id_seller` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `statement_day` varchar(60) NOT NULL,
  `date_day` date NOT NULL,
  `art` varchar(30) NOT NULL DEFAULT 'Tag'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `day`
--

INSERT INTO `day` (`id_day`, `id_seller`, `active`, `statement_day`, `date_day`, `art`) VALUES
(1, 1, 1, 'Sontag', '2017-12-01', 'Tag'),
(2, 1, 1, 'Montag', '2017-12-25', 'Tag'),
(3, 2, 1, 'ss', '2018-01-10', 'Tag');

-- --------------------------------------------------------

--
-- Table structure for table `day_detail`
--

CREATE TABLE `day_detail` (
  `id_day_detail` int(11) NOT NULL,
  `id_day` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `debit` double NOT NULL DEFAULT '0',
  `credit` double NOT NULL DEFAULT '0',
  `statement_day_detail` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `day_detail`
--

INSERT INTO `day_detail` (`id_day_detail`, `id_day`, `id_user`, `debit`, `credit`, `statement_day_detail`) VALUES
(1, 1, 35, 0, 60, 'aa'),
(2, 1, 76, 50, 0, 'aa'),
(3, 1, 75, 60, 0, 'sdf'),
(4, 1, 75, 10, 0, 'sdf'),
(5, 1, 75, 10, 0, 'sdf'),
(6, 1, 76, 10, 0, 'sdf'),
(7, 1, 75, 10, 0, 'sdf'),
(8, 1, 36, 0, 10, 'b'),
(12, 1, 35, 0, 111, 'lolo'),
(27, 2, 35, 0, 10, 'qq'),
(28, 2, 36, 0, 20, 'ww'),
(29, 2, 159, 0, 30, 'ee'),
(30, 2, 75, 60, 0, 'aa'),
(31, 2, 35, 0, 5, '5'),
(32, 2, 35, 0, 6, '6'),
(33, 2, 35, 0, 7, '7'),
(34, 3, 35, 0, 10, 'kk'),
(35, 3, 36, 0, 20, 'll');

-- --------------------------------------------------------

--
-- Table structure for table `day_detail_deleted`
--

CREATE TABLE `day_detail_deleted` (
  `id_day_detail` int(11) NOT NULL,
  `id_day` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `debit` double NOT NULL DEFAULT '0',
  `credit` double NOT NULL DEFAULT '0',
  `statement_day_detail` varchar(60) NOT NULL,
  `user` varchar(60) NOT NULL,
  `date_delet` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `day_detail_deleted`
--

INSERT INTO `day_detail_deleted` (`id_day_detail`, `id_day`, `id_user`, `debit`, `credit`, `statement_day_detail`, `user`, `date_delet`) VALUES
(9, 1, 35, 30, 0, 'j', 'admin', '2018-01-10'),
(15, 2, 159, 0, 147, 'lolo', 'admin', '2018-01-14'),
(16, 2, 36, 0, 66, 'lolo', 'admin', '2018-01-14'),
(18, 2, 36, 0, 66, 'lolo', 'admin', '2018-01-14'),
(19, 2, 159, 0, 11, 'lolo', 'admin', '2018-01-14');

-- --------------------------------------------------------

--
-- Table structure for table `general`
--

CREATE TABLE `general` (
  `general_id` int(11) NOT NULL,
  `general_name_ar` varchar(255) DEFAULT NULL,
  `general_name_en` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `general`
--

INSERT INTO `general` (`general_id`, `general_name_ar`, `general_name_en`) VALUES
(11, 'الأصول الثابتة', 'Fixed Assets'),
(12, 'مشاريع تحت التنفيذ', 'Project in Process'),
(13, 'المخزون', 'Inventory'),
(14, 'اقراض طويل الآجل', 'Long-Term Loans'),
(16, 'مدينون', 'Debitors'),
(17, 'حسابات مدينة مختلفة', 'Other Debit Accounts'),
(18, 'أموال جاهزة', 'Cash Holdings'),
(21, 'رأس المال', 'Capital'),
(22, 'احتياطيات', 'Free Reserves'),
(23, 'مجمع الإهلاكات', 'Accumlated Depreciation'),
(24, 'المخصصات', 'Provisions'),
(25, 'قروض طويلة الأجل', 'Long-TermLoans'),
(26, 'دائنون', 'Creditors'),
(27, 'حسابات دائنة مختلفة', 'Other credit Accounts'),
(31, 'الأجور', 'Payroll'),
(32, 'المستلزمات السلعية', 'Good Expenses'),
(33, 'مستلزمات خدمية وتوريدات خارجية', 'Service Expenses'),
(34, 'صافي المشتريات', 'Purchases Net'),
(35, 'المصروفات التحويلية الجارية', 'Expenditure'),
(36, 'المصروفات الجارية التخصيصية', 'Allocation Expenses'),
(43, 'ايرادات تشغيل للغير', 'Operatimg Revenues'),
(44, 'خدمات مباعة', 'Service Revenues'),
(45, 'ايرادات بضائع بغرض البيع', 'Sales Revenues'),
(47, 'ايرادات تحويلية', 'Other Revenues');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `id_Invoice` int(11) NOT NULL,
  `id_seller` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `id_user` int(11) NOT NULL,
  `date_Invoice` date NOT NULL,
  `statement_invoice` varchar(30) NOT NULL,
  `number_Invoice` int(11) NOT NULL,
  `art` varchar(30) NOT NULL DEFAULT 'rechnung',
  `retoure` varchar(10) NOT NULL,
  `sales` varchar(30) NOT NULL,
  `rabatt_r` float NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`id_Invoice`, `id_seller`, `active`, `id_user`, `date_Invoice`, `statement_invoice`, `number_Invoice`, `art`, `retoure`, `sales`, `rabatt_r`) VALUES
(4, 1, 1, 35, '2017-12-08', 'bar2', 87872, 'rechnung', 'No', 'verkauf', 0.54),
(5, 1, 1, 159, '2017-12-02', 'bar', 98797, 'rechnung', 'No', 'verkauf', 1),
(6, 2, 1, 159, '2017-12-29', 'b', 98798, 'rechnung', 'No', 'verkauf', 3),
(7, 1, 1, 159, '2017-01-01', 'b', 9878, 'rechnung', 'No', 'verkauf', 0),
(8, 1, 1, 75, '2017-12-31', 'b', 97987, 'rechnung', 'No', 'einkauf', 0),
(9, 2, 1, 76, '2017-12-31', 'bbb2311', 97987, 'rechnung', 'Yes', 'einkauf', 0),
(10, 1, 1, 75, '2017-12-31', 'bar', 656, 'rechnung', 'Yes', 'einkauf', 0),
(11, 1, 1, 36, '2017-12-31', 'bar', 325234, 'rechnung', 'No', 'verkauf', 0),
(12, 1, 1, 36, '2017-12-24', 'b', 154, 'rechnung', 'No', 'verkauf', 0),
(13, 1, 1, 159, '2017-12-31', 'bar', 325234, 'rechnung', 'No', 'verkauf', 0),
(14, 1, 1, 35, '2017-12-31', 'bar', 325234, 'rechnung', 'No', 'verkauf', 0),
(15, 1, 1, 75, '2018-01-04', 'hh', 6565, 'rechnung', 'No', 'einkauf', 0),
(16, 1, 1, 35, '2018-12-31', 'bar', 454, 'rechnung', 'No', 'verkauf', 3),
(17, 2, 1, 36, '2018-12-31', 'bar', 325234, 'rechnung', 'No', 'verkauf', 4);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_details`
--

CREATE TABLE `invoice_details` (
  `id_details_invoice` int(11) NOT NULL,
  `id_Invoice` int(11) NOT NULL,
  `statement_Invoice_details` int(11) NOT NULL,
  `lager_detail_invoice` int(11) NOT NULL,
  `quantity` double NOT NULL DEFAULT '1',
  `price` double NOT NULL DEFAULT '0',
  `rabatt_rd` float NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `invoice_details`
--

INSERT INTO `invoice_details` (`id_details_invoice`, `id_Invoice`, `statement_Invoice_details`, `lager_detail_invoice`, `quantity`, `price`, `rabatt_rd`) VALUES
(4, 5, 7, 2, 1.6, 6, 0),
(5, 5, 1, 1, 2, 3, 0),
(7, 6, 8, 1, 1, 2, 0),
(8, 6, 7, 2, 2, 6, 0),
(9, 9, 1, 1, 2, 3, 0),
(12, 4, 7, 2, 6, 8, 0),
(13, 10, 7, 2, 2, 3, 0),
(14, 10, 8, 2, 3, 3, 0),
(15, 4, 7, 1, 2, 30, 2),
(16, 7, 8, 1, 2, 30, 1),
(17, 7, 7, 2, 3, 60, 2),
(18, 7, 1, 1, 5, 10, 1),
(19, 7, 2, 1, 2, 15, 1),
(20, 7, 8, 2, 2, 10, 1),
(21, 9, 8, 1, 2, 10, 1),
(22, 9, 7, 2, 2, 10, 1),
(27, 11, 8, 1, 2, 10, 1),
(28, 11, 7, 2, 3, 30, 1),
(29, 12, 8, 1, 2, 10, 1),
(30, 12, 2, 1, 1, 1, 1),
(31, 12, 1, 2, 2, 10, 1),
(32, 12, 7, 1, 3, 10, 1),
(33, 13, 8, 2, 2, 10, 1),
(34, 13, 7, 1, 2, 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_details_deleted`
--

CREATE TABLE `invoice_details_deleted` (
  `id_details_invoice` int(11) NOT NULL,
  `id_Invoice` int(11) NOT NULL,
  `statement_Invoice_details` int(11) NOT NULL,
  `lager_detail_invoice` int(11) NOT NULL,
  `quantity` double NOT NULL DEFAULT '1',
  `price` double NOT NULL DEFAULT '0',
  `rabatt_rd` float NOT NULL DEFAULT '0',
  `user` varchar(60) NOT NULL,
  `date_delet` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `invoice_details_deleted`
--

INSERT INTO `invoice_details_deleted` (`id_details_invoice`, `id_Invoice`, `statement_Invoice_details`, `lager_detail_invoice`, `quantity`, `price`, `rabatt_rd`, `user`, `date_delet`) VALUES
(17, 4, 8, 1, 2, 3, 2, 'Customer (1)', '2018-01-10'),
(18, 4, 7, 2, 2, 3, 2, 'admin', '2018-01-10');

-- --------------------------------------------------------

--
-- Table structure for table `lager`
--

CREATE TABLE `lager` (
  `id_lager` int(11) NOT NULL,
  `name_lager` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lager`
--

INSERT INTO `lager` (`id_lager`, `name_lager`) VALUES
(1, '3.14'),
(2, '3.15'),
(3, '4.5');

-- --------------------------------------------------------

--
-- Table structure for table `lagerartikel`
--

CREATE TABLE `lagerartikel` (
  `lagerartikel_id` int(11) NOT NULL,
  `id_lager` int(11) NOT NULL,
  `id_artikel` int(11) NOT NULL,
  `anzahl` int(11) NOT NULL,
  `price` double NOT NULL DEFAULT '0',
  `date_lagerartikel` date NOT NULL,
  `art` varchar(30) NOT NULL DEFAULT 'Lager'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lagerartikel`
--

INSERT INTO `lagerartikel` (`lagerartikel_id`, `id_lager`, `id_artikel`, `anzahl`, `price`, `date_lagerartikel`, `art`) VALUES
(1, 1, 7, 54, 4, '2017-12-01', 'Lager'),
(2, 2, 7, 5, 4.5, '2017-12-02', 'Lager'),
(3, 1, 7, 4, 4.3, '2017-12-02', 'Lager'),
(4, 1, 1, 3, 3, '2017-12-03', 'Lager'),
(5, 1, 2, 3, 3, '2017-12-03', 'Lager'),
(6, 1, 8, 6, 15, '2017-12-03', 'Lager'),
(7, 1, 8, 2, 2, '2017-12-31', 'Lager');

-- --------------------------------------------------------

--
-- Table structure for table `materials`
--

CREATE TABLE `materials` (
  `id_materials` int(11) NOT NULL,
  `name_materials` varchar(30) NOT NULL,
  `Inventory` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `materials`
--

INSERT INTO `materials` (`id_materials`, `name_materials`, `Inventory`) VALUES
(1, 'Pizza', 112),
(2, 'Bier', 2),
(3, 'OrangenSaft', 1),
(4, 'Kafee', 111),
(5, 'Käse', 1),
(6, 'Buch', 10);

-- --------------------------------------------------------

--
-- Table structure for table `principal`
--

CREATE TABLE `principal` (
  `principal_id` int(11) NOT NULL,
  `principal_name_ar` varchar(255) DEFAULT NULL,
  `principal_name_en` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `principal`
--

INSERT INTO `principal` (`principal_id`, `principal_name_ar`, `principal_name_en`) VALUES
(1, 'الأصـــــول', 'Assets'),
(2, 'الخصوم', 'Liabilities'),
(3, 'المصروفات', 'Expenses'),
(4, 'الإيرادات', 'Revenues');

-- --------------------------------------------------------

--
-- Table structure for table `seller`
--

CREATE TABLE `seller` (
  `id_seller` int(11) NOT NULL,
  `number_seller` int(11) NOT NULL DEFAULT '0',
  `name_seller` varchar(30) NOT NULL,
  `address` varchar(60) NOT NULL,
  `telephon` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `seller`
--

INSERT INTO `seller` (`id_seller`, `number_seller`, `name_seller`, `address`, `telephon`) VALUES
(1, 545, 'alfred', '', ''),
(2, 6454, 'paul', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(8) NOT NULL,
  `username` varchar(30) NOT NULL,
  `phone` int(20) NOT NULL,
  `password` varchar(60) NOT NULL,
  `confirm_password` varchar(60) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `phone`, `password`, `confirm_password`, `first_name`, `last_name`, `email`, `active`) VALUES
(1, 'khaldoun', 0, 'e10adc3949ba59abbe56e057f20f883e', '', '', '', '', 0),
(6, 'admin', 0, '21232f297a57a5a743894a0e4a801fc3', '', '', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(10) NOT NULL,
  `principal` int(11) DEFAULT NULL,
  `general` int(11) DEFAULT NULL,
  `number_user` int(11) DEFAULT NULL,
  `name_user_ar` varchar(255) DEFAULT NULL,
  `name_user` varchar(255) DEFAULT NULL,
  `art` varchar(255) DEFAULT NULL,
  `art1` int(10) DEFAULT NULL,
  `benutzertyp` varchar(50) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `telephon` varchar(50) DEFAULT NULL,
  `mobile` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `principal`, `general`, `number_user`, `name_user_ar`, `name_user`, `art`, `art1`, `benutzertyp`, `address`, `telephon`, `mobile`) VALUES
(1, 1, 11, 111, 'الأراضي', 'Lands', 'ميزانية', 1, NULL, '', '', ''),
(2, 1, 11, 112, 'مباني وإنشاءات ومرافق وطرق', 'Building & Roads', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(3, 1, 11, 113, 'آلات وتجهيزات', 'Plant & Equipment', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(4, 1, 11, 114, 'وسائل نقل وانتقال', 'Autos & Trucks', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(5, 1, 11, 115, 'عدد وأدوات وقوالب', 'Tools', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(6, 1, 11, 116, 'أثاث ومعدات مكاتب', 'Furniture & Office Equipment', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(7, 1, 11, 1161, 'أثاث', 'Furniture', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(8, 1, 11, 1162, 'آلات كاتبة وحاسبة', 'Office Equipment', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(9, 1, 11, 1163, 'كمبيوتر', 'Computer', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(10, 1, 11, 118, 'نفقات إيرادية مؤجلة', 'Delaeyd Revenue Expenses', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(11, 1, 11, 1181, 'نفقات التأسيس', 'Organization Expense', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(12, 1, 11, 1186, 'حملة إعلانية', 'Advertising & Promotion', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(13, 1, 12, 121, 'أراضي', 'Lands', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(14, 1, 12, 122, 'مباني وإنشاءات ومرافق وطرق', 'Building & Roads', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(15, 1, 12, 123, 'آلات وتجهيزات', 'Plant & Equipment', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(16, 1, 12, 124, 'وسائل نقل وانتقال', 'Autos & Trucks', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(17, 1, 12, 125, 'عدد وأدوات وقوالب', 'Tools', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(18, 1, 12, 126, 'أثاث ومعدات مكاتب', 'Furniture & Office Equipment', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(19, 1, 13, 130, 'مخزون أول المدة', 'Beginning Inventory', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(20, 1, 13, 1301, 'مواد وسلع أول المدة', '(IB) Goods & Material', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(21, 1, 13, 1302, 'وقود وزيوت أول المدة', '(IB) Oil & Fuel', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(22, 1, 13, 1303, 'قطع غيار وعدد صغيرة أول المدة', '(IB) Tools', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(23, 1, 13, 1305, 'مواد تعبئة وتغليف أول المدة', '(IB) Packaging Goods', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(24, 1, 13, 131, 'مخازن مواد وموجودات مختلفة', 'Goods & Material Depots', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(25, 1, 13, 1312, 'مخزون المواد والسلع', '(Inv) Goods & Material', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(26, 1, 13, 1313, 'مخزون الوقود والزيوت', '(Inv) Oil & Fuel', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(27, 1, 13, 1314, 'مخزون قطع الغيار والعدد الصغيرة', '(Inv) Tools', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(28, 1, 13, 1315, 'مخزون مواد التعبئة والتغليف', '(Inv) Packaging Goods', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(29, 1, 13, 136, 'اعتمادات لشراء المواد والبضائع', 'Documentary Credits', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(30, 1, 13, 13601, 'اعتماد (1)', 'Credit (1)', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(31, 1, 13, 13602, 'اعتماد (2)', 'Credit (2)', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(32, 1, 14, 141, 'اقراض محلي طويل الآجل', 'Long-Term International Loans', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(33, 1, 14, 142, 'اقراض خارجي طويل الآجل', 'Long-Term Extermal Loans', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(34, 1, 16, 161, 'زبائن', 'Customers', 'ميزانية', 1, NULL, '', '', ''),
(35, 1, 16, 161001, 'زبون (1)', 'Customer (1)', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(36, 1, 16, 161002, 'زبون (2)', 'Customer (2)', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(37, 1, 16, 162, 'أوراق القبض', 'Bills Receivable', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(38, 1, 16, 162001, 'أوراق القبض زبون (1)', 'Customer (1)', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(39, 1, 16, 162002, 'أوراق القبض زبون (2)', 'Customer (2)', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(40, 1, 16, 163, 'تأمينات وسلف', 'Imprest & Insurance', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(41, 1, 16, 1631, 'تأمينات لدي الغير', 'Deposit', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(42, 1, 16, 1632, 'سلف العاملين', 'Employees Imprest', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(43, 1, 17, 171, 'مدينون مختلفون', 'Other Debitors', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(44, 1, 17, 17101, 'مدين (1)', 'Debit (1)', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(45, 1, 17, 17102, 'مدين (2)', 'Debit (2)', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(46, 1, 17, 173, 'ايرادات جارية وتخصيصية مستحقة', 'Accrued Revenues', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(47, 1, 17, 1733, 'فوائد دائنة مستحقة', 'Accrued Interests', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(48, 1, 17, 1734, 'ايجارات دائنة مستحقة', 'Accrued Rents', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(49, 1, 17, 174, 'مصروفات جارية مدفوعه مقدماً', 'Prepaid Expenses', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(50, 1, 17, 1741, 'أجور مدفوعة مقدماً', 'Prepaid Wages', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(51, 1, 17, 1742, 'ايجارات مدفوعة مقدماً', 'Prepaid Rents', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(52, 1, 18, 181, 'الصندوق', 'Cash on Hand', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(53, 1, 18, 182, 'البنك ', 'Cash in Banks', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(54, 1, 18, 1821, 'بنك رقم 1', 'Bank (1)', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(55, 1, 18, 1822, 'بنك رقم 2', 'Bank (2)', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(56, 2, 21, 211, 'رأس المال المدفوع', 'Paid-up Capital', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(57, 2, 21, 2111, 'رأسمال الشريك (1)', 'Partner (1)', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(58, 2, 21, 2112, 'رأسمال الشريك (2)', 'Partner (2)', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(59, 2, 21, 212, 'الأرباح والخسائر', 'Profit and loss', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(60, 2, 21, 2121, 'ارباح وخسائر مرحلة', 'Profits and losses of previous years', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(61, 2, 21, 2122, 'ارباح وخسائر الفترة', 'Profit and loss period', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(62, 2, 22, 221, 'احتياطى قانوني', 'Legal Reserve', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(63, 2, 22, 224, 'احتياطى اختيارى', 'Voluntary Reserve', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(64, 2, 22, 227, 'فائض مرحل', 'Import Surplus', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(65, 2, 23, 232, 'اهلاكات المباني والانشاءات', 'Accum Building', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(66, 2, 23, 233, 'اهلاكات الآلات والمعدات', 'Accum Plant & Equipment', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(67, 2, 23, 234, 'اهلاك وسائل النقل', 'Accum Autos & Trucks', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(68, 2, 23, 235, 'اهلاك العدد والأدوات والقوالب', 'Accum Tools', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(69, 2, 23, 236, 'اهلاك الأثاث ومعدات المكاتب', 'Accum Furniture & Office Equip', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(70, 2, 24, 241, 'مخصص ضرائب ورسوم متنازع عليها', 'Taxes provision', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(71, 2, 24, 242, 'مخصص  الديون المشكوك في تحصيلها', 'Customers provision', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(72, 2, 25, 251, 'قروض طويلة محلية', 'Internal Loans', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(73, 2, 25, 252, 'قروض خارجية', 'External Loans', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(74, 2, 26, 261, 'موردون', 'Suppliers', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(75, 2, 26, 261001, 'مورد (1)', 'Supplier 1', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(76, 2, 26, 261002, 'مورد (2)', 'Supplier 2', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(77, 2, 26, 262, 'أوراق دفع', 'Bills Payable', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(78, 2, 26, 262001, 'أوراق دفع المورد (1)', 'Supplier 1', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(79, 2, 26, 262002, 'أوراق دفع المورد (2)', 'Supplier 2', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(80, 2, 26, 263, 'دائنون متنوعون', 'Other Creditors', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(81, 2, 26, 2631, 'تأمينات للغير', 'Credit Guarantee', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(82, 2, 26, 2632, 'الدوائر المالية', 'Finance Ministry', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(83, 2, 26, 2633, 'الدوائر الجمركية', 'Custom Authority', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(84, 2, 26, 2635, 'مؤسسة التأمين والمعاشات', 'Social Security', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(85, 2, 27, 274, 'مصروفات جارية وتخصيصية مستحقة', 'Accured Charges', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(86, 2, 27, 2741, 'أجور مستحقة', 'Accured Wages', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(87, 2, 27, 2742, 'ايجارات مستحقة', 'Accured Rents', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(88, 2, 27, 2743, 'فوائد مستحقة', 'Accured Interest', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(89, 2, 27, 2745, 'تعويضات للغير مستحقة', 'Accured Compensation', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(90, 2, 27, 275, 'ايرادات جارية مقبوضة مقدما', 'Repaied Revenues', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(91, 2, 27, 2751, 'اعانات مقبوضة مقدما', 'Repaied Subsidy', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(92, 2, 27, 2753, 'فوائد مقبوضة مقدما', 'Repaied Interset', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(93, 2, 27, 2754, 'ايجارات مقبوضة مقدما', 'Repaied Rents', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(94, 2, 27, 2755, 'تعويضات على الغير مقبوضة مقدما', 'Repaied Compensation', 'ميزانية', 1, NULL, NULL, NULL, NULL),
(95, 3, 31, 311, 'أجور نقدية', 'Cash Wages', 'قائمة الدخل', 2, NULL, NULL, NULL, NULL),
(96, 3, 31, 3111, 'رواتب وأجور نقدية ومتمماتها', 'Salaries & Wages', 'قائمة الدخل', 2, NULL, NULL, NULL, NULL),
(97, 3, 31, 3117, 'مكآفات تشجيعية', 'Bonuses', 'قائمة الدخل', 2, NULL, NULL, NULL, NULL),
(98, 3, 31, 3119, 'تعويضات', 'Compensation', 'قائمة الدخل', 2, NULL, NULL, NULL, NULL),
(99, 3, 31, 312, 'مزايا عينية', 'Fringe Benefits', 'قائمة الدخل', 2, NULL, NULL, NULL, NULL),
(100, 3, 31, 3121, 'السكن', 'Housing', 'قائمة الدخل', 2, NULL, NULL, NULL, NULL),
(101, 3, 31, 3122, 'الغذاء', 'Food', 'قائمة الدخل', 2, NULL, NULL, NULL, NULL),
(102, 3, 31, 3123, 'العلاج', 'Medication', 'قائمة الدخل', 2, NULL, NULL, NULL, NULL),
(103, 3, 32, 323, 'وقود وزيوت وقوي محركة للتشغيل', 'Fuel & Oil', 'قائمة الدخل', 2, NULL, NULL, NULL, NULL),
(104, 3, 32, 324, 'قطع غيار وأدوات صغيرة', 'Spare Parts & Tools', 'قائمة الدخل', 2, NULL, NULL, NULL, NULL),
(105, 3, 32, 325, 'مواد تعبئة وتغليف', 'Handling Charges', 'قائمة الدخل', 2, NULL, NULL, NULL, NULL),
(106, 3, 32, 327, 'أدوات كتابية ومطبوعات', 'Office Supplies', 'قائمة الدخل', 2, NULL, NULL, NULL, NULL),
(107, 3, 33, 331, 'مصروفات الصيانة الخارجية', 'Maintenance Charges', 'قائمة الدخل', 2, NULL, NULL, NULL, NULL),
(108, 3, 33, 332, 'مصروفات تشغيل لدي الغير', 'Operating Expenses', 'قائمة الدخل', 2, NULL, NULL, NULL, NULL),
(109, 3, 33, 334, 'دعاية واعلان وعلاقات عامة', 'Publicity & Advertising', 'قائمة الدخل', 2, NULL, NULL, NULL, NULL),
(110, 3, 33, 335, 'نقل وانتقال', 'Transportation Charges', 'قائمة الدخل', 2, NULL, NULL, NULL, NULL),
(111, 3, 33, 336, 'استئجار آلات ومعدات ووسائط نقل', 'Leasing (plant & equip)', 'قائمة الدخل', 2, NULL, NULL, NULL, NULL),
(112, 3, 33, 337, 'الإنارة والمياه', 'Electricity & Water', 'قائمة الدخل', 2, NULL, NULL, NULL, NULL),
(113, 3, 33, 338, 'بريد وبرق وهاتف وتلكس', 'Telephone & Telegraph', 'قائمة الدخل', 2, NULL, NULL, NULL, NULL),
(114, 3, 33, 339, 'مصروفات خدمية متنوعة', 'Other Expenses', 'قائمة الدخل', 2, NULL, NULL, NULL, NULL),
(115, 3, 33, 3391, 'اشتراكات هيئات عامة', 'Subscription', 'قائمة الدخل', 2, NULL, NULL, NULL, NULL),
(116, 3, 33, 3392, 'التامين', 'Insurance', 'قائمة الدخل', 2, NULL, NULL, NULL, NULL),
(117, 3, 33, 3394, 'عمولات ومصروفات مصرفية', 'Bank Service Charge', 'قائمة الدخل', 2, NULL, NULL, NULL, NULL),
(118, 3, 33, 3395, 'عمولات مبيعات', 'Sales Commision', 'قائمة الدخل', 2, NULL, NULL, NULL, NULL),
(119, 3, 33, 3396, 'عمولات مختلفة', 'Other Commission', 'قائمة الدخل', 2, NULL, NULL, NULL, NULL),
(120, 3, 34, 341, 'إجمالي مشتريات بغرض البيع', 'Purchases Totals', 'قائمة الدخل', 2, NULL, NULL, NULL, NULL),
(121, 3, 34, 342, 'مردودات المشتريات', 'Purchases Returns', 'قائمة الدخل', 2, NULL, NULL, NULL, NULL),
(122, 3, 34, 343, 'مسموحات المشتريات', 'Purchases Discounts', 'قائمة الدخل', 2, NULL, NULL, NULL, NULL),
(123, 3, 35, 351, 'الضرائب والرسوم السلعية', 'Taxes', 'قائمة الدخل', 2, NULL, NULL, NULL, NULL),
(124, 3, 35, 3512, 'رسوم جمركية على المستهلك من مواد', 'Custom-Duties', 'قائمة الدخل', 2, NULL, NULL, NULL, NULL),
(125, 3, 35, 3515, 'ضريبة ريع العقارات', 'Building Tax', 'قائمة الدخل', 2, NULL, NULL, NULL, NULL),
(126, 3, 35, 352, 'أعباء الأهتلاك', 'Depreciation', 'قائمة الدخل', 2, NULL, NULL, NULL, NULL),
(127, 3, 35, 3522, 'اهتلاك مباني وانشاءت', 'Buidings-Dep', 'قائمة الدخل', 2, NULL, NULL, NULL, NULL),
(128, 3, 35, 3523, 'اهتلاك آلات وتجهيزات', 'Plant & Equip-Dep', 'قائمة الدخل', 2, NULL, NULL, NULL, NULL),
(129, 3, 35, 3524, 'اهتلاك وسائل نقل وانتقال', 'Autos & Trucks-Dep', 'قائمة الدخل', 2, NULL, NULL, NULL, NULL),
(130, 3, 35, 3525, 'اهتلاك عدد وأدوات وقوالب', 'Tools-Dep', 'قائمة الدخل', 2, NULL, NULL, NULL, NULL),
(131, 3, 35, 3526, 'اهتلاك أثاث ومعدات مكاتب', 'Furniture-Dep', 'قائمة الدخل', 2, NULL, NULL, NULL, NULL),
(132, 3, 35, 353, 'إيجارات فعليه', 'Actual Rent', 'قائمة الدخل', 2, NULL, NULL, NULL, NULL),
(133, 3, 35, 3531, 'إيجار أراضي', 'Lands Rent', 'قائمة الدخل', 2, NULL, NULL, NULL, NULL),
(134, 3, 35, 3533, 'إيجار مباني', 'Building Rent', 'قائمة الدخل', 2, NULL, NULL, NULL, NULL),
(135, 3, 35, 355, 'فوائد محلية', 'Internal Interest', 'قائمة الدخل', 2, NULL, NULL, NULL, NULL),
(136, 3, 35, 356, 'فوائد خارجية', 'External Interest', 'قائمة الدخل', 2, NULL, NULL, NULL, NULL),
(137, 3, 36, 361, 'تبرعات', 'Contributions', 'قائمة الدخل', 2, NULL, NULL, NULL, NULL),
(138, 3, 36, 362, 'اعانات للغير', 'Subsidy', 'قائمة الدخل', 2, NULL, NULL, NULL, NULL),
(139, 3, 36, 363, 'تعويضات للغير وغرامات', 'Compentsatiry Damages', 'قائمة الدخل', 2, NULL, NULL, NULL, NULL),
(140, 3, 36, 364, 'خسائر رأسمالية', 'Capital Losses', 'قائمة الدخل', 2, NULL, NULL, NULL, NULL),
(141, 3, 36, 366, 'ديون معدومة', 'Bad Debts', 'قائمة الدخل', 2, NULL, NULL, NULL, NULL),
(142, 3, 36, 369, 'ضريبة دخل الأرباح', 'Income Tax', 'قائمة الدخل', 2, NULL, NULL, NULL, NULL),
(143, 4, 43, 4301, 'ايراد (1)', 'Revenue 1', 'قائمة الدخل', 2, NULL, NULL, NULL, NULL),
(144, 4, 43, 4302, 'ايراد (2)', 'Revenue 2', 'قائمة الدخل', 2, NULL, NULL, NULL, NULL),
(145, 4, 44, 4401, 'ايراد (1)', 'Revenue 1', 'قائمة الدخل', 2, NULL, NULL, NULL, NULL),
(146, 4, 44, 4402, 'ايراد (2)', 'Revenue 2', 'قائمة الدخل', 2, NULL, NULL, NULL, NULL),
(147, 4, 45, 451, 'صافي مبيعات بضائع بغرض البيع', 'Sales Net', 'قائمة الدخل', 2, NULL, NULL, NULL, NULL),
(148, 4, 45, 4511, 'إجمالي مبيعات بضائع بغرض البيع', 'Sales Total', 'قائمة الدخل', 2, NULL, NULL, NULL, NULL),
(149, 4, 45, 4512, 'مردودات مبيعات', 'Sales Returns', 'قائمة الدخل', 2, NULL, NULL, NULL, NULL),
(150, 4, 45, 4513, 'مسموحات مبيعات', 'Sales Discount', 'قائمة الدخل', 2, NULL, NULL, NULL, NULL),
(151, 4, 45, 4514, 'هدايا وعينات', 'Gifts', 'قائمة الدخل', 2, NULL, NULL, NULL, NULL),
(152, 4, 47, 471, 'ايراد أوراق مالية', 'Securities Revenues', 'قائمة الدخل', 2, NULL, NULL, NULL, NULL),
(153, 4, 47, 472, 'فوائد دائنة', 'Credit Interests', 'قائمة الدخل', 2, NULL, NULL, NULL, NULL),
(154, 4, 47, 473, 'ايجارات دائنة', 'Credit Rents', 'قائمة الدخل', 2, NULL, NULL, NULL, NULL),
(155, 4, 47, 474, 'أرباح رأسمالية', 'Capital Gains', 'قائمة الدخل', 2, NULL, NULL, NULL, NULL),
(156, 4, 47, 475, 'ايرادات السنوات السابقة', 'Last Years Revenues', 'قائمة الدخل', 2, NULL, NULL, NULL, NULL),
(157, 4, 47, 476, 'تعويضات وغرامات على الغير', 'Compensation', 'قائمة الدخل', 2, NULL, NULL, NULL, NULL),
(158, 4, 47, 477, 'ايرادات متنوعة', 'Other Income', 'قائمة الدخل', 2, NULL, NULL, NULL, NULL),
(159, 1, 16, 161003, NULL, 'Customer (3)', NULL, NULL, '', 'aa', 'bb', 'cc');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artikel`
--
ALTER TABLE `artikel`
  ADD PRIMARY KEY (`id_artikel`),
  ADD UNIQUE KEY `name` (`name_artikel`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `daily`
--
ALTER TABLE `daily`
  ADD PRIMARY KEY (`id_daily`);

--
-- Indexes for table `daily_artikel`
--
ALTER TABLE `daily_artikel`
  ADD PRIMARY KEY (`id_daily_artikel`);

--
-- Indexes for table `day`
--
ALTER TABLE `day`
  ADD PRIMARY KEY (`id_day`),
  ADD KEY `id_seller` (`id_seller`);

--
-- Indexes for table `day_detail`
--
ALTER TABLE `day_detail`
  ADD PRIMARY KEY (`id_day_detail`),
  ADD KEY `id_day` (`id_day`);

--
-- Indexes for table `day_detail_deleted`
--
ALTER TABLE `day_detail_deleted`
  ADD PRIMARY KEY (`id_day_detail`),
  ADD KEY `id_day` (`id_day`);

--
-- Indexes for table `general`
--
ALTER TABLE `general`
  ADD PRIMARY KEY (`general_id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id_Invoice`),
  ADD KEY `id_seller` (`id_seller`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_Invoice` (`id_Invoice`);

--
-- Indexes for table `invoice_details`
--
ALTER TABLE `invoice_details`
  ADD PRIMARY KEY (`id_details_invoice`),
  ADD KEY `id_Invoice` (`id_Invoice`);

--
-- Indexes for table `invoice_details_deleted`
--
ALTER TABLE `invoice_details_deleted`
  ADD PRIMARY KEY (`id_details_invoice`),
  ADD KEY `id_Invoice` (`id_Invoice`);

--
-- Indexes for table `lager`
--
ALTER TABLE `lager`
  ADD PRIMARY KEY (`id_lager`),
  ADD UNIQUE KEY `name` (`name_lager`);

--
-- Indexes for table `lagerartikel`
--
ALTER TABLE `lagerartikel`
  ADD PRIMARY KEY (`lagerartikel_id`);

--
-- Indexes for table `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`id_materials`),
  ADD UNIQUE KEY `name_materials` (`name_materials`);

--
-- Indexes for table `principal`
--
ALTER TABLE `principal`
  ADD PRIMARY KEY (`principal_id`);

--
-- Indexes for table `seller`
--
ALTER TABLE `seller`
  ADD PRIMARY KEY (`id_seller`),
  ADD UNIQUE KEY `number_seller` (`number_seller`),
  ADD UNIQUE KEY `name_seller` (`name_seller`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artikel`
--
ALTER TABLE `artikel`
  MODIFY `id_artikel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `daily`
--
ALTER TABLE `daily`
  MODIFY `id_daily` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21604;

--
-- AUTO_INCREMENT for table `daily_artikel`
--
ALTER TABLE `daily_artikel`
  MODIFY `id_daily_artikel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1214;

--
-- AUTO_INCREMENT for table `day`
--
ALTER TABLE `day`
  MODIFY `id_day` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `day_detail`
--
ALTER TABLE `day_detail`
  MODIFY `id_day_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `day_detail_deleted`
--
ALTER TABLE `day_detail_deleted`
  MODIFY `id_day_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id_Invoice` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `invoice_details`
--
ALTER TABLE `invoice_details`
  MODIFY `id_details_invoice` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `invoice_details_deleted`
--
ALTER TABLE `invoice_details_deleted`
  MODIFY `id_details_invoice` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `lager`
--
ALTER TABLE `lager`
  MODIFY `id_lager` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `lagerartikel`
--
ALTER TABLE `lagerartikel`
  MODIFY `lagerartikel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `materials`
--
ALTER TABLE `materials`
  MODIFY `id_materials` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `seller`
--
ALTER TABLE `seller`
  MODIFY `id_seller` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `day`
--
ALTER TABLE `day`
  ADD CONSTRAINT `day_ibfk_2` FOREIGN KEY (`id_seller`) REFERENCES `seller` (`id_seller`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
