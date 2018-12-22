var key = 0 ;
var tab;
var nbAffiche=0;

$( window ).resize(function() {
  if ($(window).width() <768) {
    $(".composant" ).hide();
  }
  else{
    $(".composant" ).show();
  }
});
function removeAide() {
  $('.aide').remove();
}

$("#rechercheDepart").autocomplete({
  source: "scriptphp/chercheVille.php"
});
$("#rechercheArrive").autocomplete({
  source: "scriptphp/chercheVille.php"
});

/*function ville(variable) {
 $.get('scriptphp/chercheVille.php', // Un script PHP que l'on va créer juste après
            
            { term: variable.val()}
                
            ,
 
            function(data,statut){ 
              alert(data);
              var val=JSON.parse(data);
              $("#villesTrouve").remove();
              variable.parent().append('<div id= "villesTrouve" class="border border-dark container"> </div> ')
                for (var i = 0; i < data.length; i++) {
                  $("#villesTrouve").append('<div id=villeTrouve'+i+' class="row villeTrouve" > </div>');
                  $("#villeTrouve"+i).append('<p> '+val[i]["nomVille"]+', '+ val[i]["codePostal"]+' <p>');
                }
                //$("#rechercheDepart").parent().append(t[0][0]);
                return data;
         
            },
            'text'
         ).fail(function(data,statut,xhr) {
           verifError(data.responseText);
         });
  
       }*/
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

       $("#buttonTrieRes1").change(function(event) {
        alert("fez");
       });

$("#inscription").submit(function(e){ // On sélectionne le formulaire par son identifiant
  e.preventDefault();
  removeWarningForm();
  alert("on rentre");
    //$('#email').val().length
    $.post('scriptphp/formulaireDinscription.php', // Un script PHP que l'on va créer juste après

      $("#inscription").serialize()
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
$("#formulaireDeRechercheResultat").submit(function(e){ // On sélectionne le formulaire par son identifiant
  e.preventDefault();
    $.post('scriptphp/formulaireDeRecherche.php', // Un script PHP que l'on va créer juste après

      $("#formulaireDeRechercheResultat").serialize()
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


function afficheRes(){
  removeResTrajet();
  console.log($("divHauteRes").attr("class"));
  nbResAAfficher=tab.length<nbAffiche?tab.length:nbAffiche;
  for (var i = 0; i < nbResAAfficher; i++) {

    $('#contenu').append('<div class="'+$("#divHauteRes").attr("class")+' removeResTrajet"> <a class="liensanscouleur '+$("#divHauteRes2").attr("class")+'" href="index.php?module=mod_trajet&id='+tab[i]["idTrajet"]+'"> <div class="col-2"> <img src="home.jpg" style="width: 100px"> <span class="">'+tab[i]["prenom"]+'</span> </div> <div class="col-6 row offset-1 justify-content-between" > <div class=" justify-content-between row container"> <span class="col-12 col-md-6">'+tab[i]["depart"]+'</span> <span class="col-6 text-right">'+tab[i]["heureDepart"]+'</span></div><div class="align-items-end justify-content-between row container"><span class="col-12 col-md-6" style="padding-right: 3px">'+tab[i]["destination"]+'</span> <span class="col-6 text-right">'+tab[i]["heureArrivee"]+'</span> </div> </div> <div class="col-2 row offset-1 justify-content-end "> <div class="row justify-content-end col-12"> <span class="align-top">'+tab[i]["placeTotale"]+'</span> </div> <div class="row align-content-end justify-content-end col-12" > <span class="align-text-bottomme">'+tab[i]["prix"]+'€</span> </div> </div> </a> </div>');

  }
}

$('#buttonAffichePlus').on('click',function(event) {
  event.preventDefault();
  nbAffiche+=10;
  afficheRes();
});


$('#addCar').on('click', function(e){
  e.preventDefault();

  var immatriculation= $(document).find('#immatriculation').val();
  var critair=$(document).find('#critair').val();
  var hybride=$(document).find('#hybride').is(":checked");
  var formData = new FormData();

  formData.append("photo", $("#photoCar")[0].files[0]);
  formData.append("immatriculation", immatriculation);
  formData.append("critair", critair);
  formData.append("hybride", hybride);
  $.ajax({
    url:'scriptphp/formTrajet.php',
    type:'POST',    
    contentType: false,
    processData: false,
    method: 'POST',
    type: 'POST', // For jQuery < 1.9
    data:formData,
    success : function(txt){
      console.log(txt);
      $(document).find('#immatriculation').val("");
      $(document).find('#critair').val("0");
      $(document).find('#hybride').prop('checked', false);
    },
    error: function(){
      alert("fail");
    }
  });
});


$('#envoiTrajet').on("click",function(e){
  e.preventDefault();
  console.log("Valeur de "+key);
  var soustrajets=[];

  if( key == 0){
    // console.log("pas dde sns")
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
    // console.log(soustrajet);
    soustrajets[0]= soustrajet;

  }else{
    // console.log(key)
    for( var i = 0 ; i < key+1 ; i++ ){
      // console.log(i);
      
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
      else if( i == key){//dernier
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
          // idVehiculeConducteur: $(document).find('#idVehiculeConducteur').val(),
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
          // idVehiculeConducteur: $(document).find('#idVehiculeConducteur').val(),
          idVehiculeConducteur: $(document).find('#idVehicule').find(':selected').val(),
          prix: $(document).find(prix).val(),
          regulier: $(document).find('#regulier').is(":checked")
        };
      }
      console.log(soustrajet)

      soustrajets[i]= soustrajet;
    }
  }
  console.log(soustrajets)

  var descriptionTrajet =$(document).find("#descriptionTrajet").val();
  var placeTotale=$(document).find("#placeTotale").val();
  
  $.ajax({
    url:'scriptphp/formTrajet.php',
    type:'POST',
    dataType : 'text',
    data: {
      soustrajet: soustrajets,
      descriptionTrajet: descriptionTrajet,
      placeTotale: placeTotale
    },
    success : function(txt){
      // window.location='index.php';
      console.log("msg :"+txt);
      key = 0;
    },
    error: function(txt){
      alert("fail");
      console.log("msg :"+txt);
    }
  });
});


$(function(){

  // ajout des champs etapes
  $("#btnAjoutEtape").on("click",function(){

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
        source: "scriptphp/chercheVille.php"
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
        source: "scriptphp/chercheVille.php"
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
    source: "scriptphp/chercheVille.php"
  });

  $(document).on('click',".btnSupprEtape",function(){
    if($(this).parent().parent().find("div").length==1 ){

      var id = $(this).parent().find("input").first().attr("id") ;
      var nb = parseInt(id.replace(/[^0-9\.]/g,''),10);

      console.log("On a supprimé le block");
      $(this).parent().parent().fadeOut(function(){
        $(this).remove(); 

      });
      $(document).find("#date"+nb).parent().parent().parent().fadeOut(function(){
        $(this).remove(); 
      });

    }else{

      var id = $(this).parent().find("input").first().attr("id") ;
      var nb = parseInt(id.replace(/[^0-9\.]/g,''),10);
      $(document).find("#date"+nb).parent().parent().remove();
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
  });

  //transforme les entrées non numerique  en vide
  $('#placeTotale').on("keyup",function(){
    var verif = $(this).val();
    if(verif.match(/[a-zA-Z]/g)){
      $(this).val(verif.replace(/[a-zA-Z]/g,""))
    }
  });

  $('#idVehicule').change(function() {
    var i  =$(this).find(':selected').attr("data-url"); 
    console.log(i)
    // console.log($(this).attr("data-url"));
    $('#imgCar').attr("src",i);
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
    var i  =$(this).find(':selected').attr("data-url"); 
    $('#imgCar').attr("src",i);

  });


//FUNCTION
function removeWarningForm(){
  $('.warning').remove();
}
function removeResTrajet(){
  $('.removeResTrajet').remove();
}

function verifError(data){
  if (data.includes("00")) {
    $('#divEmailInscription').append('<small id="warningemaildif" class=" form-text warning"> /!\\ ce champ est incorrect</small>');
  }
  if (data.includes("01")) {
    $('#divConfEmail').append('<small id="warningemaildif" class=" form-text warning"> /!\\ les emails sont différents</small>');
  }
  if(data.includes("02")){
    $('#divNomInscription').append('<small id="warningemaildif" class=" form-text warning"> /!\\ ce champ est incorrect</small>');
  }
  if(data.includes("03")){
    $('#divPrenomInscription').append('<small id="warningemaildif" class=" form-text warning"> /!\\ ce champ est incorrect</small>');
  }
  if (data.includes("04")) {
    $('#divMDPInscription').append('<small id="warningemaildif" class=" form-text warning"> /!\\ ce champ est incorrect il doit être au minimum superieur a 8 charactere, contenir une lettre en majuscule, un chiffre et un charactere en minuscule </small>');
  }
  if(data.includes("05")){
    $('#divConfMDPInscription').append('<small id="warningemaildif" class=" form-text warning"> /!\\ ce champ est incorrect</small>');
  }
  if (data.includes("06")) {
    $('#divEmailInscription').append('<small id="warningemaildif" class=" form-text warning"> /!\\ cette adresse email est deja utilisee</small>');
  }
}






function chargeInterlocuteurs(){
  $('.interlocuteurs').on('click', function(e){
   
    e.preventDefault();
    
    var obj = $(this);

    $('textarea#idInterlocuteurEnCours').val(obj.attr("id"));

      $.post('scriptphp/afficheMessages.php', 
      {
        idInterlocuteur: obj.attr("id")},

        function(data,statut){
          $("#messages").html(data)
          $("#messages").scrollTop(999999);
        }
      );

  });
}

$('.interlocuteurs').ready(function(e){
  chargeInterlocuteurs();
});


function envoyerMessage(){
  
  var msg = $('textarea#MsgAEnvoyer').val();
  if(msg != ""){
    var interlocuteur = $('textarea#idInterlocuteurEnCours').val();
    $('textarea#MsgAEnvoyer').val('');

    $.post('scriptphp/envoyerMessage.php',

     {
      message: msg,
      idInterlocuteur: interlocuteur
     },
      function(){
      }
    );

    $.post('scriptphp/afficheMessages.php', 
    {
      idInterlocuteur: interlocuteur
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

  $.post('scriptphp/afficheInterlocuteurs.php',
      {},
      function(data,statut){
        $('#interlocuteurs').html(data)
        chargeInterlocuteurs();
      }
    );

    interlocuteur = $('textarea#idInterlocuteurEnCours').val();
    $.post('scriptphp/afficheMessages.php', 
    {
      idInterlocuteur: interlocuteur
    },

      function(data,statut){
        var elem = $("#messages");
        var maxScrollTopOld = elem[0].scrollHeight - elem.outerHeight();

        $("#messages").html(data)

        var elem = $("#messages");
        var maxScrollTopNew = elem[0].scrollHeight - elem.outerHeight();

        if($("#messages").scrollTop().valueOf()==0 || maxScrollTopOld!=maxScrollTopNew){
          $("#messages").scrollTop(999999);
        }
      }
    );
}



$('#messages').ready(function(e){

  afficheMessagesEtInterlocuteurs();

  setInterval(function() {

    afficheMessagesEtInterlocuteurs();   
  }, 1000);
});

$('#messagesNonLus').ready(function(e){
  setInterval(function(){
    $.post('scriptphp/messagesNonLus.php',
      {},
      function(data,statut){
        if(data!=0)
          $('#messagesNonLus').text(data);
        
          else
            $('#messagesNonLus').text('');
      });
  },1000);
});


