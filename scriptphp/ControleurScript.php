<?php  
session_start();

if(isset($_POST['fonction'])){
switch ($_POST['fonction']) {
	case 'rechercheTrajet':
		include_once __DIR__ . "/../connexion.php";
		include_once '../modules/mod_resTrajet/modele_resTrajet.php';

		$mod_connexion=new modele_resTrajet();
		$regulier=0;
		if (isset($_POST['regulier'])) {
			$regulier=1;
		}
		$mod_connexion->donneTrajetJSON($_POST['depart'],$_POST['destination'],$_POST['date'],$_POST['prix'],$_POST['type'],$regulier,$_POST['trie']);

		break;
	case 'actualiseMap':
		include_once '../modules/mod_trajet/modele_trajet.php';
		$modele_trajet=new modele_trajet();
		if (isset($_POST['tabVille']) && !empty($_POST['tabVille'])) {
			$modele_trajet->actualiseMap($_POST['tabVille']);
		}
		break;
	case 'verifFavoris':
		include_once __DIR__ . '/../connexion.php';
		include_once '../modules/mod_resTrajet/modele_resTrajet.php';

		$modele_resTrajet=new modele_resTrajet();
		$regulier=0;
		if (isset($_POST['regulier'])) {
			$regulier=1;
		}
		$modele_resTrajet->verifieSiExisteJ(htmlspecialchars($_POST['depart']),htmlspecialchars($_POST['destination']),htmlspecialchars($_POST['prix']),htmlspecialchars($_POST['type']),htmlspecialchars($regulier));


		break;
	case 'mesFavoris':
		include_once __DIR__ . '/../connexion.php';
		include_once '../modules/mod_resTrajet/modele_resTrajet.php';

		$modele_resTrajet=new modele_resTrajet();
		$regulier=0;
		if (isset($_POST['regulier'])) {
			$regulier=1;
		}//,$_POST['order']
		$modele_resTrajet->mesFavoris(htmlspecialchars($_POST['depart']),htmlspecialchars($_POST['destination']),htmlspecialchars($_POST['prix']),htmlspecialchars($_POST['type']),htmlspecialchars($regulier));

		break;
	case 'retireFavoris':
		include_once '../modules/mod_profil/modele_profil.php';
		$ModeleProfil=new ModeleProfil();
		if (isset($_POST['idFavoris']) && !empty($_POST['idFavoris'])) {
			$ModeleProfil->retireFavoris(htmlspecialchars($_POST['idFavoris']));
		}
		break;
	case 'formulaireDinscription':
		include_once '../modules/mod_connexion/modele_connexion.php';
		$mod_connexion=new modele_connexion();
		$mod_connexion->verifieInscription($_POST['emailInscription'],$_POST['confemail'],$_POST['nomInscription'],$_POST['prenomInscription'],$_POST['MDPInscription'],$_POST['confMDPInscription']);

		break;
	case 'formulaireDeCommentaire':
		
		include_once '../modules/mod_trajet/modele_trajet.php';

		$mod_connexion=new modele_trajet();
		$mod_connexion->ajouteCommentaire(htmlspecialchars($_POST['note']),htmlspecialchars($_POST['commentaire']),htmlspecialchars($_POST['idTrajet']));

		break;
	case 'supprimerCom':
		include_once '../modules/mod_trajet/modele_trajet.php';
		$modele_trajet=new modele_trajet();
		$modele_trajet->supCom($_POST['idTrajet']);

		break;
	case 'formulaireDinscriptionAuTrajet':
		include_once '../modules/mod_trajet/modele_trajet.php';
		$modele_trajet=new modele_trajet();
		$modele_trajet->InscriptionTrajet($_POST['tabId'],$_POST['idTrajet'],$_POST['token']);


		break;
	case 'desinscriptionAuTrajet':
		
		include_once '../modules/mod_trajet/modele_trajet.php';
		$modele_trajet=new modele_trajet();
		$modele_trajet->desinscriptionTrajet($_POST['idTrajet']);

		break;
	case 'validationAuTrajet':
		include_once '../modules/mod_trajet/modele_trajet.php';
		$modele_trajet=new modele_trajet();
		$modele_trajet->valideTrajet($_POST['idTrajet'],$_POST['token']);

		break;
	case 'retirerTrajet':
		include_once '../modules/mod_trajet/modele_trajet.php';
		$modele_trajet=new modele_trajet();
		$modele_trajet->retirerTrajet($_POST['idTrajet']);
		break;
	case 'formTrajet':
		include_once __DIR__.'/../modules/mod_trajet/modele_trajet.php';
		$modele_trajet=new modele_trajet();

		if( isset($_POST['soustrajet']) && isset($_POST['descriptionTrajet']) && isset($_POST['placeTotale']) && isset($_POST['dateArrivee'])){
			if($modele_trajet->creationTrajet($_POST['soustrajet'], $_POST['descriptionTrajet'],$_POST['placeTotale'], $_POST['dateArrivee'])){
				echo "ok";
				exit();
			}
		}

		if( isset($_POST['immatriculation']) && isset($_POST['critair']) && isset($_POST['hybride'])){
			echo $modele_trajet->ajoutVehicule($_POST['immatriculation'],$_POST['critair'],$_POST['hybride']);
				
			
		}

		if(isset($_POST['immatriculation']) && isset($_POST['delete']) ){
			if($modele_trajet->delVehicule($_POST['immatriculation'])){
				echo "ok";
			}
		}

		break;
	case 'afficheMessages':
		include_once __DIR__.'/../modules/mod_discussion/modele_discussion.php';
		$modele = new ModeleDiscussion;

			$idInterlocuteur=isset($_POST['idInterlocuteur']) ? $_POST['idInterlocuteur'] : null;

			if ($idInterlocuteur !== null){
				$idUser = $_SESSION['id'];

				if($modele->checkDiscuValide($idUser, $idInterlocuteur)){
					$msg=$modele->messages($idUser, $idInterlocuteur);
					$modele->messageLu($idUser, $idInterlocuteur);

					for($i=0; $i<count($msg); $i++){
						
						if($i>0) echo '';

						echo	'<div class="row rounded messages"  >
									<div class="col-md-3 row">
										<label class="col-5 col-md-12 prenomDiscussion">'.$msg[$i]["prenom"].'</label>
										<label class="col-5 col-md-12 dateHeureDiscussion">'.$msg[$i]["jour"].'</label>
										<label class="col-2 col-md-12 dateHeureDiscussion">'.$msg[$i]["heure"].'</label>
									</div>
									<div class="col-md-9">
										<span class="msgLongs">'.$msg[$i]["contenuMessage"].'</span>
									</div>
								</div>';
						
					}
									
				}		
	}
		break;
	case 'envoyerMessage':
		include_once __DIR__.'/../modules/mod_discussion/modele_discussion.php';
		$modele = new ModeleDiscussion;

		$message = isset($_POST['message'])? htmlspecialchars($_POST['message']) : null;
		$idInterlocuteur = isset($_POST['idInterlocuteur'])?$_POST['idInterlocuteur'] : null;

		if ($message != null && $idInterlocuteur != null){
			$idUser = $_SESSION['id'];	

			if($modele->checkDiscuValide($idUser, $idInterlocuteur))
				$result=$modele->insererMessage($idUser, $idInterlocuteur, $message);				
			
		}
		break;
	case 'afficheInterlocuteurs':
		include_once __DIR__.'/../modules/mod_discussion/modele_discussion.php';
		$modele = new ModeleDiscussion;

			$idUser = $_SESSION['id'];

				$interlocuteurs=$modele->interlocuteurs($idUser);

				for($i=0; $i<count($interlocuteurs); $i++){
		?>
					<div  id="<?php echo $interlocuteurs[$i]['idInterlocuteur']; ?>" class="row interlocuteurs rounded" >
						<p class=" col-md-9"><?php echo $interlocuteurs[$i]['prenom']; ?></p>
		<?php
				$nbMessagesNonLu=$modele->nbMessagesNonLuInterlocuteur($idUser, $interlocuteurs[$i]['idInterlocuteur']);
				if($nbMessagesNonLu!=0)
					echo "<div class='col-md-3 '><span id='messagesNonLus' class='badge badge-danger'>$nbMessagesNonLu</span></div>";
		?>
						
					</div>
		<?php
					
								
				}	
		break;
	case 'messagesNonLus':
		include_once __DIR__.'/../modules/mod_discussion/modele_discussion.php';
		$modele = new ModeleDiscussion;

		if(isset($_SESSION['id'])){
			$idUser = $_SESSION['id'];
			echo $modele->nbMessagesNonLus($idUser);
		}
		break;
	case 'changeMdpProfil':
		include_once __DIR__.'/../modules/mod_profil/modele_profil.php';
		$modele = new ModeleProfil;

			if(isset($_SESSION['id'])){
				$code = $modele->verifieModificationMdp($_SESSION['id']);
				if($code==0)
					echo "0";
				else if($code==1)
					echo "1";
				else if($code==2)
					echo "2";
			}
			else echo "2";
		break;
	case 'envoieMessageProfil':
		include_once __DIR__.'/../modules/mod_discussion/modele_discussion.php';
		$modele = new ModeleDiscussion;

			if(isset($_SESSION['id'])){
				$code=$modele->envoieMsgDepuisProfil($_SESSION['id'], $_POST['idInterlocuteur']);
				if ($code==0)
					echo "0";
			}

			echo "1";
		break;
	default:
		# code...
		break;
}

}
else if (isset($_GET['fonction'])) {
	
	switch ($_GET['fonction']) {
		case 'rechercheVille':
			include_once '../modules/mod_connexion/modele_connexion.php';
			$mod_connexion=new modele_connexion();
			$mod_connexion->chercheVille($_GET['term']);

			break;
		
		default:
			# code...
			break;
	}
	
}





?>