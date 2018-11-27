<?php
/**
* 
*/
include_once 'vue_connexion.php';
include_once 'modele_connexion.php';
class cont_connexion
{
	private $modele;
	private $vue;
	function __construct()
	{
		$this->modele=new modele_connexion();
		$this->vue=new vue_connexion();
	}
	public function nav()
	{
		if(isset($_SESSION['login'])){
			$this->vue->navConnecte();
		}
		else{
			$this->vue->navNonConnecte();
		}
		
	}
	public function VerifConnexion()
	{
		$_SESSION['id']=$this->modele->verifieConnexion();
		if($_SESSION['id']<0){
			unset($_SESSION['id']);
			$this->vue->pageConnexion(1);
		}
		else{
			unset($_SESSION['id']);
			header("Location: index.php");
		}

		
	}
	public function verifieInscription($email,$emailConf,$nom,$prenom,$mdp,$mdpConf){
		$this->modele->verifieInscription($email,$emailConf,$nom,$prenom,$mdp,$mdpConf);
	}

	public function AffichePageConnexion()
	{
		$this->vue->pageConnexion();
	}

	public function AfficheMotDePasseOublier()
	{
		$this->vue->motDePasseOublier();
	}


}