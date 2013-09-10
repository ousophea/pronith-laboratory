-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 10, 2013 at 10:49 AM
-- Server version: 5.1.53
-- PHP Version: 5.3.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_laboratory`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_doctors`
--

CREATE TABLE IF NOT EXISTS `tbl_doctors` (
  `doc_id` int(11) NOT NULL AUTO_INCREMENT,
  `doc_hos_id` int(11) DEFAULT NULL,
  `doc_reference` int(11) DEFAULT NULL,
  `doc_name` varchar(45) DEFAULT NULL,
  `doc_sex` varchar(45) DEFAULT NULL,
  `doc_email` varchar(45) DEFAULT NULL,
  `doc_position` varchar(45) DEFAULT NULL,
  `doc_dateCreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `doc_dateModified` timestamp NULL DEFAULT NULL,
  `doc_status` bit(1) DEFAULT NULL,
  PRIMARY KEY (`doc_id`),
  KEY `fk_tbl_doctors_tbl_doctors1_idx` (`doc_reference`),
  KEY `fk_tbl_doctors_tbl_hostpitals1_idx` (`doc_hos_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tbl_doctors`
--

INSERT INTO `tbl_doctors` (`doc_id`, `doc_hos_id`, `doc_reference`, `doc_name`, `doc_sex`, `doc_email`, `doc_position`, `doc_dateCreated`, `doc_dateModified`, `doc_status`) VALUES
(6, 1, NULL, 'CHEA Rathana', 'm', 'chearathana@gmail.com', 'Doctor', '2013-09-03 07:41:15', '2013-09-03 07:41:15', b'1'),
(7, 1, 6, 'CHEA Vichet', 'm', 'cheavichet@gmail.com', 'Nourse', '2013-09-03 11:01:10', '2013-09-03 11:01:10', b'1');

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
  `doc_com_total` double DEFAULT NULL,
  `doc_com_commission` int(11) DEFAULT NULL,
  `doc_com_pay` double DEFAULT NULL,
  `doc_com_getPaid` bit(1) DEFAULT NULL,
  `doc_com_dateCreated` timestamp NULL DEFAULT NULL,
  `doc_com_dateModified` timestamp NULL DEFAULT NULL,
  `doc_com_status` bit(1) DEFAULT NULL,
  PRIMARY KEY (`doc_com_id`),
  KEY `fk_tbl_doctors_commissions_tbl_patients_tests1_idx` (`doc_com_pat_tes_id`),
  KEY `fk_tbl_doctors_commissions_tbl_doctors1_idx` (`doc_com_doc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_doctors_commissions`
--


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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_doctors_phones`
--


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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_hospitals`
--

INSERT INTO `tbl_hospitals` (`hos_id`, `hos_name`, `hos_address`, `hos_status`) VALUES
(1, 'មន្ទីរពេទ្យ​កុមារជាតិ', NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ills`
--

CREATE TABLE IF NOT EXISTS `tbl_ills` (
  `ill_id` int(11) NOT NULL AUTO_INCREMENT,
  `ill_ill_gro_id` int(11) DEFAULT NULL,
  `ill_name` varchar(45) DEFAULT NULL,
  `ill_dateCreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `ill_dateModified` timestamp NULL DEFAULT NULL,
  `ill_status` bit(1) DEFAULT NULL,
  PRIMARY KEY (`ill_id`),
  KEY `fk_tbl_ills_tbl_ills_groups1_idx` (`ill_ill_gro_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tbl_ills`
--

INSERT INTO `tbl_ills` (`ill_id`, `ill_ill_gro_id`, `ill_name`, `ill_dateCreated`, `ill_dateModified`, `ill_status`) VALUES
(3, 1, 'aaaaa', '2013-09-10 14:58:34', '2013-09-10 15:29:53', b'0'),
(4, 1, 'qqqqq', '2013-09-10 15:04:00', NULL, b'1'),
(5, 2, 'ssss', '2013-09-10 15:04:28', '2013-09-10 16:46:28', b'1'),
(6, 4, 'fsadfsadfsadf', '2013-09-10 16:34:51', '2013-09-10 16:35:07', b'1');

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
  `ill_gro_description` text,
  `ill_gro_dateCreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `ill_gro_dateModified` timestamp NULL DEFAULT NULL,
  `ill_gro_status` bit(1) DEFAULT NULL,
  PRIMARY KEY (`ill_gro_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tbl_ills_groups`
--

INSERT INTO `tbl_ills_groups` (`ill_gro_id`, `ill_gro_name`, `ill_gro_description`, `ill_gro_dateCreated`, `ill_gro_dateModified`, `ill_gro_status`) VALUES
(1, 'BBBB', '', '2013-09-09 18:19:18', '2013-09-10 15:42:52', b'0'),
(2, 'BBBBsdf', 'ewfrweef', '2013-09-09 18:19:21', '2013-09-10 15:42:50', b'0'),
(3, 'aaaa', 'ewfrweef', '2013-09-09 18:19:26', '2013-09-10 15:42:49', b'0'),
(4, 'SAa', '', '2013-09-09 18:19:29', '2013-09-10 16:10:10', b'1');

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
(1, 4, 'sdfa', '1111', '111', '111', '1111', '2013-09-10 17:33:34', NULL, b'1'),
(2, 6, 'SSSS', '1', '1', '1', '1', '2013-09-10 17:46:58', NULL, b'0'),
(3, 3, 'SSSSS', '1', '11', '1', '11', '2013-09-10 17:47:23', NULL, b'0');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tbl_patients`
--

INSERT INTO `tbl_patients` (`pat_id`, `pat_doc_id`, `pat_firstName`, `pat_lastName`, `pat_sex`, `pat_identityCard`, `pat_email`, `pat_dateCreated`, `pat_dateModified`, `pat_status`) VALUES
(4, 6, 'SOK', 'Chumnou', 'm', NULL, NULL, '2013-09-07 00:41:49', NULL, b'1'),
(5, 6, 'SENG', 'Rathana', 'm', NULL, NULL, '2013-09-07 00:41:49', NULL, b'1'),
(9, NULL, 'CHEA', 'Dararith', 'm', NULL, NULL, '2013-09-07 00:47:44', '0000-00-00 00:00:00', b'1');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_patients_phones`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_patients_tests`
--

CREATE TABLE IF NOT EXISTS `tbl_patients_tests` (
  `pat_tes_id` int(11) NOT NULL AUTO_INCREMENT,
  `pat_tes_pat_id` int(11) NOT NULL,
  `pat_tes_use_id` int(11) NOT NULL,
  `pat_tes_dateReceived` timestamp NULL DEFAULT NULL,
  `pat_tes_isReceive` bit(1) DEFAULT b'0',
  `pat_tes_isResult` bit(1) DEFAULT b'0',
  `pat_tes_isReceiveIll` bit(1) DEFAULT b'0',
  `pat_tes_subTotal` double DEFAULT '0',
  `pat_tes_total` double DEFAULT NULL,
  `pat_tes_deposit` double DEFAULT '0',
  `pat_tes_owe` double DEFAULT '0',
  `pat_tes_discount` int(11) DEFAULT '0',
  `pat_tes_doctorCommission` int(11) DEFAULT '0',
  `pat_tes_dateCreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `pat_tes_dateModified` timestamp NULL DEFAULT NULL,
  `pat_tes_tax` int(11) DEFAULT NULL,
  `pat_tes_status` bit(1) DEFAULT NULL,
  PRIMARY KEY (`pat_tes_id`),
  KEY `fk_tbl_patients_tests_tbl_users1_idx` (`pat_tes_use_id`),
  KEY `fk_tbl_patients_tests_tbl_patients1_idx` (`pat_tes_pat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_patients_tests`
--


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


-- --------------------------------------------------------

--
-- Table structure for table `tbl_patients_tests_results`
--

CREATE TABLE IF NOT EXISTS `tbl_patients_tests_results` (
  `pat_tes_res_id` int(11) NOT NULL AUTO_INCREMENT,
  `pat_tes_res_pat_tes_id` int(11) DEFAULT NULL,
  `pat_tes_res_ill_id` int(11) DEFAULT NULL,
  `pat_tes_res_ill_ite_id` int(11) DEFAULT NULL,
  `pat_tes_res_value` float DEFAULT NULL,
  `pat_tes_res_dateCreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `pat_tes_res_dateModified` timestamp NULL DEFAULT NULL,
  `pat_tes_res_status` bit(1) DEFAULT NULL,
  PRIMARY KEY (`pat_tes_res_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_patients_tests_results`
--


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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`use_id`, `use_gro_id`, `use_username`, `use_password`, `use_fullName`, `use_dateCreated`, `use_dateModified`, `use_status`, `use_firstName`, `use_lastName`) VALUES
(1, 1, 'admin@laboratory.com', '21232f297a57a5a743894a0e4a801fc3', '0', '2013-09-02 19:53:57', '2013-09-10 11:54:04', b'1', 'sdfsadfsa', 'fsadfsadfsf'),
(4, 1, 'vannak@laboratory.com', '3df89cfbd86f19c7767771199b957f9d787747cf', NULL, '2013-09-03 07:48:22', NULL, b'1', NULL, NULL),
(9, 1, 'sochy.choeun@gmail.com', 'f749822ef408516aa28afab8a41c37329d7ec2fd', NULL, '2013-09-09 18:03:00', '2013-09-09 18:14:13', b'1', NULL, NULL),
(10, 2, 'sochy.g@gmail.com', 'f749822ef408516aa28afab8a41c37329d7ec2fd', '0', '2013-09-09 18:09:48', '2013-09-10 16:47:10', b'0', 'fffff', '');

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
-- Table structure for table `vie_doctors`
--
-- in use(#1356 - View 'db_laboratory.vie_doctors' references invalid table(s) or column(s) or function(s) or definer/invoker of view lack rights to use them)

--
-- Dumping data for table `vie_doctors`
--
-- in use (#1356 - View 'db_laboratory.vie_doctors' references invalid table(s) or column(s) or function(s) or definer/invoker of view lack rights to use them)

-- --------------------------------------------------------

--
-- Table structure for table `vie_ills_items`
--
-- in use(#1356 - View 'db_laboratory.vie_ills_items' references invalid table(s) or column(s) or function(s) or definer/invoker of view lack rights to use them)

--
-- Dumping data for table `vie_ills_items`
--
-- in use (#1356 - View 'db_laboratory.vie_ills_items' references invalid table(s) or column(s) or function(s) or definer/invoker of view lack rights to use them)

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
