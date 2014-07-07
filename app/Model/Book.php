<?php
class Book extends AppModel
{ public $name = 'Book';
public $belongsTo = array(
 'Author'=>array(
'className'=>'Author',
'counterCache'=>true,
//'foreignkey'=>'author_id'
)
);

public $hasAndBelongsToMany = array(
 'Reader'=>array(
'className'=>'Reader',
'foreignkey'=>'book_id',
'associationForeignKey'=>'reader_id',
'counterCache'=>true,
'unique'=>false //this is to let the book existing relationship with reader will not be 
//deleted before new one inserted
)
);
}
?>