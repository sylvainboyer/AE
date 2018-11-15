//baklicol = "";
//orilicol = "";

function setBouton(btStr) {
	var bt = document.getElementById('bouton');
	bt.value = btStr;
}

function roll(img){
	// get the src of the image, and find out the file extension
	var src = img.src;
	var ftype = src.substring(src.lastIndexOf('.'), src.length);
	// check if the src already has an -over and delete it, if that is the case 
	if (/-over/.test(src)) {
		var newsrc = src.replace('-over','');
	} else {
	// else, add the -over to the src 
		var newsrc = src.replace(ftype, '-over' + ftype);
	}
	img.src = newsrc;
}

function showLib(o){
	// met en evidence
	cssjs('addorremove', o.parentNode, 'important');
}

function map(li){
	var f = $('map');
	var img = f.getElementsByTagName('img');
	var src = img[0].src;
	var ftype = src.substring(src.lastIndexOf('.'), src.length);
	var racine = src.substring(0, src.lastIndexOf('-'));
	var idx = li.substring(li.lastIndexOf('.')+1, li.length);
	checkForFile(racine+"-"+idx+ftype,img[0]);
	//surligneLi(li)
}

function unmap(li){
	var f = $('map');
	var img = f.getElementsByTagName('img');
	img[0].src = 'map/c-000.gif';
	showMap('mcache');
	//deSurligneLi(li)
}

function showMap(v){
	var f = document.getElementById('map');
	cssjs("set", f, v);
}

function selectligneLi(li){
	var lignes = $$('li');
	var lig,
		elts,
		it;
	lignes.each(function(lig){
		elts = $A(lig.firstDescendant().childElements());
		if(lig.id === li){
			lig.addClassName("lisel");
			elts.each(function(it) {
				it.addClassName("lisel");
			});
		}else{
			lig.removeClassName("lisel");
			elts.each(function(it) {
				it.removeClassName("lisel");
			});
		}
	});
}

function surligneLi(li){
	var ligne = $(li);
	var elts = $A(ligne.firstDescendant().childElements());
	var it;
	ligne.addClassName("lisur");
	elts.each(function(it) {
		it.addClassName("lisur");
	});
}

function deSelectTout(){
	var lignes = $$('li');
	var elts,
		it;
	lignes.each(function(lignes){
		lignes.removeClassName("lisel");
		elts = $A(lignes.firstDescendant().childElements());
		elts.each(function(it) {
			it.removeClassName("lisel");
		});
	});
}

function deSelectligneLi(li){
	var ligne = $(li);
	var elts = $A(ligne.firstDescendant().childElements());
	var it;
	ligne.removeClassName("lisel");
	elts.each(function(it) {
		it.style.color = "";
		it.removeClassName("lisel");
	});
}

function deSurligneLi(li){
	var ligne = $(li);
	var elts = $A(ligne.firstDescendant().childElements());
	var it;
	ligne.removeClassName("lisur");
	elts.each(function(it) {
		it.style.color = "";
		it.removeClassName("lisur");
	});
}

function preload(){
	// Compteur
	var nbh = $('nbh').innerHTML;
	// Crée l'objet
	var imageObj = new Image();
	// Défini la liste d'images
	//images = new Array();
	for (var i = 1; i <= nbh; ++i) {
		/*images[i]="map/c-"+i+".gif";
		imageObj.src = images[i];*/
		imageObj.src = "map/c-"+i+".gif";
     }
     // Démarre le préchargement
     /*for(i = 1; i <= nbh ; ++i) {
		 imageObj.src = images[i];
     }*/
}

function checkForFile(imgName, displayHolder){
	new Ajax.Request(imgName, {
		method:'get',
		onSuccess: function(transport){
			var response = transport.status || "no response text";
			if(parseInt(response) == 200){
				displayHolder.src = imgName;
				showMap('mvisible');
			}
		},
		onFailure: function(){
			displayHolder.src = 'map/c-0.gif';
			showMap('mvisible');
		}   
	});     
}
