<?php

class vueNote
{
	
	function __construct(){}

	public function affiche($note){
?>
		<div class="col-12 composant rounded hidden-md-down">
         <div class="headline_composant col-12"> 
            <h4>Note moyenne :</h4>
         </div>
         <div class="component_composant rounded">
         
<?php
      if ($note!=NULL) {
         echo " <h3 class='text-center'>$note/20</h3>";
      }
      else
         echo "Vous n'avez reçu aucune note pour le moment.";

            
?>

         </div>
      </div>
<?php
	}
}
?>