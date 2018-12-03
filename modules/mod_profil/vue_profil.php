<?php

include_once 'vue_generique.php';
	class VueProfil{

		function __construct(){}

		function accueilProfil($donnerAAfficher, $nbTrajet, $moyenne, $commentaires, $estConnecter, $estPagePerso, $idUser){

			
			echo '<div class="row">';
		if($estConnecter)
			echo '	<p class="col-md-3 text-center"> emplacement aside </p>          
		

				
				<div class="col-md-9">';
		else
			echo '<div class="col-md-12">';

		if($estPagePerso){
?>
					<nav class="navbar navbar-expand-md navbar-dark bg-primary">
					
					    <div class="navbar-nav justify-content-between">
					    	<a class="nav-item nav-link active" href="<?php echo '?module=mod_profil&idprofil='.$idUser.'&ongletprofil=profil'; ?>">Profil</a>
					    	<a class="nav-item nav-link" href="<?php echo '?module=mod_profil&idprofil='.$idUser.'&ongletprofil=favoris'; ?>">Favoris</a>
					    	<a class="nav-item nav-link" href="<?php echo '?module=mod_profil&idprofil='.$idUser.'&ongletprofil=modif'; ?>">Modifier le profil</a>
					    	<a class="nav-item nav-link" href="<?php echo '?module=mod_profil&idprofil='.$idUser.'&ongletprofil=vehicules'; ?>">Liste de véhicule</a>
					    	<a class="nav-item nav-link" href="<?php echo '?module=mod_profil&idprofil='.$idUser.'&ongletprofil=historique'; ?>">Historique</a>
					    	<a class="nav-item nav-link" href="<?php echo '?module=mod_profil&idprofil='.$idUser.'&ongletprofil=trajets'; ?>">Trajets réservés</a>
					    </div>
					
					</nav> 
<?php		
		}
?>
					<section class="border border-dark rounded">
						
					
						<div class="row col-auto">
							<img class="col-md-2 order-0 " src="<?php echo $donnerAAfficher['urlPhoto']; ?>" alt="photo de profil">

							<div class="row col-md-4 order-2 order-md-1">
								<label class="col-md-12"> Prénom : <?php echo $donnerAAfficher['prenom']; ?> </label>	
								<label class="col-md-12"> Nom : <?php echo $donnerAAfficher['nom']; ?></label>
<?php
		if(isset($donnerAAfficher['dateDeNaissance']))
			echo '					<label class="col-md-12"> Age : '.$donnerAAfficher['dateDeNaissance'].' ans</label>';
?>
								<label class="col-md-12">Sexe : <?php echo $donnerAAfficher['sexe']; ?></label>						
							</div>

							<div class="row col-md-4 order-3 order-md-2">
<?php	if($estPagePerso)							
			echo '				<label class="col-md-12">E-mail : '.$donnerAAfficher['adresseMail'].'</label>';
?>								<label class="col-md-12">Nombre de trajets effectués : <?php echo $nbTrajet; ?></label>
								<label class="col-md-12">Note moyenne : <?php echo $moyenne; ?></label>
							</div>

<?php	if($estPagePerso)							
			echo '			<a class="col-md-2 order-1 order-md-3" href="?module=mod_profil&idprofil='.$idUser.'&ongletprofil=modif"><button type="button" class="btn 	btn-primary col-md-12">Modifier le profil</button></a>';
?>						</div>
					

					
						<div class="col-md-auto">
							<label class="">Description : </label>
							<label class=" col-md-12 border border-primary rounded"><?php echo $donnerAAfficher['description']; ?></label>
						</div>
							
						
					</section>
					
<?php

				for ($i=0; $i < count($commentaires); $i++) { 

?>
	   				<section class="border border-dark rounded col-md-12">
	   					<div class="row">
	   						<label class="col-md-8">De <?php echo $commentaires[$i]['prenom']; ?> le <?php echo $commentaires[$i]['date']; ?></label>
	   						<label class="col-md-4">note : <?php echo $commentaires[$i]['note']; ?></label>
	   					</div>
	   					<div class="row">
	   						<label class="col-md-12"><?php echo $commentaires[$i]['description']; ?></label>
	   					</div>
	   				</section>
<?php	   				
	   			}
?>			
				</div>
				
			</div> 
<?php		
		}

		function modificationDeProfil($idUser, $donnees){
?>

			<div class="row">
				<p class="col-md-3 text-center"> emplacement aside </p>   

				<div class="col-md-9">
					<nav class="navbar navbar-expand-md navbar-dark bg-primary">
					
					    <div class="navbar-nav justify-content-between">
							<a class="nav-item nav-link" href="<?php echo '?module=mod_profil&idprofil='.$idUser.'&ongletprofil=profil'; ?>">Profil</a>
					    	<a class="nav-item nav-link" href="<?php echo '?module=mod_profil&idprofil='.$idUser.'&ongletprofil=favoris'; ?>">Favoris</a>
					    	<a class="nav-item nav-link active" href="<?php echo '?module=mod_profil&idprofil='.$idUser.'&ongletprofil=modif'; ?>">Modifier le profil</a>
					    	<a class="nav-item nav-link" href="<?php echo '?module=mod_profil&idprofil='.$idUser.'&ongletprofil=vehicules'; ?>">Liste de véhicule</a>
					    	<a class="nav-item nav-link" href="<?php echo '?module=mod_profil&idprofil='.$idUser.'&ongletprofil=historique'; ?>">Historique</a>
					    	<a class="nav-item nav-link" href="<?php echo '?module=mod_profil&idprofil='.$idUser.'&ongletprofil=trajets'; ?>">Trajets réservés</a>
					    </div>
					
					</nav> 

					<section class="border border-dark rounded">
						<form method="POST" id="editProfil">
							<div class="row col-12">
								<label class="col-md-4">Photo de profil : </label>
								<img class="col-md-4" src="<?php echo $donnees['urlPhoto']; ?>" alt="photo de profil">
								<!--<button class="col-md-4 btn btn-primary">Ajouter nouvelle photo</button>-->
							</div>

							<div class="row col-12">
								<label class="col-md-4">Prenom : </label>
								<input class="col-md-4 type="text" name="prenom" value="<?php echo $donnees['prenom']; ?>">
							</div>

							<div class="row col-12">
								<label class="col-md-4">Nom : </label>
								<input class="col-md-4" type="text" name="nom" value="<?php echo $donnees['nom']; ?>">
							</div>

							<div class="row col-12">
								<label class="col-md-4">E-mail : </label>
								<input class="col-md-4" type="email" name="Email" placeholder="Entrez votre nouvel E-mail">
							</div>

							<div class="row col-12">
								<label class="col-md-4">E-mail confirmation : </label>
								<input class="col-md-4" type="email" name="confirmationEmail" placeholder="Confirmez votre E-mail">
							</div>

							<div class="row col-12">
								<label class="col-md-4">Date de naissance : </label>
								<input class="col-md-4" type="date" name="date de naissance" value="<?php echo $donnees['dateDeNaissance']; ?>">
							</div>

							<div class="row col-12">
								<label class="col-md-4">Sexe : </label>
								<div class="col-md-4">
									<div class="row">
										<div class="col-md-6">
											<input type="radio" name="sexe" id="homme" value="homme" <?php if($donnees['sexe'] == 1) echo 'checked'; ?>>
											<label for="homme">Homme</label>
										</div>
										<div class="col-md-6">
											<input type="radio" name="sexe" id="femme" value="femme"<?php if($donnees['sexe'] == 0) echo 'checked'; ?>>
											<label for="femme">Femme</label>
										</div>
									</div>	
								</div>
							</div>	

							<div class="row col-12">
								<label class="col-md-4">Description : </label>
								<textarea class="col-md-4" rows="10" form="editProfil" name="description"><?php echo $donnees['description'];?></textarea>
							</div>

							<input type="submit" name="submit" value="Mettre à jour vos données">
						</form>

						
						

					</section>
				</div>
			</div>
<?php
		}
	}
?>