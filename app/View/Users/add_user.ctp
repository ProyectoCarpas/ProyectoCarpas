<?php $this->assign('head_description', 'Escribir algooo');?>


<?php echo $this->Form->create('User', array('id' => 'addUser',
                                                         'class' => 'form-horizontal',
                                                         'novalidate' => 'novalidate',
                                                         'inputDefaults' => array(
                                                                                'div' => array(
                                                                                               'class' => 'form-group has-feedback'
                                                                                              ),
                                                                                'class' => 'form-control',
                                                                                'autocomplete' => 'off'
                                                                                )
                                                            ));
        ?>

        <div class="col-md-9">

            <div class="row titulo">

                  <div class="col-xs-12">
                      <h4>Editar Perfil</h4>
                  </div>

            </div>

            <div class="row formulario">

                <div class="col-xs-12">

                    <?php echo $this->Form->input('email', array('between' => '<div class="col-sm-9 col-md-7 col-lg-6">',
                                             'after' =>   '</div>',
                                             'placeholder' => 'Email...',
                                             'label' => array('class' => 'col-sm-3 col-md-2 control-label',
                                                              'text'  => 'Email <span> * </span>'
                                              )
                            ));
                    ?>

                    <?php echo $this->Form->input('first_name', array('between' => '<div class="col-sm-9 col-md-7 col-lg-6">',
                                                                      'after' =>   '</div>',
                                                                      'label' => array('class' => 'col-sm-3 col-md-2 control-label',
                                                                        'text'  => 'Nombre <span> * </span>'
                                                                      )
                                                ));
                    ?>

                    <?php echo $this->Form->input('last_name', array('between' => '<div class="col-sm-9 col-md-7 col-lg-6">',
                                                                  'after' =>   '</div>',
                                                                  'placeholder' => 'Apellido',
                                                                  'label' => array('class' => 'col-sm-3 col-md-2 control-label',
                                                                                   'text'  => 'Apellido <span> * </span>'
                                                                                  ),
                                                ));
                    ?>

                    <?php echo $this->Form->input('date_of_birth', array('between' => '<div class="col-sm-9 col-md-7 col-lg-6">',
                                                                  'after' =>   '</div>',
                                                                  'placeholder' => 'Fecha de Nacimiento',
                                                                  'label' => array('class' => 'col-sm-3 col-md-2 control-label',
                                                                                   'text'  => 'Fecha de Nacimiento'
                                                                                  ),
                                                ));
                    ?>

                    <?php echo $this->Form->input('cell_number', array('between' => '<div class="col-sm-9 col-md-7 col-lg-6">',
                                                                  'after' =>   '</div>',
                                                                  'placeholder' => 'Número Celular',
                                                                  'label' => array('class' => 'col-sm-3 col-md-2 control-label',
                                                                                   'text'  => 'Número Celular'
                                                                                  ),
                                                ));
                    ?>

                    <?php echo $this->Form->input('password', array('between' => '<div class="col-sm-9 col-md-7 col-lg-6">',
                                                                  'after' =>   '</div>',
                                                                  'placeholder' => 'Password',
                                                                  'label' => array('class' => 'col-sm-3 col-md-2 control-label',
                                                                                   'text'  => 'Password'
                                                                                  ),
                                                ));
                    ?>

                    <?php echo $this->Form->input('password_confirm', array('between' => '<div class="col-sm-9 col-md-7 col-lg-6">',
                                                                  'after' =>   '</div>',
                                                                  'placeholder' => 'Confirmar Password',
                                                                  'label' => array('class' => 'col-sm-3 col-md-2 control-label',
                                                                                   'text'  => 'Confirmar Password'
                                                                                  ),
                                                ));
                    ?>

                </div>

            </div> <!-- Cierra row-->

            <!-- //////////////////// -->

            <div class="row botones">

                  <!-- Dejo 2 columnas vacias-->
                  <div class="col-xs-12 col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2">

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