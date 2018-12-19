<?php

$time = date("D, d M Y H:i:s");
$time = " [".$time."] ";

//ip du client 
$ip = $_SERVER['REMOTE_ADDR'];

//page visite
$url = $_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF'];

//url de provenance
if(IsSet($_SERVER['HTTP_REFERER']))
	$url_provenance = $_SERVER['HTTP_REFERER'];
else $url_provenance = "direct";

//User Agent = Navigateur + OS 
$referer = urldecode(getenv("HTTP_USER_AGENT"));

$event = $ip.$time. "\"" .$url. "\" " .http_response_code(). " \"" .$url_provenance. "\" \"".$referer."\" \n";

// Ecrit $event dans le fichier
// FILE_APPEND pour rajouter à la suite du fichier
// LOCK_EX pour empêcher quiconque d'autre d'écrire dans le fichier en même temps
file_put_contents("../fichier.log", $event, FILE_APPEND  | LOCK_EX);

?>
