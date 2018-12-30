<?php
/**
* 
*/
include_once 'contCommentaire.php';
class compCommentaire
{
	
	function __construct()
	{
	}
	public function affiche()
	{
		$controleur=new ContCommentaire();
		$controleur->affiche();
	}
}