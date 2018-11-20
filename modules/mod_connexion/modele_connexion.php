<?php

/**
* 
*/
include_once '/../../connexion.php';
class modele_connexion extends connexion
{
	
	function __construct()
	{
		$connexion=new connexion();
		$connexion->init();
	}
	public function validite_connexion($login,$mdp)
	{
		if($login!=null && $mdp!=null && isset($login)&& isset($mdp)){
			$selecPreparee=self::$bdd->prepare('SELECT login FROM utilisateur WHERE login=? and mot_de_passe=?');
			$tableauIds=array($login,crypt($mdp,'$5$rounds=5000$usesomesillystringforsalt$'));
			$selecPreparee->execute($tableauIds);
			$tab= $selecPreparee->fetch();
			return $tab[0]==$login;
		}
		return 1==2;
	}
	public function verifieVar($email,$emailConf,$nom,$prenom,$mdp,$mdpConf){
		$erreur=false;
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			echo "00";
			$erreur=true;
		}
		if (!($emailConf==$email)) {
			echo "01";
			$erreur=true;
		}
		if (!preg_match('#^[a-zA-Z]+[-]{0,1}[a-zA-Z]+$#', $nom)) {
			echo "02";
			$erreur=true;
		}
		if (!preg_match('#^[a-zA-Z]+[-]{0,1}[a-zA-Z]+$#', $prenom)) {
			echo "03";
			$erreur=true;
		}
		if (!preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{8,})#', $mdp)) {
			echo "04";
			$erreur=true;
		}
		if (!($mdp==$mdpConf)) {
			echo "05";
			$erreur=true;
		}
		return $erreur;

	}
	public function verifieInscription($email,$emailConf,$nom,$prenom,$mdp,$mdpConf){
		if(self::verifieVar($email,$emailConf,$nom,$prenom,$mdp,$mdpConf)){
			exit(1);
		}
		
		

		$selecPrepareeUnique=self::$bdd->prepare('SELECT adresseMail FROM utilisateur WHERE adresseMail=?');
		$tableauIds=array($email);
		$selecPrepareeUnique->execute($tableauIds);
		$unique=$selecPrepareeUnique->fetch();
		if (empty($unique['adresseMail'])==0) {
			echo "06";
			exit(1);
		}
		$reponse = self::$bdd->query('SELECT idUtilisateur FROM utilisateur ORDER BY idUtilisateur desc limit 1');
		$id=($reponse->fetch());
		$id1=$id['idUtilisateur']+1;
		$insertPreparee=self::$bdd->prepare('INSERT INTO utilisateur(idUtilisateur,nom,prenom,motDePasse,dateDeNaissance,sexe,adresseMail,description,urlPhoto,credit) values(:idUtilisateur,:nom,:prenom,:motDePasse,"1999-05-02",:sexe,:adresseMail,null,null,DEFAULT)');
		$insertPreparee -> execute(array('idUtilisateur'=>$id1,'nom'=>$nom,'prenom'=>$prenom,'adresseMail'=>$email,'motDePasse'=>$mdp,'sexe'=>true));
	}

}