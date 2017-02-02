

<?php echo $this->Html->link('LOGIN' , array('controller' => 'users', 'action' => 'login')); ?>

<br /><br />

<?php echo $this->Html->link('LOGOUT' , array('controller' => 'users', 'action' => 'logout'));  ?>



<?php

if($this->Html->isUserRegistered()){
	
	echo $this->Html->nestedList($user);
}

?>