
<?php $this->assign('head_description', 'Escribir algooo');?>


<h2>Iniciar Sesión</h2>

<?php
	echo $this->Form->create('User', array('controller' => 'users', 'action' => 'login'));

		echo $this->Form->input('email');
	    echo $this->Form->input('password');

	echo $this->Form->end('Sign In');




	echo $this->Html->link('ADD', array('controller' => 'users', 'action' => 'addUser'));
?>
