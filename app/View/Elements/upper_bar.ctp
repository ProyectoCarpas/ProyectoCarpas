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

							<?php if(!$this->Html->isUserLogged()){ ?>

								<div class="dropdown">

									<?php echo $this->Html->link('Inicar Sesion',
																			array('controller' => 'users',
																				  'action' => 'login'),
																			array('style' => 'button',
																				  'class' => 'btn btn-primary',
																				  'escape' => false));
									?>
								</div>

							<?php }?>

							<?php if($this->Html->isAdministratorUser()){ ?>

								<?php echo $this->element('upper_bar_administrator_user_menu_button'); ?>

							<?php }?>

							<?php if($this->Html->isUserLogged()){ ?>

								<?php echo $this->element('upper_bar_user_menu_button'); ?>

							<?php }?>
						</div>
					</div> <!-- "dropdown" -->
				</li>
			</ul>

		</div> <!-- navbar-collapse-->
	</div>  <!-- container" -->
</nav>