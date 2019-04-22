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
	query( "DELETE FROM my_cron WHERE id='".$_GET['delid']."'" );
}
$dem = mysql_num_rows( mysql_query( "SELECT id FROM my_cron" ) );
$sql = query( "SELECT * FROM my_cron ORDER BY cr_staus ASC,id DESC limit ".$bg.",{$masp}" );
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
	$row['cr_date'] = date( "h:i:s d/m/Y", $row['cr_times'] );
	if ( $row['cr_staus'] == 1 )
	{
		$row['cr_staus'] = "<b><spam style='color: #33CC33'>OK</span></b>";
	}
	else
	{
		$row['cr_staus'] = "Wait";
	}
	$row['cr_end'] = sec_to_time( $row['cr_times'] - time( ) );
	$data[] = $row;
}
$stv->assign( "data", $data );
$stv->assign( "c_url", $c_url );
$stv->assign( "paging", paging( $dem, $page, 10, $masp ) );
$stv->display( "cron_manage.htm" );
?>
