<?php
/**
* 
*/
include_once 'contVehicule.php';
class CompVehicule
{
	
	function __construct()
	{
	}
	public function affiche()
	{
		$controleur=new ContVehicule();
		$controleur->affiche();
	}
}