<?php  
session_start();
include_once __DIR__.'/../modules/mod_trajet/modele_trajet.php';
$modele_trajet=new modele_trajet();

if( isset($_POST['soustrajet']) && isset($_POST['descriptionTrajet']) && isset($_POST['placeTotale']) && isset($_POST['dateArrivee'])){
	if($modele_trajet->creationTrajet($_POST['soustrajet'], $_POST['descriptionTrajet'],$_POST['placeTotale'], $_POST['dateArrivee'])){
		echo "ok";
	}
}

if( isset($_POST['immatriculation']) && isset($_POST['critair']) && isset($_POST['hybride'])){
	if($modele_trajet->ajoutVehicule($_POST['immatriculation'],$_POST['critair'],$_POST['hybride'])){
		echo "ok";
	}
}

if(isset($_POST['immatriculation'])){
	if($modele_trajet->delVehicule($_POST['immatriculation'])){
		echo "ok";
	}
}


?>