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
					if(isset($_GET['resultat'])){
						$resultat=$_GET['resultat'];
						$this->controleur->accueilProfil($idUser, $estConnecter, $resultat);
					}
					else 
						$this->controleur->accueilProfil($idUser, $estConnecter, null);
					break;
				
				case 'modif':

					$this->controleur->modifierProfil($idUser, $estConnecter);
					break;

				case 'recupmodif':
					$this->controleur->recupereModifProfil($idUser, $estConnecter);
					break;


				case 'recupmodifmdp':
					$this->controleur->recupereModifMdp($idUser, $estConnecter);
					break;

				case 'modifMdp':
					if(isset($_GET['resultat'])){
						$resultat=$_GET['resultat'];
						$this->controleur->accueilProfil($idUser, $estConnecter, $resultat);
					}
					break;

				case 'vehicules':
					$this->controleur-> afficheListeVehicule($idUser, $estConnecter);
					break;
				case 'favoris':
				
					$this->controleur-> afficheListeFavoris($_SESSION['id']);
					break;
				default:
					die("page inaccessible");
					break;
			}


				
		}
		
	}



}








?>
