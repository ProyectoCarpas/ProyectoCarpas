<?php echo $this->Html->css('styles/styles_USERS_activar_cuenta', array('inline' => false)); ?>

<div class="container well">

    <div class="row mensaje">

		<h3>Su cuenta ha sido activada exitosamente!! </h3>


		<?php echo $this->Html->link(' <span class="glyphicon glyphicon-circle-arrow-left"></span> Volver al Login',

														   array('controller'=>'users', 'action'=>'login'),

		 												   array('class'=>'btn btn-warning btn-sm',
                                                                 'escape' => false));
        ?>

	</div>
</div>