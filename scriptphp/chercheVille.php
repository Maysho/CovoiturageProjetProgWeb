<?php  


include_once '../modules/mod_connexion/modele_connexion.php';
$mod_connexion=new modele_connexion();
$mod_connexion->chercheVille($_POST['ville']);




?>