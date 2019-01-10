<?php

include_once 'contNote.php';
class compNote{
	
	function __construct(){}

	public function affiche()
	{
		$controleur=new ContNote();
		$controleur->affiche();
	}
}