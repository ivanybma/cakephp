<?php
class ReadersController extends AppController {
var $name = 'Readers';
var $uses = array('Book','Reader');
var $helpers = array('Html', 'Form','Session');
function index() {
$this->layout = 'pluralizing';
$this->Reader->recursive = 1;
$rtotal=$this->Reader->find('count');
$rooks = $this->Reader->find('all');
$this->set('readers', $rooks);
$this->set('rtotal', $rtotal);
}

 public function add() {
 	$this ->layout='pluralizing';
 	
 	$db = $this->Reader->getDataSource();
 	$value="select count(*) from readers where name in ('abc','ddd') and date>12";
 	//the function value(input,outputtype) is to change the input into a sql statement usable value
$value2 = $db->value($value, 'int');
$this->set('tst',$value);
$this->set('tst2',$value2);

$conditionsSubQuery['"User2"."status"'] = 'B';

$db = $this->Reader->getDataSource();
$subQuery = $db->buildStatement(
    array(
        'fields'     => array('"User2"."id"'),
        'table'      => $db->fullTableName($this->Reader),
        'alias'      => 'User2',
        'limit'      => null,
        'offset'     => null,
        'joins'      => array(),
        'conditions' => $conditionsSubQuery,
        'order'      => null,
        'group'      => null
    ),
    $this->Reader
);
$subQuery = ' "User"."id" NOT IN (' . $subQuery . ') ';
$this->set('psubq',$subQuery);
$subQueryExpression = $db->expression($subQuery);
$this->set('subq',$subQueryExpression);
$conditions[]=$subQueryExpression;
$aaa=compact('conditions');
$this->set('cpsubq',$aaa);
//$conditions[] = $subQueryExpression;
 	
    if ($this->request->is('post')) 
   {
        	$this->set('formdata',$this->request->data);
        	$db = $this->Reader->getDataSource();
        	$vv=$db->value('2', 'int');
        	$this->set('vv',$vv);
        	//pay attention to the string used by SQL, need to be quoted with '', so in cakephp, we need to use "'string'"
        	$this->Reader->updateAll(array('email'=>"'default222@yahoo.com'"),array('id'=>$vv));
            $this->Reader->create();
/*We call the create() method first in order to reset the model state for saving new
 *  information. It does not actually create a record in the database, but clears 
 *  Model::$id and sets Model::$data based on your database field defaults.*/                      
//if ($this->Reader->save($this->request->data))this kind of coding will let the validation
// be performed in model level, once it passes, data will be saved directly, then no chance for 
//controller to send more info to user
    $this->Reader->set($this->request->data); //we use set to put the fields value to model array temporarily
    //but it will not be saved at this time
    if ($this->Reader->validates())//controller trigger the validation on model set data
   {
        if($this->Reader->save())//in case controller validation passes, model will proceed the save action
       {$this->flash(__("Reader Saved!"),array("action"=>"index"),4);}
        else 
       {$this->flash(__("Reader fail to be saved due to database error!"),array("action"=>"add"),4);}
   }
    else // in case controller validation failes, send msg to view directly from controller
   {   
       	$this->set('errormsg',$this->Reader->validationErrors);
 //  $this->set('error',$this->Reader->invalidFields()); don't know why it return duplicate error msg
//$this->flash(__("Reader fail to be saved due to database error!"),array("action"=>"add"),4);
   }
   
   }
   
    }


function add2() {
	$this ->layout='pluralizing';
	$this->Reader->recursive=1;
	//$this->set('formdata','not yet in post');
	if($this->request->is('post')) 
	{
	//	if($str==null)
	if (isset($this->request->data['Add']))
	$key='add';
	if (isset($this->request->data['Cancel1']))
	$key='cancel';
	if ($str<>null)
	$key=$str;
	
	$str=" key: ".$key." is pressed";
	$this->set('key',$str);
	$this->set('formdata',$this->request->data);
		//if need to use the save() function, we need to ensure the field name in our form 
		//should be the same as the field name in destination table
		$this->Reader->create();
	        if ($this->Reader->save($this->request->data)) {
          $this->flash(__("Reader Saved!"),array("action"=>"add"),4);}
        else 
        {//$this->flash(__("Reader add failed!"),array("action"=>"index"),4);
        	//$this->flash($this->Reader->validationErrors, array("action"=>"index"),4);
        	$this->set('errormsg',$this->Reader->validationErrors);
           
        //    $this->render('index');
       // 	$this->index();
       // 	$this->render('index'); 
        }
	//	else
	//	$this->set('formdata',$str);
	}

	
}
function sbdelete($id=null,$rid=null) {

		if($id==null or $rid==null)
		throw new NotFoundException(__('Invalid id'));
		else 
		{
			$this->Reader->BooksReader->delete($id);
		}
	$this->redirect(array('action'=>'view',$rid));
}
function delete($str=null) {
	$this ->layout='pluralizing';
	$this->Reader->recursive=1;
	//$this->set('formdata','not yet in post');
	if($this->request->is('post')) 
	{
	//	if($str==null)
	if (isset($this->request->data['delete']))
	$key='delete';
	if (isset($this->request->data['cancel2']))
	$key='cancel';
	
	$str=" key: ".$key." is pressed";
	$this->set('key',$str);
	$this->set('formdata',$this->data);
		
	//	else
	//	$this->set('formdata',$str);
	}
	$this->index();
	$this->render('index'); 
	
}
function view($id=null) {
    $this->layout='pluralizing';
    $this->Reader->recursive=1;
    //pls remember that BooksReader is an available model generated by cakephp automaticaly, but if we need to 
    //do some more extend on it, we need to define the model physically under model folder
    $btotal=$this->Reader->BooksReader->find('count',array('conditions'=>array('BooksReader.reader_id'=>$id)));
	// do remember that condition definition key word should be "conditions" 
    $read=$this->Reader->findById($id);
    $this->set('reader',$read);
	$this->set('btotal', $btotal);
/*	$blst=$this->Book->find('list',array('conditions'=>
	array('NOT'=>array('id'=> $this->Reader->BooksReader->field('book_id',array('condition'=>
	array('reader_id'=>$id))
	)))));*/
	$bkid=$this->Reader->BooksReader->find('list',array('conditions'=>array('reader_id'=>$id),
	'fields'=>array('id','book_id')));//this is to extract the list of book which has been owned by reader $id
	$this->set('bkid',$bkid);
	$blst=$this->Book->find('list',array('conditions'=>
	array('NOT'=>array('id'=> $bkid)),'fields'=>array('id','title')));//this is to extract
	//book list not in the list for books which owned by user $id(that means list of book
	//not owned by user
	$this->set('blst',$blst); // this list will be used for a "select" element in view
	if($this->request->is("post"))
	{
		$this->set('ddta',$this->request->data);
		$this->Reader->save($this->request->data);
		$this->redirect(array('action'=>'view',$id));
	}
	
	
}

}


?>