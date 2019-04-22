<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/

switch ( $_GET['hd'] )
{
case "xoadondathang" :
	$p['p']['trangthai'] = 4;
	update( $p['p'], "dondathang", "id='".$_GET['id']."'" );
	echo "Số sim đã đưa vào trạng thái tạm xóa";
	break;
case "chuyendondathang" :
	$q = query( "SELECT id AS simid, sosim, giatien AS giaban, (SELECT id FROM thanhvien WHERE username='admin') AS daily FROM dondathang WHERE id='".$_GET['id']."'" );
	$r = mysql_fetch_assoc( $q );
	$r['ngaychuyen'] = date( "d/m/Y" );
	$q2 = mysql_num_rows( mysql_query( "SELECT * FROM cod WHERE sosim='".$r['sosim']."'" ) );
	if ( $q2 < 1 )
	{
		insert( $r, "cod" );
		$p['trangthai'] = 2;
		update( $p, "dondathang", "id='".$_GET['id']."'" );
		echo "Đơn đặt hàng đã được đưa vào danh sách cod của admin";
	}
	else
	{
		echo "Đơn đặt hàng đã có trong sách cod của admin";
	}
}
?>
