<?php echo $this->Html->script('validation_client_side', array('inline' => false)); ?>

<!-- Le cambie el nombre para no confundir con el "bootstrap.js" -->
<?php echo $this->Html->script('bootstrap_validation_client_side', array('inline' => false)); ?>

<?php echo $this->Html->css('validation_client_side', array('inline' => false)); ?>

<?php echo $this->Html->css('styles/styles_USERS_edit', array('inline' => false)); ?>


<?php $this->assign('head_description', 'Editar Articulo - Info Parana. Minorista y Compra Online de Articulos de Informatica - Parana, Entre Rios - Tel: 0343 - 4000000. ');?>


<div class="container well">

    <div class="row">

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

                                                                          array('class' =>'list-group-item active',
                                                                                'escape' => false));  ?>

                          <?php echo $this->Html->link('<span class="glyphicon glyphicon-alert"></span> Editar Contraseña',

                                                                          array('controller' => 'users',
                                                                                'action' => 'edit_pass',
                                                                                $this->Session->read('Auth.User.id')),

                                                                          array('class' =>'list-group-item',
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

            </div><!-- Cierra row-->

        </div>

        <!-- /////////////////////////////////////////////////////////////////////////////// -->

        <?php echo $this->Form->create('User', array('id' => 'edit_cuenta',
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

        <!-- Le dedico toda la fila al titulo -->
        <div class="col-md-9 lado_derecho">

            <div class="row titulo">

                  <div class="col-xs-12">
                      <h4>Editar Perfil</h4>
                  </div>

            </div>

            <!-- //////////////////// -->

            <div class="row formulario">

                <div class="col-xs-12">

                    <!-- Improtante para que funcione el formulario de edit -->
                    <?php echo $this->Form->hidden('id'); ?>

                    <?php echo $this->Form->input('username', array('between' => '<div class="col-sm-9 col-md-7 col-lg-6">',
                                                                    'after' =>   '</div>',
                                                                    'readonly' => 'readonly',
                                                                    'label' => array('class' => 'col-sm-3 col-md-2 control-label',
                                                                                     'text'  => 'Username <span> * </span>'
                                                                                    )
                                                ));
                    ?>

                    <?php echo $this->Form->input('nombre', array('between' => '<div class="col-sm-9 col-md-7 col-lg-6">',
                                                                  'after' =>   '</div>',
                                                                  'placeholder' => 'Su nombre...',
                                                                  'label' => array('class' => 'col-sm-3 col-md-2 control-label',
                                                                                   'text'  => 'Nombre <span> * </span>'
                                                                                  ),
                                                ));
                    ?>

                    <?php echo $this->Form->input('apellido', array('between' => '<div class="col-sm-9 col-md-7 col-lg-6">',
                                                                    'after' =>   '</div>',
                                                                    'placeholder' => 'Apellido...',
                                                                    'label' => array('class' => 'col-sm-3 col-md-2 control-label',
                                                                                     'text'  => 'Apellido <span> * </span>'
                                                                                    )
                                                ));
                    ?>

                    <?php echo $this->Form->input('email', array('between' => '<div class="col-sm-9 col-md-7 col-lg-6">',
                                                                 'after' =>   '</div>',
                                                                 'placeholder' => 'Email...',
                                                                 'label' => array('class' => 'col-sm-3 col-md-2 control-label',
                                                                                  'text'  => 'Email <span> * </span>'
                                                                                  )
                                                ));
                    ?>

                    <br />

                    <?php echo $this->Form->input('localidade_id', array('between' => '<div class="col-sm-9 col-md-7 col-lg-6">',
                                                                         'after' =>   '</div>',
                                                                         'label' => array('class' => 'col-sm-3 col-md-2 control-label',
                                                                                          'text'  => 'Localidad <span> * </span>'
                                                                                        )
                                                ));
                    ?>

                    <?php echo $this->Form->input('calle', array('between' => '<div class="col-sm-5 col-md-4 col-lg-3">',
                                                                 'after' =>   '</div>',
                                                                 'placeholder' => 'Calle',
                                                                 'type' => 'text',
                                                                 'maxlength'=>'30',
                                                                 'label' => array('class' => 'col-sm-3 col-md-2 control-label',
                                                                                  'text'  => 'Calle <span> * </span>'
                                                                )
                                                ));
                    ?>

                    <?php echo $this->Form->input('numero', array('between' => '<div class="col-sm-3 col-md-3 col-lg-3">',
                                                                  'after' =>   '</div>',
                                                                  'placeholder' => 'Numero',
                                                                  'type' => 'text',
                                                                  'maxlength'=>'11',
                                                                  'label' => array('class' => 'col-sm-3 col-md-2 control-label',
                                                                                   'text'  => 'Número <span> * </span>'
                                                                )
                                                ));
                    ?>

                    <?php echo $this->Form->input('piso', array('between' => '<div class="col-sm-3 col-md-3 col-lg-3">',
                                                                'after' =>   '</div>',
                                                                'placeholder' => 'Piso',
                                                                'type' => 'text',
                                                                'maxlength'=>'11',
                                                                'label' => array('class' => 'col-sm-3 col-md-2 control-label',
                                                                                 'text'  => 'Piso'
                                                                )
                                                ));
                    ?>

                    <?php echo $this->Form->input('depto', array('between' => '<div class="col-sm-3 col-md-3 col-lg-3">',
                                                                 'after' =>   '</div>',
                                                                 'placeholder' => 'Depto',
                                                                 'type' => 'text',
                                                                 'maxlength'=>'11',
                                                                 'label' => array('class' => 'col-sm-3 col-md-2 control-label',
                                                                                  'text'  => 'Depto'
                                                                )
                                                ));
                    ?>

                    <br />

                </div>

            </div> <!-- Cierra row-->

            <!-- //////////////////// -->

            <div class="row botones">

                  <!-- Dejo 2 columnas vacias-->
                  <div class="col-xs-12 col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2">

                      <?php echo $this->Html->link('<span class="glyphicon glyphicon-circle-arrow-left"></span> Volver',

                                                array('controller' => 'users', 'action' => 'view',
                                                      $this->Session->read('Auth.User.id')),

                                                array('class' => 'btn btn-primary btn-sm',
                                                       'escape' => false));
                      ?>

                      <!-- Boton que envia el form al controller. Le puse type "submit" para que mande por POST.-->
                      <?php echo $this->Form->button('<span class="glyphicon glyphicon-floppy-saved"></span> Guardar',

                               array(
                                      'type' => 'submit',
                                      'class' => 'btn btn-info btn-sm',
                                      'escape' => false
                                      ));
                      ?>

                  </div>

            </div> <!-- ROW Botones-->

        </div> <!-- cierra col-md-9-->


        <?php echo $this->Form->end(); ?>

    </div> <!-- cierra ROW principal-->

</div><!-- Cierro container -->



<!-- //////////////////////////////////////////////////////////////////////////////////////////////// -->

 <script type='text/javascript' language='javascript'>

$(document).ready(function() {

    /*ID formulario*/
    $('#edit_cuenta').formValidation({
        framework: 'bootstrap',

        /*Para que utilice los iconos de bootstrap*/
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },


        fields: {

            'data[User][username]': {
                validators: {
                    notEmpty: {
                        message: 'El campo no puede ser vacío'
                    },
                    stringLength: {
                        min: 6,
                        max: 30,
                        message: 'Debe tener entre 6 y 30 caracteres'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9áéíóúÁÉÍÓÚÑñ_ \-]+$/,
                        message: 'Solo letras, números, puntos o guiones bajos'
                    }
                }
            },

            'data[User][nombre]': {
                validators: {
                    notEmpty: {
                        message: 'El campo no puede ser vacío'
                    },
                    stringLength: {
                        min:2,
                        max: 30,
                        message: 'Debe tener al menos 2 caracteres y menos de 30 caracteres'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9áéíóúÁÉÍÓÚÑñ_ \-]+$/,
                        message: 'Solo letras, números, puntos o guiones bajos'
                    }
                }
            },

            'data[User][apellido]': {
                validators: {
                    notEmpty: {
                        message: 'El campo no puede ser vacío'
                    },
                    stringLength: {
                        min:2,
                        max: 30,
                        message: 'Debe tener al menos 2 caracteres y menos de 30 caracteres'
                    },

                    regexp: {
                        regexp: /^[a-zA-Z0-9áéíóúÁÉÍÓÚÑñ_ \-]+$/,
                        message: 'Solo letras, números, puntos o guiones bajos'
                    }
                }
            },


            'data[User][email]': {
                validators: {
                    notEmpty: {
                        message: 'El campo no puede ser vacío'
                    },
                    emailAddress: {
                        message: 'Debe proporcionar una direccion Email válida'
                    },
                    stringLength: {
                        min:6,
                        max: 50,
                        message: 'Debe tener al menos 6 caracteres y menos de 50 caracteres'
                    },
                }
            },


/////////////////////////////////////////////////////////////////////////////////////////////////////////////

            'data[User][calle]': {
                validators: {
                    notEmpty: {
                        message: 'El campo no puede ser vacío'
                    },
                    stringLength: {
                        max: 30,
                        message: 'Menos de 30 caracteres'
                    },


                    regexp: {
                        regexp: /^[a-zA-Z0-9áéíóúÁÉÍÓÚÑñ_ \-]+$/,
                        message: 'Solo letras, números, puntos o guiones'
                    }
                }
            },

//////////////////////////////////////////////////////////////////////////////////////////////////////////////

            'data[User][numero]': {
                validators: {
                    notEmpty: {
                        message: 'El campo no puede ser vacío'
                    },
                    stringLength: {
                        max: 11,
                        message: 'Menos de 11 caracteres'
                    },


                    numeric: {
                        message: 'Solo números'
                    }
                }
            },

//////////////////////////////////////////////////////////////////////////////////////////////////////////////

            'data[User][piso]': {
                validators: {
                    stringLength: {
                        max: 11,
                        message: 'Menos de 11 caracteres'
                    },

                    regexp: {
                        regexp: /^[a-zA-Z0-9áéíóúÁÉÍÓÚÑñ_ \-]+$/,
                        message: 'Solo letras, números, puntos o guiones'
                    }
                }
            },

//////////////////////////////////////////////////////////////////////////////////////////////////////////////

            'data[User][depto]': {
                validators: {
                    stringLength: {
                        max: 11,
                        message: 'Menos de 11 caracteres'
                    },

                    regexp: {
                        regexp: /^[a-zA-Z0-9áéíóúÁÉÍÓÚÑñ_ \-]+$/,
                        message: 'Solo letras, números, puntos o guiones'
                    }
                }
            }

//////////////////////////////////////////////////////////////////////////////////////////////////////////////

        }
    });
});
</script>