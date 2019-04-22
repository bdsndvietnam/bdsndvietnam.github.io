<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/

class baogia
{

	public function daily( $simid )
	{
		$sql = mysql_query( "SELECT * FROM thanhvien WHERE id='".$simid."'" );
		$row = fecth( $sql );
		return $row['hovaten'];
	}

	public function del( $simid )
	{
		mysql_query( "DELETE FROM raobansim WHERE simid='".$id."'" );
	}


	public function xoaall( $arr )
	{
		foreach ( $arr as $key => $value )
		{
			mysql_query( "DELETE FROM raobansim WHERE id='".$value."'" );
		}
	}

}


$masp = 80;
$page = $_GET['page'];
if ( $page )
{
	--$page;
}
$bg = $masp * $page;
if ( $page == "" )
{
	$page = 1;
}
else
{
	$page = $_GET['page'];
}
if ( !$_GET['taive'] )
{
	$limit = "limit ".$bg.",{$masp}";
}
$sql = query( "SELECT * FROM raobansim ".$where." ".$_GET['post']['oder'].( " ".$limit ) );
$stv->assign( "mysql", urlencode( "SELECT * FROM raobansim ".$where." ".$_GET['post']['oder']."" ) );

if ( 0 < $_GET['delid'] )
{
	query( "DELETE FROM raobansim WHERE id='".$_GET['delid']."'" );
}

$i = 0;
while ( $row = fecth( $sql ) )
{
	++$i;
	$row['stt'] = $i;
	$row['giaban'] = number_format( $row['giaban'] * 1000000, 0, ",", "," );
	$row['gianhap'] = number_format( $row['gianhap'] * 1000000, 0, ",", "," );
	$data[] = $row;
}
$stv->assign( "paging", xstrang( $dem, $page, 10, $masp, "index.php?".$_SERVER['QUERY_STRING']."&page=" ) );
$stv->assign( "demsim", number_format( $dem, 0, ".", "." ) );
$stv->assign( "data", $data );
$stv->assign( "my_link", "?".$_SERVER['QUERY_STRING'] );
if ( isset( $_GET['taive'] ) )
{
	$filename = date( "s_i_H-d_m_Y" ).".xls";
	header( "Content-Type: application/vnd.ms-excel" );
	header( "Content-Disposition: attachment;filename=".$filename );
	header( "Pragma: no-cache" );
	header( "Expires: 0" );
	$stv->display( "download.htm" );
}
else
{
	$stv->display( "raosim.htm" );
}
?>
