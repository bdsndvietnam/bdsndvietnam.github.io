<?php
$stv =new Smarty();
$masp=20;
$page=$_GET['page'];
if ($page)$page--;
$bg=$masp*$page;
if ($page=="")
$page=1;
else 
$page=$_GET['page'];
$dem=mysql_num_rows(mysql_query("SELECT id FROM thanhvien WHERE gol='1'"));
if ($_GET['page']=="")$i=0;else $i=$bg;
$sql=query("SELECT hovaten,diachi,mobile,email,tel FROM thanhvien where gol='1' order by id desc limit $bg,$masp");
while ($row=fecth($sql))
{
	$i++;
	$row['stt']=$i;
	if ($i%2==0)$row['class']="b1";else $row['class']="b2";
	$data[]=$row;
}
$stv->assign("data",$data);
$stv->assign("paging",paging($dem,$page,10,$masp));
$stv->display("khachhang.htm");
?>