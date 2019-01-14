<?php
/**
* 
*/
include_once 'vuePub.php';


class contPub
{
	private $vue;
	function __construct()
	{
		$this->vue=new vuePub();
	}
	public function affiche()
	{
		
		//$infoCom=$this->modele->Favoris($_SESSION['id']);
		$this->vue->affiche();
	}
	
}