<?php
class UsrautsController extends AppController {
    public $helpers = array('Html', 'Form','Session');

    public function index() {
    	$this->layout = 'pluralizing';
        $this->set('usau', $this->Usraut->find('all'));
    }

}
    
    ?>