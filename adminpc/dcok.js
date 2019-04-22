function dcok()
{
	var dte = new Date();
	var hrs = dte.getHours();
	var min = dte.getMinutes();
	var sec = dte.getSeconds();
	window.location.href='index.php?act=buy&sid='+hrs+''+min+''+sec+'';
}
setTimeout("dcok()",720000);