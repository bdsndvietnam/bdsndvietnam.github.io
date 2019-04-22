<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/
$stv = new Smarty( );
$qml = query( "SELECT * FROM menu WHERE menu!='' order BY moder ASC", $ccom );
while ( $rqml = fecth( $qml ) )
{
	$menu .= "<li><a href=\"?act=".$rqml['mmd']."\" >".$rqml['menu']."</a>";
	$qml2 = query( "SELECT * FROM menu WHERE mgr='".$rqml['mid']."' AND smenu!='' ORDER BY moder ASC", $ccom );
	if ( 0 < mysql_num_rows( $qml2 ) )
	{
		$menu .= "<ul>";
		while ( $rqml2 = fecth( $qml2 ) )
		{
			$menu .= "<li><a href=\"?act=".$rqml2['mmd']."\" >".$rqml2['smenu']."</a></li>";
		}
		$menu .= "</ul>";
	}
	$menu .= "</li>";
}
$stv->assign( $myinfo );
$stv->assign( "menu", $menu );
$stv->display( "header.htm" );
?>
