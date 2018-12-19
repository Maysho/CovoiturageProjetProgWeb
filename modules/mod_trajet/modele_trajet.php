<?php

/**
* 
*/
include_once __DIR__ . '/../../connexion.php';
class modele_trajet extends connexion {
	
	private $msg;
	function __construct()
	{
		$trajet=new connexion();
		$trajet->init();
		$this->msg="";
	}
	public function getListeVehicule(){

		$idUser = isset($_SESSION['id']) ? $_SESSION['id'] : -1;

		$reqGetListeCar = self::$bdd->prepare("
			SELECT *  from vehicule inner join vehiculeutilisateur on vehicule.immatriculation =vehiculeutilisateur.immatriculation where idUtilisateur = ?
		");
		$reqGetListeCar->execute(array($idUser));
		$liste= $reqGetListeCar->fetchAll();
		return $liste;
	}


	public function ajoutVehicule($immatriculation, $critair, $hybride){
		
		// if( $this->verifVehicule($immatriculation, $critair, $hybride) ){
		// 	echo $this->msg;
		// 	exit(1);
		// }

		$reg = $hybride == "true" ?  1 :  0; 

		$idConducteur = isset($_SESSION['id']) ? $_SESSION['id'] : -1;

		$url =null;

		if(!empty( $_FILES ) ){
			if($_FILES['photo']['size']>0){
				$extension_upload = strtolower(  substr( strrchr($_FILES['photo']['name'], '.')  ,1)  );
				$nomFich=$idConducteur.'Vehicule'.'.'.$extension_upload;
				// echo "FILE DEST = " . $_SERVER['DOCUMENT_ROOT']. "/CovoiturageProjetProgWeb/sources/images/photoVehicule/";
				$result=move_uploaded_file($_FILES['photo']['tmp_name'],$_SERVER['DOCUMENT_ROOT']. "/CovoiturageProjetProgWeb/sources/images/photoVehicule/".$nomFich);
				if($result)
					$url = "sources/images/photoVehicule/".$nomFich;
			}
		}

		$reqAddCar=self::$bdd->prepare("
			INSERT INTO vehicule (
				immatriculation,
				critair,
				hybride,
				urlPhoto
			) VALUES (
				:immatriculation,
				:critair,
				:hybride,
				:urlPhoto
			)
		");

		$reqAddCar->execute(array(
			":immatriculation" => $immatriculation,
			":critair" => $critair,
			":hybride" => $reg,
			":urlPhoto" => $url
		));


		$reqAddCarUser=self::$bdd->prepare("
			INSERT INTO vehiculeutilisateur (
				idUtilisateur,
				immatriculation
			) VALUES (
				:idUtilisateur,
				:immatriculation
			)
		");

		$reqAddCarUser->execute(array(
			":idUtilisateur" => $idConducteur,
			":immatriculation" => $immatriculation
		));


	}


	public function creationTrajet($soustrajets, $descriptionTrajet, $placeTotale){
		
		$placeTotale++;

		if( $this->verifChamps($soustrajets, $placeTotale) ){
			echo $this->msg;
			exit(1);
		}

		$idConducteur = isset($_SESSION['id']) ? $_SESSION['id'] : -1;
			
		$reqGetIdTrajet = self::$bdd->query('SELECT idTrajet FROM trajet ORDER BY idTrajet desc limit 1');
		$reponse=($reqGetIdTrajet->fetch());
		$idTrajet=$reponse['idTrajet'];

		if( $idTrajet == null){
			$idTrajet = 1;
		}
		else {
			$idTrajet++;
		}

		$reqTrajet =self::$bdd->prepare("
		INSERT INTO trajet(
			idTrajet, 
			descriptionTrajet, 
			idConducteur, 
			placeTotale, 
			suppression
			) VALUES (
			:idTrajet,
			:descriptionTrajet,
			:idConducteur,
			:placeTotale,
			false
			) 
		");
		
		$reqTrajet->execute(array(
			'idTrajet' => $idTrajet,
			':descriptionTrajet' => $descriptionTrajet,
			':idConducteur' => $idConducteur,
			':placeTotale' => $placeTotale
		));

		$somme =0;

		foreach ($soustrajets as $key => $value) {

			list($nomVille, $codePostal)= explode(",", $value['idVilleD']);
			list($nomVille2, $codePostal2)= explode(",", $value['idVilleA']);

			$sql = self::$bdd->prepare('SELECT idVille FROM ville where nomVille like ? or codePostal like ?');
			$array = array($nomVille, $codePostal);
			$sql->execute($array);
			$reponsesql = ($sql->fetch());
			$idVille1 = $reponsesql['idVille'];

			$sql2 = self::$bdd->prepare('SELECT idVille FROM ville where nomVille like ? or codePostal like ?');
			$array2 = array($nomVille2, $codePostal2);
			$sql2->execute($array2);
			$reponsesql2 = ($sql2->fetch());
			$idVille2 = $reponsesql2['idVille'];

			$value['idVilleD'] = $idVille1;
			$value['idVilleA'] = $idVille2;

			if( $value['regulier'] == "true"){
				$reg = 1;
			}
			else {
				$reg = 0;
			}

			$somme+=$value['prix'];

 			$reqSousTrajet =self::$bdd->prepare('
 				INSERT INTO soustrajet (
	 				idsousTrajet,
					idTrajet,
					dateDepart,
					heureDepart,
					idVilleDepart,
					idVilleArrivee,
					heureArrivee,
					idVehiculeConducteur,
					prix,
					prixCumule,
					regulier
 				) VALUES (
 					DEFAULT,
					:idTrajet,
					:dateDepart,
					:heureDepart,
					:idVilleDepart,
					:idVilleArrivee,
					:heureArrivee,
					:idVehiculeConducteur,
					:prix,
					:prixCumule,
					:regulier
 				)
 			');
 			
		 	$reqSousTrajet->execute(array(
		 		':idTrajet' => $idTrajet, 
		 		':dateDepart'=>$value['dateDepart'],
		 		':heureDepart'=>$value['heureDepart'],
		 		':idVilleDepart'=>$value['idVilleD'],
		 		':idVilleArrivee'=>$value['idVilleA'],
		 		':heureArrivee'=>$value['heureArrivee'],
		 		':idVehiculeConducteur'=>1,
		 		// ':idVehiculeConducteur'=>$value['idVehiculeConducteur'],
		 		':prix'=>$value['prix'],
		 		':prixCumule'=>$somme,
		 		':regulier'=> $reg
		 	));
	 	}	


	 	$reqGetIdSousTrajet= self::$bdd->prepare('SELECT idsousTrajet from soustrajet where idTrajet = ? ');
	 	$reqGetIdSousTrajet->execute(array($idTrajet));
	 	$reponseReqGetIdSousTrajet = ($reqGetIdSousTrajet->fetchAll());
	 	
	 	foreach ($reponseReqGetIdSousTrajet as $key => $value) {
	 		$reqInsert=self::$bdd->prepare('
	 			INSERT INTO soustrajetutilisateur (
	 				utilisateur_idutilisateur,
	 				sousTrajet_idsousTrajet,
	 				valide,
	 				prixPayer
	 			) VALUES (
	 				:utilisateur_idutilisateur,
	 				:sousTrajet_idsousTrajet,
	 				:valide,
	 				:prixPayer
	 			)
	 		');

	 		$reqInsert->execute(array(
	 			':utilisateur_idutilisateur' => $idConducteur,
 				':sousTrajet_idsousTrajet' => $value['idsousTrajet'],
 				':valide' => true,
 				':prixPayer' =>0.0
	 		));

	 	}



	}

	public function verifChamps($soustrajets, $placeTotale){
		$error = false;

		if(!isset($_SESSION['id'])){
			$this->msg=$this->msg."30- Utilisateur non connecté"."\n";
			$error = true;
		}
		if( $placeTotale < 2 && $placeTotale < 9){
			$this->msg=$this->msg."31- Erreur de saisie PlaceTotale"."\n";
			$error = true;	
		}
		
		$i = 0;
		$date = $soustrajets[0]['dateDepart'];
		$heure = $soustrajets[0]['heureDepart'];
		while( $i < count($soustrajets) ){
			//prix neg
			if($soustrajets[$i]['prix'] < 0){
				$this->msg=$this->msg."32- Erreur sur le prix" ."\n";
				$error = true;	
			}

			// verif date et horaire
			if($date < $soustrajets[$i]['dateDepart']){
				$date = $soustrajets[$i]['dateDepart'];
			}else if($date > $soustrajets[$i]['dateDepart']){
				$this->msg=$this->msg."331- Erreur de conformité Date" ."\n";
				$error = true;	
			}else{
				//heure dans l'ordre
				// difference minimale de 0  ? 
				if( $heure < $soustrajets[$i]['heureDepart'] ){
					$heure = $soustrajets[$i]['heureDepart'];
				} else if( $heure >= $soustrajets[$i]['heureDepart'] && $soustrajets[$i] != $soustrajets[0]){
					$this->msg=$this->msg."332- Erreur de conformité Heure " ."\n";
					$error = true;	
				}
			}
			if($soustrajets[$i]['heureDepart'] == $soustrajets[$i]['heureArrivee']){
				$this->msg=$this->msg."332- Erreur de conformité Heure " ."\n";
				$error = true;	
			}
			//verifie format heure
			if(!preg_match('#^([0-9]|0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$#', $soustrajets[$i]['heureDepart'] )){
				$this->msg=$this->msg."341- Erreur de Format Heure" ."\n";
					$error = true;	
			}

			//verifie format date
			if(!preg_match('#^\d{4}\-(0[1-9]|1[012])\-(0[1-9]|[12][0-9]|3[01])$#', $soustrajets[$i]['dateDepart'])){
				$this->msg=$this->msg."342- Erreur de Format Date" ."\n";
				$error = true;	
			}

			//ville existante
			$i++;
		}

		foreach ($soustrajets as $key => $value) {
			if($value['idVilleD'] != null && $value['idVilleA'] != null){
				if(!preg_match('#[,]#',  $value['idVilleD']) && !preg_match('#[,]#',  $value['idVilleA'])){
					$this->msg=$this->msg."353- Erreur Ville" ."\n";
					$error = true;	
				}else{
					list($nomVille, $codePostal)= explode(",", $value['idVilleD']);
					list($nomVille2, $codePostal2)= explode(",", $value['idVilleA']);


					$sql = self::$bdd->prepare('SELECT idVille FROM ville where nomVille like ? or codePostal like ?');
					$array = array($nomVille, $codePostal);
					$sql->execute($array);
					$reponsesql = ($sql->fetch());
					$idVille1 = $reponsesql[0];

					$sql2 = self::$bdd->prepare('SELECT idVille FROM ville where nomVille like ? or codePostal like ?');
					$array2 = array($nomVille2, $codePostal2);
					$sql2->execute($array2);
					$reponsesql2 = ($sql2->fetch());
					$idVille2 = $reponsesql2[0];

					if( empty($idVille1) || empty($idVille2)){
						$this->msg=$this->msg."352- Erreur de Ville inexistante" ."\n";
						$error = true;	
					}
				}
			}
			else{
				$this->msg=$this->msg."351- Erreur Champs Ville non défini" ."\n";
				$error = true;	
			}
		}

		return $error;
			
	}
}


?>
