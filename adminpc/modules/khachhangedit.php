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

$stv = new Smarty( );
if ( $_POST['submit'] )
{
	$sql2 = query( "SELECT * FROM khachhang WHERE id='".$_GET['id']."'" );
	$row2 = fecth( $sql2 );
	if ( $_POST['post']['password'] == NULL )
	{
		$GLOBALS['_POST']['post']['password'] = $row2['password'];
	}
	else
	{
		$GLOBALS['_POST']['post']['password'] = md5( md5( md5( $_POST['post']['password'] ) ) );
	}
	update( $_POST['post'], "khachhang", "id='".$_GET['id']."'" );
	thongbao( "Đổi thông tin thành công!" );
}
$sql = query( "SELECT * FROM khachhang WHERE id='".$_GET['id']."'" );
$stv->assign( $row = fecth( $sql ) );
foreach ( $city['s'] as $cityname )
{
	$cityn[] = $cityname;
}
$stv->assign( "name", array( "member" ) );
$stv->assign( "value", array( 0 ) );
$stv->assign( "sele", $row['live'] );
$stv->assign( "cityn", $cityn );
$stv->assign( "select", $row['city'] );
$stv->display( "khachhangedit.htm" );
?>
