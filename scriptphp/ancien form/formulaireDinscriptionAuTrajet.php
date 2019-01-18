<?php  
session_start();

include_once '../modules/mod_trajet/modele_trajet.php';
$modele_trajet=new modele_trajet();
$modele_trajet->InscriptionTrajet($_POST['tabId'],$_POST['idTrajet'],$_POST['token']);




?>