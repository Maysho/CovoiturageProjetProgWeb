<?php

/*
*	
*/

include_once 'cont_trajet.php';

class mod_trajet extends VueGenerique{
	private $controleur;

	function __construct(){
		$this->controleur=new cont_trajet();
	}

	public function afficheNav(){
		$this->controleur->nav();
	}

	public function init(){
		$this->controleur->formTrajet();
	}

}?>