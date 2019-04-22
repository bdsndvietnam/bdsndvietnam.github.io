<?php
$stv=new Smarty();

if ($_POST['submit'])
{
	update($_POST['post'],"thanhvien","username='".$_SESSION['username']."'");
	thongbao("Đổi thông tin thành công!");
}
$sql=query("SELECT * FROM thanhvien WHERE username='".$_SESSION['username']."'");
$stv->assign($row=fecth($sql));
foreach ($city['s'] as &$cityname)
{
	$cityn[]=$cityname;
}
$stv->assign("cityn",$cityn);
$stv->assign("select",$row['city']);
$stv->display("doithongtincanhan.htm");
?>