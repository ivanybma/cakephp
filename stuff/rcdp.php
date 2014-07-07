<?php
 $con=mysqli_connect("localhost","ivan","440103","ivan");
 // Check connection
 if (mysqli_connect_errno()) 
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
 
//$sql="alter TABLE Persons add column id int";

$id=$_GET["idn"];
$case=$_GET["case"];

if ($case=='d')
{echo "<title>Record Delete Screen</title>";
echo "<h1 align='center'>Record Delete Screen</h1>";}
else
{echo "<title>Record Change Screen</title>";
echo "<h1 align='center'>Record Change Screen</h1>";}

$sql="select * from persons where id='".$id."'";
$rst=mysqli_query($con,$sql);
if(!$rst)
echo "Error selecting table: " . mysqli_error($con);

if($rcd=mysqli_fetch_assoc($rst))  // return a row in array with column name as a key to get the field value
{
echo "<table align='center' style='border:1px solid black; width:400px;'><tr><th colspan='2'>ID number: ".$rcd["id"]."</th></tr>";
foreach ($rcd as $fld=>$value)
{
if ($fld=='id')
echo "<input type='text' style='display:none;' id='idno' value=". $value ."></input>";

if ($fld!="id")
{
if ($fld=="sex")
{
$mslcted="";
$fslcted="";

if ($value=="Male")
$mslcted = "selected";
else
$fslcted = "selected";

echo "<tr><td>".$fld."</td><td><select name='sex' id='sex'><option value='Male' ".$mslcted.">Male</option><option value='Female' ".$fslcted.">Female</option></select></td>";
}

else
echo "<tr><td>".$fld."</td><td><input type='text' id='".$fld."' value=".$value."></input></td>";

if ($case=='d')
echo "<script>document.getElementById('".$fld."').disabled=true;</script>";
}

}

echo "<tr><td></td><td align='right'><input type='button' id= 'delete' value='Delete' onclick='dltrcd()'></input><input type='button' id='submit' value='Submit' onclick='updrcd()'></input><input type='button' id='cancel' value='Cancel' onclick='cancel()'></input></td></table>";
if ($case=='d')
echo "<script>document.getElementById('delete').style.display='inline';document.getElementById('submit').style.display='none';document.getElementById('cancel').style.display='none';</script>";
else
echo "<script>document.getElementById('delete').style.display='none';document.getElementById('submit').style.display='inline';document.getElementById('cancel').style.display='inline';</script>";

}

mysqli_close($con);
?>

<script>
function dbpro(action)
{
if (window.XMLHttpRequest)
var obj= new XMLHttpRequest();
else
var obj= new ActiveXObject("Microsoft.XMLHTTP");
obj.onreadystatechange=function()
{
if (obj.readyState==4 && obj.status==200)
{
window.opener.location.reload(false);
window.close();
}
}
var str="rcdpact?id="+document.getElementById("idno").value+
"&age=" + document.getElementById("Age").value + "&lname=" + document.getElementById("LastName").value + 
"&fname=" + document.getElementById("FirstName").value + "&act=" + action + "&JoinDate=" + document.getElementById("JoinDate").value +
"&sex=" + document.getElementById("sex").value;
obj.open("GET",str,true);
obj.send();
}

function dltrcd()
{dbpro('d');}

function updrcd()
{
if(validate())
dbpro('c');
}

function cancel()
{
window.opener.location.reload(false);
window.close();
}

</script>

<script>
function validatedate(inputText)  
{  
  var dateformat = /^\d{4}[-](0?[1-9]|1[012])[-](0?[1-9]|[12][0-9]|3[01])$/;   
  // Match the date format through regular expression 

if(inputText.match(dateformat))  
  {  
  var opera2 = inputText.split('-');  
  lopera2 = opera2.length;  
  // Extract the string into month, date and year  

if (lopera2>1)  
  {  
  var pdate = inputText.split('-');  
  }  

  var dd = parseInt(pdate[2]);  
  var mm  = parseInt(pdate[1]);  
  var yy = parseInt(pdate[0]);  

// Create list of days of a month [assume there is no leap year by default]  
  var ListofDays = [31,28,31,30,31,30,31,31,30,31,30,31];  
  if (mm==1 || mm>2)  
  {  
  if (dd>ListofDays[mm-1])  
  {  
  alert('Invalid date format!');  
  return false;  
  }  
  }  
  
if (mm==2)  
  {  
  var lyear = false;  
  
if ( (!(yy % 4) && yy % 100) || !(yy % 400))   
  {  
  lyear = true;  
  }  
 
if ((lyear==false) && (dd>=29))  
  {  
  alert('Invalid date format!');  
  return false;  
  }  
  
if ((lyear==true) && (dd>29))  
  {  
  alert('Invalid date format!');  
  return false;  
  }

  }
  
  }  

  else  
  {  
  alert("Invalid date format!");  
//  document.JoinDate.focus();  
  return false;  
  }  

  return true;
  }    

</script>

<script>
function validate()
{
if (isNaN(document.getElementById("Age").value))
{
alert ("Age should be a number");
return false;
}

if (document.getElementById("sex").value=="" || document.getElementById("JoinDate").value=="" || document.getElementById("FirstName").value=="" || document.getElementById("LastName").value=="" || document.getElementById("Age").value=="")
{
alert ("Pls input all information");
return false;
}

inputText=document.getElementById("JoinDate").value;

if (!validatedate(inputText))
{return false;}

return true;
}
</script>
