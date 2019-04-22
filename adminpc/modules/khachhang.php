<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/
$stv = new Smarty( );
$masp = 20;
$page = $_GET['page'];
if ( $page )
{
	--$page;
}
$bg = $masp * $page;
if ( $_GET['page'] == "" )
{
	$page = 1;
}
else
{
	$page += 1;
}
if ( $page == 1 )
{
	$i = 0;
}
else
{
	$i = $bg;
}
if ( isset( $_GET['active'] ) )
{
	if ( $_GET['active'] == 0 )
	{
		$p['k']['gol'] = 1;
	}
	else
	{
		$p['k']['gol'] = 0;
	}
	update( $p['k'], "khachhang", "id='".$_GET['id']."'" );
}
if ( 0 < $_GET['delid'] )
{
	query( "DELETE FROM khachhang WHERE id='".$_GET['delid']."'" );
}
if ( isset( $_GET['search'] ) )
{
	$sql = query( "SELECT * FROM khachhang WHERE (hovaten LIKE '%".$_GET['text']."%' || mobile LIKE '%".$_GET['text'].( "%') AND live='0' ORDER BY id DESC limit ".$bg.",{$masp}" ) );
	$dem = mysql_num_rows( query( "SELECT * FROM khachhang WHERE (hovaten LIKE '%".$_GET['text']."%' || mobile LIKE '%".$_GET['text']."%') AND live='0'" ) );
}
else
{
	$sql = query( "SELECT * FROM khachhang WHERE gol='0' ORDER BY id DESC limit ".$bg.", {$masp}" );
	$dem = mysql_num_rows( $sql = query( "SELECT * FROM khachhang WHERE gol='0'" ) );
}
while ( $row = fecth( $sql ) )
{
	++$i;
	$row['stt'] = $i;
	if ( $i % 2 == 0 )
	{
		$row['class'] = "b2";
	}
	else
	{
		$row['class'] = "b1";
	}
	$data[] = $row;
}
$stv->assign( "data", $data );
$stv->assign( "c_url", $c_url );
$stv->assign( "paging", paging( $dem, $page, 10, $masp ) );
$stv->display( "khachhang.htm" );
?>
