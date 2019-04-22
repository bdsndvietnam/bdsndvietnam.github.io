<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/

if ( $_POST['submit'] && md5( md5( md5( $_POST['pw'] ) ) ) == $adminpass2 )
{
	$_SESSION['giaodich'] = "ok";
}
if ( $_SESSION['giaodich'] != "ok" )
{
	echo "<form method=\"post\">\r\n\t<div style=\"text-align: center\">\r\n\t\t<input name=\"pw\" type=\"password\" /><input name=\"submit\" type=\"submit\" value=\"Login\" /></div>\r\n</form>\r\n";
}
else
{
	
	$stv = new Smarty( );
	$masp = 200;
	$page = $_GET['page'];
	if ( $page )
	{
		--$page;
	}
	$bg = $page * $masp;
	if ( $_GET['page'] == "" )
	{
		$page = 1;
		$i = 0;
	}
	else
	{
		$page = $_GET['page'];
		$i = $bg;
	}
	if ( $_GET['del'] )
	{
		if ( $_GET['daxoa'] == 1 )
		{
			query( "DELETE FROM nhapxuat WHERE id='".$_GET['del']."'" );
		}
		else
		{
			query( "UPDATE nhapxuat SET xoa=1 WHERE id='".$_GET['del']."'" );
		}
	}
	if ( $_GET['daily'] )
	{
		$where = " AND daily='".$_GET['daily']."'";
	}
	if ( $_GET['daxoa'] )
	{
		$w = "WHERE xoa='1'";
	}
	else
	{
		$w = "WHERE xoa='0'";
	}
	if ( $_GET['text'] != "" )
	{
		if ( $_GET['v'] == 1 )
		{
			$w = "";
		}
		$where .= " AND (sosim LIKE '%".$_GET['text']."%' || hovaten LIKE '%".$_GET['text']."%')";
	}
	else
	{
		$where .= " AND (hovaten LIKE '%(AB)')";
	}
	$sql = query( "SELECT * FROM nhapxuat ".$w." {$where} order by id DESC limit {$bg},{$masp}" );
	$numrow = mysql_num_rows( mysql_query( "SELECT * FROM nhapxuat ".$w." {$where}" ) );
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
		$row['lai'] = $row['giaban'] - $row['gianhap'] + $row['gianhap'] * $row['hoahong'] / 100 + $row['phikhac'];
		$tongnhap1 += $row['gianhap'];
		$tonglai += $row['lai'];
		if ( $row['trangthai'] == 1 )
		{
			$row['sosim'] = "<a href='../daily/aindex.php?act=trangthai&id=".$row[id]."' rel='lyteframe' title='' rev='width: 400px; height: 300px; scrolling: no;'><span style='color:orange'>".$row['sosim']."</span></a>";
		}
		else if ( $row['trangthai'] == 2 )
		{
			$row['sosim'] = "<a href='../daily/aindex.php?act=trangthai&id=".$row[id]."' rel='lyteframe' title='' rev='width: 400px; height: 300px; scrolling: no;'> <span style='color:red'>".$row['sosim']."</span></a>";
		}
		else if ( $row['xoa'] == 1 )
		{
			$row['sosim'] = "<span style='color:#999999; background-color:#CCCCCC'>".$row['sosim']."</span>";
		}
		$row['gianhap'] = number_format( $row['gianhap'], 0, ",", "," );
		$row['giaban'] = number_format( $row['giaban'], 0, ",", "," );
		$data[] = $row;
	}
	$stv->assign( "tongnhap1", number_format( $tongnhap1 * 1000, 0, ",", "," ) );
	$stv->assign( "tongnhap2", number_format( $tongnhap2 * 1000, 0, ",", "," ) );
	$stv->assign( "tonglai", number_format( $tonglai * 1000, 0, ",", "," ) );
	$stv->assign( "tongam", number_format( $tongam * 1000, 0, ",", "." ) );
	$stv->assign( "data", $data );
	$stv->assign( "data2", $data2 );
	$stv->assign( "c_url", $c_url );
	$stv->assign( "paging", paging( $numrow, $page, 10, $masp ) );
	$q2 = mysql_query( "SELECT * FROM thanhvien WHERE live=1 ORDER BY id DESC" );
	while ( $r2 = mysql_fetch_array( $q2 ) )
	{
		$xvalues[] = $r2['id'];
		$xnames[] = $r2['hovaten'];
	}
	$stv->assign( "xvalues", $xvalues );
	$stv->assign( "xnames", $xnames );
	$stv->assign( "date", date( "d/m/Y" ) );
	if ( $_GET['in'] == 1 )
	{
		$stv->display( "ingiaodich.htm" );
	}
	else
	{
		$stv->display( "giaodich.htm" );
	}
}
?>
