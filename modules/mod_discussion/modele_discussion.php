<?php

include_once __DIR__ . '/../../connexion.php';

	class ModeleDiscussion extends connexion{

		private $msg;

		function __construct(){
			$connexion=new connexion();
			$connexion->init();
			$this->msg="";
		}
	}
?>