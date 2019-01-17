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
			    <label for="exampleInputPassword1">Mot De Passe <i class="fas fa-question-circle" title="votre mot de passe doit être constitué a minima d\'une minuscule, d\'une majuscule, d\'un chiffre et doit être de longueur 8"></i></label>
			    <input type="password" title="votre mot de passe doit être constitué a minima d\'une minuscule, d\'une majuscule, d\'un chiffre et doit être de longueur 8 " required name="MDPInscription" class="form-control" id="MDPInscription" placeholder="Mot De Passe">
			    
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
			    <label for="mdp">Mot de passe <i class="fas fa-question-circle" title="votre mot de passe doit être constitué a minima d\'une minuscule, d\'une majuscule, d\'un chiffre et doit être de longueur 8"></label>
			    <input type="password" required name="mdp" title="votre mot de passe doit être constitué a minima d\'une minuscule, d\'une majuscule, d\'un chiffre et doit être de longueur 8 " class="form-control" id="mdp"  placeholder="Code...">
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