<?php



session_start();


// importation de config.php

require_once 'config.php';
require_once 'db.class.php';

$db = new DB(DB_HOST,DB_LOGIN,DB_PASS,DB_NAME); 

$nb = $db->query("SELECT count(id) as nb from message;");

// si il n'existe pas la variable de session OU elle ne vaut plus la même chose que la requête (il y a un/des nouveau(x) message(s)
if(!isset($_SESSION['nombre'])||$_SESSION['nombre']!=$nb){
    // on crée/update la variable de session
    $_SESSION['nombre']=$nb;
    // on dit à l'ajax de charger les derniers messages
    echo "charge";
}else{
    // sinon on fait rien
    echo "rien";
}


