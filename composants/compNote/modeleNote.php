<?php

/**
* 
*/
include_once __DIR__ . '/../../connexion.php';
class modeleNote extends connexion
{
	
	function __construct(){}

	public function Note($idUser){

		$selectPreparee=self::$bdd->prepare('SELECT round(avg(note),1) as moyenne FROM commenter WHERE idUtilisateur=? and idAuteur!=? ');
		$tableauIds=array($idUser,$idUser);
		$selectPreparee->execute($tableauIds);
		$note=$selectPreparee->fetch();
		return $note['moyenne'];
		}
}