<?php

if(isset($_POST['titre']) && !empty($_POST['titre']) && isset($_POST['texte']) && !empty($_POST['texte'])){
	$idutil = (int) $_POST['idutil'];
	$texte = htmlspecialchars(strip_tags(trim($_POST['titre'])),ENT_QUOTES);
	$titre = htmlspecialchars(strip_tags(trim($_POST['texte'])),ENT_QUOTES);

	if($texte&&$titre&&$idutil){
		$sql = "INSERT INTO message ('idutil','titre','texte') VALUES ($idutil,'$titre','$texte')";

		$sql_recup = mysqli_query($db,$sql);

		$tab = mysqli_fetch_assoc($sql_recup);
	}else{
		header("Location: ./");
	}
}

class Traitement{

	private $titre;
	private $texte;
	private $idutil;


	public function __construct($titre=null,$texte=null){
		if($titre!=null && $texte!=null){
			$this->titre = $titre;
			$this->texte = $texte;
			$this->idutil = $idutil;
		}else{
			header("Location: base.php");
		}
	}
	public function query($sql){
		$req = $this->db->prepare($sql);
		$req = execute();
		return $req->fetchAll();
	}
}

