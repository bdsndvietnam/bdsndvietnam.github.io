<?php if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) ob_start("ob_gzhandler"); else ob_start(); ?>
<?php
 $stv=new Smarty();
ob_start();
function xmang($arr)
{
	foreach ($arr AS &$value)
	{
		if (strlen($value)==3)
		$l3[]="'".$value."'";
		else 
		$l4[]="'".$value."'";
		$valuex[]=$value;
	}
	if ($l4  && $l3)
	$where.="(left(sim2,3) IN(".join(", ",$l3).") || left(sim2,4) IN(".join(", ",$l4)."))";
	else if ($l3)
	$where.="(left(sim2,3) IN(".join(", ",$l3)."))";
	else 
	$where.="(left(sim2,4) IN(".join(", ",$l4)."))";
	$q=query("SELECT sim2 FROM simso WHERE $where");
	if (@mysql_num_rows($q) > 0)
	return 1;
	else 
	return 0;
}
$qp=mysql_query("SELECT id, ptitle FROM page WHERE pcode='menu' order by pos asc");
$nav='<table style="width: auto" cellspacing="0">
	<tr>';
$nav.='<td><span><a href="/" target="_self" title="TRANG CHỦ">TRANG CHỦ</a></span></td>';
$nav.='<td><span><a href="http://diendan.ovi.vn">DIỄN ĐÀN</a></span></td>';
$nav.='<td><span><a href="/index.php?act=news">TIN TỨC</a></span></td>';
$nav.='<td><span><a href="/index.php?act=raobansim">ĐĂNG BÁN SIM</a></td></span>';
$nav.='<td><span><a href="/ho-tro-mua-sim-35">PHONG THỦY</a></span></td>';
$nav.='<td><span><a href="/ho-tro-mua-sim-12">THANH TOÁN</a></span></td>';
$nav.='<td><span><a href="/lien-he-mua-sim-dep">LIÊN HỆ</a></span></td>';
$nav.='</tr>
</table>';
$stv->assign("nav",$nav);
/*
$sql1=query("SELECT count(sim2) AS so, sim2 AS sim FROM simso GROUP BY left(sim2,4)");
foreach ($mang['s'] AS $skey => $svalue)
{
	if (xmang($mang['s'][$skey])!= 0)
	{
	$i++;
	$hname[] = $skey;
	$hdauso[]=number_format(demsodau($svalue),0,".",".");
	$tongdau+=demsodau($svalue);
	}	
}
$stv->assign("name",$hname);
$stv->assign("dauso",$hdauso);
$stv->assign("tongdau",number_format($tongdau,0,".","."));

*/
$stv->assign("linkf",$linkf);
$stv->assign("linknamef",$linknamef);
$q=query("SELECT id AS aid, tieude AS atieude FROM news WHERE id!='".$_GET['newid']."' order by STT DESC");
while ($r=fecth($q))
{
	$r['tieude']=xoadau($r['atieude']);
	$nd[]=$r;
}
$stv->assign("nd",$nd); 
$menu="";
foreach ($mang['s'] AS $mk => $mv)
{
	$dem=demsimml($mang['s'][$mk],$mv);
	$demslsim=number_format($dem*1,0,".",".");
	$total+=$dem;
	$tongsimw=number_format($total*1,0,".",".");
	$menu.='<li><a href="/so-dep-'.$mk.'.html">Số đẹp '.$mk.' <span style="color:#f00;font-weight:normal"><sup>('.$demslsim.')</sup></span></a></li>';	
}
$stv->assign("menu",$menu);
$stv->assign("tongsim",$tongsimw);
foreach ($loai['s'] as $name => $value)
{
	$links[]="/".$name.".html";
	$linkname[]=$value;
}
$stv->assign("link",$links);
$stv->assign("linkname",$linkname);
if ($_GET['sloai'] && $_GET['smang'])
{
	if ($_GET['page'])$pagex="Trang ".$_GET['page'];
	$title=$myinfo[my_keyword]." - ".$_GET['sloai']." &laquo; ".str_replace('-','',$_GET['sloai'])." ".$_GET['smang']." &laquo; Danh sanh so dep ".$_GET['sloai']." ".$pagex;
	$title=str_replace("-"," ",$title);
}
elseif ($_GET['sloai'])
{
	if ($_GET['page'])$pagex="Trang ".$_GET['page'];
	$title=$myinfo[my_keyword]." - Sim ".str_replace(array('-','sim'),array(' ',''),$_GET['sloai'])." &laquo; Sim ".str_replace(array('-','sim'),array(' ',''),$_GET['sloai'])." dep &laquo; Danh sach so dep ".str_replace(array('-','sim'),array(' ',''),$_GET['sloai'])." ".$pagex;
}
elseif ($_GET['smang'])
{	if ($_GET['page'])$pagex="Trang ".$_GET['page'];
	if (!$_GET['act'])$title="sim so dep";
	else 
	$title=$myinfo[my_keyword]." - Sim ".str_replace("-"," ",$_GET['smang'])." &laquo; Sim ".$_GET['smang']." đẹp &laquo; Danh Sách sim số đẹp ".$_GET['smang'].$pagex;
}
elseif ($_GET['act']=="search")
{
	$title="Tìm Sim số đẹp ".$_GET['Textsim'];
}
elseif ($_GET['sdauso'])
{
	if ($_GET['page'])$pagex="Trang ".$_GET['page'];
	$dauso="dau so ".$_GET['sdauso']." ".$pagex;
	$title=$myinfo[my_keyword]." - dau so ".preg_replace('/[a-zA-Z-]/','',$_GET['sdauso']).", dau so viettel, dau so mobifone, dau so vinaphone";
}
elseif ($_GET['sosim'])
{

	$title=$myinfo[my_keyword]." - ".$_GET['sosim']." &laquo; Sim Số Đẹp &laquo; ".$my_title." &laquo; ".$myinfo[my_domain];
}
elseif ($_GET['link'])
{
	$title=str_replace('-',' ',$_GET['link']);
}
elseif ($_GET['tag'])
{
	$xtag=str_replace("-"," ",$_GET['tag']);
	$title=$xtag." rẻ, ".$xtag." dep, ".$xtag." de nho, ".$xtag." vip";
}
else 
{
	$title=$myinfo[my_title];
}
$stv->assign("title",$title);
if ($_GET['sosim'])
{
	$des="Bạn đang tìm sim số đẹp ".$rxs['sim1']." ? mời bạn vào website ".$myinfo[my_domain]." nơi có hàng triệu sim số đẹp để bạn lựa chọn!";
}
elseif ($_GET['sloai'])
{	if ($_GET['page'])$pagex="Trang ".$_GET['page'];
	$des=$myinfo[my_keyword]." - ".$loai['s'][$_GET['sloai']]." | Sim số đẹp ".$loai['s'][$_GET['sloai']]." | ".$myinfo[my_domain]." - Có hàng nghìn  ".$loai['s'][$_GET['sloai']]."  để bạn lựa chọn. ".$pagex;
}
elseif ($_GET['smang'])
{	if ($_GET['page'])$pagex="Trang ".$_GET['page'];
	$des=$myinfo[my_keyword]." - Sim ".$_GET['smang'].", Sim số Đẹp ".$_GET['smang']." | ".$myinfo[my_domain]." - Có Hàng nghìn sim số đẹp ".$_GET['smang']." giá rẻ để bạn lựa chọn. ".$pagex;	
}
elseif ($_GET['link'])
{
	$des=str_replace('-',' ',$_GET['link']);
}
elseif ($_GET['sdauso'])
{
	if ($_GET['page'])$pagex="Trang ".$_GET['page'];
	$des=$myinfo[my_keyword]." - dau so ".$_GET['sdauso']." | ".$myinfo[my_domain]." - Hàng triệu sim số đẹp giá rẻ để bạn chọn.
Hotline: ".$myinfo[my_hl1]." - ".$myinfo[my_hl2]." ".$pagex;;
}
elseif ($_GET['tag'])
{
	$xtag=str_replace("-"," ",$_GET['tag']);
	$des=$xtag." rẻ, ".$xtag." dep, ".$xtag." de nho, ".$xtag." vip";
	$stv->assign("h1x",$des);
}
else 
{
	$des=$myinfo['my_keyword']." ".$myinfo[my_domain].", ".$my_title." Vinaphone - Mobifone - Viettel .
Call: ".$myinfo[my_hl1]." - ".$myinfo[my_hl2];
}
$stv->assign("des",$des);
if ($_GET['sloai'])
{
$h1x=xds($loai['s'][$_GET['sloai']]).", sim so dep ".$loai['s'][$_GET['sloai']];
$h1link=$myinfo[my_domain]."/".$_GET['sloai'].".html";
}
elseif ($_GET['smang'])
{
$h1x=$myinfo[my_keyword]." - Sim ".$_GET['smang'].", Sim so dep ".$_GET['smang'];
$h1link=$myinfo[my_domain]."/Sim-".$_GET['smang'].".html";
}
elseif ($_GET['sdauso'])
{
$h1x="Dau so ".$_GET['sdauso'];
$h1link="/dau-so".$_GET['sdauso'].".html";
}
else 
{
$h1x="Sim so dep";
$h1link=$myinfo[my_domain];
}
function page_edith(){
	$q=mysql_query("SELECT * FROM page WHERE pcode IN('quangcao_left','mucgia')");
	while ($r=mysql_fetch_assoc($q))
	{
		if ($r['pcode']=='quangcao_left')
		$s[p_quangcao_left]=$r['pconment'];
		else 
		$s[p_mucgia]=$r['pconment'];
	}
	return $s;
}
$stv->assign(page_edith());
$stv->assign($myinfo);
$stv->assign("h1",$h1x);
$stv->assign("h1link",$h1link);
if ($_GET['sloai'] && $_GET['smang'])
$shome=' >> <a href="'.$myinfo[my_domain].'/Sim-'.$_GET['smang'].'.html">'.$_GET['smang'].'</a> >> <a href="M-'.$_GET['smang'].'-'.$_GET['sloai'].'.html">'.$loai['s'][$_GET['sloai']].'</a>';
elseif ($_GET['smang'])
$shome=' >> <a href="'.$myinfo[my_domain].'/Sim-'.$_GET['smang'].'.html">'.$_GET['smang'].'</a>';
elseif ($_GET['sloai'])
$shome=' >> <a href="'.$myinfo[my_domain].'/'.$_GET['sloai'].'.html">'.$loai['s'][$_GET['sloai']].'</a>';
$stv->assign("shome",$shome);
ob_clean();
$stv->display("header.htm");
?>