<?php



session_start();


// importation de config.php

require_once 'config.php';
require_once 'db.class.php';
$db = new DB(DB_HOST,DB_LOGIN,DB_PASS,DB_NAME); 

$nb = $db->query("SELECT count(id) as nb from message;");

var_dump($nb);


