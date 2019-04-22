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
	if ( $_POST['post']['pcode'] == "" )
	{
		echo thongbao( "Bạn quên chưa nhập Mã Trang!" );
		$i = 1;
	}
	if ( $_POST['post']['ptitle'] == "" )
	{
		echo thongbao( "Bạn quên chưa nhập tiêu đề trang!" );
		$i = 1;
	}
	if ( $_POST['post']['pconment'] == "" )
	{
		echo thongbao( "Bạn quên chưa nhập nội dung!" );
		$i = 1;
	}
	function checkocode( )
	{
		$q = mysql_query( "select * FROM page WHERE pcode='".$pcode."'" );
		if ( 0 < @mysql_num_rows( $q ) )
		{
			return 1;
		}
	}
	if ( checkocode( $_POST['post']['pcode'] ) == 1 )
	{
		thongbao( "Mã trang đã được sử dụng!" );
	}
	if ( $i != 1 )
	{
		$GLOBALS['_POST']['post'][pconment2] = xoad( $_POST['post'][pconment] );
		insert( $_POST['post'], "page" );
		echo thongbao( "Thêm Trang Mới Thành Công!" );
	}
}
$stv->display( "pageadd.htm" );
?>
