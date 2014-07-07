<?php
class Reader extends AppModel
{ public $name = 'Reader';

    public $validate = array(
    'name'  => array('ne'=>array('rule'=>'notEmpty','message'=>'Reader name should not be blank','last'=>false)),
        'email' => array('em'=>array('rule'=>'email','allowEmpty'=>true, 'message'=>'email format invalid')),
        
    );
    


public $hasAndBelongsToMany = array(
 'Book'=>array(
'className'=>'Book',
'foreignkey'=>'reader_id',
'associationForeignKey'=>'Book_id',
'unique'=>false,//this is to let the reader existing relationship with book will not be 
//deleted before new one inserted
'counterCache' => true
)
);




}


?>