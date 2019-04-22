<?php
if (isset($_POST['submit']))
{
$stv=new Smarty();
$_POST['post']['ngayketthuc']=($_POST['post']['ngayketthuc']*24*60*60);
$_POST['post']['ngaybatdau']=time();
$q=query("SELECT * FROM yeucausim WHERE mobile='".$_POST['post']['mobile']."'");
if (@mysql_num_rows($q) > 0)
{
	$_POST['post']['send']=0;
	$_POST['post']['active']=0;
	update($_POST['post'],"yeucausim","mobile='".$_POST['post']['mobile']."'");
}
else 
insert($_POST['post'],"yeucausim");
$stv->assign("mobile",$_POST['post']['mobile']);
$stv->display("yeucausimok.htm");	
}
else 
{
$stv=new Smarty();
$stv->display("yeucausim.htm");
}
?>