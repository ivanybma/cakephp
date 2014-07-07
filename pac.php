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
<script type="text/javascript" src="mktree.js"></script>  <!--*tree*-->
<script>
function validate()
{

}
</script>

<script>

</script>
<link rel="stylesheet" type="text/css" href="mktree.css">  <!--*tree*-->
<link rel="stylesheet" type="text/css" href="grossstyle.css">
<!--meta http-equiv="refresh" content="5000"-->
<base href="http://localhost/erp_nframework/">
<title>Personal account page</title>
</head>
<body>
<a id="bdy">
<table class='t1st'>
<tr> <!------heading------->
<td class='headl'></td><td class='headc'></td>
<td class='headr'>
<div id='login' style="background-color:#889933;">
<table>
<tr>
<td width='110'><a class="lgofc">Welcome back !</a></td>
<td><a id="nme" class="lgofc"></a></td>
</tr>
<tr>
<td width='110' ><a class="lgofc">Last login time:</a></td>
<td ><a id="ltime" class="lgofc"></a></td>
</tr>
<tr>
<td width='110'></td>    <!---- button in a form need to be defined with type = "button", or else, it will trigger the submit() event--->
<td></td>
</tr>
</table>
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
<td class='mainl'>
<div class="usrfn">

<fieldset class="acau">
<legend>Authority group</legend>
<ul class="mktree" id="tree1">
<!--<button onclick='jQuery("#admin").children("ul:first").append("<li><a>User basic info main</a></li>");'>sss</button>-->

</ul> 
</fieldset>
<!--
<fieldset class="acau">
<legend>Function list</legend>
<ol id="fncl">
</ol>  
</fieldset>-->

</div>
</td>
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
</a>
</body>
</html>

<?php

if (isset($_SESSION["id"]))
{                                //session exists B
$lname=$_SESSION["lname"];
$fname=$_SESSION["fname"];
$ltime=$_SESSION["ltime"];
$id=$_SESSION["id"];
$name= $fname . ' ' . $lname;

//prepare the user login information to be shown on the right top
$stat="<script>document.getElementById('nme').innerHTML='".$name."';</script>";
echo $stat;
$stat="<script>document.getElementById('ltime').innerHTML='".$ltime."';</script>";
echo $stat;

//prepare the user function list
 $con=mysqli_connect("localhost","ivan","440103","ivan");
 // Check connection
 if (mysqli_connect_errno()) 
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
  /*prepare authority group*/
$sql="select usrgrp from usraut where id='". $id . "'";
$rst=mysqli_query($con,$sql);
if(!$rst)
echo "Error selecting table: " . mysqli_error($con);

while($rcd=mysqli_fetch_array($rst))  /*loop the authority group result set*/
{
$usrgrp=$rcd['usrgrp'];

$txt="'<li id=".$usrgrp."><a>".$usrgrp."</a></li>'";              /*append the group name as a new LI one by one*/
echo '<script>jQuery("#tree1").append(' . $txt . ');</script>';

{  /*this is to prepare all the function under the group*/
$sql="select fncdes,fnclnk from fnccdbase where fnccd in (select fnccd from grpfnc where usrgrp ='".$usrgrp."')";

$rsts=mysqli_query($con,$sql);
if ($rsts)      /*in case there is function under the current group, append a blank UL as a child under the group LI*/
echo '<script>jQuery("#'.$usrgrp.'").append("<ul></ul>");</script>';

while($rcds=mysqli_fetch_array($rsts)) /* loop all function under this group and append them as new LI one by one*/
{
$des=$rcds['fncdes'];
$lnk=$rcds['fnclnk'];
$txt="<li><a>".$des."</a></li>";
$script="jQuery('#" . $usrgrp. "').children('ul:first').append('<li><a href=".$lnk.">".$des."</a></li>');";
echo '<script>'.$script.'</script>';
}
//echo "<script>alert('".mysqli_num_rows($rsts)."');</script>";
}

}

}
                           //session exists E
else
{                                //session not exists B
echo "<script>document.getElementById('bdy').innerHTML='Please log on through home page!'</script>";
echo "<script>document.getElementById('bdy').href='home';</script>";

}                   //session not exists E



?>




