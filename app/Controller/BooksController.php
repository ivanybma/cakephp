<?php
class BooksController extends AppController {
var $name = 'Books';
var $uses = array("Book","Author");

//var $scaffold; this is to let the app can hold a default simple function provided by cake
function index() {
	$this->layout = 'pluralizing';
$this->Book->recursive = 1;
$atotal=$this->Book->Author->find('count');
$btotal=$this->Book->find('count');
$books = $this->Book->find('all');
$this->set('books', $books);
$this->set('atotal', $atotal);
$this->set('btotal', $btotal);
}

function rlist($id=null)
{
	$this->layout = 'pluralizing';
	$this->Book->recursive=1;
	$bk=$this->Book->findById($id);
	$this->set('bk',$bk);
}

function delete($id=null)
{
    if($id==null)
    throw new NotFoundException(__('Invalid id'));
    else 
    $this->Book->delete($id);//only save() and delete() will update the counterCache field
 //   $this->Book->deleteAll(array('Book.id'=>$id));***deleteAll will not update the counterCache field
    
    $this->redirect(array("action"=>"index"));
	
}

function add()
{
	$this->layout = 'pluralizing';
	$alst=$this->Author->find("list",array("fields"=>array('id','name')));
	$this->set('alst',$alst);
	if($this->request->is("post"))
	{
		if($this->Book->save($this->data))
		{
			$this->flash(__("Reader Saved!"),array("action"=>"index"),4);
		}
		
	//	$this->redirect(array('action'=>'index'));
	}
	
}

function view($id=null) {
    $this->layout='pluralizing';
    $this->Book->recursive=1;
    $btotal=$this->Book->Author->find('count');
	$books=$this->Book->findById($id);
	$this->set('books',$books);
	$this->set('btotal', $btotal);
// the following code is to test that updateAll CAN access the "has many" association 
//model from "belongto" one  ---- you can access the Author fields,
// in oppositely direction(from the view of "has many" model), pls check the detail in AuthorsController
// NEED TO PAY ATTENTION TO THE syntax
	$this->Book->updateAll(array('Author.name'=>"'updated from book ".$id."'",
'Book.title'=>"'updateall___".$id."'"),array('Book.id'=>$id));
	
}
}
?>   