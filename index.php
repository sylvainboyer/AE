<?php
include ('defineInc.php');
include ('dbInc.php');
include ('writeTabInc.php');

$NB_JOURS = count($JOURS);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html dir="ltr" xml:lang="fr" xmlns="http://www.w3.org/1999/xhtml" lang="fr">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>EcoChantiers en EcoHabitats [Alter'énergies] - Accueil</title>
	<meta name="description" content="Deux jours pour découvrir 21 exemples d'éco-construction, en Indre-et-Loire, mais aussi dans le Loir-et-Cher, dans l'Indre, dans la Vienne et dans la Sarthe." />
	<meta name="robots" content="index,follow" />
	<meta name="date" content="2014-09-21T13:00:00+0000" />
	<meta name="keywords" content="alterenergies,ecochantier,ecohabitat,eco,chantier,habitat,ecoconstruction,ecomateriaux" />
	<link rel="search" type="application/opensearchdescription+xml" href="http://www.alterenergies.org/lib/exe/opensearch.php" title="Alter'énergies" />
	<link rel="start" href="http://www.alterenergies.org/" />
	<link rel="contents" href="http://www.alterenergies.org/doku.php?id=alterenergies:accueil&amp;do=index" title="Index" />
	<link rel="canonical" href="http://www.alterenergies.org/doku.php?id=alterenergies:accueil" />
	<link rel="stylesheet" media="screen" type="text/css" href="css/css.css?v=<?= filemtime('css/css.css')?>" />
	<link rel="stylesheet" media="print" type="text/css" href="css/print.css?v=<?= filemtime('css/print.css')?>" />
	<link rel="stylesheet" type="text/css" href="css/font.css" />
	<script type="text/javascript" src="lib/prototype.js"></script>
	<script type="text/javascript" src="lib/scriptaculous.js?load=effects"></script>
	<script type="text/javascript" src="js/core.js"></script>
	<script type="text/javascript" src="js/script.js"></script>
	<script type="text/javascript" src="js/class.js"></script>
	<script type="text/javascript" src="js/tab.js?v=<?php echo filemtime('js/tab.js');?>"></script>
	<script type="text/javascript" src="js/index.js?v=<?php echo filemtime('js/index.js');?>"></script>
	<link rel="icon" type="image/png" href="gfx/favicon.png" />
</head>

<body id="body">
<div class="eceh">
	<div id="bandeau">
		<?php include ('headerInc.php'); ?>
	</div>
	<div id="conteneur-degrade"><!-- DIV utilisé pour faire le dégradé derrière #nos-services, #page-content, #page-edition  -->
		<div id="trois-colonnes">
			<div id="participants">
				<?php include ('participInc.php'); ?>
			</div> <!-- Fin #colonne-participants -->
			<div id="colonne-droite">
				<?php include ('partenInc.php'); ?>
			</div><!-- Fin de #colonne-droite -->
			<div id="page-contenu">
			    <div id="visites" class="center">
					<?php
					for ($x = 0; $x < $NB_JOURS; $x++) {
						if ($x==0){
							$nb_weekend = 1;
						} elseif ($JOURS[$x][1] == ($JOURS[$x-1][1] + 1)){
							$nb_weekend = $nb_weekend;
						} else {
							$nb_weekend = $nb_weekend + 1;
					 	}
					}
					$output = $nb_weekend.' week-end';
					if ($nb_weekend > 1) {
						$output .= 's';
					}
					?>
					<h1 id="t-eceh"><?php echo $output; ?> de découverte et d'échange<br /><span class="vertc">autour de l'éco-construction</span></h1>
					<span id="nblieux" class="rougeo"><span id="nb_hotes"><?php echo $NB_HOTES; ?></span> lieux à découvrir en Indre-et-Loire et alentour</span>
					<br /><br />
					<?php /* construction de la chaîne avec les jours d'ouverture*/
					if ($NB_JOURS>0) {
						$output="le";
						if ($NB_JOURS>1) {
							$output.="s";
						}
						$output.='<br /><span class="orange">';
						for ($x = 0; $x < $NB_JOURS; $x++) {
							if ($x==0){
								$output.=" ";
							} elseif ($x==($NB_JOURS - 1)){
								$output.=" et ";
							} else {
								$output.=", ";
							}
							$output.=$JOURS[$x][0]." ".$JOURS[$x][1];
							if ($x==($NB_JOURS - 1)){
								$output.=" ".$JOURS[$x][2];
							} elseif ($JOURS[$x][2] != $JOURS[$x+1][2]){
								$output.=" ".$JOURS[$x][2];
							}
							if ($x==($NB_JOURS - 1)){
								$output.=".</span>";
							} elseif ($JOURS[$x][1] != ($JOURS[$x+1][1] - 1)){
								$output.='</span><br /><span class="orange">';
							}
						}
					}  /* fin de construction de la chaîne avec les jours d'ouverture*/ ?>
					<h1 id="t-dates">L'édition <span class="orange"><?php echo $DEF_ANNEE; ?></span> se tiendra <?php echo $output; ?></h1>
					<h1<span class="vertc">La vie étant ce qu'elle est, les possibilités d'accueil de certains de nos hôtes peuvent avoir évolué depuis l'impression de la plaquette. Les dates présentes sur ce site sont correctes.</span></h1>
					<?php echo inscription_acc($NB_HOTES, $INSCR_OUV, $DATE_DEB_INSCR, $DATE_FIN_INSCR, $s_tablePrefix) ?>
					<br />
				</div>
				<div id="hotes">
					<form id="fphoto" method="post" action="index.php" onsubmit="return photo(this, <?php echo "'".$s_tablePrefix."'";?>)" accept-charset="utf-8">
						<!-- affichage des photos -->
						<div id="photo" class="photos cache">
							<div class="transparent"></div>
							<input id="prev" name="prev" type="image" src="gfx/pto-prev.gif" alt="précédente" />
							<img alt="" id="pchantier" src="" />
							<input id="next" name="next" type="image" src="gfx/pto-next.gif" alt="suivante" />
							<span id="legende">...</span>
							<span id="prop">maison</span>
							<input id="close" name="close" type="image" src="gfx/pto-close.gif" alt="fermer" />
							<input name="bouton" id="bouton" value="" type="hidden" />
							<input name="idx" id="idx" value="" type="hidden" />
						</div>
<!-- coder en php si javascript desactive -->
<?php
function inscription_acc($nb_hotes, $inscr_ouv, $date_deb_inscr, $date_fin_inscr, $s_tablePrefix) {
	//$res = '';
	$closes = '<h3><span class="rougeo gras">Les inscriptions sont closes</span></h3>';
	$ouvertes = '<h3><a id="a_acc_inscr"><span class="rougeo">Pour s\'inscrire : </span></a>
					<a id="binscription" class="action login bInscription" rel="nofollow" href="login.php">inscription</a></h3>';
	if ($inscr_ouv) {
		if(time() < $date_deb_inscr || time() > $date_fin_inscr){
			fermeInscriptions($s_tablePrefix);
			$res = $closes;
		} else {
			$res = $ouvertes;
		}
	} else {
		if(time() > $date_deb_inscr && time() < $date_fin_inscr){
			ouvreInscriptions($s_tablePrefix);
			$res = $ouvertes;
		} elseif(time() < $date_deb_inscr){
			$res = '<h3><span class="bleu16 gras">Ouverture des inscriptions le '. date("d/m/y",$date_deb_inscr).'</span></h3>';
		} else {
		$res = $closes;
		}
	}
	return $res;
}

function ouvreInscriptions($s_tablePrefix){
	$sql_U = 'UPDATE '.$s_tablePrefix.'eceh_params SET inscr_ouv="1" WHERE id="1"';
	$query_U = mysql_query($sql_U) or die ("<br />erreur sur : " . $sql_U);
	if (!isset($_GET['mavar'])) {
		$lien = 'index.php?&mavar=1';
		echo '<meta http-equiv="refresh" content="0;URL=index.php">';
	}
	mysql_free_result($query_U);
}

function fermeInscriptions($s_tablePrefix){
	$sql_U = 'UPDATE '.$s_tablePrefix.'eceh_params SET inscr_ouv="0" WHERE id="1"';
	$query_U = mysql_query($sql_U) or die ("<br />erreur sur : " . $sql_U);
	if (!isset($_GET['mavar'])) {
		$lien = 'index.php?&mavar=1';
		echo '<meta http-equiv="refresh" content="0;URL=index.php">';
	}
	mysql_free_result($query_U);
}

function whichDays($a_data){
	$s_day = '';
	$j11 = ($a_data['placesSamAM'] != 0);
	$j12 = ($a_data['placesSamPM'] != 0);
	$j21 = ($a_data['placesDimAM'] != 0);
	$j22 = ($a_data['placesDimPM'] != 0);
	$j31 = ($a_data['placesSam2AM'] != 0);
	$j32 = ($a_data['placesSam2PM'] != 0);
	$j41 = ($a_data['placesDim2AM'] != 0);
	$j42 = ($a_data['placesDim2PM'] != 0);
	$jour1=ucfirst($JOURS[0][0]).' '.$JOURS[0][1];
	$jour2=ucfirst($JOURS[1][0]).' '.$JOURS[1][1];
	$jour3=ucfirst($JOURS[2][0]).' '.$JOURS[2][1];
	$jour4=ucfirst($JOURS[3][0]).' '.$JOURS[3][1];
	$s_day = '<div class="txt_dispo">Disponibilités : </div>
			<div class="picto_jours">
				<div class="hv">
					<div class="hv1">10h 15h</div>
					<div class="hv2">10h 15h</div>
				</div>
				<div class="sam">'.$jour1.' '.substr($JOURS[0][2],0,3).' :&nbsp;&nbsp;&nbsp;
					<span class="picto"><img alt="picto1" src="gfx/'.($j11==true?"oui":"non").'.png" title="'.$jour1.' à 10h : visite '.($j11==true?"possible":"impossible").'"></span>
					<span class="picto"><img alt="picto2" src="gfx/'.($j12==true?"oui":"non").'.png" title="'.$jour1.' à 15h : visite '.($j12==true?"possible":"impossible").'"></span>
				</div>
				<div class="dim">'.$jour2.' '.substr($JOURS[1][2],0,3).' :&nbsp;&nbsp;
					<span class="picto"><img alt="picto3" src="gfx/'.($j21==true?"oui":"non").'.png" title="'.$jour2.' à 10h : visite '.($j21==true?"possible":"impossible").'"></span>
					<span class="picto"><img alt="picto4" src="gfx/'.($j22==true?"oui":"non").'.png" title="'.$jour2.' à 15h : visite '.($j22==true?"possible":"impossible").'"></span>
				</div>
				<br />
				<div class="sam">'.$jour3.' '.substr($JOURS[2][2],0,3).' :&nbsp;
					<span class="picto"><img alt="picto5" src="gfx/'.($j31==true?"oui":"non").'.png" title="'.$jour3.' à 10h : visite '.($j31==true?"possible":"impossible").'"></span>
					<span class="picto"><img alt="picto6" src="gfx/'.($j32==true?"oui":"non").'.png" title="'.$jour3.' à 15h : visite '.($j32==true?"possible":"impossible").'"></span>
				</div>
				<div class="dim">'.$jour4.' '.substr($JOURS[3][2],0,3).' :
					<span class="picto"><img alt="picto7" src="gfx/'.($j41==true?"oui":"non").'.png" title="'.$jour4.' à 10h : visite '.($j41==true?"possible":"impossible").'"></span>
					<span class="picto"><img alt="picto8" src="gfx/'.($j42==true?"oui":"non").'.png" title="'.$jour4.' à 15h : visite '.($j42==true?"possible":"impossible").'"></span>
				</div>
			</div>';
	return $s_day;
};

function miniature($m_data){
	$res = "";
	if($m_data['nb_photo'] != 0){
		$res = "<div class='cmini'><img src='gfx/photos/" . $m_data['photo'] . "-1.jpg' class='mini' alt='" . $m_data['photo'] . "-1' /></div>";
		for ($i = 2; $i <= $m_data['nb_photo']; $i++){
			$res .= "<img src='gfx/photos/" . $m_data['photo'] . "-" . $i .".jpg' class='preload' alt='" . $m_data['photo'] . "-" . $i ."' />";
		}
	}else{
		$res = "<div class='cmini'><img src='gfx/nd.jpg' class='mini' alt='Pas de photos' /></div>";
	}
	return $res;
};

$sql_S = 'SELECT * FROM '.$s_tablePrefix.'eceh_hote WHERE ordre_aff!=0 ORDER BY ordre_aff';
$query = mysql_query($sql_S) or die ("<br />erreur sur : " . $sql_S);
while($data = mysql_fetch_array($query)){
	$dpt = substr($data['cp'],0,2);
	echo '			<div class="hote level2 dpt'.$dpt.'">';
	echo '				<p><span class="num num'.$dpt.'">'.$data['ordre_aff'].'</span><span class="num ndpt nd'.$dpt.'"></span><span class="nom">'.$data['nom'].'</span><span class="adr">'.$data['ville'].'</span></p>';
	echo miniature($data);
	echo whichDays($data);
	echo '				<a class="savoir_plus sp" title="En savoir plus...">';
	echo '				</a>';
	echo '				<div class="description cache" title="Cliquez pour fermer">';
	echo '              <span class="ferm">cliquez pour fermer</span>';
	echo '              <h5 class="phrase">'.$data['phrase'].'</h5>';
	if ($data['blog'] != ""){
		echo '              <p class="blog"><a href="'.$data['blog'].'" title="Cliquez pour naviguer vers '.$data['blog'].'">'.$data['blog'].'</a><a class="blog_ext" href="'.$data['blog'].'"><img src="gfx/iconExtLink.png" alt="Lien externe" title="Cliquez pour ouvrir le lien dans un nouvel onglet" /></a></p>';
	}
	echo '				<p>'.$data['descr'].'</p>';
    if ($data['nb_photo']>0){
		echo '				<h5><input name="show'.$data['ordre_aff'].'" id="show'.$data['ordre_aff'].'" value="show'.$data['ordre_aff'].'" class="photo" type="image" title="Cliquez pour voir les photos" src="gfx/cam.gif" /></h5>';
	}
	echo '			</div>';
	// PHOTO
	echo '		</div>';
	echo '		<div class="hote-sep">&nbsp;</div>';
}
mysql_free_result($query);
?>
					</form>
				</div> <!-- hotes -->
			</div><!-- Fin de #page-contenu -->
		</div><!-- fin DIV #deux-colonnes -->
		<div style="clear: both;"></div>
		<div id="page-edition">
			<div id="page-edition-arriere-plan">
				<!-- boutons utilisateur -->
				<div id="boutons-utilisateur" class="bInscription">
<?php
	if($INSCR_OUV){
		echo '					<a class="action login" rel="nofollow" href="login.php">inscription</a>';
	}
?>
			  </div>
			</div><!-- fin DIV #page-edition-arriere-plan -->
		</div><!-- fin DIV #page-edition -->
	</div><!-- fin DIV pour dégradé #conteneur-degrade -->
	<div style="clear: both;"></div>
<?php
	include ('footerInc.php');
?>
</div><!--<div class="eceh">-->
<div id="scroll-bar" class="scroll_bar_a" style="display:none;">
	<a  href="#" title="Haut de page"><span></span>Haut de page</a>
</div>
</body>
</html>
<?php
	ob_end_flush();
?>
