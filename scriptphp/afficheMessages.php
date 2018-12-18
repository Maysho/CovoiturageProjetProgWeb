<?php  
session_start();
include_once __DIR__.'/../modules/mod_discussion/modele_discussion.php';
$modele = new ModeleDiscussion;

	$idInterlocuteur=isset($_POST['idInterlocuteur']) ? $_POST['idInterlocuteur'] : null;

	$idUser = $_SESSION['id'];
	if ($idInterlocuteur !== null){

		$idValide = $modele->checkDiscuValide($idUser, $idInterlocuteur);

		if($idValide){
			$msg=$modele->messages($idUser, $idInterlocuteur);

			for($i=0; $i<count($msg); $i++){
				
				echo	'<hr>


						<div class="row">
							<div class="col-3">
								<label class="col-12">'.$msg[$i]["prenom"].'</label>
								<label class="col-12">'.$msg[$i]["date"].'</label>
							</div>
							
								<label class="col-9">'.$msg[$i]["contenuMessage"].'</label>
							
						</div>';
				
			}
							
		}		
	}
?>