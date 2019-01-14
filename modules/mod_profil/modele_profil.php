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
			$selectPreparee=self::$bdd->prepare('SELECT nom, prenom, dateDeNaissance, sexe, adresseMail, description, urlPhoto FROM utilisateur WHERE idUtilisateur=? ');
			$tableauIds=array($idUser);
			$selectPreparee->execute($tableauIds);
			return $selectPreparee->fetch();
		}

		else{
			$selectPreparee=self::$bdd->prepare('SELECT nom, prenom, dateDeNaissance, sexe, description, urlPhoto FROM utilisateur WHERE idUtilisateur=? ');
			$tableauIds=array($idUser);
			$selectPreparee->execute($tableauIds);
			return $selectPreparee->fetch();
		}

	}

	public function recupereInfoUtilisateurModif($idUser){
		
			$selectPreparee=self::$bdd->prepare('SELECT nom, prenom, dateDeNaissance, sexe, adresseMail, description, urlPhoto FROM utilisateur WHERE idUtilisateur=? ');
			$tableauIds=array($idUser);
			$selectPreparee->execute($tableauIds);
			return $selectPreparee->fetch();
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
	
	public function nbTrajetsEtNote($idUser){

		$selectPreparee=self::$bdd->prepare('SELECT count(*) as nb, round(avg(note),1) as moyenne FROM commenter WHERE idUtilisateur=? ');
		$tableauIds=array($idUser);
		$selectPreparee->execute($tableauIds);
		return $selectPreparee->fetch();
	}

	public function commentaires($idUser){

			$selectPreparee=self::$bdd->prepare('SELECT (SELECT prenom from utilisateur where idUtilisateur=idAuteur) as prenom, idAuteur, date_format(date,"%d/%m/%Y") AS date, note, commenter.description FROM utilisateur INNER JOIN commenter on utilisateur.idUtilisateur = commenter.idUtilisateur WHERE utilisateur.idUtilisateur=? and commenter.description is not null order by date DESC');
			$tableauIds=array($idUser);
			$selectPreparee->execute($tableauIds);
			return $selectPreparee->fetchAll();
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
		if(strlen($description)>1024){
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

		$selectPreparee=self::$bdd->prepare('SELECT urlPhoto from utilisateur where idUtilisateur=?');
		$tableauIds=array($idUser);
		$selectPreparee->execute($tableauIds);
		$resultselect=$selectPreparee->fetch();

		$ancienUrl=null;

		if($resultselect['urlPhoto']!=null)
			$ancienUrl=$resultselect['urlPhoto'];

		if($_FILES['photoprofil']['size']>0){
			if($ancienUrl!=null)
				unlink($ancienUrl);
			$extension_upload = strtolower(  substr(  strrchr($_FILES['photoprofil']['name'], '.')  ,1)  );
			$nomFich=$idUser.'.'.$extension_upload;
			$result=move_uploaded_file($_FILES['photoprofil']['tmp_name'], "sources/images/photoProfil/".$nomFich);

			if($result){
				return "sources/images/photoProfil/".$nomFich;
			}
		}
		else 
			return $ancienUrl;
	}

	public function verifieModificationProfil($idUser){

		$token=htmlspecialchars($_POST['token']);

		if(!$this->verifieToken($idUser, $token)){
			http_response_code(400);
			echo 'Une erreur dans le certificat c\'est produite veuillez réessayer';
			exit(1);
		}

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
				$selectPreparee=self::$bdd->prepare('SELECT adresseMail FROM utilisateur WHERE idUtilisateur=? ');
				$tableauIds=array($idUser);
				$selectPreparee->execute($tableauIds);
				$tab=$selectPreparee->fetch();
				$email=$tab['adresseMail'];
		}

		
		$urlPhoto = self::enregistrePhotoProfil($idUser);			
		self::updateProfil($email, $nom, $prenom, $sexe, $date, $description, $idUser, $urlPhoto);			
			
	}

	public function actualiseToken($idUser)
    {
        $lettrePossible = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','0','1','2','3','4','5','6','7','8','9');
        $token="";
        for ($i=0; $i < 10; $i++) { 
            $token=$token.$lettrePossible[rand(0,61)];
        }
        $insertPreparee=self::$bdd->prepare('UPDATE utilisateur SET token = :token WHERE idUtilisateur=:idUtilisateur');
        $insertPreparee -> execute(array('token'=>$token,'idUtilisateur'=>$idUser));
        return $token;
    }


	private function verifieToken($idUser,$token)
    {
        $selecPrepareeUnique=self::$bdd->prepare('SELECT token FROM utilisateur where idUtilisateur=? and token=?');
        $tableauIds=array($idUser,$token);
        $selecPrepareeUnique->execute($tableauIds);
        $unique=$selecPrepareeUnique->fetch();
        if (empty($unique['token'])) {
            return false;
        }
        return true;
    }

	public function verifieModificationMdp($idUser){
		$resultat;
		$mdpActuel;

		if(isset($_POST['mdpActuel']) && isset($_POST['nouveauMdp']) && isset($_POST['nouveauMdpConf'])){
			$mdpActuel=htmlspecialchars($_POST['mdpActuel']);
			if($this->ancienMdpEstValide($idUser, $mdpActuel)){
				if($this->nouveauMdpEstValide($_POST['nouveauMdp'], $_POST['nouveauMdpConf'])){
					$this->modifierMdp($idUser, $_POST['nouveauMdp']);
					return 0;
				}
				else return 2;
			}
			else return 1;		
		}
		else return 2;
	}

	private function ancienMdpEstValide($idUser, $mdp){
		$selectPreparee=self::$bdd->prepare('SELECT motDePasse AS mdp FROM utilisateur WHERE idUtilisateur=?');
		$tableauVal = array($idUser);
		$selectPreparee->execute($tableauVal);
		$mdpBD=$selectPreparee->fetch();
		$mdpBD=$mdpBD['mdp'];

		$mdpHash=crypt($mdp, '$6$rounds=5000$usesomesillystringforsalt$');

		if($mdpBD==$mdpHash)
			return true;
		else
			return false;
	}

	private function nouveauMdpEstValide($mdp,$mdpConf){

		if (!preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{8,})#', $mdp)) 
			return false;
		
		if ($mdp!=$mdpConf) 
			return false;
		
		return true;
	}

	private function modifierMdp($idUser, $mdp){
		$updatePreparee=self::$bdd->prepare('UPDATE utilisateur SET motDePasse = :mdp WHERE idUtilisateur=:id');
		$mdpHash=crypt($mdp, '$6$rounds=5000$usesomesillystringforsalt$');
		$updatePreparee -> execute(array('mdp'=>$mdpHash,'id'=>$idUser));
	}

	public function getListeVehicules($idUser){
		$reqGetListeCar = self::$bdd->prepare("
		SELECT *  from vehicule inner join vehiculeutilisateur on vehicule.immatriculation =vehiculeutilisateur.immatriculation where idUtilisateur = ?
		");
		$reqGetListeCar->execute(array($idUser));
		$liste= $reqGetListeCar->fetchAll();
		return $liste;

	}
	public function getListeFavoris($idUser)
	{
		$reqGetListeFavoris = self::$bdd->prepare("SELECT * from favoris  where idUtilisateur = ?");
		$reqGetListeFavoris->execute(array($idUser));
		$liste= $reqGetListeFavoris->fetchAll();
		return $liste;
	}
	public function retireFavoris($idFavoris='')
	{
		$reqGetListeFavoris = self::$bdd->prepare("DELETE from favoris  where idFavoris = ? and idUtilisateur=?");
		$reqGetListeFavoris->execute(array($idFavoris,$_SESSION['id']));
		echo "success";
	}

	public function getListeTrajetsReserves($idUser){
		date_default_timezone_set('Europe/Paris');
		$date =date('Y-m-d');
		$reqGetListeCar = self::$bdd->prepare("
		SELECT idTrajet  FROM  soustrajet
		INNER JOIN soustrajetutilisateur
		ON soustrajetutilisateur.sousTrajet_idsousTrajet = soustrajet.idsousTrajet
		WHERE utilisateur_idutilisateur = ? AND valide = 0 AND dateDepart >= ?
		GROUP BY idTrajet
		ORDER BY dateDepart DESC, heureDepart DESC
		LIMIT 10
		");

		$reqGetListeCar->execute(array($idUser, $date));
		$liste= $reqGetListeCar->fetchAll();
		$tab = array();
		foreach ($liste as $key => $value) {
			$tab[$value['idTrajet']]=$this->recupSDepartSArrivee($value['idTrajet']) ;
		}
		return $tab;
	}

	public function getListeHistorique($idUser){
		$reqGetListeCar = self::$bdd->prepare("
		SELECT idTrajet  FROM  soustrajet
		INNER JOIN soustrajetutilisateur
		ON soustrajetutilisateur.sousTrajet_idsousTrajet = soustrajet.idsousTrajet
		WHERE utilisateur_idutilisateur = ? 
		GROUP BY idTrajet
		ORDER BY dateDepart DESC, heureDepart DESC
		LIMIT 10
		");

		$reqGetListeCar->execute(array($idUser));
		$liste= $reqGetListeCar->fetchAll();
		$tab = array();
		foreach ($liste as $key => $value) {
			$tab[$value['idTrajet']]=$this->recupSDepartSArrivee($value['idTrajet']) ;
		}
		return $tab;
	}

	public function recupSDepartSArrivee($id){
		$selecPreparee=self::$bdd->prepare('SELECT MIN(s1.idsousTrajet) as idDepart ,MAX(s1.idsousTrajet) as idArrivee FROM soustrajet as s1  WHERE s1.idTrajet=? GROUP by s1.idTrajet');
		$tableauIds=array($id);
		$selecPreparee->execute($tableauIds);
		$tab = $selecPreparee->fetch(PDO::FETCH_ASSOC);
		
		$tableau=array();

		$selecPreparee=self::$bdd->prepare('
			SELECT * FROM soustrajet as s1  INNER JOIN ville on s1.idVilleDepart = ville.idVille  WHERE s1.idsousTrajet = ?');
		$selecPreparee->execute(array($tab["idDepart"]));
		$tableau["villeDepart"] = $selecPreparee->fetch(PDO::FETCH_ASSOC);

		$selecPreparee=self::$bdd->prepare('
			SELECT * FROM soustrajet as s1  INNER JOIN ville  on s1.idVilleArrivee = ville.idVille WHERE s1.idsousTrajet = ?');
		$selecPreparee->execute(array($tab["idArrivee"]));
		$tableau["villeArrivee"] = $selecPreparee->fetch(PDO::FETCH_ASSOC);

		return $tableau;
		// return $tab;
	}

	

	
}

?>