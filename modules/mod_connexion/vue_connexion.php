<?php

/**
* 
*/
include_once 'vue_generique.php';
class vue_connexion extends VueGenerique
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
  	public function pageConnexion($error=0)
  	{
  		echo '<div class="row col-12">

  		<div class="order-md-0 order-2 justify-content-md-start justify-content-lg-center offset-1 col-md-4 ">
  		<h2>S\'inscrire</h2>
  		<form method="POST" id="inscription">
			  <div class="form-group" id="divEmailInscription">
			    <label for="exampleInputEmail1">Adresse mail</label>
			    <input type="email" required name="emailInscription" class="form-control" id="emailInscription"  placeholder="adresse mail">
			  </div>
			  <div class="form-group" id="divConfEmail">
			    <label for="exampleInputEmail2">Confirmation d\'adresse mail</label>
			    <input type="email" required name="confemail" id="confemail" class="form-control"   placeholder="adresse mail">
			  </div >
			  <div class="form-group" id="divNomInscription">
			    <label for="Nom">Nom</label>
			    <input type="text" required name="nomInscription"class="form-control" id="nomInscription"  placeholder="Nom">
			  </div>
			  <div class="form-group" id="divPrenomInscription">
			    <label for="Prenom">Prenom</label>
			    <input type="text" required name="prenomInscription" class="form-control" id="prenomInscription"  placeholder="Prenom">
			  </div>
			  <div class="form-group" id="divMDPInscription">
			    <label for="exampleInputPassword1">Mot De Passe</label>
			    <input type="password" required name="MDPInscription" class="form-control" id="MDPInscription" placeholder="Mot De Passe">
			  </div>
			  <div class="form-group" id="divConfMDPInscription">
			    <label for="exampleInputPassword2">Confirmation De Mot De Passe</label>
			    <input type="password" required name="confMDPInscription" class="form-control" id="confMDPInscription" placeholder="Confirmation De Mot De Passe">
			  </div>
			  <button type="submit"  id="inscriptionbutton" name="submit"  class="btn btn-primary">S\'inscrire</button>
		</form>


  		</div>
  		<div class=" col-0 order-md-1 separation border border-dark d-none d-md-block"></div>
  		<div class=" row order-md-2 order-0 justify-content-md-start justify-content-center align-items-center col-md-4 offset-1 ">
  		<form id="espaceConnexion" method="post" action="index.php?module=mod_connexion&action=verifConnexion">
  			<h2>Se connecter</h2>
			  <div class="form-group">
			    <label for="exampleInputEmail3">Adresse mail</label>
			    <input type="email" class="form-control" id="mailConnexion" name="mailConnexion"  placeholder="adresse mail">
			  </div>
			  
			  <div class="form-group">
			    <label for="exampleInputPassword4">Mot De Passe</label>
			    <input type="password" class="form-control" name="mdpConnexion" id="mdpConnexion" placeholder="Mot De Passe">
			    ';
			  if ($error==1) {
			  	 echo '<small id="warningemaildif" class=" form-text warning"> /!\\ ce champ est incorrect</small>';
			  }
			 echo '
			  </div>
			  <div class="justify-content-md-between container-fluid row">
			  <button type="submit" class="btn btn-primary">Se connecter</button>
			  <a href="index.php?module=mod_connexion&action=AfficheMotDePasseOublier">mot de passe oublier</a>
			  </div>
		</form>
  		</div>
  		<div class="col-1"></div>
  		</div>';
  	}
  	public function pageToken($value)
  	{
  		?>

  		<div class="justify-content-md-start justify-content-lg-center offset-1 col-md-3 ">
  		<h2>Renseigner le code reçu par email</h2>
  		<?php echo '<form method="POST" action="index.php?module=mod_connexion&action=VerifieToken">';?>
			  <div class="form-group" id="divEmailInscription">
			    <label for="emailInscription">Code recu par mail</label>
			    <input type="text" required name="token" class="form-control" id="emailInscription"  placeholder="Code..."><?php 
			    if($value==1)
			    	echo '<small id="warningemaildif" class=" form-text warning"> /!\\ ce champ est incorrect</small>';
			    ?>
			  </div>
			  <div class="justify-content-end row" >
			  <button type="submit" name="submit"  class="btn btn-primary">Verifier</button>
			  </div>
		</form>


  		</div>
  		

<?php
  	}
  	public function affichePageChangementMPD($value,$token)
  	{
  		?>

  		<div class="justify-content-md-start justify-content-lg-center offset-1 col-md-3 ">
  		<h2>Renseigner le nouveau Mot de Passe</h2>
  		<?php echo '<form method="POST" action="index.php?module=mod_connexion&action=VerifieMPD">';?>
			  <div class="form-group" id="divEmailInscription">
			    <label for="mdp">Mot de passe</label>
			    <input type="password" required name="mdp" class="form-control" id="mdp"  placeholder="Code...">
			    <label for="mdpconf">Mot de passe</label>
			    <input type="password" required name="mdpconf" class="form-control" id="mdpconf"  placeholder="Code...">
			    <input type="hidden" name="token" value="<?php echo $token ?>">
			    <?php 
			   
			    if($value==1)
			    	echo '<small id="warningemaildif" class=" form-text warning"> /!\\ un champ est incorrect</small>';
			    ?>
			  </div>
			  <div class="justify-content-end row" >
			  <button type="submit" name="submit"  class="btn btn-primary">Changer</button>
			  </div>
		</form>


  		</div>
  		
<?php
  	}
  	public function motDePasseOublier($value)
  	{
  		?>

  		<div class="justify-content-md-start justify-content-lg-center offset-1 col-md-3 ">
  		<h2>Mot de passe oublier</h2>
  		<form method="GET" action="index.php?module=mod_connexion&action=ChercheMotDePasseOublie">
			  <div class="form-group" id="divEmailInscription">
			    <label for="emailInscription">Renseignez l’adresse e-mail de votre compte :</label>
			    <input type="email" required name="email" class="form-control" id="emailInscription"  placeholder="adresse mail">
			    <input type="hidden" name="module" value="mod_connexion" />
			    <input type="hidden" name="action" value="ChercheMotDePasseOublie" /><?php 
			    if($value==1)
			    	echo '<small id="warningemaildif" class=" form-text warning"> /!\\ ce champ est incorrect</small>';
			    ?>
			  </div>
			  <div class="justify-content-end row" >
			  <button type="submit" name="submit"  class="btn btn-primary">Réinitialiser mon mot de passe </button>
			  </div>
		</form>

  		</div>
  		<?php

  	}
}
?>