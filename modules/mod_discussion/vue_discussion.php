
<?php

include_once 'vue_generique.php';

	class VueDiscussion extends VueGenerique{

		function __construct(){
			parent::__construct();
		}

		public function discussion($interlocuteurs, $msg){
?>			    
		
			<div class="col-md-12">
				<div class="row">
					<p>Pour ajouter un nouveau contact, envoyez lui un message depuis son profil!</p>
				</div>
				<div class="row">
					<textarea id="idInterlocuteurEnCours" hidden=""><?php if(isset($interlocuteurs[0]['idInterlocuteur']))echo $interlocuteurs[0]['idInterlocuteur']; ?></textarea>
					<h4 id="titreContacts" class="col-md-3 order-1 order-md-1">Contacts:</h4>
					<h4 id="titreMessages" class="col-md-9 order-3 order-md-2">Messages:</h4>
					<div id="interlocuteurs"  class="col-md-3 order-2 order-md-3 pre-scrollable scroll-bottom" style=""></div>
					
					<div id="messages" class="col-md-9 order-4 order-md-4 pre-scrollable scroll-bottom"></div>

				</div>

				<div class="row">
						<textarea id="MsgAEnvoyer" class="col-md-10 form-control textarea-fixe" maxlength="255" rows="1"></textarea>
						<input id="EnvoieMsg" class="btn btn-primary col-md-2" type="submit"></input>
					
				</div>
					
			</div>
<?php
		}
	}
?>