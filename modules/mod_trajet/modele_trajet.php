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
	public function delVehicule($immatriculation){
		$reqDelCarUser=self::$bdd->prepare("DELETE FROM vehiculeutilisateur where immatriculation = ? AND idUtilisateur = ?");
		$reqDelCarUser->execute(array($immatriculation, $_SESSION['id']));

		$reqDelCar=self::$bdd->prepare("DELETE FROM vehicule where immatriculation = ?");
		$reqDelCar->execute(array($immatriculation));
	}

	public function ajoutVehicule($immatriculation, $critair, $hybride){
		$immatriculation= strtoupper($immatriculation);
		$immatriculation = str_replace("-", " ", $immatriculation);
		$immatriculation = str_replace(" ", "", $immatriculation);
		if( $this->verifVehicule($immatriculation, $critair, $hybride) ){
			http_response_code(400);
			echo $this->msg;
			exit(1);
		}
		$reg = $hybride == "true" ?  1 :  0; 
		$idConducteur = isset($_SESSION['id']) ? $_SESSION['id'] : -1;
		$url = null;

		if(!empty( $_FILES ) ){
			if($_FILES['photo']['size']>0){
				$extension_upload = strtolower(  substr( strrchr($_FILES['photo']['name'], '.')  ,1)  );
				$nomFich=$idConducteur.'_'.$immatriculation.'.'.$extension_upload;
				// echo "FILE DEST = " . $_SERVER['DOCUMENT_ROOT']. "/CovoiturageProjetProgWeb/sources/images/photoVehicule/";
				$result=move_uploaded_file($_FILES['photo']['tmp_name'],__DIR__. "/../../sources/images/photoVehicule/".$nomFich);
				if($result)
					$url = "sources/images/photoVehicule/".$nomFich;
			}
		}else{
			$url = "photos/Black.png";
		}
		$reqAddCar=self::$bdd->prepare('
			INSERT INTO vehicule(
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
		');

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
			"idUtilisateur" => $idConducteur,
			"immatriculation" => $immatriculation
		));
		return $url;
	}


	public function creationTrajet($soustrajets, $descriptionTrajet, $placeTotale, $dateArrivee){
		
		$placeTotale++;

		if( $this->verifChampsTrajet($soustrajets, $placeTotale, $dateArrivee) || !isset($_SESSION['id']) ){
			echo $this->msg;
			http_response_code(400);
			exit(1);
		}
		$idConducteur = $_SESSION['id'];
		
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

			$immatriculation= strtoupper($value['idVehiculeConducteur']);
			$immatriculation = str_replace("-", " ", $immatriculation);
			$immatriculation = str_replace(" ", "-", $immatriculation);

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
					regulier,
					dateArrivee
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
					:regulier,
					:dateArrivee
 				)
 			');
 			
		 	$reqSousTrajet->execute(array(
		 		':idTrajet' => $idTrajet, 
		 		':dateDepart'=>$value['dateDepart'],
		 		':heureDepart'=>$value['heureDepart'],
		 		':idVilleDepart'=>$value['idVilleD'],
		 		':idVilleArrivee'=>$value['idVilleA'],
		 		':heureArrivee'=>$value['heureArrivee'],
		 		':idVehiculeConducteur'=>$immatriculation,
		 		':prix'=>$value['prix'],
		 		':prixCumule'=>$somme,
		 		':regulier'=> $reg,
		 		':dateArrivee' => ($key == count($soustrajets)-1 ) ? $dateArrivee : $soustrajets[$key+1]['dateDepart']
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
 				':valide' => 0,
 				':prixPayer' =>0.0
	 		));
	 	}
	}

	public function verifVehicule($immatriculation, $critair, $hybride){
		$error = false;

		if(!isset($critair) || $critair < 0 || $critair > 6){
			$this->msg=$this->msg."361" ."\n";
			$error = true;
		}
		
		if(!isset($hybride)){
			$this->msg=$this->msg."362" ."\n";
			$error = true;
		}

		if($this->verifImmatriculation($immatriculation)){
			$this->msg=$this->msg."36-" ."\n";
			$error = true;
		}
		return $error;
	}

	public function verifImmatriculation($immatriculation){
		$error = false;
		if(empty($immatriculation)){
			$error = true;
		}

		if (  !preg_match("~(\d{3,4}\s*[a-z]{2}\s*(\d{2}|\d[a-z])|[a-z]{2}\s*\d{4}\s*[a-z]{2}|[a-z]{2}\s*\d{3}\s*[a-z])~iu", $immatriculation)) {
			$error = true;	
		}
		return $error;
	}

	public function verifChampsTrajet($soustrajets, $placeTotale, $dateArrivee){
		$error = false;

		if(!isset($_SESSION['id'])){
			$this->msg=$this->msg."30- Utilisateur non connecté"."\n";
			$error = true;
		}
		if( $placeTotale < 2 || $placeTotale > 9){
			$this->msg=$this->msg."31- Erreur de saisie PlaceTotale"."\n";
			$error = true;	
		}
		
		$i = 0;
		while( $i < count($soustrajets) ){
			//prix neg
			if($soustrajets[$i]['prix'] < 0){
				$this->msg=$this->msg."32- Erreur sur le prix" ."\n";
				$error = true;	
			}

			if($i == count($soustrajets)-1){
				if(strtotime($soustrajets[$i]['dateDepart']) > strtotime($dateArrivee)){
					$this->msg=$this->msg."33a- Erreur de conformité Date depart > arrivee  " ."\n";
					$error = true;	
				}
				elseif(strtotime($soustrajets[$i]['dateDepart']) == strtotime($dateArrivee)){
					if(strtotime($soustrajets[$i]['heureDepart']) >= strtotime($soustrajets[$i]['heureArrivee'])){
						$this->msg=$this->msg."33b- Erreur de conformité Heure depart = arrivee, hdepart>=harivee " ."\n";
						$error = true;	
					}
				}
			}else{
				if(strtotime($soustrajets[$i]['dateDepart']) > strtotime($soustrajets[$i+1]['dateDepart'])){
					$this->msg=$this->msg."33a- Erreur de conformité Date depart > arrivee " ."\n";
					$error = true;	
				}
				elseif(strtotime($soustrajets[$i]['dateDepart']) == strtotime($soustrajets[$i+1]['dateDepart'])){
					if(strtotime($soustrajets[$i]['heureDepart']) >= strtotime($soustrajets[$i]['heureArrivee'])){
						$this->msg=$this->msg."33b- Erreur de conformité Heure depart = arrivee, hdepart>=harivee " ."\n";
						$error = true;	
					}
				}
			}

			if(strtotime($soustrajets[$i]['dateDepart']) <= strtotime("yesterday") ){
				$this->msg=$this->msg."33a- Erreur de conformité Date depart < now " ."\n";
				$error = true;	
			}

			if(strtotime($dateArrivee) <= strtotime("yesterday") ){
				$this->msg=$this->msg."33a- Erreur de conformité Date arrivee < now " ."\n";
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
			$i++;
		}

		foreach ($soustrajets as $key => $value) {
			if( !is_null($value['idVilleD']) && !is_null($value['idVilleA']) ){
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
			$immatriculation= strtoupper($value['idVehiculeConducteur']);
			$immatriculation = str_replace("-", " ", $immatriculation);
			if($this->verifImmatriculation($immatriculation)){
				$this->msg=$this->msg."363- Erreur immatriculation" ."\n";
				$error = true;	
			}
		}

		return $error;
			
	}
	public function recupSDepartSArrivee($id)
	{
		$selecPreparee=self::$bdd->prepare('SELECT MIN(s1.idsousTrajet),MAX(s1.idsousTrajet) FROM soustrajet as s1  WHERE s1.idTrajet=? GROUP by s1.idTrajet');
		$tableauIds=array($id);
		$selecPreparee->execute($tableauIds);
		return $selecPreparee->fetch();
	}
	public function recupInfoTrajet($id,$tabs1s2)
	{
		$selecPreparee=self::$bdd->prepare('SELECT ville1.nomVille,ville2.nomVille,sDebut.dateDepart,sFin.dateArrivee,vehicule.immatriculation,vehicule.critair,vehicule.hybride,vehicule.urlPhoto,utilisateur.urlPhoto, nom, prenom,descriptionTrajet,sFin.prixCumule,trajet.idTrajet,idConducteur,trajet.placeTotale FROM trajet inner join soustrajet as sDebut on trajet.idTrajet=sDebut.idTrajet inner join soustrajet as sFin on trajet.idTrajet=sFin.idTrajet inner join utilisateur on idConducteur=utilisateur.idUtilisateur inner join ville as ville1 on ville1.idVille=sDebut.idVilleDepart inner join ville as ville2 on ville2.idVille=sFin.idVilleArrivee inner join vehiculeutilisateur as vu on idConducteur=vu.idUtilisateur inner join vehicule on vu.immatriculation=vehicule.immatriculation WHERE trajet.idTrajet=? and sDebut.idsousTrajet=? and sFin.idsousTrajet=?');
		$tableauIds=array($id,$tabs1s2[0],$tabs1s2[1]);
		$selecPreparee->execute($tableauIds);
		return $selecPreparee->fetch();
	}
	public function recupUser($id)
	{
		$selecPreparee=self::$bdd->prepare('SELECT * FROM `soustrajetutilisateur` INNER join soustrajet on soustrajetutilisateur.sousTrajet_idsousTrajet=soustrajet.idsousTrajet where soustrajet.idTrajet=? ORDER BY `sousTrajet_idsousTrajet`, utilisateur_idutilisateur');
		$tableauIds=array($id);
		$selecPreparee->execute($tableauIds);
		return $selecPreparee->fetchAll();
	}
	public function recupInfoSousTrajet($id)
	{
		$selecPreparee=self::$bdd->prepare('SELECT * FROM soustrajet inner join ville as v1 on v1.idVille=idVilleDepart inner join ville as v2 on v2.idVille=idVilleArrivee where soustrajet.idTrajet=? order by soustrajet.idsousTrajet');
		$tableauIds=array($id);
		$selecPreparee->execute($tableauIds);

		return( $selecPreparee->fetchAll());
	}
	public function commentaires($idTrajet){

		$selectPreparee=self::$bdd->prepare('SELECT prenom ,urlPhoto, idAuteur, date, note, commenter.description FROM trajet INNER JOIN commenter on trajet.idTrajet = commenter.idTrajet inner join utilisateur on utilisateur.idUtilisateur=idAuteur WHERE trajet.idTrajet=? order by date DESC');
		$tableauIds=array($idTrajet);
		$selectPreparee->execute($tableauIds);
		return $selectPreparee->fetchAll();
	}
	public function ajouteCommentaire($note,$commentaire,$idTrajet)
	{
		if (!isset($_SESSION['id'])) {
			header('Location: index.php?module=mod_connexion');
		}
		if(!is_numeric($note) || $note>20 || $note<0 || empty($commentaire)){
			http_response_code(400);
			echo "le message ou la note est incorrect";
			exit(1);
		}
		//TODO faire une verif si on est inscrit au trajet mdr

		$selecPrepareeUnique=self::$bdd->prepare('SELECT * FROM commenter where idAuteur=? and idTrajet=? ');
		$tableauIds=array($_SESSION['id'],$idTrajet);
		$selecPrepareeUnique->execute($tableauIds);
		$unique=$selecPrepareeUnique->fetch();
		if (empty($unique['idAuteur'])==0) {
			http_response_code(401);
			echo "vous avez déjà rentré un commentaire";
			exit(1);
		}

		$selecPrepareeUnique=self::$bdd->prepare('SELECT idConducteur,urlPhoto FROM trajet inner join utilisateur on idConducteur=idUtilisateur where idTrajet=? ');
		$tableauIds=array($idTrajet);
		$selecPrepareeUnique->execute($tableauIds);
		$utilisateur=$selecPrepareeUnique->fetch();
		if (empty($utilisateur['idConducteur'])) {
			http_response_code(402);
			echo "une erreur est survenu";
			exit(1);
		}

		$insertPreparee=self::$bdd->prepare('INSERT INTO commenter(idAuteur,idTrajet,description,date,note,idUtilisateur) values(:id1,:id2,:descript,:date,:note,:idUtilisateur)');
		$insertPreparee -> execute(array('id1'=>$_SESSION['id'],'id2'=>$idTrajet,'descript'=>$commentaire,'date'=>date("Y-m-d"),'note'=>$note,'idUtilisateur'=>$utilisateur['idConducteur']));

		echo json_encode($utilisateur); 
	}

	public function VerifError($tabIdVille, $idTrajet)
	{
		if (count($tabIdVille)==0) {
			echo "07-";
			return true;
		}
		if ($idTrajet<0) {
			echo "07-";
			return true;
		}
		$selecPrepareeUnique=self::$bdd->prepare('SELECT idVilleArrivee FROM trajet inner join soustrajet on trajet.idTrajet=soustrajet.idTrajet where trajet.idTrajet=? ');
		$selecPrepareeUnique->execute(array($idTrajet));
		$idVille=$selecPrepareeUnique->fetchAll();
		foreach ($tabIdVille as $key => $value) {
			if ( !in_array($value, array_column($idVille, 'idVilleArrivee'))) {
				echo "07-";
				return true;
			}
		}
		$selecPrepareeUnique=self::$bdd->prepare('SELECT trajet.idTrajet as idTrajet, trajet.placeTotale as t, idVilleArrivee FROM trajet inner join soustrajet on trajet.idTrajet=soustrajet.idTrajet 
			inner join ville as a on a.idVille=soustrajet.idVilleArrivee
			left join soustrajetutilisateur as stu on stu.sousTrajet_idsousTrajet=soustrajet.idsousTrajet
			WHERE trajet.idTrajet=? group by soustrajet.idsousTrajet
HAVING trajet.placeTotale-count(utilisateur_idutilisateur)>0 ');
		$selecPrepareeUnique->execute(array($idTrajet));
		$idVille=$selecPrepareeUnique->fetchAll();
		if (empty($idVille)) {
			echo "08-";
			return true;
		}
		foreach ($tabIdVille as $key => $value) {
			if ( !in_array($value, array_column($idVille, 'idVilleArrivee'))) {
				echo "08-";
				return true;
			}
		}
		if (!isset($_SESSION['id'])) {
			echo "09-";
			return true;
		}
		$selecPrepareeUnique=self::$bdd->prepare('SELECT * FROM soustrajetutilisateur inner join soustrajet on sousTrajet_idsousTrajet=soustrajet.idsousTrajet 
			WHERE soustrajet.idTrajet=? and utilisateur_idutilisateur=?');
		$selecPrepareeUnique->execute(array($idTrajet,$_SESSION['id']));
		$idUtilisateur=$selecPrepareeUnique->fetchAll();
		if (!empty($idUtilisateur)) {
			echo "10-";
			return true;
		}
		$prixApayer=0;
		foreach ($tabIdVille as $key => $value) {
			$selecPrepareeUnique=self::$bdd->prepare('SELECT prix FROM soustrajet WHERE soustrajet.idTrajet=? and idVilleArrivee=?');
			$selecPrepareeUnique->execute(array($idTrajet,$value));
			$prixApayer=$selecPrepareeUnique->fetch()[0]+$prixApayer;
		}
		$selecPrepareeUnique=self::$bdd->prepare('SELECT credit FROM utilisateur where idUtilisateur=?');
		$selecPrepareeUnique->execute(array($_SESSION['id']));
		$argent=$selecPrepareeUnique->fetch()[0];
		if ($prixApayer>$argent) {
			echo "11-";
			return true;
		}
		return false;	
	}
	public function InscriptionTrajet($tabIdVille, $idTrajet,$token)
	{
		if(self::VerifError($tabIdVille, $idTrajet) || !self::verifieToken($_SESSION['id'],$token)){

			http_response_code(400);
			exit(1);
		}
		

		foreach ($tabIdVille as $key => $value) {

			$selecPrepareeUnique=self::$bdd->prepare('SELECT * FROM soustrajet WHERE soustrajet.idTrajet=? and idVilleArrivee=?');
			$selecPrepareeUnique->execute(array($idTrajet,$value));
			$idst=$selecPrepareeUnique->fetch();

			$insertPreparee=self::$bdd->prepare('INSERT INTO soustrajetutilisateur(utilisateur_idutilisateur,sousTrajet_idsousTrajet,valide,prixPayer) values(:idUser,:idsousTrajet,0,:prix)');
			$insertPreparee -> execute(array('idUser'=>$_SESSION['id'],'idsousTrajet'=>$idst['idsousTrajet'],'prix'=>$idst['prix']));
			$updatePrepareee=self::$bdd->prepare('UPDATE utilisateur set credit=credit-? where idUtilisateur=?');
			$updatePrepareee -> execute(array($idst['prix'],$_SESSION['id']));
		}

		echo "success";
	}
	public function estDansTrajet($idTrajet)
	{
		$selecPrepareeUnique=self::$bdd->prepare('SELECT * FROM soustrajetutilisateur inner join soustrajet on sousTrajet_idsousTrajet=soustrajet.idsousTrajet 
			WHERE soustrajet.idTrajet=? and utilisateur_idutilisateur=?');
		$selecPrepareeUnique->execute(array($idTrajet,$_SESSION['id']));
		$idUtilisateur=$selecPrepareeUnique->fetchAll();
		return !empty($idUtilisateur);

		
	}
	public function recupPrixAPayer($idTrajet)
	{
		$selecPreparee=self::$bdd->prepare('SELECT sum(prixPayer),
			(select nomVille from soustrajet as st inner join ville on ville.idVille=st.idVilleDepart where st.idsousTrajet= min( soustrajet.idsousTrajet)) as ville1,
			(select nomVille from soustrajet as st inner join ville on ville.idVille=st.idVilleArrivee where st.idsousTrajet= max( soustrajet.idsousTrajet)) as ville2,
			(select dateDepart from soustrajet as st inner join ville on ville.idVille=st.idVilleDepart where st.idsousTrajet= min( soustrajet.idsousTrajet)) as date1,
			(select dateArrivee from soustrajet as st inner join ville on ville.idVille=st.idVilleArrivee where st.idsousTrajet= max( soustrajet.idsousTrajet)) as date2 
			 FROM `soustrajetutilisateur` INNER join soustrajet on soustrajetutilisateur.sousTrajet_idsousTrajet=soustrajet.idsousTrajet where soustrajet.idTrajet=? and utilisateur_idutilisateur=? ORDER BY `sousTrajet_idsousTrajet` ASC');
		$tableauIds=array($idTrajet, $_SESSION['id']);
		$selecPreparee->execute($tableauIds);
		return $selecPreparee->fetch();
	}
	public function recupPrixAPayerU($idTrajet,$idUser)
	{
		$selecPreparee=self::$bdd->prepare('SELECT sum(prixPayer) FROM `soustrajetutilisateur` INNER join soustrajet on soustrajetutilisateur.sousTrajet_idsousTrajet=soustrajet.idsousTrajet where soustrajet.idTrajet=? and utilisateur_idutilisateur=? ORDER BY `sousTrajet_idsousTrajet` ASC');
		$tableauIds=array($idTrajet, $idUser);
		$selecPreparee->execute($tableauIds);
		return $selecPreparee->fetch()[0];
	}
	public function desinscriptionTrajet($idTrajet)
	{	
		$prix=self::recupPrixAPayer($idTrajet);

		$updatePrepareee=self::$bdd->prepare('UPDATE utilisateur set credit=credit+? where idUtilisateur=?');
		$updatePrepareee -> execute(array($prix[0],$_SESSION['id']));

		$deletePreparee=self::$bdd->prepare('DELETE soustrajetutilisateur FROM soustrajetutilisateur inner join soustrajet on sousTrajet_idsousTrajet=soustrajet.idsousTrajet where utilisateur_idutilisateur=? and idTrajet=? ');
		$deletePreparee -> execute(array($_SESSION['id'],$idTrajet));
		echo "success";
	}
	public function supCom($idTrajet)
	{
		$deletePreparee=self::$bdd->prepare('DELETE FROM commenter where idAuteur=? and idTrajet=?');
		$deletePreparee -> execute(array($_SESSION['id'],$idTrajet));
		echo "success";
	}

	public function aEteValide($idTrajet)
	{
		$selecPrepareeUnique=self::$bdd->prepare('SELECT * FROM soustrajetutilisateur inner join soustrajet on sousTrajet_idsousTrajet=soustrajet.idsousTrajet 
			WHERE soustrajet.idTrajet= ? and soustrajetutilisateur.valide=true');
		$selecPrepareeUnique->execute(array($idTrajet));
		$idUtilisateur=$selecPrepareeUnique->fetchAll();
		return !empty($idUtilisateur);
	}
	public function conducteur($idTrajet)
	{
		$selecPrepareeUnique=self::$bdd->prepare('SELECT idConducteur from trajet where idTrajet=?');
		$selecPrepareeUnique->execute(array($idTrajet));
		$idUtilisateur=$selecPrepareeUnique->fetch();
		return $idUtilisateur[0];
		
	}
	public function valideTrajet($idTrajet,$token)
	{
		if (self::verifieToken($_SESSION['id'],$token)) {
			
		
		$conducteur=self::conducteur($idTrajet);
		if ($_SESSION['id']==$conducteur) {
	   
			$selecPrepareeUnique=self::$bdd->prepare('SELECT utilisateur_idutilisateur from soustrajetutilisateur inner join soustrajet on soustrajetutilisateur.sousTrajet_idsousTrajet=soustrajet.idsousTrajet where soustrajet.idTrajet=?');
			$selecPrepareeUnique->execute(array($idTrajet));
			$idUtilisateur=$selecPrepareeUnique->fetchAll();
			foreach ($idUtilisateur as $key => $value) {
				$prix=self::recupPrixAPayerU($idTrajet,$value[0]);
				$updatePreparee=self::$bdd->prepare('UPDATE utilisateur set  credit=credit+? where idUtilisateur=?');
				$updatePreparee -> execute(array($prix,$value[0]));
			}


			$updatePreparee=self::$bdd->prepare('update soustrajetutilisateur set valide=1, prixPayer=0 where sousTrajet_idsousTrajet in (select idsousTrajet from soustrajet where idTrajet=?)');
			$updatePreparee -> execute(array($idTrajet));

			
		}
		else{
		$updatePreparee=self::$bdd->prepare('update soustrajetutilisateur set valide=1 where utilisateur_idutilisateur=? and sousTrajet_idsousTrajet in (select idsousTrajet from soustrajet where idTrajet=?)');
		$updatePreparee -> execute(array($_SESSION['id'],$idTrajet));
		$prix=self::recupPrixAPayer($idTrajet);
		
		$updatePreparee=self::$bdd->prepare('update utilisateur set credit=credit+? where idUtilisateur=?');
		$updatePreparee -> execute(array($prix[0],$conducteur));
		$updatePreparee=self::$bdd->prepare('update soustrajetutilisateur set prixPayer=0 where utilisateur_idutilisateur=? and sousTrajet_idsousTrajet in (select idsousTrajet from soustrajet where idTrajet=?)');
		$updatePreparee -> execute(array($_SESSION['id'],$idTrajet));
		}
		echo "success";
		}
		else{
			http_response_code(400);
			echo "error";
		}
	}
	public function peutEtreValide($idTrajet)
	{
		$idSt1=self::recupSDepartSArrivee($idTrajet);
		$selecPreparee=self::$bdd->prepare('SELECT heureDepart, dateDepart FROM soustrajet where soustrajet.idsousTrajet=? ');
		$tableauIds=array($idSt1[0]);
		$selecPreparee->execute($tableauIds);
		$res=$selecPreparee->fetch();

		$date1 = new DateTime($res[1]." ".$res[0]);
		if(date('H')<22){
			$date=date('H')+2;
		}
		elseif (date('H')==22) {
			$date=00;
		}
		elseif (date('H')==23) {
			$date=01;
		}
		else {
			$date=2;
		}
		$date2 = new DateTime(date("Y-m-d $date:i:s"));
		return ( ( $date1 <= $date2)) ;

	}
	public function trajetValide($idTrajet)
	{
		$selecPrepareeUnique=self::$bdd->prepare('SELECT * FROM soustrajetutilisateur inner join soustrajet on sousTrajet_idsousTrajet=soustrajet.idsousTrajet 
			WHERE soustrajet.idTrajet= ? and soustrajetutilisateur.valide=true and soustrajetutilisateur.utilisateur_idutilisateur=?');
		$selecPrepareeUnique->execute(array($idTrajet,$_SESSION['id']));
		$idUtilisateur=$selecPrepareeUnique->fetchAll();
		return !empty($idUtilisateur);
	}
	public function nbPersDansTrajet($idTrajet)
	{
		$selecPrepareeUnique=self::$bdd->prepare('SELECT count(DISTINCT utilisateur_idutilisateur) FROM soustrajetutilisateur inner join soustrajet on sousTrajet_idsousTrajet=soustrajet.idsousTrajet 
			WHERE soustrajet.idTrajet= ? ');
		$selecPrepareeUnique->execute(array($idTrajet));
		$idUtilisateur=$selecPrepareeUnique->fetch();
		return $idUtilisateur[0];
	}
	public function idPersDansTrajetExceptConducteur($idTrajet)
	{
		$selecPrepareeUnique=self::$bdd->prepare('SELECT DISTINCT utilisateur_idutilisateur, urlPhoto FROM soustrajetutilisateur inner join soustrajet on sousTrajet_idsousTrajet=soustrajet.idsousTrajet inner join utilisateur on utilisateur_idutilisateur=idUtilisateur inner join trajet on soustrajet.idTrajet=trajet.idTrajet WHERE soustrajet.idTrajet= ? and trajet.idConducteur!=soustrajetutilisateur.utilisateur_idutilisateur');
		$selecPrepareeUnique->execute(array($idTrajet));
		$idUtilisateur=$selecPrepareeUnique->fetchAll();
		return $idUtilisateur;
	}
	public function idConducteurDansTrajet($idTrajet)
	{
		$selecPrepareeUnique=self::$bdd->prepare('SELECT DISTINCT utilisateur_idutilisateur, urlPhoto FROM soustrajetutilisateur inner join soustrajet on sousTrajet_idsousTrajet=soustrajet.idsousTrajet inner join utilisateur on utilisateur_idutilisateur=idUtilisateur inner join trajet on soustrajet.idTrajet=trajet.idTrajet WHERE soustrajet.idTrajet= ? and trajet.idConducteur=soustrajetutilisateur.utilisateur_idutilisateur');
		$selecPrepareeUnique->execute(array($idTrajet));
		$idUtilisateur=$selecPrepareeUnique->fetchAll();
		return $idUtilisateur;
	}
	public function EtapePers($idTrajet)
	{
		if (self::nbPersDansTrajet($idTrajet)>1) {

			$pers=self::idPersDansTrajetExceptConducteur($idTrajet);
		}
		else
			$pers= array();

		array_push($pers, self::idConducteurDansTrajet($idTrajet)[0]);
		$tab=array();
		foreach ($pers as $key => $value) {
			$selecPrepareeUnique=self::$bdd->prepare('SELECT sousTrajet_idsousTrajet FROM soustrajetutilisateur inner join soustrajet on sousTrajet_idsousTrajet=soustrajet.idsousTrajet 
			WHERE soustrajet.idTrajet= ? and soustrajetutilisateur.utilisateur_idutilisateur=? ');
		$selecPrepareeUnique->execute(array($idTrajet, $value[0]));
		$tab[$value[0]] = $selecPrepareeUnique->fetchAll();

		}
		return $tab;
		
	}
	public function retirerTrajet($idTrajet)
	{
		$updatePreparee=self::$bdd->prepare('UPDATE trajet set  suppression=1 where idTrajet=? && idConducteur=?');
		$updatePreparee -> execute(array($idTrajet, $_SESSION['id']));
		echo "success";
	}
	public function idEtapeTrajet($idTrajet)
	{
		$selecPrepareeUnique=self::$bdd->prepare('SELECT DISTINCT sousTrajet_idsousTrajet FROM soustrajetutilisateur inner join soustrajet on sousTrajet_idsousTrajet=soustrajet.idsousTrajet 
			WHERE soustrajet.idTrajet= ? ');
		$selecPrepareeUnique->execute(array($idTrajet));
		$idUtilisateur=$selecPrepareeUnique->fetchAll();
		return $idUtilisateur;
	}
	public function actualiseToken($idUser)
	{
		$lettrePossible = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','0','1','2','3','4','5','6','7','8','9');
		$token="";
		for ($i=0; $i < 10; $i++) { 
			$token=$token.$lettrePossible[rand(0,61)];
		}
		$insertPreparee=self::$bdd->prepare('UPDATE utilisateur SET token = :token WHERE idUtilisateur=:idUtilisateur');
		$insertPreparee -> execute(array('token'=>$token,'idUtilisateur'=>$idUser));
		return $token;
	}
	public function verifieToken($idUser,$token)
	{
		$selecPrepareeUnique=self::$bdd->prepare('SELECT token FROM utilisateur where idUtilisateur=? and token=?');
		$tableauIds=array($idUser,$token);
		$selecPrepareeUnique->execute($tableauIds);
		$unique=$selecPrepareeUnique->fetch();
		if (empty($unique['token'])) {
			return false;
		}
		return true;
	}
	public function actualiseMap($tabVille)
	{
		$ville=array();
		$compteur=0;
		foreach ($tabVille as $key => $value) {
			if (!empty($value)) {
				$depart= explode(",", $value)[0];
		
				$selecPrepare=self::$bdd->prepare('SELECT nomVille, Geo_Point FROM ville where nomVille like upper("%"?"%")');
				$tableauIds=array($depart);
				$selecPrepare->execute($tableauIds);
				$res= $selecPrepare->fetch();

				$ville[$compteur]=explode(",", $res[1]);
				$compteur=$compteur+1;
			}
			else
				echo $value;
		}
		echo json_encode($ville);

	}

}


?>
