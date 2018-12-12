<?php

/**
* 
*/
include_once __DIR__ . '/../../connexion.php';
class modele_trajet extends connexion {
	
	function __construct()
	{
		$trajet=new connexion();
		$trajet->init();
	}


	// private function enregistrePhoto(){

	// 		$ancienUrl=$resultselect['urlPhoto'];

	// 	if($_FILES['photoprofil']['size']>0){
	// 		unlink($ancienUrl);
	// 		$extension_upload = strtolower(  substr(  strrchr($_FILES['photoprofil']['name'], '.')  ,1)  );
	// 		$_FILES['photoprofil']['name']=$idUser.'.'.$extension_upload;
	// 		$result=move_uploaded_file($_FILES['photoprofil']['tmp_name'], "sources/images/photoProfil/".$_FILES['photoprofil']['name']);

	// 		if($result)
	// 			return "sources/images/photoProfil/".$_FILES['photoprofil']['name'];

	// 	}
	// 	else 
	// 		return $ancienUrl;
	// }

	public function ajoutVehicule($immatriculation, $critair, $hybride){

		$reg = $hybride == "on" ?  1 :  0; 

		$idConducteur = isset($_SESSION['id']) ? $_SESSION['id'] : -1;

		$reqAddCar=self::$bdd->prepare("
			INSERT INTO vehicule (
			immatriculation,
			critair,
			hybride
			) VALUES (
			:immatriculation,
			:critair,
			:hybride
			)
		");

		$reqAddCar->execute(array(
			":immatriculation" => $immatriculation,
			":critair" => $critair,
			":hybride" => $reg
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


	public function verifCreationTrajet3($soustrajets, $descriptionTrajet, $placeTotale){
		
		// $this->verifChamps($soustrajets, $descriptionTrajet, $placeTotale);
		// foreach ($soustrajets as $key => $value) {
		// 	list($nomVille, $codePostal)= explode(",", $value['idVilleD']);
		// 	list($nomVille2, $codePostal2)= explode(",", $value['idVilleA']);
		// 	echo $nomVille."\n";
		// 	echo $codePostal."\n";
		// 	echo $nomVille2."\n";
		// 	echo $codePostal2."\n";

		// 	$sql = self::$bdd->prepare('SELECT idVille FROM ville where nomVille like ? or codePostal like ?');
		// 	$array = array($nomVille, $codePostal);
		// 	$sql->execute($array);
		// 	$reponsesql = ($sql->fetch());
		// 	$idVille1 = $reponsesql['idVille'];

		// 	$sql2 = self::$bdd->prepare('SELECT idVille FROM ville where nomVille like ? or codePostal like ?');
		// 	$array2 = array($nomVille2, $codePostal2);
		// 	$sql2->execute($array2);
		// 	$reponsesql2 = ($sql2->fetch());
		// 	$idVille2 = $reponsesql2['idVille'];

		// 	$value['idVilleD'] = $idVille1;
		// 	$value['idVilleA'] = $idVille2;
		// 	echo $value['idVilleD'] ."\n";
		// 	echo $value['idVilleA'] ."\n";
		// }

		$idConducteur = isset($_SESSION['id']) ? $_SESSION['id'] : -1;

		// echo $idConducteur;
			
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

			
			if( $value['regulier'] == "on"){
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
	}

	public function verifChamps($soustrajets, $descriptionTrajet, $placeTotale){
	}
}


?>
