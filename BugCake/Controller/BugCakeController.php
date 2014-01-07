<?php
class BugCakeController extends BugCakeAppController {
	public function index() {
		$this->redirect(array('controller' => 'users', 'action'=> 'login'));
	}
}
?>