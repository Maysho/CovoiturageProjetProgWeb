<?php
/**
* 
*/
include_once 'vueMenu.php';
class contMenu
{
	private $vue;
	function __construct()
	{
		$this->vue=new vueMenu();
	}
	public function affiche()
	{
		$this->vue->afficheMenu();
	}
	
}