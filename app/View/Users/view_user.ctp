<?php $this->assign('head_description', 'Detalles Usuario');?>

<div class="container">
    <div class="well">

        <div class="row">

            <div class="col-md-3">

                <?php echo $this->element('user_actions_lateral_menu_element'); ?>
            </div>

            <div class="col-md-9">

                <h4>Datos Personales</h4>

                <p> <span> Username: </span> <?php echo $user['User']['email']; ?></p>

                <p> <span> Nombre: </span> <?php echo $user['User']['first_name']; ?></p>

                <p> <span> Apellido: </span> <?php echo $user['User']['last_name']; ?></p>

                <p> <span> Email: </span> <?php echo $user['User']['date_of_birth']; ?></p>

                <p> <span> Número Celular: </span> <?php echo $user['User']['cell_number']; ?></p>

            </div>
        </div> <!-- Cierra row-->
    </div><!-- well-->
</div><!-- container -->
