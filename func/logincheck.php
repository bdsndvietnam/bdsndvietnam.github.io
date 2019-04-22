<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/

session_start( );
require( "./ovikn.php" );
require( "./func/mysql.php" );
require( "./func/xoadau.php" );
if ( $_POST['submit'] )
{
	$pass = md5( md5( md5( $_POST['y'] ) ) );
	$sql = mysql_query( "SELECT * FROM thanhvien WHERE (username='".$_POST['x']."' AND password='{$pass}') AND live > 0" );
	if ( 0 < mysql_num_rows( $sql ) )
	{
		$_SESSION['mod'] = "ok";
		$_SESSION['username'] = $_POST['x'];
		$_SESSION['time'] = time( );
		$row = mysql_fetch_array( $sql );
		$_SESSION['daily'] = $row['id'];
		if ( $row['live'] == 2 )
		{
			$_SESSION['admin'] = "ok";
			$_SESSION['pt'] = $row['pt'];
		}
		if ( $_POST['x'] == "admin" )
		{
			$_SESSION['admins'] = 1;
		}
		ob_clean( );
		header( "Location: index.php" );
	}
	else
	{
		header( "Location: login.htm" );
	}
}
if ( $_GET['act'] == "logoff" )
{
	ob_clean( );
	unset( $_SESSION['mod'] );
	unset( $_SESSION['username'] );
	unset( $_SESSION['time'] );
	unset( $_SESSION['admin'] );
	unset( $_SESSION['daily'] );
	session_destroy( );
	header( "Location: login.htm" );
}
?>
