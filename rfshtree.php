

<?php
//header('Content-type: application/json');
$usrgrp=$_POST["usrgrp"];

class rtv
{
public $con=" ";
public $sql=" ";
public $rst=" ";
public $rtn=array();
public $host="localhost";
public $usr="ivan";
public $pwd="440103";
public $db="ivan";

function connect($dba)
{
//prepare the user function list
 $this->con=mysqli_connect($this->host,$this->db,$this->pwd,$this->usr);
 // Check connection
 if (mysqli_connect_errno()) 
 return "no";
 else
 return "yes";
}

function get()
{
//need to understand a thing, if we need to store the object to array, we first need to create the object instant
// and format it, then apply it to the array, if we want to add some more new object to this array, 
//we need to rebuild a new instant of the object and format it accordingly instead of just change the value of the prior one.
$this->rst=mysqli_query($this->con,$this->sql);
if(!$this->rst)
return true;
while($this->rcd=mysqli_fetch_array($this->rst))  /*loop the authority group result set*/
{
array_push($this->rtn,$this->rcd);
}


}

}

/*
class rcd 
{
public $fnc;
public $lnk;
}
//$grpusr=$_POST["grpusr"];
$str=array();
//$str[]=new rcd;
$obj= new rcd;
$obj->fnc="fnc";
$obj->lnk="lnk";
array_push($str,$obj);
$obj->fnc="ooo";
$obj->lnk="qqq";
array_push($str,$obj);
$obj= new rcd;
$obj->fnc="ddd";
$obj->lnk="fff";
array_push($str,$obj);
*/
//header('Content-type: application/json');
$obj= new rtv;

//$usrgrp="basic";
$obj->sql="select fncdes,fnclnk from fnccdbase where fnccd in (select fnccd from grpfnc where usrgrp ='".$usrgrp."')";
$aa=$obj->connect("");
$obj->get();
//print_r($obj->rtn);
echo json_encode($obj->rtn); 
?>