<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/


$stv = new Smarty( );
include( "mysql_backup.class.php" );
$db_host = $dbhost;
$db_name = $dbname;
$db_user = $dbuser;
$db_pass = $dbpass;
$output = date( "d_m_Y" )."_backup.sql";
$structure_only = FALSE;
( $db_host, $db_name, $db_user, $db_pass, $output, $structure_only );
$backup = new mysql_backup( );
if ( $_GET['ac'] == "r" )
{
	$backup->restore( );
}
else
{
	$backup->backup( );
}
?>
