<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/

function write( $contents )
{
	if ( $GLOBALS['gzip'] )
	{
		gzwrite( $GLOBALS['fp'], $contents );
	}
	else
	{
		fwrite( $GLOBALS['fp'], $contents );
	}
}

set_time_limit( 0 );
$date = date( "m_d_Y" );
require( "../ovikn.php" );
$dbserver = $dbhost;
$to = "nganhangsimsodep.com@gmail.com";
$from = "admin@nganhangsimsodep.com";
$file = $dbname.( "-".$date.".sql.gz" );
$gzip = TRUE;
$silent = TRUE;
mysql_connect( $dbserver, $dbuser, $dbpass );
mysql_select_db( $dbname );
if ( $gzip )
{
	$fp = gzopen( $file, "w" );
}
else
{
	$fp = fopen( $file, "w" );
}
$tables = mysql_query( "SHOW TABLES" );
while ( $i = mysql_fetch_array( $tables ) )
{
	$i = $i["Tables_in_".$dbname];
	if ( !$silent )
	{
		echo "Backing up table ".$i."\n";
	}
	$create = mysql_fetch_array( mysql_query( "SHOW CREATE TABLE ".$i ) );
	write( $create['Create Table'].";\n\n" );
	$sql = mysql_query( "SELECT * FROM ".$i );
	while ( !mysql_num_rows( $sql ) && !( $row = mysql_fetch_row( $sql ) ) )
	{
		foreach ( $row as $j => $k )
		{
			$row[$j] = "'".mysql_escape_string( $k )."'";
		}
		write( "INSERT INTO ".$i." VALUES(".implode( ",", $row ).");\n" );
	}
}
$gzip ? gzclose( $fp ) : fclose( $fp );
$use_gzip = "no";
$remove_sql_file = "no";
$remove_gzip_file = "no";
$savepath = "";
$send_email = "yes";
$senddate = date( "d/m/Y" );
$subject = $_SERVER['HTTP_HOST'].( "-Database - ".$dbname."- Backup - {$senddate}" );
$message = "Your MySQL database has been backed up and is attached to this email";
$use_ftp = "no";
$ftp_server = "ftp.diendanpascal.com";
$ftp_user_name = "mutsu";
$ftp_user_pass = "leauwater";
$ftp_path = "/";
$date = date( "m_d_Y" );
$filename = "{$savepath}/{$dbname}-{$date}.sql";
if ( $use_gzip == "yes" )
{
	$filename2 = $file;
}
else
{
	$filename2 = "{$savepath}/{$dbname}-{$date}.sql";
}
if ( $send_email == "yes" )
{
	$fileatt_type = filetype( $filename2 );
	$fileatt_name = "".$dbname."-".$date."_sql.tar.gz";
	$headers = "From: ".$from;
	echo "Openning archive for attaching:".$filename2;
	$file = fopen( $filename2, "rb" );
	$data = fread( $file, filesize( $filename2 ) );
	fclose( $file );
	$semi_rand = md5( time( ) );
	$mime_boundary = "==Multipart_Boundary_x".$semi_rand."x";
	$headers .= "\nMIME-Version: 1.0\nContent-Type: multipart/mixed;\n".( " boundary=\"".$mime_boundary."\"" );
	$message = "This is a multi-part message in MIME format.\n\n".( "--".$mime_boundary."\n" )."Content-Type: text/plain; charset=\"iso-8859-1\"\nContent-Transfer-Encoding: 7bit\n\n".$message."\n\n";
	$data = chunk_split( base64_encode( $data ) );
	echo "|";
	echo $mime_boundary;
	echo "|";
	echo $fileatt_type;
	echo "|";
	echo $fileatt_name;
	echo "| ";
	echo $fileatt_name;
	echo "|";
	echo $mime_boundary;
	echo "|<BR>";
	$message .= "--".$mime_boundary."\n".( "Content-Type: ".$fileatt_type.";\n" ).( " name=\"".$fileatt_name."\"\n" )."Content-Disposition: attachment;\n".( " filename=\"".$fileatt_name."\"\n" )."Content-Transfer-Encoding: base64\n\n".$data."\n\n".( "--".$mime_boundary."--\n" );
	$ok = @mail( $to, $subject, $message, $headers );
	if ( $ok )
	{
		echo "<h4><center><bg color=black><font color= blue>Database backup created and sent! File name \$filename2 </p>\r\n Idea Conceived By <a href=\"mailto:coolsurfer@gmail.com\">coolsurfer@gmail.com</a>\r\n Programmer email: <a href=\"mailto:neagumihai@hotmail.com\">neagumihai@hotmail.com</a></p>\r\n This is our first humble effort, pl report bugs, if U find any...</p>\r\n Email me at <>coolsurfer@gmail.com nJoY!! <img src=\"http://bigball.info/wp-includes/images/smilies/icon_smile.gif\" alt=\":)\" class=\"wp-smiley\">\r\n </color></center></h4>";
	}
	else
	{
		echo "<h4><center>Mail could not be sent. Sorry!</center></h4>";
	}
}
if ( $use_ftp == "yes" )
{
	$ftpconnect = "ncftpput -u ".$ftp_user_name." -p {$ftp_user_pass} -d debsender_ftplog.log -e dbsender_ftplog2.log -a -E -V {$ftp_server} {$ftp_path} {$filename2}";
	shell_exec( $ftpconnect );
	echo "<h4><center>";
	echo $filename2;
	echo " Was created and uploaded to your FTP server!</center></h4>";
}
if ( $remove_gzip_file == "yes" )
{
	exec( "rm -r -f ".$filename2 );
}
echo " ";
?>
