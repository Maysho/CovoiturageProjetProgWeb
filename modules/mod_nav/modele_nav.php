<?php

include_once __DIR__ . '/../../connexion.php';
class ModeleNav extends connexion{

	

	function __construct(){
		$connexion=new connexion();
		$connexion->init();
		
	}
	public function recupereInfoUtilisateur($idUser){
		
			$selectPreparee=self::$bdd->prepare('SELECT urlPhoto,credit FROM utilisateur WHERE idUtilisateur=? ');
			$tableauIds=array($idUser);
			$selectPreparee->execute($tableauIds);
			return $selectPreparee->fetch();
	}
	
}

?>