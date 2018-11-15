window.onload = function () {
	/*bandeauResize();
	Event.observe(window, "resize", bandeauResize);*/
	var f = document.getElementById('finscription');
	var selects = f.getElementsByTagName('select');
	var i = 0,
		l = 0;
	for (i = 0, l = selects.length; i < l; ++i) {
		//if (cssjs("check", divs[i], "hote")) {    
		selects[i].onchange = function(){
								setSelects(this);
								placesRestantes();
		};
		//}
	}
	var f = document.getElementById('finscription');
	var boutons = f.getElementsByTagName('input');
	for (i = 0, l = boutons.length; i < l; ++i) {
		if (cssjs("check", boutons[i], "img")) {    
			boutons[i].onmouseover = function(){roll(this);};
			boutons[i].onmouseout = function(){roll(this);};
		}
		if (cssjs("check", boutons[i], "annule")) {    
			boutons[i].onmouseover = function(){showLib(this); roll(this);};
			boutons[i].onmouseout = function(){showLib(this); roll(this);};
			boutons[i].onclick = function(){setBouton("annule"); setSelects(this);};
		}
		if (cssjs("check", boutons[i], "voir")) {    
			boutons[i].onclick = function(){setBouton("voir");};
		}
		if (cssjs("check", boutons[i], "ajouter")) {
			 boutons[i].onclick = function(){setBouton("ajouter");};
		}
    }
	// # map #
	/*var els = $$('li');
	for (var i = 0, l = els.length; i < l; ++i) {
		els[i].observe('mouseover', function(){
				surligneLi(this.id);
			});
		els[i].observe('click', function(){
				selectligneLi(this.id);
				map(this.id);
			});
		els[i].observe('mouseout', function(){
				deSurligneLi(this.id);
			});
		$('map').observe('click', function(){
				deSelectTout(this.id);
				showMap('mcache');
			});
  	}
	preload();*/
	// # fin map #
	// # début scroll top icon #
	$('scroll-bar').observe('click', scrollup);
	if(document.viewport.getScrollOffsets()[1] >= 250)
		$('scroll-bar').appear({ duration: 0.5 });
	document.observe('scroll', function(){
			if(document.viewport.getScrollOffsets()[1] >= 250){
				$('scroll-bar').appear({ duration: 0.5 });
			}else{
				$('scroll-bar').fade({ duration: 0.5 });
			}
		});
	// # fin scroll top icon #
	//placesRestantes();
}

function setSelects(sel){
	//alert(sel.id + " - " + sel.value + " - " + sel.options[sel.selectedIndex].text);
	var id = sel.id;
	var url = "liste" + capitalize(id) + ".php";
	var pv = sel.value,
		param = "";
	if (id == "creneau"){
		param = "IdC";
	}else{ //id=hote
		param = "IdH";
	}
	new Ajax.Request(url, {
		parameters: param + "=" + pv,
		asynchronous: false,
        method:'post',
        onSuccess: function(transport){
			//alert("OK Ajax : " + transport.responseXML);
                readSelData(transport.responseXML);
        },
        onFailure: function(){
            //displayHolder.src = 'map/map-0.gif';
			alert("err Ajax : " + transport.status);
        }
    });
}

function readSelData(oData) {
	var selid = oData.getElementsByTagName("select")[0].getAttribute("id");
	var nodes = oData.getElementsByTagName("item");
	var oSelect = document.getElementById(selid);
	var selected = oSelect.value;
	var oOption, oInner;
	var atId = "",
		atVal = "";
	var opTxt = "Sélectionnez un lieu";
	if(selid == "creneau"){
		opTxt = "Sélectionnez une date";
	}
	// vide le select
	oSelect.innerHTML = "";
	// Ajoute l'option 0
	oOption = document.createElement("option");
	oInner  = document.createTextNode(opTxt);
	oOption.value = 0;
	oOption.appendChild(oInner);
	oSelect.appendChild(oOption);
	// Ajoute les autres options
	for (var i = 0, c = nodes.length; i < c; ++i) {
		atId = nodes[i].getAttribute("id");
		atVal = nodes[i].getAttribute("val");
		oOption = document.createElement("option");
		oInner = document.createTextNode(atVal);
		oOption.value = atId;
		if(atId == selected){
			oOption.selected = true;
		}
		oOption.appendChild(oInner);
		oSelect.appendChild(oOption);
	}
}

function valider(frm){
//  alert (frm.elements['bouton'].value)
  if (frm.elements['bouton'].value == "repas") return true;
  if (frm.elements['bouton'].value == "annule") return true;
  if (frm.elements['bouton'].value == "voir" && frm.elements['nn'].value != "" && frm.elements['pp'].value != "") return true;
  //alert ("g"+frm.elements['do'].value)
  var creneau = getCreneau();
  var chantier = getChantier();

//alert("alert"+frm.elements['action'].value)
  if (frm.elements['action'].value == 'admin'){
    if(frm.elements['nn'].value == ""){
		alert("Saisissez le nom");
    	return false;
    }
    if(frm.elements['pp'].value == ""){
		alert("Saisissez le prenom");
        return false;
    }
    if(frm.elements['mm'].value == ""){
		alert("Saisissez l'adresse mail");
        return false;
    }
  }
  if (frm.elements['chantier'].value == 0){
    alert("Choisissez le lieu de la visite");
    return false;
  }
  if (frm.elements['creneau'].value == 0){
    alert("Choisissez le moment de la visite");
    return false;
  }
  if (getNB() == '' || getNB() == 0){
    alert("Choisissez le nombre de personnes");
    return false;
  }
	var accueil = 0;
	//var idxChantier = chantier - 1;
	for(var i = 0; i<g_a_hotes.length;i++){
		if(g_a_hotes[i][13] == chantier){
			accueil = getAccueil(g_a_hotes[i], creneau);
			break;
		}
	}
  if (accueil > 0){
    var nb = accueil - reserve(chantier, creneau);
    if (nb >= getNB()){
      return true;
	}else{
      plr = nb > 1 ? "s" : "";
      alert ("il y a seulement " + nb + " place" + plr + " disponible" + plr + " !");
      return false;
    }
  }else if (accueil == 0){
    alert ("inscription pour ce lieu à cette date non disponible !");
    return false;
  }else{
    return true;
  }
}

function capitalize(s){
    return s[0].toUpperCase() + s.slice(1);
}