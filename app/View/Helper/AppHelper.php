<?php
App::uses('Helper', 'View');

class AppHelper extends Helper {

	public $helpers = array('Session');

    public  function isUserRegistered() {

	        if( $this->Session->check('Auth.User') AND $this->Session->read('Auth.User.role_id') == '2'){
	        	return true;
		    }
	}

    public  function isUserAdmin() {

	        if( $this->Session->check('Auth.User') AND $this->Session->read('Auth.User.role_id') == '1'){
	        	return true;
		    }
    }
}