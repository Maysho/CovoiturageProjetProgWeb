<?php  
	session_start();
	include_once __DIR__.'/../modules/mod_discussion/modele_discussion.php';
	$modele = new ModeleDiscussion;

	$idUser = $_SESSION['id'];
	echo $modele->nbMessagesNonLus($idUser);
?>