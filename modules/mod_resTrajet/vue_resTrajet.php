<?php

/**
* 
*/
include_once 'vue_generique.php';
class vue_resTrajet extends VueGenerique
{
	
	function __construct()
	{
		parent::__construct();
	}
	public function affichePage($value=-1,$tab1)
	{
		?>
		
  		<?php
  		if ($value==1) {

  			echo "<div class='row'><div class=' col-md-8 row justify-content-md-center border border-dark'>";
  		}
  		else
  			echo "<div class='row justify-content-md-center'> <div class=' col-md-6 row justify-content-md-center border border-dark'>";
  		?>
  			<form id='formulaireDeRecherche' class="col-12">
  			<div class='form-row justify-content-around' id="formPrincipal" >
				    <div class='form-group container col-md-6' id="villeDepartRecherche">
				      <label for='rechercheDepart'>depart</label>
				      <input type='adresse' class='form-control col-12' id='rechercheDepart' placeholder='adresse'  >
				      </div>
				    <div class='form-group col-md-6' id="villeArriveRecherche">
				      <label for='rechercheArrive'>destination</label>
				      <input type='adresse' class='form-control' id='rechercheArrive' placeholder='adresse'>
				    </div>
				    <div class="form-group col-md-3 partitAjoute d-none"> 
				    	<label for="inputAddress">date</label>  
				    	<input type="date" class="form-control" id="inputAddress" placeholder="1234 Main St">  
				    	 </div> 
				    	 <div class="form-group col-md-3 partitAjoute d-none">
				    	 	<label for="inputAddress2">prix</label>    
				    	 	 <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
				    	 	  </div>  
				    	 	<div class="partitAjoute form-group col-md-2 d-none">  
				    	 	<label for="inputState">type de vehicule</label> 
				    	 	<select id="inputState" class="form-control"> 
				    	 	<option selected>1</option>
				    	 	<option>2</option>
				    	 	</select> 
    	 	                </div>
				    
				</div>
				<div class="form-row d-none" id="regulierForm"> 
				    	<div class="form-check"> 
				    		<input class="form-check-input" type="checkbox" id="gridCheck"> 
				    		<label class="form-check-label" for="gridCheck"> regulier </label>
				    	</div> 
				    </div>
				       
				  
				  <div class='row' id="buttonSubmitAccueil">
				  	<button class='btn btn-secondary d-block' id="buttonAgranditForm">+</button>
				  	<div class="mr-auto"></div>
				  <button type='submit' class='btn btn-primary' style='margin-right: 3%'>Sign in</button>
				  </div>
				  <div class="row d-none" id="divbuttonrapetisseform">
				        <button class="btn btn-secondary" id="buttonRapetisseForm">-</button> 
				    </div>
				  
				</form>
	  		</div>
  		</div>
  		<?php
  		while($donnee = $tab1->fetch()) // on effectue une boucle pour obtenir les données
		{
		    //array_push($array, $donnee['nomVille']." ".$donnee['codePostal']); // et on ajoute celles-ci à notre tableau
		
  		if ($value==1) {

  			echo "<div class='row'>
	  		<div class='row border border-dark justify-content-md-between col-md-8'>";
  		}
  		else
  			echo "<div class='row justify-content-md-center'> <div class=' row border border-dark justify-content-md-between col-md-6'>";
  		?>
  		
	  			<div class="col-md-2">
	  				<img src="home.jpg" style="width: 100px;">
	  				<span class="">nom chauffeur</span>
	  			</div>
	  			<div class="col-md-6 row offset-1" >
	  				<span class="align-top">fjiroefieo</span>
	  				<div class="align-items-end row container">
	  				<span class="align-bottom" style="padding-right: 3px;">fjiroefidezdezd ezdzezedeo</span>
	  				</div>
	  			</div>
	  			<div class="col-md-2 row offset-1 justify-content-end ">
	  				<span class="align-top">90 €</span>
	  				<div class="align-items-end row container">
	  				<span class="align-bottom">place dispo</span>
	  				</div>
	  			</div>
	  			
	  		</div>

  		</div>
  		</div>
  		<?php }
	}
}