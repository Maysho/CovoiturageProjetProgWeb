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
   		<div class="col-12 composant rounded hidden-md-down ">
   			<div class="headline_composant col-12"> 
   				<h4>Favoris Recent:</h4>
   			</div>
				<div class="component_composant rounded">
            <?php if (count($donnees)<=0) {
               echo "<span>Vous n'avez mis aucune recherche en favoris</span>";
            }
            else{ ?>
            	<table class="table">
                     
   			<?php

   			for ($i=count($donnees)-1; $i >=0 ; $i--) { 
               $premier=count($donnees)-1==$i?' border-top-0':"";
               echo " <tr>
               <td class='text-center".$premier."'><a class='liensanscouleur' href='index.php?module=mod_resTrajet&action=afficheFavoris&id=".$donnees[$i][0]."'>".$donnees[$i][2]."</a></td>
               <td class='text-center ".$premier."'> <i class='fas fa-long-arrow-alt-right'></i></td>
               <td class=' text-center ".$premier."'><a class='liensanscouleur' href='index.php?module=mod_resTrajet&action=afficheFavoris&id=".$donnees[$i][0]."'>".$donnees[$i][3]."</a></td></tr>";
            }

   			?>
           		</table>
					<div class="row no-gutters justify-content-end">
						<a href="index.php?module=mod_profil&idprofil=<?php echo $_SESSION['id'];?>&ongletprofil=favoris" class="liensanscouleur text-right" >en afficher plus... </a>
					</div>
            <?php } ?>
					</div>
				</div>
   	<?php
   	
  	}
}