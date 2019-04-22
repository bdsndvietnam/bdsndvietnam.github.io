<?php
session_start();
define("wwwdir","");
require("ovikn.php");
require("libs/Smarty.class.php");
require("func/mysql.php");
require("func/xoadau.php");
require("func/paging.php");
$act=$_GET['act'];
if ($act=="" || $act==null)$act="xhome";
if (file_exists("modules/".$act.".php"))
{

	require("modules/".$act.".php");

}
else
{ 
echo "<center><b>Lỗi! :File: $act.php không tồn tại!</b></center>";
}
?>