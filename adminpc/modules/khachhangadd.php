<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/


$stv = new Smarty( );
if ( $_POST['submit'] )
{
	$GLOBALS['_POST']['post']['live'] = 1;
	$GLOBALS['_POST']['post']['password'] = md5( md5( md5( $_POST['post']['password'] ) ) );
	insert( $_POST['post'], "khachhang" );
	thongbao( "Thêm khách hàng thành công!" );
}
$sql = query( "SELECT * FROM khachhang WHERE id='".$_GET['id']."'" );
$stv->assign( $row = fecth( $sql ) );
foreach ( $city['s'] as $cityname )
{
	$cityn[] = $cityname;
}
$stv->assign( "name", array( "member" ) );
$stv->assign( "value", array( 0 ) );
$stv->assign( "cityn", $cityn );
$stv->assign( "select", $row['city'] );
$stv->display( "khachhangadd.htm" );
?>
