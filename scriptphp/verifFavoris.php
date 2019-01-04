<?php  
session_start();
include_once __DIR__ . '/../../connexion.php';
include_once '../modules/mod_resTrajet/modele_resTrajet.php';

$modele_resTrajet=new modele_resTrajet();
$regulier=0;
if (isset($_POST['regulier'])) {
	$regulier=1;
}//,$_POST['order']
$modele_resTrajet->verifieSiExisteJ(htmlspecialchars($_POST['depart']),htmlspecialchars($_POST['destination']),htmlspecialchars($_POST['prix']),htmlspecialchars($_POST['type']),htmlspecialchars($regulier));




?>