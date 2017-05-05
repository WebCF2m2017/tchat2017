-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema sql8614_tchat
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `sql8614_tchat` ;

-- -----------------------------------------------------
-- Schema sql8614_tchat
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `sql8614_tchat` DEFAULT CHARACTER SET utf8 ;
USE `sql8614_tchat` ;

-- -----------------------------------------------------
-- Table `sql8614_tchat`.`util`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sql8614_tchat`.`util` (
  `idutil` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `login` VARCHAR(45) NOT NULL,
  `mdp` VARCHAR(32) NOT NULL,
  `mail` VARCHAR(80) NOT NULL,
  `clefutil` VARCHAR(64) NOT NULL,
`actif` tinyint(1) NOT NULL COMMENT 'actif à 1',
  PRIMARY KEY (`idutil`))
ENGINE = InnoDB;

ALTER TABLE `util`
  ADD UNIQUE KEY `login_UNIQUE` (`login`),
  ADD UNIQUE KEY `clefutil` (`clefutil`);


-- -----------------------------------------------------
-- Table `sql8614_tchat`.`message`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sql8614_tchat`.`message` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `texte` VARCHAR(120) NOT NULL,
  `ladate` TIMESTAMP NOT NULL DEFAULT NOW(),
  `util_idutil` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

CREATE INDEX `fk_message_util_idx` ON `sql8614_tchat`.`message` (`util_idutil` ASC);


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
