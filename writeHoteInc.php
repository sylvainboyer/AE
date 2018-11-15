<?php

	echo '					<div id="map" class="cache">
					<img src="map/c-0.gif" alt="carte des chantiers" />
					<p id="legendeMap">Cliquez sur la carte pour la masquer</p>
				</div>
				<h1>
					<a name="aparticipants" id="aparticipants">Les <span id="nbh">'.$NB_HOTES.'</span> participants :</a>
				</h1>
				<div class="level1">
					<ol id="olparticipants">';
	$sql_S = 'SELECT * FROM '.$s_tablePrefix.'eceh_hote WHERE ordre_aff!=0 ORDER BY ordre_aff';
	$query = mysql_query($sql_S) or die ("<br>erreur sur : " . $sql_S);
	while($data = mysql_fetch_array($query)){
		$dept = substr($data['cp'],0,2);
		// pour chaque créneau
		for($i = 1; $i < 9; ++$i){
			$sql_N = 'SELECT SUM(nb_pers) AS nb FROM '.$s_tablePrefix.'eceh_inscription WHERE id_h='.$data['id'].' AND creneau='.$i;
			$queryN = mysql_query($sql_N) or die ("<br />erreur sur : " . $sql_N);
			if ($dataN = mysql_fetch_row($queryN)){
				$nbP[$i] = $dataN[0] != "" ? $dataN[0] : 0;
			}
		}
		mysql_free_result($queryN);
		echo '			<li class="level1 dpt'.$dept.'" id="p.'.$data['ordre_aff'].'">
					<div class="li participants">
						<span class="numhote">'.$data['ordre_aff'].'</span>
						<span class="hote">'.$data["nom"].'</span>
						<br />
						<div class="ville">'.$data["ville"].'</div>
						<!--<span class="icone-carte" id="ic.'.$data['ordre_aff'].'"></span>-->
						<div class="places">
							<div class="plab">
								places disponibles :
							</div>';
		if($data['placesSamAM'] == 0){
			echo '					<div class="p0">
								sam.'.$DEF_SAM1.' '.$DEF_AM.'h
								<div>nd</div>
							</div>';
		}else{
			echo '					<div class="psam">
								sam.'.$DEF_SAM1.' '.$DEF_AM.'h
								<!--<div>'.$data['placesSamAM'].'</div>-->
								<div>'.($data['placesSamAM'] - $nbP[1]).'</div>
							</div>';
		}
		if($data['placesSamPM'] == 0){
			echo '					<div class="p0">
								sam.'.$DEF_SAM1.' '.$DEF_PM.'h
								<div>nd</div>
							</div>';
		}else{
			echo '					<div class="pspm">
								sam.'.$DEF_SAM1.' '.$DEF_PM.'h
								<div>'.($data['placesSamPM'] - $nbP[2]).'</div>
							</div>';
		}
		if($data['placesDimAM'] == 0){
			echo '					<div class="p0">
								dim.'.$DEF_DIM1.' '.$DEF_AM.'h
								<div>nd</div>
							</div>';
		}else{
			echo '					<div class="pdam">
								dim.'.$DEF_DIM1.' '.$DEF_AM.'h
								<div>'.($data['placesDimAM'] - $nbP[3]).'</div>
							</div>';
		}
		if($data['placesDimPM'] == 0){
			echo '					<div class="p0">
								dim.'.$DEF_DIM1.' '.$DEF_PM.'h
								<div>nd</div>
							</div>';
		}else{
			echo '					<div class="pdpm">
								dim.'.$DEF_DIM1.' '.$DEF_PM.'h
								<div>'.($data['placesDimPM'] - $nbP[4]).'</div>
							</div>';
		}
		if($data['placesSam2AM'] == 0){
			echo '					<div class="p0">
								sam.'.$DEF_SAM2.' '.$DEF_AM.'h
								<div>nd</div>
							</div>';
		}else{
			echo '					<div class="psam">
								sam.'.$DEF_SAM2.' '.$DEF_AM.'h
								<!--<div>'.$data['placesSam2AM'].'</div>-->
								<div>'.($data['placesSam2AM'] - $nbP[5]).'</div>
							</div>';
		}
		if($data['placesSam2PM'] == 0){
			echo '					<div class="p0">
								sam.'.$DEF_SAM2.' '.$DEF_PM.'h
								<div>nd</div>
							</div>';
		}else{
			echo '					<div class="pspm">
								sam.'.$DEF_SAM2.' '.$DEF_PM.'h
								<div>'.($data['placesSam2PM'] - $nbP[6]).'</div>
							</div>';
		}
		if($data['placesDim2AM'] == 0){
			echo '					<div class="p0">
								dim.'.$DEF_DIM2.' '.$DEF_AM.'h
								<div>nd</div>
							</div>';
		}else{
			echo '					<div class="pdam">
								dim.'.$DEF_DIM2.' '.$DEF_AM.'h
								<div>'.($data['placesDim2AM'] - $nbP[7]).'</div>
							</div>';
		}
		if($data['placesDim2PM'] == 0){
			echo '					<div class="p0">
								dim.'.$DEF_DIM2.' '.$DEF_PM.'h
								<div>nd</div>
							</div>';
		}else{
			echo '					<div class="pdpm">
								dim.'.$DEF_DIM2.' '.$DEF_PM.'h
								<div>'.($data['placesDim2PM'] - $nbP[8]).'</div>
							</div>';
		}
		echo '					</div>
					</div>
				</li>';
	}
	echo '
					</ol>
				</div>';
mysql_free_result($query);
?>
