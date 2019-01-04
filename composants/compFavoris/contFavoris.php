<?php
/**
* 
*/
include_once 'vueFavoris.php';
include_once 'modeleFavoris.php';

class contFavoris
{
	private $vue;
	function __construct()
	{
		$this->vue=new vueFavoris();
		$this->modele=new modeleFavoris();
	}
	public function affiche()
	{
		
		$infoCom=$this->modele->Favoris($_SESSION['id']);
		$this->vue->affiche($infoCom);
	}
	
}