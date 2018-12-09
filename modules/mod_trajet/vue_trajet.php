<?php

/**
* 
*/
include_once __DIR__ .'/../../vue_generique.php';
class vue_Trajet extends VueGenerique
{
	
	function __construct(){
		parent::__construct();
	}
	public function formCreation(){
		date_default_timezone_set('Europe/Paris');
		?>

		<div class="offset-0 offset-md-2 col-md-8 text-center">
	  		<section>
	  			<h2>Je propose un Trajet</h2>
		  			<div>
		  				<h2 class="text-left">Itinéraire</h2>
		  				<div class="row">
			  				<div class="col-md-6"> 
			  					<div class="text-left form-group" id="departEtape">
								    <label for="depart">Je pars de... </label>
								    <input type="text"  name="depart" class="form-control" id="depart"  placeholder="Ville de Depart">
								</div>
								
								<div class="text-center form-group container tpl" id="etape" hidden>
								    <label for="villeEtape">...En Passant par...</label>
								    <div class="form-group row villeEtape" id="villeEtape" >
									    <input type="text" id="villeEtape0" class="form-control col-11 nomdeVille" placeholder="Ville de Passage" value="">
										<input type="button" class="btn col-1 btnSupprEtape" value="x">
								    </div>
								</div>								

								<div class="text-right form-group">
								    <label for="arrive">... Pour aller à...</label>
								    <input type="text" name="arrive" id="arrive" class="form-control"  placeholder="Ville d'Arrivée">
								</div >
								<input type="button" class="btn-group" id="btnAjoutEtape" value="Ajouter une Etape" name="btnAjoutEtape">
								
								<div class="form-group text-left">
									<label>Frequence :</label>
								    <label class="offset-1"><input type="radio" name="regulier" id="regulier" checked>Occasionnel</label>
								    <label class="offset-1"><input type="radio" name="regulier" id="regulier">Régulier</label>
								</div>	
							</div>
			  				<div class="col-md-6"> 
			  					<img alt="Map de la France" src="photos/Black.png">
			  				</div>
		  				</div>
		  				<hr>
		  			</div>
		  			<div>
		  				<div class="text-left">
		  					<div class="row container">
		  						<h2>Dates et Horaires</h2>
		  						<label>Aller-Retour<input type="checkbox" name="allerRetour"></label>
		  					</div>
		  				</div>
		  				<div class="text-left form-group " >
		  					<label>Date de l'aller</label>
		  						<input type="date" id="dateDepart" value="<?php echo date('Y-m-d') ?>">
		  					<label>Heure</label>
		  						<input class="col-md-2" type="time" id="heureDepart" value="<?php echo date('h:i') ?>">
		  				</div>
		  				
						<div class="text-left form-group" id="checkpoint" hidden>
		  					<div class="form-group" id="checkpoint1" >
		  						<label>Date Etape</label>
			  						<input type="date" id="date0" value="<?php echo date('Y-m-d') ?>">
			  					<label>Heure</label>
									<input class="col-md-2" type="time" id="heure0" value="<?php echo date('h:i') ?>">
			  					<label>prix</label>
			  						<input class="col-md-1" type="" id="prix0" value="0">
		  					</div>
		  				</div> 

		  				<div class="text-left form-group">
		  					<label>Date Arrivee</label>
		  						<input type="date" id="dateArrivee" value="<?php echo date('Y-m-d') ?>">
		  					<label>Heure</label>
								<input class="col-md-2" type="time" id="heureArrivee" value="<?php echo date('h:i') ?>">
		  					<label>prix</label>
		  						<input class="col-md-1" id="prixArrivee" value="0">
		  				</div> 

		  				<!-- <div class="text-left form-group" hidden>
		  					<label>Date du retour</label>
		  						<input type="date" name="" value="">
		  					<label>Heure</label>
								<input class="col-md-2" type="time" name="soustrajet[][heure]" value="<?php echo date('h:i') ?>">
		  					<label>prix</label>
		  						<input class="col-md-1" name="prix" value="0">
		  				</div> -->
		  				<hr>
		  			</div>
		  			<div> 
		  				<h2 class="text-left"> Autres Modalités	</h2>
		  				<div class="row">
			  				<div class="col-md-6"> 
			  					<div class="text-left form-group">
			  						<div class="row">
									    <label class="col-md-4" for="idVehicule">Mon Vehicule</label>
									    <!-- <input class="offset-1 col-md-6 form-control" type="text"  name=""  id="emailInscription"  placeholder="Ajouter un Vehicule"> -->
									    
										<select class="offset-1 col-md-6 form-control" id="idVehicule">
										    <option value="">--Please choose an option--</option>
										    <option value="">Ajouter Un Véhicule</option>
										    <option value="1">Ajouter Un Véhicule</option>
										</select>

									</div>
								    <div class="row">
									    <label class="col-md-4" for="placeTotale">Nombre de place</label>
									    <input class="offset-1 col-md-6 form-control" type="text"  name="placeTotale"   id="placeTotale"  placeholder="0">
									</div>
								</div >
							</div>
			  				<div class="col-md-6"> 
	  							<img alt="Voiture" src="photos/Black.png">
	  						</div>
		  				</div>
		  				<div class="row">
		  					<div class="col-md-12">
			  					<div class="text-left form-group">
								    <label  for="">Detail du voyage</label>
								    <textarea class="form-control" name="descriptionTrajet" id="descriptionTrajet" rows="4"  placeholder="Description"></textarea>
								</div>
							</div>
						</div > 
						<hr>
		  			</div>
		  			<div class="row">
					    <label><input type="checkbox" name="notificationJoin">Me prévenir lorsqu'un passager s'inscrit au trajet</label>
					</div>
		  			<button id="envoiTrajet" class="btn btn-primary">C'est parti!</button>
	  		</section>
	  	</div>

		<?php
	}
}
?>