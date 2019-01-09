<?php  
session_start();
include_once __DIR__.'/../modules/mod_discussion/modele_discussion.php';
$modele = new ModeleDiscussion;

	if(isset($_SESSION['id'])){
		$code=$modele->envoieMsgDepuisProfil($_SESSION['id'], $_POST['idInterlocuteur']);
		if ($code==0)
			echo "0";
	}

	echo "1";

?>