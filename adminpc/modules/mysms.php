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
if ( !$_GET['action'] )
{
	
	$stv = new Smarty( );
	$masp = 100;
	$page = $_GET['page'];
	if ( $page )
	{
		--$page;
	}
	$bg = $masp * $page;
	if ( $_GET['page'] == "" )
	{
		$page = 1;
	}
	if ( isset( $_POST['submit'] ) && is_array( $_POST['check'] ) )
	{
		foreach ( $GLOBALS['_POST']['check'] as $v )
		{
			$sx = mysql_query( "SELECT * FROM mysms WHERE id='".$v."'" );
			$rx = mysql_fetch_array( $sx );
			if ( $rx['sstaus'] == 2 )
			{
				$stausx = 0;
			}
			else if ( $rx['sstaus'] == 0 )
			{
				$stausx = 2;
			}
			mysql_query( "update mysms SET sstaus='".$stausx."' WHERE id='".$v."'" );
		}
	}
	$order = "order by id DESC";
	if ( $_GET['type'] == "3" )
	{
		$where = "WHERE sstaus =2";
	}
	else if ( $_GET['type'] == "1" )
	{
		$where = "WHERE type=1 AND sstaus IN(0,1) AND right(sdate,10)='".date( "d/m/Y" )."'";
	}
	else if ( $_POST['search'] )
	{
		$where = "WHERE scontent like '%".$_POST['search']."%' OR sto like '%".$_POST['search']."%'";
	}
	else if ( $_GET['type'] == "0" )
	{
		$where = "WHERE sstaus IN(0,1) and type=0 AND right(sdate,10)='".date( "d/m/Y" )."'";
	}
	else
	{
		$where = "WHERE sstaus IN(0,1)";
		$order = "order by id DESC";
	}
	if ( $_GET['del'] )
	{
		mysql_query( "UPDATE mysms SET sstaus=2 WHERE id='".$_GET['del']."'" );
	}
	$sql = query( "SELECT * FROM mysms ".$where." {$order} limit {$bg},{$masp}" );
	if ( $page == 1 )
	{
		$i = 0;
	}
	else
	{
		$i = $bg;
	}
	while ( $row = fecth( $sql ) )
	{
		++$i;
		if ( $i % 2 == 0 )
		{
			$row['class'] = "b2";
		}
		else
		{
			$row['class'] = "b1";
		}
		$row['stt'] = $i;
		$data[] = $row;
	}
	$stv->assign( "my_url", "?".$_SERVER['QUERY_STRING'] );
	$stv->assign( "data", $data );
	$stv->display( "mysms.htm" );
}
else
{
	function send( $id )
	{
		$q = mysql_query( "SELECT * FROM mysms WHERE id='".$id."'" );
		$r = mysql_fetch_array( $q );
		
		$smsx = new xstv_sms( );
		$stv_check = $smsx->check_login( $myinfo[my_sms_number], $myinfo[my_sms_pass] );
		if ( $stv_check )
		{
			$stv_send = $smsx->send_sms( preg_replace( "/[^0-9]/", "", $r['sto'] ), $r['scontent'] );
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
		$sms['s']['sto'] = $r['sto'];
		$sms['s']['ssend'] = $myinfo[my_sms_number];
		$sms['s']['scontent'] = $r['scontent'];
		$sms['s']['sdate'] = date( "h:i:s d/m/Y" );
		$sms['s']['staus'] = $sms_staus;
		update( $sms['s'], "mysms", "id='".$id."'" );
		if ( $sms_staus == 1 )
		{
			return "<script>alert('Tin nhắn đang được gửi tới ".$r['sto']." !')</script>";
		}
		return "<script>alert('Ko gửi được tin nhắn tới ".$r['sto']." Vui lòng thử lại')</script>";
	}
	if ( 1 < intval( $_GET['send'] ) )
	{
		echo send( $_GET['send'] );
	}
	function setstaus( $id )
	{
		mysql_query( "UPDATE mysms Set staus=1 WHERE id='".$id."'" );
		return "<strong style=\"color: #008000\">OK</strong>";
	}
	if ( $sms_staus == 1 )
	{
		echo setstaus( $_GET['id'] );
	}
}
?>
