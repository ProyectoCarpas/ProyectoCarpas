<?php
App::uses('Controller', 'Controller');

class AppController extends Controller {

	public $helpers = array('Html','Form','Session');

    public $components = array(

    	'Email',

		//'DebugKit.Toolbar',
		'Session',

		'Auth' => array(

			'authenticate' => array(
							'Form' => array(
									'passwordHasher' => 'Blowfish',
	                                'userModel' => 'User',
                                    'fields' => array('username' => 'email',
                                                      'password' => 'password'),

                                    'scope' => array(
                                                     array('User.status' => 'Active')
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
}

