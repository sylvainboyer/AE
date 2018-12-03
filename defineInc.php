<?php

// Extrait de la BDD dans dbInc.php
/*	$SAMEDI_1
	$DIMANCHE_1
	$SAMEDI_2
	$DIMANCHE_2
	$SAMEDI_3
	$DIMANCHE_3
	$DEF_AM
	$DEF_PM
	*/

$NB_JOURS = 2;
$SAMEDI_1	= explode("/",$SAMEDI_1,3);
$DEF_ANNEE = $SAMEDI_1[2];
$SAMEDI_1	= array("samedi",$SAMEDI_1[0],$SAMEDI_1[1]);
$DIMANCHE_1	= explode("/",$DIMANCHE_1,3);
$DIMANCHE_1	= array("dimanche",$DIMANCHE_1[0],$DIMANCHE_1[1]);
$SAMEDI_2	= explode("/",$SAMEDI_2,3);
$DIMANCHE_2	= explode("/",$DIMANCHE_2,3);
if ($SAMEDI_2[2] == $DEF_ANNEE) {
	$SAMEDI_2	= array("samedi",$SAMEDI_2[0],$SAMEDI_2[1]);
	$DIMANCHE_2	= array("dimanche",$DIMANCHE_2[0],$DIMANCHE_2[1]);
	$NB_JOURS = $NB_JOURS + 2;
} else {
	$SAMEDI_2	= array("","","");
	$DIMANCHE_2	= array("","","");
}
$SAMEDI_3	= explode("/",$SAMEDI_3,3);
$DIMANCHE_3	= explode("/",$DIMANCHE_3,3);
if ($SAMEDI_3[2] == $DEF_ANNEE) {
	$SAMEDI_3	= array("samedi",$SAMEDI_3[0],$SAMEDI_3[1]);
	$DIMANCHE_3	= array("dimanche",$DIMANCHE_3[0],$DIMANCHE_3[1]);
	$NB_JOURS = $NB_JOURS + 2;
} else {
	$SAMEDI_3	= array("","","");
	$DIMANCHE_3	= array("","","");
}

$JOURS = array
	(
	$SAMEDI_1,
	$DIMANCHE_1,
	$SAMEDI_2,
	$DIMANCHE_2,
	$SAMEDI_3,
	$DIMANCHE_3
	);

$CRENEAUX = array("AM"=>$DEF_AM, "PM"=>$DEF_PM);

$DEF_SAM1 = $JOURS[0][1].'/'.$JOURS[0][2];
$DEF_DIM1 = $JOURS[1][1].'/'.$JOURS[1][2];
$DEF_SAM2 = $JOURS[2][1].'/'.$JOURS[2][2];
$DEF_DIM2 = $JOURS[3][1].'/'.$JOURS[3][2];
$DEF_SAM3 = $JOURS[4][1].'/'.$JOURS[4][2];
$DEF_DIM3 = $JOURS[5][1].'/'.$JOURS[5][2];

$MOIS = array("1"=>"janvier", "2"=>"février", "3"=>"mars", "4"=>"avril", "5"=>"mai", "6"=>"juin", "7"=>"juillet", "8"=>"août", "9"=>"septembre", "10"=>"octobre", "11"=>"novembre", "12"=>"décembre");

$DEF_SAMAM = ucfirst($JOURS[0][0]).' '.$JOURS[0][1].'/'.$JOURS[0][2].' - '.$CRENEAUX["AM"].' h';
$DEF_SAMPM = ucfirst($JOURS[0][0]).' '.$JOURS[0][1].'/'.$JOURS[0][2].' - '.$CRENEAUX["PM"].' h';
$DEF_DIMAM = ucfirst($JOURS[1][0]).' '.$JOURS[1][1].'/'.$JOURS[1][2].' - '.$CRENEAUX["AM"].' h';
$DEF_DIMPM = ucfirst($JOURS[1][0]).' '.$JOURS[1][1].'/'.$JOURS[1][2].' - '.$CRENEAUX["PM"].' h';
$DEF_SAM2AM = ucfirst($JOURS[2][0]).' '.$JOURS[2][1].'/'.$JOURS[2][2].' - '.$CRENEAUX["AM"].' h';
$DEF_SAM2PM = ucfirst($JOURS[2][0]).' '.$JOURS[2][1].'/'.$JOURS[2][2].' - '.$CRENEAUX["PM"].' h';
$DEF_DIM2AM = ucfirst($JOURS[3][0]).' '.$JOURS[3][1].'/'.$JOURS[3][2].' - '.$CRENEAUX["AM"].' h';
$DEF_DIM2PM = ucfirst($JOURS[3][0]).' '.$JOURS[3][1].'/'.$JOURS[3][2].' - '.$CRENEAUX["PM"].' h';
$DEF_SAM3AM = ucfirst($JOURS[4][0]).' '.$JOURS[4][1].'/'.$JOURS[4][2].' - '.$CRENEAUX["AM"].' h';
$DEF_SAM3PM = ucfirst($JOURS[4][0]).' '.$JOURS[4][1].'/'.$JOURS[4][2].' - '.$CRENEAUX["PM"].' h';
$DEF_DIM3AM = ucfirst($JOURS[5][0]).' '.$JOURS[5][1].'/'.$JOURS[5][2].' - '.$CRENEAUX["AM"].' h';
$DEF_DIM3PM = ucfirst($JOURS[5][0]).' '.$JOURS[5][1].'/'.$JOURS[5][2].' - '.$CRENEAUX["PM"].' h';

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
