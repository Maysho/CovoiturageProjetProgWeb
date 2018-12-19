<?php

/**
* Vue du trajet, Formulaire de trajet avec fenetre modale Vehicule
*/
include_once __DIR__ .'/../../vue_generique.php';
class vue_Trajet extends VueGenerique
{
	
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
		  						<input class="offset-md-2 col-md-4 form-control" type="time" id="heureDepart" value="<?php echo date('h:i') ?>">
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
									<input class="offset-md-2 col-md-4 form-control" type="time" id="heure0" value="<?php echo date('h:i') ?>">
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
								<input class="offset-md-2 col-md-4 form-control" type="time" id="heureArrivee" value="<?php echo date('h:i') ?>">
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
										    <option value="">--Please choose an option--</option>
											<?php 
											foreach ($listeVehicule as $key => $value) {
											?>
												<option value="<?php echo $key ?>"><?php echo $value['immatriculation'] ?> </option>	
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
														<button id="addCar" class="btn btn-primary"> Ajouter </button>
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
	  							<img class="col-md-12 img-thumbnail" alt="Voiture" src="<?php if($listeVehicule[$key]['urlPhoto'] != null) echo $listeVehicule[$key]['urlPhoto']; else echo "/photos/Black.png"; ?>">
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
	public function afficheTrajet($value)
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
						<span>Paris, 89+ dniezo</span>
					</div>
					<div class="row descriptionTxt" >
						<span>Arrive</span>
						<div class="mr-auto"></div>
						<span>Paris, 89+ dniezo</span>
					</div>
					<div class="row descriptionTxt" >
						<span>Date Depart</span>
						<div class="mr-auto"></div>
						<span>15/12/2018</span>
					</div>
					<div class="row descriptionTxt" >
						<span>Date Arrive</span>
						<div class="mr-auto"></div>
						<span>15/12/2018</span>
					</div>
					<div class="row descriptionTxt" >
						<span>Immatriculation</span>
						<div class="mr-auto"></div>
						<span>A156ZEAZEAZEA</span>
					</div>
					<div class="row descriptionTxt" >
						<span>CritAir</span>
						<div class="mr-auto" ></div>
						<span>1</span>
					</div>

				</div>
				<div class="col offset-2">
					<div>
						<img src="home.jpg" class=" col-12" >
					</div>
					<div class="justify-content-center row">
						<button class="btn">button</button>
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
						<img src="home.jpg" class="img-fluid" >
						
				</div>
				<div class="col-8 col-md-10">
					<div class="row descriptionTxt" >
						<span>yolo bonjour</span>
					</div>
					<div class="row descriptionTxt" >
						<span class="col-12">Ce trajet est cool puisque iozerhiofrezh iomvrhezivhj ropimjuvorpeùzjor pveùzjopvreùzojp f,reffffffff,,,,,,, ,,,ffffffffffffffff eiiiiiiiiiiiiiiiii iiiiiiiiiiiii iiiiiiiiiiii</span>
						<span></span>
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
						<div class="col-2 border-dark border" >
							<span>p</span>
						</div>
						<div class="col-2 border-dark border">
							<span>p</span>
						</div>
						<div class="col-2 border-dark border">
							<span>p</span>
						</div>	
					</div>
					<div class="row " >
						<div class="col-4 border-dark border ">
							<div class="bordered ">
								<span> heure</span>
							</div>
						</div>
						<div class="col-2 border-dark border border-bottom-0">
							<img src="home.jpg" class="img-fluid">
						</div>
						<div class="col-2 border-dark border border-bottom-0" >
							<span>passager</span>
						</div>
						<div class="col-2 border-dark border border-bottom-0">
							<span>passager</span>
						</div>
						<div class="col-2 border-dark border border-bottom-0">
							<span>passager</span>
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
				</div>

				
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
				</div>

				<div class="row"> 
				<div class="col-3 col-md-2 offset-md-1 " style="display: inline-block;">
					<img src="home.jpg" class="img-fluid">
				</div>
				<div class="col">
					<span> je suis le commentaire de dfddddddddddd ddddddddddddddd ddddddddddddddd dddddddddddd dddddddddddd ddddddddddddd dddddddddddddd ddddddddddddd ddddddddddd dddddddddddd sssssssssss ssssssssssssssssss ssssssssssssssss ssssssssssss sssssssssss</span>
				</div>	
				</div>

				<div class="row">

				<div class="col-3 col-md-2 offset-md-1">
					<img src="home.jpg" class="img-fluid">
				</div>
				<div class="col">
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