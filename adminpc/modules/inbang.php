<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/

require( "ovikn.php" );
require( "libs/Smarty.class.php" );
require( "func/mysql.php" );
if ( isset( $_GET['daily'] ) )
{
	$sql = query( "SELECT * FROM simso WHERE simdl='".$_GET['daily']."'" );
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
		$row['mang'] = checkm( $row['sim2'] );
		$data[] = $row;
	}
	$stv->assign( "data", $data );
}
$q2 = mysql_query( "SELECT * FROM thanhvien WHERE live=1 ORDER BY id DESC" );
while ( $r2 = mysql_fetch_array( $q2 ) )
{
	$xvalues[] = $r2['id'];
	$xnames[] = $r2['hovaten'];
}
$stv->display( "inbang.htm" );
?>
