/*======================================================================*\
|| #################################################################### ||
|| # kenhdaihoc Scroll Page Script                                    # ||
|| # ---------------------------------------------------------------- # ||
|| # Copyright ©2011-2012 Kenhdaihoc.com - All Rights Reserved.       # ||
|| # Please do not remove this comment lines.                         # ||
|| # -------------------- LAST MODIFY INFOMATION -------------------- # ||
|| # Last Modify: 22-07-2011 03:00:00 PM by: contact_kdh              # ||
|| #################################################################### ||
\*======================================================================*/
/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*\
|*-------Please specify source when using my code or a part of them-----*|
\*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/

var kenhdaihoc_dy=100;
var kenhdaihoc_dtime=5;

function kenhdaihoc_gettop()
{
	try{
		if(window.pageYOffset!=undefined)
			return window.pageYOffset;
		return window.document.body.scrollTop;
	}catch(err)
	{
		try{
			return window.document.body.scrollTop;
		}catch(err2)
		{
			return 0;
		}
	}

}
function kenhdaihoc_croll_top()
{

	var kenhdaihoc_body_obj=window.document.body;
	var kenhdaihoc_cur_stop=kenhdaihoc_gettop();
	window.scrollBy (0,-kenhdaihoc_dy);
	var kenhdaihoc_new_stop=kenhdaihoc_gettop();
	if(kenhdaihoc_cur_stop>kenhdaihoc_new_stop)
		setTimeout("kenhdaihoc_croll_top()",kenhdaihoc_dtime);
	else
		document.getElementById("kenhdaihoc_scroll_down_img").style.display="block";
	return false;
}

function kenhdaihoc_croll_down()
{
	var kenhdaihoc_body_obj=window.document.body;
	var kenhdaihoc_cur_stop=kenhdaihoc_gettop();
	window.scrollBy (0,kenhdaihoc_dy);
	var kenhdaihoc_new_stop=kenhdaihoc_gettop();
	if(kenhdaihoc_cur_stop<kenhdaihoc_new_stop)
		setTimeout("kenhdaihoc_croll_down()",kenhdaihoc_dtime);
	else
		document.getElementById("kenhdaihoc_scroll_down_img").style.display="none";
	return false;
}

function kenhdaihoc_display_scroll_btn()
{
	var kenhdaihoc_body=window.document.body;
	var kenhdaihoc_height=kenhdaihoc_body.scrollHeight;
	var kenhdaihoc_top=kenhdaihoc_gettop();
	//document.getElementById("scroll").innerHTML=kenhdaihoc_top+"/"+kenhdaihoc_height;
	if(kenhdaihoc_top==0)
		document.getElementById("kenhdaihoc_scroll_up_img").style.display="none";
	else
		document.getElementById("kenhdaihoc_scroll_up_img").style.display="block";
	/*
	if(kenhdaihoc_top>=kenhdaihoc_height-kenhdaihoc_body.clientHeight)
		document.getElementById("kenhdaihoc_scroll_down_img").style.display="none";
	else
		document.getElementById("kenhdaihoc_scroll_down_img").style.display="block";
	*/
}
setInterval("kenhdaihoc_display_scroll_btn()",100);
document.write('<div style="position: fixed; width: 40px; right: 0px; bottom: 0px;">	<a href="#" onclick="return kenhdaihoc_croll_top()"><img border="0" id="kenhdaihoc_scroll_up_img" width="40px" src="images/bottom.png"></a>	<a href="#" onclick="return kenhdaihoc_croll_down()"><img border="0" width="40px" id="kenhdaihoc_scroll_down_img" src="images/top.png"></a></div></div>');