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
	function __construct()
	{
		$this->modele=new modele_trajet();
		$this->vue=new vue_trajet();
	}
	public function nav(){
		if(isset($_SESSION['login'])){
			$this->vue->navConnecte();
		}
		else{
			$this->vue->navNonConnecte();
		}
	}
	
	public function formTrajet(){
		$this->vue->formCreation();
	}
	public function AffichePageTrajet($value='')
	{
		# code...
	}
	/*public function verifieInscription($email,$emailConf,$nom,$prenom,$mdp,$mdpConf){
		$this->modele->verifieInscription($email,$emailConf,$nom,$prenom,$mdp,$mdpConf);
	}

	public function AffichePageTrajet()
	{
		$this->vue->pageTrajet();
	}*/
}?>