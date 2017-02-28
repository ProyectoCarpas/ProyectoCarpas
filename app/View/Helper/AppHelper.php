<?php
App::uses('Helper', 'View');

class AppHelper extends Helper {

	public $helpers = array('Session');

	public  function isUserLogged() {

	        if( $this->Session->check('Auth.User') AND ($this->Session->read('Auth.User.role_id') == Configure::read('Administrador') || $this->Session->read('Auth.User.role_id') == Configure::read('General'))){
	        	return true;
		    }
    }

    public  function isGeneralUser() {

	        if( $this->Session->check('Auth.User') AND $this->Session->read('Auth.User.role_id') == Configure::read('General')){
	        	return true;
		    }
	}

    public  function isAdministratorUser() {

	        if( $this->Session->check('Auth.User') AND $this->Session->read('Auth.User.role_id') == Configure::read('Administrador')){
	        	return true;
		    }
    }
}