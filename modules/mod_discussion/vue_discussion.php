
<?php

include_once 'vue_generique.php';

	class VueDiscussion extends VueGenerique{

		function __construct(){}

		public function discussion($interlocuteurs, $msg){
?>
			<div class="row">
	
				<p class="col-md-3 text-center"> emplacement aside </p>          
		
				<section class="col-md-9">

					<div class="row">
						<div id="interlocuteurs"  class="col-md-2 pre-scrollable">
<?php
			for($i=0; $i<count($interlocuteurs); $i++){
?>
				<p id="<?php echo $interlocuteurs[$i]['idInterlocuteur']; ?>" class="interlocuteurs"><?php echo $interlocuteurs[$i]['prenom']; ?></p>
			<hr>
<?php	
			}
?>
						</div>

						<div id="messages" class="col-md-9 pre-scrollable">
<?php
			for($i=0; $i<count($msg);$i++){
?>
				<hr>

				<div class="row">
					<div class="col-3">
						<label class="col-12"><?php echo $msg[$i]["prenom"]; ?></label>
						<label class="col-12"><?php echo $msg[$i]["date"]; ?></label>
					</div>
					
						<label class="col-9"><?php echo$msg[$i]["contenuMessage"]; ?></label>
					
				</div>
<?php	
			}
?>
						</div>

					</div>

					<div class="row">
						<textarea class="col-md-7 offset-md-2 form-control" maxlength="250" rows="1" style="resize: none"></textarea>
						<button class="btn btn-primary col-md-2">Envoyer</button>
					</div>
						
				</section>
			</div>
<?php
		}
	}
?>