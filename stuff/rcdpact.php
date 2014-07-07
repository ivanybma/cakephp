<?php
$act=$_GET["act"];
$id=$_GET["id"];
$age=$_GET["age"];
$fname=$_GET["fname"];
$lname=$_GET["lname"];
$jdate=$_GET["JoinDate"];
$sex=$_GET["sex"]; 	

 $con=mysqli_connect("localhost","ivan","440103","ivan");
 // Check connection
 if (mysqli_connect_errno()) 
   echo "Failed to connect to MySQL: " . mysqli_connect_error();

//---------------delete rcd from PERSONS-------------------------
if ($act=='d')
{
$sql="delete from persons where id='".$id."'";
$rst=mysqli_query($con,$sql);
if(!$rst)
echo "Error selecting table: " . mysqli_error($con);

//---------------recycle the id number to idbase-----------------
$today=getdate();
$day="$today[year]-$today[mon]-$today[mday]";

$sql="insert into idbase value('".$id."', '" . $day ."')";
$rst=mysqli_query($con,$sql);
if(!$rst)
echo "Error selecting table: " . mysqli_error($con);

//---------------update rcd in AGESTAT-------------------------
$sql="update agestat set number=number-1 where ageb<='".$age ."' and agee>='" . $age . "'";
$rst=mysqli_query($con,$sql);
if(!$rst)
echo "Error selecting table: " . mysqli_error($con);
}

if ($act=='c')
{
//---------------update rcd in AGESTAT-------------------------
$sql="select * from persons where id='".$id."'";
$rst=mysqli_query($con,$sql);
if(!$rst)
echo "Error selecting table: " . mysqli_error($con);
$rcd=mysqli_fetch_assoc($rst);
$hage=$rcd["Age"];
echo $hage;
$sql="update agestat set number=number-1 where ageb<='".$hage ."' and agee>='" . $hage . "'";
$rst=mysqli_query($con,$sql);
if(!$rst)
echo "Error selecting table: " . mysqli_error($con);

$sql="update agestat set number=number+1 where ageb<='".$age ."' and agee>='" . $age . "'";
$rst=mysqli_query($con,$sql);
if(!$rst)
echo "Error selecting table: " . mysqli_error($con);

//---------------update rcd in PERSONS-------------------------
$sql="update persons set Age='" . $age ."' , FirstName='". $fname . "' , LastName='" .$lname."' , sex='". $sex. "' , JoinDate='". $jdate ."' where id='".$id."'";
$rst=mysqli_query($con,$sql);
if(!$rst)
echo "Error selecting table: " . mysqli_error($con);
}

?>