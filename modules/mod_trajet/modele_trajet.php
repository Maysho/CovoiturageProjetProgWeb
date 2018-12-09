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

	public function verifCreationTrajet3($soustrajets, $descriptionTrajet, $placeTotale){
		
		if(isset($_SESSION['id'])){
			$idConducteur==$_SESSION['id'];
		}
		else{
			//erreur
		}
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
			// ':idConducteur' => $idConducteur,
			':idConducteur' => 1,
			':placeTotale' => $placeTotale
		));

		foreach ($soustrajets as $key => $value) {
			if( $value['regulier'] == "on"){
				$reg = 1;
			}
			else {
				$reg = 0;
			}

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
		 		':regulier'=> $reg
		 	));
	 	}	
	}
}


?>
