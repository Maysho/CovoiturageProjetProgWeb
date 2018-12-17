var key = 0 ;

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



$('#addCar').on('click', function(e){
  e.preventDefault();
  alert("dans lafocntione");
  var immatriculation= $(document).find('#immatriculation').val();
  var critair=$(document).find('#critair').val();
  var hybride=$(document).find('#hybride').is(":checked");
  // console.log(immatriculation);
  // console.log(critair);
  // console.log(hybride);
  var formData = new FormData();
  formData.append("photo", $("#photoCar")[0].files[0]);
  formData.append("immatriculation", immatriculation);
  $.ajax({
    url:'scriptphp/formTrajet.php',
    type:'POST',    
    contentType: false,
    processData: false,
    method: 'POST',
    type: 'POST', // For jQuery < 1.9
    data:{
      immatriculation : immatriculation,
      critair: critair,
      hybride: hybride,
      formData
    },
    success : function(txt){
       // window.location='/CovoiturageProjetProgWeb/index.php' 
       console.log(txt);
       alert("dans le ajax" + txt);
    },
    error: function(){
      alert("fail");
    }
  });

});

      /*
$('#addCar').on('click', function(e){
  e.preventDefault();
  alert("dans lafocntione");
  var immatriculation= $(document).find('#immatriculation').val();
  var critair=$(document).find('#critair').val();
  var hybride=$(document).find('#hybride').val();
  // console.log(immatriculation);
  // console.log(critair);
  // console.log(hybride);
  var formData = new FormData();
  formData.append("photo", $("#photoCar")[0].files[0]);
  formData.append("immatriculation", immatriculation);
  $.ajax({
    url:'scriptphp/formTrajet.php',
    type:'POST',    
    contentType: false,
    processData: false,
    method: 'POST',
    type: 'POST', // For jQuery < 1.9
    data:formData,
    success : function(txt){
       // window.location='/CovoiturageProjetProgWeb/index.php' 
       console.log(txt);
       alert("dans le ajax" + txt);
    },
    error: function(){
      alert("fail");
    }
  });

});
*/

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
      // idVehiculeConducteur: $(document).find('#idVehiculeConducteur').val(),
      idVehiculeConducteur: 1,
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
          // idVehiculeConducteur: $(document).find('#idVehiculeConducteur').val(),
          idVehiculeConducteur: 1,
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
          idVehiculeConducteur: 1,
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
          idVehiculeConducteur: 1,
          prix: $(document).find(prix).val(),
          regulier: $(document).find('#regulier').is(":checked")
        };
      }
      console.log(soustrajet)
      soustrajets[i]= soustrajet;
    }
  }
  // console.log(soustrajets)

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
    error: function(){
      alert("fail");
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

});

//FUNCTION
function removeWarningForm(){
  $('.warning').remove();
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