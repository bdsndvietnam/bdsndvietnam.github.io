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
$stv->assign( "name", array( "Ẩn", "Trái", "Phải","Banner","Footer","Chữ cuộn", "Logo", "Logo Footer" ) );
$stv->assign( "value", array( 0, 1, 2, 4, 3, 5, 6, 7 ) );
$stv->assign( "sele", $row['vitri'] );
$stv->display( "homemenuedit.htm" );
?>
