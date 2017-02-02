
<?php echo $this->Html->script('validation_client_side', array('inline' => false)); ?>

<!-- Le cambie el nombre para no confundir con el "bootstrap.js" -->
<?php echo $this->Html->script('bootstrap_validation_client_side', array('inline' => false)); ?>

<?php echo $this->Html->css('validation_client_side', array('inline' => false)); ?>


<?php echo $this->Html->css('styles/styles_USERS_forgetpwd', array('inline' => false)); ?>

<?php $this->assign('head_description', 'Resetear Pass - Info Parana. Minorista y Compra Online de Articulos de Informatica - Parana, Entre Rios - Tel: 0343 - 4000000. ');?>


<div class="container well">


    <div class="row titulo">

        <div class="col-lg-6 col-md-6 col-sm-5">

                  <h4>Resetear Contraseña</h4>
        </div>

    </div> <!-- CIERRA ROW -->

    <!-- ////////////////////////// -->

    <?php echo $this->Form->create('User', array(   'id' => 'reset_password',
                                                    'class' => 'form-horizontal',

                                                    'inputDefaults' => array(

                                                                            'div' => array(
                                                                                           'class' => 'form-group has-feedback'
                                                                                          ),
                                                                            'class' => 'form-control'
                                                                          )
                                                    ));
    ?>

    <!-- ////////////////////////// -->

    <div class="row formulario">

            <?php echo $this->Form->input('email', array('between' => '<div class="col-sm-5 col-md-4">',
                                                         'after' =>   '</div>',
                                                         'placeholder' => 'Email',
                                                         'autofocus'=>'autofocus',
                                                         'label' => array('class' => 'col-sm-3 col-md-2 control-label',
                                                                          'text'  => 'Email <span> * </span>'
                                                                          )
                                        ));
            ?>

    </div> <!-- CIERRA ROW -->

    <!-- ////////////////////////// -->


    <div class="row botones">

        <div class="form-group">

                    <!-- Dejo 2 columnas vacias-->
                    <div class="col-xs-12 col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2">

                        <?php echo $this->Form->button('<span class="glyphicon glyphicon-arrow-right"></span> Enviar',

                                 array(
                                        'type' => 'submit',
                                        'class' => 'btn btn-info btn-sm',
                                        'escape' => false
                                        ));
                        ?>

                        <?php echo $this->Html->link('<span class="glyphicon glyphicon-remove-circle"></span> Volver',

                                                  array('controller' => 'users', 'action' => 'login'
                                                         ),
                                                  array('class' => 'btn btn-primary btn-sm',
                                                         'escape' => false));
                        ?>

                    </div>
        </div>

    </div> <!-- Cierra row-->


    <?php echo $this->Form->end(); ?>

</div><!-- Cierro container -->

<!-- //////////////////////////////////////////////////////////////////////////////////////////////// -->


 <script type='text/javascript' language='javascript'>


$(document).ready(function() {

    /*ID formulario*/
    $('#reset_password').formValidation({
        framework: 'bootstrap',

        /*Para que utilice los iconos de bootstrap*/
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },


        fields: {

                  'data[User][email]': {
                            validators: {
                                notEmpty: {
                                    message: 'El campo no puede ser vacio'
                                },
                                emailAddress: {
                                    message: 'Debe proporcionar una direccion Email valida'
                                },
                                stringLength: {
                                    min:6,
                                    max: 50,
                                    message: 'Debe tener al menos 6 caracteres y menos de 50 caracteres'
                                },
                            }
                        }

//////////////////////////////////////////////////////////////////////////////////////////////////////////////

        }
    });
});
</script>