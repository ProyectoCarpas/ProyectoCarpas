<?php
App::uses('AppController', 'Controller');

class PublicsController extends AppController {

	public function beforeFilter(){

		parent:: beforeFilter();
		$this->Auth->allow('index');
	}


	public function index() {

		$user = $this->Auth->user();
		
		if($user){
			$this->set(compact('user'));
		}
	}
}
?>