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
			case 'AfficheMotDePasseOublier':
				if (isset($_GET['trompe'])) {
					$this->controleur->AfficheMotDePasseOublier(1);
				}
				else
					$this->controleur->AfficheMotDePasseOublier(0);
				break;
			case 'ChercheMotDePasseOublie':
				$this->controleur->ChercheMotDePasseOublie();
				break;
			case 'ChercheMotDePasseOublier':
				$this->controleur->ChercheMotDePasseOublier();
				break;
			case 'deconnexion':
				$this->controleur->deconnexion();
				break;
			case 'VerifieToken':
				$this->controleur->VerifieToken();
				break;
			case 'ChangementMDP':
				$this->controleur->ChangementMDP();
				break;
			case 'VerifieMPD':
				$this->controleur->VerifieMPD();
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