<?php
$stv=new Smarty();
if ($_POST['sosim']!="")
{
	$q=query("SELECT simid FROM simso WHERE sim2='".replace($_POST['sosim'])."'");
	$r=fecth($q);
	if (mysql_num_rows($q) > 0)
	{
		//loca("index.php?act=datmuasim&sosim=".$_POST['sosim']."&sid=".$r['simid']."");
		loca("mua-sim-dep-".replace($_POST['sosim'])."-cid".$r['simid'].".html");
	}
	else 
	{
		for ($i=0;$i < strlen($_POST['sosim']); $i++)
		{
			$q=query("SELECT * FROM simso WHERE sim2 LIKE'%".substr($_POST['sosim'],$i,strlen($_POST['sosim'])-$i)."' LIMIT 100");
			if (mysql_num_rows($q) > 0)
			{
			$a=$q;
			$i=strlen($_POST['sosim']);
			
			}
			
		}
	while ($row=fecth($a))
	{
	$v++;
	if ($v%2==0)$row['class']="b1";else $row['class']="b2";
	$row['stt']=$v;
	$row['mang']=checkmang($row['sim1'],$mang['s']);
	$row['giaban']=number_format($row['giaban']*1000000,0,".",".");
	$data[]=$row;
	}
	$stv->assign("data",$data);
	$stv->assign("mo",1);
		
	}
}
$stv->display("datsim.htm");
?>