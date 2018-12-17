<?php
//$s_tablePrefix = strval(idate("Y"))."_";
$s_tablePrefix = "2014_";
if  ($_SERVER["HTTP_HOST"] == "localhost") { // $_SERVER["HTTP_HOST"] == "localhost"
	$s_server = "localhost";
	$s_login = "eceh";
	$s_passwd = "2014ecoh";
	$database = "eceh";
} else {
	$s_server = "sql01.ouvaton.coop";
	$s_login = "01777_eceh";
	$s_passwd = "2014ecoh";
	$database = "01777_eceh";
}
/*  *************   ANCIENNE METHODE REQUETE SQL
$connexion = @mysql_connect($s_server,$s_login,$s_passwd) or
	die ("Impossible de se connecter au serveur MySQL:$s_server sur ".$_SERVER["HTTP_NAME"].".");
$db = @mysql_selectdb($database) or
	die ("Impossible d'accéder à la base $database.");
mysql_query("SET NAMES 'utf8'");
mysql_query("SET CHARACTER SET utf8");
mysql_query("SET COLLATION_CONNECTION = 'utf8_unicode_ci'");
*/
/*

// Récupération du nombre d'hotes
$sql_C = 'SELECT COUNT(*) FROM '.$s_tablePrefix.'eceh_hote WHERE ordre_aff>0';
$query_C = mysql_query($sql_C) or die ("<br />erreur sur : " . $sql_C);
while($data_C = mysql_fetch_array($query_C)){
	$NB_HOTES = $data_C['COUNT(*)'];
}
mysql_free_result($query_C);

// Récupération des paramètres
$sql_P = 'SELECT * FROM '.$s_tablePrefix.'eceh_params';
$query_P = mysql_query($sql_P) or die ("<br />erreur sur : " . $sql_P);
if($data_P = mysql_fetch_array($query_P)){
	$DATE_DEB_INSCR = strtotime($data_P['date_deb_inscr']);
	$DATE_FIN_INSCR = strtotime($data_P['date_fin_inscr']);
	$INSCR_OUV = $data_P['inscr_ouv'];
}
mysql_free_result($query_P);
*/


try
{
  $bdd = new PDO('mysql:host='.$s_server.";dbname=$database;charset=utf8", $s_login, $s_passwd);
}

catch (Exception $e)
{
  die('Erreur : ' . $e->getMessage());
}


// Récupération du nombre d'hotes
$sql_C = 'SELECT COUNT(*) FROM '.$s_tablePrefix.'eceh_hote WHERE ordre_aff>0';
$query_C = $bdd->query($sql_C);
if($data_C = $query_C->fetch()){
	$NB_HOTES = $data_C['COUNT(*)'];
}
$query_C->closeCursor();

// Récupération des paramètres
$sql_P = 'SELECT * FROM '.$s_tablePrefix.'eceh_params';
$query_P = $bdd->query($sql_P);
if($data_P = $query_P->fetch()){
	$DATE_DEB_INSCR   = strtotime($data_P['date_deb_inscr']);
	$DATE_FIN_INSCR   = strtotime($data_P['date_fin_inscr']);
  $SAMEDI_1         = strtotime($data_P['samedi_1']);
	$DIMANCHE_1       = strtotime($data_P['dimanche_1']);
	$SAMEDI_2         = strtotime($data_P['samedi_2']);
	$DIMANCHE_2       = strtotime($data_P['dimanche_2']);
	$SAMEDI_3         = strtotime($data_P['samedi_3']);
	$DIMANCHE_3       = strtotime($data_P['dimanche_3']);

	$INSCR_OUV        = $data_P['inscr_ouv'];
	$DEF_AM           = $data_P['heure_creneau_matin'];
	$DEF_PM           = $data_P['heure_creneau_apres_midi'];
}
$query_P->closeCursor();

// TUTO SQL - requetes preparees quand parametres variables
//$req = $bdd->prepare('SELECT nom FROM jeux_video WHERE possesseur = ? AND prix <= ?');
//$req->execute(array($_GET['possesseur'], $_GET['prix_max']));

?>
