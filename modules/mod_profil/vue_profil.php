<?php

include_once 'vue_generique.php';
	class VueProfil{

		function __construct(){}

		function accueilProfil($donnerAAfficher, $nbTrajet, $moyenne, $commentaires){

			echo '
			<div class="row">
				
				<p class="col-md-3 text-center"> emplacement aside </p>                   
				

				
				<div class="col-md-9">
					
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
				
					<section class="border border-dark rounded">
						
					
						<div class="row col-auto">
							<img class="col-md-2 order-0 " src="'.$donnerAAfficher['urlPhoto'].'" alt="photo de profil">

							<div class="row col-md-4 order-2 order-md-1">
								<label class="col-md-12"> Prénom : '.$donnerAAfficher['prenom'].'</label>	
								<label class="col-md-12"> Nom : '.$donnerAAfficher['nom'].'</label>
								<label class="col-md-12"> Age : '.$donnerAAfficher['dateDeNaissance'].' ans</label>
								<label class="col-md-12">Sexe : '.$donnerAAfficher['sexe'].'</label>						
							</div>

							<div class="row col-md-4 order-3 order-md-2">
								<label class="col-md-12">E-mail : '.$donnerAAfficher['adresseMail'].'</label>
								<label class="col-md-12">Nombre de trajets effectués : '.$nbTrajet.'</label>
								<label class="col-md-12">Note moyenne : '.$moyenne.'</label>
							</div>

							<button class="col-md-2 btn btn-primary order-1 order-md-3 ">Modifier le profil</button>
						</div>
					

					
						<div class="col-md-auto">
							<label class="">Description : </label>
							<label class=" col-md-12 border border-primary rounded">'.$donnerAAfficher['description'].'</label>
						</div>
							
						
					</section>
					';?>
					<?php

				for ($i=0; $i < count($commentaires); $i++) { 

	   				echo '
	   				<section class="border border-dark rounded">
	   					<div class="row">
	   						<label class="col-md-8">De '.$commentaires[$i]['prenom'].' le '.$commentaires[$i]['date'].'</label>
	   						<label class="col-md-4">note : '.$commentaires[$i]['note'].'</label>
	   					</div>
	   					<div class="row">
	   						<label class="col-md-12">'.$commentaires[$i]['description'].'</label>
	   					</div>
	   				</section>
	   				';
	   			}

					?>

					<?php echo '
				</div>
				
			</div> 		';
		}
	}
?>