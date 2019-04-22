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
	$GLOBALS['_POST']['post']['ngaychuyen'] = $times;
	$GLOBALS['_POST']['post']['giaban'] = replace( $_POST['post']['giaban'] );
	$s = mysql_query( "SELECT * FROM cod WHERE sosim='".$_POST['post']['sosim']."'" );
	if ( mysql_num_rows( $s ) < 1 )
	{
		insert( $_POST['post'], "cod" );
		thongbao( "Thêm cod thành công!" );
		print_r( $_POST['post'] );
	}
	else
	{
		thongbao( "Cod Đã có !" );
	}
	$GLOBALS['_POST']['s']['cr_times'] = mktime( $_POST['Time_Hour'], $_POST['Time_Minute'] + 2, $_POST['Time_Second'], $data_s[0], $data_s[1], $data_s[2] );
	$smsphone = "Sim: ".$_POST['post']['sosim']." chuyen luc ".$_POST['Time_Hour']."H ngay ".$data_s[1]."/".$data_s[0]."\n";
	$smsphone .= "Ma buu pham: ".$_POST['post']['mabuu'].".\n";
	$smsphone .= "2 ngay sau Quy khach chua nhan duoc vui long LH buu dien gan nhat de nhan sim!";
	$GLOBALS['_POST']['s']['cr_type'] = "SMS";
	$GLOBALS['_POST']['s']['cr_to'] = $_POST['post']['phone'];
	$GLOBALS['_POST']['s']['cr_msg'] = $smsphone;
	$sv = mysql_query( "SELECT * FROM my_cron WHERE cr_to='".$_POST['post']['phone']."' AND cr_msg='".$smsphone."'" );
	if ( mysql_num_rows( $sv ) < 1 )
	{
		insert( $_POST['s'], "my_cron" );
		echo "Tao cron Thanh Cong!";
	}
}
$stv->assign( "days", date( "m/d/Y" ) );
$stv->display( "add_cod.htm" );
?>
