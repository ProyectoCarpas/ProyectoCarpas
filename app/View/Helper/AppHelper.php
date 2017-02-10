<?php
App::uses('Helper', 'View');

class AppHelper extends Helper {

	public $helpers = array('Session');

	public  function isUserLogged() {

	        if( $this->Session->check('Auth.User') AND ($this->Session->read('Auth.User.role_id') == Configure::read('administrator_rol_user') || $this->Session->read('Auth.User.role_id') == Configure::read('general_rol_user'))){
	        	return true;
		    }
    }

    public  function isGeneralUser() {

	        if( $this->Session->check('Auth.User') AND $this->Session->read('Auth.User.role_id') == Configure::read('general_rol_user')){
	        	return true;
		    }
	}

    public  function isAdminUser() {

	        if( $this->Session->check('Auth.User') AND $this->Session->read('Auth.User.role_id') == Configure::read('administrator_rol_user')){
	        	return true;
		    }
    }
}