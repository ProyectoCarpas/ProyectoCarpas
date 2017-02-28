<div class="dropdown">

	<?php echo $this->Html->link('Administrador <span class="caret"></span>',
																	array('action' => '#'),
																	array('id' => 'dropdownMenu2',
																		  'style' => 'button',
																		  'class' => 'btn btn-default dropdown-toggle',
																		  'data-toggle' => 'dropdown',
																		  'data-target' => '#',
																		  'aria-haspopup' => true,
																		  'aria-expanded' => false,
																		  'escape' => false));
	?>

	<ul class="dropdown-menu" aria-labelledby="dropdownMenu2">

		<li><?php echo $this->Html->link('<span class="fa fa-search"></span> Buscar Usuarios',

											array('administrator' => true,
												  'controller' => 'users',
												  'action' => 'searchUsers',
												  0),
											array('aria-hidden' => true,
					   							  'escape' => false));
			?>
		</li>
	</ul> <!--"dropdown-menu" -->
</div>