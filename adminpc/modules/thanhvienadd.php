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
	$GLOBALS['_POST']['post']['password'] = md5( md5( md5( $_POST['post']['password'] ) ) );
	insert( $_POST['post'], "thanhvien" );
	thongbao( "Thêm thành viên thành công!" );
}
$sql = query( "SELECT * FROM thanhvien WHERE id='".$_GET['id']."'" );
$stv->assign( $row = fecth( $sql ) );
foreach ( $city['s'] as $cityname )
{
	$cityn[] = $cityname;
}
$stv->assign( "name", array( "mod", "admin", "member" ) );
$stv->assign( "value", array( 1, 2, 0 ) );
$stv->assign( "cityn", $cityn );
$stv->assign( "select", $row['city'] );
$stv->display( "thanhvienadd.htm" );
?>
