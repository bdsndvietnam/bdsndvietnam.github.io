<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/

$html_email_file = @file( "html_email.htm" );
$maillist = array( "quangninhads@gmail.com", "quangninhads@gmail.com", "quangninhads@gmail.com" );
( "Chao mung ban", $html_email_file, "sim.choquangninh.com", "quangninhads@gmail.com", $maillist );
$xmail = new semail( );
$xmail->send( );
?>
