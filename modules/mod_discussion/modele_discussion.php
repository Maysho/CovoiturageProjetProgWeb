<?php

include_once __DIR__ . '/../../connexion.php';

	class ModeleDiscussion extends connexion{

		private $msg;

		function __construct(){
			$connexion=new connexion();
			$connexion->init();
			$this->msg="";
		}

		public function interlocuteurs($idUser){
			$selectPreparee=self::$bdd->prepare('
				
				SELECT idUtilisateur1 AS idInterlocuteur, (SELECT prenom FROM utilisateur WHERE idUtilisateur1 = idUtilisateur) AS prenom, (SELECT date FROM discussion WHERE idUtilisateur2=? AND idUtilisateur1 = idInterlocuteur ORDER BY date DESC LIMIT 1) AS dateDernierMsg FROM discussion WHERE idUtilisateur2 = ? 

				UNION 

				SELECT idUtilisateur2 AS idInterlocuteur, (SELECT prenom FROM utilisateur WHERE idUtilisateur2 = idUtilisateur) AS prenom, (SELECT date FROM discussion WHERE idUtilisateur2=idInterlocuteur AND idUtilisateur1 = ? ORDER BY date DESC LIMIT 1) as dateDernierMsg FROM discussion WHERE idUtilisateur1 = ? ORDER BY dateDernierMsg DESC');

			$tableauIds=array($idUser, $idUser, $idUser, $idUser);
			$selectPreparee->execute($tableauIds);
			return $selectPreparee->fetchAll();	
		}

		public function messages($idUser, $idInterlocuteur){
			$selectPreparee=self::$bdd->prepare('

				SELECT idDiscussion, contenuMessage, (SELECT prenom FROM utilisateur WHERE idUtilisateur = idUtilisateurParle) AS prenom, date FROM discussion
				WHERE idUtilisateur1=? AND idUtilisateur2=?

				UNION

				SELECT idDiscussion, contenuMessage, (SELECT prenom FROM utilisateur WHERE idUtilisateur = idUtilisateurParle) AS prenom, date FROM discussion
				WHERE idUtilisateur2=? AND idUtilisateur1=?

				ORDER BY idDiscussion
				');
			$tableauIds=array($idUser, $idInterlocuteur, $idUser, $idInterlocuteur);
			$selectPreparee->execute($tableauIds);
			return $selectPreparee->fetchAll();	

		}

		public function checkDiscuValide($idUser, $idInterlocuteur){

			$selectPreparee=self::$bdd->prepare('
				SELECT count(idUtilisateur1) AS nbDiscu FROM discussion WHERE (idUtilisateur1 = ? AND idUtilisateur2 = ?) OR (idUtilisateur2 = ? AND idUtilisateur1 = ? )
				'
			);
			$tableauIds=array($idUser, $idInterlocuteur, $idUser, $idInterlocuteur);
			$selectPreparee->execute($tableauIds);
			$nbDiscu=$selectPreparee->fetch();
		
			return ($nbDiscu['nbDiscu'] == 0)? false : true;
		}

		public function insererMessage($idUser, $idInterlocuteur, $message){

			$idUtilisateur1;
			$idUtilisateur2;

			$selectPreparee=self::$bdd->prepare('
				SELECT count(idUtilisateur1) AS nbDiscu FROM discussion WHERE idUtilisateur1 = ? AND idUtilisateur2 = ? LIMIT 1'
			);
			$tableauIds=array($idUser, $idInterlocuteur);
			$selectPreparee->execute($tableauIds);
			$discuValide=$selectPreparee->fetch();

			if($discuValide['nbDiscu'] != 0){
				$idUtilisateur1=$idUser;
				$idUtilisateur2=$idInterlocuteur;
			}
			else{
				$idUtilisateur1=$idInterlocuteur;
				$idUtilisateur2=$idUser;
			}

			$insertPrepare=self::$bdd->prepare('INSERT INTO discussion VALUES (DEFAULT, ?, ?, ?, ?, now(), 0)');
			$tabValues=array($idUtilisateur1, $idUtilisateur2, $message, $idUser);
			$insertPrepare->execute($tabValues);
		}

		public function messageLu($idUser, $idInterlocuteur){
			$updatePrepare=self::$bdd->prepare('UPDATE discussion SET lu=1 WHERE ((idUtilisateur1 = ? AND idUtilisateur2 = ?) OR (idUtilisateur1 = ? AND idUtilisateur2 = ?)) AND idUtilisateurParle = ? AND lu = 0'
			);

			$tabValues=array($idUser, $idInterlocuteur, $idInterlocuteur, $idUser, $idInterlocuteur);
			$updatePrepare->execute($tabValues);
		}

		public function nbMessagesNonLus($idUser){
			$selectPreparee=self::$bdd->prepare('SELECT count(*) AS nb FROM discussion WHERE (idUtilisateur1=? OR idUtilisateur2=?) AND idUtilisateurParle != ? AND lu = 0');
			$tabValues=array($idUser, $idUser, $idUser);
			$selectPreparee->execute($tabValues);
			$nbMsgNnLus=$selectPreparee->fetch();
			return $nbMsgNnLus['nb'];

		}

		public function nbMessagesNonLuInterlocuteur($idUser, $idInterlocuteur){
			$selectPreparee=self::$bdd->prepare('SELECT count(*) AS nb FROM discussion WHERE ((idUtilisateur1 = ? AND idUtilisateur2 = ?) OR (idUtilisateur1 = ? AND idUtilisateur2 = ?)) AND idUtilisateurParle = ? AND lu = 0');
			
			$tabValues=array($idUser, $idInterlocuteur, $idInterlocuteur, $idUser, $idInterlocuteur);
			$selectPreparee->execute($tabValues);
			$nbMsgNnLus=$selectPreparee->fetch();
			return $nbMsgNnLus['nb'];
		}
	}
		
?>