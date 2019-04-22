<?php
$stv = new Smarty( );
$sql = query( "SELECT * FROM thanhvien WHERE live <3 order by live DESC limit 10" );
while ( $row = fecth( $sql ) )
$homemenu[] = $row;
$stv->assign( "homemenu", $homemenu );
$stv->display( "thanhvientest.htm" );
?>