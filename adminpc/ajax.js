var xmlHttp=false;
	function creatAjaxObject()
	{
		if (window.XMLHttpRequest)
		{ 
			xmlHttp=new XMLHttpRequest()
			if (xmlHttp.overrideMimeType)
			xmlHttp.overrideMimeType('text/xml')
		}
		else if (window.ActiveXObject)
		{ 
			try 
				{
					xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
				} 
				catch (e)
				{
					try
					{
						xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
					}
					catch (e)
					{
					}
				}
			}
	}
function ajaxLoad(url, where){
creatAjaxObject();
var bar = 'Loading...';
document.getElementById(where).innerHTML = bar
window.status="Website đang tải dữ liệu ...";
document.getElementById(where).innerHTML="";
         xmlHttp.onreadystatechange= function(){
                 if(xmlHttp.readyState==4){
                          document.getElementById(where).innerHTML = xmlHttp.responseText
						  window.status="*** WWW.NGANHANGSIMSODEP.COM *** Sim số đẹp , Sim vip , Sim taxi , Sim lộc phát ... --- Hotline : 0914.77.9999 ";
                         }
                 }
         xmlHttp.open("GET", url, true);
         xmlHttp.send(null);
   }

 function ajaxpost(form,fid,url)
 {	
 		ob=document.fr;
 	     creatAjaxObject();
         xmlHttp.onreadystatechange= function(){
                 if(xmlHttp.readyState==4 || xmlHttp.readyState == 200){
                 
               			alert(xmlHttp.responseText);
                         }
                 }
	xmlHttp.open('POST', url , true);//must be put here
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.send("data="+document.forms["fr"].elements["f29[]"].value+"");
 }
function dangchuyen()
{
	
	oi=document.getElementById('dangchuyen');
	oi.className='menucx';
	ox=document.getElementById('moi');
	ox.className='menuxc';
	var dte = new Date();
	var hrs = dte.getHours();
	var min = dte.getMinutes();
	var sec = dte.getSeconds();
	ajaxLoad('aindex.php?act=dathangmoi&t=1&sid='+hrs+''+min+''+sec+'','dathang');
}
function moi()
{
	oi=document.getElementById('dangchuyen');
	oi.className='menuxc';
	ox=document.getElementById('moi');
	ox.className='menucx';
	var dte = new Date();
	var hrs = dte.getHours();
	var min = dte.getMinutes();
	var sec = dte.getSeconds();
	ajaxLoad('aindex.php?act=dathangmoi&t=0&sid='+hrs+''+min+''+sec+'','dathang');
}
function wd(url, where)
{
obj=document.getElementById('main');
obj.style.width=400+"px";
obj.style.height=500+"px";
obj.style.top=20;
obj.style.left=(window.screen.width-500)/2;
ajaxLoad(url, where);
}
function wdc(url, where)
{
obj=document.getElementById('main');
obj.style.width=1+"px";
obj.style.height=1+"px";
obj.style.position="absolute";
window.location.href=window.location.href;
}
function GotoPage(id)
{
url=window.location.href;
c_url=url.split('&page');

if(url.indexOf("?")!=-1)
window.location.href=c_url[0]+'&page='+id+'';
else
window.location.href=c_url[0]+'?page='+id+'';
}

function checktext()
{
ob=document.getElementById('text');
if(ob.value=='')
{
	alert('Bạn vui lòng viết lý do!'); 
	return false;
}
}
function Load(url){
creatAjaxObject();
         xmlHttp.onreadystatechange= function(){
                 if(xmlHttp.readyState==4){
                         }
                 }
         xmlHttp.open("GET", url, true);
         xmlHttp.send(null);
         window.location.href= window.location.href;
   }
   function Load2(url){
creatAjaxObject();
         xmlHttp.onreadystatechange= function(){
                 if(xmlHttp.readyState==4){
                         }
                          alert(xmlHttp.responseText);
                 }
         xmlHttp.open("GET", url, true);
         xmlHttp.send(null);
        
   }
 function sms(url){
creatAjaxObject();
         xmlHttp.onreadystatechange= function(){
                 if(xmlHttp.readyState==4){
                         }
                 }
         xmlHttp.open("GET", url, true);
         xmlHttp.send(null);
        
   }
function conf(id)
{
	a=window.confirm('Bạn muốn xóa '+id+'?');
	if(a) return true
	else return false
}
function confs(id)
{
	var d=document.myfrom.txt.value.length;
	if(d > 155)
	{
		alert('Độ dài tin nhắn vượt quá 155 Ký tự vui lòng xóa bớt');
		return false
	}
	a=window.confirm(id);
	if(a) return true
	else return false
}
function show(id)
{
	ob=document.getElementById(id);
	ob.style.display="none";
	ob2=document.getElementById(''+id+'an');
	ob2.style.display="block";
}
function number(giatri,f)
{
	ob=document.getElementsByName(''+f+'');;
	alert(ob.value);
}
function checkmobi(field) { 
        var re = /^[0-9. ,]*$/; 
        if (!re.test(field.value)) { 
                    field.value = field.value.replace(/[^0-9. ,]/g,""); 
        } 
    } 
  
    
    function checka(field) { 
        var re = /^[<>/:]*$/; 
        if (re.test(field.value)) { 
                    field.value = field.value.replace(/[<>/:]/g,""); 
        } 
    } 
 function checkmobi2(field) { 
        var re = /^[0-9]$/; 
        if (!re.test(field.value)) { 
                    field.value = field.value.replace(/[^0-9]/g,""); 
        } 
    } 
    function checksimdat(field) { 
        var re = /^[0-9]$/; 
        if (!re.test(field.value)) { 
                    field.value = field.value.replace(/[^0-9]/g,""); 
        }
        if(field.value.length >= 10)
        {
        if(field.value.substr(0,2) != '09' &&  field.value.substr(0,2) != '01')
        {
        alert('Số điện thoại bạn cần đặt mua không đúng!');
        field.focus()	
        }
        if(field.value.length > 11)
        {
        alert('Số điện thoại bạn cần đặt mua không đúng!');
        field.focus()
        }
        }
        if(field.value.length == 10 && field.value.substr(0,2) == '09')
        {
        Load2('aindex.php?act=action&stv=checkso&sosim='+field.value+'');	
        }
        if(field.value.length == 11 && field.value.substr(0,2) == '01')
        {
        Load2('aindex.php?act=action&stv=checkso&sosim='+field.value+'');	
        }
    } 
function date(v)
{
	var currentTime = new Date()
	var month = currentTime.getMonth() + 1
	var day = currentTime.getDate()
	var year = currentTime.getFullYear()
	v.value= day+ "/" + month + "/" + year;
}
function select_all(name, value) {
	formblock= document.getElementById('form_id');
  forminputs = formblock.getElementsByTagName('input');
  for (i = 0; i < forminputs.length; i++) {
    // regex here to check name attribute
    var regex = new RegExp(name, "i");
    if (regex.test(forminputs[i].getAttribute('name'))) {
      if (value == '1') {
        forminputs[i].checked = true;
      } else {
        forminputs[i].checked = false;
  }
    }
  }
}
function checkdh()
{
	field=new Array();
	field[0]="họ và tên";
	field[1]="địa chỉ";
	field[2]="tỉnh thành";
	field[3]="số di động";
	for(i=0;i<=field.length;i++)
	{
		ob=document.getElementById('c'+[i]+'');
		if(ob.value=="")
		{
		alert('Bạn quên chưa nhập '+field[i]+'');
		ob.focus()
		return false;
		}
	}
		obs=document.getElementById('c0');
	    var re = /^[<>/:]$/; 
        if (re.test(obs.value)) { 
            obs.value.value = obs.value.replace(/[<>/:]/g,""); 
        }
}
function checkus()
{
	user=document.getElementById('user');
	pass=document.getElementById('pass');
	if(user.value=="")
	{
		alert('Bạn quên chưa nhập username!');
		user.focus()
		return false;
	}
	if(pass.value=="")
	{
		alert('Bạn quên chưa nhập mật khẩu');
		pass.focus()
		return false;
	}
	
	
}
function checksearch()
{
	ob=document.getElementById('csearch');
	g1=document.getElementById('g1');
	g2=document.getElementById('g2');
	if(ob.value=='' || ob.value=='Nhập số sim bạn cần tìm kiếm!') 
	{
	alert('Bạn hãy nhập số cần tìm! VD: *1986 , 091*6789, *8888, 0123*6666, 09xxxxx768, 09*55x55');
	return false;
	}
	if(g1.value=="" && g2.value!="")
	{
		g1.value='100,000';
		
	}
	if(g1.value < 100000)
	{
		g1.value='100,000';
	}
	//oj=document.timkiemsim;
	//window.location.href='tim-kiem-sim-so-dep-'+oj.smang.value+'-'+g1.value+'-'+g2.value+'-'+oj.Textsim.value+'-'+oj.tongnut.value+'.html';
	return true;
}
function checktai()
{
	g1=document.getElementById('gia1');
	g2=document.getElementById('gia2');
	if(g1.value=='100.000' && g2.value=='20.000.000')
	{
		g1.value='';
		g2.value='';
	}
}
function checkmobis(field) 
{ 
        var re = /^[0-9.xX*]$/; 
        if (!re.test(field.value)) { 
                    field.value = field.value.replace(/[^0-9.xX*]/g,""); 
        }
        if(field.value.length >= 4)
        {
        	$("#jasearch").load('aindex.php?act=jasearch&keyword='+field.value+'');
        }
} 
function checkmobisx(field) 
{ 
        var re = /^[0-9.xX*]$/; 
        if (!re.test(field.value)) { 
                    field.value = field.value.replace(/[^0-9.xX*]/g,""); 
        } 
} 
function demsodadang(i)
{
	ob=document.getElementById('datang');
	ob.value=100;
}
function admds()
{
	ob=document.getElementById('select');
	if(ob.value==0)
	{
		alert('Bạn quên chưa chọn đại lý');
		ob.focus()
		return false;
	}
}
function copyToClipBoard(sContents)
{
window.clipboardData.setData("Text", sContents);
}
function loadweb()
{
	
	setTimeout("ajaxLoad('hit.htm','bodem')",1200);
	setTimeout("ajaxLoad('yahoo.htm','yahoo')",1400);
	
	
}
function loadimg()
{
if(window.screen.width < 1024)
{
	
	//var ob=document.getElementById('s');
	//ob.src="images/support2.jpg";
	
}
else
{
	var ob=document.getElementById('xmain');
	ob.style.width="95%";
}
}
function checkcod(v)
{
ob=document.Form1;
ob._ctl0_Mae1_txt.value=''+v+'';
ob.submit()
}
function executeComma2(fr) {
	temp = fr.value;
	/*for (i=0;i<temp.length;i++) {
		if (temp.charAt(i) == ',') {
			temp.charAt(i) = '';
		}
	}*/

	for (i=0;i<temp.length;i++) {
		for (k=i;k<temp.length;k++) {
			if (temp.charAt(k) == ',') {
				temp = temp.replace(',','');
			}
		}
	}

	var j = 0;
	var s = "";
	var s1 = "";
	var s2 = "";
	for (i=temp.length-1;i>=0;i--) {
		j = j+1;
		if (j == 3) {
			j = 0;
			s1 = temp.substring(0,i);
			s2 = temp.substring(i,i+3);
			s = "," + s2 + s;
		}
	}
	if (s1.length > 0) {
		//alert(s1.length);
		s = s1 + s;
		fr.value = s;
	}else if (s.length > 0 && s2.length > 0){
		fr.value = s.substring(1,s.length);
	}
}

function executeComma(event,fr) {
	//alert(event.keyCode);
	if ((event.keyCode >= 96 && event.keyCode <= 105)) {
		executeComma2(fr);
	}
	else if (event.keyCode >= 48 && event.keyCode <= 57) {
		executeComma2(fr);
	}
	else if (event.keyCode == 8 || event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9) {
		executeComma2(fr);
	}
	else {
		//alert("Giá trị nhập vào là một số!");
		//fr.value = "";
	}
}
murl=document.URL;
if(murl.indexOf('dat-mua-sim-')==-1)
{
setTimeout("location.reload(true);",600000);
}
function xbload()
{
	document.timkiemsim.Textsim.focus()
}
function cyeucau()
{
	field=new Array();
	field[0]="Bạn quên chưa nhập số sim yêu cầu! ";
	field[1]="Bạn quên chưa lựa chọn ngày chấm dứt yêu cầu!";
	field[2]="Bạn quên chưa nhập số điện thoại liên hệ với bạn!";
	for(i=0;i<=field.length;i++)
	{
		ob=document.getElementById('c'+[i]+'');
		if(ob.value=="")
		{
		alert(field[i]);
		ob.focus()
		return false;
		}
	}
}

function oshow()
{
	$("#soption").show("slow");
	$("#soption2").show("fast");
	$("#tbt").show("fast");
	$("#tnc").hide("fast");
}
function ohide()
{
	$("#soption").hide("slow");
	$("#soption2").hide("fast");
	$("#tbt").hide("fast");
	$("#tnc").show("fast");
}
function xacthuc(str1,str2,str3)
{
	$.get('aindex.php?act=xacthuc&code1='+str1+'&code2='+str2+'&dhmd5='+str3+'',function(datax)
	{
		if(datax==0)
		alert('Quý khách đã nhập sai mã xác thực vui lòng thử lại!');
		else
		{
		$("#xt").hide("slow");
		$("#thank").show("fast");
		}
	}
	);
}
$(document).ready(function(){
	/**
	var data = "*2x2x2x *77x77x *x88x88 0912* 0913* 0914* 0916* 01234* 091*6868 090*1990 09*1986 1990 1991 1992 1986 1987 1988 1989 1982 1981 1980 *6789 6789 *6868 *8888 *6666 *9999 *1102 09*888 09*666 09*8x8x8x 09*66x88x".split(" ");
  	 $("#csearch").autocomplete(data); 
  	var data = "100,000 200,000 300,000 400,000 500,000 600,000 700,000 800,000 900,000 1,000,000 2,000,000 3,000,000 4,000,000 5,000,000 6,000,000 7,000,000 8,000,000 9,000,000 10,000,000 20,000,000 30,000,000 40,000,000 50,0000,000 60,000,000 70,000,0000 80,000,000 90,000,000 100,000,000 200,000,000 300,000,000 400,000,000 500,000,000 600,000,000 700,000,000 800,000,000 900,000,000 1,000,000,000 2,000,000,000".split(" ");
  	 $("#g1").autocomplete(data);
  	 $("#g2").autocomplete(data);
	**/

$("a[rel='example1']").colorbox();
				$("a[rel='example2']").colorbox({transition:"fade"});
				$("a[rel='example3']").colorbox({transition:"none", width:"75%", height:"75%"});
				$("a[rel='example4']").colorbox({slideshow:true});
				$("a[rel='example5']").colorbox({transition:"none", width:"50%", height:"75%"});
				$(".example5").colorbox();
				$(".example6").colorbox({iframe:true, innerWidth:425, innerHeight:344});
				$(".example7").colorbox({width:"80%", height:"80%", iframe:true});
				$(".example8").colorbox({width:"50%", inline:true, href:"#inline_example1"});
				$(".example9").colorbox({
					onOpen:function(){ alert('onOpen: colorbox is about to open'); },
					onLoad:function(){ alert('onLoad: colorbox has started to load the targeted content'); },
					onComplete:function(){ alert('onComplete: colorbox has displayed the loaded content'); },
					onCleanup:function(){ alert('onCleanup: colorbox has begun the close process'); },
					onClosed:function(){ alert('onClosed: colorbox has completely closed'); }
				});
				
				//Example of preserving a JavaScript event for inline calls.
				$("#click").click(function(){ 
					$('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
					return false;
				});
    
});