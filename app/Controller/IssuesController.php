<?php
class IssuesController extends AppController {
    public $helpers = array('Html', 'Form');
    public $uses = array('DefaultModel', 'Issue');
    public $components = array('Paginator', 'Session', 'Cookie');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Cookie->name = 'baker_id';
        $this->Cookie->time = 600;  // or '1 hour'
        $this->Cookie->path = '/';
        $this->Cookie->domain = 'bugcake.com';
        $this->Cookie->secure = false;  // i.e. only sent if using secure HTTPS
        $this->Cookie->key = 'qSI232qs*&sfytf65r6fc9-+!@#HKis~#^';
        $this->Cookie->httpOnly = false;
    }
    
    public function state($id=null) {
        if ($this->request->is('get')) {
            $this->redirect(array('action' => 'view', $id));
        }
        if ($this->Session->read('Auth.User.role') == 'admin' || $this->Cookie->read('User.role') == 'admin') {
            
            $post = $this->Issue->findById($id);
            if ($post['Issue']['state'] == 0) {
                $post['Issue']['state'] = 1;
            } else {
                $post['Issue']['state'] = 0;
            }
            $this->Issue->create();
            
            $this->Issue->save($post);
            //$this->Session->setFlash(__(var_dump($post)));
        }
        $this->redirect(array('action' => 'view', $id));
    }
    
    public function index($state=null) {
        $this->layout = 'tracker';
        //$this->Session->setFlash(__('Welcome back'), 'info');
        if ($this->Session->read('Auth.User.username') != null || $this->Cookie->read('User.username') != null) {
            //$this->redirect(array('controller' => 'users', 'actions'=> 'login'));
        }
        if ($state == null) {
            $this->Paginator->settings = array('conditions' => array('Issue.comment_id =' => '0'),
                                               'limit' => 6, 'order' => array('Issue.id' => 'desc'));
        } else {
            $this->Paginator->settings = array('conditions' => array('Issue.comment_id =' => '0',
                                                                     'Issue.state =' => $state),
                                               'limit' => 6, 'order' => array('Issue.id' => 'desc'));
        }

        $data = $this->Paginator->paginate('Issue');
        $this->set('posts', $data);
    }

    public function view($id=null) {
        
        $this->layout = 'tracker';

        $post = $this->Issue->findById($id);
        $comments = $this->Issue->findAllByComment_id($id);
        
        if (!$post) { $this->redirect(array('action' => 'index')); }
        
        $this->set('post', $post);
        $this->set('comments', $comments);
    }
    
    public function add() {
        $this->layout = 'tracker';
        if ($this->Session->read('Auth.User.username') != null || $this->Cookie->read('User.username') != null) {
            if ($this->request->is('post')) {
                $this->Issue->create();
                $this->Issue->set("author", $this->Cookie->read('User.username'));
                $this->Issue->set("state", 0);
                //var_dump($this->Issue);
                if ($this->Issue->save($this->request->data)) {
                    $this->Session->setFlash(__('Your post has been saved.'), 'info');
                    //return $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('Unable to add your post.'), 'info');
                }
            }
        } else {
            //return $this->redirect(array('action' => 'index'));
        }
        
    }
    public function edit($id = null) {
        $this->layout = 'tracker';
        $post = $this->Issue->findById($id);
        if ($post['Issue']['author'] == $this->Session->read('Auth.User.username') ||
            $post['Issue']['author'] == $this->Cookie->read('User.username')) {

            $this->set('post', $post);
            if (!$post) {
                $this->redirect(array('action' => 'index'));
            }
            if ($this->request->is('post') || $this->request->is('put')) {
                $this->Issue->id = $id;
                if ($this->Issue->save($this->request->data)) {
                    $this->Session->setFlash(__('Your post has been updated.'), 'info');
                    $this->redirect(array('action' => 'index'));
                }
                $this->Session->setFlash(__('Unable to update your post.'), 'info');
            }
            if (!$this->request->data) {
                $this->request->data = $post;
            }
            
        } else {
            $this->redirect(array('action' => 'view', $id));
        }
    }
    
    public function delete($id) {
        $this->layout = 'tracker';
        
        if ($this->request->is('get')) {
            $this->redirect(array('action' => 'index'));
        }
        $post = $this->Issue->findById($id);
        if ($post['Issue']['author'] == $this->Session->read('Auth.User.username') ||
            $post['Issue']['author'] == $this->Cookie->read('User.username')) {
            if ($this->Issue->delete($id)) {
                $this->Session->setFlash(__('The post with id: %s has been deleted.', h($id)), 'info');
                $this->redirect(array('action' => 'index'));
            }
            
        }
        
    }
    
    public function comment($post_id = null) {
        if ($this->request->is('post')) {
            $form = $this->Issue->read(null, $post_id);
            $form['Issue']['answers'] = $form['Issue']['answers'] + 1;
            $this->Issue->create();
            $this->Issue->save($form);   
            $this->Issue->create();
            $this->Issue->set(array('comment_id'=>$post_id));
            $this->Issue->set("author", $this->Cookie->read('User.username'));
            $this->Issue->set("title", "comment");
            if ($this->Issue->save($this->request->data)) {
                $this->Session->setFlash('Your comment has been added.', 'info');
                //$this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to add your comment.', 'info');
            }
            $this->redirect(array('action' => 'view', $post_id));
        }
    }
}
?>