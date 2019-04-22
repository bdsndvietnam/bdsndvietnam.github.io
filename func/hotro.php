<?php
$stv=new Smarty();
if (isset($_POST['submit']))

$sql=mysql_query("select * from page WHERE pconment2 like '%".$_POST['search']."%' OR pconment like '%".$_POST['search']."%' AND pcode='0'");
else
$sql=mysql_query("SELECT * from page WHERE pcode='0' order by pos desc limit 10");
$i=0;

while ($row=mysql_fetch_array($sql))
{
	$i++;
	if ($i%2==0)$row['class']="ui-widget-content";else $row['class']="";
	$data[]=$row;
}
$stv->assign("data",$data);
if (isset($_GET['sid']))
$masp=30;
$page=$_GET['page'];
if ($page)$page--;
$bg=$masp*$page;
if ($page=="")
$page=1;
else 
$page=$_GET['page'];
{
	$q=mysql_query("SELECT * FROM page WHERE id='".$_GET['sid']."'");
	$r=mysql_fetch_array($q);
	$stv->assign("noidung",$r['pconment']);

}
$stv->assign("paging",paging($dem,$page,10,$masp));
$stv->display("hotro.htm");
?>

