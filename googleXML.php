<?php
/*  Copyright 2004  Sameer D'Costa  (email : sameerd1977 at gmail dot com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/
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
