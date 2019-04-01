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
			self::affichePageToken(0,$_GET["email"]);
		}
		else
			self::AfficheMotDePasseOublier(1);
		
		
	}
	public function VerifieToken()
	{
		if (empty($_SESSION['emailChangement'])) {
			self::AfficheMotDePasseOublier(1);
		}
		elseif (isset($_POST['token'])  && $this->modele->verifieToken(htmlspecialchars($_SESSION['emailChangement']),htmlspecialchars($_POST["token"]))) {
			self::ChangementMDP(htmlspecialchars($_POST["token"]));
		}
		else
			self::affichePageToken(1);
	}
	public function affichePageToken($value)
	{
		$this->vue->pageToken($value);
	}
	public function ChangementMDP($token)
	{
		if (empty($_SESSION['emailChangement'])) {
			self::AfficheMotDePasseOublier(1);
		}
		else{
			$this->vue->affichePageChangementMPD(0,$token);
		
		}
	}
	public function VerifieMPD()
	{
		if (isset($_POST['mdp'])&&isset($_POST['mdpconf'])&& isset($_POST['token']) && $this->modele->verifieMDP(htmlspecialchars($_POST['mdp']),htmlspecialchars($_POST['mdpconf']))) {
			$id=$this->modele->recupereID($_SESSION['emailChangement']);
			unset($_SESSION['emailChangement']);
			if($id>=0){
				if ($this->modele->verifieTokenDansMDP(htmlspecialchars($_POST['token']),$id)) {
					$this->modele->changeMDP($_POST['mdp'],$id);	
					header("Location: index.php?module=mod_connexion");
				}
				else
					$this->vue->affichePageChangementMPD(1,null);		
			}
			
		}
		else
			$this->vue->affichePageChangementMPD(1,null);
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
	public function ChercheMotDePasseOublie($value='')
	{
		if (!empty($_GET["email"])&& $this->modele->verifieMail($_GET["email"])) {
			
			$this->modele->envoieMailMdp($_GET["email"]);
			header("Location: index.php?module=mod_connexion&action=ChercheMotDePasseOublier&email=".$_GET["email"]);

		}
		else
			self::AfficheMotDePasseOublier(1);
		
	}


}?>