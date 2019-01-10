<?php  
session_start();
include_once __DIR__.'/../modules/mod_discussion/modele_discussion.php';
$modele = new ModeleDiscussion;

	$idInterlocuteur=isset($_POST['idInterlocuteur']) ? $_POST['idInterlocuteur'] : null;

	if ($idInterlocuteur !== null){
		$idUser = $_SESSION['id'];

		if($modele->checkDiscuValide($idUser, $idInterlocuteur)){
			$msg=$modele->messages($idUser, $idInterlocuteur);
			$modele->messageLu($idUser, $idInterlocuteur);

			for($i=0; $i<count($msg); $i++){
				
				echo	'<hr>


						<div class="row">
							<div class="col-md-3 row">
								<label class="col-5 col-md-12 col-xl-12">'.$msg[$i]["prenom"].'</label>
								<label class="col-5 col-md-12 col-xl-7">'.$msg[$i]["jour"].'</label>
								<label class="col-2 col-md-12 col-xl-5">'.$msg[$i]["heure"].'</label>
							</div>
							<div class="col-md-9">
								<span >'.$msg[$i]["contenuMessage"].'</span>
							</div>
								
							
						</div>';
				
			}
							
		}		
	}
?>