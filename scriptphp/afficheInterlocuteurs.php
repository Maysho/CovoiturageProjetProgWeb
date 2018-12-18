<?php  
session_start();
include_once __DIR__.'/../modules/mod_discussion/modele_discussion.php';
$modele = new ModeleDiscussion;

	$idUser = $_SESSION['id'];

		$interlocuteurs=$modele->interlocuteurs($idUser);

		for($i=0; $i<count($interlocuteurs); $i++){
?>
			<p id="<?php echo $interlocuteurs[$i]['idInterlocuteur']; ?>" class="interlocuteurs"><?php echo $interlocuteurs[$i]['prenom']; ?></p>
			<hr>
<?php
			
						
		}		
?>