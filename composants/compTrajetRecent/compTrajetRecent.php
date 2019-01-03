<?php
/**
* 
*/
include_once 'contTrajetRecent.php';
class compTrajetRecent
{
	
	function __construct()
	{
	}
	public function affiche()
	{
		$controleur=new ContTrajetRecent();
		$controleur->affiche();
	}
}