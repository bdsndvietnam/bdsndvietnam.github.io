<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/

session_start( );
require( "../connect.php" );
require( "../../func/mysql.php" );
if ( $_SESSION['admins'] == 1 )
{
	mysql_query( "DELETE FROM notes WHERE id='".$_GET['id']."'" );
}
?>
