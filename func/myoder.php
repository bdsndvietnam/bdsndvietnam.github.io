<?php
class myoder
{
	function insert($post,$table)
	{
		foreach ($post AS $colss => $values)
		{
			$cols[]=$colss;
			$value[]="'$values'";
		}
		//echo "INSERT INTO {$table} (".join(", ",$cols).") VALUES (".join(", ",$value).")";
		return mysql_query("INSERT INTO {$table} (".join(", ",$cols).") VALUES (".join(", ",$value).")");
		
	}
	function connect($db_host,$db_user,$db_pass,$db_name)
	{
		$ccon=mysql_connect($db_host,$db_user,$db_pass) or die('Khong ket noi duoc voi may chu');
		mysql_select_db($db_name,$ccon) or die('khong tim thay '.$db_name);
		return $ccon;
		
	}
	function sms($arr,$to_phone,$user,$pass)
	{
	$smsx=new xstv_sms();
	$stv_check=$smsx->check_login($user,$pass);
	if ($stv_check==true)
	{
	$stv_send=$smsx->send_sms(preg_replace('/[^0-9]/','',$to_phone),$arr);
	}	
	}
	function semail($arr,$to_email)
	{
		
	}
	function daily($sim2)
	{
		$q=mysql_query("SELECT thanhvien.hovaten AS hovaten ,thanhvien.id AS id from thanhvien,simso WHERE thanhvien.id=simso.simdl AND simso.sim2='".$sim2."'");
		return mysql_fetch_array($q);
		
		
	}
	function checkgn($sosim)
	{
		$sql=mysql_query("SELECT * from simso WHERE sim2='".$sosim."'");
		$row=mysql_fetch_array($sql);
		return $row['gianhap'];
	}
}
?>