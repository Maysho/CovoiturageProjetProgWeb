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
			if($this->modele->utilisateurConnecter()){

				$result=$this->modele->recupereInfoUtilisateurCo();
				$result=$this->modele->traduitResultatRequeteCo($result);
				$nbTrajetEtNote=$this->modele->nbTrajetsEtNote();
				$commentaires=$this->modele->commentaires();
				$this->vue->accueilProfil($result, $nbTrajetEtNote['nb'], $nbTrajetEtNote['moyenne'], $commentaires);
			}	
		}
	}
?>