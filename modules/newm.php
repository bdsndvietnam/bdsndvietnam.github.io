<?

$msp=14;

$p=$_GET['p'];

if ($p)$p--;

$bg=$msp*$p;

$nsql=query("SELECT id AS nid, tieude AS ntieude FROM news where domain='".str_replace("www.","",$_SERVER['HTTP_HOST'])."' ORDER BY stt ASC limit $bg,$msp");
$i=0;
while ($rn=fecth($nsql))

{
$i++;
	$rn['tieude']=xoadau($rn['ntieude']);
	echo '<p class=ui-widget-content style="line-height:20px; margin: 0;"><a href="'.$myinfo['my_domain'].'/sim-so-dep-gia-re-viettel-mobifone-vinaphone-'.$rn['nid'].'-'.$rn['tieude'].'.html">'.$rn['ntieude'].'</a></p>';



}

?>

