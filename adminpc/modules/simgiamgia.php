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
if ( $_POST['submit'] )
{
	if ( $_POST['check'] != 1 )
	{
		mysql_query( "DELETE FROM simgiamgia" );
	}
	$data = explode( "\r\n", $_POST['list'] );
	$k = 0;
	foreach ( $data as $values )
	{
		list( $sosim, $giatien ) = split( "\t", $values );
		$sosim = preg_replace( "/[^0-9.]/", "", $sosim );
		$giatien = preg_replace( "/[^0-9]/", "", $giatien );
		if ( checkso( $sosim, $giatien ) )
		{
			++$k;
			mysql_query( "insert into simgiamgia (sosim, giatien) VALUES ('".$sosim."', '".$giatien."')" );
		}
	}
	echo thongbao( "Đăng thành công ".$k." số!" );
}
$stv->display( "simgiamgia.htm" );
?>
