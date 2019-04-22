<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/

function sec_to_time( $seconds )
{
	$hours = floor( $seconds / 3600 );
	$minutes = floor( $seconds % 3600 / 60 );
	$seconds %= 60;
	return sprintf( "%d:%02d:%02d", $hours, $minutes, $seconds );
}

function strTime( $s )
{
	$d = intval( $s / 86400 );
	$s -= $d * 86400;
	$h = intval( $s / 3600 );
	$s -= $h * 3600;
	$m = intval( $s / 60 );
	$s -= $m * 60;
	if ( $d )
	{
		$str = $d;
	}
	return $str;
}

if ( !stv_code )
{
	check_code( 0 );
}

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
if ( 0 < $_GET['delid'] )
{
	query( "update cod set trangthai =3 WHERE id='".$_GET['delid']."'" );
}
if ( isset( $_POST['thungrac'] ) )
{
	$settt = 4;
}
else if ( isset( $_POST['danhan'] ) )
{
	$settt = 3;
}
else if ( isset( $_POST['daco'] ) )
{
	$settt = 2;
}
if ( is_array( $_POST['check'] ) )
{
	foreach ( $GLOBALS['_POST']['check'] as $keyid )
	{
		@mysql_query( "UPDATE cod SET trangthai='".$settt."' WHERE id='".$keyid."'" );
	}
}
if ( !$_GET['type'] )
{
	$GLOBALS['_GET']['type'] = "";
}
$dem = mysql_num_rows( mysql_query( "SELECT id FROM cod where trangthai='".$_GET['type']."'" ) );
$sql = query( "SELECT * FROM cod where trangthai='".$_GET['type'].( "' order by ngaychuyen desc limit ".$bg.",{$masp}" ) );
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
	$row['st'] = $i;
	$row['dachuyen'] = strtime( time( ) - $row['ngaychuyen'] );
	if ( 20 < $row['dachuyen'] && $row['dachuyen'] < 35 )
	{
		$row['canhbao'] = "<img src=\"img/cham.gif\" width=\"30\" />";
	}
	else if ( 35 <= $row['dachuyen'] && $row['dachuyen'] < 50 )
	{
		$row['canhbao'] = "<img src=\"img/quacham.gif\" width=\"30\" />";
	}
	else if ( 50 <= $row['dachuyen'] )
	{
		$row['canhbao'] = "<img src=\"img/qualau.gif\" width=\"30\" />";
	}
	$tongtien += $row['giaban'];
	$row['giaban'] = number_format( $row['giaban'], 0, ",", "," );
	if ( substr( $row['mabuu'], 0, 2 ) == "eb" )
	{
		$row['sms'] = "<img src=\"img/ems.JPG\" width=\"30\" />";
	}
	else if ( substr( $row['mabuu'], 0, 2 ) == "ve" )
	{
		$row['sms'] = "<img src=\"img/ve.jpg\" width=\"30\" />";
	}
	else
	{
		$row['sms'] = "<a target=\"_blank\" href=\"http://ttcvina.com/home/index.php?option=com_track&value=".$row['mabuu']."\"><img src=\"img/tinthanh.jpg\" width=\"30\" /></a>";
	}
	$row['ngaychuyen'] = date( "d/m/Y", $row['ngaychuyen'] );
	if ( $row['trangthai'] == 1 )
	{
		$row['trangthai'] = "<b><spam style='color: #33CC33'>OK</span></b>";
	}
	else
	{
		$row['trangthai'] = "Wait";
	}
	$data[] = $row;
}
$stv->assign( "tongtien", number_format( $tongtien, 0, ",", "," ) );
$stv->assign( "data", $data );
$stv->assign( "c_url", $c_url );
$stv->assign( "paging", paging( $dem, $page, 10, $masp ) );
$stv->display( "cod_manage.htm" );
?>
