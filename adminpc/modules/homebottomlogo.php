<?php
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
	update( $p['k'], "homemenu", "id='".$_GET['id']."'" );
}
if ( 0 < $_GET['delid'] )
{
	query( "DELETE FROM homemenu WHERE id='".$_GET['delid']."'" );
}
if ( isset( $_GET['search'] ) )
{
	$sql = query( "SELECT * FROM homemenu WHERE tieude LIKE '%".$_GET['text']."%' || mobile LIKE '%".$_GET['text'].( "%' ORDER BY vitri DESC limit ".$bg.",{$masp}" ) );
	$dem = mysql_num_rows( query( "SELECT * FROM homemenu WHERE tieude LIKE '%".$_GET['text']."%' || mobile LIKE '%".$_GET['text']."%'" ) );
}
else
{
	$sql = query( "SELECT * FROM homemenu WHERE vitri=7 order by vitri DESC limit ".$bg.",{$masp}" );
	$dem = mysql_num_rows( query( "SELECT * FROM homemenu WHERE vitri > 0" ) );
}
while ( $row = fecth( $sql ) )
{
	++$i;
	$row['stt'] = $i;
	if ( $i % 2 == 0 )
	{
		$row['class'] = "ui-widget-content";
	}
	else
	{
		$row['class'] = "";
	}
	$homemenu[] = $row;
}
$stv->assign( "homemenu", $homemenu );
$stv->assign( "c_url", $c_url );
$stv->assign( "paging", paging( $dem, $page, 10, $masp ) );
if ( $_SESSION['admins'] = 1 )
{
	$stv->display( "homebottomlogo.htm" );
}
?>