<?php
session_start();
function RemoveSign($str)
{
$coDau=array("à","á","ạ","ả","ã","â","ầ","ấ","ậ","ẩ","ẫ","ă",
"ằ","ắ","ặ","ẳ","ẵ",
"è","é","ẹ","ẻ","ẽ","ê","ề" ,"ế","ệ","ể","ễ",
"ì","í","ị","ỉ","ĩ",
"ò","ó","ọ","ỏ","õ","ô","ồ","ố","ộ","ổ","ỗ","ơ"
,"ờ","ớ","ợ","ở","ỡ",
"ù","ú","ụ","ủ","ũ","ư","ừ","ứ","ự","ử","ữ",
"ỳ","ý","ỵ","ỷ","ỹ",
"đ",
"À","Á","Ạ","Ả","Ã","Â","Ầ","Ấ","Ậ","Ẩ","Ẫ","Ă"
,"Ằ","Ắ","Ặ","Ẳ","Ẵ",
"È","É","Ẹ","Ẻ","Ẽ","Ê","Ề","Ế","Ệ","Ể","Ễ",
"Ì","Í","Ị","Ỉ","Ĩ",
"Ò","Ó","Ọ","Ỏ","Õ","Ô","Ồ","Ố","Ộ","Ổ","Ỗ","Ơ"
,"Ờ","Ớ","Ợ","Ở","Ỡ",
"Ù","Ú","Ụ","Ủ","Ũ","Ư","Ừ","Ứ","Ự","Ử","Ữ",
"Ỳ","Ý","Ỵ","Ỷ","Ỹ",
"Đ","ê","ù","à");

$khongDau=array("a","a","a","a","a","a","a","a","a","a","a"
,"a","a","a","a","a","a",
"e","e","e","e","e","e","e","e","e","e","e",
"i","i","i","i","i",
"o","o","o","o","o","o","o","o","o","o","o","o"
,"o","o","o","o","o",
"u","u","u","u","u","u","u","u","u","u","u",
"y","y","y","y","y",
"d",
"A","A","A","A","A","A","A","A","A","A","A","A"
,"A","A","A","A","A",
"E","E","E","E","E","E","E","E","E","E","E",
"I","I","I","I","I",
"O","O","O","O","O","O","O","O","O","O","O","O"
,"O","O","O","O","O",
"U","U","U","U","U","U","U","U","U","U","U",
"Y","Y","Y","Y","Y",
"D","e","u","a");
return str_replace($coDau,$khongDau,$str);
}
if ($_POST['pw']!="" and md5($_POST['pw'])=="e563611b0e2de3bf1502bc4762300f9e")
{
	setcookie("sends",1,time()+3*3600);
}
if ($_COOKIE['sends']!=1)
header("Location: sends_login.htm");
require("ovikn.php");
require("func/mysql.php");
require("func/xoadau.php");
if (isset($_POST['submit']))
{
if ((substr($_POST['mobile'],0,2)=="09" || substr($_POST['mobile'],0,2)=="01"))
{

$smsx=new xstv_sms();
$_POST['text']=RemoveSign($_POST['text']);
$stv_check=$smsx->check_login($_POST['phone'],"hyn123");
if ($stv_check==true)
{
	$stv_send=$smsx->send_sms(preg_replace('/[^0-9]/','',$_POST['mobile']),$_POST['text']);
	if ($stv_send==true)
	$sms_staus=1;
	else
	$sms_staus=0;
	 
}
else 
$sms_staus=0;

$sms['s']['sto']=$_POST['mobile'];
$sms['s']['ssend']=$_POST['phone'];
$sms['s']['scontent']=$_POST['text'];
$sms['s']['sdate']=date('h:i:s d/m/Y');
$sms['s']['staus']=$sms_staus;
$cr=@mysql_query("SELECT * FROM mysms WHERE scontent='".$_POST['text']."' AND sto='".$_POST['mobile']."'");
if (@mysql_num_rows($cr) < 1)
insert($sms['s'],"mysms");
else 
update($sms['s'],"mysms","scontent='".$_POST['text']."' AND sto='".$_POST['mobile']."'");


if ($sms_staus==1)
echo "Gửi Tin Nhắn Thành Công";
else 
echo "<font color='red'>Không Gửi Được tin nhắn!</font>";

}
else 

	echo "<center>bạn đã nhập sai mật khẩu</center>";
}
else
{
$_POST['mobile']='Số Người Nhận';
}
if (isset($_POST['sx']) AND $_POST['tims']!="")
{

	$q=query("SELECT mobile, hovaten From nhapxuat WHERE sosim LIKE '%".replace($_POST['tims'])."'");	
}
else 
{
	
	$q=query("SELECT mobile, hovaten From thanhvien WHERE live=1 ORDER BY hovaten ASC");	
}

	


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
<meta http-equiv="Content-Language" content="en-us" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript">
function scheck()
{
	var ob=document.fr.text;
	if(ob.value.length > 150)
	{
	alert('Tin nhắn vượt quá 150 Ký tự!');
	return false;
	}

}
function sms(str)
{
	var ob=document.fr;
	ob.smslength.value=150-str.length;
}
</script>
<script type="text/javascript" src="http://nganhangsimsodep.com/js/jquery-1.4.2.min.js"></script>
<title>Nhắn Tin</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

</head>
<body>
<style>
body
{
	font-family:Arial, Helvetica, sans-serif;
	font-size:12px;
}
td 
{
	height:22px;
}
h2
{
	font-family:Arial, Helvetica, sans-serif;
	font-size:12px;
	margin-top:5px;
}
.hi
{
	background-color:#999999;
	
	color:fuchsia;

}
a:link{
	font-weight:bold;
	color:#0000FF;
	font-size:13px;
	text-decoration:none;
}
a:visited
{
	color:black;
}
a:hover
{
	color:#0000FF;
}
</style>
<div align="center">
<form method="post" onsubmit="return scheck()" name="fr">
<table style="width: 80%" cellspacing="0" cellpadding="0">
	<tr>
		<td style="width: 25%; height: 22px; background-color: #FF00FF;">
		&nbsp;</td>
		<td style="width: 50%; background-color: #FF00FF;">
		<h2 style="margin-left: 10px">NỘI 
		DUNG TIN NHẮN</h2></td>
		<td style="width: 30%; height: 22px; background-color: #FF00FF;">
		<h2 style="margin-left: 10px">
		DANH SÁCH ĐẠI LÝ</h2>
		<p style="margin-left: 10px; margin-top: 0; margin-bottom: 0">
		<input name="tims" type="text" style="width: 105px" /><input onclick="$('#dl').load('sends1.php?tims='+document.fr.tims.value+'');"  type="button" value="Tìm" /></p>
		</td>
	</tr>
	<tr>
		<td style="width: 25%; height: 22px;" valign="top">
		<div style="text-align: center">
		<input name="ss" type="text" style="height: 56px">
			<br>
			<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input onclick="$('#view').load('sends1.php?sosim='+document.fr.ss.value+'');" name="Button1" type="button" value="Check" style="height: 39px"></strong></div>
		<div id="view">
		</div>
		</td>
		<td style="width: 50%" valign="top">
	<div style="text-align: center">
		<textarea onkeyup="sms(this.value)" name="text" style="height: 151px; width: 217px;"><?=$_POST['text']?></textarea><br>
		<input name="phone" type="radio" style="height: 20px" value="0937666886" checked="checked">0937.666.886<br>
		<input name="phone" type="radio" value="0939578888">0939.57.8888<br>
		<br>
		<input onclick="this.value=''" name="mobile" type="text" style="width: 119px; height: 26px" value="<?=$_POST['mobile']?>" /><strong><input name="smslength" type="text" style="width: 29px; height:26px" /><br>
		<input name="submit" type="submit" value="Gửi Tin Nhắn" style="font-weight: bold" /></strong></div>

</td>
		<td style="width: 30%; height: 22px;" valign="top">
		<table style="width: 100%; background-color: #EAEAFF;">
					<tr>
				<td style="height: 41px; background-color: #FFFFFF; text-align: left;" onclick="this.className='hi'">
				<a onclick="forms[0].mobile.value='0944402333'" href="javascript:void(0)">
				Cty TNHH Tran Viet [ Thái Bình]<b> (0944402333)</b></a></td>
			</tr>
			<tr>
				<td style="height: 22px; background-color: #FFFFFF; text-align: left;" onclick="this.className='hi'">
				<a onclick="forms[0].mobile.value='0982333328'" href="javascript:void(0)">
				SSDVN HCM<b> (0982333328)</b></a></td>
			</tr>
	<tr>
				<td style="height: 22px; background-color: #FFFFFF; text-align: left;" onclick="this.className='hi'">
				&nbsp;</td>
			</tr>
			<div id="dl"></div>
			</table>
		</td>
	</tr>
</table>
</form>
</div>
</body>

</html>
