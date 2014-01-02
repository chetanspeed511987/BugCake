<?php
class UsersController extends AppController {
    var $components = array('Session', 'Auth');
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add');
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
            (strpos($email,'@lubbleup.com') ? $emailCheck = 1 : $emailCheck = 0);


            if ($duplicateUsername == 0 && $emailCheck == 1) {
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
                return $this->redirect($this->Auth->redirect());
            }
            $this->Session->setFlash(__('Invalid username or password, try again'));
        }
    }
    
    public function logout() {
        $this->redirect($this->Auth->logout());
    }
}
?>