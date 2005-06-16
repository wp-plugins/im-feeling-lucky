<?php
extract($_GET);
$ss = "http://www.google.com/search?hl=en&q=" . 
	urlencode($s) . "&btnI=I\'m+Feeling+Lucky";
$ch = curl_init();
//$timeout = 0; // set to zero for no timeout
curl_setopt ($ch, CURLOPT_URL, $ss);
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla');
curl_setopt($ch, CURLOPT_NOBODY, 1);
//curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
$file_contents = curl_exec($ch);
curl_close($ch);
$pieces = explode("\r", $file_contents);
$anotherPiece = explode(" ", $pieces[1]);

$xml = "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n";
$xml .= "<note>\n";
$xml .= "<body>"  . $anotherPiece[1] . "</body>\n";
$xml .= "</note>";
//echo $xml;
echo $anotherPiece[1];
?>
