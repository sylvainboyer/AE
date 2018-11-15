<?php
//  include ('utils/unicode.php');
  
/*
if($_SERVER["SERVER_NAME"] == "wipe.yiibee.free.fr")
{
	$db = new PDO('mysql:host=sql.free.fr;dbname=wipe.yiibee', 'wipe.yiibee', '858cdy8u');
}
else
{
  $db = new PDO('mysql:host=localhost;dbname=eceh', 'root', '');
}

  if ($_SERVER["SERVER_NAME"] == "wipe.yiibee.free.fr")
  {
    $s_server = "sql.free.fr";
    $s_login = "wipe.yiibee";
    $s_passwd = "858cdy8u";
    $database = "wipe.yiibee";
  }
  else  // $_SERVER["HTTP_HOST"] == "localhost"
  {
    date_default_timezone_set('Europe/Belgrade');
    $s_server = "localhost";
    $s_login = "root";
    $s_passwd = "";
    $database = "eceh";
  }
 
  $s_tablePrefix = "";
  
  $connexion = @mysql_connect($s_server,$s_login,$s_passwd) or  
             die ("Impossible de se connecter au serveur MySQL:$s_server sur ".$_SERVER["HTTP_NAME"].".");
  $db = @mysql_selectdb($database) or 
  	     die ("Impossible d'accéder à la base $database.");
*/

//$sql_S = 'SELECT DISTINCT(mail) FROM `'.$s_tablePrefix.'eceh_visiteur` WHERE NOT mail LIKE `06%`';

include ('dbInc.php');

$sql_S = "SELECT DISTINCT(mail) FROM `".$s_tablePrefix."eceh_visiteur` WHERE NOT mail LIKE '06%' AND NOT mail LIKE '02%' AND mail != '' AND NOT mail LIKE '?%' ORDER BY mail";
  $query = mysql_query($sql_S) or die ("<br>erreur sur : " . $sql_S);  
  if ($data = mysql_fetch_array($query))
    $url_S = $data['mail'];
  while ($data = mysql_fetch_array($query))
  {
    $url_S .= ", ".$data['mail'];
  }
echo $url_S;

$sql_S = "SELECT count(DISTINCT(mail)) FROM `".$s_tablePrefix."eceh_visiteur` WHERE NOT mail LIKE '06%' AND NOT mail LIKE '02%' AND mail != '' AND NOT mail LIKE '?%' ORDER BY mail";
  $query = mysql_query($sql_S) or die ("<br>erreur sur : " . $sql_S);  
  if ($data = mysql_fetch_row($query))
    $url_S = $data[0];
    
echo "<br><br><br>".$url_S." adresses.";

mysql_free_result($query);
?>