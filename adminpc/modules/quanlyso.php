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
		mysql_query( "DELETE FROM simso WHERE simid='".$simid."'" );
	}

	public function dauso( )
	{
		$sql = query( "SELECT left(sim2,4) AS dau FROM simso GROUP BY left(sim2,4) ORDER by left(sim2,4) DESC" );
		while ( $row = fecth( $sql ) )
		{
			$arr[] = $row['dau'];
		}
		return $arr;
	}

	public function xoaall( $arr )
	{
		foreach ( $arr as $key => $value )
		{
			mysql_query( "DELETE FROM simso WHERE simid='".$value."'" );
		}
	}

	public function suall( $arr1, $arr2 )
	{
		if ( is_array( $arr1 ) )
		{
			foreach ( $arr1 as $k => $v )
			{
				if ( isset( $_POST['sua'][$k] ) )
				{
					$arr2[$k][gianhap] = replace( $arr2[$k][gianhap] ) / 1000000;
					$arr2[$k][giaban] = replace( $arr2[$k][giaban] ) / 1000000;
					update( $arr2[$k], "simso", "simid='".$k."'" );
				}
			}
		}
	}

}

function checkm( $sosim )
{
	$mang['s']['VinaPhone'] = array( "091", "094", "0123", "0125", "0127", "0129" );
	$mang['s']['MobiFone'] = array( "090", "093", "0120", "0121", "0122", "0126", "0128" );
	$mang['s']['Viettel'] = array( "097", "098", "0168", "0169", "0167", "0165", "0166" );
	$mang['s']['VNMobile'] = array( "092" );
	$mang['s']['Sfone'] = array( "095" );
	$mang['s']['Beeline'] = array( "0199" );
	if ( strlen( $sosim ) == 11 )
	{
		$dau = substr( $sosim, 0, 4 );
	}
	else
	{
		$dau = substr( $sosim, 0, 3 );
	}
	if ( in_array( $dau, $mang['s']['VinaPhone'] ) )
	{
		return "VinaPhone";
	}
	if ( in_array( $dau, $mang['s']['MobiFone'] ) )
	{
		return "MobiFone";
	}
	if ( in_array( $dau, $mang['s']['Viettel'] ) )
	{
		return "Viettel";
	}
	if ( in_array( $dau, $mang['s']['VNMobile'] ) )
	{
		return "VNMobile";
	}
	if ( in_array( $dau, $mang['s']['Sfone'] ) )
	{
		return "Sfone";
	}
	if ( in_array( $dau, $mang['s']['Beeline'] ) )
	{
		return "Beeline";
	}
}

if ( !stv_code )
{
	check_code( 0 );
}

$stv = new Smarty( );
$q2 = mysql_query( "SELECT * FROM thanhvien WHERE live > 0 and  order by hovaten asc" );
while ( $r2 = mysql_fetch_array( $q2 ) )
{
	$id[] = $r2['id'];
	$hovaten[] = $r2['hovaten'];
}
$stv->assign( "hovaten", $hovaten );
$stv->assign( "id", $id );

$red = new baogia( );
if ( $_GET['del'] )
{
	$red->del( $_GET['del'] );
}
$stv->assign( "dauso", $red->dauso( ) );
if ( isset( $_POST['xoaall'] ) )
{
	$red->xoaall( $_POST['check'] );
}
$red->suall( $_POST['sua'], $_POST['p'] );
$stv->assign( "loaisim", $loai['s'] );
$where = "WHERE sim2";
$txtsim = $_GET['post']['search'];
$txtsim = str_replace( array( ".", " " ), array( "", "" ), $txtsim );
if ( $txtsim != "" )
{
	$spot = strpos( $txtsim, "*" );
}
$slen = strlen( $txtsim );
if ( stristr( $txtsim, "*" ) === FALSE )
{
	$txtsim = str_replace( array( "x", "X", "*" ), array( "[0-9]", "[0-9]", ".*" ), $txtsim );
	$where = "WHERE sim2 rlike'.*".$txtsim.".*'";
}
else
{
	$txtsim = str_replace( array( "x", "X", "*" ), array( "[0-9]", "[0-9]", ".*" ), $txtsim );
	if ( $spot == 0 )
	{
		$where = "WHERE sim2 rlike '".$txtsim."\$'";
	}
	else if ( $spot == $slen - 1 )
	{
		$where = "WHERE sim2 rlike '^".$txtsim."'";
	}
	else
	{
		$where = "WHERE sim2 rlike '^".$txtsim."\$'";
	}
}
if ( is_array( $_GET['n'] ) )
{
	foreach ( $GLOBALS['_GET']['n'] as $v )
	{
		$vv .= $v;
	}
	$where .= " AND sim2 NOT rlike'[".$vv."]'";
}
if ( $_GET['post']['dauso'] != 0 )
{
	$where .= " AND left(sim2,4)='".$_GET['post']['dauso']."'";
}
if ( $_GET['post']['daily'] != 0 )
{
	$where .= " AND simdl='".$_GET['post']['daily']."'";
}
if ( 1 < strlen( $_GET[post][loaisim] ) )
{
	foreach ( $loai['s'] as $my_k => $my_v )
	{
		if ( $_GET['post']['loaisim'] == $my_v )
		{
			$where .= " AND (".join( " AND ", $kieu[$my_k] ).")";
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
$sql = query( "SELECT * FROM simso ".$where." and daily='".$_SESSION['dailyid']."' ".$_GET['post']['oder'].( " ".$limit ) );
$dem = mysql_num_rows( query( "SELECT * FROM simso ".$where." ".$_GET['post']['oder']."" ) );
$stv->assign( "mysql", urlencode( "SELECT * FROM simso ".$where." ".$_GET['post']['oder']."" ) );
if ( $_GET['delsearch'] == "yes" )
{
	query( "DELETE FROM simso ".$where );
}
$i = 0;
while ( $row = fecth( $sql ) )
{
	++$i;
	$row['daily'] = $red->daily( $row['simdl'] );
	$row['stt'] = $i;
	$row['giaban'] = number_format( $row['giaban'] * 1000000, 0, ",", "," );
	$row['gianhap'] = number_format( $row['gianhap'] * 1000000, 0, ",", "," );
	$row['mang'] = checkm( $row['sim2'] );
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
	$stv->display( "baogia.htm" );
}
?>
