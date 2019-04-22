<?php
require("../ovikn.php");
require("mysql.php");
$smsx=new xstv_sms();
$stv_check=$smsx->check_login($myinfo['my_sms_number'],$myinfo['my_sms_pass']);
if ($stv_check==true)
{
	echo "ok";
$sql=mysql_query("SELECT * FROM mysms WHERE staus=0 AND sstaus!='2' and right(sdate,10)='".date('d/m/Y')."'");
while ($row=mysql_fetch_array($sql))
{

	$stv_send=$smsx->send_sms($row['sto'],$row['scontent']);
	if ($stv_send==true)
	$sms_staus=1;
	else
	$sms_staus=0;
	 
$sms['s']['sto']=$row['sto'];
$sms['s']['ssend']=$myinfo['my_sms_number'];
$sms['s']['scontent']=$row['scontent'];
$sms['s']['sdate']=date('h:i:s d/m/Y');
$sms['s']['staus']=$sms_staus;
$cr=@mysql_query("SELECT * FROM mysms WHERE scontent='".$row['scontent']."' AND sto='".$row['sto']."'");
if (@mysql_num_rows($cr) < 1)
insert($sms['s'],"mysms");
else 
update($sms['s'],"mysms","scontent='".$row['scontent']."' AND sto='".$row['sto']."'");
sleep(3);
if ($sms_staus==1)
echo "SEND : ".$row['sto']." -- ".$row['scontent']." <br>";
else 
echo "Not SEND : ".$row['sto']." -- ".$row['scontent']." <br>";
}
}
?>