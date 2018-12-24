<?php

/**
* 
*/
include_once 'vue_generique.php';
class vue_nav extends VueGenerique
{
	
	function __construct()
	{
		parent::__construct();
	}
	public function navNonConnecte($value='')
	{
		echo "<nav class='navbar navbar-expand-md navbar-light bg-light'>
			  <a class='navbar-brand ' href='index.php'><img src='home.jpg' class='imagenav'></a>
			  <button class='navbar-toggler navbar-nav mr-auto' type='button' data-toggle='collapse' data-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
			    <span class='navbar-toggler-icon'></span>
			  </button>

			  <div class='collapse navbar-collapse justify-content-end' id='navbarSupportedContent'>
			    <ul class='navbar-nav '>
			      
			      <li class='nav-item'>
			        <a class='nav-link' href='#'>Rechercher <span class='sr-only'>(current)</span></a>
			      </li>
			      <li class='nav-item'>
			        <a class='nav-link' href='index.php?module=mod_connexion'>S'inscrire </a>
			      </li>
			      <li class='nav-item'>
			        <a class='nav-link' href='index.php?module=mod_connexion'>Se Connecter</a>
			      </li>
			    </ul>
			  </div>
			</nav>
";
	}
	public function navConnecte(){

   		echo "<nav class='navbar navbar-expand-md navbar-light bg-light'>
			  <a class='navbar-brand ' href='index.php'><img src='home.jpg' class='imagenav'></a>
			  <button class='navbar-toggler navbar-nav mr-auto' type='button' data-toggle='collapse' data-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
			    <span class='navbar-toggler-icon'></span>
			  </button>

			  <div class='collapse navbar-collapse float-right' id='navbarSupportedContent'>
			  <div class='mr-auto'></div>
			    <ul class='navbar-nav '>
			      <li class='nav-item'>
			      	<a id='messagesNonLus' class='nav-link' href='?module=mod_discussion'></a>
			      </li>
			      <li class='nav-item'>
			        <a class='nav-link' href='index.php?module=mod_trajet'>Proposer <span class='sr-only'>(current)</span></a>
			      </li>
			      <li class='nav-item'>
			        <a class='nav-link' href='#'>Rechercher</a>
			      </li>
			    </ul>
			    <div class='nav-item dropdown'>
			        <a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
			          <img src='profildefault.jpg' class='imagenav'>
			        </a>
			        <div class='dropdown-menu' aria-labelledby='navbarDropdown'>
			          <a class='dropdown-item' href='?module=mod_discussion'>Discussion</a>
			          <a class='dropdown-item' href='?module=mod_profil'>Profil</a>
			          <div class='dropdown-divider'></div>
			          <a class='dropdown-item' href='index.php?module=mod_connexion&action=deconnexion'>Deconnexion</a>
			        </div>
			      </div>
			  </div>
			</nav>
";
   	
  	}
}
?>