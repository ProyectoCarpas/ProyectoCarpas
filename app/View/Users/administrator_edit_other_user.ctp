<?php $this->assign('head_description', 'Editar User');?>

<div class="container">
    <div class="well">

        <div class="row">

            <div class="col-xs-12">

                <h4> Editar Perfil </h4>

                <?php
                echo $this->Form->create('User',
                                    array('id' => 'editUser',
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

                echo $this->Form->hidden('id');

                echo $this->Form->input('email',
                                            array('between' => '<div class="col-sm-9 col-md-7 col-lg-6">',
                                                  'after' =>  '</div>',
                                                  'placeholder' => 'Email...',
                                                  'readonly' => 'readonly',
                                                  'label' => array('class' => 'col-sm-3 col-md-2 control-label',
                                                                  'text'  => 'Email <span> * </span>'
                                                            )
                ));

                echo $this->Form->input('first_name',
                                            array('between' => '<div class="col-sm-9 col-md-7 col-lg-6">',
                                                  'after' => '</div>',
                                                  'label' => array('class' => 'col-sm-3 col-md-2 control-label',
                                                                   'text'  => 'Nombre <span> * </span>'
                                                            )
                ));

                echo $this->Form->input('last_name',
                                            array('between' => '<div class="col-sm-9 col-md-7 col-lg-6">',
                                                  'after' =>  '</div>',
                                                  'placeholder' => 'Apellido',
                                                  'label' => array('class' => 'col-sm-3 col-md-2 control-label',
                                                                   'text'  => 'Apellido <span> * </span>'
                                                            )
                ));


                echo $this->Form->input('date_of_birth',
                                            array('between' => '<div class="col-sm-9 col-md-7 col-lg-6">',
                                                  'after' =>   '</div>',
                                                  'placeholder' => 'Fecha de Nacimiento',
                                                  'label' => array('class' => 'col-sm-3 col-md-2 control-label',
                                                                   'text'  => 'Fecha de Nacimiento'
                                                            )
                ));

                echo $this->Form->input('cell_number',
                                            array('between' => '<div class="col-sm-9 col-md-7 col-lg-6">',
                                                  'after' =>   '</div>',
                                                  'placeholder' => 'Número Celular',
                                                  'label' => array('class' => 'col-sm-3 col-md-2 control-label',
                                                                   'text'  => 'Número Celular'
                                                            )
                ));
                ?>

                <div class="row">

                    <div class="col-xs-12 col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2">

                        <?php
                        echo $this->Html->link('<span class="glyphicon glyphicon-circle-arrow-left"></span> Volver',

                                                  array('controller' => 'users', 'action' => 'viewUser',
                                                        $this->Session->read('Auth.User.id')),

                                                  array('class' => 'btn btn-primary btn-sm',
                                                        'escape' => false
                                                  )
                        );

                        echo "&nbsp;&nbsp;";

                        echo $this->Form->button('<span class="glyphicon glyphicon-floppy-saved"></span> Guardar',

                                                  array('type' => 'submit',
                                                        'class' => 'btn btn-info btn-sm',
                                                        'escape' => false
                                                  )
                        );
                        ?>

                    </div>
                </div> <!-- row button-->

                <?php echo $this->Form->end(); ?>

            </div>
        </div> <!-- row -->
    </div> <!-- well -->
</div> <!-- container -->



<!-- //////////////////////////////////////////////////////////////////////////////////////////////// -->

 <script type='text/javascript' language='javascript'>

// $(document).ready(function() {

//     $('#edit').formValidation({
//         framework: 'bootstrap',

//         icon: {
//             valid: 'glyphicon glyphicon-ok',
//             invalid: 'glyphicon glyphicon-remove',
//             validating: 'glyphicon glyphicon-refresh'
//         },

//         fields: {

//             'data[User][first_name]': {
//                 validators: {
//                     notEmpty: {
//                         message: 'El campo no puede ser vacío'
//                     },
//                     stringLength: {
//                         min: 6,
//                         max: 30,
//                         message: 'Debe tener entre 6 y 30 caracteres'
//                     },
//                     regexp: {
//                         regexp: /^[a-zA-Z0-9áéíóúÁÉÍÓÚÑñ_ \-]+$/,
//                         message: 'Solo letras, números, puntos o guiones bajos'
//                     }
//                 }
//             },

//             'data[User][last_name]': {
//                 validators: {
//                     notEmpty: {
//                         message: 'El campo no puede ser vacío'
//                     },
//                     stringLength: {
//                         min:2,
//                         max: 30,
//                         message: 'Debe tener al menos 2 caracteres y menos de 30 caracteres'
//                     },
//                     regexp: {
//                         regexp: /^[a-zA-Z0-9áéíóúÁÉÍÓÚÑñ_ \-]+$/,
//                         message: 'Solo letras, números, puntos o guiones bajos'
//                     }
//                 }
//             },

//             'data[User][date_of_birth]': {
//                 validators: {
//                     notEmpty: {
//                         message: 'El campo no puede ser vacío'
//                     }
//                 }
//             }
//         }
//     });
// });
</script>