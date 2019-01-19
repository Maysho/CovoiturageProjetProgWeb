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
	public function affichePage($value=-1,$tab1,$depart,$destination,$date,$prix,$type,$regulier,$favoris=false)
	{
		?>
  		<?php
  		if ($value==1) {
  			echo "<div><div class='col col-md-12'>";
  		}
  		else{
  			echo "<div class='row justify-content-center col-12'> <div class='col col-md-6 '>";
  		}
  		?>
			<div id='contenu' class='col-12'> <div class='col-12 ' id='divHauteRes'> 
				<div id='divHauteRes2' class='search_container_result col-12 row justify-content-between'>
  		<?php
  		if ($value==1) {?>
					<div class='row justify-content-end col-12'>
						<button class="btn btn-primary buttonRecherche" id='miseEnFavoris' title="permet de mettre ou retirer un favoris"><?php echo $favoris?'<i class="far fa-star" id="pasFavoris"></i>':'<i class="fas fa-star" id="favoris"></i>';?></button><!-- <i class="fas fa-star"></i> -->
					</div>
  		<?php 
  	}
  		?>
  			<form id='formulaireDeRechercheResultat' class="col-12">
  				<div class='form-row justify-content-around' id="formPrincipal" >
				    <div class='form-group col-md-6' id="villeDepartRecherche">
				      <label class="search_headline" for='rechercheDepart'>Départ</label>
				      <input type='adresse' class='form-control col-12' id='rechercheDepart' placeholder='Ville de Départ (ex: MONTCUQ, 46800)' name='depart' value="<?php echo $depart; ?>"  >
					</div>
				    <div class='form-group col-md-6' id="villeArriveRecherche">
				      <label class="search_headline" for='rechercheArrive'>Destination</label>
				      <input type='adresse' class='form-control' id='rechercheArrive' placeholder="Ville d'Arrivée (ex: LE FION, 74500)" name="destination" value="<?php echo $destination; ?>">
				    </div>
				    <div class="form-group col-md-3 partitAjoute d-none"> 
				    	<label class="search_mini_headline" for="inputAddress">Date</label>  
				    	<input type="date" class="form-control" id="inputAddress" placeholder="" name="date" value="<?php echo $date; ?>">  
				    	 </div> 
				    	 <div class="form-group col-md-3 partitAjoute d-none">
				    	 	<label class="search_mini_headline" for="inputAddress2">prix</label>    
				    	 	 <input type="text" class="form-control" id="inputAddress2" name="prix" placeholder="Prix maximal" value="<?php echo $prix; ?>">
				    	 	  </div>  
				    	 	<div class="partitAjoute form-group col-md-2 d-none">  
				    	 	<label class="search_mini_headline" for="inputState">type de vehicule<i class="fas fa-question-circle" title="dans ce champ vous devez rentrer le crit'Air de votre véhicule"></i></label> 
				    	 	<select id="inputState" name="type" class="form-control"> 
							<option <?php echo $type=="Non Renseigné"? "selected":""; ?>>Non Renseigné</option>
				    	 	
				    	 	<option <?php echo $type=="1"? "selected":""; ?>>1</option>
				    	 	<option <?php echo $type=="2"? "selected":""; ?>>2</option>
				    	 	<option <?php echo $type=="3"? "selected":""; ?>>3</option>
				    	 	<option <?php echo $type=="4"? "selected":""; ?>>4</option>
				    	 	<option <?php echo $type=="5"? "selected":""; ?>>5</option>
				    	 	<option <?php echo $type=="6"? "selected":""; ?>>6</option>
				    	 	<option <?php echo $type=="7"? "selected":""; ?>>7</option>
						</select> 
					</div>
				</div>
				<div class="form-row d-none" id="regulierForm"> 
					<div class="form-check"> 
						<input class="form-check-input" type="checkbox" id="gridCheck" name="regulier" <?php echo $regulier==true?"checked":""; ?> value="<?php echo $regulier; ?>"> 
						<label class="form-check-label search_mini_headline" for="gridCheck"> Régulier<i class="fas fa-question-circle" title="ce champ doit être validé si vous recherchez un trajet régulié"></i></label>
					</div> 
				</div>
				<div class='row' id="buttonSubmitAccueil">
				  	<button class='btn btn-secondary d-block buttonRecherche' id="buttonAgranditForm">+</button>
				  	<div class="mr-auto"></div>
				  	<select class='btn' name="trie" id="buttonTrieRes1">
				  		<option selected>prix</option>
				    	<option>prix desc</option>
				    	<option>heureArrivee</option>
				    	<option>heureDepart</option>
				    	<option>prix, heureArrivee</option>
				    </select>
					<button type='submit' class='btn btn-primary buttonRecherche' id="buttonResTrajet" >Sign in</button>
				</div>
				<div class="row d-none" id="divbuttonrapetisseform">
					<button class="btn btn-secondary buttonRecherche" id="buttonRapetisseForm">-</button> 
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
	  		<a class="resultatTrajet liensanscouleur row justify-content-between col-12" href="index.php?module=mod_trajet&action=afficheTrajet&id='.$donnee['idTrajet'].'">';
  		}
  		else
  			echo '<div class="col-12 justify-content-center removeResTrajet"> <a class="resultatTrajet liensanscouleur row justify-content-between col-12" href="index.php?module=mod_trajet&action=afficheTrajet&id='.$donnee['idTrajet'].'"> '
  		?>
	  			<div class="col-md-2">
	  				<img src="home.jpg" style="width: 100px;">
	  				<span class=""><?php echo $donnee['prenom'];?></span>
	  			</div>
	  			<div class="col-md-6 row offset-md-1 justify-content-md-between justify-content-center no-gutters px-0" >
	  			<div class=" justify-content-md-between justify-content-center row container-fluid px-0" >
	  				<span class="col-12 col-md-6 text-center">Départ de <?php echo $donnee['depart'];?></span>
	  				<span class="col-6 text-md-right text-center"> à <?php echo $donnee['heureDepart'];?></span>
	  				
	  				</div>
	  				<div class="align-items-end justify-content-md-between justify-content-center row container-fluid px-0">
	  				<span class="col-12 col-md-6 text-center" style="padding-right: 3px;">Arrivée à <?php echo $donnee['destination'];?></span>
	  				<span class="col-6 text-md-right text-center" > à <?php echo $donnee['heureArrivee'];?></span>
	  				</div>
	  			</div>
	  			<div class="col-md-2 row offset-md-1  justify-content-md-end px-0">
	  			<div class="row justify-content-md-end col-12">
	  				<span class="align-top">Places <?php echo $donnee['placeTotale']; ?></span>
	  				</div>
	  				<div class="row align-content-end justify-content-end col-12" >
	  					<span class="align-text-bottomme">Prix <?php echo $donnee['prix'];?>€</span>
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
  		
  			<button class="btn btn-primary buttonRecherche" id="buttonAffichePlus">en afficher plus</button>
  		</div>
  	</div>
  		<?php
	}
}