<?php



session_start();


// importation de config.php

require_once 'dbtraitement.class.php';


require_once 'config.php';
require_once 'connect.php';
require_once 'fonctions.php';


if(isset($_GET['inscription'])){
    require_once 'inscription.php';
    
}elseif(isset($_GET['confirm'])&&isset($_GET['id'])&&isset($_GET['c'])&&
        ctype_digit($_GET['id']) && !empty($_GET['c'])
        ){
        $id = (int) $_GET['id'];
        $clef = htmlspecialchars($_GET['c'],ENT_QUOTES);
    require_once 'confirm.php';

}

elseif(!isset($_SESSION['clef_de_session'])){
    require_once 'accueil.php';
}else{
    
    if($_SESSION['clef_de_session']== session_id()){
        
        if(isset($_GET['action'])){
           
            switch($_GET['action']){

                case "deco":
                    header("Location: disconnect.php");
                    break;

                default :
                    header("Location: ./");
            }
        }else{
            require_once 'base.php';
        }
    }else{
        header("Location: disconnect.php");
    }
}

// SI nous ne sommes pas connectés

    // Hiliye et joao => page d'accueil avec formulaire de connexion => accueil.php
    
// si connecté (tant que Hiliye et Joao bossent dessus, par défaut)

// Yassine et Houssain création du design de l'acceuil, avec un div pour le texte (les messages) qui s'affiche en haut, un div en bas de page avec un formulaire pour l'envoi => base.php

// Momo => crée une feuille de style (ou plusieures) dans un dossier css/

// Tristan, modidifie ajax.js pour pouvoir récupérer des infos d'une page php=>sql=>php

// John modidifie ajax.js pour pouvoir envoyer des infos du formulaire vers php=>sql=>php

// igor, crée des fichiers .php qui vont afficher les données venant de la db, ou insérer dans la db depuois un formulaire (insertion db)


// Mounir, passe chez tout le monde, et trouve le moyen d'harmoniser le travail des différents intervenants

