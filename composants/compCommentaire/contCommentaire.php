<?php
/**
* 
*/
include_once 'vueCommentaire.php';
include_once 'modeleCommentaire.php';

class contCommentaire
{
	private $vue;
	function __construct()
	{
		$this->vue=new vueCommentaire();
		$this->modele=new modeleCommentaire();
	}
	public function affiche()
	{
		
		$infoCom=$this->modele->commentaires($_SESSION['id']);
		$this->vue->affiche($infoCom);
	}
	
}