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

        <title>Perfil</title>

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
                <div class="navigation-trigger" data-ma-action="aside-open" data-ma-target=".sidebar">
                    <div class="navigation-trigger__inner">
                        <i class="navigation-trigger__line"></i>
                        <i class="navigation-trigger__line"></i>
                        <i class="navigation-trigger__line"></i>
                    </div>
                </div>

                <div class="header__logo hidden-sm-down">
                    <h1 style="color:white">Tu Perfil</h1>
                </div>

                <ul class="top-nav">

                    <li class="dropdown hidden-xs-down">
                        <a href="" data-toggle="dropdown"><i class="zmdi zmdi-more-vert"></i></a>

                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-item theme-switch">
                                Conmutador de temas

                                <div class="btn-group btn-group--colors mt-2" data-toggle="buttons">
                                    <label class="btn bg-green"><input type="radio" value="green" autocomplete="off"></label>
                                    <label class="btn bg-blue"><input type="radio" value="blue" autocomplete="off"></label>
                                    <label class="btn bg-red"><input type="radio" value="red" autocomplete="off"></label>
                                    <label class="btn bg-orange"><input type="radio" value="orange" autocomplete="off"></label>
                                    <label class="btn bg-teal"><input type="radio" value="teal" autocomplete="off"></label>

                                    <br>

                                    <label class="btn bg-cyan"><input type="radio" value="cyan" autocomplete="off"></label>
                                    <label class="btn bg-blue-grey"><input type="radio" value="blue-grey" autocomplete="off"></label>
                                    <label class="btn bg-purple"><input type="radio" value="purple" autocomplete="off"></label>
                                    <label class="btn bg-indigo"><input type="radio" value="indigo" autocomplete="off"></label>
                                    <label class="btn bg-lime"><input type="radio" value="lime" autocomplete="off"></label>
                                </div>
                            </div>
                            <a href="" class="dropdown-item">Pantalla completa</a>
                            <a href="" class="dropdown-item">Limpiar caché</a>
                        </div>
                    </li>

                    <li class="hidden-xs-down">
                        <a href="" data-ma-action="aside-open" data-ma-target=".chat" class="top-nav__notify">
                            <i class="zmdi zmdi-comment-alt-text"></i>
                        </a>
                    </li>
                </ul>
            </header>

            <aside class="sidebar sidebar--hidden">
                <div class="scrollbar-inner">
                    <div class="user">
                        <div class="user__info" data-toggle="dropdown">
                            <img class="user__img" id="picAvatar" src=
                            <?php
                                echo "img/Avatares/". $_SESSION['UsuarioID'] .".png?" . filemtime("img/Avatares/". $_SESSION['UsuarioID'] .".png");
                            ?>
                            alt="">
                            <div>
                                <div class="user__name"><?php echo $_SESSION['Nombre']; ?></div>
                                <div class="user__email">Superusuario</div>
                            </div>
                        </div>

                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="perfil.php">Perfil</a>
                            <a class="dropdown-item" href="">Ajustes</a>
                            <a class="dropdown-item" href="scripts/LogOut.php">Desconectarse</a>
                        </div>
                    </div>

                    <ul class="navigation">
                        <li><a href="protocolos.php"><i class="zmdi zmdi-home"></i> Protocolos</a></li>

                        <li class="navigation__sub navigation__sub--toggled">
                            <a href=""><i class="zmdi zmdi-view-week"></i> Variants</a>

                            <ul>
                                <li><a href="hidden-sidebar.html">Hidden Sidebar</a></li>
                                <li><a href="boxed-layout.html">Boxed Layout</a></li>
                                <li><a href="hidden-sidebar-boxed-layout.html">Boxed Layout with Hidden Sidebar</a></li>
                                <li><a href="top-navigation.html">Top Navigation</a></li>
                            </ul>
                        </li>

                        <li><a href="typography.html"><i class="zmdi zmdi-format-underlined"></i> Typography</a></li>

                        <li><a href="widgets.html"><i class="zmdi zmdi-widgets"></i> Widgets</a></li>

                        <li class="navigation__sub">
                            <a href=""><i class="zmdi zmdi-view-list"></i> Tables</a>

                            <ul>
                                <li><a href="html-table.html">HTML Table</a></li>
                                <li><a href="data-table.html">Data Table</a></li>
                            </ul>
                        </li>

                        <li class="navigation__sub">
                            <a href=""><i class="zmdi zmdi-collection-text"></i> Forms</a>

                            <ul>
                                <li><a href="form-elements.html">Basic Form Elements</a></li>
                                <li><a href="form-components.html">Form Components</a></li>
                                <li><a href="form-validation.html">Form Validation</a></li>
                            </ul>
                        </li>

                        <li class="navigation__sub">
                            <a href=""><i class="zmdi zmdi-swap-alt"></i> User Interface</a>

                            <ul>
                                <li><a href="colors.html">Colors</a></li>
                                <li><a href="css-animations.html">CSS Animations</a></li>
                                <li><a href="buttons.html">Buttons</a></li>
                                <li><a href="icons.html">Icons</a></li>
                                <li><a href="listview.html">Listview</a></li>
                                <li><a href="toolbars.html">Toolbars</a></li>
                                <li><a href="cards.html">Cards</a></li>
                                <li><a href="alerts.html">Alerts</a></li>
                                <li><a href="badges.html">Badges</a></li>
                                <li><a href="breadcrumbs.html">Bredcrumbs</a></li>
                                <li><a href="jumbotron.html">Jumbotron</a></li>
                                <li><a href="navs.html">Navs</a></li>
                                <li><a href="pagination.html">Pagination</a></li>
                                <li><a href="progress.html">Progress</a></li>
                            </ul>
                        </li>

                        <li class="navigation__sub">
                            <a href=""><i class="zmdi zmdi-group-work"></i> Javascript Components</a>

                            <ul class="navigation__sub">
                                <li><a href="carousel.html">Carousel</a></li>
                                <li><a href="collapse.html">Collapse</a></li>
                                <li><a href="dropdowns.html">Dropdowns</a></li>
                                <li><a href="modals.html">Modals</a></li>
                                <li><a href="popover.html">Popover</a></li>
                                <li><a href="tabs.html">Tabs</a></li>
                                <li><a href="tooltips.html">Tooltips</a></li>
                                <li><a href="notifications-alerts.html">Notifications & Alerts</a></li>
                            </ul>
                        </li>

                        <li class="navigation__sub">
                            <a href=""><i class="zmdi zmdi-trending-up"></i> Charts</a>

                            <ul>
                                <li><a href="flot-charts.html">Flot</a></li>
                                <li><a href="other-charts.html">Other Charts</a></li>
                            </ul>
                        </li>

                        <li><a href="calendar.html"><i class="zmdi zmdi-calendar"></i> Calendar</a></li>

                        <li><a href="photo-gallery.html"><i class="zmdi zmdi-image"></i> Photo Gallery</a></li>

                        <li class="navigation__sub">
                            <a href=""><i class="zmdi zmdi-collection-item"></i> Sample Pages</a>

                            <ul>
                                <li><a href="profile-about.html">Profile</a></li>
                                <li><a href="messages.html">Messages</a></li>
                                <li><a href="contacts.html">Contacts</a></li>
                                <li><a href="groups.html">Groups</a></li>
                                <li><a href="pricing-tables.html">Pricing Tables</a></li>
                                <li><a href="invoice.html">Invoice</a></li>
                                <li><a href="todo-lists.html">Todo Lists</a></li>
                                <li><a href="notes.html">Notes</a></li>
                                <li><a href="login.html">Login & SignUp</a></li>
                                <li><a href="lockscreen.html">Lockscreen</a></li>
                                <li><a href="404.html">404</a></li>
                                <li><a href="empty.html">Empty Page</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </aside>

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
                        

                    <div class="row">
                        <div class="col-sm-4 col-md-3 text-center">
                            <div class="redondear" id="imagencontainer"
                                <?php
                                    echo "style='width: 210px; height: 210px; background-image: url(";
                                    echo "img/Avatares/". $_SESSION['UsuarioID'] .".png?" . filemtime("img/Avatares/". $_SESSION['UsuarioID'] .".png");
                                    echo ")'";
                                ?>
                            >
                                <a href="" onclick="document.getElementById('imgInp').click(); return false" class="pmop-edit">
                                <i class="zmdi zmdi-camera"></i><span>Cambiar Avatar</span>
                                </a>
                                <input type='file' id="imgInp" style="visibility: hidden; width: 1px; height: 1px"/>
                            </div>
                        </div>
                        <div class="col-sm-8 col-md-9">
                            <div class="fg-line form-group">
                                <label for="Perfil_Usuario">Usuario</label>
                                <input type="text" class="form-control input-sm" id="Perfil_Usuario" placeholder="Usuario" disabled
                                    value=<?php echo $valor["Usuario"]; ?>>
                            </div>
                            <div class="fg-line form-group">
                                <p><label>Color de tema</label></p>
                                <p>También puede modificarlo desde el menú desplegable en la esquina superior derecha</p>
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
                if( imageURI == "" ) return;

                var form = new Object();
                form.Avatar =                   imageURI;

                var postInfo = JSON.stringify(form);

                $.post( "scripts/GuardaPerfil.php", postInfo) .done(function( data ) {
                    resp = JSON.parse(data);
                    switch (resp.Codigo) {
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
            
        </script>

    </body>
</html>