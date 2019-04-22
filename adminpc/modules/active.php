<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/


$stv = new Smarty( );
set_time_limit( 1800 );
if ( isset( $_POST['submit'] ) )
{
	$headers = "From: quangninhads@gmail.com\r\n";
	$headers .= "Reply-To: quangninhads@gmail.com\r\n";
	$sql = query( "SELECT * FROM thanhvien WHERE email!='' AND username=''" );
	$i = 0;
	while ( $row = fecth( $sql ) )
	{
		++$i;
		$noidung = "Chao ban ".$row['hovaten']."! \n \n";
		$noidung .= "Ban da tung dat mua sim so dep qua mang \n";
		$noidung .= "Voi thong tin nhu sau:\n \n";
		$noidung .= "Ho va Ten: ".$row['hovaten']."\n";
		$noidung .= "Dia chi: ".$row['diachi']." ".$row['city']."\n";
		$noidung .= "Mobile: ".$row['mobile']." \n";
		$noidung .= "Tel: ".$row['tel']." \n";
		$noidung .= "Email: ".$row['email']." \n \n";
		$noidung .= "Boi vay chung toi gui cho ban mot ma kich hoat tai khoan cua ban tai";
		$noidung .= " Website cua chung toi !";
		$noidung .= "Ma kich hoat tai khoan: http://sim.choquangninh.com/index.php?act=activeacc&cid=".$row['cidmd5']." \n \n";
		$noidung .= "Ban vui long nhan vao duong link kich hoat tai khoan tren \nVa hay tao cho minh mot tai khoan. \n";
		$noidung .= "Ban co tai khoan nay ban mua sim so dep tai website cua chung toi se duoc tinh gia uu dai! \n";
		$noidung .= "Cam on ban da su dung dich vu cua chung toi! \n";
		$noidung .= "Bo phan ho tro khach hang: \n";
		$noidung .= "0986.865.559 \n";
		$noidung .= "Mr.Tung";
		@mail( $row['email'], "Kich hoat tai khoan cua ban!", $noidung, $headers );
	}
	echo thongbao( "Đã gửi link kích hoạt tới ".$i." tài khoản thành công !" );
}
$stv->display( "active.htm" );
?>
