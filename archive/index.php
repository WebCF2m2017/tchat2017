<?php


require_once 'connect.php';
require_once 'fonctions.php';

$nb_par_page = 50;

if(!isset($_GET['idarticle'])){
    // pour pagination
    if(isset($_GET['pg'])&& ctype_digit($_GET['pg'])){
        $pg= (int) $_GET['pg'];
    }else{
        $pg=1;
    }
    
    // affichage de tous les articles par ladate DESC avec lelogin de l'auteur (mailto vers son email)... N'afficher que les 300 premiers caractères + lire la suite    
    require_once 'accueil.php'; 
}