<?php
$q=query("SELECT simid, COUNT(*) AS total FROM simso GROUP BY sim2 ORDER BY simid DESC");
$dem=0;
while ($row=fecth($q))
{
if ($row['total'] > 1)
{
   $d=mysql_query("DELETE FROM simso WHERE simid='".$row['simid']."'");
   $dem++;
}
}
@mysql_free_result($q);
@mysql_free_result($d);
@mysql_close();
echo "<center>Xóa thành công $dem Số!</center>";
?>