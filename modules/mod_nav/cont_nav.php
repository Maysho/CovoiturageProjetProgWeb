<?php
/**
* 
*/
include_once 'vue_nav.php';
include_once 'modele_nav.php';
class cont_nav
{
	private $vue;
	private $modele;

	function __construct()
	{
		$this->vue=new vue_nav();
		$this->modele=new ModeleNav();
	}
	public function nav()
	{
		if(isset($_SESSION['id'])){
			$url=$this->modele->recupereInfoUtilisateur($_SESSION['id']);
			$this->vue->navConnecte($url);
		}
		else{
			$this->vue->navNonConnecte();
		}
		
	}


}?>