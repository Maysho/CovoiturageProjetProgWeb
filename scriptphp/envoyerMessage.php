<?php
	session_start();
	include_once __DIR__.'/../modules/mod_discussion/modele_discussion.php';
	$modele = new ModeleDiscussion;

	$message = isset($_POST['message'])? htmlspecialchars($_POST['message']) : null;
	$idInterlocuteur = isset($_POST['idInterlocuteur'])?$_POST['idInterlocuteur'] : null;

	if ($message != null && $idInterlocuteur != null){
		$idUser = $_SESSION['id'];	

		if($modele->checkDiscuValide($idUser, $idInterlocuteur))
			$result=$modele->insererMessage($idUser, $idInterlocuteur, $message);				
		
	}
	