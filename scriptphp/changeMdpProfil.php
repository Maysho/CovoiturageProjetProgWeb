<?php  
session_start();
include_once __DIR__.'/../modules/mod_profil/modele_profil.php';
$modele = new ModeleProfil;

	if(isset($_SESSION['id'])){
		$code = $modele->verifieModificationMdp($_SESSION['id']);
		if($code==0)
			echo "0";
		else if($code==1)
			echo "1";
		else if($code==2)
			echo "2";
	}
	else echo "2";
?>