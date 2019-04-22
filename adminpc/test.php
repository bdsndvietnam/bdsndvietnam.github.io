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
( );
$curl = new curl( );
echo $curl->makeRequest( "post", "http://wap.mobifone.com.vn/wap/xhtml/mypage/checkPassword.jsp", "username=0937666886&password=hyn123&remember=1&submit=Ok" );
echo $curl->makeRequest( "post", "http://wap.mobifone.com.vn/wap/xhtml/mypage/sms/result.jsp?lang=vn&action=mypage", "phonenum=0914779999&message=sssssssssssssss test&submit=Ok" );
?>
