-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 11, 2013 at 05:15 AM
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

INSERT INTO `tbl_doctors` (`doc_id`, `doc_hos_id`, `doc_firstName`, `doc_lastName`, `doc_reference`, `doc_sex`, `doc_email`, `doc_position`, `doc_dateCreated`, `doc_dateModified`, `doc_status`) VALUES
(6, 1, 'CHEA', 'Rathana', 7, 'f', 'chearathana@gmail.com', 'Doctor', '2013-09-03 00:41:15', '2013-09-19 10:50:43', b'1'),
(7, 1, 'SOK', 'Sambath', 6, 'm', 'cheavichet@gmail.com', 'Nourse', '2013-09-03 04:01:10', '2013-09-19 03:39:32', b'1'),
(8, 1, 'YAN', 'Chumnou', NULL, 'm', 'chumnou@yahoo.com', 'Doctor', '2013-09-19 06:14:17', NULL, b'1'),
(9, 1, 'VANN', 'Sukhunthea', 8, 'f', '', 'Doctor', '2013-09-19 06:18:52', NULL, b'1'),
(10, 1, 'RET', 'Rado', 6, 'm', 'rado@yahoo.com', 'Doctor', '2013-09-19 10:41:10', '2013-09-19 10:41:42', b'1');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_doctors_commissions`
--

INSERT INTO `tbl_doctors_commissions` (`doc_com_id`, `doc_com_doc_id`, `doc_com_pat_tes_id`, `doc_com_ammount`, `doc_com_getPaid`, `doc_com_dateCreated`, `doc_com_dateModified`, `doc_com_status`) VALUES
(1, 7, 5, 12240, b'0', NULL, NULL, b'1'),
(2, 7, 7, 23490, b'0', NULL, NULL, b'1'),
(3, 6, 8, 2900, b'0', NULL, NULL, b'1'),
(4, 6, 9, 1995, b'0', NULL, NULL, b'1'),
(5, 7, 10, 2900, b'0', NULL, NULL, b'1');

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
  `ill_nameEn` varchar(45) NOT NULL,
  `ill_price` varchar(10) NOT NULL DEFAULT '0',
  `ill_dateCreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `ill_dateModified` timestamp NULL DEFAULT NULL,
  `ill_status` bit(1) DEFAULT NULL,
  PRIMARY KEY (`ill_id`),
  KEY `fk_tbl_ills_tbl_ills_groups1_idx` (`ill_ill_gro_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tbl_ills`
--

INSERT INTO `tbl_ills` (`ill_id`, `ill_ill_gro_id`, `ill_name`, `ill_nameEn`, `ill_price`, `ill_dateCreated`, `ill_dateModified`, `ill_status`) VALUES
(3, 1, 'ថ្លើម​ប្រភេទអា', 'Infinity-A', '8000', '2013-09-10 07:58:34', '2013-10-06 15:13:58', b'1'),
(4, 1, 'ថ្លើម​ប្រភេទ​​បេ', '', '8000', '2013-09-10 08:04:00', '2013-10-06 15:03:46', b'1'),
(5, 2, 'សួត​ធំ', '', '6500', '2013-09-10 08:04:28', '2013-10-06 15:04:17', b'1'),
(6, 4, 'លំពែង​ធំ', '', '6500', '2013-09-10 09:34:51', '2013-10-06 15:04:25', b'1');

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
  `ill_gro_nameEn` varchar(45) NOT NULL,
  `ill_gro_description` text,
  `ill_gro_dateCreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `ill_gro_dateModified` timestamp NULL DEFAULT NULL,
  `ill_gro_status` bit(1) DEFAULT NULL,
  PRIMARY KEY (`ill_gro_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_ills_groups`
--

INSERT INTO `tbl_ills_groups` (`ill_gro_id`, `ill_gro_name`, `ill_gro_nameEn`, `ill_gro_description`, `ill_gro_dateCreated`, `ill_gro_dateModified`, `ill_gro_status`) VALUES
(1, 'ថ្លើម', '', '', '2013-09-09 11:19:18', '2013-10-06 11:05:58', b'1'),
(2, 'សួត', '', 'ewfrweef', '2013-09-09 11:19:21', '2013-10-06 11:06:05', b'1'),
(3, 'ក្រពះ', '', 'ewfrweef', '2013-09-09 11:19:26', '2013-10-06 11:06:12', b'1'),
(4, 'លំពែង', '', '', '2013-09-09 11:19:29', '2013-10-06 11:06:59', b'1');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_ills_items`
--

INSERT INTO `tbl_ills_items` (`ill_ite_id`, `ill_ite_ill_id`, `ill_ite_name`, `ill_ite_description`, `ill_ite_dimention`, `ill_ite_value_male`, `ill_ite_value_female`, `ill_ite_dateCreated`, `ill_ite_dateModified`, `ill_ite_status`) VALUES
(1, 4, 'sdfa', '1111', '111', '111', '1111', '2013-09-10 10:33:34', NULL, b'1'),
(2, 6, 'SSSS', '1', '1', '1', '1', '2013-09-10 10:46:58', NULL, b'0'),
(3, 3, 'SSSSS', '1', '11', '1', '11', '2013-09-10 10:47:23', NULL, b'0');

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
(4, 7, 'SOK', 'Chumnou', 'm', 0, '', '2013-09-06 17:41:49', '2013-09-15 11:42:09', b'0'),
(5, 6, 'SENG', 'Rathana', 'm', 0, '', '2013-09-06 17:41:49', '2013-09-15 11:41:43', b'1'),
(9, NULL, 'CHEA', 'Dararith', 'm', NULL, NULL, '2013-09-06 17:47:44', '2013-09-15 11:17:51', b'1'),
(10, 6, 'SUON', 'Dara', 'm', 1222328839, '', '2013-09-19 11:42:15', '2013-09-19 12:08:52', b'1'),
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
  `pat_test_isPaid` bit(1) NOT NULL DEFAULT b'0',
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tbl_patients_tests`
--

INSERT INTO `tbl_patients_tests` (`pat_tes_id`, `pat_tes_pat_id`, `pat_tes_use_id`, `pat_tes_dateTimeReceived`, `pat_tes_isReceive`, `pat_tes_isResult`, `pat_tes_isReceiveIll`, `pat_tes_subTotal`, `pat_tes_total`, `pat_test_isPaid`, `pat_tes_deposit`, `pat_tes_owe`, `pat_tes_discount`, `pat_tes_doctorCommission`, `pat_tes_dateCreated`, `pat_tes_dateModified`, `pat_tes_tax`, `pat_tes_status`) VALUES
(5, 4, 4, '2013-10-10 16:31:00', b'0', b'0', b'1', 16000, 13600, b'1', 16000, 0, 5, 12240, '2013-10-10 16:59:39', NULL, 10, b'1'),
(6, 14, 4, '2013-10-10 17:00:00', b'0', b'0', b'1', 6500, 5850, b'1', 6500, 0, 0, 0, '2013-10-10 17:00:26', NULL, 10, b'1'),
(7, 4, 4, '2013-10-10 18:04:00', b'0', b'0', b'1', 29000, 26100, b'0', 5000, 24000, 5, 23490, '2013-10-10 18:27:23', NULL, 5, b'1'),
(8, 5, 4, '2013-10-10 18:04:00', b'0', b'0', b'1', 29000, 26100, b'1', 29000, 0, 0, 2900, '2013-10-10 18:33:01', NULL, 0, b'1'),
(9, 5, 4, '2013-10-10 18:04:00', b'0', b'0', b'1', 21000, 17955, b'1', 21000, 0, 0, 1995, '2013-10-10 18:37:05', NULL, 5, b'1'),
(10, 4, 4, '2013-10-10 18:04:00', b'0', b'0', b'1', 29000, 26100, b'0', 0, 29000, 0, 2900, '2013-10-10 18:38:23', NULL, 0, b'1');

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
(5, 3),
(7, 3),
(8, 3),
(9, 3),
(10, 3),
(5, 4),
(7, 4),
(8, 4),
(10, 4),
(6, 5),
(7, 5),
(8, 5),
(9, 5),
(10, 5),
(7, 6),
(8, 6),
(9, 6),
(10, 6);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `tbl_patients_tests_results`
--

INSERT INTO `tbl_patients_tests_results` (`pat_tes_res_id`, `pat_tes_res_pat_tes_id`, `pat_tes_res_ill_ite_id`, `pat_tes_res_value`, `pat_tes_res_dateCreated`, `pat_tes_res_dateModified`, `pat_tes_res_status`) VALUES
(1, 5, 1, NULL, '2013-10-10 16:59:39', NULL, b'1'),
(2, 5, 3, NULL, '2013-10-10 16:59:39', NULL, b'1'),
(3, 7, 1, NULL, '2013-10-10 18:27:23', NULL, b'1'),
(4, 7, 2, NULL, '2013-10-10 18:27:23', NULL, b'1'),
(5, 7, 3, NULL, '2013-10-10 18:27:23', NULL, b'1'),
(6, 8, 1, NULL, '2013-10-10 18:33:01', NULL, b'1'),
(7, 8, 2, NULL, '2013-10-10 18:33:01', NULL, b'1'),
(8, 8, 3, NULL, '2013-10-10 18:33:01', NULL, b'1'),
(9, 9, 2, NULL, '2013-10-10 18:37:05', NULL, b'1'),
(10, 9, 3, NULL, '2013-10-10 18:37:05', NULL, b'1'),
(11, 10, 1, NULL, '2013-10-10 18:38:23', NULL, b'1'),
(12, 10, 2, NULL, '2013-10-10 18:38:23', NULL, b'1'),
(13, 10, 3, NULL, '2013-10-10 18:38:23', NULL, b'1');

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
(1, 1, 'admin@laboratory.com', '21232f297a57a5a743894a0e4a801fc3', '0', '2013-09-02 12:53:57', '2013-10-10 19:14:50', b'1', 'ADMIN', 'Administrator'),
(4, 1, 'vannak@laboratory.com', '3df89cfbd86f19c7767771199b957f9d787747cf', '0', '2013-09-03 00:48:22', '2013-10-10 19:14:23', b'1', 'PEN', 'Vannak'),
(9, 1, 'sochy.choeun@gmail.com', 'f749822ef408516aa28afab8a41c37329d7ec2fd', '0', '2013-09-09 11:03:00', '2013-10-10 19:14:12', b'1', 'CHOEUN', 'Sochy'),
(10, 2, 'sochy.g@gmail.com', 'f749822ef408516aa28afab8a41c37329d7ec2fd', '0', '2013-09-09 11:09:48', '2013-10-10 19:15:06', b'0', 'G', 'Sochy');

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
,`pat_test_isPaid` bit(1)
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

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vie_patients_tests` AS select `t`.`pat_tes_id` AS `pat_tes_id`,`t`.`pat_tes_pat_id` AS `pat_tes_pat_id`,`t`.`pat_tes_use_id` AS `pat_tes_use_id`,`t`.`pat_tes_dateTimeReceived` AS `pat_tes_dateTimeReceived`,`t`.`pat_tes_isReceive` AS `pat_tes_isReceive`,`t`.`pat_tes_isResult` AS `pat_tes_isResult`,`t`.`pat_tes_isReceiveIll` AS `pat_tes_isReceiveIll`,`t`.`pat_tes_subTotal` AS `pat_tes_subTotal`,`t`.`pat_tes_total` AS `pat_tes_total`,`t`.`pat_test_isPaid` AS `pat_test_isPaid`,`t`.`pat_tes_deposit` AS `pat_tes_deposit`,`t`.`pat_tes_owe` AS `pat_tes_owe`,`t`.`pat_tes_discount` AS `pat_tes_discount`,`t`.`pat_tes_doctorCommission` AS `pat_tes_doctorCommission`,`t`.`pat_tes_dateCreated` AS `pat_tes_dateCreated`,`t`.`pat_tes_dateModified` AS `pat_tes_dateModified`,`t`.`pat_tes_tax` AS `pat_tes_tax`,`t`.`pat_tes_status` AS `pat_tes_status`,concat(`p`.`pat_firstName`,' ',`p`.`pat_lastName`) AS `pat_name`,concat(`u`.`use_firstName`,' ',`u`.`use_lastName`) AS `use_name` from ((`tbl_patients_tests` `t` join `tbl_patients` `p` on((`t`.`pat_tes_pat_id` = `p`.`pat_id`))) join `tbl_users` `u` on((`t`.`pat_tes_use_id` = `u`.`use_id`)));

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
