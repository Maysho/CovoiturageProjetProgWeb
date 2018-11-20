<?php

/**
* 
*/

include_once 'cont_connexion.php';

class mod_connexion extends VueGenerique
{
	private $controleur;
	function __construct()
	{
		$this->controleur=new cont_connexion();
	}
	public function afficheNav(){
		$this->controleur->nav();
	}
	public function verifieInscription($email,$emailConf,$nom,$prenom,$mdp,$mdpConf){
		$this->controleur->verifieInscription($email,$emailConf,$nom,$prenom,$mdp,$mdpConf);
	}
	public function init()
	{
		$this->controleur->AffichePageConnexion();
	}


}