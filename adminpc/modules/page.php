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
if ( isset( $_POST['submit'] ) && is_array( $_POST['p'] ) )
{
	function updatepos( $arr )
	{
		foreach ( $arr as $id => $value )
		{
			mysql_query( "UPDATE page SET pos ='".$value."' WHERE id='".$id."'" );
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
	query( "DELETE FROM page WHERE id='".$_GET['delid']."'" );
}
$dem = mysql_num_rows( mysql_query( "SELECT id FROM page" ) );
$sql = query( "SELECT * FROM page ORDER BY pos ASC limit ".$bg.",{$masp}" );
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
$stv->display( "page.htm" );
?>
