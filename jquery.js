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
  
}/*
$(document).on('keyup',"#rechercheDepart",function() {
  ville(this);
});
$(document).on('keyup',"#rechercheArrive",function() {
  ville(this);
});
$(document).on('focusin',"#rechercheDepart",function() {
  ville(this);
});
$(document).on('focusin',"#rechercheArrive",function() {
  ville(this);
});*/
$(document).on('click', '#buttonAgranditForm', function(event) {
  event.preventDefault();
  $("#formPrincipal").append('<div class="form-group col-md-3 partitAjoute"> <label for="inputAddress">date</label>  <input type="date" class="form-control" id="inputAddress" placeholder="1234 Main St">   </div> <div class="form-group col-md-3 partitAjoute"><label for="inputAddress2">prix</label>     <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor"> </div>     <div class="partitAjoute form-group col-md-2">     <label for="inputState">type de vehicule</label>     <select id="inputState" class="form-control">       <option selected>1</option> <option>2</option> </select> </div> </div> ');
  $( '<div class="form-row" id="regulierForm"> <div class="form-check"> <input class="form-check-input" type="checkbox" id="gridCheck"> <label class="form-check-label" for="gridCheck"> regulier </label></div> </div> ' ).insertBefore( "#buttonSubmitAccueil" );
  $("#buttonSubmitAccueil").remove();
  $('<div class="row justify-content-end" id="buttonSubmitAccueil"> <button type="submit" class="btn btn-primary"  style="margin-right: 3%">Sign in</button> </div> <div class="row" id="divbuttonrapetisseform"> <button class="btn btn-secondary" id="buttonRapetisseForm">-</button> </div>').insertAfter('#regulierForm');   

});

$(document).on('click', '#buttonRapetisseForm', function(event) {
  event.preventDefault();
  $(".partitAjoute").remove();
  $("#regulierForm").remove();

    $("#buttonSubmitAccueil").remove();
  $("#divbuttonrapetisseform").remove();
  $("#formulaireDeRecherche").append("<div class='row' id='buttonSubmitAccueil'> <button class='btn btn-secondary mr-auto' id='buttonAgranditForm'>+</button> <button type='submit' class='btn btn-primary' style='margin-right: 3%'>Sign in</button>  </div>");
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