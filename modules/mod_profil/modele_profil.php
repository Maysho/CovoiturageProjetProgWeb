<?php

include_once __DIR__ . '/../../connexion.php';
	class ModeleProfil extends connexion{

		function __construct(){
			$connexion=new connexion();
			$connexion->init();
		}

		public function recupereInfoUtilisateur($idUser, $estPagePerso){
			
			if($estPagePerso){
				$selecPreparee=self::$bdd->prepare('SELECT nom, prenom, dateDeNaissance, sexe, adresseMail, description, urlPhoto FROM utilisateur WHERE idUtilisateur=? ');
				$tableauIds=array($idUser);
				$selecPreparee->execute($tableauIds);
				return $selecPreparee->fetch();
			}

			else{
				$selecPreparee=self::$bdd->prepare('SELECT nom, prenom, dateDeNaissance, sexe, description, urlPhoto FROM utilisateur WHERE idUtilisateur=? ');
				$tableauIds=array($idUser);
				$selecPreparee->execute($tableauIds);
				return $selecPreparee->fetch();
			}

		}

		public function estPagePerso($idUser){
			return $idUser===$_SESSION['id'];
		}

		public function traduitResultatRequete($result){
			$result['sexe']=self::traduitSexe($result['sexe']);
			$result['dateDeNaissance']=self::traduitAge($result['dateDeNaissance']);
			return $result;
		}

		private function traduitSexe($sexeInt){
			return $sexeInt === 1 ? 'femme' : 'homme';
		}

		private function traduitAge($dateDeNaissance){
			$datetime1 = new DateTime(date("Y-m-d"));
			$datetime2 = new DateTime($dateDeNaissance);
			$age = $datetime2->diff($datetime1);
			return  $age->format('%y');
		}

		public function commentaires($idUser){

			$selecPreparee=self::$bdd->prepare('SELECT (SELECT prenom from utilisateur where idUtilisateur=idAuteur) as prenom, date, note, commenter.description FROM utilisateur INNER JOIN commenter on utilisateur.idUtilisateur = commenter.idUtilisateur WHERE utilisateur.idUtilisateur=? and commenter.description is not null order by date DESC');
			$tableauIds=array($idUser);
			$selecPreparee->execute($tableauIds);
			return $selecPreparee->fetchAll();
		}

		public function nbTrajetsEtNote($idUser){

			$selecPreparee=self::$bdd->prepare('SELECT count(*) as nb, round(avg(note),1) as moyenne FROM commenter WHERE idUtilisateur=? ');
			$tableauIds=array($idUser);
			$selecPreparee->execute($tableauIds);
			return $selecPreparee->fetch();
		}


	}
?>