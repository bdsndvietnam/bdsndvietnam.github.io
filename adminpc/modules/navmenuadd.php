<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/


$stv = new Smarty( );
if ( isset( $_POST['submit'] ) )
{
	if ( $_POST['post']['mgr'] == 0 )
	{
		$GLOBALS['_POST']['post']['menu'] = $_POST['menu'];
	}
	else
	{
		$GLOBALS['_POST']['post']['smenu'] = $_POST['menu'];
	}
	if ( $_POST['menu'] == "" )
	{
		echo "<center>Bạn chưa nhập tên menu!<br>";
		echo $back;
		echo "</center>";
		return FALSE;
	}
	if ( $_POST['post']['mmd'] == "" )
	{
		echo "<center>Bạn chưa nhập module cho menu!<br>";
		echo $back;
		echo "</center>";
		return FALSE;
	}
	insert( $_POST['post'], "navmenu" );
}
$q = query( "SELECT navmenu AS tenmuc, mid AS cid FROM navmenu WHERE menu!='' ORDER By mgr" );
while ( $r = fecth( $q ) )
{
	$tenmuc[] = $r['tenmuc'];
	$cid[] = $r['cid'];
}
$stv->assign( "tenmuc", $tenmuc );
$stv->assign( "cid", $cid );
$stv->assign( "select", $_GET['gr'] );
$stv->display( "navmenuadd.htm" );
?>
