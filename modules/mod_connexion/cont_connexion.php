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
		if (isset($_GET["email"])&& $this->modele->verifieMail($_GET["email"])) {
			$this->modele->envoieMailMdp($_GET["email"]);
			self::affichePageToken(0,$_GET["email"]);
		}
		else
			self::AfficheMotDePasseOublier(1);
		
		
	}
	public function VerifieToken()
	{
		if (empty($_GET["email"])) {
			self::AfficheMotDePasseOublier(1);
		}
		elseif (isset($_POST['token'])  && $this->modele->verifieToken($_GET["email"],$_POST["token"])) {
			header("Location: index.php?module=mod_connexion&action=ChangementMDP&email=".$_GET['email']);
		}
		else
			self::affichePageToken(1,$_GET["email"]);
	}
	public function affichePageToken($value,$email)
	{
		$this->vue->pageToken($value,$email);
	}
	public function ChangementMDP()
	{
		if (empty($_GET["email"])) {
			self::AfficheMotDePasseOublier(1);
		}
		else{
			$this->vue->affichePageChangementMPD(0,$_GET["email"]);
		
		}
	}
	public function VerifieMPD()
	{
		if (isset($_POST['mdp'])&&isset($_POST['mdpconf']) && $this->modele->verifieMDP($_POST['mdp'],$_POST['mdpconf'])) {
			$_SESSION['id']=$this->modele->recupereID($_GET['email']);
			echo $_SESSION['id'];
			if($_SESSION['id']<0){
				unset($_SESSION['id']);
				$this->vue->pageConnexion(1);
			}
			else{
				header("Location: index.php");
			}
		}
		else
			$this->vue->affichePageChangementMPD(1,$_GET["email"]);
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


}