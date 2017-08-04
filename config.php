<!DOCTYPE html>

<?php 
    require_once('scripts/VerificarLogin.php');
    require("scripts/mysql/conexion.php");

    $strSQL = "Select Nombre, Apellido, Usuario From Usuarios Where ID = $_SESSION[UsuarioID]";
            
    $query = mysqli_query($conn, $strSQL);

    if (!$query)
        die('Error al ejecutar la consulta: ' . mysqli_error($conn));

    $valor = mysqli_fetch_assoc($query);
?>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>Primeros pasos</title>

        <!-- Vendor styles -->
        <link rel="stylesheet" href="vendors/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css">
        <link rel="stylesheet" href="vendors/bower_components/animate.css/animate.min.css">
        <!--<link rel="stylesheet" href="vendors/bower_components/jquery.scrollbar/jquery.scrollbar.css">-->

        <link rel="stylesheet" href="vendors/croppie/croppie.css" />

        <!-- App styles -->
        <link rel="stylesheet" href="css/app.min.css">

        <link href="css/mios.css" rel="stylesheet">

        <style>
            .modalRecortar {
                width:450px !important;
            }
        </style>

    </head>

    <body data-ma-theme=<?php echo $_SESSION['Skin']; ?>>
        <main class="main">
            <div class="page-loader">
                <div class="page-loader__spinner">
                    <svg viewBox="25 25 50 50">
                        <circle cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
                    </svg>
                </div>
            </div>

            <header class="header">

                <div class="header__logo hidden-sm-down">
                    <h1 style="color:white">Primeros Pasos</h1>
                </div>

                <ul class="top-nav">

                </ul>
            </header>

            <aside class="chat">
                <div class="chat__header">
                    <h2 class="chat__title">Centro de actividades</h2>
                </div>

                <div class="listview listview--hover chat__buddies scrollbar-inner">
                    <a class="listview__item chat__available">
                        <img src="demo/img/profile-pics/7.jpg" class="listview__img" alt="">

                        <div class="listview__content">
                            <div class="listview__heading">Jeannette Lawson</div>
                            <p>hey, how are you doing.</p>
                        </div>
                    </a>

                    <a class="listview__item chat__available">
                        <img src="demo/img/profile-pics/5.jpg" class="listview__img" alt="">

                        <div class="listview__content">
                            <div class="listview__heading">Jeannette Lawson</div>
                            <p>hmm...</p>
                        </div>
                    </a>

                    <a class="listview__item chat__away">
                        <img src="demo/img/profile-pics/3.jpg" class="listview__img" alt="">

                        <div class="listview__content">
                            <div class="listview__heading">Jeannette Lawson</div>
                            <p>all good</p>
                        </div>
                    </a>

                    <a class="listview__item">
                        <img src="demo/img/profile-pics/8.jpg" class="listview__img" alt="">

                        <div class="listview__content">
                            <div class="listview__heading">Jeannette Lawson</div>
                            <p>morbi leo risus portaac consectetur vestibulum at eros.</p>
                        </div>
                    </a>

                    <a class="listview__item">
                        <img src="demo/img/profile-pics/6.jpg" class="listview__img" alt="">

                        <div class="listview__content">
                            <div class="listview__heading">Jeannette Lawson</div>
                            <p>fusce dapibus</p>
                        </div>
                    </a>

                    <a class="listview__item chat__busy">
                        <img src="demo/img/profile-pics/9.jpg" class="listview__img" alt="">

                        <div class="listview__content">
                            <div class="listview__heading">Jeannette Lawson</div>
                            <p>cras mattis consectetur purus sit amet fermentum.</p>
                        </div>
                    </a>
                </div>

                <!--<a href="messages.html" class="btn btn--action btn--fixed btn-danger"><i class="zmdi zmdi-plus"></i></a>-->
            </aside>

            <section class="content content--full">

                <div class="card">

                    <div class="card-block">
                        

                        <div class="wizard fw-container">

                            <ul class="nav nav-tabs nav-fill" role="tablist" id="Pestañas">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#tab1" data-toggle="tab" role="tab">Bienvenido</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link disabled" href="#tab2" data-toggle="tab" role="tab">Perfil</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link disabled" href="#tab3" data-toggle="tab" role="tab">Personalización</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link disabled" href="#tab4" data-toggle="tab" role="tab">Terminando...</a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane fade active show" id="tab1">
                                    <p>Bienvenido/a a Pat. Este asistente te guiará a través de unos simples pasos de configuración. Por favor, no cierres
                                        la ventana hasta terminar.</p>
                                    <p>Recuerda que este proceso se realiza una sola vez. Si deseas cambiar tu configuración de usuario más adelante,
                                        dirígete a la sección <em>Mi perfil</em> en el menú de la izquierda.</p>
                                    <p>Pulsa la flecha a la derecha en la parte inferior del Asistente para continuar.</p>
                                </div>
                                <div class="tab-pane fade" id="tab2">
                                    <p>Esta es la información que figura en su perfil de usuario. Confirme que es correcta y, caso contrario, corríjala.</p>
                                    <div class="row">
                                        <div class="col-sm-4 col-md-3 text-center">
                                            <div class="redondear" id="imagencontainer" style="width: 210px;
                                                                            height: 210px; background-image: url('img/Avatares/default.png')">
                                                <a href="" onclick="document.getElementById('imgInp').click(); return false" class="pmop-edit">
                                                                                <i class="zmdi zmdi-camera"></i> <span>Cambiar Avatar</span>
                                                                            </a>
                                                <input type='file' id="imgInp" style="visibility: hidden; width: 1px; height: 1px" />
                                            </div>
                                        </div>
                                        <div class="col-sm-8 col-md-9">
                                            <div class="fg-line form-group">
                                                <label for="Perfil_Usuario">Usuario</label>
                                                <input type="text" class="form-control input-sm" id="Perfil_Usuario" placeholder="Usuario" disabled value=<?php echo $valor["Usuario"]; ?>>
                                            </div>
                                            <div class="fg-line form-group">
                                                <label for="Perfil_Nombre">Nombre</label>
                                                <input type="text" class="form-control input-sm" id="Perfil_Nombre" placeholder="Nombre" value=<?php echo $valor['Nombre']; ?>>
                                            </div>
                                            <div class="fg-line form-group">
                                                <label for="Perfil_Apellido">Apellido</label>
                                                <input type="text" class="form-control input-sm" id="Perfil_Apellido" placeholder="Apellido" value=<?php echo $valor["Apellido"]; ?>>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="tab3">
                                    <p>El Color de Énfasis se aplica a varios controles en todo el programa. Elija el que le resulte más atractivo visualmente.</p>
                                    <p>Recuerde que siempre puede modificar esto mediante el menú desplegable en la esquina superior derecha del encabezado.</p>

                                    <div class="btn-group btn-group--colors mt-2 theme-switch" data-toggle="buttons">
                                        <label class="btn bg-green"><input type="radio" value="green" autocomplete="off"></label>
                                        <label class="btn bg-blue"><input type="radio" value="blue" autocomplete="off"></label>
                                        <label class="btn bg-red"><input type="radio" value="red" autocomplete="off"></label>
                                        <label class="btn bg-orange"><input type="radio" value="orange" autocomplete="off"></label>
                                        <label class="btn bg-teal"><input type="radio" value="teal" autocomplete="off"></label>
                                        <label class="btn bg-cyan"><input type="radio" value="cyan" autocomplete="off"></label>
                                        <label class="btn bg-blue-grey"><input type="radio" value="blue-grey" autocomplete="off"></label>
                                        <label class="btn bg-purple"><input type="radio" value="purple" autocomplete="off"></label>
                                        <label class="btn bg-indigo"><input type="radio" value="indigo" autocomplete="off"></label>
                                        <label class="btn bg-lime"><input type="radio" value="lime" autocomplete="off"></label>
                                    </div>

                                </div>
                                <div class="tab-pane fade" id="tab4">
                                    <p>¡Ya casi terminamos!</p>
                                    <p>Elija una contraseña personal. Recuerde no compartirla con nadie, y desconectarse antes de dejar la computadora.
                                        Se atribuirá a cada persona las acciones registradas por su usuario.</p>
                                    <p>La contraseña debe tener al menos cinco dígitos de longitud.</p>
                                    <div class="fg-line form-group">
                                        <label for="Perfil_Contraseña">Contraseña</label>
                                        <input id="Perfil_Contraseña" type="password" class="form-control" placeholder="Contraseña">
                                    </div>

                                    <button id="btn-antiguos" class="btn btn-default" type="button" onclick="Enviar();">
                                        <i class="zmdi zmdi-check-circle"></i> ¡Finalizar!
                                    </button>
                                </div>

                                <br>

                                <button id="btnAnterior" class="btn btn-secondary btn--icon"><i class="zmdi zmdi-arrow-back" disabled></i></button>
                                <button id="btnSiguiente" class="btn btn-secondary btn--icon"><i class="zmdi zmdi-arrow-forward"></i></button>
                                
                            </div>
                        </div>


                    </div>
                </div>


            <div class="modal fade" id="modalFinal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modalRecortar">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">¡YA ESTÁ!</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-4 text-center">                              
                                    <div class="redondear" id="imagenfinal" style="width: 110px;
                                        height: 110px; background-image: url('img/Avatares/default.png'); background-size: contain;">
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <h3>¡Bienvenido/a,</h3>
                                    <h1 id="NombreLbl">Nicolás!</h1>
                                </div>
                            </div>
                            Todo está listo. Pulsa el botón para continuar al sistema.
                        </div>
                        <div class="modal-footer">
                            <button data-dismiss="modal" type="button" class="btn btn-link" onclick="window.location='protocolos.php';">¡VAMOS ALLÁ!</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Recortar -->
            <div class="modal fade" id="modalRecortar" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modalRecortar">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Recortar imagen</h4>
                        </div>
                        <div class="modal-body">
                            <div id="imagen" style="width: 400px; height: 400px;"></div>
                        </div>
                        <div class="modal-footer">
                            <button id="RecortaImagen" data-dismiss="modal" type="button" class="btn btn-link">Terminar</button>
                            <button id="RecortarCerrar" type="button" class="btn btn-link" data-dismiss="modal">Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>


                
        </section>
    </main>

        <!-- Older IE warning message -->
            <!--[if IE]>
                <div class="ie-warning">
                    <h1>Warning!!</h1>
                    <p>You are using an outdated version of Internet Explorer, please upgrade to any of the following web browsers to access this website.</p>

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
                    <p>Sorry for the inconvenience!</p>
                </div>
            <![endif]-->

        <!-- Javascript -->
        <!-- ../vendors -->
        <script src="vendors/bower_components/jquery/dist/jquery.min.js"></script>
        <script src="vendors/bower_components/tether/dist/js/tether.min.js"></script>
        <script src="vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="vendors/bower_components/Waves/dist/waves.min.js"></script>
        <!--<script src="vendors/bower_components/jquery.scrollbar/jquery.scrollbar.min.js"></script>
        <script src="vendors/bower_components/jquery-scrollLock/jquery-scrollLock.min.js"></script>-->

        <script src="vendors/croppie/croppie.min.js"></script>

        <script src="vendors/bower_components/salvattore/dist/salvattore.min.js"></script>


        <!-- App functions and actions -->
        <script src="js/mios.js"></script>
        <script src="js/app.min.js"></script>

    <script>

        $( ".bg-<?php echo $_SESSION['Skin']; ?>" ).addClass("active");

</script>

<script>
            var imageURI;
            var uploadCrop;

            function Enviar() {
                var bandera = 0;
                //Verifico a Dios y a María Santísima...
                if( $( '#Perfil_Contraseña' ).val().lenght < 5 ) bandera = 1;
                if( $( '#Perfil_Nombre' ).val().lenght < 2 ) bandera = 1;
                if( $( '#Perfil_Apellido' ).val().lenght < 2 ) bandera = 1;

                if( bandera == 1 ) { //ERROR
                    notificar('danger', "Asegúrese de completar los campos Nombre, Apellido y Contraseña de manera correcta antes de continuar. Use las flechas al pie para volver atrás y revisar los datos ingresados.");
                    return;
                }

                var form = new Object();
                form.Nombre =                   $( '#Perfil_Nombre' ).val();
                form.Apellido =                 $( '#Perfil_Apellido' ).val();
                form.Clave =                    $( '#Perfil_Contraseña' ).val();
                form.Avatar =                   imageURI;

                var postInfo = JSON.stringify(form);

                $.post( "scripts/GuardaPerfil.php", postInfo) .done(function( data ) {
                    resp = JSON.parse(data);
                    switch (resp.Codigo) {
                        case 1:
                            $("#NombreLbl").html(form.Nombre.split(' ')[0] + "!");
                            $('#modalFinal').modal('show');
                            break;
                        case 10: //Error MySQL
                            notificar('danger', resp.Mensaje);
                            break;
                    }
                });
            }

            $("#modalRecortar").on('shown.bs.modal', function(){
                if (typeof uploadCrop == 'undefined') {
                    uploadCrop = $('#imagen').croppie({
                        url: imageURI,
                        viewport: { width: 210, height: 210, type: 'circle' },
                        boundary: { width: 400, height: 400 },
                        showZoomer: false
                    });

                    var vanillaResult = document.getElementById('RecortaImagen');
                    var vanillaCerrar = document.getElementById('RecortarCerrar');

                    vanillaCerrar.addEventListener('click', function() {
                        imageURI = "";
                    });

                    vanillaResult.addEventListener('click', function() {
                        uploadCrop.croppie('result', {
                            type: 'canvas',
                            size: {
                                width: 210,
                                height: 210
                            }
                        }).then(function (resp) {
                            imageURI = resp;
                            $('#imagencontainer').css('background-image', 'url(' + imageURI + ')');
                            $('#imagenfinal').css('background-image', 'url(' + imageURI + ')');
                            $('#picAvatar').attr('src', imageURI);
                            Enviar();
                        });
                    });
                } else {
                    uploadCrop.croppie('bind', {
                        url: imageURI
                    });
                }
            });

            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    
                    reader.onload = function (e) {
                        imageURI = e.target.result;
                        $('#modalRecortar').modal('show');

                        //$('#imagencontainer').css('background-image', 'url(' + e.target.result + ')');

                    }
                    
                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#imgInp").change(function(){
                var fileTypes = ['gif', 'jpg', 'png', 'jpeg'];
                var filaName = $('#imgInp').val();
                var lastFive = filaName.substr(filaName.length - 4); //Extraño bug en split con antibarra?
                var dots = lastFive.split(".");
                
                //get the part AFTER the LAST period.
                var fileType = dots[dots.length-1];

                if ($.inArray(fileType, fileTypes) != -1) {
                    readURL(this);
                } else {
                    notificar('danger', 'Por favor, seleccione un archivo de imágen válido');
                }

            });

    //Wizard
    $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

        var $target = $(e.target);
    
        if ($target.parent().hasClass('disabled')) {
            return false;
        }
    });

    $("#btnSiguiente").click(function (e) {

        var $active = $('.wizard .nav-tabs li.active');
        $active.next().removeClass('disabled');
        nextTab($active);

    });
    $("#btnAnterior").click(function (e) {

        var $active = $('.wizard .nav-tabs li.active');
        prevTab($active);

    });

    function nextTab(elem) {
        $(elem).next().find('a[data-toggle="tab"]').click();
        alert("hoila");
    }
    function prevTab(elem) {
        $(elem).prev().find('a[data-toggle="tab"]').click();
    }
            
        </script>

    </body>
</html>