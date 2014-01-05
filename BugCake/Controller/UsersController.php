<?php
class UsersController extends BugCakeAppController {
    // var $domain = "example.com" 


    var $components = array('Session', 'Auth', 'Cookie');
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add');
        $this->Cookie->name = 'baker_id';
        $this->Cookie->time = 600;  // or '1 hour'
        $this->Cookie->path = '/';
        $this->Cookie->domain = 'bugcake.com';
        $this->Cookie->secure = false;  // i.e. only sent if using secure HTTPS
        $this->Cookie->key = 'qSI232qs*&sfytf65r6fc9-+!@#HKis~#^';
        $this->Cookie->httpOnly = false;
    }
    
    public function index() {
        $this->User->recursive = 0;
        $this->set('users', $this->paginate());
        $this->redirect(array('action' => '../'));
    }

    public function view($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->set('user', $this->User->read(null, $id));
    }

    public function add() {
        if ($this->request->is('post')) {
            $username = $this->request->data['User']['username'];
            $email = $this->request->data['User']['email'];
            $duplicateUsername = $this->User->find('count', array(
             'conditions' => array('username' => $username)
             ));
            /* 
-            Uncomment these lines if you work in an enteprise-level environment
-            so that you limit the users' registration to corporate-only (recommended)
-
-            (strpos($email, $domain) ? $emailCheck = 1 : $emailCheck = 0);
 
-            Remember to update the if check that follows with the $emailCheck var to make use of it.
-            */
-
-           if ($duplicateUsername == 0) {

                $this->User->create();
                $this->request->data['User']['role'] = "user";
                if ($this->User->save($this->request->data)) {
                    $this->Session->setFlash(__('The user has been saved'));
                    return $this->redirect(array('action' => 'index'));
                }
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            } else {
                if($emailCheck == 0) {
                    $this->Session->setFlash(__('You are not allowed to access this webplace'));
                } else {
                    $this->Session->setFlash(__('This username already exists!'));
                }
                
            }
        }
    }

    public function edit($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
        } else {
            $this->request->data = $this->User->read(null, $id);
            unset($this->request->data['User']['password']);
        }
    }

    public function delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->User->delete()) {
            $this->Session->setFlash(__('User deleted'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('User was not deleted'));
        $this->redirect(array('action' => 'index'));
    }
    
    public function login() {
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->Cookie->write('User.name', $this->Session->read('Auth.User.username'));
                $this->Cookie->write('User.role', $this->Session->read('Auth.User.role'));
                $this->Session->setFlash(__('Welcome '.$this->Session->read('Auth.User.username')));
                $this->redirect(array('action' => 'login'));
            }
            $this->Session->setFlash(__('Invalid username or password, try again'));
        }
    }
    
    public function test() {
    }
    
    public function logout() {
        $this->Cookie->destroy();
        $this->Session->setFlash(__('Logged out successfully'));
        $this->redirect($this->Auth->logout());
        
    }
}
?>