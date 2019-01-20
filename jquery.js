/******************************************************************************************************************************
**
**Recherche de trajet
**
******************************************************************************************************************************/
var key = 0 ;
var tab;
var nbAffiche=0;

function removeAide() {
  $('.aide').remove();
}



$("#rechercheDepart").autocomplete({
  source: "scriptphp/ControleurScript.php?fonction=rechercheVille"
});



$("#rechercheArrive").autocomplete({
  source: "scriptphp/ControleurScript.php?fonction=rechercheVille"
});



$(document).on('click', '#buttonAgranditForm', function(event) {
  event.preventDefault();
  $(".d-none").toggleClass("d-none d-block");
  $("#buttonAgranditForm").toggleClass("d-block d-none");
});



$(document).on('click', '#buttonRapetisseForm', function(event) {
  event.preventDefault();
  $(".d-block").toggleClass("d-block d-none");
  $("#buttonAgranditForm").toggleClass("d-none d-block");
});



$("#formulaireDeRechercheResultat").submit(function(e){ // On sélectionne le formulaire par son identifiant
  alert("uidzeuideee");
  var nomFonction=$("#formulaireDeRechercheResultat").serialize()+"&fonction=rechercheTrajet";
  e.preventDefault();
  $.post('scriptphp/ControleurScript.php', // Un script PHP que l'on va créer juste après

    nomFonction
    ,

    function(data,statut){
      alert(data);
      tab=JSON.parse(data);
      nbAffiche=25;
      afficheRes();

    },
    'text'
  ).fail(function(data,statut,xhr) {
      verifError(data.responseText);
    });
});



$("#formulaireDeRechercheResultat").change(function(event) {
  var nomFonction=$("#formulaireDeRechercheResultat").serialize()+"&fonction=verifFavoris";
  $.post('scriptphp/ControleurScript.php', // Un script PHP que l'on va créer juste après

    nomFonction,

    function(data,statut){
      if (data.includes("1")) {
                  
        $("#miseEnFavoris").children().replaceWith('<i class="far fa-star" id="pasFavoris"></i>');
 
      }
      else{
        $("#miseEnFavoris").children().replaceWith('<i class="fas fa-star" id="favoris"></i>');
        
      }
    },
    'text'
  )
});


/******************************************************************************************************************************
**
**Page résultat trajet
**
******************************************************************************************************************************/

function afficheRes(){
  removeResTrajet();
  console.log($("divHauteRes").attr("class"));
  nbResAAfficher=tab.length<nbAffiche?tab.length:nbAffiche;
  for (var i = 0; i < nbResAAfficher; i++) {
    var urlPhoto=tab[i]["urlPhoto"]!=null?tab[i]["urlPhoto"]:"home.jpg";
    $('#contenu').append('<div class="'+$("#divHauteRes").attr("class")+' removeResTrajet"> <a class="liensanscouleur '+$("#divHauteRes2").attr("class")+'" href="index.php?module=mod_trajet&action=afficheTrajet&id='+tab[i]["idTrajet"]+'"> <div class="col-md-2"> <img src="'+urlPhoto+'" style="width: 100px"> <span class="">'+tab[i]["prenom"]+'</span> </div> <div class="col-md-6 row offset-md-1 justify-content-md-between justify-content-center no-gutters px-0" > <div class=" justify-content-md-between justify-content-center row container-fluid px-0"> <span class="col-12 col-md-6 text-center">'+tab[i]["depart"]+'</span> <span class="col-6 text-md-right text-center">'+tab[i]["heureDepart"]+'</span></div><div class="align-items-end justify-content-md-between justify-content-center row container-fluid px-0 "><span class="col-12 col-md-6 text-center" style="padding-right: 3px">'+tab[i]["destination"]+'</span> <span class="col-6 text-md-right text-center">'+tab[i]["heureArrivee"]+'</span> </div> </div> <div class="col-md-2 row offset-md-1  justify-content-md-end px-0"> <div class="row justify-content-md-end col-12"> <span class="align-top">'+tab[i]["placeTotale"]+'</span> </div> <div class="row align-content-end justify-content-end col-12" > <span class="align-text-bottomme">'+tab[i]["prix"]+'€</span> </div> </div> </a> </div>');

  }
}



$('#buttonAffichePlus').on('click',function(event) {
  event.preventDefault();
  nbAffiche+=10;
  afficheRes();
});



$("#miseEnFavoris").on('click', function(event) {
  event.preventDefault();
  if($(this).children().attr('id')=='pasFavoris'){
    $(this).children().replaceWith('<i class="fas fa-star" id="favoris"></i>');
  }
  else{
    $(this).children().replaceWith('<i class="far fa-star" id="pasFavoris"></i>');
  }
  var nomFonction=$("#formulaireDeRechercheResultat").serialize()+"&fonction=mesFavoris";
  $.post('scriptphp/ControleurScript.php', // Un script PHP que l'on va créer juste après

      
   nomFonction
      
    ,

    function(data,statut){
      alert(data);
      //je passe le message d'erreur par un echo dans le serveur qui est recuperer dans le data
      if(data.includes("success")){
          //window.location.replace('index.php');//.parent().parent().parent().parent().attr("background-color", 'blue');
      }
      else{
           // Le membre n'a pas été connecté. (data vaut ici "failed")
      }
    },
    'text'
  ).fail(function(data,statut,xhr) {
  });
});

/******************************************************************************************************************************
**
**Page profil-->favoris: supprimer favoris
**
******************************************************************************************************************************/


$(".buttonSuppFavoris").on('click', function(event) {
  $.post('scriptphp/ControleurScript.php', // Un script PHP que l'on va créer juste après

    {
      idFavoris:$(this).attr('data-id'),
      fonction:"retireFavoris"
    }
    
    ,

    function(data,statut){
      alert(data);
      //je passe le message d'erreur par un echo dans le serveur qui est recuperer dans le data
      if(data.includes("success")){
            //window.location.replace('index.php');//.parent().parent().parent().parent().attr("background-color", 'blue');
      }
      else{
         // Le membre n'a pas été connecté. (data vaut ici "failed")
      }
    },
    'text'
  ).fail(function(data,statut,xhr) {
  });

  $(this).parent().parent().remove();  
});



/******************************************************************************************************************************
**
**Page inscription/connexion
**
******************************************************************************************************************************/



$("#inscription").submit(function(e){ // On sélectionne le formulaire par son identifiant
  e.preventDefault();
  removeWarningForm();
  alert("on rentre");
  var nomFonction=$("#inscription").serialize()+"&fonction=formulaireDinscription";
  $.post('scriptphp/ControleurScript.php', // Un script PHP que l'on va créer juste après

    nomFonction
    ,

    function(data,statut){
      alert(data);
      //je passe le message d'erreur par un echo dans le serveur qui est recuperer dans le data
      if(data.includes("success")){
        // Le membre est connecté. Ajoutons lui un message dans la page HTML.

        window.location.replace('index.php?module=mod_connexion');
      }
      else{
             // Le membre n'a pas été connecté. (data vaut ici "failed")
      }
    },
    'text'
  ).fail(function(data,statut,xhr) {
        verifError(data.responseText);
    });
});



/******************************************************************************************************************************
**
**Page Trajets
**
******************************************************************************************************************************/



$("#formCommentairePageTrajet").submit(function(e){ // On sélectionne le formulaire par son identifiant
  e.preventDefault();
  $('#messageErreurCom').remove();
  var nomFonction=$("#formCommentairePageTrajet").serialize()+"&fonction=formulaireDeCommentaire";
  $.post('scriptphp/ControleurScript.php', // Un script PHP que l'on va créer juste après

    nomFonction,

    function(data,statut){


      $('#espaceCommentaire').prepend('<div class="row col-12" > <div class="col-3 col-md-2 offset-md-1 " style="display: inline-block;"> <a href="?module=mod_profil"> <img src="'+$("#photoUtilisateurCo").attr('src')+'" class="img-fluid"></a><label class="">note : '+$("#note").val()+'</label></div> <div class="col-7 col-md-8"><span>'+$("#contenuCom").val()+'</span></div><div class="col-1"><a class="nav-link dropdown-toggle" href="#" id="dropcom" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="fas fa-bars"></i></a><div class="dropdown-menu col-1" aria-labelledby="dropdownMenuButton"><a class="dropdown-item " id="supprimerCom" href="#">supprimer</a></div></div>');
      $("#supprimerCom").on('click',function(e){ // On sélectionne le formulaire par son identifiant
        e.preventDefault();
      


        $.post('scriptphp/ControleurScript.php', // Un script PHP que l'on va créer juste après
          {
            idTrajet:$('#contenuCom').attr('data-id'),
            fonction:"supprimerCom"
          }
          ,

          function(data,statut){
          //je passe le message d'erreur par un echo dans le serveur qui est recuperer dans le data
            if(data.includes("success")){
              $('#supprimerCom').parent().parent().parent().remove();
                   /*window.location.replace('index.php?module=mod_trajet&action=afficheTrajet&id='+$('#desinscriptionAuTrajet').attr('data-id'));*/

                   //window.location.replace('index.php?module=mod_connexion');
            }
            else{
                 // Le membre n'a pas été connecté. (data vaut ici "failed")
            }
          },
          'text'
        ).fail(function(data,statut,xhr) {
          });
         
     });  
    },
    'text'
  ).fail(function(data,statut,xhr) {
      console.log(data.responseText);
      $('#formCommentairePageTrajet').append('<div class="row justify-content-end col-12" id="messageErreurCom"><small class="align-right form-text warning"> '+data.responseText+'</small></div>');
  });
});



valeurChange=-1;
$(".checkerInscription").on('change', function(event) {
  if ($(this).val()==valeurChange) {
    valeurChange=-1;
    $('.checkerInscription').prop( "checked", false );
    $('#prixInscription').text("0");
  }
  else if (valeurChange<0) {
    valeurChange=$(this).val();
    $('#prixInscription').text(parseInt($('#prixInscription').text(),10)+parseInt($(this).attr('data-prix'),10));
  }
  else if(!($(this).prop('checked'))){
    $('.checkerInscription').prop( "checked", false );
    var prix=0;
    if (valeurChange<$(this).val()) {
      for (var i = valeurChange; i <= $(this).val()-1; i++) {
        val="#st"+i;
        $(val).prop( "checked", true);
        prix+=parseInt($(val).attr('data-prix'),10);  
      }
    }
    else{
      for (var i = valeurChange; i > $(this).val(); i--) {
        val="#st"+i;
        $(val).prop( "checked", true);
        prix+=parseInt($(val).attr('data-prix'),10);   
      }
    }
    $('#prixInscription').text(prix);
  }
  else {
    var prix=0;
    $('.checkerInscription').prop( "checked", false );
    if (valeurChange<$(this).val()) {
      for (var i = valeurChange; i <= $(this).val(); i++) {
        val="#st"+i;
        $(val).prop( "checked", true);
        prix+=parseInt($(val).attr('data-prix'),10);   
      }
    }
    else{
      for (var i = valeurChange; i >= $(this).val(); i--) {
        val="#st"+i;
        $(val).prop( "checked", true);
        prix+=parseInt($(val).attr('data-prix'),10); 
      }
    }
    $('#prixInscription').text(prix);
  } 
});



$("#envoieInscriptionTrajet").submit(function(e){ // On sélectionne le formulaire par son identifiant
  e.preventDefault();
  $('#warningInscriptionprob').remove();
  alert("on rentre");
  var compteur=0;
  var tabVille=[];
  for (var i = 0; i < parseInt($(this).attr('data-nbPlace'),10); i++) {
    val="#st"+i;
    if ($(val).prop("checked")) {
      tabVille[compteur]=$(val).attr('data-idville');
      compteur++;
    }
  }
  
  if (tabVille.length !=0 && confirm("Etes-vous sûr.e de vous inscrire à ce trajet?")) {
    $.post('scriptphp/ControleurScript.php', // Un script PHP que l'on va créer juste après
      {
        tabId:tabVille,
        idTrajet:$('#sinscrireAuTrajet').attr('data-id'),
        token:$('#sinscrireAuTrajet').attr('data-token'),
        fonction:"formulaireDinscriptionAuTrajet"
      }
      ,
      function(data,statut){
        alert(data);
      //je passe le message d'erreur par un echo dans le serveur qui est recuperer dans le data
        if(data.includes("success")){
               window.location.replace('index.php?module=mod_trajet&action=afficheTrajet&id='+$('#sinscrireAuTrajet').attr('data-id'));

               //window.location.replace('index.php?module=mod_connexion');
        }
        else{
             // Le membre n'a pas été connecté. (data vaut ici "failed")
        }
      },

      'text'
    ).fail(function(data,statut,xhr) {
      alert(data.responseText);
      verifError(data.responseText);
    });
  }
});



$("#desinscriptionAuTrajet").on('click',function(e){ // On sélectionne le formulaire par son identifiant
  e.preventDefault();
  
  alert("on rentre");
  if(confirm("Etes-vous sûr.e de vous desinscrire de ce trajet?")){
  $.post('scriptphp/ControleurScript.php', // Un script PHP que l'on va créer juste après
    {
      idTrajet:$('#desinscriptionAuTrajet').attr('data-id'),
      fonction:"desinscriptionAuTrajet"
    }
    ,
    function(data,statut){
      alert(data);
    //je passe le message d'erreur par un echo dans le serveur qui est recuperer dans le data
      if(data.includes("success")){
             window.location.replace('index.php?module=mod_trajet&action=afficheTrajet&id='+$('#desinscriptionAuTrajet').attr('data-id'));

             //window.location.replace('index.php?module=mod_connexion');
      }
      else{
           // Le membre n'a pas été connecté. (data vaut ici "failed")
      }
    },
       'text'
  ).fail(function(data,statut,xhr) {
    alert(data.responseText);
    verifError(data.responseText);
  });
}
});



$("#supprimerCom").on('click',function(e){ // On sélectionne le formulaire par son identifiant
  e.preventDefault();
  
  alert("on rentre");

  $.post('scriptphp/ControleurScript.php', // Un script PHP que l'on va créer juste après

    {
      idTrajet:$('#contenuCom').attr('data-id'),
      fonction:"supprimerCom"
    }
    ,

    function(data,statut){
      alert(data);
    //je passe le message d'erreur par un echo dans le serveur qui est recuperer dans le data
      if(data.includes("success")){
        $('#supprimerCom').parent().parent().parent().remove();//.parent().parent().parent().parent().attr("background-color", 'blue');
      }
      else{
           // Le membre n'a pas été connecté. (data vaut ici "failed")
      }
    },
    'text'
  ).fail(function(data,statut,xhr) {
  });       
});



$('#validationAuTrajet').on('click', function(event) {
  event.preventDefault();
  alert("rentre");
  if(confirm("Etes-vous sûr.e de vouloir valider ce trajet ? Ceci complétera ce trajet pour vous et c'est irrémédiable")){
  $.post('scriptphp/ControleurScript.php', // Un script PHP que l'on va créer juste après

    {
      idTrajet:$('#validationAuTrajet').attr('data-id'),
      token:$('#validationAuTrajet').attr('data-token'),
      fonction:"validationAuTrajet"
    }
    ,

    function(data,statut){
      alert(data);
    //je passe le message d'erreur par un echo dans le serveur qui est recuperer dans le data
      if(data.includes("success")){
        window.location.replace('index.php?module=mod_trajet&action=afficheTrajet&id='+$('#validationAuTrajet').attr('data-id'));//.parent().parent().parent().parent().attr("background-color", 'blue');
      }
      else{
             // Le membre n'a pas été connecté. (data vaut ici "failed")
      }
    },
  'text'
  ).fail(function(data,statut,xhr) {
  });
}
});



$('#retirerTrajet').on('click', function(event) {
  event.preventDefault();
  alert("rentre");
  if(confirm("Etes-vous sûr.e de vous desinscrire de ce trajet?")){
  $.post('scriptphp/ControleurScript.php', // Un script PHP que l'on va créer juste après

    {
      idTrajet:$('#retirerTrajet').attr('data-id'),
      fonction:"retirerTrajet"
    }
    ,
    function(data,statut){
      alert(data);
    //je passe le message d'erreur par un echo dans le serveur qui est recuperer dans le data
      if(data.includes("success")){
        window.location.replace('index.php');//.parent().parent().parent().parent().attr("background-color", 'blue');
      }
      else{
         // Le membre n'a pas été connecté. (data vaut ici "failed")
      }
    },
    'text'
  ).fail(function(data,statut,xhr) {
  });
}
});



/******************************************************************************************************************************
**
**Ajout vehicule (depuis création de trajet ou profil)
**
******************************************************************************************************************************/


$('#addCar').on('click', function(e){
  e.preventDefault();

  var immatriculation= $(document).find('#immatriculation').val().replace(/-|\s/g, "");
  var critair=$(document).find('#critair').val();
  var hybride=$(document).find('#hybride').is(":checked");
  var formData = new FormData();
  formData.append("photo", $("#photoCar")[0].files[0]);
  formData.append("immatriculation", immatriculation);
  formData.append("critair", critair);
  formData.append("hybride", hybride);
  formData.append("fonction","formTrajet");
  var page = $("#vehiculeProfil").length;
  $(".warning").remove();
  $.ajax({
    url:'scriptphp/ControleurScript.php',
    type:'POST',    
    contentType: false,
    processData: false,
    method: 'POST',
    type: 'POST', // For jQuery < 1.9
    data:formData,
    success : function(txt){
      console.log(txt);
      if( page == 1){
        location.reload();
      }
      $('#immatriculation').val("");
      $('#critair').val("0");
      $('#hybride').prop('checked', false);
      $('#defaultThumb').attr('src', 'photos/Black.png');
      $('#photoCar').val("");

      if (txt =='') {
        $(document).find("#idVehicule").last().append("<option class='voitureSelection' selected data-url='photos/Black.png' value='"+immatriculation+"'>"+ immatriculation +"</option>");
        $(document).find("#imgCar").attr("src","photos/Black.png");
      }
      else{
        $(document).find("#idVehicule").last().append("<option class='voitureSelection' selected data-url='"+txt+"' value='"+immatriculation+"'>"+ immatriculation +"</option>");
        $(document).find("#imgCar").attr("src",txt);
      }
      $("#myModal").modal('hide');
    },
    error: function(txt){
      alert("fail");
      alert("msg"+txt.responseText)
      verifError(txt.responseText);
    }
  });
});



$(document).ready(function(){
  $('#photoCar').on('change', function(){ //on file input change
    if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
    {
      // $('#thumbnail').html(''); //clear html of output element
      var data = $(this)[0].files; //this file data

      $.each(data, function(index, file){ //loop though each file
        if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
          var fRead = new FileReader(); //new filereader
          fRead.onload = (function(file){ //trigger function on successful read
            return function(e) {
              // var img = $('<img/>').addClass('thumb img-fluid').attr('src', e.target.result); //create image element 
              // console.log(img);
              // $('#thumbnail').append(img); //append image to output element
              $('#defaultThumb').attr('src', e.target.result);
            };
          })(file);
          fRead.readAsDataURL(file); //URL representing the file's data.
        }
      });
      
    }else{
      alert("Your browser doesn't support File API!"); //if File API is absent
    }
  });

  var sources= $(document).find('#idVehicule').find(':selected').attr("data-url"); 
  if( sources == ""){
    $('#imgCar').attr("src","photos/Black.png");
  }
  else{
    $('#imgCar').attr("src",sources);
  }
});

$('.modal').on('show.bs.modal', function (e) {


      var button = $(e.relatedTarget);
      console.log(button);
      var index = button.attr('class');
      if (index!=undefined) {
      if(index.indexOf("btn-photo-vehicule")!=-1)
        $(this).find('#img-photo-vehicule').attr('src',button.attr('data-src'));
     
    }
      /*$(this).find('.modal-content').load('remote' + index + '.html')*/
});

/******************************************************************************************************************************
**
**Page creation de trajet
**
******************************************************************************************************************************/

//Creation du trajet

$('#envoiTrajet').on("click",function(e){
  e.preventDefault();
  console.log("Valeur de "+key);
  var dateArrivee= $('#dateArrivee').val();
  var soustrajets=[];

  if( key == 0){
    // console.log("pas de soustrajet")
    var soustrajet = { 
      idVilleD : $(document).find('#depart').val(), 
      idVilleA : $(document).find('#arrive').val(),
      dateDepart: $(document).find('#dateDepart').val(),
      heureDepart: $(document).find('#heureDepart').val(),
      heureArrivee: $(document).find('#heureArrivee').val(),
      idVehiculeConducteur: $(document).find('#idVehicule').find(':selected').val(),
      prix: $(document).find('#prixArrivee').val(),
      regulier: $(document).find('#regulier').is(":checked")
    };
    soustrajets[0]= soustrajet;

  }else{
    for( var i = 0 ; i < key+1 ; i++ ){
      
      if( i == 0){
        // console.log("premier sous trajet")
        var soustrajet = { 
          idVilleD : $(document).find('#depart').val(), 
          idVilleA : $(document).find('#villeEtape1').val(),
          dateDepart: $(document).find('#dateDepart').val(),
          heureDepart: $(document).find('#heureDepart').val(),
          heureArrivee: $(document).find('#heure1').val(),
          idVehiculeConducteur: $(document).find('#idVehicule').find(':selected').val(),
          prix: $(document).find('#prix1').val(),
          regulier: $(document).find('#regulier').is(":checked")
        };
      }
      else if( i == key){
        // console.log("dernier sous trajet")
        var villeDepart = "#villeEtape"+(i);
        var dateDepart = "#date"+(i);
        var heureDepart = "#heure"+(i);

        var soustrajet = { 
          idVilleD : $(document).find(villeDepart).val(), 
          idVilleA : $(document).find('#arrive').val(),
          dateDepart: $(document).find(dateDepart).val(),
          heureDepart: $(document).find(heureDepart).val(),
          heureArrivee: $(document).find('#heureArrivee').val(),
          idVehiculeConducteur: $(document).find('#idVehicule').find(':selected').val(),
          prix: $(document).find('#prixArrivee').val(),
          regulier: $(document).find('#regulier').is(":checked")
        };
      }
      else if( 0 < i && i < key){
        // console.log("sous trajet inter")
        var villeDepart = "#villeEtape"+(i);
        var dateDepart = "#date"+(i);
        var heureDepart = "#heure"+(i);
        var villeArrivee="#villeEtape"+(i+1) ;
        var heureArrivee="#heure"+(i+1) ;
        var prix="#prix"+(i+1) ;

        var soustrajet = { 
          idVilleD : $(document).find(villeDepart).val(), 
          idVilleA : $(document).find(villeArrivee).val(),
          dateDepart: $(document).find(dateDepart).val(),
          heureDepart: $(document).find(heureDepart).val(),
          heureArrivee: $(document).find(heureArrivee).val(),
          idVehiculeConducteur: $(document).find('#idVehicule').find(':selected').val(),
          prix: $(document).find(prix).val(),
          regulier: $(document).find('#regulier').is(":checked")
        };
      }
      console.log(soustrajet)
      soustrajets[i]= soustrajet;
    }
  }

  var descriptionTrajet =$(document).find("#descriptionTrajet").val();
  var placeTotale=$(document).find("#placeTotale").val();
  if(confirm("Etes-vous sûr.e de valider ce trajet?")){
    $(".warning").remove();
    $.ajax({
      url:'scriptphp/ControleurScript.php',
      type:'POST',
      dataType : 'text',
      data: {
        soustrajet: soustrajets,
        descriptionTrajet: descriptionTrajet,
        placeTotale: placeTotale,
        dateArrivee: dateArrivee,
        fonction:"formTrajet"
      },
      success : function(txt){
        window.location='index.php';
        // console.log("msg :"+txt.responseText);
        // key = 0;
      },
      error: function(txt){
        // alert("fail");
        // alert("msg :"+txt.responseText);
        alert("Certains champs ont été mal remplis, veuillez réinsérer des donneés correctes");
        verifError(txt.responseText);
         console.log(txt.responseText);
      }
    });
  }
});


//Gestion de la création du trajet
$(function(){

  // ajout des champs etapes
  $("#btnAjoutEtape").on("click",function(){
    console.log(key);
    // On copie le template et on le rend visible la premiere fois 
    if( $('.tpl').length == 1){
      var cont= $('#etape').clone(); //partie itineraire
      cont.removeAttr("id");
      cont.removeAttr("hidden");

      cont.find("input.nomdeVille").each(function() {

        // $(this).attr("value", "");
        $(this).attr("id", $(this).attr("id").replace(/\d+/g, key + 1));
      });
      $("#etape").after(cont);
      $(document).find('.ville').autocomplete({
        source: "scriptphp/ControleurScript.php?fonction=rechercheVille"
      });
      $(".ville").on('keyup', function(event) {


          actualiseMap();

      });
      $(".ville").on('focusout', function(event) {

          actualiseMap();

      });

      var cont2= $('#checkpoint').clone(); //partie horaire
      cont2.removeAttr("id");
      cont2.removeAttr("hidden");
      cont2.find("#checkpoint0").attr("id",cont2.find("#checkpoint0").attr("id").replace(/\d+/g, key + 1));
      cont2.find("input").each(function() {
        $(this).attr("id", $(this).attr("id").replace(/\d+/g, key + 1));
      });
      $("#checkpoint").after(cont2);
      
    }else{ // on ajoute au truc suivant copie du template
      var fils= $('#villeEtape').clone(); //partie itineraire
      // fils.find(".nomdeVille").val("");
      fils.removeAttr("id");

      fils.find("input.nomdeVille").each(function() {
        // $(this).attr("value", "")
        $(this).attr("id", $(this).attr("id").replace(/\d+/g, key + 1));
      });
      $("#etape").next().append(fils);
      
      $(document).find('.ville').autocomplete({
        source: "scriptphp/ControleurScript.php?fonction=rechercheVille"
      });
      $(".ville").on('keyup', function(event) {

          actualiseMap();

      });
       $(".ville").on('focusout', function(event) {

          actualiseMap();

      });

      var fils2= $('#checkpoint0').clone(); //partie horaire
      fils2.attr("id", fils2.attr("id").replace(/\d+/g, key + 1));
      fils2.find("input").each(function() {
        $(this).attr("id", $(this).attr("id").replace(/\d+/g, key + 1));
      });
      $("#checkpoint").next().append(fils2);

    };
    key ++;

  }); 

  $(document).find('.ville').autocomplete({
    source: "scriptphp/ControleurScript.php?fonction=rechercheVille"
  });
  $(".ville").on('keyup', function(event) {


    actualiseMap();

});
  $(".ville").on('focusout', function(event) {

    actualiseMap();

});


  $(document).on('click',".btnSupprEtape",function(){
    if($(this).parent().parent().find("div").length==1 ){

      var id = $(this).parent().find("input").first().attr("id") ;
      var nb = parseInt(id.replace(/[^0-9\.]/g,''),10);

      console.log("On a supprimé le block");
      $(this).parent().parent().fadeOut(function(){
        $(this).remove(); 

      });
      $(document).find("#checkpoint"+nb).fadeOut(function(){
        $(this).remove(); 
      });

    }else{

      var id = $(this).parent().find("input").first().attr("id") ;
      var nb = parseInt(id.replace(/[^0-9\.]/g,''),10);
      $(document).find("#checkpoint"+nb).remove();
      console.log("On a supprimé une étape");

      $(this).parent().fadeOut(function(){
        $(this).remove();
      });

      for(var i = nb ; i < key  ; i++){

        $(document).find("#villeEtape"+(i+1)).attr("id", "villeEtape"+i);
        $(document).find("#checkpoint"+(i+1)).find("input").each(function(){
          $(this).attr("id", $(this).attr("id").replace(/\d+/g, i ));
        });
        $(document).find("#checkpoint"+(i+1)).attr("id","checkpoint"+i );
      }

    }

    key--;
    actualiseMap();
  });


  //transforme les entrées non numerique  en vide
  $('#placeTotale').on("keyup",function(){
    var verif = $(this).val();
    if(verif.match(/[a-zA-Z]/g)){
      $(this).val(verif.replace(/[a-zA-Z]/g,""))
    }
  });

  $('#idVehicule').change(function() {
    var sources = $(this).find(':selected').attr("data-url"); 
    console.log($(this).attr("data-url"));
    if(sources == ""){
      $('#imgCar').attr("src","photos/Black.png");
    }
    else{
      $('#imgCar').attr("src",sources);
    }
  });

  $('.delCar').click(function(){
    var immatriculation = $(this).attr('data-id');
    var row= $(this).parent().parent();
    $.ajax({
      url:'scriptphp/ControleurScript.php',
      type:'POST',
      dataType : 'text',
      data: {
        immatriculation: immatriculation,
        delete : 1,
        fonction:"formTrajet"
      },
      success : function(txt){
        row.remove();
      },
      error: function(txt){
        alert("fail");
      }
    });
  });
});


var lat = 48.852969;
var lon = 2.349903;
var macarte=null;
markers=[];
polyline=null;
// Fonction d'initialisation de la carte
function initMap() {
  // Créer l'objet "macarte" et l'insèrer dans l'élément HTML qui a l'ID "map"


  macarte = L.map('map').setView([lat, lon], 11);
  // Leaflet ne récupère pas les cartes (tiles) sur un serveur par défaut. Nous devons lui préciser où nous souhaitons les récupérer. Ici, openstreetmap.fr
  L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
    // Il est toujours bien de laisser le lien vers la source des données
    attribution: 'données © OpenStreetMap/ODbL - rendu OSM France',
    minZoom: 1,
    maxZoom: 20
  }).addTo(macarte);

  // Nous parcourons la liste des villes
                   
}
function actualiseMap() {
  var tabVille=[];
  tabVille[0]=$("#depart").val();
  
  for (var i = 0; i < key+2; i++) {
    nom="#villeEtape"+i;
    tabVille[i+1]=$(nom).val();
  }
  tabVille[key+2]=$("#arrive").val();

  $.post('scriptphp/ControleurScript.php', // Un script PHP que l'on va créer juste après

    {
      tabVille:tabVille,
      fonction:"actualiseMap"
    }
    ,
    function(data,statut){
      tab=JSON.parse(data);
      for (var i = 0; i < markers.length; i++) {
        console.log("test");
        macarte.removeLayer(markers[i]);
        macarte.removeBounds
      }
      if (polyline!=null) {
        console.log(polyline);
      macarte.removeLayer(polyline);
      }
      markers=[];
      for (ville in tab) {
        var marker = L.marker([tab[ville][0], tab[ville][1]]).addTo(macarte);
        markers[markers.length]=marker;
        
      }
      if (tab.length) {
      var nvTab=[];
      var nvTab2=[];
      compteur=0;
       for (ville in tab) {
        nvTab2[compteur]=tab[ville];
        compteur++;
      }
      nvTab[0]=nvTab2;
      polyline = L.polyline(nvTab, {color: 'red'}).addTo(macarte);
      macarte.fitBounds(polyline.getBounds());
    }
      
    },
    'text'
  ).fail(function(data,statut,xhr) {
    alert("fail");
  });
    
}
$(document).ready(function() {
  if($('#map').length)
    initMap();
}); 

$(".ville").on('keyup', function(event) {
  event.preventDefault();
  actualiseMap();

});
 


/******************************************************************************************************************************
**
**Gestion erreurs
**
******************************************************************************************************************************/



function removeWarningForm(){
  $('.warning').remove();
}
function removeResTrajet(){
  $('.removeResTrajet').remove();
}

function verifError(data){
  if (data.includes("00")) {
    $('#divEmailInscription').append('<small id="warningemaildif" class="form-text warning"> <i class="fas fa-exclamation-triangle"></i> ce champ est incorrect</small>');
  }
  if (data.includes("01")) {
    $('#divConfEmail').append('<small id="warningemaildif" class="form-text warning"> <i class="fas fa-exclamation-triangle"></i> les emails sont différents</small>');
  }
  if(data.includes("02")){
    $('#divNomInscription').append('<small id="warningemaildif" class="form-text warning"> <i class="fas fa-exclamation-triangle"></i> ce champ est incorrect</small>');
  }
  if(data.includes("03")){
    $('#divPrenomInscription').append('<small id="warningemaildif" class="form-text warning"> <i class="fas fa-exclamation-triangle"></i> ce champ est incorrect</small>');
  }
  if (data.includes("04")) {
    $('#divMDPInscription').append('<small id="warningemaildif" class="form-text warning"> <i class="fas fa-exclamation-triangle"></i> ce champ est incorrect il doit être au minimum superieur a 8 charactere, contenir une lettre en majuscule, un chiffre et un charactere en minuscule </small>');
  }
  if(data.includes("05")){
    $('#divConfMDPInscription').append('<small id="warningemaildif" class="form-text warning"> <i class="fas fa-exclamation-triangle"></i> ce champ est incorrect</small>');
  }
  if (data.includes("06")) {
    $('#divEmailInscription').append('<small id="warningemaildif" class="form-text warning"> <i class="fas fa-exclamation-triangle"></i> cette adresse email est deja utilisee</small>');
  }
  if (data.includes("07")) {
    $('#bodyInscriptionTrajet').append('<small id="warningInscriptionprob" class="form-text warning"> <i class="fas fa-exclamation-triangle"></i> petit malin tu as changer du code</small>');
  }
  if (data.includes("08")) {
    $('#bodyInscriptionTrajet').append('<small id="warningInscriptionprob" class="form-text warning"> <i class="fas fa-exclamation-triangle"></i> desole mais le trajet n\' est pas celui que vous avez choisi initialement et il est plein</small>');
  }
  if (data.includes("09")) {
    $('#bodyInscriptionTrajet').append('<small id="warningInscriptionprob" class="form-text warning"> <i class="fas fa-exclamation-triangle"></i> vous vous etes deconnectez</small>');
  }
  if (data.includes("10")) {
    $('#bodyInscriptionTrajet').append('<small id="warningInscriptionprob" class="form-text warning"> <i class="fas fa-exclamation-triangle"></i> vous etes deja dans ce trajet</small>');
  }
  if (data.includes("11")) {
    $('#bodyInscriptionTrajet').append('<small id="warningInscriptionprob" class="form-text warning"> <i class="fas fa-exclamation-triangle"></i> vous n\'avez pas assez d\'argent sur votre compte</small>');
  }


  if(data.includes("30")){
    $('#btnAjoutEtape').before('<p class="form-text warning"> <i class="fas fa-exclamation-triangle"></i> Vous n\'etes pas connecté</p>');
  }
  if(data.includes("31")){
    $('#placeTotale').after('<p class="form-text warning"> <i class="fas fa-exclamation-triangle"></i> Erreur de saisie PlaceTotale </p>');
  }
  if(data.includes("32")){
    $('#DateHoraire').append('<p class="form-text warning"> <i class="fas fa-exclamation-triangle"></i> Erreur sur le prix</p>');
  }
  if(data.includes("33a")){
    $('#DateHoraire').append('<p class="form-text warning"> <i class="fas fa-exclamation-triangle"></i> Erreur de conformité Date </p>');
  }
  if(data.includes("33b")){
    $('#heureDepart').after('<p class="form-text warning"> <i class="fas fa-exclamation-triangle"></i> Erreur de conformité Heure </p>');
  }
  if(data.includes("341")){
    $('#heureDepart').after('<p class="form-text warning"> <i class="fas fa-exclamation-triangle"></i> Erreur de Format Heure</p>');
  }
  if(data.includes("342")){
    $('#DateHoraire').append('<p class="form-text warning"> <i class="fas fa-exclamation-triangle"></i> Erreur de Format Date</p>');
  }
  if(data.includes("353")){
    $('#btnAjoutEtape').before('<p class="form-text warning"> <i class="fas fa-exclamation-triangle"></i> Erreur Ville </p>');
  }
  if(data.includes("351")){
    $('#btnAjoutEtape').before('<p class="form-text warning"> <i class="fas fa-exclamation-triangle"></i> Erreur Champs Ville non défini</p>');
  }
  if(data.includes("352")){
    $('#btnAjoutEtape').before('<p class="form-text warning"> <i class="fas fa-exclamation-triangle"></i> Erreur de Ville inexistante</p>');
  }
  if(data.includes("36")){
    $('#immatriculation').after('<p class="form-text warning"> <i class="fas fa-exclamation-triangle"></i> Erreur Immatriculation</p>');
  }
  if(data.includes("361")){
    $('#critair').after('<p class="form-text warning"> <i class="fas fa-exclamation-triangle"></i> Erreur Crit air non renseigné</p>');
  }
  if(data.includes("362")){
    $('#hybride').after('<p class="form-text warning"> <i class="fas fa-exclamation-triangle"></i> Erreur renseignement Hybride </p>');
  }
  if(data.includes("363")){
    $('#idVehicule').after('<p class="form-text warning"> <i class="fas fa-exclamation-triangle"></i> Erreur immatriculation</p>');
  }

}


/******************************************************************************************************************************
**
**Page de discussion
**
******************************************************************************************************************************/


function chargeMessagesInterlocuteurs(){
  $('.interlocuteurs').on('click', function(e){
   
    e.preventDefault();
    var obj = $(this);

    interlocuteur = $('textarea#idInterlocuteurEnCours').val();
    $("#"+interlocuteur).css({
      'background-color':'#d8d8d8',
      'font-weight':'normal'
    });

    $('textarea#idInterlocuteurEnCours').val(obj.attr("id"));
    
    $.post('scriptphp/ControleurScript.php', 
    {
      idInterlocuteur: obj.attr("id"),
      fonction:"afficheMessages"
    },

      function(data,statut){
        afficheMessages(data, true);
      }
    );
    interlocuteur = $('textarea#idInterlocuteurEnCours').val();
    $("#"+interlocuteur).css({
      'background-color':'#ffffff',
      'font-weight':'bold'
    });
  });
}



$(document).ready(function(e){
  if($('.interlocuteurs').length){
    chargeMessagesInterlocuteurs();
  }
});



function envoyerMessage(){
  
  var msg = $('textarea#MsgAEnvoyer').val();
  if(msg != ""){
    var interlocuteur = $('textarea#idInterlocuteurEnCours').val();
    $('textarea#MsgAEnvoyer').val('');

    $.post('scriptphp/ControleurScript.php',

     {
      message: msg,
      idInterlocuteur: interlocuteur,
      fonction:"envoyerMessage"
     },
      function(){}
    );

    $.post('scriptphp/ControleurScript.php', 
    {
      idInterlocuteur: interlocuteur,
      fonction:"afficheMessages"
    },

      function(data,statut){
        $("#messages").html(data)
        $("#messages").scrollTop(999999);
      }
    );
  }
}



$('#EnvoieMsg').on('click', function(e){
  envoyerMessage();
});



$('#MsgAEnvoyer').keyup(function(e){
  if(e.keyCode == 13){
    envoyerMessage();
  }
});



function afficheMessagesEtInterlocuteurs(){
  var interlocuteur;

  $.post('scriptphp/ControleurScript.php',
    {fonction:"afficheInterlocuteurs"},
    function(data,statut){

      $('#interlocuteurs').html(data)

      interlocuteur = $('textarea#idInterlocuteurEnCours').val();
      $("#"+interlocuteur).css({
      'background-color':'#ffffff',
      'font-weight':'bold'
    });

      chargeMessagesInterlocuteurs();
    }
  );

  interlocuteur = $('textarea#idInterlocuteurEnCours').val();
  $.post('scriptphp/ControleurScript.php', 
  {
    idInterlocuteur: interlocuteur,
    fonction:"afficheMessages"
  },

    function(data,statut){
      afficheMessages(data, false);
    }
  );
   
}



function afficheMessages(data, chargeMessagesInterlocuteurs){
  var elem = $("#messages");
  var maxScrollTopOld = elem[0].scrollHeight - elem.outerHeight();

  $("#messages").html(data)


  var elem = $("#messages");
  var maxScrollTopNew = elem[0].scrollHeight - elem.outerHeight();

  if(chargeMessagesInterlocuteurs || maxScrollTopOld!=maxScrollTopNew)
    $("#messages").scrollTop(999999);
}



$(document).ready(function(e){

  if($('#messages').length){

    afficheMessagesEtInterlocuteurs();
   
    setInterval(function() {
      afficheMessagesEtInterlocuteurs();   
    }, 1000);
  }
});



function messagesNonLu(){
  $.post('scriptphp/ControleurScript.php',
    {fonction:"messagesNonLus"},
    function(data,statut){
      if(data!=0){
        $('#messagesNonLus').text(data);
         $('#messagesNonLus').removeClass('badge-light border').addClass('badge-danger');
         $('#envelopeMsg').removeClass('fa-envelope').addClass('fa-envelope-open');

      }
      
      else{
        $('#messagesNonLus').text("0"); 
        $('#messagesNonLus').removeClass('badge-danger').addClass('badge-light border');
        $('#envelopeMsg').removeClass('fa-envelope-open').addClass('fa-envelope');
      }
    }
  );
}



$(document).ready(function(e){

  if($('#messagesNonLus').length){

    messagesNonLu();

    setInterval(function(){
      messagesNonLu();
    },1000);
  }
});



/******************************************************************************************************************************
**
**Changement mot de passe depuis le profil
**
******************************************************************************************************************************/


var nouveauMdpEstValide=false;
var ancienMdpDiffNouveau=false;
var verifOk=false;
var msgErreurNouveauMdp="/!\\ Le mot de passe doit contenir au moins 8 caracteres dont une lettre en minuscule, une lettre majuscule, un chiffre et doit être différent de votre mot de passe actuel";
var msgErreurConfNouveauMdp="/!\\ Erreur dans la confirmation du mot de passe";

var regexMdp = new RegExp('^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{8,})');


$("#mdpActuel").on('input', function(e){
  e.preventDefault();
  if(this.value != $("#nouveauMdp").val()){
    ancienMdpDiffNouveau=true;
    if(nouveauMdpEstValide)
      $("#msgErreurNouveauMdp").text("");
  }
  else{
    ancienMdpDiffNouveau=false;
    if($("#nouveauMdp").val()!=""){
      $("#msgErreurNouveauMdp").text(msgErreurNouveauMdp);
    }
  }
});



$("#nouveauMdp").on('input',function(e){
  e.preventDefault();
  var mdp = this.value;

  if(regexMdp.test(mdp)){
    nouveauMdpEstValide=true;
    if(this.value!=$("#mdpActuel").val())
      $("#msgErreurNouveauMdp").text("");
  }
  else{
    nouveauMdpEstValide=false;
    $("#msgErreurNouveauMdp").text(msgErreurNouveauMdp);
  }
  if(this.value!=$("#mdpActuel").val()){
    ancienMdpDiffNouveau=true;
    if(nouveauMdpEstValide)
      $("#msgErreurNouveauMdp").text("");
  }
  else{
    ancienMdpDiffNouveau=false;
    $("#msgErreurNouveauMdp").text(msgErreurNouveauMdp);
  }
  if(this.value==$("#confirmationNouveauMdp").val()){
    verifOk=true;
    $("#msgErreurConfNouveauMdp").text("");
  }
  else{
    verifOk=false;
    if($("#confirmationNouveauMdp").val()!="")
      $("#msgErreurConfNouveauMdp").text(msgErreurConfNouveauMdp);
  }
});



$("#confirmationNouveauMdp").on('input',function(e){
  e.preventDefault();
  if(this.value == $("#nouveauMdp").val()){
    verifOk=true;
    $("#msgErreurConfNouveauMdp").text("");
  }
  else{
    verifOk=false;
    if($("#nouveauMdp").val()!="")
      $("#msgErreurConfNouveauMdp").text(msgErreurConfNouveauMdp);
  }
});



$(document).ready(function(e){
  if($("#boutonModifierMotDePasse").length){

    setInterval(function(){
      if(nouveauMdpEstValide && ancienMdpDiffNouveau && verifOk)
        $("#boutonModifierMotDePasse").prop("disabled", false);
      else
        $("#boutonModifierMotDePasse").prop("disabled", true);
    },100);
  }
});



$('#changeMdpProfil').submit(function(e){
  e.preventDefault();


  $.post('scriptphp/ControleurScript.php',
    {
      mdpActuel: $('#mdpActuel').val(),
      nouveauMdp: $('#nouveauMdp').val(),
      nouveauMdpConf: $('#confirmationNouveauMdp').val(),
      fonction:"changeMdpProfil"
    },
    function(data){
      if (data.includes("0")){
        $("#changementMDPModal").modal('toggle');
        alert("Le mot de passe a été modifié avec succès !");
      }
      else if(data.includes("1")){
        $('#msgErreurSaisieMdp').text('/!\\ Le mot de passe saisi est incorrect');
      }
      else if (data.includes("2")){
        alert("Une erreur est survenu veuillez réessayer");
      }
    }
  );

});



/******************************************************************************************************************************
**
**Envoie message depuis profil
**
******************************************************************************************************************************/

var zoneEnvoieNonVide=false;

$("#zoneEnvoieMsgProfil").on('input',function(e){
  //e.preventDefault();
  
  if(this.value != ""){
    zoneEnvoieNonVide=true;
  }
  else{
    zoneEnvoieNonVide=false;
  }
});



$('#zoneEnvoieMsgProfil').keyup(function(e){
  if(e.keyCode == 13 && zoneEnvoieNonVide){
    $("#boutonEnvoieMsgProfil").trigger('click');
  }
});



$(document).ready(function(e){
  if($("#zoneEnvoieMsgProfil").length){

    setInterval(function(){
      if(zoneEnvoieNonVide)
         $("#boutonEnvoieMsgProfil").prop("disabled", false);
      else
         $("#boutonEnvoieMsgProfil").prop("disabled", true);

    },100);
  }
});


$('#envoyerMessage').submit(function(e){
  e.preventDefault();


  $.post('scriptphp/ControleurScript.php',
    {
      message: $('#zoneEnvoieMsgProfil').val(),
      idInterlocuteur: $('#boutonEnvoieMsgProfil').attr('data-id'),
      fonction:"envoieMessageProfil"
    },
    function(data){
      if (data.includes("0")){
        $("#envoieMsgModal").modal('toggle');
        $('#zoneEnvoieMsgProfil').val("");
        alert("Le message a été envoyé avec succès !");
      }
      else if(data.includes("1")){
        alert("Une erreur est survenu veuillez réessayer");
      }
    }
  );
});


/******************************************************************************************************************************
**
**Place footer en bas de page
**
******************************************************************************************************************************/


function replaceFooter(){
   var docHeight = $(window).height();
  var footerHeight = $('#footer').height();
  var footerTop = $('#footer').position().top + footerHeight;

  if (footerTop < docHeight) {
   $('#footer').css('margin-top', (docHeight - footerTop) + 'px');
  }
}

$(document).ready(function() {
  replaceFooter();
});

$(window).resize(function(){
  replaceFooter();

});


/******************************************************************************************************************************
**
**Affiche ou desaffiche les composants
**
******************************************************************************************************************************/



$( window ).resize(function() {
  if ($(window).width() <768) {
    $(".composant" ).hide();
    $('#changeComposant').hide();
  }
  else{
    $(".composant" ).show();
    $('#changeComposant').show();
  }
});
$('#changeComposant').on('click', function(event) {
  event.preventDefault();
   $.post('scriptphp/ControleurScript.php',
    {
      fonction:"changeStatutComposant"
    },
    function(data){
      
      if (data.includes("0")){
        $('aside').removeClass('d-none');;
        $('section').toggleClass('col-md-6 col-md-8');
        $('#changeComposant').text("Desaffiche");
      }
      else if(data.includes("1")){
        $('aside').addClass('d-none');
        $('section').toggleClass('col-md-8 col-md-6');
        $('#changeComposant').text("Affiche");
      }
      replaceFooter();
    }
  );
});