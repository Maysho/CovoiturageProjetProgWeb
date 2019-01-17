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
				
				if($i>0) echo '';

				echo	'<div class="row rounded messages"  >
							<div class="col-md-3 row">
								<label class="col-5 col-md-12 prenomDiscussion">'.$msg[$i]["prenom"].'</label>
								<label class="col-5 col-md-12 dateHeureDiscussion">'.$msg[$i]["jour"].'</label>
								<label class="col-2 col-md-12 dateHeureDiscussion">'.$msg[$i]["heure"].'</label>
							</div>
							<div class="col-md-9">
								<span class="msgLongs">'.$msg[$i]["contenuMessage"].'</span>
							</div>
						</div>';
				
			}
							
		}		
	}
?>