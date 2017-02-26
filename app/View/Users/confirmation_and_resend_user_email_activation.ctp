

<h1> El email de confirmacion ha sido enviado a su casilla de correo. Revise el correo no deseado </h1>

<?php echo $this->Html->link('Reenviar Email', array('controller' => 'users', 'action' => 'confirmationAndResendUserEmailActivation', 1));  ?>