<!DOCTYPE html>

<?php 
    require_once('scripts/VerificarLogin.php');
?>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>Protocolos</title>

        <!-- Vendor styles -->
        <link rel="stylesheet" href="vendors/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css">
        <link rel="stylesheet" href="vendors/bower_components/animate.css/animate.min.css">
        <!--<link rel="stylesheet" href="vendors/bower_components/jquery.scrollbar/jquery.scrollbar.css">-->
        <link rel="stylesheet" href="vendors/bower_components/select2/dist/css/select2.min.css">

        <!-- App styles -->
        <link rel="stylesheet" href="css/app.min.css">
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
                    <h1 id="Titulo" style="color:white">Nuevo protocolo</h1>
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
                            <img class="user__img" src=
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
                        <li class="navigation__sub--active"><a href="protocolos.php"><i class="zmdi zmdi-home"></i> Protocolos</a></li>

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
            </aside>

            <section class="content content--full">

                <div class="card">
                    <div class="card-block">
                        
                        <div class="form-group fg-line">

                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Tipo de tumor</label>

                                    <select class="select2 formControl" data-placeholder="Tipo de tumor" id="TipoTumor" data-id=0 onChange="CargaCombos();">
                                        <option value=8>Bones And Joints</option>
                                        <option value=9>Soft Tissues</option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label>Localizacion</label>

                                    <select id="Localizacion" class="select2 formControl" disabled data-id=0 onChange="CargaCombos();">
                                        <option>&nbsp;</option>
                                    </select>
                                </div>
                                <div class="col-sm-2">
                                    <label>Loc. en el hueso</label>

                                    <select id="LocHueso" class="select2 formControl" disabled data-id=0>
                                        <option>&nbsp;</option>
                                    </select>
                                </div>
                                <div class="col-sm-2">
                                    <label>Lado</label>

                                    <select id="Lado" class="select2 formControl" disabled data-id=0>
                                        <option value=0>Sin especificar</option>
                                        <option value=1>Izquierdo</option>
                                        <option value=2>Derecho</option>
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-sm-12">
                                <label>Historial clínico</label>
                                <div class="form-group">
                                    <input type="text" class="form-control formControl" id="HistorialClinico" placeholder="Historial clínico">
                                    <i class="form-group__bar"></i>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <label>Diagnóstico presuntivo </label>
                                    <input type="text" class="form-control formControl" id="DiagnosticoPresuntivo" placeholder="Diagnóstico presuntivo">                                    <i class="form-group__bar"></i>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Fecha de orden</label>
                                    <input type="tel" class="form-control input-mask formControl" id="FechaOrden" placeholder="Fecha de orden" data-mask="00/00/0000">
                                    <i class="form-group__bar"></i>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <label>Material recibido</label>
                                            <ul class="actions">
                                                <a id="lnkMatEnv" data-toggle="modal" href="#modalMatEnv" onclick="CargaMatEnv();">
                                                    <i class="actions__item zmdi zmdi-plus-circle-o" data-toggle="tooltip" data-placement="bottom" title="Añadir material recibido a la lista"></i>
                                                </a>
                                            </ul>
                                        </div>

                                        <div class="card-block">
                                            <div class="row">
                                                <div class="col-sm-2">
                                                    <label class="custom-control custom-checkbox">
                                                        <input type="checkbox" id="Imagenes" class="custom-control-input">
                                                        <span class="custom-control-indicator"></span>
                                                        <span class="custom-control-description">Recibe imagenes</span>
                                                    </label>
                                                </div>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control formControl" id="Imagenes_Obs" placeholder="Observaciones">
                                                    <i class="form-group__bar"></i>
                                                </div>
                                            </div>

                                            <div class="card-body table-responsive">
                                                <table class="table" id="MatEnv">
                                                    <thead>
                                                        <tr>
                                                            <th>Material</th>
                                                            <th>Cantidad</th>
                                                            <th>Fijado en</th>
                                                            <th>Obtenido por</th>
                                                            <th>Contenido</th>
                                                            <th>Observaciones</th>
                                                            <th>Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="MatEnvBody">
                                                        
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h2 class="card-title">Informes</h2>
                            </div>

                            <div class="card-block">
                                <div class="tab-container">
                                    <ul class="nav nav-tabs nav-fill" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#informe_principal" role="tab">Informe principal</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#informe_complementario" role="tab">Informe complementario</a>
                                        </li>
                                    </ul>

                                    <div class="tab-content">
                                        <div class="tab-pane active fade show" id="informe_principal" role="tabpanel">
                                            <textarea class="form-control" rows="15"></textarea>
                                        </div>
                                        <div class="tab-pane fade" id="informe_complementario" role="tabpanel">
                                            <textarea class="form-control" rows="15"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group fg-line">
                            <div class="card">
                                <div class="card-header">
                                    <label>Diagnóstico</label>
                                </div>
                                <div class="card-block">
                                    <div class="form-group fg-line">
                                        <div class="row">
                                            <div class="col-sm-4">
                                               <label>Diagnóstico patológico 1</label>
                                               <div>
                                                  <div style="display:inline-block;" id="DiagPatol1" data-id="0">Ninguno seleccionado.</div>
                                                  <a id="lnkDiag1" data-toggle="modal" href="#modalSelect" onclick="IniciaDiagnosticos(1);"> (Cambiar selección)</a>
                                               </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" id="Duda1" class="custom-control-input">
                                                    <span class="custom-control-indicator"></span>
                                                    <span class="custom-control-description">Duda</span>
                                                </label>
                                            </div>
                                            <div class="col-sm-4">
                                               <label>Diagnóstico patológico 2</label>
                                               <div>
                                                  <div style="display:inline-block;" id="DiagPatol2" data-id=0>Ninguno seleccionado.</div>
                                                  <a id="lnkDiag2" data-toggle="modal" href="#modalSelect" onclick="IniciaDiagnosticos(2);"> (Cambiar selección)</a>
                                               </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" id="Duda2" class="custom-control-input">
                                                    <span class="custom-control-indicator"></span>
                                                    <span class="custom-control-description">Duda</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
        <script src="vendors/bower_components/select2/dist/js/select2.full.min.js"></script>
        <script src="vendors/bower_components/jquery-mask-plugin/dist/jquery.mask.min.js"></script>

        <script src="vendors/bower_components/salvattore/dist/salvattore.min.js"></script>

        <!-- Vendors: Data tables -->
        <script src="vendors/bower_components/datatables.net/js/jquery.dataTables.js"></script>
        <script src="vendors/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
        <script src="vendors/bower_components/datatables.net-buttons/js/buttons.print.min.js"></script>
        <script src="vendors/bower_components/jszip/dist/jszip.min.js"></script>
        <script src="vendors/bower_components/datatables.net-buttons/js/buttons.html5.min.js"></script>

        <!-- App functions and actions -->
        <script src="js/mios.js"></script>
        <script src="js/app.min.js"></script>

    <script>

        $( ".bg-<?php echo $_SESSION['Skin']; ?>" ).addClass("active");

        var table = $("#data-table").DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "scripts/datatables/protocolos.php"
                },
            "columns": [
                { "data": "Estado", "width": "0px" },
                { "data": "ID", "width": "0px" },
                { "data": "Cuando", "width": "0px" },
                { "data": "Paciente" },
                { "data": "Localizacion" },
                { "data": "Medico" },
                { "data": "Hospital" }
            ],
            "order": [[ 2, "desc" ]],
            "stateSave": true,
            lengthMenu: [
                [15, 30, 45, -1],
                ["15 filas", "30 filas", "45 filas", "Todo"]
            ],
            language: {
                searchPlaceholder: "Buscar en la lista...",
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla",
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "sInfoFiltered":   "\(filtrado de un total de _MAX_ registros)",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            },
            buttons: [{
                extend: "excelHtml5",
                title: "Listado de protocolos"
            }, {
                extend: "csvHtml5",
                title: "Listado de protocolos"
            }, {
                extend: "print",
                title: "Listado de protocolos"
            }],
            initComplete: function (e, t) {
                $(this)
                    .closest(".dataTables_wrapper")
                    .prepend('<div class="dataTables_buttons hidden-sm-down actions"><span class="actions__item zmdi zmdi-print" data-table-action="print" /><span class="actions__item zmdi zmdi-fullscreen" data-table-action="fullscreen" /><div class="dropdown actions__item"><i data-toggle="dropdown" class="zmdi zmdi-download" /><ul class="dropdown-menu dropdown-menu-right"><a href="" class="dropdown-item" data-table-action="excel">Excel (.xlsx)</a><a href="" class="dropdown-item" data-table-action="csv">CSV (.csv)</a></ul></div></div>')
            }
        });

        $(".dataTables_filter input[type=search]").focus(function () {
            $(this)
                .closest(".dataTables_filter")
                .addClass("dataTables_filter--toggled")
        });

        //Seleccionar con doble click
        $('#data-table tbody').on('dblclick', 'tr', function () {
            var data = table.row( this ).data();
            var id = data['ID'];
            //window.location.assign("verprotocolo.php?ProtocoloID="+id);
        });
        //Seleccionar con doble click
    </script>

    </body>
</html>