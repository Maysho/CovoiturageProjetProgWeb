
<?php

include_once 'vue_generique.php';

	class VueDiscussion extends VueGenerique{

		function __construct(){}

		public function discussion(){
?>
			<div class="row">
	
				<p class="col-md-3 text-center"> emplacement aside </p>          
		
				<div class="col-md-9">

					<div class="row">
						<div class="col-md-2 pre-scrollable">
							<p>test</p>
							<p>test</p>
							<p>test</p>
							<p>test</p>
							<p>test</p>
							<p>test</p>
							<p>test</p>
							<p>test</p>
							<p>test</p>
							<p>test</p>
							<p>test</p>
							<p>test</p>
						</div>

						<div class="col-md-9 pre-scrollable">
							<p> test d'un message qui doit etre un minimum long quand meme. Enfin c'est surtout histoire de pouvoir avoir un retour à la ligne pour voir ce que ça donne avce le pre-scrollable</p>
							<p> test d'un message qui doit etre un minimum long quand meme. Enfin c'est surtout histoire de pouvoir avoir un retour à la ligne pour voir ce que ça donne avce le pre-scrollable</p>
							<p> test d'un message qui doit etre un minimum long quand meme. Enfin c'est surtout histoire de pouvoir avoir un retour à la ligne pour voir ce que ça donne avce le pre-scrollable</p>
							<p> test d'un message qui doit etre un minimum long quand meme. Enfin c'est surtout histoire de pouvoir avoir un retour à la ligne pour voir ce que ça donne avce le pre-scrollable</p>
							<p> test d'un message qui doit etre un minimum long quand meme. Enfin c'est surtout histoire de pouvoir avoir un retour à la ligne pour voir ce que ça donne avce le pre-scrollable</p>
							<p> test d'un message qui doit etre un minimum long quand meme. Enfin c'est surtout histoire de pouvoir avoir un retour à la ligne pour voir ce que ça donne avce le pre-scrollable</p>
							<p> test d'un message qui doit etre un minimum long quand meme. Enfin c'est surtout histoire de pouvoir avoir un retour à la ligne pour voir ce que ça donne avce le pre-scrollable</p>
							<p> test d'un message qui doit etre un minimum long quand meme. Enfin c'est surtout histoire de pouvoir avoir un retour à la ligne pour voir ce que ça donne avce le pre-scrollable</p>
							<p> test d'un message qui doit etre un minimum long quand meme. Enfin c'est surtout histoire de pouvoir avoir un retour à la ligne pour voir ce que ça donne avce le pre-scrollable</p>
							<p> test d'un message qui doit etre un minimum long quand meme. Enfin c'est surtout histoire de pouvoir avoir un retour à la ligne pour voir ce que ça donne avce le pre-scrollable</p>
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