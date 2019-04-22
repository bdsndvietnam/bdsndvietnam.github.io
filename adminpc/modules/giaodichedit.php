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
	update( $_POST['post'], "nhapxuat", "id='".$_POST['id']."'" );
	echo thongbao( "Cập nhập thành công!" );
}
$sql = mysql_query( "SELECT * FROM nhapxuat WHERE id='".$_GET['id']."'" );
$stv->assign( $row = mysql_fetch_array( $sql ) );
$q = query( "SELECT * FROM nhapxuat group by daily order by daily asc" );
while ( $r = mysql_fetch_array( $q ) )
{
	$xvalue[] = $r['daily'];
	$xname[] = $r['daily'];
}
$stv->assign( "xvalue", $xvalue );
$stv->assign( "xname", $xname );
$stv->assign( "xselect", $row['daily'] );
$stv->display( "giaodichedit.htm" );
?>
