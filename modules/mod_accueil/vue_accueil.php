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
  		echo "
  		<div class='row justify-content-end'>
  			<button class='btn btn-primary' style='margin-right: 3%'>lala</button>
  		</div>
  			<form id='formulaireDeRecherche'>
  			<div class='form-row justify-content-around'>
				    <div class='form-group col-md-6'>
				      <label for='inputEmail4'>depart</label>
				      <input type='adresse' class='form-control' id='inputEmail4' placeholder='adresse'>
				      </div>
				    <div class='form-group col-md-6'>
				      <label for='inputPassword4'>destination</label>
				      <input type='adresse' class='form-control' id='inputPassword4' placeholder='adresse'>
				    </div>
				</div>
				  
				  <div class='row'>
				  	<button class='btn btn-secondary mr-auto' onclick='agranditForm()'>+</button>
				  <button type='submit' class='btn btn-primary' style='margin-right: 3%'>Sign in</button>
				  </div>
				  
				</form>
  		</section>
  		</div>";

   }

   
}