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

			if ($result['nom'] == NULL)
				die("Page inaccessible");

			$result=$this->modele->traduitResultatRequete($result);
			$nbTrajetEtNote=$this->modele->nbTrajetsEtNote($idUser);
			$commentaires=$this->modele->commentaires($idUser);
			$this->vue->accueilProfil($result, $nbTrajetEtNote['nb'], $nbTrajetEtNote['moyenne'], $commentaires, $estConnecter, $estPagePerso, $idUser);
			
		}

		public function modifierProfil($idUser, $estConnecter){

			/*$estPagePerso=false;

			if(!$estConnecter)
				die("Page inaccessible");
			else
				$estPagePerso=$this->modele->estPagePerso($idUser);

			if(!$estPagePerso)
				die("Page inaccessible");
*/
			$donnees=$result=$this->modele->recupereInfoUtilisateurModif($idUser);

			$this->vue->modificationDeProfil($idUser, $donnees);
		}
	}
?>