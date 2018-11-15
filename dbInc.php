<?php
//$s_tablePrefix = strval(idate("Y"))."_";
$s_tablePrefix = "2014_";
if ($_SERVER["SERVER_NAME"] == "oliduha.free.fr") {
	$s_server = "sql.free.fr";
	$s_login = "oliduha";
	$s_passwd = "di4cent6";
	$database = "oliduha";
}else if  ($_SERVER["HTTP_HOST"] == "localhost") { // $_SERVER["HTTP_HOST"] == "localhost"
	$s_server = "localhost";
	$s_login = "oliduha";
	$s_passwd = "di4cent6";
	$database = "eceh";
} else {
	$s_server = "sql01.ouvaton.coop";
	$s_login = "01777_eceh";
	$s_passwd = "2014ecoh";
	$database = "01777_eceh";
}
$connexion = @mysql_connect($s_server,$s_login,$s_passwd) or
	die ("Impossible de se connecter au serveur MySQL:$s_server sur ".$_SERVER["HTTP_NAME"].".");
$db = @mysql_selectdb($database) or
	die ("Impossible d'accéder à la base $database.");
mysql_query("SET NAMES 'utf8'");
mysql_query("SET CHARACTER SET utf8");
mysql_query("SET COLLATION_CONNECTION = 'utf8_unicode_ci'");

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
?>
