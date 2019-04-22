<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/


$stv = new Smarty( );
if ( $_POST['add'] )
{
	insert( $_POST['post'], "listurl" );
}
if ( $_GET['del'] )
{
	query( "delete from listurl WHERE id='".$_GET['del']."'" );
}
$sql = query( "SELECT * FROM listurl" );
while ( $row = mysql_fetch_array( $sql ) )
{
	$data[] = $row;
}
$stv->assign( "data", $data );
$stv->display( "stuff.htm" );
?>
