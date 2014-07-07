<?php
session_start();
?>


<!DOCTYPE html>
<!-- html/css studying -->
<html>
<head>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script> 
<script src="menu.hoverIntent.js" type="text/javascript"></script>
<script src="menucontrol.js" type="text/javascript"></script>
<script>
function validate()
{
if (document.getElementById("id").value=="" || document.getElementById("pwd").value=="")
{
alert ("Pls input entire login information");
return false;
}

return true;
}
</script>

<script>
function signoff()
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
}

var str="signoff.php";
obj.open("GET",str,true);
obj.send();
}

</script>

<link rel="stylesheet" type="text/css" href="grossstyle.css">


<meta http-equiv="refresh" content="5000">
<base href="http://localhost/erp_nframework/">
<title>Basic home page</title>
</head>
<body>
<table class='t1st'>
<tr> <!------heading------->
<td class='headl'></td><td class='headc'></td>
<td class='headr'>
<div id='login' style="background-color:#889933;">
<form action="<?php pathinfo($_SERVER['PHP_SELF']);?>" method="POST" onsubmit="return validate()">
<table>
<tr>
<td width='110'><a class="lginc">ID: </a><a class="lgofc">Welcome back !</a></td>
<td><input type="text" name="id" id="id" class="lginc"></input><a id="nme" class="lgofc"></a></td>
</tr>
<tr>
<td width='110' ><a class="lginc">Password: </a><a class="lgofc">Last login time:</a></td>
<td ><input type="password" class="lginc" name="pwd" id="pwd"></input><a id="ltime" class="lgofc"></a></td>
</tr>
<tr>
<td width='110'><input type="submit" id="lginb" class="lginc" style="display:inline;" value="Login"></input>
<a class="lgofc" id="acmnu" href="pac">My Account</a></td>    <!---- button in a form need to be defined with type = "button", or else, it will trigger the submit() event--->
<td><div id="info"><button type="button" class="lgofc" id="sngff" onclick="signoff()">log off</button></div></td>
</tr>
</table>
</form>
</div>
</td>
</tr>
<tr><!-----menu bar------->
<td class='menul'></td>
<td class='menuc'>
<div class="menudv">
<ul class="topul cfix">
           <li class="home">
		    <a href="home">home</a>
		    <div class="secdv" style="display: none; opacity: 0;">
			<a class="bu-close" href="#">Close</a>
		    </div>
		   </li>		   
		   <li class="item_a">
		    <a>item_a</a>
		    <div class="secdv" style="display: none; opacity: 0;">
			<a class="bu-close" href="#">Close</a>
		    </div>
		   </li>
           <li class="item_b">
		    <a>item_b</a>
		    <div class="secdv" style="display: none; opacity: 0;">
			<a class="bu-close" href="#">Close</a>
		    </div>
		   </li>		   
		   <li class="item_c">
		    <a>item_c</a>
		    <div class="secdv" style="display: none; opacity: 0;">
			<a class="bu-close" href="#">Close</a>
		    </div>
		   </li>
		   <li class="item_d">
		    <a>item_d</a>
		    <div class="secdv" style="display: none; opacity: 0;">
			<a class="bu-close" href="#">Close</a>
		    </div>
		   </li>	  
           <li class="item_e">
		    <a>item_e</a>
		    <div class="secdv" style="display: none; opacity: 0;">
			<a class="bu-close" href="#">Close</a>
		    </div>
		   </li>	
		   
</ul>
</div>
</td>
<td class='menur'></td>
</tr>
<tr><!-----main content------->
<td class='mainl'></td>
<td class='mainc'></td>
<td class='mainr'></td>
</tr>
<tr><!-----trailer bar------->
<td class='traill'></td>
<td class='trailc'></td>
<td class='trailr'></td>
</tr>
<tr><!-----ending------->
<td class='endl'></td>
<td class='endc'></td>
<td class='endr'></td>
</tr>
</table>
</body>
</html>


<?php

if (isset($_SESSION["id"]))
{                                //session exists B
$lname=$_SESSION["lname"];
$fname=$_SESSION["fname"];
$ltime=$_SESSION["ltime"];
$name= $fname . ' ' . $lname;
//----PHP print the Jquery coding to the browser, Jquery can help to change the CSS arttribute for all the elements------
// if don't use jquery, javascript need to loop all the elements in the same class and change the arttribute one by one-----------
$stat="<script>$('.lginc').css('display','none');</script>"; 
echo $stat;
$stat="<script>$('.lgofc').css('display','inline');</script>";
echo $stat;
$stat="<script>document.getElementById('nme').innerHTML='".$name."';</script>";
echo $stat;
$stat="<script>document.getElementById('ltime').innerHTML='".$ltime."';</script>";
echo $stat;
}                                //session exists E
else
{                                //session not exists B
//$stat="<script>document.getElementsByClassName('lginc').style.display='inline';</script>";
$stat="<script>$('.lginc').css('display','inline');</script>";
echo $stat;
//$stat="<script>document.getElementsByClassName('lgofc').style.display='none';</script>";
$stat="<script>$('.lgofc').css('display','none');</script>";
echo $stat;



if ($_SERVER["REQUEST_METHOD"]=="POST")
 // Check connection
{                                 //requested by itself B
 $con=mysqli_connect("localhost","ivan","440103","ivan");
 //$con=mysqli_connect("sql5.freemysqlhosting.net","sql542921","gN4*uE6%","sql542921");// this is to connect the remote mysql database provided by http://www.freemysqlhosting.net/
 if (mysqli_connect_errno()) 
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
 
$id=$_POST["id"];
$pwd=$_POST["pwd"];
$sql="select * from usrpwd where id='".$id."' and pwd=aes_encrypt('".$pwd."', 'mysecret_key_to_encrypt')";
$rst=mysqli_query($con,$sql);      //user$pwd identified B  
$tst=mysqli_num_rows($rst);
if ($tst==0 || !$rst)                       
{echo "<script>document.getElementById('info').innerHTML='user&pwd not match';</script>";}  //user$pwd fail to be identified 
else
{                            
$rcd=mysqli_fetch_array($rst);
$ltime=$rcd["ltime"];
$sql="select * from persons where id='".$id."'";
$rst=mysqli_query($con,$sql);
$rcd=mysqli_fetch_array($rst);
if($rcd)
{                           //designated user info fetching successfully B 
$lname=$rcd["LastName"];
$fname=$rcd["FirstName"];
$name= $fname . ' ' . $lname;
//$stat="<script>document.getElementsByClassName('lginc').style.display='none';</script>";
$stat="<script>$('.lginc').css('display','none');</script>";
echo $stat;
//$stat="<script>document.getElementsByClassName('lgofc').style.display='inline';</script>";
$stat="<script>$('.lgofc').css('display','inline');</script>";
echo $stat;
$stat="<script>document.getElementById('nme').innerHTML='".$name."';</script>";
echo $stat;
$stat="<script>document.getElementById('ltime').innerHTML='".$ltime."';</script>";
echo $stat;

$_SESSION["id"]=$id;
$_SESSION["ltime"]=$ltime;
$_SESSION["fname"]=$fname;
$_SESSION["lname"]=$lname;    
date_default_timezone_set("America/Los_Angeles");
$ctime= date('Y-m-d H:i:s');

$sql="update usrpwd set ltime='".$ctime."' where id='".$id."'";    //refresh last login time with the current one
$rst=mysqli_query($con,$sql);
                              // incept the session for current browser
}                          //designated user info fetching successfully E
/*else
{                           //designated user info fetching failed B
$stat="<script>document.getElementById('info').innerHTML='user/pwd invalid';</script>";
echo $stat;                    
}  */                         //designated user info fetching failed E

}                           //user$pwd identified E

}                        //requested by itself E

}                   //session not exists E
?>

