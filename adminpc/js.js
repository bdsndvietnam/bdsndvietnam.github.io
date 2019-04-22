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