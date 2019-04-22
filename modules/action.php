<?php
switch ($_GET['stv'])
{
	case 'xoagiohang':
	setcookie("carx[".$spid."]",null);
	exit();
	break;
	case 'checkso':
	$q=query("SELECT * FROM simso WHERE sim2='".$_GET['sosim']."'");
	if (mysql_num_rows($q) > 0)
	{
		echo "Số ".$_GET['sosim']." có tại website bạn có thể đặt mua";
		
	}
	else 
	{
		echo "Số ".$_GET['sosim']." không có trên website bạn không thể đặt mua";
	}
	break;
	
	case 'checkdk':
	if ($_GET['field']=="c1")
	{
		$sql=query("SELECT * FROM thanhvien WHERE username='".$_GET['value']."'");
		if (mysql_num_rows($sql) > 0)
		echo "Tên truy cập này đã có người sử dụng!";
	}
		if ($_GET['field']=="c4")
	{
		$sql=query("SELECT * FROM thanhvien WHERE username!='' and email='".$_GET['value']."'");
		if (mysql_num_rows($sql) > 0)
		echo "Email này đã có người sử dụng!";
	}
	break;
}
?>