function agranditForm() {
		document.getElementById('formulaireDeRecherche').innerHTML='<form id="formulaireDeRecherche"> <div class="form-row justify-content-around"> <div class="form-group col-md-6"> <label for="inputEmail4">depart</label> <input type="adresse" class="form-control" id="inputEmail4" placeholder="adresse"> </div> <div class="form-group col-md-6"> <label for="inputPassword4">destination</label> <input type="adresse" class="form-control" id="inputPassword4" placeholder="adresse"> </div> <div class="form-group col-md-3 "> <label for="inputAddress">date</label> <input type="date" class="form-control" id="inputAddress" placeholder="1234 Main St"> </div> <div class="form-group col-md-3"> <label for="inputAddress2">prix</label> <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor"> </div> <div class="form-group col-md-2"> <label for="inputState">type de vehicule</label> <select id="inputState" class="form-control"> <option selected>1</option> <option>2</option> </select> </div> </div> <div class="form-row"> <div class="form-check"> <input class="form-check-input" type="checkbox" id="gridCheck"> <label class="form-check-label" for="gridCheck"> regulier </label> </div> </div> <div class="row justify-content-end"> <button type="submit" class="btn btn-primary" style="margin-right: 3%">Sign in</button> </div> <div class="row"> <button class="btn btn-secondary" onclick="baisseForm()">-</button> </div>';
}
function baisseForm(){
	document.getElementById('formulaireDeRecherche').innerHTML='<div class="form-row justify-content-around"> <div class="form-group col-md-6"> <label for="inputEmail4">depart</label> <input type="adresse" class="form-control" id="inputEmail4" placeholder="adresse"> </div> <div class="form-group col-md-6"> <label for="inputPassword4">destination</label> <input type="adresse" class="form-control" id="inputPassword4" placeholder="adresse"> </div> </div> <div class="row"> <button class="btn btn-secondary mr-auto" onclick="agranditForm()">+</button> <button type="submit" class="btn btn-primary" style="margin-right: 3%">Sign in</button> </div> '
	}

if (window.innerWidth<768) {
	var elems = document.getElementsByClassName('composant');
	for (var i=0;i<elems.length;i+=1){
	  elems[i].style.display = 'none';
}
}
