<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/

function extractZip( $zipFile = "", $dirFromZip = "" )
{
	define( DIRECTORY_SEPARATOR, "/" );
	$zipDir = getcwd( ).DIRECTORY_SEPARATOR;
	$zip = zip_open( $zipDir.$zipFile );
	if ( $zip )
	{
		while ( $zip_entry = zip_read( $zip ) )
		{
			$completePath = $zipDir.dirname( zip_entry_name( $zip_entry ) );
			$completeName = $zipDir.zip_entry_name( $zip_entry );
			if ( !file_exists( $completePath ) || preg_match( "#^".$dirFromZip.".*#", dirname( zip_entry_name( $zip_entry ) ) ) )
			{
				$tmp = "";
				foreach ( explode( "/", $completePath ) as $k )
				{
					$tmp .= $k."/";
					if ( !file_exists( $tmp ) )
					{
						@mkdir( $tmp, 511 );
					}
				}
			}
			if ( !zip_entry_open( $zip, $zip_entry, "r" ) && !preg_match( "#^".$dirFromZip.".*#", dirname( zip_entry_name( $zip_entry ) ) ) )
			{
				if ( $fd = @fopen( $completeName, "w+" ) )
				{
					fwrite( $fd, zip_entry_read( $zip_entry, zip_entry_filesize( $zip_entry ) ) );
					fclose( $fd );
				}
				else
				{
					mkdir( $completeName, 511 );
				}
				zip_entry_close( $zip_entry );
			}
		}
		zip_close( $zip );
	}
	return TRUE;
}

function dangsotutext( $data )
{
	$e = explode( "\r\n", $data );
	$p['p']['simdl'] = $_POST['select'];
	$p['p']['ngaynhap'] = ngay( );
	$p['p']['usernhap'] = $_SESSION['username'];
	$j = 0;
	$i = 0;
	for ( ;	$i < count( $e ) - 1;	++$i	)
	{
		list( $sosim, $giaban, $gianhap ) = split( "\t", $e[$i] );
		if ( $_POST['donvi'] == 1 )
		{
			$giaban = replace( $giaban ) * 1000;
			$gianhap = replace( $gianhap ) * 1000;
		}
		if ( $_POST['donvi'] == 2 )
		{
			$giaban = soreplace( $giaban ) * 1000000;
			$gianhap = soreplace( $gianhap ) * 1000000;
		}
		else
		{
			$giaban = replace( $giaban );
			$gianhap = replace( $gianhap );
		}
		$sim1x = soreplace( $sosim );
		$sim2x = replace( $sosim );
		$dlid = $_POST['select'];
		if ( checkso( $sim2x, $giaban ) )
		{
			$datapost['s'][$sim2x] = $sim1x."-".$giaban."-".$gianhap;
		}
	}
	foreach ( $datapost['s'] as $sg )
	{
		list( $sim1x, $giaban, $gianhap ) = split( "-", $sg );
		if ( 100000 < $gianhap )
		{
			$p['p']['gianhap'] = $gianhap;
		}
		else
		{
			$p['p']['gianhap'] = $giaban;
		}
		if ( $_SESSION['pt'] == 1 )
		{
			$giaban = tangpt( $giaban, $_POST['select'] );
		}
		$p['p']['sim1'] = $sim1x;
		$p['p']['sim2'] = replace( $sim1x );
		$p['p']['giaban'] = $giaban;
		$test = query( "SELECT sim2 FROM simso WHERE sim2='".$sim2x."'" );
		if ( mysql_num_rows( $test ) < 1 )
		{
			insert( $p['p'], "simso" );
			++$j;
		}
	}
	echo thongbao( "Bạn đã đăng thành công ".$j." số !" );
}

set_time_limit( 18000 );

$stv = new Smarty( );
if ( $_POST['submit'] )
{
	dangsotutext( $_POST['textsim'] );
}
$q = query( "SELECT * FROM thanhvien WHERE live='1'" );
while ( $r = fecth( $q ) )
{
	$oid[] = $r['id'];
	$oname[] = $r['hovaten'];
}
$stv->assign( "oid", $oid );
$stv->assign( "oname", $oname );
mysql_close( );
$stv->display( "dangso.htm" );
?>
