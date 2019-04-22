<?php
	if (isset($_GET['sim']))
	setcookie("my_cart[".$_GET['sim']."]",$_GET['gia'],time()+3600*24);
echo '<div class="ui-tabs ui-widget ui-widget-content ui-corner-all">
	<ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
		<li class="ui-state-default ui-corner-top ui-tabs-selected ui-state-hover">
		<a>Giỏ hàng</a></li>
	</ul>
	<div class="ui-tabs-panel ui-widget-content ui-corner-bottom">';
	$my_cart=$_COOKIE['my_cart'];
	if (is_array($my_cart))
{
	foreach ($my_cart AS $sosim => $giatien)
	{
		echo $sosim." ".$giatien."<br>";
	}
}
	else 
	echo "Giỏ hàng chưa có gì!";	
echo '
	</div>
</div>';
?>