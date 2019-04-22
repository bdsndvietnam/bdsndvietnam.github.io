<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/

function sms( $message )
{
	$url = "http://serversms.gotdns.com:9333/ozeki?action=sendMessage&login=admin&password=hyn123&recepient=0914779999&messageData=".$message."&sender=tong";
	if ( $f = @fopen( $url, “r” ) )
	{
		fgets( $f, 255 );
	}
}

sms( "test cai" );
?>
