<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/

if ( isset( $_POST['submit'] ) )
{
	$e = explode( "\r\n", $_POST['txtso'] );
	$k = 0;
	$i = 0;
	for ( ;	$i <= count( $e );	++$i	)
	{
		$so[$i] = preg_replace( "/[^0-9]/", "", $e[$i] );
		$q = query( "SELECT * FROM simmoi WHERE sim2='".$so[$i]."'" );
		if ( 0 < @mysql_num_rows( $q ) )
		{
			++$k;
			mysql_query( "DELETE FROM simmoi WHERE sim2='".$so[$i]."'" );
			$q2 = query( "SELECT * FROM list WHERE so='".$so[$i]."'" );
			if ( mysql_num_rows( $q2 ) < 1 )
			{
				mysql_query( "INSERT list(so) VALUES ('".$so[$i]."')" );
			}
		}
	}
	echo "<script>alert('Xóa thành công ".$k." số trên website!');</script>";
}
echo "<html>\r\n\r\n<head>\r\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">\r\n<title>Xóa số</title>\r\n</head>\r\n\r\n<body>\r\n\r\n<form method=\"POST\" action=\"\">\r\n<p align=\"center\"><textarea rows=\"15\" name=\"txtso\" cols=\"20\"></textarea></p>\r\n<p align=\"center\"><input type=\"submit\" value=\"xóa\" name=\"submit\"></p>\r\n</form>\r\n\r\n</body>\r\n\r\n</html>";
?>
