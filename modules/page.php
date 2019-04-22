<?php
if ($_GET['pid'])
$where="WHERE id='".$_GET['pid']."'";
if ($_GET['pcode'])
$where="WHERE pcode='".$_GET['pcode']."'";
$sql=query("SELECT * FROM page ".$where);
$row=fecth($sql);
?>
<div class="ui-tabs ui-widget ui-widget-content ui-corner-all">
	<ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
		<li class="ui-state-default ui-corner-top ui-tabs-selected ui-state-default">
		<a><?=$row['ptitle']?></a></li>
	</ul>
	<div class="ui-tabs-panel ui-widget-content">
	<?=$row['pconment']?>				
	</div>
</div>
