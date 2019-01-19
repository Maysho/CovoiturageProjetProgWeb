<?php
/**
* 
*/
include_once 'vue_generique.php';
class VueAccueil extends VueGenerique
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function affiche($connecte){
   		if ($connecte) {
   			echo "<div class='no-gutters px-0 '>
  		<div id='search_container' class='border border-dark justify-content-md-start justify-content-lg-center col-12'>";
   		}
   
  		else
  			echo "<div class='no-gutters px-0 justify-content-md-center row col'>
  		<div id='search_container' class='border border-dark justify-content-md-start justify-content-lg-center col-md-6'>";
  		?>
  		<div id="divHauteRes2">
  		<div class='row no-gutters justify-content-end'>
  			<a href="index.php?module=mod_trajet"><button class='btn btn-primary buttonRecherche' title="permet d'accéder a la page de proposition de trajet" >Proposer un Trajet</button></a>
  		</div>
  			<form id='formulaireDeRecherche' method="POST" action="index.php?module=mod_resTrajet">
  			<div class='form-row justify-content-around' id="formPrincipal">
				    <div class='form-group container col-md-6' id="villeDepartRecherche">
				      <label for='rechercheDepart'>Départ</label>
				      <input type='adresse' class='form-control col-12' name="depart" id='rechercheDepart' placeholder='Ville de Départ'  >
				      </div>
				    <div class='form-group col-md-6' id="villeArriveRecherche">
				      <label for='rechercheArrive'>Destination</label>
				      <input type='adresse' class='form-control' id='rechercheArrive' name="destination" placeholder="Ville d'Arrivée">
				    </div>
				    <div class="form-group col-md-3 partitAjoute d-none"> 
				    	<label for="inputAddress">Date</label>  
				    	<input type="date" class="form-control" id="inputAddress" name='date'>  
				    	 </div> 
				    	 <div class="form-group col-md-3 partitAjoute d-none">
				    	 	<label for="inputAddress2">Prix</label>    
				    	 	 <input type="number" class="form-control" id="inputAddress2" name="prix" placeholder="Prix Maximal">
				    	 	  </div>  
				    	 	<div class="partitAjoute form-group col-md-2 d-none">  
				    	 	<label for="inputState">Type de Véhicule<i class="fas fa-question-circle" title="Veuillez renseigné la catégorie crit'Air de votre véhicule"></i></label> 
				    	 	<select id="inputState" name="type" class="form-control"> 
				    	 	<option selected>Non Renseigné</option>
				    	 	<option>1</option>
				    	 	<option>2</option>
				    	 	<option>3</option>
				    	 	<option>4</option>
				    	 	<option>5</option>
				    	 	<option>6</option>
				    	 	<option>7</option>
				    	 	</select> 
    	 	                </div>
				    
				</div>
				<div class="no-gutters d-none" id="regulierForm"> 
				    	<div class="form-check"> 
				    		
				    		<input class="form-check-input" name="regulier" type="checkbox" id="gridCheck"> 
				    		<label class="form-check-label" for="gridCheck"> Régulier <i class="fas fa-question-circle" title="Veuillez cocher ce champ pour rechercher un trajet régulié"></i></label>
				    	</div> 
				    </div>
				       
				  
				  <div class='row no-gutters' id="buttonSubmitAccueil">
				  	<button class='btn btn-secondary d-block' id="buttonAgranditForm">+</button>
				  	<div class="mr-auto"></div>
				  <button type='submit' class='btn btn-primary buttonRecherche'>C'est parti!</button>
				  </div>
				  <div class="row no-gutters d-none" id="divbuttonrapetisseform">
				        <button class="btn btn-secondary" id="buttonRapetisseForm">-</button> 
				    </div>
				  
				</form>
  		</div>
  		</div>
  		</div><?php

   }

   
}