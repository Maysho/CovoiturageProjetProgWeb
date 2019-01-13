<?php
/**
* 
*/
include_once 'vueVehicule.php';
include_once 'modeleVehicule.php';

class ContVehicule
{
	private $vue;
	function __construct()
	{
		$this->vue=new VueVehicule();
		$this->modele=new ModeleVehicule();
	}
	public function affiche()
	{
		
		$data=$this->modele->Vehicule($_SESSION['id']);
		$this->vue->affiche($data);
	}
	
}