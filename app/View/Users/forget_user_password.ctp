<?php $this->assign('head_description', 'Contraseña olvidada');?>

<div class="container">
    <div class="well">

        <div class="row">

            <div class="col-xs-12">

                <h4> Resetear Contraseña </h4>

                <?php
                echo $this->Form->create('User',
                                            array('id' => 'forgetUserPassword',
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
             
                echo $this->Form->input('email',
                                            array('between' => '<div class="col-sm-5 col-md-4">',
                                                  'after' =>   '</div>',
                                                  'placeholder' => 'Email',
                                                  'autofocus'=>'autofocus',
                                                  'label' => array('class' => 'col-sm-3 col-md-2 control-label',
                                                                   'text'  => 'Email <span> * </span>'
                                                            )
                ));
                ?>

                <div class="row">

                    <div class="col-xs-12 col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2">

                        <?php
                        echo $this->Html->link('<span class="glyphicon glyphicon-circle-arrow-left"></span> Volver',

                                                array('controller' => 'users', 'action' => 'login'),
                                                array('class' => 'btn btn-primary btn-sm',
                                                      'escape' => false
                                                )
                        );

                        echo "&nbsp;&nbsp;";

                        echo $this->Form->button('<span class="glyphicon glyphicon-floppy-saved"></span> Enviar',
                                                array('type' => 'submit',
                                                      'class' => 'btn btn-info btn-sm',
                                                      'escape' => false
                                                )
                        );
                        ?>

                    </div>
                </div> <!-- row buttons-->

                <?php echo $this->Form->end(); ?>

            </div>
        </div> <!-- row -->
    </div> <!-- well -->
</div> <!-- container -->



<!-- //////////////////////////////////////////////////////////////////////////////////////////////// -->


 <script type='text/javascript' language='javascript'>


// $(document).ready(function() {

//     /*ID formulario*/
//     $('#reset_password').formValidation({
//         framework: 'bootstrap',

//         /*Para que utilice los iconos de bootstrap*/
//         icon: {
//             valid: 'glyphicon glyphicon-ok',
//             invalid: 'glyphicon glyphicon-remove',
//             validating: 'glyphicon glyphicon-refresh'
//         },


//         fields: {

//                   'data[User][email]': {
//                             validators: {
//                                 notEmpty: {
//                                     message: 'El campo no puede ser vacio'
//                                 },
//                                 emailAddress: {
//                                     message: 'Debe proporcionar una direccion Email valida'
//                                 },
//                                 stringLength: {
//                                     min:6,
//                                     max: 50,
//                                     message: 'Debe tener al menos 6 caracteres y menos de 50 caracteres'
//                                 },
//                             }
//                         }

// //////////////////////////////////////////////////////////////////////////////////////////////////////////////

//         }
//     });
// });
</script>