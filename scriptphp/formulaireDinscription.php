<?php  


include_once '../modules/mod_connexion/modele_connexion.php';
$mod_connexion=new modele_connexion();
$mod_connexion->verifieInscription($_POST['emailInscription'],$_POST['confemail'],$_POST['nomInscription'],$_POST['prenomInscription'],$_POST['MDPInscription'],$_POST['confMDPInscription']);




?>