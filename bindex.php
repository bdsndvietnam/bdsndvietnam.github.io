<?php
session_start();
require("ovikn.php");
require("func/mysql.php");
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
mysql_close();
?>