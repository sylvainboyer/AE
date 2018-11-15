<?php
function gzip($file){
	ob_start('ob_gzhandler');
	//$file = isset($_GET['f']) ? $_GET['f'] : null;
	$extension=pathinfo($file,PATHINFO_EXTENSION);
	switch($extension){
		case 'css':
			header("Content-type: text/css");
			include($file);
			echo "<script type='text/javascript'>alert('Fichier ".$file." incorporé');</script>";
			break;
		case 'js':
			header("Content-type: application/x-javascript");
			include($file);
			echo "<script type='text/javascript'>alert('Fichier ".$file." incorporé');</script>";
			break;
		default:
			return;
	}
}
?>