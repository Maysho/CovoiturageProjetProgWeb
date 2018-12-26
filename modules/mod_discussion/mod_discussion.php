<?php 

include_once 'cont_discussion.php';

class ModDiscussion extends VueGenerique
{
	private $controleur;
	function __construct(){
		//$connexion=new connexion();
		//$connexion->init();
		$this->controleur=new ContDiscussion();

	}


	public function init(){

		if(isset($_SESSION['id'])){
			$idUser=$_SESSION['id'];
			if(isset($_GET['idprofil'])){
				$idInterlocuteur=$_GET['idprofil'];
				if($idUser != $idInterlocuteur){
					$this->controleur->envoieMsgDepuisProfil($_SESSION['id'], $_GET['idprofil']);
					header("Location: ?module=mod_profil&idprofil=$idInterlocuteur&ongletprofil=profil");
				}
			}
			else
				$this->controleur->discussion($_SESSION['id']);
		}

		else
			die("page inaccessible");
			
	}
}
?>
