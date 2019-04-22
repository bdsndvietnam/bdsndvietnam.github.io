<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/


$stv = new Smarty( );
$q2 = mysql_query( "SELECT * FROM thanhvien WHERE live=1 ORDER BY id DESC" );
while ( $r2 = mysql_fetch_array( $q2 ) )
{
	$xvalues[] = $r2['id'];
	$xnames[] = $r2['hovaten'];
}
$stv->assign( "xvalues", $xvalues );
$stv->assign( "xnames", $xnames );
$stv->assign( "date", date( "d/m/Y" ) );
$stv->display( "inbang2.htm" );
?>
