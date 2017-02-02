<?php echo $this->Html->script('validation_client_side', array('inline' => false)); ?>

<!-- Le cambie el nombre para no confundir con el "bootstrap.js" -->
<?php echo $this->Html->script('bootstrap_validation_client_side', array('inline' => false)); ?>

<?php echo $this->Html->css('validation_client_side', array('inline' => false)); ?>

<?php echo $this->Html->css('styles/styles_USERS_edit_pass', array('inline' => false)); ?>


<?php $this->assign('head_description', 'Editar Pass - Info Parana. Minorista y Compra Online de Articulos de Informatica - Parana, Entre Rios - Tel: 0343 - 4000000. ');?>


<div class="container well">

    <div class="col-md-3 lado_izquierdo">

            <div class="row">

                  <div class="col-xs-12">

                      <div class="list-group">

                          <div class="list-group-item titulo_panel"> Operaciones Usuario</div>


                          <?php echo $this->Html->link('<span class="glyphicon glyphicon-eye-open"></span> Detalles',

                                                                          array('controller' => 'users',
                                                                                'action' => 'view',
                                                                                $this->Session->read('Auth.User.id')),

                                                                          array('class' =>'list-group-item',
                                                                                'escape' => false));  ?>

                          <?php echo $this->Html->link('<span class="glyphicon glyphicon-edit"></span> Editar Perfil',

                                                                          array('controller' => 'users',
                                                                                'action' => 'edit',
                                                                                $this->Session->read('Auth.User.id')),

                                                                          array('class' =>'list-group-item',
                                                                                'escape' => false));  ?>

                          <?php echo $this->Html->link('<span class="glyphicon glyphicon-alert"></span> Editar Contraseña',

                                                                          array('controller' => 'users',
                                                                                'action' => 'edit_pass',
                                                                                $this->Session->read('Auth.User.id')),

                                                                          array('class' =>'list-group-item active',
                                                                                'escape' => false));  ?>

                          <?php echo $this->Html->link('<span class="glyphicon glyphicon-remove"></span> Eliminar Cuenta',

                                                                          array('controller' => 'users',
                                                                                'action' => 'cambiar_status',
                                                                                $this->Session->read('Auth.User.id')),

                                                                          array('class' =>'list-group-item',
                                                                                'escape' => false),

                                                                  sprintf('Esta seguro que desea eliminar su Cuenta? Solo el Administrador será capaz de restaurarla.'));?>

                          <?php if($this->Html->usuario()){ ?>

                            <?php echo $this->Html->link( '<span class="glyphicon glyphicon-shopping-cart"></span> Mis Compras',

                                                                            array('controller' => 'compras',
                                                                                  'action' => 'lista_compras_user',
                                                                                  $this->Session->read('Auth.User.id')),

                                                                            array('class' =>'list-group-item',
                                                                                  'escape' => false));
                          }?>

                      </div>
                  </div>

            </div> <!-- Cierra row-->

    </div> <!-- Cierra lado izquierdo-->

    <!-- /////////////////////////////////////////////////////////////////////////////// -->


    <!-- Le dedico toda la fila al titulo -->
    <div class="col-md-9 lado_derecho">

        <?php echo $this->Form->create('User', array('id' => 'edit_pass',
                                                     'class' => 'form-horizontal',

                                                     'inputDefaults' => array(

                                                                        'div' => array(
                                                                                       'class' => 'form-group has-feedback'
                                                                                      ),
                                                                        'class' => 'form-control',

                                                                        'autocomplete' => 'off'
                                                                        ),
                                                    ));
        ?>


        <div class="row titulo">
            <div class="col-xs-12">

                <h4>Cambiar Contraseña</h4>

            </div>

        </div> <!-- Cierra row-->


        <div class="row formulario">

            <div class="col-xs-12">

                <!-- Campo ID y campo usado para el LOGUIN los debemos poner como HIDDEN -->
                <?php echo $this->Form->hidden('id'); ?>
                <?php echo $this->Form->hidden('username'); ?>


                <?php echo $this->Form->input('old_password', array('between' => '<div class="col-md-5">',
                                                                    'after' =>   '</div>',
                                                                    'placeholder' => 'Vieja Contraseña',
                                                                    'type' => 'password',
                                                                    'label' => array('class' => 'col-md-4 col-lg-3 control-label',
                                                                                     'text'  => 'Vieja Contraseña <span> * </span>'
                                                                                    ),

                                                                    'id' => 'old_password'
                                            ));
                ?>

                <?php echo $this->Form->input('password_update', array('between' => '<div class="col-md-5">',
                                                                       'after' =>   '</div>',
                                                                       'placeholder' => 'Contraseña',
                                                                       'type' => 'password',
                                                                       'label' => array('class' => 'col-md-4 col-lg-3 control-label',
                                                                                        'text'  => 'Nueva Contraseña <span> * </span>'
                                                                                      )
                                            ));
                ?>

                <?php echo $this->Form->input('password_confirm_update', array('between' => '<div class="col-md-5">',
                                                                               'after' =>   '</div>',
                                                                               'placeholder' => 'Repita Nueva Contraseña',
                                                                               'type' => 'password',
                                                                               'label' => array('class' => 'col-md-4 col-lg-3 control-label',
                                                                                                'text'  => 'Repita Contraseña <span> * </span>'
                                                                                               )
                                            ));
                ?>


            </div>

        </div> <!-- Cierro row-->


        <div class="row botones">

              <!-- Dejo 2 columnas vacias-->
              <div class="col-xs-12 col-md-8 col-md-offset-4 col-lg-9 col-lg-offset-3">

                  <?php echo $this->Html->link('<span class="glyphicon glyphicon-circle-arrow-left"></span> Volver',

                                            array('controller' => 'users', 'action' => 'view',
                                                   $this->Session->read('Auth.User.id')),
                                            array('class' => 'btn btn-primary btn-sm',
                                                   'escape' => false));
                  ?>

                  <?php echo $this->Form->button('<span class="glyphicon glyphicon-floppy-saved"></span> Guardar',

                           array(
                                  'type' => 'submit',
                                  'class' => 'btn btn-info btn-sm',
                                  'escape' => false
                                  ));
                  ?>

              </div>

        </div> <!-- Cierro row-->

        <?php echo $this->Form->end(); ?>

    </div> <!-- Cierra lado derecho-->

</div><!-- Cierro container -->


<!-- //////////////////////////////////////////////////////////////////////////////////////////////// -->


<script type='text/javascript' language='javascript'>


$(document).ready(function() {

    /*ID formulario*/
    $('#edit_pass').formValidation({
        framework: 'bootstrap',

        /*Para que utilice los iconos de bootstrap*/
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },


        fields: {

              'data[User][password_update]': {
                validators: {
                    notEmpty: {
                        message: 'El campo no puede ser vacío'
                    },
                    stringLength: {
                        min:6,
                        max: 30,
                        message: 'Debe tener al menos 6 caracteres y menos de 30 caracteres'
                    },


                    regexp: {
                        regexp: /(^(?=.*[a-z])(?=.*[A-Z])(?=.*\d){6,20}.+$)/,
                        message: 'Debe tener al menos una mayúscula, una minúscula y un número'
                    },


                    different: {
                        field: 'data[User][username]',
                        message: 'El password no puede ser igual al Nombre de usuario'
                    }
                }
            },


            'data[User][password_confirm_update]': {
                validators: {
                    notEmpty: {
                        message: 'El campo no puede ser vacío'
                    },

                     identical: {
                        field: 'data[User][password_update]',
                        message: 'Las contraseñas no coinciden'
                    }
                }
            }

        //////////////////////////////////////////////////////////////////////////////////////////////////////////////

        }
    });
});
</script>