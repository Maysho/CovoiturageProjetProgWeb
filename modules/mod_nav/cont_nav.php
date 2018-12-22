<?php
/**
* 
*/
include_once 'vue_nav.php';
class cont_nav
{
	private $vue;
	function __construct()
	{
		$this->vue=new vue_nav();
	}
	public function nav()
	{
		if(isset($_SESSION['id'])){
			$this->vue->navConnecte();
		}
		else{
			$this->vue->navNonConnecte();
		}
		
	}


}?>