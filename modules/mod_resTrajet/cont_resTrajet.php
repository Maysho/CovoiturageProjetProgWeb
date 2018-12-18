<?php
/**
* 
*/
include_once 'vue_resTrajet.php';
include_once 'modele_resTrajet.php';
class cont_resTrajet
{
	private $modele;
	private $vue;
	function __construct()
	{
		$this->modele=new modele_resTrajet();
		$this->vue=new vue_resTrajet();
	}
	
	public function VerifConnexion()
	{
		$_SESSION['id']=$this->modele->verifieConnexion();
		if($_SESSION['id']<0){
			unset($_SESSION['id']);
			$this->vue->pageConnexion(1);
		}
		else{
			header("Location: index.php");
		}

		
	}
	public function affichePage($value='')
	{
		$regulier=0;
		if (isset($_POST['regulier'])) {
			$regulier=true;
		}
		if (!isset($_POST['depart'])|| !isset($_POST['destination'])) {
			header("Location: index.php");
		}
		else{
			$tab=$this->modele->donneTrajet($_POST['depart'],$_POST['destination'],$_POST['date'],$_POST['prix'],$_POST['type'],$regulier);
			if (isset($_SESSION['id'])) {
				$this->vue->affichePage(1,$tab,$_POST['depart'],$_POST['destination'],$_POST['date'],$_POST['prix'],$_POST['type'],$regulier);
			}
			else
				$this->vue->affichePage(0,$tab,$_POST['depart'],$_POST['destination'],$_POST['date'],$_POST['prix'],$_POST['type'],$regulier);
		}
	}
	


}