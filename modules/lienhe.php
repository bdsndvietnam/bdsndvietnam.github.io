<?php
$stv=new Smarty();
if (isset($_POST['submit']))
{
	if ($_POST['hovaten']=="")$thongbao[]="Bạn Quên Chưa nhập Họ tên!";
	if ($_POST['email']=="")$thongbao[]="Bạn Chưa nhập Email";
	if ($_POST['dienthoai']=="")$thongbao[]="Bạn chưa nhập điện thoại";
	if ($_POST['chude']=="")$thongbao[]="Bạn quyên chưa nhập tiêu đề!";
	if ($_POST['noidung']=="")$thongbao[]="Bạn quên chưa nhập nội dung liên hệ!";
	if (is_array($thongbao))
	{
	$stv->assign("thongbao",join("<br>",$thongbao));
	$stv->assign($_POST);
	}
	else 
	{
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
		$headers .= "From: ".$_POST['hovaten']."<".$_POST['email'].">\r\n";
		$headers .= "Reply-To: ".$_POST['hovaten']."<".$_POST['email'].">\r\n"; 
		
		$headers2  = 'MIME-Version: 1.0' . "\r\n";
		$headers2 .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
		$headers2 .= "From: ".$myinfo['my_name']."<".$myinfo['my_email'].">\r\n";
		$headers2 .= "Reply-To: ".$myinfo['my_name']."<".$myinfo['my_email'].">\r\n"; 
		
		
		$text="
		Họ Và tên:".$_POST['hovaten']."\r\n<br>
		Điện Thoại:".$_POST['dienthoai']."\r\n<br>
		-------------------------------------\r\n<br>
		".$_POST['noidung']."";
		if ($myinfo['smtp']=="true")
		{
		require('SMTP.class.php');
		$smtp = new SMTP($myinfo[smtp_server],  $myinfo[smtp_port], true);
		$smtp->auth($myinfo[smtp_user],  $myinfo[smtp_pass]);
		/*
		$smtp->mail_from($myinfo['my_email']);
		$smtp->send($_POST['email'], "Cam on ban da lien he voi".$myinfo['my_web_add'],"Chúng tôi đã nhận được thông tin liên hệ bạn gửi<br>Chúng tôi sẽ trả lời bạn sớm nhất <br> Thân Ái ".$myinfo['my_name'], $headers2);
		*/
		$smtp->mail_from($_POST['email']);	
		$smtp->send($myinfo['my_email'], $_POST['chude'],$text, $headers);	
		}
		else 
		{
		mail($_POST['email'],"Cam on ban da lien he voi".$myinfo['my_web_add'],"Chúng tôi đã nhận được thông tin liên hệ bạn gửi<br>Chúng tôi sẽ trả lời bạn sớm nhất <br> Thân Ái ".$myinfo['my_name'],$headers2);
		mail($myinfo['my_email'],$_POST['chude'],$text,$headers);
		}
		
		$stv->assign("thongbao","Liên hệ đã gửi thành công!");
		
	}
	
}
$stv->assign($myinfo);
$stv->display("lienhe.htm");
?>