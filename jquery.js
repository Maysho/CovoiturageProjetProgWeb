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

/*
$(document).on('mousedown',".villeTrouve",function(){
  $("#"+this.id).parent().parent().children('input').val($(this).children().text());
  $("#villesTrouve").remove();
  });
$(document).on('focusout',"#villeDepartRecherche",function(event) {
  $("#villesTrouve").remove();
});
$(document).on('focusout',"#villeArriveRecherche",function(event) {
  $("#villesTrouve").remove();
});*/
$( "#rechercheDepart" ).autocomplete({
      source: "scriptphp/chercheVille.php"
    });
/*$("#villeDepartRecherche").autocomplete({
      source: ville($("#villeDepartRecherche"))
    });*/
function ville(variable) {
 $.post('scriptphp/chercheVille.php', // Un script PHP que l'on va créer juste après
            
            { ville: variable.val()}
                
            ,
 
            function(data,statut){ 
              alert(data);
              /*var val=JSON.parse(data);
              $("#villesTrouve").remove();
              variable.parent().append('<div id= "villesTrouve" class="border border-dark container"> </div> ')
                for (var i = 0; i < data.length; i++) {
                  $("#villesTrouve").append('<div id=villeTrouve'+i+' class="row villeTrouve" > </div>');
                  $("#villeTrouve"+i).append('<p> '+val[i]["nomVille"]+', '+ val[i]["codePostal"]+' <p>');

                }*/
                //$("#rechercheDepart").parent().append(t[0][0]);
                return data;
         
            },
            'text'
         ).fail(function(data,statut,xhr) {
           verifError(data.responseText);
         });
  
}
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
                    
                     window.location.replace('index.php');
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

$('#formTrajet').submit(function(e){
  e.preventDefault();
  console.log("SVP");
  alert("1");
  // $.post('scriptphp/formTrajet.php', $("#formTrajet").serialize(), function(data, statut){ });
  $.ajax({
    url:'scriptphp/formTrajet.php',
    method:'POST',
    // $_POST['idConduteur'],$_POST['soustrajets'],$_POST['idVehicule'],$_POST['descriptionTrajet'],$_POST['placeTotale']
    data: {
      soustrajets: "soustrajets",
      idVehicule: "idVehicule",
      descriptionTrajet: "descriptionTrajet",
      placeTotale: "placeTotale"
    },
    success : function(){
      alert("gg");
      console.log(idVehicule);
      console.log(descriptionTrajet);
      console.log(placeTotale);
    },
    error: function(){
      alert("fail");
    }
  });
});


$(function(){

  $("#btnAjoutEtape").click(function(){
    // $("#etape").removeAttr("hidden");
    var fils= $("#etape").find("#villeEtape").clone();
    fils.find('btnSupprEtape').
    $("#etape").append(fils);
  // console.log($(this).find(".nomVille").length());
  });

  $(document).on('click',".btnSupprEtape",function(){
    /*if($(document).find(".etape .nomVille").count()){
    }*/
    $(this).parent().remove();
    console.log("on a cliqué");
  });

});

   /*$("#btnAjoutEtape").click(function(){
    // $("#etape").removeAttr("hidden");
    var fils= $("#etape").clone().removeAttr("hidden");
    fils = fils.attr("id","");
    $("#departEtape").append(fils);
  });


  if(  ){
    $(document).on('click',".btnSupprEtape",function(){
      $(this).parent().remove();
    });
  }else{
    $(document).on('click',".btnSupprEtape",function(){
      $(this).parent().remove();
    });
  }*/

    /*$("#btnAjoutEtape").remove();*/
  //   $("#etape").focusin(function(){
  //     alert("entrer");
  //       $(this).css("background-color", "#FFFFCC");
  //   });
  // });

  // $("#etape").focusout(function(){
  //     alert("sortie");
  //   $(this).css("background-color", "#FFFFFF");
  // });




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