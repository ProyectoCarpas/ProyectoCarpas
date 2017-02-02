    <div class="container flash_mes_error">

        <div class="alert alert-danger alert-hover" id="flash_error">
            <button class="close">x</button>

            <!-- Aca esta el iconito que se ve en el mensajes y el mensaje en si -->
            <i class="fa fa-exclamation-circle"></i> <strong> <?php echo $message; ?> </strong>
        </div>
    </div>


    <script type="text/javascript">

    // Oculto el mensaje luego de 8 segundos y tardo 1.5 para el fadeout.
    $(document).ready(function() {
        setTimeout(function() {
            $(".flash_mes_error").fadeOut(1500);
        },8000);
    });


    $('#flash_error').addClass('animated fadeInDown');
    $( ".close" ).click(function() {
        jQuery('#flash_error').removeClass('fadeInDown');
        jQuery('#flash_error').addClass('fadeOutUp');
    });
    </script>



    <style>
        div.container.flash_mes_error div#flash_error{
            font-style: bold;
            margin-top: 6px;
            position: absolute;
            width: 70%;
            height: 42px;
        }

/*////////////////////////////////////// MOBILE //////////////////////////////////////////*/

        /*Para que el ancho del mensaje ocupe toda el ancho de la pantalla */
        @media screen and (max-width: 768px){
            div.container.flash_mes_error div#flash_error{
                width: 100%;
            }
        }

    </style>
