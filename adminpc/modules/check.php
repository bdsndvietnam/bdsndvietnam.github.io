<?php
function infoadmin( )
{
	$q = mysql_query( "SELECT * FROM thanhvien WHERE username='".$_SESSION['username']."'" );
	$r = mysql_fetch_array( $q );
	if ( 0 < @mysql_num_rows( $q ) )
	{
		return $r;
	}
}

function danhba( )
{
	$q = mysql_query( "SELECT * FROM thanhvien WHERE live=1 order by hovaten asc" );
	while ( $r = mysql_fetch_array( $q ) )
	{
		$danhba[] = $r;
	}
	return $danhba;
}

$stv = new Smarty( );
$info_admin = infoadmin( );
if ( isset( $_POST['submit'] ) )
{
	function check( )
	{
		$q = mysql_query( "SELECT * from simso,thanhvien WHERE simso.sim2='".preg_replace( "/[^0-9]/", "", $_POST['sosim'] )."' and simso.simdl=thanhvien.id" );
		$r = mysql_fetch_assoc( $q );
		if ( 0 < @mysql_num_rows( $q ) )
		{
			return $r;
		}
		return FALSE;
	}
	$stvinfo = check( );
	if ( !$stvinfo )
	{
		$thongbao = "Số ".$_POST['sosim']." Không có trên website!";
	}
	else
	{
		$stvinfo[hoahong] = hoahong( $stvinfo['sim2'] );	
		$giagoc = number_format( $stvinfo['gianhap'] * ( 100 - $stvinfo[hoahong] ) * 10000, 0, ".", "." );
		$giakhach = number_format( $stvinfo['gianhap'] * 1000000, 0, ".", "." );
	}
	$stv->assign( "thongbao", $thongbao );
	$stv->assign( $stvinfo );
}

$stv->assign( "hoahongdl",($stvinfo[hoahong]));
$stv->assign( "danhba", danhba( ) );
$stv->assign( "sodt", $_POST['sosim']);
$stv->assign( "giagoc", $giagoc);
$stv->assign( "giakhach", $giakhach);
$stv->assign( "sendby", "Send by: ".$info_admin['hovaten'] );
if ( $_GET['so'] )
{
	if ( $_POST['to'] )
	{
		$GLOBALS['_GET']['dlso'] = $_POST['to'];
		$smstxt = $_POST['msg'];
		$smstxt .= "\n";
	}
	else
	{
		if ( $_GET['type'] == "giu" )
		{
			$smstxt = "Giu cho em so ".$_GET['so']." \nThanks! \n";
		}
		else if ( $_GET['type'] == "kiemtra" )
		{
			$smstxt = "Kiem tra giup em so ".$_GET['so']." xem co con ko? \n";
		}
		$smstxt .= $myinfo[my_sms_by];
	}
	
	$smsx = new xstv_sms( );
	$stv_check = $smsx->check_login( $myinfo[my_sms_number], $myinfo[my_sms_pass] );
	if ( $stv_check )
	{
		$stv_send = $smsx->send_sms( preg_replace( "/[^0-9]/", "", $_GET['dlso'] ), $smstxt );
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
	$sms['s']['sto'] = $_GET['dlso'];
	$sms['s']['ssend'] = $info_admin['mobile'];
	$sms['s']['scontent'] = $smstxt;
	$sms['s']['sdate'] = date( "h:i:s d/m/Y" );
	$sms['s']['staus'] = $sms_staus;
	$cr = @mysql_query( "SELECT * FROM mysms WHERE scontent='".$smstxt."' AND sto='".$_GET['dlso']."'" );
	if ( mysql_num_rows( $cr ) < 1 )
	{
		insert( $sms['s'], "mysms" );
	}
	else
	{
		update( $sms['s'], "mysms", "scontent='".$smstxt."' AND sto='".$_GET['dlso']."'" );
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
else
{
	$stv->display( "check.htm" );
}
?>
