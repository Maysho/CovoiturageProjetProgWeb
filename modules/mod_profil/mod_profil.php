<?php 

include_once 'cont_profil.php';
class ModProfil
{
	
	function __construct(){
		//$connexion=new connexion();
		//$connexion->init();
		$this->init();

	}
	public function init()
	{
		$action='profil';
		if(isset($_GET['action'])){

			$action=$_GET['action'];
		}


		$controleur=new ContProfil();
		$controleur-> accueilProfil();
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