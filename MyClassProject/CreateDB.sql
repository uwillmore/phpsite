-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema UTE-Flora-DB
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema UTE-Flora-DB
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `UTE-Flora-DB` DEFAULT CHARACTER SET utf8 ;
USE `UTE-Flora-DB` ;

-- -----------------------------------------------------
-- Table `UTE-Flora-DB`.`Locations`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `UTE-Flora-DB`.`Locations` ;

CREATE TABLE IF NOT EXISTS `UTE-Flora-DB`.`Locations` (
  `LocationID` INT(11) NOT NULL AUTO_INCREMENT COMMENT '',
  `Longitude` VARCHAR(45) NULL DEFAULT NULL COMMENT '',
  `Latitude` VARCHAR(45) NULL DEFAULT NULL COMMENT '',
  `GPSCoordinates` VARCHAR(45) NULL DEFAULT NULL COMMENT '',
  `LocationNotes` VARCHAR(150) NULL DEFAULT NULL COMMENT '',
  PRIMARY KEY (`LocationID`)  COMMENT '')
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE UNIQUE INDEX `LocationID_UNIQUE` ON `UTE-Flora-DB`.`Locations` (`LocationID` ASC)  COMMENT '';


-- -----------------------------------------------------
-- Table `UTE-Flora-DB`.`Soils`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `UTE-Flora-DB`.`Soils` ;

CREATE TABLE IF NOT EXISTS `UTE-Flora-DB`.`Soils` (
  `SoilID` INT(11) NOT NULL AUTO_INCREMENT COMMENT '',
  `SoilType` VARCHAR(45) NOT NULL COMMENT '',
  PRIMARY KEY (`SoilID`)  COMMENT '')
ENGINE = InnoDB
AUTO_INCREMENT = 8
DEFAULT CHARACTER SET = utf8;

CREATE UNIQUE INDEX `SoilID_UNIQUE` ON `UTE-Flora-DB`.`Soils` (`SoilID` ASC)  COMMENT '';


-- -----------------------------------------------------
-- Table `UTE-Flora-DB`.`Users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `UTE-Flora-DB`.`Users` ;

CREATE TABLE IF NOT EXISTS `UTE-Flora-DB`.`Users` (
  `UserID` INT(11) NOT NULL AUTO_INCREMENT COMMENT '',
  `UserName` VARCHAR(20) NOT NULL COMMENT '',
  `UserPassword` VARCHAR(15) NULL DEFAULT NULL COMMENT '',
  `UserEmail` VARCHAR(20) NULL DEFAULT NULL COMMENT '',
  `UserRole` TINYINT(4) NOT NULL DEFAULT '0' COMMENT '',
  `CreatedDate` DATETIME NOT NULL COMMENT '',
  PRIMARY KEY (`UserID`)  COMMENT '')
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = utf8;

CREATE UNIQUE INDEX `UserID_UNIQUE` ON `UTE-Flora-DB`.`Users` (`UserID` ASC)  COMMENT '';


-- -----------------------------------------------------
-- Table `UTE-Flora-DB`.`Weather`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `UTE-Flora-DB`.`Weather` ;

CREATE TABLE IF NOT EXISTS `UTE-Flora-DB`.`Weather` (
  `WeatherID` INT(11) NOT NULL AUTO_INCREMENT COMMENT '',
  `ObservationTIme` DATETIME NULL DEFAULT NULL COMMENT '',
  `TemperatureF` INT(11) NULL DEFAULT NULL COMMENT '',
  `Conditions` VARCHAR(150) NULL DEFAULT NULL COMMENT '',
  `DateEntered` DATETIME NOT NULL COMMENT '',
  PRIMARY KEY (`WeatherID`)  COMMENT '')
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE UNIQUE INDEX `WeatherID_UNIQUE` ON `UTE-Flora-DB`.`Weather` (`WeatherID` ASC)  COMMENT '';


-- -----------------------------------------------------
-- Table `UTE-Flora-DB`.`Plants`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `UTE-Flora-DB`.`Plants` ;

CREATE TABLE IF NOT EXISTS `UTE-Flora-DB`.`Plants` (
  `PlantID` INT(11) NOT NULL AUTO_INCREMENT COMMENT '',
  `SoilTypeID` INT(11) NOT NULL COMMENT '',
  `LocationID` INT(11) NULL DEFAULT NULL COMMENT '',
  `WeatherID` INT(11) NULL DEFAULT NULL COMMENT '',
  `UserID` INT(11) NOT NULL COMMENT '',
  `PlantName` VARCHAR(45) NOT NULL COMMENT '',
  `PlantNote` VARCHAR(150) NULL DEFAULT NULL COMMENT '',
  `SoilCondition` VARCHAR(45) NULL DEFAULT NULL COMMENT '',
  `EnteredOnSite` TINYINT(1) NOT NULL DEFAULT '0' COMMENT '',
  `DateEntered` DATETIME NOT NULL COMMENT '',
  PRIMARY KEY (`PlantID`)  COMMENT '',
  CONSTRAINT `LocationID`
    FOREIGN KEY (`LocationID`)
    REFERENCES `UTE-Flora-DB`.`Locations` (`LocationID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `SoilID`
    FOREIGN KEY (`SoilTypeID`)
    REFERENCES `UTE-Flora-DB`.`Soils` (`SoilID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `UserID`
    FOREIGN KEY (`UserID`)
    REFERENCES `UTE-Flora-DB`.`Users` (`UserID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `WeatherID`
    FOREIGN KEY (`WeatherID`)
    REFERENCES `UTE-Flora-DB`.`Weather` (`WeatherID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE UNIQUE INDEX `PlantID_UNIQUE` USING BTREE ON `UTE-Flora-DB`.`Plants` (`PlantID` ASC)  COMMENT '';

CREATE INDEX `SoilID_idx` ON `UTE-Flora-DB`.`Plants` (`SoilTypeID` ASC)  COMMENT '';

CREATE INDEX `LocationID_idx` ON `UTE-Flora-DB`.`Plants` (`LocationID` ASC)  COMMENT '';

CREATE INDEX `WeatherID_idx` ON `UTE-Flora-DB`.`Plants` (`WeatherID` ASC)  COMMENT '';

CREATE INDEX `UserID_idx` ON `UTE-Flora-DB`.`Plants` (`UserID` ASC)  COMMENT '';


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;