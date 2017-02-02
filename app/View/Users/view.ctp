<?php echo $this->Html->css('styles/styles_USERS_view', array('inline' => false)); ?>


<?php $this->assign('head_description', 'Detalles Usuario - Info Parana. Minorista y Compra Online de Articulos de Informatica - Parana, Entre Rios - Tel: 0343 - 4000000. ');?>

<div class="container well">

    <div class="row">

        <!-- Recordar que el Administrador puede VER los detalles de cualquier usuario. Sin embargo no puede editarlos, es decir
        no debe ser capaz de poder ver la barra lateral. Solo es posible ver la barra lateral si se esta viendo a si mismo. -->
        <?php if($user['User']['id'] == $this->Session->read('Auth.User.id')){?>

          <div class="col-md-3 lado_izquierdo">

              <div class="row">

                  <div class="col-xs-12">

                      <div class="list-group">

                          <div class="list-group-item titulo_panel"> Operaciones Usuario</div>


                          <?php echo $this->Html->link('<span class="glyphicon glyphicon-eye-open"></span> Detalles',

                                                                          array('controller' => 'users',
                                                                                'action' => 'view',
                                                                                $this->Session->read('Auth.User.id')),

                                                                          array('class' =>'list-group-item active',
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

              </div>

          </div> <!-- Cierra row-->

        <?php } ?>

        <!-- //////////////////////////////// -->

        <div class="col-md-9 lado_derecho">

            <div class="row titulo">

                <div class="col-xs-12">

                   <h3>Datos Personales</h3>

                </div>

            </div>

            <div class="row datos">

                <div class="col-xs-12">

                    <p> <span class="detalles"> Username: </span> <?php echo $user['User']['username']; ?></p>

                    <p> <span class="detalles"> Nombre: </span> <?php echo $user['User']['nombre']; ?></p>

                    <p> <span class="detalles"> Apellido: </span> <?php echo $user['User']['apellido']; ?></p>

                    <p> <span class="detalles"> Email: </span> <?php echo $user['User']['email']; ?></p>

                    <p> <span class="detalles"> Calle: </span> <?php echo $user['User']['calle']; ?>  &nbsp;  &nbsp;
                        <span class="detalles"> Número: </span> <?php echo $user['User']['numero']; ?>
                    </p>
                    <p> <span class="detalles"> Piso: </span> <?php echo $user['User']['piso']; ?>  &nbsp;  &nbsp;
                        <span class="detalles"> Depto: </span> <?php echo $user['User']['depto']; ?>
                    </p>

                    <p> <span class="detalles"> Localidad: </span> <?php echo $user['Localidade']['nombre']; ?></p>

                </div>

            </div> <!-- Cierra row-->

            <!-- ////////////// -->

            <div class="row botones">

                <div class="col-xs-12">

                      <?php echo $this->Html->link('<span class="glyphicon glyphicon-circle-arrow-left"></span> Volver', 'javascript:history.go(-1)',
                                                              array('class'=>'btn btn-primary btn-sm',
                                                                    'escape' => false));  ?>

                </div> <!--fin Col-md-12 -->

            </div> <!--fin ROW -->

        </div> <!--fin Col-md-9 -->


    </div> <!--fin ROW -->

    <!-- //////////// -->


    

</div><!-- Cierro container -->

