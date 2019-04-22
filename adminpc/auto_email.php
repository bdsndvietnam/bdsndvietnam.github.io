<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/

$html_email_file = @file( "html_email.htm" );
require( "../func/email.php" );
$maillist = array( "vthy08@yahoo.com", "sale@raobansim.com", "nganhangsimsodep.com@gmail.com" );
semail::semail( "Chao mung ban", $html_email_file, "Sodep 123.com", "sale@sodep123.com", $maillist );
$xmail->send( );
?>
