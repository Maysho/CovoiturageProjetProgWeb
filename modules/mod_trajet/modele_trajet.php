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

	public function verifCreationTrajet($soustrajets, $idVehicule, $descTrajet, $placeTotale){
		$erreur =false;
		// if($idConducteur == null){
		// 	// renvoyer vers la page de connexion
		// }

		$sqlTrajet= self::$bdd->prepare('
			INSERT INTO trajet(
			idTrajet, 
			descriptionTrajet, 
			idConducteur, 
			placeTotale, 
			suppresion) 
			values(
			:idTrajet, 
			:descriptionTrajet, 
			:idConducteur, 
			:placeTotale, 
			:suppresion)
		');

		$sqlTrajet -> execute(array( 
			'idTrajet'=> $idTrajet, 
			'descriptionTrajet'=> $descTrajet, 
			'idConducteur' => $Conducteur, 
			'placeTotale' => $placeTotale, 
			'suppresion' => $suppresion	
		));

		foreach( $soustrajets as $key => $values){

			$sqlSousTrajet = self::$bdd->prepare('
				INSERT INTO soustrajets(
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
				)
				values(
				:idsousTrajet,
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
			$sqlSousTrajet -> execute(array(
				'idsousTrajet'=>$key,
				'idTrajet'=> $values['idTrajet'],
				'dateDepart'=>$values['date'],
				'heureDepart'=>$values['heureDepart'],
				'villeDepart'=>$values['villeDepart'],
				'dureeTrajet'=>$values['dureeTrajet'],
				'heureArrivee'=>$values['heureArrivee'],
				'idVehiculeConducteur'=>$values['idVehiculeConducteur'],
				'prix'=>$values['prix'],
				'regulier'=> $values['regulier']
			));
		}
	}

	public function verifCreationTrajet2($descriptionTrajet, $placeTotale){
		
		$reponse = self::$bdd->query('SELECT idTrajet FROM trajet ORDER BY idTrajet desc limit 1');
		$idTraj=($reponse->fetch());
		$idTrajet=$idTraj['idTrajet']+1;
		echo $idTrajet;

		if(isset($_SESSION['id'])){
			$idConducteur==$_SESSION['id'];
		}
		else{
			$reponse2 = self::$bdd->prepare('SELECT idConducteur FROM trajet ORDER BY idConducteur desc limit 1');
			$idCon=($reponse2->fetch());
			$idConducteur=$idCon['idTrajet']+1;
			//erreur
		}
		echo $idConducteur;
		
		
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

	}

}


?>
