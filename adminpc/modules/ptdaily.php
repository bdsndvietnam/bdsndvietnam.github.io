<?php
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
	query( "DELETE FROM pt_daily WHERE id='".$_GET['ptid']."'" );
}
if ( isset( $_POST['submit'] ) )
{
	$GLOBALS['_POST']['post']['dl'] = $_GET['dl'];
	insert( $_POST['post'], "pt_daily" );
}
$dem = mysql_num_rows( mysql_query( "SELECT thanhvien.hovaten AS hovaten, pt_daily.dk1 AS dk1, pt_daily.dk2 AS dk2, pt_daily.id AS id, pt_daily.pt AS pt FROM pt_daily LEFT JOIN thanhvien ON pt_daily.dl = thanhvien.id WHERE pt_daily.dl ='".$_GET['dl']."'" ) );
$sql = query( "SELECT thanhvien.hovaten AS hovaten, pt_daily.dk1 AS dk1, pt_daily.dk2 AS dk2, pt_daily.id AS id, pt_daily.pt AS pt FROM pt_daily LEFT JOIN thanhvien ON pt_daily.dl = thanhvien.id WHERE pt_daily.dl ='".$_GET['dl']."' ORDER BY pt_daily.pt DESC limit {$bg},{$masp}" );
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
$stv->assign( "paging", paging( $dem, $page, 10, $masp ) );
$q = query( "SELECT * FROM thanhvien order by live desc" );
while ( $r = fecth( $q ) )
{
	$oid[] = $r['id'];
	$oname[] = $r['hovaten'];
}
$stv->assign( "oid", $oid );
$stv->assign( "oname", $oname );
$stv->assign( "c_url", $c_url );
if ( $_SESSION['admins'] = 1 )
{
	$stv->display( "ptdaily.htm" );
}
?>
