<?php

/**
* 
*/
include_once '/../../vue_generique.php';
class vue_connexion extends VueGenerique
{
	
	function __construct()
	{
		parent::__construct();
	}
	public function formNonConnecte($value='')
	{
		echo "<nav class='navbar navbar-expand-md navbar-light bg-light'>
			  <a class='navbar-brand ' href='#'><img src='home.jpg' class='imagenav'></a>
			  <button class='navbar-toggler navbar-nav mr-auto' type='button' data-toggle='collapse' data-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
			    <span class='navbar-toggler-icon'></span>
			  </button>

			  <div class='collapse navbar-collapse justify-content-end' id='navbarSupportedContent'>
			    <ul class='navbar-nav '>
			      
			      <li class='nav-item'>
			        <a class='nav-link' href='#'>Rechercher <span class='sr-only'>(current)</span></a>
			      </li>
			      <li class='nav-item'>
			        <a class='nav-link' href='#'>S'inscrire </a>
			      </li>
			      <li class='nav-item'>
			        <a class='nav-link' href='#'>Se Connecter</a>
			      </li>
			    </ul>
			  </div>
			</nav>
";
	}
	public function formConnecte(){

   		echo "<nav class='navbar navbar-expand-md navbar-light bg-light'>
			  <a class='navbar-brand ' href='#'><img src='home.jpg' class='imagenav'></a>
			  <button class='navbar-toggler navbar-nav mr-auto' type='button' data-toggle='collapse' data-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
			    <span class='navbar-toggler-icon'></span>
			  </button>

			  <div class='collapse navbar-collapse float-right' id='navbarSupportedContent'>
			  <div class='mr-auto'></div>
			    <ul class='navbar-nav '>
			      <li class='nav-item'>
			        <a class='nav-link' href='#'>Proposer <span class='sr-only'>(current)</span></a>
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
			          <a class='dropdown-item' href='#'>Discussion</a>
			          <a class='dropdown-item' href='#'>Profil</a>
			          <div class='dropdown-divider'></div>
			          <a class='dropdown-item' href='#'>Deconnexion</a>
			        </div>
			      </div>
			  </div>
			</nav>
";
   	
  	}
  	public function pageConnexion($login='')
  	{
  		echo '<div class="row">

  		<section class="order-md-0 order-2 justify-content-md-start justify-content-lg-center offset-1 col-md-4 ">
  		<h2>S\'inscrire</h2>
  		<form method="POST" id="inscription">
			  <div class="form-group" id="divEmailInscription">
			    <label for="exampleInputEmail1">Adresse mail</label>
			    <input type="email" required name="email" class="form-control" id="emailInscription"  placeholder="adresse mail">
			  </div>
			  <div class="form-group" id="divConfEmail">
			    <label for="exampleInputEmail2">Confirmation d\'adresse mail</label>
			    <input type="email" required name="confemail" id="confemail" class="form-control" id="exampleInputEmail2"  placeholder="adresse mail">
			  </div >
			  <div class="form-group" id="divNomInscription">
			    <label for="Nom">Nom</label>
			    <input type="text" required name="nom"class="form-control" id="nomInscription"  placeholder="Nom">
			  </div>
			  <div class="form-group" id="divPrenomInscription">
			    <label for="Prenom">Prenom</label>
			    <input type="text" required name="prenom" class="form-control" id="prenomInscription"  placeholder="Prenom">
			  </div>
			  <div class="form-group" id="divMDPInscription">
			    <label for="exampleInputPassword1">Mot De Passe</label>
			    <input type="password" required name="mdr" class="form-control" id="MDPInscription" placeholder="Mot De Passe">
			  </div>
			  <div class="form-group" id="divConfMDPInscription">
			    <label for="exampleInputPassword2">Confirmation De Mot De Passe</label>
			    <input type="password" required name="confmdp" class="form-control" id="confMDPInscription" placeholder="Confirmation De Mot De Passe">
			  </div>
			  <button type="submit"  id="inscriptionbutton"name="submit"  class="btn btn-primary">S\'inscrire</button>
		</form>


  		</section>
  		<div class=" col-0 order-md-1 separation border border-dark d-none d-md-block"></div>
  		<section class=" row order-md-2 order-0 justify-content-md-start justify-content-center align-items-center col-md-4 offset-1 ">
  		<form id="espaceConnexion">
  			<h2>Se connecter</h2>
			  <div class="form-group">
			    <label for="exampleInputEmail3">Adresse mail</label>
			    <input type="email" class="form-control" id="exampleInputEmail3"  placeholder="adresse mail">
			  </div>
			  
			  <div class="form-group">
			    <label for="exampleInputPassword4">Mot De Passe</label>
			    <input type="password" class="form-control" id="exampleInputPassword4" placeholder="Mot De Passe">
			  </div>
			  <button type="submit" class="btn btn-primary">Se connecter</button>
		</form>
  		</section>
  		<div class="col-1"></div>
  		</div>';
  	}
}