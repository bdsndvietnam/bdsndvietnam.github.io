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
	if ( $_GET['domains'] != "" )
	{
		$GLOBALS['_POST']['post']['domain'] = $_GET['domains'];
	}
	if ( $_POST['post']['tieude'] == "" )
	{
		echo thongbao( "Bạn quên chưa nhập tiêu đề!" );
		$i = 1;
	}
	if ( $_POST['post']['noidung'] == "" )
	{
		echo thongbao( "Bạn quên chưa nhập nội dung!" );
		$i = 1;
	}
	if ( $i != 1 )
	{
		insert( $_POST['post'], "news" );
		echo thongbao( "Đăng tin thành công!" );
	}
}
$stv->display( "newsadd.htm" );
?>
