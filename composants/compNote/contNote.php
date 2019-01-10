<?php
/**
* 
*/
include_once 'vueNote.php';
include_once 'modeleNote.php';

class contNote
{
	private $vue;
	function __construct()
	{
		$this->vue=new vueNote();
		$this->modele=new modeleNote();
	}
	public function affiche()
	{
		$note=$this->modele->note($_SESSION['id']);
		$this->vue->affiche($note);
	}
	
}