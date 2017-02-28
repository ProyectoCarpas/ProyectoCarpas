<?php
App::uses('Controller', 'Controller');

class AppController extends Controller {

	public $helpers = array('Html','Form','Session');

    public $components = array(

    	'Email',
		'Session',
		//'DebugKit.Toolbar',

		'Auth' => array(

			'authenticate' => array(
							'Form' => array(
									'passwordHasher' => 'Blowfish',
	                                'userModel' => 'User',
                                    'fields' => array('username' => 'email',
                                                      'password' => 'password'),
                                    'scope' => array(
                                                     array('User.status' => 'Activo')
                                    )
							)
			),

			'loginRedirect'  => array('controller' => 'publics', 'action' => 'index'),
            'logoutRedirect' => array('controller' => 'publics', 'action' => 'index'),

			'authError' => 'Accedo restringido',
			'loginError' => false,

			'authorize' => array('Controller')
        )
	);

	
	public function checkRequiredFieldsForm($data = null, $requiredFields) {

		if (!empty($requiredFields)) {

			foreach ($requiredFields as $field) {

					if(!in_array($field, array_keys($data))){

						return false;
					}
			}
		}

		return true;
	}
}

