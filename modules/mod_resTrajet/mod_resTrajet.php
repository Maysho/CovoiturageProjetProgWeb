<?php

/**
* 
*/

include_once 'cont_resTrajet.php';

class mod_resTrajet extends VueGenerique
{
	private $controleur;
	function __construct()
	{
		$this->controleur=new cont_resTrajet();
	}
	public function init()
	{
		if (isset($_GET['action'])&& $_GET['action']="afficheFavoris" && isset($_SESSION['id'])) {
			$this->controleur->afficheFavoris();
		}
		else {
			$this->controleur->affichePage();
		}

		
	}


}