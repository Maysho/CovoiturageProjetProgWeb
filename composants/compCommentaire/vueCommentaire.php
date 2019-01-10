<?php

/**
* 
*/
class vueCommentaire
{
	
	function __construct()
	{

	}
	public function affiche($tab){
		
			# code...
		
   		?>
   		<div class="col-12 composant border border-dark hidden-md-down">
   			<div class="col-12"> 
   				<h4>Commentaire Recent:</h4>
   			</div>
   			<?php
            if (count($tab)<=0) {
               echo "<span>Vous n'avez pas reçu de commentaire</span>";
               }
               else{
   			for ($i=0; $i <count($tab) ; $i++) { 
   				?>
   				<a class="col-12 row liensanscouleur" href="index.php?module=mod_profil&idprofil=<?php echo $tab[$i]['idUtilisateur'];?>&ongletprofil=profil#<?php echo $tab[$i]['idAuteur'].'Auteur'.$tab[$i]['idTrajet'].'Trajet';?>">
   					<span><?php echo $tab[$i]['description']; ?></span><p><br></p>
   				</a>


   				<?php
   			}
         

   			?>
            <div class="row justify-content-end">
               <a href="index.php?module=mod_profil&idprofil=<?php echo $tab[0]['idUtilisateur'];?>&ongletprofil=profil#<?php echo $tab[0]['idAuteur'].'Auteur'.$tab[0]['idTrajet'].'Trajet';?>" class="liensanscouleur text-right" style="color: gray;text-decoration: underline;">en afficher plus... </a>
            </div>
         <?php } ?>
   		</div>
   	<?php
   	
  	}
}