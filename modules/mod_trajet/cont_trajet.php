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
		if(isset($_SESSION['id'])){
	        if (isset($_GET['action']) && htmlspecialchars($_GET['action'])=="afficheTrajet") {
	        	$idS=$this->modele->recupSDepartSArrivee(htmlspecialchars($_GET['id']));
	        	$tabInfoTrajet=$this->modele->recupInfoTrajet(htmlspecialchars($_GET['id']),$idS);
	        	$tabUser=$this->modele->recupUser(htmlspecialchars($_GET['id']));
	        	$tabinfoSTrajet=$this->modele->recupInfoSousTrajet(htmlspecialchars($_GET['id']));
	        	$tabCommentaire=$this->modele->commentaires(htmlspecialchars($_GET['id']));
	            $this->vue->afficheTrajet(isset($_SESSION['id'])?1:0,$tabInfoTrajet,$tabUser,$idS,$tabinfoSTrajet,$tabCommentaire);
	        }
	        else{
	           
				$listeVehicule = $this->modele->getListeVehicule();
				$this->vue->formCreation($listeVehicule);
			}
		}else{
				header("Location: index.php?module=mod_connexion");
		
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