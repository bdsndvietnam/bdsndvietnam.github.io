<?php
require("ovikn.php");
require("libs/Smarty.class.php");
require("func/mysql.php");
function checkm($sosim)
{

$mang['s']['VinaPhone'] = array('091', '094', '0123', '0125', '0127', '0129');
$mang['s']['MobiFone'] = array('090', '093', '0120','0121', '0122', '0126', '0128');
$mang['s']['Viettel'] = array('097', '098', '0168','0169','0167','0165','0166');
$mang['s']['VNMobile'] = array('092');
$mang['s']['Sfone'] = array('095');
$mang['s']['Beeline'] = array('0199');
if (strlen($sosim)==11)
$dau=substr($sosim,0,4);
else 
$dau=substr($sosim,0,3);
if (in_array($dau,$mang['s']['VinaPhone']))
return "VinaPhone";
elseif (in_array($dau,$mang['s']['MobiFone']))
return "MobiFone";
elseif (in_array($dau,$mang['s']['Viettel']))
return "Viettel";
elseif (in_array($dau,$mang['s']['VNMobile']))
return "VNMobile";
elseif (in_array($dau,$mang['s']['Sfone']))
return "Sfone";
elseif (in_array($dau,$mang['s']['Beeline']))
return "Beeline";
}
$stv=new Smarty();
if ($_POST['gia1']!="" && $_POST['gia2']!="")
$where.="AND (giaban >= ".(replace($_POST['gia1'])/1000000)." && giaban <= ".(replace($_POST['gia2'])/1000000).")";
foreach ($_POST['c'] as $k => $v)
{
	foreach ($mang['s'][$v] as &$value)
	{
	if (strlen($value)==4)
	$jo1[]="'".$value."'";
	elseif (strlen($value)==3) 
	$jo2[]="'".$value."'";
	}

}
	if ($jo1 && $jo2)
	$w[]="left(sim2,4) IN(".join(", ",$jo1).") || left(sim2,3) IN(".join(", ",$jo2).")";
	elseif ($jo1)
	$w[]="left(sim2,4) IN(".join(", ",$jo1).")";
	elseif ($jo2) 
	$w[]="left(sim2,3) IN(".join(", ",$jo2).")";
$where.=" AND (".join(" || ",$w).")";
$where.=" AND (".join(" AND ",$kieu[$_POST['sloai']]).")";
if ($_GET[textsql])
{
	$sql=query($_GET[textsql]);
	$_POST['r']=1;
	$_POST['sloai']=date('i_h_d_m_Y');
}
else 
$sql=query("SELECT sim1,giaban FROM simso WHERE sim2 $where limit 15000");
if ($_POST['r']==1)
{
		$filename = $_POST['sloai'].".xls";
		header("Content-Type: application/vnd.ms-excel");
 		header("Content-Disposition: attachment;filename=".$filename);
 		header('Pragma: no-cache');
  		header('Expires: 0');
}
elseif ($_POST['r']==2)
{
		$filename = $_POST['sloai'].".doc";
		header('Content-type: application/doc');
 		header("Content-Disposition: attachment;filename=".$filename);
 		header('Pragma: no-cache');
  		header('Expires: 0');
}
elseif ($_POST['r']==3)
{
		$filename = $_POST['sloai'].".html";
		header('Content-type: application/html');
 		header("Content-Disposition: attachment;filename=".$filename);
 		header('Pragma: no-cache');
  		header('Expires: 0');	
}
else 
{
			$filename = $_POST['sloai'].".pdf";
			@header("Cache-Control: ");// leave blank to avoid IE errors
			@header("Pragma: ");// leave blank to avoid IE errors
			@header("Content-type: application/octet-stream");
			@header("Content-Disposition: attachment; filename=".$filename);
}
$i=0;
while ($row=fecth($sql))
{
	$i++;
	$row['stt']=$i;
	$row['giaban']=number_format($row['giaban']*1000000,0,",",",");
	$row['loai']=$loai['s'][$_POST['sloai']];
	$row['mang']=checkm(str_replace('.','',$row['sim1']));
	$data[]=$row;
}
$stv->assign("data",$data);
$stv->assign($myinfo);
@mysql_close();
$stv->display("download.htm");
?>