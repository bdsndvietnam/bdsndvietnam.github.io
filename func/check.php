<?php
/**
http://www.ozeki.hu/sms/getresponse.php?sender=$SENDER&
receiver=$RECEIVER&msg=$MSG&recvtime=$RECEIVEDTIME&
msgtype=$TYPE&gsmsms=$GSMSMS

*/

/*
	$ccom=mysql_connect("localhost","root","hyn123") or die('Ko Ket Noi duoc Voi May Chu!');
	mysql_select_db("sms",$ccom) or die("Khong tim thay db ".$name);
*/
require("../ovikn.php");
require("../func/mysql.php");
require("../func/xoadau.php");
$sender=$_GET['sender'];
$receiver=$_GET['receiver'];
$msg=$_GET['msg'];
$receivtime=$_GET['recvtime'];
$msgtype=$_GET['msgtype'];
$gsmsms=$_GET['gsmsms'];
if ($msg!="")
{

$sql=mysql_query("SELECT sim1,giaban,hovaten, mobile, city FROM simso,thanhvien WHERE sim2='".preg_replace('/[^0-9]/','',$msg)."' and simso.simdl = thanhvien.id");
if (@mysql_num_rows($sql) > 0)
{
	$row=mysql_fetch_assoc($sql);
	$sms_back="So ".$row['sim1']." Gia ".number_format($row['giaban']*1000000,0,".",".")." ";
	$sms_back.="\n Dai Ly : ".$row['hovaten'];
	$sms_back.="\n ".$row['city'];
	$sms_back.="\n Mobile: ".$row['mobile'];
}
}
echo xoad($sms_back);
/*
if ($sms_back)
{
$gatewayURL  =   'http://localhost:9333/ozeki?';
  $request = 'login=admin';
  $request .= '&password=abc123';
  $request .= '&action=sendMessage';
  $request .= '&messageType=SMS:TEXT';
  $request .= '&recepient='.urlencode($sender);
  $request .= '&messageData='.urlencode($sms_back);

  $url =  $gatewayURL . $request;  

  //Open the URL to send the message
   file($url); 
}

*/

/*
mysql_query("INSERT INTO my_sms(sender,receiver,msg,receivtime,msgtype,gsmsms) VALUES ('$sender','$receiver','$msg','$receivtime','$msgtype','$gsmsms')");
*/
?>