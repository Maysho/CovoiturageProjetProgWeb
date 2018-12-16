<!-- <?php  
session_start();
?> -->
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Covoiturage</title>
  </head>


<?php
//phpinfo();

require_once 'connexion.php';
$connexion=new connexion();
$connexion->init();

/*
require_once 'composants/CompMenu.php';
$CompMenu=new CompMenu;
*/

if(isset($_GET['module'])){

	$module=$_GET['module'];
}
else{
	$module="mod_accueil";
}

switch ($module){
	case"mod_accueil":
		include_once 'modules/'.$module.'/'.$module.".php";
		$mod_accueil=new ModAccueil();
		$mod_accueil->init();
		$affichageForm=$mod_accueil->getAffichage();
		break
		;
	case"mod_joueurs":
	include_once 'modules/'.$module.'/'.$module.".php";
		$mod_joueur=new ModJoueurs();
		$mod_joueur->init();
		$affichageForm=$mod_joueur->getAffichage();
	break
	;
	case "mod_resTrajet":
	include_once 'modules/'.$module.'/'.$module.".php";
		$mod_resTrajet=new mod_resTrajet();
		$mod_resTrajet->init();
		$affichageForm=$mod_resTrajet->getAffichage();
		

	break;
	case "mod_connexion":
	include_once 'modules/'.$module.'/'.$module.".php";
		$mod_connexion=new mod_connexion();
		$mod_connexion->init();
		$affichageForm=$mod_connexion->getAffichage();
	break;
	case "mod_trajet":
	include_once 'modules/'.$module.'/'.$module.".php";
		$mod_trajet=new mod_trajet();
		$mod_trajet->init();
		$affichageForm=$mod_trajet->getAffichage();
	break;

	case "mod_profil":
	include_once 'modules/'.$module.'/'.$module.".php";
		$mod_profil=new ModProfil();
		$mod_profil->init();
		$affichageForm=$mod_profil->getAffichage();
	break;

	case "mod_discussion":
	include_once 'modules/'.$module.'/'.$module.".php";
		$mod_discussion=new ModDiscussion();
		$mod_discussion->init();
		$affichageForm=$mod_discussion	->getAffichage();
	break;

	default
:
die("Interdiction d’acces a ce module");
}

?>

		<!--<h1 class="center">Joueur trop fort</h1>-->
		

 
  	<div class="container-fluid">
		<header>
	  		<?php 
				//$CompMenu->affiche();

				include_once 'modules/mod_connexion/mod_connexion.php';
				$mod_connexion=new mod_connexion();
				$mod_connexion->afficheNav();
				echo "$affichageForm";
				
			?>
		</header>
	</div>

	<footer>Antoine Dabilly</footer>
	<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script src="http://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="jquery.js"></script>
    <script src="javascript.js"> </script>
</body>

</html>
