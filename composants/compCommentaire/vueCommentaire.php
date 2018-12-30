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

   		?>
   		<div class="col-12 composant">

   			<?php
   			for ($i=0; $i <count($tab) ; $i++) { 
   				?>
   				<a class="col-12 row" href="http://localhost:81/CovoiturageProjetProgWeb/index.php?module=mod_profil&idprofil=<?php echo $tab[$i]['idUtilisateur'];?>&ongletprofil=profil#<?php echo $tab[$i]['idAuteur'].'Auteur'.$tab[$i]['idTrajet'].'Trajet';?>">
   					<span><?php echo $tab[$i]['description']; ?></span>
   				</a>


   				<?php
   			}

   			?>

   		</div>
   	<?php
  	}
}