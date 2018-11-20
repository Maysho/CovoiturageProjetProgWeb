<?php /**
* 
*/
include_once 'cont_accueil.php';
class ModAccueil extends VueGenerique
{
	
	function __construct(){
		$connexion=new connexion();
		$connexion->init();
		
	}
	public function init()
	{

		$controleur=new ContAccueil();
		$controleur->affiche();

	}
	



}

?>