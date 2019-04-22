<?php
$stv=new Smarty();
foreach ($city['s'] as &$cityname)
{
	$cityn[]=$cityname;
}
$stv->assign("cityn",$cityn);

if ($_GET['cid']!=0)
{
$stv->assign("ok",1);
}

if (is_array($_COOKIE['my_cart']) and $_GET['sosim']=="0")
{
foreach ($_COOKIE['my_cart'] as $k =>$v)
{
	$join[]="'".$k."'";
}
$sql=query("SELECT * FROM simso WHERE sim2 IN(".join(', ',$join).")");
}
else 
$sql=query("SELECT * FROM simso WHERE sim2='".$_GET['sosim']."'");
while ($row=fecth($sql))
{
	$i++;
	$row['stt']=$i;
	$row['giagiam']=number_format($row['giaban']*900000,0,",",",");
	$row['docgiagiam']=doctien($row['giaban']*900000);
	$row['doctien']=doctien($row['giaban']*1000000);	
	$row['giaban']=number_format($row['giaban']*1000000,0,",",",");
	$data[]=$row;
}
if (@mysql_num_rows($sql) > 1)$stv->assign("chon",1);
if (@mysql_num_rows($sql) < 1)
{
	$row['sim1']=$_GET['sosim'];
	$data[]=$row;
	$stv->assign("buy","no");
}
$stv->assign($myinfo);
$stv->assign("tongtien",number_format($tongtien*1000000,0,",",","));
$stv->assign("data",$data);
$stv->assign("cid","DH-".time());
$stv->assign("sosim",$_GET['sosim']);
		for ($i=0;$i < strlen($_GET['sosim']); $i++)		{
			$q=query("SELECT * FROM simso WHERE sim2 LIKE'%".substr($_GET['sosim'],$i,strlen($_GET['sosim'])-$i)."'  AND sim2!='".$_GET['sosim']."' LIMIT 50");
			if (mysql_num_rows($q) > 0)
			{
			$a=$q;
			$i=strlen($_GET['sosim']);			
			}
	while ($row=fecth($a))
	{
	$v++;
	if ($v%2==0)$row['class']="b1";else $row['class']="b2";
	$row['stt']=$v;
	$row['mang']=checkmang($row['sim1'],$mang['s']);
	$row['giaban']=number_format($row['giaban']*1000000,0,",",",");
	$row['giagiam']=number_format($row['giaban']*900000,0,",",",");
	$data2[]=$row;
	}
	$stv->assign("data2",$data2);
	$stv->assign("mo",1);		
	}
$dodai = strlen($_GET['sosim']);
if ($dodai==11)
$dayso = substr($_GET['sosim'],0,8);
else
$dayso = substr($_GET['sosim'],0,7);
$chuoisoa = "000";
$chuoisob = "999";
$daysodau = $dayso.$chuoisoa;
$daysocuoi = $dayso.$chuoisob;
$dayhienthi = range($daysodau,$daysocuoi);
$soao="";
foreach ($dayhienthi AS $mk => $mv)
{
	$soao.='<span style="padding:0px 7px;font-size:12px"><a href="'.$myinfo[my_domain].'/mua-sim-re-0'.$mv.'.html">  0'.$mv.'  </a></span>';	
}
$stv->assign("soao",$soao);
$stv->assign("daysodau",$daysodau);	
$stv->assign("daysocuoi",$daysocuoi);	
$stv->assign("loaiso",$dodai);
$stv->display("datmuasim.htm");
?>