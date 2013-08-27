SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE DATABASE IF NOT EXISTS `db_laboratory` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `db_laboratory` ;

-- -----------------------------------------------------
-- Table `db_laboratory`.`tbl_users_groups`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_laboratory`.`tbl_users_groups` ;

CREATE  TABLE IF NOT EXISTS `db_laboratory`.`tbl_users_groups` (
  `gro_id` INT NOT NULL AUTO_INCREMENT ,
  `gro_name` VARCHAR(45) NOT NULL ,
  `gro_description` TEXT NULL ,
  PRIMARY KEY (`gro_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_laboratory`.`tbl_users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_laboratory`.`tbl_users` ;

CREATE  TABLE IF NOT EXISTS `db_laboratory`.`tbl_users` (
  `use_id` INT NOT NULL AUTO_INCREMENT ,
  `use_gro_id` INT NOT NULL ,
  `use_username` VARCHAR(45) NOT NULL ,
  `use_password` VARCHAR(45) NOT NULL ,
  `use_fullName` VARCHAR(45) NULL ,
  `use_dateCreated` TIMESTAMP NULL DEFAULT current_timestamp ,
  `use_dateModified` TIMESTAMP NULL ,
  `use_status` BIT NULL DEFAULT 1 ,
  PRIMARY KEY (`use_id`) ,
  INDEX `fk_tbl_users_tbl_users_groups1_idx` (`use_gro_id` ASC) ,
  CONSTRAINT `fk_tbl_users_tbl_users_groups1`
    FOREIGN KEY (`use_gro_id` )
    REFERENCES `db_laboratory`.`tbl_users_groups` (`gro_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_laboratory`.`tbl_hostpitals`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_laboratory`.`tbl_hostpitals` ;

CREATE  TABLE IF NOT EXISTS `db_laboratory`.`tbl_hostpitals` (
  `hos_id` INT NOT NULL AUTO_INCREMENT ,
  `hos_name` VARCHAR(45) NOT NULL ,
  `hos_address` TEXT NULL ,
  `status` VARCHAR(45) NULL ,
  PRIMARY KEY (`hos_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_laboratory`.`tbl_doctors`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_laboratory`.`tbl_doctors` ;

CREATE  TABLE IF NOT EXISTS `db_laboratory`.`tbl_doctors` (
  `doc_id` INT NOT NULL AUTO_INCREMENT ,
  `doc_hos_id` INT NULL ,
  `doc_reference` INT NOT NULL ,
  `doc_name` VARCHAR(45) NULL ,
  `doc_sex` VARCHAR(45) NULL ,
  `doc_phone` VARCHAR(45) NULL ,
  `doc_email` VARCHAR(45) NULL ,
  `doc_position` VARCHAR(45) NULL ,
  `doc_dateCreated` TIMESTAMP NULL DEFAULT current_timestamp ,
  `doc_dateModified` TIMESTAMP NULL ,
  `status` BIT NULL DEFAULT 1 ,
  PRIMARY KEY (`doc_id`) ,
  INDEX `fk_tbl_doctors_tbl_doctors1_idx` (`doc_reference` ASC) ,
  INDEX `fk_tbl_doctors_tbl_hostpitals1_idx` (`doc_hos_id` ASC) ,
  CONSTRAINT `fk_tbl_doctors_tbl_doctors1`
    FOREIGN KEY (`doc_reference` )
    REFERENCES `db_laboratory`.`tbl_doctors` (`doc_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_doctors_tbl_hostpitals1`
    FOREIGN KEY (`doc_hos_id` )
    REFERENCES `db_laboratory`.`tbl_hostpitals` (`hos_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_laboratory`.`tbl_patients`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_laboratory`.`tbl_patients` ;

CREATE  TABLE IF NOT EXISTS `db_laboratory`.`tbl_patients` (
  `pat_id` INT NOT NULL AUTO_INCREMENT ,
  `pat_doc_id` INT NULL DEFAULT 0 ,
  `pat_firstName` VARCHAR(45) NULL ,
  `pat_lastName` VARCHAR(45) NULL ,
  `pat_sex` CHAR NULL ,
  `pat_identityCard` INT NULL ,
  `pat_phone` VARCHAR(30) NULL ,
  `pat_email` VARCHAR(30) NULL ,
  `pat_dateCreated` TIMESTAMP NULL DEFAULT current_timestamp ,
  `pat_dateModified` TIMESTAMP NULL ,
  `status` BIT NULL DEFAULT 1 ,
  PRIMARY KEY (`pat_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_laboratory`.`tbl_phones`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_laboratory`.`tbl_phones` ;

CREATE  TABLE IF NOT EXISTS `db_laboratory`.`tbl_phones` (
  `pho_id` INT NOT NULL AUTO_INCREMENT ,
  `pho_doc_id` INT NULL ,
  `pho_number` VARCHAR(45) NULL ,
  PRIMARY KEY (`pho_id`) ,
  CONSTRAINT `fk_tbl_phones_tbl_doctors1`
    FOREIGN KEY (`pho_doc_id` )
    REFERENCES `db_laboratory`.`tbl_doctors` (`doc_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_laboratory`.`tbl_ills_groups`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_laboratory`.`tbl_ills_groups` ;

CREATE  TABLE IF NOT EXISTS `db_laboratory`.`tbl_ills_groups` (
  `ill_gro_id` INT NOT NULL ,
  `ill_gro_name` VARCHAR(45) NULL ,
  `ill_gro_description` TEXT NULL ,
  `ill_gro_dateCreated` TIMESTAMP NULL DEFAULT current_timestamp ,
  `ill_gro_dateModified` TIMESTAMP NULL ,
  `status` BIT NULL DEFAULT 1 ,
  PRIMARY KEY (`ill_gro_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_laboratory`.`tbl_ills`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_laboratory`.`tbl_ills` ;

CREATE  TABLE IF NOT EXISTS `db_laboratory`.`tbl_ills` (
  `ill_id` INT NOT NULL AUTO_INCREMENT ,
  `ill_ill_gro_id` INT NULL ,
  `ill_name` VARCHAR(45) NULL ,
  `ill_dateCreated` TIMESTAMP NULL DEFAULT current_timestamp ,
  `ill_dateModified` TIMESTAMP NULL ,
  `status` BIT NULL DEFAULT 1 ,
  PRIMARY KEY (`ill_id`) ,
  INDEX `fk_tbl_ills_tbl_ills_groups1_idx` (`ill_ill_gro_id` ASC) ,
  CONSTRAINT `fk_tbl_ills_tbl_ills_groups1`
    FOREIGN KEY (`ill_ill_gro_id` )
    REFERENCES `db_laboratory`.`tbl_ills_groups` (`ill_gro_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_laboratory`.`tbl_ills_items`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_laboratory`.`tbl_ills_items` ;

CREATE  TABLE IF NOT EXISTS `db_laboratory`.`tbl_ills_items` (
  `ill_ite_id` INT NOT NULL AUTO_INCREMENT ,
  `ill_ite_ill_id` INT NULL ,
  `ill_ite_name` VARCHAR(45) NOT NULL ,
  `ill_ite_description` TEXT NULL ,
  `ill_ite_dimention` VARCHAR(45) NOT NULL ,
  `ill_ite_value_male` VARCHAR(45) NOT NULL ,
  `ill_ite_value_female` VARCHAR(45) NOT NULL ,
  `ill_ite_dateCreated` TIMESTAMP NULL DEFAULT current_timestamp ,
  `ill_ite_dateModified` TIMESTAMP NULL ,
  `status` BIT NULL DEFAULT 1 ,
  PRIMARY KEY (`ill_ite_id`) ,
  INDEX `fk_tbl_ills_items_tbl_ills_idx` (`ill_ite_ill_id` ASC) ,
  CONSTRAINT `fk_tbl_ills_items_tbl_ills`
    FOREIGN KEY (`ill_ite_ill_id` )
    REFERENCES `db_laboratory`.`tbl_ills` (`ill_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_laboratory`.`tbl_patients_tests`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_laboratory`.`tbl_patients_tests` ;

CREATE  TABLE IF NOT EXISTS `db_laboratory`.`tbl_patients_tests` (
  `pat_tes_id` INT NOT NULL AUTO_INCREMENT ,
  `pat_tes_pat_id` INT NOT NULL ,
  `pat_tes_use_id` INT NOT NULL ,
  `pat_tes_dateReceived` TIMESTAMP NULL ,
  `pat_tes_isReceive` BIT NULL DEFAULT 0 ,
  `pat_tes_isResult` BIT NULL DEFAULT 0 ,
  `pat_tes_isReceiveIll` BIT NULL DEFAULT 0 ,
  `pat_tes_subTotal` DOUBLE NULL DEFAULT 0 ,
  `pat_tes_total` DOUBLE NULL ,
  `pat_tes_deposit` DOUBLE NULL DEFAULT 0 ,
  `pat_tes_owe` DOUBLE NULL DEFAULT 0 ,
  `pat_tes_discount` INT NULL DEFAULT 0 ,
  `pat_tes_doctorCommission` INT NULL DEFAULT 0 ,
  `pat_tes_dateCreated` TIMESTAMP NULL DEFAULT current_timestamp ,
  `pat_tes_dateModified` TIMESTAMP NULL ,
  `pat_tes_tax` INT NULL ,
  `status` BIT NULL ,
  PRIMARY KEY (`pat_tes_id`) ,
  INDEX `fk_tbl_patients_tests_tbl_users1_idx` (`pat_tes_use_id` ASC) ,
  INDEX `fk_tbl_patients_tests_tbl_patients1_idx` (`pat_tes_pat_id` ASC) ,
  CONSTRAINT `fk_tbl_patients_tests_tbl_users1`
    FOREIGN KEY (`pat_tes_use_id` )
    REFERENCES `db_laboratory`.`tbl_users` (`use_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_patients_tests_tbl_patients1`
    FOREIGN KEY (`pat_tes_pat_id` )
    REFERENCES `db_laboratory`.`tbl_patients` (`pat_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_laboratory`.`tbl_patients_tests_results`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_laboratory`.`tbl_patients_tests_results` ;

CREATE  TABLE IF NOT EXISTS `db_laboratory`.`tbl_patients_tests_results` (
  `pat_tes_res_id` INT NOT NULL ,
  `pat_tes_res_pat_tes_id` INT NULL ,
  `pat_tes_res_ill_id` INT NULL ,
  `pat_tes_res_ill_ite_id` INT NULL ,
  `pat_tes_res_value` FLOAT NULL ,
  `pat_tes_res_dateCreated` TIMESTAMP NULL DEFAULT current_timestamp ,
  `pat_tes_res_dateModified` TIMESTAMP NULL ,
  `status` BIT NULL DEFAULT 1 ,
  PRIMARY KEY (`pat_tes_res_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_laboratory`.`tbl_patients_tests_has_tbl_ills`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_laboratory`.`tbl_patients_tests_has_tbl_ills` ;

CREATE  TABLE IF NOT EXISTS `db_laboratory`.`tbl_patients_tests_has_tbl_ills` (
  `pat_tes_id` INT NOT NULL ,
  `ill_id` INT NOT NULL ,
  PRIMARY KEY (`pat_tes_id`, `ill_id`) ,
  INDEX `fk_tbl_patients_tests_has_tbl_ills_tbl_ills1_idx` (`ill_id` ASC) ,
  INDEX `fk_tbl_patients_tests_has_tbl_ills_tbl_patients_tests1_idx` (`pat_tes_id` ASC) ,
  CONSTRAINT `fk_tbl_patients_tests_has_tbl_ills_tbl_patients_tests1`
    FOREIGN KEY (`pat_tes_id` )
    REFERENCES `db_laboratory`.`tbl_patients_tests` (`pat_tes_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_patients_tests_has_tbl_ills_tbl_ills1`
    FOREIGN KEY (`ill_id` )
    REFERENCES `db_laboratory`.`tbl_ills` (`ill_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_laboratory`.`tbl_doctors_commissions`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_laboratory`.`tbl_doctors_commissions` ;

CREATE  TABLE IF NOT EXISTS `db_laboratory`.`tbl_doctors_commissions` (
  `doc_com_id` INT NOT NULL ,
  `doc_com_doc_id` INT NULL ,
  `doc_com_pat_tes_id` INT NULL ,
  `doc_com_total` DOUBLE NULL ,
  `doc_com_commission` INT NULL ,
  `doc_com_pay` DOUBLE NULL ,
  `doc_com_getPaid` BIT NULL ,
  `doc_com_dateCreated` TIMESTAMP NULL ,
  `doc_com_dateModified` TIMESTAMP NULL ,
  `doc_com_status` BIT NULL ,
  PRIMARY KEY (`doc_com_id`) ,
  INDEX `fk_tbl_doctors_commissions_tbl_patients_tests1_idx` (`doc_com_pat_tes_id` ASC) ,
  INDEX `fk_tbl_doctors_commissions_tbl_doctors1_idx` (`doc_com_doc_id` ASC) ,
  CONSTRAINT `fk_tbl_doctors_commissions_tbl_patients_tests1`
    FOREIGN KEY (`doc_com_pat_tes_id` )
    REFERENCES `db_laboratory`.`tbl_patients_tests` (`pat_tes_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_doctors_commissions_tbl_doctors1`
    FOREIGN KEY (`doc_com_doc_id` )
    REFERENCES `db_laboratory`.`tbl_doctors` (`doc_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

USE `db_laboratory` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
