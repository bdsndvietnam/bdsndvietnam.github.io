<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/

if ( $_POST['submit'] )
{
	
	$stv = new Smarty( );
	if ( $_POST['submit'] )
	{
		$where = " AND daily='".$_POST['Select1']."'";
	}
	$sql = query( "SELECT * FROM nhapxuat WHERE xoa='0'".$where." order by id DESC" );
	$i = 0;
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
		$dailythu += $row['gianhap'] - $row['gianhap'] * $row['hoahong'] / 100;
		$tonglai += $row['lai'];
		$row['lai'] = number_format( $row['lai'] * 1000, 0, ".", "." );
		if ( $row['trangthai'] == 1 )
		{
			$row['sosim'] = "<span style='color:orange'>".$row['sosim']."</span>";
		}
		else if ( $row['trangthai'] == 2 )
		{
			$row['sosim'] = "<span style='color:red'>".$row['sosim']."</span>";
		}
		else
		{
			$row['sosim'] = "".$row['sosim']."";
		}
		$row['giaban'] = number_format( $row['giaban'] * 1000, 0, ".", "." );
		$row['gianhap'] = number_format( $row['gianhap'] * 1000, 0, ".", "." );
		if ( $row['giaban'] == 0 )
		{
			$row['kieu'] = "Nhập/G.Ko Thu";
		}
		else
		{
			$row['kieu'] = "Đ.Lý Giao Hộ";
		}
		$data[] = $row;
	}
	$stv->assign( "so", $i );
	$stv->assign( "dailythu", number_format( $dailythu * 1000, 0, ".", "." ) );
	$stv->assign( "tongnhap1", number_format( $tongnhap1 * 1000, 0, ".", "." ) );
	$stv->assign( "tongnhap2", number_format( $tongnhap2 * 1000, 0, ".", "." ) );
	$stv->assign( "tonglai", number_format( $tonglai * 1000, 0, ".", "." ) );
	$stv->assign( "tongam", number_format( $tongam * 1000, 0, ".", "." ) );
	$stv->assign( "data", $data );
	$stv->assign( "data2", $data2 );
	$stv->assign( "dates", date( "d/m/Y", $ntime ) );
	$stv->assign( "bandang", number_format( 0 - ( $tongam + $tonglai ) * 1000, 0, ".", "." ) );
	$s = query( "SELECT hovaten FROM thanhvien WHERE id='".$_POST['Select1']."'" );
	$sr = fecth( $s );
	$filename = str_replace( " ", "_", xds( $sr['hovaten'] ) ).date( "d_m_Y" ).".xls";
	header( "Content-Type: application/vnd.ms-excel" );
	header( "Content-Disposition: attachment;filename=".$filename );
	header( "Pragma: no-cache" );
	header( "Expires: 0" );
	$stv->display( "taive.htm" );
}
else
{
	
	$stv = new Smarty( );
	$q2 = mysql_query( "SELECT * FROM thanhvien WHERE live=1 ORDER BY id DESC" );
	while ( $r2 = mysql_fetch_array( $q2 ) )
	{
		$xvalues[] = $r2['id'];
		$xnames[] = $r2['hovaten'];
	}
	$stv->assign( "xvalues", $xvalues );
	$stv->assign( "xnames", $xnames );
	$stv->display( "taive2.htm" );
}
?>
