<?php
/*
paging.php
chứa hàm trả về chuỗi phân trang
*/

/*
tham số của hàm paging
/*
$totalRow: tổng số dòng
$curPage: vị trí trang hiện tại đang xem
$maxPage: = Số lượng record trong mỗi trang
$maxRow=5
*/

/*
$totalRow: tong so dong
$curPage: vi tri hien tai dang xem
$maxPage: =5 so luong trang ham paging tra ve
EX:
Current Page : 5   Total pages : 10
Go to page :  1  2  3  4  5  Next  
MAX : SỐ LƯỢNG RECOD TRẢ VỀ
*/
//echo paging($totalRow,$curPage,$maxPage,$maxRow);
//	echo paging($maxRow,$curPage,5,MAX); 

function paging($totalRows,$curPg,$pg,$re)	  
{			 				
	$paging="";	         		 
	$mxR = $re;
	$mxP = $pg;
	if($totalRows%$mxR==0)  
		$totalPages = (int)($totalRows/$mxR);
	else 
		$totalPages = (int)($totalRows/$mxR+1);

				
	$curRow = ($curPg-1)*$mxR+1;
	$paging="<table cellspacing='0' cellpadding='0'><tr><td colspan='13'>";
	$paging .="Bạn đang xem trang :&nbsp;";
	$paging .="<font color=red>".number_format($curPg,0,".",".");
	$paging .="</font>&nbsp;&nbsp;&nbsp;";
	$paging .="Trên tổng số&nbsp;";
	$paging .="<FONT color=red>";
	$paging .=number_format($totalPages,0,".",".")."</FONT> trang<br></td></tr><tr><td></td></tr><tr>"; 
	if($totalRows>$mxR)
	{
	 	$start=1;
	 	$end=1;
	 	$paging1 ="";				 	 
		for($i=1;$i<=$totalPages;$i++)
		{	if(($i>((int)(($curPg-1)/$mxP))* $mxP) && ($i<=((int)(($curPg-1)/$mxP+1))* $mxP))
			{
				if($start==1) $start=$i;
					if($i==$curPg)      
					  	$paging1 .=  "<td><div class='i2'>".$i."</div></td>";
							else    
							{
							  	$paging1 .= "<td width='26'><div class='i'><a href='javascript:";
								$paging1 .="GotoPage(".$i.")'>".$i;
								$paging1 .="</a></td>";	
							}
							$end=$i;	
						}
					}

					if($curPg>$mxP)
						{
					 	$paging .="<td whdth='22'><div class='next'><a href='javascript:";
						$paging .="GotoPage(".($start-1);
						$paging .=")'>Pre</a></div></td>";
						}
					$paging.=$paging1;
					if($curPg < $totalPages)
						{
						$paging .= "<td><div class='next'><a href='javascript:";
						$paging .="GotoPage(".($end+1);
						$paging .=")'>Next</a></div></td>";
						}
					}
					$paging .="</tr></table>";
				 return $paging;
			}
			
			
function strang($totalRows,$curPg,$pg,$re,$xurl,$xindex=".html")	  
{			 				
	$paging="";	         		 
	$mxR = $re;
	$mxP = $pg;
	if($totalRows%$mxR==0)  
		$totalPages = (int)($totalRows/$mxR);
	else 
		$totalPages = (int)($totalRows/$mxR+1);

				
	$curRow = ($curPg-1)*$mxR+1;
	$paging="<table cellspacing='0' cellpadding='0'><tr><td colspan='13'>";
	$paging .="Bạn đang xem trang :&nbsp;";
	$paging .="<font color=red>".number_format($curPg,0,".",".");
	$paging .="</font>&nbsp;&nbsp;&nbsp;";
	$paging .="Trên tổng số&nbsp;";
	$paging .="<FONT color=red>";
	$paging .=number_format($totalPages,0,".",".")."</FONT> trang<br></td></tr><tr><td></td></tr><tr>"; 
	if($totalRows>$mxR)
	{
	 	$start=1;
	 	$end=1;
	 	$paging1 ="";				 	 
		for($i=1;$i<=$totalPages;$i++)
		{	if(($i>((int)(($curPg-1)/$mxP))* $mxP) && ($i<=((int)(($curPg-1)/$mxP+1))* $mxP))
			{
				if($start==1) $start=$i;
					if($i==$curPg)      
					  	$paging1 .=  "<td><div class='i2'>".$i."</div></td>";
							else    
							{
							  	$paging1 .= "<td width='26'><div class='i'><a class='ik' href='".$xurl.$i.$xindex."'><span>".$i;
								$paging1 .="</span></a></div></td>";	
							}
							$end=$i;	
						}
					}

					if($curPg>$mxP)
						{
					 	$paging .="<td whdth='22'>
					 	<div class='next'><a class='ik' href='".$xurl.($start-1).$xindex."'>
					 	Pre</a></div></td>";
						}
					$paging.=$paging1;
					if($curPg < $totalPages)
						{
						$paging .= "<td><div class='next'><a class='ik' href='".$xurl.($end+1).$xindex."'>Next</a></div></td>";
						}
					}
					$paging .="</tr></table>";
				 return $paging;
			}
			
function xstrang($totalRows,$curPg,$pg,$re,$xurl)	  
{			 				
	$paging="";	         		 
	$mxR = $re;
	$mxP = $pg;
	if($totalRows%$mxR==0)  
		$totalPages = (int)($totalRows/$mxR);
	else 
		$totalPages = (int)($totalRows/$mxR+1);

				
	$curRow = ($curPg-1)*$mxR+1;
	$paging="<table cellspacing='0' cellpadding='0'><tr><td colspan='13'>";
	$paging .="Bạn đang xem trang :&nbsp;";
	$paging .="<font color=red>".number_format($curPg,0,".",".");
	$paging .="</font>&nbsp;&nbsp;&nbsp;";
	$paging .="Trên tổng số&nbsp;";
	$paging .="<FONT color=red>";
	$paging .=number_format($totalPages,0,".",".")."</FONT> trang<br></td></tr><tr><td></td></tr><tr>"; 
	if($totalRows>$mxR)
	{
	 	$start=1;
	 	$end=1;
	 	$paging1 ="";				 	 
		for($i=1;$i<=$totalPages;$i++)
		{	if(($i>((int)(($curPg-1)/$mxP))* $mxP) && ($i<=((int)(($curPg-1)/$mxP+1))* $mxP))
			{
				if($start==1) $start=$i;
					if($i==$curPg)      
					  	$paging1 .=  "<td><div class='i2'>".$i."</div></td>";
							else    
							{
							  	$paging1 .= "<td width='26'><div class='i'><a class='ik' href='".$xurl.$i."'><span>".$i;
								$paging1 .="</span></a></div></td>";	
							}
							$end=$i;	
						}
					}

					if($curPg>$mxP)
						{
					 	$paging .="<td whdth='22'>
					 	<div class='next'><a class='ik' href='".$xurl.($start-1)."'>
					 	Pre</a></div></td>";
						}
					$paging.=$paging1;
					if($curPg < $totalPages)
						{
						$paging .= "<td><div class='next'><a class='ik' href='".$xurl.($end+1)."'>Next</a></div></td>";
						}
					}
					$paging .="</tr></table>";
				 return $paging;
			}
?>