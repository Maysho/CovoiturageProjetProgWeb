<?php

/**
* 
*/
class vueFavoris
{
	
	function __construct()
	{

	}
	public function affiche($donnees){
		if (count($donnees)>0) {
			# code...
		
   		?>
   		<div class="col-12 composant border border-dark">
   			<div class="col-12"> 
   				<h4>Favoris Recent</h4>
   			</div>
            <table class="table" style="table-layout: fixed; width:100%;">
                     
   			<?php
   			for ($i=count($donnees)-1; $i >=0 ; $i--) { 
               $prix=$donnees[$i][4]!='100000'?$donnees[$i][4]:'';
               echo " <tr><td class=' text-center'><a class='liensanscouleur' href='index.php?module=mod_resTrajet&action=afficheFavoris&id=".$donnees[$i][0]."'>".$donnees[$i][2]."</a></td><td class=' text-center'><a class='liensanscouleur' href='index.php?module=mod_resTrajet&action=afficheFavoris&id=".$donnees[$i][0]."'>".$donnees[$i][3]."</a></td><td class=' text-center'><a class='liensanscouleur'  href='index.php?module=mod_resTrajet&action=afficheFavoris&id=".$donnees[$i][0]."'>".$prix."</a></td><td class=' text-center'><a class='liensanscouleur' href='index.php?module=mod_resTrajet&action=afficheFavoris&id=".$donnees[$i][0]."'>".$donnees[$i][5]."</a></td><td class='row justify-content-center'><a class='liensanscouleur' href='index.php?module=mod_resTrajet&action=afficheFavoris&id=".$donnees[$i][0]."'>".$donnees[$i][6]."</a></td></tr>";
            }

   			?>
            </table>

   		</div>
   	<?php
   	}
  	}
}