<?php

/**
* 
*/
class VueVehicule
{
	
	function __construct()
	{

	}
	public function affiche($donnees){
      ?>
         <div class="col-12 composant rounded hidden-md-down ">
   			<div class="headline_composant col-12"> 
   				<h4>Vehicule</h4>
   			</div>
            <div class="component_composant rounded">
      <?php
      if (count($donnees)>0) {      
         ?>
               <table class="table" style="table-layout: fixed; width:100%;">
                     
   			<?php
            foreach ($donnees as $key => $value) {
            ?>
                  <tr>
                     <td class=" text-center ">
                        <?php echo $value['immatriculation']?>
                     </td>
                     <td class=" text-center ">
                        <a href="<?php echo $value['urlPhoto']?>">Voir&nbsp<i class="fas fa-search-plus"></i></a>
                     </td>
                  </tr>
            <?php
            }
            ?>
               </table>
               <div class="row no-gutters justify-content-end">
                  <a href="index.php?module=mod_profil&idprofil=1&ongletprofil=vehicules" class="liensanscouleur text-right">Tout afficher </a>
               </div>
   	<?php
      }else{
      ?>
         <span>Vous n'avez aucun Véhicule</span>
      <?php
      }
      ?>
            </div>
         </div>
      <?php
   }
}

?>