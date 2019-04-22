<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/

if ( $_POST['submit'] && md5( md5( md5( $_POST['pw'] ) ) ) == "0a1f0a4ec292283f25bd340623f58bd7" )
{
	$_SESSION['giaodich'] = "ok";
}
if ( $_SESSION['giaodich'] != "ok" )
{
	echo "<form method=\"post\">\r\n\t<div style=\"text-align: center\">\r\n\t\t<input name=\"pw\" type=\"password\" /><input name=\"submit\" type=\"submit\" value=\"Login\" /></div>\r\n</form>\r\n";
}
else
{
	( );
	$stv = new Smarty( );
	$masp = 50;
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
	else
	{
		$page += 1;
	}
	if ( $page == 1 )
	{
		$i = 0;
	}
	else
	{
		$i = $bg;
	}
	if ( isset( $_GET['active'] ) )
	{
		if ( $_GET['active'] == 0 )
		{
			$p['k']['pt'] = 1;
		}
		else
		{
			$p['k']['pt'] = 0;
		}
		update( $p['k'], "thanhvien", "id='".$_GET['id']."'" );
	}
	if ( 0 < $_GET['delid'] )
	{
		mysql_query( "DELETE FROM thanhvien WHERE id='".$_GET['delid']."'" );
	}
	if ( isset( $_GET['search'] ) )
	{
		$sql = mysql_query( "SELECT * FROM thanhvien WHERE hovaten LIKE '%".$_GET['text']."%' || mobile LIKE '%".$_GET['text'].( "%' order by hovaten limit ".$bg.",{$masp}" ) );
		$dem = mysql_num_rows( mysql_query( "SELECT * FROM thanhvien WHERE hovaten LIKE '%".$_GET['text']."%' || mobile LIKE '%".$_GET['text']."%'" ) );
	}
	else
	{
		$sql = mysql_query( "SELECT * FROM thanhvien WHERE live > 0 order by hovaten asc limit 200" );
		$dem = mysql_num_rows( $sql = mysql_query( "SELECT * FROM thanhvien WHERE live > 0" ) );
	}
	while ( $row = fecth( $sql ) )
	{
		++$i;
		$row['stt'] = $i;
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
	$stv->assign( "data", $data );
	$stv->assign( "c_url", $c_url );
	$stv->assign( "paging", paging( $dem, $page, 10, $masp ) );
	$stv->display( "thanhvien.htm" );
	mysql_close( $ccom );
}
?>
