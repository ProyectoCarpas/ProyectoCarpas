<?php
App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

class User extends AppModel {

	public $name = 'User';

	public $belongsTo = array(
		'Role' => array(
			'className' => 'Role',
			'foreignKey' => 'role_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => ''
			)
	);

	public $hasMany = array(
                            // 'Stand' => array(

                            //                     'className' => 'Stand',
                            //                     'foreignKey' => 'stand_id',
                            //                     'dependent' => true
                            //                 ),
	);

	public $validate = array(

		'email' => array(

			'required' => array(
				'rule' => array('email', true), // email type
				'message' => 'Introduce un Email válido'
			),

			'unique' => array(
				'rule'    => array('isUnique'),
				'message' => 'Email en uso',
			),

			'between' => array(
				'rule' => array('between', 6, 50),
				'message' => 'Debe contener entre 6 y 50 caracteres'
			)
		),

		'first_name' => array(

			'nonEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Campo obligatorio',
				'allowEmpty' => false
			),

			'max_length' => array(
				'rule' => array('maxLength', '30'),
				'message' => 'No puede tener mas de 30 caracteres'
			),

			'alphaNumericDashUnderscore' => array(
				'rule'    => array('alphaNumericDashUnderscore'),
				'message' => 'Solo puede contener letras, números y guiones.'
			)
		),

		'last_name' => array(

			'nonEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Campo obligatorio',
				'allowEmpty' => false
			),

			'max_length' => array(
				'rule' => array('maxLength', '30'),
				'message' => 'No puede tener mas de 30 caracteres'
			),

			'alphaNumericDashUnderscore' => array(
				'rule'    => array('alphaNumericDashUnderscore'),
				'message' => 'Solo puede contener letras, números y guiones.'
			)
		),

		//TODO: check Validations
		'date_of_birth' => array(

			// 'numericDash' => array(
			// 	'rule'    => array('numericDash'),
			// 	'message' => 'Solo puede contener números y guion medio.'
			// 	)

			),

		// TODO: check Validations
		'cell_number' => array(

		),

		'password' => array(

			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'Campo obligatorio'
			),

			'min_length' => array(
				'rule' => array('minLength', '6'),
				'message' => 'La Contraseña debe tener al menos 6 caracteres'
			),

			'max_length' => array(
				'rule' => array('maxLength', '30'),
				'message' => 'La Contraseña debe no puede tener mas de 30 caracteres'
			),

			'security_password' => array(
				'rule'    => array('securityPassword'),
				'message' => 'La Contraseña debe tener al menos una letra mayuscula, una minuscula, y un número'
			)
		),

		'password_confirm' => array(

			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'Repita la Contraseña'
			),

			'equaltofield' => array(
				'rule' => array('equaltofield', 'password'),
				'message' => 'Las Contraseñas no coinciden'
			)
		),

		// Validation when editing User Password.
		'old_password' => array(

			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'Debe proporcionar su vieja contraseña'
			),

			'check_old_password' => array(
				'rule' => array('check_old_password'),
				'message' => 'Su contraseña vieja es incorrecta'
			)
		),

		'password_update' => array(

			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'Contraseña obligatoria'
			),

			'min_length' => array(
				'rule' => array('minLength', '6'),
				'message' => 'La Contraseña debe tener al menos 6 caracteres'
			),

			'max_length' => array(
				'rule' => array('maxLength', '30'),
				'message' => 'La Contraseña debe no puede tener mas de 30 caracteres'
			),

			'security_password' => array(
				'rule'    => array('securityPassword'),
				'message' => 'Debe tener al menos una letra mayuscula, una minuscula, y un número'
			)
		),

		'password_confirm_update' => array(

			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'Repita la Contraseña'
			),

			'equaltofield' => array(
				'rule' => array('equaltofield', 'password_update'),
				'message' => 'Ambas Contraseñas no coinciden'
			)
		)
	);


	public function alphaNumericDashUnderscore($check) {
		// $data array is passed using the form field name as the key
		// have to extract the value to make the function generic
		$value = array_values($check);
		$value = $value[0];

		// Regular expresion for numbers, letters, underscore and dash.
		return preg_match('/^[a-zA-Z0-9áéíóúÁÉÍÓÚÑñ_ \-]*$/', $value);
	}


	public function numericDash($check) {

		$value = array_values($check);
		$value = $value[0];

		//TODO: no testing
		return preg_match('/^[0-9 \-]*$/', $value);
	}


	// Password check: it must have at least one capital letter, one letter, one number, and length between 6 and 20 charaters.
	public function securityPassword($check) {
		
		$value = array_values($check);
		$value = $value[0];

		return preg_match('/(^(?=.*[a-z])(?=.*[A-Z])(?=.*\d){6,20}.+$)/', $value);
	}


	public function equaltofield($check, $otherfield) {
		 
		//get name of field
		$fieldName = '';
		
		foreach ($check as $key => $value) {
		
			$fieldName = $key;
			break;
		}

		return $this->data[$this->name][$otherfield] === $this->data[$this->name][$fieldName];
	}


	// Validate if password stored in database is equal than password entered in "old_password" field.
	public function check_old_password($check) {

		// get user information. This query  doesn't get password value, that's why the next line.
		$thisUserId = CakeSession::read('Auth.User.id');

	    $user = $this->find('first', array('conditions' => array('User.id' => $thisUserId)));

		$userHashStoredPassword =  $user['User']['password'];

		//get name of field (old password)
		$fieldName = '';

		foreach ($check as $key => $value) {
			$fieldName = $key;
			break;
		}

		// Check if old password in database is equal to old password entered.
		$userNewHashPassword = Security::hash($this->data[$this->name][$fieldName], 'blowfish', $userHashStoredPassword);

		return strcmp($userHashStoredPassword, $userNewHashPassword) === 0;
	}


	// Execute before saving user
	public function beforeSave($options = array()) {

		$passwordHasher = new BlowfishPasswordHasher();

		if (isset($this->data[$this->alias]['password'])) {

			$this->data[$this->alias]['password'] = $passwordHasher->hash($this->data[$this->alias]['password']);
		}

		if (isset($this->data[$this->alias]['password_update'])) {
			$this->data[$this->alias]['password'] = $passwordHasher->hash($this->data[$this->alias]['password_update']);
		}

		return parent::beforeSave($options);
	}
}

?>