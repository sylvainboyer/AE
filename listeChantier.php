<?php
header("Content-Type: text/xml");
echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
echo "<list>\n";
echo "\t<select id=\"creneau\" />\n";
include ('dbInc.php');
$idHo = (isset($_POST["IdH"])) ? htmlentities($_POST["IdH"]) : NULL;
if ($idHo > 0) {
    $query = mysql_query('SELECT * FROM '.$s_tablePrefix.'eceh_hote WHERE id='.mysql_real_escape_string($idHo).' ORDER BY ordre_aff');
	//"SELECT * FROM ajax_example_softwares WHERE idEditor=" . mysql_real_escape_string($idEditor) . " ORDER BY name");
    while ($back = mysql_fetch_assoc($query)) {
		if($back['placesSamAM'] != 0){
        	echo "	<item id=\"1\" val=\"Samedi 1er - 10h\" />\n";
		}
		if($back['placesSamPM'] != 0){
        	echo "	<item id=\"2\" val=\"Samedi 1er - 15h\" />\n";
		}
		if($back['placesDimAM'] != 0){
        	echo "	<item id=\"3\" val=\"Dimanche 2 - 10h\" />\n";
		}
		if($back['placesDimPM'] != 0){
        	echo "	<item id=\"4\" val=\"Dimanche 2 - 15h\" />\n";
		}
		if($back['placesSam2AM'] != 0){
        	echo "	<item id=\"5\" val=\"Samedi 8 - 10h\" />\n";
		}
		if($back['placesSam2PM'] != 0){
        	echo "	<item id=\"6\" val=\"Samedi 8 - 15h\" />\n";
		}
		if($back['placesDim2AM'] != 0){
        	echo "	<item id=\"7\" val=\"Dimanche 9 - 10h\" />\n";
		}
		if($back['placesDim2PM'] != 0){
        	echo "	<item id=\"8\" val=\"Dimanche 9 - 15h\" />\n";
		}
    }
	mysql_free_result($query);
} else {
	echo "\t<item id=\"1\" val=\"Samedi 1<sup>er</sup> - 10h\" />\n";
	echo "\t<item id=\"2\" val=\"Samedi 1<sup>er</sup> - 15h\" />\n";
	echo "\t<item id=\"3\" val=\"Dimanche 2 - 10h\" />\n";
	echo "\t<item id=\"4\" val=\"Dimanche 2 - 15h\" />\n";
	echo "\t<item id=\"5\" val=\"Samedi 8 - 10h\" />\n";
	echo "\t<item id=\"6\" val=\"Samedi 8 - 15h\" />\n";
	echo "\t<item id=\"7\" val=\"Dimanche 9 - 10h\" />\n";
	echo "\t<item id=\"8\" val=\"Dimanche 9 - 15h\" />\n";
}
echo "</list>";
?>