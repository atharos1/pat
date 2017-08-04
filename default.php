<?php 
	session_start();
    if( isset($_SESSION['UsuarioID'] )) header('Location: protocolos.php');
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>Bienvenido - PaT2</title>

        <!-- Vendor styles -->
        <link rel="stylesheet" href="vendors/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css">
        <link rel="stylesheet" href="vendors/bower_components/animate.css/animate.min.css">

        <!-- App styles -->
        <link rel="stylesheet" href="css/app.min.css">

        <link rel="stylesheet" href="css/login.css">
    </head>

    <body data-ma-theme="green">
        <div id="gradient" class="login">

            <!-- Login -->
            <div class="login__block active" id="l-login">
                <div class="login__block__header">
                    <i class="zmdi zmdi-account-circle"></i>
                    ¡Bienvenido! Inicia Sesión
                </div>

                <div class="login__block__body">
                    <div class="form-group form-group--float form-group--centered">
                        <input id="Usuario" type="text" class="form-control" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" onkeypress="if( event.which == 13) Loguea();">
                        <label>Nombre de usuario</label>
                        <i class="form-group__bar"></i>
                    </div>

                    <div class="form-group form-group--float form-group--centered">
                        <input id="Clave" type="password" class="form-control" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" onkeypress="if( event.which == 13) Loguea();">
                        <label>Contraseña</label>
                        <i class="form-group__bar"></i>
                    </div>

                    
                    <label class="custom-control custom-checkbox">
                        <input id="Recordar" type="checkbox" class="custom-control-input" <?php if( isset( $_COOKIE['recordarme'] )) echo "checked='checked'"; ?>>
                        <span class="custom-control-indicator"></span>
                        <span class="custom-control-description">Recordar mi nombre de usuario</span>
                    </label>

                    <div class="clearfix mb-2"></div>

                    <a onclick="Loguea();" role="button" tabindex="0" class="btn btn--icon login__block__btn"><i class="zmdi zmdi-long-arrow-right"></i></a>
                </div>
            </div>
        </div>

        <!-- Older IE warning message -->
            <!--[if IE]>
                <div class="ie-warning">
                    <h1>¡¡Atención!!</h1>
                    <p>Está usando un navegador desactualizado. Por favor, actualice para continuar al sistema.</p>

                    <div class="ie-warning__downloads">
                        <a href="http://www.google.com/chrome">
                            <img src="img/browsers/chrome.png" alt="">
                        </a>

                        <a href="https://www.mozilla.org/en-US/firefox/new">
                            <img src="img/browsers/firefox.png" alt="">
                        </a>

                        <a href="http://www.opera.com">
                            <img src="img/browsers/opera.png" alt="">
                        </a>

                        <a href="https://support.apple.com/downloads/safari">
                            <img src="img/browsers/safari.png" alt="">
                        </a>

                        <a href="https://www.microsoft.com/en-us/windows/microsoft-edge">
                            <img src="img/browsers/edge.png" alt="">
                        </a>

                        <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                            <img src="img/browsers/ie.png" alt="">
                        </a>
                    </div>
                    <p>Disculpe las molestias.</p>
                </div>
            <![endif]-->

        <!-- Javascript -->
        <!-- Vendors -->
        <script src="vendors/bower_components/jquery/dist/jquery.min.js"></script>
        <script src="vendors/bower_components/tether/dist/js/tether.min.js"></script>
        <script src="vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="vendors/bower_components/remarkable-bootstrap-notify/dist/bootstrap-notify.min.js"></script>
        <script src="vendors/bower_components/Waves/dist/waves.min.js"></script>

        <!-- App functions and actions -->
        <script src="js/mios.js"></script>
        <script src="js/app.min.js"></script>

        <script src="js/login.js"></script>

        <script>

            if( localStorage.Recordar ) {
                $( '#Recordar' ).prop('checked', true);
                $( '#Usuario' ).val(localStorage.Recordar);
            }
            
            function Loguea() {

                var form = new Object();

                form.Usuario =  $( '#Usuario' ).val();
                form.Clave =    $( '#Clave' ).val();
                form.Recordar = + $( '#Recordar' ).prop('checked');

                var postInfo = JSON.stringify(form);

                $.post( "scripts/LogIn.php", postInfo) .done(function( data ) {
                    resp = JSON.parse(data);
                    switch (resp.Codigo) {
                        case 1: //Todo ok
                        case 3:
                            if( resp.Codigo == 1 ) window.location = "protocolos.php";
                            if( resp.Codigo == 3 ) window.location = "config.php"; //Primer inicio

                            if( form.Recordar == 1 ) 
                                localStorage.Recordar = form.Usuario;
                             else 
                                if( localStorage.Recordar ) localStorage.removeItem( "Recordar" );

                            break;
                        
                        case 2: //Error autenticación
                        case 10: //Error MySQL
                            notificar('danger', resp.Mensaje);
                            break;
                    }
                });
            }

        </script>

    </body>
</html>