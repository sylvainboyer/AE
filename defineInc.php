<?php
$DEF_ANNEE = "2017";
$JOURS = array
  (
  array("samedi","7","octobre"),
  array("dimanche","8","octobre"),
  array("samedi","14","octobre"),
  array("dimanche","15","octobre"),
  );

$DEF_SAMAM = "Samedi 7/10 - 10 h";
$DEF_SAMPM = "Samedi 7/10 - 15 h";
$DEF_DIMAM = "Dimanche 8/10 - 10 h";
$DEF_DIMPM = "Dimanche 8/10 - 15 h";
$DEF_SAM2AM = "Samedi 14/10 - 10 h";
$DEF_SAM2PM = "Samedi 14/10 - 15 h";
$DEF_DIM2AM = "Dimanche 15/10 - 10 h";
$DEF_DIM2PM = "Dimanche 15/10 - 15 h";

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
