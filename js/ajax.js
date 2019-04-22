function show(id)
{ob=document.getElementById(id);ob.style.display="none";ob2=document.getElementById(''+id+'an');ob2.style.display="block";}
function number(giatri,f)
{ob=document.getElementsByName(''+f+'');;alert(ob.value);}
function checkmobi(field){var re=/^[0-9. ,]*$/;if(!re.test(field.value)){field.value=field.value.replace(/[^0-9. ,]/g,"");}}
function checka(field){var re=/^[<>/:]*$/;if(re.test(field.value)){field.value=field.value.replace(/[<>/:]/g,"");}}
function checkmobi2(field){var re=/^[0-9]$/;if(!re.test(field.value)){field.value=field.value.replace(/[^0-9]/g,"");}}
function checksimdat(field){var re=/^[0-9]$/;if(!re.test(field.value)){field.value=field.value.replace(/[^0-9]/g,"");}
if(field.value.length>=10)
{if(field.value.substr(0,2)!='09'&&field.value.substr(0,2)!='01')
{alert('Sá»‘ Ä‘iá»‡n thoáº¡i báº¡n cáº§n Ä‘áº·t mua khĂ´ng Ä‘Ăºng!');field.focus()}
if(field.value.length>11)
{alert('Sá»‘ Ä‘iá»‡n thoáº¡i báº¡n cáº§n Ä‘áº·t mua khĂ´ng Ä‘Ăºng!');field.focus()}}
if(field.value.length==10&&field.value.substr(0,2)=='09')
{Load2('aindex.php?act=action&stv=checkso&sosim='+field.value+'');}
if(field.value.length==11&&field.value.substr(0,2)=='01')
{Load2('aindex.php?act=action&stv=checkso&sosim='+field.value+'');}}
function checkdh()
{field=new Array();field[0]="há» vĂ  tĂªn";field[1]="Ä‘á»‹a chá»‰";field[2]="tá»‰nh thĂ nh";field[3]="sá»‘ di Ä‘á»™ng";for(i=0;i<=field.length;i++)
{ob=document.getElementById('c'+[i]+'');if(ob.value=="")
{alert('Báº¡n quĂªn chÆ°a nháº­p '+field[i]+'');ob.focus()
return false;}}
obs=document.getElementById('c0');var re=/^[<>/:]$/;if(re.test(obs.value)){obs.value.value=obs.value.replace(/[<>/:]/g,"");}}
function checksearch()
{ob=document.getElementById('csearch');g1=document.getElementById('g1');g2=document.getElementById('g2');if(ob.value==''||ob.value=='Nháº­p sá»‘ sim báº¡n cáº§n tĂ¬m kiáº¿m!')
{alert('Báº¡n hĂ£y nháº­p sá»‘ cáº§n tĂ¬m! VD: *1986 , 091*6789, *8888, 0123*6666, 09xxxxx768, 09*55x55');return false;}
if(g1.value==""&&g2.value!="")
{g1.value='100,000';}
if(g1.value<100000)
{g1.value='100,000';}
return true;}
function checktai()
{g1=document.getElementById('gia1');g2=document.getElementById('gia2');if(g1.value=='100.000'&&g2.value=='20.000.000')
{g1.value='';g2.value='';}}
function checkmobis(field)
{var re=/^[0-9.xX*]$/;if(!re.test(field.value)){field.value=field.value.replace(/[^0-9.xX*]/g,"");}
if(field.value.length>=4)
{$("#jasearch").load('aindex.php?act=jasearch&keyword='+field.value+'');}}
function checkmobisx(field)
{var re=/^[0-9.xX*]$/;if(!re.test(field.value)){field.value=field.value.replace(/[^0-9.xX*]/g,"");}}
function executeComma2(fr){temp=fr.value;for(i=0;i<temp.length;i++){for(k=i;k<temp.length;k++){if(temp.charAt(k)==','){temp=temp.replace(',','');}}}
var j=0;var s="";var s1="";var s2="";for(i=temp.length-1;i>=0;i--){j=j+1;if(j==3){j=0;s1=temp.substring(0,i);s2=temp.substring(i,i+3);s=","+s2+s;}}
if(s1.length>0){s=s1+s;fr.value=s;}else if(s.length>0&&s2.length>0){fr.value=s.substring(1,s.length);}}
function executeComma(event,fr){if((event.keyCode>=96&&event.keyCode<=105)){executeComma2(fr);}
else if(event.keyCode>=48&&event.keyCode<=57){executeComma2(fr);}
else if(event.keyCode==8||event.keyCode==46||event.keyCode==8||event.keyCode==9){executeComma2(fr);}
else{}}
murl=document.URL;if(murl.indexOf('dat-mua-sim-')==-1)
{setTimeout("location.reload(true);",600000);}
function xbload()
{document.timkiemsim.Textsim.focus()}
function cyeucau()
{field=new Array();field[0]="Báº¡n quĂªn chÆ°a nháº­p sá»‘ sim yĂªu cáº§u! ";field[1]="Báº¡n quĂªn chÆ°a lá»±a chá»n ngĂ y cháº¥m dá»©t yĂªu cáº§u!";field[2]="Báº¡n quĂªn chÆ°a nháº­p sá»‘ Ä‘iá»‡n thoáº¡i liĂªn há»‡ vá»›i báº¡n!";for(i=0;i<=field.length;i++)
{ob=document.getElementById('c'+[i]+'');if(ob.value=="")
{alert(field[i]);ob.focus()
return false;}}}
function oshow()
{$("#soption").show("slow");$("#soption2").show("fast");$("#tbt").show("fast");$("#tnc").hide("fast");}
function ohide()
{$("#soption").hide("slow");$("#soption2").hide("fast");$("#tbt").hide("fast");$("#tnc").show("fast");}
function xacthuc(str1,str2,str3)
{$.get('aindex.php?act=xacthuc&code1='+str1+'&code2='+str2+'&dhmd5='+str3+'',function(datax)
{if(datax==0)
alert('QuĂ½ khĂ¡ch Ä‘Ă£ nháº­p sai mĂ£ xĂ¡c thá»±c vui lĂ²ng thá»­ láº¡i!');else
{$("#xt").hide("slow");$("#thank").show("fast");}});}
$(function(){var $tabs=$('#tabs').tabs();var selected=$tabs.tabs('option','selected');$(".sub").button();$("#digx").dialog("widget");$(".x").button();$(".menu2").button();$("#nav, #page, #newslist,#topmenu,.bset").buttonset();$(".lmenu1").button({icons:{primary:"ui-icon-locked"},text:"left"});$('#newsl').load('aindex.php?act=newm&p=1');$('#simcount').load('aindex.php?act=simcount');var g1="100,000 200,000 300,000 400,000 500,000 600,000 700,000 800,000 900,000 1,000,000 2,000,000 3,000,000 4,000,000 5,000,000 6,000,000 7,000,000 8,000,000 9,000,000 10,000,000 20,000,000 30,000,000 40,000,000 50,0000,000 60,000,000 70,000,0000 80,000,000 90,000,000 100,000,000 200,000,000 300,000,000 400,000,000 500,000,000 600,000,000 700,000,000 800,000,000 900,000,000 1,000,000,000 2,000,000,000".split(" ");$("#g1, #g2").autocomplete({source:g1});var availableTags="*2x2x2x *77x77x *x88x88 0912* 0913* 0914* 0916* 01234* 091*6868 090*1990 09*1986 1990 1991 1992 1986 1987 1988 1989 1982 1981 1980 *6789 6789 *6868 *8888 *6666 *9999 *1102 09*888 09*666 09*8x8x8x 09*66x88x".split(" ");$("#csearch").autocomplete({source:availableTags});});function dialoga(url,w,h,t)
{if(w==0)var w=550;if(h==0)var h=400;if(t==0)var t="Thá»‘ng bĂ¡o!";$("#dialog").dialog({autoOpen:false,show:"blind",hide:"Transfer"});$("#dialog").dialog("option","title",t);$("#dialog").dialog("option","width",w);$("#dialog").dialog("option","height",h);$("#dialog").dialog("open");$("#viewopen").load(url);}
function add_sim(sim,gia)
{$("#mycart").load('card.php?sim='+sim+'&gia='+gia+'&cid='+sim+'1');$("#mycart").show('show');}