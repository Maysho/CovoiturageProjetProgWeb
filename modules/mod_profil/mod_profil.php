<?php 

include_once 'cont_profil.php';

class ModProfil extends VueGenerique
{
	private $controleur;
	
	function __construct(){
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

				case 'recupmodifmdp':
					$this->controleur->recupereModifMdp($idUser, $estConnecter);
					break;

				case 'vehicules':
					$this->controleur-> afficheListeVehicule($idUser, $estConnecter);
					break;

				case 'trajets':
					$this->controleur-> afficheTrajetsReserves($idUser, $estConnecter);
					break;

				case 'historique':
					$this->controleur-> afficheHistorique($idUser, $estConnecter);
					break;

				case 'favoris':
					$this->controleur-> afficheListeFavoris($idUser, $estConnecter);
					break;

				default:
					die("Erreur 404");
					break;
			}
		}
		else 
			header("Location: index.php");
	}
}

?>
