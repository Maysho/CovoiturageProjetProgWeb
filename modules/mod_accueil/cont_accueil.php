<?php 
/**
* 
*/
include_once 'vue_accueil.php';
class ContAccueil
{
	
	private $vue;
	
	function __construct()
	{
		$this->vue=new VueAccueil();
	}
	public function affiche(){
		if(isset($_SESSION['id']))
			$this->vue->afficheSiConnecte();
		else
			$this->vue->afficheSiNonConnecte();
	}
}