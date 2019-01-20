<?php
session_start();
?> 
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css" integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ=="
            crossorigin="" />
	<link rel="icon" href="favicon.png" />
    <title>TakeU</title>
  </head>
  <body>


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
		$mod_profil=new modProfil();
		$mod_profil->init();
		$affichageForm=$mod_profil->getAffichage();

	break;

	case "mod_discussion":
	include_once 'modules/'.$module.'/'.$module.".php";
		$mod_discussion=new modDiscussion();
		$mod_discussion->init();
		$affichageForm=$mod_discussion->getAffichage();

	break;
	default:
		http_response_code(404);
		die("Erreur 404");
	break;
}

?>

		<!--<h1 class="center">Joueur trop fort</h1>-->
		

 
  	<div class="container-fluid">
<!--   		<button id="changeComposant" class="btn btn-info">Change</button> -->

		<header>
 <?php 
			//$CompMenu->affiche();

			include_once 'modules/mod_nav/mod_nav.php';
			$mod_nav=new mod_nav();
			$mod_nav->afficheNav(); 
?>
		</header>
		
<?php 	
			if($module=="mod_accueil")
				echo '<div class="row justify-content-center flextest frontpage">';
			else
				echo '<div class="row justify-content-center flextest">';
		if(isset($_SESSION['id'])) {
			if(!isset($_SESSION['composantNonActif']))
				echo "<aside id='composants' class='col-md-3' >";
			else
				echo "<aside id='composants' class='col-md-3 d-none' >";
}
		else{
			
		}
			include_once 'composants/compCommentaire/compCommentaire.php';

  			$compCommentaire=new compCommentaire();
			

			include_once 'composants/compFavoris/compFavoris.php';

  			$compFavoris=new compFavoris();


			include_once 'composants/compNote/compNote.php';

  			$compNote=new compNote();

			include_once 'composants/compHistorique/compHistorique.php';

  			$compHistorique=new CompHistorique();

			include_once 'composants/compTrajetReserve/compTrajetReserve.php';

  			$compTrajetReserve=new CompTrajetReserve();

			include_once 'composants/compPub/compPub.php';

  			$CompPub=new CompPub();

			if (isset($_SESSION['id']) ) {
				$compCommentaire->affiche();
				$compFavoris->affiche();
				$compNote->affiche();
				$compHistorique->affiche();
				$compTrajetReserve->affiche();
				$CompPub->affiche();
			}

			if (isset($_SESSION['id'])) {
				echo "</aside>";
			}

			if (isset($_SESSION['id'])) {
				if(!isset($_SESSION['composantNonActif']))
					echo'<section class="col-md-8 px-0 " >';
				else
					echo'<section class="col-md-6 px-0 " >';
			}
			else{
				echo'<section class="col-12 row px-0 ">';
				
			}
				echo "$affichageForm";
?>
		</section>
		


	

		<footer id="footer" class="row col-12 justify-content-center card-footer">
			<div class="col-md-3">
				<h3 class="text-footer titre-footer">Qui sommes-nous?</h3>
				<div class="justify-content-center col-12">
					<p class="text-footer">Antoine Dabilly</p>
					<p class="text-footer">William Lin</p>
					<p class="text-footer">Bastian Padiglione</p>
				</div>
			</div>
			<div class="col-md-3">
				<h3 class="text-footer titre-footer">Nos outils de developpement</h3>
				<div class="justify-content-center col-12">
					<p><a class="text-footer lien-footer" href="https://github.com/Maysho/CovoiturageProjetProgWeb">GitHub</a></p>
					<p><a class="text-footer lien-footer" href="https://trello.com/">Trello</a></p>
					<p><a class="text-footer lien-footer" href="https://discordapp.com/">Discord</a></p>
				</div>
			</div>
			<div class="col-md-3">
				<h3 class="text-footer titre-footer">Le projet TakeU</h3>
				<div class="justify-content-center col-12">
					<p><a class="text-footer lien-footer" href="">A propos du projet</a></p>
				</div>
			</div>
		</footer>

	</div>	

	<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script src="http://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    
<script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js" integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw=="
            crossorigin=""></script>
    
    <script src="jquery.js"></script>
    <script src="javascript.js"> </script>
</body>

</html>
