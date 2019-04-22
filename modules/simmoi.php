<?php
function fsimmoive(){
	$sql=mysql_query("SELECT * FROM simmoi order by giaban desc limit 400");
	while ($row=mysql_fetch_array($sql))
	{
		$row['giaban']=number_format($row['giaban']*1,0,".",".");
		$data[]=$row;
	}
	return $data;
}
$stv->assign("simmoi",fsimmoive());
$stv->display("simmoi.htm");
?>