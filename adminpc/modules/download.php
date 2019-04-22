<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/

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
require( "ovikn.php" );
require( "libs/Smarty.class.php" );
require( "func/mysql.php" );

$stv = new Smarty( );
if ( $_POST['gia1'] != "" && $_POST['gia2'] != "" )
{
	$where .= "AND (giaban >= ".replace( $_POST['gia1'] )." && giaban <= ".replace( $_POST['gia2'] ).")";
}
foreach ( $GLOBALS['_POST']['c'] as $k => $v )
{
	foreach ( $mang['s'][$v] as $value )
	{
		if ( strlen( $value ) == 4 )
		{
			$jo1[] = "'".$value."'";
		}
		else if ( strlen( $value ) == 3 )
		{
			$jo2[] = "'".$value."'";
		}
	}
}
if ( $jo1 && $jo2 )
{
	$w[] = "left(sim2,4) IN(".join( ", ", $jo1 ).") || left(sim2,3) IN(".join( ", ", $jo2 ).")";
	if ( $jo1 )
	{
		$w[] = "left(sim2,4) IN(".join( ", ", $jo1 ).")";
	}
}
else if ( $jo2 )
{
	$w[] = "left(sim2,3) IN(".join( ", ", $jo2 ).")";
}
$where .= " AND (".join( " || ", $w ).")";
$where .= " AND (".join( " AND ", $kieu[$_POST['sloai']] ).")";
$sql = query( "SELECT sim1,giaban FROM simso WHERE sim2 ".$where." limit 15000" );
if ( $_POST['r'] == 1 )
{
	$filename = $_POST['sloai'].".xls";
	header( "Content-Type: application/vnd.ms-excel" );
	header( "Content-Disposition: attachment;filename=".$filename );
	header( "Pragma: no-cache" );
	header( "Expires: 0" );
}
else if ( $_POST['r'] == 2 )
{
	$filename = $_POST['sloai'].".doc";
	header( "Content-type: application/doc" );
	header( "Content-Disposition: attachment;filename=".$filename );
	header( "Pragma: no-cache" );
	header( "Expires: 0" );
}
else if ( $_POST['r'] == 3 )
{
	$filename = $_POST['sloai'].".html";
	header( "Content-type: application/html" );
	header( "Content-Disposition: attachment;filename=".$filename );
	header( "Pragma: no-cache" );
	header( "Expires: 0" );
}
else
{
	$filename = $_POST['sloai'].".pdf";
	@header( "Cache-Control: " );
	@header( "Pragma: " );
	@header( "Content-type: application/octet-stream" );
	@header( "Content-Disposition: attachment; filename=".$filename );
}
$i = 0;
while ( $row = fecth( $sql ) )
{
	++$i;
	$row['stt'] = $i;
	$row['giaban'] = number_format( $row['giaban'], 0, ",", "," );
	$row['loai'] = $loai['s'][$_POST['sloai']];
	$row['mang'] = checkm( str_replace( ".", "", $row['sim1'] ) );
	$data[] = $row;
}
$stv->assign( "data", $data );
$stv->assign( $myinfo );
@mysql_close( );
$stv->display( "download.htm" );
?>
