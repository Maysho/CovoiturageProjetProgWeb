<?php  
session_start();

include_once '../modules/mod_profil/modele_profil.php';
$ModeleProfil=new ModeleProfil();
if (isset($_POST['idFavoris']) && !empty($_POST['idFavoris'])) {
	$ModeleProfil->retireFavoris(htmlspecialchars($_POST['idFavoris']));
}





?>