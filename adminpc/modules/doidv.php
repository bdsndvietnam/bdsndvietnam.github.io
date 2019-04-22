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
	$e = explode( "\r\n", $_POST['txtsim'] );
	$i = 0;
	for ( ;	$i < count( $e ) - 1;	++$i	)
	{
		list( $sosim, $giaban ) = split( "\t", $e[$i] );
		$e2 = explode( "tr", $giaban );
		if ( 1 < count( $e2 ) )
		{
			$giaban = preg_replace( "/[^0-9,.]/", "", $giaban );
			$giaban = str_replace( ",", ".", $giaban );
			$simx .= $sosim."\t".$giaban * $_POST['donvi']."\r\n";
		}
		else
		{
			$simx .= $sosim."\t".$giaban."\r\n";
		}
	}
}
echo "\r\n<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\r\n<html xmlns=\"http://www.w3.org/1999/xhtml\">\r\n\r\n<head>\r\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\r\n<title>Đổi đơn vị tiền</title>\r\n</head>\r\n\r\n<body>\r\n\r\n<form method=\"post\">\r\n\t\t<div style=\"text-align: center\">\r\n\t\t\t\t<textarea name=\"txtsim\" style=\"width: 315px; height: 347px\">";
echo $simx;
echo "</textarea><br />\r\n\t\t\t\t<input name=\"donvi\" type=\"text\" style=\"width: 59px\" /><input name=\"submit\" type=\"submit\" value=\"submit\" /></div>\r\n</form>\r\n\r\n</body>\r\n\r\n</html>";
?>
