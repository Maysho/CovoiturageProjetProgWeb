<?php 

include_once 'cont_profil.php';

class ModProfil extends VueGenerique
{
	private $controleur;
	function __construct(){
		//$connexion=new connexion();
		//$connexion->init();
		$this->controleur=new ContProfil();

	}


	public function init()
	{


		
		
		$idUser=isset($_SESSION['id']) ? $_SESSION['id'] : -1;
		
		if(isset($_GET['idprofil'])){
			$idUser=$_GET['idprofil'];
		}

		if($idUser!==-1){

			$estConnecter = isset($_SESSION['id']) ? true : false;
			$ongletProfil = isset($_GET['ongletprofil']) ? $_GET['ongletprofil'] : 'profil';

			switch ($ongletProfil) {
				case 'profil':
					$this->controleur->accueilProfil($idUser, $estConnecter);
					break;
				
				case 'modif':

					$this->controleur->modifierProfil($idUser, $estConnecter);
					break;

				case 'recupmodif':
					$this->controleur->recupereModifProfil($idUser, $estConnecter);
					break;

				case 'vehicules':
					$this->controleur-> afficheListeVehicule($idUser, $estConnecter);
					break;
				default:
					# code...
					break;
			}


				
		}
		
	}



}








?>
