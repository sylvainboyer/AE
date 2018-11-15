<?php
// define
function isSunday($creneau) {
	return $creneau > 2 ? true : false;
}

function isSaturday($creneau) {
	return $creneau < 3 ? true : false;
}

// transforme la chaine : UPPER
function nom($chaine) {
	return mb_strtoupper($chaine, mb_detect_encoding($chaine));
}

// transforme la chaine : maj en debut de chq mot
function prenom($chaine) {
	return mb_convert_case($chaine, MB_CASE_TITLE, mb_detect_encoding($chaine));
}

function lower($str){
  debug($str);              
  $new = strtr($str,
              "AZERTYUIOPQSDFGHJKLMWXCVBNÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜİ",
              "azertyuiopqsdfghjklmwxcvbnaaaaaaæçeeeeiiiiooooouuuuy");
  debug($new);              
  return $new;
}

function lowerNoAccent($str){
  debug($str);              
  $new = strtr(ucwords($str),
              "AZERTYUIOPQSDFGHJKLMWXCVBNÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜİ",
              "azertyuiopqsdfghjklmwxcvbnaaaaaaaceeeeiiiiooooouuuuy");
  debug($new);              
  return $new;
}

function upper($str){
  return strtr($str,
              "azertyuiopqsdfghjklmwxcvbnàáâãäåæçèéêëìíîïòóôõöùúûüı",
              "AZERTYUIOPQSDFGHJKLMWXCVBNÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜİ");
}

function upperNoAccent($str){
  debug($str);              
  $new = strtr($str,
              "azertyuiopqsdfghjklmwxcvbnàáâãäåæçèéêëìíîïòóôõöùúûüı",
              "AZERTYUIOPQSDFGHJKLMWXCVBNAAAAAAACEEEEIIIIOOOOOUUUUY");
  debug($new);              
  return $new;
}

function removeAccent($var) {
	$modif = str_replace(
			array(
					utf8_decode('à'), utf8_decode('â'), utf8_decode('ä'), utf8_decode('á'), utf8_decode('ã'), utf8_decode('å'),
					utf8_decode('î'), utf8_decode('ï'), utf8_decode('ì'), utf8_decode('í'), 
					utf8_decode('ô'), utf8_decode('ö'), utf8_decode('ò'), utf8_decode('ó'), utf8_decode('õ'), utf8_decode('ø'), 
					utf8_decode('ù'), utf8_decode('û'), utf8_decode('ü'), utf8_decode('ú'), 
					utf8_decode('é'), utf8_decode('è'), utf8_decode('ê'), utf8_decode('ë'), 
					utf8_decode('ç'), utf8_decode('ÿ'), utf8_decode('ñ'),
					utf8_decode('À'), utf8_decode('Â'), utf8_decode('Ä'), utf8_decode('Á'), utf8_decode('Ã'), utf8_decode('Å'),
					utf8_decode('Î'), utf8_decode('Ï'), utf8_decode('Ì'), utf8_decode('Í'), 
					utf8_decode('Ô'), utf8_decode('Ö'), utf8_decode('Ò'), utf8_decode('Ó'), utf8_decode('Õ'), utf8_decode('Ø'), 
					utf8_decode('Ù'), utf8_decode('Û'), utf8_decode('Ü'), utf8_decode('Ú'), 
					utf8_decode('É'), utf8_decode('È'), utf8_decode('Ê'), utf8_decode('Ë'), 
					utf8_decode('Ç'), utf8_decode('Ÿ'), utf8_decode('Ñ'), 
			),
			array(
					'a', 'a', 'a', 'a', 'a', 'a', 
					'i', 'i', 'i', 'i', 
					'o', 'o', 'o', 'o', 'o', 'o', 
					'u', 'u', 'u', 'u', 
					'e', 'e', 'e', 'e', 
					'c', 'y', 'n', 
					'A', 'A', 'A', 'A', 'A', 'A', 
					'I', 'I', 'I', 'I', 
					'O', 'O', 'O', 'O', 'O', 'O', 
					'U', 'U', 'U', 'U', 
					'E', 'E', 'E', 'E', 
					'C', 'Y', 'N', 
			),$var);
	$var=utf8_encode($modif);
	return $var;
}
?>