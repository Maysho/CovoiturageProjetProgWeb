<?php

/**
* 
*/

include_once 'cont_trajet.php';

class mod_trajet extends VueGenerique
{
	private $controleur;
	function __construct()
	{
		$this->controleur=new cont_trajet();
	}
	public function afficheNav(){
		$this->controleur->nav();
	}


	/*public function verifieInscription($email,$emailConf,$nom,$prenom,$mdp,$mdpConf){
		$this->controleur->verifieInscription($email,$emailConf,$nom,$prenom,$mdp,$mdpConf);
	}*/

	public function verifCreationTrajet($soustrajets, $idVehicule, $descTrajet, $placeTotale){
		$this->controleur->verifCreationTrajet($soustrajets, $idVehicule, $descTrajet, $placeTotale);
	}

	public function verifCreationTrajet2($descriptionTrajet, $placeTotale){
		$this->controleur->verifCreationTrajet2($descriptionTrajet, $placeTotale);
	}

	public function init()
	{
		$this->controleur->formTrajet();
	}

}?>