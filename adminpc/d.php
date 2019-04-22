<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/

header( "Content-type: application/html" );
header( "Content-Disposition: attachment;filename=".$_GET['file'] );
header( "Pragma: no-cache" );
header( "Expires: 0" );
readfile( $_GET['file'] );
echo "\t";
?>
