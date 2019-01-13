<?php
/**
* 
*/
include_once 'contTrajetReserve.php';
class CompTrajetReserve
{
	
	function __construct()
	{
	}
	public function affiche()
	{
		$controleur=new ContTrajetReserve();
		$controleur->affiche();
	}
}