<?php
/**
* 
*/
include_once 'vueTest.php';
class contTest
{
	private $vue;
	function __construct()
	{
		$this->vue=new vueTest();
	}
	public function affiche()
	{
		$this->vue->affiche();
	}
	
}