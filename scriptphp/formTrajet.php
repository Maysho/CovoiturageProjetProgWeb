<?php  
include_once __DIR__.'/../modules/mod_trajet/modele_trajet.php';
$modele_trajet=new modele_trajet();

if( isset($_POST['soustrajet']) && isset($_POST['descriptionTrajet']) && isset($_POST['placeTotale'])){
	if($modele_trajet->verifCreationTrajet3($_POST['soustrajet'], $_POST['descriptionTrajet'],$_POST['placeTotale'])){
		echo "ok";
	}
}

?>