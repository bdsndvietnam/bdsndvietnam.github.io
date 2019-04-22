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
   function loadurl(url,msg){
         creatAjaxObject();
         xmlHttp.onreadystatechange= function(){
                 if(xmlHttp.readyState==4){
                         if(msg!="")alert(msg);
                         }
                 }
         xmlHttp.open("GET", url, true);
         xmlHttp.send(null);
   }
   function ajax(where, url){
        /* xmlHttp = new GetXmlHttpObject()
         if(xmlHttp==null){
                 return;
                 }
                 */
         creatAjaxObject();
var bar = '<div  align="center"><img border="0" src="loading.gif"></div>';
document.getElementById(where).innerHTML = bar
window.status="Website đang tải dữ liệu ...";
         xmlHttp.onreadystatechange= function(){
                 if(xmlHttp.readyState==4){
                          document.getElementById(where).innerHTML = xmlHttp.responseText
						  window.status="*** WWW.SODEP.VN *** Sim số đẹp , Sim vip , Sim taxi , Sim lộc phát , Sim năm sinh ... --- Hotline : 0937 666 886 ";
                         }
                 }
         xmlHttp.open("GET", url, true);
         xmlHttp.send(null);
   }
    function ajaxp1(where, url){
         xmlHttp = new GetXmlHttpObject()
         if(xmlHttp==null){
                 return;
                 }
        
         var bar = '<div  align="center"><img border="0" src="images/loading.gif"></div>';
         //document.getElementById(where).innerHTML = bar
         xmlHttp.onreadystatechange= function(){
                 if(xmlHttp.readyState==4 || xmlHttp.readyState == 200){
                          document.getElementById(where).innerHTML = xmlHttp.responseText
               
                         }
                 }
  
	xmlHttp.open('POST', url , true);//must be put here
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.send("copy=");
   }
   
   //////////////////----------END AJAX ------------------------////////////////////
function config(name)
{
var a=window.confirm("Bạn muốn xóa "+name+" ?");
if(a) return true;
else return false;
}
function loca(l)
{
	window.location.href=''+l+'';
	
}
function checkf()
{
var sosim=document.getElementById('sosim');
var name=document.getElementById('name');
var city=document.getElementById('city');
var mobile=document.getElementById('mobile');

if(sosim.value=="")
{
	alert("Bạn quên chưa nhập số cần đặt");
	sosim.focus();
	return false;
}
if(name.value=="")
{
	alert("Bạn quên chưa nhập tên!");
	name.focus();
	return false;
}
if(city.value==0)
{
	alert("Bạn quên chưa lựa chọn tỉnh thành!");
	city.focus();
	return false;
}
if(mobile.value=="")
{
	alert("Bạn quên chưa nhập số điện thoại liên hệ!");
	mobile.focus();
	return false;
}
}
function checkmobi(field) { 
        var re = /^[0-9. ,]*$/; 
        if (!re.test(field.value)) { 
            alert('Số điện thoại nhập vào không đúng'); 
            field.value = field.value.replace(/[^0-9. ,]/g,""); 
        } 
    } 