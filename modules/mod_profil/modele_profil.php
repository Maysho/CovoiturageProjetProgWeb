<?php

include_once __DIR__ . '/../../connexion.php';
	class ModeleProfil extends connexion{

		private $msg;

		function __construct(){
			$connexion=new connexion();
			$connexion->init();
			$this->msg="";
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




		public function recupereInfoUtilisateurModif($idUser){
			
				$selecPreparee=self::$bdd->prepare('SELECT nom, prenom, dateDeNaissance, sexe, adresseMail, description, urlPhoto FROM utilisateur WHERE idUtilisateur=? ');
				$tableauIds=array($idUser);
				$selecPreparee->execute($tableauIds);
				return $selecPreparee->fetch();
		}




		public function estPagePerso($idUser){
			return $idUser===$_SESSION['id'];
		}




		public function traduitResultatRequete($result){
			if(isset($result['sexe']))
				$result['sexe']=$result['sexe'] == 0 ? 'femme' : 'homme';

			if(isset($result['dateDeNaissance']))
				$result['dateDeNaissance']=self::traduitAge($result['dateDeNaissance']);

			return $result;
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




		private function erreurDansModif($email, $emailConfirm, $nom, $prenom, $sexe, $date, $description){
			$erreur=false;
			if(!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)){
				 $this->msg=$this->msg."00-";
				$erreur=true;
			}
			if (!($emailConfirm==$email)) {
				$this->msg= $this->msg."01-";

				$erreur=true;
			}
			if (!preg_match('#^[a-zA-Z]+[-]{0,1}[a-zA-Z]+$#', $nom)) {
				$this->msg=$this->msg."02-";
				$erreur=true;
			}
			if (!preg_match('#^[a-zA-Z]+[-]{0,1}[a-zA-Z]+$#', $prenom)) {
				$this->msg=$this->msg."03-";
				$erreur=true;
			}
			if($sexe != 0 && $sexe != 1){
				$this->msg=$this->msg."10-";
				$erreur = true;
			}

			if($date != null && self::traduitAge($date)<18){
				$this->msg=$this->msg."11-";
				$erreur = true;
			}
			if(strlen($description)>1023){
				$this->msg=$this->msg."12-";
				$erreur = true;
			}
			return $erreur;	
		}




		private function erreurDansUploadImage(){
			$erreur=false;

			if($_FILES['photoprofil']['size']>0){
				if($_FILES['photoprofil']['error']>0){
					$this->msg=$this->msg."20-";
					$erreur=true;
				}
				if($_FILES['photoprofil']['size']>5000000){
					$this->msg=$this->msg."21-";
					$erreur=true;
				}
				$extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
				$extension_upload = strtolower(  substr(  strrchr($_FILES['photoprofil']['name'], '.')  ,1)  );

				if (!in_array($extension_upload,$extensions_valides)){
					$this->msg=$this->msg."22-";
					$erreur=true;
				}
			}
		
			return $erreur;
		}




		private function updateProfil($email, $nom, $prenom, $sexe, $date, $description, $idUser, $urlPhoto){
			$insertPrepare=self::$bdd->prepare('UPDATE utilisateur SET adresseMail =:mail, nom=:nom, prenom=:prenom, sexe=:sexe, dateDeNaissance=:datenaiss, description=:descri, urlPhoto=:urlphoto WHERE idUtilisateur=:iduser');
			if($date != null)
			$tableauVal=array('mail'=>$email, 'nom'=>$nom, 'prenom'=>$prenom, 'sexe'=>$sexe, 'datenaiss'=>$date, 'descri'=>$description, 'iduser'=>$idUser, 'urlphoto'=>$urlPhoto);
			else
				$tableauVal=array('mail'=>$email, 'nom'=>$nom, 'prenom'=>$prenom, 'sexe'=>$sexe, 'datenaiss'=>null, 'descri'=>$description, 'iduser'=>$idUser, 'urlphoto'=>$urlPhoto);
			$insertPrepare->execute($tableauVal);

		}





		private function enregistrePhotoProfil($idUser){

			$selecPreparee=self::$bdd->prepare('SELECT urlPhoto from utilisateur where idUtilisateur=?');
			$tableauIds=array($idUser);
			$selecPreparee->execute($tableauIds);
			$resultselect=$selecPreparee->fetch();

			$ancienUrl=null;

			if($resultselect['urlPhoto']!=null)
				$ancienUrl=$resultselect['urlPhoto'];

			if($_FILES['photoprofil']['size']>0){
				unlink($ancienUrl);
				$extension_upload = strtolower(  substr(  strrchr($_FILES['photoprofil']['name'], '.')  ,1)  );
				$nomFich=$idUser.'.'.$extension_upload;
				$result=move_uploaded_file($_FILES['photoprofil']['tmp_name'], "sources/images/photoProfil/".$nomFich);

				if($result)
					return "sources/images/photoProfil/".$nomFich;
			}
			else 
				return $ancienUrl;
		}




		public function verifieModificationProfil( $idUser){

			$prenom = htmlspecialchars($_POST['prenom']);
			$nom = htmlspecialchars($_POST['nom']);
			$email = htmlspecialchars($_POST['Email']);
			$emailConfirm = htmlspecialchars($_POST['confirmationEmail']);
			$date = $_POST['datedenaissance'];
			$sexe = isset($_POST['sexe'])?$_POST['sexe'] : null;
			$description = htmlspecialchars($_POST['description']);

			if(self::erreurDansModif($email, $emailConfirm, $nom, $prenom, $sexe, $date, $description) || self::erreurDansUploadImage()){
				http_response_code(400);
				echo $this->msg;
				exit(1);
			}

			else if($email == null){
					$selecPreparee=self::$bdd->prepare('SELECT adresseMail FROM utilisateur WHERE idUtilisateur=? ');
					$tableauIds=array($idUser);
					$selecPreparee->execute($tableauIds);
					$tab=$selecPreparee->fetch();
					$email=$tab['adresseMail'];
			}

			
			$urlPhoto = self::enregistrePhotoProfil($idUser);			
			self::updateProfil($email, $nom, $prenom, $sexe, $date, $description, $idUser, $urlPhoto);			
				
		}

	}
?>