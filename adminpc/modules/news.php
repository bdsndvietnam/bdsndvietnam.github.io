<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/

function selectd( )
{
	$q = mysql_query( "select * FROM my_order where mydomain!='' group by mydomain" );
	while ( $r = mysql_fetch_array( $q ) )
	{
		$domains[] = $r['mydomain'];
	}
	return $domains;
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
	query( "DELETE FROM news WHERE id='".$_GET['delid']."'" );
}
if ( isset( $_POST['submit'] ) )
{
	foreach ( $GLOBALS['_POST']['pot'] as $id => $valu )
	{
		query( "UPDATE news SET stt='".$valu."' WHERE id='".$id."'" );
	}
	print_r( $_POST['pot'] );
}
if ( $_GET['domains'] )
{
	$dem = mysql_num_rows( mysql_query( "SELECT id FROM news where domain='".$_GET['domains']."'" ) );
	$sql = query( "SELECT * FROM news where domain='".$_GET['domains'].( "' ORDER BY stt ASC limit ".$bg.",{$masp}" ) );
}
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
$stv->assign( "domain_sl", selectd( ) );
$stv->assign( "indexd", $_GET[domains] );
if ( $_GET['domains'] )
{
	$stv->display( "news.htm" );
}
else
{
	$stv->display( "news_select.htm" );
}
?>
