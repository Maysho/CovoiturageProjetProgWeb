<?php

include_once 'vue_generique.php';
	class VueProfil{

		function __construct(){}

		function accueilProfil($donnerAAfficher, $nbTrajet, $moyenne, $commentaires, $estConnecter, $estPagePerso){

			
			echo '<div class="row">';
		if($estConnecter)
			echo '	<p class="col-md-3 text-center"> emplacement aside </p>          
		

				
				<div class="col-md-9">';
		else
			echo '<div class="col-md-12">';

		if($estPagePerso){
?>
					<nav class="navbar navbar-expand-md navbar-dark bg-primary">
					
					    <div class="navbar-nav justify-content-between">
					    	<a class="nav-item nav-link active" href="#">Profil</a>
					    	<a class="nav-item nav-link active" href="#">Favoris</a>
					    	<a class="nav-item nav-link active" href="#">Modifier le profil</a>
					    	<a class="nav-item nav-link active" href="#">Liste de véhicule</a>
					    	<a class="nav-item nav-link active" href="#">Historique</a>
					    	<a class="nav-item nav-link active" href="#">Trajets réservés</a>
					    </div>
					
					</nav> 
<?php		
		}?>
					<section class="border border-dark rounded">
						
					
						<div class="row col-auto">
							<img class="col-md-2 order-0 " src="<?php echo $donnerAAfficher['urlPhoto']; ?>" alt="photo de profil">

							<div class="row col-md-4 order-2 order-md-1">
								<label class="col-md-12"> Prénom : <?php echo $donnerAAfficher['prenom']; ?> </label>	
								<label class="col-md-12"> Nom : <?php echo $donnerAAfficher['nom']; ?></label>
<?php
		if(isset($donnerAAfficher['dateDeNaissance']))
			echo '					<label class="col-md-12"> Age : '.$donnerAAfficher['dateDeNaissance'].' ans</label>';
?>
								<label class="col-md-12">Sexe : <?php echo $donnerAAfficher['sexe']; ?></label>						
							</div>

							<div class="row col-md-4 order-3 order-md-2">
<?php	if($estPagePerso)							
			echo '				<label class="col-md-12">E-mail : '.$donnerAAfficher['adresseMail'].'</label>';
?>								<label class="col-md-12">Nombre de trajets effectués : <?php echo $nbTrajet; ?></label>
								<label class="col-md-12">Note moyenne : <?php echo $moyenne; ?></label>
							</div>

<?php	if($estPagePerso)							
			echo '			<button class="col-md-2 btn btn-primary order-1 order-md-3 ">Modifier le profil</button>';
?>						</div>
					

					
						<div class="col-md-auto">
							<label class="">Description : </label>
							<label class=" col-md-12 border border-primary rounded"><?php echo $donnerAAfficher['description']; ?></label>
						</div>
							
						
					</section>
					
<?php

				for ($i=0; $i < count($commentaires); $i++) { 

?>
	   				<section class="border border-dark rounded col-md-12">
	   					<div class="row">
	   						<label class="col-md-8">De <?php echo $commentaires[$i]['prenom']; ?> le <?php echo $commentaires[$i]['date']; ?></label>
	   						<label class="col-md-4">note : <?php echo $commentaires[$i]['note']; ?></label>
	   					</div>
	   					<div class="row">
	   						<label class="col-md-12"><?php echo $commentaires[$i]['description']; ?></label>
	   					</div>
	   				</section>
<?php	   				
	   			}
?>			
				</div>
				
			</div> 
<?php		
		}
	}
?>