<?php
ob_start('ob_gzhandler');
$ttl = 4*24*3600;
session_set_cookie_params($ttl);
ini_set('session.gc_maxlifetime', $ttl);
session_name('eceh');
session_start();

// A COMMENTER AVANT PRODUCTION PUIS TESTER LA PAGE [*** vérifier qu'il ne reste aucun debug( ***]
//include ('debug.php');

include ('defineInc.php');
include ('dbInc.php');

setlocale(LC_ALL, 'fr_CA.utf8'); // fr_FR pour la France
// TODO : A REVOIR (avec ligne 172)
$iECEHDate = $DATE_FIN_INSCR;
$action = $_POST["action"];
/*// pb iconv non installe chez free
$nom = iconv('UTF-8', 'UTF-8//TRANSLIT', $_POST["n"]);
$prenom = iconv('UTF-8', 'UTF-8//TRANSLIT', $_POST["p"]); // ok site
$nomDB = iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $_POST["n"]); // ok base
$prenomDB = iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $_POST["p"]); // ok base
*/
$nom = strtoupper($_POST["n"]);
$prenom = ucwords(strtolower($_POST["p"]));
$nomDB = strtoupper($_POST["n"]);
$prenomDB = ucwords(strtolower($_POST["p"]));
//debug ($nom ." " . $prenom);
//$nom = strtoupper(removeAccent($_POST["n"]));
//$prenom = ucwords(strtolower(removeAccent($_POST["p"])));
/*$nom = strtoupper($_POST["n"]);
//$prenom = ucwords(strtolower($_POST["p"]));
$prenom = strtoupper($_POST["p"]);*/
$tel = $_POST["t"];
$mail = $_POST["m"];
$idV = $_POST["id"];
$nb = $_POST["nb"];
//@$do = $_POST["do"];
$do = $_POST["bouton"];
$idH = $_POST["chantier"];
$creneau = $_POST["creneau"];

//global $strDebug;
//$strDebug="vide";

/********************************************************
*            controles                                  *
********************************************************/
$errMsg = "";
$bMissing = false;
$creneauSelected = array('', '', '', '', '', '', '', '', '');
$star = "<span class='missing'>*</span>";
if (isset($_POST['do'])){
  $keys = array_keys($_POST['do']);
  $do = strtolower($keys[0]);
}
$keys = array_keys($_POST);
$ppost = "";
for ($i = 0, $l = count($_POST); $i < $l; ++$i){
  $ppost = $ppost."\\n\\t".$keys[$i]." : ".$_POST[$keys[$i]];
}
if ($do != "voir" /*&& $do != "repas"*/ && !preg_match('/annuler/', $do)){
	switch($action){
		case "login":
			// validation : donnees minimales
			if ($nom == "" OR $prenom == "" OR $mail == "")
				$errMsg = "<span class='attention'>veuillez saisir nom, prénom et adresse email. </span><a href='login.php' class='action login' rel='nofollow'>Deconnexion</a>"; // rajouter bouton pour lien
		break;

		case "res":
			if($do == 'ajouter'){
				if ($creneau == 0){
					$bMissing = true;
					$missingCreneau = $star;
				}else{
					$creneauSelected[$creneau] = ' selected';
				}
				if ($idH == 0){
					$bMissing = true;
					$missingHote = $star;
				}else{
					$chantierSelected = ' selected';
				}
				if ($nb == 0){
					$bMissing = true;
					$missingNb = $star;
				}else{
					$nbValue = ' value='.$nb;
				}
			}
			break;

		case "admin":
			if ($creneau == 0){
				$bMissing = true;
				$missingCreneau = $star;
			}else{
				$creneauSelected[$creneau] = ' selected';
			}
			if ($idH == 0){
				$bMissing = true;
				$missingHote = $star;
			}else{
				$chantierSelected = ' selected';
			}
			if ($nb == 0){
				$bMissing = true;
				$missingNb = $star;
			}else{
				$nbValue = ' value='.$nb;
			}
			$nomV = $_POST["nn"];
			$prenomV = $_POST["pp"];
			$mailV = $_POST["mm"];
			$telV = $_POST["tt"];

			if ($nomV == ""){
				$bMissing = true;
				$missingNom = $star;
			}
			if ($prenomV == ""){
				$bMissing = true;
				$missingPrenom = $star;
			}
			if ($mailV == ""){
				$bMissing = true;
				$missingMail = $star;
			}
			break;

		default:
			break;
	}
	if ($bMissing){
		$errMsg = "<span class='attention'>données manquantes !</span>";
	}
}

switch($action) {
  	case "login":
		if ($nom != "" AND $prenom != ""){
			$_SESSION['nom'] = $nom;
			$_SESSION['prenom'] = $prenom;
			$_SESSION['mail'] = $mail;
			$_SESSION['tel'] = $tel;

			$sql_S = 'SELECT * FROM '.$s_tablePrefix.'eceh_visiteur WHERE UPPER(nom)="'.strtoupper($nomDB).'" AND UPPER(prenom)="'.strtoupper($prenomDB).'"';
			$query = mysql_query($sql_S) or die ("<br />erreur (5) sur : " . $sql_S);
			if ($data = mysql_fetch_array($query)){ // visiteur deja inscrit
				$idV = $data['id'];
				if($data['mail'] == "" && $mail != ""){
					$sql_U = 'UPDATE '.$s_tablePrefix.'eceh_visiteur SET mail="'.$mail.'" WHERE id='.$idV.';';
					$query_U = mysql_query($sql_U) or die ("<br />erreur UPDATE sur : " . $sql_U);
				}if($data['tel'] == "" && $tel != ""){
					$sql_U = 'UPDATE '.$s_tablePrefix.'eceh_visiteur SET tel="'.$tel.'" WHERE id='.$idV.';';
					$query_U = mysql_query($sql_U) or die ("<br />erreur UPDATE sur : " . $sql_U);
				}
			}else{ // nouveau visiteur
				$strNom = $nomDB;
				$strPrenom = $prenomDB;
				$sql_S = 'INSERT INTO '.$s_tablePrefix.'eceh_visiteur (nom, prenom, mail, tel, date) VALUES ("'.$strNom.'", "'.$strPrenom.'", "'.$mail.'", "'.$tel.'", NOW())';
				mysql_query($sql_S) or die ("<br />erreur sur : " . $sql_S);
				$idV = mysql_insert_id();
				logVisiteur($strNom, $strPrenom, $mail, $s_tablePrefix);
			}
			mysql_free_result($query);
		}
		break;

	case "res":
/* ********************************************************************************************* */
/* *** TODO : A REVOIR !                                                                    *** */
/* *** COMMENTER POUR TESTS RESERVATION HORS DATES D'OUVERTURE                             *** */

		if (time() > $iECEHDate){
			$errMsg = "<span class='attention'>Les inscriptions sont closes !</span>";
			break;
		}

/* *** FIN COMMENTER POUR TESTS RESERVATION                                                  *** */
/* ******************************************************************************************** */
		if($do == 'ajouter' AND $creneau > 0 AND $idH > 0 AND $nb > 0 AND $errMsg == ""){
			// test nb places
			$sql_S = 'SELECT id, nom, placesSamAM, placesSamPM, placesDimAM, placesDimPM, placesSam2AM, placesSam2PM, placesDim2AM, placesDim2PM FROM '.$s_tablePrefix.'eceh_hote WHERE id='.$idH;
			$query = mysql_query($sql_S) or die ("<br />erreur sur : " . $sql_S);
			if ($data = mysql_fetch_array($query)){
				$disp = $creneau == 1 ? $data['placesSamAM'] : ($creneau == 2 ? $data['placesSamPM'] : ($creneau == 3 ? $data['placesDimAM'] : ($creneau == 4 ? $data['placesDimPM'] : ($creneau == 5 ? $data['placesSam2AM'] : ($creneau == 6 ? $data['placesSam2PM'] : ($creneau == 7 ? $data['placesDim2AM'] : ($creneau == 8 ? $data['placesDim2PM'] : 0)))))));
			}else{
				$disp = -1;
			}
			$sql_S = 'SELECT sum(nb_pers) as nb FROM '.$s_tablePrefix.'eceh_inscription WHERE id_h='.$idH.' AND creneau='.$creneau.' AND id_v!='.$idV;
			$query = mysql_query($sql_S) or     die ("<br />erreur sur : " . $sql_S);
			if ($data = mysql_fetch_array($query)){
				$res = $data['nb'];
			}else{
				$res = 0;
			}
			// fin test nb places
			if ($disp == -1 OR ($disp - $res) >= $nb){  // disp = 0 => pas ouvert // disp = -1 => visite libre
				//$strDebug = "ajout";
				$sql_S = 'DELETE FROM '.$s_tablePrefix.'eceh_inscription WHERE id_v='.$idV.' AND creneau='.$creneau;
				mysql_query($sql_S) or die ("<br />erreur sur : " . $sql_S);
				$sql_S = 'INSERT INTO '.$s_tablePrefix.'eceh_inscription (id_h, id_v, nb_pers, creneau, date) VALUES ('.$idH.', '.$idV.', '.$nb.', '.$creneau.', NOW())';
				mysql_query($sql_S) or die ("<br />erreur sur : " . $sql_S);
				logInscription($idH, $idV, $creneau, $nb, $s_tablePrefix);
				$nbValue="";
				$creneauSelected[$creneau] = '';
				$chantierSelected = '';
				$confMsg = "Inscription confirmée !";
				$bConf = confirm($idV, 'ajouter', $creneau, $s_tablePrefix);
				if($bConf[0]){
					$confMsg .= "<br /><br />Mail de confirmation avec l'adresse du rendez-vous envoyé à ".$mailV;
				}else{
					$confMsg .= "<br /><br />".$bConf[1];
				}
			}elseif ($disp == 0){ // ferme ce jour
				$bMissing = true;
				$creneauSelected[$creneau] = ' selected';
				$chantierSelected = ' selected';
				$missingCreneau = $star;
				$errMsg = "<span class='attention'>Ce site n'est pas ouvert à la date choisie !</span>";
			}else{ // plus assez de places
				$bMissing = true;
				$creneauSelected[$creneau] = ' selected';
				$chantierSelected = ' selected';
				$nbValue = ' value='.($disp - $res);
				$missingNb = $star;
				$errMsg = "<span class='attention'>Il ne reste que ".($disp - $res)." places disponibles sur ce site !</span>";
			}
			mysql_free_result($query);
		}
		for ($i = 1; $i < 9; $i++){
			if($do == 'annuler'.$i){
				//$strDebug = "annule";
				logAnnulation($idV, $i, $s_tablePrefix);
				$sql_S = 'DELETE FROM '.$s_tablePrefix.'eceh_inscription WHERE id_v='.$idV.' AND creneau='.$i;
				mysql_query($sql_S) or die ("<br />erreur sur : " . $sql_S);
				$confMsg = "Annulation confirmée !";
				//confirm($idV, 'annuler', $i, $s_tablePrefix);
				$bConf = confirm($idV, 'annuler', $i, $s_tablePrefix);
				if($bConf[0]){
					$confMsg .= "<br /><br />Mail de confirmation envoyé";
				}else{
					$confMsg .= "<br /><br />".$bConf[1];
				}
			}
		}
		break;

	case "admin":
		$nomV = strtoupper($_POST["nn"]);
		$prenomV = ucwords(strtolower($_POST["pp"]));
		$mailV = strtolower($_POST["mm"]);
		$telV = $_POST["tt"];
		$sql_S = 'SELECT * FROM '.$s_tablePrefix.'eceh_visiteur WHERE UPPER(nom)="'.strtoupper($nomV).'" AND UPPER(prenom)="'.strtoupper($prenomV).'"';
		$query = mysql_query($sql_S) or die ("<br />erreur (6) sur : " . $sql_S);
		if ($data = mysql_fetch_array($query)){ // l'admin modifie un visiteur deja enregistre
			$idV = $data["id"];
			$nomV = strtoupper($data["nom"]);
			$prenomV = ucwords(strtolower($data["prenom"]));
			$mailV = strtolower($data["mail"]);
			$telV = $data["tel"];
		}elseif ($nomV != "" AND $prenomV != ""){ // l'admin cree un nouveau visiteur

			//////////////////////////////////////////////////////////////////////
			// TODO : Demander confirmation avant de créer un nouveau visiteur //
			////////////////////////////////////////////////////////////////////

			$sql_S = 'INSERT INTO '.$s_tablePrefix.'eceh_visiteur (nom, prenom, mail, tel, date) VALUES ("'.$nomV.'", "'.$prenomV.'", "'.$mailV.'", "'.$telV.'", NOW())';
			mysql_query($sql_S) or die ("<br />erreur sur : " . $sql_S);
			$idV = mysql_insert_id();
			logVisiteur($nomV, $prenomV, $mailV, $s_tablePrefix);

			////////////////////////////////////////////////////////////
		}
		mysql_free_result($query);
		// l'admin ajoute une réservation au visiteur $idV
		if($do == 'ajouter' AND $creneau > 0 AND $idH > 0 AND $nb > 0 AND $errMsg == ""){
			// test nb places
			$sql_S = 'SELECT id, nom, placesSamAM, placesSamPM, placesDimAM, placesDimPM, placesSam2AM, placesSam2PM, placesDim2AM, placesDim2PM FROM '.$s_tablePrefix.'eceh_hote WHERE id='.$idH;
			$query = mysql_query($sql_S) or die ("<br />erreur sur : " . $sql_S);
			if ($data = mysql_fetch_array($query)){
				$disp = $creneau == 1 ? $data['placesSamAM'] : ($creneau == 2 ? $data['placesSamPM'] : ($creneau == 3 ? $data['placesDimAM'] : ($creneau == 4 ? $data['placesDimPM'] : ($creneau == 5 ? $data['placesSam2AM'] : ($creneau == 6 ? $data['placesSam2PM'] : ($creneau == 7 ? $data['placesDim2AM'] : ($creneau == 8 ? $data['placesDim2PM'] : 0)))))));
			}else{
				$disp = 0;
			}
			$sql_S = 'SELECT sum(nb_pers) as nb FROM '.$s_tablePrefix.'eceh_inscription WHERE id_h='.$idH.' AND creneau='.$creneau.' AND id_v!='.$idV;
			$query = mysql_query($sql_S) or die ("<br />erreur sur : " . $sql_S);
			if ($data = mysql_fetch_array($query)){
				$res = $data['nb'];
			}else{
				$res = 0;
			}
			mysql_free_result($query);
			$r = $disp - $res;
			// fin test nb places
			if ($disp == -1 OR ($disp - $res) >= $nb){  // disp = 0 => pas ouvert // disp = -1 => visite libre
				$sql_S = 'DELETE FROM '.$s_tablePrefix.'eceh_inscription WHERE id_v='.$idV.' AND creneau='.$creneau;
				mysql_query($sql_S) or die ("<br />erreur sur : " . $sql_S);
				$sql_S = 'INSERT INTO '.$s_tablePrefix.'eceh_inscription (id_h, id_v, nb_pers, creneau, date) VALUES ('.$idH.', '.$idV.', '.$nb.', '.$creneau.', "'.date("c").'")';
				mysql_query($sql_S) or die ("<br />erreur sur : " . $sql_S);
				logInscription($idH, $idV, $creneau, $nb, $s_tablePrefix);
				//confirm($idV, 'ajouter', $creneau, $s_tablePrefix);
				$bConf = confirm($idV, 'ajouter', $creneau, $s_tablePrefix);
				if($bConf[0]){
					$confMsg .= "<br /><br />Mail de confirmation avec l'adresse du rendez-vous envoyé à ".$mailV;
				}else{
					$confMsg .= "<br /><br />".$bConf[1];
				}
				$nbValue="";
				$creneauSelected[$creneau] = '';
				$chantierSelected = '';
			}elseif ($disp == 0){ // ferme ce jour
				$bMissing = true;
				$creneauSelected[$creneau] = ' selected';
				$chantierSelected = ' selected';
				$missingCreneau = $star;
				$errMsg = "<span class='attention'>Ce site n'est pas ouvert à la date choisie !</span>";
			}else{ // plus assez de places
				$bMissing = true;
				$creneauSelected[$creneau] = ' selected';
				$chantierSelected = ' selected';
				$nbValue = ' value='.($disp - $res);
				$missingNb = $star;
				$errMsg = "<span class='attention'>Il ne reste que ".($disp - $res)." places disponibles sur ce site !</span>";
			}
		}
		for ($i = 1; $i < 9; $i++){
			if($do == 'annuler'.$i){
				logAnnulation($idV, $i, $s_tablePrefix);
				$sql_S = 'DELETE FROM '.$s_tablePrefix.'eceh_inscription WHERE id_v='.$idV.' AND creneau='.$i;
				mysql_query($sql_S) or die ("<br />erreur sur : " . $sql_S);
			}
		}
		break;

	default:
		break;
}
// AFFICHE LES RESERVATIONS EXISTANTES
$viewDimPm = "'cache'";
$viewDimAm = "'cache'";
$viewSamPm = "'cache'";
$viewSamAm = "'cache'";
$viewDim2Pm = "'cache'";
$viewDim2Am = "'cache'";
$viewSam2Pm = "'cache'";
$viewSam2Am = "'cache'";
if (!($action == "login" OR $action == "") OR !($nom == "" OR $prenom == "")){
	$sql_S = 'SELECT '.$s_tablePrefix.'eceh_hote.nom as n,'.$s_tablePrefix.'eceh_hote.adresse as ad, nb_pers FROM '.$s_tablePrefix.'eceh_inscription, '.$s_tablePrefix.'eceh_hote WHERE '.$s_tablePrefix.'eceh_inscription.id_h = '.$s_tablePrefix.'eceh_hote.id AND '.$s_tablePrefix.'eceh_inscription.id_v='.$idV.' AND creneau=1';
	$query = mysql_query($sql_S) or die ("<br />erreur sur : " . $sql_S);
	if ($data = mysql_fetch_array($query)){ // visiteur deja inscrit
		$libSamAm = html_entity_decode(htmlentities($data['n']));
		$titSamAm =  html_entity_decode(htmlentities($data['ad']));
		$viewSamAm = "visible";
		$nbSamAm = $data['nb_pers'];
	}
	$sql_S = 'SELECT '.$s_tablePrefix.'eceh_hote.nom as n,'.$s_tablePrefix.'eceh_hote.adresse as ad, nb_pers FROM '.$s_tablePrefix.'eceh_inscription, '.$s_tablePrefix.'eceh_hote WHERE '.$s_tablePrefix.'eceh_inscription.id_h = '.$s_tablePrefix.'eceh_hote.id AND '.$s_tablePrefix.'eceh_inscription.id_v='.$idV.' AND creneau=2';
	$query = mysql_query($sql_S) or die ("<br />erreur sur : " . $sql_S);
	if ($data = mysql_fetch_array($query)){ // visiteur deja inscrit
		$libSamPm = html_entity_decode(htmlentities($data['n']));
		$titSamPm = html_entity_decode(htmlentities($data['ad']));
		$viewSamPm = "visible";
		$nbSamPm = $data['nb_pers'];
	}
	$sql_S = 'SELECT '.$s_tablePrefix.'eceh_hote.nom as n,'.$s_tablePrefix.'eceh_hote.adresse as ad, nb_pers FROM '.$s_tablePrefix.'eceh_inscription, '.$s_tablePrefix.'eceh_hote WHERE '.$s_tablePrefix.'eceh_inscription.id_h = '.$s_tablePrefix.'eceh_hote.id AND '.$s_tablePrefix.'eceh_inscription.id_v='.$idV.' AND creneau=3';
	$query = mysql_query($sql_S) or die ("<br />erreur sur : " . $sql_S);
	if ($data = mysql_fetch_array($query)){ // visiteur deja inscrit
		$libDimAm = html_entity_decode(htmlentities($data['n']));
		$titDimAm = html_entity_decode(htmlentities($data['ad']));
		$viewDimAm = "visible";
		$nbDimAm = $data['nb_pers'];
	}
  	$sql_S = 'SELECT '.$s_tablePrefix.'eceh_hote.nom as n,'.$s_tablePrefix.'eceh_hote.adresse as ad, nb_pers FROM '.$s_tablePrefix.'eceh_inscription, '.$s_tablePrefix.'eceh_hote WHERE '.$s_tablePrefix.'eceh_inscription.id_h = '.$s_tablePrefix.'eceh_hote.id AND '.$s_tablePrefix.'eceh_inscription.id_v='.$idV.' AND creneau=4';
	$query = mysql_query($sql_S) or die ("<br />erreur sur : " . $sql_S);
	if ($data = mysql_fetch_array($query)){ // visiteur deja inscrit
		$libDimPm = html_entity_decode(htmlentities($data['n']));
		$titDimPm = html_entity_decode(htmlentities($data['ad']));
		$viewDimPm = "visible";
		$nbDimPm = $data['nb_pers'];
	}
	$sql_S = 'SELECT '.$s_tablePrefix.'eceh_hote.nom as n,'.$s_tablePrefix.'eceh_hote.adresse as ad, nb_pers FROM '.$s_tablePrefix.'eceh_inscription, '.$s_tablePrefix.'eceh_hote WHERE '.$s_tablePrefix.'eceh_inscription.id_h = '.$s_tablePrefix.'eceh_hote.id AND '.$s_tablePrefix.'eceh_inscription.id_v='.$idV.' AND creneau=5';
	$query = mysql_query($sql_S) or die ("<br />erreur sur : " . $sql_S);
	if ($data = mysql_fetch_array($query)){ // visiteur deja inscrit
		$libSam2Am = html_entity_decode(htmlentities($data['n']));
		$titSam2Am = html_entity_decode(htmlentities($data['ad']));
		$viewSam2Am = "visible";
		$nbSam2Am = $data['nb_pers'];
	}
	$sql_S = 'SELECT '.$s_tablePrefix.'eceh_hote.nom as n,'.$s_tablePrefix.'eceh_hote.adresse as ad, nb_pers FROM '.$s_tablePrefix.'eceh_inscription, '.$s_tablePrefix.'eceh_hote WHERE '.$s_tablePrefix.'eceh_inscription.id_h = '.$s_tablePrefix.'eceh_hote.id AND '.$s_tablePrefix.'eceh_inscription.id_v='.$idV.' AND creneau=6';
	$query = mysql_query($sql_S) or die ("<br />erreur sur : " . $sql_S);
	if ($data = mysql_fetch_array($query)){ // visiteur deja inscrit
		$libSam2Pm = html_entity_decode(htmlentities($data['n']));
		$titSam2Pm = html_entity_decode(htmlentities($data['ad']));
		$viewSam2Pm = "visible";
		$nbSam2Pm = $data['nb_pers'];
	}
	$sql_S = 'SELECT '.$s_tablePrefix.'eceh_hote.nom as n,'.$s_tablePrefix.'eceh_hote.adresse as ad, nb_pers FROM '.$s_tablePrefix.'eceh_inscription, '.$s_tablePrefix.'eceh_hote WHERE '.$s_tablePrefix.'eceh_inscription.id_h = '.$s_tablePrefix.'eceh_hote.id AND '.$s_tablePrefix.'eceh_inscription.id_v='.$idV.' AND creneau=7';
	$query = mysql_query($sql_S) or die ("<br />erreur sur : " . $sql_S);
	if ($data = mysql_fetch_array($query)){ // visiteur deja inscrit
		$libDim2Am = html_entity_decode(htmlentities($data['n']));
		$titDim2Am = html_entity_decode(htmlentities($data['ad']));
		$viewDim2Am = "visible";
		$nbDim2Am = $data['nb_pers'];
	}
  	$sql_S = 'SELECT '.$s_tablePrefix.'eceh_hote.nom as n,'.$s_tablePrefix.'eceh_hote.adresse as ad, nb_pers FROM '.$s_tablePrefix.'eceh_inscription, '.$s_tablePrefix.'eceh_hote WHERE '.$s_tablePrefix.'eceh_inscription.id_h = '.$s_tablePrefix.'eceh_hote.id AND '.$s_tablePrefix.'eceh_inscription.id_v='.$idV.' AND creneau=8';
	$query = mysql_query($sql_S) or die ("<br />erreur sur : " . $sql_S);
	if ($data = mysql_fetch_array($query)){ // visiteur deja inscrit
		$libDim2Pm = html_entity_decode(htmlentities($data['n']));
		$titDim2Pm = html_entity_decode(htmlentities($data['ad']));
		$viewDim2Pm = "visible";
		$nbDim2Pm = $data['nb_pers'];
	}
	mysql_free_result($query);
}
// cas d'administration
$tr="";
if ((strtoupper($nom) == "ALTERENERGIES") AND strtoupper($prenom) == "ADMIN"){
	$bAdmin = true;
	$tr = "<thead><tr><th class='col1'>Récap. par hotes</th><th class='col2'>sam.".$DEF_SAM1." ".$DEF_AM."h</th><th class='col2'>sam.".$DEF_SAM1." ".$DEF_PM."h</th><th class='col2'>dim.".$DEF_DIM1." ".$DEF_AM."h</th><th class='col2'>dim.".$DEF_DIM1." ".$DEF_PM."h</th><th class='col2'>sam.".$DEF_SAM2." ".$DEF_AM."h</th><th class='col2'>sam.".$DEF_SAM2." ".$DEF_PM."h</th><th class='col2'>dim.".$DEF_DIM2." ".$DEF_AM."h</th><th class='col2'>dim.".$DEF_DIM2." ".$DEF_PM."h</th></tr></thead>\n";

	$sql_S = 'SELECT id, ordre_aff, nom, placesSamAM, placesSamPM, placesDimAM, placesDimPM, placesSam2AM, placesSam2PM, placesDim2AM, placesDim2PM FROM '.$s_tablePrefix.'eceh_hote WHERE ordre_aff>0 ORDER BY ordre_aff';
	$query = mysql_query($sql_S) or die ("<br />erreur sur : " . $sql_S);
	while ($data = mysql_fetch_array($query)){
		if ($data['placesSamPM'] != -1){
			if ($data['placesSamPM'] != 0){
				$places = $data['placesSamPM']." places";
			}elseif ($data['placesDimPM'] != 0){
				$places = $data['placesDimPM']." places";
			}elseif ($data['placesDimAM'] != 0){
				$places = $data['placesDimAM']." places";
			}elseif ($data['placesSam2AM'] != 0){
				$places = $data['placesSam2AM']." places";
			}elseif ($data['placesSam2PM'] != 0){
				$places = $data['placesSam2PM']." places";
			}elseif ($data['placesDim2PM'] != 0){
				$places = $data['placesDim2PM']." places";
			}elseif ($data['placesDim2AM'] != 0){
				$places = $data['placesDim2AM']." places";
			}else{
				$places = $data['placesSamAM']." places";
			}
		}else{
			$places = "Visites libres";
		}
    	$tr .= "<tbody><tr><td>[".$data['ordre_aff']."] ".reduit_texte($data['nom'], 20, 20, ' ', '...')."<br/>".$places;
    	for ($i = 1; $i < 9; ++$i){
      		$class = (!$data['placesDim2PM'] && $i == 8) || (!$data['placesDim2AM'] && $i == 7) || (!$data['placesSam2PM'] && $i ==6) || (!$data['placesSam2AM'] && $i ==5) || (!$data['placesDimPM'] && $i == 4) || (!$data['placesDimAM'] && $i == 3) || (!$data['placesSamPM'] && $i ==2) || (!$data['placesSamAM'] && $i ==1) ? " class='grey'" : " class=\"col2\"";

      		$sql2_S = 'SELECT sum(nb_pers) as nb FROM '.$s_tablePrefix.'eceh_inscription WHERE id_h='.$data['id'].' AND creneau='.$i;
      		$query2 = mysql_query($sql2_S) or die ("<br />erreur sur : " . $sql2_S);
      		if ($data2 = mysql_fetch_array($query2)){
        		$tr .= "<td".$class.">".$data2['nb']."</td> ";
      		}
			mysql_free_result($query2);
		}
		$tr .= "</tr>\n";
	}
	mysql_free_result($query);
	$tr .= "<tr><td class=\"ligneSep\" colspan=9></td></tr>\n";
	$tr .= "<tr><td colspan=9></td></tr>\n";
	$tr .= "<tr><td class=\"ligneSepF\" colspan=9></td></tr>\n";
	$tr .= "<tr><th>Total par créneaux</th>";
	for ($i = 1; $i < 9; $i++){
		$sql_S = 'SELECT SUM(nb_pers) FROM '.$s_tablePrefix.'eceh_inscription WHERE creneau='.$i;
		$query = mysql_query($sql_S) or die ("<br />erreur sur : " . $sql_S);
		$tr .= "<th>";
		if ($data = mysql_fetch_row($query)){
		  $tr .= $data[0] != "" ? $data[0]." p." : "";
		}
		$tr .= "</th>";
		mysql_free_result($query);
	}
	$tr .= "</tr>\n";
	$tr .= "<tr><td class=\"ligneSepF\" colspan=9></td></tr>\n";
	$tr .= "<tr><td colspan=9></td></tr>\n";
	$tr .= "<tr><td class=\"ligneSep\" colspan=9></td></tr>\n";
	$tr .= "<tr><th>Récap. par visiteurs</th><th>sam.".$DEF_SAM1." ".$DEF_AM."h</th><th>sam.".$DEF_SAM1." ".$DEF_PM."h</th><th>dim.".$DEF_DIM1." ".$DEF_AM."h</th><th>dim.".$DEF_DIM1." ".$DEF_PM."h</th><th>sam.".$DEF_SAM2." ".$DEF_AM."h</th><th>sam.".$DEF_SAM2." ".$DEF_PM."h</th><th>dim.".$DEF_DIM2." ".$DEF_AM."h</th><th>dim.".$DEF_DIM2." ".$DEF_PM."h</th></tr>\n";
	$sql_S = 'SELECT * FROM '.$s_tablePrefix.'eceh_visiteur ORDER BY nom';
	$query = mysql_query($sql_S) or die ("<br />erreur (7) sur : " . $sql_S);
	$data = mysql_fetch_array($query);
	$idx = 0;
	while ($data = mysql_fetch_array($query)){
		if (strtoupper($data['nom']) != "ALTERENERGIES"){
			$sql2_S = 'SELECT count(*) as nb FROM '.$s_tablePrefix.'eceh_inscription WHERE id_v='.$data['id'];
			$query2 = mysql_query($sql2_S) or die ("<br />erreur sur (8): " . $sql2_S);
			if ($data2 = mysql_fetch_array($query2) AND $data2['nb']){
				$idx++;
			}
		}
		$flag = 0;
		$tr_v = "<tr><td>".$idx." - ".ucwords(strtolower($data['prenom']))." - ".strtoupper ($data['nom'])."<br/><span class='it'>".$data['mail']."</span></td>";
		for ($i = 1; $i < 9; $i++){
			$sql2_S = 'SELECT nb_pers as nb, nom FROM '.$s_tablePrefix.'eceh_inscription, '.$s_tablePrefix.'eceh_hote WHERE id_h='.$s_tablePrefix.'eceh_hote.id AND id_v='.$data['id'].' AND creneau='.$i;
			$query2 = mysql_query($sql2_S) or die ("<br />erreur sur (9): " . $sql2_S);
			$tr_v .= "<td class=\"col2\">";
			if ($data2 = mysql_fetch_array($query2)){
				$tr_v .= reduit_texte($data2['nom'], 35, 45, ' ', '...')." [".$data2['nb']."p.]";
				$flag++;
			}
			$tr_v .= "</td> ";
		}
		mysql_free_result($query2);
		if ($flag){
			$tr .= $tr_v ."</tr>\n";
		}
	}
	mysql_free_result($query);
}else{
	$bAdmin = false;
}
$tr .= "</tbody>";
// FONCTIONS ///////////////////////////////////////////////////////////////
function logVisiteur($nom, $prenom, $mail, $s_tablePrefix){
	$log_F = fopen('log.txt', 'a');

	$sql_S = 'SELECT * FROM '.$s_tablePrefix.'eceh_visiteur';
	$query = mysql_query($sql_S) or die ("<br />erreur (1) sur : " . $sql_S);
	if ($data = mysql_fetch_array($query)){
		$idV = $data['id'];
	}
	mysql_free_result($query);
	$sql_S = 'INSERT INTO '.$s_tablePrefix.'eceh_log (date, op, id_h, creneau) VALUES (NOW(), "visiteur", '.$idV.', 0)';
	mysql_query($sql_S) or die ("<br />erreur sur : " . $sql_S);

	fputs($log_F, date("j M Y")." - ".$prenom." ".$nom." (".$mail.")\n");

	fclose($log_F);
}

function logInscription($idH, $idV, $creneau, $nb, $s_tablePrefix){
	$log_F = fopen('log.txt', 'a');
	$sql_S = 'SELECT * FROM '.$s_tablePrefix.'eceh_visiteur WHERE id='.$idV;
	$query = mysql_query($sql_S) or die ("<br />erreur (2) sur : " . $sql_S);
	if ($data = mysql_fetch_array($query))
		$visiteur = $data['prenom']." ".$data['nom'];
	$sql_S = 'SELECT * FROM '.$s_tablePrefix.'eceh_hote WHERE id='.$idH;
	$query = mysql_query($sql_S) or die ("<br />erreur sur (3) : " . $sql_S);
	if ($data = mysql_fetch_array($query))
		$hote = $data['nom'];
	mysql_free_result($query);

	$sql_S = 'INSERT INTO '.$s_tablePrefix.'eceh_log (date, op, id_h, creneau) VALUES (NOW(), "ajoute", '.$idV.', '.$creneau.')';
	mysql_query($sql_S) or die ("<br />erreur sur : " . $sql_S);

	//  debuf
	//$quand = $creneau == 1 ? $DEF_SAMAM : ($creneau == 2 ? $DEF_SAMPM : ($creneau == 3 ? $DEF_DIMAM :($creneau == 4 ? $DEF_DIMPM : "")));
	switch($creneau){
		case 1:
			$quand = $DEF_SAMAM;
			break;
		case 2:
			$quand = $DEF_SAMPM;
			break;
		case 3:
			$quand = $DEF_DIMAM;
			break;
		case 4:
			$quand = $DEF_DIMPM;
			break;
		case 5:
			$quand = $DEF_SAM2AM;
			break;
		case 6:
			$quand = $DEF_SAM2PM;
			break;
		case 7:
			$quand = $DEF_DIM2AM;
			break;
		case 8:
			$quand = $DEF_DIM2PM;
			break;
	}

	fputs($log_F, date("j M Y")." - ajoute -  (".$nb."p. ; " . $quand . ") ".$visiteur." -> ".$hote."\n");

	fclose($log_F);
}

function logAnnulation($idV, $creneau, $s_tablePrefix){
	if(!$idH) return;

	global $DEF_SAMAM;
	global $DEF_SAMPM;
	global $DEF_DIMAM;
	global $DEF_DIMPM;
	global $DEF_SAM2AM;
	global $DEF_SAM2PM;
	global $DEF_DIM2AM;
	global $DEF_DIM2PM;

	$creneau_A[1] = $DEF_SAMAM;
	$creneau_A[2] = $DEF_SAMPM;
	$creneau_A[3] = $DEF_DIMAM;
	$creneau_A[4] = $DEF_DIMPM;
	$creneau_A[5] = $DEF_SAM2AM;
	$creneau_A[6] = $DEF_SAM2PM;
	$creneau_A[7] = $DEF_DIM2AM;
	$creneau_A[8] = $DEF_DIM2PM;

	$log_F = fopen('log.txt', 'a');
	$sql_S = 'SELECT * FROM '.$s_tablePrefix.'eceh_visiteur WHERE id='.$idV;
	$query = mysql_query($sql_S) or die ("<br />erreur (3) sur : " . $sql_S);
	if ($data = mysql_fetch_array($query))
		$visiteur = $data['prenom']." ".$data['nom'];
	$sql_S = 'SELECT * FROM '.$s_tablePrefix.'eceh_inscription WHERE id_V='.$idV.' AND creneau='.$creneau;
	$query = mysql_query($sql_S) or die ("<br />erreur sur : " . $sql_S);
	if ($data = mysql_fetch_array($query))
		$idH = $data['id_h'];
	//debug ("idH ".$idH);
	$sql_S = 'SELECT * FROM '.$s_tablePrefix.'eceh_hote WHERE id='.$idH;
	$query = mysql_query($sql_S) or die ("<br />erreur sur (5) : " . $sql_S);
	if ($data = mysql_fetch_array($query))
		$hote = $data['nom'];
	mysql_free_result($query);
	$quand = $creneau_A[$creneau];

	$sql_I = 'INSERT INTO '.$s_tablePrefix.'eceh_log (date, op, id_h, creneau) VALUES (NOW(), "annule", '.$idV.', '.$creneau.')';
	mysql_query($sql_I) or die ("<br />erreur sur : " . $sql_I);

	fputs($log_F, date("j M Y")." - annule - (" . $quand . ") ".$visiteur." -> ".$hote."\n");

	fclose($log_F);
}

function confirm($id, $what, $cr, $s_tablePrefix){
// Envoie un mail de confirmation
	global $DEF_SAMAM;
	global $DEF_SAMPM;
	global $DEF_DIMAM;
	global $DEF_DIMPM;
	global $DEF_SAM2AM;
	global $DEF_SAM2PM;
	global $DEF_DIM2AM;
	global $DEF_DIM2PM;

	$creneau[1] = strtolower(str_replace(" - ", " à ", $DEF_SAMAM));
	$creneau[2] = strtolower(str_replace(" - ", " à ", $DEF_SAMPM));
	$creneau[3] = strtolower(str_replace(" - ", " à ", $DEF_DIMAM));
	$creneau[4] = strtolower(str_replace(" - ", " à ", $DEF_DIMPM));
	$creneau[5] = strtolower(str_replace(" - ", " à ", $DEF_SAM2AM));
	$creneau[6] = strtolower(str_replace(" - ", " à ", $DEF_SAM2PM));
	$creneau[7] = strtolower(str_replace(" - ", " à ", $DEF_DIM2AM));
	$creneau[8] = strtolower(str_replace(" - ", " à ", $DEF_DIM2PM));

	$mailenvoye[0] = false;
	//$strDebug = "confirm";

	$sql_S = 'SELECT * FROM '.$s_tablePrefix.'eceh_visiteur WHERE id='.$id;
	$query = mysql_query($sql_S) or die ("<br />erreur (4) sur : " . $sql_S);
	if ($data = mysql_fetch_array($query)){
		$n = $data['nom'];
		$p = $data['prenom'];
		$m = $data['mail'];
		$t = $data['tel'];
		//$strDebug = "data";
		if ($m != ""){
			$msg = "";
			//$strDebug = "m=".$m;
			switch ($what){
				case "ajouter":
					$msg .= "Bonjour,<br /><br />\r\n\r\nNous avons bien enregistré votre inscription pour le ".$creneau[$cr]."<br />\r\n-<br />\r\n";
					$sql_S = 'SELECT nb_pers, nom, adresse, ville, cp FROM '.$s_tablePrefix.'eceh_hote, '.$s_tablePrefix.'eceh_inscription WHERE id_v='.$id.' AND id_h=id AND creneau='.$cr ;
					$query = mysql_query($sql_S) or die ("<br />erreur sur : " . $sql_S);
					if ($data = mysql_fetch_array($query)){
						//$msg .= "\t".$creneau[$cr]." : ".$data['nom']." - ".$data['nb_pers']."p.<br />\r\n";
      					$plr = $data['nb_pers'] > 1 ? "s" : "";
						$msg .= "Pour ".$data['nb_pers']." personne".$plr."<br />\r\n<br />\r\n";
						$msg .= "<span class='adresservs'>Veuillez noter soigneusement l'adresse du rendez-vous</span> :<br />\r\n<span class='adresserv'>".$data["nom"]." - ".$data['adresse']."</span><br />\r\n";
						$insc = "d'inscription";
					}
					break;

				case "annuler":
					$msg .= "Bonjour,<br />\r\n<br />\r\nNous avons bien enregistré l'annulation de votre inscription pour le ".$creneau[$cr]."<br />\r\n";
					$insc = "d'annulation";
					break;

				default:
					break;
			}
			$msg .= "<br />\r\nRésumé de vos réservations :<br />\r\n";
			$resa = "";
			for ($i = 1; $i < 9; $i++){
				$sql_S = 'SELECT nb_pers, nom, adresse FROM '.$s_tablePrefix.'eceh_hote, '.$s_tablePrefix.'eceh_inscription WHERE id_v='.$id.' AND id_h=id AND creneau='.$i;
				$query = mysql_query($sql_S) or die ("<br />erreur sur : " . $sql_S);
				if ($data = mysql_fetch_array($query)){
      				$plr = $data['nb_pers'] > 1 ? "s" : "";
					$resa .= "* ".$creneau[$i]." : ".$data['nom']." - ".$data['nb_pers']." personne".$plr."<br />\r\n\t&nbsp;&nbsp;&nbsp;&nbsp;->&nbsp;".$data['adresse']."<br />\r\n";
				}
			}
			if($resa != ""){
				$msg .= $resa;
			}else{
				$msg .= "Vous n'avez plus aucune réservation.<br />\r\n";
			}
			$msg .= "<br />\r\n";
			$msg .= "Vous pouvez à tout moment modifier vos réservations en vous reconnectant sur le site <a href='http://ecochantiersenecohabitats.org/login.php'>http://ecochantiersenecohabitats.org/login.php</a> avec les identifiants suivants :<br />\r\n";
			$msg .= "Nom : ".$n."<br />\r\n";
			$msg .= "Prénom : ".$p."<br /><br />\r\n\r\nL'équipe d'organisation.";
			//ini_set  ("SMTP", "smtp.orange.fr");
			ini_set  ("SMTP", "smtp.ouvaton.coop");
			//      mail($m, "confirmation inscription", removeAccent($msg), "from: infos@alterenergies.org; charset=iso-8859-1");
			//     $headers  = 'MIME-Version: 1.0' . "\r\n";
     $headers  = 'MIME-Version: 1.0' . "\r\n";
     $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	//		$headers .= 'Content-type: text/html; charset=utf-8;' . "\r\n";
			// En-têtes additionnels
			$headers .= 'from: infos@alterenergies.org' . "\r\n";
			//die ($m."<br />".$headers);
			//$strDebug = "<br />".$msg;
			//$msg = wordwrap($msg, 60, "<br />\r\n");
			$mailenvoye[0] = mail($m, "ECOCHANTIER EN ECOHABITAT : Confirmation ".$insc, $msg, $headers);
			$mailenvoye[1] = $msg;
		}
	}
	mysql_free_result($query);
	return $mailenvoye;
}

function reduit_texte($texte, $minlen, $maxlen, $separateur = ' ', $suffix = '') {
    $resultat = $texte;
    if (strlen($resultat) > $maxlen) {
        if (($pos = strrpos(substr($resultat, 0, $maxlen + strlen( $separateur )), $separateur)) !== false) {
            if ($pos < $minlen) {
                $resultat = substr($resultat, 0, $maxlen) . $suffix;
            } else {
                $resultat = substr($resultat, 0, $pos) . $suffix;
            }
        } else {
            $resultat = substr($resultat, 0, $maxlen) . $suffix;
        }
    }
    return $resultat;
}
// construit le tableau dynamique JS
include ('writeTabInc.php');
/*
TODO
- XX ecrire le tableau js ds un fichier .js separe pour le calcul des places
- XX liste des noms avec animation carte
- XX gestion des erreurs de reservation (msg erreur) ( fonction valider, gerer le dimanche pour place restantes, gerer les cas 'no limit',  inactiver la zone de texte si plus de place )
- XX controle PhP - surreservation
- reservation repas ??? pour admin
- XX css pour version imprimable
- XX log des inscriptions
- liste par participant
- XX pb si reinscription sur le meme chantier si deja juste en place
- XX envoyer un mail de confirmation
- css pour impression
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
*/
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="ltr" xml:lang="fr" xmlns="http://www.w3.org/1999/xhtml" lang="fr">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<title>EcoChantiers en EcoHabitats - Inscriptions</title>
<meta name="description" content="Deux week-ends pour découvrir 25 exemples d'éco-construction, en Indre-et-Loire, mais aussi dans le Maine-et-Loire, dans la Sarthe, dans le Loir-et-Cher, dans l'Indre et dans la Vienne. Page des réservations." />
<?php
	if (($action == "login" OR $action == "") AND ($nom == "" OR $prenom == "")){
	  echo '<meta http-equiv="refresh" content="0;url=login.php" />';
	}
?>
<meta name="generator" content="DokuWiki Release 2009-12-25c &quot;Lemming&quot;"/>
<meta name="robots" content="index,follow"/>
<meta name="date" content="2014-09-21T13:00:00+0000" />
<meta name="keywords" content="alterenergies,ecochantier,ecohabitat,eco,chantier,habitat,ecoconstruction,ecomateriaux" />
<link rel="search" type="application/opensearchdescription+xml" href="http://www.alterenergies.org/lib/exe/opensearch.php" title="Alter'énergies"/>
<link rel="start" href="http://www.alterenergies.org/"/>
<link rel="contents" href="http://www.alterenergies.org/doku.php?id=alterenergies:accueil&amp;do=index" title="Index"/>
<link rel="canonical" href="http://www.alterenergies.org/doku.php?id=alterenergies:accueil"/>
<link rel="stylesheet" media="screen" type="text/css" href="css/css.css?v=<?php echo filemtime('css/css.css');?>"/>
<link rel="stylesheet" media="print" type="text/css" href="css/print.css?v=<?php echo filemtime('css/print.css');?>">
<link rel="stylesheet" type="text/css" href="css/font.css" />
<script type="text/javascript" src="lib/prototype.js"></script>
<script type="text/javascript" src="lib/scriptaculous.js?load=effects"></script>
<script type="text/javascript" charset="utf-8" src="js/core.js"></script>
<script type="text/javascript" charset="utf-8" src="js/class.js"></script>
<script type="text/javascript" charset="utf-8" src="js/tab.js?v=<?php echo filemtime('js/tab.js');?>"></script>
<script type="text/javascript" charset="utf-8" src="js/script.js"></script>
<script type="text/javascript" charset="utf-8" src="js/map.js"></script>
<script type="text/javascript" charset="utf-8" src="js/resa.js"></script>
<link rel="icon" type="image/png" href="gfx/favicon.png"/>

<!--	Correctif pour l'affichage de #contenu-page dans IE6 qui ne connait pas les contextes de formatage :	http://css.alsacreations.com/Faire-une-mise-en-page-sans-tableaux/design-trois-colonnes-positionnement-flottant
		Et autres...
	-->
<!--[if lte IE 6]>
	<style type="text/css">
	#page-contenu {
		overflow: visible;
		height:1px;
	}
	#sommaire-gauche {
		margin-left:4px;
	}
	#bandeau {
		overflow: visible;
		border-bottom:0;
	}
	#titre-alterenergies {
		border-bottom:1px solid #036bc2;
	}
	#page-edition-arriere-plan{
		//overflow:visible;
	}
	#page-edition{width:100%;}
	.footerinc{overflow:visible;}
	div.dokuwiki{overflow:hidden;}
</style><![endif]-->
</head>
<body>
<div class="eceh">
	<div id="bandeau">
		<?php include ('headerInc.php'); ?>
	</div>
<?php echo $DEF_DECONNEXION; // bouton deconnexion haut et bas ?>
	<div id="conteneur-degrade"><!-- DIV utilisé pour faire le dégradé derrière #nos-services, #page-content, #page-edition  -->
		<div id="trois-colonnes">
			<div id="participants">
				<?php include ('writeHoteInc.php'); ?>
			</div><!-- Fin #colonne-participants -->
			<div id="colonne-droite">
				<?php include ('partenInc.php'); ?>
			</div><!-- Fin de #colonne-droite -->
			<div id="page-contenu"<?php $action=="admin" ? "" : " class='fix'" ?>>
				<div class="centeralign">
<?php
//          <h2>Problème d'inscription sur Internet Explorer : vous pouvez utiliser Firefox ou envoyer un mail à infos@alterenergies.org en attendant la résolution du problème !</h2>
  if ($errMsg != ""){
    $errMsg = "<div class='errmsg'>".$errMsg."</div>";
  }
  echo $errMsg;
  if ($confMsg != ""){
    $confMsg = "<div class='errmsg'>".$confMsg."</div>";
  }
  echo $confMsg;
?>
					<form id="finscription" method="post" action="resa.php" onsubmit="return valider(this)" accept-charset="utf-8">
						<div class="no">
							<fieldset id="fsinscription">
								<legend>Inscription</legend>
								<h1><?php echo ucwords($prenom)." ".strtoupper($nom);?></h1>
								<input name="id" id="id" value="<?php echo $idV; ?>" type="hidden">
								<input name="n" id="n" value="<?php echo $nom; ?>" type="hidden">
								<input name="p" id="p" value="<?php echo $prenom; ?>" type="hidden">
								<input name="m" id="m" value="<?php echo $mail; ?>" type="hidden">
								<input name="t" id="t" value="<?php echo $tel; ?>" type="hidden">
								<input name="bouton" id="bouton" value="" type="hidden">
<?php
  if ($bAdmin){
    echo '              <p><label class="block" for="nn">'.$missingNom.'<span>NOM</span></label> <input id="nn" name="nn" class="edit" type="text" value="'.$nomV.'"></p>';
    echo '              <p><label class="block" for="pp">'.$missingPrenom.'<span>Prénom</span></label> <input id="pp" name="pp" class="edit" type="text" value="'.$prenomV.'">';
    echo '              <p><label class="block" for="mm">'.$missingMail.'<span>Mail</span></label> <input id="mm" name="mm" class="edit" type="text" value="'.$mailV.'"></p>';
    echo '              <p><label class="block" for="tt"><span>Tel</span></label> <input id="tt" name="tt" class="edit" type="text" value="'.$telV.'"></p>';
    echo '              <p><input name="do[Voir]" id="do[Voir]" value="voir" class="button img voir" type="image" src="gfx/boutons-voir.gif"><img alt="info Admin" src="gfx/info.png" title="Admin : Entrez le nom et le prénom du visiteur à modifier OU entrez les infos du visiteur à créer PUIS cliquez sur le bouton [Voir]" class="info" /></p><br />';
    echo '              <div style="clear: both;"></div>';
	echo '				<div class="hote-sep">&nbsp;</div>';
// utilisation de do[voir] pour ie
    echo '              <input name="action" id="action" value="admin" type="hidden">';
  }else{
    echo '              <input name="action" id="action" value="res" type="hidden">';
  }
?>
								<p>
									<label for="creneau"><?php echo @$missingCreneau; ?><span>Quand ?</span></label>
									<select class="edit" id="creneau" name="creneau">
										<option value='0'>Sélectionnez une date</option>
										<option value='1'<?php echo $creneauSelected[1].">".$DEF_SAMAM;  ?></option>
										<option value='2'<?php echo $creneauSelected[2].">".$DEF_SAMPM;  ?></option>
										<option value='3'<?php echo $creneauSelected[3].">".$DEF_DIMAM;  ?></option>
										<option value='4'<?php echo $creneauSelected[4].">".$DEF_DIMPM;  ?></option>
										<option value='5'<?php echo $creneauSelected[5].">".$DEF_SAM2AM;  ?></option>
										<option value='6'<?php echo $creneauSelected[6].">".$DEF_SAM2PM;  ?></option>
										<option value='7'<?php echo $creneauSelected[7].">".$DEF_DIM2AM;  ?></option>
										<option value='8'<?php echo $creneauSelected[8].">".$DEF_DIM2PM;  ?></option>
									</select>
								</p>
								<p>
									<label class="block" for="chantier"><?php echo @$missingHote; ?><span>Où ?</span></label>
									<select class="edit" id="chantier" name="chantier">
										<option value='0'>Sélectionnez un lieu</option>
										<?php
  $sql_S = 'SELECT id, ordre_aff, nom, ville, placesSamPM nb FROM '.$s_tablePrefix.'eceh_hote WHERE ordre_aff!=0 ORDER BY ordre_aff';
  $query = mysql_query($sql_S) or die ("<br />erreur sur : " . $sql_S);
  while($data = mysql_fetch_array($query)){
    $num = $data["ordre_aff"];
    $selected = $data['id'] == $idH ? $chantierSelected : '';
    echo '            <option value="'.$data["id"].'"'.$selected.'>'.$num.'. '.$data["nom"].'</option>';
  }
?>
									</select>
								</p>
								<div id="nb_restant">Sélectionnez une date ou un lieu</div>
								<div id="places">
									<label class="block" for="nb"><?php echo @$missingNb; ?><span>Nombre de personnes :</span></label>
									<input id="nb" name="nb" class="edit" type="text"<?php echo @$nbValue; ?>>
								<input name="do[ajouter]" value="ajouter" id="do[ajouter]" class="button buttonL img" type="image" src="gfx/boutons-ajouter.gif">
								</div>
								<div class="hote-sep">&nbsp;</div>
								<p>Récapitulatif de vos inscriptions :</p>
								<div id="samAM" class=<?php echo $viewSamAm; ?> title="<?php echo $titSamAm; ?>"><?php echo "Sam.".$DEF_SAM1." ".$DEF_AM."h : "; ?><span id="libSamAm"><?php echo $libSamAm." - ".$nbSamAm." personne".($nbSamAm>1?"s":""); ?></span>
									<input name="do[annuler1]" id="do[annuler1]" value="annuler1" class="button img annule" type="image" src="gfx/boutons-annuler.gif">
								</div>
								<div id="samPM" class=<?php echo $viewSamPm; ?> title="<?php echo $titSamPm; ?>"><?php echo "Sam.".$DEF_SAM1." ".$DEF_PM."h : "; ?><span id="libSamPm"><?php echo $libSamPm." - ".$nbSamPm." personne".($nbSamPm>1?"s":""); ?></span>
									<input name="do[annuler2]" id="do[annuler2]" value="annuler2" class="button img annule" type="image" src="gfx/boutons-annuler.gif">
								</div>
								<div id="dimAM" class=<?php echo $viewDimAm; ?> title="<?php echo $titDimAm; ?>"><?php echo "Dim.".$DEF_DIM1." ".$DEF_AM."h : "; ?><span id="libDimAm"><?php echo $libDimAm." - ".$nbDimAm." personne".($nbDimAm>1?"s":""); ?></span>
									<input name="do[annuler3]" id="do[annuler3]" value="annuler3" class="button img annule" type="image" src="gfx/boutons-annuler.gif">
								</div>
								<div id="dimPM" class=<?php echo $viewDimPm; ?> title="<?php echo $titDimPm; ?>"><?php echo "Dim.".$DEF_DIM1." ".$DEF_PM."h : "; ?><span id="libDimPm"><?php echo $libDimPm." - ".$nbDimPm." personne".($nbDimPm>1?"s":""); ?></span>
									<input name="do[annuler4]" id="do[annuler4]" value="annuler4" class="button img annule" type="image" src="gfx/boutons-annuler.gif">
								</div>
								<div id="sam2AM" class=<?php echo $viewSam2Am; ?> title="<?php echo $titSam2Am; ?>"><?php echo "Sam.".$DEF_SAM2." ".$DEF_AM."h : "; ?><span id="libSam2Am"><?php echo $libSam2Am." - ".$nbSam2Am." personne".($nbSam2Am>1?"s":""); ?></span>
									<input name="do[annuler5]" id="do[annuler5]" value="annuler5" class="button img annule" type="image" src="gfx/boutons-annuler.gif">
								</div>
								<div id="sam2PM" class=<?php echo $viewSam2Pm; ?> title="<?php echo $titSam2Pm; ?>"><?php echo "Sam.".$DEF_SAM2." ".$DEF_PM."h : "; ?><span id="libSam2Pm"><?php echo $libSam2Pm." - ".$nbSam2Pm." personne".($nbSam2Pm>1?"s":""); ?></span>
									<input name="do[annuler6]" id="do[annuler6]" value="annuler6" class="button img annule" type="image" src="gfx/boutons-annuler.gif">
								</div>
								<div id="dim2AM" class=<?php echo $viewDim2Am; ?> title="<?php echo $titDim2Am; ?>"><?php echo "Dim.".$DEF_DIM2." ".$DEF_AM."h : "; ?><span id="libDim2Am"><?php echo $libDim2Am." - ".$nbDim2Am." personne".($nbDim2Am>1?"s":""); ?></span>
									<input name="do[annuler7]" id="do[annuler7]" value="annuler7" class="button img annule" type="image" src="gfx/boutons-annuler.gif">
								</div>
								<div id="dim2PM" class=<?php echo $viewDim2Pm; ?> title="<?php echo $titDim2Pm; ?>"><?php echo "Dim.".$DEF_DIM2." ".$DEF_PM."h : "; ?><span id="libDim2Pm"><?php echo $libDim2Pm." - ".$nbDim2Pm." personne".($nbDim2Pm>1?"s":""); ?></span>
									<input name="do[annuler8]" id="do[annuler8]" value="annuler8" class="button img annule" type="image" src="gfx/boutons-annuler.gif">
								</div>
								<?php
								if($viewSamAm == "'cache'" AND $viewSamPm == "'cache'" AND $viewDimAm == "'cache'" AND $viewDimPm == "'cache'" AND $viewSam2Am == "'cache'" AND $viewSam2Pm == "'cache'" AND $viewDim2Am == "'cache'" AND $viewDim2Pm == "'cache'")
									echo '<div id="nores" class="visible">Vous n\'avez plus aucune inscription.</div>';
								?>
							</fieldset>
								<table id="t-inscription">
									<?php echo $tr; ?>
								</table>
						</div>
					</form>
					<div>
						<h5 class="attentionC">Merci de penser à annuler vos réservations si vous ne pouvez pas vous y rendre !</h5>
					</div>
					<div>
						<h5>Pour tout problème d'inscription : <a href="mailto:infos@alterenergies.org">infos@alterenergies.org</a></h5>
					</div>
				</div>
			</div><!-- Fin de #page-contenu -->
		</div><!-- fin DIV #deux-colonnes -->
		<div style="clear: both;"></div>
<?php echo $DEF_DECONNEXION; // bouton deconnexion haut et bas ?>
	</div><!-- fin DIV pour dégradé #conteneur-degrade -->
	<div style="clear: both;"></div>
	<?php include ('footerInc.php'); ?>
</div>
<div id="scroll-bar" class="scroll_bar" style="display:none;">
	<a  href="#" title="Haut de page"><span></span>Haut de page</a>
</div>
</body>
</html>
<?php ob_end_flush(); ?>
