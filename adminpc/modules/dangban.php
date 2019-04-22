<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/
$sql = query( "SELECT * FROM raobansim");
while($dangban=mysql_fetch_array($sql))
{
?> 
<p>
<strong>SỐ SIM:</strong> <?php echo $dangban['sosim'];?>
<br>
<strong>LIÊN HỆ:</strong> <?php echo $dangban['mobile'];?>
<br>
<strong>NGÀY KẾT THÚC:</strong> <?php echo $dangban['ngayketthuc'];?>
<br>
</p>
<?php 
}
mysql_close();
?>