$( window ).resize(function() {
  if ($(window).width() <768) {
  	$(".composant" ).hide();
  }
  else{
  	$(".composant" ).show();
  }
});

$("#inscriptionbutton").click(function(e){ // On sélectionne le formulaire par son identifiant
    e.preventDefault();
    removeWarningForm();
    alert("on rentre");
    //$('#email').val().length

    $.post('scriptphp/formulaireDinscription.php', // Un script PHP que l'on va créer juste après
            {
                nomFonction : "verifieInscription",
                email : $("#emailInscription").val(),  // Nous récupérons la valeur de nos input que l'on fait passer à connexion.php
                emailConf : $("#confemail").val(),
                nom : $('#nomInscription').val(),
                prenom : $('#prenomInscription').val(),
                mdp : $("#MDPInscription").val(),
                mdpConf : $("#confMDPInscription").val()
            },
 
            function(data,statut){
              //je passe le message d'erreur par un echo dans le serveur qui est recuperer dans le data
              alert(data);
                if(data.includes("success")){
                     // Le membre est connecté. Ajoutons lui un message dans la page HTML.
                    
                     //window.location.replace('index.php');
                }
                else{
                    verifError(data);
                     // Le membre n'a pas été connecté. (data vaut ici "failed")
                    
                }
         
            },
            'text'
         );
   


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