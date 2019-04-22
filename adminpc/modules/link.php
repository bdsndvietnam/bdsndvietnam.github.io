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
	query( "DELETE FROM mylink WHERE id='".$_GET['delid']."'" );
}
if ( isset( $_POST['submit'] ) )
{
	if ( $_GET['editid'] )
	{
		update( $_POST['post'], "mylink", "id=".$_GET['editid'] );
	}
	else
	{
		insert( $_POST['post'], "mylink" );
	}
}
if ( $_GET['editid'] )
{
	$q = query( "SELECT * FROM mylink WHERE id=".$_GET['editid'] );
	$stv->assign( mysql_fetch_array( $q ) );
}
$sql = query( "SELECT * FROM mylink order by title ASC" );
$i = 0;
while ( $row = fecth( $sql ) )
{
	++$i;
	if ( $i % 2 == 0 )
	{
		$row['class'] = "b2";
	}
	else
	{
		$row['class'] = "b1";
	}
	$row['st'] = $i;
	$data[] = $row;
}
$stv->assign( "data", $data );
$stv->assign( "c_url", $c_url );
$stv->display( "link.htm" );
?>
