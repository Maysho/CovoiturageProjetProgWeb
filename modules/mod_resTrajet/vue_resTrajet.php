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
	public function affichePage($value=-1,$tab1,$depart,$destination,$date,$prix,$type,$regulier)
	{
		?>
  		<?php
  		if ($value==1) {
  			echo "<div><div class='col col-md-12'>";
  		}
  		else{
  			echo "<div class='row justify-content-center col-12'> <div class='col col-md-6 '>";
  		}
  		if ($value==1) {
  			echo "<div id='contenu' class='col-12  '> <div id='divHauteRes' class='col-12'><div id='divHauteRes2' class=' col-12 row justify-content-between border border-dark'>";
  		}
  		else
  			echo "<div id='contenu' class='col-12'> <div class='col-12 ' id='divHauteRes'> <div id='divHauteRes2' class=' col-12 row justify-content-between border border-dark'>";
  		?>
  		<div class='row justify-content-end col-12'>
  			<button id='miseEnFavoris'><i class="far fa-star" id="pasFavoris"></i></button><!-- <i class="fas fa-star"></i> -->
  		</div>
  			<form id='formulaireDeRechercheResultat' class="col-12">
  			<div class='form-row justify-content-around' id="formPrincipal" >
				    <div class='form-group container col-md-6' id="villeDepartRecherche">
				      <label for='rechercheDepart'>depart</label>
				      <input type='adresse' class='form-control col-12' id='rechercheDepart' placeholder='adresse' name='depart' value="<?php echo $depart; ?>"  >
				      </div>
				    <div class='form-group col-md-6' id="villeArriveRecherche">
				      <label for='rechercheArrive'>destination</label>
				      <input type='adresse' class='form-control' id='rechercheArrive' placeholder='adresse' name="destination" value="<?php echo $destination; ?>">
				    </div>
				    <div class="form-group col-md-3 partitAjoute d-none"> 
				    	<label for="inputAddress">date</label>  
				    	<input type="date" class="form-control" id="inputAddress" placeholder="1234 Main St" name="date" value="<?php echo $date; ?>">  
				    	 </div> 
				    	 <div class="form-group col-md-3 partitAjoute d-none">
				    	 	<label for="inputAddress2">prix</label>    
				    	 	 <input type="text" class="form-control" id="inputAddress2" name="prix" placeholder="Apartment, studio, or floor" value="<?php echo $prix; ?>">
				    	 	  </div>  
				    	 	<div class="partitAjoute form-group col-md-2 d-none">  
				    	 	<label for="inputState">type de vehicule</label> 
				    	 	<select id="inputState" name="type" class="form-control"> 
							<option <?php echo $type=="Non renseigné"? "selected":""; ?>>Non renseigné</option>
				    	 	
				    	 	<option <?php echo $type=="1"? "selected":""; ?>>1</option>
				    	 	<option <?php echo $type=="2"? "selected":""; ?>>2</option>
				    	 	</select> 
    	 	                </div>
				    
				</div>
				<div class="form-row d-none" id="regulierForm"> 
				    	<div class="form-check"> 
				    		<input class="form-check-input" type="checkbox" id="gridCheck" name="regulier" <?php echo $regulier==true?"checked":""; ?> value="<?php echo $regulier; ?>"> 
				    		<label class="form-check-label" for="gridCheck"> regulier </label>
				    	</div> 
				    </div>
				       
				  
				  <div class='row' id="buttonSubmitAccueil">
				  	<button class='btn btn-secondary d-block' id="buttonAgranditForm">+</button>
				  	<div class="mr-auto"></div>
				  	<select class='btn btn-secondary' name="trie" id="buttonTrieRes1">
				  		<option selected>prix</option>
				    	<option>prix desc</option>
				    	<option>heureArrivee</option>
				    	<option>heureDepart</option>
				    	<option>prix, heureArrivee</option>
				    </select>
				  <button type='submit' class='btn btn-primary' id="buttonResTrajet" style='margin-right: 3%'>Sign in</button>
				  </div>
				  <div class="row d-none" id="divbuttonrapetisseform">
				        <button class="btn btn-secondary" id="buttonRapetisseForm">-</button> 
				  </div>
				    

				  
				</form>
	  		</div>
  		</div>
  		<?php
  		$i=0;
  		while($donnee = $tab1->fetch()) // on effectue une boucle pour obtenir les données
		{
		    //array_push($array, $donnee['nomVille']." ".$donnee['codePostal']); // et on ajoute celles-ci à notre tableau
		if ($i<25) {
			# code...
		
  		if ($value==1) {

  			echo '<div class="col-12 removeResTrajet">
	  		<a class="liensanscouleur row border border-dark justify-content-between col-12" href="index.php?module=mod_trajet&action=afficheTrajet&id='.$donnee['idTrajet'].'">';
  		}
  		else
  			echo '<div class="col-12 justify-content-center removeResTrajet"> <a class="liensanscouleur row border border-dark justify-content-between col-12" href="index.php?module=mod_trajet&action=afficheTrajet&id='.$donnee['idTrajet'].'"> '
  		?>
	  			<div class="col-2">
	  				<img src="home.jpg" style="width: 100px;">
	  				<span class=""><?php echo $donnee['prenom'];?></span>
	  			</div>
	  			<div class="col-6 row offset-1 justify-content-between" >
	  			<div class=" justify-content-between row container">
	  				<span class="col-12 col-md-6"><?php echo $donnee['depart'];?></span>
	  				<span class="col-6 text-right"><?php echo $donnee['heureDepart'];?></span>
	  				
	  				</div>
	  				<div class="align-items-end justify-content-between row container">
	  				<span class="col-12 col-md-6" style="padding-right: 3px;"><?php echo $donnee['destination'];?></span>
	  				<span class="col-6 text-right" ><?php echo $donnee['heureArrivee'];?></span>
	  				</div>
	  			</div>
	  			<div class="col-2 row offset-1  justify-content-end ">
	  			<div class="row justify-content-end col-12">
	  				<span class="align-top"><?php echo $donnee['placeTotale']; ?></span>
	  				</div>
	  				<div class="row align-content-end justify-content-end col-12" >
	  				<span class="align-text-bottomme"><?php echo $donnee['prix'];?>€</span>
	  				</div>
	  			</div>
	  			</a>
	  			


  		</div>
  		
  		
  		<?php }$i++;}?>
  		
  		</div>
  		<?php
  		if ($value==1) {
  			echo " <div class='justify-content-center row col-12'> ";
  		}
  		else 
  			echo " <div class='justify-content-center row col-12'> ";?>
  		
  			<button id="buttonAffichePlus">en afficher plus</button>
  		</div>
  	</div>
  		<?php
	}
}