<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/

session_start( );
require( "../ovikn.php" );
require( "../func/mysql.php" );
$sql = mysql_query( "SELECT * FROM my_order WHERE id='".$_GET['id']."'" );
$row = mysql_fetch_array( $sql );
echo "<h3 class=\"popupTitle\">Add a new note</h3>\r\n\r\n<!-- The preview: -->\r\n<div id=\"previewNote\" class=\"note yellow\" style=\"left:0;top:65px;z-index:1\">\r\n\t<div class=\"body\"></div>\r\n\t<div class=\"author\"></div>\r\n\t<span class=\"data\"></span>\r\n</div>\r\n\r\n<div id=\"noteData\"> <!-- Holds the form -->\r\n<form action=\"\" method=\"post\" class=\"note-form\">\r\n\r\n<label for=\"note-body\">Text of the note</label>\r\n<textarea name=\"note-body\" id=\"note-body\" class=\"pr-body\" cols=\"40\" rows=\"2\"></textarea>\r\n\r\n<input type=\"hidden\" name=\"note-name\" id=\"note-name\" class=\"pr-author\" value=\"Sim:";
echo $row['sosim'];
echo " - Khách:";
echo $row['dienthoai'];
echo "-";
echo $_SESSION['username'];
echo "\" />\r\n<input type=\"hidden\" name=\"note-mid\" id=\"note-mid\" value=\"";
echo $_GET['id'];
echo "\" class=\"pr-mid\" />\r\n\r\n<label>Color</label> <!-- Clicking one of the divs changes the color of the preview -->\r\n<div class=\"color yellow\"></div>\r\n<div class=\"color blue\"></div>\r\n<div class=\"color green\"></div>\r\n\r\n<!-- The green submit button: -->\r\n<a id=\"note-submit\" href=\"\" class=\"green-button\">Submit</a>\r\n\r\n</form>\r\n</div>\r\n";
?>
