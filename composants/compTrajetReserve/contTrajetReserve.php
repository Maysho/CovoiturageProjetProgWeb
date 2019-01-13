<?php
/**
* 
*/
include_once 'vueTrajetReserve.php';
include_once 'modeleTrajetReserve.php';

class ContTrajetReserve
{
	private $vue;
	function __construct()
	{
		$this->vue=new VueTrajetReserve();
		$this->modele=new ModeleTrajetReserve();
	}
	public function affiche()
	{
		
		$data=$this->modele->TrajetReserve($_SESSION['id']);
		$this->vue->affiche($data);
	}
	
}