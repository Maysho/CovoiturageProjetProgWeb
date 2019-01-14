<?php
	
	include_once 'modele_profil.php';
	include_once 'vue_profil.php';

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

			if ($result['nom'] == NULL){
				http_response_code(404);
				die("Erreur 404");
			}

			$result=$this->modele->traduitResultatRequete($result);
			$nbTrajetEtNote=$this->modele->nbTrajetsEtNote($idUser);
			$commentaires=$this->modele->commentaires($idUser);
			$this->vue->accueilProfil($result, $nbTrajetEtNote['nb'], $nbTrajetEtNote['moyenne'], $commentaires, $estConnecter, $estPagePerso, $idUser);
			
		}

		

		public function modifierProfil($idUser, $estConnecter){

			if($this->verifEstPagePerso($idUser, $estConnecter)){

				$donnees=$this->modele->recupereInfoUtilisateurModif($idUser);
				$token=$this->modele->actualiseToken($idUser);

				$this->vue->modificationDeProfil($idUser, $donnees, $token);
			}
		}

		public function recupereModifProfil($idUser, $estConnecter){

			if($this->verifEstPagePerso($idUser, $estConnecter)){

				$erreur=$this->modele->verifieModificationProfil($idUser);
				if($erreur==NULL){
					header("Pragma: no-cache");
					header("Location: ?module=mod_profil&idprofil=$idUser&ongletprofil=profil");
				}
				
				else{	
					$donnees=$this->modele->recupereInfoUtilisateurModif($idUser);
					$token=$this->modele->actualiseToken($idUser);

					$this->vue->modificationDeProfil($idUser, $donnees, $token, $erreur);
				}
			}
		}

		public function afficheListeVehicule($idUser, $estConnecter){
			if($this->verifEstPagePerso($idUser, $estConnecter)){
				$donnees=$this->modele->getListeVehicules($idUser);
				$this->vue->afficheListeVehicule($idUser, $donnees);
			}

		}

		public function afficheTrajetsReserves($idUser, $estConnecter){
			if($this->verifEstPagePerso($idUser, $estConnecter)){
				$donnees=$this->modele->getListeTrajetsReserves($idUser);
				$this->vue->afficheTrajetsReserves($idUser, $donnees);
			}
		}

		public function afficheHistorique($idUser, $estConnecter){
			if($this->verifEstPagePerso($idUser, $estConnecter)){
				$donnees=$this->modele->getListeHistorique($idUser);
				$this->vue->afficheHistorique($idUser, $donnees);
			}
		}

		public function afficheListeFavoris($idUser, $estConnecter){
			if($this->verifEstPagePerso($idUser, $estConnecter)){
				$donnees=$this->modele->getListeFavoris($idUser);
				$this->vue->afficheListeFavoris($idUser, $donnees);
			}
		}

		private function verifEstPagePerso($idUser, $estConnecter){
			$estPagePerso=false;

			if(!$estConnecter){
				http_response_code(403);
				die("Erreur 403");
			}
			else
				$estPagePerso=$this->modele->estPagePerso($idUser);

			if(!$estPagePerso){
				http_response_code(403);
				die("Erreur 403");
			}

			return true;
		}
	}
?>