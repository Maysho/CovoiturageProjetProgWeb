<?php
/**
* 
*/
include_once 'vueTrajetRecent.php';
include_once 'modeleTrajetRecent.php';

class contTrajetRecent
{
	private $vue;
	function __construct()
	{
		$this->vue=new vueTrajetRecent();
		$this->modele=new modeleTrajetRecent();
	}
	public function affiche()
	{
		
		$infoCom=$this->modele->TrajetRecent($_SESSION['id']);
		$this->vue->affiche($infoCom);
	}
	
}