<?php  
	session_start();
	include_once __DIR__.'/../modules/mod_discussion/modele_discussion.php';
	$modele = new ModeleDiscussion;

	if(isset($_SESSION['id'])){
		$idUser = $_SESSION['id'];
		echo $modele->nbMessagesNonLus($idUser);
	}
?>