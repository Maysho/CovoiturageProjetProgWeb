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
						</div > 
						<hr>
		  			</div>
		  			<div class="row">
					    <label><input type="checkbox" name="notificationJoin">Me prévenir lorsqu'un passager s'inscrit au trajet</label>
					</div>
		  			<button id="envoiTrajet" class="btn btn-primary">C'est parti! <i class="fas fa-car-side"></i></button>
	  		</section>
	  	</div>

		<?php
	}
	public function afficheTrajet($value,$infoTrajet,$user,$idS,$tabSt,$tabCom)
	{
		if ($value==1) {
			echo "<div class='row'>";
		}
		else
			echo "<div class='row justify-content-center'>";
		?>
		<h1>Le trajet</h1>
</div>
<?php if ($value==1) {
	echo "<div class='row' >
			<div class='border border-dark col-md-8 row justify-content-between'>";
	}else
		echo "<div class='row justify-content-center' >
			<div class='border border-dark col-md-6 row justify-content-between'>";

		
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
						<span><?php echo $infoTrajet[12]."€";?></span>
						</div>
						<button class="btn" data-id="<?php echo $infoTrajet[13];?> ">button</button>
					</div>
				</div>
				
			</div>

		</div>
		<?php
		if ($value==1) {
			echo "<div class='row' >
			<div class='border border-dark col-md-8 row justify-content-between'>";
		}
		else
			echo "<div class='row justify-content-center' >
			<div class='border border-dark col-md-6 row justify-content-between'>";
		?>
		
				<div class="col-md-2 col-4 row align-items-center">
						<img src="<?php echo empty($infoTrajet[8] )?'home.jpg':$infoTrajet[8];  ?>" class="img-fluid" >
						
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
		var_dump($user);
		var_dump(array_column($user, 'utilisateur_idutilisateur'));
		var_dump(array_column($user, 'sousTrajet_idsousTrajet'));
		$idUtilisateur=array_column($user, 'utilisateur_idutilisateur');
		$idSousTrajets=array_column($user, 'sousTrajet_idsousTrajet');
			if ($value==1) {
				echo "<div class='row' >
			<div class='border border-dark col-md-8 row justify-content-between'>";
			}
			else
				echo "<div class='row justify-content-center' >
			<div class='border border-dark col-md-6 row justify-content-between'>";

		/*while($compteur<$nbSousTrajet) {
			for ($i=0; $i < $infoTrajet[15]; $i++) { 
					$tab=array();
							if (isset($idSousTrajets[$compteur+$i+$trouve])&&$idSousTrajets[$compteur+$i+$trouve]==$idsoustrajet) {
								$val=$compteur+$i+$trouve;
								echo "<span>$idUtilisateur[$val]</span>";
								$suite=$suite+1;
							}
							else {}
							
								# code...
							
						  
						
						
							

						 }$trouve=$suite-1;$compteur=$compteur+1;
						}*/
		?>
		
				<div class="col-12">
			<h2>Itineraire</h2>
			</div>
				<div class="col">
					<div class="row " >
						<div class="col-4 border-dark border">
						<i class="far fa-circle">Nom Arret</i>
						</div>
						<div class="col-2 border-dark border">
							<span>c</span>
						</div>
						

					<?php  $compteur =0; $trouve=0; $nbSousTrajet=($idS[1]-$idS[0])+1; 
					for ($i=1; $i <$infoTrajet[15] ; $i++) { 
					 	# code...
					  ?>
					<div class="col-2 border-dark border" >
							<span>p</span>
						</div>
						
					<?php } echo "</div>";

					while($compteur<$nbSousTrajet) { ?>
			
					<div class="row " >
						<div class="col-4 border-dark border ">
							<div class="bordered ">
								<span> <?php echo $tabSt[$compteur]['heureDepart']?></span>
							</div>
						</div>
						<!-- <div class="col-2 border-dark border border-bottom-0">
							<img src="home.jpg" class="img-fluid">
						</div> -->
						<?php $idsoustrajet=$idS[0]+$compteur;
						$suite=0;
						 for ($i=0; $i < $infoTrajet[15]; $i++) { 
							echo "<div class='col-2 border-dark border border-bottom-0' >";
							if (isset($idSousTrajets[$compteur+$i+$trouve]) && $idSousTrajets[$compteur+$i+$trouve]==$idsoustrajet && isset($idUtilisateur[$compteur+$i+$trouve]) &&$idUtilisateur[$compteur+$i+$trouve]!=$infoTrajet[14]) {
								$val=$compteur+$i+$trouve;
								echo "<span>$idUtilisateur[$val]</span>";
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
						<?php }$trouve=$suite;$compteur=$compteur+1;?>
					</div>
					<div class="row " >
						<div class="col-4 border-dark border">
						<i class="far fa-circle">Nom Arret</i>
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
					}?><!-- 
					<div class="row " >
						<div class="col-4 border-dark border">
							<div class="bordered"">
								<span> heure</span>
							</div>
						</div>
						<div class="col-2 border-dark border border-top-0 border-bottom-0 box" >
						</div>
						<div class="col-2 border-dark border border-top-0 border-bottom-0" >
						</div>
						<div class="col-2 border-dark border border-top-0 border-bottom-0">
						</div>
						<div class="col-2 border-dark border border-top-0 border-bottom-0">
						</div>	
					</div>
					<div class="row " >
						<div class="col-4 border-dark border">
						<i class="far fa-circle">Nom Arret</i>
						</div>
						<div class="col-2 border-dark border border-bottom-0 border-top-0">
						</div>
						<div class="col-2 border-dark border border-bottom-0 border-top-0" >
						</div>
						<div class="col-2 border-dark border border-bottom-0 border-top-0">
						</div>
						<div class="col-2 border-dark border border-bottom-0 border-top-0">
						</div>	
					</div>
					<div class="row " >
						<div class="col-4 border-dark border">
							<div class="bordered" style="margin-left: 7px;height: 100%; padding-bottom: 12.9%;">
								<span> heure</span>
							</div>
						</div>
						<div class="col-2 border-dark border border-top-0 border-bottom-0 box">
						</div>
						<div class="col-2 border-dark border border-top-0 border-bottom-0" >
						</div>
						<div class="col-2 border-dark border border-top-0 border-bottom-0">
						</div>
						<div class="col-2 border-dark border border-top-0 border-bottom-0">
						</div>	
					</div>
					<div class="row " >
						<div class="col-4 border-dark border">
						<i class="far fa-circle">Nom Arret</i>
						</div>
						<div class="col-2 border-dark border border-bottom-0 border-top-0">
						</div>
						<div class="col-2 border-dark border border-bottom-0 border-top-0" >
						</div>
						<div class="col-2 border-dark border border-bottom-0 border-top-0">
						</div>
						<div class="col-2 border-dark border border-bottom-0 border-top-0">
						</div>	
					</div>
					<div class="row " >
						<div class="col-4 border-dark border">
							<div class="bordered" style="margin-left: 7px;height: 100%">
							</div>
						</div>
						<div class="col-2 border-dark border border-top-0">
						</div>
						<div class="col-2 border-dark border border-top-0" >
						</div>
						<div class="col-2 border-dark border border-top-0">
						</div>
						<div class="col-2 border-dark border border-top-0">
						</div>	
					</div>
				</div> -->

				
			</div>

		</div>
		<?php
		if ($value==1) {
			echo "<div class='row'>
			<div class='border border-dark col-md-8 row justify-content-between'>";
		}
		else
			echo "<div class='row justify-content-center'>
			<div class='border border-dark col-md-6 row justify-content-between'>";
		?>
		
				<div class="col-12">
					<h2>Commentaire</h2>
				</div><?php
				for ($i=0; $i < count($tabCom); $i++) { 
					$href = '?module=mod_profil&idprofil='.$tabCom[$i]['idAuteur'].'&ongletprofil=profil';
?>				<div class="row col-12"> 
				<div class="col-3 col-md-2 offset-md-1 " style="display: inline-block;">
					<a href="<?php echo $href ;?>"> <img src="home.jpg" class="img-fluid"></a>
					<label class="">note : <?php echo $tabCom[$i]['note']; ?></label>
				</div>
				<div class="col-7 col-md-9">
					<span><?php echo $tabCom[$i]['description']; ?></span>
				</div>	
				</div>
<?php	   				
	   			}?>
				<div class="row col-12">

				<div class="col-3 col-md-2 offset-md-1">
					<img src="home.jpg" class="img-fluid">
				</div>
				
				<div class="col-7 col-md-9">
					<textarea type="textarea" class="col" form="" name="commentaire" style="resize: none;"> </textarea>
				</div>	
				<div class="col-md-3 col-6 offset-md-9 offset-7">
					<input type="submit" class="col" name="">
				</div>				
				</div>
				</div>


			</div>

		</div>
<?php
}
}