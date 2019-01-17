<?php  
session_start();
include_once __DIR__.'/../modules/mod_discussion/modele_discussion.php';
$modele = new ModeleDiscussion;

	$idUser = $_SESSION['id'];

		$interlocuteurs=$modele->interlocuteurs($idUser);

		for($i=0; $i<count($interlocuteurs); $i++){
?>
			<div class="row">
				<p id="<?php echo $interlocuteurs[$i]['idInterlocuteur']; ?>" class=" col-md-9 interlocuteurs"><?php echo $interlocuteurs[$i]['prenom']; ?></p>
<?php
		$nbMessagesNonLu=$modele->nbMessagesNonLuInterlocuteur($idUser, $interlocuteurs[$i]['idInterlocuteur']);
		if($nbMessagesNonLu!=0)
			echo "<div class='col-md-3 '><span id='messagesNonLus' class='badge badge-danger'>$nbMessagesNonLu</span></div>";
?>
				<hr class="col-md-10">
			</div>
<?php
			
						
		}		
?>