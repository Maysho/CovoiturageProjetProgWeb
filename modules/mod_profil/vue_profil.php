<?php


	class VueProfil{

		function __construct(){}

		function accueilProfil(){

			?>
			<div class="row">
				<div class="col-md-4 text-center">
					<p class="col-md-4 text-center"> emplacement aside </p>                   
				</div>

				
				<div class="col-md-8">
					<div class="row">
						<nav class="col-md-8 navbar navbar-expand-md navbar-dark bg-dark">
						
						    <div class="navbar-nav justify-content-between">
						    	<a class="nav-item nav-link active" href="#">Profil</a>
						    	<a class="nav-item nav-link active" href="#">Favoris</a>
						    	<a class="nav-item nav-link active" href="#">Modifier le profil</a>
						    	<a class="nav-item nav-link active" href="#">Liste de véhicule</a>
						    	<a class="nav-item nav-link active" href="#">Historique</a>
						    	<a class="nav-item nav-link active" href="#">Trajets réservés</a>
						    </div>
						
						</nav> 
					</div>

					<div class="row">
						<div class="col-md-10"><p>test</p></div>
						
					</div>
				</div>
				
			</div>

			<?php
		}
	}
?>