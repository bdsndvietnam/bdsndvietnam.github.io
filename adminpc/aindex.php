<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/

session_start( );
define( "wwwdir", "../" );
if ( $_SESSION['mod'] == "" )
{
	header( "Location: login.htm" );
}
if ( 3600 < time( ) - $_SESSION['time'] )
{
	header( "Location: login.htm" );
}
require( "../ovikn.php" );
require( "../libs/Smarty.class.php" );
require( "../func/mysql.php" );
require( "../func/paging.php" );
$act = $_GET['act'];
if ( $act == "" || $act == NULL )
{
	$act = "xhome";
}
if ( file_exists( "modules/".$act.".php" ) )
{
	require( "modules/".$act.".php" );
}
else
{
	echo "<center><b>Lỗi! :File: ";
	echo $act;
	echo ".php không tồn tại!</b></center>";
}
?>
