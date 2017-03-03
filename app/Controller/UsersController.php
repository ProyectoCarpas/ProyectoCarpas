<?php
App::uses('AppController', 'Controller');

class UsersController extends AppController {

	public function beforeFilter() {

		parent:: beforeFilter();
		$this->Auth->allow('login', 'logout', 'addUser', 'activateUserAccount', 'forgetUserPassword', 'resetUserPassword', 'confirmationAndResendUserEmailActivation');
	}

	public function isAuthorized($user) {

		if( $this->Session->check('Auth.User') AND $this->Session->read('Auth.User.role_id') == Configure::read('General')) {

			if(in_array($this->action, array('viewUser', 'editUser', 'editUserPassword', 'deleteUser'))) {

				// If user entered his own ID.
				if(isset($this->request->params['pass'][0])) {

					if($user['id'] == $this->request->params['pass'][0]) {

						return true;
					}
				}
			}
		}

		if(isset($this->request->prefix) && ($this->request->prefix == 'administrator')) {

			if( $this->Session->check('Auth.User') AND $this->Session->read('Auth.User.role_id') == Configure::read('Administrador')) {

	    			return true;
			}
		}

		$this->redirect('/');
		return false;
	}


	public function login() {

		$this->set('title_for_layout', 'Carpas - Login');

		if($this->request->is('post')) {

			$this->User->recursive = -1;

			if(!($user = $this->User->findByemail($this->request->data['User']['email']))) {

				unset($this->request->data['User']['email']);
				unset($this->request->data['User']['password']);

				$this->Session->setFlash('Usuario inexistente', 'flash_error');
				return;
			}

			if(!$this->Auth->login()) {

				unset($this->request->data['User']['password']);

				$this->Session->setFlash('Contraseña incorrecta', 'flash_error');
				return;
			}

			$this->Session->setFlash('Usuario logueado', 'flash_success');
			return $this->redirect($this->Auth->redirectUrl());
		}
	}


	public function logout() {

		$this->Session->setFlash('Sesion finalizada', 'flash_success');
		return $this->redirect($this->Auth->logout());
	}

	//TODO: falla el add cundo salta una validacion del server, corrijo y vuevlo a apretar submit. Vuelve a abrir ADD
	public function addUser() {

		$this->set('title_for_layout', 'Nuevo Usuario');

		if ($this->request->is('post')) {

			$this->User->create();

			if(!$this->checkRequiredFieldsForm($this->request->data['User'], array('email', 'first_name', 'last_name', 'date_of_birth', 'cell_number', 'password', 'password_confirm'))) {

				throw new BadRequestException('Formulario Inválido');
			}

			$key = Security::hash(String::uuid(), 'sha512', true);
			$hash = sha1($this->request->data['User']['email'].rand(0, 100));

			$urlForActivation = Router::url( array('controller'=>'users', 'action'=>'activateUserAccount'), true ).'/'.$key.'#'.$hash;
			$urlForActivation = wordwrap($urlForActivation, 1000);

			$this->request->data['User']['token_hash'] = $key;

			// 'General' Rol by default
			$this->request->data['User']['role_id'] = Configure::read('General');

			$this->request->data['User']['status'] = 'Inactivo';

			$this->request->data['User']['id'] = String::uuid();

			if(!($this->User->save($this->request->data, true, array('id', 'email', 'first_name', 'last_name', 'date_of_birth', 'cell_number', 'status', 'password', 'token_hash', 'role_id')))) {

				$this->Session->setFlash('Hubo un error. No se pudo crear el Usuario', 'flash_error');
				return;
			}

            //============Email================//
			// SMTP Options. Configuration Email component.
			$this->Email->smtpOptions = array(
				'host' => 'ssl://smtp.gmail.com',
				'port' => 465,
				'timeout'=> '30',
				'username'=> 'el.viejo.martin.webmaster@gmail.com',
				'password'=> 'fedora1234',
				'transport' => 'Smtp'
			);

			$this->Email->template = 'activate_user_account_template';

			$this->Email->from = 'el.viejo.martin.webmaster@gmail.com';

			$this->Email->to = $this->request->data['User']['first_name'].'<'.$this->request->data['User']['email'].'>';

			$this->Email->subject = 'Activar Cuenta';

			$this->Email->sendAs = 'both';
			$this->Email->delivery = 'smtp';

			$this->set(compact('urlForActivation'));

			$this->Email->send();

			$this->Session->setFlash('Revise su correo para activar la cuenta', 'flash_success');

			// Save data in Session.
			$this->Session->write('userEmail', $this->request->data['User']['email']);
			$this->Session->write('urlForActivation', $urlForActivation);

			return $this->redirect(array('controller'=>'users', 'action'=>'confirmationAndResendUserEmailActivation'));

			//============EndEmail=============//
		}
	}


	public function confirmationAndResendUserEmailActivation($reSend = null) {

		// Read variables Session
		$urlForActivation = $this->Session->read('urlForActivation');
		$userEmail = $this->Session->read('userEmail');

		// If they session data was deleted, it means the account has been already activated.
		if(!$urlForActivation && !$userEmail) {

			$this->Session->setFlash('Su cuenta ya ha sido activada', 'flash_success');
			return $this->redirect('/');
		}

		if($reSend == 1) {

            //============Email================//
			// SMTP Options. Configuration Email component.
			$this->Email->smtpOptions = array(
				'host' => 'ssl://smtp.gmail.com',
				'port' => 465,
				'timeout'=> '30',
				'username'=> 'el.viejo.martin.webmaster@gmail.com',
				'password'=> 'fedora1234',
				'transport' => 'Smtp'
			);

			$this->Email->template = 'activate_user_account_template';

			$this->Email->from = 'el.viejo.martin.webmaster@gmail.com';

			$this->Email->to = 'Reenvio <'.$userEmail.'>';

			$this->Email->subject = ' Reenvio - Activar Cuenta';

			$this->Email->sendAs = 'both';
			$this->Email->delivery = 'smtp';

			$this->set(compact('urlForActivation'));

			$this->Email->send();

			$this->Session->setFlash('El email de confirmación ha sido reenviado', 'flash_success');

			//============EndEmail=============//
		}
	}


	public function activateUserAccount($token = null) {

		if(!$token) {

			throw new NotFoundException('Token Invalido');
		}

		$this->User->recursive = -1;

		if(!($user = $this->User->findBytoken_hash($token))) {

			$this->Session->setFlash('Clave corrumpida. La cuenta ya ha sido activada', 'flash_error');
			return $this->redirect('/');
		}

		$newHashToken = sha1($user['User']['email'].rand(0, 100));

		$this->User->id = $user['User']['id'];

		if($this->User->saveField('status', 'Activo') && $this->User->saveField('token_hash', $newHashToken)) {

			// If account changes status, we don't need session data anymore.
			$this->Session->delete('urlForActivation');
			$this->Session->delete('userEmail');

			$this->Session->setFlash('La cuenta ha sido activada', 'flash_success');
			return;
		}

		else {
			$this->Session->setFlash('No se pudo Activar la cuenta del usuario. Vuelva a intentar.', 'flash_error');
			return $this->redirect(array('controller'=>'users', 'action'=>'login'));
		}
	}


	public function viewUser($id = null) {

		$this->set('title_for_layout', 'Detalles Usuario');

		if (!($user = $this->User->findById($id))) {

			throw new NotFoundException('Usuario inexistente');
		}

		$this->set(compact('user'));
	}


	public function editUser($id = null) {

		$this->set('title_for_layout', 'Editar Usuario');

		if (!($user = $this->User->findById($id))) {

			throw new NotFoundException('Usuario inexistente');
		}

		if (!$this->request->data) {

			$this->request->data = $user;
		}

		if ($this->request->is('put', 'post')) {

			$this->request->data['User']['id'] = $id;

			if (!($this->User->save($this->request->data, true, array('id', 'email', 'first_name', 'last_name', 'date_of_birth', 'cell_number')))) {

				$this->Session->setFlash('Hubo un error y no se pudo modificar el Perfil','flash_error');
				return;
			}

			$this->Session->setFlash('Perfil modificado exitosamente', 'flash_success');
			return $this->redirect(array('controller'=>'users', 'action' => 'viewUser', $id));
		}
	}


	public function editUserPassword($id = null) {

		$this->set('title_for_layout', 'Editar Contraseña');

		if (!($user = $this->User->findById($id))) {

			throw new NotFoundException('Usuario inexistente');
		}

		if (!$this->request->data) {

			$this->request->data = $user;
		}

		if ($this->request->is('put', 'post')) {

			$this->User->set($this->request->data);

			// Check validations for 'password_update' and 'confirm_password_update' fields.
			if ($this->User->validates()) {

				$this->request->data['User']['id'] = $id;

				if (!($this->User->save($this->request->data, true, array('id', 'password')))) {

					$this->Session->setFlash('Hubo un error y no se pudo editar la contraseña', 'flash_error');
					return;
				}

				$this->Session->setFlash('Contraseña modificada exitosamente', 'flash_success');
				return $this->redirect(array('controller'=>'users', 'action'=>'viewUser', $id));
			}

			else{
				$this->Session->setFlash('Corrija los campos incorrectos', 'flash_error');
				return;
			}
		}
	}


	public function forgetUserPassword() {

		$this->set('title_for_layout', 'Resetear Pass');

		if ($this->request->is('post')) {

			if(!($this->request->data['User']['email'])) {

				$this->Session->setFlash('Ingrese su Email', 'flash_error');
				return;
			}

			$this->User->recursive = -1;

			if(!($user = $this->User->findByemail($this->request->data['User']['email']))) {

				$this->Session->setFlash('El email ingresado es inexistente', 'flash_error');
				return;
			}

			$key = Security::hash(String::uuid(), 'sha512', true);
			$hash = sha1($user['User']['email'].rand(0, 100));

			$urlForActivation = Router::url( array('controller'=>'users', 'action'=>'resetUserPassword'), true ).'/'.$key.'#'.$hash;
			$urlForActivation = wordwrap($urlForActivation, 1000);

			$user['User']['token_hash'] = $key;

			$this->User->id = $user['User']['id'];

			if(!($this->User->saveField('token_hash', $user['User']['token_hash']))) {

				$this->Session->setFlash('Error generando el Link de reseteo. Intente mas tarde.', 'flash_error');
				return $this->redirect('/');
			}

		 	//============Email================//
			/* SMTP Options */
			$this->Email->smtpOptions = array(
				'host' => 'ssl://smtp.gmail.com',
				'port' => 465,
				'timeout'=>'30',
				'username'=>'el.viejo.martin.webmaster@gmail.com',
				'password'=>'fedora1234',
				'transport' => 'Smtp'
			);

			$this->Email->template = 'reset_user_password_template';
			$this->Email->from = 'el.viejo.martin.webmaster@gmail.com';

			$this->Email->to = $user['User']['first_name'].'<'.$user['User']['email'].'>';

			$this->Email->subject = 'Reseteo Contraseña';
			$this->Email->sendAs = 'both';

			$this->Email->delivery = 'smtp';

			$this->set(compact('urlForActivation'));

			$this->Email->send();

			$this->set('smtp_errors', $this->Email->smtpError);

			$this->Session->setFlash('Revise su correo para resetear su contraseña', 'flash_success');
			return $this->redirect('/');

			//============EndEmail=============//
		}
	}


	public function resetUserPassword($token = null) {

		$this->set('title_for_layout', 'Recuperar Pass');

		$this->User->recursive = -1;

		if(!$token) {
			throw new NotFoundException('Token invalido');
		}

		if(!($user = $this->User->findBytoken_hash($token))) {
			$this->Session->setFlash('Clave corrumpida. Por favor vuelva a resetear su contraseña. El link de reseteo solo funciona una vez', 'flash_error');
			return $this->redirect('/');
		}

		if($this->request->is('post')) {

			$this->User->id = $user['User']['id'];

			$this->User->data = $this->request->data;

			if(!($this->User->validates(array('fieldList'=>array('password', 'password_confirm'))))) {

				unset($this->request->data['User']['password']);
				unset($this->request->data['User']['password_confirm']);

				$this->Session->setFlash('Corrija los campos incorrectos', 'flash_error');
				return;
			}

			$newHashToken = sha1($user['User']['email'].rand(0, 100));

			$this->User->data['User']['token_hash'] = $newHashToken;

			if($this->User->save($this->User->data, true, array('password', 'token_hash'))) {

				$this->Session->setFlash('Contraseña actualizada exitosamente', 'flash_success');
				return $this->redirect(array('controller'=>'users', 'action'=>'login'));
			}
		}
	}


    public function deleteUser($id = null) {

		if (!($user = $this->User->findById($id))) {

			throw new NotFoundException('Usuario inexistente');
		}

		$this->User->id = $id;

		if ($this->User->delete($id, true)) {

			$this->Session->destroy('User');
			$this->Session->setFlash('Su cuenta ha sido eliminada', 'flash_success');
			return $this->redirect('/');
		}
		else {

			$this->Session->setFlash('No se pudo cambiar el Estado del Usuario. Intente mas tarde.', 'flash_error');
			return $this->redirect('/');
		}
    }

    /////////////////////////// ACTIONS FOR ADMINISTRATORS ONLY /////////////////////////////////////////

    // prefix ADMINISTRATOR

    // value = 0 when entering to searchUser for first time.
    // value = 1 when sorting column or paging user grid.
    public function administrator_searchUsers($value = null) {

    	$this->set('title_for_layout', 'Buscar Usuarios');

    	// set dropdowns
		$this->set('roles', $this->User->Role->find('list', array('fields' => array('id', 'name'))));
		$this->set('statues', $this->User->enum['status']);

		// Clean SESSION DATA and User grid.
		if($value == 0) {

			$this->Session->delete('conditionEmail');
			$this->Session->delete('conditionFullName');
			$this->Session->delete('conditionStatues');
			$this->Session->delete('conditionRoleId');

			$hasSearch = false;

			$this->set(compact('hasSearch'));

			// avoid users query.
			return;
		}

		// Post request
		if($this->request->is('post')) {

			if ($this->request->data['User']['email'] != "") {

                    $conditionEmail = array('User.email LIKE' => "%" . $this->request->data['User']['email'] . "%");
                    $this->Session->write('conditionEmail', $conditionEmail);
            }
            else {
            	 $this->Session->write('conditionEmail', "true");
            }

            if ($this->request->data['User']['full_name'] != "") {

                    $conditionFullName = array("OR" => array('User.first_name LIKE' => "%" . $this->request->data['User']['full_name'] . "%",
                    					         	         'User.last_name LIKE' =>  "%" . $this->request->data['User']['full_name'] . "%"
                    					         	         )
					);
                    $this->Session->write('conditionFullName', $conditionFullName);
            }
            else {
            	 $this->Session->write('conditionFullName', "true");
            }

			if ($this->request->data['User']['statues'] != "") {

                    $conditionStatues = array('User.status' => $this->request->data['User']['statues']);
                    $this->Session->write('conditionStatues', $conditionStatues);
            }
            else {
            	 $this->Session->write('conditionStatues', "true");
            }

            if ($this->request->data['User']['role_id'] != "") {

                    $conditionRoleId = array('User.role_id' => $this->request->data['User']['role_id']);
                    $this->Session->write('conditionRoleId', $conditionRoleId);
            }
            else {
            	 $this->Session->write('conditionRoleId', "true");
            }
		}

		// Filters are used to fill inputs when is not a POST request.
		$conditionEmail    = $this->Session->read('conditionEmail');
		$conditionFullName = $this->Session->read('conditionFullName');
		$conditionStatues  = $this->Session->read('conditionStatues');
		$conditionRoleId   = $this->Session->read('conditionRoleId');

		// Not POST request.
		// load filters in inputs when is not a POST request.
		if (!$this->request->data) {

			if(isset($conditionEmail) && $conditionEmail != "true") {
				 $this->request->data['User']['email'] = substr(reset($conditionEmail), 1, -1);
			}

			if(isset($conditionFullName) && $conditionFullName != "true") {
				 $this->request->data['User']['full_name'] = substr($conditionFullName['OR']['User.first_name LIKE'], 1, -1);
			}

			if(isset($conditionStatues) && $conditionStatues != "true") {
				 $this->request->data['User']['statues'] = $conditionStatues;
			}

			if(isset($conditionRoleId) && $conditionRoleId != "true") {
				 $this->request->data['User']['role_id'] = $conditionRoleId;
			}
		}

		// query needed for any case: POST request (searching users) and when is not POST (persist users grid
		// when sort column or paging).
		$this->paginate = array(
								'limit' => 3,
								'conditions' => array($conditionEmail, $conditionFullName, $conditionStatues, $conditionRoleId)
		);

        $users = $this->paginate();

        $hasSearch = true;

        $this->set(compact('users', 'hasSearch'));
	}


	public function administrator_viewUser($id = null) {

		$this->set('title_for_layout', 'Detalles Usuario');

		if (!($user = $this->User->findById($id))) {

			throw new NotFoundException('Usuario inexistente');
		}

		$this->set(compact('user'));
	}


    public function administrator_changeUserAccoutStatus($id = null) {

		if (!($user = $this->User->findById($id))) {

			throw new NotFoundException('Usuario inexistente');
		}

		if($user['User']['status'] != 'Activo' && $user['User']['status'] != 'Inactivo') {
			
			throw new NotFoundException('Estado del Usuario nulo o desconocido');
		}

		$this->User->id = $id;

		if ($user['User']['status'] == 'Activo') {

			if ($this->User->saveField('status', 'Inactivo')) {

				$this->Session->setFlash(__('La cuenta del usuario %s ha sido desactivada', h($user['User']['email'])), 'flash_success');
			}
			else {
				$this->Session->setFlash(__('No se pudo desactivar la cuenta del usuario $s', h($user['User']['email'])), 'flash_error');
			}
		}

		if ($user['User']['status'] == 'Inactivo') {

			if ($this->User->saveField('status', 'Activo')) {

				$this->Session->setFlash(__('La cuenta del usuario %s ha sido activada', h($user['User']['email'])), 'flash_success');
			}
			else {
				$this->Session->setFlash(__('No se pudo activar la cuenta del usuario $s', h($user['User']['email'])), 'flash_error');
			}
		}

		return $this->redirect(array('administrador' => true, 'controller'=>'users', 'action' => 'searchUsers', 1));
    }


    public function administrator_deleteUser($id = null) {

    	if (!($user = $this->User->findById($id))) {

			throw new NotFoundException('Usuario inexistente');
		}

		$this->User->id = $id;

		if ($this->User->delete($id, true)) {

			$this->Session->setFlash(__('La cuenta del usuario %s ha sido eliminada', h($user['User']['email'])), 'flash_success');
		}
		else {
			$this->Session->setFlash(__('No se pudo eliminar el usuario %s', h($user['User']['email'])), 'flash_error');
		}

		return $this->redirect(array('administrador' => true, 'controller'=>'users', 'action' => 'searchUsers', 1));
    }
}
?>