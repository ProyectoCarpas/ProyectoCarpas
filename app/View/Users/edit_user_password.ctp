<?php $this->assign('head_description', 'Editar User Password');?>

<div class="container">
    <div class="well">

        <div class="row">

            <div class="col-md-3">

                <?php echo $this->element('user_actions_lateral_menu_element'); ?>
            </div>

            <div class="col-md-9">

                <h4> Cambiar Contraseña </h4>
                
                <?php
                echo $this->Form->create('User',
                                    array('id' => 'editUserPassword',
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
                ?>

                <?php
                echo $this->Form->hidden('id');
                echo $this->Form->hidden('mail');

                echo $this->Form->input('old_password',
                                            array('between' => '<div class="col-md-5">',
                                                  'after' =>   '</div>',
                                                  'placeholder' => 'Vieja Contraseña',
                                                  'type' => 'password',
                                                  'label' => array('class' => 'col-md-4 col-lg-3 control-label',
                                                                   'text'  => 'Vieja Contraseña <span> * </span>'
                                                             )
                ));

                echo $this->Form->input('password_update',
                                            array('between' => '<div class="col-md-5">',
                                                  'after' =>   '</div>',
                                                  'placeholder' => 'Contraseña',
                                                  'type' => 'password',
                                                  'label' => array('class' => 'col-md-4 col-lg-3 control-label',
                                                                   'text'  => 'Nueva Contraseña <span> * </span>'
                                                             )
                ));

                echo $this->Form->input('password_confirm_update',
                                            array('between' => '<div class="col-md-5">',
                                                  'after' =>   '</div>',
                                                  'placeholder' => 'Repita Nueva Contraseña',
                                                  'type' => 'password',
                                                  'label' => array('class' => 'col-md-4 col-lg-3 control-label',
                                                                   'text'  => 'Repita Contraseña <span> * </span>'
                                                            )
                ));
                ?>

                <div class="row">

                    <div class="col-xs-12 col-md-8 col-md-offset-4 col-lg-9 col-lg-offset-3">

                        <?php
                        echo $this->Html->link('<span class="glyphicon glyphicon-circle-arrow-left"></span> Volver',

                                                  array('controller' => 'users', 'action' => 'viewUser',
                                                        $this->Session->read('Auth.User.id')),
                                                  array('class' => 'btn btn-primary btn-sm',
                                                           'escape' => false));

                        echo "&nbsp;&nbsp;";

                        echo $this->Form->button('<span class="glyphicon glyphicon-floppy-saved"></span> Guardar',

                                                  array('type' => 'submit',
                                                        'class' => 'btn btn-info btn-sm',
                                                        'escape' => false
                                                      )
                        );
                        ?>

                    </div>
                </div> <!-- row buttons -->

                <?php echo $this->Form->end(); ?>

            </div>
        </div> <!-- row -->
    </div> <!-- well -->
</div> <!-- container -->


<!-- //////////////////////////////////////////////////////////////////////////////////////////////// -->


<script type='text/javascript' language='javascript'>


// $(document).ready(function() {

//     /*ID formulario*/
//     $('#edit_pass').formValidation({
//         framework: 'bootstrap',

//         /*Para que utilice los iconos de bootstrap*/
//         icon: {
//             valid: 'glyphicon glyphicon-ok',
//             invalid: 'glyphicon glyphicon-remove',
//             validating: 'glyphicon glyphicon-refresh'
//         },


//         fields: {

//               'data[User][password_update]': {
//                 validators: {
//                     notEmpty: {
//                         message: 'El campo no puede ser vacío'
//                     },
//                     stringLength: {
//                         min:6,
//                         max: 30,
//                         message: 'Debe tener al menos 6 caracteres y menos de 30 caracteres'
//                     },


//                     regexp: {
//                         regexp: /(^(?=.*[a-z])(?=.*[A-Z])(?=.*\d){6,20}.+$)/,
//                         message: 'Debe tener al menos una mayúscula, una minúscula y un número'
//                     },


//                     different: {
//                         field: 'data[User][username]',
//                         message: 'El password no puede ser igual al Nombre de usuario'
//                     }
//                 }
//             },


//             'data[User][password_confirm_update]': {
//                 validators: {
//                     notEmpty: {
//                         message: 'El campo no puede ser vacío'
//                     },

//                      identical: {
//                         field: 'data[User][password_update]',
//                         message: 'Las contraseñas no coinciden'
//                     }
//                 }
//             }

//         //////////////////////////////////////////////////////////////////////////////////////////////////////////////

//         }
//     });
// });
</script>