<?php

/**
* 
*/
include_once __DIR__ . '/../../connexion.php';
class modeleTrajetRecent extends connexion
{
	
	function __construct()
	{

	}
	public function TrajetRecent($idUser){

			$selectPreparee=self::$bdd->prepare('SELECT idAuteur,idTrajet,utilisateur.idUtilisateur, note, commenter.description as description FROM utilisateur INNER JOIN commenter on utilisateur.idUtilisateur = commenter.idUtilisateur WHERE utilisateur.idUtilisateur=? and commenter.description is not null order by date DESC limit 5');
			$tableauIds=array($idUser);
			$selectPreparee->execute($tableauIds);
			return $selectPreparee->fetchAll();
		}
}