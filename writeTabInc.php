<?php
// ecriture js
$tab_js_F = fopen('./js/tab.js', 'w+');

ftruncate($tab_js_F, 0); // On vide le fichier
fseek($tab_js_F, 0); // On remet le curseur au d�but du fichier
$a_S = "//!! generation automatique\n";
fputs($tab_js_F, $a_S);

// variables globales
//$a_S = 'var g_a_hotes'."\n".'g_a_hotes = new Array'."\n";
$a_S = 'g_a_hotes = new Array;'."\n";
fputs($tab_js_F, $a_S);

//$a_S = 'var g_a_visiteurs'."\n".'g_a_visiteurs = new Array'."\n";
$a_S = 'g_a_visiteurs = new Array;'."\n";
fputs($tab_js_F, $a_S);


$sql_S = 'SELECT * FROM '.$s_tablePrefix.'eceh_visiteur ORDER BY id';
$query = $bdd->query($sql_S);

while($data = $query->fetch()){

	$h[1] = 0;
	$h[2] = 0;
	$h[3] = 0;
	$h[4] = 0;
	$h[5] = 0;
	$h[6] = 0;
	$h[7] = 0;
	$h[8] = 0;
	$nb[1] = 0;
	$nb[2] = 0;
	$nb[3] = 0;
	$nb[4] = 0;
	$nb[5] = 0;
	$nb[6] = 0;
	$nb[7] = 0;
	$nb[8] = 0;

	$sql2_S = 'SELECT * FROM '.$s_tablePrefix.'eceh_inscription WHERE id_v='.$data['id'];
	$query2 = $bdd->query($sql2_S) or die ("<br>erreur sur : " . $sql2_S);
	while ($data2 = $query2->fetch()){
		if ($data2['nb_pers'] > 0){
			$h[$data2['creneau']] = $data2['id_h'];
			$nb[$data2['creneau']] = $data2['nb_pers'];
		}
	}
  $query2->closeCursor();
	$a_S = 'g_a_visiteurs[g_a_visiteurs.length] = createVisiteur('.$data['id'].', "'.$data['nom'].'"';
	for ($i = 1; $i < 9; $i++){
		$a_S .= ', '.$h[$i];
	}
	for ($i = 1; $i < 9; $i++){
		$a_S .= ', '.$nb[$i];
	}
	$a_S .= ')'.";\n";
	fputs($tab_js_F, $a_S);

}
$query->closeCursor();


/******************** OLD
$query = mysql_query($sql_S) or die ("<br>erreur sur (8) : " . $sql_S);
while ($data = mysql_fetch_array($query)){
	$h[1] = 0;
	$h[2] = 0;
	$h[3] = 0;
	$h[4] = 0;
	$h[5] = 0;
	$h[6] = 0;
	$h[7] = 0;
	$h[8] = 0;
	$nb[1] = 0;
	$nb[2] = 0;
	$nb[3] = 0;
	$nb[4] = 0;
	$nb[5] = 0;
	$nb[6] = 0;
	$nb[7] = 0;
	$nb[8] = 0;

	$sql2_S = 'SELECT * FROM '.$s_tablePrefix.'eceh_inscription WHERE id_v='.$data['id'];
	$query2 = mysql_query($sql2_S) or die ("<br>erreur sur : " . $sql2_S);
	while ($data2 = mysql_fetch_array($query2)){
		if ($data2['nb_pers'] > 0){
			$h[$data2['creneau']] = $data2['id_h'];
			$nb[$data2['creneau']] = $data2['nb_pers'];
		}
	}
	mysql_free_result($query2);
	$a_S = 'g_a_visiteurs[g_a_visiteurs.length] = createVisiteur('.$data['id'].', "'.$data['nom'].'"';
	for ($i = 1; $i < 9; $i++){
		$a_S .= ', '.$h[$i];
	}
	for ($i = 1; $i < 9; $i++){
		$a_S .= ', '.$nb[$i];
	}
	$a_S .= ')'.";\n";
	fputs($tab_js_F, $a_S);
}
   **************/


/*g_a_hotes[g_a_hotes.length] = createHote(1, "mathieu sabin", 10)
g_a_hotes[g_a_hotes.length] = createHote(2, "stephane artous", 20)
g_a_hotes[g_a_hotes.length] = createHote(3, "didier chevreux", 15)

g_a_visiteurs[g_a_visiteurs.length] = createVisiteur(0, "jb jamin", 0, 1, 0, 2, 0, 2, 0, 2)
g_a_visiteurs[g_a_visiteurs.length] = createVisiteur(0, "a cheneveau", 0, 1, 0, 3, 0, 1, 0, 1)*/

$sql_S = 'SELECT * FROM '.$s_tablePrefix.'eceh_hote WHERE ordre_aff>0 ORDER BY ordre_aff';
$query = $bdd->query($sql_S);
while ($data = $query->fetch()) {
	$a_S = 'g_a_hotes[g_a_hotes.length] = createHote('.$data['ordre_aff'].', "'.$data['nom'].'", '.$data['placesSamAM'].', '.$data['placesSamPM'].', '.$data['placesDimAM'].', '.$data['placesDimPM'].', '.$data['placesSam2AM'].', '.$data['placesSam2PM'].', '.$data['placesDim2AM'].', '.$data['placesDim2PM'].', "'.$data['photo'].'", '.$data['nb_photo'].', ';
	$a_S .= '[';
	$sql_L = 'SELECT id, id_hote, fichier, legende FROM '.$s_tablePrefix.'eceh_photo WHERE id_hote="'.$data['id'].'" ORDER BY fichier';
	$query_L = $bdd->query($sql_L) or die ("<br>erreur sur : " . $sql_L);
	while ($datal = $query_L->fetch()) {
		$a_S .= '"' . addslashes(rtrim($datal['legende'])) . '",';
	}
	$query_L->closeCursor();
	if($data['nb_photo'] > 0) {
		$a_S = substr($a_S, 0, strlen($a_S)-1);
	}
	$a_S .= ']';
	$a_S .= ', '.$data["id"].');'."\n";
	/*Start hiding from IE Mac \*/
	fputs($tab_js_F, $a_S);
	/*Stop hiding from IE Mac */
}
$query->closeCursor();
fclose($tab_js_F);
?>
