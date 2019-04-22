<?php
$sql = query( "SELECT so FROM list" );
while ( $r = fecth( $sql ) )
{
	$join[] = "'".$r['so']."'";
}
query( "DELETE FROM sosim WHERE sim2 IN(".join( $join ).")" );
$q = query( "SELECT simid, COUNT(sim2) AS total FROM simso GROUP BY sim2 ORDER BY simid DESC" );
$dem = 0;
while ( $row = fecth( $q ) )
{
	if ( 1 < $row['total'] )
	{
		$d = mysql_query( "DELETE FROM simso WHERE simid='".$row['simid']."'" );
		++$dem;
	}
}
@mysql_free_result( $q );
@mysql_free_result( $d );
@mysql_close( );
echo "<center>Xóa thành công ";
echo $dem;
echo " Số!</center>";
?>