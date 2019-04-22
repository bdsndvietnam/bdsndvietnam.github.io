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
$sql = query( "SELECT * FROM nhapxuat where ngay='".date( "d/m/Y" )."' AND gianhap > 0 and xoa!=1 order by daily asc" );
$i = 0;
if ( $_GET['del'] )
{
	if ( $_GET['daxoa'] == 1 )
	{
		query( "DELETE FROM nhapxuat WHERE id='".$_GET['del']."'" );
	}
	else
	{
		query( "UPDATE nhapxuat SET xoa=1 WHERE id='".$_GET['del']."'" );
	}
}
while ( $row = fecth( $sql ) )
{
	++$i;
	if ( $i % 2 == 0 )
	{
		$row['class'] = "ui-widget-content";
	}
	else
	{
		$row['class'] = "";
	}
	$row['stt'] = $i;
	$row['lai'] = $row['giaban'] - $row['gianhap'] + $row['gianhap'] * $row['hoahong'] / 100 + $row['phikhac'];
	$tongnhap1 += $row['gianhap'];
	$tonglai += $row['lai'];
	if ( $row['trangthai'] == 1 )
	{
		$row['sosim'] = "<a href='../daily/aindex.php?act=trangthai&id=".$row[id]."' rel='lyteframe' title='' rev='width: 400px; height: 300px; scrolling: no;'><span style='color:orange'>".$row['sosim']."</span></a>";
	}
	else if ( $row['trangthai'] == 2 )
	{
		$row['sosim'] = "<a href='../daily/aindex.php?act=trangthai&id=".$row[id]."' rel='lyteframe' title='' rev='width: 400px; height: 300px; scrolling: no;'> <span style='color:red'>".$row['sosim']."</span></a>";
	}
	else if ( $row['xoa'] == 1 )
	{
		$row['sosim'] = "<span style='color:#999999; background-color:#CCCCCC'>".$row['sosim']."</span>";
	}
	$row['gianhap'] = number_format( $row['gianhap']* 1000, 0, ",", "," );
	$row['giaban'] = number_format( $row['giaban']* 1000, 0, ",", "," );
	$data[] = $row;
}
$stv->assign( "tongnhap1", number_format( $tongnhap1 * 1000, 0, ",", "," ) );
$stv->assign( "tongnhap2", number_format( $tongnhap2 * 1000, 0, ",", "," ) );
$stv->assign( "tonglai", number_format( $tonglai * 1000, 0, ",", "," ) );
$stv->assign( "tongam", number_format( $tongam * 1000, 0, ",", "." ) );
$stv->assign( "data", $data );
$stv->assign( "data2", $data2 );
$stv->assign( "c_url", $c_url );
if ( $_SESSION['admins'] = 1 )
{
	$stv->assign( "admins", 1 );
}
$stv->assign( "xnames", $xnames );
$stv->assign( "date", date( "d/m/Y" ) );
$stv->assign( "urls", str_replace( "giaodich", "exgiaodich", $_SERVER['QUERY_STRING'] ) );
$stv->display( "giaodichtrongngay.htm" );
?>
