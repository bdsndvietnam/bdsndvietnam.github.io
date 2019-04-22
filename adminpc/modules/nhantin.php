<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/

function infoadmin( )
{
	$q = mysql_query( "SELECT * FROM thanhvien WHERE username='".$_SESSION['username']."'" );
	$r = mysql_fetch_array( $q );
	return $r;
}

if ( !stv_code )
{
	check_code( 0 );
}

$stv = new Smarty( );
require( "../func/xoadau.php" );
$info_admin = infoadmin( );
$sql = query( "SELECT *,my_order.hovaten AS hovaten,my_order.city AS mcity, thanhvien.hovaten AS tendaily, my_order.diachi AS diachi from my_order, thanhvien WHERE my_order.dailyid = thanhvien.id AND my_order.id='".$_GET['id']."'" );
$row = fecth( $sql );
if ( $_GET['kiemtra'] == 1 )
{
	$noidung = "Kiem Tra Giup Em Xem So ".$row['sosim']." Co Con Ko?\n";
}
else
{
	$noidung = $row['sosim']." Thu ".number_format( $row['giatien'] / 1000, 0, ".", "." )."K \n";
	$noidung .= $row['hovaten']." \n";
	$noidung .= "DC: ".$row['diachi']." - ".$row['mcity']." \n";
	$noidung .= "Mb: ".$row['dienthoai']."\n";
}
$noidung .= $myinfo[my_sms_by];
$stv->assign( "urlpost", "aindex.php?".$_SERVER['QUERY_STRING'] );
$stv->assign( "noidung", xoad( $noidung ) );
$stv->assign( "mobile", preg_replace( "/[^0-9]/", "", $row['mobile'] ) );
$stv->assign( "hovaten", $row['tendaily'] );
if ( isset( $_POST['submit'] ) )
{
	
	$smsx = new xstv_sms( );
	$stv_check = $smsx->check_login( $myinfo[my_sms_number], $myinfo[my_sms_pass] );
	if ( $stv_check )
	{
		$stv_send = $smsx->send_sms( preg_replace( "/[^0-9]/", "", $_POST['mobile'] ), $_POST['txt'] );
		if ( $stv_send )
		{
			$sms_staus = 1;
		}
		else
		{
			$sms_staus = 0;
		}
	}
	else
	{
		$sms_staus = 0;
	}
	$sms['s']['sto'] = $_POST['mobile'];
	$sms['s']['ssend'] = $info_admin['mobile'];
	$sms['s']['scontent'] = $_POST['txt'];
	$sms['s']['sdate'] = date( "h:i:s d/m/Y" );
	$sms['s']['staus'] = $sms_staus;
	$cr = @mysql_query( "SELECT * FROM mysms WHERE scontent='".$_POST['txt']."' AND sto='".$_POST['mobile']."'" );
	if ( mysql_num_rows( $cr ) < 1 )
	{
		insert( $sms['s'], "mysms" );
	}
	else
	{
		update( $sms['s'], "mysms", "scontent='".$_POST['txt']."' AND sto='".$_POST['mobile']."'" );
	}
	if ( $sms_staus == 1 )
	{
		echo "Gửi Tin Nhắn Thành Công";
	}
	else
	{
		echo "<font color='red'>Không Gửi Được tin nhắn!</font>";
	}
}
$stv->display( "nhantin.htm" );
?>
