<?php  
include_once __DIR__.'/../modules/mod_trajet/mod_trajet.php';
$mod_trajet=new mod_trajet();

if(isset($_POST['descriptionTrajet']) && isset($_POST['placeTotale'])){
	if($mod_trajet->verifCreationTrajet2($_POST['descriptionTrajet'],$_POST['placeTotale'])){
	echo "ok";
	}
}

?>