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
		if (!isset($date) || empty($date)) {//||$date<date('Y-m-d');
			$date=date('Y-m-d');
		}
		if (empty($prix) ) {
			$prix=100000;
		}

		$depart= explode(",", $depart)[0];
		$destination= explode(",", $destination)[0];
		$selecPreparee=self::$bdd->prepare('SELECT idTrajet, urlPhoto, prenom, depart, destination, prix, heureDepart, heureArrivee,placeTotale from ( 
			SELECT trajet.idTrajet as idTrajet,utilisateur.urlPhoto,prenom,a.nomVille as depart, b.nomVille as destination,prix,heureDepart,heureArrivee,trajet.placeTotale-count(utilisateur_idutilisateur) as placeTotale, trajet.placeTotale as t FROM trajet inner join soustrajet on trajet.idTrajet=soustrajet.idTrajet 
			inner join utilisateur on utilisateur.idUtilisateur=trajet.idConducteur 
			inner join ville as a on a.idVille=soustrajet.idVilleDepart 
			inner join ville as b on b.idVille=soustrajet.idVilleArrivee 
			inner join vehicule on soustrajet.idVehiculeConducteur=vehicule.immatriculation
			left join soustrajetutilisateur as stu on stu.sousTrajet_idsousTrajet=soustrajet.idsousTrajet
			WHERE a.nomVille LIKE ?"%" and b.nomVille LIKE ?"%" and prix<=? and regulier=? and dateDepart=? and suppression=0 and vehicule.critair>=? and vehicule.critair<=? GROUP BY trajet.idTrajet
HAVING trajet.placeTotale-count(utilisateur_idutilisateur)>0)co
			UNION (

	SELECT idTrajet, urlPhoto, prenom, depart, destination, prix, heureDepart, heureArrivee,placeTotale from(
			SELECT trajet.idTrajet as idTrajet,utilisateur.urlPhoto,prenom,a.nomVille as depart,b.nomVille as destination, d.prixCumule-e.prixCumule as prix,c.heureDepart as heureDepart, d.heureArrivee as heureArrivee, c.idsoustrajet as idsoustraj FROM trajet 
			inner join soustrajet as c on trajet.idTrajet=c.idTrajet 
			inner join soustrajet as d on trajet.idTrajet=d.idTrajet 
			inner join soustrajet as e on trajet.idTrajet=e.idTrajet 
			inner join utilisateur on utilisateur.idUtilisateur=trajet.idConducteur 
			inner join ville as a on a.idVille=c.idVilleDepart 
			inner join ville as b on b.idVille=d.idVilleArrivee 
			inner join ville as f on f.idVille=e.idVilleArrivee 
			inner join vehicule on c.idVehiculeConducteur=vehicule.immatriculation
			WHERE a.nomVille LIKE ?"%" and b.nomVille LIKE ?"%" and f.nomVille LIKE ?"%" and d.prixCumule-e.prixCumule<= ? and c.regulier=? and c.dateDepart=? and suppression=0 and placeTotale>0 and vehicule.critair>=? and vehicule.critair<=? and c.idTrajet in (SELECT idTrajete from( 
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
				inner join vehicule on s.idVehiculeConducteur=vehicule.immatriculation
				WHERE a.nomVille LIKE ?"%" and b.nomVille LIKE ?"%" and s1.heureDepart<=s.heureDepart and s8.heureDepart>=s.heureDepart and s1.idTrajet=s.idTrajet and vehicule.critair>=? and vehicule.critair<=? and s8.idTrajet=s.idTrajet GROUP BY stu3.sousTrajet_idsousTrajet )b group by idTrajete)h on idTrajet=idTrajete
				) 


			UNION (

	SELECT idTrajet, urlPhoto, prenom, depart, destination, prix, heureDepart, heureArrivee,placeTotale from(
			SELECT trajet.idTrajet as idTrajet,c.idsoustrajet as idsoustraj, utilisateur.urlPhoto,prenom,a.nomVille as depart ,b.nomVille as destination,d.prixCumule as prix ,c.heureDepart as heureDepart, d.heureArrivee as heureArrivee FROM trajet inner join soustrajet as c on trajet.idTrajet=c.idTrajet 
			inner join soustrajet as d on trajet.idTrajet=d.idTrajet 
			inner join utilisateur on utilisateur.idUtilisateur=trajet.idConducteur 
			inner join ville as a on a.idVille=c.idVilleDepart 
			inner join ville as b on b.idVille=d.idVilleArrivee 
			inner join vehicule on c.idVehiculeConducteur=vehicule.immatriculation
			WHERE a.nomVille LIKE ?"%" and b.nomVille LIKE ?"%" and d.prixCumule<=? and c.regulier=? and c.dateDepart=? and suppression=0 and vehicule.critair>=? and vehicule.critair<=? and c.idTrajet in ( 


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
				inner join vehicule on s.idVehiculeConducteur=vehicule.immatriculation
				WHERE a.nomVille LIKE ?"%" and b.nomVille LIKE ?"%" and s1.heureDepart<=s.heureDepart and s8.heureDepart>=s.heureDepart and s1.idTrajet=s.idTrajet and vehicule.critair>=? and vehicule.critair<=? and s8.idTrajet=s.idTrajet GROUP BY stu3.sousTrajet_idsousTrajet )b group by idTrajete)g on idTrajet=idTrajete

		)order by '."{$order}"); 
		
		if ($type=="Non Renseigné") {
			$type1=-5;
			$type2=1000;
		}
		else{
			$type1=$type;
			$type2=$type;

		}

		$tableauIds=array($depart,$destination,$prix+20,$regulier,$date,$type1,$type2,$depart,$destination,$depart,$prix+20,$regulier,$date,$type1,$type2,$depart,$destination,$depart,$destination,$type1,$type2,$depart,$destination,$prix+20,$regulier,$date,$type1,$type2,$depart,$destination,$depart,$destination,$depart,$prix+20,$regulier,$date,$depart,$destination,$type1,$type2);
		$selecPreparee->execute($tableauIds);
		return $selecPreparee;
	}

	public function donneTrajetJSON($depart,$destination='',$date,$prix=100000,$type='',$regulier,$order='prix')
	{
		echo json_encode(self::donneTrajet($depart,$destination,$date,$prix,$type,$regulier,$order)->fetchAll());
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
	public function verifieSiExisteJ($depart='',$destination='',$prix=100000,$type='',$regulier){
		echo self::verifieSiExiste($depart,$destination,$prix,$type,$regulier);
	}

	public function verifieSiExiste($depart='',$destination='',$prix=100000,$type='',$regulier){
		if (empty($prix) ) {
			$prix=100000;
		}
		$selecPrepareeUnique=self::$bdd->prepare('SELECT idfavoris FROM favoris where idUtilisateur=? and villeDepart=? and villeArrivee=? and prix=? and type=? and regulier=?');
		$selecPrepareeUnique->execute(array($_SESSION['id'],$depart,$destination,$prix,$type,$regulier));
		$idUtilisateur=$selecPrepareeUnique->fetch();
		return empty($idUtilisateur);
	}
	public function mesFavoris($depart='',$destination='',$prix=100000,$type='',$regulier)
	{	
		if (empty($prix) ) {
			$prix=100000;
		}
		if(self::verifieSiExiste($depart,$destination,$prix,$type,$regulier)){
			$insertPreparee=self::$bdd->prepare('INSERT INTO favoris(idfavoris,idUtilisateur,villeDepart,villeArrivee,prix,type,regulier) values(DEFAULT,:idUtilisateur,:villeDepart,:villeArrivee,:prix,:type,:regulier)');
			$insertPreparee -> execute(array('idUtilisateur'=>$_SESSION['id'],'villeDepart'=>$depart,'villeArrivee'=>$destination,'prix'=>$prix,'type'=>$type,'regulier'=>$regulier));
		}
		else{
			$insertPreparee=self::$bdd->prepare('DELETE FROM favoris  where idUtilisateur=? and villeDepart=? and villeArrivee=? and prix=? and type=? and regulier=?');
			$insertPreparee->execute(array($_SESSION['id'],$depart,$destination,$prix,$type,$regulier));
		}
		

	}
	public function recupInfoFavoris($idfavoris='')
	{
		$selecPrepareeUnique=self::$bdd->prepare('SELECT * FROM favoris where idUtilisateur=? and idfavoris=?');
		$selecPrepareeUnique->execute(array($_SESSION['id'],$idfavoris));
		return $selecPrepareeUnique->fetch();
	}
}