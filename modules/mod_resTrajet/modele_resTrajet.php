<?php

/**
* 
*/
class modele_resTrajet extends connexion
{
	private $msg;
	function __construct()
	{
		$connexion=new connexion();
		$connexion->init();
		$this->msg="";
	}
	public function donneTrajet($depart='',$destination='',$date='',$prix,$type='',$regulier='')
	{

		$codePostal1=preg_grep("#[0-9]+#", explode(",", $depart));
		$depart=preg_replace("#[0-9]|[ ]|[,]#", "", $depart);

		$codePostal2=preg_grep("#[0-9]+#", explode(",", $destination));
		$destination=preg_replace("#[0-9]|[ ]|[,]#", "", $destination);

		$selecPreparee=self::$bdd->prepare('SELECT trajet.idTrajet,urlPhoto,prenom,villeDepart,villeArrive FROM trajet inner join soustrajet on trajet.idTrajet=soustrajet.idTrajet inner join utilisateur on utilisateur.idUtilisateur=trajet.idConducteur WHERE villeDepart=? and( villeArrive=? or villeDepart=?) and (prix>=? and prix<=?) and trajet ');
		$tableauIds=array($depart,$destination,$destination);
		$selecPreparee->execute($tableauIds);
		$tab= $selecPreparee->fetch();
		echo $tab[0];
		if(empty($tab[0]))
			return -1;
		else
			return $tab[0];
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
		echo json_encode($unique);
		if (empty($unique['adresseMail'])==0) {
			http_response_code(401);
			echo "06";
			exit(1);
		}
		$reponse = self::$bdd->query('SELECT idUtilisateur FROM utilisateur ORDER BY idUtilisateur desc limit 1');
		$id=($reponse->fetch());
		$id1=$id['idUtilisateur']+1;
		$mdpCrypt=crypt($mdp, '$6$rounds=5000$usesomesillystringforsalt$');
		$insertPreparee=self::$bdd->prepare('INSERT INTO utilisateur(idUtilisateur,nom,prenom,motDePasse,dateDeNaissance,sexe,adresseMail,description,urlPhoto,credit,dateCreation) values(:idUtilisateur,:nom,:prenom,:motDePasse,null,:sexe,:adresseMail,null,null,DEFAULT,:dateCreation)');
		$insertPreparee -> execute(array('idUtilisateur'=>$id1,'nom'=>$nom,'prenom'=>$prenom,'adresseMail'=>$email,'motDePasse'=>$mdpCrypt,'sexe'=>true,'dateCreation'=>date("Y-m-d")));
		echo "success";
	}

	public function chercheVille($ville)
	{
		$codePostal=preg_grep("#[0-9]+#", explode(",", $ville));
		$ville=preg_replace("#([0-9]|[ ]|[,])*#", "", $ville);

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
		    array_push($array, $donnee['nomVille']." ".$donnee['codePostal']); // et on ajoute celles-ci à notre tableau
		}

		echo json_encode($array); 
		$selecPrepareeUnique->closeCursor();
	}

}