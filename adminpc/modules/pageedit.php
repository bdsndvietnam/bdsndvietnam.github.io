<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/

if ( !stv_code )
{
	check_code( 0 );
}

$stv = new Smarty( );
if ( isset( $_POST['submit'] ) )
{
	if ( $_POST['post']['pcode'] == "" )
	{
		echo thongbao( "Bạn quên chưa nhập mã trang!" );
		$i = 1;
	}
	if ( $_POST['post']['ptitle'] == "" )
	{
		echo thongbao( "Bạn quên chưa nhập tiêu đề!" );
		$i = 1;
	}
	if ( $_POST['post']['pconment'] == "" )
	{
		echo thongbao( "Bạn quên chưa nhập nội dung!" );
		$i = 1;
	}
	if ( $i != 1 )
	{
		$GLOBALS['_POST']['post']['pconment2'] = xoad( $_POST['post']['pconment'] );
		update( $_POST['post'], "page", "id='".$_GET['editid']."'" );
		echo thongbao( "Sửa Trang Thành công!" );
	}
}
$q = query( "SELECT * FROM page WHERE id='".$_GET['editid']."'" );
$stv->assign( mysql_fetch_assoc( $q ) );
$stv->display( "pageedit.htm" );
?>
