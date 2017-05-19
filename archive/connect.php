<?php

require_once '../config.php';

/* 
 * Connexion en procédural en mysqli
 */

$db = @mysqli_connect(DB_HOST,DB_LOGIN,DB_PASS,DB_NAME) 
        // en cas d'échec
        or die("Echec de la connexion: ". utf8_encode(mysqli_connect_error())."<br/>Num&eacute;ro d'erreur: ". mysqli_connect_errno());

mysqli_set_charset($db, DB_CHARSET);