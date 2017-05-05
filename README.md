# tchat2017
Tchat webdev 2017
## Utilisation de git et github
Le but du jeu sera principalement de pouvoir gérer un projet .git sur la plateforme github avec toute la classe
## Tchat
Cette première version basique sera le lancement de cet exercice collaboratif, où tout un chacun pourra proposer de nouvelles fonctionnalités et/ou correctifs
## URL
http://tchat.webdev-cf2m.be/

# 2017/05/03

- Instructions dans le contrôleur frontal

# création DB

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


# config.php

/* 
 * Les constantes de connexion
 */

define("DB_HOST", "localhost");
define("DB_LOGIN", "root");
define("DB_PASS", "");
define("DB_NAME", "sql8614_tchat");
define("DB_CHARSET", "utf8");
