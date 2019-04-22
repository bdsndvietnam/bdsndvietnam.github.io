<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/

if ( !stv_code )
{
	check_code( 0 );
}
if ( $_POST['submit'] && md5( md5( md5( $_POST['pw'] ) ) ) == $adminpass2 )
{
	$_SESSION['giaodich'] = "ok";
}
if ( $_SESSION['giaodich'] != "ok" )
{
	echo "<form method=\"post\">\r\n\t<div style=\"text-align: center\">\r\n\t\t<input name=\"pw\" type=\"password\" /><input name=\"submit\" type=\"submit\" value=\"Login\" /></div>\r\n</form>\r\n";
}
else
{
	
	$svt = new Smarty( );
	if ( $_GET['del'] )
	{
		$q0 = query( "SELECT * FROM navmenu WHERE mgr=".$_GET['del'] );
		if ( mysql_num_rows( $q0 ) < 1 )
		{
			query( "DELETE FROM navmenu WHERE mid=".$_GET['del'] );
		}
	}
	$masp = 20;
	$page = $_GET['page'];
	if ( $page )
	{
		--$page;
	}
	$bg = $masp * $page;
	if ( $_GET['page'] == "" )
	{
		$page = 1;
	}
	else
	{
		$page += 1;
	}
	if ( $_GET['id'] )
	{
		$q = query( "SELECT smenu AS menu, mid, moder, mmd FROM menu WHERE mgr='".$_GET['id'].( "' limit ".$bg.", {$masp}" ) );
		$dem = mysql_num_rows( query( "SELECT smenu AS menu, mid, moder, mmd FROM menu WHERE mgr='".$_GET['id']."'" ) );
	}
	else
	{
		$q = query( "SELECT * FROM navmenu WHERE menu!='' ORDER BY moder limit ".$bg.",{$masp}" );
		$dem = mysql_num_rows( query( "SELECT * FROM navmenu WHERE menu!='' ORDER BY moder" ) );
	}
	if ( $page == 1 )
	{
		$i = 0;
	}
	else
	{
		$i = $bg;
	}
	while ( $r = fecth( $q ) )
	{
		++$i;
		$r['stt'] = $i;
		if ( $i % 2 == 0 )
		{
			$r['class'] = "ui-widget-content";
		}
		else
		{
			$r['class'] = "";
		}
		$data[] = $r;
	}
	mysql_close( );
	$stv->assign( "data", $data );
	$stv->assign( "gid", $_GET['id'] );
	$stv->assign( "paging", paging( $dem, $page, 10, $masp ) );
	$stv->assign( "c_url", $c_url );
	$stv->display( "navmenu.htm" );
}
?>
