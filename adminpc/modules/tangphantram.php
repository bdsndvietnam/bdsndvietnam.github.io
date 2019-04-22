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
if ( 0 < $_GET['ptid'] )
{
	query( "DELETE FROM auto_pt WHERE id='".$_GET['ptid']."'" );
}
if ( isset( $_POST['submit'] ) )
{
	$GLOBALS['_POST']['post']['dl'] = $_GET['daily'];
	insert( $_POST['post'], "auto_pt" );
}
$dem = mysql_num_rows( mysql_query( "SELECT id FROM auto_pt" ) );
$sql = query( "SELECT * FROM auto_pt WHERE dl='".$_GET['daily']."' ORDER BY dk2 DESC limit {$bg},{$masp}" );
if ( $page == 1 )
{
	$i = 0;
}
else
{
	$i = $bg;
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
	$row['dk1'] = number_format( $row['dk1'], 0, ".", "." );
	$row['dk2'] = number_format( $row['dk2'], 0, ".", "." );
	$row['stt'] = $i;
	$data[] = $row;
}
$stv->assign( "data", $data );
$stv->assign( "c_url", $c_url );
$stv->assign( "paging", paging( $dem, $page, 10, $masp ) );
$q2 = mysql_query( "SELECT * FROM thanhvien WHERE live=1 ORDER BY hovaten ASC" );
while ( $r2 = mysql_fetch_array( $q2 ) )
{
	$xvalues[] = $r2['id'];
	$xnames[] = $r2['hovaten'];
}
$stv->assign( "xvalues", $xvalues );
$stv->assign( "sl", $_GET['daily'] );
$stv->assign( "xnames", $xnames );
if ( $_SESSION['admins'] == 1 )
{
	$stv->display( "tangphantram.htm" );
}
?>
