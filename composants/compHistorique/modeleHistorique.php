<?php

/**
* 
*/
include_once __DIR__ . '/../../connexion.php';
class ModeleHistorique extends connexion
{
	
	function __construct()
	{

	}
	public function Historique($idUser){
		$reqGetListeCar = self::$bdd->prepare("
		SELECT trajet.idTrajet FROM  soustrajet
		INNER JOIN soustrajetutilisateur
		ON soustrajetutilisateur.sousTrajet_idsousTrajet = soustrajet.idsousTrajet
		inner join trajet on soustrajet.idTrajet=trajet.idTrajet 
		WHERE utilisateur_idutilisateur = ? and valide = 1 and suppression=0
		GROUP BY idTrajet
		ORDER BY dateDepart DESC, heureDepart DESC
		LIMIT 3
		");

		$reqGetListeCar->execute(array($idUser));
		$liste= $reqGetListeCar->fetchAll();
		$tab = array();
		foreach ($liste as $key => $value) {
			$tab[$value['idTrajet']]=$this->recupSDepartSArrivee($value['idTrajet']) ;
		}
		return $tab;
	}	

	public function recupSDepartSArrivee($id){
		$selecPreparee=self::$bdd->prepare('SELECT MIN(s1.idsousTrajet) as idDepart ,MAX(s1.idsousTrajet) as idArrivee FROM soustrajet as s1  WHERE s1.idTrajet=? GROUP by s1.idTrajet');
		$tableauIds=array($id);
		$selecPreparee->execute($tableauIds);
		$tab = $selecPreparee->fetch(PDO::FETCH_ASSOC);
		
		$tableau=array();

		$selecPreparee=self::$bdd->prepare('
			SELECT * FROM soustrajet as s1 INNER JOIN ville on s1.idVilleDepart = ville.idVille  WHERE s1.idsousTrajet = ?');
		$selecPreparee->execute(array($tab["idDepart"]));
		$tableau["villeDepart"] = $selecPreparee->fetch(PDO::FETCH_ASSOC);

		$selecPreparee=self::$bdd->prepare('
			SELECT * FROM soustrajet as s1 INNER JOIN ville  on s1.idVilleArrivee = ville.idVille WHERE s1.idsousTrajet = ?');
		$selecPreparee->execute(array($tab["idArrivee"]));
		$tableau["villeArrivee"] = $selecPreparee->fetch(PDO::FETCH_ASSOC);

		return $tableau;
	}
}