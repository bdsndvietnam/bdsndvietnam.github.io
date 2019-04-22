<?php
$stv = new Smarty( );
if ( isset( $_POST['submit'] ) && is_array( $_POST['p'] ) )
{
	function updatepos( $arr )
	{
		foreach ( $arr as $id => $value )
		{
			mysql_query( "UPDATE giam_gia SET pt ='".$value."' WHERE id='".$id."'" );
		}
	}
	updatepos( $_POST['p'] );
}
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
	query( "DELETE FROM giam_gia WHERE id='".$_GET['delid']."'" );
}
$dem = mysql_num_rows( mysql_query( "SELECT id FROM giam_gia" ) );
$sql = query( "SELECT * FROM giam_gia ORDER BY vitri ASC limit ".$bg.",{$masp}" );
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
	$data[] = $row;
}
$stv->assign( "data", $data );
$stv->assign( "c_url", $c_url );
$stv->assign( "paging", paging( $dem, $page, 10, $masp ) );
$stv->display( "qlgiasim.htm" );
?>
