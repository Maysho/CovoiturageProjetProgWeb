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
  <body>
  	<div class="container-fluid">
  			<nav class="navbar navbar-expand-md navbar-light bg-light">
			  <a class="navbar-brand " href="#"><img src="home.jpg" class="imagenav"></a>
			  <button class="navbar-toggler navbar-nav mr-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			    <span class="navbar-toggler-icon"></span>
			  </button>

			  <div class="collapse navbar-collapse float-right" id="navbarSupportedContent">
			  <div class="mr-auto"></div>
			    <ul class="navbar-nav ">
			      <li class="nav-item">
			        <a class="nav-link" href="#">Proposer <span class="sr-only">(current)</span></a>
			      </li>
			      <li id="test" class="nav-item">
			        <a class="nav-link" href="#">Rechercher</a>
			      </li>
			    </ul>
			    <div class="nav-item dropdown">
			        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			          <img src="profildefault.jpg" class="imagenav">
			        </a>
			        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
			          <a class="dropdown-item" href="#">Discussion</a>
			          <a class="dropdown-item" href="#">Profil</a>
			          <div class="dropdown-divider"></div>
			          <a class="dropdown-item" href="#">Deconnexion</a>
			        </div>
			      </div>
			  </div>
			</nav>




				<h1 class="text-center">Bienvenue dans notre site de covoiturage</h1>
  		
  		<aside class="composant col-md-3  float-left">
  			<img src="profildefault.jpg" style="width: 100%">
  		</aside>
	<div class="row ">
  		
  		</div>
  		<div><aside class="composant col-md-3">
  			<img src="profildefault.jpg" style="width: 100%">
  		</aside></div>
  		









  	</div>
    <!--<h1>Hello, world!</h1>-->

    
  
<?php
/*
require_once 'controleur.php';
$connexion=new connexion();
$connexion->init();

require_once 'composant/CompMenu.php';
$CompMenu=new CompMenu;


if(isset($_GET['module'])){

	$module=$_GET['module'];
}
else
	$module="";
switch ($module){
	case"module1":
	case"mod_equipe":
	include_once 'modules/'.$module.'/'.$module.".php";
		$mod_equipe=new ModEquipe();
		$mod_equipe->init();
		$affichageForm=$mod_equipe->getAffichage();
	case"mod_joueurs":
	include_once 'modules/'.$module.'/'.$module.".php";
		$mod_joueur=new ModJoueurs();
		$mod_joueur->init();
		$affichageForm=$mod_joueur->getAffichage();
	break
	;
	case "mod_connexion":
	include_once 'modules/'.$module.'/'.$module.".php";
		$mod_connexion=new mod_connexion();
		$mod_connexion->init();
		$affichageForm=$mod_connexion->getAffichage();
		

	break;
	default
:
//die("Interdiction d’acces a ce module");
}
*/
?>


		<!--<h1 class="center">Joueur trop fort</h1>-->
		<?php /*
			$CompMenu->affiche();

			include_once 'modules/mod_connexion/mod_connexion.php';
			$mod_connexion=new mod_connexion();
			$mod_connexion->afficheFormCo();
			echo "$affichageForm";
			
			*/
		?>

	<footer>Antoine Dabilly</footer>
	<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    
    <script src="jquery.js"></script>
    <script src="javascript.js"> </script>

</body>

</html>