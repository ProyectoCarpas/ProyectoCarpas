
<?php $this->assign('head_description', 'Buscar Usuarios');?>

<div class="container well">

	<?php echo $this->Form->create('User', array('id' => 'search_users',

												// Avoid User Model validations
												'novalidate' => true,

												// Es necesario ponerle la URL ya que si  en la lista de USER vamos haciendo SORT y/o cambiando paginas, esto produce cambios
												// en la URL. Por lo tanto, si hacemos un SUBMIT con esta URL "cambiada", explota. Entonces aca "reseteamos" la URL que se habia
												// generado con los SORT y la dejamos limpia.
												'url' => array('administrator' => true,
													           'controller' => 'users',
															   'action' => 'searchUsers',
															   1
												),
												'inputDefaults' => array('class' => 'form-control',
																		 'autocomplete' => 'off'
												),
	));?>

	<div class="row">

		<div class="col-xs-12">
			<h4 >Buscar Usuario por ....</h4>
		</div>

	</div>

	<div class="row">

		<div class="col-sm-3 col-md-2">
			<?php echo $this->Form->input('email', array('placeholder' => 'Email usuario...',
														 'type' => 'text',
														 'label' => array('text'  => 'Email')
			));?>
		</div>

		<div class="col-sm-3 col-md-3">
			<?php echo $this->Form->input('full_name', array('placeholder' => 'Nombre y/o Apellido...',
															 'type' => 'text',
															 'label' => array('text'  => 'Nombre t/o Apellido')
			));?>
		</div>

		<div class="col-sm-3 col-md-3">
			<?php echo $this->Form->input('role_id', array('empty' => 'Seleccione un Rol...',
			  										     'label' => array('text'  => 'Rol')
			));?>
		</div>

		<div class="col-sm-3 col-md-3">
			<?php echo $this->Form->input('statues', array('empty' => 'Seleccione un Estado...',
														   'label' => array('text'  => 'Estado')
			));?>
		</div>
	</div>

	<div class="row">

		<div class="col-xs-12">

            <?php echo $this->Form->button('<span class="glyphicon glyphicon-search"></span> Buscar',

                                                 array('type' => 'submit',
                                                       'class' => 'pull-left btn btn-sm btn-success',
                                                       'escape' => false
			));?>
		</div>
	</div>

	<?php echo $this->Form->end(); ?>


	<hr/>

	<?php

	if($hasSearch == true){

		if(!empty($users)){?>

			<div class="row">
				<div class="col-xs-12">

						<h4>Usuarios Encontrados:</h4>

				</div>

			</div>

			<div class="row">

				<div class="col-xs-12">

					<div class="table-responsive">

						<table class="table table-striped table-hover">

							<thead>
								<tr>

									<?php $this->Paginator->options['url'] = array('administrator' => true, 'controller' => 'users', 'action' => 'searchUsers', 1);?>

									<th><?php echo $this->Paginator->sort(
																    'email',
																    array(
													  'asc' => 'Email' . ' <i class="fa fa-long-arrow-up"></i>',
													 'desc' => 'Email' . ' <i class="fa fa-long-arrow-down"></i>'
																    ),
																	array(
																        'escape' => false
		   															)
									);?>  </th>

									<th><?php echo $this->Paginator->sort(
																    'first_name',
																    array(
													  'asc' => 'Nombre' . ' <i class="fa fa-long-arrow-up"></i>',
													 'desc' => 'Nombre' . ' <i class="fa fa-long-arrow-down"></i>'
																    ),
																	array(
																        'escape' => false
		   															)
									);?>  </th>

									<th><?php echo $this->Paginator->sort(
																    'last_name',
																    array(
													  'asc' => 'Apellido' . ' <i class="fa fa-long-arrow-up"></i>',
													 'desc' => 'Apellido' . ' <i class="fa fa-long-arrow-down"></i>'
																    ),
																	array(
																        'escape' => false
		   															)
									);?>  </th>

									<th><?php echo $this->Paginator->sort(
																    'status',
																    array(
													  'asc' => 'Estado' . ' <i class="fa fa-long-arrow-up"></i>',
													 'desc' => 'Estado' . ' <i class="fa fa-long-arrow-down"></i>'
																    ),
																	array(
																        'escape' => false
		   															)
									);?>  </th>

									<th><?php echo $this->Paginator->sort(
																    'role_id',
																    array(
													  'asc' => 'Rol' . ' <i class="fa fa-long-arrow-up"></i>',
													 'desc' => 'Rol' . ' <i class="fa fa-long-arrow-down"></i>'
																    ),
																	array(
																        'escape' => false
		   															)
									);?>  </th>

									<th>Operaciones</th>
								</tr>
							</thead>

							<tbody>

								<?php foreach($users as $user): ?>

									<tr>

										<td><?php echo $user['User']['email']; ?></td>
										<td><?php echo $user['User']['first_name']; ?></td>
										<td><?php echo $user['User']['last_name']; ?></td>
										<td><?php echo $user['User']['status']; ?></td>
										<td><?php echo $user['Role']['name']; ?></td>

										<td>

											<!-- SI NO es el EL mismo, entonces muestro los botones -->
											<?php
											if($user['User']['id'] != $this->Session->read('Auth.User.id')) {?>

												<?php echo $this->Html->link('<i class="glyphicon glyphicon-zoom-in"></i>',
																				array('administrator' => true,
																					  'controller' => 'users',
																					  'action' => 'viewUser',
																					   $user['User']['id']),

																				array('class' => 'btn btn-xs btn-info',
																					  'escape' => false,
																					  'data-toggle' => 'tooltip',
																			  		  'data-placement' => 'bottom',
																					  'title' => 'Ver Detalles Usuario',
																				)
												);

												echo " | ";

												//Si esta ACTIVO, entonces muestro un determinad boton //////
												if($user['User']['status'] == 'Activo'){

													echo $this->Html->link('<i class="glyphicon glyphicon-ban-circle"></i>',
																				array('administrator' => true,
																					  'controller' => 'users',
																				  	  'action' => 'changeUserAccoutStatus',
																				       $user['User']['id']),

																				array('class' => 'btn btn-xs btn-danger',
								                                                      'escape' => false,
								                                                      'data-toggle' => 'tooltip',
																				      'data-placement' => 'bottom',
																					  'title' => 'Inactivar Usuario',
								                                                ),
																			 	sprintf('Esta seguro que desea inactivar a este Usuario?')
  												    );
												}

												///Si esta INACTIVO, entonces muestro otro boton  /////////////////// -->

												if($user['User']['status'] == 'Inactivo'){

													echo $this->Html->link('<i class="glyphicon glyphicon-plus"></i>',
																				array('administrator' => true,
																					  'controller' => 'users',
																				  	  'action' => 'changeUserAccoutStatus',
																				      $user['User']['id']),

																				array('class' => 'btn btn-xs btn-default',
										                                              'escape' => false,
					                                                                  'data-toggle' => 'tooltip',
																		  		      'data-placement' => 'bottom',
																					  'title' => 'Activar Usuario',
										                                        ),
																				sprintf('Esta seguro que desea activar a este Usuario?')
													);
												}

												echo " | ";

												echo $this->Html->link('<i class="glyphicon glyphicon-remove"></i>',
																			array('administrator' => true,
																				  'controller' => 'users',
																			  	  'action' => 'deleteUser',
																			      $user['User']['id']),

																			array('class' => 'btn btn-xs btn-default',
									                                              'escape' => false,
				                                                                  'data-toggle' => 'tooltip',
																	  		      'data-placement' => 'bottom',
																				  'title' => 'Borrar usuario',
									                                        ),
									                                        sprintf('Esta seguro que desea borrar el Usuario?')
												);
									  		} ?>  <!-- Cierra IF -->

											</td>
									</tr>

								<?php endforeach; ?>

							</tbody>
						</table>
					</div>
				</div>
			</div>

			<div class="row">

				<div class="col-xs-12">

						<p>
							<?php
								 echo $this->Paginator->counter(
									array('format' =>'Pagina {:page} de {:pages}, mostrando {:current} usuarios de {:count}'));
							?>

						</p>

						<p>

							<?php $this->Paginator->options['url'] = array('controller' => 'users', 'action' => 'searchUsers', 1);?>

							<?php echo $this->Paginator->prev('< Anterior', array(), null, array('class' => 'prev disabled')); ?>
							<?php echo $this->Paginator->numbers(array('separator' => ' ')); ?>
							<?php echo $this->Paginator->next('Siguiente >', array(), null, array('class' => 'next disabled')); ?>

						</p>
				</div>
			</div>


		<?php } //fin IF

		else{ ?>

			No se han encuentrado usuarios con los criterios seleccionados!

		<?php }
	}?>


</div> <!-- Cierra container -->


<!-- ///////////////////////////////////////////////////////////////// -->

<script>

</script>