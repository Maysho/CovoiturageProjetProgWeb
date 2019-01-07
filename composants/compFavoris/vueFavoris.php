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
   		<div class="col-12 composant border border-dark hidden-md-down ">
   			<div class="col-12"> 
   				<h4>Favoris Recent</h4>
   			</div>
            <table class="table" style="table-layout: fixed; width:100%;">
                     
   			<?php
   			for ($i=count($donnees)-1; $i >=0 ; $i--) { 
               $prix=$donnees[$i][4]!='100000'?$donnees[$i][4]:'';
               $regulier=$donnees[$i][6]==1?"oui":'non';
               echo " <tr><td class=' text-center'><a class='liensanscouleur' href='index.php?module=mod_resTrajet&action=afficheFavoris&id=".$donnees[$i][0]."'><span>".$donnees[$i][2]."</span></a></td><td class=' text-center'><a class='liensanscouleur' href='index.php?module=mod_resTrajet&action=afficheFavoris&id=".$donnees[$i][0]."'><span>".$donnees[$i][3]."</span></a></td><td class=' text-center'><a class='liensanscouleur'  href='index.php?module=mod_resTrajet&action=afficheFavoris&id=".$donnees[$i][0]."'><span>".$prix."</span></a></td><td class=' text-center'><a class='liensanscouleur' href='index.php?module=mod_resTrajet&action=afficheFavoris&id=".$donnees[$i][0]."'><span>".$donnees[$i][5]."</span></a></td><td class='text-center'><a class='liensanscouleur' href='index.php?module=mod_resTrajet&action=afficheFavoris&id=".$donnees[$i][0]."'><span>".$regulier."</span></a></td></tr>";
            }

   			?>
            </table>
            <div class="row justify-content-end">
               <a href="index.php?module=mod_profil&idprofil=1&ongletprofil=favoris" class="liensanscouleur text-right" style="color: gray;text-decoration: underline;">en afficher plus... </a>
            </div>

   		</div>
   	<?php
   	}
  	}
}