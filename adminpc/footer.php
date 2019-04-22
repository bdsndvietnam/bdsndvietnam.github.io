<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/


$stv = new Smarty( );
if ( !stv_code )
{
	check_code( 0 );
}
$stv->assign( $myinfo );
$stv->display( "footer.htm" );
?>
