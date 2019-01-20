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
		?>
		<div class="row col-12">
			<div class="order-md-0 order-2 justify-content-md-start justify-content-lg-center offset-1 col-md-4 inscription_panel">
				<h2 class="text-center" >S'inscrire</h2>
					<form class=""method="POST" id="inscription">
						<div class="form-group" id="divEmailInscription">
							<label for="exampleInputEmail1">Adresse Mail</label>
							<input type="email" required name="emailInscription" class="form-control" id="emailInscription"  placeholder="Adresse Mail (ex: hishirobestgrill@relife.com)">
						</div>
						<div class="form-group" id="divConfEmail">
							<label for="exampleInputEmail2">Confirmation d'Adresse Mail</label>
							<input type="email" required name="confemail" id="confemail" class="form-control"   placeholder="Adresse Mail (ex: hishirobestgrill@relife.com)">
						</div >
						<div class="form-group" id="divNomInscription">
							<label for="Nom">Nom</label>
							<input type="text" required name="nomInscription" class="form-control" id="nomInscription"  placeholder="Nom (ex: Monkey D.)">
						</div>
						<div class="form-group" id="divPrenomInscription">
							<label for="Prenom">Prénom</label>
							<input type="text" required name="prenomInscription" class="form-control" id="prenomInscription"  placeholder="Prénom (ex: Luffy)">
						</div>
						<div class="form-group" id="divMDPInscription">
							<label for="exampleInputPassword1">Mot De Passe <i class="fas fa-question-circle" title="Doit faire au moins 8 caractères, 1 Majuscule, 1 Minuscule et 1 chiffre"></i></label>
							<input type="password" title="Doit faire au moins 8 caractères, 1 Majuscule, 1 Minuscule et 1 chiffre" required name="MDPInscription" class="form-control" id="MDPInscription" placeholder="Mot De Passe (ex: ********)">
						</div>
						<div class="form-group" id="divConfMDPInscription">
							<label for="exampleInputPassword2">Confirmation De Mot De Passe</label>
							<input type="password" required name="confMDPInscription" class="form-control" id="confMDPInscription" placeholder="Confirmation De Mot De Passe (ex: ********)">
						</div>
						<div class="row justify-content-center">
							<button type="submit"  id="inscriptionbutton" name="submit" class="buttonInscription btn btn-primary">S'inscrire</button>	
						</div>
					</form>
				</div>
				<div class="col-0 order-md-1 separation  d-none d-md-block"></div>
				<div class="row order-md-2 order-0 justify-content-md-start justify-content-center align-items-center col-md-4 offset-1">
					<form id="espaceConnexion" class="inscription_panel" method="post" action="index.php?module=mod_connexion&action=verifConnexion">
						<h2 class="text-center">Se Connecter</h2>
						<div class="form-group">
							<label for="exampleInputEmail3">Adresse Mail</label>
							<i class="fas fa-user"></i>
							<input type="email" class="form-control" id="mailConnexion" name="mailConnexion"  placeholder=" <i class="fas fa-user"></i> Adresse Mail (ex: songoku@dbz.com)">
						</div>
						<div class="form-group">
							<label for="exampleInputPassword4">Mot De Passe</label>
							<i class="fas fa-lock"></i>
							<input type="password" class="form-control" name="mdpConnexion" id="mdpConnexion" placeholder="Mot De Passe (ex: ********)">
							<?php
							if ($error==1) {
							?>
							<small id="warningemaildif" class=" form-text warning"> <i class="fas fa-exclamation-triangle"></i> Ce champ est incorrect</small>
							<?php
							} 
							?>
						</div>
						<div class="row justify-content-center">
							<div class="col-12 row justify-content-center">
								<button type="submit" class="btn btn-primary buttonInscription">Se connecter</button>
							</div>
							<div class="col-12 row justify-content-center">
								<a href="index.php?module=mod_connexion&action=AfficheMotDePasseOublier">Mot de passe oublié</a>	
							</div>	
						</div>
					</form>
				</div>
				<div class="col-1"></div>
			</div>
		<?php
	}
	public function pageToken($value)
	{
	?>
		<div class="justify-content-md-start justify-content-lg-center offset-1 col-md-3 ">
			<h2>Veuillez renseigner le code reçu par email</h2>
		<?php echo '<form method="POST" action="index.php?module=mod_connexion&action=VerifieToken">';?>
				<div class="form-group" id="divEmailInscription">
					<label for="emailInscription">Code recu par mail</label>
					<input type="text" required name="token" class="form-control" id="emailInscription"  placeholder="Code..."><?php 
					if($value==1)
						echo '<small id="warningemaildif" class=" form-text warning"> <i class="fas fa-exclamation-triangle"> Ce champ est Incorrect</small>';
					?>
				</div>
				<div class="justify-content-end row" >
					<button type="submit" name="submit"  class="btn btn-primary buttonInscription">Vérifier</button>
				</div>
			</form>
		</div>
<?php
	}
	public function affichePageChangementMPD($value,$token)
	{
		?>
		<div class="justify-content-md-start justify-content-lg-center offset-1 col-md-3 ">
			<h2>Veuillez renseigner le nouveau Mot de Passe</h2>
		<?php echo '<form method="POST" action="index.php?module=mod_connexion&action=VerifieMPD">';?>
					<div class="form-group" id="divEmailInscription">
						<label for="mdp">Mot de passe <i class="fas fa-question-circle" title="Doit faire au moins 8 caractères, 1 Majuscule, 1 Minuscule et 1 chiffre"></label>
						<input type="password" required name="mdp" title="Doit faire au moins 8 caractères, 1 Majuscule, 1 Minuscule et 1 chiffre" class="form-control" id="mdp"  placeholder="Mot De Passe (ex: ********)">
						<label for="mdpconf">Mot de passe</label>
						<input type="password" required name="mdpconf" class="form-control" id="mdpconf"  placeholder="Mot De Passe (ex: ********)">
						<input type="hidden" name="token" value="<?php echo $token ?>">
						<?php 
						if($value==1)
							echo '<small id="warningemaildif" class=" form-text warning"> <i class="fas fa-exclamation-triangle"> Champ incorrect</small>';
						?>
					</div>
					<div class="justify-content-end row" >
						<button type="submit" name="submit"  class="btn btn-primary buttonInscription">Changer de mot de passe</button>
					</div>
			</form>
		</div>
		
<?php
	}
	public function motDePasseOublier($value)
	{
		?>
		<div class="justify-content-md-start justify-content-lg-center offset-1 col-md-3 ">
			<h2>Mot de passe oublié</h2>
				<form method="GET" action="index.php?module=mod_connexion&action=ChercheMotDePasseOublie">
					<div class="form-group" id="divEmailInscription">
						<label for="emailInscription">Veuillez renseigner l’adresse e-mail de votre compte :</label>
						<input type="email" required name="email" class="form-control" id="emailInscription"  placeholder="Adresse Mail (ex: monkeydluff@onepiece.com)">
						<input type="hidden" name="module" value="mod_connexion" />
						<input type="hidden" name="action" value="ChercheMotDePasseOublie" /><?php 
						if($value==1)
							echo '<small id="warningemaildif" class=" form-text warning"> <i class="fas fa-exclamation-triangle"> Champs incorrect</small>';
						?>
					</div>
					<div class="justify-content-end row" >
						<button type="submit" name="submit"  class="btn btn-primary buttonInscription">Réinitialiser mon mot de passe </button>
					</div>
				</form>
			</div>
		<?php
	}
}
?>