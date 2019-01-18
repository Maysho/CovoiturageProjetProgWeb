<?php  
session_start();

include_once '../modules/mod_trajet/modele_trajet.php';
$modele_trajet=new modele_trajet();
if (isset($_POST['tabVille']) && !empty($_POST['tabVille'])) {
	$modele_trajet->actualiseMap($_POST['tabVille']);
}





?>