<?php
ob_start('ob_gzhandler');
$ttl = 4*24*3600; 
session_set_cookie_params($ttl);
ini_set('session.gc_maxlifetime', $ttl);
session_name('eceh');
session_start();
if (isset($_SESSION['nom'])){
	$s_valNom = " value='".$_SESSION['nom']."' ";
	$s_valPrenom = " value='".$_SESSION['prenom']."' ";
	$s_valMail = " value='".$_SESSION['mail']."' ";
	$s_valTel = " value='".$_SESSION['tel']."' ";
}else{
	$s_valNom = "";
	$s_valPrenom = "";
	$s_valMail = "";
	$s_valTel = "";
}
include ('defineInc.php');
include ('dbInc.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html dir="ltr" xml:lang="fr" xmlns="http://www.w3.org/1999/xhtml" lang="fr">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>EcoChantiers en EcoHabitats - Connexion</title>
	<meta name="description" content="Deux jours pour découvrir 37 exemples d'éco-construction, en Indre-et-Loire, mais aussi dans le Maine-et-Loire, dans la Sarthe, dans le Loir-et-Cher, dans l'Indre et dans la Vienne. Page d'identification." />
	<!-- Déclaration du plugin displaywikipage -->
	<meta name="generator" content="DokuWiki Release 2009-12-25c &quot;Lemming&quot;" />
	<meta name="robots" content="index,follow" />
	<meta name="date" content="2014-09-21T13:00:00+0000" />
	<meta name="keywords" content="alterenergies,ecochantier,ecohabitat,eco,chantier,habitat,ecoconstruction,ecomateriaux" />
	<link rel="search" type="application/opensearchdescription+xml" href="http://www.alterenergies.org/lib/exe/opensearch.php" title="Alter'énergies" />
	<link rel="start" href="http://www.alterenergies.org" />
	<link rel="contents" href="http://www.alterenergies.org/doku.php?id=alterenergies:accueil&amp;do=index" title="Index" />
	<link rel="canonical" href="http://www.alterenergies.org/doku.php?id=alterenergies:accueil" />
	<link rel="stylesheet" media="screen" type="text/css" href="css/css.css?v=<?= filemtime('css/css.css')?>" />
	<link rel="stylesheet" media="print" type="text/css" href="css/print.css?v=<?= filemtime('css/print.css')?>" />
	<link rel="stylesheet" type="text/css" href="css/font.css" />
	<script type="text/javascript" src="lib/prototype.js"></script>
	<script type="text/javascript" src="lib/scriptaculous.js?load=effects"></script>
	<script type="text/javascript" charset="utf-8" src="js/core.js"></script>
	<script type="text/javascript" charset="utf-8" src="js/login.js"></script>
	<script type="text/javascript" src="js/map.js"></script>
	<link rel="icon" type="image/png" href="gfx/favicon.png" />
<!--	Correctif pour l'affichage de #contenu-page dans IE6 qui ne connait pas les contextes de formatage :
		http://css.alsacreations.com/Faire-une-mise-en-page-sans-tableaux/design-trois-colonnes-positionnement-flottant
		Et autres...-->
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
<body>
<div class="eceh">
	<div id="bandeau">
		<?php include ('headerInc.php'); ?>
	</div>
	<?php echo $DEF_ACCUEIL_H; // bouton deconnexion haut et bas ?>
	<!-- DIV utilisé pour faire le dégradé derrière #nos-services, #page-content, #page-edition  -->
	<div id="conteneur-degrade">
		<div id="trois-colonnes">
			<div id="participants">
				<?php include ('writeHoteInc.php'); ?>
			</div><!-- Fin #participants -->
			<div id="colonne-droite">
				<?php  include ('partenInc.php'); ?>
			</div><!-- Fin de #colonne-droite -->
			<div id="page-contenu">
				<h5><a name="connexion" id="connexion">Vous n&#039;êtes pas connecté !<br /> Saisissez vos nom, prénom, mail et tel pour vous connecter.</a></h5>
				<div class="centeralign">
					<form id="finscription" method="post" action="resa.php" onsubmit="return valider(this)" accept-charset="utf-8">
						<div class="no">
							<input type="hidden" id="id" name="id" value="-1" />
							<input type="hidden" id="action" name="action" value="login" />
							<fieldset id="fsinscription">
								<legend>Connexion</legend>
								<p>
									<label class="block" for="n"><span>NOM *</span></label>
									<input id="n" name="n" class="edit" type="text" <?php echo $s_valNom; ?> />
								</p>
								<p>
									<label class="block" for="p"><span>Prénom *</span></label>
									<input id="p" name="p" class="edit" type="text" <?php echo $s_valPrenom; ?> />
								</p>
								<p>
									<label class="block" for="m"><span>Mail *</span></label>
									<input id="m" name="m" class="edit" type="text" <?php echo $s_valMail; ?> />
								</p>
								<p>
									<label class="block" for="t"><span>Tel *</span></label>
									<input id="t" name="t" class="edit" type="text" <?php echo $s_valTel; ?> />
								</p>
								<br/>
								<p>
									<input value="Connexion" id="connect" name="connect" class="edit button" type="submit" />
								</p>
								<p class="etoile">* Votre adresse mail est indispensable pour recevoir l'adresse du rendez-vous.<br />Ces données ne seront pas communiquées et pourront servir à vous contacter en cas d'imprévus et pour vous demander un retour sur l'évènement (mail).</p>
							</fieldset>
						</div>
					</form>
				</div>
			</div><!-- Fin de #page-contenu --> 
		</div><!-- fin DIV #deux-colonnes -->
		<div style="clear: both;"></div>
		<?php echo $DEF_ACCUEIL_B; // bouton deconnexion haut et bas ?>
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