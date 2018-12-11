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
		$regulier=false;
		if (isset($_POST['regulier'])) {
			$regulier=true;
		}
		$tab1=$this->modele->donneTrajetDirect($_POST['depart'],$_POST['destination'],$_POST['date'],$_POST['prix'],$_POST['type'],$regulier);
		//$tab2=$this->modele->donneTrajetAPartirEtape($_POST['depart'],$_POST['destination'],$_POST['date'],$_POST['prix'],$_POST['type'],$regulier);
		//$tab3=$this->modele->donneTrajetAPartirDepart($_POST['depart'],$_POST['destination'],$_POST['date'],$_POST['prix'],$_POST['type'],$regulier);
		if (isset($_SESSION['id'])) {
			$this->vue->affichePage(1,$tab1);
		}
		else
			$this->vue->affichePage(0,$tab1);
	}
	


}