<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/

require( "../ovikn.php" );
require( "../func/mysql.php" );
$sql = query( "SELECT * FROM my_cron where cr_staus=0 AND cr_times < ".time( )." ORDER BY cr_times  limit 10" );
while ( $row = fecth( $sql ) )
{
	if ( $row['cr_type'] == "get" )
	{
		$url_open = @file_get_contents( @str_replace( " ", "+", $row['cr_to'] ) );
		if ( $url_open )
		{
			@mysql_query( "update my_cron set cr_staus=1 WHERE id='".$row['id']."'" );
			echo $row['cr_to']." ok<br>";
		}
		else
		{
			echo $row['cr_to']." false <br>";
		}
	}
	else
	{
		$phones = split( ",", $row['cr_to'] );
		if ( is_array( $phones ) )
		{
			foreach ( $phones as $key => $value )
			{
				$sms_staus = 0;
				$sms['s']['sto'] = $value;
				$sms['s']['ssend'] = "0937666886";
				$sms['s']['scontent'] = $row['cr_msg'];
				$sms['s']['sdate'] = date( "h:i:s d/m/Y" );
				$sms['s']['staus'] = $sms_staus;
				$cr = @mysql_query( "SELECT * FROM mysms WHERE scontent='".$row['cr_msg']."' AND sto='".$value."'" );
				if ( mysql_num_rows( $cr ) < 1 )
				{
					insert( $sms['s'], "mysms" );
					@mysql_query( "update my_cron set cr_staus=1 WHERE id='".$row['id']."'" );
				}
				else
				{
					update( $sms['s'], "mysms", "scontent='".$row['cr_msg']."' AND sto='".$value."'" );
				}
			}
		}
		else
		{
			$sms_staus = 0;
			$sms['s']['sto'] = $row['cr_to'];
			$sms['s']['ssend'] = "0937666886";
			$sms['s']['scontent'] = $row['cr_msg'];
			$sms['s']['sdate'] = date( "h:i:s d/m/Y" );
			$sms['s']['staus'] = $sms_staus;
			$cr = @mysql_query( "SELECT * FROM mysms WHERE scontent='".$row['cr_msg']."' AND sto='".$row['cr_to']."'" );
			if ( mysql_num_rows( $cr ) < 1 )
			{
				insert( $sms['s'], "mysms" );
				@mysql_query( "update my_cron set cr_staus=1 WHERE id='".$row['id']."'" );
			}
			else
			{
				update( $sms['s'], "mysms", "scontent='".$row['cr_msg']."' AND sto='".$row['cr_to']."'" );
			}
		}
	}
}
?>
