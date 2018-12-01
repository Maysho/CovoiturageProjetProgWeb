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
			$this->controleur->accueilProfil($idUser, $estConnecter);	
		
		}
		
	}



}








?>
