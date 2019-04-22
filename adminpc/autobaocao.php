<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/

ini_set( "session.cookie_lifetime", 3600 );
require( "../ovikn.php" );
require( "../func/mysql.php" );
require( "../func/email.php" );
$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=UTF-8\r\n";
$headers .= "From: Nganhangsimsodep.com <nganhangsimsodep.com@gmail.com>\r\n";
$headers .= "Reply-To: Nganhangsimsodep.com <nganhangsimsodep.com@gmail.com>\r\n";
$q = query( "SELECT * FROM thanhvien WHERE live='1' AND email!=''" );
$v = 0;
while ( $r = fecth( $q ) )
{
	++$v;
	$txt[$v] = "<table border=\"0\" width=\"600\" id=\"table1\" cellspacing=\"1\" cellpadding=\"0\" bgcolor=\"#C0C0C0\">\r\n\t<tr>\r\n\t\t<td width=\"38\" bgcolor=\"#E1F0FF\" align=\"center\" height=\"22\">\r\n\t\t<p align=\"center\"><b>STT</b></td>\r\n\t\t<td bgcolor=\"#E1F0FF\" align=\"center\" height=\"22\" width=\"58\"><b>Ngày </b></td>\r\n\t\t<td width=\"103\" bgcolor=\"#E1F0FF\" align=\"center\" height=\"22\"><b>Số Sim</b></td>\r\n\t\t<td bgcolor=\"#E1F0FF\" align=\"center\" height=\"22\" width=\"92\"><b>Giá nhập</b></td>\r\n\t\t<td bgcolor=\"#E1F0FF\" align=\"center\" height=\"22\" width=\"86\"><b>Giá Bán</b></td>\r\n\t\t<td bgcolor=\"#E1F0FF\" align=\"center\" height=\"22\" width=\"75\"><b>Hoa Hồng</b></td>\r\n\t\t<td bgcolor=\"#E1F0FF\" align=\"center\" height=\"22\" width=\"66\"><b>Phí khác</b></td>\r\n\t\t<td width=\"73\" bgcolor=\"#E1F0FF\" align=\"center\" height=\"22\"><b>Lãi</b></td>\r\n\t</tr>";
	$q2 = query( "SELECT * FROM nhapxuat WHERE xoa = 0 AND daily='".$r['id']."'" );
	if ( 0 < mysql_num_rows( $q2 ) )
	{
		$i = 0;
		while ( $r2 = fecth( $q2 ) )
		{
			++$i;
			$txt[$v] .= "\t<tr>\r\n\t\t<td width='38' bgcolor='#FFFFFF' height='22'><p align='center'>".$i."</td>\r\n\t\t<td bgcolor='#FFFFFF' height='22' width='58'>".$r2['ngay']."</td>\r\n\t\t<td width='103' bgcolor='#FFFFFF' height='22'><p align='center'><b>".$r2['sosim']."</b></td>\r\n\t\t<td bgcolor='#FFFFFF' height='22' width='92'><p align='center'><b>".$r2['gianhap']."</b></td>\r\n\t\t<td bgcolor='#FFFFFF' height='22' width='86'><p align='center'><b>".$r2['giaban']."</b></td>\r\n\t\t<td bgcolor='#FFFFFF' height='22' width='75'><p align='center'><b>".$r2['hoahong']."</b></td>\r\n\t\t<td bgcolor='#FFFFFF' height='22' width='66'><p align='center'><b>".$r2['phikhac']."</b></td>\r\n\t\t<td width='73' bgcolor='#FFFFFF' height='22'><p align='center'><b>".( $r2['giaban'] - $r2['gianhap'] + $r2['gianhap'] * $r2['hoahong'] / 100 + $r2['phikhac'] )."</b></td>\r\n\t</tr>";
			$tong[$v] += $r2['giaban'] - $r2['gianhap'] + $r2['gianhap'] * $r2['hoahong'] / 100 + $r2['phikhac'];
		}
	}
	$txt[$v] .= "<tr>\r\n\t\t<td bgcolor=\"#FFFFFF\" height=\"22\" colspan=\"8\"><b>Tổng cộng</b> : <b>".$tong[$v]." K</b><br/> Nếu có sai lệch gì anh / chị vui lòng báo lại.<br />\r\n\t\t<p style=\"margin-top: 0; margin-bottom: 0\"><a href=\"http://www.nganhangsimsodep.com\">www.nganhangsimsodep.com</a> \r\n\t\t- <a href=\"http://www.simsodep.hn\">www.simsodep.hn</a></p>\r\n\t\t<p style=\"margin-top: 0; margin-bottom: 0\">Trương Văn Tòng</p>\r\n\t\t<p style=\"line-height: 150%; margin-top: 0; margin-bottom: 0\">Ngân Hàng Vietcombank</p>\r\n\t\t<p style=\"margin-top: 0; margin-bottom: 0\"><span class=\"noidung\">STK: 0011003568524</span></p>\r\n\t\t<b>Hotline: 0914.77.9999 - 0937.666.886 - 0986.77.8668 - 0949.39.6789</b></td>\r\n\t</tr>\r\n\t</table>";
	if ( 0 < mysql_num_rows( $q2 ) )
	{
		mail( $r['email'], "www.nganhangsimsodep.com - GD UPDATE ".date( "d/m/Y" ), $txt[$v], $headers );
	}
}
?>
