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
			$this->vue->discussion();
		}

	}
?>