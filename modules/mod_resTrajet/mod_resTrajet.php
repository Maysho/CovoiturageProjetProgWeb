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
		$this->controleur->affichePage();
		
	}


}