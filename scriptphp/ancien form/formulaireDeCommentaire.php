<?php  
session_start();

include_once '../modules/mod_trajet/modele_trajet.php';

$mod_connexion=new modele_trajet();
$mod_connexion->ajouteCommentaire(htmlspecialchars($_POST['note']),htmlspecialchars($_POST['commentaire']),htmlspecialchars($_POST['idTrajet']));




?>