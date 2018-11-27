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
		$this->controleur-> accueilProfil();
		/*
		$action='profil';
		if(isset($_GET['action'])){

			$action=$_GET['action'];
		}


		
		
		/*switch ($action) {
			case 'liste':
				$controleur->liste();
				break;
			case 'details':
				$controleur->details();
				break;
			case 'form':
				$controleur->form_ajout();
				break;
			case 'ajout':
				$controleur->ajout($_POST['nom'],$_POST['description']);
				break;

			default:
				
				break;
		}*/
	}



}








?>
