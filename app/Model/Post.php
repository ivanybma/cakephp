<?php


class Post extends AppModel {
    public $validate = array(
        'title' => array(
            'rule' => 'notEmpty',
    'message' => 'cannot be empty'
        ),
        'body' => array(
            'rule' => 'notEmpty'
        )
    );
}







?>