<div class="dropdown">

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

											array('administrator' => false,
												  'controller' => 'users',
												  'action' => 'viewUser',
											 	  $this->Session->read('Auth.User.id')),
											array('aria-hidden' => true,
					   							  'escape' => false));
			?>
		</li>

		<li class="divider"></li>

		<li><?php echo $this->Html->link('<span class="fa fa-sign-out"></span> Cerrar Sesión',

											array('administrator' => false,
												  'controller' => 'users',
												  'action' => 'logout'),
											array('aria-hidden' => true,
												  'escape' => false));
			?>
		</li>
	</ul> <!--"dropdown-menu" -->
</div>