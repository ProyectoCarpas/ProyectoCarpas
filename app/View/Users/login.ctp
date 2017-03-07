<?php $this->assign('head_description', 'Ingresar');?>

<div class="container">
    <div class="well">

        <div class="row">

        	<div class="col-xs-12">

				<h4> Iniciar Sesión </h4>

				<?php
				echo $this->Form->create('User',
		                                    array('id' => 'login',
		                                          'class' => 'form-horizontal',
		                                          'novalidate' => 'novalidate',
		                                          'inputDefaults' => array(
   		                                                               'div' => array(
		                                                                          'class' => 'form-group has-feedback'
		                                                                        ),
		                                                              'class' => 'form-control',
		                                                              'autocomplete' => 'off'
		                                                            )
		                                    )
		        );

		        echo $this->Form->input('email',
				                            array('between' => '<div class="col-sm-9 col-md-7 col-lg-6">',
				                                  'after' =>  '</div>',
				                                  'placeholder' => 'Email...',
				                                  'label' => array('class' => 'col-sm-3 col-md-2 control-label',
				                                                   'text'  => 'Email'
				                                            )
				));

				echo $this->Form->input('password',
				                            array('between' => '<div class="col-sm-9 col-md-7 col-lg-6">',
				                                  'after' =>  '</div>',
				                                  'placeholder' => 'Password...',
				                                  'type' => 'password',
				                                  'label' => array('class' => 'col-sm-3 col-md-2 control-label',
				                                                   'text'  => 'Password'
				                                            )
				));

				echo $this->Form->button('Entrar',
			                              	array('type' => 'submit',
			                                    'class' => 'btn btn-info btn-sm',
			                                    'escape' => false
			                                )
	            );
				?>


				<p><?php echo $this->Html->link("¿No puedes acceder a tu cuenta?",
													array('controller' => 'users', 'action' => 'forgetUserPassword'));?>
				</p>

			</div>
		</div>

		<div class="row">

        	<div class="col-xs-12">
        		
        		<h4> Nuevo usuario </h4>
				
				<?php echo $this->Html->link('+ Crear cuenta', array('controller' => 'users', 'action' => 'addUser'));  ?>
      		</div>
		</div>

	</div>
</div>
