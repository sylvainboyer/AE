<?php
// À extraire de la BDD
$DEF_ANNEE = "2017";
// À extraire de la BDD
$JOURS = array
	(
	array("samedi","7","10"),
	array("dimanche","8","10"),
	array("samedi","14","10"),
	array("dimanche","15","10"),
	);

// À extraire de la BDD
$CRENEAUX = array("AM"=>"10", "PM"=>"15");

$MOIS = array("1"=>"janvier", "2"=>"février", "3"=>"mars", "4"=>"avril", "5"=>"mai", "6"=>"juin", "7"=>"juillet", "8"=>"août", "9"=>"septembre", "10"=>"octobre", "11"=>"novembre", "12"=>"décembre");

$DEF_SAMAM = ucfirst($JOURS[0][0]).' '.$JOURS[0][1].'/'..$JOURS[0][2].' - '.$CRENEAUX["AM"].' h';
$DEF_SAMPM = ucfirst($JOURS[0][0]).' '.$JOURS[0][1].'/'..$JOURS[0][2].' - '.$CRENEAUX["PM"].' h';
$DEF_DIMAM = ucfirst($JOURS[1][0]).' '.$JOURS[1][1].'/'..$JOURS[1][2].' - '.$CRENEAUX["AM"].' h';
$DEF_DIMPM = ucfirst($JOURS[1][0]).' '.$JOURS[1][1].'/'..$JOURS[1][2].' - '.$CRENEAUX["PM"].' h';
$DEF_SAM2AM = ucfirst($JOURS[2][0]).' '.$JOURS[2][1].'/'..$JOURS[2][2].' - '.$CRENEAUX["AM"].' h';
$DEF_SAM2PM = ucfirst($JOURS[2][0]).' '.$JOURS[2][1].'/'..$JOURS[2][2].' - '.$CRENEAUX["PM"].' h';
$DEF_DIM2AM = ucfirst($JOURS[3][0]).' '.$JOURS[3][1].'/'..$JOURS[3][2].' - '.$CRENEAUX["AM"].' h';
$DEF_DIM2PM = ucfirst($JOURS[3][0]).' '.$JOURS[3][1].'/'..$JOURS[3][2].' - '.$CRENEAUX["PM"].' h';

$DEF_DECONNEXION  = '    	<div id="page-edition-dec">';
$DEF_DECONNEXION .= '			<div id="page-edition-arriere-plan-dec">';
$DEF_DECONNEXION .= '				<!-- boutons utilisateur -->';
$DEF_DECONNEXION .= '				<div id="boutons-utilisateur-dec">';
$DEF_DECONNEXION .= '					<a href="index.php" class="action login" rel="nofollow">Deconnexion</a>				</div>';
$DEF_DECONNEXION .= '			</div><!-- fin DIV #page-edition-arriere-plan -->';
$DEF_DECONNEXION .= '		</div><!-- fin DIV #page-edition -->';

$DEF_ADDIN    = '';

$DEF_ACCUEIL  = '    	<div id="page-edition-ac">';
$DEF_ACCUEIL .= '			<div id="page-edition-arriere-plan-ac">';
$DEF_ACCUEIL .= '				<!-- boutons utilisateur -->';
$DEF_ACCUEIL .= '				<div id="boutons-utilisateur-ac">';
$DEF_ACCUEIL .= '					<a href="index.php" class="action login" rel="nofollow">Accueil</a>'.$DEF_ADDIN.'</div>';
$DEF_ACCUEIL .= '			</div><!-- fin DIV #page-edition-arriere-plan -->';
$DEF_ACCUEIL .= '		</div><!-- fin DIV #page-edition -->';

$DEF_ACCUEIL_H  = '    	<div id="page-edition-ach">';
$DEF_ACCUEIL_H .= '			<div id="page-edition-arriere-plan-ach">';
$DEF_ACCUEIL_H .= '				<!-- boutons utilisateur -->';
$DEF_ACCUEIL_H .= '				<div id="boutons-utilisateur-ach">';
$DEF_ACCUEIL_H .= '					<a href="index.php" class="action login" rel="nofollow">Accueil</a>'.$DEF_ADDIN.'</div>';
$DEF_ACCUEIL_H .= '			</div><!-- fin DIV #page-edition-arriere-plan -->';
$DEF_ACCUEIL_H .= '		</div><!-- fin DIV #page-edition -->';

$DEF_ACCUEIL_B  = '    	<div id="page-edition-acb">';
$DEF_ACCUEIL_B .= '			<div id="page-edition-arriere-plan-acb">';
$DEF_ACCUEIL_B .= '				<!-- boutons utilisateur -->';
$DEF_ACCUEIL_B .= '				<div id="boutons-utilisateur-acb">';
$DEF_ACCUEIL_B .= '					<a href="index.php" class="action login" rel="nofollow">Accueil</a>'.$DEF_ADDIN.'</div>';
$DEF_ACCUEIL_B .= '			</div><!-- fin DIV #page-edition-arriere-plan -->';
$DEF_ACCUEIL_B .= '		</div><!-- fin DIV #page-edition -->';

function def_accueil($strAdd) {
	$str  = '    	<div id="page-edition-defac">';
	$str .= '			<div id="page-edition-arriere-plan-defac">';
	$str .= '				<!-- boutons utilisateur -->';
	$str .= '				<div id="boutons-utilisateur-defac">';
	$str .= '					<a href="index.php" class="action login" rel="nofollow">Accueil</a>'.$strAdd.'</div>';
	$str .= '			</div><!-- fin DIV #page-edition-arriere-plan -->';
	$str .= '		</div><!-- fin DIV #page-edition -->';
	return $str;
}
?>
