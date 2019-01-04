<?php
	
	include_once 'modele_profil.php';
	include_once 'vue_profil.php';

	class ContProfil{

		private $modele, $vue;

		function __construct(){
			$this->modele=new ModeleProfil();
			$this->vue=new VueProfil();
		}

		public function accueilProfil($idUser, $estConnecter, $resultat){
			
			$estPagePerso=false;
			//$estPagePerso=true;
			//$estConnecter=true;
			if($estConnecter)
				$estPagePerso=$this->modele->estPagePerso($idUser);
			
			
			$result=$this->modele->recupereInfoUtilisateur($idUser, $estPagePerso);

			if ($result['nom'] == NULL)
				die("Page inaccessible");

			$result=$this->modele->traduitResultatRequete($result);
			$nbTrajetEtNote=$this->modele->nbTrajetsEtNote($idUser);
			$commentaires=$this->modele->commentaires($idUser);
			$this->vue->accueilProfil($result, $nbTrajetEtNote['nb'], $nbTrajetEtNote['moyenne'], $commentaires, $estConnecter, $estPagePerso, $idUser, $resultat);
			
		}

		

		public function modifierProfil($idUser, $estConnecter){

			$estPagePerso=false;

			if(!$estConnecter)
				die("Page inaccessible");
			else
				$estPagePerso=$this->modele->estPagePerso($idUser);

			if(!$estPagePerso)
				die("Page inaccessible");

			$donnees=$result=$this->modele->recupereInfoUtilisateurModif($idUser);

			$this->vue->modificationDeProfil($idUser, $donnees);
		}

		public function recupereModifProfil($idUser, $estConnecter){

			$estPagePerso=false;

			if(!$estConnecter)
				die("Page inaccessible");
			else
				$estPagePerso=$this->modele->estPagePerso($idUser);

			if(!$estPagePerso)
				die("Page inaccessible");

			$this->modele->verifieModificationProfil($idUser);

			header("Location: ?module=mod_profil&idprofil=$idUser&ongletprofil=profil");
		}

		public function recupereModifMdp($idUser, $estConnecter){

			$estPagePerso=false;

			if(!$estConnecter)
				die("Page inaccessible");
			else
				$estPagePerso=$this->modele->estPagePerso($idUser);

			if(!$estPagePerso)
				die("Page inaccessible");

			$code=$this->modele->verifieModificationMdp($idUser);
			if($code == 0)
				header("Location: ?module=mod_profil&idprofil=$idUser&ongletprofil=modifMdp&resultat=0");
			else if($code == 1)
				header("Location: ?module=mod_profil&idprofil=$idUser&ongletprofil=modifMdp&resultat=1");
			else
				header("Location: ?module=mod_profil&idprofil=$idUser&ongletprofil=modifMdp&resultat=2");
		}

		public function afficheListeVehicule($idUser){

			$donnees=$this->modele->getListeVehicules($idUser);

			$this->vue->afficheListeVehicule($idUser, $donnees);

		}
		public function afficheListeFavoris($idUser)
		{
			$donnees=$this->modele->getListeFavoris($idUser);
			$this->vue->afficheListeFavoris($idUser, $donnees);
		}
	}
?>