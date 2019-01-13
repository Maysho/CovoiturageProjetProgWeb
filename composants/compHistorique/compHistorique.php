<?php
/**
* 
*/
include_once 'contHistorique.php';
class CompHistorique
{
	
	function __construct()
	{
	}
	public function affiche()
	{
		$controleur=new ContHistorique();
		$controleur->affiche();
	}
}