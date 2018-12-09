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
			$reponse2 = self::$bdd->prepare('SELECT idConducteur FROM trajet ORDER BY idConducteur desc limit 1');
			$idCon=($reponse2->fetch());
			$idConducteur=$idCon['idTrajet']+1;
			//erreur
		}
		// echo $idConducteur;
		
		$sql =self::$bdd->prepare("
		INSERT INTO trajet(
			idTrajet, 
			descriptionTrajet, 
			idConducteur, 
			placeTotale, 
			suppression
			) VALUES (
			DEFAULT,
			:descriptionTrajet,
			:idConducteur,
			:placeTotale,
			false
			) 
		");
		
		$sql->execute(array(
			':descriptionTrajet' => $descriptionTrajet,
			':idConducteur' => $idConducteur,
			':placeTotale' => $placeTotale
		));

		$reponse = self::$bdd->query('SELECT idTrajet FROM trajet ORDER BY idTrajet desc limit 1');
		$idTraj=($reponse->fetch());
		$idTrajet=$idTraj['idTrajet'];
		echo "c'est moi ".$idTrajet;

		foreach ($soustrajets as $key => $value) {
			if( $value['regulier'] == "on"){
				$reg = 1;
			}
			else {
				$reg = 0;
			}

 			$sqlsss =self::$bdd->prepare('
	 				INSERT INTO soustrajet (
		 				idsousTrajet,
						idTrajet,
						dateDepart,
						heureDepart,
						villeDepart,
						dureeTrajet,
						heureArrivee,
						idVehiculeConducteur,
						prix,
						regulier
	 				) VALUES (
	 					DEFAULT,
						:idTrajet,
						:dateDepart,
						:heureDepart,
						:villeDepart,
						:dureeTrajet,
						:heureArrivee,
						:idVehiculeConducteur,
						:prix,
						:regulier
	 				)
	 			');

		 	$sqlsss->execute(array(
		 		':idTrajet' => $idTrajet, 
		 		':dateDepart'=>$value['dateDepart'],
		 		':heureDepart'=>$value['heureDepart'],
		 		':villeDepart'=>$value['idVilleD'],
		 		':dureeTrajet'=>$value['heureDepart'],
		 		// ':dureeTrajet'=>$value['dureeTrajet'],
		 		':heureArrivee'=>$value['heureDepart'],
		 		// ':heureArrivee'=>$value['heureArrive'],
		 		':idVehiculeConducteur'=>1,
		 		// ':idVehiculeConducteur'=>$value['idVehiculeConducteur'],
		 		':prix'=>$value['prix'],
		 		':regulier'=> $reg
		 	));
	 	}
	}
}


?>
