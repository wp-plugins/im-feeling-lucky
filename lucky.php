<?php
/*
Plugin Name: I'm Feeling Lucky quicktag
Plugin URI: http://dcostanet.net/wordpress/2005/06/09/im-feeling-lucky/
Description: This plugin creates a quicktag button which takes some text and creates a link to the first link in google's search
Version: 1.0
Author: Sameer D'Costa
Author URI: http://dcostanet.net/wordpress

This plugin is a simple modification of Owen Winkler's
http://www.asymptomatic.net quicktag button template downloaded from
http://redalt.com/downloads/
*/ 

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

add_filter('admin_footer', 'google_tag');

function google_tag()
{
	if(strpos($_SERVER['REQUEST_URI'], 'post.php'))
	{
?>
<script language="JavaScript" type="text/javascript"><!--
var toolbar = document.getElementById("ed_toolbar");

var xmlhttp;
var dacanvas;
var mywhatToPut;
var myGoogleHandler = "<?php echo get_settings('siteurl') . '/wp-content/plugins/lucky/googleXML.php'; ?>";

function loadXMLDoc(url)
{
// code for Mozilla, etc.
if (window.XMLHttpRequest)
  {
  xmlhttp=new XMLHttpRequest()
  xmlhttp.onreadystatechange=xmlhttpChange
  xmlhttp.open("GET",url,true)
  xmlhttp.send(null)
  }
// code for IE
else if (window.ActiveXObject)
  {
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP")
    if (xmlhttp)
    {
    xmlhttp.onreadystatechange=xmlhttpChange
    xmlhttp.open("GET",url,true)
    xmlhttp.send()
    }
  }
}

function xmlhttpChange()
{
if (xmlhttp.readyState==4)
  {
  if (xmlhttp.status==200)
    {
edInsertContent(dacanvas, "<a href=\"" + xmlhttp.responseText + "\">" + mywhatToPut + "</a>");
mywhatToPut = '';
    }
  else
    {
    alert("Problem retrieving XML data")
    }
  }
}

function edGoog(myField) {
        var word = '';
	dacanvas = myField;
        if (document.selection) {
                myField.focus();
            var sel = document.selection.createRange();
                if (sel.text.length > 0) {
                        word = sel.text;
                }
        }
        else if (myField.selectionStart || myField.selectionStart == '0') {
                var startPos = myField.selectionStart;
                var endPos = myField.selectionEnd;
                if (startPos != endPos) {
                        word = myField.value.substring(startPos, endPos);
                }       
        }       
        if (word == '') {
                word = prompt('Enter a word or phrase to look up:', '');
        }                   
        if (word !== null ) {
	loadXMLDoc(myGoogleHandler + '?s=' + escape(word));
	mywhatToPut = word;	
        }
}


<?php

edit_insert_button("Lucky", "my_button_handler", "I'm feeling Lucky", "k");
	
?>

function my_button_handler()
{

	edGoog(edCanvas);

}

//--></script>
<?php
	}
}

if(!function_exists('edit_insert_button'))
{
	

	//edit_insert_button: Inserts a button into the editor
	function edit_insert_button($caption, $js_onclick, $title = '', $access = '')
	{
	?>
	if(toolbar)
	{
		var theButton = document.createElement('input');
		theButton.type = 'button';
		theButton.value = '<?php echo $caption; ?>';
		theButton.onclick = <?php echo $js_onclick; ?>;
		theButton.className = 'ed_button';
		theButton.accessKey = '<?php echo $access; ?>';
		theButton.title = "<?php echo $title; ?>";
		theButton.id = "<?php echo "ed_{$caption}"; ?>";
		toolbar.appendChild(theButton);

	}
	<?php

	}
}


?>
