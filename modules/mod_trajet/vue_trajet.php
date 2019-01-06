<?php

/**
* Vue du trajet, Formulaire de trajet avec fenetre modale Vehicule
*/
include_once __DIR__ .'/../../vue_generique.php';
class vue_Trajet extends VueGenerique{
	
	function __construct(){
		parent::__construct();
	}
			public function formCreation($listeVehicule){
				date_default_timezone_set('Europe/Paris');
				?>

				<div class="offset-0 offset-md-2 col-md-8 text-center">
					<section>
						<h2>Je propose un Trajet <i class="fas fa-car"></i> </h2>
						<div>
							<h2 class="text-left">Itinéraire</h2>
							<div class="row">
								<div class="col-md-6"> 
									<div class="text-left form-group" id="departEtape">
										<label for="depart">Je pars de... </label>
										<input type="text"  name="depart" class="form-control ville" id="depart"  placeholder="Ville de Depart">
									</div>

									<div class="text-center form-group container tpl" id="etape" hidden>
										<label for="villeEtape">...En Passant par...</label>
										<div class="form-group row villeEtape" id="villeEtape" >
											<input type="text" id="villeEtape0" class="form-control col-10 nomdeVille ville" placeholder="Ville de Passage">
											<input type="button" class="btn col-2 btnSupprEtape" value="&times;">
										</div>
									</div>								

									<div class="text-right form-group">
										<label for="arrive">... Pour aller à...</label>
										<input type="text" name="arrive" id="arrive" class="form-control ville"  placeholder="Ville d'Arrivée">
									</div >
									<button class="btn btn-info btn-lg" id="btnAjoutEtape" name="btnAjoutEtape">Ajouter une Etape <i class="far fa-flag"></i></button>

									<div class="form-group text-left">
										<label><input type="checkbox" name="regulier" id="regulier">Régulier</label>
									</div>	
								</div>
								<div class="col-md-6"> 
									<img class="col-md-12 img-thumbnail" alt="Map de la France" src="photos/Black.png">
								</div>
							</div>
							<hr>
						</div>
						<div>
							<div class="text-left">
								<h2>Dates et Horaires</h2>
				  					<!-- <div class="row container" >
				  						<h2>Dates et Horaires</h2>
				  						<label>Aller-Retour<input type="checkbox" name="allerRetour"></label>
				  					</div> --> 
				  				</div>
				  				<div class="text-left form-group row" >
				  					<div class="col-md-4 row form-group text-center">
				  						<label class="col-md-5"><i style=" color: green;"class="fab fa-font-awesome-flag"></i> Date de l'aller </label>
				  						<input class="offset-md-1 col-md-5 form-control" type="date" id="dateDepart" value="<?php echo date('Y-m-d') ?>">
				  					</div>

				  					<div class="col-md-3 row form-group text-center">
				  						<label class="col-md-4">Heure <i class="far fa-clock"></i></label>
				  						<input class="offset-md-2 col-md-4 form-control" type="time" id="heureDepart" value="<?php echo date('H:i') ?>">
				  					</div>
				  				</div>
				  				
				  				<div class="text-left form-group" id="checkpoint" hidden>
				  					<div class="form-group row checkpoint" id="checkpoint0" >
				  						<div class="col-md-4 row form-group text-center">
				  							<label class="col-md-5"><i class="fab fa-font-awesome-flag"></i> Date Etape </label>
				  							<input type="date" class="offset-md-1 col-md-5 form-control" id="date0" value="<?php echo date('Y-m-d') ?>">
				  						</div>

				  						<div class="col-md-3 row form-group text-center">
				  							<label class="col-md-4">Heure <i class="far fa-clock"></i></label>
				  							<input class="offset-md-2 col-md-4 form-control" type="time" id="heure0" value="<?php echo date('H:i') ?>">
				  						</div>

				  						<div class="col-md-4 row form-group text-center">
				  							<label class="col-md-4">Prix</label>
				  							<input class="offset-md-1 col-md-2 text-right form-control" id="prix0" value="0">
				  						</div>
				  					</div>
				  				</div> 

				  				<div class="form-group text-left row">
				  					<div class="col-md-4 row form-group text-center">
				  						<label class="col-md-5"><i style=" color: red;" class="fab fa-font-awesome-flag"></i> Date Arrivee </label>
				  						<input type="date" class="offset-md-1 col-md-5 form-control" id="dateArrivee" value="<?php echo date('Y-m-d') ?>">
				  					</div>

				  					<div class="col-md-3 row form-group text-center">
				  						<label class="col-md-4" >Heure <i class="far fa-clock"></i></label>
				  						<input class="offset-md-2 col-md-4 form-control" type="time" id="heureArrivee" value="<?php echo date('H:i') ?>">
				  					</div>

				  					<div class="col-md-4 row form-group text-center">
				  						<label class="col-md-4">Prix</label>
				  						<input class="offset-md-1 col-md-2 text-right form-control" id="prixArrivee" value="0">
				  					</div>
				  				</div> 

				  				<!-- <div class="text-left form-group" hidden>
				  					<label>Date du retour</label>
				  						<input type="date" name="" value="">
				  					<label>Heure</label>
										<input class="col-md-2" type="time" name="soustrajet[][heure]" value="<?php echo date('h:i') ?>">
				  					<label>prix</label>
				  						<input class="col-md-1" name="prix" value="0"	>
				  					</div> -->
				  					<hr>
				  				</div>
				  				<div> 
				  					<h2 class="text-left"> Autres Modalités	</h2>
				  					<div class="row">
				  						<div class="col-md-6"> 
				  							<div class="text-left">
				  								<div class="row">
				  									<label class="col-md-4" for="idVehicule">Mon Vehicule</label>
				  									<select class="offset-md-1 col-md-6 text-center form-control" id="idVehicule">
				  										<?php if(empty($listeVehicule)) {
				  										?>
			  											<option class="voitureSelection" value="-1">--Please choose an option--</option>
				  										<?php
				  										}
				  										 ?>
				  										<?php 
				  										foreach ($listeVehicule as $key => $value) {
				  											?>
			  											<option <?php if($key == 1) echo "selected";?> class="voitureSelection" data-url="<?php echo $value['urlPhoto']?>" value="<?php echo $key ?>"><?php echo $value['immatriculation'] ?> </option>	
				  											<?php
				  										}
				  										?>
				  									</select>
				  								</div>

				  								<div class="row">
				  									<!-- Trigger the modal with a button -->
				  									<button type="button" class="offset-md-5 col-md-6  btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Ajouter un Vehicule <i class="fas fa-car"></i></button>

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
				  															<option value="0">Vert</option>
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
				  														<img id="defaultThumb"class="col-md-5 thumb img-fluid" src="photos/Black.png" alt="Photo du vehicule">
				  														<input type="hidden" id="photoVehicule" name="MAX_FILE_SIZE" value="5000000" />
				  														<input class="offset-md-5" type="file" id="photoCar"name="photoCar">

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


				  								<div class="row">
				  									<label class="col-md-4" for="placeTotale">Nombre de place</label>
				  									<input class="offset-md-1 col-md-6 text-right form-control" type="text"  name="placeTotale"   id="placeTotale"  value="0">
				  								</div>
				  							</div >
				  						</div>
				  						<div class="col-md-6"> 
				  							<img class="col-md-12 img-thumbnail img-fluid" id="imgCar"alt="Voiture" src="photos/Black.png">
				  							<!-- <?php if(isset($listeVehicule[$key]['urlPhoto'])) echo $listeVehicule[$key]['urlPhoto']; else echo "/photos/Black.png"; ?> -->
				  						</div>
				  					</div>
				  					<div class="row">
				  						<div class="col-md-12">
				  							<div class="text-left form-group">
				  								<label for="descriptionTrajet">Detail du voyage</label>
				  								<textarea class="form-control" name="descriptionTrajet" id="descriptionTrajet" rows="4"  placeholder="Description du trajet"></textarea>
				  							</div>
				  						</div>
				  					</div > 
				  					<hr>
				  				</div>
				  				<div class="container row">
				  					<label><input type="checkbox" name="notificationJoin">Me prévenir lorsqu'un passager s'inscrit au trajet</label>
				  				</div>
				  				<button id="envoiTrajet" class="btn btn-primary">C'est parti! <i class="fas fa-car-side"></i></button>
				  			</section>
				  		</div>

				  		<?php
				  	
	}
	public function afficheTrajet($value,$infoTrajet,$user,$idS,$tabSt,$tabCom,$estDansTrajet,$PrixAPayer,$trajetValide,$peutEtreValide,$trajetValidee,$nbPers)
	{
		if ($value>=1) {
			echo "<div class='col-12'><div class='col-md-12'>";
		}
		else
			echo "<div class='col-12 row justify-content-center'> <div class='row col-md-6 justify-content-center'>";
		

			echo "<div class='row col-md-12 justify-content-center'>";
		?>
		<h1>Le trajet</h1>
</div>
<?php if ($value>=1) {
	echo "<div class='col-12' >
			<div class='border border-dark col-12 row justify-content-between'>";
	}else
		echo "<div class='row col-12 justify-content-center' >
			<div class='border border-dark col-12 row justify-content-between'>";

		
			?>
				<div class="col-md-6">
					<div class="row descriptionTxt" >
						<span>Depart</span>
						<div class="mr-auto"></div>
						<span><?php echo $infoTrajet[0];?></span>
					</div>
					<div class="row descriptionTxt" >
						<span>Arrive</span>
						<div class="mr-auto"></div>
						<span><?php echo $infoTrajet[1];?></span>
					</div>
					<div class="row descriptionTxt" >
						<span>Date Depart</span>
						<div class="mr-auto"></div>
						<span><?php echo $infoTrajet[2];?></span>
					</div>
					<div class="row descriptionTxt" >
						<span>Date Arrive</span>
						<div class="mr-auto"></div>
						<span><?php echo $infoTrajet[3];?></span>
					</div>
					<div class="row descriptionTxt" >
						<span>Immatriculation</span>
						<div class="mr-auto"></div>
						<span><?php echo $infoTrajet[4];?></span>
					</div>
					<div class="row descriptionTxt" >
						<span>CritAir</span>
						<div class="mr-auto" ></div>
						<span><?php echo $infoTrajet[5];?></span>
					</div>
					<div class="row descriptionTxt" >
						<span>Hybride</span>
						<div class="mr-auto" ></div>
						<span><?php echo $infoTrajet[6];?></span>
					</div>

				</div>
				<div class="col offset-2">
					<div>
						<img src="<?php echo empty($infoTrajet[7] )?'home.jpg':$infoTrajet[8];?>" alt="photoVehicule" class=" col-12" >
					</div>
					<div class="justify-content-center row">
						<div class="col-12 justify-content-center row">
						<span><?php if($estDansTrajet) echo $PrixAPayer."€";else echo $infoTrajet[12]."€";?></span>
						</div>
						<?php 
						if ($value==0 && !$peutEtreValide) {
							echo '<a href="index.php?module=mod_connexion"><button class="btn"  data-target="#partieInscription" id="sinscrireAuTrajet" data-id=" '.$infoTrajet[13].' ">s\'inscrire au trajet</button></a>';
						}else {
							if ($trajetValidee) {
								# code...
							}

							else if ($estDansTrajet && !$peutEtreValide && $value!=$infoTrajet[14]) {
								echo '<button class="btn" id="desinscriptionAuTrajet" data-id="'.$infoTrajet[13].'">se desinscrire du trajet</button>';
							}
							else if (!$estDansTrajet && $peutEtreValide) {
								# code...
							}
							else if($peutEtreValide){
								echo '<button class="btn" id="validationAuTrajet" data-id="'.$infoTrajet[13].'">valider ce trajet</button>';
							}
							else if ($value==$infoTrajet[14] && $nbPers<=1) {
								echo '<button class="btn" id="retirerTrajet" data-id="'.$infoTrajet[13].'">retirer ce trajet</button>';
							}
							else{
								echo '<button class="btn" data-toggle="modal" data-target="#partieInscription" id="sinscrireAuTrajet" data-id="'.$infoTrajet[13].'">s\'inscrire au trajet</button>';
							}
						}
?>
					</div>
				</div>
				
			</div>

		</div>


		<div class="modal" id="partieInscription">
			<div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h4 class="modal-title">Choisissez votre trajet</h4>
			        <button type="button" class="close" data-dismiss="modal">
			          <span>&times;</span>
			        </button>            
			      </div>
			      <form method="GET" action="#" id="envoieInscriptionTrajet" data-nbPlace="<?php echo count($tabSt) ?>">
			      <div class="modal-body" id="bodyInscriptionTrajet">
			        <?php
			        
			        //var_dump($tabSt);
			        
			         
			        for ($i=0; $i <count($tabSt) ; $i++) { 
                        if ($i==(count($tabSt)-1)) {
                        	echo '<div class="row"><div class="col-6">';
                        }
                        else
                        	echo '<div class="row"><div class="col-6 border border-top-0 border-right-0 border-left-0 border-dark">';
                        if($i==0){
                        echo '<label for="st'.$i.'" >'.$tabSt[$i][12].'</label></div><div class="row col-6 align-items-center"></div></div><div class="row"><div class="col-6 border border-top-0 border-right-0 border-left-0 border-dark">';
                        }
                        
                        	echo '<label for="st'.$i.'" >'.$tabSt[$i][35].'</label></div><div class="row col-6 align-items-top"><input type="checkbox" n id="st'.$i.'" data-idVille="'.$tabSt[$i][34].'" value='.$i.' data-prix="'.$tabSt[$i][8].'" class="checkerInscription checkermed"></div></div>';
                    }

			        ?>
			        <div class="row justify-content-end">
			        <span id="prixInscription">0</span><span>€</span>
			        </div>
			      </div>
			      <div class="modal-footer justify-content-between">
			        <button type="button" class="btn btn-primary" data-dismiss="modal">Fermer</button>
			        <input type="submit" name="envoie" class="btn" value="Valider" id="envoieInscription">
			      </div>
			  </form>
			    </div>
			  </div>
		</div>

		<?php
		if ($value>=1) {
			echo "<div class='col-12' >
			<div class='border border-dark col-12 row justify-content-between'>";
		}
		else
			echo "<div class='row col-12 justify-content-center' >
			<div class='border border-dark col-12 row justify-content-between'>";
		?>
		
				<div class="col-md-2 col-4 row align-items-center">
					<?php $lien='?module=mod_profil&idprofil='.$infoTrajet[14].'&ongletprofil=profil'?>
						<a href="<?php echo $lien; ?>"><img src="<?php echo empty($infoTrajet[8] )?'home.jpg':$infoTrajet[8];  ?>" class="img-fluid" ></a>
						
				</div>
				<div class="col-8 col-md-10">
					<div class="row descriptionTxt" >
						<span><?php echo $infoTrajet[9]." "; echo $infoTrajet[10];?></span>
					</div>
					<div class="row descriptionTxt" >
						<span class="col-12"><?php echo $infoTrajet[11];?></span>
						<span></span>
					</div>
				</div>

				
			</div>

		</div>
		<?php
		/*var_dump($user);
		var_dump(array_column($user, 'utilisateur_idutilisateur'));
		var_dump(array_column($user, 'sousTrajet_idsousTrajet'));*/
		$idUtilisateur=array_column($user, 'utilisateur_idutilisateur');
		$idSousTrajets=array_column($user, 'sousTrajet_idsousTrajet');
			if ($value>=1) {
				echo "<div class='col-12' >
			<div class='border border-dark col-12 row justify-content-between'>";
			}
			else
				echo "<div class='row col-12 justify-content-center' >
			<div class='border border-dark col-12 row justify-content-between'>";


		?>
		
				<div class="col-12">
			<h2>Itineraire</h2>
			</div>
				<div class="col">
					<div class="row " >
						<div class="col-4 border-dark border row justify-content-between detailTrajet">
						<i class="far fa-circle"><?php  echo $tabSt[0][12]?></i>
						<span> <?php echo self::afficheHeure($tabSt[0]['heureDepart'])?></span>
						</div>
						<div class="col-2 border-dark border">
							<!-- <span>c</span> -->
						</div>
						

					<?php  $compteur =0; $trouve=0; $nbSousTrajet=($idS[1]-$idS[0])+1; 
					for ($i=1; $i <$infoTrajet[15] ; $i++) { 
					 	# code...
					  ?>
					<div class="col-2 border-dark border" >
							<!-- <span>p</span> -->
						</div>
						
					<?php } echo "</div>";

					while($compteur<$nbSousTrajet) { ?>
			
					<div class="row " >
						<div class="col-4 border-dark border ">
							<div class="bordered ">
								
							</div>
						</div>
						<!-- <div class="col-2 border-dark border border-bottom-0">
							<img src="home.jpg" class="img-fluid">
						</div> -->
						<?php $idsoustrajet=$idS[0]+$compteur;
						$suite=0;
						 for ($i=0; $i < $infoTrajet[15]; $i++) { 
							echo "<div class='col-2 border-dark border border-bottom-0' >";
							$val=$compteur+$i+$trouve;
							if (isset($idSousTrajets[$compteur+$i+$trouve]) && $idSousTrajets[$compteur+$i+$trouve]==$idsoustrajet && isset($idUtilisateur[$compteur+$i+$trouve]) &&$idUtilisateur[$compteur+$i+$trouve]!=$infoTrajet[14]) {
								$val=$compteur+$i+$trouve;
								echo "<span>$idUtilisateur[$val] </span>";
								$suite=$suite+1;
							}
							else if (isset($idSousTrajets[$compteur+$i+$trouve]) && $idSousTrajets[$compteur+$i+$trouve]==$idsoustrajet &&isset($idUtilisateur[$compteur+$i+$trouve]) &&$idUtilisateur[$compteur+$i+$trouve]==$infoTrajet[14]) {
								echo "<img src='home.jpg' class='img-fluid'>";
							}
							else{
								//echo $trouve.", ".$compteur.", ".$i ;
							}
							
						  ?>
						
						
							
						</div>
						<?php }$trouve=$trouve+$suite;$compteur=$compteur+1;
						?>

					</div>
					<div class="row " >
						<div class="col-4 border-dark border row justify-content-between detailTrajet">
						<i class="far fa-circle"><?php echo $tabSt[$compteur-1][35]?></i>
						<span> <?php echo self::afficheHeure($tabSt[$compteur-1]['heureArrivee'])?></span>
						</div>
						<div class="col-2 border-dark border border-bottom-0 border-top-0">
						</div>
						<?php
						for ($i=1; $i <$infoTrajet[15] ; $i++) { 
					 	# code...
					  ?>
						<div class="col-2 border-dark border border-bottom-0 border-top-0" >
						</div>

						
					<?php } ?>
						
						
					</div>
					<?php  

							
					}?>

				
			</div>
		</div>
		</div>
		<?php 
		if ($trajetValide) {
		
		if ($value>=1) {
			echo "<div class=' col-12'>
			<div class='border border-dark col-12 row justify-content-between'>";
		}
		else
			echo "<div class='row col-12 justify-content-center'>
			<div class='border border-dark col-12 row justify-content-between'>";
		?>
		
				<div class="col-12">
					<h2>Commentaire</h2>
				</div><div id="espaceCommentaire"><?php
				for ($i=0; $i < count($tabCom); $i++) { 
					$href = '?module=mod_profil&idprofil='.$tabCom[$i]['idAuteur'].'&ongletprofil=profil';
?>				<div class="row col-12" > 
				<div class="col-3 col-md-2 offset-md-1 " style="display: inline-block;">
					<a href="<?php echo $href ;?>"> <img src="home.jpg" class="img-fluid"></a>
					<label class="">note : <?php echo $tabCom[$i]['note']; ?></label>
				</div>
				<?php if ($tabCom[$i]['idAuteur']!=$value) {
					
				?>
				<div class="col-8 col-md-9">
					<span><?php echo $tabCom[$i]['description']; ?></span>
				</div>	
				<?php } else{?>
				<div class="col-7 col-md-8">
					<span><?php echo $tabCom[$i]['description']; ?></span>
				</div>
				<div class="col-1">
					<a class="nav-link dropdown-toggle" href="#" id="dropcom" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">

			        
					<i class="fas fa-bars"></i>
					</a>
					<div class="dropdown-menu col-1" aria-labelledby="dropdownMenuButton">
					    <a class="dropdown-item " id="supprimerCom" href="#">supprimer</a>

					  </div>
				</div>
			<?php }?>
				</div>
<?php	   				
	   			}?>
	   		</div>
	   		<?php if ($estDansTrajet) {
	   			# code...
	   		?>
				<form method="POST" action="" id="formCommentairePageTrajet" class="row col-12">

				<div class="col-3 col-md-2 offset-md-1">
					<img src="home.jpg" class="img-fluid">
				</div>
				
				<div class="col-8 col-md-9">
					<textarea type="textarea" class="col" form="formCommentairePageTrajet" name="commentaire" id="contenuCom"style="resize: none;"> </textarea>
				</div>
				<div class="col-3 col-md-3 offset-md-1">
					<label  for="note">note:</label>
					<input class ="col-12 col-md-6" type="text" id="note" name="note">
				</div>	
				<input type="hidden" name="idTrajet" value="<?php echo $infoTrajet['13']  ?>">
				<div class="col-md-3 col-6 offset-md-9 offset-7">
					<input type="submit" class="col" name="submit">
				</div>				
				</form>
			<?php }?>
				</div>


			</div>

		</div>
	</div>
</div>
<?php
	}
}
	public function afficheHeure($heureAvecSec)
	{
		$heure=explode(':', $heureAvecSec);
		return " ".$heure[0].':'.$heure[1];
	}

}