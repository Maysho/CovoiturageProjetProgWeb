<?php
/**
* 
*/
include_once 'contTest.php';
class CompTest 
{
	
	function __construct()
	{
	}
	public function affiche()
	{
		$controleur=new ContTest();
		$controleur->affiche();
	}
}