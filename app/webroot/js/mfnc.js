function validate()
{
if (document.getElementById("id").value=="" || document.getElementById("pwd").value=="")
{
alert ("Pls input entire login information");
return false;
}

return true;
}

function signoff($src)
{
	if ($src==null)
{
if (window.XMLHttpRequest)
var obj= new XMLHttpRequest();
else
var obj= new ActiveXObject("Microsoft.XMLHTTP");

obj.onreadystatechange=function()
{
if (obj.readyState==4 && obj.status==200)
{
window.location.reload();
}
};

var str="/erp_cake/Posts/signoff";
obj.open("GET",str,true);
obj.send();
}
else
{
	window.open ('/erp_cake/posts/phpsignoff','_self',true);
}
}

