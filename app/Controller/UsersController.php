<?php
App::uses('AppController', 'Controller');

class UsersController extends AppController {

	public function beforeFilter() {

		parent:: beforeFilter();
		$this->Auth->allow('login','logout','addUser'/*, 'resendConfirmationEmail', 'forgetPassword','resetPassword' */);
	}

	public function isAuthorized($user){

		if(in_array($this->action, array('viewUser','editUser','editPasswordUser','changeAccoutStatus'))){

			// User trying to type his own ID.
			if(isset($this->request->params['pass'][0])){

				if($user['id'] == $this->request->params['pass'][0]){

					return true;
				}
			}
		}

		// if(in_array($this->action, array('administrator_check'))){

		// 	if($this->Session->check('Auth.User') AND $this->Session->read('Auth.User.role') == 'admin' ){

		// 		return true;
		// 	}
		// }

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

			if($user['User']['status'] !== 'Active'){

				$this->Session->setFlash('Su cuenta ha sido eliminada. Comuniquese con el administrador.','flash_error');
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

			$key = Security::hash(String::uuid(),'sha512',true);


			// $hash=sha1($this->request->data['User']['email'].rand(0,100));

			// $url = Router::url( array('controller'=>'users','action'=>'activateAccount'), true ).'/'.$key.'#'.$hash;

			// $ms=$url;

			// $ms=wordwrap($ms,1000);

			$this->request->data['User']['token_hash'] = $key;

			$this->request->data['User']['role_id'] = Configure::read('general_Rol_User');

			// TODO: change to INACTIVE when email sending is ready
			// $this->request->data['User']['status'] = 'Inactive';

			$this->request->data['User']['status'] = 'Active';

			if ($this->User->save($this->data)) {

		            //============Email================//
					// SMTP Options. Configuramos nuestro MAIL con la compoennte EMAIL que habilitamos en el
					//AppController.
				// $this->Email->smtpOptions = array(
				// 	'host' => 'ssl://smtp.gmail.com',
				// 	'port' => 465,
				// 	'timeout'=>'30',
				// 	'username'=>'dracomex@gmail.com',
				// 	'password'=>'fedorafedora',
				// 	'transport' => 'Smtp'
				// 	);

					// PARTE IMPORTANTE:
					//Aca en "template" lo que hacemos es decir que el archivo View/Email/html/activar_cuenta.ctp
					// contiene el CUERPO del email.
				// $this->Email->template = 'activar_cuenta';

					// De donde se envia. Tiene que ser GMAIL.
				// $this->Email->from    = 'dracomex@gmail.com';

					// A donde se envia con encabezado del nombre del USER.
				// $this->Email->to      = $this->request->data['User']['username'].'<'.$this->request->data['User']['email'].'>';

					// Titulo del MAIL
				// $this->Email->subject = 'Activar Cuenta - Info Parana';

					// Configuracion de MAIL
				// $this->Email->sendAs = 'both';
				// $this->Email->delivery = 'smtp';

					// Enviamos la variable al cuerpo del MAIL "View/Email/html/resetpw.ctp"
				// $this->set('ms', $ms);

					// Enviamos el MAIL
				// $this->Email->send();

					// Una vez enviado, mostramos el mensaje flash y redirigimos a la RAIZ.
				$this->Session->setFlash('Revise su correo para activar la cuenta','flash_success');
				$this->redirect(array('controller'=>'users','action'=>'login'));

					//============EndEmail=============//
			}

			else {
				$this->Session->setFlash('Hubo un error. No se pudo crear el Usuario', 'flash_error');
			}
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

		if ($this->request->is('put','post')) {

			if (!($this->User->save($this->request->data))) {

				$this->Session->setFlash('Hubo un error y no se pudo modificar el Perfil','flash_error');
				return;
			}

			$this->Session->setFlash('Perfil modificado exitosamente','flash_success');
			return $this->redirect(array('controller'=>'users', 'action' => 'viewUser', $id));
		}

		if (!$this->request->data) {

			$this->request->data = $user;
		}
	}


	public function editPasswordUser($id = null){

		$this->set('title_for_layout', 'Editar Contraseña');

		// Condition needed for blowfih encrypt
		if(!($user = $this->User->find('first', array('conditions' => array('User.id' => AuthComponent::user('id')))))){

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

	public function changeAccoutStatus($id = null){

		if (!($user = $this->User->findById($id))) {

			throw new NotFoundException('Usuario inexistente');
		}

		if(($id === $this->Session->read('Auth.User.id')) && ($user['User']['status'] === 'Active')){

			$this->User->id = $id;

			if ($this->User->saveField('status', 'Inactive')){

				$this->Session->destroy('User');
				$this->Session->setFlash('Su cuenta ha sido eliminada', 'flash_success');
				return $this->redirect('/');
			}
			else{

				$this->Session->setFlash('No se pudo cambiar el Estado del Usuario. Intente mas tarde.', 'flash_error');
				return $this->redirect('/');
			}
      	}
    }

	///////////////////////////////////

	// 	// Recibe el token por parametro
	// public function activateAccount($token=null) {

	// 	$this->User->recursive = -1;

	// 	if(!empty($token)){

	// 			// Buscamos en la base el USER con este TOKEN.
	// 		$usuario = $this->User->findBytokenhash($token);

	// 			// Si existe un user con este token, entonces procedemos.
	// 		if($usuario){

	// 				// creamos un nuevo TOKEN aleatorio
	// 			$new_hash = sha1($usuario['User']['username'].rand(0,100));

	// 				// Me paro sobre el User
	// 			$this->User->id = $usuario['User']['id'];


	// 				// Actualizo los campos STATUS y el TOKENHASH
	// 			if($this->User->saveField('status', 'Activo') && $this->User->saveField('tokenhash', $new_hash)){

	// 				$this->Session->setFlash('La cuenta ha sido activada', 'flash_success');
	// 			}

	// 			else{
	// 				$this->Session->setFlash('No se pudo Activar el usuario. Vuelva a intentar','flash_error');
	// 				$this->redirect(array('controller'=>'users', 'action'=>'login'));
	// 			}
	// 		}

	// 		else{
	// 			$this->Session->setFlash('Clave corrumpida.  La cuenta ya ha sido activada','flash_error');
	// 			$this->redirect('/');
	// 		}
	// 	}

	// 	else{
	// 		$this->redirect('/');
	// 	}
	// }



	// 	//////////////////////////////


	// 	function forgetPassword(){

	// 		$this->set('title_for_layout', 'Resetear Pass - Info Parana. Articulos de Informatica');

	// 		$this->User->recursive= -1;

	// 		if(!empty($this->data)){

	// 			if(empty($this->data['User']['email'])){

	// 				$this->Session->setFlash('Ingrese su Email','flash_error');
	// 			}
	// 			else{

	// 				$email = $this->data['User']['email'];

	// 				$fu=$this->User->find('first',array('conditions'=>array('User.email'=>$email)));

	// 				if($fu){

	// 					$key = Security::hash(String::uuid(),'sha512',true);

	// 					$hash=sha1($fu['User']['username'].rand(0,100));

	// 					$url = Router::url( array('controller'=>'users','action'=>'resetPassword'), true ).'/'.$key.'#'.$hash;

	// 					$ms=$url;

	// 					$ms=wordwrap($ms,1000);

	// 					$fu['User']['tokenhash']=$key;

	// 					$this->User->id=$fu['User']['id'];

	// 					if($this->User->saveField('tokenhash',$fu['User']['tokenhash'])){

	// 							 //============Email================//
	// 						/* SMTP Options */
	// 						$this->Email->smtpOptions = array(
	// 							'host' => 'ssl://smtp.gmail.com',
	// 							'port' => 465,
	// 							'timeout'=>'30',
	// 							'username'=>'dracomex@gmail.com',
	// 							'password'=>'fedorafedora',
	// 							'transport' => 'Smtp'
	// 							);
	// 						$this->Email->template = 'resetpw';
	// 						$this->Email->from    = 'dracomex@gmail.com';

	// 						$this->Email->to      = $fu['User']['nombre'].'<'.$fu['User']['email'].'>';

	// 						$this->Email->subject = 'Reseteo Contraseña - Info Parana';
	// 						$this->Email->sendAs = 'both';

	// 						$this->Email->delivery = 'smtp';
	// 						$this->set('ms', $ms);
	// 						$this->Email->send();
	// 						$this->set('smtp_errors', $this->Email->smtpError);
	// 						$this->Session->setFlash('Revise su correo para resetear su contraseña', 'flash_success');
	// 						$this->redirect('/');

	// 							 //============EndEmail=============//
	// 					}
	// 					else{
	// 						$this->Session->setFlash('Error generando el Link de reseteo','flash_error');
	// 					}

	// 				}
	// 				else{
	// 					$this->Session->setFlash('La direccion de correo electronico no existe','flash_error');
	// 				}
	// 			}
	// 		}
	// 	} // fin forgotpassword


	// 	/////////////////////////////////////


	// 	public function resetPassword($token=null){

	// 		$this->set('title_for_layout', 'Recuperar Pass - Info Parana. Articulos de Informatica');

	// 		$this->User->recursive=-1;

	// 		if(!empty($token)){

	// 			$u=$this->User->findBytokenhash($token);

	// 			if($u){
	// 				$this->User->id=$u['User']['id'];

	// 				if(!empty($this->data)){

	// 					$this->User->data=$this->data;
	// 					$this->User->data['User']['username']=$u['User']['username'];
	// 					$new_hash=sha1($u['User']['username'].rand(0,100));//created token
	// 					$this->User->data['User']['tokenhash']=$new_hash;

	// 					if($this->User->validates(array('fieldList'=>array('password','password_confirm')))){
	// 						if($this->User->save($this->User->data))
	// 						{
	// 							$this->Session->setFlash('Contraseña actualizada','flash_success');
	// 							$this->redirect(array('controller'=>'users','action'=>'login'));
	// 						}

	// 					}
	// 					else{

	// 						$this->Session->setFlash('Se produjo un error. Vuelva a intenta.','flash_error');
	// 					}
	// 				}
	// 			}
	// 			else
	// 			{
	// 				$this->Session->setFlash('Clave corrumpida. Por favor vuelva a resetear su contraseña. El link de reseteo solo funciona una vez','flash_error');
	// 				// Me redirecciona a la RAIZ.
	// 				$this->redirect('/');
	// 			}
	// 		}

	// 		else{
	// 			$this->redirect('/');
	// 		}
	// 	}


	} //fin controller
	?>