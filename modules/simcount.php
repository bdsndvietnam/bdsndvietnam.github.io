<table style="background: #fff; width: 100%" cellpadding="0" cellspacing="0">
<?php
$i=0;
foreach ($mang[s] AS $key => $arrvalue)
{
	$i++;
	if ($i%2==0)$class="ui-widget-content";else $class="";
	$dem=demsimml($mang[s][$key],$arrvalue);
	echo '
<tr style="width: 100%; height: 25px" class='.$class.'>
		<td style="border-left: 1px solid #e0e0e0; border-bottom: 1px solid #e0e0e0; text-align: left">&nbsp; &nbsp;&nbsp;'.$key.':</td>
		<td style="border-left: 1px solid #e0e0e0; border-bottom: 1px solid #e0e0e0; text-align: left">&nbsp; &nbsp;&nbsp;<b>'.number_format($dem,0,".",".").'</b>Sim</td>
	</tr>
';
	$total+=$dem;
}

echo '	<tr style="width: 100%; height: 25px">
		<td colspan="2" style="border-left: 1px solid #e0e0e0; border-bottom: 1px solid #e0e0e0; text-align: center"><b>Tổng số:&nbsp;&nbsp;'.number_format($total,0,".",".").' SIM</b></td>
	</tr>
	</table>
';
?>
</table>