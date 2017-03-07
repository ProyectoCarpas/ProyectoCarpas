<?php $this->assign('head_description', 'Activar Cuenta');?>

<div class="container">
    <div class="well">

	    <div class="row">

        	<div class="col-xs-12">

				<h3> El email de confirmacion ha sido enviado a su casilla de correo. Revise el correo no deseado. </h3>

				<?php echo $this->Html->link('Reenviar Email',
												array('controller' => 'users',
													  'action' => 'confirmationAndResendUserEmailActivation',
													  1)
				);
				?>

			</div>
        </div>
	</div>
</div>