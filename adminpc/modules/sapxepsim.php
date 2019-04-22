<?php
$stv = new Smarty( );
if ( $_POST['submit'] )
{
	$sql2 = query( "SELECT * FROM sapxep WHERE id=1" );
	$row2 = fecth( $sql2 );
	update( $_POST['post'], "sapxep", "id=1" );
	thongbao( "Đổi thông tin thành công!" );
}
$sql = query( "SELECT * FROM sapxep WHERE id=1" );
$stv->assign( $row = fecth( $sql ) );
$stv->assign( "name", array( "Ngẫu nhiên", "Cao --> Thấp", "Thấp --> Cao" ) );
$stv->assign( "value", array( "RAND()", "giaban DESC", "giaban ASC" ) );
$stv->assign( "sele", $row['xep'] );
$stv->display( "sapxepsim.htm" );
?>