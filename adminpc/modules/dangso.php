<?php
function dangsotutext( $data )
{
	if ( $_POST['c'] == "Y" )
	{
		mysql_query( "DELETE FROM simso WHERE simdl='".$_POST['select']."'" );
	}
	$e = explode( "\r\n", $data );
	$p['p']['simdl'] = $_POST['select'];
	$j = 0;
	$i = 0;
	for ( ;	$i < count( $e ) - 1;	$i++	)
	{
		list( $sosim, $gianhap ) = split( "\t", $e[$i] );
		if ( $_POST['donvi'] == 1 )
		{
			$gianhap = replace( $gianhap ) * 1000;
		}
		if ( $_POST['donvi'] == 2 )
		{
			$gianhap = soreplace( $gianhap ) * 1000000;
		}
		else
		{
			$gianhap = replace( $gianhap );
		}
		$sim1x = preg_replace( "/[^0-9.]/", "", $sosim );
		$sim2x = replace( $sosim );
		if ( strlen( $sim2x ) == 10 && substr( $sim2x, 0, 1 ) == 1 || strlen( $sim2x ) == 9 && substr( $sim2x, 0, 1 ) == 9 )
		{
			$sim2x = "0".$sim2x;
			$sim1x = "0".$sim1x;
		}
		$dlid = $_POST['select'];
		if ( checkso( $sim2x, $gianhap ) )
		{
			$datapost['s'][$sim2x] = $sim1x."-".$gianhap;
		}
	}
	$m = 0;
	foreach ( $datapost['s'] as $sg )
	{
		$m++;
		list( $sim1x, $gianhap ) = split( "-", $sg );
		if ( 100000 < $gianhap )
		{
			$p['p']['gianhap'] = $gianhap / 1000000;
		}
		else
		{
		}
		if ( $_SESSION['pt'] == 1 )
		{
			$giaban = tangpt( $giaban, $_POST['select'] );
		}
		$p['p']['sim1'] = $sim1x;
		$p['p']['sim2'] = replace( $sim1x );
		$p['p']['giaban'] = $giaban;
		$valuesx[] = "('".$p['p']['sim1']."', '".$p['p']['sim2']."','".$p['p']['gianhap']."', '".$_POST['select']."')";
		$j++;
		if ( $m == 5000 )
		{
			mysql_query( "INSERT INTO `simso` (`sim1`, `sim2`, `gianhap`, `simdl`) VALUES ".join( ",", $valuesx ).";" );
			$m = 0;
			unset( $valuesx );
		}
	}
	if ( 0 < $m && $m < 5000 )
	{
		mysql_query( "INSERT INTO `simso` (`sim1`, `sim2`, `gianhap`, `simdl`) VALUES ".join( ",", $valuesx ).";" );
		unset( $valuesx );
	}
	echo thongbao( "Bạn đã đăng thành công ".$j." số !" );
}


$stv = new Smarty( );
if ( $_POST['submit'] )
{
	if ( $_POST['textsim'] == "" )
	{
		$handle = @fopen( "data.txt", "r" );
		$p['p']['simdl'] = $_POST['select'];
		$p['p']['ngaynhap'] = ngay( );
		$p['p']['usernhap'] = $_SESSION['username'];
		$j = 0;
		if ( $handle )
		{
			while ( !feof( $handle ) )
			{
				$lineso = fgets( $handle, 4096 );
				list( $sosim, $gianhap ) = split( "\t", $lineso );
				if ( $_POST['donvi'] == 1 )
				{
					$gianhap = soreplace( $gianhap ) * 1000;
				}
				if ( $_POST['donvi'] == 2 )
				{
					$gianhap = soreplace( $gianhap ) * 1000000;
				}
				if ( checkso( $sosim, $giaban ) )
				{
					$giaban = replace( $giaban );
					if ( $gianhap == "" )
					{
						$p['p']['gianhap'] = $giaban;
					}
					else
					{
						$p['p']['gianhap'] = replace( $gianhap );
					}
					if ( $_SESSION['pt'] == 1 )
					{
						$giaban = tangpt( $giaban, $_POST['select'] );
					}
					$p['p']['sim1'] = soreplace( $sosim );
					$p['p']['sim2'] = replace( $sosim );
					$test = query( "SELECT sim2 FROM simso WHERE sim2='".replace( $sosim )."'" );
					if ( 0 < @mysql_num_rows( $test ) )
					{
						update( $p['p'], "simso", "sim2=".replace( $sosim ) );
					}
					else
					{
						insert( $p['p'], "simso" );
						$j++;
					}
				}
			}
			echo thongbao( "Bạn đã đăng thành công ".$j." số !" );
			fclose( $handle );
		}
	}
	else
	{
		dangsotutext( $_POST['textsim'] );
	}
}
$q = query( "SELECT * FROM thanhvien ORDER BY live DESC" );
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