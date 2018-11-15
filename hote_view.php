<?php
$ttl = 4*24*3600; 
session_set_cookie_params($ttl);
ini_set('session.gc_maxlifetime', $ttl);
session_name('eceh');
session_start();

include ('defineInc.php');
include ('dbInc.php');
include ('debug.php');
//debug("hote._view.php1.5 : "." : ". $_SESSION['chantier']);
//$bFollow = false;
$chantier = (isset($_POST['chantier']) && is_int((integer) $_POST['chantier'])) ? (integer) $_POST['chantier'] : NULL;
$action = (isset($_POST['action']) && is_string($_POST['action'])) ? $_POST['action'] : NULL;
//$pwd = (isset($_POST['pwd']) && is_string($_POST['pwd'])) ? $_POST['pwd'] : NULL;
$_SESSION['chantier'] = $chantier;
//debug("chantier = ".$_POST['chantier']." - pwd = ".$_POST['pwd']);
//$meta = "";
  //debug("hote_view.php => SESSION : ". $_SESSION['chantier'].' POST : '.$_POST['chantier'].' $chantier : '.$chantier.' '.is_int($chantier));
if(($chantier >= -1 and $chantier < $NB_HOTES)){
	//debug("hote._view.php3 : ".$action." : ". $_SESSION['chantier']);
	if($action === NULL){
		//debug("hote._view.php4 : "." : ". $_SESSION['chantier']);
		$meta = '<meta http-equiv="refresh" content="0;url=hote.php?err=Veuillez choisir un lieu !" />';
	}elseif($action === "login" AND $chantier === -1){
		//debug("hote._view.php5 : ".$action ." : ". $_POST['chantier']);
		$meta = '<meta http-equiv="refresh" content="0;url=hote.php?err=Veuillez choisir un lieu !" />';
	}elseif($action === "login"){
		//debug('login');
		if($chantier > 0){
			//debug('chantier > 0');
			$sql_S = 'SELECT * FROM '.$s_tablePrefix.'eceh_hote WHERE id='.$chantier;
//			$bFollow = true;
		}elseif($chantier == 0){
			//debug('OK chantier : '. $chantier.' mp : '.$pwd);
			$sql_S = 'SELECT * FROM '.$s_tablePrefix.'eceh_hote WHERE ordre_aff>0 ORDER BY ordre_aff';
//			$bFollow = true;
		}else{
			//debug('KO chantier : '. $chantier.' mp : '.$pwd);
			$meta = '<meta http-equiv="refresh" content="0;url=hote.php?err=Une erreur s\'est produite !" />';
		}
		//debug($sql_S);
		$query = mysql_query($sql_S) or die ("<br>erreur 1 sur : " . $sql_S);  
		$data = mysql_fetch_array($query);
		//debug($_POST['pwd']." // ".md5($_POST['pwd'])." // ".$data['pwd']);
		/*if ($chantier && $data && $data['pwd']!=md5($_POST['pwd'])){
			$meta = '<meta http-equiv="refresh" content="0;url=hote.php?err=Code d\'accès erroné !" />';
		}else{*/
			$_SESSION['chantier']=$chantier;
//			$bFollow = true;
		/*}*/
		mysql_free_result($query);
	}
/*}else{
	//$chantier = $_SESSION['chantier'];
	$bFollow = false;*/
}
//if ($bFollow){
	if($chantier != 0){
		$sql_S = 'SELECT * FROM '.$s_tablePrefix.'eceh_hote WHERE id='.$chantier;
		$query = mysql_query($sql_S) or die ("<br>erreur 2 sur : " . $sql_S);  
		if ($data = mysql_fetch_array($query)){
			$DEF_DECONNEXION = def_accueil('<a href="hote.php?action=chantierChange" class="action login" rel="nofollow">'.$data['nom'].' : modifier</a>');
		}
	}else{
		$DEF_DECONNEXION = def_accueil('<a href="hote.php?action=chantierChange" class="action login" rel="nofollow">Choisir un hote</a>');
	}
	mysql_free_result($query);
//}
//$pwd = $_POST["pwd"];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="ltr" xml:lang="fr" xmlns="http://www.w3.org/1999/xhtml" lang="fr">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<title>D'EcoChantiers en EcoHabitats : Récapitulatif hotes</title>
<?php
echo $meta;
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
	<link rel="stylesheet" type="text/css" href="css/font.css" />
	<script type="text/javascript" src="lib/prototype.js"></script>
	<script type="text/javascript" charset="utf-8" src="js/core.js"></script>
	<script type="text/javascript" charset="utf-8" src="js/hote.js"></script>
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
	</style>
	<![endif]-->
</head>
<body>
<div class="eceh">
	<div id="bandeau">
		<?php include ('headerInc.php'); ?>
	</div>
	<?php echo $DEF_DECONNEXION; // bouton deconnexion haut et bas ?>
	<!-- DIV utilisé pour faire le dégradé derrière #nos-services, #page-content, #page-edition  -->
	<div id="conteneur-degrade">	
		<div id="trois-colonnes">
			<div id="participants">
				<?php include ('writeHoteInc.php'); ?>
		</div> <!-- Fin #colonne-participants -->
		<div id="colonne-droite">
			<?php include ('partenInc.php'); ?>
		</div><!-- Fin de #colonne-droite -->
		<div id="page-contenu">
			<div class='recap'>
<?php
	$creneau[1] = strtolower(str_replace(" - ", " à ", $DEF_SAMAM));
	$creneau[2] = strtolower(str_replace(" - ", " à ", $DEF_SAMPM));
	$creneau[3] = strtolower(str_replace(" - ", " à ", $DEF_DIMAM));
	$creneau[4] = strtolower(str_replace(" - ", " à ", $DEF_DIMPM));
	$creneau[5] = strtolower(str_replace(" - ", " à ", $DEF_SAM2AM));
	$creneau[6] = strtolower(str_replace(" - ", " à ", $DEF_SAM2PM));
	$creneau[7] = strtolower(str_replace(" - ", " à ", $DEF_DIM2AM));
	$creneau[8] = strtolower(str_replace(" - ", " à ", $DEF_DIM2PM));
if ($chantier != 0/* AND $bFollow*/){
	$sql_S = 'SELECT * FROM '.$s_tablePrefix.'eceh_hote WHERE id='.$chantier;
	$query = mysql_query($sql_S) or die ("<br>erreur sur : " . $sql_S);  
	if ($data = mysql_fetch_array($query)){
		echo "<br /><p>Détail des inscriptions : [". $data["ordre_aff"] ."] ". $data["nom"] ."</p><ul>";
		$row = "";
		for ($i = 1; $i < 9; $i++){
			$flag = 0;
			$sql2_S = 'SELECT SUM(nb_pers) FROM '.$s_tablePrefix.'eceh_inscription WHERE id_h = '.$data['id'].' AND creneau='.$i;
			$query2 = mysql_query($sql2_S) or die ("<br>erreur sur : " . $sql2_S);  
			if ($data2 = mysql_fetch_array($query2))
			  $total = $data2[0];
			mysql_free_result($query2);
			
			$row = "<div class='level2'><li class='creneau'>" . $creneau[$i] . " (".$total." p.)</li><div class='level1'>";
			$sql3_S = 'SELECT * FROM '.$s_tablePrefix.'eceh_inscription, '.$s_tablePrefix.'eceh_visiteur WHERE id = id_v AND id_h = '.$data['id'].' AND creneau='.$i;
			$query3 = mysql_query($sql3_S) or die ("<br>erreur sur : " . $sql3_S);  
			while ($data3 = mysql_fetch_array($query3)){
			  $flag++;
			  $row .= ucwords($data3['prenom'])." ".strtoupper($data3['nom'])." - ".$data3['nb_pers']." p. (<span class='it'>".$data3['mail'] . " - " . $data3['tel'] ."</span>)<br />";
			}
			mysql_free_result($query3);
			$row .= "</div></div>";
			if ($flag){
				echo $row;
			}
		}
		if(!$flag){
			echo "<div class='level1'>Aucune réservation</div>";
		}
		echo "</ul>";
	mysql_free_result($query);
	}
}elseif($chantier == 0/* AND $bFollow*/){ // tous les lieus
	$sql_S = 'SELECT * FROM '.$s_tablePrefix.'eceh_hote WHERE ordre_aff>0 ORDER BY ordre_aff';
	$query = mysql_query($sql_S) or die ("<br>erreur sur : " . $sql_S);  
	while($data = mysql_fetch_array($query)){
		echo "<br /><p>Détail des inscriptions : [". $data["ordre_aff"] ."] ". $data["nom"] ."</p><ul>";
		$row = "";
		for ($i = 1; $i < 9; $i++){
			$flag = 0;
			$sql2_S = 'SELECT SUM(nb_pers) FROM '.$s_tablePrefix.'eceh_inscription WHERE id_h = '.$data['id'].' AND creneau='.$i;
			$query2 = mysql_query($sql2_S) or die ("<br>erreur sur : " . $sql2_S);  
			if ($data2 = mysql_fetch_array($query2))
			  $total = $data2[0];
			mysql_free_result($query2);
			
			$row = "<div class='level2'><li class='creneau'>" . $creneau[$i] . " (".$total." p.)</li><div class='level1'>";
			$sql3_S = 'SELECT * FROM '.$s_tablePrefix.'eceh_inscription, '.$s_tablePrefix.'eceh_visiteur WHERE id = id_v AND id_h = '.$data['id'].' AND creneau='.$i;
			$query3 = mysql_query($sql3_S) or die ("<br>erreur sur : " . $sql3_S);  
			while ($data3 = mysql_fetch_array($query3)){
			  $flag++;
			  $row .= ucwords($data3['prenom'])." ".strtoupper($data3['nom'])." - ".$data3['nb_pers']." p. (<span class='it'>".$data3['mail'] . " - " . $data3['tel'] ."</span>)<br />";
			}
			mysql_free_result($query3);
			$row .= "</div></div>";
			if ($flag)
			  echo $row;
		}
		echo "</ul>";
	}
	mysql_free_result($query);
}
?>
			</div>
		</div><!-- Fin de #page-contenu -->
	</div><!-- fin DIV #deux-colonnes -->
	<div style="clear: both;"></div>
	<?php	// bouton deconnexion haut et bas
		echo $DEF_DECONNEXION;
	?>	
	</div><!-- fin DIV pour dégradé #conteneur-degrade -->
	<div style="clear: both;"></div>
	<?php
		include ('footerInc.php');
	?>
</div>
</body>
</html>