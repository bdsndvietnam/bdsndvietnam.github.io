<?php
$stv=new Smarty();
foreach ($loai['s'] as $namef => $valuef)
{
	$linkf[]=$namef;
	$linknamef[]=$valuef;	
}
function nlist()
{
	$q=query("SELECT id FROM news");
	$r=mysql_num_rows($q);
	$st=ceil($r/10);
	$str="<div id='newslist'><br/>";
	for ($i=1;$i<=$st;$i++)
	{
		$str.="<a onclick=\"$('#newsl').load('aindex.php?act=newm&p=".$i."');\" href=\"javascript:void(0)\">".$i."</a>";
	}
	$str.="</div>";
	return $str;	
}
$stv->assign("newlist",nlist());
$stv->assign("h1",$h1x);
$stv->assign("h1link",$h1link);
$stv->assign("linkf",$linkf);
$stv->assign("linknamef",$linknamef);
$stv->assign("dates",date('H:i:s d/m/Y',$ntime));
$stv->assign($myinfo);
if (is_array($_COOKIE['my_cart']))
$stv->assign("showcart",1);
/**
$doc = new DOMDocument();
$doc->load('http://sodep123.com/rss.php');
$Feeds = array();
foreach ($doc->getElementsByTagName('item') as $node) {
        $itemRSS = array (
            'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
            'desc' => $node->getElementsByTagName('description')->item(0)->nodeValue,
            'link' => $node->getElementsByTagName('link')->item(0)->nodeValue,
            'date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue
            );
        array_push($Feeds, $itemRSS);
    }    
    foreach ($Feeds AS $des)
    {
    	$rss[]= "<a target='_blank' href='".$des['link']."' title='".$des['title']."'>".$des['title']."</a>";
    }
    $stv->assign("ads",join(" <br> ",$rss));    
  **/
$q=query("SELECT id AS aid, tieude AS atieude FROM news WHERE id!='".$_GET['newid']."' order by STT DESC limit 0,20");
while ($r=fecth($q))
{
	$r['tieude']=xoadau($r['atieude']);
	$nd[]=$r;
}
$stv->assign("nd",$nd); 
function page_editf(){
	$q=mysql_query("SELECT * FROM page WHERE pcode IN('hotline','quangcao','banquyen','taikhoan')");
	while ($r=mysql_fetch_assoc($q))
	{
		if ($r['pcode']=='hotline')
		$s[p_hotline]=$r['pconment'];
		elseif ($r['pcode']=='quangcao')
		$s[p_quangcao]=$r['pconment'];
		elseif ($r['pcode']=='taikhoan')
		$s[p_taikhoan]=$r['pconment'];
		else 
		$s[p_banquyen]=$r['pconment'];
	}
	return $s;}
function fsimmoive(){
	$sql=mysql_query("SELECT * FROM simso FROM WHERE simdl=2 order by giaban desc limit 400");
	while ($row=mysql_fetch_array($sql))
	{
		$row['giaban']=number_format($row['giaban']*1000000,0,".",".");
		$data[]=$row;
	}
	return $data;
}
$stv->assign("simmoi",fsimmoive());
$stv->assign(page_editf());
$stv->display("footer.htm");
?>