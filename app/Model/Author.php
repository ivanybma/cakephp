<?php
class Author extends AppModel
{
public $name = 'Author';

    public $hasMany = array(
    'Book'=>array(
    'className'=>'Book',
    'foreignKey'=>'author_id',
    'dependent'=>true
    )
    );
        
     public $validate = array(
    'name'  => array('ne'=>array('rule'=>'notEmpty','message'=>'Author name should not be blank','last'=>false)),
    'email' => array('em'=>array('rule'=>'email','allowEmpty'=>true, 'message'=>'email format invalid')),
    );
    
}
?>