<?php

/**
* 
*/

include_once 'cont_nav.php';

class mod_nav
{
	private $controleur;
	function __construct()
	{
		$this->controleur=new cont_nav();
	}
	public function afficheNav(){
		$this->controleur->nav();
	}

}