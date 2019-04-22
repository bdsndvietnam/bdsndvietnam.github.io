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
$masp = 50;
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
		$p['k']['pt'] = 1;
	}
	else
	{
		$p['k']['pt'] = 0;
	}
	update( $p['k'], "thanhvien", "id='".$_GET['id']."'" );
}
if ( 0 < $_GET['delid'] )
{
	mysql_query( "DELETE FROM simso WHERE simdl='".$_GET['delid']."'" );
}
$dem = mysql_num_rows( query( "SELECT * FROM thanhvien WHERE live " ) );
$sql = query( "SELECT * FROM thanhvien ORDER BY live DESC limit ".$bg.",{$masp}" );
while ( $row = fecth( $sql ) )
{
	$q2 = query( "SELECT count(simid) simx  FROM simso WHERE simdl='".$row['id']."'" );
	$rs = fecth( $q2 );
	++$i;
	$row['stt'] = $i;
	$row['tongsim'] = $rs['simx'];
	$row['xsim'] = number_format( $row['tongsim'], 0, ".", "." );
	if ( $i % 2 == 0 )
	{
		$row['class'] = "ui-widget-content";
	}
	else
	{
		$row['class'] = "";
	}
	$data[] = $row;
}
$stv->assign( "data", $data );
$stv->assign( "c_url", $c_url );
$stv->assign( "paging", paging( $dem, $page, 10, $masp ) );
$stv->display( "xoaso.htm" );
?>
