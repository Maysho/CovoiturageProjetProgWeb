<?php  
include_once '../modules/mod_connexion/modele_connexion.php';
$mod_connexion=new modele_connexion();
// verifCreationTrajet($idConducteur, $soustrajets, $idVehicule, $descTrajet, $placeTotale, $suppresion)
$mod_connexion->verifCreationTrajet($_POST['soustrajets'],$_POST['idVehicule'],$_POST['descriptionTrajet'],$_POST['placeTotale']);




?>