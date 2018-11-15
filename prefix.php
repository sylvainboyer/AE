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
              "AZERTYUIOPQSDFGHJKLMWXCVBN��������������������������",
              "azertyuiopqsdfghjklmwxcvbnaaaaaa��eeeeiiiiooooouuuuy");
  debug($new);              
  return $new;
}

function lowerNoAccent($str){
  debug($str);              
  $new = strtr(ucwords($str),
              "AZERTYUIOPQSDFGHJKLMWXCVBN��������������������������",
              "azertyuiopqsdfghjklmwxcvbnaaaaaaaceeeeiiiiooooouuuuy");
  debug($new);              
  return $new;
}

function upper($str){
  return strtr($str,
              "azertyuiopqsdfghjklmwxcvbn��������������������������",
              "AZERTYUIOPQSDFGHJKLMWXCVBN��������������������������");
}

function upperNoAccent($str){
  debug($str);              
  $new = strtr($str,
              "azertyuiopqsdfghjklmwxcvbn��������������������������",
              "AZERTYUIOPQSDFGHJKLMWXCVBNAAAAAAACEEEEIIIIOOOOOUUUUY");
  debug($new);              
  return $new;
}

function removeAccent($var) {
	$modif = str_replace(
			array(
					utf8_decode('�'), utf8_decode('�'), utf8_decode('�'), utf8_decode('�'), utf8_decode('�'), utf8_decode('�'),
					utf8_decode('�'), utf8_decode('�'), utf8_decode('�'), utf8_decode('�'), 
					utf8_decode('�'), utf8_decode('�'), utf8_decode('�'), utf8_decode('�'), utf8_decode('�'), utf8_decode('�'), 
					utf8_decode('�'), utf8_decode('�'), utf8_decode('�'), utf8_decode('�'), 
					utf8_decode('�'), utf8_decode('�'), utf8_decode('�'), utf8_decode('�'), 
					utf8_decode('�'), utf8_decode('�'), utf8_decode('�'),
					utf8_decode('�'), utf8_decode('�'), utf8_decode('�'), utf8_decode('�'), utf8_decode('�'), utf8_decode('�'),
					utf8_decode('�'), utf8_decode('�'), utf8_decode('�'), utf8_decode('�'), 
					utf8_decode('�'), utf8_decode('�'), utf8_decode('�'), utf8_decode('�'), utf8_decode('�'), utf8_decode('�'), 
					utf8_decode('�'), utf8_decode('�'), utf8_decode('�'), utf8_decode('�'), 
					utf8_decode('�'), utf8_decode('�'), utf8_decode('�'), utf8_decode('�'), 
					utf8_decode('�'), utf8_decode('�'), utf8_decode('�'), 
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