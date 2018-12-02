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
		$this->vue->affiche(isset($_SESSION['id']));
	}
}