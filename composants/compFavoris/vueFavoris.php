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
		
			# code...
		
   		?>
   		<div class="col-12 composant border border-dark hidden-md-down ">
   			<div class="col-12"> 
   				<h4>Favoris Recent:</h4>
   			</div>
            <?php if (count($donnees)<=0) {
               echo "<span>Vous n'avez mis aucune recherche en favoris</span>";
            }
            else{ ?>
            <table class="table">
                     
   			<?php

   			for ($i=count($donnees)-1; $i >=0 ; $i--) { 
               echo " <tr>
               <td class=' text-center'><a class='liensanscouleur' href='index.php?module=mod_resTrajet&action=afficheFavoris&id=".$donnees[$i][0]."'>".$donnees[$i][2]."</a></td>
               <td class'text-center'> <i class='fas fa-long-arrow-alt-right'></i></td>
               <td class=' text-center'><a class='liensanscouleur' href='index.php?module=mod_resTrajet&action=afficheFavoris&id=".$donnees[$i][0]."'>".$donnees[$i][3]."</a></td></tr>";
            }

   			?>
            </table>
            <div class="row justify-content-end">
               <a href="index.php?module=mod_profil&idprofil=1&ongletprofil=favoris" class="liensanscouleur text-right" style="color: gray;text-decoration: underline;">en afficher plus... </a>
            </div>
            <?php } ?>

   		</div>
   	<?php
   	
  	}
}