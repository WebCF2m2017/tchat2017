-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema tchatIgor
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema tchatIgor
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `tchatIgor` DEFAULT CHARACTER SET utf8 ;
USE `tchatIgor` ;

-- -----------------------------------------------------
-- Table `tchatIgor`.`util`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tchatIgor`.`util` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `login` VARCHAR(50) NOT NULL,
  `mdp` TEXT NOT NULL,
  `mail` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tchatIgor`.`message`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tchatIgor`.`message` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `titre` VARCHAR(50) NOT NULL,
  `ladate` TIMESTAMP NOT NULL DEFAULT NOW(),
  `util_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  INDEX `fk_message_util_idx` (`util_id` ASC),
  CONSTRAINT `fk_message_util`
    FOREIGN KEY (`util_id`)
    REFERENCES `tchatIgor`.`util` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = '		';


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
