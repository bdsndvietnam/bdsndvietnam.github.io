<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/

require( "ovikn.php" );
require( "func/mysql.php" );
$sql = query( "select * FROM thanhvien WHERE city='Hà Nội' order by id desc limit 100" );
while ( $row = fecth( $sql ) )
{
	echo $row['hovaten']."\t".$row['hovaten']."\t".$row['diachi']."\t".$row['city']."\n <br>";
}
?>
