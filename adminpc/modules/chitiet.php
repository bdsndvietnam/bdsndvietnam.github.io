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

function notes( $mid )
{
	$query = mysql_query( "SELECT * FROM notes WHERE mid='".$mid."' ORDER BY id DESC" );
	$notes = "";
	$left = "";
	$top = "";
	$zindex = "";
	while ( $row = mysql_fetch_assoc( $query ) )
	{
		list( $left, $top, $zindex ) = explode( "x", $row['xyz'] );
		$notes .= "\r\n\t<div class=\"note ".$row['color']."\" style=\"left:".$left."px;top:".$top."px;z-index:".$zindex."\" id=\"note-".$row['id']."\">\r\n\t\t".htmlspecialchars( $row['text'] )."\r\n\t\t\r\n\t\t<div class=\"author\">".htmlspecialchars( $row['name'] )." <a onclick=\"deln(".$row['id'].")\" href=\"javascript:void(0);\">Xóa</a></div>\r\n\t\t<span class=\"data\">".$row['id']." </span>\r\n\t</div>";
	}
	return $notes;
}


$stv = new Smarty( );
$info_admin = infoadmin( );
if ( !$_GET['group'] )
{
	$where = "WHERE id='".$_GET['id']."'";
}
else
{
	$where = "WHERE oid='".$_GET['group']."'";
}
$q2 = query( "SELECT * FROM my_order ".$where );
$i = 0;
if ( $_GET['del'] == 1 && $_GET['id'] )
{
	@mysql_query( "delete from my_order where id='".$_GET['id']."'" );
	echo thongbao( "Đã xóa đơn đặt hàng thành công!" );
}
while ( $row = fecth( $q2 ) )
{
	++$i;
	$row['stt'] = $i;
	$tongtien += $row['giatien'];
	if ( $row['trangthai'] == 3 )
	{
		$row['sosim'] = "<font color='#0066FF'>".$row['sosim']."</font>";
	}
	if ( $row['trangthai'] == 4 )
	{
		$row['sosim'] = "<font color='#C0C0C0'>".$row['sosim']."</font>";
	}
	$row['giatien'] = number_format( $row['giatien'], 0, ".", "." );
	if ( $i % 2 == 0 )
	{
		$row['class'] = "b2";
	}
	else
	{
		$row['class'] = "b1";
	}
	$data[] = $row;
}
mysql_query( "UPDATE my_order set trangthai=1 WHERE id='".$_GET['id']."' and trangthai!=2 and trangthai!='Xóa'" );
if ( $_GET['set'] == 1 )
{
	mysql_query( "UPDATE my_order set trangthai='0' WHERE id='".$_GET['id']."' and trangthai!=2" );
	thongbao( "Chưa gọi khách hàng!" );
}
$stv->assign( "data", $data );
$stv->assign( "tongtien", number_format( $tongtien, 0, ".", "." ) );
$stv->assign( "tongsim", $i );
if ( isset( $_POST['submit'] ) )
{
	
	$smsx = new xstv_sms( );
	$stv_check = $smsx->check_login( $info_admin['mobile'], $myinfo[my_sms_pass] );
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
	if ( $sms_staus == 1 )
	{
		echo "Gửi Tin Nhắn Thành Công";
	}
	else
	{
		echo "<font color='red'>Không Gửi Được tin nhắn!</font>";
	}
}
$stv->assign( "del", $_GET['id']."&del=1" );
$stv->assign( "notes", notes( $_GET['id'] ) );
$stv->display( "chitiet.htm" );
?>
