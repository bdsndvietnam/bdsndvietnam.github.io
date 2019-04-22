<?php
class payclass
{
function pay($city2,$sosim2,$giatien)
{
	$ht="<table style=\"width: 100%\" cellspacing=\"0\" cellpadding=\"0\">
	<tr>
		<td style=\"width: 982px; background-image: url('http://simsodep.hn/images/pay_06.gif'); text-align: left; height: 43px;\">
		<img src=\"http://simsodep.hn/images/pay_01.gif\" width=\"303\" height=\"43\" alt=\"\"></td>
		<td style=\"height: 43px\"><img src=\"http://simsodep.hn/images/pay_03.gif\" width=\"17\" height=\"43\" alt=\"\"></td>
	</tr>
	<tr>
		<td style=\"width: 982px; background-image: url('http://simsodep.hn/images/pay_06.gif'); text-align: center;\" valign=\"top\">
		Quý khách hiện đang ở <strong>".$city2."<br>
		</strong></td>
		<td style=\"background-image: url('http://simsodep.hn/images/pay_05.gif')\">&nbsp;</td>
	</tr>
	<tr>
					<td style=\"background-image: url('http://simsodep.hn/images/pay_06.gif'); text-align:center\">
					<div style=\"height: 40px; width:95%; background-color: #CCCCCC\">Những 
					hình thức 
					thanh toán và giao hàng được chấp nhận đối với đơn hàng
					<strong>".$sosim2."</strong></div></td>
					<td style=\"background-image: url('http://simsodep.hn/images/pay_05.gif')\">&nbsp;</td>

				</tr>
	<tr>
		<td style=\"width: 982px; background-image: url('http://simsodep.hn/images/pay_06.gif'); text-align: left;\" valign=\"top\">";
	
	$q=mysql_query("SELECT * FROM simso WHERE sim2='".$sosim2."'");
	$r=mysql_fetch_array($q);
	$q2=mysql_query("SELECT * FROM thanhvien WHERE id='".$r['simdl']."'");
	$r2=mysql_fetch_array($q2);
		
	$listcity=array("Nam Định" =>"Quang Trung - TP. Nam Định",
	"Hồ Chí Minh" =>"Q.10 Hoặc Q. Bình Thạnh TP.HCM",
	"Cần Thơ" =>"Q.Ninh Kiều, TP. Cần Thơ",
	"Hải Dương" =>"",
	"Thái Bình"	=>"",
	"Hưng Yên" =>"Yên Mỹ - Hưng Yên",
	"Đà Nẵng" =>"Đà Nẵng"
	);
	if ($city2==$r2['city'])
	{
		$ht.='<div>
			<table style="width: 100%">
				<tr>
					<td>
					<p style="margin-left: 20px">
					Sim đang có sẵn tại
					<strong>'.$city2.'</strong> <br>
					<img alt="Chấp Nhận" src="http://simsodep.hn/nhan.gif" width="24" height="30" style="float: left">
					Thanh toán trực tiếp cho nhân viên giao hàng của chúng tôi khi 
					mang sim tới giao cho quý khách<br>
					Nhận sim trong vòng 2 giờ  (Giờ Hành chính) - Ngoài giờ hành chính quý 
						khách muốn nhận sim nhanh hãy gọi qua số hotline.</p>
					<p style="margin-left: 20px">Sau 2 giờ quý khách chưa nhận 
						được hãy gọi qua số Hotline cho chúng tôi!</p>
					</td>
				</tr>
			</table>
		</div>
';
		
	}
	elseif ($city2=="Hà Nội")
	{
		if ($giatien < 1000000)
		$datcoc='Thanh Toán đặt cọc trước tối thiểu 150.000 VNĐ ';
		elseif ($giatien >=1000000 && $giatien < 5000000)
		$datcoc='Thanh toán đặt cọc trước tối thiểu 200.000 VNĐ';
		else
		$datcoc='Thanh toán đặt cọc trước tối thiểu '.number_format(($giatien*10/100),0,".",".").' VNĐ'; 
		$ht.='<div>
			<p style="margin-left: 20px">
			<img alt="Chấp Nhận" src="http://simsodep.hn/nhan.gif" width="24" height="30" style="float: left">Sim 
			<strong>'.$sosim2.'</strong><br>
			Đang để ở kho <strong>TP.HCM</strong> Quý khách vui lòng qua cửa hàng của chúng tôi tại 
			76 Quan Nhân- Thanh Xuân - Hà Nội Hoặc
			<a href="sim-so-dep-thanhtoan.html">chuyển khoản</a><br>
			Đặt trước tiền để chúng tôi chuyển sim ra!</p>
			<p style="margin-left: 20px">'.$datcoc.'</p>
			<p style="margin-left: 20px">Quý khách sẽ nhận được sim&nbsp; 
				sau 24 - 48 Tiếng.</p>
		</div>';	
	}
	elseif ($listcity[$city2]!="")
	{
		if ($r2['city']=="Hồ Chí Minh")
		$hoac="Hoặc <strong>TP.Hồ Chí Minh</strong>";
		if ($giatien < 1000000)
		$datcoc='Thanh Toán đặt cọc trước tối thiểu 150.000 VNĐ';
		elseif ($giatien >=1000000 && $giatien < 5000000)
		$datcoc='Thanh toán đặt cọc trước tối thiểu 200.000 VNĐ';
		else
		$datcoc='Thanh toán đặt cọc trước tối thiểu '.number_format(($giatien*10/100),0,".",".").' VNĐ'; 
		 
		
		$ht.='<div>
			<table style="width: 100%" cellspacing="0" cellpadding="0">
					<tr>
					<td style="text-align: left;">
					<p style="margin-left: 20px"><img alt="Chấp Nhận" src="http://simsodep.hn/nhan.gif" width="24" height="30" style="float: left"> 
					 </p>
					<p style="margin-left: 20px"> Thanh toán hoặc đặt cọc trước tại chi nhánh của chúng tôi tại <br> '.$listcity[$city2].'<br>
</p>
					<p style="margin-left: 20px">'.$datcoc.' tại chi nhánh chúng tôi sẽ chuyển sim về chi nhánh!</p>
					<p></p>
					</td>
				</tr>
				
				<tr>
					<td style="text-align: left;">
					<p style="margin-left: 20px"><img alt="Chấp Nhận" src="http://simsodep.hn/nhan.gif" width="24" height="30" style="float: left"> 
					 </p>
					<p style="margin-left: 20px">'.$datcoc.'  qua <a href="sim-so-dep-thanhtoan.html">chuyển khoản</a><br>
					Nhận sim qua dịch vụ chuyển phát nhanh và thanh toán số tiền 
					còn lại cho nhân viên chuyển phát trong thời gian 1-3 ngày!</p>
					<p style="margin-left: 20px">&nbsp;</p>
					</td>
				</tr>
				<tr>
					<td style="height: 40px; text-align: left;">
					<p style="margin-left: 20px">
					<img alt="Chấp Nhận" src="http://simsodep.hn/nhan.gif" width="24" height="30" style="float: left"> 
					Nhờ người thân tại
					<strong>Hà Nội</strong>&nbsp;'.$hoac.' nhận sim và thanh toán trực 
					tiếp tại cửa hàng hoặc cho nhân viên giao hàng của chúng tôi!</p>
					<p style="margin-left: 20px">&nbsp;</p>
					</td>
				</tr>
				<tr>
					<td>
					<p style="margin-left: 20px">
					<img alt="Chấp Nhận" src="http://simsodep.hn/nhan.gif" width="24" height="30" style="float: left">Thanh 
					toán toàn bộ tiền qua
					<a href="sim-so-dep-thanhtoan.html">chuyển khoản</a><br>
					Nhận sim qua dịch vụ chuyển phát nhanh bảo đảm trong thời 
					gian 1-3 ngày!</p>
					</td>
				</tr>
			</table>
		</div>';
	}
	elseif (in_array($city2,array('Hồ Chí Minh','Hải Phòng','Đà Nẵng','Bà Rịa-Vũng Tàu','Bình Dương')) and $giatien >= 500000)
	{
		$ht.='<p style="margin-left: 20px">
					<img alt="Chấp Nhận" src="http://simsodep.hn/nhan.gif" width="24" height="30" style="float: left">Thanh 
					toán trực tiếp cho nhân viên giao hàng của chúng tôi hoặc 
					nhân viên chuyển phát khi giao hàng tới<br>
					Thời gian nhận sim từ 1-2 ngày! </p>';
	}
	elseif ($giatien < 500000)
	{
		if ($r2['city']=="Hồ Chí Minh")
		$hoac="Hoặc <strong>TP.Hồ Chí Minh</strong>";
		$ht.='<div>
			<table style="width: 100%">
				<tr>
					<td style="height: 77px">
					<p style="margin-left: 20px; height: 49px;">
					<img alt="Chấp Nhận" src="http://simsodep.hn/nhan.gif" width="24" height="30" style="float: left">Nhờ người thân tại
					<strong>Hà Nội</strong> '.$hoac.'
					nhận sim và thanh toán trực tiếp tại cửa hàng hoặc cho nhân viên 
					giao hàng của chúng tôi! </p>
					</td>
				</tr>
				<tr>
					<td style="text-align: left">
					<p style="margin-left: 20px">
					<img alt="Chấp Nhận" src="http://simsodep.hn/nhan.gif" width="24" height="30" style="float: left">Thanh toán toàn bộ tiền qua 
			<a href="sim-so-dep-thanhtoan.html">chuyển khoản</a><br>
					Nhận sim qua dịch vụ chuyển phát nhanh bảo đảm trong thời gian 
					1-3 ngày!<br>
&nbsp;<br>
					Số tài khoản của chúng nhận thanh toán<br>
					<br>
					Chủ tài khoản: <strong>Trương Văn Tòng<br>
					</strong><br>
					TK Vietcombank -Nguyễn Chí Thanh - Hà Nội<br>
					STK:001100.3568.524<br>
					<br>
					TK Techcombank - Đại Cồ Việt - Hà Nội<br>
					STK: 1112.076.002.6015<br><br>
					TK: Đông Á - Cầu Giấy - Hà Nội<br>
					STK: 0101.701.889<br>
					<br>
					TK: Agribank - Láng Hạ - Hà Nội<br>
					STK: 1400.2050.71587<br>
					<br>
					<strong>Chú ý:</strong> Nội dung chuyển khoản quý khách ghi rõ thanh toán tiền mua sim : <b>'.$sosim2.'</b>. và báo lại cho chúng tôi khi đã chuyển khoản<br/>
					</p>
					</td>
				</tr>
				</table>
		</div>
';
	}
	else 
	{
		if ($giatien < 1000000)
		$datcoc='Thanh Toán đặt cọc trước tối thiểu 150.000 VNĐ qua chuyển khoản';
		elseif ($giatien >=1000000 && $giatien < 5000000)
		$datcoc='Thanh toán đặt cọc trước tối thiểu 200.000 VNĐ qua <a href="sim-so-dep-thanhtoan.html">chuyển khoản</a>';
		else
		$datcoc='Thanh toán đặt cọc trước tối thiểu '.number_format(($giatien*10/100),0,".",".").' VNĐ qua <a href="sim-so-dep-thanhtoan.html">chuyển khoản</a><br/>'; 
		$datcoc.="<strong>Chú ý:</strong> Nội dung chuyển khoản quý khách ghi rõ đặt tiền mua sim : <b>".$sosim2."</b>. và báo lại cho chúng tôi khi đã chuyển khoản<br/>";
		 
		if ($r2['city']=="Hồ Chí Minh")
		$hoac="Hoặc <strong>TP.Hồ Chí Minh</strong>";
		
		$ht.='<div>
			<table style="width: 100%" cellspacing="0" cellpadding="0">
				
				<tr>
					<td style="text-align: left;">
					<p style="margin-left: 20px"><img alt="Chấp Nhận" src="http://simsodep.hn/nhan.gif" width="24" height="30" style="float: left"> 
					 </p>
					<p style="margin-left: 20px">'.$datcoc.'<br>
					Nhận sim qua dịch vụ chuyển phát nhanh và thanh toán số tiền 
					còn lại cho nhân viên chuyển phát trong thời gian 1-3 ngày!</p>
					<p style="margin-left: 20px">&nbsp;</p>
					</td>
				</tr>
				<tr>
					<td style="height: 40px; text-align: left;">
					<p style="margin-left: 20px">
					<img alt="Chấp Nhận" src="http://simsodep.hn/nhan.gif" width="24" height="30" style="float: left"> 
					Nhờ người thân tại
					<strong>Hà Nội</strong> '.$hoac.'&nbsp; nhận sim và thanh toán trực 
					tiếp tại cửa hàng hoặc cho nhân viên giao hàng của chúng tôi!</p>
					<p style="margin-left: 20px">&nbsp;</p>
					</td>
				</tr>
				<tr>
					<td>
					<p style="margin-left: 20px">
					<img alt="Chấp Nhận" src="http://simsodep.hn/nhan.gif" width="24" height="30" style="float: left">Thanh 
					toán toàn bộ tiền qua
					<a href="sim-so-dep-thanhtoan.html">chuyển khoản</a><br>
					Nhận sim qua dịch vụ chuyển phát nhanh bảo đảm trong thời 
					gian 1-3 ngày.</p>
					</td>
				</tr>
			</table>
		</div>';
	}
	$ht.="</td>
		<td style=\"background-image: url('http://simsodep.hn/images/pay_05.gif')\">
		&nbsp;</td>
	</tr>
	<tr>
		<td colspan=\"2\">
		<table style=\"width: 100%\" cellspacing=\"0\" cellpadding=\"0\">
			<tr>
				<td style=\"width: 29px; height: 26px\">
				<img src=\"http://simsodep.hn/images/pay_09.gif\" width=\"29\" height=\"26\" alt=\"\"></td>
				<td style=\"background-image: url('http://simsodep.hn/images/pay_10.gif')\">&nbsp;</td>
				<td style=\"width: 17px; height: 26px\">
				<img src=\"http://simsodep.hn/images/pay_13.gif\" width=\"17\" height=\"26\" alt=\"\"></td>
			</tr>
		</table>
		</td>
	</tr>
</table>
";
	return $ht;
	
}
}
?>