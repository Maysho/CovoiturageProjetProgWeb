<!-- <?php  
session_start();
?> -->
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Covoiturage</title>
    
  </head>
  <body>
  	<div class="container-fluid">
  			<nav class="navbar navbar-expand-md navbar-light bg-light">
			  <a class="navbar-brand " href="#"><img src="home.jpg" class="imagenav"></a>
			  <button class="navbar-toggler navbar-nav mr-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			    <span class="navbar-toggler-icon"></span>
			  </button>

			  <div class="collapse navbar-collapse float-right" id="navbarSupportedContent">
			  <div class="mr-auto"></div>
			    <ul class="navbar-nav ">
			      <li class="nav-item">
			        <a class="nav-link" href="#">Proposer <span class="sr-only">(current)</span></a>
			      </li>
			      <li id="test" class="nav-item">
			        <a class="nav-link" href="#">Rechercher</a>
			      </li>
			    </ul>
			    <div class="nav-item dropdown">
			        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			          <img src="profildefault.jpg" class="imagenav">
			        </a>
			        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
			          <a class="dropdown-item" href="#">Discussion</a>
			          <a class="dropdown-item" href="#">Profil</a>
			          <div class="dropdown-divider"></div>
			          <a class="dropdown-item" href="#">Deconnexion</a>
			        </div>
			      </div>
			  </div>
			</nav>



  		
	<div class="offset-2 col-md-8 text-center">

  		<section>
  			
  			<h2>Je propose un Trajet</h2>
  			<form method="POST" id="formTrajet">
	  			<div>
	  				<h2 class="text-left">Itinéraire</h2>
	  				<div class="row">
		  				<div class="col-md-6"> 
		  					<div class="text-left form-group" id="">
							    <label for="">Je pars de... </label>
							    <input type="text" required="required" name="" class="form-control" id=""  placeholder="Ville de Depart">
							</div>
							<div class="text-center form-group" id="">
							    <label for="">... Pour aller à...</label>
							    <input type="text" required="required" name="" id="" class="form-control" id=""  placeholder="Ville d'Arrivée">
							</div >
							<div class="text-right form-group">
							    <label for="">...En Passant par...</label>
							    <input type="text" name="" id="" class="form-control" id=""  placeholder="Ville de Passage">
							</div >
							<div class="form-group text-left">
								<label>Frequence :</label>
						      <label class="offset-1"><input type="radio" name="frequence" checked>Occasionnel</label>
						      <label class="offset-1"><input type="radio" name="frequence">Régulier</label>
							</div>	
						</div>
		  				<div class="col-md-6"> 
		  					<img alt="Map de la France" src="photos/Black.png">
		  				</div>
	  				</div>
	  				<hr>
	  			</div>
	  			<div>
	  				<div class="text-left">
	  					<div>
	  						<h2>Dates et Horaires</h2>
	  						<label>Aller-Retour<input type="checkbox" name="allerRetour"></label>
	  					</div>
	  				</div>
	  				<div class="text-left form-group " >
	  					<label>Date de l'aller</label>
	  						<input type="" name="" value="00-00-0000">
	  					<label>Heure</label>
	  						<input class="col-md-1" type="" name="" value="00:00">
	  					<label>+-</label>
	  						<input class="col-md-1" type="" name="" value="00">
	  				</div>
	  				<!-- <div class="text-left form-group" hidden>
	  					<label>Date du retour</label>
	  						<input type="" name="" value="00-00-0000">
	  					<label>Heure</label>
							<input class="col-md-1" type="" name="" value="00:00">
	  					<label>+-</label>
	  						<input class="col-md-1" type="" name="" value="00">
	  					<label>prix</label>
	  						<input class="col-md-1" type="" name="" value="0">
	  				</div> 
	  				<div id="checkpoint" class="row" hidden>
	  					<label>Date</label>
	  						<input type="" name="" value="">
	  					<label>Heure</label>
	  						<input type="" name="" value="">
	  					<label>+-</label>
	  						<input type="" name="" value="">
	  					<label>prix</label>
	  						<input type="" name="" value="">
	  				</div> -->
	  				<hr>
	  			</div>
	  			
	  			<div> 
	  				<h2 class="text-left"> Autres Modalités	</h2>
	  				<div class="row">
		  				<div class="col-md-6"> 
		  					<div class="text-left form-group" id="">
		  						<div class="row">
								    <label class="col-md-4" for="">Mon Vehicule</label>
								    <!-- <input class="offset-1 col-md-6 form-control" type="text" required="required" name=""  id="emailInscription"  placeholder="Ajouter un Vehicule"> -->
								    
									<select class="offset-1 col-md-6 form-control" id="monVehicule">
									    <option value="">--Please choose an option--</option>
									    <option value="">Ajouter Un Véhicule</option>
									</select>
								</div>
							    <label class="col-md-4" for="">Nombre de place</label>
							    <input class="offset-1 col-md-6" type="text" required="required" name="" id="" class="form-control" id=""  placeholder="0">
							</div >
						</div>
		  				<div class="col-md-6"> 
  							<img alt="Voiture" src="photos/Black.png">
  						</div>
	  				</div>
	  				<div class="row">
	  					<div class="col-md-12">
		  					<div class="text-left form-group" id="">
							    <label  for="">Detail du voyage</label>
							    <textarea class="form-control" type="textarea" name="" id="" rows="4"  placeholder="Description"></textarea>
							</div>
						</div>
					</div > 
					<hr>
	  			</div>
	  			<div class="row">
				    <label><input type="checkbox" name="notificationJoin">Me prévenir lorsqu'un passager s'inscrit au trajet</label>
				</div>
	  			<button type="submit"  id=""  name="submit"  class="btn btn-primary">C'est parti!</button>
			</form>
  		</section>
  	</div>

	<footer>Antoine Dabilly</footer>
	<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    
    <script src="jquery.js"></script>
    <script src="javascript.js"> </script>

</body>

</html>