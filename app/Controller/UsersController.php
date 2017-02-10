<?php
App::uses('AppController', 'Controller');

class UsersController extends AppController {

	public function beforeFilter() {

		parent:: beforeFilter();
		$this->Auth->allow('login','logout','addUser', 'activateUserAccount', 'forgetUserPassword', 'resetUserPassword'  /*, 'resendUserConfirmationEmail', */);
	}

	public function isAuthorized($user){

		if(in_array($this->action, array('viewUser','editUser','editPasswordUser','deleteUser'))){

			// User trying to type his own ID.
			if(isset($this->request->params['pass'][0])){

				if($user['id'] == $this->request->params['pass'][0]){

					return true;
				}
			}
		}

		if(in_array($this->action, array('administrator_changeUserAccoutStatus', 'administrator_deleteUser' /*, administratro_searchUser'*/))){

			if($this->Session->check('Auth.User') AND $this->Session->read('Auth.User.role_id') == Configure::read('administrator_rol_user')){

				return true;
			}
		}

		$this->redirect('/');
		return false;
	}



	public function login(){

		$this->set('title_for_layout', 'Carpas - Login');
		$this->User->recursive = -1;

		if ($this->request->is('post')) {

			if(!($user = $this->User->findByemail($this->request->data['User']['email']))){

				unset($this->request->data['User']['email']);
				unset($this->request->data['User']['password']);
				$this->Session->setFlash('Usuario inexistente','flash_error');
				return;
			}

			

			if(!$this->Auth->login()) {

				unset($this->request->data['User']['password']);
				$this->Session->setFlash('Contraseña incorrecta','flash_error');
				return;
			}

			$this->Session->setFlash('Usuario logueado','flash_success');
			$this->redirect($this->Auth->redirectUrl());
		}
	}


	public function logout(){

		$this->Session->setFlash('Sesion finalizada','flash_success');
		$this->redirect($this->Auth->logout());
	}


	public function addUser(){

		$this->set('title_for_layout', 'Nuevo Usuario');

		if ($this->request->is('post')) {

			$this->User->create();

			$key = Security::hash(String::uuid(), 'sha512', true);
			$hash = sha1($this->request->data['User']['email'].rand(0,100));
			$url = Router::url( array('controller'=>'users', 'action'=>'activateUserAccount'), true ).'/'.$key.'#'.$hash;
			$ms = $url;
			$ms = wordwrap($ms, 1000);

			$this->request->data['User']['token_hash'] = $key;

			// General user rol by default
			$this->request->data['User']['role_id'] = Configure::read('general_rol_user');

			$this->request->data['User']['status'] = 'Inactive';

			if(!($this->User->save($this->request->data))) {

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

			$this->set('ms', $ms);

			$this->Email->send();

			$this->Session->setFlash('Revise su correo para activar la cuenta','flash_success');
			return $this->redirect(array('controller'=>'users','action'=>'login'));

			//============EndEmail=============//
		}
	}

	public function activateUserAccount($token = null) {

		if(!$token){

			throw new NotFoundException('Token Invalido');
		}

		$this->User->recursive = -1;

		if(!($user = $this->User->findBytokenhash($token))){

			$this->Session->setFlash('Clave corrumpida. La cuenta ya ha sido activada','flash_error');
			return $this->redirect('/');
		}

		$new_hash = sha1($user['User']['email'].rand(0,100));

		$this->User->id = $user['User']['id'];

		if($this->User->saveField('status', 'Active') && $this->User->saveField('token_hash', $new_hash)){

			$this->Session->setFlash('La cuenta ha sido activada', 'flash_success');
			return;
		}

		else{
			$this->Session->setFlash('No se pudo Activar la cuenta del usuario. Vuelva a intentar.','flash_error');
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

		if ($this->request->is('put','post')) {

			$this->request->data['User']['id'] = $id;

			if (!($this->User->save($this->request->data))) {

				$this->Session->setFlash('Hubo un error y no se pudo modificar el Perfil','flash_error');
				return;
			}

			$this->Session->setFlash('Perfil modificado exitosamente','flash_success');
			return $this->redirect(array('controller'=>'users', 'action' => 'viewUser', $id));
		}
	}


	public function editPasswordUser($id = null){

		$this->set('title_for_layout', 'Editar Contraseña');

		if (!($user = $this->User->findById($id))) {

			throw new NotFoundException('Usuario inexistente');
		}

		if (!$this->request->data) {

			$this->request->data = $user;
		}

		if ($this->request->is('put','post')) {

			// User old password.
			$storedHash = $user['User']['password'];

			$this->User->set($this->request->data);

			// Check validations for password_update and confirm_password_update fields.
			if ($this->User->validates()) {

				// Check if old password in database is equal to old password entered.
				$newHash = Security::hash($this->request->data['User']['old_password'], 'blowfish', $storedHash);

				// old passwords different
				if(strcmp($storedHash, $newHash) != 0){

					$this->Session->setFlash('Su contraseña vieja no es correcta','flash_error');
					return;
				}

				if (!($this->User->save($this->request->data))){

					$this->Session->setFlash('Hubo un error y no se pudo editar la contraseña','flash_error');
					return;
				}

				$this->Session->setFlash('Contraseña modificada','flash_success');
				return $this->redirect('/');
			}
		}
	}

	// quizas no va el PUBLIC, probar ????????????????????????????????????????????????????????????????????????????''
	public function forgetUserPassword(){

		$this->set('title_for_layout', 'Resetear Pass');

		if ($this->request->is('post')) {

			if(!($this->request->data['User']['email'])){

				$this->Session->setFlash('Ingrese su Email','flash_error');
				return;
			}

			$this->User->recursive = -1;

			if(!($user = $this->User->findByemail($this->request->data['User']['email']))){

				$this->Session->setFlash('El email ingresado es inexistente','flash_error');
				return;
			}

			$key = Security::hash(String::uuid(),'sha512',true);
			$hash = sha1($user['User']['email'].rand(0,100));
			$url = Router::url( array('controller'=>'users','action'=>'resetUserPassword'), true ).'/'.$key.'#'.$hash;

			$ms = $url;
			$ms = wordwrap($ms,1000);

			$user['User']['token_hash'] = $key;

			$this->User->id = $user['User']['id'];

			if(!($this->User->saveField('token_hash',$user['User']['token_hash']))){

				$this->Session->setFlash('Error generando el Link de reseteo. Intente mas tarde.','flash_error');
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

			$this->set('ms', $ms);
			$this->Email->send();

			$this->set('smtp_errors', $this->Email->smtpError);
			$this->Session->setFlash('Revise su correo para resetear su contraseña', 'flash_success');
			$this->redirect('/');

			//============EndEmail=============//
		}
	}


	public function resetUserPassword($token = null){

		$this->set('title_for_layout', 'Recuperar Pass');

		$this->User->recursive = -1;

		if(!$token){
			throw new NotFoundException('Token invalido');
		}

		if(!($user = $this->User->findBytokenhash($token))){
			$this->Session->setFlash('Clave corrumpida. Por favor vuelva a resetear su contraseña. El link de reseteo solo funciona una vez','flash_error');
			return $this->redirect('/');
		}

		$this->User->id = $user['User']['id'];

		$this->User->data['User']['email'] = $user['User']['email'];

		$new_hash = sha1($user['User']['email'].rand(0,100)); //created new token

		$this->User->data['User']['tokenhash'] = $new_hash;

		if($this->User->validates(array('fieldList'=>array('password','password_confirm')))){

			if($this->User->save($this->User->data))
			{
				$this->Session->setFlash('Contraseña actualizada','flash_success');
				return $this->redirect(array('controller'=>'users','action'=>'login'));
			}
		}
	}


    public function deleteUser($id = null){

		if (!($user = $this->User->findById($id))) {

			throw new NotFoundException('Usuario inexistente');
		}

		$this->User->id = $id;

		if ($this->User->delete($id, true)){

			$this->Session->destroy('User');
			$this->Session->setFlash('Su cuenta ha sido eliminada', 'flash_success');
			return $this->redirect('/');
		}
		else{

			$this->Session->setFlash('No se pudo cambiar el Estado del Usuario. Intente mas tarde.', 'flash_error');
			return $this->redirect('/');
		}
    }

    ///////////////////////////   ACTIONS ONLY FOR ADMINISTRATORS /////////////////////////////////////////

    // prefix ADMINISTRATOR
    public function administrator_changeUserAccoutStatus($id = null){

		if (!($user = $this->User->findById($id))) {

			throw new NotFoundException('Usuario inexistente');
		}

		$this->User->id = $id;

		if ($this->User->saveField('status', 'Inactive')){

			$this->Session->setFlash('La cuenta del usuario %s ha sido desactivada', h($user['User']['email']), 'flash_success');
					}
		else{
			$this->Session->setFlash('No se pudo cambiar el estado de la cuenta de  $s', h($user['User']['email']), 'flash_error');
			
		}

		return $this->redirect('/');
    }


    public function administrator_deleteUser($id = null){

    	if (!($user = $this->User->findById($id))) {

			throw new NotFoundException('Usuario inexistente');
		}

		$this->User->id = $id;

		if (!($this->User->delete($id, true))){

			$this->Session->setFlash('No se pudo eliminar el Usuario. Intente mas tarde.', 'flash_error');
			return $this->redirect('/');
		}

		// Trying to delete his own administration account.
		if($id == $this->Session->read('Auth.User.id')){
			$this->Session->destroy('User');
		}

		$this->Session->setFlash('La cuenta de usuario ha sido eliminada', 'flash_success');
		return $this->redirect('/');
    }
}
?>