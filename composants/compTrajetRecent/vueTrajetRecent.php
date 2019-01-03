<?php

/**
* 
*/
class vueTrajetRecent
{
	
	function __construct()
	{

	}
	public function affiche($tab){
		if (count($tab)>0) {
			# code...
		
   		?>
   		<div class="col-12 composant border border-dark">
   			<div class="col-12"> 
   				<h4>Commentaire Recent</h4>
   			</div>
   			<?php
   			for ($i=0; $i <count($tab) ; $i++) { 
   				?>
   				<a class="col-12 row liensanscouleur" href="http://localhost:81/CovoiturageProjetProgWeb/index.php?module=mod_profil&idprofil=<?php echo $tab[$i]['idUtilisateur'];?>&ongletprofil=profil#<?php echo $tab[$i]['idAuteur'].'Auteur'.$tab[$i]['idTrajet'].'Trajet';?>">
   					<span><?php echo $tab[$i]['description']; ?></span><p><br></p>
   				</a>


   				<?php
   			}

   			?>

   		</div>
   	<?php
   	}
  	}
}