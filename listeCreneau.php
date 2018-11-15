<?php
header("Content-Type: text/xml");
echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
echo "<list>\n";
echo "\t<select id=\"chantier\" />\n";
include ('dbInc.php');
$idCr = (isset($_POST["IdC"])) ? htmlentities($_POST["IdC"]) : NULL;
if ($idCr >= 0) {
	/*$field = "places";
	$field += $idCr == 1 ? "SamAM" : ($idCr == 2 ? "SamPM" : ($idCr == 3 ? "DimAM" : ($idCr == 4 ? "DimPM" : "")));*/
	switch($idCr){
		case 0:
			$where = "WHERE 1";
			break;
		case 1:
			$where = "WHERE placesSamAM>0";
			break;
		case 2:
			$where = "WHERE placesSamPM>0";
			break;
		case 3:
			$where = "WHERE placesDimAM>0";
			break;
		case 4:
			$where = "WHERE placesDimPM>0";
			break;
		case 5:
			$where = "WHERE placesSam2AM>0";
			break;
		case 6:
			$where = "WHERE placesSam2PM>0";
			break;
		case 7:
			$where = "WHERE placesDim2AM>0";
			break;
		case 8:
			$where = "WHERE placesDim2PM>0";
			break;
		default:
			$where = "WHERE 1";
			return;
	}
    //echo $idCr.' - SELECT * FROM '.$s_tablePrefix.'eceh_hote WHERE '.$field.'!=0 ORDER BY id';
    $query = mysql_query('SELECT * FROM '.$s_tablePrefix.'eceh_hote '.$where.' AND ordre_aff>0 ORDER BY ordre_aff');
    while ($back = mysql_fetch_assoc($query)) {
        echo "\t<item id=\"" . $back["id"] . "\" val=\"" . $back["ordre_aff"] . ". " . $back["nom"] . "\" />\n";
    }
	mysql_free_result($query);
}
echo "</list>";
?>