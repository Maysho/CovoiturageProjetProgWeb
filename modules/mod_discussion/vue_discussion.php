
<?php

include_once 'vue_generique.php';

	class VueDiscussion extends VueGenerique{

		function __construct(){}

		public function discussion($interlocuteurs, $msg){
?>
			<div class="row">
	
				<p class="col-md-3 text-center"> emplacement aside </p>          
		
				<div class="col-md-9">

					<div class="row">
						<div class="col-md-2 pre-scrollable">
<?php
			for($i=0; $i<count($interlocuteurs); $i++){
?>
							<p><?php echo $interlocuteurs[$i]['prenom'] ?></p>
<?php							
			}
?>

													</div>

						<div class="col-md-9 pre-scrollable">
<?php
			for($i=0; $i<count($msg); $i++){
?>
							<p><?php echo $msg[$i]['prenom']."  ".$msg[$i]['date']."  ".$msg[$i]['contenuMessage'] ?></p>
<?php							
			}
?>
						</div>

					</div>

					<div class="row">
						<textarea class="col-md-7 offset-md-2"></textarea>
						<button class="btn btn-primary col-md-2">Envoyer</button>
					</div>
						
				</div>
			</div>
			
<?php
		}
	}
?>