<?php

/**
* 
*/
class VueTrajetReserve
{
	
	function __construct()
	{

	}
	public function affiche($donnees){
		if (count($donnees)>0) {		
   		?>
   		<div class="col-12 composant border border-dark hidden-md-down ">
   			<div class="col-12"> 
   				<h4>TrajetReserve</h4>
   			</div>
            <table class="table" style="table-layout: fixed; width:100%;">
                     
   			<?php
            foreach ($donnees as $key => $value) {
            ?>
               <tr>
                  <td class="text-center">
                     <a class="liensanscouleur" href="index.php?module=mod_trajet&action=afficheTrajet&id=<?php echo $value["villeDepart"]["idTrajet"]?>">
                     <?php echo $value["villeDepart"]["dateDepart"]?> 
                     </a>
                  </td>
                  <td class="text-center">
                     <a class="liensanscouleur" href="index.php?module=mod_trajet&action=afficheTrajet&id=<?php echo $value["villeDepart"]["idTrajet"]?>">
                     <?php echo $value["villeDepart"]["nomVille"]?> 
                     </a>
                  </td>
                  <td class="text-center"><i class="fas fa-long-arrow-alt-right"></i></td>
                  <td class="text-center">
                     <a class="liensanscouleur" href="index.php?module=mod_trajet&action=afficheTrajet&id=<?php echo $value["villeDepart"]["idTrajet"]?>">
                     <?php echo $value["villeArrivee"]["nomVille"]?> 
                     </a>
                  </td>
               </tr> 
            <?php
            }
            ?>
            </table>
            <div class="row justify-content-end">
               <a href="index.php?module=mod_profil&idprofil=1&ongletprofil=trajets" class="liensanscouleur text-right" style="color: gray;text-decoration: underline;">Tout afficher </a>
            </div>

   		</div>
   	<?php
   	}
  	}
}