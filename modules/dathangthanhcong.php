<?php
$stv=new Smarty();
if (isset($_POST['submit']))
{
require("func/myoder.php");
$myoder=new myoder();
$_POST[post][oid]=$_GET[cid];

if (is_array($_POST[sims]))
	{
	$_POST[post][ngaygio]=date('h:i:s j/m/Y');
	$_POST[post][fname]=xoad($_POST[post][hovaten]);
	$tongsim=0;
	foreach ($_POST[sims] as $sim => $gia)
	{
	$tongsim++;
	$_POST[post][sosim]=replace($sim);
	
	$_POST[post][giatien]=replace($gia);
	$_POST[post][mydomain]=str_replace("www.","",$_SERVER['HTTP_HOST']);
	$_POST[post][gianhap]=$myoder->checkgn($_POST[post][sosim]);
	$tongtien+=$_POST[post][giatien];
	$xdl=$myoder->daily($_POST[post][sosim]);
	$_POST['post']['daily']=$xdl['hovaten'];
	$_POST['post']['dailyid']=$xdl['id'];
	if ($_SESSION[DH]!=$_GET[cid]){
	
	$myoder->insert($_POST[post],"my_order");

	}
	$show[xgiaban]=$gia;
	$show[xsosim]=$sim;
	$data[]=$show;
	}
	}
if (count($_POST[sims])==1)
{
	$sms_noidung=$_POST[post][sosim]." Giá: ".number_format(($_POST[post][giatien]/1),0,".",".")."đ\n".
	$sms_noidung.=$_POST[post][ngaygio]."\n";
	$sms_noidung.=xds($_POST[post][hovaten])."\n";
	$sms_noidung.=xds($_POST[post][city])."\n";
	$sms_noidung.=$_POST[post][dienthoai];
	
	if ($myinfo['dathang_sms']=="true" and $_SESSION[DH]!=$_GET[cid])
	$myoder->sms($sms_noidung,$myinfo['dathang_sms_to'],$myinfo['my_sms_number'],$myinfo['my_sms_pass']);
	
	if ($myinfo['dathang_email']=="true" and $_SESSION[DH]!=$_GET[cid])
	{

		if ($myinfo['smtp']=="true")
		{

		require('SMTP.class.php');
		$smtp = new SMTP($myinfo[smtp_server], $myinfo[smtp_port], true);
		$smtp->auth($myinfo[smtp_user], $myinfo[smtp_pass]);
		$smtp->mail_from($myinfo['my_email']);	
		$smtp->send($myinfo[dathang_email_to],"Đơn hàng của ". xds($_POST[post][hovaten])." Luc ".date('h:i:s j/m/Y'),$sms_noidung , $headers);	
		}
		else 
		{
		mail($myinfo[dathang_email_to],"Don dat hang cua". xds($_POST[post][hovaten])." Luc ".date('h:i:s j/m/Y'),$sms_noidung ,$headers);
		}
	}
}
$stv->assign("data",$data);
$stv->assign($_POST[post]);
$stv->assign("tongsim",$tongsim);
$stv->assign("tongtien",number_format($tongtien,0,".","."));
//mysql_close($ccom2);
}
$_SESSION[DH]=$_GET[cid];
$stv->display("dathangthanhcong.htm");	
?>
