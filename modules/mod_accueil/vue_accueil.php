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
   			echo "<div class='row '>
  		<section class='border border-dark justify-content-md-start justify-content-lg-center col-md-9'>";
   		}
   
  		else
  			echo "<div class='row justify-content-md-center'>
  		<section class='border border-dark justify-content-md-start justify-content-lg-center col-md-7'>";
  		?>
  		<div class='row justify-content-end'>
  			<button class='btn btn-primary' style='margin-right: 3%'>lala</button>
  		</div>
  			<form id='formulaireDeRecherche'>
  			<div class='form-row justify-content-around' id="formPrincipal">
				    <div class='form-group container col-md-6' id="villeDepartRecherche">
				      <label for='rechercheDepart'>depart</label>
				      <input type='adresse' class='form-control col-12' id='rechercheDepart' placeholder='adresse'  >
				      </div>
				    <div class='form-group col-md-6' id="villeArriveRecherche">
				      <label for='rechercheArrive'>destination</label>
				      <input type='adresse' class='form-control' id='rechercheArrive' placeholder='adresse'>
				    </div>
				</div>
				  
				  <div class='row' id="buttonSubmitAccueil">
				  	<button class='btn btn-secondary mr-auto' id="buttonAgranditForm">+</button>
				  <button type='submit' class='btn btn-primary' style='margin-right: 3%'>Sign in</button>
				  </div>
				  
				</form>
  		</section>
  		</div><?php

   }

   
}