-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 14, 2013 at 03:26 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `db_laboratory`
--
CREATE DATABASE IF NOT EXISTS `db_laboratory` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `db_laboratory`;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_doctors`
--

CREATE TABLE IF NOT EXISTS `tbl_doctors` (
  `doc_id` int(11) NOT NULL AUTO_INCREMENT,
  `doc_hos_id` int(11) DEFAULT NULL,
  `doc_firstName` varchar(45) DEFAULT 'First Name',
  `doc_lastName` varchar(45) DEFAULT 'Last Name',
  `doc_reference` int(11) DEFAULT NULL,
  `doc_sex` varchar(45) DEFAULT NULL,
  `doc_email` varchar(45) DEFAULT NULL,
  `doc_position` varchar(45) DEFAULT NULL,
  `doc_commission` int(11) NOT NULL DEFAULT '0',
  `doc_dateCreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `doc_dateModified` timestamp NULL DEFAULT NULL,
  `doc_status` bit(1) DEFAULT NULL,
  PRIMARY KEY (`doc_id`),
  KEY `fk_tbl_doctors_tbl_doctors1_idx` (`doc_reference`),
  KEY `fk_tbl_doctors_tbl_hostpitals1_idx` (`doc_hos_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tbl_doctors`
--

INSERT INTO `tbl_doctors` (`doc_id`, `doc_hos_id`, `doc_firstName`, `doc_lastName`, `doc_reference`, `doc_sex`, `doc_email`, `doc_position`, `doc_commission`, `doc_dateCreated`, `doc_dateModified`, `doc_status`) VALUES
(6, 1, 'CHEA', 'Rathana', 7, 'm', 'chearathana@gmail.com', '0', 30, '2013-09-03 00:41:15', '2013-10-13 06:27:50', b'1'),
(7, 1, 'SOK', 'Sambath', 6, 'm', 'cheavichet@gmail.com', '0', 10, '2013-09-03 04:01:10', '2013-10-13 01:44:16', b'0'),
(8, 1, 'YAN', 'Chumnou', NULL, 'm', 'chumnou@yahoo.com', 'Doctor', 10, '2013-09-19 06:14:17', '2013-10-13 01:44:20', b'1'),
(9, 1, 'VANN', 'Sukhunthea', 8, 'f', '', 'Doctor', 10, '2013-09-19 06:18:52', '2013-10-13 01:44:25', b'1'),
(10, 1, 'RET', 'Rado', 6, 'm', 'rado@yahoo.com', 'Doctor', 10, '2013-09-19 10:41:10', '2013-10-13 01:44:29', b'1');

--
-- Triggers `tbl_doctors`
--
DROP TRIGGER IF EXISTS `tri_update_tbl_doctors`;
DELIMITER //
CREATE TRIGGER `tri_update_tbl_doctors` BEFORE UPDATE ON `tbl_doctors`
 FOR EACH ROW BEGIN
  SET NEW.doc_dateModified = NOW();
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_doctors_commissions`
--

CREATE TABLE IF NOT EXISTS `tbl_doctors_commissions` (
  `doc_com_id` int(11) NOT NULL AUTO_INCREMENT,
  `doc_com_doc_id` int(11) DEFAULT NULL,
  `doc_com_pat_tes_id` int(11) DEFAULT NULL,
  `doc_com_ammount` float DEFAULT NULL,
  `doc_com_getPaid` bit(1) DEFAULT b'0',
  `doc_com_dateCreated` timestamp NULL DEFAULT NULL,
  `doc_com_dateModified` timestamp NULL DEFAULT NULL,
  `doc_com_status` bit(1) DEFAULT b'1',
  PRIMARY KEY (`doc_com_id`),
  KEY `fk_tbl_doctors_commissions_tbl_patients_tests1_idx` (`doc_com_pat_tes_id`),
  KEY `fk_tbl_doctors_commissions_tbl_doctors1_idx` (`doc_com_doc_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_doctors_commissions`
--

INSERT INTO `tbl_doctors_commissions` (`doc_com_id`, `doc_com_doc_id`, `doc_com_pat_tes_id`, `doc_com_ammount`, `doc_com_getPaid`, `doc_com_dateCreated`, `doc_com_dateModified`, `doc_com_status`) VALUES
(1, 6, 34, 18480, b'0', NULL, NULL, b'1'),
(2, 6, 35, 49305, b'0', NULL, NULL, b'1');

--
-- Triggers `tbl_doctors_commissions`
--
DROP TRIGGER IF EXISTS `tri_update_tbl_doctors_commissions`;
DELIMITER //
CREATE TRIGGER `tri_update_tbl_doctors_commissions` BEFORE UPDATE ON `tbl_doctors_commissions`
 FOR EACH ROW BEGIN
  SET NEW.doc_com_dateModified = NOW();
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_doctors_phones`
--

CREATE TABLE IF NOT EXISTS `tbl_doctors_phones` (
  `doc_pho_id` int(11) NOT NULL AUTO_INCREMENT,
  `doc_pho_doc_id` int(11) NOT NULL,
  `doc_pho_number` varchar(45) NOT NULL,
  PRIMARY KEY (`doc_pho_id`),
  KEY `fk_tbl_doctors_tbl_doctors_phones1` (`doc_pho_doc_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tbl_doctors_phones`
--

INSERT INTO `tbl_doctors_phones` (`doc_pho_id`, `doc_pho_doc_id`, `doc_pho_number`) VALUES
(3, 9, '(855)90887766'),
(5, 10, '(855)98890767'),
(6, 10, '(855)764553212'),
(8, 6, '(855)979895235');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_hospitals`
--

CREATE TABLE IF NOT EXISTS `tbl_hospitals` (
  `hos_id` int(11) NOT NULL AUTO_INCREMENT,
  `hos_name` varchar(45) NOT NULL,
  `hos_address` text,
  `hos_status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`hos_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_hospitals`
--

INSERT INTO `tbl_hospitals` (`hos_id`, `hos_name`, `hos_address`, `hos_status`) VALUES
(1, 'មន្ទីរពេទ្យ​កុមារជាតិ', 'តាមបណ្តោយផ្លូវសហព័ន្ធរុស្ស៊ី', 'on'),
(2, 'មន្ទីរពេទ្យព្រះកុសុមៈ', 'ផ្លូវ ២៧១, សង្កាត់ត្រពាំងឈូក, ខណ្ឌឫស្សីកែវ', 'on'),
(3, 'មន្ទីរពេទ្យសហភាព សូវៀត', 'ស្ទឹងមានជ័យ', 'on');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ills`
--

CREATE TABLE IF NOT EXISTS `tbl_ills` (
  `ill_id` int(11) NOT NULL AUTO_INCREMENT,
  `ill_ill_gro_id` int(11) DEFAULT NULL,
  `ill_name` varchar(45) DEFAULT NULL,
  `ill_nameKh` varchar(45) NOT NULL,
  `ill_price` double NOT NULL DEFAULT '0',
  `ill_dateCreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `ill_dateModified` timestamp NULL DEFAULT NULL,
  `ill_status` bit(1) DEFAULT NULL,
  PRIMARY KEY (`ill_id`),
  KEY `fk_tbl_ills_tbl_ills_groups1_idx` (`ill_ill_gro_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=116 ;

--
-- Dumping data for table `tbl_ills`
--

INSERT INTO `tbl_ills` (`ill_id`, `ill_ill_gro_id`, `ill_name`, `ill_nameKh`, `ill_price`, `ill_dateCreated`, `ill_dateModified`, `ill_status`) VALUES
(3, 1, 'Hg VS', '', 8000, '2013-09-10 07:58:34', '2013-10-13 13:30:07', b'1'),
(4, 1, 'Groupage ABO + Rhésus', '', 8000, '2013-09-10 08:04:00', '2013-10-13 13:30:30', b'1'),
(5, 1, 'Taux de Réticulocytes', '', 6500, '2013-09-10 08:04:28', '2013-10-13 13:30:50', b'1'),
(6, 1, 'TS TC', '', 6500, '2013-09-10 09:34:51', '2013-10-13 13:32:56', b'1'),
(7, 1, 'Taux de Prothrombine', '', 8000, '2013-10-13 13:33:23', '2013-10-13 16:59:07', b'1'),
(8, 1, 'Fibrinogène', '', 8000, '2013-10-13 13:33:34', '2013-10-13 16:59:11', b'1'),
(9, 1, 'TCK ou TCA', '', 8000, '2013-10-13 13:33:42', '2013-10-13 16:59:14', b'1'),
(10, 1, 'CD4 CD8', '', 8000, '2013-10-13 13:33:50', '2013-10-13 16:59:18', b'1'),
(11, 2, 'Anticorps Anti-Hépatite A (IgM)', '', 8000, '2013-10-13 13:34:03', '2013-10-13 16:59:22', b'1'),
(12, 2, 'Antigène HBs (ELISA)', '', 8000, '2013-10-13 13:34:15', '2013-10-13 16:59:25', b'1'),
(13, 2, 'Anticorps Anti-HBs (ELISA)', '', 8000, '2013-10-13 13:34:25', '2013-10-13 16:59:27', b'1'),
(14, 2, 'Antigène HBe (ELISA)', '', 8000, '2013-10-13 13:34:35', '2013-10-13 16:59:30', b'1'),
(15, 2, 'Anticorps Anti-HBe IgM (ELISA)', '', 8000, '2013-10-13 13:34:49', '2013-10-13 16:59:33', b'1'),
(16, 2, 'Anticorops Anti-HBc TOTAL (ELISA)', '', 8000, '2013-10-13 13:35:05', '2013-10-13 16:59:36', b'1'),
(17, 2, 'Anticorps Anti-HBc IgM (ELISA)', '', 8000, '2013-10-13 13:35:16', '2013-10-13 16:59:38', b'1'),
(18, 2, 'Anticorps Anti-HCV (ELISA)', '', 8000, '2013-10-13 13:35:29', '2013-10-13 16:59:41', b'1'),
(19, 3, 'HBV-AND quantitative', '', 8000, '2013-10-13 13:35:55', '2013-10-13 16:59:45', b'1'),
(20, 3, 'HBV-AND qualitative', '', 8000, '2013-10-13 13:36:11', '2013-10-13 16:59:48', b'1'),
(21, 3, 'HBV-GENOTYPE', '', 8000, '2013-10-13 13:36:26', '2013-10-13 16:59:51', b'1'),
(22, 4, 'HCV-ARN quantitative', '', 8000, '2013-10-13 13:38:49', '2013-10-13 16:59:54', b'1'),
(23, 4, 'HCV-GENOTYPE', '', 8000, '2013-10-13 13:39:05', '2013-10-13 16:59:56', b'1'),
(24, 5, 'ASLO', '', 8000, '2013-10-13 13:39:34', '2013-10-13 16:59:59', b'1'),
(25, 5, 'Amibiase', '', 8000, '2013-10-13 13:40:06', '2013-10-13 17:00:01', b'1'),
(26, 5, 'BW (TPHA et VDRL)', '', 8000, '2013-10-13 13:40:20', '2013-10-13 17:00:04', b'1'),
(27, 5, 'Chlamidia trachomatis (IgM)', '', 8000, '2013-10-13 13:40:33', '2013-10-13 17:00:06', b'1'),
(28, 5, 'Chlamidia trachomatis (IgG)', '', 8000, '2013-10-13 13:40:47', '2013-10-13 17:00:10', b'1'),
(29, 5, 'CMV-IgG', '', 8000, '2013-10-13 13:41:07', '2013-10-13 17:00:13', b'1'),
(30, 5, 'Facteurs Rhumatoides', '', 8000, '2013-10-13 13:41:28', '2013-10-13 17:00:17', b'1'),
(31, 5, 'H.pylori (IgM)', '', 8000, '2013-10-13 13:42:00', '2013-10-13 17:00:20', b'1'),
(32, 5, 'H.pylori (IgG)', '', 8000, '2013-10-13 13:42:18', '2013-10-13 17:00:25', b'1'),
(33, 5, 'IgE totales', '', 8000, '2013-10-13 13:42:40', '2013-10-13 17:00:37', b'1'),
(34, 5, 'Leptospirose', '', 8000, '2013-10-13 13:42:54', '2013-10-13 17:00:40', b'1'),
(35, 5, 'Reubéole IgG', '', 8000, '2013-10-13 13:43:08', '2013-10-13 17:00:43', b'1'),
(36, 5, 'Rose Bengale (Brucellose)', '', 8000, '2013-10-13 13:43:27', '2013-10-13 17:00:45', b'1'),
(37, 5, 'Toxoplasmose IgM', '', 8000, '2013-10-13 13:43:43', '2013-10-13 17:00:49', b'1'),
(38, 5, 'Toxoplasmose IgG', '', 8000, '2013-10-13 13:44:05', '2013-10-13 17:00:53', b'1'),
(39, 5, 'Widal', '', 8000, '2013-10-13 13:44:38', '2013-10-13 17:00:55', b'1'),
(40, 6, 'Examen á l'' état frais et Gram', '', 8000, '2013-10-13 13:45:14', '2013-10-13 17:00:58', b'1'),
(41, 6, 'Culture et Antibiogramme', '', 8000, '2013-10-13 13:45:29', '2013-10-13 17:01:02', b'1'),
(42, 7, 'Acide urique', '', 8000, '2013-10-13 13:47:17', '2013-10-13 17:01:07', b'1'),
(43, 7, 'Albumine', '', 8000, '2013-10-13 13:47:36', '2013-10-13 17:01:11', b'1'),
(44, 7, 'Bilirubine totale et directe', '', 8000, '2013-10-13 13:47:48', '2013-10-13 17:01:14', b'1'),
(45, 7, 'Bicarbonates', '', 8000, '2013-10-13 13:48:24', '2013-10-13 17:01:16', b'1'),
(46, 7, 'C-Réactive Proteine (CRP)', '', 8000, '2013-10-13 13:48:45', '2013-10-13 17:01:19', b'1'),
(47, 7, 'Calcémie', '', 8000, '2013-10-13 13:49:01', '2013-10-13 17:01:26', b'1'),
(48, 7, 'Cholesterol totale', '', 8000, '2013-10-13 13:49:39', '2013-10-13 17:01:30', b'1'),
(49, 7, 'Cholestérol-HDL', '', 8000, '2013-10-13 13:50:03', '2013-10-13 17:01:33', b'1'),
(50, 7, 'Cholestérol-LDL', '', 8000, '2013-10-13 13:50:17', '2013-10-13 17:01:36', b'1'),
(51, 7, 'Cholestérol-VLDL', '', 8000, '2013-10-13 13:50:31', '2013-10-13 17:01:40', b'1'),
(52, 7, 'Créatinine', '', 8000, '2013-10-13 13:50:44', '2013-10-13 17:01:42', b'1'),
(53, 7, 'Electrophorèses des Hémoglobines', '', 8000, '2013-10-13 13:50:59', '2013-10-13 17:01:44', b'1'),
(54, 7, 'EElectrophorèses des protéines', '', 8000, '2013-10-13 13:51:17', '2013-10-13 17:01:47', b'1'),
(55, 7, 'Fer Sérique', '', 8000, '2013-10-13 13:51:32', '2013-10-13 17:01:49', b'1'),
(56, 7, 'Folate', '', 8000, '2013-10-13 13:51:50', '2013-10-13 17:01:51', b'1'),
(57, 7, 'Glycémie', '', 8000, '2013-10-13 13:52:06', '2013-10-13 17:01:53', b'1'),
(58, 7, 'Hémolobine Glycosylée (HbAle)', '', 8000, '2013-10-13 13:52:20', '2013-10-13 17:01:55', b'1'),
(59, 7, 'lonogramme', '', 8000, '2013-10-13 13:52:34', '2013-10-13 17:01:57', b'1'),
(60, 7, 'Lithium', '', 8000, '2013-10-13 13:52:47', '2013-10-13 17:02:01', b'1'),
(61, 7, 'Magnésium Sérique', '', 8000, '2013-10-13 13:52:59', '2013-10-13 17:02:03', b'1'),
(62, 7, 'Protéine totale', '', 8000, '2013-10-13 13:53:12', '2013-10-13 17:02:06', b'1'),
(63, 7, 'Phosphorémie', '', 8000, '2013-10-13 13:53:32', '2013-10-13 17:02:08', b'1'),
(64, 7, 'Triglycérides', '', 8000, '2013-10-13 13:53:48', '2013-10-13 17:02:10', b'1'),
(65, 7, 'Urée sanguine', '', 8000, '2013-10-13 13:54:08', '2013-10-13 17:02:12', b'1'),
(66, 7, 'Vitamine B12', '', 8000, '2013-10-13 13:54:21', '2013-10-13 17:02:14', b'1'),
(67, 8, 'Amylasémie', '', 8000, '2013-10-13 13:54:47', '2013-10-13 17:02:17', b'1'),
(68, 8, 'CPK', '', 8000, '2013-10-13 13:55:03', '2013-10-13 17:02:19', b'1'),
(69, 8, 'CPK-MB', '', 8000, '2013-10-13 13:55:19', '2013-10-13 17:02:21', b'1'),
(70, 8, 'Gamma-G-T', '', 8000, '2013-10-13 13:55:37', '2013-10-13 17:02:23', b'1'),
(71, 8, 'LDH', '', 8000, '2013-10-13 13:55:54', '2013-10-13 17:02:26', b'1'),
(72, 8, 'PAL', '', 8000, '2013-10-13 13:56:05', '2013-10-13 17:02:28', b'1'),
(73, 8, 'Phosphatasses Acides Prostatiques', '', 8000, '2013-10-13 13:56:17', '2013-10-13 17:02:31', b'1'),
(74, 8, 'PPhosphatases Acides Totles', '', 8000, '2013-10-13 13:56:31', '2013-10-13 17:02:35', b'1'),
(75, 8, 'Transaminases', '', 8000, '2013-10-13 13:56:48', '2013-10-13 17:02:39', b'1'),
(76, 9, 'H.I.V 1+2 (ELISA)', '', 8000, '2013-10-13 13:57:19', '2013-10-13 17:02:42', b'1'),
(77, 9, 'H.I.V 1+2 (WESTERN-BLOT)', '', 8000, '2013-10-13 13:57:31', '2013-10-13 17:02:44', b'1'),
(78, 10, 'AFP', '', 8000, '2013-10-13 13:59:48', '2013-10-13 17:02:46', b'1'),
(79, 10, 'ACE', '', 8000, '2013-10-13 14:00:03', '2013-10-13 17:02:49', b'1'),
(80, 10, 'C A 125', '', 8000, '2013-10-13 14:00:15', '2013-10-13 17:02:52', b'1'),
(81, 10, 'C A 15-3', '', 8000, '2013-10-13 14:00:27', '2013-10-13 17:02:55', b'1'),
(82, 10, 'C A 19-9', '', 8000, '2013-10-13 14:01:17', '2013-10-13 17:02:58', b'1'),
(83, 10, 'CA 72-4', '', 8000, '2013-10-13 14:01:34', '2013-10-13 17:03:00', b'1'),
(84, 10, 'PSA', '', 8000, '2013-10-13 14:01:49', '2013-10-13 17:03:03', b'1'),
(85, 10, 'f PSA', '', 8000, '2013-10-13 14:02:06', '2013-10-13 17:03:06', b'1'),
(86, 10, 'Ferritine', '', 8000, '2013-10-13 14:02:15', '2013-10-13 17:03:09', b'1'),
(87, 10, 'SCC', '', 8000, '2013-10-13 14:02:30', '2013-10-13 17:03:12', b'1'),
(88, 11, 'Cortisol à 8 h', '', 8000, '2013-10-13 14:08:59', '2013-10-13 17:03:14', b'1'),
(89, 11, 'Béta HCG (quantitative)', '', 8000, '2013-10-13 14:09:14', '2013-10-13 17:03:17', b'1'),
(90, 11, 'HCG (qualitative)', '', 8000, '2013-10-13 14:09:27', '2013-10-13 17:03:20', b'1'),
(91, 11, 'T3 totale', '', 8000, '2013-10-13 14:09:39', '2013-10-13 17:03:22', b'1'),
(92, 11, 'T4 totale', '', 8000, '2013-10-13 14:09:50', '2013-10-13 17:03:25', b'1'),
(93, 11, 'PTH', '', 8000, '2013-10-13 14:10:03', '2013-10-13 17:03:27', b'1'),
(94, 11, 'T3 libre (fT3)', '', 8000, '2013-10-13 14:10:15', '2013-10-13 17:03:30', b'1'),
(95, 11, 'T4 libre (fT4)', '', 8000, '2013-10-13 14:10:27', '2013-10-13 17:03:32', b'1'),
(96, 11, 'TSH', '', 8000, '2013-10-13 14:10:40', '2013-10-13 17:03:35', b'1'),
(97, 12, 'Sérologie Tuberculose (BK) Ou IgGAM-TB (Sérum', '', 8000, '2013-10-13 14:10:59', '2013-10-13 17:03:37', b'1'),
(98, 12, 'Sérologie TubercCrachats', '', 8000, '2013-10-13 14:11:19', '2013-10-13 17:03:46', b'1'),
(99, 12, 'Urines', '', 8000, '2013-10-13 14:11:32', '2013-10-13 17:03:49', b'1'),
(100, 12, 'Selles', '', 8000, '2013-10-13 14:11:42', '2013-10-13 17:03:52', b'1'),
(101, 13, 'Proténes, Glucose, Cytologie', '', 8000, '2013-10-13 14:12:00', '2013-10-13 17:03:54', b'1'),
(102, 13, 'Rivalta', '', 8000, '2013-10-13 14:12:17', '2013-10-13 17:03:57', b'1'),
(103, 13, 'Culture', '', 8000, '2013-10-13 14:12:31', '2013-10-13 17:03:59', b'1'),
(104, 14, 'Spermogramme', '', 8000, '2013-10-13 14:12:55', '2013-10-13 17:04:01', b'1'),
(105, 14, 'Spermoculture', '', 8000, '2013-10-13 14:13:10', '2013-10-13 17:04:04', b'1'),
(106, 15, 'Opiacés', '', 8000, '2013-10-13 14:13:33', '2013-10-13 17:04:07', b'1'),
(107, 15, 'Amphétamine', '', 8000, '2013-10-13 14:13:45', '2013-10-13 17:04:09', b'1'),
(108, 15, 'Cannabinoides', '', 8000, '2013-10-13 14:13:57', '2013-10-13 17:04:11', b'1'),
(109, 15, 'Cocaine', '', 8000, '2013-10-13 14:14:09', '2013-10-13 17:04:13', b'1'),
(110, 16, 'Examen direct et enrichement', '', 8000, '2013-10-13 14:14:31', '2013-10-13 17:04:15', b'1'),
(111, 16, 'Coproculture', '', 8000, '2013-10-13 14:14:48', '2013-10-13 17:04:17', b'1'),
(112, 17, 'Albumine, Surce, Cytologie urinaire', '', 8000, '2013-10-13 14:15:13', '2013-10-13 17:04:20', b'1'),
(113, 17, 'Uroculture', '', 8000, '2013-10-13 14:15:40', '2013-10-13 17:04:23', b'1'),
(114, 18, 'Recherche d''Hématozoaires', '', 8000, '2013-10-13 14:16:24', '2013-10-13 17:04:25', b'1'),
(115, 19, 'Anapath', '', 8000, '2013-10-13 14:16:51', '2013-10-13 17:04:28', b'1');

--
-- Triggers `tbl_ills`
--
DROP TRIGGER IF EXISTS `tri_update_tbl_ills`;
DELIMITER //
CREATE TRIGGER `tri_update_tbl_ills` BEFORE UPDATE ON `tbl_ills`
 FOR EACH ROW BEGIN
  SET NEW.ill_dateModified = NOW();
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ills_groups`
--

CREATE TABLE IF NOT EXISTS `tbl_ills_groups` (
  `ill_gro_id` int(11) NOT NULL AUTO_INCREMENT,
  `ill_gro_name` varchar(45) DEFAULT NULL,
  `ill_gro_nameKh` varchar(45) NOT NULL,
  `ill_gro_description` text,
  `ill_gro_dateCreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `ill_gro_dateModified` timestamp NULL DEFAULT NULL,
  `ill_gro_status` bit(1) DEFAULT NULL,
  PRIMARY KEY (`ill_gro_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `tbl_ills_groups`
--

INSERT INTO `tbl_ills_groups` (`ill_gro_id`, `ill_gro_name`, `ill_gro_nameKh`, `ill_gro_description`, `ill_gro_dateCreated`, `ill_gro_dateModified`, `ill_gro_status`) VALUES
(1, 'HEMATOLOGIE', 'ហេម៉ាតូឡូជី', '', '2013-09-09 11:19:18', '2013-10-13 09:50:51', b'1'),
(2, 'HEPATITES A,B,C', 'ថ្លើម​ធម្មតា ប្រភេទ អា បេ សេ', '', '2013-09-09 11:19:21', '2013-10-13 09:51:39', b'1'),
(3, 'PCR DE L''HEPATITE B', '', '', '2013-09-09 11:19:26', '2013-10-13 03:05:08', b'1'),
(4, 'PCR DE L''HEPATITE C', '', '', '2013-09-09 11:19:29', '2013-10-13 03:05:26', b'1'),
(5, 'SEROLOGIE ET IMMUNOLOGIE', '', '', '2013-10-12 11:53:49', '2013-10-13 04:29:07', b'1'),
(6, 'MICROBIOLOGIE', '', '', '2013-10-13 04:29:34', NULL, b'1'),
(7, 'BIOCHIMIE SANGUINE', '', '', '2013-10-13 04:29:54', NULL, b'1'),
(8, 'ENZYMOLOGIE', '', '', '2013-10-13 04:30:13', NULL, b'1'),
(9, 'SEROLOGIE H.I.V', '', '', '2013-10-13 04:30:31', NULL, b'1'),
(10, 'MARQUEURS TUMORAUX', '', '', '2013-10-13 04:30:44', NULL, b'1'),
(11, 'HORMONOGIE', '', '', '2013-10-13 04:30:55', NULL, b'1'),
(12, 'RECHERCHE DU B,K', '', '', '2013-10-13 04:31:08', NULL, b'1'),
(13, 'LCR, PLEURALE, SYNOVIAL', '', '', '2013-10-13 04:31:18', NULL, b'1'),
(14, 'EXAMEN DU SPERMME', '', '', '2013-10-13 04:31:30', NULL, b'1'),
(15, 'TOXICOLOGIE', '', '', '2013-10-13 04:31:42', NULL, b'1'),
(16, 'PARASITOLOGIE DES SELLES', '', '', '2013-10-13 04:31:52', NULL, b'1'),
(17, 'BIOCHIMIE URINAIRE', '', '', '2013-10-13 04:32:00', NULL, b'1'),
(18, 'PARASITOLOGIE SANGUINE', '', '', '2013-10-13 04:32:12', NULL, b'1'),
(19, 'HISTOPATHOLOGIE', '', '', '2013-10-13 04:32:23', NULL, b'1'),
(20, 'AUTRE TESTS', '', '', '2013-10-13 04:32:32', NULL, b'1');

--
-- Triggers `tbl_ills_groups`
--
DROP TRIGGER IF EXISTS `tri_update_tbl_ills_groups`;
DELIMITER //
CREATE TRIGGER `tri_update_tbl_ills_groups` BEFORE UPDATE ON `tbl_ills_groups`
 FOR EACH ROW BEGIN
  SET NEW.ill_gro_dateModified = NOW();
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ills_items`
--

CREATE TABLE IF NOT EXISTS `tbl_ills_items` (
  `ill_ite_id` int(11) NOT NULL AUTO_INCREMENT,
  `ill_ite_ill_id` int(11) DEFAULT NULL,
  `ill_ite_name` varchar(45) NOT NULL,
  `ill_ite_description` text,
  `ill_ite_dimention` varchar(45) NOT NULL,
  `ill_ite_value_male` varchar(45) NOT NULL,
  `ill_ite_value_female` varchar(45) NOT NULL,
  `ill_ite_dateCreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `ill_ite_dateModified` timestamp NULL DEFAULT NULL,
  `ill_ite_status` bit(1) DEFAULT NULL,
  PRIMARY KEY (`ill_ite_id`),
  KEY `fk_tbl_ills_items_tbl_ills_idx` (`ill_ite_ill_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tbl_ills_items`
--

INSERT INTO `tbl_ills_items` (`ill_ite_id`, `ill_ite_ill_id`, `ill_ite_name`, `ill_ite_description`, `ill_ite_dimention`, `ill_ite_value_male`, `ill_ite_value_female`, `ill_ite_dateCreated`, `ill_ite_dateModified`, `ill_ite_status`) VALUES
(1, 4, 'GB', '', 'x10⁹/1', '3.5-10', '3.5-10', '2013-09-10 10:33:34', '2013-10-13 14:59:29', b'1'),
(2, 6, 'GR', '', 'x10₁₂/1', '3.50-5.50', '3.50-5.50', '2013-09-10 10:46:58', '2013-10-13 14:58:29', b'1'),
(3, 3, 'Hb', '', 'x10⁹/1', '11.5-16.5', '11.5-16.5', '2013-09-10 10:47:23', '2013-10-13 14:57:32', b'1'),
(4, 4, 'GVR', '', 'x10₁₂/1', '2.5-11', '2-10.5', '2013-10-13 16:56:44', NULL, b'1'),
(5, 11, 'AAHA-1', '', 'x10⁹/1', '1-10', '2-11', '2013-10-13 16:57:34', NULL, b'1'),
(6, 11, 'AAHA-2', '', 'x10⁹/1', '1-10', '2-11', '2013-10-13 16:57:45', NULL, b'1'),
(7, 11, 'AAHA-3', '', 'x10⁹/1', '1-10', '2-11', '2013-10-13 16:57:49', NULL, b'1');

--
-- Triggers `tbl_ills_items`
--
DROP TRIGGER IF EXISTS `tri_update_tbl_ills_items`;
DELIMITER //
CREATE TRIGGER `tri_update_tbl_ills_items` BEFORE UPDATE ON `tbl_ills_items`
 FOR EACH ROW BEGIN
  SET NEW.ill_ite_dateModified = NOW();
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_patients`
--

CREATE TABLE IF NOT EXISTS `tbl_patients` (
  `pat_id` int(11) NOT NULL AUTO_INCREMENT,
  `pat_doc_id` int(11) DEFAULT NULL,
  `pat_firstName` varchar(45) DEFAULT NULL,
  `pat_lastName` varchar(45) DEFAULT NULL,
  `pat_sex` char(1) DEFAULT NULL,
  `pat_identityCard` int(11) DEFAULT NULL,
  `pat_email` varchar(30) DEFAULT NULL,
  `pat_dateCreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `pat_dateModified` timestamp NULL DEFAULT NULL,
  `pat_status` bit(1) DEFAULT NULL,
  PRIMARY KEY (`pat_id`),
  KEY `fk_tbl_doctors_tbl_patients1` (`pat_doc_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `tbl_patients`
--

INSERT INTO `tbl_patients` (`pat_id`, `pat_doc_id`, `pat_firstName`, `pat_lastName`, `pat_sex`, `pat_identityCard`, `pat_email`, `pat_dateCreated`, `pat_dateModified`, `pat_status`) VALUES
(4, NULL, 'SOK', 'Chumnou', 'm', 0, '', '2013-09-06 17:41:49', '2013-10-13 16:26:56', b'1'),
(5, 6, 'SENG', 'Rathana', 'm', 0, '', '2013-09-06 17:41:49', '2013-09-15 11:41:43', b'1'),
(9, NULL, 'CHEA', 'Dararith', 'm', NULL, NULL, '2013-09-06 17:47:44', '2013-09-15 11:17:51', b'1'),
(10, 6, 'SUON', 'Dara', 'f', 1222328839, '', '2013-09-19 11:42:15', '2013-10-11 13:31:44', b'1'),
(11, NULL, 'SENG', 'Dara', 'm', 990099878, '', '2013-09-22 09:35:31', NULL, b'1'),
(12, NULL, 'SOU', 'Sopheap', 'm', 0, '', '2013-09-22 09:37:17', NULL, b'1'),
(13, NULL, 'SRENG', 'Sokneath', 'm', 899899989, '', '2013-09-22 09:42:49', NULL, b'1'),
(14, NULL, 'Vannak', 'PEN', 'm', 10681635, 'vannakpen@gmail.com', '2013-10-10 15:27:49', NULL, b'1');

--
-- Triggers `tbl_patients`
--
DROP TRIGGER IF EXISTS `tri_update_tbl_patients`;
DELIMITER //
CREATE TRIGGER `tri_update_tbl_patients` BEFORE UPDATE ON `tbl_patients`
 FOR EACH ROW BEGIN
  SET NEW.pat_dateModified = NOW();
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_patients_phones`
--

CREATE TABLE IF NOT EXISTS `tbl_patients_phones` (
  `pat_pho_id` int(11) NOT NULL AUTO_INCREMENT,
  `pat_pho_pat_id` int(11) NOT NULL,
  `pat_pho_number` varchar(45) NOT NULL,
  PRIMARY KEY (`pat_pho_id`),
  KEY `fk_tbl_patients_phones_tbl_patients1` (`pat_pho_pat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tbl_patients_phones`
--

INSERT INTO `tbl_patients_phones` (`pat_pho_id`, `pat_pho_pat_id`, `pat_pho_number`) VALUES
(2, 10, '(855)12908978'),
(3, 10, '(855)90998877'),
(4, 11, '(855)12333322'),
(5, 12, '(855)99889090'),
(6, 13, '(855)89112332'),
(7, 14, '(855)10681635');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_patients_tests`
--

CREATE TABLE IF NOT EXISTS `tbl_patients_tests` (
  `pat_tes_id` int(11) NOT NULL AUTO_INCREMENT,
  `pat_tes_pat_id` int(11) NOT NULL,
  `pat_tes_use_id` int(11) NOT NULL,
  `pat_tes_dateTimeReceived` timestamp NULL DEFAULT NULL,
  `pat_tes_isReceive` bit(1) DEFAULT b'0',
  `pat_tes_isResult` bit(1) DEFAULT b'0',
  `pat_tes_isReceiveIll` bit(1) DEFAULT b'0',
  `pat_tes_subTotal` double DEFAULT '0',
  `pat_tes_total` double DEFAULT '0',
  `pat_tes_isPaid` bit(1) NOT NULL DEFAULT b'0',
  `pat_tes_deposit` double DEFAULT '0',
  `pat_tes_owe` double DEFAULT '0',
  `pat_tes_discount` int(11) DEFAULT '0',
  `pat_tes_doctorCommission` int(11) DEFAULT '0',
  `pat_tes_dateCreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `pat_tes_dateModified` timestamp NULL DEFAULT NULL,
  `pat_tes_tax` int(11) DEFAULT '0',
  `pat_tes_status` bit(1) DEFAULT b'1',
  PRIMARY KEY (`pat_tes_id`),
  KEY `fk_tbl_patients_tests_tbl_users1_idx` (`pat_tes_use_id`),
  KEY `fk_tbl_patients_tests_tbl_patients1_idx` (`pat_tes_pat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=42 ;

--
-- Dumping data for table `tbl_patients_tests`
--

INSERT INTO `tbl_patients_tests` (`pat_tes_id`, `pat_tes_pat_id`, `pat_tes_use_id`, `pat_tes_dateTimeReceived`, `pat_tes_isReceive`, `pat_tes_isResult`, `pat_tes_isReceiveIll`, `pat_tes_subTotal`, `pat_tes_total`, `pat_tes_isPaid`, `pat_tes_deposit`, `pat_tes_owe`, `pat_tes_discount`, `pat_tes_doctorCommission`, `pat_tes_dateCreated`, `pat_tes_dateModified`, `pat_tes_tax`, `pat_tes_status`) VALUES
(33, 4, 4, '2013-10-15 05:00:00', b'0', b'1', b'1', 69000, 48300, b'1', 69000, 0, 30, 0, '2013-10-13 18:43:34', '2013-10-13 19:30:49', 0, b'1'),
(34, 5, 4, '2013-10-15 06:00:00', b'0', b'0', b'1', 77000, 43120, b'1', 77000, 0, 20, 18480, '2013-10-13 18:46:02', NULL, 0, b'1'),
(35, 5, 4, '2013-10-13 19:02:00', b'0', b'1', b'1', 173000, 115045, b'1', 173000, 0, 5, 49305, '2013-10-13 19:02:40', '2013-10-13 19:24:09', 0, b'1'),
(36, 4, 4, '2013-10-15 01:00:00', b'0', b'0', b'1', 24000, 24000, b'1', 24000, 0, 0, 0, '2013-10-13 20:49:58', NULL, 0, b'1'),
(37, 4, 4, '2013-10-13 20:57:00', b'0', b'0', b'1', 56000, 50400, b'0', 5000, 51000, 5, 0, '2013-10-13 21:09:10', NULL, 5, b'1'),
(38, 4, 4, '2013-10-13 20:57:00', b'0', b'0', b'1', 56000, 50400, b'0', 5000, 51000, 5, 0, '2013-10-13 21:12:41', NULL, 5, b'1'),
(39, 4, 4, '2013-10-13 20:57:00', b'0', b'0', b'1', 56000, 50400, b'0', 5000, 51000, 5, 0, '2013-10-13 21:13:20', NULL, 5, b'1'),
(40, 4, 4, '2013-10-13 20:57:00', b'0', b'0', b'1', 56000, 50400, b'0', 5000, 51000, 5, 0, '2013-10-13 21:13:26', NULL, 5, b'1'),
(41, 4, 4, '2013-10-13 21:20:00', b'0', b'0', b'1', 16000, 15200, b'1', 16000, 0, 0, 0, '2013-10-13 21:20:49', NULL, 5, b'1');

--
-- Triggers `tbl_patients_tests`
--
DROP TRIGGER IF EXISTS `tri_update_tbl_patients_tests`;
DELIMITER //
CREATE TRIGGER `tri_update_tbl_patients_tests` BEFORE UPDATE ON `tbl_patients_tests`
 FOR EACH ROW BEGIN
  SET NEW.pat_tes_dateModified = NOW();
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_patients_tests_has_tbl_ills`
--

CREATE TABLE IF NOT EXISTS `tbl_patients_tests_has_tbl_ills` (
  `pat_tes_id` int(11) NOT NULL,
  `ill_id` int(11) NOT NULL,
  PRIMARY KEY (`pat_tes_id`,`ill_id`),
  KEY `fk_tbl_patients_tests_has_tbl_ills_tbl_ills1_idx` (`ill_id`),
  KEY `fk_tbl_patients_tests_has_tbl_ills_tbl_patients_tests1_idx` (`pat_tes_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_patients_tests_has_tbl_ills`
--

INSERT INTO `tbl_patients_tests_has_tbl_ills` (`pat_tes_id`, `ill_id`) VALUES
(33, 3),
(34, 3),
(35, 3),
(36, 3),
(37, 3),
(38, 3),
(39, 3),
(40, 3),
(41, 3),
(33, 4),
(34, 4),
(35, 4),
(36, 4),
(37, 4),
(38, 4),
(39, 4),
(40, 4),
(41, 4),
(33, 5),
(34, 5),
(35, 5),
(33, 6),
(34, 6),
(35, 6),
(34, 7),
(35, 7),
(35, 8),
(33, 11),
(34, 11),
(35, 11),
(36, 11),
(37, 11),
(38, 11),
(39, 11),
(40, 11),
(33, 12),
(34, 12),
(35, 12),
(37, 12),
(38, 12),
(39, 12),
(40, 12),
(33, 13),
(34, 13),
(35, 13),
(37, 13),
(38, 13),
(39, 13),
(40, 13),
(33, 14),
(35, 14),
(33, 15),
(35, 15),
(34, 19),
(35, 19),
(37, 19),
(38, 19),
(39, 19),
(40, 19),
(34, 20),
(35, 20),
(37, 20),
(38, 20),
(39, 20),
(40, 20),
(35, 21),
(35, 22),
(35, 23),
(35, 24),
(35, 25),
(35, 26),
(35, 27),
(35, 28),
(35, 29);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_patients_tests_results`
--

CREATE TABLE IF NOT EXISTS `tbl_patients_tests_results` (
  `pat_tes_res_id` int(11) NOT NULL AUTO_INCREMENT,
  `pat_tes_res_pat_tes_id` int(11) DEFAULT NULL,
  `pat_tes_res_ill_ite_id` int(11) DEFAULT NULL,
  `pat_tes_res_value` float DEFAULT NULL,
  `pat_tes_res_dateCreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `pat_tes_res_dateModified` timestamp NULL DEFAULT NULL,
  `pat_tes_res_status` bit(1) DEFAULT b'1',
  PRIMARY KEY (`pat_tes_res_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `tbl_patients_tests_results`
--

INSERT INTO `tbl_patients_tests_results` (`pat_tes_res_id`, `pat_tes_res_pat_tes_id`, `pat_tes_res_ill_ite_id`, `pat_tes_res_value`, `pat_tes_res_dateCreated`, `pat_tes_res_dateModified`, `pat_tes_res_status`) VALUES
(1, 35, 1, 5, '2013-10-13 19:24:09', NULL, b'1'),
(2, 35, 4, 8, '2013-10-13 19:24:09', NULL, b'1'),
(3, 35, 3, 9, '2013-10-13 19:24:09', NULL, b'1'),
(4, 35, 2, 10, '2013-10-13 19:24:09', NULL, b'1'),
(5, 35, 5, 6, '2013-10-13 19:24:09', NULL, b'1'),
(6, 35, 6, 8, '2013-10-13 19:24:09', NULL, b'1'),
(7, 35, 7, 9, '2013-10-13 19:24:09', NULL, b'1'),
(8, 33, 1, 6, '2013-10-13 19:30:49', NULL, b'1'),
(9, 33, 4, 6, '2013-10-13 19:30:49', NULL, b'1'),
(10, 33, 3, 12, '2013-10-13 19:30:49', NULL, b'1'),
(11, 33, 2, 2, '2013-10-13 19:30:49', NULL, b'1'),
(12, 33, 5, 7, '2013-10-13 19:30:49', NULL, b'1'),
(13, 33, 6, 9, '2013-10-13 19:30:49', NULL, b'1'),
(14, 33, 7, 10, '2013-10-13 19:30:49', NULL, b'1');

--
-- Triggers `tbl_patients_tests_results`
--
DROP TRIGGER IF EXISTS `tri_update_tbl_patients_tests_results`;
DELIMITER //
CREATE TRIGGER `tri_update_tbl_patients_tests_results` BEFORE UPDATE ON `tbl_patients_tests_results`
 FOR EACH ROW BEGIN
  SET NEW.pat_tes_res_dateModified = NOW();
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE IF NOT EXISTS `tbl_users` (
  `use_id` int(11) NOT NULL AUTO_INCREMENT,
  `use_gro_id` int(11) NOT NULL,
  `use_username` varchar(45) NOT NULL,
  `use_password` varchar(45) NOT NULL,
  `use_fullName` varchar(45) DEFAULT NULL,
  `use_dateCreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `use_dateModified` timestamp NULL DEFAULT NULL,
  `use_status` bit(1) DEFAULT b'1',
  `use_firstName` varchar(50) DEFAULT NULL,
  `use_lastName` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`use_id`),
  KEY `fk_tbl_users_tbl_users_groups1_idx` (`use_gro_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`use_id`, `use_gro_id`, `use_username`, `use_password`, `use_fullName`, `use_dateCreated`, `use_dateModified`, `use_status`, `use_firstName`, `use_lastName`) VALUES
(1, 1, 'admin@laboratory.com', '21232f297a57a5a743894a0e4a801fc3', '0', '2013-09-02 12:53:57', '2013-10-13 11:25:46', b'1', 'ADMIN', 'Administrator'),
(4, 1, 'vannak@laboratory.com', '3df89cfbd86f19c7767771199b957f9d787747cf', '0', '2013-09-03 00:48:22', '2013-10-10 19:14:23', b'1', 'PEN', 'Vannak'),
(9, 1, 'sochy.choeun@gmail.com', 'f749822ef408516aa28afab8a41c37329d7ec2fd', '0', '2013-09-09 11:03:00', '2013-10-10 19:14:12', b'1', 'CHOEUN', 'Sochy'),
(10, 2, 'sochy.g@gmail.com', 'f749822ef408516aa28afab8a41c37329d7ec2fd', '0', '2013-09-09 11:09:48', '2013-10-13 09:48:24', b'1', 'GGGGGG', 'Sochy');

--
-- Triggers `tbl_users`
--
DROP TRIGGER IF EXISTS `tri_insert_tbl_users`;
DELIMITER //
CREATE TRIGGER `tri_insert_tbl_users` BEFORE INSERT ON `tbl_users`
 FOR EACH ROW BEGIN
  SET NEW.use_fullName = NEW.use_firstName + ' ' + NEW.use_lastName;
END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `tri_update_tbl_users`;
DELIMITER //
CREATE TRIGGER `tri_update_tbl_users` BEFORE UPDATE ON `tbl_users`
 FOR EACH ROW BEGIN
  	SET NEW.use_dateModified = NOW(),
	NEW.use_fullName = NEW.use_firstName + ' ' + NEW.use_lastName;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users_groups`
--

CREATE TABLE IF NOT EXISTS `tbl_users_groups` (
  `gro_id` int(11) NOT NULL AUTO_INCREMENT,
  `gro_name` varchar(45) NOT NULL,
  `gro_description` text,
  PRIMARY KEY (`gro_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_users_groups`
--

INSERT INTO `tbl_users_groups` (`gro_id`, `gro_name`, `gro_description`) VALUES
(1, 'administrator', 'Administrator Role'),
(2, 'asssistant', 'Assistant role');

-- --------------------------------------------------------

--
-- Stand-in structure for view `vie_doctors`
--
CREATE TABLE IF NOT EXISTS `vie_doctors` (
`doc_id` int(11)
,`doc_hos_id` int(11)
,`doc_firstName` varchar(45)
,`doc_lastName` varchar(45)
,`doc_reference` int(11)
,`doc_sex` varchar(45)
,`doc_email` varchar(45)
,`doc_position` varchar(45)
,`doc_dateCreated` timestamp
,`doc_dateModified` timestamp
,`doc_status` bit(1)
,`doc_ref_name` varchar(91)
,`hos_name` varchar(45)
,`doc_pho_number` varchar(45)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `vie_ills_items`
--
CREATE TABLE IF NOT EXISTS `vie_ills_items` (
`ill_gro_id` int(11)
,`ill_gro_name` varchar(45)
,`ill_gro_status` bit(1)
,`ill_id` int(11)
,`ill_name` varchar(45)
,`ill_status` bit(1)
,`ill_ite_id` int(11)
,`ill_ite_ill_id` int(11)
,`ill_ite_name` varchar(45)
,`ill_ite_description` text
,`ill_ite_dimention` varchar(45)
,`ill_ite_value_male` varchar(45)
,`ill_ite_value_female` varchar(45)
,`ill_ite_dateCreated` timestamp
,`ill_ite_dateModified` timestamp
,`ill_ite_status` bit(1)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `vie_patients`
--
CREATE TABLE IF NOT EXISTS `vie_patients` (
`pat_id` int(11)
,`pat_doc_id` int(11)
,`pat_firstName` varchar(45)
,`pat_lastName` varchar(45)
,`pat_sex` char(1)
,`pat_identityCard` int(11)
,`pat_email` varchar(30)
,`pat_dateCreated` timestamp
,`pat_dateModified` timestamp
,`pat_status` bit(1)
,`doc_name` varchar(91)
,`pat_pho_number` varchar(45)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `vie_patients_tests`
--
CREATE TABLE IF NOT EXISTS `vie_patients_tests` (
`pat_tes_id` int(11)
,`pat_tes_pat_id` int(11)
,`pat_tes_use_id` int(11)
,`pat_tes_dateTimeReceived` timestamp
,`pat_tes_isReceive` bit(1)
,`pat_tes_isResult` bit(1)
,`pat_tes_isReceiveIll` bit(1)
,`pat_tes_subTotal` double
,`pat_tes_total` double
,`pat_tes_isPaid` bit(1)
,`pat_tes_deposit` double
,`pat_tes_owe` double
,`pat_tes_discount` int(11)
,`pat_tes_doctorCommission` int(11)
,`pat_tes_dateCreated` timestamp
,`pat_tes_dateModified` timestamp
,`pat_tes_tax` int(11)
,`pat_tes_status` bit(1)
,`pat_name` varchar(91)
,`use_name` varchar(101)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `vie_patients_tests_results_inputs`
--
CREATE TABLE IF NOT EXISTS `vie_patients_tests_results_inputs` (
`groups_name` varchar(91)
,`ills_name` varchar(91)
,`ill_ite_id` int(11)
,`ill_ite_ill_id` int(11)
,`ill_ite_name` varchar(45)
,`ill_ite_description` text
,`ill_ite_dimention` varchar(45)
,`ill_ite_value_male` varchar(45)
,`ill_ite_value_female` varchar(45)
,`ill_ite_dateCreated` timestamp
,`ill_ite_dateModified` timestamp
,`ill_ite_status` bit(1)
,`pat_tes_id` int(11)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `vie_patients_tests_results_views`
--
CREATE TABLE IF NOT EXISTS `vie_patients_tests_results_views` (
`groups_name` varchar(91)
,`ills_name` varchar(91)
,`ill_ite_id` int(11)
,`ill_ite_ill_id` int(11)
,`ill_ite_name` varchar(45)
,`ill_ite_description` text
,`ill_ite_dimention` varchar(45)
,`ill_ite_value_male` varchar(45)
,`ill_ite_value_female` varchar(45)
,`ill_ite_dateCreated` timestamp
,`ill_ite_dateModified` timestamp
,`ill_ite_status` bit(1)
,`pat_tes_res_id` int(11)
,`pat_tes_res_pat_tes_id` int(11)
,`pat_tes_res_ill_ite_id` int(11)
,`pat_tes_res_value` float
,`pat_tes_res_dateCreated` timestamp
,`pat_tes_res_dateModified` timestamp
,`pat_tes_res_status` bit(1)
);
-- --------------------------------------------------------

--
-- Structure for view `vie_doctors`
--
DROP TABLE IF EXISTS `vie_doctors`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vie_doctors` AS select `doctors`.`doc_id` AS `doc_id`,`doctors`.`doc_hos_id` AS `doc_hos_id`,`doctors`.`doc_firstName` AS `doc_firstName`,`doctors`.`doc_lastName` AS `doc_lastName`,`doctors`.`doc_reference` AS `doc_reference`,`doctors`.`doc_sex` AS `doc_sex`,`doctors`.`doc_email` AS `doc_email`,`doctors`.`doc_position` AS `doc_position`,`doctors`.`doc_dateCreated` AS `doc_dateCreated`,`doctors`.`doc_dateModified` AS `doc_dateModified`,`doctors`.`doc_status` AS `doc_status`,concat(`p_doctors`.`doc_firstName`,' ',`p_doctors`.`doc_lastName`) AS `doc_ref_name`,`hospitals`.`hos_name` AS `hos_name`,`phones`.`doc_pho_number` AS `doc_pho_number` from (((`tbl_doctors` `doctors` join `tbl_hospitals` `hospitals` on((`doctors`.`doc_hos_id` = `hospitals`.`hos_id`))) left join `tbl_doctors_phones` `phones` on((`doctors`.`doc_id` = `phones`.`doc_pho_doc_id`))) left join `tbl_doctors` `p_doctors` on((`doctors`.`doc_reference` = `p_doctors`.`doc_id`))) group by `doctors`.`doc_id`;

-- --------------------------------------------------------

--
-- Structure for view `vie_ills_items`
--
DROP TABLE IF EXISTS `vie_ills_items`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vie_ills_items` AS select `ills_groups`.`ill_gro_id` AS `ill_gro_id`,`ills_groups`.`ill_gro_name` AS `ill_gro_name`,`ills_groups`.`ill_gro_status` AS `ill_gro_status`,`ills`.`ill_id` AS `ill_id`,`ills`.`ill_name` AS `ill_name`,`ills`.`ill_status` AS `ill_status`,`ills_items`.`ill_ite_id` AS `ill_ite_id`,`ills_items`.`ill_ite_ill_id` AS `ill_ite_ill_id`,`ills_items`.`ill_ite_name` AS `ill_ite_name`,`ills_items`.`ill_ite_description` AS `ill_ite_description`,`ills_items`.`ill_ite_dimention` AS `ill_ite_dimention`,`ills_items`.`ill_ite_value_male` AS `ill_ite_value_male`,`ills_items`.`ill_ite_value_female` AS `ill_ite_value_female`,`ills_items`.`ill_ite_dateCreated` AS `ill_ite_dateCreated`,`ills_items`.`ill_ite_dateModified` AS `ill_ite_dateModified`,`ills_items`.`ill_ite_status` AS `ill_ite_status` from ((`tbl_ills_items` `ills_items` join `tbl_ills` `ills` on((`ills_items`.`ill_ite_ill_id` = `ills`.`ill_id`))) join `tbl_ills_groups` `ills_groups` on((`ills`.`ill_ill_gro_id` = `ills_groups`.`ill_gro_id`)));

-- --------------------------------------------------------

--
-- Structure for view `vie_patients`
--
DROP TABLE IF EXISTS `vie_patients`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vie_patients` AS select `patients`.`pat_id` AS `pat_id`,`patients`.`pat_doc_id` AS `pat_doc_id`,`patients`.`pat_firstName` AS `pat_firstName`,`patients`.`pat_lastName` AS `pat_lastName`,`patients`.`pat_sex` AS `pat_sex`,`patients`.`pat_identityCard` AS `pat_identityCard`,`patients`.`pat_email` AS `pat_email`,`patients`.`pat_dateCreated` AS `pat_dateCreated`,`patients`.`pat_dateModified` AS `pat_dateModified`,`patients`.`pat_status` AS `pat_status`,concat(`doctors`.`doc_firstName`,' ',`doctors`.`doc_lastName`) AS `doc_name`,`phones`.`pat_pho_number` AS `pat_pho_number` from ((`tbl_patients` `patients` left join `tbl_doctors` `doctors` on((`patients`.`pat_doc_id` = `doctors`.`doc_id`))) left join `tbl_patients_phones` `phones` on((`patients`.`pat_id` = `phones`.`pat_pho_pat_id`))) group by `patients`.`pat_id`;

-- --------------------------------------------------------

--
-- Structure for view `vie_patients_tests`
--
DROP TABLE IF EXISTS `vie_patients_tests`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vie_patients_tests` AS select `t`.`pat_tes_id` AS `pat_tes_id`,`t`.`pat_tes_pat_id` AS `pat_tes_pat_id`,`t`.`pat_tes_use_id` AS `pat_tes_use_id`,`t`.`pat_tes_dateTimeReceived` AS `pat_tes_dateTimeReceived`,`t`.`pat_tes_isReceive` AS `pat_tes_isReceive`,`t`.`pat_tes_isResult` AS `pat_tes_isResult`,`t`.`pat_tes_isReceiveIll` AS `pat_tes_isReceiveIll`,`t`.`pat_tes_subTotal` AS `pat_tes_subTotal`,`t`.`pat_tes_total` AS `pat_tes_total`,`t`.`pat_tes_isPaid` AS `pat_tes_isPaid`,`t`.`pat_tes_deposit` AS `pat_tes_deposit`,`t`.`pat_tes_owe` AS `pat_tes_owe`,`t`.`pat_tes_discount` AS `pat_tes_discount`,`t`.`pat_tes_doctorCommission` AS `pat_tes_doctorCommission`,`t`.`pat_tes_dateCreated` AS `pat_tes_dateCreated`,`t`.`pat_tes_dateModified` AS `pat_tes_dateModified`,`t`.`pat_tes_tax` AS `pat_tes_tax`,`t`.`pat_tes_status` AS `pat_tes_status`,concat(`p`.`pat_firstName`,' ',`p`.`pat_lastName`) AS `pat_name`,concat(`u`.`use_firstName`,' ',`u`.`use_lastName`) AS `use_name` from ((`tbl_patients_tests` `t` join `tbl_patients` `p` on((`t`.`pat_tes_pat_id` = `p`.`pat_id`))) join `tbl_users` `u` on((`t`.`pat_tes_use_id` = `u`.`use_id`)));

-- --------------------------------------------------------

--
-- Structure for view `vie_patients_tests_results_inputs`
--
DROP TABLE IF EXISTS `vie_patients_tests_results_inputs`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vie_patients_tests_results_inputs` AS select concat(`tbl_ills_groups`.`ill_gro_name`,' ',`tbl_ills_groups`.`ill_gro_nameKh`) AS `groups_name`,concat(`tbl_ills`.`ill_name`,' ',`tbl_ills`.`ill_nameKh`) AS `ills_name`,`tbl_ills_items`.`ill_ite_id` AS `ill_ite_id`,`tbl_ills_items`.`ill_ite_ill_id` AS `ill_ite_ill_id`,`tbl_ills_items`.`ill_ite_name` AS `ill_ite_name`,`tbl_ills_items`.`ill_ite_description` AS `ill_ite_description`,`tbl_ills_items`.`ill_ite_dimention` AS `ill_ite_dimention`,`tbl_ills_items`.`ill_ite_value_male` AS `ill_ite_value_male`,`tbl_ills_items`.`ill_ite_value_female` AS `ill_ite_value_female`,`tbl_ills_items`.`ill_ite_dateCreated` AS `ill_ite_dateCreated`,`tbl_ills_items`.`ill_ite_dateModified` AS `ill_ite_dateModified`,`tbl_ills_items`.`ill_ite_status` AS `ill_ite_status`,`tbl_patients_tests`.`pat_tes_id` AS `pat_tes_id` from ((((`tbl_ills_items` join `tbl_ills` on((`tbl_ills_items`.`ill_ite_ill_id` = `tbl_ills`.`ill_id`))) join `tbl_ills_groups` on((`tbl_ills`.`ill_ill_gro_id` = `tbl_ills_groups`.`ill_gro_id`))) join `tbl_patients_tests_has_tbl_ills` on((`tbl_ills`.`ill_id` = `tbl_patients_tests_has_tbl_ills`.`ill_id`))) join `tbl_patients_tests` on((`tbl_patients_tests_has_tbl_ills`.`pat_tes_id` = `tbl_patients_tests`.`pat_tes_id`))) where (`tbl_ills_items`.`ill_ite_status` = 1) order by `groups_name`,`ills_name`;

-- --------------------------------------------------------

--
-- Structure for view `vie_patients_tests_results_views`
--
DROP TABLE IF EXISTS `vie_patients_tests_results_views`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vie_patients_tests_results_views` AS select concat(`tbl_ills_groups`.`ill_gro_name`,' ',`tbl_ills_groups`.`ill_gro_nameKh`) AS `groups_name`,concat(`tbl_ills`.`ill_name`,' ',`tbl_ills`.`ill_nameKh`) AS `ills_name`,`tbl_ills_items`.`ill_ite_id` AS `ill_ite_id`,`tbl_ills_items`.`ill_ite_ill_id` AS `ill_ite_ill_id`,`tbl_ills_items`.`ill_ite_name` AS `ill_ite_name`,`tbl_ills_items`.`ill_ite_description` AS `ill_ite_description`,`tbl_ills_items`.`ill_ite_dimention` AS `ill_ite_dimention`,`tbl_ills_items`.`ill_ite_value_male` AS `ill_ite_value_male`,`tbl_ills_items`.`ill_ite_value_female` AS `ill_ite_value_female`,`tbl_ills_items`.`ill_ite_dateCreated` AS `ill_ite_dateCreated`,`tbl_ills_items`.`ill_ite_dateModified` AS `ill_ite_dateModified`,`tbl_ills_items`.`ill_ite_status` AS `ill_ite_status`,`tbl_patients_tests_results`.`pat_tes_res_id` AS `pat_tes_res_id`,`tbl_patients_tests_results`.`pat_tes_res_pat_tes_id` AS `pat_tes_res_pat_tes_id`,`tbl_patients_tests_results`.`pat_tes_res_ill_ite_id` AS `pat_tes_res_ill_ite_id`,`tbl_patients_tests_results`.`pat_tes_res_value` AS `pat_tes_res_value`,`tbl_patients_tests_results`.`pat_tes_res_dateCreated` AS `pat_tes_res_dateCreated`,`tbl_patients_tests_results`.`pat_tes_res_dateModified` AS `pat_tes_res_dateModified`,`tbl_patients_tests_results`.`pat_tes_res_status` AS `pat_tes_res_status` from (((`tbl_patients_tests_results` join `tbl_ills_items` on((`tbl_patients_tests_results`.`pat_tes_res_ill_ite_id` = `tbl_ills_items`.`ill_ite_id`))) join `tbl_ills` on((`tbl_ills_items`.`ill_ite_ill_id` = `tbl_ills`.`ill_id`))) join `tbl_ills_groups` on((`tbl_ills`.`ill_ill_gro_id` = `tbl_ills_groups`.`ill_gro_id`))) where (`tbl_ills_items`.`ill_ite_status` = 1) order by `groups_name`,`ills_name`;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_doctors`
--
ALTER TABLE `tbl_doctors`
  ADD CONSTRAINT `fk_tbl_doctors_tbl_doctors1` FOREIGN KEY (`doc_reference`) REFERENCES `tbl_doctors` (`doc_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_doctors_tbl_hostpitals1` FOREIGN KEY (`doc_hos_id`) REFERENCES `tbl_hospitals` (`hos_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_doctors_commissions`
--
ALTER TABLE `tbl_doctors_commissions`
  ADD CONSTRAINT `fk_tbl_doctors_commissions_tbl_doctors1` FOREIGN KEY (`doc_com_doc_id`) REFERENCES `tbl_doctors` (`doc_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_doctors_commissions_tbl_patients_tests1` FOREIGN KEY (`doc_com_pat_tes_id`) REFERENCES `tbl_patients_tests` (`pat_tes_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_doctors_phones`
--
ALTER TABLE `tbl_doctors_phones`
  ADD CONSTRAINT `fk_tbl_doctors_tbl_doctors_phones1` FOREIGN KEY (`doc_pho_doc_id`) REFERENCES `tbl_doctors` (`doc_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_ills`
--
ALTER TABLE `tbl_ills`
  ADD CONSTRAINT `fk_tbl_ills_tbl_ills_groups1` FOREIGN KEY (`ill_ill_gro_id`) REFERENCES `tbl_ills_groups` (`ill_gro_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_ills_items`
--
ALTER TABLE `tbl_ills_items`
  ADD CONSTRAINT `fk_tbl_ills_items_tbl_ills` FOREIGN KEY (`ill_ite_ill_id`) REFERENCES `tbl_ills` (`ill_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_patients`
--
ALTER TABLE `tbl_patients`
  ADD CONSTRAINT `fk_tbl_doctors_tbl_patients1` FOREIGN KEY (`pat_doc_id`) REFERENCES `tbl_doctors` (`doc_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_patients_phones`
--
ALTER TABLE `tbl_patients_phones`
  ADD CONSTRAINT `fk_tbl_patients_phones_tbl_patients1` FOREIGN KEY (`pat_pho_pat_id`) REFERENCES `tbl_patients` (`pat_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_patients_tests`
--
ALTER TABLE `tbl_patients_tests`
  ADD CONSTRAINT `fk_tbl_patients_tests_tbl_patients1` FOREIGN KEY (`pat_tes_pat_id`) REFERENCES `tbl_patients` (`pat_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_patients_tests_tbl_users1` FOREIGN KEY (`pat_tes_use_id`) REFERENCES `tbl_users` (`use_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_patients_tests_has_tbl_ills`
--
ALTER TABLE `tbl_patients_tests_has_tbl_ills`
  ADD CONSTRAINT `fk_tbl_patients_tests_has_tbl_ills_tbl_ills1` FOREIGN KEY (`ill_id`) REFERENCES `tbl_ills` (`ill_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_patients_tests_has_tbl_ills_tbl_patients_tests1` FOREIGN KEY (`pat_tes_id`) REFERENCES `tbl_patients_tests` (`pat_tes_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD CONSTRAINT `fk_tbl_users_tbl_users_groups1` FOREIGN KEY (`use_gro_id`) REFERENCES `tbl_users_groups` (`gro_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
