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
			$this->controleur->discussion($_SESSION['id']);
		}

		else
			header("Location: index.php");
			
	}
}
?>
