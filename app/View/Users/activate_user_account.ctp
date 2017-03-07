<?php $this->assign('head_description', 'Cuenta Activada');?>

<div class="container">
    <div class="well">

	    <div class="row">

        	<div class="col-xs-12">

				<h3> Su cuenta ha sido activada exitosamente!! </h3>


				<?php
				echo $this->Html->link('<span class="glyphicon glyphicon-circle-arrow-left"></span> Volver al Login',

												   array('controller'=>'users', 'action'=>'login'),

													   array('class'=>'btn btn-warning btn-sm',
	                                                         'escape' => false)
				);
        		?>
        	</div>
        </div>
	</div>
</div>