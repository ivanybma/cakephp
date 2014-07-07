<?php
class Post2sController extends AppController {
    public $helpers = array('Html', 'Form');
   public function index() {
        $this->set('post2s', $this->Post2->find('all'));
    }
    
    public function view($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }

        $post = $this->Post2->findById($id);
        if (!$post) {
            throw new NotFoundException(__('Invalid post'));
        }
        $this->set('post2', $post);
    }
}
?>