<?php
/**
* 
*/
include_once 'contMenu.php';
class CompMenu 
{
	
	function __construct()
	{
		$connexion=new connexion();
		$connexion->init();
	}
	public function affiche()
	{
		$controleur=new ContMenu();
		$controleur->affiche();
	}
}