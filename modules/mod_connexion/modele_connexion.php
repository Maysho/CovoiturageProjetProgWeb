<?php

/**
* 
*/
include_once __DIR__ . '/../../connexion.php';
class modele_connexion extends connexion
{
	private $msg;
	function __construct()
	{
		$connexion=new connexion();
		$connexion->init();
		$this->msg="";
	}
	public function verifieConnexion()
	{

		if(isset($_POST['mailConnexion'])&& isset($_POST['mdpConnexion'])){
			$selecPreparee=self::$bdd->prepare('SELECT idUtilisateur FROM utilisateur WHERE adresseMail=? and motDePasse=?');
			//$tableauIds=array($login,crypt($mdp,'$5$rounds=5000$usesomesillystringforsalt$'));
			$tableauIds=array($_POST['mailConnexion'],$_POST['mdpConnexion']);
			$selecPreparee->execute($tableauIds);
			$tab= $selecPreparee->fetch();
			echo $tab[0];
			if(empty($tab[0]))
				return -1;
			else
				return $tab[0];
		}
		return -1;
	}
	public function verifieVar($email,$emailConf,$nom,$prenom,$mdp,$mdpConf){
		$erreur=false;
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			 $this->msg=$this->msg."00-";
			 echo $this->msg;
			$erreur=true;
		}
		if (!($emailConf==$email)) {
			$this->msg= $this->msg."01-";

			$erreur=true;
		}
		if (!preg_match('#^[a-zA-Z]+[-]{0,1}[a-zA-Z]+$#', $nom)) {
			$this->msg=$this->msg."02-";
			$erreur=true;
		}
		if (!preg_match('#^[a-zA-Z]+[-]{0,1}[a-zA-Z]+$#', $prenom)) {
			$this->msg=$this->msg."03-";
			$erreur=true;
		}
		if (!preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{8,})#', $mdp)) {
			$this->msg= $this->msg."04-";
			$erreur=true;
		}
		if (!($mdp==$mdpConf)) {
			$this->msg= $this->msg."05-";
			$erreur=true;
		}
		return $erreur;

	}
	public function verifieInscription($email,$emailConf,$nom,$prenom,$mdp,$mdpConf){
		if(self::verifieVar($email,$emailConf,$nom,$prenom,$mdp,$mdpConf)){
			http_response_code(400);
			echo $this->msg;

			exit(1);
		}
		
		

		$selecPrepareeUnique=self::$bdd->prepare('SELECT * FROM utilisateur ');
		$tableauIds=array($email);
		$selecPrepareeUnique->execute($tableauIds);
		$unique=$selecPrepareeUnique->fetch();
		echo json_encode($unique);
		if (empty($unique['adresseMail'])==0) {
			http_response_code(401);
			echo "06";
			exit(1);
		}
		$reponse = self::$bdd->query('SELECT idUtilisateur FROM utilisateur ORDER BY idUtilisateur desc limit 1');
		$id=($reponse->fetch());
		$id1=$id['idUtilisateur']+1;
		$insertPreparee=self::$bdd->prepare('INSERT INTO utilisateur(idUtilisateur,nom,prenom,motDePasse,dateDeNaissance,sexe,adresseMail,description,urlPhoto,credit,dateCreation) values(:idUtilisateur,:nom,:prenom,:motDePasse,null,:sexe,:adresseMail,null,null,DEFAULT,:dateCreation)');
		$insertPreparee -> execute(array('idUtilisateur'=>$id1,'nom'=>$nom,'prenom'=>$prenom,'adresseMail'=>$email,'motDePasse'=>$mdp,'sexe'=>true,'dateCreation'=>date("Y-m-d")));
		echo "success";
	}

}