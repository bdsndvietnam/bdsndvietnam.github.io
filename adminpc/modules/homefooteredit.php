<?php
$stv = new Smarty( );
if ( $_POST['submit'] )
{
	$sql2 = query( "SELECT * FROM homemenu WHERE id='".$_GET['id']."'" );
	$row2 = fecth( $sql2 );
	update( $_POST['post'], "homemenu", "id='".$_GET['id']."'" );
	thongbao( "Đổi thông tin thành công!" );
}
$sql = query( "SELECT * FROM homemenu WHERE id='".$_GET['id']."'" );
$stv->assign( $row = fecth( $sql ) );
$stv->assign( "name", array( "Footer") );
$stv->assign( "value", array( 3) );
$stv->assign( "sele", $row['vitri'] );
$stv->display( "homemenuedit.htm" );
?>
