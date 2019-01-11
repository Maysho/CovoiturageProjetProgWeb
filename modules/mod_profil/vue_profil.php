
<?php
include_once __DIR__ .'/../../vue_generique.php';
	class VueProfil extends VueGenerique{

		function __construct(){
			parent::__construct();
		}

		function accueilProfil($donnerAAfficher, $nbTrajet, $moyenne, $commentaires, $estConnecter, $estPagePerso, $idUser){

			
			echo '<div class="col-md-12">';

		if($estPagePerso){
?>
					<?php self::afficheNavProfil(1,$idUser); ?>
<?php		
		}
?>
					<div class="border border-dark rounded">
						
					
						<div class="row col-auto">
							<div class="col-md-2 order-0 ">
							<?php
		if(isset($donnerAAfficher['urlPhoto'])){
?>
							
								<img class="img-fluid" src="<?php echo $donnerAAfficher['urlPhoto']; ?>" alt="photo de profil">
							
<?php
		}
		else
			echo '				<img class="img-fluid" src="sources/images/photoProfil/default.jpg" alt="photo de profil">';
?>
							</div>
							<div class="row col-md-4 order-2 order-md-1">
								<label class="col-md-12"> Prénom : <?php echo $donnerAAfficher['prenom']; ?> </label>	
								<label class="col-md-12"> Nom : <?php echo $donnerAAfficher['nom']; ?></label>
<?php
		if(isset($donnerAAfficher['dateDeNaissance']))
			echo '					<label class="col-md-12"> Age : '.$donnerAAfficher['dateDeNaissance'].' ans</label>';

		if(isset($donnerAAfficher['sexe']))
			echo '
								<label class="col-md-12">Sexe : '.$donnerAAfficher['sexe'].'</label>';					
?>
							</div>

							<div class="row col-md-4 order-3 order-md-2">
<?php	if($estPagePerso)							
			echo '				<label class="col-md-12">E-mail : '.$donnerAAfficher['adresseMail'].'</label>';
?>								<label class="col-md-12">Nombre de trajets effectués : <?php echo $nbTrajet; ?></label>
								<label class="col-md-12">Note moyenne : <?php if($moyenne!=NULL)echo $moyenne; else echo "Aucune note reçu"; ?></label>
							</div>

<?php	if($estPagePerso){	
			echo '
							<div class=" col-md-2 order-1 order-md-3">
							
								<a class="btn btn-primary btn-profil btn-block col-md-12" href="?module=mod_profil&idprofil='.$idUser.'&ongletprofil=modif" role="button">
									Modifier le profil
								</a>
								<a class="btn btn-primary btn-profil btn-block col-md-12" href="#" data-toggle="modal" data-target="#changementMDPModal" role="button">
									Changer de mot de passe
								</a>
							</div>';
?>
							<!-- Modal -->
							<div class="modal fade" id="changementMDPModal" tabindex="-1" role="dialog" aria-labelledby="changementMDPModalLabel" aria-hidden="true">
							  <div class="modal-dialog" role="document">
							    <div class="modal-content">
							      <div class="modal-header">
							        <h5 class="modal-title" id="changementMDPModalLabel">Modifier le mot de passe</h5>
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							          <span aria-hidden="true">&times;</span>
							        </button>
							      </div>
							      <div class="modal-body">

							      	<form method="POST" class="col-12" id="changeMdpProfil" enctype="multipart/form-data" action="">

										<div class="row form-group">
											<label for="mdpActuel" class="">Mot de passe actuel :</label>
											<input id="mdpActuel" class="form-control" type="password" name="ancienMdp" required="">


		
			                          <p id="msgErreurSaisieMdp" class="form-text warning" ></p>				

										</div>
										<hr>
										<div class="row form-group">
											<label for="nouveauMdp" class="">Nouveau mot de passe :</label>
											<input id="nouveauMdp" data-toggle="conditionsMdp" data-placement="bottom" title="Le mot de passe doit contenir au moins 8 caracteres dont une lettre en minuscule, une lettre majuscule, un chiffre et doit être différent de votre mot de passe actuel" class="form-control" type="password" name="nouveauMdp" required="">
											<p id="msgErreurNouveauMdp" class="form-text warning"></p>
										</div>

										<div class="row form-group">
											<label for="confirmationNouveauMdp" class="">Confimartion mot de passe :</label>
											<input id="confirmationNouveauMdp" class="form-control" type="password" name="nouveauMdpConf" required="">
											<p id="msgErreurConfNouveauMdp" class="form-text warning"></p>
										</div>

									</form>

							      </div>
							      <div class="modal-footer">
							        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
							        <button disabled="" id="boutonModifierMotDePasse" type="submit" class="btn btn-primary" form="changeMdpProfil">Modifier mot de passe</button>
							      </div>
							    </div>
							  </div>
							</div>

<?php
		}
		else if($estConnecter){
?>							
							<div class="col-md-2 order-1 order-md-3">
							<a class="btn btn-primary btn-profil btn-block col-12" href="#" data-toggle="modal" data-target="#envoieMsgModal" role="button">
								Envoyer un message
							</a>
							</div>
							<!-- Modal -->
							<div class="modal fade" id="envoieMsgModal" tabindex="-1" role="dialog" aria-labelledby="envoieMsgModalLabel" aria-hidden="true">
							  <div class="modal-dialog" role="document">
							    <div class="modal-content">
							      <div class="modal-header">
							        <h5 class="modal-title" id="envoieMsgModalLabel">Envoyer un message</h5>
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							          <span aria-hidden="true">&times;</span>
							        </button>
							      </div>
							      <div class="modal-body">

							      	<form method="POST" class="col-12" id="envoyerMessage" enctype="multipart/form-data" action="">

										<textarea id="zoneEnvoieMsgProfil" class="form-control textarea-fixe" rows="3" maxlength="255" form="envoyerMessage" name="message"></textarea>
									</form>

							      </div>
							      <div class="modal-footer">
							        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
<?php			      
							echo "        <button disabled='' id='boutonEnvoieMsgProfil' data-id='$idUser' type='submit' class='btn btn-primary' form='envoyerMessage'>Envoyer</button>";
?>
							      </div>
							    </div>
							  </div>
							</div>
<?php
		}
?>
						</div>
					

					
						<div class="col-md-auto">
							<label class="">Description : </label>
							<div class=" col-md-12 border border-primary rounded">
								<span><?php echo $donnerAAfficher['description']; ?></span>
							</div>
						</div>
					</div>
					
<?php

				for ($i=0; $i < count($commentaires); $i++) { 
					$href = '?module=mod_profil&idprofil='.$commentaires[$i]['idAuteur'].'&ongletprofil=profil';
?>
	   				<div class="border border-dark rounded col-md-12" id="<?php echo $commentaires[$i]['idAuteur'].'Auteur99Trajet'?>">
	   					<div class="row">
	   						<label class="col-md-8">De <a href="<?php echo $href ;?>"><?php echo $commentaires[$i]['prenom'];?></a> le <?php echo $commentaires[$i]['date']; ?></label>
	   						<label class="col-md-4">note : <?php echo $commentaires[$i]['note']; ?></label>
	   					</div>
	   					<div class="row">
	   						<div class="col-md-12">
	   							<span ><?php echo $commentaires[$i]['description']; ?></span>
	   						</div>
	   					</div>
	   					<?php
?>
	   				</div>
<?php	   				
	   			}
?>			
				</div>
				
			</div> 
<?php		
		}



		public function afficheListeFavoris($idUser,$donnees)
		{

?>
	<div class="col-12">
<?php

					 self::afficheNavProfil(2,$idUser);
		
		
?>
					<div class="border border-dark rounded col-12" style="overflow: auto;">
						<table class="table">
							<tr class="">
								<td class=" text-center titreFavoris">Depart</td>
								<td class=" text-center titreFavoris">Destination</td>
								<td class=" text-center titreFavoris">Prix</td>
								<td class=" text-center titreFavoris">Type</td>
								<td class=" text-center titreFavoris">Régulier</td>
							</tr>
						<?php 
							for ($i=0; $i <count($donnees) ; $i++) { 
								$prix=$donnees[$i][4]!='100000'?$donnees[$i][4]:'';
								$regulier=$donnees[$i][6]==1?"oui":'non';
								echo " <tr><td class=' text-center'><a class='liensanscouleur' href='index.php?module=mod_resTrajet&action=afficheFavoris&id=".$donnees[$i][0]."'>".$donnees[$i][2]."</a></td><td class=' text-center'><a class='liensanscouleur' href='index.php?module=mod_resTrajet&action=afficheFavoris&id=".$donnees[$i][0]."'>".$donnees[$i][3]."</a></td><td class=' text-center'><a class='liensanscouleur'  href='index.php?module=mod_resTrajet&action=afficheFavoris&id=".$donnees[$i][0]."'>".$prix."</a></td><td class=' text-center'><a class='liensanscouleur' href='index.php?module=mod_resTrajet&action=afficheFavoris&id=".$donnees[$i][0]."'>".$donnees[$i][5]."</a></td><td class='row justify-content-center'><a class='liensanscouleur' href='index.php?module=mod_resTrajet&action=afficheFavoris&id=".$donnees[$i][0]."'>".$regulier."</a></td><td class=' text-center'><button class='buttonSuppFavoris' data-id='".$donnees[$i][0]."'>X</button></td></tr>";
							}
					
						?>
						
						</table>
	   				</div>
	   				
	   			
	

			</div>
			
<?php		
		}
		

		public function afficheNavProfil($active=1,$idUser)
		{
			?>
			<nav class="navbar navbar-expand-md navbar-dark bg-primary">
					
					    <div class="navbar-nav justify-content-between">
							<a class="nav-item nav-link <?php echo $active==1?'active':''; ?>" href="<?php echo '?module=mod_profil&idprofil='.$idUser.'&ongletprofil=profil'; ?>">Profil</a>
					    	<a class="nav-item nav-link <?php echo $active==2?'active':''; ?>" href="<?php echo '?module=mod_profil&idprofil='.$idUser.'&ongletprofil=favoris'; ?>">Favoris</a>
					    	<a class="nav-item nav-link <?php echo $active==3?'active':''; ?>" href="<?php echo '?module=mod_profil&idprofil='.$idUser.'&ongletprofil=modif'; ?>">Modifier le profil</a>
					    	<a class="nav-item nav-link <?php echo $active==4?'active':''; ?>" href="<?php echo '?module=mod_profil&idprofil='.$idUser.'&ongletprofil=vehicules'; ?>">Liste de véhicule</a>
					    	<a class="nav-item nav-link <?php echo $active==5?'active':''; ?>" href="<?php echo '?module=mod_profil&idprofil='.$idUser.'&ongletprofil=historique'; ?>">Historique</a>
					    	<a class="nav-item nav-link <?php echo $active==6?'active':''; ?>" href="<?php echo '?module=mod_profil&idprofil='.$idUser.'&ongletprofil=trajets'; ?>">Trajets réservés</a>
					    </div>
					
					</nav> <?php
		}
		function modificationDeProfil($idUser, $donnees){
?>

			
				

				<div class="col-12">
					
					<?php self::afficheNavProfil(3,$idUser); ?>
					<section class="border border-dark rounded">
						<form method="POST" class="col-12" id="editProfil" enctype="multipart/form-data" action="<?php echo '?module=mod_profil&idprofil='.$idUser.'&ongletprofil=recupmodif'; ?>">
							<div class="row form-group">
								<label class="col-md-4">Photo de profil (5Mo max): </label><?php
		if(isset($donnees['urlPhoto'])){
?>
							<img class="col-md-4 img-fluid" src="<?php echo $donnees['urlPhoto']; ?>" alt="photo de profil">
<?php
		}
		else
			echo 			'<img class="col-md-4 img-fluid" src="sources/images/photoProfil/default.jpg" alt="photo de profil">';
?>
								<input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
								<input class="col-md-4" type="file" name="photoprofil" >
								<!--<button class="col-md-4 btn btn-primary">Ajouter nouvelle photo</button>-->
							</div>

							<div class="row form-group">
								<label class="col-md-4">Prenom : </label>
								<input class="col-md-4 form-control" type="text" name="prenom" value="<?php echo $donnees['prenom']; ?>">
							</div>

							<div class="row form-group">
								<label class="col-md-4">Nom : </label>
								<input class="col-md-4 form-control" type="text" name="nom" value="<?php echo $donnees['nom']; ?>">
							</div>

							<div class="row form-group">
								<label class="col-md-4">E-mail : </label>
								<input class="col-md-4 form-control" type="email" name="Email" placeholder="Entrez votre nouvel E-mail">
							</div>

							<div class="row form-group">
								<label class="col-md-4">E-mail confirmation : </label>
								<input class="col-md-4 form-control" type="email" name="confirmationEmail" placeholder="Confirmez votre E-mail">
							</div>

							<div class="row form-group">
								<label class="col-md-4">Date de naissance : </label>
								<input class="col-md-4 form-control" type="date" name="datedenaissance" value="<?php echo $donnees['dateDeNaissance']; ?>">
							</div>

							<div class="row form-group">
								<label class="col-md-4">Sexe : </label>
								<div class="col-md-4">
									<div class="row">
										<div class="col-md-6">
											<input type="radio" name="sexe" id="homme" value=1 <?php if(isset($donnees['sexe']) && $donnees['sexe'] == 1) echo 'checked'; ?>>
											<label for="homme">Homme</label>
										</div>
										<div class="col-md-6">
											<input type="radio" name="sexe" id="femme" value=0 <?php if(isset($donnees['sexe']) && $donnees['sexe'] == 0) echo 'checked'; ?>>
											<label for="femme">Femme</label>
										</div>
									</div>	
								</div>
							</div>	

							<div class="row form-group">
								<label class="col-md-4">Description : </label>
								<textarea class="col-md-4 form-control textarea-fixe" rows="10" maxlength="1024" form="editProfil" name="description"><?php echo $donnees['description'];?></textarea>
							</div>

							<button class="btn btn-primary" type="submit" name="submit">Mettre à jour vos données</button>
						</form>

						
					</section>
				</div>
			
<?php
		}


		function afficheListeVehicule($idUser, $donnees){
			?>

				<div id="vehiculeProfil" class="col-md-12">

					<?php self::afficheNavProfil(4,$idUser); ?>
					<div class="border border-dark rounded col-12" style="overflow: auto;">
						<table class="table">
							<thead>
								<tr class="">
									<td class=" text-center titreFavoris">Immatriculation</td>
									<td class=" text-center titreFavoris">Crit'air</td>
									<td class=" text-center titreFavoris">Hybride</td>
									<td class=" text-center titreFavoris">Vehicule</td>
									<td></td>
								</tr>
							</thead>
							<tbody>
							<?php
							foreach ($donnees as $key => $value) {
							?>
							<tr>
								<td class=" text-center ">
									<?php echo $value['immatriculation']?>
								</td>
								<td class=" text-center ">
									<?php echo ($value['critair'] == "6") ? "Non renseigné" : 'Catégorie : '.$value['critair']; ?>
								</td>
								<td class=" text-center ">
									<?php echo ($value['hybride'] == "1") ?  "Oui" :  "Non"?>
								</td>
								<td class=" text-center ">
									<a href="<?php echo $value['urlPhoto']?>">Voir&nbsp<i class="fas fa-search-plus"></i></a>
									<!-- <img id="myImg" src="img_snow.jpg" alt="Snow" style="width:100%;max-width:300px"> -->
									
								</td>
								<td>
									<!-- <button class="btn btn-primary"><i class="fas fa-edit"></i></button> -->
									<button data-id="<?php echo $value['immatriculation']?>" class="btn btn-primary delCar"><i class="fas fa-trash"></i></button>
								</td>
							</tr>
							<?php
							}
							?>
							</tbody>
						</table>
					</div>

					<div class="container">
						<!-- Trigger the modal with a button -->
						<div class="row">
							<div class="">
								<button type="button" class="btn btn-info " data-toggle="modal" data-target="#myModal">Ajouter un Vehicule <i class="fas fa-car"></i></button>		
							</div>
						</div>
						<!-- Modal -->
						<div class="modal fade" id="myModal" role="dialog">
							<div class="modal-dialog modal-lg">
								<!-- Modal content-->
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
									</div>
									<div class="modal-body">
										<h3 class="modal-title text-center">Votre nouveau Vehicule</h3>
										<div class="row form-group offset-md-1">
											<label class="col-md-5" for="immatriculation">Immatriculation</label>
											<input class="col-md-5 form-control" type="text" id="immatriculation" placeholder="AA-000-AA">
										</div>
										<div class="row offset-md-1">
											<label class="col-md-5" for="critair">Crit'air</label>
											<select class="col-md-5 form-control" id="critair">
												<option value="0">Vert (0)</option>
												<option value="1">1</option>
												<option value="2">2</option>
												<option value="3">3</option>
												<option value="4">4</option>
												<option value="5">5</option>
												<option value="6">Je n'ai pas certifié mon véhicule</option>
											</select>
										</div>
										<div class="row offset-md-1">
											<label class="col-md-2" for="hybride">Hybride</label>	
											<div class="row offset-md-5">
												<input type="checkbox" id="hybride" name="hybride">
											</div>
										</div>
										<div class="row offset-md-1">
											<label class="col-md-5" for="photoVehicule">Photo du Vehicule</label>
											<img id="defaultThumb" class="col-md-5 thumb img-fluid"  src="photos/Black.png" alt="Photo du vehicule"/>
											<input type="hidden" id="photoVehicule" name="MAX_FILE_SIZE" value="5000000" />
											<input class="offset-md-5" type="file" id="photoCar" name="photoCar"/>
										</div>
										<div class="text-center">
											<button id="addCar" data-dismiss="modal" class="btn btn-primary"> Ajouter </button>
										</div>
									</div>
									<div class="modal-footer">
										<button class="btn btn-default" data-dismiss="modal">Close</button>
									</div>
								</div>
							</div>
						</div>									  
					</div>
				</div>
<?php 
		}

		function afficheHistorique($idUser, $donnees){
			?>
			<div id="vehiculeProfil">
				<div class="col-md-9">
					<?php self::afficheNavProfil(5,$idUser); ?>
					<div class="border border-dark rounded col-12" style="overflow: auto;">		
						<table class="table">
							<thead>
								<tr class="">
									<td class=" text-center titreFavoris">Date</td>
									<td class=" text-center titreFavoris">Depart</td>
									<td class=" text-center titreFavoris">Arrivee</td>
								</tr>
							</thead>
							<tbody>

								<?php
								foreach ($donnees as $key => $value) {
								?>
								
								<tr>
									<td class="text-center">
										<a class="liensanscouleur" href="index.php?module=mod_trajet&action=afficheTrajet&id=<?php echo $value[0][1]?>">
										<?php echo $value[0][2]?> 
										</a>
										<?php //var_dump($value[0])?>
									</td>
									<td class="text-center">
										<a class="liensanscouleur" href="index.php?module=mod_trajet&action=afficheTrajet&id=<?php echo $value[0][1]?>">
										<?php echo $value[0]['nomVille']?> 
										</a>
									</td>
									<td class="text-center">
										<a class="liensanscouleur" href="index.php?module=mod_trajet&action=afficheTrajet&id=<?php echo $value[0][1]?>">
										<?php echo $value[1]['nomVille']?> 
										</a>
									</td>
								</tr>
								<?php
								}
								?>

								
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<?php
		}

		function afficheTrajetsReserves($idUser, $donnees){
			?>
			<div id="vehiculeProfil">
				<div class="col-md-9">
					<?php self::afficheNavProfil(6,$idUser); ?>
					<div class="border border-dark rounded col-12" style="overflow: auto;">
					<table class="table">
							<thead>
								<tr class="">
									<td class=" text-center titreFavoris">Date</td>
									<td class=" text-center titreFavoris">Depart</td>
									<td class=" text-center titreFavoris">Arrivee</td>
								</tr>
							</thead>
							<tbody>

								<?php
								foreach ($donnees as $key => $value) {
								?>
								<?php
								// var_dump($value[0])
								?>
								<tr>
									<td class="text-center">
										<a class="liensanscouleur" href="index.php?module=mod_trajet&action=afficheTrajet&id=<?php echo $value[0][1]?>">
										<?php echo $value[0][2]?> 
										</a>
									</td>
									<td class="text-center">
										<a class="liensanscouleur" href="index.php?module=mod_trajet&action=afficheTrajet&id=<?php echo $value[0][1]?>">
										<?php echo $value[0]['nomVille']?> 
										</a>
									</td>
									<td class="text-center">
										<a class="liensanscouleur" href="index.php?module=mod_trajet&action=afficheTrajet&id=<?php echo $value[0][1]?>">
										<?php echo $value[1]['nomVille']?> 
										</a>
									</td>
								</tr>
								<?php
								}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<?php
		}
	}
?>