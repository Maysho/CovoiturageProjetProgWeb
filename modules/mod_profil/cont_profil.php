<?php
	
	require_once 'modele_profil.php';
	require_once 'vue_profil.php';

	class ContProfil{

		private $modele, $vue;

		function __construct(){
			$this->modele=new ModeleProfil();
			$this->vue=new VueProfil();
		}

		public function accueilProfil($idUser, $estConnecter){
			
			$estPagePerso=false;

			if($estConnecter)
				$estPagePerso=$this->modele->estPagePerso($idUser);
			
			
			$result=$this->modele->recupereInfoUtilisateur($idUser, $estPagePerso);
			$result=$this->modele->traduitResultatRequete($result);
			$nbTrajetEtNote=$this->modele->nbTrajetsEtNote($idUser);
			$commentaires=$this->modele->commentaires($idUser);
			$this->vue->accueilProfil($result, $nbTrajetEtNote['nb'], $nbTrajetEtNote['moyenne'], $commentaires, $estConnecter, $estPagePerso);
			
		}
	}
?>