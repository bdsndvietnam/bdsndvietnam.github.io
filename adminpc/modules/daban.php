<?php
function cinfo($so)
{
	$sql=mysql_query("SELECT simso.sim1,simso.sim2, simso.gianhap, thanhvien.hovaten FROM simso,thanhvien WHERE simso.simdl=thanhvien.id AND simso.sim2='".$so."' ");
	return mysql_fetch_array($sql);
}
	$pthh=hoahong($cinfo[sim2]);
if ($_GET['so']!=null)
{
	$cinfo=cinfo($_GET['so']);
	$p[ngay]=date('h:i:s d/m/Y');
	$p[daily]=$cinfo[hovaten];
	$p[giaban]=$cinfo[gianhap]*1000000;
	$p[gianhap]=$cinfo[gianhap]*(100-$pthh)*10000;
	$p[sosim]=$cinfo[sim1];	
	insert($p,"daban");
	echo "<center> Đã xóa số và thêm vào quản lý sim đã bán!</center>";
	mysql_query("DELETE FROM simso WHERE sim2='".$cinfo[sim2]."'");
	
}
?>