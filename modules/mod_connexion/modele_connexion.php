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
			$mdpCrypt=crypt($_POST['mdpConnexion'],'$6$rounds=5000$usesomesillystringforsalt$');
			$selecPreparee=self::$bdd->prepare('SELECT idUtilisateur FROM utilisateur WHERE adresseMail=? and motDePasse=?');
			$tableauIds=array($_POST['mailConnexion'],$mdpCrypt);
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
		

		$selecPrepareeUnique=self::$bdd->prepare('SELECT adresseMail FROM utilisateur where adresseMail=? ');
		$tableauIds=array($email);
		$selecPrepareeUnique->execute($tableauIds);
		$unique=$selecPrepareeUnique->fetch();
		if (empty($unique['adresseMail'])==0) {
			http_response_code(401);
			echo "06";
			exit(1);
		}
		$mdpCrypt=crypt($mdp, '$6$rounds=5000$usesomesillystringforsalt$');
		$insertPreparee=self::$bdd->prepare('INSERT INTO utilisateur(idUtilisateur,nom,prenom,motDePasse,dateDeNaissance,sexe,adresseMail,description,urlPhoto,credit,dateCreation,token) values(DEFAULT,:nom,:prenom,:motDePasse,null,null,:adresseMail,null,null,DEFAULT,:dateCreation,null)');
		$insertPreparee -> execute(array('nom'=>$nom,'prenom'=>$prenom,'adresseMail'=>$email,'motDePasse'=>$mdpCrypt,'dateCreation'=>date("Y-m-d")));
		echo "success";
	}

	public function chercheVille($ville)
	{
		$codePostal=preg_grep("#[0-9]+#", explode(",", $ville));
		$ville=preg_replace("#([0-9]|[,])*#", "", $ville);

		$selecPrepareeUnique=self::$bdd->prepare('SELECT nomVille,codePostal FROM ville where nomVille like "%"?"%" or( codePostal>= ? and codePostal<=?) limit 5');

		$codePostals=isset($codePostal[1]) || isset($codePostal[0])?(isset($codePostal[0])?$codePostal[0] :$codePostal[1]):"99999999";
		$codePostal1=$codePostals;
		$codePostal2=$codePostals;
		while ($codePostal1 <= 10000) {
			$codePostal1=$codePostal1*10;
		}
		while ($codePostal2 <= 10000) {
			$codePostal2=($codePostal2*10)+9;
		}
		if (empty($ville)) {
			$ville=-9999999999999;
		}

		$tableauIds=array($ville,$codePostal1,$codePostal2);
		$selecPrepareeUnique->execute($tableauIds);
		$array = array(); // on créé le tableau

		while($donnee = $selecPrepareeUnique->fetch()) // on effectue une boucle pour obtenir les données
		{
		    array_push($array, $donnee['nomVille'].", ".$donnee['codePostal']); // et on ajoute celles-ci à notre tableau
		}

		echo json_encode($array); 
		$selecPrepareeUnique->closeCursor();
	}

	public function envoieMailMdp($email)
	{
		$lettrePossible = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','0','1','2','3','4','5','6','7','8','9');
		$token="";
		for ($i=0; $i < 10; $i++) { 
			$token=$token.$lettrePossible[rand(0,61)];
		}
		$insertPreparee=self::$bdd->prepare('UPDATE utilisateur SET token = :token WHERE adresseMail=:adresseMail');
		$insertPreparee -> execute(array('token'=>$token,'adresseMail'=>$email));
		mail($email, 'Mot de passe oublier covoiturage', $token, "From: covoiturage@hotm.fr");
	}
	public function verifieMail($email)
	{
		if (filter_var($email, FILTER_VALIDATE_EMAIL)){
			$selecPrepareeUnique=self::$bdd->prepare('SELECT adresseMail FROM utilisateur where adresseMail=? ');
			$tableauIds=array($email);
			$selecPrepareeUnique->execute($tableauIds);
			$unique=$selecPrepareeUnique->fetch();
			if (!empty($unique['adresseMail'])==0) {
				return false;
			}
			return true;
		}
		else
			return false;
	}
	public function verifieToken($email,$token)
	{
		$selecPrepareeUnique=self::$bdd->prepare('SELECT token FROM utilisateur where adresseMail=? and token=?');
		$tableauIds=array($email,$token);
		$selecPrepareeUnique->execute($tableauIds);
		$unique=$selecPrepareeUnique->fetch();
		if (!empty($unique['token'])==0) {
			return false;
		}
		return true;
	}
	public function verifieMDP($mdp,$mdpConf)
	{
		if (!preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{8,})#', $mdp)) {
			return false;
		}
		if (!($mdp==$mdpConf)) {
			return false;
		}
		return true;
	}
	public function recupereID($email)
	{
		if(empty($email)==0){
			$selecPreparee=self::$bdd->prepare('SELECT idUtilisateur FROM utilisateur WHERE adresseMail=?');
			$tableauIds=array($email);
			$selecPreparee->execute($tableauIds);
			$tab= $selecPreparee->fetch();
			if(empty($tab[0]))
				return -1;
			else
				return $tab[0];
		}
		return -1;
	}
	public function changeMDP($mdp,$id)
	{
		$insertPreparee=self::$bdd->prepare('UPDATE utilisateur SET motDePasse = :mdp WHERE idUtilisateur=:id');
		$mdpCrypt=crypt($mdp, '$6$rounds=5000$usesomesillystringforsalt$');
		$insertPreparee -> execute(array('mdp'=>$mdpCrypt,'id'=>$id));
	}
}