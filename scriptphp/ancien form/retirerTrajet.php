<?php  
session_start();

include_once '../modules/mod_trajet/modele_trajet.php';
$modele_trajet=new modele_trajet();
$modele_trajet->retirerTrajet($_POST['idTrajet']);




?>