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


	public function init()
	{
		// if(isset($_GET['action'])){
		// 	$action=$_GET['action'];
		// }
		// else{
		// 	$action="";
		// }

		// switch ($action) {
		// 	case 'formTrajet':
		// 		$this->controleur->verifCreationTrajet();
		// 		break;
			
		// 	default:
		// 		# code...
		// 		break;
		// }
		$this->controleur->formTrajet();
	}

}