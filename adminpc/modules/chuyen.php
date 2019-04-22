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
	require( "../func/myoder.php" );
	$q = query( "SELECT * FROM nhapxuat WHERE sosim='".replace( $_POST['post']['sosim'] )."' AND daily='".$_POST['post']['daily']."' AND xoa=0" );
	if ( $_POST['post']['daily'] != "no" && mysql_num_rows( $q ) < 1 )
	{
		$r = mysql_fetch_array( $q );
		$GLOBALS['_POST']['post']['ngay'] = date( "d/m/Y" );
		$GLOBALS['_POST']['post']['gianhap'] = replace( $_POST['post']['gianhap'] ) / 1000;
		$GLOBALS['_POST']['post']['giaban'] = replace( $_POST['post']['giaban'] ) / 1000;
		insert( $_POST['post'], "nhapxuat" );
		echo thongbao( "Thêm vào danh sách chuyển của đại lý thành công" );
	}
	else
	{
		echo thongbao( "LOI! Số sim đã có trong danh sách chuyển của đại lý" );
	}
	mysql_query( "UPDATE my_order set trangthai=2 WHERE id='".$_GET['id']."'" );
}
if ( $_GET['id'] )
{
	$q = query( "SELECT * from my_order WHERE id='".$_GET['id']."'" );
	$row = mysql_fetch_array( $q );
	$row['gianhap'] = number_format( $row['gianhap'] * 1000000, 0, ".", "." );
	$row['giatien'] = number_format( $row['giatien'], 0, ".", "." );
	$row['hoahong'] = hoahong( $row['sosim'] );
	$stv->assign( $row );
	$q2 = mysql_query( "SELECT * FROM thanhvien" );
	while ( $r2 = mysql_fetch_array( $q2 ) )
	{
		$dlid[] = $r2['hovaten'];
		$dlname[] = $r2['hovaten'];
	}
	$stv->assign( "dlid", $dlid );
	$stv->assign( "dlname", $dlname );
}
$stv->display( "chuyen.htm" );
?>
