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
			$idInterlocuteur= isset($interlocuteurs[1]['idInterlocuteur'])?$interlocuteurs[1]['idInterlocuteur']:null;
			$msg=$this->modele->messages($idUser,$idInterlocuteur);
			$this->vue->discussion($interlocuteurs, $msg);
		}

		public function envoieMsgDepuisProfil($idUser, $idInterlocuteur){
			$resultat=$this->modele->envoieMsgDepuisProfil($idUser, $idInterlocuteur);
			header("Location: ?module=mod_profil&idprofil=$idInterlocuteur&ongletprofil=profil&resultat=$resultat");
		}

	}
?>