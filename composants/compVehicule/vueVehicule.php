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
		if (count($donnees)>0) {		
   		?>
   		<div class="col-12 composant border border-dark hidden-md-down ">
   			<div class="col-12"> 
   				<h4>Vehicule</h4>
   			</div>
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
            <div class="row justify-content-end">
               <a href="index.php?module=mod_profil&idprofil=1&ongletprofil=vehicules" class="liensanscouleur text-right" style="color: gray;text-decoration: underline;">Tout afficher </a>
            </div>

   		</div>
   	<?php
   	}
  	}
}