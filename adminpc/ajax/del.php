<?php
session_start();
require("../../ovikn.php");
require("../../func/mysql.php");
mysql_query("DELETE FROM notes WHERE id='".$_GET['id']."'");
?>