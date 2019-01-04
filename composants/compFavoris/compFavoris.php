<?php
/**
* 
*/
include_once 'contFavoris.php';
class compFavoris
{
	
	function __construct()
	{
	}
	public function affiche()
	{
		$controleur=new ContFavoris();
		$controleur->affiche();
	}
}