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

	public function donneTrajet($depart='',$destination='',$date,$prix=100000,$type='',$regulier,$order='prix')
	{
		if (empty($date)) {//||$date<date('Y-m-d');
			$date=date('Y-m-d');
		}
		if (empty($prix) ) {
			$prix=100000;
		}
		list($depart, $codePostal1)= explode(",", $depart);
		list($destination, $codePostal2)= explode(",", $destination);
		$selecPreparee=self::$bdd->prepare('SELECT idTrajet, urlPhoto, prenom, depart, destination, prix, heureDepart, heureArrivee,placeTotale from ( 
			SELECT trajet.idTrajet as idTrajet,urlPhoto,prenom,a.nomVille as depart, b.nomVille as destination,prix,heureDepart,heureArrivee,trajet.placeTotale-count(utilisateur_idutilisateur) as placeTotale, trajet.placeTotale as t FROM trajet inner join soustrajet on trajet.idTrajet=soustrajet.idTrajet 
			inner join utilisateur on utilisateur.idUtilisateur=trajet.idConducteur 
			inner join ville as a on a.idVille=soustrajet.idVilleDepart 
			inner join ville as b on b.idVille=soustrajet.idVilleArrivee 
			left join soustrajetutilisateur as stu on stu.sousTrajet_idsousTrajet=soustrajet.idsousTrajet
			WHERE a.nomVille LIKE ?"%" and b.nomVille LIKE ?"%" and prix<=? and regulier=? and dateDepart=? and suppression=0  GROUP BY trajet.idTrajet
HAVING trajet.placeTotale-count(utilisateur_idutilisateur)>0)co
			



			UNION (

	SELECT idTrajet, urlPhoto, prenom, depart, destination, prix, heureDepart, heureArrivee,placeTotale from(
			SELECT trajet.idTrajet as idTrajet,urlPhoto,prenom,a.nomVille as depart,b.nomVille as destination, d.prixCumule-e.prixCumule as prix,c.heureDepart as heureDepart, d.heureArrivee as heureArrivee, c.idsoustrajet as idsoustraj FROM trajet 
			inner join soustrajet as c on trajet.idTrajet=c.idTrajet 
			inner join soustrajet as d on trajet.idTrajet=d.idTrajet 
			inner join soustrajet as e on trajet.idTrajet=e.idTrajet 
			inner join utilisateur on utilisateur.idUtilisateur=trajet.idConducteur 
			inner join ville as a on a.idVille=c.idVilleDepart 
			inner join ville as b on b.idVille=d.idVilleArrivee 
			inner join ville as f on f.idVille=e.idVilleArrivee 
			WHERE a.nomVille LIKE ?"%" and b.nomVille LIKE ?"%" and f.nomVille LIKE ?"%" and d.prixCumule-e.prixCumule<= ? and c.regulier=? and c.dateDepart=? and suppression=0 and placeTotale>0 and c.idTrajet in (SELECT idTrajete from( 
			SELECT idTrajete, min(placeTotale) as placeTotale from (

			SELECT s.idTrajet as idTrajete,s.idsousTrajet as idsoustraj, COUNT(DISTINCT stu3.utilisateur_idutilisateur), trajet.placeTotale-count(DISTINCT stu3.utilisateur_idutilisateur) as placeTotale,trajet.placeTotale as ptot FROM soustrajet as s1 
				INNER join `soustrajetutilisateur` as stu1 on s1.idsousTrajet=stu1.sousTrajet_idsousTrajet 
				INNER join soustrajet as s8 on s8.idTrajet=s1.idTrajet
				inner join `soustrajetutilisateur` as stu2 on s8.idsousTrajet=stu2.sousTrajet_idsousTrajet 
				INNER JOIN soustrajet as s on s.idTrajet=s1.idTrajet 
				inner join `soustrajetutilisateur` as stu3 on s.idsousTrajet=stu3.sousTrajet_idsousTrajet 
				INNER join trajet as trajet on trajet.idTrajet=s.idTrajet 
				inner join ville as a on a.idVille=s1.idVilleDepart 
				inner join ville as b on b.idVille=s8.idVilleArrivee 
				WHERE a.nomVille LIKE ?"%" and b.nomVille LIKE ?"%" and s1.heureDepart<=s.heureDepart and s8.heureDepart>=s.heureDepart and s1.idTrajet=s.idTrajet and s8.idTrajet=s.idTrajet GROUP BY stu3.sousTrajet_idsousTrajet ) col group by idTrajete HAVING min(placeTotale)>0)l ))a

				inner join ( SELECT idTrajete, min(placeTotale) as placeTotale from (
			SELECT s.idTrajet as idTrajete,s.idsousTrajet as idsoustraje, COUNT(DISTINCT stu3.utilisateur_idutilisateur), trajet.placeTotale-count(DISTINCT stu3.utilisateur_idutilisateur) as placeTotale,trajet.placeTotale as totale FROM soustrajet as s1 
				INNER join `soustrajetutilisateur` as stu1 on s1.idsousTrajet=stu1.sousTrajet_idsousTrajet 
				INNER join soustrajet as s8 on s8.idTrajet=s1.idTrajet
				inner join `soustrajetutilisateur` as stu2 on s8.idsousTrajet=stu2.sousTrajet_idsousTrajet 
				INNER JOIN soustrajet as s on s.idTrajet=s1.idTrajet 
				inner join `soustrajetutilisateur` as stu3 on s.idsousTrajet=stu3.sousTrajet_idsousTrajet 
				INNER join trajet as trajet on trajet.idTrajet=s.idTrajet 
				inner join ville as a on a.idVille=s1.idVilleDepart 
				inner join ville as b on b.idVille=s8.idVilleArrivee 
				WHERE a.nomVille LIKE ?"%" and b.nomVille LIKE ?"%" and s1.heureDepart<=s.heureDepart and s8.heureDepart>=s.heureDepart and s1.idTrajet=s.idTrajet and s8.idTrajet=s.idTrajet GROUP BY stu3.sousTrajet_idsousTrajet )b group by idTrajete)h on idTrajet=idTrajete
				) 


			UNION (

	SELECT idTrajet, urlPhoto, prenom, depart, destination, prix, heureDepart, heureArrivee,placeTotale from(
			SELECT trajet.idTrajet as idTrajet,c.idsoustrajet as idsoustraj, urlPhoto,prenom,a.nomVille as depart ,b.nomVille as destination,d.prixCumule as prix ,c.heureDepart as heureDepart, d.heureArrivee as heureArrivee FROM trajet inner join soustrajet as c on trajet.idTrajet=c.idTrajet 
			inner join soustrajet as d on trajet.idTrajet=d.idTrajet 
			inner join utilisateur on utilisateur.idUtilisateur=trajet.idConducteur 
			inner join ville as a on a.idVille=c.idVilleDepart 
			inner join ville as b on b.idVille=d.idVilleArrivee 
			WHERE a.nomVille LIKE ?"%" and b.nomVille LIKE ?"%" and d.prixCumule<=? and c.regulier=? and c.dateDepart=? and suppression=0 and c.idTrajet in ( 


			SELECT idTrajete FROM (
			SELECT idTrajete, min(placeTotale) as placeTotale from (
			SELECT s.idTrajet as idTrajete,s.idsousTrajet as idsoustraj, COUNT(DISTINCT stu3.utilisateur_idutilisateur), trajet.placeTotale-count(DISTINCT stu3.utilisateur_idutilisateur) as placeTotale,trajet.placeTotale as ptot FROM soustrajet as s1 
				INNER join `soustrajetutilisateur` as stu1 on s1.idsousTrajet=stu1.sousTrajet_idsousTrajet 
				INNER join soustrajet as s8 on s8.idTrajet=s1.idTrajet
				inner join `soustrajetutilisateur` as stu2 on s8.idsousTrajet=stu2.sousTrajet_idsousTrajet 
				INNER JOIN soustrajet as s on s.idTrajet=s1.idTrajet 
				inner join `soustrajetutilisateur` as stu3 on s.idsousTrajet=stu3.sousTrajet_idsousTrajet 
				INNER join trajet as trajet on trajet.idTrajet=s.idTrajet 
				inner join ville as a on a.idVille=s1.idVilleDepart 
				inner join ville as b on b.idVille=s8.idVilleArrivee 
				WHERE a.nomVille LIKE ?"%" and b.nomVille LIKE ?"%" and s1.heureDepart<=s.heureDepart and s8.heureDepart>=s.heureDepart and s1.idTrajet=s.idTrajet and s8.idTrajet=s.idTrajet GROUP BY stu3.sousTrajet_idsousTrajet) col2 group by idTrajete HAVING min(placeTotale)>0)k )
				
			and d.idTrajet NOT IN (
			SELECT trajet.idTrajet as idTrajet FROM trajet inner join soustrajet as c on trajet.idTrajet=c.idTrajet 
			inner join soustrajet as d on trajet.idTrajet=d.idTrajet 
			inner join soustrajet as e on trajet.idTrajet=e.idTrajet 
			inner join utilisateur on utilisateur.idUtilisateur=trajet.idConducteur 
			inner join ville as a on a.idVille=c.idVilleDepart 
			inner join ville as b on b.idVille=d.idVilleArrivee 
			inner join ville as f on f.idVille=e.idVilleArrivee 
			WHERE a.nomVille LIKE ?"%" and b.nomVille LIKE ?"%" and f.nomVille LIKE ?"%" and d.prixCumule-e.prixCumule<= ? and c.regulier=? and c.dateDepart=?)

			)e inner join ( SELECT idTrajete, min(placeTotale) as placeTotale from (
			SELECT s.idTrajet as idTrajete,s.idsousTrajet as idsoustraje, COUNT(DISTINCT stu3.utilisateur_idutilisateur), trajet.placeTotale-count(DISTINCT stu3.utilisateur_idutilisateur) as placeTotale,trajet.placeTotale as totale FROM soustrajet as s1 
				INNER join `soustrajetutilisateur` as stu1 on s1.idsousTrajet=stu1.sousTrajet_idsousTrajet 
				INNER join soustrajet as s8 on s8.idTrajet=s1.idTrajet
				inner join `soustrajetutilisateur` as stu2 on s8.idsousTrajet=stu2.sousTrajet_idsousTrajet 
				INNER JOIN soustrajet as s on s.idTrajet=s1.idTrajet 
				inner join `soustrajetutilisateur` as stu3 on s.idsousTrajet=stu3.sousTrajet_idsousTrajet 
				INNER join trajet as trajet on trajet.idTrajet=s.idTrajet 
				inner join ville as a on a.idVille=s1.idVilleDepart 
				inner join ville as b on b.idVille=s8.idVilleArrivee 
				WHERE a.nomVille LIKE ?"%" and b.nomVille LIKE ?"%" and s1.heureDepart<=s.heureDepart and s8.heureDepart>=s.heureDepart and s1.idTrajet=s.idTrajet and s8.idTrajet=s.idTrajet GROUP BY stu3.sousTrajet_idsousTrajet )b group by idTrajete)g on idTrajet=idTrajete

		)order by '."{$order}"); 
		$tableauIds=array($depart,$destination,$prix+20,$regulier,$date,$depart,$destination,$depart,$prix+20,$regulier,$date,$depart,$destination,$depart,$destination,$depart,$destination,$prix+20,$regulier,$date,$depart,$destination,$depart,$destination,$depart,$prix+20,$regulier,$date,$depart,$destination);
		$selecPreparee->execute($tableauIds);
		return $selecPreparee;
	}

	public function donneTrajetJSON($depart,$destination='',$date,$prix=100000,$type='',$regulier,$order='prix')
	{
		echo json_encode(self::donneTrajet($depart,$destination,$date,$prix,$type,$regulier,$order)->fetchAll());
	}

	public function donneTrajetDirect($depart='',$destination='',$date,$prix=0,$type='',$regulier)//fonctionne pas si on prend une etape donc il faut rajouter dans la bd un champ qui est prixDepuisDepart en plus du prixsousTrajet 
	{
		if (empty($date)) {
			$date=date('Y-m-d');
		}
		$codePostal1=preg_grep("#[0-9]+#", explode(",", $depart));
		$depart=preg_replace("#[0-9]|[ ]|[,]#", "", $depart);

		$codePostal2=preg_grep("#[0-9]+#", explode(",", $destination));
		$destination=preg_replace("#[0-9]|[ ]|[,]#", "", $destination);

		$selecPreparee=self::$bdd->prepare('SELECT trajet.idTrajet as idTrajet,urlPhoto,prenom,a.nomVille as depart,b.nomVille as destination,prix FROM trajet inner join soustrajet on trajet.idTrajet=soustrajet.idTrajet inner join utilisateur on utilisateur.idUtilisateur=trajet.idConducteur inner join ville as a on a.idVille=soustrajet.idVilleDepart inner join ville as b on b.idVille=soustrajet.idVilleArrivee WHERE a.nomVille LIKE ?"%" and b.nomVille LIKE ?"%" and prix<=? and regulier=? and dateDepart=?');
		$tableauIds=array($depart,$destination,$prix+20,1,$date);
		$selecPreparee->execute($tableauIds);
		print_r($selecPreparee);
		return $selecPreparee;
	}
	public function donneTrajetAPartirEtape($depart='',$destination='',$date='',$prix,$type='',$regulier)
	{

		$codePostal1=preg_grep("#[0-9]+#", explode(",", $depart));
		$depart=preg_replace("#[0-9]|[,]#", "", $depart);

		$codePostal2=preg_grep("#[0-9]+#", explode(",", $destination));
		$destination=preg_replace("#[0-9]|[,]#", "", $destination);

		$selecPreparee=self::$bdd->prepare('SELECT trajet.idTrajet as idTrajet,urlPhoto,prenom,a.nomVille as depart,b.nomVille as destination,d.prix-e.prix as prix FROM trajet inner join soustrajet as c on trajet.idTrajet=c.idTrajet
		 inner join soustrajet as d on trajet.idTrajet=d.idTrajet
		  inner join soustrajet as e on trajet.idTrajet=e.idTrajet 
		  inner join utilisateur on utilisateur.idUtilisateur=trajet.idConducteur 
		  inner join ville as a on a.idVille=c.idVilleDepart 
		  inner join ville as b on b.idVille=d.idVilleArrivee 
		  inner join ville as f on f.idVille=e.idVilleArrivee 
		  WHERE a.nomVille LIKE ? and b.nomVille LIKE ?  and f.nomVille LIKE ? and d.prixCumule-e.prixCumule<=? and c.regulier=? and c.dateDepart=?');
		$tableauIds=array($depart,$destination,$depart);
		$selecPreparee->execute($tableauIds);
		return $selecPreparee;
	}
	public function donneTrajetAPartirDepart($depart='',$destination='',$date='',$prix,$type='',$regulier)
	{

		$codePostal1=preg_grep("#[0-9]+#", explode(",", $depart));
		$depart=preg_replace("#[0-9]|[,]#", "", $depart);

		$codePostal2=preg_grep("#[0-9]+#", explode(",", $destination));
		$destination=preg_replace("#[0-9]|[,]#", "", $destination);

		$selecPreparee=self::$bdd->prepare('SELECT trajet.idTrajet as idTrajet,urlPhoto,prenom,a.nomVille as depart ,b.nomVille as destination,d.prix as prix FROM trajet inner join soustrajet as c on trajet.idTrajet=c.idTrajet inner join soustrajet as d on trajet.idTrajet=d.idTrajet inner join soustrajet as e on trajet.idTrajet=e.idTrajet inner join utilisateur on utilisateur.idUtilisateur=trajet.idConducteur inner join ville as a on a.idVille=c.idVilleDepart inner join ville as b on b.idVille=d.idVilleArrivee WHERE a.nomVille LIKE ? and b.nomVille LIKE ? and d.prixCumule<=? and c.regulier=? and c.date=?');
		$tableauIds=array($depart,$destination,$destination);
		$selecPreparee->execute($tableauIds);
		return $selecPreparee;
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