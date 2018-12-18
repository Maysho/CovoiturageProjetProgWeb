<?php
	
	require_once 'modele_discussion.php';
	require_once 'vue_discussion.php';

	class ContDiscussion{

		private $modele, $vue;

		function __construct(){
			$this->modele=new ModeleDiscussion();
			$this->vue=new VueDiscussion();
		}

		public function discussion($idUser){

			$interlocuteurs=$this->modele->interlocuteurs($idUser);
			$msg=$this->modele->messages($idUser,$interlocuteurs[0]['idInterlocuteur']);
			$this->vue->discussion($interlocuteurs, $msg);
		}

	}
?>