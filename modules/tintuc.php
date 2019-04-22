<?php
$stv=new Smarty();
function replacetin($data)
{
	$arrkey1=array('sim số đẹp','số đẹp','Sim đẹp','sim','<a','(Dân trí)');
	$arrkey2=array('<a href="http://nganhangsimsodep.com">sim số đẹp</a>','<a href="http://nganhangsimsodep.com">số đẹp</a>','<a href="http://nganhangsimsodep.com">sim đẹp</a>','<a href="http://nganhangsimsodep.com">sim</a>','<a rel="nofollow"','(NHSSD)');
	return str_replace($arrkey1,$arrkey2,$data);
}
$url=explode('tintuc.html?',$_SERVER['REQUEST_URI']);
if (strlen($url[1]) > 0)
{
$curl = new curl( );
$readdata=$curl->makeRequest('get','http://dantri.com.vn/'.$url[1],'');
$readdata=explode('<div id="ctl00_IDContent_ctl00_divContent">',$readdata);
$readdata=explode('<div class="emailprint">',$readdata[1]);
$stv->assign("htmldata",replacetin(preg_replace("/\<a([^>]*)\>([^<]*)\<\/a\>/i", "$2", $readdata[0]))." Tag: <a href='http://nganhangsimsodep.com'>sim so dep</a>");
}
$stv->display("tintuc.htm");
?>