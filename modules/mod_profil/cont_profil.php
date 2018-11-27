<?php
	
	require_once 'modele_profil.php';
	require_once 'vue_profil.php';

	class ContProfil{

		private $modele, $vue;

		function __construct(){
			$this->modele=new ModeleProfil();
			$this->vue=new VueProfil();
		}

		public function accueilProfil(){
			$this->vue->accueilProfil();
		}

	}
?>