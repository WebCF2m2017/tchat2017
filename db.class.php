<?php

class DB{

	private $titre;
	private $texte;
	private $idutil;
	private $clef_de_session;

	private $host ="localhost";
	private $login = "root";
	private $pwd = "";
	private $dataname = "sql8614_tchat";
	private $db;


	public function __construct($host=null,$login=null,$pwd=null,$dataname=null){
		if($host!=null){
			$this->host = $host;
			$this->login = $login;
			$this->pwd = $pwd;
			$this->dataname= $dataname;
		}
		try{
			$this->db = new PDO("mysql:host=".$this->host.';dbname='.$this->dataname, $this->login, $this->pwd, array(
				PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8',
				PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
		}catch(PDOExecption $e){
			die("Connexion à la db impossible");
		}
	}
	public function query($sql){
		$req = $this->db->prepare($sql);
		$req = execute();
		return $req->fetchAll();
	}
	public function verif_session($clef_de_session){
		return $this->clef_de_session == session_id();
	}
}

