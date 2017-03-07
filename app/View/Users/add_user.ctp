<?php $this->assign('head_description', 'Crear Cuenta');?>

<div class="container">
    <div class="well">

        <div class="row">

            <div class="col-xs-12">

                <h4> Crear Cuenta </h4>

                <?php
                echo $this->Form->create('User',
                                            array('id' => 'addUser',
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
                                            array('between' => '<div class="col-sm-9 col-md-7 col-lg-6">',
                                                  'after' =>   '</div>',
                                                  'placeholder' => 'Email...',
                                                  'label' => array('class' => 'col-sm-3 col-md-2 control-label',
                                                                   'text'  => 'Email <span> * </span>'
                                                              )
                ));


                echo $this->Form->input('first_name',
                                            array('between' => '<div class="col-sm-9 col-md-7 col-lg-6">',
                                                  'after' =>   '</div>',
                                                  'label' => array('class' => 'col-sm-3 col-md-2 control-label',
                                                                   'text'  => 'Nombre <span> * </span>'
                                                              )
                ));

                echo $this->Form->input('last_name',
                                            array('between' => '<div class="col-sm-9 col-md-7 col-lg-6">',
                                                  'after' =>   '</div>',
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

                echo $this->Form->input('password',
                                            array('between' => '<div class="col-sm-9 col-md-7 col-lg-6">',
                                                  'after' =>   '</div>',
                                                  'placeholder' => 'Password',
                                                  'label' => array('class' => 'col-sm-3 col-md-2 control-label',
                                                                   'text'  => 'Password <span> * </span>'
                                                              )
                ));

                echo $this->Form->input('password_confirm',
                                            array('between' => '<div class="col-sm-9 col-md-7 col-lg-6">',
                                                  'after' =>   '</div>',
                                                  'placeholder' => 'Confirmar Password',
                                                  'label' => array('class' => 'col-sm-3 col-md-2 control-label',
                                                                   'text'  => 'Confirmar Password <span> * </span>'
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

                          echo $this->Form->button('<span class="glyphicon glyphicon-floppy-saved"></span> Guardar',
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
