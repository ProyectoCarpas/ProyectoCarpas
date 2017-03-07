<div id="userActionsLateralMenu" class="list-group" data-actual-view="<?php echo $this->action; ?>">
   
      <?php echo $this->Html->link('<span class="glyphicon glyphicon-eye-open"></span> Detalles',

                                                      array('controller' => 'users',
                                                            'action' => 'viewUser',
                                                            $this->Session->read('Auth.User.id')),

                                                      array('id' => 'view-user-option',
                                                            'class' =>'list-group-item',
                                                            'escape' => false));  ?>

      <?php echo $this->Html->link('<span class="glyphicon glyphicon-edit"></span> Editar Perfil',

                                                      array('controller' => 'users',
                                                            'action' => 'editUser',
                                                            $this->Session->read('Auth.User.id')),

                                                      array('id' => 'edit-user-option',
                                                            'class' =>'list-group-item',
                                                            'escape' => false));  ?>

      <?php echo $this->Html->link('<span class="glyphicon glyphicon-alert"></span> Editar Contraseña',

                                                      array('controller' => 'users',
                                                            'action' => 'editUserPassword',
                                                            $this->Session->read('Auth.User.id')),

                                                      array('id' => 'edit-user-pass-option',
                                                            'class' =>'list-group-item',
                                                            'escape' => false));  ?>

      <?php echo $this->Html->link('<span class="glyphicon glyphicon-remove"></span> Eliminar Cuenta',

                                                      array('controller' => 'users',
                                                            'action' => 'deleteUser',
                                                            $this->Session->read('Auth.User.id')),

                                                      array('id' => 'delete-user-option',
                                                            'class' =>'list-group-item',
                                                            'escape' => false),
                                                     sprintf('Esta seguro que desea eliminar su Cuenta?'));?>
</div>
