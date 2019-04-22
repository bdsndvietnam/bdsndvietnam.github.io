<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/


$stv = new Smarty( );
if ( 0 < intval( $_GET['id'] ) )
{
	query( "DELETE FROM gichusim WHERE pid='".$_GET['id']."'" );
}
if ( isset( $_POST['submit'] ) && $_POST['post']['gichu'] != "" )
{
	$q = query( "SELECT * from gichusim WHERE pid='".$_POST['post']['pid']."'" );
	if ( mysql_num_rows( $q ) < 1 )
	{
		insert( $_POST['post'], "gichusim" );
		thongbao( "Thêm gi chú thành công!" );
	}
	else
	{
		thongbao( "Thêm ghi chú không thành công!" );
	}
}
$q2 = mysql_query( "SELECT thanhvien.id AS id, thanhvien.hovaten AS hovaten, gichusim.gichu AS ghichu FROM thanhvien LEFT JOIN gichusim ON (gichusim.pid = thanhvien.id) WHERE thanhvien.live=1 ORDER BY thanhvien.id DESC" );
$i = 0;
while ( $r2 = mysql_fetch_array( $q2 ) )
{
	++$i;
	$r2['stt'] = $i;
	$xvalues[] = $r2['id'];
	$xnames[] = $r2['hovaten'];
	$xgichu[] = $r2['ghichu'];
	$data[] = $r2;
}
$stv->assign( "xvalues", $xvalues );
$stv->assign( "data", $data );
$stv->assign( "xnames", $xnames );
$stv->display( "addgichu.htm" );
?>
