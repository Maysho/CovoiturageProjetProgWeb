<?php

/**
* personne du trajet
*/

class personne {

	private $tabEtape;
	private $tabPersonne;
	private $place;
	private $id;
	private $urlPhoto;
	function __construct($tabEtape,&$tabPersonne,$maxPersonne,$id,$urlPhoto){
		$this->tabEtape=$tabEtape;
		$this->tabPersonne=&$tabPersonne;
		$this->id=$id;
		$this->urlPhoto=$urlPhoto;
		$place=0;
		$placeTrouve=0;
		$conteurEtape=0;
		//var_dump($tabPersonne);
		while ($conteurEtape<count($tabEtape)) {
			for ($i=$place; $i <$maxPersonne ; $i++) { 
				if (self::placeDispo($i,$tabEtape[$conteurEtape][0])) {
					
					$placeTrouve=$i;
					
					break;
				}
			}
			if ($place!=0 && $place!=$placeTrouve) {
				$conteurEtape=0;
			}
			$conteurEtape=$conteurEtape+1;
			$place=$placeTrouve;
		}
		$this->place=$place;
		//array_push($tabPersonne,$this);


	}
	public function placeDispo($place,$etape)
	{
		
		foreach ($this->tabPersonne as $key => $value) {
			if (self::getPlaceUtilise($etape,$value)==$place) {
				
				return false;
			}
		}
		
		return true;
	}
	public function getPlace()
	{
		return $this->place;
	}
	public function getId()
	{
		return $this->id;
	}
	public function getUrlPhoto()
	{
		return $this->urlPhoto;
	}
	public function getTabEtape()
	{
		return $this->tabEtape;
	}
	public function utilisePlace($etape,$place)
	{
		foreach ($this->getTabEtape() as $key => $value) {
			if ($value[0]==$etape) {
				return $this->getPlace()==$place;
			}
		}
		return false;
	}
	public function getPlaceUtilise($etape,$perso)
	{
	
		foreach ($perso->getTabEtape() as $key => $value) {
			if ($value[0]==$etape) {
				return $perso->getPlace();
			}
		}
		return -5;
	}
			

}