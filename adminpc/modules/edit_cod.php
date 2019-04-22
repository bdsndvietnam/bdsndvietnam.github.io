<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/


$stv = new Smarty( );
if ( isset( $_POST['submit'] ) )
{
	$data_s = split( "/", $_POST['d_s'] );
	$times = mktime( $_POST['Time_Hour'], $_POST['Time_Minute'], $_POST['Time_Second'], $data_s[0], $data_s[1], $data_s[2] );
	$GLOBALS['_POST']['post']['giatien'] = replace( $_POST['post']['giatien'] );
	$GLOBALS['_POST']['post']['ngaychuyen'] = $times;
	update( $_POST['post'], "cod", "id='".$_GET['id']."'" );
	thongbao( "Sửa cod thành công!" );
}
$sql = mysql_query( "SELECT * FROM cod WHERE id='".$_GET['id']."'" );
$stv->assign( $row = mysql_fetch_assoc( $sql ) );
$stv->assign( "days", date( "m/d/Y", $row['ngaychuyen'] ) );
$stv->display( "edit_cod.htm" );
?>
