<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/

ini_set( 0 );
require( "../ovikn.php" );
require( "../func/mysql.php" );
@query( "DELETE FROM yeucausim WHERE ngayketthuc <= (".@time( )."- ngaybatdau)" );
@query( "DELETE FROM yeucausim WHERE ngaybatdau <= (".@time( )."- 604800) AND active=0" );
$q = query( "SELECT * FROM yeucausim WHERE active=1 AND send < 5" );
$i = 0;
while ( $r = fecth( $q ) )
{
	++$i;
	if ( count( explode( "*", $r['sosim'] ) ) == 2 )
	{
		if ( substr( $r['sosim'], 0, 1 ) == "*" )
		{
			$like = "WHERE sim2 LIKE '%".replace( $r['sosim'] )."'";
		}
		else if ( substr( $r['sosim'], -1, 1 ) == "*" )
		{
			$like = "WHERE sim2 LIKE '".replace( $r['sosim'] )."%'";
		}
		else
		{
			list( $d1, $c1 ) = split( "[*]", $r['sosim'] );
			$like = "WHERE (left(sim2,".strlen( $d1 ).")='".$d1."' AND right(sim2,".strlen( $c1 ).") ='".$c1."')";
		}
	}
	else
	{
		$like = "WHERE sim2 LIKE '%".replace( $r['sosim'] )."'";
	}
	$dem = mysql_num_rows( mysql_query( "SELECT * FROM simso ".$like ) );
	if ( 0 < $dem )
	{
		$q2 = query( "SELECT * FROM simso ".$like." limit 39" );
		$s = 0;
		$x = 1;
		while ( $r2 = fecth( $q2 ) )
		{
			++$s;
			if ( $s == 8 )
			{
				++$x;
				$s = 0;
				$mymobi[$i] = $r['mobile'];
				$mysend[$i] = $r['send'];
				++$i;
			}
			$str[$i] .= $r2['sim2']."-".$r2['giaban']."tr \n";
			if ( $dem < 2 )
			{
				$str[$i] .= "Yeu Cau sim ( ".$r['sosim']." ) cua ban da tim thay, Lien he voi chung toi de dat mua!";
			}
		}
		mysql_query( "UPDATE yeucausim Set send='".( $r['send'] + $x )."' WHERE mobile='".$r['mobile']."'" );
		$mymobi[$i] = $r['mobile'];
		$mysend[$i] = $r['send'];
	}
}

$curl = new curl( );
$curl->makeRequest( "post", "http://wap.mobifone.com.vn/wap/xhtml/mypage/checkPassword.jsp", "username=0937666886&password=hyn123&remember=1&submit=Ok" );
foreach ( $str as $k => $v )
{
	if ( $mymobi[$k] != "" )
	{
		$curl->makeRequest( "post", "http://wap.mobifone.com.vn/wap/xhtml/mypage/sms/result.jsp?lang=vn&action=mypage", "phonenum=".preg_replace( "/[^0-9]/", "", $mymobi[$k] )."&message=".$v."&submit=Ok" );
		sleep( 5 );
	}
}
?>
