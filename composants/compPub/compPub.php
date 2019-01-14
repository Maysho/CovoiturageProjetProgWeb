<?php
/**
* 
*/
include_once 'contPub.php';
class compPub
{
	
	function __construct()
	{
	}
	public function affiche()
	{
		$controleur=new ContPub();
		$controleur->affiche();
	}
}