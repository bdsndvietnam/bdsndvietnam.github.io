<?php
$stv=new Smarty();
function checkt($sim)
{
	if ($_GET['smang'] && $_GET['sloai'])
	return "Sim ".$_GET['smang']." ".str_replace('-',' ',$_GET['sloai'])." ".$sim;
	elseif ($_GET['smang'])
	return "sim ".$_GET['smang']." , sim so dep ".$sim;
	elseif ($_GET['sloai'])
	return str_replace('-',' ',$_GET['sloai'])." , sim so dep ".$sim;
	elseif ($_GET['sdauso'])
	{
	return "dau so ".str_replace('-',' ',$_GET['sdauso']).", sim so dep  ".$sim;
	}
	else 
	return "sim so dep ".$sim;
}
$masp=68;
$page=$_GET['page'];
if ($page)$page--;
$bg=$masp*$page;
if ($page=="")
$page=1;
else 
$page=$_GET['page'];
if ($_GET['smang'])
{
	foreach ($mang['s'][$_GET['smang']] AS &$value)
	{
		if (strlen($value)==3)
		$l3[]="'".$value."'";
		else 
		$l4[]="'".$value."'";
		$valuex[]=$value;
	}
	if ($l4  && $l3)
	$where.="AND (left(sim2,3) IN (".join(", ",$l3).") || left(sim2,4) IN (".join(", ",$l4)."))";
	else if ($l3)
	$where.="AND (left(sim2,3) IN (".join(", ",$l3)."))";
	else 
	$where.="AND (left(sim2,4) IN (".join(", ",$l4)."))";	
}
if ($_GET['sloai'])
{
$stv->assign("loaisim",1);
$l=0;
foreach ($mang['s'] as $ks => $vs)
{
	$l++;
	$ls[]=$l;
	$vloai[]=$ks;
	if ($l==3)$l==1;
	$vlink[]="mang-".$ks."-".$_GET['sloai'].".html";
}
$stv->assign("vloai",$vloai);
$stv->assign("l",$ls);
$stv->assign("vlink",$vlink);
$where.=" AND (".join(" AND ",$kieu[$_GET['sloai']]).")";
}
if ($_GET['sdauso'])
{
$where.="AND sim2 like'".$_GET['sdauso']."%'";
$stv->assign("muc","Đầu số ".$_GET['sdauso']."");
}
if ($_GET['sdau'])
{
$where.="AND sim2 like'".$_GET['sdau']."%'";
$sql=query("SELECT left(sim2, 2) AS sdau FROM simso GROUP BY left(sim2, 2) ORDER BY left(sim2, 2) DESC");
$stv->assign("sdau".$_GET['sdau']."");
}
$sql=query("SELECT sim1,gianhap FROM simso where sim2 $where ORDER BY gianhap DESC limit $bg,$masp");
$lrow=mysql_query("SELECT simid FROM simso where sim2 $where");
$dem=mysql_num_rows($lrow);
if ($_GET['page']=="")$i=0;
else $i=$bg;
while ($row=fecth($sql))
{
	$i++;
	if ($i%2==0)$row['class']="";else $row['class']="ui-widget-content";
	$row['stt']=$i;
	//$row['mang']='<div id="'.checkmang($row['sim1'],$mang['s']).'"></div>';
	$row['mang']='<img src="css/images/'.checkmang($row['sim1'],$mang['s']).'.gif" width="100" height="28" alt="'.checkt($row['sim1']).'" />';
	//$row['mang']='<span style="font-size: 12px; font-family:Tahoma; color:orange;font-weight:bold">'.checkmang($row['sim1'],$mang['s']).'</span>';
	$row['giaban']=number_format($row['gianhap']*1000000,0,".",".");
	$row['sim2']=str_replace('.','',$row['sim1']);
	$data[]=$row;
}
$stv->assign("data",$data);
$k=0;
foreach ($loai['s'] as $name => $value)
{
	$k++;
	$j[]=$k;
	if ($_GET['smang'])
	$link[]="mang-".$_GET['smang']."-".$name.".html";
	else 
	$link[]="".$name.".html";
	$linkname[]=$value;
	if ($k==4)$k=0;	
}
$stv->assign("j",$j);
$stv->assign("link",$link);
$stv->assign("linkname",$linkname);
$sql2=query("SELECT left(sim2, 4) AS dauso FROM simso GROUP BY left(sim2, 4) ORDER BY left(sim2, 4) DESC");
while ($row2=fecth($sql2))
{
	if (substr($row2['dauso'],0,2)=='09')$dauso=substr($row2['dauso'],0,3); else $dauso=$row2['dauso'];
	if (in_array($dauso,$mang['s']['VinaPhone']))
	$dauvina[]=$row2['dauso'];
		elseif (in_array($dauso,$mang['s']['MobiFone']))
	$daumobi[]=$row2['dauso'];
		elseif (in_array($dauso,$mang['s']['Viettel']))
	$dauviettel[]=$row2['dauso'];
		elseif (in_array($dauso,$mang['s']['VietNamobile']))
	$dauVietNamobile[]=$row2['dauso'];
		elseif (in_array($dauso,$mang['s']['Gmobile']))
	$dauGmobile[]=$row2['dauso'];
		elseif (in_array($dauso,$mang['s']['Sfone']))
	$dausfone[]=$row2['dauso'];
}
$stv->assign("dauvina",$dauvina);
$stv->assign("daumobi",$daumobi);
$stv->assign("dauviettel",$dauviettel);
$stv->assign("dauVietNamobile",$dauVietNamobile);
$stv->assign("dauGmobile",$dauGmobile);
$stv->assign("dausfone",$dausfone);
$stv->assign("thiskey","Nhập số bạn cần tìm!");
foreach ($mang['s'] as $key => $value)
{
	$tenmang[]=$key;
}
$stv->assign("tenmang",$tenmang);
if ($_GET['sloai'] && $_GET['smang'])
$xurl="".$_GET['sloai']."-".$_GET['smang']."-Trang-";
elseif ($_GET['smang'])
$xurl="so-dep-".$_GET['smang']."-Trang-";
elseif ($_GET['sdauso'])
$xurl="dauso-".$_GET['sdauso']."-Trang";
else 
$xurl="".$_GET['sloai']."-Trang-";
$stv->assign("paging",strang($dem,$page,10,$masp,$xurl));
//$stv->assign("paging",paging($dem,$page,10,$masp));
if ($_GET['sloai']  && $_GET['smang'])
$stv->assign("muc","Sim ".$loai['s'][$_GET['sloai']]." ".$_GET['smang']."");
elseif ($_GET['smang'])
$stv->assign("muc","".$_GET['smang']."");
elseif ($_GET['sloai'])
$stv->assign("muc","".$loai['s'][$_GET['sloai']].""); 
$stv->display("xhomesearch.htm");
?>