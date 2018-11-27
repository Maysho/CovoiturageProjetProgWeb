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
		if(isset($_GET['action'])){

			$action=$_GET['action'];
		}
		else
			$action="";

		switch ($action) {
			case 'verifConnexion':
				$this->controleur->VerifConnexion();
				break;
			case 'AffichePageConnexion':
				$this->controleur->AfficheMotDePasseOublier();
				break;

			default:
				if (isset($_SESSION['id'])) {
					header("Location: index.php");
				}
				else
					$this->controleur->AffichePageConnexion();
				break;
		}
		
	}


}