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
	if ( $_POST['hovaten'] == "" )
	{
		$thongbao[] = "Bạn Quên Chưa nhập Họ tên!";
	}
	if ( $_POST['email'] == "" )
	{
		$thongbao[] = "Bạn Chưa nhập Email";
	}
	if ( $_POST['dienthoai'] == "" )
	{
		$thongbao[] = "Bạn chưa nhập điện thoại";
	}
	if ( $_POST['chude'] == "" )
	{
		$thongbao[] = "Bạn quyên chưa nhập tiêu đề!";
	}
	if ( $_POST['noidung'] == "" )
	{
		$thongbao[] = "Bạn quên chưa nhập nội dung liên hệ!";
	}
	if ( is_array( $thongbao ) )
	{
		$stv->assign( "thongbao", join( "<br>", $thongbao ) );
		$stv->assign( $_POST );
	}
	else
	{
		$text = "\r\n\t\tHọ Và tên:".$_POST['hovaten']."\r\n<br>\r\n\t\tĐiện Thoại:".$_POST['dienthoai']."\r\n<br>\r\n\t\t-------------------------------------\r\n<br>\r\n\t\t".$_POST['noidung']."";
		require( "func/smtp.php" );
		sendmail( $_POST['email'], $myinfo['email'], $_POST['chude'], $text, $_POST['hovaten'] );
		$stv->assign( "thongbao", "Liên hệ đã gửi thành công!" );
	}
}
$stv->assign( $myinfo );
$stv->display( "lienhe.htm" );
?>
