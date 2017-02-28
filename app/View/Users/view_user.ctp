
<?php $this->assign('head_description', 'Detalles Usuario ....');?>

<div class="container">
    <div class="well">

        <div class="row">

            <div class="col-md-3">

                <?php echo $this->element('user_actions_lateral_menu'); ?>
            </div>

            <div class="col-md-9 lado_derecho">

                <div class="row titulo">

                    <div class="col-xs-12">

                       <h3>Datos Personales</h3>

                    </div>

                </div>

                <div class="row datos">

                    <div class="col-xs-12">

                        <p> <span class="detalles"> Username: </span> <?php echo $user['User']['email']; ?></p>

                        <p> <span class="detalles"> Nombre: </span> <?php echo $user['User']['first_name']; ?></p>

                        <p> <span class="detalles"> Apellido: </span> <?php echo $user['User']['last_name']; ?></p>

                        <p> <span class="detalles"> Email: </span> <?php echo $user['User']['date_of_birth']; ?></p>

                        <p> <span class="detalles"> Número Celular: </span> <?php echo $user['User']['cell_number']; ?></p>

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

    </div><!-- well-->
</div><!-- container -->

