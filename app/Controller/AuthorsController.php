<?php
class AuthorsController extends AppController {
var $name = 'Authors';
var $uses = array('Author','Book');
var $components = array('RequestHandler');
//public $helpers = array('Js' => array('Prototype'));  * this is to define which javascript libraries are used in cakePHP
// as I just know jQuery library, so I will use the following definition
public $helpers=array('Js'=>array('Jquery'));//$this->Js->xxxx cannot work without this definition 

//var $scaffold;this is to let the app can hold a default simple function provided by cake
function index() {
	$rstpe=$this->request->is('ajax');
	$this->set('rstpe',$rstpe);
		$this->layout='pluralizing';
	if ($this->request->is('post'))
	{
		$name=$this->request->data['test']['name'];
		$db = $this->Author->getDataSource(); //for fetch function, association info will not be collected
		$rst=$db->fetchAll('select * from authors where name like :username', array('username'=>'%'.$name.'%'));
		$this->set('srch',$rst);  
		$byf = $this->Author->findById('1');//for find function, the association info will be collected
		$this->set('srch2',$byf);
//		$conditions= array( *** this does not work as we cannot put fields/group into condition
//		'Book.id' => '2'
//		'fields' => array('Book.author_id')
//		'group' => 'Book.author_id'
//		);
// for the find setting, we need to define it seperately in fields, group, condition...
		$ak=$this->Book->find('all',array('fields'=>
		array('Book.author_id','COUNT(*) AS cnt'),'group'=>'Book.author_id'));
// this is to use COUNT and GROUP to calculate the book count manually for each author
		$this->set('ak',$ak);
	}
	else 
	{

$this->Author->recursive = 1;
$authors = $this->Author->find('all');
$this->set('authors', $authors);
$total=$this->Author->find('count');
$thread=$this->Book->find('threaded');
$btotal=$this->Book->find('count');
$list=$this->Author->find('list', array('fields'=>array('id','name','website')));
//$btotal=$this->Autor->Book->find('count');
$this->set('total',$total);
$this->set('list',$list);
$this->set('btotal',$btotal);
$this->set('thread',$thread);
//$this->set('btotal',$btotal);
// the following code is to test that updateAll cannot access the "belongto" association 
//model from "has many" one  ---- if you try to access the Book fields, it will prompt error
// in oppositely direction(from the view of "belongto" model), pls check the detail in BooksController
$this->Author->updateAll(array('Author.name'=>"'updateall from author'",
'Author.email'=>"'updall@sss.com'"),array('Author.id'=>1));
}
}

function view($id=null){
	$this->layout='pluralizing';
    $this->Author->recursive=1;
    $btotal=$this->Book->find('count',array('conditions'=>array('Book.author_id'=>$id)));
    $author=$this->Author->findById($id);
    $this->set('author',$author);
	$this->set('btotal', $btotal);
}

function clock()
{
date_default_timezone_set("America/Los_Angeles");
$ctime= date('Y-m-d H:i:s');
$this->set('ctime',$ctime);	
$this->render('clock', 'ajax'); 
}

function delete($id=null)
{
    if($id==null)
    throw new NotFoundException(__('Invalid id'));
    else 
    $this->Author->delete($id);//this delete will also delete the book which with relationship belong to this author
 // just because we use "dependent"=>true in author model
    
    $this->redirect(array("action"=>"index"));
	
}

function add(){
	$this->layout='pluralizing';
    $this->Author->recursive=1;
    $count=5;
    $this->set('count', $count);//set the form helper count for view usage
    if($this->request->is('post'))
    {
    	$this->set('dta',$this->request->data);
  //  	$this->Author->saveAll($this->request->data['Author']); this is to save all the entries
  // in one time, if there is validation defined in model, the save will not be performed in case
  // any entry fails to pass the validation
  $ddta=array(); //***this pre initialization is a must in case u want to use "array_push" below
//the following code is to manually prepare a array content for saveMany, it is important to use "compact"
//array syntax for saveMany: array( [0]=>array() [1]=>array() [2]=>array() [3]=>array()...)
// every array() direct under the 1st level element is expected to be an entry to be saved to model(or including some association model)
// so this array should include all the fields u want to save for this entry
// and because saveMany can also save the association model, so we need to declare clearly in the array that
// which model are fields belong to.  in this case, as field "name","email","website" are 
// the fields in model AUTHOR, so we need to ensure a set of these fields should be designated to "Author" 

  foreach ($this->request->data['Author'] as $rcd)
  {  //loop all the author entries one by one
  	if(!empty($rcd['name']) || !empty($rcd['email']) || !empty($rcd['website']))
  	{//this logic will treat check if any field of an author has been makred, 
   //only author entry with at lease one field input will be collected for further action
  		$Author=$rcd;    //variable with name "Author" here is important, it will ensure 
  		// key name "Author" will be used for the array: $rcd value by command COMPACT below
  		$Book=array('title'=>$rcd['name'].'default book','isbn'=>'default','description'=>'default');
  		array_push($ddta,compact('Author','Book'));//put the element with key named "Author" and value as the
  	//	array: $rcd to array $ddta
    }
  }
  
  }
  $data= array(
  array('Author'=>array('name'=>'many 3','email'=>'many@21cn.com'),'Book' => array('title' => 'default')),
  array('Author'=>array('name'=>'many 4','email'=>'many@gmail.com','website'=>'many website 2'))
  );// this is just a sample of normal saveMany array syntax
  $this->set('nmdta',$data);
$this->set('mdta',$ddta);
//****DO remember, if need to save the association model, we need to use the "many"(lower level) model
// instead of the "one"(upper one) *****
//$this->Author->saveMany($ddta,array('deep'=>true)); this cannot work due to "Author" model
//is the upper one("one")
	$this->Book->saveMany($ddta,array('deep'=>true));
    }
}

?>    