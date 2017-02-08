

<?php echo $this->Html->link('LOGIN' , array('controller' => 'users', 'action' => 'login')); ?>

<br /><br />

<?php echo $this->Html->link('LOGOUT' , array('controller' => 'users', 'action' => 'logout'));  ?>



<?php

if($this->Html->isUserRegistered()){?> 
	
	
<div class="container well">

    <div class="row">

        <div class="col-md-3">

            <div class="row">

                  <div class="col-xs-12">

                      <div class="list-group">

                          <div> Operaciones Usuario </div>


                          <?php echo $this->Html->link('<span class="glyphicon glyphicon-eye-open"></span> Detalles',

                                                                          array('controller' => 'users',
                                                                                'action' => 'viewUser',
                                                                                $this->Session->read('Auth.User.id')),

                                                                          array('class' =>'list-group-item',
                                                                                'escape' => false));  ?>

                          <?php echo $this->Html->link('<span class="glyphicon glyphicon-edit"></span> Editar Perfil',

                                                                          array('controller' => 'users',
                                                                                'action' => 'editUser',
                                                                                $this->Session->read('Auth.User.id')),

                                                                          array('class' =>'list-group-item active',
                                                                                'escape' => false));  ?>

                          <?php echo $this->Html->link('<span class="glyphicon glyphicon-alert"></span> Editar Contraseña',

                                                                          array('controller' => 'users',
                                                                                'action' => 'editPasswordUser',
                                                                                $this->Session->read('Auth.User.id')),

                                                                          array('class' =>'list-group-item',
                                                                                'escape' => false));  ?>

                          <?php echo $this->Html->link('<span class="glyphicon glyphicon-remove"></span> Eliminar Cuenta',

                                                                          array('controller' => 'users',
                                                                                'action' => 'changeAccoutStatus',
                                                                                $this->Session->read('Auth.User.id')),

                                                                          array('class' =>'list-group-item',
                                                                                'escape' => false),

                                                         sprintf('Esta seguro que desea eliminar su Cuenta?'));?>
                      </div>
                  </div>
            </div><!-- Cierra row-->
        </div>
    </div>
</div>

<?php
	echo $this->Html->nestedList($user);
}

?>