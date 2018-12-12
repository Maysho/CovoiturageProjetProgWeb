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
		if(isset($_SESSION['id'])){
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
	public function ChercheMotDePasseOublier()
	{

		if (!empty($_GET["email"])&& $this->modele->verifieMail($_GET["email"])) {
			$_SESSION['emailChangement']=$_GET["email"];
			$this->modele->envoieMailMdp($_SESSION['emailChangement']);
			self::affichePageToken(0,$_SESSION['emailChangement']);

		}
		else
			self::AfficheMotDePasseOublier(1);
		
		
	}
	public function VerifieToken()
	{
		if (empty($_SESSION['emailChangement'])) {
			self::AfficheMotDePasseOublier(1);
		}
		elseif (isset($_POST['token'])  && $this->modele->verifieToken($_SESSION['emailChangement'],$_POST["token"])) {
			header("Location: index.php?module=mod_connexion&action=ChangementMDP");
		}
		else
			self::affichePageToken(1);
	}
	public function affichePageToken($value)
	{
		$this->vue->pageToken($value);
	}
	public function ChangementMDP()
	{
		if (empty($_SESSION['emailChangement'])) {
			self::AfficheMotDePasseOublier(1);
		}
		else{
			$this->vue->affichePageChangementMPD(0);
		
		}
	}
	public function VerifieMPD()
	{
		if (isset($_POST['mdp'])&&isset($_POST['mdpconf']) && $this->modele->verifieMDP($_POST['mdp'],$_POST['mdpconf'])) {
			$id=$this->modele->recupereID($_SESSION['emailChangement']);
			unset($_SESSION['emailChangement']);
			if($id>=0){
				$this->modele->changeMDP($_POST['mdp'],$id);				
			}
			$this->vue->pageConnexion(0);
		}
		else
			$this->vue->affichePageChangementMPD(1);
	}
	public function deconnexion($value='')
	{
		unset($_SESSION['id']);
		header("Location: index.php");
	}
	public function AfficheMotDePasseOublier($val)
	{
		$this->vue->motDePasseOublier($val);
	}


}?>