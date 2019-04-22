<?php
$stv = new Smarty( );
if ( $_POST['submit'] )
{
	insert( $_POST['post'], "homemenu" );
	thongbao( "Thêm danh mục thành công!" );
}
$sql = query( "SELECT * FROM thanhvien WHERE id='".$_GET['id']."'" );
$stv->assign( $row = fecth( $sql ) );
$stv->assign( "name", array( "Ẩn", "Trái", "Phải","Banner","Footer","Chữ cuộn", "Logo", "Logo Footer" ) );
$stv->assign( "value", array( 0, 1, 2, 4, 3, 5, 6, 7 ) );
$stv->display( "homemenuadd.htm" );
?>
