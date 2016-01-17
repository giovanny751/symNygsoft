<!DOCTYPE HTML>
<html lang="es-co">
<head>
    <meta charset="UTF-8">
    <title>SG-SST</title>
    
    <!--------------------------------------------------------------------------
                                    Fondos
    ------------------------------------------------------------------------ -->
    <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" />
    
    <!--------------------------------------------------------------------------
                                    Iconos
    ------------------------------------------------------------------------ -->
    <link type="text/css" rel="stylesheet" href="<?php echo base_url("assets/global/plugins/font-awesome/css/font-awesome.min.css") ?>" />
    <link type="text/css" rel="stylesheet" href="<?php echo base_url("assets/global/plugins/simple-line-icons/simple-line-icons.min.css") ?>" />
    
    <!--------------------------------------------------------------------------
                                Estilos Librerias
    ------------------------------------------------------------------------ -->
    <link type="text/css" rel="stylesheet" href="<?php echo base_url("css/sst.css") ?>" />
    <link type="text/css" rel="stylesheet" href="<?php echo base_url("css/bootstrap_3.3.5.min.css") ?>" />
    <link type="text/css" rel="stylesheet" href="<?php echo base_url("css/bootstrap_theme_3.3.5.min.css") ?>" />
    <link type="text/css" rel="stylesheet" href="<?php echo base_url("css/jquery-ui_11.11.4.min.css") ?>" />
    <link type="text/css" rel="stylesheet" href="<?php echo base_url("css/jquery-ui.theme_11.11.4.min.css") ?>" />
    
    <!--------------------------------------------------------------------------
                            Estilos Layoud
    ------------------------------------------------------------------------ -->
    <link type="text/css" rel="stylesheet" href="<?php echo base_url("assets/global/css/components.css") ?>" />
    <link type="text/css" rel="stylesheet" href="<?php echo base_url("assets/global/css/plugins.css") ?>" />
    <link type="text/css" rel="stylesheet" href="<?php echo base_url("assets/admin/layout/css/layout.css") ?>" />
    <link type="text/css" rel="stylesheet" href="<?php echo base_url("assets/admin/layout/css/themes/blue.css") ?>" />
    <link type="text/css" rel="stylesheet" href="<?php echo base_url("assets/admin/layout/css/custom.css") ?>" />
    
    <!--------------------------------------------------------------------------
                            Otros Estilos Necesarios
    ------------------------------------------------------------------------ -->
    <!-- Calendario -->
    <link type="text/css" rel="stylesheet" href="<?php echo base_url("assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css") ?>" />
    <!-- Notificaciones -->
    <link type="text/css" rel="stylesheet" href="<?= base_url('assets/global/plugins/jquery-notific8/jquery.notific8.min.css') ?>"/>
    <!-- Datepicker -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/global/plugins/bootstrap-datepicker/css/datepicker3.css') ?>"/>
    
    
    
</head>
<body class="page-header-fixed page-quick-sidebar-over-content page-sidebar-closed-hide-logo page-container-bg-solid page-footer-fixed">
    <?php
        function modulos($datosmodulos, $idusuario, $dato = null,$prueba = null) {
            $ci = &get_instance();
            $ci->load->model("ingreso_model");
            $user = null;
            $menu = $ci->ingreso_model->menu($datosmodulos, $idusuario, 2);
            $i = array();
            foreach ($menu as $modulo)
                $i[$modulo['menu_nombrepadre']][$modulo['menu_idpadre']] [] = array($modulo['menu_idhijo'], $modulo['menu_controlador'], $modulo['menu_accion'], $modulo['mod_icons']);
            
            if(empty($prueba)) { ?>
                <ul class="page-sidebar-menu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
                    <li class="sidebar-toggler-wrapper">
                        <div class="sidebar-toggler"></div>
                    </li>
                    <?php
            }else{ ?>
                <ul class='sub-menu'>
                <?php
            }
            
                foreach ($i as $nombrepapa => $menuidpadre)
                    foreach ($menuidpadre as $modulos => $menu)
                        foreach ($menu as $submenus):
                            if ($submenus[1] == "" && $submenus[2] == "")
                                echo "<li><a href='javascript:;'><i class='icon-home'></i> <span class='title'>" . strtoupper($nombrepapa) . "</span><span class='arrow'></span></a>";
                            else
                                echo "<li><a href='" . base_url("index.php/" . $submenus[1] . "/" . $submenus[2]) . "'><i class='icon-bar-chart'></i> <span class='title'>" . strtoupper($nombrepapa) . "</span></a>";
                            if (!empty($submenus[0]))
                                modulos($submenus[0], $idusuario, null,'uno');
                            echo "</li>";
                        endforeach;
            if ($datosmodulos == 'prueba')
                echo "<li><a href='" . base_url('index.php/login/logout') . "'>CERRAR SESION</a></li>";
            echo "</ul>";
        }
    ?>
    <!-- HEADER -->
    <div class="page-header -i navbar navbar-fixed-top">
        <div class="page-header-inner">
            <!-- Logo -->
            <div class="page-logo">
                <a href="<?php echo base_url("index.php/presentacion/principal") ?>">
                    <!-- <img src="<?php echo base_url("img/nygsoft.png") ?>" alt="logo" class="logo-default"/> -->
                    <h4 class="logo-default">SG-SST</h4>
                </a>
                <div class="menu-toggler sidebar-toggler hide">
                </div>
            </div>
            <!-- Empezar RESPONSIVE menu despegable -->
            <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"></a>
            <!-- Empezar navegacion menu superior -->
            <div class="top-menu">
                <ul class="nav navbar-nav pull-right">
                    <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <i class="icon-bell"></i>
                            <span class="badge badge-default">8</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="external">
                                <h3><span class="bold">12 pendiente</span> notificaciones</h3>
                                <a href="<?php ?>">Ver todos</a>
                            </li>
                            <li>
                                <ul class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283">
                                    <li>
                                        <a href="javascript:;">
                                            <span class="time">Ahora</span>
                                            <span class="details">
                                                <span class="label label-sm label-icon label-success">
                                                    <i class="fa fa-plus"></i>
                                                </span>
                                                Nuevo usuario registrado
                                            </span>
                                        </a>
                                    </li>   
                                    <li>
                                        <a href="javascript:;">
                                            <span class="time">3 minutos</span>
                                            <span class="details">
                                                <span class="label label-sm label-icon label-danger">
                                                    <i class="fa fa-bolt"></i>
                                                </span>
                                                Extintor vencido
                                            </span>
                                        </a>
                                    </li>   
                                    <li>
                                        <a href="javascript:;">
                                            <span class="time">1 Dia</span>
                                            <span class="details">
                                                <span class="label label-sm label-icon label-warning">
                                                    <i class="fa fa-bolt"></i>
                                                </span>
                                                Extintor por vencer
                                            </span>
                                        </a>
                                    </li>   
                                    <li>
                                        <a href="javascript:;">
                                            <span class="time">1 Dia</span>
                                            <span class="details">
                                                <span class="label label-sm label-icon label-warning">
                                                    <i class="fa fa-bolt"></i>
                                                </span>
                                                Extintor por vencer
                                            </span>
                                        </a>
                                    </li>   
                                    <li>
                                        <a href="javascript:;">
                                            <span class="time">1 Dia</span>
                                            <span class="details">
                                                <span class="label label-sm label-icon label-warning">
                                                    <i class="fa fa-bolt"></i>
                                                </span>
                                                Extintor por vencer
                                            </span>
                                        </a>
                                    </li>   
                                    <li>
                                        <a href="javascript:;">
                                            <span class="time">1 Dia</span>
                                            <span class="details">
                                                <span class="label label-sm label-icon label-warning">
                                                    <i class="fa fa-bolt"></i>
                                                </span>
                                                Extintor por vencer
                                            </span>
                                        </a>
                                    </li>   
                                    <li>
                                        <a href="javascript:;">
                                            <span class="time">1 Dia</span>
                                            <span class="details">
                                                <span class="label label-sm label-icon label-warning">
                                                    <i class="fa fa-bolt"></i>
                                                </span>
                                                Extintor por vencer
                                            </span>
                                        </a>
                                    </li>   
                                    <li>
                                        <a href="javascript:;">
                                            <span class="time">1 Dia</span>
                                            <span class="details">
                                                <span class="label label-sm label-icon label-warning">
                                                    <i class="fa fa-bolt"></i>
                                                </span>
                                                Extintor por vencer
                                            </span>
                                        </a>
                                    </li>   
                                    <li>
                                        <a href="javascript:;">
                                            <span class="time">1 Dia</span>
                                            <span class="details">
                                                <span class="label label-sm label-icon label-warning">
                                                    <i class="fa fa-bolt"></i>
                                                </span>
                                                Extintor por vencer
                                            </span>
                                        </a>
                                    </li>   
                                    <li>
                                        <a href="javascript:;">
                                            <span class="time">1 Dia</span>
                                            <span class="details">
                                                <span class="label label-sm label-icon label-warning">
                                                    <i class="fa fa-bolt"></i>
                                                </span>
                                                Extintor por vencer
                                            </span>
                                        </a>
                                    </li>   
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <!-- CONTENEDOR -->
    <div class="page-container">
        <!-- Empezar Barra Lateral -->
        <div class="page-sidebar-wrapper">
            <div class="page-sidebar navbar-collapse collapse">
                <?php echo modulos('prueba', $id, null); ?>
            </div>
        </div>
        <!-- Contenido -->
        <div class="page-content-wrapper">
            <div class="page-content">
                <div class="page-bar">
                    <ul class="page-breadcrumb">
                        <li>
                            <i class="fa fa-home"></i>
                            <a href="javascript:;">Hogar</a>
                            <i class="fa fa-angle-right"></i>
                        </li>
                        <li>
                            <a href="#">Inicio</a>
                        </li>
                    </ul>
                    <div class="page-toolbar">
                        <div id="dashboard-report-range" class="pull-right tooltips btn btn-sm btn-default" data-container="body" data-placement="bottom" data-original-title="Fecha Actual">
                            <i class="icon-calendar"></i>&nbsp; <span class="thin uppercase visible-lg-inline-block"></span>&nbsp; <i class="fa fa-angle-down"></i>
                        </div>
                    </div>
                </div>
                <h3 class="page-tittle">
                    Titulo <small>reporte y estadisticas</small>
                </h3>
                <!-- Contenido -->
                <?php echo $content_for_layout ?>
                <!-- Final Contenido -->
            </div>
        </div>
    </div>
    <!-- FOOTER -->
    <div class="page-footer">
        <div class="page-footer-inner">
             2016 &copy; Nygsoft.
        </div>
        <div class="scroll-to-top">
            <i class="icon-arrow-up"></i>
        </div>
    </div>
    
    <!-- ------------------------------------------------------------
                                 SCRIPTS
    ---------------------------------------------------------------- -->
    
    <!-- Librerias  -->
    <script type="text/javascript" src="<?php echo base_url("js/jquery-1.12.0.min.js") ?>"></script>
    <script type="text/javascript" src="<?php echo base_url("js/jquery-ui_11.11.4.min.js") ?>"></script>
    <script type="text/javascript" src="<?php echo base_url("js/bootstrap_3.3.5.min.js") ?>"></script>

    <!-- Scripts Pagina -->
    <script type="text/javascript" src="<?php echo base_url("assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js") ?>"></script> <!-- Notificaciones -->
    <script type="text/javascript" src="<?php echo base_url("assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js") ?>"></script> <!-- Notificaciones -->
    <script type="text/javascript" src="<?php echo base_url("assets/global/plugins/bootstrap-daterangepicker/moment.min.js") ?>"></script> <!-- Fecha Inicio (1,3) -->
    <script type="text/javascript" src="<?php echo base_url("assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js") ?>"></script> <!-- Fecha Inicio (2,3) -->
    <script type="text/javascript" src="<?php echo base_url('assets/global/plugins/jquery-notific8/jquery.notific8.min.js') ?>"></script> <!-- Notificacion (1,2) -->
    <script type="text/javascript" src="<?php echo base_url('assets/admin/pages/scripts/ui-notific8.js') ?>"></script> <!-- Notificacion (2,2) -->
    <script type="text/javascript" src="<?= base_url('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') ?>"></script> <!-- Datepicker -->

    <!-- Inicio Pagina -->
    <script type="text/javascript" src="<?php echo base_url("assets/global/scripts/metronic.js") ?>"></script>
    <script type="text/javascript" src="<?php echo base_url("assets/admin/layout/scripts/layout.js") ?>"></script> <!-- Menu -->
    <script type="text/javascript" src="<?php echo base_url("assets/admin/pages/scripts/index.js") ?>"></script>  <!-- Fecha Inicio (3,3) -->
    
    <script type="text/javascript">
    jQuery(document).ready(function() {    
        Metronic.init(); // init metronic core componets
        Layout.init(); // Menu 
        Index.initDashboardDaterange(); // Fecha
        UINotific8.init();
    }); 
    //    --------------------------------------------------------------------------
    //COLORES DE ALERTAS DE METRONIC
    //    --------------------------------------------------------------------------
    function alerta(color, texto){
        switch (color) {
            case "rojo":
                var alerta = 'ruby sticky';
                break;
            case "morado":
                var alerta = 'amethyst sticky';
                break;
            case "azul":
                var alerta = 'teal sticky';
                break;
            case "amarillo":
                var alerta = 'lemon sticky';
                break;
            case "verde":
                var alerta = 'lime sticky';
                break;
            case "naranja":
                var alerta = 'tangerine sticky';
                break;
            default:
                break;
        }
        $.notific8('', {
            horizontalEdge: 'bottom',
            life: 5000,
            theme: alerta,
            heading: texto
        });
    }


    $('body').delegate('.number', 'keypress', function (tecla) {
        if (tecla.charCode > 0 && tecla.charCode < 48 || tecla.charCode > 57)
            return false;
    });
    //numero que permite comas        
    $('body').delegate('.number2', 'keypress', function (tecla) {
        console.log(tecla.charCode);
        if (tecla.charCode > 0 && (tecla.charCode < 48 || tecla.charCode > 57) && (tecla.charCode < 45 || tecla.charCode > 47))
            return false;
    });
    $('body').delegate('.miles', 'keyup', function (tecla) {
        $(this).val(num_miles($(this).val()))
    });
    $('body').delegate('.float', 'keypress', function (tecla) {
        if (tecla.charCode == 46)
            return true;
        if ((tecla.charCode > 0 && tecla.charCode < 48) || (tecla.charCode > 57))
            return false;
    });
    function obligatorio(clase) {
        var i = 0;
        $('.' + clase).each(function (key, val) {
            if ($(this).val() != "")
                $(this).removeClass('obligado');
            else {
                $(this).addClass('obligado');
                i++;
            }
        });
        if (i == 0)
            return true;
        else {
            alerta('naranja', "FALTAN CAMPOS POR LLENAR");
            return false;
        }
    };

    function email(classemail){
        var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
        //Se utiliza la funcion test() nativa de JavaScript
        if (regex.test($('.' + classemail).val().trim())) {
            $("." + classemail).removeClass('obligado');
            return true;
        } else {
            $("." + classemail).addClass('obligado');
            alerta("amarillo", "Correo no valido")
            return false;
        }
    }

    ;
    (function ($) {
                $.fn.datepicker.dates['es'] = {
                    days: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo"],
                    daysShort: ["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb", "Dom"],
                    daysMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa", "Do"],
                    months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
                    monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"]
                };
            }(jQuery));

    $(".email").change(function () {
        email("email");
    });
    
    $('.fecha').datepicker({
        language: "es",
        format: "yyyy-mm-dd",
        autoclose: true
    }); 

    function difFecha(idFecha1, idFecha2) {
        var valFecha1 = $(idFecha1).val();
        var valFecha2 = $(idFecha2).val();
        var arrayFecha1 = valFecha1.split("-");
        var arrayFecha2 = valFecha2.split("-");
        var fecha1 = new Date(arrayFecha1[0], arrayFecha1[1] - 1, arrayFecha1[2]);
        var fecha2 = new Date(arrayFecha2[0], arrayFecha2[1] - 1, arrayFecha2[2]);
        var resta = (fecha2 - fecha1) / 1000 / 3600 / 24;
        if (resta >= 0) {
            $(idFecha1,idFecha2).removeClass("obligado");
            return resta;
        } else {
            $(idFecha1,idFecha2).addClass("obligado");
            alerta("amarillo", "Fecha no es valida");
            return false;
        }
    }
    function difFechaIncapacidad(idFecha1, idFecha2) {
        var valFecha1 = $(idFecha1).val();
        var valFecha2 = $(idFecha2).val();
        var arrayFecha1 = valFecha1.split("-");
        var arrayFecha2 = valFecha2.split("-");
        var fecha1 = new Date(arrayFecha1[0], arrayFecha1[1] - 1, arrayFecha1[2]);
        var fecha2 = new Date(arrayFecha2[0], arrayFecha2[1] - 1, arrayFecha2[2]);
        var resta = (fecha2 - fecha1) / 1000 / 3600 / 24;
        if (resta >= 0) {
            $(idFecha1).removeClass("obligado");
            $(idFecha2).removeClass("obligado");
            return resta+1;
        } else {
            $(idFecha1).addClass("obligado");
            $(idFecha2).addClass("obligado");
            alerta("amarillo", "Fecha no es valida");
            return false;
        }
    }
    function num_miles(num) {
        num = num.toString().replace(/\$|\,/g, '');
        if (isNaN(num))
            num = "0";
        sign = (num == (num = Math.abs(num)));
        num = Math.floor(num * 100 + 0.50000000001);
        cents = num % 100;
        num = Math.floor(num / 100).toString();
        if (cents < 10)
            cents = "0" + cents;
        for (var i = 0; i < Math.floor((num.length - (1 + i)) / 3); i++)
            num = num.substring(0, num.length - (4 * i + 3)) + ',' +
                    num.substring(num.length - (4 * i + 3));
        return (((sign) ? '' : '-') + num);
    }
     
    </script>
    
</body>
</html>