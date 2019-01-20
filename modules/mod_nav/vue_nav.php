<?php

/*
*  Vue du navigateur
*/

class vue_nav 
{
	
	function __construct()
	{
		
	}
	public function navNonConnecte($value='')
	{
	?>
		<nav class='row navbar navbar-expand-md navbar-light'>
			<a class='navbar-brand ' href='index.php'><img src='logo-nav.png' ></a>
			<button class='navbar-toggler navbar-nav mr-auto' type='button' data-toggle='collapse' data-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
				<span class='navbar-toggler-icon'></span>
			</button>
			<div class='collapse navbar-collapse justify-content-end' id='navbarSupportedContent'>
				<ul class='navbar-nav '>
					<li class='nav-item'>
						<a class='nav-link' href='index.php' title='Accéder à la page de recherche' >Rechercher<span class='sr-only'>(current)</span></a>
					</li>
					<li class='nav-item'>
						<a class='nav-link' href='index.php?module=mod_connexion'>Connexion <i class="fas fa-sign-in-alt"></i></a>
					</li>
				</ul>
			</div>
		</nav>
	<?php
	}
	public function navConnecte($info){
?>
   		<nav class='row navbar navbar-expand-md navbar-light'>

			<a class='navbar-brand ' href='index.php'><img src='logo-nav.png'></a>
			<a  class='nav-link liensanscouleur ' title="en cliquant vous ferez afficher ou desafficher les composants" id="changeComposant" href=''><?php echo !isset($_SESSION['composantNonActif'])?"Désaffiche":"Affiche"?></a>
			<div class='mr-auto'></div>
			<div class="row align-items-center">
	        	<a class='nav-link' href='index.php?module=mod_trajet' title="permet d'accéder a la page de proposition de trajet">Proposer <span class='sr-only'>(current)</span></a>

	        	<a class='nav-link' href='index.php' title="permet d'accéder a la page de recherche de trajet">Rechercher</a>


			  
			  	<a class="btn btn-light border" href="?module=mod_discussion" role="button">
				<i id="envelopeMsg" class="fas fa-envelope"></i>
				<span id='messagesNonLus' class="badge border badge-light"></span>
			  	</a>

			    <ul class='navbar-nav'>
			      	<li class="nav-item ">
						<a class="btn btn-light border" href="#">
				      		<i class="fas fa-money-bill"></i>
							<span class=""><?php echo $info[1]."€";?></span>
						</a>
			      </li>
			    </ul>

			    <div class='nav-item dropdown  ' >

			        <a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
			          	<img src='<?php echo isset($info[0])? $info[0]:'home.jpg' ?>' class='imagenav'>
			        </a>
			        <div class='dropdown-menu' aria-labelledby='navbarDropdown' id="dropdownNav">
			          	<a class='dropdown-item' href='?module=mod_discussion' title="Accéder à la page de discussion">Discussion</a>
						<a class='dropdown-item' href='?module=mod_profil' title="Accéder à la page de profil">Profil</a>
						<div class='dropdown-divider'></div>
						<a class='dropdown-item' href='index.php?module=mod_connexion&action=deconnexion'>Déconnexion <i class="fas fa-sign-out-alt"></i></a>
					</div>
				</div>
			</div>
		</nav>
   	<?php
  	}
}
?>