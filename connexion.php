<?php 
/**
* 
*/
class connexion 
{
	protected static $bdd;
	function __construct()
	{
		# code...

		
	}


	public static function init()
	{
		/* Connexion à une base MySQL avec l'invocation de pilote */
		try {
		    self::$bdd = new PDO('mysql:host=localhost;dbname=dutinfopw201623;charset=utf8', 'root', '');
		} catch (PDOException $e) {
   			echo 'Connexion échouée : ' . $e->getMessage();
		}
		
	}

}

?>