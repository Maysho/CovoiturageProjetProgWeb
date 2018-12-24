
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
						<textarea id="idInterlocuteurEnCours"  hidden=""><?php echo $interlocuteurs[0]['idInterlocuteur']; ?></textarea>

						<div id="interlocuteurs"  class="col-md-2 pre-scrollable scroll-bottom"></div>
						
						<div id="messages" class="col-md-9 pre-scrollable scroll-bottom"></div>

					</div>

					<div class="row">
							<textarea id="MsgAEnvoyer" class="col-md-7 offset-md-2 form-control" maxlength="255" rows="1" style="resize: none"></textarea>
							<input id="EnvoieMsg" class="btn btn-primary col-md-2" type="submit"></input>
						
					</div>
						
				</section>
			</div>
<?php
		}
	}
?>