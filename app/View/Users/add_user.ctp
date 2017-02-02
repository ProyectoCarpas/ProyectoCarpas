<?php $this->assign('head_description', 'Escribir algooo');?>


<h2>Iniciar Sesión</h2>

<?php
	echo $this->Form->create('User', array('novalidate' => 'novalidate'));

		echo $this->Form->input('email');
	    echo $this->Form->input('first_name');
	    echo $this->Form->input('last_name');
	    echo $this->Form->input('date_of_birth');
	    echo $this->Form->input('cell_number');
	    echo $this->Form->input('password');
	    echo $this->Form->input('password_confirm');
	    
	echo $this->Form->end('Sign In');

	echo $this->Html->link('ADD', array('controller' => 'users', 'action' => 'addUser'));
?>