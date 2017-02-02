<?php
App::uses('AppController', 'Controller');

class UsersController extends AppController {

	public function beforeFilter() {

		parent:: beforeFilter();
		$this->Auth->allow('login','logout','addUser'/*, 'resendConfirmationEmail', 'forgetPassword','resetPassword', 'activateAccout'*/);
	}

	// public function isAuthorized($user){

	// 	if(in_array($this->action, array('view', 'delete', 'edit', 'editPassword'))){

	// 		if(isset($this->request->params['pass'][0])){

	// 			if($user['id'] == $this->request->params['pass'][0]){

	// 				return true;
	// 			}
	// 		}
	// 	}

	// 	if(in_array($this->action, array('administrator_check'))){

	// 		if($this->Session->check('Auth.User') AND $this->Session->read('Auth.User.role') == 'admin' ){

	// 			return true;
	// 		}
	// 	}

	// 	$this->redirect('/');
	// 	return false;
	// }


	// public function index() {


	// }


	public function login(){

		$this->set('title_for_layout', 'Carpas - Login');

		$this->User->recursive = -1;

 			//TODO: REFACTOR!!!!!!!!!!!!!!!
		if ($this->request->is('post')) {

			$user = $this->User->findByemail($this->request->data['User']['email']);

				//TODO: REFACTOR - Only one IF for both!!!!!!!!!!!!!!!
			if($user){

				if ($this->Auth->login()) {

					$this->Session->setFlash('Usuario logueado','flash_success');
					$this->redirect($this->Auth->redirectUrl());
				}
				else {
					unset($this->request->data['User']['password']);
					$this->Session->setFlash('Contraseña incorrecta','flash_error');
				}
			}
			else{
				unset($this->request->data['User']['password']);
				$this->Session->setFlash('Usuario inexistente','flash_error');
			}
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

			$this->request->data['User']['role_id'] = Configure::read('general_user');

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
				$this->Session->setFlash('Revise su correo para activar la cuenta');
				$this->redirect(array('controller'=>'users','action'=>'login'));

					//============EndEmail=============//
			}

			else {
				$this->Session->setFlash('Hubo un error. No se pudo crear el Usuario');
			}
		}
	}

	// 	//////////////////////////////

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


	// public function view($id = null) {

	// 	$this->set('title_for_layout', 'Detalles Usuario - Info Parana. Articulos de Informatica');

	// 	if (!$id) {
	// 		$this->Session->setFlash('Debe proporcionar un ID valido','flash_error');
	// 		$this->redirect('/');
	// 	}

	// 	$user = $this->User->findById($id);

	// 	if($user){

	// 		$this->set('user', $user);
	// 	}

	// 	else{
	// 		$this->Session->setFlash('El ID del Usuario no existe', 'flash_error');
	// 		$this->redirect('/');
	// 	}
	// }


	// public function edit($id = null) {

	// 	$this->set('title_for_layout', 'Editar Usuario - Info Parana. Articulos de Informatica');

	// 	if (!$id) {
	// 		$this->Session->setFlash('Debe proporcionar un ID valido','flash_error');
	// 		$this->redirect('/');
	// 	}

	// 	$user = $this->User->findById($id);

	// 	/* Verifico que exista el usuario*/
	// 	if(!$user){

	// 		$this->Session->setFlash('El ID del usuario no existe', 'flash_error');
	// 		$this->redirect('/');
	// 	}

	// 		// Existe e l usuario, por lo tanto continuo
	// 	else{

	// 			// LLevo la lista de localidades a la vista
	// 		$this->loadModel('Localidade');
	// 		$this->Localidade->recursive = -1;

	// 		$this->set('localidades', $this->Localidade->find('list', array('fields' => array('id', 'nombre'),
	// 			'order' => array('Localidade.nombre ASC')
	// 			)
	// 		));

	// 			/////////////////////////////////////////////

	// 		if ($this->request->is('put','post')) {

	// 					// Por el HIDDEN "id" en la view, sabe en que usuario debe sobrescribir en la base de datos.
	// 			if ($this->User->save($this->request->data)) {

	// 				$this->Session->setFlash('Perfil modificado','flash_success');

	// 				$this->redirect(array('controller'=>'users', 'action' => 'view', $id));

	// 			}
	// 			else{
	// 				$this->Session->setFlash('Hubo un error y no se pudo modificar el Perfil','flash_error');
	// 			}
	// 		}

	// 			/////////////////////////////////////////////

	// 			// Completamos con los datos del usuario en el formulario.
	// 		if (!$this->request->data) {

	// 			$this->request->data = $user;

	// 		}
	// 	}


	// 	} // fin funcion edit


	// 	//////////////////////////////


		

	// 	// Cuando editamos la contraseña, solicitamos la contraseña vieja-
	// 	public function editPassword($id = null){

	// 		$this->set('title_for_layout', 'Editar Contraseña - Info Parana. Articulos de Informatica');

	// 		if (!$id) {
	// 			$this->Session->setFlash('Debe proporcionar un ID valido','flash_error');
	// 			$this->redirect('/');
	// 		}


	// 		$this->User->id = $id;

	// 		if (!$this->User->exists()) {
	// 			$this->Session->setFlash('ID inválido', 'flash_error');
	// 			$this->redirect('/');
	// 		}


	// 		if (!$this->request->data) {

 //    			// para que sepa de que usuario hablamos
	// 			$this->request->data = $this->User->read();
	// 		}

 //    		// Necesario esta condicion debido al Blowfish
	// 		$user = $this->User->find('first', array(
	// 			'conditions' => array(
	// 				'User.id' => AuthComponent::user('id')
	// 				),
	// 			'fields' => array('password')
	// 			));

 //    		// Aca tenemos almacenado el password del Usuario.
	// 		$storedHash = $user['User']['password'];


	// 		///////////////////////////////

	// 		if ($this->request->is('put','post')) {

	// 			// Necesario para que funcione el "validate" siguiente.
	// 			$this->User->set($this->request->data);

	// 			// Valido  los campos de password_update y confirm_password_update. Si pasaron la validacion, entonces verifico
	// 			// que la contraseña vieja sea correcta.
	// 			if ($this->User->validates()) {

	// 				// Leemos el passowrd viejo ingresado para ver si coincide con el de la base de datos. Es necesario
	// 				// esto raro debido a que el blowish encripta de una forma distinta de los demas.
	// 				$newHash = Security::hash($this->request->data['User']['old_password'], 'blowfish', $storedHash);

	// 				// Si la contraseña Vieja ingresasa coincide con la almacenada en la base de datos,
	// 				//es decir, 'strcmp' devuelve 0 si ambos string son iguales, entonces continuamos.
	// 				if(strcmp($storedHash, $newHash) == 0){

	// 					if ($this->User->save($this->request->data)) {

	// 						$this->Session->setFlash('Contraseña modificada','flash_success');
	// 						$this->redirect('/');

	// 					}
	// 					else {
	// 						$this->Session->setFlash('Hubo un error y no se pudo editar la contraseña','flash_error');
	// 					}
	// 				}
	// 				else{
	// 					$this->Session->setFlash('Su contraseña vieja no es correcta','flash_error');
	// 				}

	// 		    } // Cierra validate

	// 	    } // cierra POST

	// 	}


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


	// 	///////////////////////////////////////////////////////////////////////////////////

	// 	// Si el valor inicial es "0" significa que ingresamos por primera vez desde "Operaciones Administrador-> Buscar Usuarios"
	// 	// El valor inicial llega como "1" cuando hacemos un cambio de pagina o hacemos SORT de alguna columna.
	// 	public function search_users($valor_inicial = null) {

	// 		$this->set('title_for_layout', 'Buscar Usuarios - Info Parana. Articulos de Informatica');

	// 		// Borramos los arreglos de session cuando ingresamos por primera vez y los creamos.
	// 		if($valor_inicial == 0){

	// 			$this->Session->delete('Condition1');
	// 			$this->Session->write('Condition1');

	// 			$this->Session->delete('Condition2');
	// 			$this->Session->write('Condition2');

	// 			$this->Session->delete('Condition3');
	// 			$this->Session->write('Condition3');

	// 			$this->Session->delete('Condition4');
	// 			$this->Session->write('Condition4');
	// 		}


	// 			/////////////////////////////////////////////////////////////

	// 		if($this->request->is('post')){

	// 			if ($this->request->data['Usuario']['username'] != "") {

	// 				$condition1 = array('User.username LIKE' => "%" . $this->request->data['Usuario']['username'] . "%");
	// 				$this->Session->write('Condition1', $condition1);
	// 			}
	// 			else{
	// 				$this->Session->write('Condition1', "true");
	// 			}


	// 			if ($this->request->data['Usuario']['nombre'] != "") {

	// 				$condition2 = array('User.nombre LIKE' => "%" . $this->request->data['Usuario']['nombre'] . "%");
	// 				$this->Session->write('Condition2', $condition2);
	// 			}
	// 			else{
	// 				$this->Session->write('Condition2', "true");
	// 			}

	// 			if ($this->request->data['Usuario']['apellido'] != "") {

	// 				$condition3 = array('User.apellido LIKE' => "%" . $this->request->data['Usuario']['apellido'] . "%");
	// 				$this->Session->write('Condition3', $condition3);
	// 			}
	// 			else{
	// 				$this->Session->write('Condition3', "true");
	// 			}

	// 			if ($this->request->data['Usuario']['emaill'] != "") {

	// 				$condition4 = array('User.email LIKE' => "%" . $this->request->data['Usuario']['emaill'] . "%");
	// 				$this->Session->write('Condition4', $condition4);
	// 			}
	// 			else{
	// 				$this->Session->write('Condition4', "true");
	// 			}

	// 		}

	// 		$condition1 = $this->Session->read('Condition1');
	// 		$condition2 = $this->Session->read('Condition2');
	// 		$condition3 = $this->Session->read('Condition3');
	// 		$condition4 = $this->Session->read('Condition4');


	// 			// Si hemos hecoh un SORT de nombres por ejemplo, debemos rellenar los inputs con lo que hay almacenado en
	// 			// sus correspondientes variables de session
	// 		if (!$this->request->data) {

	// 				// Sabemos que el array de session "condition1" posee solo un elemento: por ejemplo:
	// 				// array(
	// 						// 'User.username LIKE' => '%fed%'
	// 				// )
	// 				// Si es que hemos completado el campo de "username". Por lo tanto en la tabla al ordenar por username,
	// 				// nombre, apellido o email, necesitamos seguir manteniendo lo que escribimos en "username", es decir "fed".
	// 				// Para eso utlizamos lo siguiente: reset lo que hace es obtener el VALUE del primer elemento del arreglo
	// 				// que pasamos. Siempre tendra un solo elemento el arreglo por lo tanto devuelve "%fed%". Luego con "substr"
	// 				// le decimos que quite el primer caracter y el ultimo caracter al string pasado. De estamo forma "condition1_aux"
	// 				// tendra "fed" lo cual lo ponemos en el input de "username."
	// 				// Inicialemente es NULL por lo tanto no debemos ejecutar esto. Se transforma en "true" cuando no
	// 				// completamos ESTE input, por lo tanto tampoco debemos poner algo en el input para este caso.
	// 			if(isset($condition1) && $condition1 != "true"){
	// 				$condition1_aux = substr(reset($condition1), 1, -1);
	// 				$this->request->data['Usuario']['username'] = $condition1_aux;
	// 			}

	// 			if(isset($condition2) && $condition2 != "true"){
	// 				$condition2_aux = substr(reset($condition2), 1, -1);
	// 				$this->request->data['Usuario']['nombre'] = $condition2_aux;
	// 			}

	// 			if(isset($condition3) && $condition3 != "true"){
	// 				$condition3_aux = substr(reset($condition3), 1, -1);
	// 				$this->request->data['Usuario']['apellido'] = $condition3_aux;
	// 			}

	// 			if(isset($condition4) && $condition4 != "true"){
	// 				$condition4_aux = substr(reset($condition4), 1, -1);
	// 				$this->request->data['Usuario']['emaill'] = $condition4_aux;
	// 			}
	// 		}

	// 		$this->paginate = array(
	// 			'limit' => 5,
	// 			'conditions' => array($condition1,$condition2,$condition3,$condition4)
	// 			);

	// 		$users_encontrados = $this->paginate();

	// 		$this->set('users_encontrados',$users_encontrados);

	// } // fin funcion


		} //fin controller
		?>