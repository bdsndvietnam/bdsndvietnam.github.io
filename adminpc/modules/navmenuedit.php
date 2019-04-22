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
		$GLOBALS['_POST']['post']['smenu'] = "";
	}
	else
	{
		$GLOBALS['_POST']['post']['smenu'] = $_POST['menu'];
		$GLOBALS['_POST']['post']['menu'] = "";
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
	update( $_POST['post'], "navmenu", "mid=".$_GET['id'] );
}
$q = query( "SELECT menu AS tenmuc, mid AS cid FROM navmenu WHERE menu!='' ORDER By mgr" );
while ( $r = fecth( $q ) )
{
	$tenmuc[] = $r['tenmuc'];
	$cid[] = $r['cid'];
}
$q2 = query( "SELECT * FROM navmenu WHERE mid=".$_GET['id'] );
$stv->assign( $r2 = fecth( $q2 ) );
if ( $r2['menu'] != "" )
{
	$stv->assign( "navmenu", $r2['navmenu'] );
}
else
{
	$stv->assign( "menu", $r2['smenu'] );
}
$stv->assign( "sl", $r2['mgr'] );
$stv->assign( "tenmuc", $tenmuc );
$stv->assign( "cid", $cid );
$stv->display( "navmenuedit.htm" );
?>
