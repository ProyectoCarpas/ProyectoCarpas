<?php $this->assign('head_description', 'Recuperar Password');?>

<div class="container">
    <div class="well">

        <div class="row">

            <div class="col-xs-12">

                <h4> Resetear Contraseña </h4>

                <?php
                echo $this->Form->create('User',
                                            array('id' => 'resetUserPassword',
                                                  'class' => 'form-horizontal',
                                                  'novalidate' => 'novalidate',
                                                  'inputDefaults' => array(
                                                                        'div' => array(
                                                                                    'class' => 'form-group has-feedback'
                                                                        ),
                                                                        'class' => 'form-control',
                                                                        'autocomplete' => 'off'
                                                                    )
                                                    )
                );

                echo $this->Form->input('password',
                                            array('between' => '<div class="col-sm-4 col-md-4 col-lg-3">',
                                                  'after' =>   '</div>',
                                                  'placeholder' => 'Contraseña',
                                                  'type' => 'password',
                                                  'autofocus'=>'autofocus',
                                                  'label' => array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label',
                                                                   'text'  => 'Nueva Contraseña <span> * </span>'
                                                            )
                ));

                echo $this->Form->input('password_confirm',
                                            array('between' => '<div class="col-sm-4 col-md-4 col-lg-3">',
                                                  'after' =>   '</div>',
                                                  'placeholder' => 'Repita Nueva Contraseña',
                                                  'type' => 'password',
                                                  'label' => array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label',
                                                                   'text'  => 'Repita Contraseña <span> * </span>'
                                                            )
                ));
                ?>

                <div class="row">

                    <div class="col-xs-12 col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">

                        <?php
                        echo $this->Form->button('<span class="glyphicon glyphicon-arrow-right"></span> Cambiar',
                                                    array('type' => 'submit',
                                                          'class' => 'btn btn-info btn-sm',
                                                          'escape' => false
                                                        )
                        );
                        ?>
                    </div>
                </div><!-- row buttons-->

                <?php echo $this->Form->end(); ?>

            </div>
        </div> <!-- row -->
    </div> <!-- well -->
</div> <!-- container -->




<!-- //////////////////////////////////////////////////////////////////////////////////////////////// -->

<script type='text/javascript' language='javascript'>

// $(document).ready(function() {

//     /*ID formulario*/
//     $('#reset').formValidation({
//         framework: 'bootstrap',

//         /*Para que utilice los iconos de bootstrap*/
//         icon: {
//             valid: 'glyphicon glyphicon-ok',
//             invalid: 'glyphicon glyphicon-remove',
//             validating: 'glyphicon glyphicon-refresh'
//         },


//         fields: {

//               'data[User][password]': {
//                 validators: {
//                     notEmpty: {
//                         message: 'El campo no puede ser vacio'
//                     },
//                     stringLength: {
//                         min:6,
//                         max: 30,
//                         message: 'Debe tener al menos 6 caracteres y menos de 30 caracteres'
//                     },


//                     regexp: {
//                         regexp: /(^(?=.*[a-z])(?=.*[A-Z])(?=.*\d){6,20}.+$)/,
//                         message: 'De tener al menos una mayuscula, una minuscula y un numero'
//                     },


//                     different: {
//                         field: 'data[User][username]',
//                         message: 'El password no puede ser igual al Nombre de usuario'
//                     }
//                 }
//             },


//             'data[User][password_confirm]': {
//                 validators: {
//                     notEmpty: {
//                         message: 'El campo no puede ser vacio'
//                     },

//                      identical: {
//                         field: 'data[User][password]',
//                         message: 'Las contraseñas no coinciden'
//                     }
//                 }
//             }

// //////////////////////////////////////////////////////////////////////////////////////////////////////////////

//         }
//     });
// });
</script>