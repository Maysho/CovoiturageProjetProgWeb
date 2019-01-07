<?php  
session_start();
include_once __DIR__ . '/../connexion.php';
include_once '../modules/mod_resTrajet/modele_resTrajet.php';

$mod_connexion=new modele_resTrajet();
$regulier=0;
if (isset($_POST['regulier'])) {
	$regulier=1;
}//,$_POST['order']
$mod_connexion->donneTrajetJSON($_POST['depart'],$_POST['destination'],$_POST['date'],$_POST['prix'],$_POST['type'],$regulier,$_POST['trie']);




?>