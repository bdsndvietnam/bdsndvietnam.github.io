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
if ( !stv_code )
{
	check_code( 0 );
}
if ( 432000 < time( ) - $_SESSION['time'] )
{
	header( "Location: logincheck.php?act=logoff" );
}
if ( $_SESSION['admin'] != "ok" )
{
	header( "Location: logincheck.php?act=logoff" );
}
require( "../ovikn.php" );
require( "../libs/Smarty.class.php" );
require( "../func/mysql.php" );
require( "../func/email.php" );
require( "../func/paging.php" );
require( "../func/xoadau.php" );
$act = $_GET['act'];
if ( $act == "" || $act == NULL )
{
	$act = "xhome";
}
if ( file_exists( "modules/".$act.".php" ) )
{
	require( "header.php" );
	require( "modules/".$act.".php" );
	require( "footer.php" );
}
else
{
	echo "<center><b>Lỗi! :File: ";
	echo $act;
	echo ".php không tồn tại!</b></center>";
}
?>
