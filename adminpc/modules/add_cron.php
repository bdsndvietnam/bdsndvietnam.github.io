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
	$GLOBALS['_POST']['post']['cr_times'] = $times;
	$s = mysql_query( "SELECT * FROM my_cron WHERE cr_to='".$_POST['post']['cr_to']."' AND cr_msg='".$_POST['post']['cr_msg']."'" );
	if ( mysql_num_rows( $s ) < 1 )
	{
		if ( $_POST['post']['cr_type'] == "get" )
		{
			$GLOBALS['_POST']['post']['cr_to'] = $_POST['cr_url'];
		}
		insert( $_POST['post'], "my_cron" );
		echo "Tao cron Thanh Cong!";
	}
}
$stv->assign( "days", date( "m/d/Y" ) );
if ( 0 < $_GET['id'] )
{
	function info( $id )
	{
		$q = mysql_query( "SELECT my_order.dienthoai as khach, thanhvien.mobile as daily FROM my_order, thanhvien WHERE thanhvien.id = my_order.dailyid AND my_order.id='".$id."'" );
		$r = mysql_fetch_array( $q );
		return $r;
	}
	$stv->assign( info( $_GET['id'] ) );
}
$stv->display( "add_cron.htm" );
?>
