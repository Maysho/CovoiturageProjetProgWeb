<?php
/**
* 
*/
include_once 'vue_trajet.php';
include_once 'modele_trajet.php';
class cont_trajet
{
	private $modele;
	private $vue;

	function __construct(){
		$this->modele=new modele_trajet();
		$this->vue=new vue_trajet();
	}

	public function formTrajet(){
		if(isset($_SESSION['id']))
			$this->vue->formCreation();
		else
			header("Location: index.php?module=mod_connexion");
	}

}?>