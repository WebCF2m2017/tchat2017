<?php

require_once 'config.php';
require_once 'db.class.php';



$db = new DB(DB_HOST,DB_LOGIN,DB_PASS,DB_NAME); 






if (!empty($_POST))
{
	extract($_POST);

	$texte = htmlspecialchars(strip_tags(trim($texte)),ENT_QUOTES);
	$username = htmlspecialchars(strip_tags(trim($username)),ENT_QUOTES);
	$user_id = (int) $user_id;

	$lulu = $db->db->prepare('SELECT * FROM util WHERE login = :username AND idutil = :idutil');
	$lulu->execute(array(':username' => $username, 'idutil' => $user_id));


	if ($lulu->rowCount())
	{
		$lulu = $db->db->prepare('INSERT INTO message(texte, util_idutil) VALUES(:texte, :util_idutil)');
		$req = $lulu->execute(array(':texte' => $texte, 'util_idutil' => $user_id));
		if($req)
			echo 'ok';
	}
	
}
