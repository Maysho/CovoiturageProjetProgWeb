<?php
/**
* 
*/
include_once 'vue_trajet.php';
include_once 'modele_trajet.php';

class cont_trajet
{
	private $modele;
	private $vue;

	function __construct(){
		$this->modele=new modele_trajet();
		$this->vue=new vue_trajet();
	}

	public function formTrajet(){
		
	        if (isset($_GET['action']) && htmlspecialchars($_GET['action'])=="afficheTrajet") {
	        	$idS=$this->modele->recupSDepartSArrivee(htmlspecialchars($_GET['id']));
	        	if (empty($idS)) {
	        		header("Location: index.php");
	        		exit();
	        	}
	        	$tabInfoTrajet=$this->modele->recupInfoTrajet(htmlspecialchars($_GET['id']),$idS);
	        	$tabUser=$this->modele->recupUser(htmlspecialchars($_GET['id']));
	        	$tabinfoSTrajet=$this->modele->recupInfoSousTrajet(htmlspecialchars($_GET['id']));
	        	$tabCommentaire=$this->modele->commentaires(htmlspecialchars($_GET['id']));
	        	$estDansTrajet=false;
	        	$trajetpeutEtreValide=false;
	        	$token=null;
	        	if (isset($_SESSION['id'])) {
	        		$token=$this->modele->actualiseToken($_SESSION['id']);
	        		$estDansTrajet=$this->modele->estDansTrajet(htmlspecialchars($_GET['id']));
	        	}
	        	
	        	$prixAPayer=0;
	        	$trajetValide=false;
	        	if (isset($_SESSION['id'])&&$estDansTrajet) {
	        		$prixAPayer=$this->modele->recupPrixAPayer(htmlspecialchars($_GET['id']));
	        		
	        		$trajetValide=$this->modele->trajetValide(htmlspecialchars($_GET['id']));
	        		
	        	}
				$trajetpeutEtreValide=$this->modele->peutEtreValide(htmlspecialchars($_GET['id']));
	        	

	        	$trajetAeteValide=$this->modele->aEteValide(htmlspecialchars($_GET['id']));
	        	$nbPersDansTrajet=$this->modele->nbPersDansTrajet(htmlspecialchars($_GET['id']));
	        	$etapePers=$this->modele->EtapePers(htmlspecialchars($_GET['id']));
	        	$idPersDansTrajetExceptConducteur=$this->modele->idPersDansTrajetExceptConducteur(htmlspecialchars($_GET['id']));
	        	$idEtapeTrajet=$this->modele->idEtapeTrajet(htmlspecialchars($_GET['id']));
	        	$idConducteurDansTrajet=$this->modele->idConducteurDansTrajet(htmlspecialchars($_GET['id']));
				$personne=array();
	        	include_once 'personne.php';
	        	$personne[$idConducteurDansTrajet[0][0]]=new personne($etapePers[$idConducteurDansTrajet[0][0]],$personne,$tabInfoTrajet[15],$idConducteurDansTrajet[0][0],$idConducteurDansTrajet[0][1]);
	        	foreach ($idPersDansTrajetExceptConducteur as $key => $value) {
	        		include_once 'personne.php';
	        		$personne[$value[0]]=new personne($etapePers[$value[0]],$personne,$tabInfoTrajet[15],$value[0],$value[1]);
	        	}
	        	
	            $this->vue->afficheTrajet(isset($_SESSION['id'])?$_SESSION['id']:0,$tabInfoTrajet,$tabUser,$idS,$tabinfoSTrajet,$tabCommentaire,$estDansTrajet,$prixAPayer[0],$prixAPayer,$trajetAeteValide,$trajetpeutEtreValide,$trajetValide,$nbPersDansTrajet,$personne,$idEtapeTrajet,$token);
	        }
	        else{
	           if(isset($_SESSION['id'])){
				$listeVehicule = $this->modele->getListeVehicule();
				$this->vue->formCreation($listeVehicule);
				}else{
				header("Location: index.php?module=mod_connexion");
		
        }
			}
		
    }
	public function AffichePageTrajet($value='')
	{
		# code...
	}
	/*public function verifieInscription($email,$emailConf,$nom,$prenom,$mdp,$mdpConf){
		$this->modele->verifieInscription($email,$emailConf,$nom,$prenom,$mdp,$mdpConf);

		if(isset($_SESSION['id'])){
			$listeVehicule = $this->modele->getListeVehicule();
			$this->vue->formCreation($listeVehicule);
		}
		else{
			header("Location: index.php?module=mod_connexion");
		}

	}*/

}?>