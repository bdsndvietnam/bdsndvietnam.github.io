<?php
session_start();
define("wwwdir","");
function checkcache($url,$t_cache)
{
	$fname=str_replace(array('http://'.$_SERVER['HTTP_HOST'].'/index.php?','&','='),array('','_','_'),$url);
	$day="so_dep_";
	if (file_exists("cache/".$day.$fname.".html") and round(filesize("cache/".$day.$fname.".html")/1024,2) > 10 And time()-@filemtime("cache/".$day.$fname.".html") < $t_cache)
	return true;
	else 
	{
		
		$open=@fopen("cache/".$day.$fname.".html","wb");
		$content=file_get_contents($url."&c=yes");
		fwrite($open,$content);
		fclose($open);
	}
}
$arract=array('sim-so-dep','');
if (!$_GET['show'] and !$_GET['page'] and !$_GET['c']  and in_array($_GET['act'],$arract))
$testcache=checkcache("http://".$_SERVER['HTTP_HOST']."/index.php?".$_SERVER['QUERY_STRING'],$myinfo[cache]);
if ($testcache==true)
require("cache/"."so_dep_".str_replace(array('&','='),"_",$_SERVER['QUERY_STRING']).".html");
else 
{
require("ovikn.php");
require("libs/Smarty.class.php");
require("func/mysql.php");
require("func/xoadau.php");
require("func/paging.php");
$act=$_GET['act'];
if ($act=="" || $act==null)$act="xhome";
if (file_exists("modules/".$act.".php"))
{
	require("header.php");
	require("modules/".$act.".php");
	require("footer.php");
}
else 
echo "<center><b>Lỗi! :File: $act.php không tồn tại!</b></center>";
}
?>