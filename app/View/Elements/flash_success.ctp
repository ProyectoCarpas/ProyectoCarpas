<div class="container flash_mes_success">
    <div class="alert alert-success alert-hover" id="flash_success">
        <button class="close">x</button>
        <i class="fa fa-check"></i> <strong> <?php echo $message; ?> </strong>
    </div>
</div>


    <script type="text/javascript">

    // Oculto el mensaje luego de 8 segundos y tardo 1.5 para el fadeout.
    $(document).ready(function() {
        setTimeout(function() {
            $(".flash_mes_success").fadeOut(1500);
        },8000);
    });

    $('#flash_success').addClass('animated fadeInDown');
    $( ".close" ).click(function() {
        jQuery('#flash_success').removeClass('fadeInDown');
        jQuery('#flash_success').addClass('fadeOutUp');
    });
    </script>


    <style>
        div.container.flash_mes_success div#flash_success{
            background: ;
            font-style: bold;
            margin-top: 6px;
            position: absolute;
            width: 70%;
            height: 42px;
        }


/*////////////////////////////////////// MOBILE //////////////////////////////////////////*/

        /*Para que el ancho del mensaje ocupe toda el ancho de la pantalla */
        @media screen and (max-width: 768px){
            div.container.flash_mes_success div#flash_success{
                width: 100%;
            }
        }

    </style>
