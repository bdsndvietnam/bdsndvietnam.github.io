<?php
$stv=new Smarty();
$l=0;
foreach ($mang['s'] as $ks => $vs)
{
	$l++;
	$ls[]=$l;
	$vloai[]="Mạng ".$ks." (".demsimml($vs,$kieu[$_GET['sloai']])." sim)";
	if ($l==3)$l==1;
	$vlink[]=$ks;
	$tsim+=demsimml($vs,$kieu[$_GET['sloai']]);
}
$stv->assign("tmenu","Chọn tất ".$loai['s'][$_GET['sloai']]." ($tsim sim)");
$stv->assign("vloai",$vloai);
$stv->assign("l",$ls);
$stv->assign("vlink",$vlink);
$stv->assign("gloai",$_GET['sloai']);
$stv->display("taibangso.htm");
?>