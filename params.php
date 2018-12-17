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





?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html dir="ltr" xml:lang="fr" xmlns="http://www.w3.org/1999/xhtml" lang="fr">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>EcoChantiers en EcoHabitats - Paramétrage de la future édition</title>
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
<!-- params.js-->	<script type="text/javascript" charset="utf-8" src="js/login.js"></script>
	<script type="text/javascript" src="js/map.js"></script>
	<link rel="icon" type="image/png" href="gfx/favicon.png" />
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
					<form id="fparams" method="post" action="params.php" onsubmit="return valider(this)" accept-charset="utf-8">
						<div class="no">
							<input type="hidden" id="id" name="id" value="-1" />
							<input type="hidden" id="params" name="params" value="-1" />
							<fieldset id="fsparams">
								<legend>créneaux d'ouverture</legend>
								<p>
									<label class="block" for="samedi_1"><span>1er Samedi *</span></label>
									<input id="samedi_1" name="samedi_1" class="edit" type="text" <?php echo $d_samedi_1; ?> />
								</p>
								<p>
									<label class="block" for="dimanche_1"><span>1er Dimanche *</span></label>
									<input id="dimanche_1" name="dimanche_1" class="edit" type="text" <?php echo $d_dimanche_1; ?> />
								</p>
								<br/>
								<p>
									<label class="block" for="samedi_2"><span>2eme Samedi</span></label>
									<input id="samedi_2" name="samedi_2" class="edit" type="text" <?php echo $d_samedi_2; ?> />
								</p>
								<p>
									<label class="block" for="dimanche_2"><span>2eme Dimanche</span></label>
									<input id="dimanche_2" name="dimanche_2" class="edit" type="text" <?php echo $d_dimanche_2; ?> />
								</p>
								<br/>
								<p>
									<label class="block" for="samedi_3"><span>3eme Samedi</span></label>
									<input id="samedi_3" name="samedi_3" class="edit" type="text" <?php echo $d_samedi_3; ?> />
								</p>
								<p>
									<label class="block" for="dimanche_3"><span>3eme Dimanche</span></label>
									<input id="dimanche_3" name="dimanche_3" class="edit" type="text" <?php echo $d_dimanche_3; ?> />
								</p>
								<br/>
								<p>
									<label class="block" for="heure_creneau_matin"><span>Horaire d'ouverture le matin *</span></label>
									<input id="heure_creneau_matin" name="heure_creneau_matin" class="edit" type="text" <?php echo $i_heure_creneau_matin; ?> />
								</p>
								<p>
									<label class="block" for="heure_creneau_apres_midi"><span>Horaire d'ouverture l'après midi *</span></label>
									<input id="heure_creneau_apres_midi" name="heure_creneau_apres_midi" class="edit" type="text" <?php echo $i_heure_creneau_apres_midi; ?> />
								</p>
              </fieldset>
              </br>
							<fieldset id="fsparams">
								<legend>période d'inscription</legend>
								<p>
									<label class="block" for="date_deb_inscr"><span>Date de début des inscriptions *</span></label>
									<input id="date_deb_inscr" name="date_deb_inscr" class="edit" type="text" <?php echo $d_date_deb_inscr; ?> />
								</p>
								<p>
									<label class="block" for="date_deb_inscr"><span>Date de fin des inscriptions *</span></label>
									<input id="date_fin_inscr" name="date_fin_inscr" class="edit" type="text" <?php echo $d_date_fin_inscr; ?> />
								</p>
								<p>
									<label class="block" for="inscr_ouv"><span>Inscriptions ouvertes</span></label>
									<input id="inscr_ouv" name="inscr_ouv" class="edit" type="checkbox" <?php echo $i_inscr_ouv; ?> />
								</p>
							</fieldset>
              </br>
							<fieldset id="fsparams">
								<legend>Téléchargement de l'affiche et du flyer</legend>
								<p>
									<label class="block" for="affiche"><span>Affiche</span></label>
									<input id="affiche" name="affiche" class="edit button" type="file" accept="application/pdf"/>
								</p>
								<p>
									<label class="block" for="flyer"><span>Flyer</span></label>
									<input id="flyer" name="flyer" class="edit button" type="file" accept="application/pdf"/>
								</p>
							</fieldset>
              <br/>
              <p>
                <input value="Enregistrer" id="save" name="save" class="edit button" type="submit" />
              </p>

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
