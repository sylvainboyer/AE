function dejaReserve(){
	var idV = getIdV();
	var creneau = getCreneau();
	var chantier = getChantier();
	var idx = chantier - 1;
	for (var i = 0, l = g_a_visiteurs.length; i < l; ++i){
		if (idV == getId(g_a_visiteurs[i])){
			vis = g_a_visiteurs[i];
		}
	}
	if (chantier == getChantierCr(vis, creneau)){
		nb = getNbCr(vis, creneau);
	}else{
		nb = 0;
	}
	return nb;
}

function reserve(chantier, creneau, tot){
	var total = tot | false;
	var idx = parseInt(chantier, 10) - 1;
	var nb = parseInt(0);
	for (var i = 0, l = g_a_visiteurs.length; i < l; ++i){
		vs = g_a_visiteurs[i];
		if (chantier == getChantierCr(vs, creneau)){
			nb += parseInt(getNbPers(vs, creneau));
		}
	}
	if(!total)
		nb -= dejaReserve();
	return nb;
}

function placesRestantes(){
	var creneau = parseInt(getCreneau(), 10);
	var chantier = parseInt(getChantier(), 10);
	var oNbRest = document.getElementById('nb_restant'),
	oNb = document.getElementById('nb'),
	oBtnAjout = document.getElementById('do[ajouter]');
	if (creneau == 0 || chantier == 0){
		if(creneau == 0 && chantier == 0){
			oNbRest.innerHTML = "S&eacute;lectionnez une date ou un lieu";
		}else if(creneau == 0){
			oNbRest.innerHTML = "S&eacute;lectionnez maintenant une date";
		}else if(chantier == 0){
			oNbRest.innerHTML = "S&eacute;lectionnez maintenant un lieu";
		}
		oNb.disabled = true;
		oBtnAjout.disabled = true;
		oNb.style.cursor = "not-allowed";
		oBtnAjout.style.cursor = "not-allowed";
		return;
	}
	//var idxChantier = chantier - 1;
	var accueil = 0;
	for(var i = 0; i<g_a_hotes.length;i++){
		if(g_a_hotes[i][13] == chantier){
			accueil = getAccueil(g_a_hotes[i], creneau);
			break;
		}
	}
	if (accueil > 0){
		var nb = accueil - reserve(chantier, creneau);
		var plr = nb <= 1 ? "" : "s";
		var str = nb + " place" + plr + " disponible" + plr;
		if (nb >= 0){
			oNb.disabled = false;
			oBtnAjout.disabled = false;
			oNb.style.cursor = "auto";
			oBtnAjout.style.cursor = "pointer";
		}else{
			oNb.disabled = true;
			oBtnAjout.disabled = true;
			oNb.style.cursor = "not-allowed";
			oBtnAjout.style.cursor = "not-allowed";
		}
	}else if (accueil == 0){
		if ( creneau == 8 ){
			str = "Pas de visites le dimanche 9 apr&egrave;s midi !";
		}else if ( creneau == 7 ){
			str = "Pas de visites le dimanche 9 matin !";
		}else if ( creneau == 6 ){
			str = "Pas de visites le samedi 8 apr&egrave;s midi !";
		}else if ( creneau == 5 ){
			str = "Pas de visites le samedi 8 matin !";
		}else if ( creneau == 4 ){
			str = "Pas de visites le dimanche 2 apr&egrave;s midi !";
		}else if ( creneau == 3 ){
			str = "Pas de visites le dimanche 2 matin !";
		}else if ( creneau == 2 ){
			str = "Pas de visites le samedi 1er apr&egrave;s midi !";
		}else if ( creneau == 1 ){
			str = "Pas de visites le samedi 1er matin !";
		}
		oNb.disabled = true;
		oBtnAjout.disabled = true;
		oNb.style.cursor = "not-allowed";
		oBtnAjout.style.cursor = "not-allowed";
	}else{
		str = "pas de limites";
		oNb.disabled = false;
		oBtnAjout.disabled = false;
		oNb.style.cursor = "auto";
		oBtnAjout.style.cursor = "pointer";
	}
	oNbRest.innerHTML = str;
}

// ajoute ds le tableau des visiteurs la reservation courante
function ajouter(){
	var creneau = getCreneau();
	var chantier = getChantier();
	var nb = getNB();
	var vs = getCurV();
	// enregistre le chantier pour le creneau concerne
	var idx = 1 + parseInt(creneau);
	vs[idx] = chantier;
	// enregistre le nbre de personnes sur le chantier concerne
	idx += parseInt(4);
	vs[idx] = nb;
	var idxCreneau = 0;
	// afficher le div
	var strDiv;
	var strSpan;
	var str = "";
	switch(parseInt(creneau)){
		case 1:
			strDiv="samAM";
			strSpan="libSamAM";
			idxCreneau = N_H1;
			break;
		case 2:
			strDiv="samPM";
			strSpan="libSamPM";
			idxCreneau = N_H2;
			break;
		case 3:
			strSpan="libDimAM";
			strDiv="dimAM";
			idxCreneau = N_H3;
			break;
		case 4:
			strSpan="libDimPM";
			strDiv="dimPM";
			idxCreneau = N_H4;
			break;
		case 5:
			strDiv="sam2AM";
			strSpan="libSam2AM";
			idxCreneau = N_H5;
			break;
		case 6:
			strDiv="sam2PM";
			strSpan="libSam2PM";
			idxCreneau = N_H6;
			break;
		case 7:
			strSpan="libDim2AM";
			strDiv="dim2AM";
			idxCreneau = N_H7;
			break;
		case 8:
			strSpan="libDim2PM";
			strDiv="dim2PM";
			idxCreneau = N_H8;
			break;
	}
	idx = vs[idxCreneau] - 1;
	var div = document.getElementById(strDiv);
	var span = div.getElementsByTagName('span')[0];
	span.innerHTML = str + getNom(g_a_hotes[idx]) + " - " + nb + "p.";
	div.className = "visible";
	//resume()
	placesRestantes();
	return false;
}

function resume() {
	document.getElementById('finscription').reset();
	str = "<tr><td></td><td>sam.1 10h</td><td>sam.1 14h</td><td>dim.2 10h</td><td>dim.2 14h</td><td>sam.8 10h</td><td>sam.8 14h</td><td>dim.9 10h</td><td>dim.9 14h</td></tr>";
	//var idx = 1;
	for(var i = 0, idx = 1, l = g_a_hotes.length; i < l; ++i, ++idx){
		str += "<tr>";
		str += "<td>" + getNom(g_a_hotes[i]) + " (" + getAccueil(g_a_hotes[i]) + ")</td>";
		str += "<td>" + reserve(idx, 1) + "</td>";
		str += "<td>" + reserve(idx, 2) + "</td>";
		str += "<td>" + reserve(idx, 3) + "</td>";
		str += "<td>" + reserve(idx, 4) + "</td>";
		str += "<td>" + reserve(idx, 5) + "</td>";
		str += "<td>" + reserve(idx, 6) + "</td>";
		str += "<td>" + reserve(idx, 7) + "</td>";
		str += "<td>" + reserve(idx, 8) + "</td>";
		str += "</tr>";
	}
	str += "<tr><td colspan=9></td></tr>";
	for(var i = 0, l = g_a_visiteurs.length; i < l; ++i){
		str += "<tr>";
		str += "<td>"+getNomV(g_a_visiteurs[i])+"</td>";
		str += "<td>";
		if (g_a_visiteurs[i][N_NB1]){
			idx = g_a_visiteurs[i][N_H1]-1;
			str += getNom(g_a_hotes[idx])+" ("+(g_a_visiteurs[i][N_NB1])+")";
		}
		str += "</td>";
		str += "<td>";
		if (g_a_visiteurs[i][N_NB2]) {
			idx = g_a_visiteurs[i][N_H2]-1;
			str += getNom(g_a_hotes[idx])+" ("+(g_a_visiteurs[i][N_NB2])+")";
		}
		str += "</td>";
		str += "<td>";
		if (g_a_visiteurs[i][N_NB3]) {
			idx = g_a_visiteurs[i][N_H3]-1;
			str += getNom(g_a_hotes[idx])+" ("+(g_a_visiteurs[i][N_NB3])+")";
		}
		str += "</td>";
		str += "<td>";
		if (g_a_visiteurs[i][N_NB4]) {
			idx = g_a_visiteurs[i][N_H4]-1;
			str += getNom(g_a_hotes[idx])+" ("+(g_a_visiteurs[i][N_NB4])+")";
		}
		if (g_a_visiteurs[i][N_NB5]){
			idx = g_a_visiteurs[i][N_H5]-1;
			str += getNom(g_a_hotes[idx])+" ("+(g_a_visiteurs[i][N_NB5])+")";
		}
		str += "</td>";
		str += "<td>";
		if (g_a_visiteurs[i][N_NB6]) {
			idx = g_a_visiteurs[i][N_H6]-1;
			str += getNom(g_a_hotes[idx])+" ("+(g_a_visiteurs[i][N_NB6])+")";
		}
		str += "</td>";
		str += "<td>";
		if (g_a_visiteurs[i][N_NB7]) {
			idx = g_a_visiteurs[i][N_H7]-1;
			str += getNom(g_a_hotes[idx])+" ("+(g_a_visiteurs[i][N_NB7])+")";
		}
		str += "</td>";
		str += "<td>";
		if (g_a_visiteurs[i][N_NB8]) {
			idx = g_a_visiteurs[i][N_H8]-1;
			str += getNom(g_a_hotes[idx])+" ("+(g_a_visiteurs[i][N_NB8])+")";
		}
		str += "</td>";
		str += "</tr>";
	}
	document.getElementById('t-inscription').innerHTML = str;
	// resume des reservations en cours de validation...
}

// annule la reservation sur le creneau cr du visiteur courant
function annuler(cr){
	var vs = getCurV();
	switch(parseInt(cr)){
	case 1:
		strDiv = "samAM";
		strSpan = "libSamAM";
		idxCreneau = N_H1;
		idxNb = N_NB1;
		break;
	case 2:
		strDiv="samPM";
		strSpan="libSamPM";
		idxCreneau = N_H2;
		idxNb = N_NB2;
		break;
	case 3:
		strDiv = "dimAM";
		strSpan = "libDimAM";
		idxCreneau = N_H3;
		idxNb = N_NB3;
		break;
	case 4:
		strDiv = "dimPM";
		strSpan = "libDimPM";
		idxCreneau = N_H4;
		idxNb = N_NB4;
		break;
	case 5:
		strDiv = "sam2AM";
		strSpan = "libSam2AM";
		idxCreneau = N_H5;
		idxNb = N_NB5;
		break;
	case 6:
		strDiv="sam2PM";
		strSpan="libSam2PM";
		idxCreneau = N_H6;
		idxNb = N_NB6;
		break;
	case 7:
		strDiv = "dim2AM";
		strSpan = "libDim2AM";
		idxCreneau = N_H7;
		idxNb = N_NB7;
		break;
	case 8:
		strDiv = "dim2PM";
		strSpan = "libDim2PM";
		idxCreneau = N_H8;
		idxNb = N_NB8;
		break;
	default:
		break;
	}
	idx = vs[idxCreneau] - 1;
	vs[idxCreneau] = 0;
	vs[idxNb] = 0;
	var div = document.getElementById(strDiv);
	var span = div.getElementsByTagName('span')[0];
	span.innerHTML = "";
	div.className = "cache";
	resume();
	placesRestantes();
}

///////////////////////////////////////////////
// check les input text pour &, ', ? ...
function checkStr(str_input){
	str = str_replace(str_input, "&", "&amp;");                // ?
	str = str_replace(str, "é", "&eacute;");
	str = str_replace(str, "è", "&egrave;");
	str = str_replace(str, "à", "&agrave;");
	return str;
}

function str_replace(str_input, c_out, c_in){
	var str_output = "",
		c = "";
	for (var i = 0, l = str_input.length; i < l; ++i){
		c = str_input.charAt(i);
		if (c == c_out){
			str_output += c_in;
		}else{
			str_output += c;
		}
	}
	return str_output;
}
    