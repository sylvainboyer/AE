// variables globales
//var g_a_hotes;
//var g_a_visiteurs;

//un Hote est un tableau
//  HOTE[ID] : id
//  HOTE[NAME] : nom
//  HOTE[PLACESAM] : nbre de places samedi matin
//  HOTE[PLACES] : nbre de places samedi
//  HOTE[PLACED] : nbre de places dimanche
//  HOTE[PHOTO] :
//  HOTE[NB_PHOTO] :

var N_OA			= 0;
var N_NOM			= 1;
var N_PLACESAM		= 2;
var N_PLACESPM		= 3;
var N_PLACEDAM		= 4;
var N_PLACEDPM		= 5;
var N_PLACES2AM		= 6;
var N_PLACES2PM		= 7;
var N_PLACED2AM		= 8;
var N_PLACED2PM		= 9;
var N_PHOTO			= 10;
var N_NB_PHOTO		= 11;
var N_LEGENDE_PHOTO	= 12;
var N_ID			= 13;

///////////////////////////////////////
//
//                  0   1    2         3         4         5         6          7          8          9          10     11        12        13
function createHote(oa, nom, placesam, placespm, placedam, placedpm, places2am, places2pm, placed2am, placed2pm, photo, nb_photo, legendes, id){
	var arrayAux;
	arrayAux = new Array;
	arrayAux[N_OA] = oa;
	arrayAux[N_NOM] = nom;
	arrayAux[N_PLACESAM] = placesam;
	arrayAux[N_PLACESPM] = placespm;
	arrayAux[N_PLACEDAM] = placedam;
	arrayAux[N_PLACEDPM] = placedpm;
	arrayAux[N_PLACES2AM] = places2am;
	arrayAux[N_PLACES2PM] = places2pm;
	arrayAux[N_PLACED2AM] = placed2am;
	arrayAux[N_PLACED2PM] = placed2pm;
	arrayAux[N_PHOTO] = photo;
//alert(arrayAux[N_PHOTO]);
	arrayAux[N_NB_PHOTO] = nb_photo;
	arrayAux[N_LEGENDE_PHOTO] = [legendes];
	arrayAux[N_ID] = id;
	return arrayAux;
}

//un Visiteur est un tableau
//  VISITEUR[IDV] : id
//  VISITEUR[NOMV] : nom
//  VISITEUR[PRENOM] : prenom
//  VISITEUR[mail] : mail
//  VISITEUR[H1] : lieu de visite sam am
//  VISITEUR[H2] : lieu de visite sam pm
//  VISITEUR[H3] : lieu de visite dim pm
//  VISITEUR[H4] : lieu de visite dim am
//  VISITEUR[NB1] : nb personnes visite sam am
//  VISITEUR[NB2] : nb personnes visite sam pm
//  VISITEUR[NB3] : nb personnes visite dim am
//  VISITEUR[NB4] : nb personnes visite dim pm

var N_IDV     = 0;
var N_NOMV    = 1;
var N_H1      = 2;
var N_H2      = 3;
var N_H3      = 4;
var N_H4      = 5;
var N_H5      = 6;
var N_H6      = 7;
var N_H7      = 8;
var N_H8      = 9;
var N_NB1     = 10;
var N_NB2     = 11;
var N_NB3     = 12;
var N_NB4     = 13;
var N_NB5     = 14;
var N_NB6     = 15;
var N_NB7     = 16;
var N_NB8     = 17;

///////////////////////////////////////
// constructeur
//                      0   1    2   3   4   5   6   7   8   9   10   11   12   13   14   15   16   17
function createVisiteur(id, nom, h1, h2, h3, h4, h5, h6, h7, h8, nb1, nb2, nb3, nb4, nb5, nb6, nb7, nb8){
	var arrayAux;
	arrayAux = new Array;
	arrayAux[N_IDV] = id;
	arrayAux[N_NOMV] = nom;
	arrayAux[N_H1] = h1;
	arrayAux[N_H2] = h2;
	arrayAux[N_H3] = h3;
	arrayAux[N_H4] = h4;
	arrayAux[N_H5] = h5;
	arrayAux[N_H6] = h6;
	arrayAux[N_H7] = h7;
	arrayAux[N_H8] = h8;
	arrayAux[N_NB1] = nb1;
	arrayAux[N_NB2] = nb2;
	arrayAux[N_NB3] = nb3;
	arrayAux[N_NB4] = nb4;
	arrayAux[N_NB5] = nb5;
	arrayAux[N_NB6] = nb6;
	arrayAux[N_NB7] = nb7;
	arrayAux[N_NB8] = nb8;
	return arrayAux;
}

///////////////////////////////////////
// selecteurs

// retourne le creneau selectionne ds le formulaire pour la visite
function getCreneau(){
	var creneau = document.getElementById('creneau');
	return creneau.value;
}
// retourne le lieu selectionne ds le formulaire pour la visite
function getChantier(){
	var chantier = document.getElementById('chantier');
	return chantier.value;
}
// retourne le visiteur en cours de reservation
function getIdV(){
	var id = document.getElementById('id');
	return id.value;
}
// retourne l'id visiteur vis
function getId(vis){
	var id = vis[0];
	return id;
}
// retourne le nbre de personnes pour la visite
function getNB(){
	var nb = document.getElementById('nb');
	return nb.value;
}
// retourne le nb de personnes pour le creneau cr (1 2 3 4) du visiteur vs
function getNbPers(vs, cr){
	var idx = 9;
	for (var i = 0; i < cr; ++i){
		idx++;
	}
	return vs[idx];
}
// retourne le lieu pour le creneau cr (1 2 3 4) du visiteur vs
function getChantierCr(vs, cr){
	var idx = 1;
	for (var i = 0; i < cr; ++i){
		idx++;
	}
//alert(vs+" ; "+idx)
	return vs[idx];
}
// !!! CETTE FONCTION FAIT LA MEME CHOSE QUE LA PRECEDANTE !!!
function getNbCr(vs, cr){
	var idx = 9;
	for (var i = 0; i < cr; ++i){
		idx++;
	}
//alert(vs+" ; "+idx)
	return vs[idx];
}
// retourne nb place d'accueil du chantier hote pour le creneau
function getAccueil(hote, creneau){
    return creneau == 8 ? hote[N_PLACED2PM] : creneau == 7 ? hote[N_PLACED2AM] : creneau == 6 ? hote[N_PLACES2PM] : creneau == 5 ? hote[N_PLACES2AM] : creneau == 4 ? hote[N_PLACEDPM] : creneau == 3 ? hote[N_PLACEDAM] : creneau == 2 ? hote[N_PLACESPM] : creneau == 1 ? hote[N_PLACESAM] : -1;
}
function getNom(hote){
	return hote[N_NOM];
}
function getNomV(vs){
  return vs[N_NOMV];
}

// retourne le visiteur (objet et non idx) en cours de reservation -> TABLEAU !?
function getCurV(){
	var nom = document.getElementById('n').value+" "+document.getElementById('p').value;
	var vs;
//alert(nom);
	for (var i = 0, l = g_a_visiteurs.length; i < l; ++i){
		if(getNomV(g_a_visiteurs[i]) == nom){
			vs = g_a_visiteurs[i];
		}
	}
	return vs;
}

// retourne le nom des photos de l'hote id
function getPhoto(id){
	//alert(id);
	return g_a_hotes[id][N_PHOTO];
}
// retourne la légende de la photo de l'hote id
function getLegendePhoto(id, num){
	//alert(id);
	return g_a_hotes[id][N_LEGENDE_PHOTO][0][num];
}

// retourne le nom de l'hote id
function getNomHote(id){
	return g_a_hotes[id][N_NOM];
}
// retourne le nombre de photos de l'hote id
function getNbPhoto(id){
	return g_a_hotes[id][N_NB_PHOTO];
}

///////////////////////////////////////
// construction des tableaux
// par PhP - resa.php -> tab.js
/*
g_a_hotes     = new Array
g_a_visiteurs = new Array

g_a_hotes[g_a_hotes.length] = createHote(1, "mathieu sabin", 10)
g_a_hotes[g_a_hotes.length] = createHote(2, "stephane artous", 20)
g_a_hotes[g_a_hotes.length] = createHote(3, "didier chevreux", 15)


g_a_visiteurs[g_a_visiteurs.length] = createVisiteur(0, "jb jamin", 0, 1, 0, 2, 0, 2, 0, 2)
g_a_visiteurs[g_a_visiteurs.length] = createVisiteur(0, "a cheneveau", 0, 1, 0, 3, 0, 1, 0, 1)
*/
