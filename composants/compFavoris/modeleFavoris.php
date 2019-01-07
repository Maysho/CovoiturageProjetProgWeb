<?php

/**
* 
*/
include_once __DIR__ . '/../../connexion.php';
class modeleFavoris extends connexion
{
	
	function __construct()
	{

	}
	public function Favoris($idUser){

		$reqGetListeFavoris = self::$bdd->prepare("SELECT * from favoris  where idUtilisateur = ? order by idfavoris desc limit 2");
		$reqGetListeFavoris->execute(array($idUser));
		$liste= $reqGetListeFavoris->fetchAll();
		return $liste;
		}
}