<?php
/**
* 
*/
include_once 'vueHistorique.php';
include_once 'modeleHistorique.php';

class ContHistorique
{
	private $vue;
	function __construct()
	{
		$this->vue=new VueHistorique();
		$this->modele=new ModeleHistorique();
	}
	public function affiche()
	{
		
		$data=$this->modele->Historique($_SESSION['id']);
		$this->vue->affiche($data);
	}
	
}