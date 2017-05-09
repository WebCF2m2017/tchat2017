<?php

require_once 'config.php';
require_once 'db.class.php';
$db = new DB(DB_HOST,DB_LOGIN,DB_PASS,DB_NAME); 


if (!empty($_POST))
{
	extract($_POST);
	if (!ctype_digit($user_id))
		die('notok');

	$texte = htmlspecialchars(strip_tags(trim($texte)),ENT_QUOTES);
	$username = htmlspecialchars(strip_tags(trim($username)),ENT_QUOTES);

	$db->query('SELECT * FROM util WHERE username = {$username} AND idutil = {$user_id}');
	$data = $db->fetch();
	var_dump($data);

}

if (!empty($_GET))
{
	/*
	$db->db->prepare("INSERT INTO message (texte,idutil) VALUES (?,?);");

	$db->bindValue(2,$lemdp,PDO::PARAM_STR);
    $db->bindValue(3,$lemail,PDO::PARAM_STR);
    $db->bindValue(4,$clef,PDO::PARAM_STR);
    
    // on exécute la requête
    $verif = $db->execute();
    */
}