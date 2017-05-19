# tchat2017
Tchat webdev 2017
## Utilisation de git et github
Le but du jeu sera principalement de pouvoir gérer un projet .git sur la plateforme github avec toute la classe
## Tchat
Cette première version basique sera le lancement de cet exercice collaboratif, où tout un chacun pourra proposer de nouvelles fonctionnalités et/ou correctifs
## URL
http://tchat.webdev-cf2m.be/

# 2017/05/11

- Augmentation du champs texte de 120 à 500 caractères (la table message)
Effectuez cette commande en sql: 

ALTER TABLE `message` CHANGE `texte` `texte` VARCHAR(500) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;

- Les premiers icones sont actifs

# 2017/05/03

- Instructions dans le contrôleur frontal


# création DB

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `id` int(10) UNSIGNED NOT NULL,
  `texte` varchar(120) NOT NULL,
  `ladate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `util_idutil` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `util`
--

CREATE TABLE `util` (
  `idutil` int(10) UNSIGNED NOT NULL,
  `login` varchar(45) NOT NULL,
  `mdp` char(64) NOT NULL,
  `mail` varchar(80) NOT NULL,
  `clefutil` varchar(64) NOT NULL,
  `actif` tinyint(1) NOT NULL COMMENT 'actif à 1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `util`
--

INSERT INTO `util` (`idutil`, `login`, `mdp`, `mail`, `clefutil`, `actif`) VALUES
(1, 'admin', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'admin@admin', 'xwvxcwvcv', 1);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_message_util_idx` (`util_idutil`);

--
-- Index pour la table `util`
--
ALTER TABLE `util`
  ADD PRIMARY KEY (`idutil`),
  ADD UNIQUE KEY `login_UNIQUE` (`login`),
  ADD UNIQUE KEY `clefutil` (`clefutil`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- 500 caractères en varchar pour le champs texte de la table `message`
--
ALTER TABLE `message` CHANGE `texte` `texte` VARCHAR(500) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
--
-- AUTO_INCREMENT pour la table `util`
--
ALTER TABLE `util`
  MODIFY `idutil` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;


# config.php

/* 
 * Les constantes de connexion
 */

define("DB_HOST", "localhost");
define("DB_LOGIN", "root");
define("DB_PASS", "");
define("DB_NAME", "sql8614_tchat");
define("DB_CHARSET", "utf8");

// variable de pagination

$nb_par_page = 3;
/*
 * temps en secondes de vérification de nouveaux message
 */
define("AJAX_REFRESH", 3);