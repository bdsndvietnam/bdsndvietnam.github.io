<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/


$stv = new Smarty( );
if ( isset( $_POST['submit'] ) )
{
	$q = query( "SELECT * FROM thanhvien WHERE id='".$_SESSION['daily']."'" );
	$r = fecth( $q );
	$headers = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
	$headers .= "From: ".$r['hovaten']."<".$r['email'].">\r\n";
	$headers .= "Reply-To: ".$r['hovaten']."<".$r['email'].">\r\n";
	if ( $_POST['nhom'] == 4 )
	{
		$sql = query( "SELECT email FROM thanhvien WHERE email!=''" );
	}
	else
	{
		$sql = query( "SELECT email FROM thanhvien WHERE live='".$_POST['nhom']."' AND email!=''" );
	}
	while ( $row = fecth( $sql ) )
	{
		$to[] = $row['email'];
		echo "Email send To: ".$row['email']." <br>";
	}
	if ( $myinfo['smtp'] == "true" )
	{
		require( "../SMTP.class.php" );
		{
            $myinfo[smtp_server], $myinfo[smtp_port], TRUE );
		$smtp = new SMTP( );
		$smtp->auth( $myinfo[smtp_user], $myinfo[smtp_pass] );
		$smtp->mail_from( $myinfo['my_email'] );
		$smtp->send( $to, $_POST['post']['tieude'], str_replace( array( "&lt;", "&gt;", "&quot;" ), array( "<", ">", "\"" ), $_POST['post']['noidung'] ), $headers );
	}
	else
	{
		mail( join( ", ", $tos ), $_POST['post']['tieude'], str_replace( array( "&lt;", "&gt;", "&quot;" ), array( "<", ">", "\"" ), $_POST['post']['noidung'] ), $headers );
	}
}
if ( $_SESSION['admins'] = 1 )
{
	$stv->display( "email.htm" );
}
?>
