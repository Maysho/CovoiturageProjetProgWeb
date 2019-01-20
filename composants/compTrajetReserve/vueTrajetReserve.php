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
      ?>
   		<div class="col-12 composant rounded hidden-md-down ">
            <div class="headline_composant col-12"> 
               <h4>Trajet Reserve</h4>
   			</div>
            <div class="component_composant rounded">
      <?php
      if (count($donnees)>0) {      
         ?>
            <table class="table">
               <tbody>      
   			<?php
            $compteur=0;
            foreach ($donnees as $key => $value) {
               $premier=$compteur==0?' border-top-0':"";
            ?>
                  <tr>
                     <td class="text-center <?php echo $premier;?>">
                        <a class="liensanscouleur" href="index.php?module=mod_trajet&action=afficheTrajet&id=<?php echo $value["villeDepart"]["idTrajet"]?>">
                        <?php echo $value["villeDepart"]["dateDepart"]?> 
                        </a>
                     </td>
                     <td class="text-center <?php echo $premier;?>">
                        <a class="liensanscouleur" href="index.php?module=mod_trajet&action=afficheTrajet&id=<?php echo $value["villeDepart"]["idTrajet"]?>">
                        <?php echo $value["villeDepart"]["nomVille"]?> 
                        </a>
                     </td>
                     <td class="text-center <?php echo $premier;?>"><i class="fas fa-long-arrow-alt-right"></i></td>
                     <td class="text-center <?php echo $premier;?>">
                        <a class="liensanscouleur" href="index.php?module=mod_trajet&action=afficheTrajet&id=<?php echo $value["villeDepart"]["idTrajet"]?>">
                        <?php echo $value["villeArrivee"]["nomVille"]?> 
                        </a>
                     </td>
                  </tr> 
            <?php
            $compteur++;
            }
            ?>
               </tbody>
            </table>
            <div class="row no-gutters justify-content-end">
               <a href="index.php?module=mod_profil&idprofil=<?php echo $_SESSION['id'];?>&ongletprofil=trajets" class="liensanscouleur text-right" >en afficher plus... </a>
            </div>

      <?php
      }else{
      ?>
      <span>Vous n'avez aucun trajet actif</span>
         
      <?php
      }
      ?> 
            </div>
   		</div>
      <?php
  	}
}

?>