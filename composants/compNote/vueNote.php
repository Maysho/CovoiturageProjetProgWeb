<?php

class vueNote
{
	
	function __construct(){}

	public function affiche($note){
?>
		<div class="col-12 composant border border-dark hidden-md-down">
         <div class="col-12"> 
            <h4>Note moyenne :</h4>
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