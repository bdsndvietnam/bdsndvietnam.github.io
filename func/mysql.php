<?php
ob_start();
$ccom=mysql_connect($dbhost,$dbuser,$dbpass) or die(require("/htmlacts/lostdb.htm"));
mysql_select_db($dbname,$ccom) or die(require("/htmlacts/lostdb.htm"));
function query($sql)
	{
	
	return $q=mysql_query($sql);
	}

function insert($post,$table)
	{

		foreach ($post as $colss => $values)
		{
			$cols[]=$colss;
			$value[]="'$values'";
		}
		//echo "INSERT INTO {$table} (".join(", ",$cols).") VALUES (".join(", ",$value).")";
		$q=mysql_query("INSERT INTO {$table} (".join(", ",$cols).") VALUES (".join(", ",$value).")");
	}
function update($post,$table,$where)
	{

		foreach ($post as $cols => $value)
		{
			$update[]="{$cols}='{$value}'";
		}
		$update=join(", ",$update);
		//echo "UPDATE {$table} SET {$update} WHERE $where";
		return mysql_query("UPDATE {$table} SET {$update} WHERE $where");
		
		
	}
function fecth($sql)
	{
	
	return @mysql_fetch_array($sql);
	}
function thongbao($msg)
{
	echo "<script>alert('".$msg."')</script>";
}
function checkso($sosim,$giatien)
{
	$dau['10']=array('091', '094', '090', '093', '097', '098', '092', '095','096','099');
	$dau['10x']=array('0911','0910','0940','0941');
	$dau['11']=array('012','016','019','018');
	$dau['11x']=array('011');
	$mayban['s']=array('04','08');
	$so=$sosim;
	$gia=$giatien;
	if (($gia >= 100000 && $gia < 2000000000) && ((strlen($so)==10 && in_array(substr($so,0,3),$dau['10']) && !in_array(substr($so,0,4),$dau['10x'])) || (strlen($so)==11 && in_array(substr($so,0,3),$dau['11']) && !in_array(substr($so,0,3),$dau['11x']))  || in_array(substr($so,0,2),$mayban['s']) ))
	{
	return true;
	}
	else 
	return false;
}
function checkmang($so,$mang)
{
	
	$so=replace($so);
	if (strlen($so)==11)
	$dau=substr($so,0,4);
	else 
	$dau=substr($so,0,3);
	
	foreach ($mang as $key => $value)
	{
		if (in_array($dau,$value))
		return $key;
	}
}
function tangpt($gia,$dl)
{

	$q=query("SELECT * FROM  auto_pt WHERE dl='$dl' order by dk2 DESC");
	if (@mysql_num_rows($q) > 0)
	{
	while ($r=fecth($q))
	{
		$ptcheck[]=$r['dk1']."-".$r['dk2']."-".$r['phantram'];
	}
	foreach ($ptcheck as &$giatri)
	{
	
		list($xdk1,$xdk2,$xpt)=split("-",$giatri);
		if ($gia > $xdk1 && $gia <= $xdk2)
		{
			$giamoi=$gia+($gia*$xpt/100);
			$lengia=strlen($giamoi);
			if ($lengia == 6)
			$lengia=$lengia-2;
			elseif ($lengia == 7)
			$lengia=$lengia-2;
			elseif ($lengia == 8)
			$lengia=$lengia-3;
			elseif ($lengia==9)
			$lengia=$lengia-3;
			elseif ($lengia==10)
			$lengia=$lengia-4;
			$giadep=round($giamoi,-$lengia);
		return  $giadep;
		}
		
	}
	
	}
	return $gia;

}
function replace($data)
{
	$data=preg_replace('/[^0-9]/','',$data);
	return $data;
}
function ngay()
{
	return date('d/m/Y');
}
function ktradang($sosim,$simdl)
{
	$q=mysql_query("SELECT sim2 FROM simso WHERE sim2='".$sosim."'");
	if (mysql_num_rows($q)==0)
	{
		return true;
	}
	
	else 
	{
	$q2=mysql_query("SELECT sim2 FROM simso WHERE sim2='".$sosim."' AND simdl='".$simdl."'");
	
	if (mysql_num_rows($q2)==1)
	{
	mysql_query("DELETE FROM simso WHERE sim2='".$sosim."'");
	return true;
	}
	
	else return false;
	}
}
function soreplace($data)
{

	$data=preg_replace('/[^0-9.]/','',$data);
	return $data;
	
}
function demsodau($arr)
{
	foreach ($arr As &$va)
	{
		if (strlen($va)==3)
		$le[]="left(sim2, 3)='".$va."'";
		else 
		$le[]="left(sim2, 4)='".$va."'";
	}
	$jo=join(" || ",$le);
	$sql=query("SELECT sim2 FROM simso WHERE ($jo)");
	return mysql_num_rows($sql);
	
}
function demsimml($arr1,$arr2)
{
		foreach ($arr1 AS &$value)
	{
		if (strlen($value)==3)
		$l3[]="'".$value."'";
		else 
		$l4[]="'".$value."'";
		$valuex[]=$value;
	}
	if ($l4  && $l3)
	$where.="AND(left(sim2,3) IN(".join(", ",$l3).") || left(sim2,4) IN(".join(", ",$l4)."))";
	else if ($l3)
	$where.="AND(left(sim2,3) IN(".join(", ",$l3)."))";
	else 
	$where.="AND(left(sim2,4) IN(".join(", ",$l4)."))";
	$where.="AND (".join(" AND ",$arr2).")";
	$sql=mysql_query("SELECT sim2 FROM simso WHERE sim2 $where");
	return mysql_num_rows($sql);
}
function loca($url)
{
	echo "<script>window.location.href='".$url."';</script>";
}
function hoahong($sosim)
{
	$q=query("SELECT simdl, gianhap FROM simso WHERE sim2='".$sosim."'");
	$r=fecth($q);
	$q2=query("SELECT * FROM pt_daily WHERE dl='".$r['simdl']."'");
	while ($r2=fecth($q2))
	{
		if ($r['gianhap']*1000000 >= $r2['dk1'] && $r['gianhap']*1000000 <= $r2['dk2'])
		{
			return $r2['pt'];
		}
	}
}
class curl
{
    var $channel ;
    
    function curl(  )
    {
        $this->channel = curl_init( );
        // you might want the headers for http codes
        curl_setopt( $this->channel, CURLOPT_HEADER, true );
        // you may need to set the http useragent for curl to operate as
        curl_setopt( $this->channel, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        // you wanna follow stuff like meta and location headers
        curl_setopt( $this->channel, CURLOPT_FOLLOWLOCATION, true );
        // you want all the data back to test it for errors
        curl_setopt( $this->channel, CURLOPT_RETURNTRANSFER, true );
        // probably unecessary, but cookies may be needed to
        curl_setopt( $this->channel, CURLOPT_COOKIEJAR, 'cookie.txt');
        // as above
        curl_setopt( $this->channel, CURLOPT_COOKIEFILE, 'cookie.txt');    
    }
    function makeRequest( $method, $url, $vars )
    {
        // if the $vars are in an array then turn them into a usable string
        if( is_array( $vars ) ):
            $vars = implode( '&', $vars );
        endif;
        
        // setup the url to post / get from / to
        curl_setopt( $this->channel, CURLOPT_URL, $url );
        // the actual post bit
        if ( strtolower( $method ) == 'post' ) :
            curl_setopt( $this->channel, CURLOPT_POST, true );
            curl_setopt( $this->channel, CURLOPT_POSTFIELDS, $vars );
        endif;
        // return data
        return curl_exec( $this->channel );
    }
}
class xstv_sms
{
	
	function check_login($username,$password)
	{
		$curl = new curl();
		 $c_login=$curl->makeRequest( 'post','http://wap.mobifone.com.vn/wap/xhtml/mypage/checkPassword.jsp','username='.$username.'&password='.$password.'');
		if (strpos($c_login,"Logout")!==false)
		return true;
		else 
		return false;
		
		
	}
	function send_sms($phone,$msg)
	{
		$curl2 = new curl();
		$c_send=$curl2->makeRequest( 'post','http://wap.mobifone.com.vn/wap/xhtml/mypage/sms/result.jsp?lang=vn&action=mypage','phonenum='.preg_replace('/[^0-9]/','',$phone).'&message='.$msg.'');
		if (strpos($c_send,"Lenh gui tin nhan den so")!==false)
		return true;
		else 
		return false;
	}

}
function doctien($number)
{
$donvi=" &#273;&#7891;ng ";
$tiente=array("nganty" => " ngh&#236;n t&#7927; ","ty" => " t&#7927; ","trieu" => " tri&#7879;u ","ngan" =>" ngh&#236;n ","tram" => " tr&#259;m ");
$num_f=$nombre_format_francais = number_format($number, 2, ',', ' ');
$vitri=strpos($num_f,',');
$num_cut=substr($num_f,0,$vitri);
$mang=explode(" ",$num_cut);
$sophantu=count($mang);
switch($sophantu)
{
    case '5':
            $nganty=doc3so($mang[0]);
            $text=$nganty;
            $ty=doc3so($mang[1]);
            $trieu=doc3so($mang[2]);
            $ngan=doc3so($mang[3]);
            $tram=doc3so($mang[4]);
            if((int)$mang[1]!=0)
            {
                $text.=$tiente['ngan'];
                $text.=$ty.$tiente['ty'];
            }
            else
            {
                $text.=$tiente['nganty'];
            }
            if((int)$mang[2]!=0)
                $text.=$trieu.$tiente['trieu'];
            if((int)$mang[3]!=0)
                $text.=$ngan.$tiente['ngan'];
            if((int)$mang[4]!=0)
                $text.=$tram;
            $text.=$donvi;
            return  $text;
            
            
    break;
    case '4':
            $ty=doc3so($mang[0]);
            $text=$ty.$tiente['ty'];
            $trieu=doc3so($mang[1]);
            $ngan=doc3so($mang[2]);
            $tram=doc3so($mang[3]);
            if((int)$mang[1]!=0)
                $text.=$trieu.$tiente['trieu'];
            if((int)$mang[2]!=0)
                $text.=$ngan.$tiente['ngan'];
            if((int)$mang[3]!=0)
                $text.=$tram;
            $text.=$donvi;
            return $text;
            
            
    break;
    case '3':
            $trieu=doc3so($mang[0]);
            $text=$trieu.$tiente['trieu'];
            $ngan=doc3so($mang[1]);
            $tram=doc3so($mang[2]);
            if((int)$mang[1]!=0)
                $text.=$ngan.$tiente['ngan'];
            if((int)$mang[2]!=0)
                $text.=$tram;
            $text.=$donvi;
            return $text;
    break;
    case '2':
            $ngan=doc3so($mang[0]);
            $text=$ngan.$tiente['ngan'];
            $tram=doc3so($mang[1]);
            if((int)$mang[1]!=0)
                $text.=$tram;
            $text.=$donvi;
            return $text;
                
    break;
    case '1':
            $tram=doc3so($mang[0]);
            $text=$tram.$donvi;
            return $text;
            
    break;
    default:
        echo "Xin l&#7895;i s&#7889; qu&#225; l&#7899;n kh&#244;ng th&#7875; &#273;&#7893;i &#273;&#432;&#7907;c";
    break;
}
}
function doc3so($so)
{
    $achu = array ( " kh&#244;ng "," m&#7897;t "," hai "," ba "," b&#7889;n "," n&#259;m "," s&#225;u "," b&#7843;y "," t&#225;m "," ch&#237;n " );
    $aso = array ( "0","1","2","3","4","5","6","7","8","9" );
    $kq = "";
    $tram = floor($so/100); // H&#224;ng tr&#259;m
    $chuc = floor(($so/10)%10); // H&#224;ng ch&#7909;c
    $donvi = floor(($so%10)); // H&#224;ng &#273;&#417;n v&#7883;
    if($tram==0 && $chuc==0 && $donvi==0) $kq = "";
    if($tram!=0)
    {
        $kq .= $achu[$tram] . " tr&#259;m ";
        if (($chuc == 0) && ($donvi != 0)) $kq .= " l&#7867; ";
    }
    if (($chuc != 0) && ($chuc != 1))
    {
            $kq .= $achu[$chuc] . " m&#432;&#417;i";
            if (($chuc == 0) && ($donvi != 0)) $kq .= " linh ";
    }
    if ($chuc == 1) $kq .= " m&#432;&#7901;i ";
    switch ($donvi)
    {
        case 1:
            if (($chuc != 0) && ($chuc != 1))
            {
                $kq .= " m&#7889;t ";
            }
            else
            {
                $kq .= $achu[$donvi];
            }
            break;
        case 5:
            if ($chuc == 0)
            {
                $kq .= $achu[$donvi];
            }
            else
            {
                $kq .= " n&#259;m ";
            }
            break;
        default:
            if ($donvi != 0)
            {
                   $kq .= $achu[$donvi];
            }
            break;
    }
    if($kq=="")
    $kq=0;   
    return $kq;
}
function doc_so($so)
{
    $so = preg_replace("([a-zA-Z{!@#$%^&*()_+<>?,.}]*)","",$so);
    if (strlen($so) <= 21)
    {
        $kq = "";
        $c = 0;
        $d = 0;
        $tien = array ( "", " ngh&#236;n", " tri&#7879;u", " t&#7927;", " ngh&#236;n t&#7927;", " tri&#7879;u t&#7927;", " t&#7927; t&#7927;" );
        for ($i = 0; $i < strlen($so); $i++)
        {
            if ($so[$i] == "0")
                $d++;
            else break;
        }
        $so = substr($so,$d);
        for ($i = strlen($so); $i > 0; $i-=3)
        {
            $a[$c] = substr($so, $i, 3);
            $so = substr($so, 0, $i);
            $c++;
        }
        $a[$c] = $so;
        for ($i = count($a); $i > 0; $i--)
        {
            if (strlen(trim($a[$i])) != 0)
            {
                if (doc3so($a[$i]) != "")
                {
                    if (($tien[$i-1]==""))
                    {
                        if (count($a) > 2)
                            $kq .= " kh&#244;ng tr&#259;m l&#7867; ".doc3so($a[$i]).$tien[$i-1];
                        else $kq .= doc3so($a[$i]).$tien[$i-1];
                    }
                    else if ((trim(doc3so($a[$i])) == "m&#432;&#7901;i") && ($tien[$i-1]==""))
                    {
                        if (count($a) > 2)
                            $kq .= " kh&#244;ng tr&#259;m ".doc3so($a[$i]).$tien[$i-1];
                        else $kq .= doc3so($a[$i]).$tien[$i-1];
                    }
                    else
                    {
                    $kq .= doc3so($a[$i]).$tien[$i-1];
                    }
                }
            }
        }
        return $kq;
    }
    else
    {
        return "S&#7889; qu&#225; l&#7899;n!";
    }
}
function is_bot(){
$crawlers=array('aspseek','abachobot','accoona','acoirobot','adsbot','alexa','alta vista','altavista','ask jeeves','baidu','crawler','croccrawler','dumbot','estyle','exabot','fast-enterprise','fast-webcrawler','francis','geonabot','gigabot','google','heise','heritrix','ibm','iccrawler','idbot','ichiro','lycos','msn','msrbot','majestic-12','metager','ng-search','nutch','omniexplorer','psbot','rambler','seosearch','scooter','scrubby','seekport','sensis','seoma','snappy','steeler','synoo','telekom','turnitinbot','voyager','wisenut','yacy','yahoo');
foreach($crawlers as $c){if(stristr($_SERVER['HTTP_USER_AGENT'],$c))return true;}
return false;
}
?>