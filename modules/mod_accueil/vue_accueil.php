<?php
/**
* 
*/
include_once 'vue_generique.php';
class VueAccueil extends VueGenerique
{
	
	function __construct()
	{
		# code...
	}

	public function affiche($connecte){
   		if ($connecte) {
   			echo "<div class='col-md-8'>
  		<section class='border border-dark justify-content-md-start justify-content-lg-center col-12'>";
   		}
   
  		else
  			echo "<div class='justify-content-md-center col-md-6'>
  		<section class='border border-dark justify-content-md-start justify-content-lg-center col-12'>";
  		?>
  		<div class='row justify-content-end'>
  			<button class='btn btn-primary' style='margin-right: 3%'>lala</button>
  		</div>
  			<form id='formulaireDeRecherche' method="POST" action="index.php?module=mod_resTrajet">
  			<div class='form-row justify-content-around' id="formPrincipal">
				    <div class='form-group container col-md-6' id="villeDepartRecherche">
				      <label for='rechercheDepart'>depart</label>
				      <input type='adresse' class='form-control col-12' name="depart" id='rechercheDepart' placeholder='adresse'  >
				      </div>
				    <div class='form-group col-md-6' id="villeArriveRecherche">
				      <label for='rechercheArrive'>destination</label>
				      <input type='adresse' class='form-control' id='rechercheArrive' name="destination" placeholder='adresse'>
				    </div>
				    <div class="form-group col-md-3 partitAjoute d-none"> 
				    	<label for="inputAddress">date</label>  
				    	<input type="date" class="form-control" id="inputAddress" name='date' placeholder="1234 Main St">  
				    	 </div> 
				    	 <div class="form-group col-md-3 partitAjoute d-none">
				    	 	<label for="inputAddress2">prix</label>    
				    	 	 <input type="number" class="form-control" id="inputAddress2" name="prix" placeholder="prix">
				    	 	  </div>  
				    	 	<div class="partitAjoute form-group col-md-2 d-none">  
				    	 	<label for="inputState">type de vehicule</label> 
				    	 	<select id="inputState" name="type" class="form-control"> 
				    	 	<option selected>Non renseigné</option>
				    	 	<option>1</option>
				    	 	<option>2</option>
				    	 	</select> 
    	 	                </div>
				    
				</div>
				<div class="form-row d-none" id="regulierForm"> 
				    	<div class="form-check"> 
				    		
				    		<input class="form-check-input" name="regulier" type="checkbox" id="gridCheck"> 
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
  		</section>
  		</div><?php

   }

   
}