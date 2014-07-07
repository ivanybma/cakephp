<?php

class PostsController extends AppController {
    public $helpers = array('Html', 'Form','Session');

    public function index() {
        $this->set('posts', $this->Post->find('all'));
    }
    public function usraut() {

    	$this->set('usau', $this->usraut->find('all'));
    
    }
    public function pluralizing(){
    	$this->layout = 'pluralizing';
    	if(!$this->request->is('get'))
    	{
    	$word=$this->request->data['word'];
    	$inrst=Inflector::pluralize($word);
    	return $this->set('prst',$inrst);
    	
    	}
    }
	
	 public function view($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }

        $post = $this->Post->findById($id);
        if (!$post) {
            throw new NotFoundException(__('Invalid post'));
        }
        $this->set('post', $post);
    }
    
     public function add() {
        if ($this->request->is('post')) {
            $this->Post->create();
            if ($this->Post->save($this->request->data)) {
                $this->Session->setFlash(__('Your post has been saved.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Unable to add your post.'));
        }
    }
    
public function edit($id = null) {
    if (!$id) {
        throw new NotFoundException(__('Invalid post'));
    }

    $post = $this->Post->findById($id);
    if (!$post) {
        throw new NotFoundException(__('Invalid post'));
    }

    if ($this->request->is(array('post', 'put'))) {
        $this->Post->id = $id;
        if ($this->Post->save($this->request->data)) {
            $this->Session->setFlash(__('Your post has been updated.'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Unable to update your post.'));
    }

    if (!$this->request->data) {
        $this->request->data = $post;
    }
}

 public function delete($id){
 	if($this->request->is('get')){
 		throw new MethodNotAllowedException();
 }
    if($this->Post->delete($id)) {
    	$this->Session->setFlash(
    	__('The post with id %s has been deleted.', h($id))
    	);
    	return $this->redirect(array('action'=>'index'));
    }
 }
 
 
    
 public function home() {
session_start();
if (isset($_SESSION["id"]))
{                                //session exists B
$lname=$_SESSION["lname"];
$fname=$_SESSION["fname"];
$ltime=$_SESSION["ltime"];
$name= $fname . ' ' . $lname;
//----PHP print the Jquery coding to the browser, Jquery can help to change the CSS arttribute for all the elements------
// if don't use jquery, javascript need to loop all the elements in the same class and change the arttribute one by one-----------
$stat="<script>$('.lginc').css('display','none');</script>"; 
$stat=$stat."<script>$('.lgofc').css('display','inline');</script>";
$stat=$stat."<script>document.getElementById('nme').innerHTML='".$name."';</script>";
$stat=$stat."<script>document.getElementById('ltime').innerHTML='".$ltime."';</script>";
}                                //session exists E
else
{                                //session not exists B
//$stat="<script>document.getElementsByClassName('lginc').style.display='inline';</script>";
$stat="<script>$('.lginc').css('display','inline');</script>";
//$stat="<script>document.getElementsByClassName('lgofc').style.display='none';</script>";
$stat=$stat."<script>$('.lgofc').css('display','none');</script>";

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
{$stat=$stat."<script>document.getElementById('info').innerHTML='user&pwd not match';</script>";}  //user$pwd fail to be identified 
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
//$stat="<script>document.getElementsByClassName('lgofc').style.display='inline';</script>";
$stat=$stat."<script>$('.lgofc').css('display','inline');</script>";
$stat=$stat."<script>document.getElementById('nme').innerHTML='".$name."';</script>";
$stat=$stat."<script>document.getElementById('ltime').innerHTML='".$ltime."';</script>";

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
$this->set('lginfo',$stat);// this is the login/logoff info control data to view home
    }

public function pac(){
session_start();
if (isset($_SESSION["id"]))
{                                //session exists B
$lname=$_SESSION["lname"];
$fname=$_SESSION["fname"];
$ltime=$_SESSION["ltime"];
$name= $fname . ' ' . $lname;
//----PHP print the Jquery coding to the browser, Jquery can help to change the CSS arttribute for all the elements------
// if don't use jquery, javascript need to loop all the elements in the same class and change the arttribute one by one-----------
$stat="<script>$('.lginc').css('display','none');</script>"; 
$stat=$stat."<script>$('.lgofc').css('display','inline');</script>";
$stat=$stat."<script>document.getElementById('nme').innerHTML='".$name."';</script>";
$stat=$stat."<script>document.getElementById('ltime').innerHTML='".$ltime."';</script>";
$this->set('lginfo',$stat);	
}                                //session exists E
else
{                                //session not exists B
//throw new NotFoundException(__('Not yet login'));
       //  $this->Session->setFlash(__('Please log in from Home Page'));
// do remember that the flash will not be available until u set the DEBUG level =0 in CORE.php
// according to internet info, flash will take the place of session->setFlash
            $this->flash(__("You still not yet login, pls login through home page"),array("action"=>"home"),4);
        //    $this->redirect(array('controller'=>'Posts','action'=>'home'));
} 
//$this->autoRender = false;
}
//as signoff function is used by a ajax call from home, phpsignoff is a new one for non ajax call
public function phpsignoff(){
session_start();
session_destroy(); 
$this->redirect(array('controller'=>'Posts','action'=>'home'));
}
public function signoff(){
	
session_start();
session_destroy(); 
$this->autoRender = false; //stop the controller rendering a view
//$this->layout = 'ajax';  	
    }
    
}


?>