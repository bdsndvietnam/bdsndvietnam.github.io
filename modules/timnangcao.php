<?php
$stv=new Smarty();
$masp=80;
$page=$_GET['page'];
if ($page)$page--;
$bg=$masp*$page;
if ($page=="")
$page=1;
else 
$page=$_GET['page'];
$where="WHERE sim2 rlike'^".str_replace(array('X','x','*'),array('[0-9]','[0-9]','.*'),$_GET['sim'])."$'";
if (is_array($_GET['p']))
{
	foreach ($_GET['p'] as &$v)
	{
		$vv.=$v;
	}
	$where.=" AND sim2 Not rlike'[$vv]'";
}
if ($_GET['tongnut']!="")
{

	$where.=" AND (right((substring(sim2,2,1)+substring(sim2,3,1)+substring(sim2,4,1)+substring(sim2,5,1)+substring(sim2,6,1)+substring(sim2,7,1)+substring(sim2,8,1)+substring(sim2,9,1)+substring(sim2,10,1)+substring(sim2,11,1)),1) = ".$_GET['tongnut'].")";
}
$sql=query("SELECT simid,sim1,giaban FROM simso $where ORDER BY giaban DESC limit $bg,$masp");
$lrow=mysql_query("SELECT simid FROM simso $like $where");
$dem=@mysql_num_rows($lrow);
@mysql_free_result($lrow);
if ($_GET['page']=="")$i=0;
else $i=$bg;
while ($row=fecth($sql))
{
	$i++;
	$row['sim2']=str_replace('.','',$row['sim1']);
	if ($i%2==0)$row['class']="b1";else $row['class']="b2";
	$row['stt']=$i;
	if (count(explode("*",$_GET['Textsim']==2)) && $d1!="" && $c1!="")
	$row['sim1']=str_replace(array($d1,$c1),array("<font color='red'>".$d1."</font>","<font color='red'>".$c1."</font>"),$row['sim1']);
	else 
	$row['sim1']=str_replace(replace($_GET['Textsim']),"<font color='red'>".replace($_GET['Textsim'])."</font>",$row['sim1']);
	$row['mang']='<div id="'.checkmang($row['sim1'],$mang['s']).'"></div>';
	$row['giaban']=number_format($row['giaban'],0,",",",");
	
	$data[]=$row;
}
@mysql_free_result($sql);
$stv->assign("data",$data);
$k=0;
foreach ($loai['s'] as $name => $value)
{
	$k++;
	$j[]=$k;
	$link[]="sim-so-dep--".$name.".html";
	$linkname[]=$value;
	if ($k==4)$k=0;
	
}
$stv->assign("j",$j);
$stv->assign("link",$link);
$stv->assign("linkname",$linkname);
$xurl="tim-kiem-sim-so-dep-".$_GET['smang']."-".$_GET['sgiatu']."-".$_GET['sgiaden']."-".$_GET['Textsim']."-".$_GET['tongnut']."-Trang-";
$stv->assign("paging",strang($dem,$page,10,$masp,$xurl));
//$stv->assign("paging",paging($dem,$page,10,$masp));
if (strlen($_GET['Textsim'])== 10 || strlen($_GET['Textsim'])== 11)
{
if (substr($_GET['Textsim'],0,2)== '09' || substr($_GET['Textsim'],0,2)== '01')
{
if ($dem==0)
$stv->assign("dem",1);
$stv->assign("sotim",$_GET['Textsim']);
}
}
$stv->display("timnangcao.htm");
?>