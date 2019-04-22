<?php
$stv=new Smarty();
$sql=query("SELECT tieude AS ntieude, noidung AS nnoidung FROM news WHERE id='".$_GET['newid']."'");
$stv->assign(fecth($sql));
$stv->assign("nd",$nd);
$stv->display("news.htm");
?>