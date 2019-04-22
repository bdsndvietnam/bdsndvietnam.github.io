<?php
set_time_limit(300*60);
$stv=new Smarty();

function extractZip( $zipFile = '', $dirFromZip = '' )
{    
    define(DIRECTORY_SEPARATOR, '/');

    $zipDir = getcwd() . DIRECTORY_SEPARATOR;
    $zip = zip_open($zipDir.$zipFile);

    if ($zip)
    {
        while ($zip_entry = zip_read($zip))
        {
            $completePath = $zipDir . dirname(zip_entry_name($zip_entry));
            $completeName = $zipDir . zip_entry_name($zip_entry);
            
            // Walk through path to create non existing directories
            // This won't apply to empty directories ! They are created further below
            if(!file_exists($completePath) && preg_match( '#^' . $dirFromZip .'.*#', dirname(zip_entry_name($zip_entry)) ) )
            {
                $tmp = '';
                foreach(explode('/',$completePath) AS $k)
                {
                    $tmp .= $k.'/';
                    if(!file_exists($tmp) )
                    {
                        @mkdir($tmp, 0777);
                    }
                }
            }
            
            if (zip_entry_open($zip, $zip_entry, "r"))
            {
                if( preg_match( '#^' . $dirFromZip .'.*#', dirname(zip_entry_name($zip_entry)) ) )
                {
                    if ($fd = @fopen($completeName, 'w+'))
                    {
                        fwrite($fd, zip_entry_read($zip_entry, zip_entry_filesize($zip_entry)));
                        fclose($fd);
                    }
                    else
                    {
                        // We think this was an empty directory
                        mkdir($completeName, 0777);
                    }
                    zip_entry_close($zip_entry);
                }
            }
        }
        zip_close($zip);
    }
    return true;
}
if ($_POST['submit'])
{
if ($_POST['textsim']=="")
{
	copy($_FILES['file']['tmp_name'],$_FILES['file']['name']);
	chmod($_FILES['file']['name'],0755);
	extractZip($_FILES['file']['name'],'' );
	$handle = @fopen($_FILES['file']['name'].".txt", "r");
	$p['p']['simdl']=$_POST['select'];
	$p['p']['ngaynhap']=ngay();
	$p['p']['usernhap']=$_SESSION['username'];
	$j=0;
if ($handle) {
    while (!feof($handle)) {
        $lineso = fgets($handle, 4096);
       
        list($sosim,$giaban)=split("	",$lineso);
			if ($_POST['donvi']==1)
			{
				$giaban=soreplace($giaban)*1000;
				
			}
			if ($_POST['donvi']==2)
			{
				$giaban=soreplace($giaban)*1000000;
				
			}
			$giaban=replace($giaban);
			if ($gianhap=="")$p['p']['gianhap']=$giaban;
			if ($_SESSION['pt']==1)$giaban=tangpt($giaban);
			$p['p']['sim1']=$sosim;
			$p['p']['sim2']=replace($sosim);
			$p['p']['giaban']=$giaban;
			insert($p['p'],"simso");
			$j++;
			
				
			
        
        
        }
       
    }
     echo thongbao("Bạn đã đăng thành công ".$j." số !");
    fclose($handle);
    @unlink($_FILES['file']['name']);
    @unlink(str_replace('.zip','.txt',$_FILES['file']['name']));
}
}
else 
{
dangsotutext($_POST['textsim']);	
}
}




function dangsotufile()
{
	
}
function dangsotutext($data)
{
	$e=explode("
",$data);
	$p['p']['simdl']=$_POST['select'];
	$p['p']['ngaynhap']=ngay();
	$p['p']['usernhap']=$_SESSION['username'];
	$j=0;
	for ($i=0;$i<count($e)-1;$i++)
	{
		list($sosim,$giaban,$gianhap)=split("	",$e[$i]);
			if ($_POST['donvi']==1)
			{
				$giaban=soreplace($giaban)*1000;
				$gianhap=soreplace($gianhap)*1000;
			}
			if ($_POST['donvi']==2)
			{
				$giaban=soreplace($giaban)*1000000;
				$gianhap=soreplace($gianhap)*1000000;
			}
			
		if (checkso($sosim,$giaban))
		{

			$giaban=replace($giaban);
			if ($gianhap=="")$p['p']['gianhap']=$giaban;
			else $p['p']['gianhap']=replace($gianhap);
			if ($_SESSION['pt']==1)$giaban=tangpt($giaban);
			$p['p']['sim1']=soreplace($sosim);
			$p['p']['sim2']=replace($sosim);
			$p['p']['giaban']=$giaban;
			query("DELETE FROM simso WHERE sim2='".replace($sosim)."'");
			insert($p['p'],"simso");
			$j++;
				


		}
	}
	echo thongbao("Bạn đã đăng thành công ".$j." số !");
}
$q=query("SELECT * FROM thanhvien WHERE live='1'");
while ($r=fecth($q))
{
	$oid[]=$r['id'];
	$oname[]=$r['hovaten'];
	
}
$stv->assign("oid",$oid);
$stv->assign("oname",$oname);

$stv->display("dangso.htm");
?>