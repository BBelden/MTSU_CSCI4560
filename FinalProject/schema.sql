SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema Schneider
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `Schneider` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `Schneider` ;


-- -----------------------------------------------------
-- Table `Schneider`.`HOURLY`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Schneider`.`HOURLY` (
  `EngPrice` DECIMAL(10,2) NOT NULL,
  `LabPrice` DECIMAL(10,2) NOT NULL)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Schneider`.`GROUPS`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Schneider`.`GROUPS` (
  `name` VARCHAR (45) NOT NULL)
  ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Schneider`.`PERSON`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Schneider`.`PERSON` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `fname` VARCHAR(45) NOT NULL,
  `lname` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Schneider`.`SUB_CAT`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Schneider`.`SUB_CAT` (
  `catID` INT NOT NULL AUTO_INCREMENT,
  `value` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`catID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Schneider`.`COMPLEXITY`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Schneider`.`COMPLEXITY` (
  `complexID` INT NOT NULL AUTO_INCREMENT,
  `value` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`complexID`)
)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Schneider`.`COUNTRY`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Schneider`.`COUNTRY` (
  `cname` VARCHAR(45) NOT NULL,
  `cmult` DECIMAL(10,2) NOT NULL,
  PRIMARY KEY (`cname`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Schneider`.`PRODUCT`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Schneider`.`PRODUCT` (
  `pname` VARCHAR(45) NOT NULL,
  `pmult` DECIMAL(10,2) NOT NULL,
  PRIMARY KEY (`pname`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Schneider`.`TAGS`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Schneider`.`TAGS` (
  `TAGID` INT NOT NULL,
  `RevNum` INT NOT NULL,
  `PersonID` INT NOT NULL,
  `Date` DATE NOT NULL,
  `TAG_Descr` VARCHAR(100) NOT NULL,
  `Lead_Time` INT NOT NULL,
  `TAG_Notes` TEXT NOT NULL,
  `Attachments` TINYINT NOT NULL,
  `HVL` TINYINT NOT NULL,
  `HVLCC` TINYINT NOT NULL,
  `Metal_Clad` TINYINT NOT NULL,
  `MVMCC` TINYINT NOT NULL,
  `ComplexID` INT NOT NULL,
  `SubCatID` INT NOT NULL,
  `MatCost` DECIMAL(10,2) NOT NULL,
  `EngCost` DECIMAL(10,2) NOT NULL,
  `LaborCost` DECIMAL(10,2) NOT NULL,
  `InstallCost` DECIMAL(10,2) NOT NULL,
  `PriceExp` DATE NOT NULL,
  `PriceNotes` TEXT NOT NULL,
  `Obsolete` TINYINT NOT NULL,
  PRIMARY KEY (`TAGID`, `RevNum`),
  FOREIGN KEY(PersonID) REFERENCES Schneider.PERSON(id),
  FOREIGN KEY(SubCatID) REFERENCES Schneider.SUB_CAT(catID),
  FOREIGN KEY(ComplexID) REFERENCES Schneider.COMPLEXITY(complexID)
)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Schneider`.`QUOTES`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Schneider`.`QUOTES` (
  `TagNum` INT NOT NULL,
  `RevNum` INT NOT NULL,
  `Country` VARCHAR(45) NOT NULL,
  `Product` VARCHAR(45) NOT NULL,
  `MatCost` DECIMAL(10,2) NOT NULL,
  `LabCost` DECIMAL(10,2) NOT NULL,
  `EngCost` DECIMAL(10,2) NOT NULL,
  `InstCost` DECIMAL(10,2) NOT NULL,
  `Quote` DECIMAL(10,2) NOT NULL,
  PRIMARY KEY (`TagNum`, `RevNum`,`Country`,`Product`),
  FOREIGN KEY(Country) REFERENCES Schneider.COUNTRY(cname),
  FOREIGN KEY(Product) REFERENCES Schneider.PRODUCT(pname),
  FOREIGN KEY(TagNum, RevNum) REFERENCES Schneider.TAGS(TAGID, RevNum)
)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Schneider`.`APPLIED_FO`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Schneider`.`APPLIED_FO` (
  `FOno` varchar(12) NOT NULL,
  `TagNum` INT NOT NULL,
  `Type` INT NOT NULL,
  `Notes` VARCHAR(512) NOT NULL,
  PRIMARY KEY (`FOno`),
  FOREIGN KEY(TagNum) REFERENCES Schneider.TAGS(TAGID)
)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Schneider`.`USERNAME`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Schneider`.`USERNAME` (
  `name` VARCHAR(45) NOT NULL,
  `userID` INT NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `expires` DATETIME NOT NULL,
  `Admin` TINYINT NOT NULL,
  `OE` TINYINT NOT NULL,
  `TagMbr` TINYINT NOT NULL,
  `User` TINYINT NOT NULL,
  PRIMARY KEY (`name`),
  FOREIGN KEY(userID) REFERENCES Schneider.PERSON(id)
)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Schneider`.`SECURITY`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Schneider`.`SECURITY` (
  `user` VARCHAR(45) NOT NULL,
  `datetime` DATETIME NOT NULL,
  `IP` VARCHAR(32) NOT NULL,
  `machine_name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`user`, `datetime`),
  FOREIGN KEY(user) REFERENCES Schneider.USERNAME(name)
)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Schneider`.`ATTACHMENTS`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Schneider`.`ATTACHMENTS` (
  `attID` INT NOT NULL AUTO_INCREMENT,
  `TagNum` INT NOT NULL,
  `filename` VARCHAR(45) NOT NULL,
  `file` BLOB NOT NULL,
  `size` INT NOT NULL,
  `type` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`attID`),
  FOREIGN KEY(TagNum, RevNum) REFERENCES Schneider.TAGS(TAGID, RevNum)
)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
