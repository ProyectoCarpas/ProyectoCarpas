<nav class="navbar navbar-default">

	<div class="container">

		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>

			<?php echo $this->Html->link("CARPAS", array('controller' => 'publics', 'action' => 'index'),
												   array('class' => 'navbar-brand'));  ?>
		</div>

		<div class="collapse navbar-collapse" id="bar">

			<ul class="nav navbar-nav navbar-left">
				<li>
					<?php echo $this->Form->create('Stand', array('url' => array('controller' => 'stands',
														  						 'action' => 'details'),

														  					     'class' => array('navbar-form navbar-left')));
					?>

					<div class="form-group">
						<?php echo $this->Form->input('title', array('id'=>'title',
																 	 'label' => false,
																  	 'placeholder' => 'Buscar stand',
																	 'autocomplete' => 'off',
																	 'class' => 'form-control'));
						?>
					</div>

					<?php echo $this->Form->button('<span class="glyphicon glyphicon-search"></span>',
																			array('class'=>'btn btn-warning'));
					?>

					<?php echo $this->Form->end(); ?>
				</li>
			</ul>

			<ul class="nav navbar-nav navbar-right ">
				<li>
					<div class="navbar-form navbar-left">

						<div class="dropdown">

							<?php if(!$this->Html->isUserLogged()){ ?>

								<?php echo $this->Html->link('Inicar Sesion',
																		array('controller' => 'users',
																			  'action' => 'login'),
																		array('style' => 'button',
																			  'class' => 'btn btn-primary',
																			  'escape' => false));
								?>
							<?php }?>

							<?php if($this->Html->isUserLogged()){ ?>

								<?php echo $this->Html->link( 'Usuario <span class="caret"></span>',
																		array('action' => '#'),
																		array('id' => 'dropdownMenu1',
																			  'style' => 'button',
																			  'class' => 'btn btn-default dropdown-toggle',
																			  'data-toggle' => 'dropdown',
																			  'data-target' => '#',
																			  'aria-haspopup' => true,
																			  'aria-expanded' => false,
																			  'escape' => false));
								?>

								<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">

									<li><?php echo $this->Html->link('<span class="fa fa-user"></span> Ver Perfil',

																		array('controller' => 'users',
																			  'action' => 'viewUser',
																		 	  $this->Session->read('Auth.User.id')),
																		array('aria-hidden' => true,
												   							  'escape' => false));
										?>
									</li>

									<li class="divider"></li>

									<li><?php echo $this->Html->link('<span class="fa fa-sign-out"></span> Cerrar Sesión',

																		array('controller' => 'users',
																			  'action' => 'logout'),
																		array('aria-hidden' => true,
																			  'escape' => false));
										?>
									</li>
								</ul> <!--"dropdown-menu" -->

							<?php }?>
						</div>
					</div> <!-- "dropdown" -->
				</li>
			</ul>

		</div> <!-- navbar-collapse-->
	</div>  <!-- container" -->
</nav>