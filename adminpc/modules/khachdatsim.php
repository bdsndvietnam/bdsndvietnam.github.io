<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/

function notes( $id )
{
	$sql = mysql_query( "SELECT * FROM notes where mid='".$id."'" );
	$dem = @mysql_numrows( $sql );
	if ( 0 < $dem )
	{
		return $dem;
	}
}


$stv = new Smarty( );
$masp = 50;
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
if ( 0 < intval( $_GET['delid'] ) )
{
	if ( $_GET['rac'] == "1" )
	{
		mysql_query( "UPDATE yeucausim SET trangthai='' WHERE id='".$_GET[delid]."'" );
	}
	else
	{
		mysql_query( "UPDATE yeucausim SET trangthai='Xóa' WHERE id='".$_GET[delid]."'" );
	}
}
if ( $_GET['rac'] == "1" )
{
	$where = "WHERE trangthai='Xóa'";
}
else if ( $_GET['type'] == "Show" )
{
	$where = "WHERE sosim";
}
else
{
	$where = "WHERE trangthai!='Xóa'";
}
if ( $_GET['type'] == "Show" )
{
	$gdate = $_GET[Date_Day]."/".$_GET[Date_Month]."/".$_GET[Date_Year];
	if ( $gdate != date( "j/m/Y" ) )
	{
		$where .= " AND ngaygio LIKE '%".$gdate."'";
	}
	if ( $_GET['ncity'] != "0" )
	{
		$where .= " AND city='".$_GET['ncity']."' AND trangthai!='Xóa'";
	}
	if ( 0 < $_GET['number'] )
	{
		$where .= " AND (sosim like '%".preg_replace( "/[^0-9]/", "", $_GET['number'] )."%' OR dienthoai like '%".preg_replace( "/[^0-9]/", "", $_GET['number'] )."%')";
	}
	if ( $_GET['fullname'] != "Họ Và tên khách hàng" && $_GET['fullname'] != "" )
	{
		$where .= " AND fname LIKE '%".$_GET['fullname']."%'";
	}
	if ( $_GET['group'] == 1 )
	{
		$where .= " GROUP BY oid";
	}
}
$sql = mysql_query( "SELECT * FROM yeucausim ".$where." order by id desc limit {$bg},{$masp}" );
while ( $row = mysql_fetch_array( $sql ) )
{
	++$i;
	$row['stt'] = $i;
	$row['notes'] = notes( $row['id'] );
	if ( $row['trangthai'] == "Xóa" )
	{
		$row['sosim'] = "<span style=\"background-color: #CCCCCC\">".$row['sosim']."</span>";
	}
	else
	{
		$row['sosim'] = $row['sosim'];
	}
	$row['giatien'] = number_format( $row['giatien'], 0, ".", "." );
	$data[] = $row;
}
$stv->assign( "data", $data );
$stv->assign( "citys", $city[s] );
$stv->assign( $myinfo );
$querys = mysql_query( "SELECT id FROM my_order ".$where." limit 300" );
$numrow = mysql_num_rows( $querys );
$stv->assign( "paging", paging( $numrow, $page, 10, $masp ) );
$stv->display( "xhome.htm" );
?>
