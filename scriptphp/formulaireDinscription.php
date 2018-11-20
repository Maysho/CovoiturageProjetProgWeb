<?php  
if(isset($_POST['nomFonction'])){
	$nomFonction=$_POST['nomFonction'];
}
else
	$nomFonction="";
switch ($nomFonction){
	case"verifieInscription":
		include_once '../modules/mod_connexion/mod_connexion.php';
		$mod_connexion=new mod_connexion();
		$mod_connexion->verifieInscription($_POST['email'],$_POST['emailConf'],$_POST['nom'],$_POST['prenom'],$_POST['mdp'],$_POST['mdpConf']);
		break
		;
	case"mod_joueurs":
	include_once 'modules/'.$module.'/'.$module.".php";
		$mod_joueur=new ModJoueurs();
		$mod_joueur->init();
	break
	;
	case "mod_connexion":
	include_once 'modules/'.$module.'/'.$module.".php";
		$mod_connexion=new mod_connexion();
		$mod_connexion->init();
		

	break;
	default
:
//die("Interdiction d’acces a ce module");
}



?>