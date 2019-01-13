<?php

/**
* 
*/
include_once __DIR__ . '/../../connexion.php';
class ModeleVehicule extends connexion
{
	
	function __construct()
	{

	}
	public function Vehicule($idUser){
		$reqGetListeCar = self::$bdd->prepare("
		SELECT *  from vehicule inner join vehiculeutilisateur on vehicule.immatriculation =vehiculeutilisateur.immatriculation where idUtilisateur = ? LIMIT 3
		");
		$reqGetListeCar->execute(array($idUser));
		$liste= $reqGetListeCar->fetchAll();
		return $liste;
	}	
}