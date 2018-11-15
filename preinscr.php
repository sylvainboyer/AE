<?php
ob_start('ob_gzhandler');
$ttl = 4*24*3600;
session_set_cookie_params($ttl);
ini_set('session.gc_maxlifetime', $ttl);
session_name('eceh');
session_start();
include ('defineInc.php');
include ('dbInc.php');
//  date_default_timezone_set('Europe/Paris');
$iECEHDate = strtotime("12 oct 2014")+60*60*16;
function logVisiteur($mail, $s_tablePrefix){
	$log_F = fopen('log.txt', 'a');
	$sql_S = 'INSERT INTO '.$s_tablePrefix.'eceh_log (date, op, id_h, creneau) VALUES (NOW(), "pre-visiteur", 0, 0)';
	mysql_query($sql_S) or die ("<br />erreur sur : " . $sql_S);

	fputs($log_F, date("j M Y")." - pre-visiteur (".$mail.")\n");

	fclose($log_F);
}
setlocale(LC_ALL, 'fr_FR.utf8'); // fr_FR pour la France
$action = $_POST["action"];
@$nom = $_POST["n"];
@$prenom = $_POST["p"];
@$mail = $_POST["m"];
@$tel = $_POST["t"];
@$idV = $_POST["id"];
@$infos = $_POST["infos"];
/********************************************************
*            controles                                  *
********************************************************/
$errMsg = "";
$do="";
$bMissing = false;
$star = "<span class='missing'>*</span>";
if (isset($_POST['do'])){
	$keys = array_keys($_POST['do']);
	$do = strtolower($keys[0]);
}
$keys = array_keys($_POST);
$ppost = "";
for ($i = 0; $i < count($_POST); $i++){
	$ppost = $ppost."\\n\\t".$keys[$i]." : ".$_POST[$keys[$i]];
}

if ($do != "voir" && !preg_match('/annuler/', $do)){
	switch($action){
		// validation : donnees minimales
		case "preinsc":
			if ($nom == ""){
				$errMsg = "<span class='attention'>Veuillez saisir votre nom. </span><a href='prelogin.php' class='action login' rel='nofollow'>Retour</a>"; // rajouter bouton pour lien
			}
			if ($prenom == ""){
				$errMsg = "<span class='attention'>Veuillez saisir votre prénom. </span><a href='prelogin.php' class='action login' rel='nofollow'>Retour</a>"; // rajouter bouton pour lien
			}
			if ($mail == ""){
				$errMsg = "<span class='attention'>Veuillez saisir votre courriel. </span><a href='prelogin.php' class='action login' rel='nofollow'>Retour</a>"; // rajouter bouton pour lien
			}else{
				if(!preg_match('/^[^@]+@[a-zA-Z0-9._-]+\.[a-zA-Z]+$/', $mail)) {
					$errMsg = "<span class='attention'>Adresse courriel incorrecte ! Veuillez la re-saisir. </span><a href='prelogin.php' class='action login' rel='nofollow'>Retour</a>";
				}
			}
			break;

		default:
			break;
	}
}

switch($action) {
	case "preinsc":
		$_SESSION['nom'] = $nom;
		$_SESSION['prenom'] = $prenom;
		$_SESSION['mail'] = $mail;
		$_SESSION['tel'] = $tel;
		if ($mail != "" && preg_match('/^[^@]+@[a-zA-Z0-9._-]+\.[a-zA-Z]+$/', $mail)){
			$sql_S = 'SELECT * FROM '.$s_tablePrefix.'eceh_preinscription WHERE UPPER(mail)="'.strtoupper($mail).'"';
			$query = mysql_query($sql_S) or die ("<br />erreur (5) sur : " . $sql_S);
			if ($data = mysql_fetch_array($query)){ // visiteur deja inscrit
				$idV = $data['id'];
				$res_pi = "<h1 class='reponse'>Vous êtes déjà pre-inscrit.</h1>";
			}else{ // nouveau visiteur
				$sql_S = 'INSERT INTO '.$s_tablePrefix.'eceh_preinscription (nom, prenom, mail, tel, date_preinsc) VALUES ("'.$nom.'", "'.$prenom.'", "'.$mail.'", "'.$tel.'", NOW())';
				$query = mysql_query($sql_S) or die ("<br />erreur sur : " . $sql_S);
				$idV = mysql_insert_id();
				logVisiteur($mail, $s_tablePrefix);
				$res_pi = "<h1>Votre inscription a bien été prise en compte.<br />Vous recevrez un courriel dès l'ouverture des réservations.</h1>";
			}
			if(@$infos){
				$sql_S = 'SELECT * FROM '.$s_tablePrefix.'eceh_contacts WHERE UPPER(mail)="'.strtoupper($mail).'"';
				$query = mysql_query($sql_S) or die ("<br />erreur (5) sur : " . $sql_S);
				if ($data = mysql_fetch_array($query)){ // visiteur deja inscrit
					// TODO

				}else{ // nouveau visiteur
					$sql_S = 'INSERT INTO '.$s_tablePrefix.'eceh_contacts (nom, prenom, mail, tel, date_contact) VALUES ("'.$nom.'", "'.$prenom.'", "'.$mail.'", "'.$tel.'", NOW())';
					$query = mysql_query($sql_S) or die ("<br />erreur sur : " . $sql_S);
					$res_pi .= "<h2>Vous serez également averti des autres actions d'Alter'énergies.</h2>";
				}
			}
			$res_pi .= "<a id='binscription' class='action login bInscription' rel='nofollow' href='index.php'>Accueil</a>";
			mysql_free_result($query);
		}
		break;

	default:
		break;
}
if (time() > $iECEHDate){
	$errMsg = "<span class='attention'>Les inscriptions sont closes !</span>";
	break;
}
// construit le tableau dynamique JS
//include ('writeTabInc.php');

/*TODO
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
- css pour impression*/
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="ltr" xml:lang="fr" xmlns="http://www.w3.org/1999/xhtml" lang="fr">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<title>EcoChantiers en EcoHabitats - Réponse pre-inscription</title>
<?php
if (($action == "preinsc" OR $action == "") AND ($mail == "")){
  echo '<meta http-equiv="refresh" content="0;url=prelogin.php" />';
}
?>
	<meta name="generator" content="DokuWiki Release 2009-12-25c &quot;Lemming&quot;"/>
	<meta name="robots" content="index,follow"/>
	<meta name="date" content="2008-06-19T18:16:49+0200"/>
	<meta name="keywords" content="alterenergies,accueil"/>
	<link rel="search" type="application/opensearchdescription+xml" href="http://www.alterenergies.org/lib/exe/opensearch.php" title="Alter'énergies"/>
	<link rel="start" href="http://www.alterenergies.org/"/>
	<link rel="contents" href="http://www.alterenergies.org/doku.php?id=alterenergies:accueil&amp;do=index" title="Index"/>
	<link rel="canonical" href="http://www.alterenergies.org/doku.php?id=alterenergies:accueil"/>
	<link rel="stylesheet" media="screen" type="text/css" href="css/css.css?v=<?php echo filemtime('css/css.css');?>"/>
	<link rel="stylesheet" media="print" type="text/css" href="css/print.css?v=<?php echo filemtime('css/print.css');?>">
	<script type="text/javascript" src="lib/prototype.js"></script>
	<script type="text/javascript" src="lib/scriptaculous.js?load=effects"></script>
	<script type="text/javascript" charset="utf-8" src="js/core.js"></script>
	<script type="text/javascript" charset="utf-8" src="js/class.js"></script>
	<script type="text/javascript" charset="utf-8" src="js/tab.js?v=<?php echo filemtime('js/tab.js');?>"></script>
	<script type="text/javascript" src="js/map.js"></script>
	<script type="text/javascript" src="js/preinscr.js"></script>
	<link rel="icon" type="image/png" href="gfx/favicon.png"/>
	<!--	Correctif pour l'affichage de #contenu-page dans IE6 qui ne connait pas les contextes de formatage : http://css.alsacreations.com/Faire-une-mise-en-page-sans-tableaux/design-trois-colonnes-positionnement-flottant
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
			</div> <!-- Fin #colonne-participants -->
			<div id="colonne-droite">
				<?php include ('partenInc.php'); ?>
			</div><!-- Fin de #colonne-droite -->
			<div id="page-contenu">
				<div class="centeralign">
<?php
//          <h2>Problème d'inscription sur Internet Explorer : vous pouvez utiliser Firefox ou envoyer un mail à infos@alterenergies.org en attendant la résolution du problème !</h2>
  if (@$errMsg != ""){
    $errMsg = "<div class='errmsg'>".$errMsg."</div>";
  }
  echo $errMsg;
  if (@$res_pi != ""){
    $res_pi = "<div class='errmsg'>".$res_pi."</div>";
  }
  echo @$res_pi;
?>
					<div>
						<h5>Pour tout problème d'inscription :
							<a href="mailto:infos@alterenergies.org">infos@alterenergies.org</a>
						</h5>
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